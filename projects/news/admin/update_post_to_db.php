<?php
include "config.php";

if(empty($_FILES['new-image']['name']))
{
    $filenam = $_POST['old-image'];
}
else
{
        $error = array();
    
        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp =  $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
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

$id = $_POST['post_id'];
$title = $_POST['post_title'];
$desc = $_POST['postdesc'];
$cat = $_POST['category'];
$old_cat = $_POST['old_category'];

$sql = "UPDATE post SET title='$title' , description ='$desc', category= $cat , post_img='$filenam' WHERE post_id = $id ;";

if($old_cat != $cat)
{

    $sql .= "UPDATE category SET post = post-1 WHERE category_id = $old_cat ;";
    $sql .= "UPDATE category SET post = post+1 WHERE category_id = $cat ;";

}

$result = mysqli_multi_query($conn , $sql) or die(mysqli_error($conn));

if($result)
{
    header("location: {$hostname}/admin/post.php ");
}
else
{
    echo "error";
}
?>