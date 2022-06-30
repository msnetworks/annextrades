<?php include("includes/header.php");
$sess_id = isset($_SESSION['user_login']) ? $_SESSION['user_login']:'';
//print_r($_REQUEST['property']);

 ?>
 <style type="text/css">
 .redbold
 {
 color:#FF0000;
 }
 
 </style>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>


<?php
$pro=$_REQUEST['id'];
$res="select * from tbl_tradeshow where show_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);

$businessmail=$_SESSION['value'];
               ?>


<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <span><strong> <?php echo $contact_info; ?></strong> </span></div>
<div style="border: solid 1px #CFCFCF;">

 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>&nbsp;</td></tr>
                            <tr>
                              <td height="30" align="left" >
							
							  <img src="images/icon_N1.gif" width="36" height="37" /><strong><?php echo $contact_success; ?>:</strong></td>
                            </tr>
							<tr>
                              <td height="25" align="center" >
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:16px; color:#386DA3; font-weight:bold;" class="bluebold"><?php echo ucfirst($result['show_name']);?></span>
                                 </div>                              </td>
                            </tr>
							<tr>
							  <td height="30" align="center" valign="middle" ><strong><?php echo $reply_mail; ?> : </strong><span style="color:#386DA3; font-weight:bold;"  class="bluebold"><?php echo $businessmail=$_SESSION['value'];?></span><strong> <?php echo $contact_neccessary; ?>.</strong></td>
						    </tr>
                          </table>  


</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>