<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/sendajax.js"></script>
<script language="JavaScript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/subMenu.js"></script>
<script language="JavaScript">
function bookmark_us(url, title) {
    if (window.sidebar) {
        var side;
        side = window.sidebar.addPanel(title, url, "");
    } else if (window.opera && window.print) {
        var elem = document.createElement('a');
        alert(elem);
        elem.setAttribute('href', url);
        elem.setAttribute('title', title);
        elem.setAttribute('rel', 'sidebar');
        elem.click();
    } else if (document.all)

        window.external.AddFavorite(url, title);
}

function emailThisPage(url) {
    var newwindow = window.open(url, 'name', 'width=510,height=600,scrollbars=yes');
}
</script>
<div class="body-cont">

    <div class="body-cont1">
	<div class="body-leftcont">
            <?php include("includes/help_side_menu.php"); ?>
        </div>
        <div class="body-right">

            <?php include("includes/menu.php"); ?>

            <div class="tabs-cont" style="margin-top:0">
                <div class="left">
                    <div class="p-2" style="padding-top:0">
                        <div class="products-cate-heading"><h5><?php echo $post_buying_leads; ?></h5>
                        </div>
                        <!--<div style="color:#C55000; margin-left:10px; margin-top:10px;"><b style="font-size:12px;">Posting Buying Leads and Products</b></div>-->
                        <table border="0" width="100%" style="-size: 15px;padding-left:30px; padding-top:20px;">
                            <form id="form1" name="form1" method="post" action="">
                                <?php 
if($_SESSION['language']=='english')
{
$sel_qry=mysqli_query($con,"select * from general");
}
else if($_SESSION['language']=='french')
{
$sel_qry=mysqli_query($con,"select * from general_french");
}
else if($_SESSION['language']=='chinese')
{
$sel_qry=mysqli_query($con,"select * from general_chinese");
}
else
{
$sel_qry=mysqli_query($con,"select * from general_spanish");
}
	//$sel_qry=mysqli_query($con,"select * from general");
	$sell=mysqli_fetch_array($sel_qry);
?>
                                <tr>
                                    <td style="padding-left:10px;"><?php echo $sell['post_buy']; ?></td>
                                </tr>
                            </form>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <div class="body-cont4">

        </div>

    </div>


</div>


</div>

<?php include("includes/footer.php"); ?>