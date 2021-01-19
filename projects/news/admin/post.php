<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                          <?php
                                
                                include "config.php";
                                $limit = 5;
                                if(isset($_GET['page']))
                                {
                                   $page = $_GET['page'];
                                }
                                else{
                                        $page = 1;
                                       }
                                   $offset = ($page - 1) * $limit;
                                       if( $_SESSION['role'] == '1')
                                       {
                                   $sql = "SELECT post.title, post.post_date, post.post_id, category.category_name,post.category, user.username FROM post JOIN category ON post.category = category.category_id JOIN user ON post.author = user.user_id ORDER BY post.post_date DESC LIMIT $offset , $limit ";
                                       }
                                       else
                                       {
                                       $sql = "SELECT post.title, post.post_date, post.post_id, category.category_name, post.category, user.username FROM post JOIN category ON post.category = category.category_id JOIN user ON post.author = user.user_id WHERE post.author = {$_SESSION['user_id']} ORDER BY post.post_date DESC LIMIT $offset , $limit ";                                              
                                       }
                                   $result = mysqli_query($conn , $sql) or die(mysqli_error($conn));
                                // echo gettype($result); 
                                if(mysqli_num_rows($result) > 0)
                                {

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                          ?>
                            <tr>
                              <td class='id'><?php echo $row['post_id'] ?></td>
                              <td><?php echo $row['title'] ?></td>
                              <td><?php echo $row['category_name'] ?></td>
                              <td><?php echo $row['post_date'] ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delet-post.php?id=<?php echo $row['post_id'] ?>&cat=<?php echo $row['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                              </tr>
                            <?php
                                    }
                                }
                                    else
                                    {
                                        echo "no record found";
                                    }
                            ?>
                      </tbody>
                  </table>
                  <?php
                  if( $_SESSION['role'] == '1')
                  {
                  $sql2 = "SELECT * FROM post";
                  } 
                  else
                  {
                  $sql2 = "SELECT * FROM post WHERE author = {$_SESSION['user_id']}";
                  }
                  $result2 = mysqli_query($conn , $sql2) or die(mysqli_error($conn));

                        if(mysqli_num_rows($result2) > 0)
                        {
                            $total_record = mysqli_num_rows($result2);
                            $total_pages = ceil($total_record / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if($page > 1){
                        echo '<li><a href="post.php?page='.($page-1).'">Pre</a></li>';  
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
                             echo '<li class="'.$select.'"><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page< $total_pages ){
                            echo '<li><a href="post.php?page='.($page+1).'">Next</a></li>';  
                            }
                            echo " </ul>";

                        }   
                        ?>
           </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>