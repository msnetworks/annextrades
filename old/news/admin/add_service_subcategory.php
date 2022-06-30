<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Service Sub-Category</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add Service Sub-Category</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                    <center>
                        <form action="" method="post">
                            <label>Category</label>
                            <select name="category_id" class="form-control" id="service" require>
                                <option value="">Select Category</option>
                                <?php
                                $result = mysqli_query($connect,"SELECT * FROM service_category");
                                while($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?php echo $row["id"];?>"><?php echo $row["category"];?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <p>
                                <label>Sub-Category</label>
                                <input class="form-control" name="subcategory" value="" type="text" required>
                            </p>
                            <div class="form-actions">
                                <input type="submit" name="add" class="btn btn-primary" value="Add" />
                                <input type="reset" class="btn" value="Reset" />
                            </div>
                        </form>

<?php
if (isset($_POST['add'])) {
    $category_id = $_POST['category_id'];
    $subcategory = $_POST['subcategory'];
    
    $add = "INSERT INTO service_subcategory (category_id,subcategory) VALUES ('$category_id','$subcategory')";
    $sql = mysqli_query($connect, $add);
    echo '<meta http-equiv="refresh" content="0; url=add_service_subcategory.php?Success">';
}
?></center>                               
                  </div>
              </div>
            </div>
        </div>
      </div>

 
    </div>
  </div>

<?php
include "footer.php";
?>