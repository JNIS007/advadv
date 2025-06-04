<?php
session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_POST['order']) && is_array($_POST['order'])) {
    foreach($_POST['order'] as $item) {
        $id = intval($item['id']);
        $position = intval($item['position']);
        
        $sql = "UPDATE tblposts SET sort_order = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $position, $id);
        mysqli_stmt_execute($stmt);
    }
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}
?>