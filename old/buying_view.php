<?php 
include("includes/header.php");
if(isset($_REQUEST['Submit2']))
{
	header("location:buying_leads.php");
}
$buyid=$_REQUEST['id'];

//$sess_id=$_SESSION['sess_id']; 
 $res_select="select * from buyingleads where buy_id='$buyid'";

$res_query=mysqli_query($con,$res_select);

$res_fetch=mysqli_fetch_array($res_query);

$b_id=$res_fetch['buy_id'];

  $imgpath1 = "upload/".$res_fetch['photo'];	
if(($res_fetch['photo'] != '') && (file_exists($imgpath1)))
{
  $image5="upload/".$res_fetch['photo'];
}else{
 $image5="blog_photo_thumbnail/profile_pic_small.gif";
}


if(isset($_REQUEST['delete']))
{
$iddd=$_REQUEST['id']; 
  $update_com_photo="UPDATE buyingleads SET photo='' WHERE buy_id='$iddd'";  
mysqli_query($con,$update_com_photo);

}


 ?>


<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>

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

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div   class="bordersty">
<div class="headinggg"><strong><?php echo $preview_buying_lead; ?></strong></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td ><table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td width="29%" height="26" align="left" class="blackBo"><strong><?php echo $buying_lead_type; ?></strong>&nbsp;&nbsp; </td>
                                <td width="59%">&nbsp;&nbsp;<?php echo $preview_buyingleads_bu;?></td>
                              </tr>
                           <!--   <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong>Buying Lead Title</strong>&nbsp;&nbsp; </td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['subject'];?></td>
                              </tr>-->
                              
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td align="left" class="blackBo"><strong><?php echo $related_photo; ?></strong>&nbsp;&nbsp; </td>
                                <td>&nbsp;&nbsp;<img src="<?php echo $image5;  ?>" width="80" height="80" /> &nbsp;&nbsp;
								<a href="buying_view.php?id=<?php echo $res_fetch['buy_id']; ?>&delete" onclick="return confirm_delete();" ><?php echo $delete; ?></a></td>
                              </tr>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"> <strong><?php $keywords; ?>&nbsp;&nbsp;</strong> </td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['keyword'];?></td>
                              </tr>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $more_keywords; ?></strong>&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['keyword1'];?><?php echo $res_fetch['keyword2'];?></td>
                              </tr>
							  <?php
							  $res= "select * from category where parent_id='' and c_id = '$res_fetch[category]'";
		  $sql=mysqli_query($con,$res); $result=mysqli_fetch_array($sql);
		  $sub = $result['c_id'];
							  ?>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $product_cat; ?></strong>&nbsp;&nbsp;  </td>
                                <td>&nbsp;&nbsp;<?php echo $result['category'];?></td>
                              </tr>
							   <?php
							  $res1= "select * from category where c_id = '$res_fetch[subcategory]'";
		  $sql=mysqli_query($con,$res1); $result=mysqli_fetch_array($sql);
		  
		   $result['category'];
							  ?>
							  <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $sel_pro_cat; ?></strong>&nbsp;&nbsp;  </td>
                                <td>&nbsp;&nbsp;<?php echo $result['category'];?></td>
                              </tr>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $brief_introduction; ?></strong>&nbsp;&nbsp; </td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['briefdes'];?></td>
                              </tr>
                             
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $additional_description; ?>&nbsp;</strong>&nbsp; </td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['detdes'];?></td>
                              </tr>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php $expiry_date; ?>&nbsp;</strong>&nbsp; </td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['expiredate'];?>&nbsp;</td>
                              </tr>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $contact_preference; ?></strong>&nbsp;&nbsp; </td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['mycontact'];?></td>
                              </tr>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $price_range; ?></strong>&nbsp;&nbsp; </td>
                                <td>&nbsp;&nbsp;<?php echo $res_fetch['price'];?>&nbsp;<?php echo $res_fetch['range1'];?>&nbsp; ~ &nbsp;<?php echo $res_fetch['range2'];?></td>
                              </tr>
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left" class="blackBo"><strong><?php echo $minimum_order_qua; ?></strong>&nbsp;&nbsp; </td>
                                <td align="left">&nbsp;&nbsp;<?php echo $res_fetch['miniquantity'];?>&nbsp;<?php echo $res_fetch['quantity'];?></td>
                              </tr>
                        <!--  <onclick="switchDiv('tabTwo','tabOne'), swapTabs('tab2');">
						onclick="switchDiv('tabOne','tabTwo'), swapTabs('tab1');"-->
                              <tr>
							  <td width="12%">&nbsp;</td>
                                <td height="26" align="left"  class="blackBo"><strong><?php echo $certificat_require; ?></strong>&nbsp;&nbsp; </td>
                                <td align="left">&nbsp;&nbsp;<?php echo $res_fetch['certificate'];?></td>
                              </tr>
                              <tr>
                                <td height="40" colspan="3" align="center">
								  <?php /*<a href="buying_preview.php?id=<?php echo $b_id; ?>">
                                  <!--<input name="Submit" type="image" value="Preview" src="images/bu_preview.gif" />-->
                                  <input type="submit" class="search_bg" name="Submit" value="<?php echo $view_sell_offer_details_prev;?>" />
								  
                                </a>*/ ?>
								
								<a href="javascript:void(0);" onclick="javascript:location.href='buying_preview.php?id=<?php echo $b_id; ?>'"><input type="button" class="search_bg" name="Submit" value="<?php echo $preview; ?>" /> </a>
                                  
                                 <?php /* <a href="buying_edit.php?buyid=<?php echo $b_id; ?>">
                                 <!-- <input name="Submit2" type="image" value="Edit" src="images/bu_edit.gif" />-->
								  <input type="submit" class="search_bg" name="Submit4" value="<?php echo $view_sell_offer_details_edt;?>" />
								  </a> */ ?>
								 <a href="javascript:void(0);" onclick="javascript:location.href='buying_edit.php?id=<?php echo $b_id; ?>'"> <input type="button" class="search_bg" name="Submit4" value="<?php echo $edit; ?>" /> </a>
								  
                                
                                 <!--<input name="Submit3" type="image" value="Back" src="images/bu_Back.gif" />-->
								<a href="buying_leads.php"> <input type="submit" class="search_bg" name="Submit2" value="<?php echo $back; ?>" /></a>
                                
                                 </td>
                                </tr>
                            </table></td>
                          </tr>
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
