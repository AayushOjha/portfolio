<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Edit Record 
  </h2>
    <?php 
   
   include 'conn.php';
   
    ?>
   
    <form class="post-form" action="<?php  $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="showbtn" value="Show" />
    </form>
 
   
    <?php 
        if(isset($_POST['showbtn']))
        {
        $id = $_POST['sid'];
        $sql = "SELECT * FROM student Where srno = $id ";
        $result = mysqli_query($conn , $sql) or die("can;t execute quary");

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
    ?>
         <form class="post-form" action="re.php?mode=69" method="post">
        <div class="form-group">
            <label for="">Name</label>
            <input type="hidden" name="sid"  value="<?php echo $row['srno'] ; ?>" />
            <input type="text" name="sname" value="<?php echo  $row['name'] ; ?>" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?php echo $row['address'] ; ?>" />
        </div>
   
        <div class="form-group">
        <label>Class</label>
        <select name="class">
       
            <?php
            $sql2 =  "SELECT * FROM stuclass";
            $result2 = mysqli_query($conn, $sql2) or die("can;t execute quary");

            if(mysqli_num_rows($result2) >0 )
            {
                while($row2 = mysqli_fetch_assoc($result2))
                { 
                    if($row['course'] == $row2['cid'])
                    {
                       
                        $selected = "Selected";
                    }
                    else
                    {
                        $selected = "";
                    }
                    echo "<option $selected value='{$row2['cid']}'>{$row2['cname']}</option>";
                }
            } 
            ?>
        </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" value="<?php echo $row['sphone'] ; ?>" />
        </div>
    <input class="submit" type="submit" value="Update"  />
    </form>
<?php
            }
        }
        else
        {
            echo "<h1> No Record Found for ID num  " .  $id ." !!</h1>";
        }
    }

           
?>

</div>
</div>
</body>
</html>
