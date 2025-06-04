<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
}

// Function to clean input data
function clean_input($input, $con, $allow_html = false) {
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
        $clean = preg_replace_callback('/<([a-z][a-z0-9]*)([^>]*)>/i', function($matches) {
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
        $clean = preg_replace('/(\r\n|\r|\n){2,}/', "\n", $clean);
        $clean = preg_replace('/<p[^>]*>\s*<\/p>/', '', $clean);
        $clean = preg_replace('/<p[^>]*>(\s|&nbsp;)*<\/p>/', '', $clean);
        $clean = preg_replace('/\s+/', ' ', $clean);
        
        return mysqli_real_escape_string($con, $clean);
    }
    
    // For regular text fields
    $clean = html_entity_decode($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $clean = strip_tags($clean);
    $clean = preg_replace('/\s+/', ' ', $clean);
    return mysqli_real_escape_string($con, trim($clean));
}

// Handle form submission
if (isset($_POST['submit'])) {
    try {
        // Validate required fields
        $required_fields = ['category', 'description'];
        $missing_fields = [];
        
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                $missing_fields[] = ucfirst($field);
            }
        }
        
        if (!empty($missing_fields)) {
            throw new Exception("Required fields missing: " . implode(', ', $missing_fields));
        }

        // Clean input data
        $title = clean_input($_POST['category'], $con);
        $description = clean_input($_POST['description'], $con, true);
        $status = 1;

        // Handle image upload
        $img_url = '';
        if (isset($_FILES['postimage']) && $_FILES['postimage']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "postimages/travel-guide/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $file_name = basename($_FILES["postimage"]["name"]);
            $target_file = $target_dir . uniqid() . '_' . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Check if image file is a actual image
            $check = getimagesize($_FILES["postimage"]["tmp_name"]);
            if ($check === false) {
                throw new Exception("File is not an image.");
            }
            
            // Check file size (max 5MB)
            if ($_FILES["postimage"]["size"] > 5000000) {
                throw new Exception("Sorry, your file is too large. Max 5MB allowed.");
            }
            
            // Allow certain file formats
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowed_types)) {
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }
            
            // Upload file
            if (move_uploaded_file($_FILES["postimage"]["tmp_name"], $target_file)) {
                $img_url = $target_file;
            } else {
                throw new Exception("Sorry, there was an error uploading your file.");
            }
        } else {
            throw new Exception("Please upload an image for the travel guide.");
        }

        // Insert into database
        $query = mysqli_query($con, "INSERT INTO travel_guide (Title, Description, Img_url, status) 
                                    VALUES ('$title', '$description', '$img_url', '$status')");
        
        if ($query) {
            $_SESSION['msg'] = "Travel guide created successfully";
            header("Location: add-travel.php");
            exit();
        } else {
            throw new Exception("Database error: " . mysqli_error($con));
        }
        
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .cke_notifications_area {
            display: none !important;
        }
    </style>
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>

    <title>Adventure | Add Travel Guide</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>

</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <?php include('includes/topheader.php'); ?>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include('includes/leftsidebar.php'); ?>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Add Travel Guide</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Admin</a></li>
                                    <li><a href="#">Travel Guide</a></li>
                                    <li class="active">Add Travel Guide</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Add Travel Guide</b></h4>
                                <hr />
                                
                                <?php 
                                if (isset($_SESSION['error'])) {
                                    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                                    unset($_SESSION['error']);
                                }
                                if (isset($_SESSION['msg'])) {
                                    echo '<div class="alert alert-success">' . $_SESSION['msg'] . '</div>';
                                    unset($_SESSION['msg']);
                                }
                                ?>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" value="<?php echo isset($_POST['category']) ? htmlspecialchars($_POST['category']) : ''; ?>" name="category" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Description</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" id="editor" name="description" required><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                                                    <script>
                                                        CKEDITOR.replace('editor', {
                                                            toolbar: [
                                                                { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
                                                                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                                                                { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
                                                                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                                                                { name: 'colors', items: ['TextColor', 'BGColor'] },
                                                                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting'] },
                                                                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                                                                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
                                                                { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                                                            ],
                                                            height: 300
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Image</label>
                                                <div class="col-md-10">
                                                    <input type="file" class="form-control" id="postimage" name="postimage" required accept="image/*">
                                                    <p class="help-block">Upload a featured image for the travel guide (Max 5MB, JPG/PNG/GIF)</p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">&nbsp;</label>
                                                <div class="col-md-10">
                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->

            <?php include('includes/footer.php'); ?>
        </div>
    </div>

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>
</html>