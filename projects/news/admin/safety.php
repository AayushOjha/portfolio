<?php

if($_SESSION['role'] == '0')
{
    header("location: {$hostname}/admin/post.php");
}

?>