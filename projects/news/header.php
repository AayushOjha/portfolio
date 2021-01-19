<?php

include "config.php";
$base = basename($_SERVER['PHP_SELF']);
switch($base)
{
case "single.php" : 
    if(isset($_GET['id']))
    {
        $sql2 = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
        $result2 = mysqli_query($conn , $sql2) or die(mysqli_error($conn));
        $row2 = mysqli_fetch_assoc($result2);
        $pgtitle = $row2['title'];
        
    }
    else
    {
        echo "goli beta maasti  nhi";
    }
break;

case "category.php" : 
    if(isset($_GET['cid']))
    {
        $sql2 = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
        $result2 = mysqli_query($conn , $sql2) or die(mysqli_error($conn));
        $row2 = mysqli_fetch_assoc($result2);
        $pgtitle = $row2['category_name'] . " posts";
        
    }
    else
    {
        echo "goli beta maasti nhi";
    }
break;

case "author.php" : 
    if(isset($_GET['aid']))
    {
        $sql2 = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
        $result2 = mysqli_query($conn , $sql2) or die(mysqli_error($conn));
        $row2 = mysqli_fetch_assoc($result2);
        $pgtitle = "posts by - " . $row2['username'];
        
    }
    else
    {
        echo "goli beta maasti nhi";
    }
break;

case "search.php" : 
    if(isset($_GET['search']))
    {
        $pgtitle = $_GET['search'];     
    }
    else
    {
        $pgtitle = "NO SEARCH REASULT";
    }
break;

case "index.php" : 
    $pgtitle = "NEWS SITE";
break;



default : 
  $pgtitle = "NEWS SITE";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $pgtitle; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
             include "config.php";
                if(isset($_GET['cid']))
                {
                $high_cat = $_GET['cid'];
                }
                $sql = "SELECT * FROM category WHERE post > 0";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                echo "  <ul class='menu'>";
                echo "<li><a href='$hostname'>Home</a></li>";
                if(mysqli_num_rows($result) > 0)
                {   
                    $active = "";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        if(isset($_GET['cid']))
                        {
                        if($row["category_id"] == $high_cat)
                        {
                            $active =  "active";
                        }
                        else
                        {
                            $active = "";
                        }
                    }
                    echo "<li><a class = '{$active}' href='category.php?cid={$row["category_id"]}'>{$row['category_name']}</a></li>";
                    }
                    echo  "</ul>";
                }
            ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
