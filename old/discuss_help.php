<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>

<script language="JavaScript" src="js/sendajax.js"></script>
<script language="JavaScript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/subMenu.js"></script>
<script language="JavaScript">
function emailThisPage(url) {
    var newwindow = window.open(url, 'name', 'width=510,height=600,scrollbars=yes');
}

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
                        <div class="products-cate-heading"><h5><?php echo $participate_discuss; ?></h5>
                        </div>
                        <table style="size: 15px;">
                            <form id="form1" name="form1" method="post" action="">
                                <?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select discuss_help from cms");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select discuss_help from cms_french");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select discuss_help from cms_chinese");
}
else
{
$select=mysqli_query($con,"select discuss_help from cms_spanish");
}
	
	$gen=mysqli_fetch_array($select);
?>
                                <tr>
                                    <td style="padding-left:10px;"><?php echo $gen['discuss_help']; ?></td>
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