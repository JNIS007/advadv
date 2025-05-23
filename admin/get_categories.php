<?php
include('includes/config.php');
header('Content-Type: application/json');

if(isset($_POST['dest_id']) && !empty($_POST['dest_id'])) {
    $destId = intval($_POST['dest_id']);
    
    // Query to get categories for the selected destination
    $query = "SELECT c.id, c.CategoryName 
              FROM tblcategory c
              JOIN tbldest dc ON c.DestId = dc.Id
              WHERE dc.Id = ? AND c.Is_Active = 1;";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $destId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $categories = array();
    while($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    
    echo json_encode($categories);
} else {
    echo json_encode(array());
}
?>