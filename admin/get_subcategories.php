<?php
include('includes/config.php');
header('Content-Type: application/json');

if(isset($_POST['category_id'])) {
    $categoryId = intval($_POST['category_id']);
    $query = mysqli_query($con, "SELECT id, Subcategory FROM tblsubcategory WHERE CategoryId = $categoryId");
    $subcategories = array();
    
    while($row = mysqli_fetch_assoc($query)) {
        $subcategories[] = $row;
    }
    
    echo json_encode($subcategories);
} else {
    echo json_encode(array());
}
?>