<?php
session_start();
include("./includes/config.php");
if($_GET['action']='del')
{
$postid=intval($_GET['pid']);
$query=mysqli_query($con,"update tblposts set Is_Active=0 where id='$postid'");
if($query)
{
$_SESSION['msg']="Post deleted ";
}
else{
$_SESSION['error']="Something went wrong . Please try again.";    
} 
 header("location:manage-posts.php");
}else{
    header("location:index.php");
}
?>