<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width" />
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery-ui-1.8.11.custom.css" />
    <link rel="stylesheet" media="screen" href="css/colorbox.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery.tools-1.2.5.min.js"></script>
    <script src="js/jquery-ui-1.8.11.custom.min.js" language="javascript" type="text/javascript"></script>
    <script src="js/jquery.colorbox-min.js"></script>
    <script src="js/ccvalidations.js"></script>


<title><?php echo $title?></title>
<script>
    $(document).ready(function(){
        $(".ccinfo").show();
        $("a[rel='hint']").colorbox();
        $(":radio[name=cctype]").click(function(){
            if($(this).hasClass("isPayPal")){
                 $(".ccinfo").slideUp("fast");
            } else {
                 $(".ccinfo").slideDown("fast");
            }
            resetCCHightlight();
        });

        $("input[name=ccn]").bind('paste', function(e) {
                var el = $(this);
                setTimeout(function() {
                    var text = $(el).val();
                    resetCCHightlight();
                    checkNumHighlight(text);
                }, 100);
        });
    });
</script>
<noscript>
<style>
	.noscriptCase { display:none; }
	#accordion .pane { display:block;}
</style>
</noscript>
</head>
<body>