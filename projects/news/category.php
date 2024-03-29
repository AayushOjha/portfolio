<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                      include "config.php";
                    $cid = $_GET['cid'];
                    $sql2 = "SELECT * FROM category WHERE category_id = $cid";
                   
                    $result2 = mysqli_query($conn , $sql2) or die(mysqli_error($conn));
                    $row2 = mysqli_fetch_assoc($result2);  
                    ?>
                <h2 class='page-heading'><?php echo $row2['category_name']; ?></h2>
                <?php
              
                    $cid = $_GET['cid'];
                    $limit = 5;
                                if(isset($_GET['page']))
                                {
                                   $page = $_GET['page'];
                                }
                                else{
                                        $page = 1;
                                       }
                                $offset = ($page - 1) * $limit;       
                                $sql = "SELECT post.title , post.post_id, post.description,post.post_date,post.post_img,user.username, post.author,category.category_name From post JOIN user ON post.author = user.user_id JOIN category ON post.category = category.category_id WHERE category = $cid LIMIT $offset , $limit";
                                $result= mysqli_query($conn , $sql) or die(mysqli_error($conn));
                                $num = mysqli_num_rows($result);
                                if( mysqli_num_rows($result) > 0)
                                {
                                   
                                  while( $row = mysqli_fetch_assoc($result))
                                  {     
                ?>
                  
                  <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $cid; ?>'><?php echo $row['category_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,130). "...."; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                    <?php
                                    }
                                }
                                else
                                {
                                    echo "<h2>NO RECORD FOUND</h2>";
                                }
                                            ?>
                    
                    <?php
                        
                      
                        $total_records = $row2['post'];
                        $total_pages = ceil($total_records / $limit);
                        echo "<ul class='pagination'>";
                        if($page > 1)
                        {
                             echo "<li><a href='category.php?cid={$cid}&page=".($page-1)."'>Pre</a></li>";
                        }
                        for ($i=1; $i <= $total_pages ; $i++)
                         { 
                             if($i == $page)
                             {
                                 $active = "Active";
                             }
                              else
                             {
                                 $active = "";
                             }
                            echo "<li class='".$active."'><a href='category.php?cid={$cid}&page=".$i."'>".$i."</a></li>";
                         }
                         if($page < $total_pages)
                        {
                            echo '<li><a href="category.php?cid='.$cid.'&page='.($page+1).'">Next</a></li>';
                        }
                        echo "</ul>";
                        ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>