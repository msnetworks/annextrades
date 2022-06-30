<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add E-Mail</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">New E-Mail Compose</h4>         
              <div class="box-container-toggle">
                <div class="box-content">
                  <center>
                  <form action="controller/add_email.php" enctype="multipart/form-data" method="post">
                    <!-- <p>
                      <label>Subject</label>
                      <input class="form-control" name="title" value="" type="text" required>
                    </p><br />
                    <p>
                      <label>Image</label>
                      <input class="form-control" name="image" type="file" required>
                    </p><br /> -->
                    <!-- <p>
                      <label>Active</label><br />
                      <select name="active" class="form-control" required>
                          <option value="Yes" selected>Yes</option>
                          <option value="No">No</option>
                      </select>
                    </p><br /> -->
                    <p>
                      <label>Mail Number</label><br />
                      <select name="category_id" class="form-control" required>
                        <option value="">Select Mail Number Type</option>
                        <option value="1st">1st (Welcome and Congratulations email ( including startup kit +video to update product))</option>
                        <option value="2nd">2nd (Confirmation for the products upload on the portal, if not refer them to the video again)</option>
                        <option value="3rd">3rd (Product Approved information on portal)</option>
                        <option value="4th">4th (News article regarding)</option>
                        <option value="5th">5th (Reminder for Payment)</option>
                        <option value="6th">6th (Final Reminder for Payment)</option>
                        <option value="7th">7th (Last reminder before termination of services)</option>
                      </select>
                    </p>
                    <br>
                    <p>
                      <label>Email Subject</label>
                      <input class="form-control" name="sort_summary" type="text" required>
                    </p>
                    <br />
                    <br>
                    <p>
                      <label>Message Description</label>
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