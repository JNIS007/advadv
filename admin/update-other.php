<?php
session_start();
include("./includes/config.php");

// Function to clean text input but preserve HTML from CKEditor
function clean_input($input, $con, $allow_html = false) {
    if (empty($input)) {
        return '';
    }
    
    if ($allow_html) {
        // For CKEditor content, just escape it for database
        return mysqli_real_escape_string($con, trim($input));
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
        $required_fields = ['It', 'Nt', 'related_post_id', 'id', 'pagetitle', 'keyword', 'Author', 'Desc'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception(ucfirst(str_replace('_', ' ', $field)) . " is a required field");
            }
        }

        // Validate and sanitize IDs
        $id = (int)$_POST['id'];
        $related_post_id = (int)$_POST['related_post_id'];
        
        if ($id <= 0 || $related_post_id <= 0) {
            throw new Exception("Invalid ID");
        }

            // Update the post validation to:
            $stmt = $con->prepare("SELECT id FROM tblposts WHERE id = ?");
            $stmt->bind_param("i", $related_post_id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 0) {
                throw new Exception("Selected post with ID $related_post_id doesn't exist in the system");
            }
            $stmt->close();

        $stmt = $con->prepare("SELECT id FROM other WHERE id = ? AND is_active = 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows === 0) {
            throw new Exception("Record to update doesn't exist or is inactive");
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

        // Process chart data with same cleaning
        $chart_data = [];
        if (!empty($_POST['itinerary_outline']) && is_array($_POST['itinerary_outline'])) {
            foreach ($_POST['itinerary_outline'] as $index => $outline) {
                if (!empty(trim($outline))) {
                    $height = $_POST['height_in_meter'][$index] ?? '';
                    $chart_data[] = [
                        'outline' => clean_input($outline, $con),
                        'height' => clean_input($height, $con)
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

        // Use prepared statement for the update
        $stmt = $con->prepare("UPDATE other SET
            Detailed_Itinerary = ?,
            Important_Note = ?,
            Useful_Information = ?,
            Inc = ?,
            Exc = ?,
            faq = ?,
            Recommended_Package = ?,
            chart_data = ?,
            P_id = ?,
            PageTitle = ?,
            Keywords = ?,
            MetaAuthor = ?,
            `Description` = ?,
            created_at = NOW()
            WHERE id = ?");

        $stmt->bind_param("ssssssssissssi",
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
            $id
        );

        if ($stmt->execute()) {
            $_SESSION["msg"] = "Record updated successfully";
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        $_SESSION["error"] = "Error: " . $e->getMessage();
        $_SESSION['form_data'] = $_POST;
    } finally {
        header("Location: edit-other.php?oid=" . (isset($id) ? $id : ''));
        exit();
    }
} else {
    $_SESSION["error"] = "Invalid request method";
    header("Location: manage-other.php");
    exit();
}
?>