<!DOCTYPE html>
<html>
	<head>
		<title>36_widget</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!--  Include jQuery core into head section -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  AJAX-ZOOM javascript && CSS -->
		<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css">
			.azMsgClickToOpen {
				text-align: center;
				margin-bottom: 40px;
				font-size: 11px;
				font-weight: bold;
				font-family: monospace;
			}

			/* Design for color swatches, outer container */
			.azColorWrap {
				width: 60px;
				height: 30px;
				position: relative;
				display: inline-block;
				margin: 0 10px 10px 0;
				cursor: pointer; 
				overflow: hidden;
			}

			/* Design for color swatches, inner container 1 */
			.azColorWrap .color1 {
				position: absolute;
				width: 50%; height: 100%;
				top: 0; left: 0;
			}

			/* Design for color swatches, inner container 2 */
			.azColorWrap .color2 {
				position: absolute;
				width: 50%; height: 100%;
				top: 0; right: 0;
			}

			/* CSS class that is added to the body when the widget window opens */
			.azWidgetBody {
				overflow: hidden!important;
				overflow-x: hidden!important;
				overflow-y: hidden!important;
			}

			/* Big modal window container */
			#azPlayerParentContainerWidget {
				box-sizing: border-box !important;
				position: fixed;
				width: 100%;
				height: 100%;
				/* You could add padding to make the Widget a modal window */
				/* padding: 20px 20px 50px 20px; */
				z-index: 555;
				top: 0;
				left: 0;
			}

			/* Inner container inside the big modal window container */
			#azPlayerParentContainerWidgetInner {
				box-sizing: border-box !important;
				position: relative;
				background-color: #FFF;
				/* You can add border if #azPlayerParentContainerWidget has padding */
				/* border: 2px solid #000; */
				padding: 0;
				width: 100%;
				height: 100%;
			}

			/* Custom close-button at top right of the modal window */
			.azWidgetCloseButton {
				box-sizing: content-box !important;
				color: #333333;
				font: 32px/100% arial, sans-serif;
				position: absolute;
				right: 5px;
				z-index: 10;
				text-decoration: none;
				text-shadow: 0 0 1px #FFF;
				top: 5px;
				padding: 3px;
				text-align: center;
				cursor: pointer;
			}

			.azWidgetCloseButton:hover{
				color: red;
			}

			.azWidgetCloseButton:after {
				content: '✕';
			}

			/* Overlay that is appended to the AJAX-ZOOM viewer */
			#azWidgetOverlay {
				box-sizing: border-box !important;
				cusrsor: pointer;
				position: absolute;
				z-index: 5;
				width: 100%;
				height: 30%;
				max-height: 200px;
				left: 0;
				bottom: 0;
				pointer-events: none;
				background-color: rgba(255,255,255,0.5);
				transition: transform 0.4s ease-out;
			}

			/* This class is added when the overlay hides at widget mode */
			.azWidgetOverlayHidden {
				transform: translate(0, 100%);
			}

			/* Inner container that is appended to #azWidgetOverlay */
			#azWidgetOverlayInner {
				position: absolute;
				pointer-events: auto;
				box-sizing: border-box !important;
				padding: 10px 10px 0 10px;
				z-index: 6;
				width: 100%;
				height: 100%;
				left: 0;
				top: 0;
				color: #000;
			}

			/* Toggle button to show/hide the overlay with color swatches and descriptions */
			#azWidgetOverlayToggle {
				box-sizing: border-box !important;
				position: absolute;
				top: 0;
				left: 50%;
				transform: translate(-50%, -100%);
				z-index: 7;
				padding: 4px 30px 4px 30px;
				border-radius: 5px 5px 0 0;
				pointer-events: auto;
				text-align: center;
				background-color: rgba(255,255,255,0.5);
				font-size: 16px;
				font-weight: bold;
				cursor: pointer;
			}

			.azWidgetArrowUp {
				transform:rotate(90deg);
				display: inline-block;
			}

			.azWidgetArrowDown {
				transform:rotate(-90deg);
				display: inline-block;
			}

			/* Container for text inside #azWidgetOverlayInner */
			#azWidgetText {
				position: absolute;
				top: 0;
				left: 0;
				width: 50%;
				height: 100%;
				overflow-x: hidden;
				overflow-y: auto;
			}

			/* Container for title inside #azWidgetText */
			#azWidgetTitle {
				font-size: 18px;
				line-height: 20px;
				padding: 10px 10px 2px 10px;
			}

			/* Container for description inside #azWidgetText */
			#azWidgetDescr {
				box-sizing: border-box !important;
				padding: 10px 10px 5px 22px;
				font-size: 14px;
				line-height: 16px;
			}

			/* Container for the buttons that trigger spin and zoom animations */
			#azWidgetSpinToContainer {
				box-sizing: border-box !important;
				width: 45%;
				position: absolute;
				padding: 10px 0 0 0;
				text-align: right;
				right: 0;
				top: 0;
			}

			/* Buttons that trigger spin and zoom animations */
			.azWidgetSpinToButton {
				box-sizing: border-box !important;
				margin: 0px 10px 10px 0;
				display: inline-block;
				border: #444 1px solid;
				min-width: 120px;
				cursor: pointer;
				padding: 5px;
				text-align: left;
			}

			.azWidgetSpinToButton:hover {
				border-color: #000;
			}

			/* Container for 360 variant buttons */
			#azWidgetSwatches {
				position: absolute;
				right: 0px;
				bottom: 0px;
				width: 45%;
				text-align: right;
			}

			/* Adjustments for smaller screens */
			@media screen and (max-width: 992px) {
				#azWidgetOverlay {
					height: 40%;
					max-height: 300px;
				}

				.azColorWrap {
					width: 40px;
					height: 20px;
				}

				#azWidgetDescr {
					font-size: 12px;
					line-height: 14px;
					padding: 10px 10px 5px 15px;
				}

				.azWidgetSpinToButton {
					min-width: 80px;
					font-size: 12px;
				}
			}

			@media screen and (max-width: 414px) {
				.azWidgetSpinToButton {
					min-width: 0;
					font-size: 12px;
					margin: 0px 6px 6px 0;
					padding: 3px;
				}
				#azWidgetText {
					height: calc(100% - 40px);
				}

				#azWidgetSpinToContainer {
					max-height: calc(100% - 40px);
				}

				#azWidgetSwatches {
					width: 100%;
				}
			}
		</style>

	</head>
	<body>
		<?php
		// This include is just for the demo, you should remove it
		if (file_exists(dirname(__FILE__).'/navi.php')) {
			include dirname(__FILE__).'/navi.php';
		}
		?>

		<div class="container">
			<div class="col-md-12">
				<h1 class="page-header">3D/360 product spin configuration widget for developers</h1>
			</div>

			<!-- outer container should be relative, fixed or absolute -->
			<div id="outerWidgetContainer" class="clearfix" style="position: relative; clear: both;">
				<!-- This bootstrap CSS layout with col-* classes is optional -->
				<div class="col-md-6">
					<!-- Basically, only one element with an ID is required. 
					We name it "azViewerParentContainer" here, and it is responsive / adaptive.
					The container should have a calculated height.
					If height is set to 100%, then its parent container should have a calculated height.
					-->
					<div id="azViewerParentContainer" style="height: 560px; max-height: 60vh; position: relative;"></div>
					<p class="azMsgClickToOpen">
						Click or double tap on the 360 spin to open it in a full-page modal box!
					</p>
				</div>

				<!-- Description / parameters ... whatever -->
				<div class="col-md-6" style="height: 100%;">
					<div style="overflow-x: hidden;">
						<h2 style="margin-top: 0">360° view</h2>
						<div>
							<p>Click or double tap on the 360 spin to open it in a full-page modal box!
							</p>
							<!-- In your application, this is dynamically created block. -->
							<div id="azColorSwathes">
								<div class="azColorWrap" data-az_spin_path="../pic/zoom3d/Uvex_Occhiali">
									<div class="color1" style="background-color: #000;"></div>
									<div class="color2" style="background-color: #583e31;"></div>
								</div>
								<div class="azColorWrap" data-az_spin_path="../pic/zoom3d/set_your_path_1">
									<div class="color1" style="background-color: #000;"></div>
									<div class="color2" style="background-color: #c0c0c0;"></div>
								</div>
								<div class="azColorWrap" data-az_spin_path="../pic/zoom3d/set_your_path_2">
									<div class="color1" style="background-color: #dcccbf;"></div>
									<div class="color2" style="background-color: #d2a679;"></div>
								</div>
								<div class="azColorWrap" data-az_spin_path="../pic/zoom3d/set_your_path_3">
									<div class="color1" style="background-color: #ec7032;"></div>
									<div class="color2" style="background-color: #583e31;"></div> 
								</div>
							</div>
						</div>
						<p>This example is a proof of concept that shows several AJAX-ZOOM non-default options, 
							API and event hooks playing well together while developing a non-standard 360 product viewer. 
						</p>
						<p style="font-size: 150%;">For additional description and explanation, please see <br>
							<a href="https://www.ajax-zoom.com/examples/example36_widget.php" rel="nofollow">https://www.ajax-zoom.com/examples/example36_widget.php</a>
						</p>
						<div class="alert alert-warning">Also, since the download package has only one 360 view as an example, 
							you should provide your own 360 views and change the <code>data-az_spin_path</code> 
							attributes of the elements with <code>azColorWrap</code> CSS class.
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12" style="margin-bottom: 50px">
			</div>
		</div>

		<!-- This JavaScript code should be written dynamically. -->
		<script type="text/javascript" id="azDataCode">
			// Define a global variable to access from anywhere
			if (!window.azWidgetVars) {
				window.azWidgetVars = {};
			}

			// Create a variable to store descriptions for parts of the 360 views
			window.azWidgetVars.data = {};

			// e.g. description for "black" chair (which stores in folder named "black") 
			// This is what you should fetch from a database or some JSON file 
			// You can retrieve the coordinates from Photoshop, 
			// or we can build an (online) widget similar (simplified) to example35.php
			window.azWidgetVars.data['set_your_path_1'] = {
				'default': {
					'title': 'Chair "orange"',
					'descr': 'For this 360 variant, there are no spin & zoom buttons!'
				}
			};

			window.azWidgetVars.data['Uvex_Occhiali'] = {
				'default': {
					'title': 'Chair "black"',
					'descr': 'Click on the labels to the right to see details!<br>+ Some description about spinning and panning, like pan with right mouse down...'
				},
				'54': { // can be frame number or image name
					'label': 'Bacon', // label for click element
					'title': 'Bacon ipsum dolor amet sirloin', // title displayed
					'descr': 'Bacon ipsum dolor amet sirloin ground round prosciutto cow, biltong jowl flank ball tip chuck chicken shankle rump tenderloin. Chuck ham hock porchetta ground round tenderloin beef, jowl pork chop fatback sausage. Chuck venison tenderloin biltong. Rump jowl venison pork belly kevin beef fatback pancetta cow ham tongue boudin. Meatball venison fatback hamburger.', // description displayed
					'coordinates': [913, 31, 2331, 1450] // x1, y1, x2, y2 (does not need to be precise, works for responsive...)
				},
				'17': {
					'label': 'Tri-tip',
					'title': 'Tri-tip shank chuck shoulder',
					'descr': 'Tri-tip shank chuck shoulder rump brisket capicola meatball andouille ham flank turducken pig. Capicola ground round cow t-bone strip steak pancetta short loin pork belly boudin corned beef tongue ham hock jowl. Sausage swine shankle chicken pork chop jowl shank porchetta. Venison capicola corned beef landjaeger beef pig short loin boudin ground round tongue doner.',
					'coordinates': [1594, 600, 1908, 914]
				},
				'4': {
					'label': 'Strip',
					'title': 'Strip steak beef ribeye meatball',
					'descr': 'Strip steak beef ribeye meatball cow pancetta ball tip meatloaf picanha sirloin ham short ribs. Meatloaf brisket strip steak fatback, shank jerky porchetta pork biltong boudin chicken andouille turducken venison. Hamburger cupim sirloin, capicola doner kevin flank turducken alcatra tenderloin. Rump bresaola chuck jerky porchetta ball tip chicken.',
					'coordinates': [1339, 1269, 1874, 1804]
				},
				'47': {
					'label': '',
					'title': 'Andouille landjaeger prosciutto',
					'descr': 'Andouille landjaeger prosciutto picanha doner shank pork belly. Sausage turducken tenderloin boudin. Pork porchetta alcatra corned beef pig pork chop pork loin. Pancetta boudin pork turkey ribeye tongue frankfurter pig short loin doner. Meatloaf corned beef hamburger frankfurter. Short ribs meatball tail meatloaf.',
					'coordinates': [1452, 1907, 1827, 2283]
				},
				'8': {
					'label': 'Chuck',
					'title': 'Chuck landjaeger swine turkey',
					'descr': 'Chuck landjaeger swine turkey tri-tip cupim bacon kevin sausage pastrami short ribs strip steak. Filet mignon beef strip steak pastrami. Ball tip tenderloin jerky pancetta drumstick ground round ham hock pork chop strip steak tail tri-tip filet mignon salami. Picanha kielbasa salami fatback frankfurter.',
					'coordinates': [1468, 2413, 1786, 2731]
				}
			};

			window.azWidgetVars.data['set_your_path_2'] = {
				'default': {
					'title': 'Chair "silver"',
					'descr': 'Click on the labels to the right to see details!<br>+ Some description about spinning and panning, like pan with right mouse down...'
				},
				'54': { // can be frame number or image name
					'label': 'Occaecat beef', // label for click element
					'title': 'Occaecat beef t-bone kielbasa', // title displayed
					'descr': 'Occaecat beef t-bone kielbasa pariatur dolore. Velit adipisicing nulla beef shankle sausage, meatball bacon occaecat mollit porchetta in ipsum. Turkey leberkas nostrud sausage tongue occaecat enim landjaeger lorem meatball prosciutto ex. Strip steak alcatra occaecat consectetur. Pork loin adipisicing consequat frankfurter. Spare ribs bresaola flank qui lorem in.', // description displayed
					'coordinates': [913, 31, 2331, 1450] // x1, y1, x2, y2 (does not need to be precise, works for responsive...)
				},
				'17': {
					'label': 'Tempor ad minim',
					'title': 'Tempor ad minim ea dolor ground round',
					'descr': 'Tempor ad minim ea dolor ground round. In pig minim quis ea. Short ribs andouille dolore chicken magna landjaeger picanha cillum laboris. Meatloaf kielbasa pariatur dolore nulla.',
					'coordinates': [1594, 600, 1908, 914]
				},
				'4': {
					'label': 'Ham ullamco',
					'title': 'Ham ullamco ex et tail velit tri-tip',
					'descr': 'Ham ullamco ex et tail velit tri-tip. Do pig pancetta pastrami. Beef ribs voluptate fugiat chuck. Cupidatat dolor bresaola hamburger cow short loin qui t-bone rump turducken.',
					'coordinates': [1339, 1269, 1874, 1804]
				},
				'47': {
					'label': 'Et aliqua',
					'title': 'Et aliqua short loin commodo tri-tip chuck',
					'descr': 'Et aliqua short loin commodo tri-tip chuck. Reprehenderit exercitation mollit, ball tip andouille adipisicing ullamco ut bresaola. Pork belly swine landjaeger esse pig. Enim velit adipisicing elit irure, exercitation filet mignon pastrami.',
					'coordinates': [1452, 1907, 1827, 2283]
				},
				'8': {
					'label': 'Doner shoulder',
					'title': 'Doner shoulder exercitation nostrud',
					'descr': 'Doner shoulder exercitation nostrud. Kielbasa rump short loin salami. Shankle ham consequat t-bone pork loin rump. Veniam hamburger porchetta officia. Ex proident swine tri-tip chicken meatball in cillum. Bacon t-bone tri-tip ipsum sausage lorem.',
					'coordinates': [1468, 2413, 1786, 2731]
				}
			};

			window.azWidgetVars.data['set_your_path_3'] = {
				'default': {
					'title': 'Chair "classic"',
					'descr': 'Click on the labels to the right to see details!<br>+ Some description about spinning and panning, like pan with right mouse down...'
				},
				'54': { // can be frame number or image name
					'label': 'Bacon', // label for click element
					'title': 'Bacon ipsum dolor amet sirloin', // title displayed
					'descr': 'Bacon ipsum dolor amet sirloin ground round prosciutto cow, biltong jowl flank ball tip chuck chicken shankle rump tenderloin. Chuck ham hock porchetta ground round tenderloin beef, jowl pork chop fatback sausage. Chuck venison tenderloin biltong. Rump jowl venison pork belly kevin beef fatback pancetta cow ham tongue boudin. Meatball venison fatback hamburger.', // description displayed
					'coordinates': [913, 31, 2331, 1450] // x1, y1, x2, y2 (does not need to be precise, works for responsive...)
				},
				'17': {
					'label': 'Tri-tip',
					'title': 'Tri-tip shank chuck shoulder',
					'descr': 'Tri-tip shank chuck shoulder rump brisket capicola meatball andouille ham flank turducken pig. Capicola ground round cow t-bone strip steak pancetta short loin pork belly boudin corned beef tongue ham hock jowl. Sausage swine shankle chicken pork chop jowl shank porchetta. Venison capicola corned beef landjaeger beef pig short loin boudin ground round tongue doner.',
					'coordinates': [1594, 600, 1908, 914]
				},
				'4': {
					'label': 'Strip',
					'title': 'Strip steak beef ribeye meatball',
					'descr': 'Strip steak beef ribeye meatball cow pancetta ball tip meatloaf picanha sirloin ham short ribs. Meatloaf brisket strip steak fatback, shank jerky porchetta pork biltong boudin chicken andouille turducken venison. Hamburger cupim sirloin, capicola doner kevin flank turducken alcatra tenderloin. Rump bresaola chuck jerky porchetta ball tip chicken.',
					'coordinates': [1339, 1269, 1874, 1804]
				},
				'47': {
					'label': '',
					'title': 'Andouille landjaeger prosciutto',
					'descr': 'Andouille landjaeger prosciutto picanha doner shank pork belly. Sausage turducken tenderloin boudin. Pork porchetta alcatra corned beef pig pork chop pork loin. Pancetta boudin pork turkey ribeye tongue frankfurter pig short loin doner. Meatloaf corned beef hamburger frankfurter. Short ribs meatball tail meatloaf.',
					'coordinates': [1452, 1907, 1827, 2283]
				},
				'8': {
					'label': 'Chuck',
					'title': 'Chuck landjaeger swine turkey',
					'descr': 'Chuck landjaeger swine turkey tri-tip cupim bacon kevin sausage pastrami short ribs strip steak. Filet mignon beef strip steak pastrami. Ball tip tenderloin jerky pancetta drumstick ground round ham hock pork chop strip steak tail tri-tip filet mignon salami. Picanha kielbasa salami fatback frankfurter.',
					'coordinates': [1468, 2413, 1786, 2731]
				}
			};

		</script>

		<!-- Custom JavaScript code for this example -->
		<script type="text/javascript" id="azWidgetCode">
			/* 
			If you are triggering jQuery.fn.axZm.openResponsive outside of jQuery(document).ready,
			then please make sure it is done after the AJAX-ZOOM parent container, 
			in this case the div with ID "azViewerParentContainer".
			*/
			jQuery(document).ready(function($) {
				// Define a global variable to access from anywhere
				if (!window.azWidgetVars) {
					window.azWidgetVars = {};
				}

				//////////////////////////////////////////////////////
				//////////////////// Configuration ///////////////////
				//////////////////////////////////////////////////////

				// The value of the "example" query string parameter that is passed to AJAX-ZOOM
				// This parameter changes a set of settings
				window.azWidgetVars.example = 'colorSwatch';

				// ID of the parent container for the AJAX-ZOOM viewer
				window.azWidgetVars.viewerParentContainer = 'azViewerParentContainer';

				// Selector for container with product variants
				window.azWidgetVars.variantsContainer = '#azColorSwathes';

				// Selector for variantns. 
				// Must have data-az_spin_path attributes that define the paths to 360 views
				window.azWidgetVars.variants = '.azColorWrap';

				// Localization variables
				window.azWidgetVars.pleaseWait = 'Loading, please wait...';
				window.azWidgetVars.resetView = '<span style="margin-right: 10px;">&#8635;</span>' + 'Reset view';
				window.azWidgetVars.showHide = ['<span class="azWidgetArrowUp">&#10094;</span>', '<span class="azWidgetArrowDown">&#10094;</span>'];

				// Helper function to extract currently loaded directory and identify the spin. 
				// You might need to adjust this function and match with window.azWidgetVars.data
				window.azWidgetVars.getSpinName = function() {
					var path = jQuery.axZm.orgPath,
					pathArr = path.split('/').reverse();

					if (jQuery.axZm.zAxis) {
						return pathArr[2];
					}else{
						return pathArr[1];
					}
				};

				//////////////////////////////////////////////////////
				//////////// Does not need to be changed /////////////
				//////////////////////////////////////////////////////

				// Set click events for color swatches / 360 variants
				// upon the data-az_spin_path attribute 
				// of the .azColorWrap elements
				$(window.azWidgetVars.variantsContainer + ' ' + window.azWidgetVars.variants)
				.each(function() {
					var dta = $(this).attr('data-az_spin_path');
					if (dta) {
						// The first path is loaded as first 360 product view
						if (!window.azWidgetVars.firstSpinPath) {
							window.azWidgetVars.firstSpinPath = dta;
						}

						$(this).on('click', function() {
							// jQuery.fn.axZm.loadAjax360Type 
							// needs all 360 views to be the same size. 
							// It defaults to jQuery.fn.axZm.loadAjaxSet 
							// if that requirement is not met.
							jQuery.fn.axZm.loadAjax360Type(
								'3dDir=' + dta + '&example=' + window.azWidgetVars.example,
								window.azWidgetVars.overlayClear,
								null,
								window.azWidgetVars.setOverlay
							);
						});
					}
				});

				// Flag that the expended view is set
				window.azWidgetVars.expanded = false;

				// Flag for descriptions
				window.azWidgetVars.changeOnExpanded = false;

				// Function that triggers when expanded modal box view closes
				window.azWidgetVars.close = function()
				{
					if (window.azWidgetVars.expanded === true) {
						// Make page scrollable again
						jQuery('body').removeClass('azWidgetBody');

						// Reset identifier
						window.azWidgetVars.expanded = false;

						// Stop spinning
						jQuery.fn.axZm.spinStop();

						// Set AJAX-ZOOM setting no no keep the zoom level
						jQuery.axZm.fullScreenKeepZoom = {
							init: false,  
							restore: false,
							resize: false
						};

						// Enable page scroll with the mouse wheel
						jQuery.axZm.mouseScrollEnable = true;

						// Use AJAX-ZOOM API method to change the parent container back to normal
						jQuery.fn.axZm.fullScreenRelRestore(function() {
							// callback function 

							// Remove modal box and overlays that were added for expanded view
							jQuery('#azPlayerParentContainerWidget, #azWidgetOverlay').remove();

							// Remove the custom close button
							window.azWidgetVars.closeButton.remove();

							// Disable zoom 
							jQuery.axZm.disableZoom = true;
							jQuery.axZm.pinchZoomOnlyDrag = true;

							// Enable vertical page scroll on AJAX-ZOOM viewer events
							jQuery.axZm.touchPageScollDisable = false;
						});

					} 
				};

				// Create "product tour" buttons above semi-transparent overlay 
				// with spinTo & zoomTo features and manage title and descriptions if present
				window.azWidgetVars.manageLabels = function(spinName)
				{
					if (window.azWidgetVars.data && window.azWidgetVars.data[spinName]) {
						// Default description if present
						var defaultText = window.azWidgetVars.data[spinName]['default'];

						// Set the default titlte and descition
						if (defaultText) {
							window.azWidgetVars.title.html(defaultText.title);
							window.azWidgetVars.descr.html(defaultText.descr);
						}

						var nn = 0;
						var hasLabels = false;

						// Iterate over data and create "zoomTo && spinTo" buttons
						jQuery.each(window.azWidgetVars.data[spinName], function(key, val) {

							if (key != 'default') {
								hasLabels = true;
								nn++;
								var iVal = val;
								var iKey = key;

								jQuery('<div />')
								.addClass('azWidgetSpinToButton')
								.html(val.label || 'Label ' + nn)
								.bind('click', function() {
									// Insert title and description into placeholders
									window.azWidgetVars.title.html(iVal.title);
									window.azWidgetVars.descr.html(iVal.descr);

									// Parameters for zooming to a spot
									var zoomToParameters = {
										x1: iVal.coordinates[0],
										y1: iVal.coordinates[1],
										x2: iVal.coordinates[2],
										y2: iVal.coordinates[3]
									};

									jQuery.axZm.userFunc.onZoomSpinPanOnce = null;

									// Use AJAX-ZOOM API method to spin and zoom to a spot
									// example35_x use that method too but it is wraped into an extension
									jQuery.fn.axZm.spinTo(
										iKey, 
										750, 
										null, // easing
										function() {
											// Add a hook to remove the title and desciption of a spot 
											// when the user spins manually
											jQuery.fn.axZm.addCallback('onZoomSpinPanOnce', function() {
												if (window.azWidgetVars.title.length) {
													// Set "default" text for 360 if present
													if (defaultText && window.azWidgetVars.getSpinName() == spinName) {
														window.azWidgetVars.title.html(defaultText.title);
														window.azWidgetVars.descr.html(defaultText.descr);
													} else {
														window.azWidgetVars.title.empty();
														window.azWidgetVars.descr.empty();
													}
												}
											});
										}, // callback
										zoomToParameters
									);
								})
								.appendTo(window.azWidgetVars.spinTo);
							}
						});

						// Add "reset view" button
						if (defaultText && hasLabels) {
							jQuery('<div />')
							.addClass('azWidgetSpinToButton')
							.html(window.azWidgetVars.resetView)
							.bind('click', function() {
								if (jQuery.axZm.zoomID == 1) {
									// Cover the viewport
									jQuery.fn.axZm.fillArea({speed: 350});
								} else {
									// Use AJAX-ZOOM API method to spin and zoom to a spot
									// example35_x use that method too but it is wraped into an extension
									jQuery.fn.axZm.spinTo(
										1, // Frame number
										350,
										null, // easing
										function() {
											// Callback to cover the viewport
											jQuery.fn.axZm.fillArea({speed: 350});
										}, {
											// Zoom out
											x1: 0,
											y1: 0,
											x2: jQuery.axZm.ow,
											y2: jQuery.axZm.oh
										}
									);
								}
							})
							.appendTo(window.azWidgetVars.spinTo);
						}
					} else {
						// Remove loading message
						if (window.azWidgetVars.title.length) {
							window.azWidgetVars.title.empty();
							window.azWidgetVars.descr.empty();
						}
					}
				};

				// Clean semi-transparent overlay and add "loading" message
				window.azWidgetVars.overlayClear = function()
				{
					if (jQuery('.azWidgetCloseButton').length != 0) {
						window.azWidgetVars.changeOnExpanded = true;
						window.azWidgetVars.title.empty().html(azWidgetVars.pleaseWait);
						window.azWidgetVars.descr.empty();
						window.azWidgetVars.spinTo.empty();
					}
				};

				// Create semi-transparent overlay and other additional 
				// containers and elements for modal view
				window.azWidgetVars.setOverlay = function()
				{
					if (!window.azWidgetVars.expanded) {
						return;
					}

					if (!window.azWidgetVars.changeOnExpanded) {
						jQuery.axZm.pinchZoomOnlyDrag = false;

						// Add close button and bind "close" function to click event
						window.azWidgetVars.closeButton = jQuery('<div />')
						.addClass('azWidgetCloseButton')
						.appendTo('#axZm_zoomLayer')
						.bind('mouseup touchend', window.azWidgetVars.close);

						// Add semi-transparent overlay parent container
						window.azWidgetVars.overlay = jQuery('<div />')
						.attr('id', 'azWidgetOverlay')
						.appendTo('#axZm_zoomLayer')

						// Build inner container to semi-transparent overlay
						window.azWidgetVars.inner = jQuery('<div />')
						.attr('id', 'azWidgetOverlayInner');

						// Build outer container for title and description
						window.azWidgetVars.text = jQuery('<div />')
						.attr('id', 'azWidgetText')
						.appendTo(window.azWidgetVars.inner);

						// Container for title
						window.azWidgetVars.title = jQuery('<div />')
						.attr('id', 'azWidgetTitle')
						.appendTo(window.azWidgetVars.text);

						// Container for description
						window.azWidgetVars.descr = jQuery('<div />')
						.attr('id', 'azWidgetDescr')
						.appendTo(window.azWidgetVars.text);

						// Container for the buttons that trigger spin and zoom animations
						window.azWidgetVars.spinTo = jQuery('<div />')
						.attr('id', 'azWidgetSpinToContainer')
						.appendTo(window.azWidgetVars.inner);

						// Button to toggle semi-transparent overlay
						window.azWidgetVars.toggle = jQuery('<div />')
						.attr('id', 'azWidgetOverlayToggle')
						.html(window.azWidgetVars.showHide[1])
						.bind('click', function(e) {
							e.stopPropagation();
							if (window.azWidgetVars.overlay.is('.azWidgetOverlayHidden')) {
								// Remove CSS class that hides the overlay
								window.azWidgetVars.overlay
								.removeClass('azWidgetOverlayHidden');

								// Change text inside this button
								jQuery(this).html(window.azWidgetVars.showHide[1]);
							} else {
								// Add CSS class that hides the overlay
								window.azWidgetVars.overlay
								.addClass('azWidgetOverlayHidden');

								// Change text inside this button
								jQuery(this).html(window.azWidgetVars.showHide[0]);
							}
						})
						.appendTo(window.azWidgetVars.overlay);

						window.azWidgetVars.inner
						.appendTo(window.azWidgetVars.overlay);

						// Clone color swatches / 360 variants switches
						jQuery(window.azWidgetVars.variantsContainer)
						.clone(true, true)
						.attr('id', 'azWidgetSwatches')
						.appendTo(window.azWidgetVars.inner);
					}

					// Get identifier of the spin and change content
					var spinName = window.azWidgetVars.getSpinName();
					window.azWidgetVars.manageLabels(spinName);

					// Set zoom level to fit the area
					if (!window.azWidgetVars.changeOnExpanded){
						jQuery.fn.axZm.fillArea();
					}

					jQuery.axZm.fullScreenKeepZoom = {
						init: false,  
						restore: false,  
						resize: true
					};

					window.azWidgetVars.changeOnExpanded = false;

					// Disable vertical page scroll option
					jQuery.axZm.touchPageScollDisable = true;
				}

				// Create containers for the modal box
				window.azWidgetVars.createModalBox = function()
				{
					// Remove scrollbar on desktops if present
					jQuery('body').addClass('azWidgetBody');

					// Set a flag that we are in expanded mode
					window.azWidgetVars.expanded = true;

					// Enable zoom
					jQuery.axZm.disableZoom = false;

					// Disable page scroll with the mouse wheel
					jQuery.axZm.mouseScrollEnable = false;

					// Create new modal box container that is CSS only here
					var outerContainer = jQuery('<div />')
					.attr('id', 'azPlayerParentContainerWidget');

					// Create inner container for the modal box
					var innerContainer = jQuery('<div />')
					.attr('id', 'azPlayerParentContainerWidgetInner');

					// Append inner container to the outer container
					innerContainer.appendTo(outerContainer);

					// Append modal box container to body
					outerContainer.appendTo('body');

					// Change AJAX-ZOOM parent container!
					jQuery.fn.axZm.fullScreenRelChange('azPlayerParentContainerWidgetInner', function() {
						// callback function, executed after parent container of AJAX-ZOOM changes
						window.azWidgetVars.setOverlay();
					});
				}

				// AJAX-ZOOM callbacks / hooks
				var callbacks = {

					onBeforeStart: function() {
						// Enable scolling the page with the mouse wheel even if the mouse is over the viewer
						jQuery.axZm.mouseScrollEnable = true;
						jQuery.axZm.mouseScrollMsg.enable = false;

						// Some of the options can be set directly as js var in this callback, e.g. 
						jQuery.axZm.spinReverse = true;

						// Disable zoom, can be enabled or disabled whenever
						jQuery.axZm.disableZoom = true;

						// Disable native corner button for fullscreen
						jQuery.axZm.fullScreenCornerButton = false;

						// Enable "spin & drag" functionality for touch devices
						jQuery.axZm.spinAndDragTouch = true;

						// Disable zoom for pinch zoom (two fingers) and drag only
						jQuery.axZm.pinchZoomOnlyDrag = true;

						// Do not hide certain elements on tap
						jQuery.axZm.tapHideExcl.push('azWidgetOverlay', 'azWidgetCloseButton');

						// Manage autozoom
						jQuery.axZm.fullScreenKeepZoom = {
							init: false,
							restore: false,
							resize: false
						};

						// Keep rotate after spinning
						jQuery.axZm.spinKeepRotate = {
							enabled: true,
							swipeTime: 750, // define the duration of a swipe
							dbSwipeDelay: 750 // define interval between swipes for a double swipe
						};

						// Snap to key frames on spinning - type: array!
						// jQuery.axZm.spinSnapKeys = [53, 8, 23, 38];

					},

					onZoomInClickStart: function(info) {
						// info object contains some extremely useful information
						// console.log(info);

						// Exit if the product spin is not preloaded
						if (!jQuery.axZm.spinPreloaded) {
							return false;
						}

						// If already expanded into modal box, close the box and restore 360 view
						if (window.azWidgetVars.expanded === true) {
							// close on click
							window.azWidgetVars.close();
							return false;
						}

						// Open expanded view
						window.azWidgetVars.createModalBox();

						// Need to return false to prevent zoom. This is AJAX-ZOOM API requirement
						return false;
					},

					onLoad: function() {
						jQuery.axZm.fullScreenExitText = false;
					},

					// These callbacks are not needed
					// Uncomment if you want extend that code
					/*
					onDragEnd: function() {
						var viewPort = jQuery.fn.axZm.getLiveZoom(true);
						//console.log(viewPort);
					},

					onSpinEnd: function() {
						var viewPort = jQuery.fn.axZm.getLiveZoom(true);
						//console.log(viewPort);
					},

					onStopSpin: function() {
						var viewPort = jQuery.fn.axZm.getLiveZoom(true);
						//console.log(viewPort);
					}
					*/
				}

				// Trigger the AJAX-ZOOM viewer
				// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openResponsive
				if (window.azWidgetVars.firstSpinPath) {
					jQuery.fn.axZm.openResponsive(
						// Path to axZm folder; best set it as absolute path without domain (starting with /).
						'../axZm/',
						// This 360 product view opens first
						'3dDir=' + window.azWidgetVars.firstSpinPath + '&example=' + window.azWidgetVars.example,
						// Callbacks obhect that is defined above
						callbacks,
						// Parent container for AJAX-ZOOM viewer
						window.azWidgetVars.viewerParentContainer,
						true,
						true,
						false
					);
				} else {
					alert('Path for the first spin is not found');
				}
			});
		</script>

	</body>
</html>