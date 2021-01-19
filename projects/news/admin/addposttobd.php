<?php
include "config.php";
session_start();
if(isset($_FILES['fileToUpload']))
{
    $error = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $ext = explode('.',$file_name);
    $file_ext =  end($ext);
    $extenshions = array("jpeg", "jpg", "png");

    if(in_array($file_ext , $extenshions) === false)
    {
        $error[] = "This file format is not supported. Plese uploade jpeg , jpg or png";
    }

    if($file_size > 2097152 )
    {
        $error[] = "Plese upload file whose sixze is less than 2MB ";
    }

    $filenam = time()."-".basename($file_name); 

    if(empty($error) == true )
    {
     move_uploaded_file($file_tmp, "upload/".$filenam);
    }
    else
    {
        print_r($error);
        die();
    }

}

$title =mysqli_real_escape_string($conn ,$_POST['post_title']);
$desc = mysqli_real_escape_string($conn ,$_POST['postdesc']);
$category = $_POST['category'];
$date = date("d M, Y");
$author = $_SESSION["user_id"];

$sql = "INSERT INTO post(title, description,category,post_date,author,post_img) VALUES ('$title', '$desc', $category, '$date', $author, '$filenam');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

$result = mysqli_multi_query($conn , $sql) or die(mysqli_error($conn));
 if($result)
 {
    header("location: {$hostname}/admin/post.php");
 }
 else
 {
     echo "<div class='alert alert-danger'> a Query Failed</div>";
 }

?>