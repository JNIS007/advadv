<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
    exit();
}

// Get subcategory data if ID is provided
$subcatid = isset($_GET['scid']) ? intval($_GET['scid']) : 0;
$subcategory = [];
$categories = [];

if($subcatid > 0) {
    // Fetch subcategory details
    $query = mysqli_query($con, "SELECT s.*, c.CategoryName, d.DestName 
                                FROM tblsubcategory s
                                JOIN tblcategory c ON s.CategoryId = c.id
                                JOIN tbldest d ON c.DestID = d.id
                                WHERE s.id = '$subcatid'");
    $subcategory = mysqli_fetch_assoc($query);
    
    if(!$subcategory) {
        header('location:manage-subcategories.php');
        exit();
    }
    
    // Fetch available categories (only Nepal's Trekking and Tours categories)
    $catquery = mysqli_query($con, "SELECT c.id, c.CategoryName
                                   FROM tbldest d
                                   JOIN tblcategory c ON c.DestID = d.id
                                   WHERE LOWER(d.DestName) = 'nepal'
                                   AND (
                                       (c.CategoryName LIKE '%Trekking%' AND c.CategoryName LIKE '%Nepal%' AND c.CategoryName LIKE '%Mountains%')
                                       OR
                                       (c.CategoryName LIKE '%Tours%' AND c.CategoryName LIKE '%Nepal%')
                                   );");
    while($row = mysqli_fetch_assoc($catquery)) {
        $categories[] = $row;
    }
}

if(isset($_POST['updatesubcat'])) {
    $subcatid = intval($_POST['subcatid']);
    $categoryid = intval($_POST['category']);
    $subcatname = mysqli_real_escape_string($con, $_POST['subcategory']);
    $subcatdescription = mysqli_real_escape_string($con, $_POST['sucatdescription']);
    $status = intval($_POST['status']);
    
    $query = mysqli_query($con, "UPDATE tblsubcategory 
                                SET CategoryId = '$categoryid',
                                    Subcategory = '$subcatname',
                                    SubCatDescription = '$subcatdescription',
                                    Is_Active = '$status'
                                WHERE id = '$subcatid'");
    
    if($query) {
        $_SESSION['msg'] = "Sub-Category updated successfully";
        header("location:manage-subcategories.php");
        exit();
    } else {
        $error = "Something went wrong. Please try again.";    
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Adventure | Edit Sub-Category</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .cke_notifications_area{
            display: none !important;
        }
    </style>
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
    
    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
    <div id="wrapper">
        <!-- Top Bar Start -->
        <?php include('includes/topheader.php');?>
        <!-- Top Bar End -->

        <!-- Left Sidebar Start -->
        <?php include('includes/leftsidebar.php');?>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Edit Sub-Category</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Admin</a></li>
                                    <li><a href="#">Category</a></li>
                                    <li class="active">Edit Sub-Category</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Edit Sub-Category</b></h4>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">  
                                        <?php if(isset($_SESSION['msg'])) { ?>
                                            <div class="alert alert-success" role="alert">
                                                <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                                            </div>
                                            <?php unset($_SESSION['msg']); ?>
                                        <?php } ?>

                                        <?php if(isset($error)) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <form class="form-horizontal" name="category" method="post">
                                            <input type="hidden" name="subcatid" value="<?php echo htmlentities($subcatid); ?>">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Category</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="category" required>
                                                        <option value="">Select Category</option>
                                                        <?php foreach($categories as $cat): ?>
                                                            <option value="<?php echo htmlentities($cat['id']); ?>" 
                                                                <?php if(isset($subcategory['CategoryId']) && $subcategory['CategoryId'] == $cat['id']) echo 'selected'; ?>>
                                                                <?php echo htmlentities($cat['CategoryName']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select> 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Sub-Category Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="subcategory" 
                                                        value="<?php echo isset($subcategory['Subcategory']) ? htmlentities($subcategory['Subcategory']) : ''; ?>" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Description</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" id="editor2" name="sucatdescription" required><?php 
                                                        echo isset($subcategory['SubCatDescription']) ? htmlentities($subcategory['SubCatDescription']) : ''; 
                                                    ?></textarea>
                                                    <script>
                                                        CKEDITOR.replace('editor2', {
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
                                                <label class="col-md-3 control-label">Status</label>
                                                <div class="col-md-9">
                                                    <div class="radio radio-success radio-inline">
                                                        <input type="radio" id="active" value="1" name="status" 
                                                            <?php echo (!isset($subcategory['Is_Active']) || $subcategory['Is_Active'] == 1) ? 'checked' : ''; ?>>
                                                        <label for="active"> Active </label>
                                                    </div>
                                                    <div class="radio radio-danger radio-inline">
                                                        <input type="radio" id="inactive" value="0" name="status"
                                                            <?php echo (isset($subcategory['Is_Active']) && $subcategory['Is_Active'] == 0) ? 'checked' : ''; ?>>
                                                        <label for="inactive"> Inactive </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">&nbsp;</label>
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="updatesubcat">
                                                        Update
                                                    </button>
                                                    <a href="manage-subcategories.php" class="btn btn-default waves-effect waves-light btn-md">
                                                        Cancel
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('includes/footer.php');?>
        </div>
    </div>

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