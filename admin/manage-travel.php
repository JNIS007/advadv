<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set("display_error",1);

if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
    exit();
}

// Handle deletion
if(isset($_GET['action']) && isset($_GET['rid'])) {
    if($_GET['action']=='del' && $_GET['rid']){
    $id = intval($_GET['rid']);
    $query = mysqli_query($con,"UPDATE travel_guide SET status='0' WHERE id='$id'");
    $_SESSION['msg'] = "Travel guide deleted";
    header("Location: manage-travel.php");
    exit();
    }else{
     $id = intval($_GET['rid']);
    echo "<script> alert($id)</script>";
    // First get image path to delete file
    $query = mysqli_query($con,"SELECT Img_url FROM travel_guide WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    $img_path = $row['img_url'];
    
    // Delete record from database
    $query = mysqli_query($con,"DELETE FROM travel_guide WHERE id='$id'");
    
    // Delete image file if exists
    if(file_exists($img_path)) {
        unlink($img_path);
    }
    
    $_SESSION['msg'] = "Travel guide deleted forever";
    header("Location: manage-travel.php");
    exit();
    }
}

// Handle restoration
if(isset($_GET['resid'])) {
    $id = intval($_GET['resid']);
    $query = mysqli_query($con,"UPDATE travel_guide SET status='1' WHERE id='$id'");
    $_SESSION['msg'] = "Travel guide restored successfully";
    header("Location: manage-travel.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Travel Guides</title>
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
                                <h4 class="page-title">Manage Travel Guides</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Admin</a></li>
                                    <li><a href="#">Travel Guide</a></li>
                                    <li class="active">Manage Travel Guides</li>
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-box m-t-20">
                                <div class="m-b-30">
                                    <a href="add-travel.php">
                                        <button id="addToTable" class="btn btn-success waves-effect waves-light">
                                            Add <i class="mdi mdi-plus-circle-outline"></i>
                                        </button>
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query = mysqli_query($con,"SELECT * FROM travel_guide WHERE status='1'");
                                            $cnt = 1;
                                            while($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                <td><?php echo htmlentities($row['Title']);?></td>
                                                <td>
                                                    <?php if(!empty($row['Img_url'])): ?>
                                                    <img src="<?php echo htmlentities($row['Img_url']);?>" width="80" height="60">
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                                <td>
                                                    <a href="edit-travel.php?id=<?php echo htmlentities($row['id']);?>">
                                                        <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                    </a> 
                                                    &nbsp;
                                                    <a href="manage-travel.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> 
                                                        <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-box m-t-20">
                                <div class="m-b-30">
                                    <h4><i class="fa fa-trash-o"></i> Deleted Travel Guides</h4>
                                </div>

                                <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-bordered-danger">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $query = mysqli_query($con,"SELECT * FROM travel_guide WHERE status='0'");
                                            $cnt = 1;
                                            while($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                <td><?php echo htmlentities($row['Title']);?></td>
                                                <td>
                                                    <?php if(!empty($row['Img_url'])): ?>
                                                    <img src="<?php echo htmlentities($row['Img_url']);?>" width="80" height="60">
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="manage-travel.php?resid=<?php echo htmlentities($row['id']);?>">
                                                        <i class="ion-arrow-return-right" title="Restore this travel guide"></i>
                                                    </a> 
                                                    &nbsp;
                                                    <a href="manage-travel.php?rid=<?php echo htmlentities($row['id']);?>&action=parmdel" title="Delete forever"> 
                                                        <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
</body>
</html>