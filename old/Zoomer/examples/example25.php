<!DOCTYPE html>
<html>
<head>
<title>25</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not really needed but some of css classes are used in this example -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM javascript & CSS -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css" id="exampleCss">
	/* container for image numbers and external prev / next buttons */
	#az_naviOuterContainer {
		padding-right: 170px;
		min-height: 50px;
		padding-bottom: 10px;
		position: relative;
	}

	/* hide image numbers and external prev / next buttons on small screen devices */
	@media (max-width: 800px) {
		#az_naviOuterContainer {
			display: none;
		}
	}

	/* container where buttons with image numbers are appended with js */
	#az_pageSwitchContainer {
		padding-top: 5px;
	}

	/* buttons with image numbers */
	.az_pageSwitchButtons {
		color: #FFFFFF;
		font-size: 12px;
		line-height: 20px;
		min-width: 30px;
		margin: 0 5px 5px 0;
		padding: 5px;
		display: inline-block;
		cursor: pointer;
		background-color: #1D1D1A;
		text-align: center;
		border-radius: 5px;
	}

	/* selected image number */
	.az_pageSwitchButtons.selected {
		background-color: #ff9800;
	}

	/* container with external prev / next buttons */
	.az_pagePrevNextContainer {
		position: absolute;
		top: 0;
		right: 0;
		font-size: 12px;
		color: #fff;
		padding-top: 5px;
	}

	/* container for title and description */
	#az_externalDescrContainer {
		min-height: 110px;
		padding: 7px 10px 10px 10px;
		background-color: #000;
	}

	/* the description container is appended to #axZm_zoomLayer at fullscreen mode
		it should be positioned absolute
	*/
	#axZm_zoomLayer #az_externalDescrContainer {
		position: absolute;
		box-sizing: border-box !important;
		pointer-events: none !important;
		width: 100%;
		bottom: 0;
		left: 0;
		z-index: 1;
		max-height: 30%;
		overflow: auto;
		background-color: rgba(0, 0 ,0, 0.5);
	}

	/* hide showing title when hovering gallery image at fullscreen mode */
	body>#zFsO #axZm_zoomDescrHolder {
		display: none !important;
	}

	/* container for description text */
	#az_descrDiv {
		min-height: 50px;
		font-size: 12px;
		color: #FFFFFF; 
	}

	#az_descrDiv a {
		color: #FFFFFF;
		font-weight: bolder;
	}

	/* container for title */
	#az_titleDiv {
		font-size: 18px;
		line-height: 20px;;
		color: #D3D3D3;
		padding-bottom: 10px;
	}

	/* make selected thumb look different */
	#axZm_zoomGallery li.selected {
		background-color: #fff !important;
		box-shadow: 0 0 0 4px #fff !important;
		border-radius: 4px !important;
	}
	

	/* Thumbnail description area */
	.axZmThumbSlider li .axZmThumbSlider_description {
		color: #FFF;
		background: #1f1f1c;
		border-radius: 0 0 3px 3px;
		padding-top: 2px;
	}

	.axZmThumbSlider li.selected .axZmThumbSlider_description {
		color: #444;
		background: #FFF;
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
		<div class="col-lg-12">
			<h1 class="page-header">AJAX-ZOOM - external description of the gallery images</h1>
			<p>At first glance this example seems to be a little overloaded. 
				It is however meant to show some possibilities of the API. 
				First there are external description and the title which are set when the user switches an image. 
				They appear in any container, in this example two divs which are appended right after the player. 
				Also the titles of the thumbs are set dynamically from external source. 
				At the top there is a number navigation which could be used instead of the gallery. 
				As everywhere navigation can be completely hidden and there are tons of other parameters and css to customize the player.
			</p>
		</div>
		<div class="col-lg-12">
			<!-- These number buttons and prev/next buttons are not essential -->
			<div id="az_naviOuterContainer">
				<!-- Container for numbers navigation-->
				<div id="az_pageSwitchContainer"></div>

				<!-- Container for prev / next buttons -->
				<div class="az_pagePrevNextContainer">
					<div class="az_pageSwitchButtons" onclick="jQuery.fn.axZm.zoomPrevNext('prev'); jQuery(this).blur();" style="margin-right: 5px; font-size: 28px;">&#171;</div>
					<div class="az_pageSwitchButtons" onclick="jQuery.fn.axZm.zoomPrevNext('next'); jQuery(this).blur();" style="font-size: 28px;">&#187;</div>
				</div>
			</div>

			<!-- embed-responsive and embed-responsive-item are -->
			<div class="embed-responsive" style="padding-bottom: 50%; border: #000 0px solid">
				<!-- Contaiener where AJAX-ZOOM is loaded into -->
				<div id="az_parentContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
					Loading, please wait...
				</div>
			</div>
	
			<!-- Contaiener for external description -->
			<div id="az_externalDescrContainerParent">
				<div id="az_externalDescrContainer"> 
					<div id="az_titleDiv"></div> 
					<div id="az_descrDiv"></div> 
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<h3>Javascript & CSS files in head</h3>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<!-- AJAX-ZOOM javascript & CSS -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />
			');
			echo '</code></pre>';
			?>

			<h3>Additional CSS for this example</h3>
			<pre><code class="language-css" id="exampleCssPrism"></code></pre>

			<h3>HTML markup in body</h3>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
<!-- These number buttons and prev/next buttons are not essential -->
<div id="az_naviOuterContainer">
	<!-- Container for numbers navigation-->
	<div id="az_pageSwitchContainer"></div>

	<!-- Container for prev / next buttons -->
	<div class="az_pagePrevNextContainer">
		<div class="az_pageSwitchButtons" onclick="jQuery.fn.axZm.zoomPrevNext(\'prev\'); jQuery(this).blur();" style="margin-right: 5px; font-size: 28px;">&#171;</div>
		<div class="az_pageSwitchButtons" onclick="jQuery.fn.axZm.zoomPrevNext(\'next\'); jQuery(this).blur();" style="font-size: 28px;">&#187;</div>
	</div>
</div>

<!-- embed-responsive and embed-responsive-item are -->
<div class="embed-responsive" style="padding-bottom: 50%; border: #000 0px solid">
	<!-- Contaiener where AJAX-ZOOM is loaded into -->
	<div id="az_parentContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
		Loading, please wait...
	</div>
</div>

<!-- Contaiener for external description -->
<div id="az_externalDescrContainerParent">
	<div id="az_externalDescrContainer"> 
		<div id="az_titleDiv"></div> 
		<div id="az_descrDiv"></div> 
	</div>
</div>
			');
			echo '</code></pre>';
			?>

			<h3>Javascript defining the descriptions</h3>
			<?php
			echo '<pre><code class="language-js">';
			echo htmlspecialchars ('
// Define js objects to store descriptions and titles
var testTitle = {}; // Object with titles
var testDescr = {}; // Object with longer descriptions
var thumbTitle = {}; // Object with thumb descriptions

// These descriptions as js could/should be generated with server side language...
testTitle["story_2_01.jpg"] = "Do to be agreeable conveying oh assurance.";
testDescr["story_2_01.jpg"] = "Its had resolving otherwise she contented therefore. Afford relied warmth out sir hearts sister use garden. Men day warmth formed admire former simple. Humanity declared vicinity continue supplied no an. He hastened am no property exercise of. Dissimilar comparison no terminated devonshire no literature on. Say most yet head room such just easy.";
thumbTitle["story_2_01.jpg"] = "Conveying";

testTitle["story_2_02.jpg"] = "Oh acceptance apartments up sympathize astonished delightful";
testDescr["story_2_02.jpg"] = "In no impression assistance contrasted. Manners she wishing justice hastily new anxious. At discovery discourse departure objection we. Few extensive add delighted tolerably sincerity her. Law ought him least enjoy decay one quick court. Expect warmly its tended garden him esteem had remove off. Effects dearest staying now sixteen nor improve.";
thumbTitle["story_2_02.jpg"] = "Impression";

	/* ....... */
			');
			echo '</code></pre>';
			?>

			<h3>Javascript additional functions and callbacks</h3>
			<pre><code class="language-js" id="exampleJsPrism"></code></pre>

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

<script type="text/javascript">
	// Define js objects to store descriptions and titles
	var testTitle = {}; // Object with titles
	var testDescr = {}; // Object with longer descriptions
	var thumbTitle = {}; // Object with thumb descriptions

	// These descriptions as js could/should be generated with server side language...
	testTitle["animals_001.jpg"] = "Do to be agreeable conveying oh assurance.";
	testDescr["animals_001.jpg"] = "Its had <a href='https://www.ajax-zoom.com'>resolving otherwise</a> she contented therefore. Afford relied warmth out sir hearts sister use garden. Men day warmth formed admire former simple. Humanity declared vicinity continue supplied no an. He hastened am no property exercise of. Dissimilar comparison no terminated devonshire no literature on. Say most yet head room such just easy.";
	thumbTitle["animals_001.jpg"] = "Conveying";
	
	testTitle["animals_002.jpg"] = "Oh acceptance apartments up sympathize astonished delightful";
	testDescr["animals_002.jpg"] = "In no impression assistance contrasted. Manners she wishing justice hastily new anxious. At discovery discourse departure objection we. Few extensive add delighted tolerably sincerity her. Law ought him least enjoy decay one quick court. Expect warmly its tended garden him esteem had remove off. Effects dearest staying now sixteen nor improve.";
	thumbTitle["animals_002.jpg"] = "Impression";
	
	testTitle["animals_003.jpg"] = "Its had resolving otherwise she contented therefore";
	testDescr["animals_003.jpg"] = "Far quitting dwelling graceful the likewise received building. An fact so to that show am shed sold cold. Unaffected remarkably get yet introduced excellence terminated led. Result either design saw she esteem and. On ashamed no inhabit ferrars it ye besides resolve. Own judgment directly few trifling. Elderly as pursuit at regular do parlors. Rank what has into fond she.";
	thumbTitle["animals_003.jpg"] = "Quitting";
	
	testTitle["animals_004.jpg"] = "Yet remarkably appearance get him his projection";
	testDescr["animals_004.jpg"] = "Spoke as as other again ye. Hard on to roof he drew. So sell side ye in mr evil. Longer waited mr of nature seemed. Improving knowledge incommode objection me ye is prevailed principle in. Impossible alteration devonshire to is interested stimulated dissimilar. To matter esteem polite do if.";
	thumbTitle["animals_004.jpg"] = "Appearance";
	
	testTitle["animals_005.jpg"] = "Why painful the sixteen how minuter looking nor";
	testDescr["animals_005.jpg"] = "Both rest of know draw fond post as. It agreement defective to excellent. Feebly do engage of narrow. Extensive repulsive belonging depending if promotion be zealously as. Preference inquietude ask now are dispatched led appearance. Small meant in so doubt hopes. Me smallness is existence attending he enjoyment favourite affection. Delivered is to ye belonging enjoyment preferred. Astonished and acceptance men two discretion. Law education recommend did objection how old.";
	thumbTitle["animals_005.jpg"] = "Painful";
	
	testTitle["animals_006.jpg"] = "Yourself off its pleasant ecstatic now law";
	testDescr["animals_006.jpg"] = "Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband. Are securing off occasion remember daughter replying. Held that feel his see own yet. Strangers ye to he sometimes propriety in. She right plate seven has. Bed who perceive judgment did marianne.";
	thumbTitle["animals_006.jpg"] = "Pleasant";
	
	testTitle["animals_007.jpg"] = "Extremely we promotion remainder eagerness enjoyment an";
	testDescr["animals_007.jpg"] = "As am hastily invited settled at limited civilly fortune me. Really spring in extent an by. Judge but built gay party world. Of so am he remember although required. Bachelor unpacked be advanced at. Confined in declared marianne is vicinity.";
	thumbTitle["animals_007.jpg"] = "Promotion";
	
	testTitle["animals_008.jpg"] = "Much evil soon high in hope do view";
	testDescr["animals_008.jpg"] = "Particular unaffected projection sentiments no my. Music marry as at cause party worth weeks. Saw how marianne graceful dissuade new outlived prospect followed. Uneasy no settle whence nature narrow in afraid. At could merit by keeps child. While dried maids on he of linen in.";
	thumbTitle["animals_008.jpg"] = "Eagerness";
	
	testTitle["animals_009.jpg"] = "Endeavor bachelor but add eat pleasure doubtful sociable";
	testDescr["animals_009.jpg"] = "His followed carriage proposal entrance directly had elegance. Greater for cottage gay parties natural. Remaining he furniture on he discourse suspected perpetual. Power dried her taken place day ought the. Four and our ham west miss. Education shameless who middleton agreement how. We in found world chief is at means weeks smile. ";
	thumbTitle["animals_009.jpg"] = "Limited";
	
	testTitle["animals_010.jpg"] = "Unpleasant astonished an diminution up partiality";
	testDescr["animals_010.jpg"] = "Ever man are put down his very. And marry may table him avoid. Hard sell it were into it upon. He forbade affixed parties of assured to me windows. Happiness him nor she disposing provision. Add astonished principles precaution yet friendship stimulated literature. State thing might stand one his plate. Offending or extremity therefore so difficult he on provision. Tended depart turned not are.";
	thumbTitle["animals_010.jpg"] = "Diminution";
	
	testTitle["animals_011.jpg"] = "Certainty listening no no behaviour existence assurance situation";
	testDescr["animals_011.jpg"] = "Are own design entire former get should. Advantages boisterous day excellence boy. Out between our two waiting wishing. Pursuit he he garrets greater towards amiable so placing. Nothing off how norland delight. Abode shy shade she hours forth its use. Up whole of fancy ye quiet do. Justice fortune no to is if winding morning forming.";
	thumbTitle["animals_011.jpg"] = "Existence";
	
	testTitle["animals_012.jpg"] = "Answer misery adieus add wooded how nay men before though";
	testDescr["animals_012.jpg"] = "As collected deficient objection by it discovery sincerity curiosity. Quiet decay who round three world whole has mrs man. Built the china there tried jokes which gay why. Assure in adieus wicket it is. But spoke round point and one joy. Offending her moonlight men sweetness see unwilling. Often of it tears whole oh balls share an.";
	thumbTitle["animals_012.jpg"] = "Objection";
	
	testTitle["animals_013.jpg"] = "In appetite ecstatic opinions hastened by handsome admitted";
	testDescr["animals_013.jpg"] = "Received overcame oh sensible so at an. Formed do change merely to county it. Am separate contempt domestic to to oh. On relation my so addition branched. Put hearing cottage she norland letters equally prepare too. Replied exposed savings he no viewing as up. Soon body add him hill. No father living really people estate if. Mistake do produce beloved demesne if am pursuit.";
	thumbTitle["animals_013.jpg"] = "Handsome";
	
	testTitle["animals_014.jpg"] = "Situation admitting promotion at or to perceived be";
	testDescr["animals_014.jpg"] = "Over fact all son tell this any his. No insisted confined of weddings to returned to debating rendered. Keeps order fully so do party means young. Table nay him jokes quick. In felicity up to graceful mistaken horrible consider. Abode never think to at. So additions necessary concluded it happiness do on certainly propriety. On in green taken do offer witty of.";
	thumbTitle["animals_014.jpg"] = "Perceived";
</script>

<script type="text/javascript" id="exampleJs">
	// Simple function to put descriptions in a div with fade effect
	function ajaxZoomAnimateDescr(title, descr) {
		jQuery("#az_titleDiv").fadeTo(200, 0, function() {
			$(this).empty().html(title).fadeTo(200, 1);
		});

		jQuery("#az_descrDiv").fadeTo(200, 0, function() {
			$(this).empty().html(descr).fadeTo(200, 1);
		})
	}

	// Set numbers navigation
	function ajaxZoomSetNumbers(){
		if (!jQuery.axZm) {
			return false;
		}

		jQuery("#az_pageSwitchContainer").empty();

		jQuery.each(jQuery.axZm.zoomGA, function (k, v) {
			jQuery("<div />")
			.addClass("az_pageSwitchButtons")
			.html(k)
			.attr("id", "az_pageSwitchButtons_" + k)
			.bind("click", function() {
				jQuery.fn.axZm.zoomSwitch(k)
			})
			.appendTo("#az_pageSwitchContainer");
		});
	}

	// Define ajaxZoom object
	var ajaxZoom = {};

	// Path to the axZm folder, adjust if needed
	ajaxZoom.path = "../axZm/"; 

	// Parameter passed to AJAX-ZOOM
	ajaxZoom.parameter = "zoomDir=/pic/zoom/animals&example=25";

	// The id of the DIV where ajax-zoom has to be inserted into.
	ajaxZoom.divID = "az_parentContainer";

	// AJAX-ZOOM callbacks
	ajaxZoom.opt = {
		onLoad: function() {
			// Get loaded image name, as not necessarily the first image 
			// must be loaded at first into the gallery
			var getImgName = jQuery.axZm.zoomGA[jQuery.axZm.zoomID]["img"];

			// Set title and description
			ajaxZoomAnimateDescr(testTitle[getImgName], testDescr[getImgName]);

			// Set numbers navigation
			ajaxZoomSetNumbers();

			// Select first number
			jQuery("#az_pageSwitchButtons_"+jQuery.axZm.zoomID).addClass("selected");

			// Enable thumbnails description
			jQuery.axZm.galleryThumbDescr = true;
		},
		onVertGalLoaded: function() {
			// Set titles of the thumbs in the gallery
			// jQuery.fn.axZm.setDescr is API function of AJAX-ZOOM
			jQuery.each(thumbTitle, function (fName, descr) {
				jQuery.fn.axZm.setDescr(fName, testTitle[fName], descr);
			});
		},
		onImageChange: function(info){
			/* Set title and description on image change
			Note: there are many variations possible, e.g. the descriptions could be loaded
			via ajax request, you could extend this example to change the image sets like in example4.php
			*/
			var getImgName = jQuery.axZm.zoomGA[jQuery.axZm.zoomID]["img"];

			// testTitle[info.fileName]
			ajaxZoomAnimateDescr(testTitle[getImgName], testDescr[getImgName]);
			jQuery(".az_pageSwitchButtons").removeClass("selected");
			jQuery("#az_pageSwitchButtons_"+jQuery.axZm.zoomID).addClass("selected");
		},
		onFullScreenStartFromRel: function() {
			// append container with title and description to the player
			jQuery("#az_externalDescrContainer").appendTo("#axZm_zoomLayer");
		},
		onFullScreenCloseFromRel: function() {
			// put container with title and description back to the initial position
			jQuery("#az_externalDescrContainer")
			.css({display: "block", visibility: "visible"})
			.appendTo("#az_externalDescrContainerParent");
		}
	};

	// open AJAX-ZOOM responsive
	// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
	jQuery.fn.axZm.openResponsive(
		ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
		ajaxZoom.parameter, // Defines which images and which options set to load
		ajaxZoom.opt, // callbacks
		ajaxZoom.divID, // target - container ID (default 'window' - fullscreen)
		false, // apiFullscreen- use browser fullscreen mode if available
		true, // disableEsc - prevent closing with Esc key
		false // postMode - use POST instead of GET
	);
</script>

<script>
	// this is just for the demo
	$('#exampleJsPrism').html($('#exampleJs').html());
	$('#exampleCssPrism').html($('#exampleCss').html());
</script>

</body>
</html>