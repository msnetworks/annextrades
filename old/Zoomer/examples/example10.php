<!DOCTYPE html>
<html>
<head>
<title>10</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- JSON -->
<script type="text/javascript" src="../axZm/plugins/JSON/jquery.json-2.3.min.js"></script>

<!--  AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css">
	.form-control {
		display: inline-block;
	}

	.cropImage {display: inline-block; margin: 0 10px 10px 0px; border: #aaa 1px solid; cursor: pointer;}

	.optionsTable {width: 100%; border-spacing: 0; border: 1px solid #AAAAAA; font-family: Tahoma, Geneva, sans-serif; font-size: 10pt;}
	.optionsTable th {background-color: #D4D4D4; padding-top: 10px; padding-bottom: 10px; font-size:12pt; font-family: "Comic Sans MS", cursive, sans-serif;}
	.optionsTable td,th{padding-left: 5px; padding-right: 5px;}
	.optionsTable th{white-space: nowrap;}
	.optionsTable td,th {vertical-align: top; line-height: 1.2em; text-align: left; border-bottom: 1px solid #AAAAAA; padding-top: 3px; padding-bottom: 8px;}
	.optionsTable .subOpt td {border-bottom-width: 0; font-size: 12pt;}
	.optionsTable tr.important {font-weight: bolder;}
	.optionsTable td:nth-child(1) {border-right: #AAA 1px dotted;}
	.optionsTable td:nth-child(2) {border-right: #AAA 1px dotted;}
	.optionsTable ul,ol {padding-left: 14px; margin: 0 0 0 20px;}
	.optionsTable ul {list-style-type: square;}
	.optionsTable li {margin-bottom: 5px; padding-left: 14px; line-height: 0.85em;}
	.optionsTable tr:nth-child(odd) { background-color: #FDFDFD;}
	.optionsTable tr:nth-child(even) { background-color: #FFFFFF;}
	.optionsTable tr:last-child>td { border-bottom: none;}	
	.optionsTable.sub th {padding-top: 3px; padding-bottom: 3px; font-size: 11pt;}
	.optionsTable.sub td {line-height: 1em; padding-bottom: 2px; padding-top: 2px;}
	.optionsTable pre {padding: 0 0 0 20px; margin: 5px 0px 5px 0px; tab-size: 4; -moz-tab-size: 4; line-height: 0.85em;}
	.optionsTable code {font-size: 9pt; font-family: monospace;}
	.optionsTable .mono {font-family: monospace;}

	.table-no-lines tr,td,th {
		border-width: 0 !important;
	}

</style>

</head>
<body>
<?php
if (file_exists(dirname(__FILE__).'/navi.php')) {
	// This is only for the demo, you can remove it
	include dirname(__FILE__).'/navi.php';
}
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12" style="margin-bottom: 40px;">
			<h1 class="page-header">AJAX-ZOOM - $.fn.axZm.zoomTo() demo + zoom & crop basics and demo for developers</h1>

			<p>This example shows the basics of AJAX-ZOOM $.fn.axZm.zoomTo API and dynamic crop generation. With this basics one can 
				develop more sophisticated applications for front as well as backend usage. For developers we also recommend 
				to visit <a href="example14.php">example14.php</a> to get an overview about various callbacks provided by AJAX-ZOOM.
			</p>

			<p>If you are looking for a fast way to create a simple gallery with zooming to a specified image area, then please proceed to 
				<a href="example35.php">image crop editor (example35.php)</a> where you will be able to create and save 
				(thus beeing able to reproduce) such a gallery within 30 seconds. This <a href="example35.php">image crop configurator</a> 
				can work with single images, AJAX-ZOOM galleries, 360 and 3D multirow animations.
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" style="z-index: 1">
			<!-- Player -->
			<div class="embed-responsive" style="padding-bottom: 75%; border: #000 1px solid">
				<!-- Div where AJAX-ZOOM is loaded into -->
				<div id="azParentContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
					Loading, please wait..
				</div>
			</div>
		</div>
		<div class="col-md-6" style="z-index: 1">
			<table class="table table-no-lines">
				<thead>
					<tr>
						<th colspan="5" style="font-size: 150%">jQuery.fn.axZm.zoomTo test basic parameters</th>
					</tr>
				</thead>
				<tbody style="border-bottom-width: 0;">
					<tr>
						<td width="100">Coordinates:</td>
						<td width="80">x1: <input type="text" class="form-control" id="sbm_x1" value="40%" style="width: 60px"></td>
						<td width="80">y1: <input type="text" class="form-control" id="sbm_y1" value="40%" style="width: 60px"></td>
						<td width="80">x2: <input type="text" class="form-control" id="sbm_x2" style="width: 60px" value=""></td>
						<td width="80">y2: <input type="text" class="form-control" id="sbm_y2" style="width: 60px" value=""></td>
					</tr>
					<tr>
						<td>zoomLevel:</td>
						<td colspan="4"><input type="text" class="form-control" id="sbm_zoomLevel" style="width: 60px" value="100"> %</td>
					</tr>
					<tr>
						<td>speed:</td>
						<td colspan="4"><input type="text" class="form-control" id="sbm_speed" style="width: 60px" value="1000"> ms</td>
					</tr>
					<tr>
						<td>motion:</td>
						<td colspan="4">
							<select id="sbm_motion" class="form-control">
								<option>swing</option> <option>linear</option> <option>easeInQuad</option> <option>easeOutQuad</option> <option>easeInOutQuad</option> <option>easeInCubic</option> <option>easeOutCubic</option> <option>easeInOutCubic</option> <option>easeInQuart</option> 
								<option>easeOutQuart</option><option>easeInOutQuart</option> <option>easeInQuint</option><option>easeOutQuint</option> <option>easeInOutQuint</option> <option>easeInSine</option> <option>easeOutSine</option> <option>easeInOutSine</option> 
								<option>easeInExpo</option> <option>easeOutExpo</option> <option>easeInOutExpo</option> <option>easeInCirc</option> <option>easeOutCirc</option> <option>easeInOutCirc</option> <option>easeInElastic</option> <option>easeOutElastic</option>
								<option>easeInOutElastic</option> <option>easeInBack</option> <option>easeOutBack</option> <option>easeInOutBack</option> <option>easeInBounce</option> <option>easeOutBounce</option> <option>easeInOutBounce</option> 
							</select>
						</td>
					</tr>
					<tr>
						<td style="border-bottom-width: 0;">&nbsp;</td>
						<td colspan="5" style="border-bottom-width: 0;"><input type="button" class="btn btn-warning" value="zoomTo" onClick="zoomToTest(); $(this).blur()"> &nbsp;</td>
					</tr>
				</tbody>
				<thead>
					<tr>
						<th colspan="5" style="border-top-width: 0; font-size: 150%;">Retrieve x1, y1, x2, y2</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="100">Original image:</td>
						<td width="80">x1: <input type="text" class="form-control" id="z_x1" style="width: 60px"></td>
						<td width="80">y1: <input type="text" class="form-control" id="z_y1" style="width: 60px"></td>
						<td width="80">x2: <input type="text" class="form-control" id="z_x2" style="width: 60px"></td>
						<td width="80">y2: <input type="text" class="form-control" id="z_y2" style="width: 60px"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="4">
							<input type="button" class="btn btn-info btn-sm" value="GET parameters" onClick="getZoomParam(); $(this).blur()" style="margin-right: 5px;">
							<input type="button" class="btn btn-info btn-sm" value="SET parameters (zoomTo)" onClick="setZoomParam(); $(this).blur()">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div id="zoomedThumbnails" style="position: relative; padding: 10px; min-height: 100px; margin-top: 15px; background-image: url(../axZm/icons/canvas.png); border: #CCC 1px solid">
				<div style="padding: 10px; background-color: rgba(255, 255, 255, 0.5); width: 100%; height: 100%; position: absolute; left: 0; top: 0">Area for thumbnails</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h3>Make crop / thumbnail</h3>
			<p>AJAX-ZOOM has API to create thumbnails (sort of screenshots) of zoomed image on-the-fly. 
				This feature can be generally disabled and has many parameters which can be adjusted.
			</p>
			<div class="alert alert-info">Zoom with the above tools or in the player and press the button below to test.</div>
			<input type="button" class="btn btn-danger" value="Create crop / thumbnail" onClick="createThumbnail(); $(this).blur()">
			<!--
			Width: <input type="text" value="100" id="cropWidth" style="width: 50px;" />
			Height: <input type="text" value="100" id="cropHeight" style="width: 50px;" />
			-->
		</div>

		<!-- Text -->
		<div class="col-lg-12">
			<h3>Some code</h3>
			<p style="margin-top: 0;">Zooming into a predefined image area is very simple. 
			All you need to know are the coordinates of the edges in the <u>original image</u>: x1, y1 (top left corner) and x2, y2 (bottom right corner).
			You will then need to pass this coordinates to the method jQuery.fn.axZm.zoomTo() and bind the method to any event: 
			</p>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ("<a href='javascript: void(0)' onclick=\"jQuery.fn.axZm.zoomTo({x1: 2584, y1: 1650, x2: 3424, y2: 2210, motion: 'easeOutBack', motionZoomed: 'easeOutSine', speed: 1500, speedZoomed: 750}); return false;\">Zoom to rect</a>");
			echo "</code></pre>";
			?>

			<p>You can also zoom to a certain point knowing only the x1 and y1 coordinates or even define x1 and y1 as percentage. 
				With the additional property "zoomLevel" you can adjust the final level of zoomed area.
			</p>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ("<a href='javascript: void(0)' onclick=\"jQuery.fn.axZm.zoomTo({x1: '40%', y1: '60%', zoomLevel: '75%'}); return false;\">Zoom to point</a>");
			echo "</code></pre>";
			?>

			<p>For the three tests following simple functions are used:</p>
			<pre><code class="language-js" id="exampleJsPrism"></code></pre>
		</div>

		<!-- Docs -->
		<div class="col-lg-12">
			<h3>jQuery.fn.axZm.zoomTo (options)</h3>
			<table class="optionsTable" width="100%">
				<tbody>
					<tr><th width="100" class='opth3'>Option</th><th class='opth3'>Type</th><th class='opth3'>Description</th></tr>
					<tr><td class='optdl'>x1</td><td class='optdm'>int|string</td><td class='optdr'>
						Top-left x coordinate as integer or percentage, e.g. '40%' as string; <br>
						You should provide y1 coordinate too;<br>
						If you do not provide x2 and y2 coordinates AJAX-ZOOM will take x1 and y1 coordinates as the middle point to where it should zoom 
						which is very conveninent in some cases. <br>
						The level of zoom is supplied by zoomLevel option, see below. 
					</td></tr>
					<tr><td class='optdl'>y1</td><td class='optdm'>int|string</td><td class='optdr'>Top-left y coordinate as integer or percentage, e.g. '40%' as string</td></tr>
					<tr><td class='optdl'>x2</td><td class='optdm'>int|string</td><td class='optdr'>
						Bottom-right x coordinate as integer or persentage e.g. '60%' as string; <br> 
						If you provide x2 coordinates you have to provide y2 coordinates too;<br> 
						So by providing x1, y1, x2 and y2 you specify a rectangle for zoomTo; <br> 
						It is ok when the proportion of these rectangle does not math the proportions of the player / viewing area 
						which would happen for responsive AJAX-ZOOM implementation anyway.<br> 
					</td></tr>
					<tr><td class='optdl'>y1</td><td class='optdm'>int|string</td><td class='optdr'>Bottom-right y coordinate as integer or percentage, e.g. '60%' as string</td></tr>
					
					<tr><td class='optdl'>zoomLevel</td><td class='optdm'>float</td><td class='optdr'>
						Desired zoom level (percent) if only x1 and y1 coordinates are proveded, e.g. 50; 
						100 is zoom at max. 
					</td></tr>
					<tr><td class='optdl'>motion</td><td class='optdm'>string</td><td class='optdr'>
						Type of easing used when initially the image is not zoomed.
					</td></tr>
					<tr><td class='optdl'>motionZoomed</td><td class='optdm'>string</td><td class='optdr'>
						Type of easing if the image is already zoomed. 
					</td></tr>
					<tr><td class='optdl'>speed</td><td class='optdm'>int</td><td class='optdr'>
						Speed in ms of transition if image is not zoomed. 
					</td></tr>
					<tr><td class='optdl'>speedZoomed</td><td class='optdm'>int</td><td class='optdr'>
						Speed in ms of transition if image is zoomed. 
					</td></tr>
					<tr><td class='optdl'>initial</td><td class='optdm'>bool</td><td class='optdr'>
						If set to true, all coordinates will be regarded as coordinates of the not zoomed state 
						of AJAX-ZOOM player. Default: false
					</td></tr>
					<tr><td class='optdl'>ajxTo</td><td class='optdm'>int</td><td class='optdr'>
						Time after which the zoom should get sharp (load tiles) Default: 1000
					</td></tr>
					<tr><td class='optdl'>callback</td><td class='optdm'>function</td><td class='optdr'>
						You custom callback function.
					</td></tr>
				</tbody>
			</table>
		</div>
		<div class="col-lg-12" style="margin-top: 10px">
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

<script type="text/javascript" id="exampleJs">
	// var indicating that thumbnail is generating
	var cropLoading = false;

	// function to get x1, y1, x2 and y2 values
	function getZoomParam() {
		if (!$.axZm) {
			return;
		}

		// Get values
		var getCropValues = $.fn.axZm.getCropValues()[1];

		// Set values into form fields
		$("#z_x1").val(Math.round(getCropValues[0]));
		$("#z_y1").val(Math.round(getCropValues[1]));
		$("#z_x2").val(Math.round(getCropValues[2]));
		$("#z_y2").val(Math.round(getCropValues[3]));
	}

	// function to retrieve values from form fields and fire zoomTo
	function setZoomParam(){
		if (!$.axZm) {
			return;
		}

		// speed should be integer
		var speed = $("#sbm_speed").val();
		if (speed >= 0) {
			speed = parseInt(speed);
		} else {
			speed = 1000;
		}

		$.fn.axZm.zoomTo({
			// if x2 and y2 are not supposed to be passed but property is defined, it should be of type undefined
			x1: $("#z_x1").val() || undefined,
			y1: $("#z_y1").val() || undefined,
			x2: $("#z_x2").val() || undefined,
			y2: $("#z_y2").val() || undefined,
			speed: speed,
			speedZoomed: speed,
			ajxTo: speed,
			motion: $("#sbm_motion").val(),
			motionZoomed: $("#sbm_motion").val(),
			zoomLevel: $("#sbm_zoomLevel").val() || false
		});
	}

	// function to retrieve values from form fields and fire zoomTo
	function zoomToTest() {
		if (!$.axZm) {
			return;
		}

		// speed should be integer
		var speed = $("#sbm_speed").val();
		if (speed >= 0 ) {
			speed = parseInt(speed);
		} else {
			speed = 1000;
		}

		$.fn.axZm.zoomTo({
			x1: $("#sbm_x1").val() || undefined,
			y1: $("#sbm_y1").val() || undefined,
			x2: $("#sbm_x2").val() || undefined,
			y2: $("#sbm_y2").val() || undefined,
			speed: speed,
			speedZoomed: speed,
			ajxTo: speed,
			motion: $("#sbm_motion").val(),
			motionZoomed: $("#sbm_motion").val(),
			zoomLevel: $("#sbm_zoomLevel").val() || false
		});
	}

	function createThumbnail() {
		if (!$.axZm || cropLoading) {
			return;
		}

		// Get values
		var getCropValues = $.fn.axZm.getCropValues()[1];
		var cropWidth = 109;
		var cropHeight = 109;

		// Width height of the thumbnail
		/*var cropWidth = $("#cropWidth").val();
		var cropHeight = $("#cropHeight").val();
		if (cropWidth > 220){cropWidth = 220;}
		if (cropHeight > 220){cropHeight = 220;}
		if (cropWidth < 50){cropWidth = 50;}
		if (cropHeight < 50){cropHeight = 50;}*/

		// Generate a string for thumb
		var dynThumbPar = $.fn.axZm.installPath() + "zoomLoad.php?azImg=" + $.axZm.zoomGA[$.axZm.zoomID]["ph"] + $.axZm.zoomGA[$.axZm.zoomID]["img"];
		dynThumbPar += "&x1="+getCropValues[0];
		dynThumbPar += "&y1="+getCropValues[1];
		dynThumbPar += "&x2="+getCropValues[2];
		dynThumbPar += "&y2="+getCropValues[3];
		dynThumbPar += "&width="+cropWidth;
		dynThumbPar += "&height="+cropHeight;

		// Set cropping status
		cropLoading = true;

		// Preload image
		$(new Image())
		.load(function() {
			cropLoading = false;

			if ($("#zoomedThumbnails>img").length == 0) {
				$("#zoomedThumbnails").empty();
			}

			// Prepend thumb to a div
			$("<img>").attr("src", dynThumbPar)
			.addClass("cropImage")
			.bind("click", function() {
				// on thumb click zoom to this area
				var speed = $("#sbm_speed").val(); 
				if (speed >= 0 ) {
					speed = parseInt(speed);
				} else {
					speed = 1000;
				}

				$.fn.axZm.zoomTo({
					x1: getCropValues[0],
					y1: getCropValues[1],
					x2: getCropValues[2],
					y2: getCropValues[3],
					speed: speed,
					speedZoomed: speed,
					ajxTo: speed,
					motion: $("#sbm_motion").val(),
					motionZoomed: $("#sbm_motion").val()
				});
			})
			.prependTo("#zoomedThumbnails")

			// Remove all thumbs except first 10 (this is just for the test)
			$("#zoomedThumbnails>img").slice(10).remove();
		})
		.error(function(){
			cropLoading = false;
			alert("Making crop failed");
		})
		.attr("src", dynThumbPar);
	}
</script>

<script type="text/javascript">
	var ajaxZoom = {}; // New object
	ajaxZoom.divID = "azParentContainer"; // The id of the Div where ajax-zoom has to be inserted into		
	ajaxZoom.path = "../axZm/"; // Path to the axZm folder
	ajaxZoom.parameter = "zoomData=/pic/zoom/high_res/high_res_001.jpg&example=testZoomTo"; // Custom parameter
	ajaxZoom.opt = {
		onBeforeStart: function(){

		},
		onLoad: function(){
			//jQuery.fn.axZm.zoomTo({x1: 2584, y1: 1650, x2: 3424, y2: 2210, motion: "easeOutBack", motionZoomed: "easeOutQuad", speed: 1500, speedZoomed: 1000});
		}
	};
	
	// Load AJAX-ZOOM not responsive
	/*
	$.fn.axZm.load({
		opt: ajaxZoom.opt,
		path: ajaxZoom.path,
		parameter: ajaxZoom.parameter,
		divID: ajaxZoom.divID
	});
	*/

	// open AJAX-ZOOM responsive
	// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
	$(document).ready(function() {
		$.fn.axZm.openResponsive(
			ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. "/axZm/"
			ajaxZoom.parameter, // Defines which images and which options set to load
			ajaxZoom.opt, // callbacks
			ajaxZoom.divID, // target - container ID (default "window" - fullscreen)
			false, // apiFullscreen- use browser fullscreen mode if available
			true, // disableEsc - prevent closing with Esc key
			false // postMode - use POST instead of GET
		);
	});
</script>

<script>
	// this is for demo, not needed
	$("#exampleJsPrism").html($("#exampleJs").html());
</script>
</body>
</html>