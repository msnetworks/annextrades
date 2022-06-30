<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/sendajax.js"></script>
<script language="JavaScript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/subMenu.js"></script>
<script language="JavaScript">

function emailThisPage(url)
{
  var newwindow=window.open(url,'name','width=510,height=600,scrollbars=yes');
}
function bookmark_us(url, title)
{
if (window.sidebar)
{ 
    var side;
	side =window.sidebar.addPanel(title, url, "800%");
}
else if(window.opera && window.print)
{ 
    var elem = document.createElement('a');
	alert(elem);
    elem.setAttribute('href',url);
    elem.setAttribute('title',title);
    elem.setAttribute('rel','sidebar');
    elem.click();
}
else if(document.all)

    window.external.AddFavorite(url, title);
}
</script>
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/help_side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb; height:25px; padding-top:7px;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $message_center; ?></b></div>
<table border="0" width="100%" style="padding-left:30px; padding-top:20px;">
<form id="form1" name="form1" method="post" action="">
	<?php 
		$sel=mysqli_query($con,"select messagecenter from general");
		$msg=mysqli_fetch_array($sel);
	?>
	<tr>
		<td><?php echo $msg['messagecenter']; ?></td>
	</tr>
</form>
</table>
</div>

</div></div>

</div>

<div class="body-cont4"> 

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
