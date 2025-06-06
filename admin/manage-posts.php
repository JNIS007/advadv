<?php 
session_start();
include('includes/config.php');
// error_reporting();
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Newsportal | Manage Package</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="../plugins/morris/morris.css">

        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

        <!-- jQuery UI for drag and drop -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php');?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php');?>

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
                                    <h4 class="page-title">Manage Package</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Package</a>
                                        </li>
                                        <li class="active">
                                            Manage Package  
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <?php 
                        // Display and clear messages
                        if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Well done!</strong>
                            <?php echo htmlentities($_SESSION['msg']); ?>
                        </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Oh snap!</strong>
                            <?php echo htmlentities($_SESSION['error']); ?>
                        </div>
                        <?php } ?>

                        <?php 
                        // Clear all messages after displaying
                        unset($_SESSION['msg']);
                        unset($_SESSION['error']);
                        ?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table class="table table-colored table-centered table-inverse m-0" id="sortable-table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable">
                                                <?php
                                                $query=mysqli_query($con,"SELECT 
                                                    tblposts.id AS postid,
                                                    tblposts.PostTitle AS title,
                                                    tblcategory.CategoryName AS category,
                                                    tblposts.sort_order AS sort_order
                                                FROM 
                                                    tblposts 
                                                LEFT JOIN 
                                                    tblcategory ON tblcategory.id = tblposts.CategoryId
                                                WHERE 
                                                    tblposts.Is_Active = 1
                                                ORDER BY tblposts.sort_order ASC");
                                                $rowcount=mysqli_num_rows($query);
                                                if($rowcount==0) {
                                                ?>
                                                <tr>
                                                    <td colspan="4" align="center"><h3 style="color:red">No record found</h3></td>
                                                <tr>
                                                <?php 
                                                } else {
                                                    while($row=mysqli_fetch_array($query)) {
                                                ?>
                                                <tr class="sortable-row" data-id="<?php echo htmlentities($row['postid']); ?>">
                                                    <td><b><?php echo htmlentities($row['title']);?></b></td>
                                                    <td><?php echo htmlentities($row['category'])?></td>
                                                    <td>
                                                        <a href="edit-post.php?pid=<?php echo htmlentities($row['postid']);?>">
                                                            <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                        </a> 
                                                        &nbsp;
                                                        <a href="Delete-post.php?pid=<?php echo htmlentities($row['postid']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')"> 
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- CounterUp  -->
        <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

        <!--Morris Chart-->
        <script src="../plugins/morris/morris.min.js"></script>
        <script src="../plugins/raphael/raphael-min.js"></script>

        <!-- Load page level scripts-->
        <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../plugins/jvectormap/gdp-data.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>

        <!-- Dashboard Init js -->
        <script src="assets/pages/jquery.blog-dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Drag and drop functionality -->
        <script>
        $(function() {
            $("#sortable").sortable({
                handle: "td", // Makes the entire row draggable
                update: function(event, ui) {
                    var order = [];
                    $('.sortable-row').each(function(index, element) {
                        order.push({
                            id: $(this).data('id'),
                            position: index + 1
                        });
                    });
                    
                    $.ajax({
                        type: "POST",
                        url: "update-order.php",
                        data: { order: order },
                        success: function(response) {
                            console.log("Order updated successfully");
                        },
                        error: function(xhr, status, error) {
                            console.error("Error updating order: " + error);
                        }
                    });
                }
            });
            $("#sortable").disableSelection();
        });
        </script>

    </body>
</html>
<?php } ?>