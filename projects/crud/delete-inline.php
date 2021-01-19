<?php
$mode = $_GET['id'];
$redir = "projects/crud/index.php";
if($mode)
{
    $id = $_GET['id'];
}
else {
    $id = $_POST['sid'];

}

 include 'conn.php';
 
$sql = "DELETE FROM student Where srno = $id";
$result = mysqli_query($conn , $sql) or die('there is some error in executing your query');


header("Location: https://ojhaji.xyz/$redir");   

mysqli_close($conn);

?>