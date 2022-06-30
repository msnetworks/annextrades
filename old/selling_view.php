<?php 
include("includes/header.php");
$id=$_REQUEST['id'];

if(isset($_REQUEST['delete']))
{
$iddd=$_REQUEST['id']; 
 $update_com_photo="UPDATE tbl_seller SET seller_photo='' WHERE seller_id='$iddd'"; 
mysqli_query($con,$update_com_photo);

}


 ?>
<script language="javascript">
function confirm_delete()
{
	if(confirm('Are you sure want to delete this record?'))
	{
		return true;
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
<div   class="bordersty">
<div class="headinggg"><?php echo $preview_selling_lead; ?></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<table width="100%" border="0" cellpadding="3" cellspacing="2">
								
									<?php 
							
							$query = mysqli_query($con,"select * from tbl_seller where seller_id='$id'");
							$fetch = mysqli_fetch_array($query);
								
									 $id = $fetch['seller_id'];
									 $sess_id=$_SESSION['sess_id'];
									 $da = $fetch['seller_updated _date'];
									 $l = $fetch['seller_leadtype'];
									 $cat = $fetch['seller_category'];
							
							?>
									<tr>
									<td width="63">&nbsp;</td>
										<td width="211" align="right" class="blackBo"><div align="left"><strong>               <?php echo $selling_lead_type; ?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php echo $fetch['seller_leadtype']; ?></td>
									</tr>
									

									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $selling_lead_title; ?></strong></div></td>
										<td width="51"><div align="center">:</div></td>
										<td class=""><?php echo $fetch['seller_subject']; ?></td>
									</tr>
									

									<tr>
									<td>&nbsp;</td>
										<td  align="right" class="blackBo"><div align="left"><strong><?php echo $keyword; ?></strong></div></td>
										<td width="51"><div align="center">:</div></td>
										<td width="374" class=""><?php echo $fetch['seller_keyword']; ?></td>
									</tr>
									

									<!--<tr>
										<td width="297" align="right" class="greenbold">More Keywords</td>
										<td width="17"></td>
										<td width="436" class="sellerview"><?php //echo $fetch['']; ?></td>
									</tr>
									
									<tr><td>&nbsp;</td></tr>-->
									<?php
										$s = "select * from category where c_id='$cat'";
										$q = mysqli_query($con,$s);
										$f = mysqli_fetch_array($q);
										
										$catname = $f['category'];
									
									?>
									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $pro_cat; ?></strong></div></td>
										<td width="51"><div align="center">:</div></td>
										<td class=""><?php echo $catname; ?></td>
									</tr>
									

									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo" valign="top"><div align="left"><strong><?php echo $brief_introduction; ?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php echo $fetch['seller_description']; ?></td>
									</tr>
									

									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo" valign="top"><div align="left"><strong><?php echo $additional_description; ?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php echo $fetch['seller_detaildescription']; ?></td>
									</tr>
					

									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $expiry_date;?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php echo $fetch['seller_expired_date']; ?></td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $price;?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php echo $fetch['price']; ?></td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $delivery_type;?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php if($fetch['delivery_type']=='1') { echo $deliver_user; } if($fetch['delivery_type']=='2') { echo $need_buyer; } ?></td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $company_name;?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php echo $fetch['seller_companyname']; ?></td>
									</tr>
									
									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $bussiness_type;?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class=""><?php echo $fetch['seller_businesstype']; ?></td>
									</tr>
									

									<tr>
									<td>&nbsp;</td>
										<td align="right" class="blackBo"><div align="left"><strong><?php echo $attach_product_photo; ?></strong></div></td>
										<td><div align="center">:</div></td>
										<td class="sellerview">
										 <?php 
										    $filename = "uploads/".$fetch['seller_photo'];
										   if(($fetch['seller_photo'] != '') && (file_exists($filename))) {
										 ?>
										  <img src="<?php echo "uploads/".$fetch['seller_photo'];?>" height="70" width="70" /> &nbsp;&nbsp;<a href="selling_view.php?id=<?php echo $fetch['seller_id']; ?>&delete" onclick="return confirm_delete();"><?php echo $delete; ?></a>
										  <?php } else {?>
										  <img src="uploads/img_noimg.jpg" height="70" width="70" />
										  <?php } ?>
										</td>
									</tr>
									

									<tr height="60"><td colspan="4"  align="center">
										<?php /*<a href="seller_edit_preview.php?id=<?php echo $id; ?>"><input type="submit" name="preview" value="<?php echo $view_sell_offer_details_prev;?>" class="search_bg" /></a>&nbsp;&nbsp;&nbsp; */ ?>
										<a href="javascript:void(0);" onclick="javascript:location.href='seller_preview.php?id=<?php echo $id; ?>'"><input type="button" name="preview" value="<?php echo $preview; ?>" class="search_bg" /></a>&nbsp;&nbsp;&nbsp;
										<a href="selling_edit.php?id=<?php echo $id; ?>">
										<input type="hidden" name="edsval" value="<?php echo $id; ?>"/>
										<input type="button" class="search_bg" name="edit" value="<?php echo $edit; ?>" onclick="return edisgo();"/></a>&nbsp;&nbsp;&nbsp;
										 <!--<a href="manage_selling_leads.php"><input name="Submit3" type="submit" value="Back" /></a>-->
										 <input name="Submit3" class="search_bg" type='button' value="<?php echo $back; ?>" onclick="javascript:history.back();"/>
									</td></tr>
				  				</table>



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
