<!DOCTYPE html>
<html>
<head>
<title>Docs iframe</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<body>
<?php
if (isset($_GET['docu'])) {
	if (file_exists(dirname(__FILE__).'/docu_'.$_GET['docu'].'.inc.html')){
		include dirname(__FILE__).'/docu_'.$_GET['docu'].'.inc.html';
	} else {
		echo 'Error 404 file not found';
	}
} else {
	echo '"docu" query string parameter not passed.';
}
?>
</body>
</html>