<!DOCTYPE html>
<html>
	<head>
		<title>22_new</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!--  Include jQuery core into head section if not already present-->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  AJAX-ZOOM javascript -->
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
		<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css" media="screen"> 
			body {background-color: #CCC;}
			#axZmPlayerContainer{width: 60%;}
			#someOtherContainer{width: 40%;}
			@media only screen and (max-width: 1280px) {
				#axZmPlayerContainer{width: 100%; }
				#someOtherContainer{width: 100%; height: auto !important;}
			}
		</style>

	</head>
	<body>

		<div style="max-width: 1600px; margin: 0 auto;">

			<?php
			// This include is just for the demo, you should remove it
			include ('navi.php');
			?>

			<div style="height: 110px; background-color: #B9CC52; position: relative;">
				<h2 style="margin: 0; padding: 25px 10px 0 10px;">
					Responsive 2D zoom player with gallery and only CSS for layout
				</h2>
			</div>

			<div style="height: calc(100vh - 110px - 58px - 10px); position: relative;">

				<div id="someOtherContainer" style="height: 100%; float: left; background-color: #f8f8f8; position: relative; overflow-y: auto; overflow-x: hidden;">
					<div style="padding: 10px">
						<p style="margin-top: 10;">In the HTML markup below we simplified by setting the height to a fixed pixel value.
							In your CSS layout, if you want to the height to be responsive, please make sure that the parent container is responsive too / has calculated height. 
							Then you could set the height of "axZmPlayerContainer" to 100%; Otherwise you will not see anything! 
							Indeed in this example we have set the CSS height of one of the nested parent containers to calc(100vh - 110px - 58px - 10px) which is 
							100% body height minus some other values...
						</p>
						<h3>Javascript and CSS files in head</h3>
						<?php
						echo '<pre><code class="language-markup">';
						echo htmlspecialchars ('
							<!--  Include jQuery core into head section if not already present -->
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

							<!--  AJAX-ZOOM javascript -->
							<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
						<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />');
						echo '</code></pre>';
						?>
						<h3>HTML Markup</h3>
						<?php
						echo '<pre><code class="language-markup">';
						echo htmlspecialchars ('
							<!-- Container where AJAX-ZOOM will be loaded into -->
						<div id="axZmPlayerContainer" style="width: 100%; height: 500px; background-color: #FFF; position: relative;"></div>');
						echo '</code></pre>';
						?>

						<h3>Javacript</h3>
						<?php
						echo '<pre><code class="language-js">';
						echo htmlspecialchars ('
							// Define some var to hold AJAX-ZOOM related values
							window.ajaxZoom = {};

							// Path to /axZm/ folder, adjust the path in your implementaion
							ajaxZoom.path = "../axZm/";

							// Define the ID of the responsive container
							ajaxZoom.targetID = "axZmPlayerContainer";

							// Images to load
							ajaxZoom.zoomData = [
								"/pic/zoom/boutique/boutique_001.jpg",
								"/pic/zoom/boutique/boutique_002.jpg",
								"/pic/zoom/boutique/boutique_003.jpg",
								"/pic/zoom/boutique/boutique_004.jpg",
								"/pic/zoom/boutique/boutique_005.jpg",
								"/pic/zoom/boutique/boutique_006.jpg",
								"/pic/zoom/boutique/boutique_007.jpg",
								"/pic/zoom/boutique/boutique_008.jpg",
								"/pic/zoom/fashion/fashion_001.jpg",
								"/pic/zoom/fashion/fashion_002.jpg",
								"/pic/zoom/fashion/fashion_003.jpg",
								"/pic/zoom/fashion/fashion_004.jpg",
								"/pic/zoom/fashion/fashion_005.jpg"
							];

							// "example" in query string which is passed to AJAX-ZOOM defines an options set
							// which differs from default values. You can find the options set of this example 
							// in /axZm/zoomConfigCustom.inc.php after 
							// elseif ($_GET[\'example\'] == 23)
							ajaxZoom.queryString = "example=23";

							// Pass images as CSV separated with \'|\', you could also use zoomDir to load entire directory with images instead of zoomData
							// For more information about parameters which can be passed see example27.php
							ajaxZoom.queryString += "&zoomData="+ajaxZoom.zoomData.join("|");

							// AJAX-ZOOM possible callbacks
							ajaxZoom.ajaxZoomCallbacks = {

							};

							// Enable overlay before AJAX-ZOOM loads
							window.fullScreenStartSplash = {"enable": true, "className": false, "opacity": 0.75};

							// Use jQuery.fn.axZm.openFullScreen() API to trigger AJAX-ZOOM responsive
						jQuery.fn.axZm.openResponsive(ajaxZoom.path, ajaxZoom.queryString, ajaxZoom.ajaxZoomCallbacks, ajaxZoom.targetID, true, false, false);');
						echo '</code></pre>';
						?>
					</div>
				</div>

				<!-- Container where AJAX-ZOOM will be loaded into -->
				<div id="axZmPlayerContainer" style="height: 100%; float: left; background-color: #FFF; position: relative;"></div>

			</div>

			<div style="height: 10px; background-color: #CCC;">

			</div>

		</div>

		<script type="text/javascript">
			// Define some var to hold AJAX-ZOOM related values
			window.ajaxZoom = {};

			// Path to /axZm/ folder, adjust the path in your implementaion
			ajaxZoom.path = '../axZm/';

			// Define the ID of the responsive container
			ajaxZoom.targetID = 'axZmPlayerContainer';

			// Images to load
			ajaxZoom.zoomData = [
				'/pic/zoom/boutique/boutique_001.jpg',
				'/pic/zoom/boutique/boutique_002.jpg',
				'/pic/zoom/boutique/boutique_003.jpg',
				'/pic/zoom/boutique/boutique_004.jpg',
				'/pic/zoom/boutique/boutique_005.jpg',
				'/pic/zoom/boutique/boutique_006.jpg',
				'/pic/zoom/boutique/boutique_007.jpg',
				'/pic/zoom/boutique/boutique_008.jpg',
				'/pic/zoom/fashion/fashion_001.jpg',
				'/pic/zoom/fashion/fashion_002.jpg',
				'/pic/zoom/fashion/fashion_003.jpg',
				'/pic/zoom/fashion/fashion_004.jpg',
				'/pic/zoom/fashion/fashion_005.jpg'
			];

			// "example" in query string which is passed to AJAX-ZOOM defines an options set
			// which differs from default values. You can find the options set of this example 
			// in /axZm/zoomConfigCustom.inc.php after 
			// elseif ($_GET['example'] == 23)
			ajaxZoom.queryString = 'example=23';

			// Pass images as CSV separated with '|', you could also use zoomDir to load entire directory with images instead of zoomData
			// For more information about parameters which can be passed see example27.php
			ajaxZoom.queryString += '&zoomData='+ajaxZoom.zoomData.join('|');

			// AJAX-ZOOM possible callbacks
			ajaxZoom.ajaxZoomCallbacks = {

			};

			// Enable overlay before AJAX-ZOOM loads
			window.fullScreenStartSplash = {'enable': true, 'className': false, 'opacity': 0.75};

			// Use jQuery.fn.axZm.openFullScreen() API to trigger AJAX-ZOOM responsive
			jQuery.fn.axZm.openResponsive(ajaxZoom.path, ajaxZoom.queryString, ajaxZoom.ajaxZoomCallbacks, ajaxZoom.targetID, true, false, false);

		</script>
	</body>
</html>