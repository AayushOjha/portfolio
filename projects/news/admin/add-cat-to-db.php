<?php
    include "config.php";
    $sql = "INSERT INTO category (category_name) VALUES ('{$_POST['cat']}')";
    $result = mysqli_query($conn , $sql) or die('error');
    if($result)
    {
        header("location: {$hostname}/admin/category.php ");
    }
    else
    {
        echo "error1";
    }
    
    
?>