<?php
session_start();
include("./includes/config.php");

header('Content-Type: application/json');

if (!isset($_SESSION['login']) || strlen($_SESSION['login']) == 0) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

if (isset($_GET['destination_id']) && isset($_GET['category_id'])) {
    $destination_id = (int)$_GET['destination_id'];
    $c = (int)$_GET['category_id'];
    $query = $con->prepare("SELECT id, PostTitle FROM tblposts WHERE Is_Active = 1 AND DestID = ? AND CategoryId=?");
    $query->bind_param("ii", $destination_id,$c);
    $query->execute();
    $result = $query->get_result();
    
    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    
    echo json_encode($posts);
} else {
    echo json_encode(['error' => 'Destination ID required']);
}
?>