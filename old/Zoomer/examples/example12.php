<!DOCTYPE html>
<html>
<head>
<title>12</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

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

<style type="text/css" media="screen"> 
	/* cursor in tagging mode */
	.azTagging {cursor: crosshair !important;}

	/* title textfield */
	.azTextField {width: 100%; margin-bottom: 5px; box-sizing: border-box !important; padding: 5px; font-family: arial; font-size: 12px; border: 1px solid #999999; border-radius: 3px;}

	/* description textarea */
	.azTextArea {width: 100%; height: 100px; box-sizing: border-box !important; padding: 5px; background-color: #FFF; font-family: arial; font-size: 12px; border: 1px solid #999999; border-radius: 3px;}

	/* save, delete button */
	.azButton {margin-top: 5px;}

	/* message about click to place a hotspot */
	.azTaggingMsg {position: absolute; background-color: #B50904; width: 290px; margin-left: -140px; top: -1px; left: 50%; border: #000 1px solid; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; font-size: 11px; color: #FFF; padding: 1px 5px 1px 5px; z-index: 1; pointer-events: none;}

	/* parent container for navigation (mNavi) */
	.azCustomNavi{background-color: #AAA; box-sizing: border-box; height: 58px; padding: 4px 0px 4px 0px; border-left: #000 1px solid; border-bottom: #000 1px solid; border-right: #000 1px solid;}

	/* html console */
	.azTaggingResults{background-color: #101010; color: #3cc628; padding: 5px; margin: 0; height: 489px; overflow: hidden; overflow-y: auto;}
	.azPre{tab-size: 2; -moz-tab-size: 2; margin: 0; font-size: 11px; font-family: monospace; padding: 5px; background-color: transparent; color: #3cc628; border-width: 0;}

	/* Overwrite css from /axZm/jquery.axZm.js */
	.axZmToolTipInner {background-color: #c5d8e1; border-color: #5583b4; border-width: 3px;}

	.axZmToolTipTitle {color: #FFF; /* #1a4a7a*/ font-size: 16px; line-height: 18px; min-height: 24px; text-shadow: 0px 0px 2px rgba(150, 150, 150, 0.75);}

	.axZm_zoomCustomNaviParentID {margin: 0 auto;}

	#axZm_zoomLogHolder {width: 55px;}

	@media (max-width: 520px) {
		#axZm_zoomCustomNavi img {
			height: 33.3px !important;
			width: 33.3px !important;
		}
		#azCustomNavi {
			height: 42px !important;
			overflow: hidden;
		}
	}
</style>

</head>
<body>

<?php include 'navi.php';?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">AJAX-ZOOM (for developers)<br />tagging images with hotspots, adding title and description;<br />
				"createNewHotspot" API tutorial;
			</h1>
			<p>Ver. 4.2.1 - the old example got obsolete and has been replaced with a tutorial 
				for developers of how to add "tags" to the images and let the users add title and description. 
			</p>

			<p>Click somewhere on the image to create a hotspot. You can drag & drop it to adjust the position. 
				Click on the hotspot to add / read title and description. 
				You can right click on the hotspot to remove it (can be disabled).
			</p>
		</div>

		<div class="col-md-7">
			<div class="embed-responsive" style="padding-bottom: 80%; border: #000 1px solid">
				<!-- Div where AJAX-ZOOM is loaded into -->
				<div id="azParentContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
					Loading, please wait...
				</div>
			</div>
			<!-- Parent container for "mNavi" -->
			<div id="azCustomNavi" class="azCustomNavi"></div>
		</div>

		<div class="col-md-5">
			<div id="azTaggingResults" class="azTaggingResults">>> HTML console</div>
		</div>

		<div class="col-md-12">
			<!-- Bla. bla -->
			<h3>About</h3>
			<p style="margin-top: 0;">This snippet is not ment to represent a final or complete solution! 
				So the output of tagging is displayed in the "HTML console". 
				Normally you would be saving the resulted JSON to a file, database, push to another persons display or perform 
				some other fancy stuff with it. For example in a Digital-Asset-Management system the marketing manager 
				could assign a task to edit the image in a certain way...
				If you need cross-origin communication please google for "window.postMessage"; 
			</p>

			<p>As mentioned above this AJAX-ZOOM snippet is for developers who would like 
				to extend and finish this code customizing it for their own needs. 
				If you have a distinguished idea but do not want or do not have time to complete, 
				you can ask AJAX-ZOOM team for a quote to do it for you.
			</p>

			<h3>JavaScript ans CSS in head</h3>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

		<!-- JSON -->
		<script type="text/javascript" src="../axZm/plugins/JSON/jquery.json-2.3.min.js"></script>

		<!--  AJAX-ZOOM javascript -->
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
		<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />
			');
			echo '</code></pre>';
			?>

			<h3>CSS</h3>
			<?php
			echo '<pre><code class="language-css">';
			echo htmlspecialchars ('
/* cursor in tagging mode */
.azTagging {cursor: crosshair !important;}

/* title textfield */
.azTextField {width: 100%; margin-bottom: 5px; box-sizing: border-box !important; padding: 5px; font-family: arial; font-size: 12px; border: 1px solid #999999; border-radius: 3px;}

/* description textarea */
.azTextArea {width: 100%; height: 100px; box-sizing: border-box !important; padding: 5px; background-color: #FFF; font-family: arial; font-size: 12px; border: 1px solid #999999; border-radius: 3px;}

/* save, delete button */
.azButton {margin-top: 5px;}

/* message about click to place a hotspot */
.azTaggingMsg {position: absolute; background-color: #B50904; width: 290px; margin-left: -140px; top: -1px; left: 50%; border: #000 1px solid; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; font-size: 11px; color: #FFF; padding: 1px 5px 1px 5px; z-index: 1; pointer-events: none;}

/* parent container for navigation (mNavi) */
.azCustomNavi{background-color: #AAA; box-sizing: border-box; height: 58px; padding: 4px 0px 4px 0px; border-left: #000 1px solid; border-bottom: #000 1px solid; border-right: #000 1px solid;}

/* html console */
.azTaggingResults{background-color: #101010; color: #3cc628; padding: 5px; margin: 0; height: 489px; overflow: hidden; overflow-y: auto;}
.azPre{tab-size: 2; -moz-tab-size: 2; margin: 0; font-size: 11px; font-family: monospace; padding: 5px; background-color: transparent; color: #3cc628; border-width: 0;}

/* Overwrite css from /axZm/jquery.axZm.js */
.axZmToolTipInner {background-color: #c5d8e1; border-color: #5583b4; border-width: 3px;}

.axZmToolTipTitle {color: #FFF; /* #1a4a7a*/ font-size: 16px; line-height: 18px; min-height: 24px; text-shadow: 0px 0px 2px rgba(150, 150, 150, 0.75);}

.axZm_zoomCustomNaviParentID {margin: 0 auto;}

#axZm_zoomLogHolder {width: 55px;}
			');
			echo '</code></pre>';
			?>

			<h3>HTML in body</h3>
			<p style="margin-top: 0;">azTaggingResults shows JSON created after placing the hotspots, so it is not needed in your final code
			</p>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
<div class="embed-responsive" style="padding-bottom: 80%; border: #000 1px solid">
	<!-- Div where AJAX-ZOOM is loaded into -->
	<div id="azParentContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
		Loading, please wait...
	</div>
</div>
<!-- Parent container for "mNavi" -->
<div id="azCustomNavi" class="azCustomNavi"></div>

<!-- Console -->
<div id="azTaggingResults" class="azTaggingResults">>> HTML console</div>
	');
			echo '</code></pre>';
			?>

			<h3>Javascript</h3>
			<p style="margin-top: 0;">Every line is commented... The whole code could be ofcourse wraped into external JS. 
				If after all you have any questions regarding AJAX-ZOOM - do not hesitate to contact us.
			</p>
			<?php
			echo '<pre><code class="language-js" id="exampleJsPrism"></code></pre>';
			?>

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
	// some var to hold everyting else
	window.ajaxZoom = {};

	// the ID of the div element where ajax-zoom has to be inserted into
	ajaxZoom.divID = "azParentContainer";	

	// path to the axZm folder
	ajaxZoom.path = "../axZm/"; 

	// zoomData - defines which image should be loaded
	ajaxZoom.parameter = "zoomData=/pic/zoom/furniture/furniture_005.jpg";

	// example - defines which "options set" is taken
	// options in /axZm/zoomConfig.inc.php are overriden in /axZm/zoomConfigCustom.inc.php  
	// after elseif ($_GET['example'] == 'tagging'){
	ajaxZoom.parameter += "&example=tagging";

	// Local time ahead server time (PHP solution), not needed, you can set timeDiff to 0
	ajaxZoom.timeDiff = (new Date()).getTime() - <?php echo round(microtime(true)*1000) ?>;

	// switch for tagging mode
	ajaxZoom.taggingMode = true;

	// some var where we will store user defined title and description
	ajaxZoom.myTags = {};

	// define some text strings
	ajaxZoom.taggingTxt = {
		"msg": "&raquo; click somewhere to place a hotspot; right-click to remove",
		"disable": "Disable tagging mode",
		"enable": "Enable tagging mode",
		"title": "Title",
		"description": "Description",
		"confirmDelete": "Really delete?",
		"notes": "Notes",
		"noDescr": "No notes left"
	};

	// add tagging message and manage other tasks when tagging mode is enabled
	ajaxZoom.setTaggingMsg = function() {
		// append tagging message 
		if (!$("#azTaggingMsg").length) {
			$("<div />").attr("id", "azTaggingMsg").addClass("azTaggingMsg")
			.html(ajaxZoom.taggingTxt.msg)
			.appendTo("#axZm_zoomLayer");
		}else{
			$("#azTaggingMsg").css("display", "block");
		}

		// change cursor
		$("#axZm_zoomLayerImg").addClass("azTagging");

		// change src and description of the custom button which changes states
		$("#customBtn_mCustomBtn1")
		.data("btnSrc", $.axZm.icon + $.axZm.buttonSet + "/button_iPad_tag_switched.png")
		.data("bAlt", ajaxZoom.taggingTxt.disable)
		.attr("src", $.axZm.icon + $.axZm.buttonSet + "/button_iPad_tag_switched.png");

		// make hotspots draggable
		$.fn.axZm.hotspotsDraggable();
	};

	// hide tagging message and manage other tasks when tagging mode is disabled
	ajaxZoom.removeTaggingMsg = function() {
		// hide tagging message
		$("#azTaggingMsg").css("display", "none");

		// remove class which changed the cursor
		$("#axZm_zoomLayerImg").removeClass("azTagging");

		// change src and description of the custom button which changes states
		$("#customBtn_mCustomBtn1")
		.data("btnSrc", $.axZm.icon + $.axZm.buttonSet + "/button_iPad_tag.png")
		.data("bAlt", ajaxZoom.taggingTxt.enable)
		.attr("src", $.axZm.icon + $.axZm.buttonSet + "/button_iPad_tag.png");

		// make hotspots not traggable any more
		$.fn.axZm.hotspotsDraggable(true);

		// close all opened tooltips
		$.fn.axZm.removeAllToolTips();
	};

	// function which will be executed in onZoomInClickStart AJAX-ZOOM callback
	// important is that when you do not want AJAX-ZOOM to zoom, this function should return false;
	ajaxZoom.evaluateClick = function(info) {
		// do not do anything if ajaxZoom.taggingMode (a switch var) is false
		if (!ajaxZoom.taggingMode) {
			return;
		}

		// position of the click related to its original size
		var xClick = info.viewport.x;
		var yClick = info.viewport.y;

		// file (image) name
		var currentImageName = $.axZm.zoomGA[$.axZm.zoomID].img;

		// position of the hotspot in this file
		// there could be same hotspot on an image in the gallery, 
		// this is why we need image name here and it is defined this way
		var posObj = {}; posObj[currentImageName] = {left: xClick, top: yClick};

		// show hotspots in case they are disabled
		$.fn.axZm.showHotspotLayer();

		// after we know the position create hotspot "on-the-fly"
		$.fn.axZm.createNewHotspot({
			// generate some image name 
			// image name could contain the creation date and time
			// you might also want to get it from server before creating hotspot 
			// or calculate the difference between server time and client time as it is done here
			// prepend the hotspot name with some random string anyway
			name: Math.random().toString(36).substring(2) + "_" + ((new Date()).getTime() - ajaxZoom.timeDiff), 
			autoTitle: false, // we do not want alt title to be like hotspot name
			autoPos: false, // we know at wich positions to put hotspot at (posObj)
			noInit: false, // we want that the hotspot is added right away
			draggable: true, // and it should be draggable
			noRightClickRemove: false, // could be removed with right mouse click
			posObj: posObj, // our coordinates
			settings: {
				shape: "point", // shape is point (not rect)
				altTitle: false, // mouseover title is disabled
				labelGravity: "bottom", // position of the title shown as label
				labelOffsetY: -2, // vertical offset of the label
				hotspotImage: "hotspot64_map_red.png", // default image from /axZm/icons
				gravity: "top", // important - display hotspot image above the click point
				width: 32, // width of the icon
				height: 32, // height of the icon

				/* tooltip settings */
				toolTipWidth: 300, // width of the tooltip
				toolTipHeight: 120, // min-height of the tooltip
				toolTipGravity: "left", // show tooltip left to the hotspot
				toolTipAutoFlip: true, // but also right depending on position
				toolTipAdjustX: 25, // horizontal space between hotspot and toolTip
				toolTipCloseIcon: "close-32-EA0000.png", // close button icon from /axZm/icons
				toolTipCloseIconWidth: 16,
				toolTipCloseIconHeight: 16,
				toolTipCloseIconOffset: {right: 5, top: 5}, // position of the close button
				toolTipOverlayShow: false, // do not show overlayes

				// toolTipTitle can be also a JS function 
				toolTipTitle: ajaxZoom.toolTipTitle,

				// toolTipHtml can be also a JS function which returns something
				toolTipHtml: ajaxZoom.toolTipHtml
			},
			// callback after hotspot is added
			callback: function(info) {
				// we have created the hotspot so update ajaxZoom.myTags
				ajaxZoom.myTags[info.name] = {};

				// save / update console
				ajaxZoom.updateConsole();

				// trigger tooltip after it has been added
				// if you remove the line below the user would need to extra click on the hotspot
				$("#axZmHotspot_"+info.name).trigger("click");
			}
		});

		// important to return false; otherwise AJAX-ZOOM will zoom
		return false; 
	};

	// delete hotspot wrapper
	ajaxZoom.deleteHotspot = function(name) {
		// ask if the user wants to delete the hotspot
		var sureDelete = window.confirm(ajaxZoom.taggingTxt.confirmDelete);
		if (sureDelete) {
			// delete hotspot
			$.fn.axZm.deleteHotspot(name);
			
			// close all tooltips
			$.fn.axZm.removeAllToolTips();
		}
	};

	// title which is shown in the popup when the user clicks on the hotspot
	ajaxZoom.toolTipTitle = function(info) {
		// we simply return a string but it could be extended
		return ajaxZoom.taggingTxt.notes;
	};

	// html which is shown in the popup when the user clicks on the hotspot
	ajaxZoom.toolTipHtml = function(info) {
		// get already prsent information sored in ajaxZoom.myTags
		var myTags = ajaxZoom.myTags[info.name] || {},
			ret = ""; // empty string

		// if tagging mode return form fields
		if (ajaxZoom.taggingMode) {
			// simple form
			ret = "<div>";
				// title
				ret += "<input type=\"text\" id=\"azTextField\" class=\"azTextField\" value=\"" + (info.labelTitle || ajaxZoom.taggingTxt.title) + "\">";

				// description
				ret += "<textarea id=\"azTextArea\" class=\"azTextArea\">" + (myTags.descr || ajaxZoom.taggingTxt.description) + "</textarea>";

				// name of the hotspot
				ret += "<input id=\"azTextHotspotName\" type=\"hidden\" value=\"" +info.name + "\">";

				// save and delete buttons
				ret += "<div style=\"text-align: right\">";
					ret += "<input type=\"button\" class=\"azButton\" value=\"Delete\" onclick=\"ajaxZoom.deleteHotspot('" + info.name + "');\">";
					ret += "<input type=\"button\" class=\"azButton\" value=\"Save\" onclick=\"ajaxZoom.saveInfo()\">";
				ret += "</div>";
			ret += "</div>";

			setTimeout(function() {
				// Prevent bubbling when clicked on the textarea
				$("#azTextArea, #azTextField").on("mousedown touchstart", function(e) {
					e.stopPropagation();
				});

				// Show names of the form fields within formfields and remove them on focus
				$("#azTextField")
				.on("focus", function(e) {
					if ($(this).val() == ajaxZoom.taggingTxt.title) {
						$(this).val("");
					}
				})
				.on("blur", function(e) {
					if ($(this).val() == "") {
						$(this).val(ajaxZoom.taggingTxt.title);
					}
				});

				$("#azTextArea").on("focus", function(e) {
					if ($(this).val() == ajaxZoom.taggingTxt.description) {
						$(this).val("");
					}
				})
				.on("blur", function(e) {
					if ($(this).val() == "") {
						$(this).val(ajaxZoom.taggingTxt.description);
					}
				});
			}, 100);
		}

		// return when tagging mode is disabled
		else {
			// Calculate time from hotspot name (if not changed)
			var time = info.name.split("_")[1];

			// Date from Unix timestamp
			var date = new Date(parseInt(time));

			// Return what is stored in ajaxZoom.myTags.descr
			ret = "<div class='azTextArea'>"+(myTags.descr || ajaxZoom.taggingTxt.noDescr)+"</div>\
			Created: " + date + "\
			";
		}

		return ret;
	};

	// store description and title under ajaxZoom.myTags 
	ajaxZoom.saveInfo = function() {
		// read values from formfields 
		var name = $("#azTextHotspotName").val();
		var title = $("#azTextField").val();
		var descr = $("#azTextArea").val();

		// calculate date and time
		var time = (new Date()).getTime() - ajaxZoom.timeDiff;

		// create new / emtty object under ajaxZoom.myTags
		ajaxZoom.myTags[name] = {};

		// store description from formfields
		if (descr != ajaxZoom.taggingTxt.description) {
			ajaxZoom.myTags[name].descr = descr;
			ajaxZoom.myTags[name].lastChanged = time;
		}

		// store title from formfields
		if (title != ajaxZoom.taggingTxt.title) {
			ajaxZoom.myTags[name].title = title;
			ajaxZoom.myTags[name].lastChanged = time;

			// Update label title
			$.axZm.hotspots[name].labelTitle = title;

			// Redraw hotspot with $.fn.axZm.initHotspots and make them draggable again
			$.fn.axZm.initHotspots(null, $.fn.axZm.hotspotsDraggable);
		}

		// close tooltip
		$.fn.axZm.removeAllToolTips();

		// save / update console
		ajaxZoom.updateConsole();
	};

	// save / update console function 
	// this is the function which you would need to extend
	ajaxZoom.updateConsole = function() {
		var json = {};

		// eterate over ajaxZoom.myTags and gather information you would like to store
		$.each(ajaxZoom.myTags, function(name, obj) {
			if ($.axZm.hotspots[name] 
				&& $.axZm.hotspots[name]["position"] 
				&& !$.isEmptyObject($.axZm.hotspots[name]["position"])
			) {
				json[name] = {
					title: obj.title,
					descr: obj.descr,
					timestamp: obj.lastChanged,
					position: $.fn.axZm.convertHotspotPositionToPx($.axZm.hotspots[name]["position"][$.axZm.zoomID])
				};
			}
		});

		// here we simply visually show that created json without any other action
		$("#azTaggingResults").html("<pre class='azPre'>" + JSON.stringify(json, null, "\t")+"</pre>");

		// todo: for example save it to session and restore when loaded	
	};

	// AJAX-ZOOM callbacks
	ajaxZoom.opt = {
		// some (not all) options from /axZm/zoomConfig.inc.php and 
		// from /axZm/zoomConfigCustom.inc.php 
		// could be set in this "onBeforeStart" callback
		onBeforeStart: function() {
			// Remove hotspot entirely when right clicked on it
			// normally it is only disabled on the current image
			$.axZm.hsRightClickDel = true;

			// Do not zoom out at 100% on click
			$.axZm.zoomOutClick = false;

			// enable and configure the "mNavi" option
			// which is the toolbar below the player or in the player
			$.axZm.mNavi.enabled = true; // enable it
			$.axZm.mNavi.parentID = "azCustomNavi"; // set ID where it has to be appended to
			$.axZm.mNavi.buttonDescr = true; // enable description of the buttons
			$.axZm.mNavi.alt.enabled = false; // disable description simmilar to alt
			$.axZm.mNavi.fullScreenShow = true; // also show "mNavi" at fullscreen mode
			$.axZm.mNavi.offsetVertFS = 10; // vertical offset of mNavi at fullscreen mode

			// this is a list of buttons which we want to show in the toolbar
			// number value is margin to the next button
			$.axZm.mNavi.order = {
				mZoomOut: 5, // zoom out button
				mZoomIn: 20, // zoom in button
				mReset: 20, // reset button
				mPan: 5, // pan mode button
				mCrop: 20, // crop mode button
				mHotspots: 5, // show / hide hotspots button
				mCustomBtn1: 0 // our "whatever" button
			};

			// there can be as many "whatever" (custom) buttons as you want
			// call them mCustomBtn1, mCustomBtn2, ...

			// now we define how this mCustomBtn1 should look like
			$.axZm.icons.mCustomBtn1 = {file: $.axZm.buttonSet + "/button_iPad_tag", ext: "png", w: 50, h: 50};

			// and the title of mCustomBtn1
			$.axZm.mapButTitle.customBtn1 = ajaxZoom.taggingTxt.disable; // description of the button

			// attach a JS function to the mCustomBtn1
			$.axZm.mNavi.mCustomBtn1 = function() {
				// when tagging mode is already on, disable it
				if (ajaxZoom.taggingMode == true) {
					// Update state of the tagging mode
					ajaxZoom.taggingMode = false;
					
					// Do other things
					ajaxZoom.removeTaggingMsg();
				}
				// enable tagging mode
				else {
					// Update state of the tagging mode
					ajaxZoom.taggingMode = true;
					
					// Do other things
					ajaxZoom.setTaggingMsg();
				}
			};
		},

		// when image loads
		onLoad: function() {
			// Add message that tagging mode is activated and activate it
			ajaxZoom.setTaggingMsg();
		},

		// callback executed on any hotspot deletion over API
		onHotspotDelete: function(name) {
			// Save / update console
			ajaxZoom.updateConsole();
		},

		// callback triggered after hotspot is moved
		onHotspotsDragEnd: function() {
			// Save / update console
			ajaxZoom.updateConsole();
		},

		// callback triggered when the user clicks on the image
		onZoomInClickStart: function(info) {
			return ajaxZoom.evaluateClick(info);
		}
	};

	// open AJAX-ZOOM responsive
	// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
	$(document).ready(function() {
		$.fn.axZm.openResponsive(
			ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
			ajaxZoom.parameter, // Defines which images and which options set to load
			ajaxZoom.opt, // callbacks
			ajaxZoom.divID, // target - container ID (default 'window' - fullscreen)
			false, // apiFullscreen- use browser fullscreen mode if available
			true, // disableEsc - prevent closing with Esc key
			false // postMode - use POST instead of GET
		);
	});

</script>

<script>
	$('#exampleJsPrism').html($('#exampleJs').html());
</script>
</body>
</html>