<?php
ob_start(); // Start output buffering
session_start();

include("./includes/config.php");

if (isset($_POST['submit'])) {
    // Sanitize and validate input data
    $posttitle = mysqli_real_escape_string($con, trim($_POST['posttitle']));
    $catid = intval($_POST['category']);
    $subcatid = isset($_POST['subcategory']) ? intval($_POST['subcategory']) : NULL;
    $dest = intval($_POST['Destination']);
    $price = mysqli_real_escape_string($con, trim($_POST['price']));
    $day = mysqli_real_escape_string($con, trim($_POST['day']));
    $postdetails = mysqli_real_escape_string($con, trim(strip_tags($_POST['postdescription'])));
    $postedby = "admin";

    // Generate URL
    $arr = explode(" ", $posttitle);
    $url = mysqli_real_escape_string($con, implode("-", $arr));

    // Validate subcategory exists if provided
    if ($subcatid !== NULL) {
        $checkSubcat = mysqli_query($con, "SELECT id FROM tblsubcategory WHERE id = '$subcatid' AND CategoryId = '$catid'");
        if (mysqli_num_rows($checkSubcat) == 0) {
            $_SESSION['error'] = "The selected subcategory is not valid for this category";
            header("Location: add-post.php");
            exit();
        }
    }

    // Validate destination exists
    $checkDest = mysqli_query($con, "SELECT id FROM tbldest WHERE id = '$dest'");
    if (mysqli_num_rows($checkDest) == 0) {
        $_SESSION['error'] = "Invalid destination selected";
        header("Location: add-post.php");
        exit();
    }

    // Handle multiple image uploads
    $imageNames = [];
    $allowed_extensions = [".jpg", ".jpeg", ".png", ".gif"];

    foreach ($_FILES['postimages']['tmp_name'] as $key => $tmp_name) {
        $imgfile = $_FILES['postimages']['name'][$key];
        $extension = strtolower(substr($imgfile, strrpos($imgfile, ".")));

        if (!in_array($extension, $allowed_extensions)) {
            $_SESSION['error'] = 'Invalid format. Only jpg/jpeg/png/gif allowed';
            header("Location: add-post.php");
            exit();
        }

        $imgnewfile = md5(uniqid()) . $extension;
        $target_path = "postimages/" . $imgnewfile;

        if (move_uploaded_file($_FILES['postimages']['tmp_name'][$key], $target_path)) {
            $imageNames[] = $imgnewfile;
        } else {
            $_SESSION['error'] = 'Error uploading one of the images';
            header("Location: add-post.php");
            exit();
        }
    }

    // Encode all uploaded image names into JSON
    $imageJson = json_encode($imageNames);

    // Prepare and execute query with proper NULL handling
    $query = "INSERT INTO tblposts(PostTitle, CategoryId, PostDetails, PostUrl, Is_Active, 
    PostImage, postedBy, Price, Days, DestID, SubCategoryId) 
    VALUES('$posttitle', '$catid', '$postdetails', '$url', 1, 
    '$imageJson', '$postedby', '$price', '$day', '$dest', "
        . ($subcatid === NULL ? "NULL" : "'$subcatid'") . ")";

    if (mysqli_query($con, $query)) {
        $_SESSION['msg'] = "Post successfully added";
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($con);
        // Optional: Delete the uploaded image if the query failed
        if (file_exists($target_path)) {
            unlink($target_path);
        }
    }

    header("Location: add-post.php");
    exit();
}
ob_end_flush();
