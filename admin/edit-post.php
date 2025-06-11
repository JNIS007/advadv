<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $posttitle = $_POST['posttitle'];
        $catid = $_POST['category'];
        $subcatid = isset($_POST['subcategory']) ? intval($_POST['subcategory']) : null;
        $price = $_POST['price'];
        $day = $_POST['day'];
        $postdetails = strip_tags($_POST['postdescription']);
        $lastuptdby = $_SESSION['login'];
        $arr = explode(" ", $posttitle);
        $url = implode("-", $arr);
        $status = 1;
        $postid = intval($_GET['pid']);

        $query = mysqli_query($con, "update tblposts set PostTitle='$posttitle',CategoryId='$catid',SubcategoryId=" . ($subcatid ? "'$subcatid'" : "NULL") . ",PostDetails='$postdetails',PostUrl='$url',Is_Active='$status',lastUpdatedBy='$lastuptdby',Price='$price',Days='$day' where id='$postid'");

        if ($query) {
            $_SESSION['msg'] = "Post updated ";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
        header("Location:manage-posts.php");
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <title>Newsportal | Add Post</title>

        <style>
            .cke_notifications_area {
                display: none !important;

            }
        </style>


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
        <div id="wrapper">
            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- Left Sidebar Start -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Edit Post</h4>
                                    <ol class="p-0 m-0 breadcrumb">
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#">Posts</a></li>
                                        <li class="active">Add Post</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>


                        <?php
                        $postid = intval($_GET['pid']);
                        $query = mysqli_query($con, "select tblposts.id as postid,tblposts.PostImage,tblposts.PostTitle as title,tblposts.PostDetails,tblcategory.CategoryName as category,tblcategory.id as catid,tblposts.Price as p,tblposts.Days as d,tblposts.SubcategoryId as subcatid from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId where tblposts.id='$postid' and tblposts.Is_Active=1");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="p-6">
                                        <div class="">
                                            <form name="addpost" method="post">
                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Post Title</label>
                                                    <input type="text" class="form-control" id="posttitle"
                                                        value="<?php echo htmlentities($row['title']); ?>" name="posttitle"
                                                        placeholder="Enter title" required>
                                                </div>

                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Price</label>
                                                    <input type="text" class="form-control" id="price"
                                                        value="<?php echo htmlentities($row['p']); ?>" name="price"
                                                        placeholder="Enter Price" required>
                                                </div>

                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Day</label>
                                                    <input type="text" class="form-control" id="day"
                                                        value="<?php echo htmlentities($row['d']); ?>" name="day"
                                                        placeholder="Enter Day" required>
                                                </div>

                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Category</label>
                                                    <select class="form-control" name="category" id="category" required>
                                                        <option value="<?php echo htmlentities($row['catid']); ?>">
                                                            <?php echo htmlentities($row['category']); ?>
                                                        </option>
                                                        <?php
                                                        $ret = mysqli_query($con, "select id,CategoryName from tblcategory where Is_Active=1");
                                                        while ($result = mysqli_fetch_array($ret)) {
                                                        ?>
                                                            <option value="<?php echo htmlentities($result['id']); ?>">
                                                                <?php echo htmlentities($result['CategoryName']); ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <!-- Add Subcategory dropdown -->
                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Subcategory</label>
                                                    <select class="form-control" name="subcategory" id="subcategory" <?php echo empty($row['subcatid']) ? 'disabled' : ''; ?>>
                                                        <option value="">Select Subcategory (if any)</option>
                                                        <?php
                                                        if (!empty($row['subcatid'])) {
                                                            $subcatQuery = mysqli_query($con, "SELECT id, Subcategory FROM tblsubcategory WHERE CategoryId = " . $row['catid']);
                                                            while ($subcat = mysqli_fetch_array($subcatQuery)) {
                                                                $selected = ($subcat['id'] == $row['subcatid']) ? 'selected' : '';
                                                                echo '<option value="' . htmlentities($subcat['id']) . '" ' . $selected . '>' . htmlentities($subcat['Subcategory']) . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">
                                                            <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                            <textarea id="editor" name="postdescription"
                                                                required><?php echo htmlentities($row['PostDetails']); ?></textarea>
                                                            <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
                                                            <script>
                                                                CKEDITOR.replace('editor', {
                                                                    toolbar: [{
                                                                            name: 'document',
                                                                            items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']
                                                                        },
                                                                        {
                                                                            name: 'clipboard',
                                                                            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                                                                        },
                                                                        {
                                                                            name: 'editing',
                                                                            items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                                                                        },
                                                                        {
                                                                            name: 'styles',
                                                                            items: ['Styles', 'Format', 'Font', 'FontSize']
                                                                        },
                                                                        {
                                                                            name: 'colors',
                                                                            items: ['TextColor', 'BGColor']
                                                                        },
                                                                        {
                                                                            name: 'basicstyles',
                                                                            items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
                                                                        },
                                                                        {
                                                                            name: 'paragraph',
                                                                            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                                                                        },
                                                                        {
                                                                            name: 'insert',
                                                                            items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
                                                                        },
                                                                        {
                                                                            name: 'tools',
                                                                            items: ['Maximize', 'ShowBlocks']
                                                                        }
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
                                                            <h4 class="m-b-30 m-t-0 header-title"><b>Posted Images </b></h4>
                                                            <?php
                                                            $images = json_decode($row['PostImage'], true);
                                                            foreach ($images as $image) {
                                                            ?>
                                                                <img src="postimages/<?php echo htmlentities($image); ?>"
                                                                    width="300" />
                                                            <?php } ?>
                                                            <br />
                                                            <a
                                                                href="change-image.php?pid=<?php echo htmlentities($row['postid']); ?>&img=<?php echo htmlentities($image); ?>">Update
                                                                Image</a>
                                                            <br />




                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <button type="submit" name="update"
                                                class="btn btn-success waves-effect waves-light">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <?php include('includes/footer.php'); ?>
            </div>
        </div>

        <script>
            var resizefunc = [];
        </script>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <script src="../plugins/summernote/summernote.min.js"></script>
        <script src="../plugins/select2/js/select2.min.js"></script>
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function() {
                $(".select2").select2();

                // Category change handler
                $('#category').change(function() {
                    var categoryId = $(this).val();
                    var subcategorySelect = $('#subcategory');

                    // Clear existing options except the first one
                    subcategorySelect.find('option').not(':first').remove();

                    if (categoryId) {
                        // Fetch subcategories for the selected category via AJAX
                        $.ajax({
                            url: 'get_subcategories.php',
                            type: 'POST',
                            data: {
                                category_id: categoryId
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.length > 0) {
                                    subcategorySelect.prop('disabled', false);
                                    $.each(data, function(key, value) {
                                        subcategorySelect.append('<option value="' + value.id + '">' + value.Subcategory + '</option>');
                                    });
                                } else {
                                    subcategorySelect.prop('disabled', true);
                                    subcategorySelect.append('<option value="">No subcategories available</option>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error: " + status + " - " + error);
                            }
                        });
                    } else {
                        subcategorySelect.prop('disabled', true);
                    }
                });
            });
        </script>


    </body>

    </html>
<?php } ?>