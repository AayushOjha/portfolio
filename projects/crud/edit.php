<?php include 'header.php'; ?>

<div id="main-content">
    <h2>Update Record</h2>
    <?php 

include 'conn.php';
//  $conn = mysqli_connect('localhost' , 'id14730432_ayushji' , '\NMwQ-CuG%_0W84G' , 'id14730432_geeson') or die('Cannot connect with database');
 $srno = $_GET['id']; 
 $sql = "SELECT * FROM student WHERE srno = {$srno} ";
 $result = mysqli_query($conn , $sql) or die('there is some error in executing your query');

 
 if(mysqli_num_rows($result) > 0 )
 {
     while($row = mysqli_fetch_assoc($result))
     {

 ?>
    <form class="post-form" action="re.php?mode=69" method="post">
      <div class="form-group">
          <label>Name</label> 
          <input type="hidden" name="sid" value="<?php echo $row['srno'] ?>"/>
          <input type="text" name="sname" value="<?php echo $row['name'] ?>"/>
      </div>
      <div class="form-group">
          <label>Address</label>
          <input type="text" name="saddress" value="<?php echo $row['address'] ?>"/>
      </div>
      <div class="form-group">
          <label>Class</label>
     
              <?php
    
                    
                    $sql2 = "SELECT * FROM stuclass";
                    $result2 = mysqli_query($conn , $sql2) or die('there is some error in executing your query');

                    if(mysqli_num_rows($result2) > 0)
                    {
                        echo '<select name="class">';

                    while($row2 = mysqli_fetch_assoc($result2)){
   
                    if($row2['cid'] == $row['course']){

                            $selected = "Selected";

                            }
                    else {
                        $selected = "";
                    }            


                    echo  "<option $selected value='{$row2['cid']}'>{$row2['cname']}</option>" ;
                    }
                  echo " </select>";
                    }
                    ?>
         
      </div>
      <div class="form-group">
          <label>Phone</label>
          <input type="text" name="sphone" value="<?php echo $row['sphone'] ?>"/>
      </div>
      <input class="submit" type="submit" value="Update"/>
    </form>
    <?php
     }
        }
    ?>
</div>
</div>
</body>
</html>
