<?php
error_reporting(0);

if (!function_exists('natIndex')) {
	function natIndex($array, $reverse) {
		$i=1;
		$nArray=array();
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

$prevFile = false;
$nextFile = false;
$filesExamples = scandir(dirname(__FILE__));
$filesExamples = natIndex($filesExamples, false);
$arrayExamples = array();
$currentExample = basename($_SERVER['PHP_SELF']);
$currentIndex = 0;
$n = 0;

if (!empty($filesExamples)) {
	foreach ($filesExamples as $k => $file) {
		$baseName = basename($file); 
		if (!stristr($baseName, 'vario')) {
			if (strstr($file,'example') && strstr($file,'.php')) {
				$n++; 
				$arrayExamples[$n] = $baseName;
				if ($currentExample == $baseName){
					$currentIndex = $n;
				}
			}
		}
	}
}

if (isset($arrayExamples[$currentIndex - 1])) {
	$prevFile = $arrayExamples[$currentIndex - 1];
}
if (isset($arrayExamples[$currentIndex + 1])) {
	$nextFile = $arrayExamples[$currentIndex + 1];
}

if ($prevFile) {
	$prevButton = '<a href="'.$prevFile.'" rel="nofollow">
	<img class="aze_example_navi_buttons" src="../axZm/icons/previous-icon-48.png" border="0" alt="'.$prevFile.'" title="'.$prevFile.'">
	</a>';
} else {
	$prevButton = '<img class="aze_example_navi_buttons" src="../axZm/icons/previous-icon-48-disabled.png" border="0">';
}

if ($nextFile) {
	$nextButton = '<a href="'.$nextFile.'" rel="nofollow">
	<img class="aze_example_navi_buttons" src="../axZm/icons/next-icon-48.png" border="0" alt="'.$nextFile.'" title="'.$nextFile.'">
	</a>';
} else {
	$nextButton = '<img class="aze_example_navi_buttons" src="../axZm/icons/next-icon-48-disabled.png" border="0">';
}

$homeButton = '';

if (!isset($displayHome)) {
	if (!stristr($currentExample, '34')) {
		$homeButton = '<a href="https://www.ajax-zoom.com" rel="nofollow">
		<img class="aze_example_navi_buttons" src="../axZm/icons/home-icon.png" border="0" style="margin-left: 25px" alt="HOME" title="HOME">
		</a>';
	}

	$homeButton .= '<a href="index.php" rel="nofollow">
	<img class="aze_example_navi_buttons" src="../axZm/icons/overview_48x48.png" border="0" style="margin-left: 5px" alt="Overview (index.php)" title="Overview (index.php)">
	</a>';

	$homeButton .= '<a href="https://www.ajax-zoom.com/index.php?cid=download" target="_blank" rel="nofollow">
	<img class="aze_example_navi_buttons" src="../axZm/icons/buy_48x48.png" border="0" style="margin-left:5px" alt="Buy / Download" title="Buy / Download">
	</a>';

	$homeButton .= '<a href="https://www.ajax-zoom.com/index.php?cid=contact" rel="nofollow">
	<img class="aze_example_navi_buttons" src="../axZm/icons/support_48x48.png" border="0" title="Ask a question" alt="Ask a question" style="margin-left: 5px">
	</a>';
}

$backgroundColor = '#808080';
$fullscreenExamples = array('example23');
foreach($fullscreenExamples as $k => $v) {
	if (stristr($currentExample, $v) || stristr($currentExample, 'fullscreen')) {
		$backgroundColor = 'transparent';
	}
}

echo '
<style>
.aze_example_navi_container {
	height: 58px;
	overflow: hidden;
	width: 100%;
}
.aze_example_navi_buttons {
	width: 48px;
	height: 48px;
	margin-bottom: 5px;
}
@media screen and (max-width: 768px) {
	.aze_example_navi_buttons {
		width: 32px;
		height: 32px;
	}
	.aze_example_navi_container {
		height: 42px;
	}
}
</style>
<div class="aze_example_navi_container" style="box-sizing: content-box !important; background-color: '.$backgroundColor.';">
	<div style="float: left; box-sizing: content-box !important; padding: 5px 0px 0px 5px">'.$prevButton.$homeButton.'</div>
	<div style="float: right; box-sizing: content-box !important; padding: 5px 5px 0px 0px">'.$nextButton.'</div>
</div>
';

?>