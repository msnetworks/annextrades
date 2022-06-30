<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
                        <div class="products-cate-heading"><h5><?php echo $posying_com_profile; ?></h5>
                        </div>
                        <!--<div style="color:#C55000; margin-left:10px; margin-top:10px;"><b style="font-size:12px;">Posting Buying Leads and Products</b></div>-->
                        <table border="0" width="100%" style="padding-left:30px; padding-top:20px; size: 15px;">
                            <?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select selloverview from general");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select selloverview from general_french");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select selloverview from general_chinese");
}
else
{
$select=mysqli_query($con,"select selloverview from general_spanish");
}
	//$select=mysqli_query($con,"select selloverview from general");
	$overview=mysqli_fetch_array($select);
?>
                            <tr>
                                <td><?php echo $overview['selloverview']; ?></td>
                            </tr>
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