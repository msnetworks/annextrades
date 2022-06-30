<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `feature_post` WHERE id='$id'");
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Feature Posts</li>
        </ol>
      </div>
	  
	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Feature Posts</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <center><a href="add_post.php" class="btn btn-default"><i class="fa fa-edit"></i> Add Post</a></center><br />
                    <?php
                    $sql    = "SELECT * FROM feature_post ORDER by id DESC";
                    $result = mysqli_query($connect, $sql);
                    $count  = mysqli_num_rows($result);
                    if ($count <= 0) {
                        echo 'There are no posts.';
                    } else {
                        echo '
            <table class="table table-bordered table-striped table-hover" id="dt-basic">
                <thead>
				<tr>
				    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Date</th>
					<th>Active</th>
					<th>Category</th>
					<th>Actions</th>
                </tr>
				</thead>
                    ';
                        while ($row = mysqli_fetch_assoc($result)) {
                            $category_id = $row['category_id'];
                            $runq2       = mysqli_query($connect, "SELECT * FROM `categories` WHERE id='$category_id'");
                            $cat         = mysqli_fetch_assoc($runq2);
                            echo '
                                    <tr>
                                        <td>' . $row['id'] . '</td>
                                        <td><center><img src="../asset/img/feature/'.$row['image'].'" width="45px" height="45px" /></center></td>
                                        <td>' . $row['title'] . '</td>
                                        <td>' . $row['date'] . '</td>';
                            if ($row['active'] == "Yes") {
                                echo '<td>Yes</td>';
                            } else {
                                echo '<td>No</td>';
                            }
                            echo '
                    <td>' . $cat['category'] . '</td>
					<td>
					    <a href="?edit-id=' . $row['id'] . '" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
						<a href="?delete-id=' . $row['id'] . '" title="Delete" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</a>
					</td>
                </tr>
';
    }
    echo '
            </table>
';
}
?></center>
                  </div>
              </div>
            </div>
        </div>
      </div>
 
    <?php
    if (isset($_GET['edit-id'])) {
        $id  = (int) $_GET["edit-id"];
        $sql = mysqli_query($connect, "SELECT * FROM `feature_post` WHERE id = '$id'");
        $row = mysqli_fetch_assoc($sql);
        if (empty($id)) {
            echo '<meta http-equiv="refresh" content="0; url=posts.php">';
        }
        if (mysqli_num_rows($sql) == 0) {
            echo '<meta http-equiv="refresh" content="0; url=posts.php">';
        }
    ?>
    <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Edit Post</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                        <center><form action="controller/edit_feature_post.php" enctype="multipart/form-data" method="post">
								<p>
									<label>Title</label>
									<input name="id" type="text" value="<?php echo $_GET['edit-id']; ?>" hidden /><br>
									<input class="form-control" name="title" type="text" value="<?php echo $row['title']; ?>" required>
								</p><br />
								<p>
									<label>Image</label><br />
									<img src="../asset/img/feature/<?php echo $row['image']; ?>" width="50px" height="50px" /><br />
                                    <input class="form-control" name="image" type="file" value="<?php echo $row['image']; ?>" >
                                    <input  name="image1" type="text" value="<?php echo $row['image']; ?>" hidden />
								</p><br />
								<p>
									<label>Active
                                    </label><br />
									<select name="active" class="form-control" required>
									    <option value="Yes" <?php if ($row['active'] == "Yes") { echo 'selected'; } else { echo ''; }?>>Yes</option>
									    <option value="No" <?php
                                            if ($row['active'] == "No") {
                                                echo 'selected';
                                            } else {
                                                echo '';
                                            }
                                        ?>>No</option>
                                    </select>
								</p><br />
								<p>
									<label>Category</label><br />
									<select name="category_id" class="form-control" required>
									<?php
                                    $crun = mysqli_query($connect, "SELECT * FROM `categories` WHERE id='$category_id' LIMIT 1");
                                    while ($cat = mysqli_fetch_assoc($crun)) {
                                        echo '
                                            <option value="' . $cat['id'] . '" selected>' . $cat['category'] . '</option>
									';
                                        }
                                    ?>
									<?php
                                        $crun = mysqli_query($connect, "SELECT * FROM `categories`");
                                        while ($rw = mysqli_fetch_assoc($crun)) {
                                            echo '
                                    <option value="' . $rw['id'] . '">' . $rw['category'] . '</option>
									';
                                        }
                                    ?>
                                    </select>
								</p><br />
                                <p>
                                    <label>Sort Summary</label>
                                    <input class="form-control" name="sort_summary" value="<?php echo $row['sort_summary']; ?>" type="text" required>
                                </p><br />
								<p>
									<label>Content</label>
									<textarea name="content" rows="6" required><?php
                                        echo html_entity_decode($row['content']);
                                    ?></textarea>
                            	</p>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-primary" name="submit" value="Save" /><br />
                            </div>
                    </form>


                    </center>
                  </div>
              </div>
            </div>
        </div>
     </div>
<?php
}
?>
    </div>
  </div>

<script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			}
		}
	} );
} );
</script>
<script>
    CKEDITOR.replace( 'content' );
</script>
<?php
include "footer.php";
?>