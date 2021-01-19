<?php

include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id = {$id};";
$result = mysqli_query($conn , $sql) or die(mysqli_error($conn));
if($result)
{
    header("location: {$hostname}/admin/category.php ");
}
else
{
    echo "error";
}
?>