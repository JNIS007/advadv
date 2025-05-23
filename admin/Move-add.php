 <?php
 session_start();
 include("./includes/config.php");
 // For adding post  
    if (isset($_POST['submit'])) {
        $posttitle = $_POST['posttitle'];
        $catid = $_POST['category'];
        $dest = $_POST['Destination'];
        $price = $_POST['price'];
        $day = $_POST['day'];
        $postdetails = strip_tags(addslashes($_POST['postdescription']));
        $postedby = $_SESSION['login'];
        $arr = explode(" ", $posttitle);
        $url = implode("-", $arr);
        $imgfile = $_FILES["postimage"]["name"];
        // get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".PNG", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            //rename the image file
            $imgnewfile = md5($imgfile) . $extension;
            // Code for move image into directory
            move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

            $status = 1;
            $query = mysqli_query($con, "insert into tblposts(PostTitle,CategoryId,PostDetails,PostUrl,Is_Active,PostImage,postedBy,Price,Days,DestID) values('$posttitle','$catid','$postdetails','$url','$status','$imgnewfile','$postedby','$price','$day','$dest')");

            if ($query) {
                $_SESSION['msg'] = "Post successfully added ";
            } else {
                $_SESSION['error'] = "Something went wrong . Please try again.";
            }
            header("location:add-post.php");
        }
    }
?>