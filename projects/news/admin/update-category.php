<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                include "config.php";
                $id = $_GET['id'];
                $sql = "SELECT * fROM category WHERE category_id = $id";
                $result = mysqli_query($conn, $sql) or die('error');
                if(mysqli_num_rows($result) > 0)
                {
              $row = mysqli_fetch_assoc($result)
                    
              ?>
                  <form action="update-cat-to-db.php" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                        }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
