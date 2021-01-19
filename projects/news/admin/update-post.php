<?php include "header.php";
 
if($_SESSION["role"] == 0 )
{

    $getid = $_GET['id'];
    $sql1 = "SELECT author FROM post WHERE post.post_id = {$getid} ";
    $result1 = mysqli_query($conn , $sql1) or die(mysqli_error($conn));

    $row1 = mysqli_fetch_assoc($result1);
     if($row1['author'] != $_SESSION['user_id'])
     {
        header("location: {$hostname}/admin/users.php");
     }      

}

?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php
    include "config.php";
    $getid = $_GET['id'];
    $sql = "SELECT post.title, post.description, post.post_id, category.category_name,post.category, post.post_img, user.username FROM post JOIN category ON post.category = category.category_id JOIN user ON post.author = user.user_id WHERE post.post_id = {$getid} ";
    $result = mysqli_query($conn , $sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($result) > 0)
    {
       $row = mysqli_fetch_assoc($result)       

    ?>
        <!-- Form for show edit-->
        <form action="update_post_to_db.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $row['description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <?php
                            $sql2 ="SELECT * FROM category";
                            $result2 = mysqli_query($conn , $sql2);

                            if(mysqli_num_rows($result2) > 0)
                            {
                                
                                while($row2 = mysqli_fetch_assoc($result2))
                                {
                                    if($row2['category_id'] == $row['category'])
                                    {
                                        $selected = "selected";
                                    }
                                    else {
                                        $selected = "";
                                    }

                                   echo "<option $selected value='{$row2['category_id']}'>{$row2['category_name']}</option>";
                                }
                            }
                          ?>
                </select>
                <input type="hidden" name="old_category" value="<?php echo $row['category'] ?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img'] ?>" height="150px" alt="">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img'] ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php
        
    }
    else
    {
        echo "no result found";
    }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
