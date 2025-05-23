<?php
include('includes/config.php');
header('Content-Type: application/json');

if (isset($_GET['destination_id'])) {
    $destinationId = intval($_GET['destination_id']);
    $query = mysqli_query($con, "SELECT id, PostTitle FROM tblposts WHERE Is_Active = 1 AND DestID = $destinationId");
    $posts = [];
    
    while ($row = mysqli_fetch_assoc($query)) {
        $posts[] = $row;
    }
    
    echo json_encode($posts);
}
?>