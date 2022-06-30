<?php
/**
* Plugin: jQuery AJAX-ZOOM
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: https://www.ajax-zoom.com/index.php?cid=download
* Version: 5.3.10
* Date: 2019-02-07
* Review: 2019-02-07
* URL: https://www.ajax-zoom.com
* License: https://www.ajax-zoom.com/index.php?cid=download
* Documentation: https://www.ajax-zoom.com/index.php?cid=docs
*/

error_reporting(0);

function makeLink($string) {
	$string = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i", "$1https://$2", $string);
	$string = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<a target=\"_blank\" rel=\"nofollow\" href=\"$1\">$1</A>", $string);
	$string = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<a href=\"mailto:$1\">$1</a>", $string);
	return $string;
}

function readtxt($f) {
	$return = '';
	$filename = $f;
	$ini_handle = fopen($filename, "r");
	$return = fread($ini_handle, filesize($filename));
	$return = nl2br($return);
	return makeLink($return);
}

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

function getIonCubeVersion() {
	if (function_exists('ioncube_loader_iversion')) {
		$liv = ioncube_loader_iversion();
		$lv = sprintf("%d.%d.%d", $liv / 10000, ($liv / 100) % 100, $liv % 100);
		return $lv;
	} else {
		return '';
	}
}
?>
<!DOCTYPE html>
<html itemscope="itemscope" itemtype="https://schema.org/WebPage">
	<head>
		<title>AJAX-ZOOM Demo Installation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<link rel="stylesheet" href="examples/example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="examples/example_files/css/examples.css" type="text/css">

		<style type="text/css"> 
			.exampleImgOuter {
				position: relative;
				margin: 10px -1% 10px 0;
			}

			.exampleImg {
				border: #ddd 1px solid;
				box-sizing: border-box !important;
				display: inline-block;
				position: relative;
				cursor: pointer;
				width: 24%;
				margin: 0 1% 1% 0;
				padding: 5px;
			}

			.exampleImg:hover {
				border-color: #0191ff;
			}

			.exampleImgDiv {
				box-sizing: border-box !important;
				height: 0;
				font-size: 12px;
				padding-bottom: 56.33%;
				background-repeat: no-repeat;
				background-position: center;
				background-size: contain;
				overflow: hidden;
			}

			.exampleHead {
				background-color: #000;
				background-color: rgba(0, 0, 0, 0.8);
				padding: 0px 3px 1px 3px;
				border: #FFF 2px solid;
				color: #FFF;
				display: inline-block;
				text-decoration: none;
				position: absolute;
				top: 0px;
				right: 0px;
			}

			@media (max-width: 1920px) {
				.exampleImg {
					width: 32.3333%;
				}
			}

			@media (max-width: 1280px) {
				.exampleImg {
					width: 49%;
				}
			}

			@media (max-width: 1200px) {
				.exampleImg {
					width: 24%;
				}
			}

			@media (max-width: 1024px) {
				.exampleImg {
					width: 31.3333%;
					margin: 0 2% 2% 0;
				}
				.exampleImgOuter {
					margin: 10px -2% 10px 0;
				}
			}

			@media (max-width: 768px) {
				.exampleImg {
					width: 48%;
					margin: 0 2% 2% 0;
				}
			}

			@media (max-width: 375px) {
				.exampleImg {
					width: 99%;
					margin: 0 2% 2% 0;
				}
			}

			.aze_example_navi_container {
				height: 58px;
				overflow: hidden;
				width: 100%;
				box-sizing: content-box !important;
				background-color: #808080;
			}

			.aze_example_navi_buttons {
				width: 48px;
				height: 48px;
				margin-bottom: 5px;
				margin-left: 5px;
				border: none;
			}

			.readme{
				-ms-word-break: break-all;
				word-break: break-all;
				word-break: break-word;
				-webkit-hyphens: auto;
				-moz-hyphens: auto;
				hyphens: auto;
			}

			.container-fluid {
				overflow: hidden;
			}
		</style>

		<script type="text/javascript" src="axZm/plugins/jquery-1.8.3.min.js"></script>

	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<h1>AJAX-ZOOM Demo Installation</h1>
					<?php
					echo 'PHP: ' . PHP_VERSION .'<br>';
					echo 'OS: ' . PHP_OS .'<br>';
					echo 'Safe mode: ' . (ini_get('safe_mode') ? 'true' : 'false').'<br>';
					echo 'Sapi: ' . PHP_SAPI .'<br>';
					if (getIonCubeVersion()) {
						echo 'Ioncube loader version: '. getIonCubeVersion().'<br>';
					}

					if (ini_set("memory_limit", "128M") === false) {
						echo '<span style="color: red">Warning: AJAX-ZOOM will be not able to change memory_limit with ini_set() and make image tiles for very large images</span><br>';
					}

					if (ini_set("max_execution_time", "90") === false) {
						echo '<span style="color: red">Warning: AJAX-ZOOM will be not able to set max_execution_time with ini_set() dynamically and make image tiles for very large images </span><br>';
					}

					if (defined('PHALANGER') && file_exists('readme.ASP.NET.txt')) {
						echo '<h2>readme.ASP.NET.txt</h2>';
						echo '<div>';
						echo readtxt(dirname(__FILE__).'/readme.ASP.NET.txt');
						echo '</div>';
					}

					echo '<h2>Readme.txt</h2>';
					echo '<div class="readme">';
					if (file_exists(dirname(__FILE__).'/readme.txt')) {
						echo readtxt(dirname(__FILE__).'/readme.txt');
					} else if (file_exists(dirname(__FILE__).'/axZm/readme.txt')) {
						echo readtxt(dirname(__FILE__).'/axZm/readme.txt');
					} else {
						echo 'readme.txt is not present...';
					}

					echo '</div><br><br>';

					// Some tests
					$error = '';
					$warning = '';
					$info = '';

					if (!defined('PHALANGER')) {
						$php_version = phpversion();

						if (intval($php_version) < 5) {
							$error = '<li>You need PHP 5 to run AJAX-ZOOM. Currently you are running PHP version: '.$php_version.'</li>';
						}

						if (!function_exists('gd_info')) {
							$error .= '<li>GD Lib is not installed on your server. AJAX-ZOOM needs it to operate properly.</li>';
						}

						$extensions = get_loaded_extensions();
						$ionCube = false;
						foreach ($extensions as $k => $v) {
							if (stristr($v, 'ioncube')) {
								$ionCube = true;
							}
						}

						if (!$ionCube) {
							if (!ini_get('enable_dl')) {
								$error .= '<li>It seems that ionCube is not installed and 
								because dynamically loaded extensions aren\'t enabled it is essential to take care about this problem!!! 
								</li>';
							} else {
								$error .= '<li>It seems that ionCube is not installed on your server. ';
							}

							$error .= '
							Please make sure Ioncube is installed. You can download the loaders and 
							the "Loader Wizard" (PHP script to help with installation) for free at 
							<a href="https://www.ioncube.com/loaders.php" rel="nofollow" target="_blank">https://www.ioncube.com/loaders.php</a>
							';

							$error .= '</li>';
						} else {
							// check ioncube version
							$ionCubeVersion = getIonCubeVersion();
							if (version_compare($ionCubeVersion, '4.4', '<')) {
								$error .= '<li>Your Ioncube loader version ('.$ionCubeVersion.') is too old. You need at least 4.4. Please install a newer version.
								</li>';
							}
						}

						if ($error) {
							echo '<h2>Error</h2>';
							echo '<div style="border-color: red" class="alert"><ul>'.$error.'</ul></div>';
						}

						if ($warning) {
							echo '<h2>Warning</h2>';
							echo '<div style="border-color: orange" class="alert"><ul>'.$warning.'</ul></div>';
						}

						if ($info) {
							echo '<h2>Info</h2>';
							echo '<div style="border-color: gray" class="alert"><ul>'.$info.'</ul></div>';
						}
					}

					if (!$error) {
						?>
						<h2 style="color: green">Congratulations</h2>
						<div style="border-color: green" class="alert">
							AJAX-ZOOM should run on this server. In case you get an error stating, 
							that images could not be found or broken layout, 
							please open /axZm/zoomConfig.inc.php and set these options manually:<br><br>
							<ul>
								<li><a href="https://www.ajax-zoom.com/index.php?cid=docs#installPath" rel="nofollow" target="_blank">$zoom['config']['installPath']</a><br><br>
									Replace:<br>
									$zoom['config']['installPath'] = $axZmH->installPath();<br><br>
									with:<br>
									$zoom['config']['installPath'] = '';<br>
									or if the path to your application is '/shop', then set:
									$zoom['config']['installPath'] = '/shop';<br><br>
								</li>

								<li><a href="https://www.ajax-zoom.com/index.php?cid=docs#fpPP" rel="nofollow" target="_blank">$zoom['config']['fpPP']</a><br><br>
									Server root path to www directory, 
									e.g. '/srv/www/htdocs/web123' or '/home/yourdomain/public_html'. 
									Usually it is $_SERVER['DOCUMENT_ROOT']; without slash at the end. 
									Set this option manually if it does not produce correct results!<br><br>
								</li>

								<li><a href="https://www.ajax-zoom.com/index.php?cid=docs#rewriteBase" rel="nofollow" target="_blank">$zoom['config']['rewriteBase']</a><br><br>
									Ver. 4.2.11+ remove a part of the string (path) passed to AJAX-ZOOM from an application. 
									Usefull if e.g. rewriteBase in htaccess is set the way that AJAX-ZOOM gets wrong paths for images 
									e.g. Bitnami Magento and XAMPP on localhost, the path in the browser is 
									http://192.168.178.27/magento, then the setup for making AZ extension work would be: <br>
									$zoom['config']['fpPP'] = 'C:/xampp/apps/magento/htdocs';<br>
									$zoom['config']['urlPath'] = '/magento/js/axzoom';<br>
									$zoom['config']['rewriteBase'] = '/magento';<br>
								</li>
							</ul>
							<br>

							<?php
							if (ini_get('safe_mode')) {
								echo '<div style="border-color: red" class="alert">
								Attention - PHP "Safe Mode" is enabled!<br><br>
								One known issue with safe_mode is that when AJAX-ZOOM creates subfolders and tries to put image tiles for each image in them, 
								the subfolders are created, but because of save_mode turned on it is not allowed to write in them. 
								You could try to solve this problem by changing the owner of AJAX-ZOOM files and folders. Mostly the FTP owner and PHP owner are different.
								</div><br><br>';
							}
							?>
						</div>

						<h3>Reading this will save your time and protect your nerves</h3>
						<p>Each example in the download package uses a special configuration options set. 
							Default options in "/axZm/zoomConfig.inc.php" are overridden in "/axZm/zoomConfig<b>Custom</b>.inc.php" which is included at the bottom of "zoomConfig.inc.php". 
							That happens by passing an extra parameter "<b>example=</b>[some value]" to AJAX-ZOOM directly from examples or plugins over the query string. 
							To find out which "example" value is used see the source code of the implementation in question or inspect 
							an ajax call to "/axZm/zoomLoad.php" with Firebug or another ther developer tool. 
							Thus your specific options set can be found in "zoomConfigCustom.inc.php" after 
							<code>elseif ($_GET['example'] == [some value]) { </code>
							Please note that the value of example parameter passed over the query string to AJAX-ZOOM does <b>not</b> correspond to the number of an example 
							found in /examples folder of the download package. 
						</p>
						<p>Because AJAX-ZOOM is updated very frequently and its options base grows accordingly, 
							the best practice is to copy options you need to change from "zoomConfig.inc.php" to "zoomConfigCustom.inc.php" 
							after  <code>elseif ($_GET['example'] == [some value]) { </code>. 
							Of course, you can create your own [some value] in "zoomConfigCustom.inc.php". 
							By keeping "zoomConfig.inc.php" as it is (<code>$zoom['config']['licenceKey']</code> and <code>$zoom['config']['licenceType']</code> can be copied as well 
							at the beginning of zoomConfigCustom.inc.php before the if statement to serve all examples) 
							you will be able to update your customized implementation by simply overwriting all files except "zoomConfigCustom.inc.php" and custom CSS file. 
						</p>
						<div class="alert alert-info">Ver. 4.3.1+ you can also create zoomConfigCustomAZ.inc.php file and place it outside of /axZm directory (same level). 
							This way you could place your custom configurations in this file and overwrite whole /axZm directiry during future updates.
						</div>
						<p>You can read more and in greater detail about the AJAX-ZOOM configuration system at this page: <br>
							<a href="https://www.ajax-zoom.com/index.php?cid=blog&article=options_config&lang=en" rel="nofollow">
								https://www.ajax-zoom.com/index.php?cid=blog&article=options_config&lang=en
							</a>
						</p>

						<h3>Skinning</h3>
						<p>In order to change the button template into your own (skin AJAX-ZOOM) 
							simply set <a href="https://www.ajax-zoom.com/index.php?cid=docs#buttonSet" rel="nofollow" target="_blank">$zoom['config']['buttonSet']</a> option, 
							create a subfolder under /axZm/icons/[yourTemplate] and put your buttons into it (copy them from /axZm/icons/default at first). 
							Also create a new CSS file in /axZm/styles/[yourTemplate]/style.css; if needed adjust the width and height of the buttons 
							(w and h keys) by editing corresponding $zoom['config']['icons'] array, <br>e.g. 
							$zoom['config']['icons']['pan'] = array('file'=>'zoombutton_pan', 'ext'=>'jpg', 'w' => <span style="color: red">31</span>, 'h'=><span style="color: red">31</span>); <br><br>
							For CSS colors an so on you can change 
							<a href="https://www.ajax-zoom.com/index.php?cid=docs#themeCss" rel="nofollow" target="_blank">$zoom['config']['themeCss']</a> option; 
							If you want to create your own, e.g. "green", create subdirectory /axZm/themes/green and place axZm_green.css into this folder. 
							You could copy / rename CSS file from e.g. /axZm/themes/white and then change the colors of your axZm_green.css; 
							Do not forget to set $zoom['config']['themeCss'] = 'green'; then...
						</p>
						<div class="alert alert-warning">Important: in the CSS file (/axZm/axZm.css) please do not add any width, height, margin or other "px" values, 
							unless they are already present there and you just want to change them! Since/axZm/axZm.css is updated from time to time as well, 
							you can override CSS classes in /axZm/axZmCustom.css (add !important if needed) and / or in 
							/axZm/styles/default/style.css; The default style is "default".
						</div>

						<h3>360 & 3D info</h3>
						<h4>VERY IMPORTANT THINGS TO TAKE ACCOUNT OF WITH 360 OR 3D</h4>
						<p>Every image must have a unique filename!!! This is also the case if images are prepared for completely different 360s or 3D; 
							If all your source images happen to have the same filenames (e.g. spin001.jpg, spin002.jpg, [...], spin036.jpg), 
							you could then prefix each image of a spin e.g. with the product ID or something else logical 
							to ensure this uniqueness, e.g.
						</p>

						/360_source_images/123/123_spin001.jpg, <br>
						/360_source_images/123/123_spin002.jpg, <br>
						/360_source_images/123/123_spin003.jpg, <br>
						[...], <br>
						/360_source_images/123/123_spin036.jpg <br><br>

						<h4>3D (MULTIROW / SPHECICAL)</h4>
						<p>The only difference between regular 360 spin and multirow is that original images are placed in subfolders of the target folder. 
							E.g. the path along with the example parameter passed to AJAX-ZOOM is "example=spinIpad&3dDir=/pic/zoomVR/nike"; 
							Now if it is 3D (multirow) and not 360, then images of each row are placed in subfolders of the target 3dDir parameter, 
							e.g. /pic/zoomVR/nike/0, /pic/zoomVR/nike/15, /pic/zoomVR/nike/30, /pic/zoomVR/nike/45, 
							/pic/zoomVR/nike/60, /pic/zoomVR/nike/75, /pic/zoomVR/nike/90; 
							It is not important how these subfolders are named (e.g. it could be row1, row2 ...) and you also do not need to define these subfolder names anywhere. 
							AJAX-ZOOM will instantly detect them and process all the images in them. For more info and visualization of the 
							file structure see <a href="examples/example28.php" rel="nofollow">example28.php</a>
						</p>

						<h3>Batch processing images</h3>
						<p>AJAX-ZOOM is designed to create all needed images like thumbs and tiles on-the-fly. 
							However, if you have thousands of images, it is a good idea to batch process all existing images planned to be shown over AJAX-ZOOM before launching it. 
							You can do it in <a href="axZm/zoomBatch.php" rel="nofollow">/axZm/zoomBatch.php</a>; 
							To access this file, you will need to open it with an editor and set your personal password in it.
						</p>

						<div style="text-align: right; margin-top: 30px">Have fun with AJAX-ZOOM</div>
					<?php
					}
					?>
				</div>
				<div class="col-lg-6">
					<h1>Local Examples</h1>
					<p>Local examples do not contain high-resolution images. 
						Please find these and other examples with high-resolution images at 
						<a href="https://www.ajax-zoom.com/index.php?cid=examples" rel="nofollow" target="_blank">https://www.ajax-zoom.com/index.php?cid=examples</a>
					</p>
					<div class="exampleImgOuter">
						<?php
						$files = scandir(dirname(__FILE__).'/examples');
						$files = natIndex($files, false);

						$prevNum = '';
						$num = '';
						$n = 0;
						if (!empty($files)) {
							foreach (array_reverse($files, true) as $k => $file) {
								if (strstr($file,'example') && strstr($file,'php') && $file != 'example1.php') {
									if ($num) {
										$prevNum = $num;
									}

									$num = intval(str_replace(array('example','.php'),'',basename($file)));
									$n++;

									$bbb = explode('_',basename($file), 2);
									if (isset($bbb[1])) {
										$bbb[1] = str_replace('.php', '', $bbb[1]);
									}

									if (isset($bbb[1])) {
										$thumbName = 'image-zoom_'.$num.'_'.$bbb[1].'.jpg';
									} else {
										$thumbName = 'image-zoom_'.$num.'.jpg';
									}

									$exampleThumb = 'examples/example_files/img/'.$thumbName;
									if (!file_exists(dirname(__FILE__).'/'.$exampleThumb)) {
										$exampleThumb = 'examples/example_files/img/noimage.png';
									}

									$isVario = basename($file) == 'example33_vario.php';

									echo '<a rel="nofollow" href="examples/'.basename($file).($isVario ? '?zoomDir=/pic/zoom/animals' : '').'" class="exampleImg" target="_blank">
										<div class="exampleImgDiv" style="background-image: url('.$exampleThumb.')">
											<div class="exampleHead">'.basename($file).'</div>
										</div>
									</a>';
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<script>
			if (document.location.hostname == 'localhost') {
				setTimeout(function() {
					alert('You are using "localhost"! \n\nThis might cause problems like jerky behaviour / animations and AJAX-ZOOM not functioning correctly in general.\nPlease use 127.0.0.1 instead!');
				}, 3000);
			}
		</script>
	</body>
</html>