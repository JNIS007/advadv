<?php
session_start();
include("./includes/config.php");

header('Content-Type: application/json');

if (!isset($_SESSION['login']) || strlen($_SESSION['login']) == 0) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

if (isset($_GET['destination_id'])) {
    $destination_id = (int)$_GET['destination_id'];
    $query = $con->prepare("SELECT id, CategoryName FROM tblcategory WHERE Is_Active = 1 AND DestId = ?");
    $query->bind_param("i", $destination_id);
    $query->execute();
    $result = $query->get_result();
    
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    
    echo json_encode($categories);
} else {
    echo json_encode(['error' => 'Destination ID required']);
}
?>