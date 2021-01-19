<?php

    include "config.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM `user` WHERE `user`.`user_id` = $id";
    $res = mysqli_query($conn , $sql);
  
  
    header("location: {$hostname}/admin/users.php");

    mysqli_close($conn);


?>