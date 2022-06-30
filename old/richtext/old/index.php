
<link type="text/css" rel="stylesheet" href="richtext/jquery.rte.css" />
<!-- <style type="text/css">
textarea {
    font-family:sans-serif;
    font-size:12px;
} 
</style> -->
	<div id="main" style="width:100%;">
       <textarea name="p_bdes" cols="100" rows="10"  id="rte" class="rte"><?php echo $fetch_pro['p_bdes']; ?></textarea>
	</div>
<!-- <script type="text/javascript" src="richtext/jquery.js"></script> -->
<script type="text/javascript" src="richtext/jquery.rte.js"></script>
<script type="text/javascript" src="richtext/jquery.rte.tb.js"></script>
<script type="text/javascript" src="richtext/jquery.ocupload-1.1.4.js"></script>
<script type="text/javascript">
	$('.rte').rte({
		css: 'richtext/default.css',
		width: '100%',
		height: 200,
		controls_rte: rte_toolbar,
		controls_html: html_toolbar
	});
	
</script>
