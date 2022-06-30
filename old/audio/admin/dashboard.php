<?php 
//session_start();
	//ob_start();

	include("includes/header.php");
	include("../db-connect/notfound.php");
?>
	<link rel="stylesheet" href="css/layout1.css" type="text/css" media="screen" />
<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin </p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
		<div style="float:left; text-align:left;">
	<div class="" style="width:700px;">
				<div class="grid_16">
					<div class="">
						<ul class="gallery feature_tiles clearfix isotope">
		
	<li style="position: absolute; left: 139px; top: 116px;" class="all isotope-item">
		
		<a href="companyprofile.php" class="features">
			<img src="a_data/create_write.png">
			<span class="name sort_1">Company</span>
			<span class="update sort_2">0</span>
			<div class="starred blue"></div>
		</a>	
		</li>
				
	
		
	<li style="position: absolute; left: 389px; top: 116px;" class="new isotope-item">
		
		<a href="success_story.php" class="features">
			<img src="a_data/create_write.png">
			<span class="name sort_1">Success Stories</span>
			<span class="update sort_2">0</span>
			<div class="starred"></div>
		</a>
			</li>
		
<li style="position: absolute; left: 14px; top: 15px;" class="cool isotope-item">
		<a href="change_pwd.php" class="features">
			<img src="a_data/record.png">
			<span class="name sort_1">Change Password</span>
			<span class="update sort_2">0</span>
			<div class="starred blue"></div>
			</a>	</li>		
		
	
			
			<li style="position: absolute; left: 139px; top: 15px;" class="cool isotope-item">
		<a href="general_settings.php" class="features">
			<img src="a_data/day_calendar.png">
			<span class="name sort_1">General Settings</span>
			<span class="update sort_2">0</span>
			<div class="starred green"></div>
					</a>	</li>
		
	<li style="position: absolute; left: 264px; top: 15px;" class="all isotope-item">
	
		<a href="membermanagement.php" class="features">
			<img src="a_data/table.png">
			<span class="name sort_1">Members</span>
			<span class="update sort_2">0</span>
		<div class="starred"></div>
		</a>
			</li>
		
	
		
	<li style="position: absolute; left: 14px; top: 116px;" class="all isotope-item">
		
		<a href="productpending.php" class="features">
			<img src="a_data/monitor.png">
			<span class="name sort_1">Product</span>
			<span class="update sort_2">0</span>
		<div class="starred"></div>
		</a>	</li>

	<li style="position: absolute; left: 514px; top: 15px;" class="new isotope-item">
		
		<a href="country.php" class="features">
			<img src="a_data/image_2.png">
			<span class="name sort_1">Country Management</span>
			<span class="update sort_2">0</span>
		<div class="starred green"></div>
		</a>
			</li>
		
	<li style="position: absolute; left: 389px; top: 15px;" class="all isotope-item">
		
			<a href="newsletter.php" class="features">
			<img src="a_data/go_back_from_screen.png">
			<span class="name sort_1">Newsletter</span>
			<span class="update sort_2">0</span>
			<div class="starred blue"></div>
		</a>			</li>
	
		
	
	
	<li style="position: absolute; left: 514px; top: 116px;" class="cool isotope-item">
		<a href="hotnews.php" class="features">
			<img src="a_data/image_2.png">
			<span class="name sort_1">Hot News</span>
			<span class="update sort_2">0</span>
		<div class="starred blue"></div>
		</a>	</li>
	
	<li style="position: absolute; left: 264px; top: 116px;" class="cool isotope-item">
		
		<a href="feedback.php" class="features">
			<img src="a_data/monitor.png">
			<span class="name sort_1">Feed Back</span>
			<span class="update sort_2">0</span>
		<div class="starred green"></div>
		</a>
		</li>
		
		
		<li style="position: absolute; left: 14px; top: 217px;" class="cool isotope-item">
		
		<a href="site_statistics.php" class="features">
			<img src="a_data/chart_8.png">
			<span class="name sort_1">Site Statistics</span>
			<span class="update sort_2">2</span>
		<div class="starred green"></div></a>
	</li>
	
	<li style="position: absolute; left: 140px; top: 217px;" class="cool isotope-item">
		
		<a href="help.php" class="features">
			<img src="a_data/day_calendar.png">
			<span class="name sort_1">Help</span>
			<span class="update sort_2">2</span>
		<div class="starred"></div></a>
	</li>
	
	<li style="position: absolute; left: 265px; top: 217px;" class="cool isotope-item">
		
		<a href="cms.php" class="features">
			<img src="a_data/go_back_from_screen.png">
			<span class="name sort_1">CMS</span>
			<span class="update sort_2">2</span>
		<div class="starred blue"></div></a>
	</li>
	
	
	<li style="position: absolute; left: 390px; top: 217px;" class="cool isotope-item">
		
		<a href="sitemap.php" class="features">
			<img src="a_data/monitor.png">
			<span class="name sort_1">Site Map</span>
			<span class="update sort_2">2</span>
		<div class="starred green"></div></a>
	</li>
	
	<li style="position: absolute; left: 515px; top: 217px;" class="cool isotope-item">
		
		<a href="contact.php" class="features">
			<img src="a_data/record.png">
			<span class="name sort_1">Contact Us</span>
			<span class="update sort_2">2</span>
		<div class="starred"></div></a>
	</li>
	
	
	<li style="position: absolute; left: 14px; top: 317px;" class="cool isotope-item">
		
		<a href="orders.php" class="features">
			<img src="a_data/record.png">
			<span class="name sort_1">Package Orders</span>
			<span class="update sort_2">2</span>
		<div class="starred"></div></a>
	</li>
	
    <li style="position: absolute; left: 140px; top: 317px;" class="cool isotope-item">
		
		<a href="transaction.php" class="features">
			<img src="a_data/record.png">
			<span class="name sort_1">Transaction Details</span>
			<span class="update sort_2">2</span>
		<div class="starred"></div></a>
	</li>
	
		<li style="position: absolute; left: 265px; top: 317px;" class="cool isotope-item">
		
		<a href="cancel_orders.php" class="features">
			<img src="a_data/monitor.png">
			<span class="name sort_1">Cancel Orders</span>
			<span class="update sort_2">2</span>
		<div class="starred"></div></a>
	</li>
    
	<!--<li style="position: absolute; left: 139px; top: 217px;" class="all isotope-item">
		<a href="feature.php" class="features">
			<img src="a_data/go_back_from_screen.png">
			<span class="name sort_1">Features</span>
			<span class="update sort_2">0</span>
			<div class="starred"></div>
		</a>
	</li>-->
	
	<!--<li style="position: absolute; left: 264px; top: 217px;" class="all isotope-item">
		<a href="counter.php" class="features">
			<img src="a_data/record.png">
			<span class="name sort_1">Counter Management</span>
			<span class="update sort_2">0</span>
		<div class="starred blue"></div>
		</a>
	</li>-->
		
</ul>					</div>
				</div>
		  </div>
		</div>
		
		


</body>

</html>