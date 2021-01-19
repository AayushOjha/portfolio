<?php
    include "config.php";
    $id = $_POST['cat_id'];
    $name = $_POST['cat_name'];
    $sql = "UPDATE category SET category_name = '$name' WHERE category_id = $id";
    $result = mysqli_query($conn , $sql) or die(mysqli_error($conn));
    if($result)
    {
        header("location: $hostname/admin/category.php");
    }
    else
    {
        echo "kuch to gudbad h daya";
    }
?>