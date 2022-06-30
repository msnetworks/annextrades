<?php 
include("includes/header.php");

//session_start();
$today=date("F j, Y");
date('Y-m-d');
$today=date("F j, Y");

$result=mysqli_query($con,"select * from membersettings");
	$details=mysqli_fetch_array($result);
 ?>
<script type="text/javascript">
function doPreview() {
              var newwin = window.open("buying_preview.php");   
   //var newWin = window.open("", "Preview","width=500,height=300");
   //var newWin = "buying_preview.php"
   newWin.document.write("<html><body>"+document.getElementById('detdes').value, document.getElementById('price').value, document.getElementById('range1').value+"</body></html>");
  newWin.document.close();
}

function popUp1(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=150,left = 150,top = 234');");
}

function change_mem(str)
{
	if(confirm("You want to move as "+str))
	{
		window.location="trustpass_new.php?stat="+str;
	}
	else
	{
		return false;
	}
}
</script> 
 




<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div  class="bordersty">

<div align="center">
<strong>
 <?php
 if(isset($_REQUEST['pay_succ']))
 {?>
 <div style="color:#339933;"><?php echo $amount_success; ?> </div>
 <?php }
if(isset($_REQUEST['pay_err']))
 { ?>

  <div style="color:#FF0000;"><?php echo $paid_err; ?></div>
<?php }
 
 ?>
 </strong>

</div>

<div class="headinggg"><strong> <?php echo $member_details; ?></strong></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<form id="buying" name="buying" method="post" action="" enctype="multipart/form-data" onsubmit="return validate(this)">
<table width="100%" border="1" bordercolor="#29B1C9" align="right" cellpadding="0" cellspacing="0" >
<tr>
<td>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="border:3px solid #29B1C9;">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<?php
$select_pay=mysqli_query($con,"select * from member_order where order_userid ='$sess_id'");
$select_fet=mysqli_fetch_array($select_pay);
?>
<tr>
<td align="center" colspan="2"><strong><?php echo $gold_member_info; ?></strong></td>
</tr>
<tr>
<td class="text_mem" align="left"><strong><?php echo $mambership_bylvl;?></strong></td>
<td rowspan="4" valign="middle">
<?php 
if(($select_fet['order_packname'] == "GoldSupplier") and ($select_fet['payment_status']=='1')) {
?>
<span><?php echo $gold_supplier; ?></span>
<?php
} else {
?>

<input type="button" class="search_bg" name="gold" onclick="change_mem('GoldSupplier')" value="<?php echo $upgrade; ?>" />
<?php } ?>
</td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;<strong><?php echo $getting_level_member; ?>:</strong></td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;
<table border="0" cellpadding="2" cellspacing="2" width="100%">
<tbody>
<tr>
<td><?php echo $product_many_categories; ?></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<?php echo $add_image_product; ?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td class="text_mem">
&nbsp;&nbsp;
<?php echo $details['gold_year'];?>
<?php echo $year; ?> - <?php echo $amount; ?> 
$.<?php echo $details['gold_amount'];?>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style="border:3px solid #29B1C9;">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr>
<td colspan="2" align="center">
<strong><?php echo $silver_member_info; ?></strong>
</td>
</tr>
<tr>
<td class="text_mem"><strong><?php echo $getting_level_member; ?>:</strong></td>
<td rowspan="4" valign="middle">
<?php 
if(($select_fet['order_packname'] == "SilverSupplier") and ($select_fet['payment_status']=='1')) {
?>
<span><?php echo $silver_supplier; ?></span>
<?php
} else {
?>

<input type="button" class="search_bg" name="silver" onclick="change_mem('SilverSupplier')" value="<?php echo $upgrade; ?>" />
<?php } ?>
</td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;
<table border="0" cellpadding="2" cellspacing="2" width="100%">
<tbody>
<tr>
<td>&nbsp;<?php echo $product_many_categories; ?></td>
</tr>
<tr>
<td>&nbsp;&nbsp;<?php echo $add_image_product; ?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;<?php echo $mambership_addimg;?></td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;<?php echo $details['sillver_year'];?> <?php echo $year; ?> - <?php echo $amount; ?> $. <?php echo $details['silver_amount'];?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style="border:3px solid #29B1C9;">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr>
<td align="center" colspan="2"><strong><?php echo $bonze_member_info; ?></strong></td>
</tr>
<tr>
<td class="text_mem"><strong><?php echo $getting_level_member; ?>:</strong></td>
<td rowspan="4" valign="middle">
<?php 
if(($select_fet['order_packname'] == "bronzeSupplier")and ($select_fet['payment_status']=='1')) {
?>
<span><?php echo $bronze_supplier; ?></span>
<?php
} else {
?>
<input type="button" class="search_bg" name="bronze" onclick="change_mem('bronzeSupplier')" value="<?php echo $upgrade; ?>" />
<?php } ?>
</td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;<?php echo $product_many_categories; ?></td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;<?php echo $add_image_product; ?></td>
</tr>
<tr>
<td class="text_mem">&nbsp;&nbsp;<?php echo $details['bronze_year'];?> <?php echo $year; ?> - <?php echo $amount; ?> $. <?php echo $details['bronze_amount'];?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</table>
</td>
</tr>

<?php /*?><tr>
<td class="blackBo" colspan="2" align="center">
<?php
if($select_fet['paystatus']=='1')
{
?>
<a href="javascript:popUp1('upmember.php?id=<?php echo $select_fet['id'];?>')">
<input type="submit" name="Input" value="<?php echo $mambership_upgrd;?>" class="search_bg" onclick="javascript:popUp1('upmember.php?id=<?php echo $select_fet['id'];?>')"/>
<img src="images/bu_upgradeNow.gif" width="141" height="29" border="0" />
</a>
<?php
}
else
{
?>
<a href="trustpass_new.php">
<input type="button" name="Input2" value="<?php echo $mambership_upgrd;?>" class="search_bg" onclick="return uptrus();"/> </a>
<img src="images/bu_upgradeNow.gif" width="141" height="29" border="0" />-->
<?php
}
?>
</td>
</tr><?php */?>

<!--<tr>
<td colspan="2" align="center"><input name="Submit" type="image" class="button2" value="Submit" src="images/bu_submit.gif" />
<a href="buying_preview.php"></a></td>
</tr>-->
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</form>

<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


<div class="body-cont4"> 






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
