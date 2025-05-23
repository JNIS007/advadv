<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Advanture | Package</title>

        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

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
            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Package </h4>
                                    <ol class="p-0 m-0 breadcrumb">
                                        <li>
                                            <a href="#">Package</a>
                                        </li>
                                        <li>
                                            <a href="#">Add Package </a>
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <!---Success Message--->
                                <?php if (isset($_SESSION['msg'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Well done!</strong>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                </div>
                                <?php 
                                unset($_SESSION['msg']);
                                } ?>

                                <!---Error Message--->
                                <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Oh snap!</strong>
                                    <?php echo htmlentities($_SESSION['error']); ?>
                                </div>
                                <?php 
                                unset($_SESSION['error']);
                                } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" action="Move-add.php" method="post" enctype="multipart/form-data">

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Destination</label>
                                                <select class="form-control" name="Destination" id="destination" required>
                                                    <option value="">Select Destination</option>
                                                    <?php
                                                    $ret = mysqli_query($con, "SELECT id, DestName FROM tbldest;");
                                                    while ($result = mysqli_fetch_array($ret)) {
                                                        ?>
                                                        <option value="<?php echo htmlentities($result['id']); ?>">
                                                            <?php echo htmlentities($result['DestName']); ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Category</label>
                                                <select class="form-control" name="category" id="category" required>
                                                    <option value="">Select Category</option>
                                                    <!-- Categories will be loaded via AJAX -->
                                                </select>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Package Title</label>
                                                <input type="text" class="form-control" id="posttitle" name="posttitle"
                                                    placeholder="Enter title" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Price</label>
                                                <input type="text" class="form-control" id="price" name="price"
                                                    placeholder="Enter Price" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Days</label>
                                                <input type="text" class="form-control" id="Day" name="day"
                                                    placeholder="Enter Days" required>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Package Details</b></h4>
                                                        <textarea class="form-control" id="editor" name="postdescription"
                                                            required></textarea>
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
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                                        <input type="file" class="form-control" id="postimage"
                                                            name="postimage" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" name="submit"
                                                class="btn btn-success waves-effect waves-light">Save and Post</button>
                                            <button type="button"
                                                class="btn btn-danger waves-effect waves-light">Discard</button>
                                        </form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->
                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

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

        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function () {
                // Initialize Select2
                $(".select2").select2();
                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });

                // Destination change handler
                $('#destination').change(function() {
                    var destId = $(this).val();
                    var categorySelect = $('#category');
                    
                    // Clear existing options except the first one
                    categorySelect.find('option').not(':first').remove();
                    
                    if(destId) {
                        // Fetch categories for the selected destination via AJAX
                        $.ajax({
                            url: 'get_categories.php',
                            type: 'POST',
                            data: {dest_id: destId},
                            dataType: 'json',
                            success: function(data) {
                                if(data.length > 0) {
                                    $.each(data, function(key, value) {
                                        categorySelect.append('<option value="'+ value.id +'">'+ value.CategoryName +'</option>');
                                    });
                                } else {
                                    categorySelect.append('<option value="">No categories found</option>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error: " + status + " - " + error);
                            }
                        });
                    }
                });
            });
        </script>
    </body>
    </html>
<?php } ?>