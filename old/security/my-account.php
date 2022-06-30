<?php
require("core.php");
head();

$sec_username = $_SESSION['sec-username'];

$table = $prefix . 'settings';
$sql   = $mysqli->query("SELECT username, password FROM `$table` LIMIT 1");
$row   = mysqli_fetch_assoc($sql);
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-user"></i> My Account</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">My Account</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">
                    
                <div class="row">                  
                
				<div class="col-md-12">

<form class="form-horizontal" action="" method="post">
                    <div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">My Account</h3>
						</div>
				        <div class="card-body">
                               <div class="form-group">
											<label class="control-label">Username: </label>
											<div class="col-sm-12">
												<input type="text" name="username" class="form-control" value="<?php
echo $row['username'];
?>" required>
											</div>
										</div>
                                        <hr>
                                        <div class="form-group">
											<label class="control-label">New Password: </label>
											<div class="col-sm-12">
												<input type="text" name="password" class="form-control">
											</div>
										</div>
                                        <i>Fill this field only if you want to change the password.</i>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
if (isset($_POST['edit'])) {
    $table = $prefix . 'settings';
    @$username = addslashes($_POST['username']);
    @$password = $_POST['password'];
    
    $query                    = $mysqli->query("UPDATE `$table` SET username='$username' WHERE username='$sec_username'");
    $_SESSION['sec-username'] = $username;
    if ($password != null) {
        $password                 = hash('sha256', $_POST['password']);
        $query                    = $mysqli->query("UPDATE `$table` SET username='$username', password='$password' WHERE username='$sec_username'");
        $_SESSION['sec-username'] = $username;
    }
    echo '<meta http-equiv="refresh" content="0;url=my-account.php">';
}
?>
                </div>

				</div>
                    
				</div>
				</div>
				<!--===================================================-->
				<!--End page content-->

			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
</div>
<?php
footer();
?>