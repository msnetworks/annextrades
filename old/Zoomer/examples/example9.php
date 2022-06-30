<!DOCTYPE html>
<html>
<head>
<title>9</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap, not needed! -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

</head>
<body>
<?php
include ('navi.php');
?>

<div class="container">
	<h1 class="page-header">AJAX-ZOOM - embed with custom loader - jquery.axZm.loader.js</h1>
	<div class="row">
		<div class="col-md-6">
			<p>With this custom JS loader file neither jQuery core nor AJAX-ZOOM JS and CSS files are needed to be loaded 
				before triggering AJAX-ZOOM. jquery.axZm.loader.js loads everything in case it is needed on-the-fly. 
				It might be useful if you cannot edit or do not have access the header in your CMS. 
			</p>
			<p>Please note that if you need to place more than one instance of AJAX-ZOOM on the same page, then you will need to use 
				iframes which is also an alternative for quick integration, see <a href="example13.php">example13.php</a>
			</p>
			<!--googleoff: index-->
			<p style="color: #aaa">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 
			</p>
			<p style="color: #aaa">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
			</p>
			<!--googleon: index-->
		</div>
		<div class="col-md-6">
			<!-- embed-responsive and embed-responsive-item are bootstrap css classes 
				but you do not need to use bootstrap and could easily reproduce this proportional container without css libraries
			-->
			<div class="embed-responsive" style="padding-bottom: 80%;">
				<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
					Loading, please wait...
				</div>
			</div>

			<script type="text/javascript">
				var ajaxZoom = {};
				ajaxZoom.path = "../axZm/"; // Path to the axZm folder

				 // Parameter passed to AJAX-ZOOM which defines what to load into the gallery
				 // Description of possible predefined parameters is best viewed in example27.php
				ajaxZoom.parameter = "zoomDir=furniture";

				// "example" parameter defines a set of configuration parameters 
				// which can be found in /axZm/zoomConfigCustom.inc.php
				// you can extend it, change or define your own configuration set
				ajaxZoom.parameter += "&example=11";
				ajaxZoom.divID = "axZmPlayerContainer"; // The id of the Div where ajax-zoom has to be inserted
				ajaxZoom.responsive = true; // Embed responsive
				// other parameters inside /axZm/jquery.axZm.loader.js
			</script>
			<script type="text/javascript" src="../axZm/jquery.axZm.loader.js"></script>

		</div>
		<div class="col-md-12">
			<h3 style="margin-top: 40px;">Embed AJAX-ZOOM with custom loader</h3>

			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
	<!-- embed-responsive and embed-responsive-item are bootstrap css classes 
		but you do not need to use bootstrap and could easily reproduce this proportional container without css libraries
	-->
	<div class="embed-responsive" style="padding-bottom: 80%;">
		<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
			Loading, please wait...
		</div>
	</div>
	<script type="text/javascript">
		var ajaxZoom = {};
		ajaxZoom.path = "../axZm/"; // Path to the axZm folder

		// Parameter passed to AJAX-ZOOM which defines what to load into the gallery
		// Description of possible predefined parameters is best viewed in example27.php
		ajaxZoom.parameter = "zoomDir=furniture";

		// "example" parameter defines a set of configuration parameters 
		// which can be found in /axZm/zoomConfigCustom.inc.php
		// you can extend it, change or define your own configuration set
		ajaxZoom.parameter += "&example=11";
		ajaxZoom.divID = "axZmPlayerContainer"; // The id of the Div where ajax-zoom has to be inserted
		ajaxZoom.responsive = true; // Embed responsive
		// other parameters inside /axZm/jquery.axZm.loader.js
	</script>
	<script type="text/javascript" src="../axZm/jquery.axZm.loader.js"></script>
	');
	echo "</code></pre>";
			?>

			<?php
			define('COMMENTS_BOOTSTRAP', true);
			include ('footer.php');
			?>

		</div>
	</div>
</div>

</body>
</html>