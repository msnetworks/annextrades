<!doctype html>
<html>
<head>
<title>34</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- jQuery core -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM CSS && JS-->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- Include thumbSlider CSS && JS -->
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<!-- JSON library 
<script type="text/javascript" src="../axZm/plugins/JSON/jquery.json-2.3.min.js"></script>
-->

<!-- Auto suggest -->
<link type="text/css" href="../axZm/plugins/demo/jquery.autoSuggest/jquery.autoSuggest.css" rel="stylesheet" />
<script type="text/javascript" src="../axZm/plugins/demo/jquery.autoSuggest/jquery.autoSuggest.js"></script>
 
<!-- Set of functions for OCR example -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.hotspotOCR.js"></script>

<!-- Some styles for this specific example -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.hotspotOCR.css" />

<style type="text/css">
	html {margin: 0; padding: 0; border: 0;}
	body {margin: 0; padding: 0;}
</style>

</head>
<body>

<!-- Change #header css height to make this DIV visible -->
<div id="header"></div>

<!-- Left part of the page -->
<div id="nav">
	<?php 
	include ('navi.php');
	?>	
	<div style="padding: 7px; color: #FFFFFF; min-height: 82px">
		<!-- Heading text for autosuggest field -->
		<div style="font-size: 18px; margin-bottom: 3px;">Search for a word in newspaper</div>
		
		<!-- Autosuggest field -->
		<div id="hotspotList">
			<input type="text" value="Loading autosuggest" id="autoSuggestField" disabled>
		</div>
		
		<!-- Checkbox for searching a word on current page -->
		<input type="checkbox" style="vertical-align: middle;" value="1" id="autoSuggestPageSearch" onclick="jQuery.azOcr.pageSearchToggle('autoSuggestPageSearch')" /> - only on current page
	</div>
	
	<div id="hotspotCoordParent" style="color: #FFFFFF; position: relative;">
		<!-- Some text which will be removed after first search -->
		<div id="someTextLeft">
			<p style="margin-top: 0">The autosuggest search field above takes the data from any XML or HTML files which contain OCR data. 
			The data is loaded over /axZm/zoomLoadOCR.php and returns JSON data suited to this example.  
			</p>
			<p>Currently zoomLoadOCR.php supports two schemes: "hOCR" and "ALTO". 
			However it can be easily extended to process any other structured OCR data, 
			whereby the data could be also taken from a database and not necessarily flat files.
			</p>
			<p>For "hOCR" you could use a "free" Apache 2.0 licensed 
			<a href="https://en.wikipedia.org/wiki/Tesseract_%28software%29" rel="nofollow" target="_blank">tesseract-ocr</a> sofware 
			(ver. 3.0+) to process your images containing text and retrieve positions of the words in "hOCR" format 
			which are then instantly saved in html files.
			</p>
			<p>At <a href="https://www.ajax-zoom.com/examples/example34.php" target="_blank">ajax-zoom.com</a> 
			this example is based on images courtesy of "Biblioth&egrave;que royale de Belgique" and the OCR data scheme is "ALTO". 
			In the download package the OCR data is "hOCR" made with "tesseract".
			</p>

			<p>Please note that unlike in most other examples several transitions are either disabled or accelerated here. 
			Ofcourse these and many other settings can be simply adjusted in the config file 
			"/axZm/zoomConfigCustom.inc.php" 
			after <code>elseif ($_GET['example'] == 'ocr'){</code>
			</p>
			
			<p>In general this example can be used as a basis for more sophisticated applications 
			extendable with AJAX-ZOOM API and other scripts. 
			On <a href="https://www.ajax-zoom.com/index.php?cid=contact" target="_blank">request</a> 
			any customizing or integration task can be partly or fully done by AJAX-ZOOM team. 
			</p>
			
			<p>Test: load different content (images) and ocr data without reloading the page.<br>
				<input type="button" style="margin-left: 0" value="Load" onclick="$.azOcr.changeOCRcontent('zoomDir=../examples/data/example34/pic', '../examples/data/example34/xml', 'hOCR')"/>
			</p>
			<p>[Last updated: 2015-03-02]
			</p>
		</div>
		
		<!-- Div where buttons with words will be added with JS -->
		<div id="hotspotCoord" style="width: 100%;"></div>
	</div>
</div>

<!-- Div where AJAX-ZOOM will be loaded into -->
<div id="content" style="position: relative">
	<!-- The below div will be removed once AJAX-ZOOM is loaded -->
	<div style="padding:20px; color: #000000; font-size: 16pt">Loading, please wait...</div>
</div>

<!-- Div where we put the AJAX-ZOOM toolbar into -->
<div id="footer">
	<div id="mNaviParentContainer" style="margin: 0px auto;"></div>
</div>

<script type="text/javascript">

jQuery(document).ready(function($){

	// Function to adjust responsive layout of this page with JS
	window.adjustHeight = function(){
		var header = $('#header'),
			footer = $('#footer'),
			hotspotCoordParent = $('#hotspotCoordParent'),
			nav = $('#nav'),
			content = $('#content'),
			otherDivsHeight = 0;
		
		
		var contentHeight = (window.innerHeight ? window.innerHeight : $(window).height()) - header.outerHeight() - footer.outerHeight() - 1;
		var contentWidth = $(window).innerWidth() - nav.outerWidth() - parseInt(nav.css('left'));
		
		content.css({
			height: contentHeight, 
			width: contentWidth
		});
		
		nav.css({
			height: contentHeight + footer.outerHeight()
		});
		
		footer.css({
			width: contentWidth - parseInt(footer.css('paddingLeft')) - parseInt(footer.css('paddingRight'))
		});
		
		// Set height of hotspotCoordParent to enable scroller for overflow
		$('#nav > div:not(#hotspotCoordParent, .zoomToHotspotMenuSlideAway)').each(function(){
			otherDivsHeight += $(this).outerHeight();
		});
		
		hotspotCoordParent.css('height', contentHeight + footer.outerHeight() - otherDivsHeight - parseInt(hotspotCoordParent.css('paddingTop')) - parseInt(hotspotCoordParent.css('paddingBottom')) - 7);
		
		window.scrollTo(0,0);
	};
	
	// Adjust layout after page is loaded
	adjustHeight();
	
	// Adjust layout on browser resize
	$(window).bind('resize', adjustHeight);
	
	// Init the slider on possibly too long content in the navigation bar
	$('#hotspotCoordParent').axZmThumbSlider({
	 	contentMode: true,
	 	orientation: 'vertical',
	 	btn: false,
		centerNoScroll: false,
		outerWrapPosition: 'absolute',
		contentStyle: {background: 'none', padding: 0, paddingLeft: 17, paddingRight: 7},
		scrollbar: true, 
		scrollbarOpacity: 0.85,
		scrollbarIdleOpacity: 0.5,
		scrollbarStyle: {left: -2, right: ''},
		scrollbarBarStyle: {backgroundColor: 'red', width: 2},
		scrollbarTrackStyle: {background: 'none'},
		wrapStyle: {borderWidth: 0}	
	});	
	
	// Some var to hold the following settings
	window.ajaxZoom = {};

	// Define the path to the axZm folder, adjust the path if needed!
	ajaxZoom.path = '../axZm/';
	
	// Div ID where AJAX-ZOOM will be loaded into
	ajaxZoom.divID = 'content';
	
	// Define your custom parameter query string
	// zoomDir=/path/to/the/folder - best use absolute path to the folder with the images
	ajaxZoom.parameter = 'zoomDir=../examples/data/example34/pic/';
	
	// Define your custom parameter query string
	// example=archive has several presets for this layout, 
	// changeable in /axZm/zoomConfigCustom.inc.php
	ajaxZoom.example = "example=ocr"
	
	// Path to the folder with OCR data
	// The files are processed with /axZm/zoomLoadOCR.php (adjustable if needed!)
	// Best use absolute path to the folder with the images
	ajaxZoom.ocrFilesPath = '../examples/data/example34/xml/';
	
	// At the moment possible values are:
	// hOCR: https://docs.google.com/document/d/1QQnIQtvdAC_8n92-LhwPcjtAUFwBlzE8EWnKAxlgVf0/preview?pli=1
	// ALTO: https://schema.ccs-gmbh.com/ALTO, https://www.loc.gov/ndnp/alto_1-1-041.xsd
	// For hOCR there is a "free" software to proceed images and get text positions: https://code.google.com/p/tesseract-ocr/wiki/ReadMe
	ajaxZoom.ocrSchema = 'hOCR'; 
	
	// AJAX-ZOOM callbacks
	ajaxZoom.ajaxZoomCallbacks = {
		
		onLoad: function(){
			// Load OCR data
			$.azOcr.loadOCRjson(
				// path to the file which returns data for the hotspots
				ajaxZoom.path+'zoomLoadOCR.php', 
				
				 // posted parameters
				'ocrFilesPath='+ajaxZoom.ocrFilesPath+'&ocrSchema='+ajaxZoom.ocrSchema, 
				
				// you could pass e.g. "?search=someWord" as parameter over query string to this page 
				// if someWord is present it will be instantly selected
				$.azOcr.getParameterByName('search')
			);
			
			// Add a button to show / hide navi layer to the left in this page layout
			$.azOcr.addHideDiv();
		},
		onVertGalLoaded: function(){
			// Set names for vertical gallery thumbs
			$.each($.axZm.zoomGA, function(k, v){
				$('#zoomGalDescr_'+k).html('Page '+k+'<span style="padding: 0px 2px 0px 2px">/</span>'+$.axZm.numGA);
			});
		},
		onFullGalLoaded: function(){
			// Set names for full gallery thumbs
			$.each($.axZm.zoomGA, function(k, v){
				$('#zoomFullGalDescr_'+k).html('Page '+k+' ['+v.ow+' x '+v.oh+' px]');
			});
			
			// Filter images where a word has been found and hide where not
			$.azOcr.filterFullGallery();
		},
		onBeforePrevNext: function(arr){
			// Filter images when clicked on prev / next buttons
			return $.azOcr.filterPrevNext(arr);
		}
	};

	// Start splash
	window.fullScreenStartSplash = {'enable': true, 'className': false, 'opacity': 0.75};
	
	// Use API $.fn.axZm.openFullScreen to open AJAX-ZOOM in this responsive layout
	$.fn.axZm.openFullScreen(
		ajaxZoom.path, // Path to AJAX-ZOOM directory
		ajaxZoom.parameter+'&'+ajaxZoom.example, // Query string to determin which images to load
		ajaxZoom.ajaxZoomCallbacks, // JS object containing callback functions
		ajaxZoom.divID, // Target: on default the target is browser window. You can optionally set some other container ID (e.g. "myAzResponsiveContainer") if needed.
		true, // use browser fullscreen mode if available
		true, // prevent closing with Esc key
		true // set AJAX-ZOOM to use POST instead of GET 
	);
	
});
</script>

</body>
</html>