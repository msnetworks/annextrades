<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Client E-Mail</li>
        </ol>
      </div>  

<div class="row">
    <div class="col-md-12 column">
        <div class="box">
            <h4 class="box-header round-top">Add New E-Mail</h4>  
                  
            <div class="box-container-toggle">
            
                <?php if(@$_GET['msg']=="Success"){?>
                    <div class="alert alert-success" role="alert">
                        Email Add Sucessfully.
                    </div>
                <?php }elseif(@$_GET['msg']=="Failed"){?>
                    <div class="alert alert-danger" role="alert">
                        Failed To Add Email.!!
                    </div>
                <?php }elseif(@$_GET['msg']=="EmailExist"){?>
                    <div class="alert alert-warning" role="alert">
                        Email Already Exist..!!
                    </div>
                <?php } ?> 
                <div class="box-content">
                    <center>
                        <form action="controller/add_clientemail.php" enctype="multipart/form-data" method="post">
                            <p>
                                <label>Email Address</label>
                                <input class="form-control" name="email" type="email" required>
                            </p>
                            <br />
                            <br>
                            <!-- <p>
                            <label>Message Description</label>
                            <textarea class="form-control" name="content" required></textarea>
                            </p><br /> -->
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
    <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Email List</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <!-- <center><a href="add_news_post.php" class="btn btn-default"><i class="fa fa-edit"></i> Add Email Address</a></center><br /> -->
                        <table class="table table-bordered table-striped table-hover" id="dt-basic">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>E-Mail Address</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $e = $connect->query("SELECT * FROM client_emails");
                                    while($c=mysqli_fetch_array($e)){
                                ?>
                                    <tr>
                                        <td><?php echo $c['id']; ?></td>
                                        <td><?php echo $c['email']; ?></td>
                                        <td><?php echo $c['date']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                            
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