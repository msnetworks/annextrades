<?php
$navThimbsQueryString = 'ref='.basename($_SERVER['SCRIPT_FILENAME']);
$navThimbsQueryString .= '&footerMargin='.(isset($footerMargin) ? $footerMargin : '0');
if (isset($sliderWidth)) {
	$navThimbsQueryString .= '&sliderWidth='.$sliderWidth;
}

if (defined('COMMENTS_BOOTSTRAP')) {
	$navThimbsQueryString .= '&bootstrap=1';
}
?>
<script type="text/javascript">
var load_other_examples_slider = function() {
	if (!window.jQuery) {
		return;
	}

	jQuery('#load_other_examples_slider_link').replaceWith('<iframe width="100%" height="230" frameborder="0" src="nav_thumbs.php?<?php echo $navThimbsQueryString; ?>" allowfullscreen></iframe>');
};
</script>
<?php
if (defined('COMMENTS_BOOTSTRAP')) {
	echo '<a id="load_other_examples_slider_link" href="javascript:void(0)" class="btn btn-info" style="margin-bottom: 50px;" onclick="load_other_examples_slider()">Load other examples in slider</a>';
} else {
	echo '<div id="load_other_examples_slider_link" style="margin-bottom: 50px;"><a href="javascript:void(0)" onclick="load_other_examples_slider()">Load other examples in slider</a></div>';
}
?>