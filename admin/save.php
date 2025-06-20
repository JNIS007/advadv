<?php
session_start();
include("./includes/config.php");

// Function to clean text input with HTML sanitization for CKEditor
function clean_input($input, $con, $allow_html = false)
{
    if (empty($input)) {
        return '';
    }

    $input = trim($input);

    if ($allow_html) {
        // Define allowed HTML tags for CKEditor content
        $allowed_tags = '<p><a><strong><em><b><i><u><h1><h2><h3><h4><h5><h6><ul><ol><li><br><hr><table><tr><td><th><thead><tbody><div><span><img>';

        // Strip all tags except allowed ones
        $clean = strip_tags($input, $allowed_tags);

        // Remove all attributes except specific allowed ones
        $clean = preg_replace_callback('/<([a-z][a-z0-9]*)([^>]*)>/i', function ($matches) {
            $tag = strtolower($matches[1]);
            $attributes = $matches[2];

            // Define allowed attributes per tag
            $allowed_attrs = [];
            switch ($tag) {
                case 'a':
                    $allowed_attrs = ['href', 'title', 'target'];
                    break;
                case 'img':
                    $allowed_attrs = ['src', 'alt', 'title', 'width', 'height'];
                    break;
                default:
                    $allowed_attrs = ['style', 'class'];
            }

            // Process attributes
            $new_attrs = '';
            if (preg_match_all('/([a-z\-]+)\s*=\s*("[^"]*"|\'[^\']*\')/i', $attributes, $attr_matches)) {
                foreach ($attr_matches[1] as $i => $attr_name) {
                    $attr_name_lower = strtolower($attr_name);
                    if (in_array($attr_name_lower, $allowed_attrs)) {
                        // Basic XSS protection for attribute values
                        $attr_value = $attr_matches[2][$i];
                        if (strpos($attr_value, 'javascript:') !== false) {
                            continue; // Skip dangerous attributes
                        }
                        $new_attrs .= ' ' . $attr_name . '=' . $attr_value;
                    }
                }
            }

            return '<' . $tag . $new_attrs . '>';
        }, $clean);

        // Additional cleaning for unwanted whitespace and line breaks
        $clean = preg_replace('/(\r\n|\r|\n){2,}/', "\n", $clean); // Replace multiple newlines with single
        $clean = preg_replace('/<p[^>]*>\s*<\/p>/', '', $clean); // Remove empty paragraphs
        $clean = preg_replace('/<p[^>]*>(\s|&nbsp;)*<\/p>/', '', $clean); // Remove paragraphs with only whitespace
        $clean = preg_replace('/\s+/', ' ', $clean); // Replace multiple spaces with single space

        // Escape for database
        return mysqli_real_escape_string($con, $clean);
    }

    // For regular text fields
    $clean = html_entity_decode($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $clean = strip_tags($clean);
    $clean = preg_replace('/\s+/', ' ', $clean);
    return mysqli_real_escape_string($con, trim($clean));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validate required fields
        $required_fields = ['It', 'Nt', 'related_post_id', 'pagetitle', 'keyword', 'Author', 'Desc'];
        $missing_fields = [];

        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                $missing_fields[] = ucfirst(str_replace('_', ' ', $field));
            }
        }

        if (!empty($missing_fields)) {
            throw new Exception("Required fields missing: " . implode(', ', $missing_fields));
        }

        // Validate and sanitize post ID
        $related_post_id = (int)$_POST['related_post_id'];
        if ($related_post_id <= 0) {
            throw new Exception("Invalid post ID");
        }

        // Verify post exists
        $stmt = $con->prepare("SELECT id FROM tblposts WHERE id = ? AND Is_Active = 1");
        if (!$stmt) {
            throw new Exception("Database error: " . $con->error);
        }

        $stmt->bind_param("i", $related_post_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            throw new Exception("Selected post doesn't exist or is inactive");
        }
        $stmt->close();

        // Prepare all data with proper sanitization
        $fields = [
            'It' => ['field' => 'itinerary', 'html' => true],
            'Nt' => ['field' => 'important_note', 'html' => true],
            'useful_info' => ['field' => 'useful_info', 'html' => true],
            'whats_included' => ['field' => 'whats_included', 'html' => true],
            'whats_Excluded' => ['field' => 'whats_excluded', 'html' => true],
            'faq' => ['field' => 'faq', 'html' => true],
            'req' => ['field' => 'recommended_package', 'html' => true]
        ];

        $data = [];
        foreach ($fields as $post_key => $config) {
            $data[$config['field']] = isset($_POST[$post_key]) ?
                clean_input($_POST[$post_key], $con, $config['html']) : '';
        }

        // Process chart data with validation
        $chart_data = [];
        if (!empty($_POST['itinerary_outline']) && is_array($_POST['itinerary_outline'])) {
            foreach ($_POST['itinerary_outline'] as $index => $outline) {
                $outline_clean = clean_input($outline, $con);
                if (!empty($outline_clean)) {
                    $height = isset($_POST['height_in_meter'][$index]) ?
                        clean_input($_POST['height_in_meter'][$index], $con) : '';

                    // Basic validation for height (optional)
                    if (!empty($height) && !is_numeric($height)) {
                        $height = ''; // Clear invalid height
                    }

                    $chart_data[] = [
                        'outline' => $outline_clean,
                        'height' => $height
                    ];
                }
            }
        }
        $chart_data_json = !empty($chart_data) ? json_encode($chart_data) : '';

        // Clean SEO fields
        $seo_fields = [
            'pagetitle' => clean_input($_POST['pagetitle'], $con),
            'keyword' => clean_input($_POST['keyword'], $con),
            'Author' => clean_input($_POST['Author'], $con),
            'Desc' => clean_input($_POST['Desc'], $con)
        ];

        // Insert into database
        if (!empty($_POST['countries'])) {
            $ids =  json_encode($_POST['countries']);
        }
        $stmt = $con->prepare("INSERT INTO other (
            `Detailed_Itinerary`,
            `Important_Note`,
            `Useful_Information`,
            `Inc`,
            `Exc`,
            `faq`,
            `Recommended_Package`,
            `chart_data`,
            `is_active`,
            `created_at`,
            `P_id`,
            `PageTitle`,
            `Keywords`,
            `MetaAuthor`,
            `Description`,
            `selectedrecommend`
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, NOW(), ?, ?, ?, ?, ?,?)");

        if (!$stmt) {
            throw new Exception("Database error: " . $con->error);
        }

        $stmt->bind_param(
            "ssssssssisssss",
            $data['itinerary'],
            $data['important_note'],
            $data['useful_info'],
            $data['whats_included'],
            $data['whats_excluded'],
            $data['faq'],
            $data['recommended_package'],
            $chart_data_json,
            $related_post_id,
            $seo_fields['pagetitle'],
            $seo_fields['keyword'],
            $seo_fields['Author'],
            $seo_fields['Desc'],
            $ids

        );

        if ($stmt->execute()) {
            $last_id = $con->insert_id;
            $_SESSION["msg"] = "Record created successfully. ID: " . $last_id;
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $_SESSION["error"] = "Error: " . $e->getMessage();
        $_SESSION['form_data'] = $_POST;
    } finally {
        header("Location: other-category.php");
        exit();
    }
}
