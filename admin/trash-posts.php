<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {


    // Restore Post
    if ($_GET['action'] == 'restore') {
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "UPDATE tblposts SET Is_Active = 1 WHERE id = '$postid'");
        if ($query) {
            $_SESSION['msg'] = "Post restored successfully ";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
    }

    // Delete Post Permanently
    if (isset($_GET['presid'])) {
        $id = intval($_GET['presid']);
        $query = mysqli_query($con, "DELETE FROM tblposts WHERE id = '$id'");
        $_SESSION['delmsg'] = "Post deleted forever";
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme">
        <meta name="author" content="Coderthemes">
        <title>Newsportal | Manage Posts</title>
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/core.css" rel="stylesheet" />
        <link href="assets/css/components.css" rel="stylesheet" />
        <link href="assets/css/icons.css" rel="stylesheet" />
        <link href="assets/css/pages.css" rel="stylesheet" />
        <link href="assets/css/menu.css" rel="stylesheet" />
        <link href="assets/css/responsive.css" rel="stylesheet" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body class="fixed-left">
        <div id="wrapper">
            <?php include('includes/topheader.php'); ?>
            <?php include('includes/leftsidebar.php'); ?>

            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Trashed Posts</h4>
                                    <ol class="p-0 m-0 breadcrumb">
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#">Posts</a></li>
                                        <li class="active">Trashed Posts</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Display alerts -->
                        <div class="row">
                            <div class="col-sm-6">
                                <?php if (isset($_SESSION['delmsg'])) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo $_SESSION['delmsg']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <?php if (isset($_SESSION['msg'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Hurry!</strong> <?php echo $_SESSION['msg']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <?php if (isset($_SESSION['error'])) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo $_SESSION['error']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- 🔽 Unset messages after displaying -->
                        <?php
                        foreach (['msg', 'error', 'delmsg'] as $key) {
                            unset($_SESSION[$key]);
                        }
                        ?>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table class="table m-0 table-colored table-centered table-inverse">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($con, "SELECT tblposts.id AS postid, tblposts.PostTitle AS title, tblcategory.CategoryName AS category FROM tblposts LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId WHERE tblposts.Is_Active = 0");
                                                $rowcount = mysqli_num_rows($query);
                                                if ($rowcount == 0) {
                                                ?>
                                                    <tr>
                                                        <td colspan="3" align="center">
                                                            <h3 style="color:red">No record found</h3>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><b><?php echo htmlentities($row['title']); ?></b></td>
                                                            <td><?php echo htmlentities($row['category']); ?></td>
                                                            <td>
                                                                <a href="trash-posts.php?pid=<?php echo htmlentities($row['postid']); ?>&action=restore"
                                                                    onclick="return confirm('Do you really want to restore ?')">
                                                                    <i class="ion-arrow-return-right" title="Restore this Post"></i>
                                                                </a>
                                                                &nbsp;
                                                                <a href="trash-posts.php?presid=<?php echo htmlentities($row['postid']); ?>&action=perdel"
                                                                    onclick="return confirm('Do you really want to delete ?')">
                                                                    <i class="fa fa-trash-o" style="color: #f05050"
                                                                        title="Permanently delete this post"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- container -->
                </div> <!-- content -->
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
        <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>
        <script src="../plugins/morris/morris.min.js"></script>
        <script src="../plugins/raphael/raphael-min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../plugins/jvectormap/gdp-data.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        <script src="assets/pages/jquery.blog-dashboard.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>

    </html>
<?php } ?>