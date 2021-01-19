<?php
include 'header.php';
?>
<div id="main-content">
    <h2>All Records</h2>

    <?php

    include 'conn.php';

    $sql = "SELECT * FROM student JOIN stuclass WHERE student.course = stuclass.cid";

    $result = mysqli_query($conn , $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0)
{
    ?>
    <table cellpadding="7px">
        <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Class</th>
        <th>Phone</th>
        <th>Action</th>
        </thead>
        <tbody>
        <?php
                while($entry = mysqli_fetch_assoc($result))
                {
            ?>
            <tr>
            
                <td> <?php echo $entry['srno']; ?>   </td>
                <td> <?php echo $entry['name'];      ?>   </td>
                <td> <?php echo $entry['address'];   ?>   </td>
                <td> <?php echo $entry['sphone'];    ?>   </td>
                <td> <?php echo $entry['cname'];     ?>   </td>

               

                <td>
                    <a href='edit.php?id=<?php echo $entry['srno']; ?>'>Edit</a>
                    <a href='delete-inline.php?id=<?php echo $entry['srno']; ?>'>Delete</a>
                </td>
                
         </tr>
                     
                <?php
                }
                ?>
        </tbody>
    </table>
    <?php  
}

else
                {
                    echo '<h2> No record found </h2>';
                }

                mysqli_close($conn);
    ?>
</div>
</div>
</body>
</html>
