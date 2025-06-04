<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);

if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
    exit();
}

// Handle form submission
if(isset($_POST['submit'])) {
    // First, reset all selected to 0
    mysqli_query($con, "UPDATE tblposts SET selected = 0");
    
    // Then update selected posts to 1
    if(isset($_POST['selected_posts']) && is_array($_POST['selected_posts'])) {
        $selected_ids = array_map('intval', $_POST['selected_posts']);
        $ids_string = implode(',', $selected_ids);
        mysqli_query($con, "UPDATE tblposts SET selected = 1 WHERE id IN ($ids_string)");
    }
    
    $_SESSION['msg'] = "Selection updated successfully";
    header("Location:pick.php");
    exit();
}

// Pagination setup
$per_page = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $per_page;

// Get total records for pagination
$total_query = mysqli_query($con, "SELECT COUNT(*) as total FROM tblposts");
$total_row = mysqli_fetch_assoc($total_query);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Posts</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <?php include('includes/topheader.php');?>
        <!-- Top Bar End -->

        <!-- Left Sidebar Start -->
        <?php include('includes/leftsidebar.php');?>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Manage Posts</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Admin</a></li>
                                    <li><a href="#">Posts</a></li>
                                    <li class="active">Manage Posts</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">  
                            <?php 
                            if(isset($_SESSION['msg'])) {
                                echo '<div class="alert alert-success" role="alert">
                                    <strong>Success!</strong> '.$_SESSION['msg'].'
                                </div>';
                                unset($_SESSION['msg']);
                            }
                            ?>
                        </div>
                    </div>

                    <form method="post" >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="demo-box m-t-20">
                                    <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-primary">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Select</th>
                                                    <th>Post Title</th>
                                                    <th>Category</th>
                                                    <th>Posting Date</th>
                                                    <th>Status</th>
                                                    <th>Selected</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query = mysqli_query($con, "SELECT p.*, c.CategoryName 
                                                                        FROM tblposts p 
                                                                        LEFT JOIN tblcategory c ON p.CategoryId = c.id 
                                                                        ORDER BY p.PostingDate DESC 
                                                                        LIMIT $start, $per_page");
                                                $cnt = $start + 1;
                                                while($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                    <td>
                                                        <input type="checkbox" name="selected_posts[]" 
                                                               value="<?php echo htmlentities($row['id']);?>" 
                                                               <?php echo ($row['selected'] == 1) ? 'checked' : ''; ?>>
                                                    </td>
                                                    <td><?php echo htmlentities($row['PostTitle']);?></td>
                                                    <td><?php echo htmlentities($row['CategoryName']);?></td>
                                                    <td><?php echo htmlentities($row['PostingDate']);?></td>
                                                    <td><?php echo ($row['Is_Active'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                                    <td><?php echo ($row['selected'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                                <?php
                                                $cnt++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center m-t-20">
                                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                            Update Selection
                                        </button>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="text-center m-t-20">
                                        <ul class="pagination">
                                            <?php if($page > 1): ?>
                                                <li><a href="manage-posts.php?page=<?php echo $page-1; ?>">Previous</a></li>
                                            <?php endif; ?>

                                            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                                                    <a href="manage-posts.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>

                                            <?php if($page < $total_pages): ?>
                                                <li><a href="manage-posts.php?page=<?php echo $page+1; ?>">Next</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->

            <?php include('includes/footer.php');?>
        </div>
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

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
</body>
</html>