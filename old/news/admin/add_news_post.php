<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add News Post</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add News Post</h4>         
              <div class="box-container-toggle">
                <div class="box-content">
                  <center>
                  <form action="controller/add_news_post.php" method="post" enctype="multipart/form-data">
                    <p>
                      <label>Title</label>
                      <input class="form-control" name="title" value="" type="text" required>
                    </p><br />
                    <p>
                      <label>Image</label>
                      <input class="form-control" name="image" type="file" required>
                    </p><br />
                    <p>
                      <label>Active</label><br />
                      <select name="active" class="form-control" required>
                          <option value="Yes" selected>Yes</option>
                          <option value="No">No</option>
                      </select>
                    </p><br />
                    <p>
                      <label>Category</label><br />
                      <select name="category_id" class="form-control" required>
                        <?php
                          $crun = mysqli_query($connect, "SELECT * FROM `categories`");
                          while ($rw = mysqli_fetch_assoc($crun)) {
                              echo '<option value="' . $rw['id'] . '">' . $rw['category'] . '</option>';
                          }
                        ?>
                      </select>
                    </p>
                    <br> 
                    <p>
                      <label>Image</label>
                      <input class="form-control" name="image" type="file" required>
                    </p>
                    <br>
                    <p>
                      <label>Source URL</label>
                      <input class="form-control" name="source_url" value="<?php echo $row['source_url']; ?>" type="text" required>
                    </p><br />
                    <p>
                      <label>Sort Summary</label>
                      <input class="form-control" name="sort_summary" max-length="255" value="<?php echo $row['sort_summary']; ?>" type="text" required>
                    </p><br />
                    <p>
                      <label>Content</label>
                      <textarea class="form-control" name="content" required></textarea>
                    </p><br />
                    <div class="form-actions">
                      <input type="submit" name="add" class="btn btn-primary" value="Add" />
                      <input type="reset" class="btn" value="Reset" />
                    </div>
                  </form>


                    </center>                               
                  </div>
              </div>
            </div>
        </div>
      </div>

 
    </div>
  </div>
  
<script>
    CKEDITOR.replace( 'content' );
</script>
<?php
include "footer.php";
?>