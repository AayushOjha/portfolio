<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php
                        include "config.php";
                        $limit = 3;
                        if(isset($_GET['page']))
                        {
                           $page = $_GET['page'];
                        }
                        else{
                                $page = 1;
                               }
                           $offset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM category LIMIT $offset , $limit";
                        $result = mysqli_query($conn , $sql) or die("error");
                        if(mysqli_num_rows($result) > 0)
                                {

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                          ?>

                        <tr>
                            <td class='id'><?php echo $row['category_id'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                                    }
                                }
                                else
                                {
                                    echo "NO RECORD FOUND";
                                }
                        ?>
                    </tbody>
                </table>
                <?php
                $sql2 = "SELECT * FROM category";
                $result2 = mysqli_query($conn , $sql2);
                if(mysqli_num_rows($result2) > 0)
                        {
                            $total_record = mysqli_num_rows($result2);
                            $total_pages = ceil($total_record / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if($page > 1){
                        echo '<li><a href="category.php?page='.($page-1).'">Pre</a></li>';  
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
                             echo '<li class="'.$select.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page< $total_pages ){
                            echo '<li><a href="category.php?page='.($page+1).'">Next</a></li>';  
                            }
                            echo " </ul>";

                        }   
                        ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
