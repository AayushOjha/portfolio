<?php include "header.php"; 
        include "config.php";
        include "safety.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <?php
                         $limit = 3;
                         if(isset($_GET['page']))
                         {
                            $page = $_GET['page'];
                         }
                         else{
                                 $page = 1;
                                }
                            $offset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM user LIMIT $offset , $limit";
                        $result = mysqli_query($conn , $sql) or die('cannot execute query');

                        if(mysqli_num_rows($result) > 0)
                        {
                            while($rows = mysqli_fetch_assoc($result))
                            {
                        
                      ?>
                      <tbody>
                          <tr>
                              <td class='id'><?php echo $rows['user_id'];  ?></td>
                              <td><?php echo $rows['first_name'] .' '. $rows['last_name']; ?></td>
                              <td><?php echo $rows['username']; ?></td>
                              <td><?php
                               if($rows['role'] == 1)
                              {
                                  echo "admin";
                              }
                              else{
                                  echo "writer";
                              }
                              ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $rows["user_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $rows["user_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                      </tbody>
                     
                      <?php 
                            }
                        }else
                        {
                            echo "<h2> No record Found</h2>";
                        } 
                    ?>
                     </table>
                     <?php
                        $sql2 = "SELECT * FROM user";
                        $result2 = mysqli_query($conn , $sql2) or die(mysqli_error($conn));

                        if(mysqli_num_rows($result2) > 0)
                        {
                            $total_record = mysqli_num_rows($result2);
                            $total_pages = ceil($total_record / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if($page > 1){
                        echo '<li><a href="users.php?page='.($page-1).'">Pre</a></li>';  
                        }    
                        for($i = 1; $i <= $total_pages ; $i++ )
                            {
                                if($i == $page)
                                {
                                    $select = "active";
                                }
                                else
                                {
                                    $select = "";
                                }
                             echo '<li class="'.$select.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page< $total_pages ){
                            echo '<li><a href="users.php?page='.($page+1).'">Next</a></li>';  
                            }
                            echo " </ul>";

                        }   
                        ?>
         
                     
                     
                    
                 
              </div>
          </div>
      </div>
      
  </div>

