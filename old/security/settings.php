<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'settings';
    
    $email = $_POST['email'];
    
    if (isset($_POST['realtime_protection'])) {
        $realtime_protection = 1;
    } else {
        $realtime_protection = 0;
    }
    
    if (isset($_POST['mail_notifications'])) {
        $mail_notifications = 1;
    } else {
        $mail_notifications = 0;
    }
	
	if (isset($_POST['ip_detection'])) {
        $ip_detection = 2;
    } else {
        $ip_detection = 1;
    }
    
    $query = $mysqli->query("UPDATE `$table` SET email='$email', realtime_protection='$realtime_protection', mail_notifications='$mail_notifications', ip_detection='$ip_detection' WHERE id=1");

	echo '<meta http-equiv="refresh" content="0; url=settings.php" />';
	
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-cogs"></i> Settings</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Settings</li>
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
<form class="form-horizontal" method="post">
				    <div class="col-md-12 card card-dark">
						<div class="card-header">
							<h3 class="card-title"><i class="fas fa-cog"></i> Settings</h3>
						</div>
						<div class="card-body mx-auto">
<?php
$table = $prefix . 'settings';
$query = $mysqli->query("SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
?>
											<div class="form-group row">
												<label class="control-label" for="inputDefault">E-Mail Address:</label>
												
												    <div class="input-group col-sm-10">
                								      <div class="input-group-prepend">
                								        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                								      </div>
               								        <input type="email" class="form-control" name="email" value="<?php
echo $row['email'];
?>" required>
                								    </div>
                                                    <p><br />The E-Mail Address will be used for receiving&nbsp;<b>Mail Notifications</b>&nbsp;and for the &nbsp;<b>Contact Button (Warning Pages)</b>.</p>
											</div><hr>
                                            <div class="form-group">
												<label class="control-label">Real-Time Protection</label><br />
														      <input type="checkbox" name="realtime_protection" class="psec-switch" <?php
if ($row['realtime_protection'] == 1) {
    echo 'checked';
}
?> />
												     <br /> With this option you can <strong>Enable</strong> or <strong>Disable</strong> the whole script.<br />
                                            </div><hr><br />
                                            <div class="form-group">
												<label class="control-label">Mail Notifications</label><br />
														      <input type="checkbox" name="mail_notifications" class="psec-switch" <?php
if ($row['mail_notifications'] == 1) {
    echo 'checked';
}
?> />
												        </br> If this is <strong>Enabled</strong> you will receive notifications on your E-Mail Address<br />
											</div><hr><br />
											<div class="form-group">
												<label class="control-label">IP Detection</label><br />
                                                        
														      <input type="checkbox" name="ip_detection" class="psec-switch" <?php
if ($row['ip_detection'] == 2) {
    echo 'checked';
}
?> />
														<br />(<b>Basic</b> / <b>Advanced</b>)<br /><br />
														
														Basic IP Detection is used by default. Faster performance but low accuracy.<br />
														If this is <strong>Enabled</strong> will be used Advanced IP Detection. High detection accuracy but slower performance<br />
											</div>
						</div>
                        <div class="card-footer text-left">
							<button class="btn btn-flat btn-primary" name="save" type="submit">Save</button>
				            <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                     </div>
					 </div>
</form>
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
<script>
var elems = Array.prototype.slice.call(document.querySelectorAll('.psec-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
<?php
footer();
?>