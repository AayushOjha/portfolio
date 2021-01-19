<?php
$name = $_POST['sname'];
$add = $_POST['saddress'];
$phone = $_POST['sphone'];
$class = $_POST['class'];

include 'conn.php';

// $conn = mysqli_connect('localhost' , 'id14730432_ayushji', '\NMwQ-CuG%_0W84G' , 'id14730432_geeson') or die('Cannot connect with database' . mysqli_connect_error());

$sql = "INSERT INTO `student` (`name`, `address`, `course`, `sphone`) VALUES ('$name', '$add', '$class', '$phone')";

$result = mysqli_query($conn , $sql) or die('there is some error in executing your query');


header("Location: https://ojhaji.xyz/projects/crud/index.php");

mysqli_close($conn);

?>