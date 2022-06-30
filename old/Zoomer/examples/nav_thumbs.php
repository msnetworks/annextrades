<?php 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
<title>Other AJAX-ZOOM examples</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- jQuery core, needed if not already present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- Include axZm.thumbSlider plugin -->
<link rel="stylesheet" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" type="text/css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<style type="text/css">
	html {font-family: Tahoma, Arial; font-size: 10pt;}
	body {margin: 0 <?php echo isset($_GET['footerMargin']) ? $_GET['footerMargin'] : 0; ?>px 0 <?php echo isset($_GET['footerMargin']) ? $_GET['footerMargin'] : 0; ?>px; padding: 0; overflow: hidden;}
	.moreExamples {
		color: #1a4a7a;
		font-size: 18px;
		font-family: Arial;
		font-weight: bold;
		margin: 0 0 5px 0;
		padding-left: 0px;
	}

	.axZmThumbSlider div.label {
		font-size: 10px;
	}

	.axZmThumbSlider li img.thumb {
		margin-bottom: 10px;
		border: #CCCCCC 1px solid;
	}

	.axZmThumbSlider_scrollbar.horizontal .track {
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}

	.h3 {
		font-size: 24px;
		color: rgb(51, 51, 51);
		margin-top: 20px;
		margin-bottom: 10px;
	}
</style>
</head>

<body unselectable="on">
	<?php
	if (!function_exists('natIndex')) {
		function natIndex($array, $reverse) {
			$i = 1;
			$nArray = array();
			natcasesort($array);
			if ($reverse) {
				$array = array_reverse($array);
			}

			foreach ($array as $k => $v) {
				$nArray[$i] = $v;
				$i++;
			}

			return $nArray;
		}
	}
	?>
	<div style="height: 20px;"></div>
	<div class="<?php echo isset($_GET['bootstrap']) ? 'h3' : 'moreExamples';?>" style="<?php echo (isset($_GET['sliderWidth']) ? ('width: '.$_GET['sliderWidth'].'; margin: 0 auto;') : '100%;');?>">Other AJAX-ZOOM examples</div>
	<div id="slider1" style="width: <?php echo (isset($_GET['sliderWidth']) ? ($_GET['sliderWidth'].'; margin: 0 auto;') : '100%;');?> height: 125px; position: relative;">
		<ul style="display: none">
			<?php
			$files = scandir(dirname(__FILE__));
			$files = natIndex($files, false);
			$prevNum = '';
			$num = '';
			$n = 0;

			if (!empty($files)) {
				foreach ($files as $k => $file) {
					if (strstr($file,'example') && strstr($file,'php')){
						if ($num) {
							$prevNum = $num;
						}

						$num = intval(str_replace(array('example','.php'), '', basename($file)));

						$n++;
						$bbb = explode('_', basename($file), 2);
						if (isset($bbb[1])) {
							$bbb[1] = str_replace('.php','',$bbb[1]);
						}

						if (isset($bbb[1])) {
							$thumbName = 'image-zoom_'.$num.'_'.$bbb[1].'.jpg';
						} else {
							$thumbName = 'image-zoom_'.$num.'.jpg';
						}

						$exampleThumb = 'example_files/img/'.$thumbName;
						if (!file_exists(dirname(__FILE__).'/'.$exampleThumb)) {
							$exampleThumb = 'example_files/img/noimage.png';
						}

						$isVario = basename($file) == 'example33_vario.php';

						echo "<li id=\"thumb_".basename($file, ".php")."\" onclick=\"parent.location.href='".basename($file).($isVario ? '?zoomDir=/pic/zoom/animals' : '')."'\"><img src='".$exampleThumb."'><div class=\"label\">".basename($file)."</div></li>";
					
					}
				}
			}
			?>
		</ul>
	</div>

	<script type="text/javascript">
	$('#slider1').axZmThumbSlider({
		thumbLiStyle: {
			//backgroundSize: 'contain', //contain, cover
			width: 160, 
			height: 105,
			lineHeight: '85px',
			borderRadius: 0
		},
		thumbImgStyle: {
			width: 150,
			height: 85,
			marginBottom: 10
		},
		btnBwdStyle: {
			borderRadius: 0,
			lineHeight: '125px',
			//borderLeftWidth: 0,
			width: 30
		},
		btnFwdStyle: {
			borderRadius: 0,
			lineHeight: '125px',
			//borderRightWidth: 0,
			width: 30
		},
		scrollbarMargin: 100,
		scrollbarOffset: 15,
		scrollbarIdleOpacity: 0,
		scrollbarOpacity: 1,
		wrapStyle: {
			backgroundColor: '#FFF'
		},
		debugNumbers: false,
		scrollbar: true,
		firstThumb: $('#thumb_<?php echo basename($_GET['ref'], '.php');?>'),
		firstThumbPos: 'middle',
		firstThumbTriggerClick: false,
		firstThumbHighlight: true
	});
	</script>
</body>
</html>