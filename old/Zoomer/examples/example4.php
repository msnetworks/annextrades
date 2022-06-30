<!DOCTYPE html>
<html>
	<head>
		<title>4</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is needed for this example -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">

		<!-- This is not needed -->
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- jQuery core, needed if not already present. -->
		<script src="../axZm/plugins/jquery-2.2.4.min.js"></script>
		
		<!-- bootstrap.js, needed if not already present. -->
		<script src="example_files/bootstrap/js/bootstrap.min.js"></script>

		<!-- AJAX-ZOOM core, needed! -->
		<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- js for this example (example4.php) -->
		<script type="text/javascript" src="../axZm/extensions/axZmExamples/jquery.axZm.azExample4.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css" id="exampleCss">
			#axZmNavbarNav {
				border-radius: 0;
				border-top-width: 0
			}

			#axZmPlayerContainerParent {
				border: #e7e7e7 1px solid;
				/* padding bottom sets the proportions of the player */
				padding-bottom: 50%;
			}

			#axZmNavbarNav .navbar-nav>.active>a,
			#axZmNavbarNav .navbar-nav>.active>a:focus,
			#axZmNavbarNav .navbar-nav>.active>a:hover {
				color: #FFF;
				background-color: #2379b5;
			}

			#axZmNavbarNav .navbar-nav a {
				padding: 15px 7px 15px 7px;
			}

			#axZmNavbarNav .navbar-brand {
				padding: 15px 20px 15px 7px;
			}

			#axZmNavbarNav .navbar-nav a {
				font-family: "Helvetica Narrow","Arial Narrow",Tahoma,Arial,Helvetica,sans-serif;
			}

			@media screen and (orientation:portrait) and (max-width: 768px) {
				#axZmPlayerContainerParent {
					padding-bottom: 100%;
				}
			}
		</style>
	</head>
	<body>
		<?php
		// This include is just for the demo, you can remove it
		if (file_exists(dirname(__FILE__).'/navi.php')) {
			include dirname(__FILE__).'/navi.php';
		}
		?>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">AJAX-ZOOM - embedded implementation</h1>

					<p>Ver. 5.0.6+ This example has been rewritten. It now uses bootstrap navbar to display folders with images. 
						Click on the folders will load new images into the gallery with high resolution images. 
						All JavaScript is wrapped into one function - jQuery.azExample4(options);
						Feel free to adapt it.
					</p>

					<p style="margin-bottom: 30px">The main API functions utilized in this example are 
						<a href="https://www.ajax-zoom.com/index.php?cid=docs#api_load">$.fn.axZm.load</a> and 
						<a href="https://www.ajax-zoom.com/index.php?cid=docs#api_loadAjaxSet">$.fn.axZm.loadAjaxSet</a>; 
					</p>

					<!-- Container where AJAX-ZOOM will be loaded into -->
					<div class="embed-responsive" id="axZmPlayerContainerParent">
						<div id="axZmPlayerContainer" class="embed-responsive-item">
							Loading, please wait...
						</div>
					</div>

					<!-- Folder navigation with bootstrap 3.3-->
					<nav class="navbar navbar-default" id="axZmNavbarNav">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-target="#axZmNavbarDiv" data-toggle="collapse" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand">Folders</a>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="axZmNavbarDiv">
								<!-- id - "axZmNavbarContainer" is passed to the plugin -->
								<ul class="nav navbar-nav" id="axZmNavbarContainer">
									<li><a>Loading, please wait...</a></li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>

					<!-- Fire AJAX-ZOOM -->
					<script type="text/javascript" id="exampleJs">
						jQuery.azExample4({
							axZmPath: "../axZm/", // Path to /axZm directory, e.g. /test/axZm/
							zoomDir: "/pic/zoom", // Path to subfolders with images
							divID: "axZmPlayerContainer", // ID of the main container
							menuDivID: "axZmNavbarContainer", // ID of the menu container
							firstFolder: 1, // index or name of the folder to be loaded at first
							firstImage: 1, // index or name of the image to load from firstFolder
							example: 8, // configuration set value which is passed to ajax-zoom
							axZmCallBacks: {}, // AJAX-ZOOM has several callbacks, https://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
							responsive: true, // Open responsive
							fullScreenApi: false // try to open AJAX-ZOOM at browsers fullscreen mode
						});
					</script>

					<h3>JavaScript & CSS files in Head</h3>
					<div style="clear:both; margin: 5px 0px 5px 0px; width: 100%; overflow-x: hidden;">
						<?php
						echo '<pre><code class="language-markup">';
						echo htmlspecialchars ('
<!-- Bootstrap is needed for this example -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">

<!-- jQuery core, needed if not already present. -->
<script src="../axZm/plugins/jquery-2.2.4.js"></script>

<!-- bootstrap.js, needed if not already present. -->
<script src="example_files/bootstrap/js/bootstrap.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- js for this example (example4.php) -->
<script type="text/javascript" src="../axZm/extensions/axZmExamples/jquery.axZm.azExample4.js"></script>
						');
						echo '</code></pre>';
						?>
					</div>

					<h3>Additional CSS for styling</h3>
					<div style="margin: 5px 0px 5px 0px;">
						<pre><code class="language-css" id="exampleCssPrism"></code></pre>
						<script>$('#exampleCssPrism').html($('#exampleCss').html());</script>
					</div>

					<h3 style="margin-bottom: 0">HTML markup in body</h3>
					<div style="clear:both; margin: 5px 0px 5px 0px; width: 100%; overflow-x: hidden;">
						<?php
						echo '<pre><code class="language-markup">';
						echo htmlspecialchars ('
<!-- Container where AJAX-ZOOM will be loaded into -->
<div class="embed-responsive" id="axZmPlayerContainerParent">
	<div id="axZmPlayerContainer" class="embed-responsive-item">
		Loading, please wait...
	</div>
</div>

<nav class="navbar navbar-default" id="axZmNavbarNav">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#axZmNavbarDiv" data-toggle="collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand">Folders</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="axZmNavbarDiv">
			<!-- id - "axZmNavbarContainer" is passed to the plugin -->
			<ul class="nav navbar-nav" id="axZmNavbarContainer">
				<li><a>Loading, please wait...</a></li>
				<!--
				<li class="active"><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				-->
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
						');
						echo '</code></pre>';
						?>

					</div>

					<h3 style="margin-bottom: 0">Javascript</h3>
					<div style="clear:both; margin: 5px 0px 5px 0px; width: 100%; overflow-x: hidden;">
						<pre><code class="language-js" id="exampleJsPrism"></code></pre>
						<script>$('#exampleJsPrism').html($('#exampleJs').html());</script>
					</div>
					<?php
					if (file_exists(dirname(__FILE__).'/footer.php')) {
						// This is only for the demo, you can remove it
						define('COMMENTS_BOOTSTRAP', true);
						include dirname(__FILE__).'/footer.php';
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>