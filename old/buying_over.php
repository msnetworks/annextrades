<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>

<script language="JavaScript" src="js/sendajax.js"></script>
<script language="JavaScript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/subMenu.js"></script>
<script language="JavaScript">
function openClosStatus(AAA) {
    if (
        document.getElementById(AAA).style.display == "block") {
        document.getElementById(AAA).style.display = "none";
    } else {
        document.getElementById(AAA).style.display = "block";
    }
}

function openClosother(CCC) {
    if (
        document.getElementById(CCC).style.display == "block") {
        document.getElementById(CCC).style.display = "none";
    } else {
        document.getElementById(CCC).style.display = "block";
    }
}

function openCloseother(BBB) {
    if (
        document.getElementById(BBB).style.display == "block") {
        document.getElementById(BBB).style.display = "none";
    } else {

        document.getElementById(BBB).style.display = "block";
    }
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
                        <div class="products-cate-heading"><h5><?php echo $buy_overview; ?></h5>
                        </div>
                        <table style="font-size: 15px;">
                            <form id="form1" name="form1" method="post" action="">
                                <?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select buy_over from general");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select buy_over from general_french");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select buy_over from general_chinese");
}
else
{
$select=mysqli_query($con,"select buy_over from general_spanish");
}	
	$gen=mysqli_fetch_array($select);
?>
                                <tr>
                                    <td style="padding-left:10px;"><?php echo $gen['buy_over']; ?></td>
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