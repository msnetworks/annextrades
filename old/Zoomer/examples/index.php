<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Examples overview</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

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
				width: 11.5%;
				margin: 0 1% 1% 0;
				padding: 5px;
			}

			.exampleImg:hover{
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
				background-color: rgba(0,0,0,0.8); 
				padding: 0px 3px 1px 3px;
				border: #FFF 2px solid;
				color: #FFF;
				display: inline-block;
				text-decoration: none;
				position: absolute;
				top: 0px;
				right: 0px;
			}

			.container-fluid {
				overflow: hidden;
				padding-right: 1%;
				padding-left: 1%;
			}

			@media (max-width: 1920px) {
				.exampleImg {
					width: 15.6666%;
				}
			}

			@media (max-width: 1500px) {
				.container-fluid {
					padding-right: 15px;
					padding-left: 15px;
				}
			}

			@media (max-width: 1680px) {
				.exampleImg {
					width: 19%;
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

			@media screen and (max-width: 768px) {
				.aze_example_navi_container {
					height: 42px;
				}
				.aze_example_navi_buttons {
					width: 32px;
					height: 32px;
				}
			}
		</style>

	</head> 
	<body>
		<div class="aze_example_navi_container">
			<div style="padding: 5px 0px 0px 5px">
				<a href="https://www.ajax-zoom.com" rel="nofollow"><img class="aze_example_navi_buttons" title="HOME" alt="HOME" src="../axZm/icons/home-icon.png"></a>
				<a href="https://www.ajax-zoom.com/index.php?cid=download" rel="nofollow"><img class="aze_example_navi_buttons" title="Download AJAX-ZOOM" alt="Download AJAX-ZOOM" src="../axZm/icons/download_48x48.png"></a>
				<a href="https://www.ajax-zoom.com/index.php?cid=docs" rel="nofollow"><img class="aze_example_navi_buttons" title="Documentaion" alt="Documentaion" src="../axZm/icons/docu_48x48.png"></a>
				<a href="https://www.ajax-zoom.com/index.php?cid=contact" rel="nofollow"><img class="aze_example_navi_buttons" title="Ask a question" alt="Ask a question" src="../axZm/icons/support_48x48.png"></a>
			</div>
		</div>

		<div class="container-fluid">
			<h2>AJAX-ZOOM examples overview</h2>
			<div class="exampleImgOuter">
				<?php
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

				$files = scandir(dirname(__FILE__));
				$files = natIndex($files, false);
				$prevNum = '';
				$num = '';
				$n = 0;

				if (!empty($files)) {

					foreach ($files as $k => $file) {

						if (strstr($file, 'example') && strstr($file, 'php') && $file != 'example1.php') {
							if ($num) {
								$prevNum = $num;
							}

							$num = intval(str_replace(array('example', '.php'), '', basename($file)));

							$n++;

							$bbb = explode('_',basename($file),2);

							if ($bbb[1]) {
								$bbb[1] = str_replace('.php','',$bbb[1]);
							}

							if ($bbb[1]) {
								$thumbName = 'image-zoom_'.$num.'_'.$bbb[1].'.jpg';
							} else {
								$thumbName = 'image-zoom_'.$num.'.jpg';
							}

							$exampleThumb = 'example_files/img/'.$thumbName;
							if (!file_exists(dirname(__FILE__).'/'.$exampleThumb)) {
								$exampleThumb = 'example_files/img/noimage.png';
							}

							$isVario = basename($file) == 'example33_vario.php';

							echo '<a href="'.basename($file).($isVario ? '?zoomDir=/pic/zoom/animals' : '').'" class="exampleImg" rel="nofollow">
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
	</body>
</html>