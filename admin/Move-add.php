<?php
ob_start(); // Start output buffering
session_start();

include("./includes/config.php");

if (isset($_POST['submit'])) {
    $posttitle = $_POST['posttitle'];
    $catid = $_POST['category'];
    $subcatid = isset($_POST['subcategory']) ? $_POST['subcategory'] : NULL ;
    $dest = $_POST['Destination'];
    $price = $_POST['price'];
    $day = $_POST['day'];
    $postdetails = strip_tags(addslashes($_POST['postdescription']));
    $postedby = "admin";
    $arr = explode(" ", $posttitle);
    $url = implode("-", $arr);
    $imgfile = $_FILES["postimage"]["name"];
    $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".PNG", ".gif");

    if (!in_array($extension, $allowed_extensions)) {
        $_SESSION['error'] = 'Invalid format. Only jpg / jpeg/ png /gif format allowed';
        header("Location: add-post.php");
        exit();
    } else {
        $imgnewfile = md5($imgfile) . $extension;
        move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

        $status = 1;
        $query = mysqli_query($con, "insert into tblposts(PostTitle,CategoryId,PostDetails,PostUrl,Is_Active,PostImage,postedBy,Price,Days,DestID,SubCategoryId) values('$posttitle','$catid','$postdetails','$url','$status','$imgnewfile','$postedby','$price','$day','$dest','$subcatid')");

        if ($query) {
            $_SESSION['msg'] = "Post successfully added";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
        header("Location: add-post.php");
        exit();
    }
}
ob_end_flush();
?>