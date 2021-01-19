<?php

include "config.php";

$id = $_GET['id'];
$cat = $_GET['cat'];

$sql1 = "SELECT post_img FROM post WHERE post_id = {$id}";
$result = mysqli_query($conn ,$sql1) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);
unlink("upload/".$row['post_img'] );

$sql = "DELETE FROM post WHERE post_id = {$id};";
$sql .= "UPDATE category SET post= post - 1 WHERE category_id = {$cat}";

if(mysqli_multi_query($conn , $sql))
{
    header("location: {$hostname}/admin/post.php ");
}
else
{
    echo "error";
}
?>