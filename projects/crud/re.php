<?php
$name = $_POST['sname'];
$add = $_POST['saddress'];
$phone = $_POST['sphone'];
$class = $_POST['class'];
$pera = $_GET['mode'];

include 'conn.php';


if($pera == 69)
{

$id = $_POST['sid'];


    $sql = "UPDATE student SET  name ='{$name}', address = '{$add}' , course = '{$class}' , sphone = '{$phone}' WHERE srno = {$id} ";

}

else
{
    $sql = "INSERT INTO `student` (`name`, `address`, `course`, `sphone`) VALUES ('$name', '$add', '$class', '$phone')";
}

    $result = mysqli_query($conn , $sql) or die('there is some error in executing your query');


    header("Location: https://ojhaji.xyz/projects/crud/index.php");

mysqli_close($conn);

?>