<?php 
include("includes/header.php");
$id=$_REQUEST['id'];
 ?>
 <style type="text/css">

 </style>
 
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
<table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
									<tr><td>&nbsp;</td></tr>
								<?php
								
									$viewquery = mysqli_query($con,"select * from tbl_seller where seller_id='$id'");
								//echo "select * from tbl_seller where seller_id='$id'";
									$viewfetch = mysqli_fetch_array($viewquery);
									  $id = $viewfetch['seller_id'];
									  $cat  = $viewfetch['seller_category'];
									  $type = $viewfetch['seller_leadtype'];
								
								
								?>
								
								
									<tr>
										<td width="240" style="padding-left:5px"><strong><?php echo $viewfetch['seller_subject']; ?></strong></td>
									</tr>
									<tr>
										<td style="padding-left:5px" align="center">
										<?php if((file_exists("uploads/".$viewfetch['seller_photo']))&&($viewfetch['seller_photo']!='')) { ?><img src="<?php echo "uploads/".$viewfetch['seller_photo'];?>" height="190" width="230" /><?php } else { ?><img src="uploads/img_noimg.jpg" height="190" width="230" /><?php } ?></td>
										<td width="500">
											<table width="458" border="0" cellpadding="3" cellspacing="0" align="right">
												<tr>
													<td width="106" align="left"><strong><?php echo $post_date; ?></strong></td>
													<td width="2">:</td>
													<td width="332" align="left"><span  style="font-size:12px;"><?php echo $viewfetch['seller_updated_date']; ?></span></td>
												</tr>
												<!--<tr height="3"><td></td></tr>-->
												<tr><td colspan="9" >&nbsp;</td></tr>
												<tr height="3"><td>&nbsp;</td></tr>
												<tr>
													<td align="left"><strong><?php echo $expiry_date; ?></strong></td>
													<td>:</td>
													<td align="left"><span  style="font-size:12px;"><?php echo $viewfetch['seller_expired_date']; ?></span></td>
												</tr>
												
												<tr>
												<td colspan="9" >
												<table width="100%" border="0">
												<tr><td colspan="2">&nbsp;</td></tr>
														  <tr>
															<td colspan="2" align="left"><strong><?php echo $company_info; ?></strong></td>															
														  </tr>
														  <tr>
															<td width="26%" height="31" class="" align="left"><strong><?php echo $date_joined; ?></strong>
															<td width="74%" align="left"><span  style="font-size:12px;"><?php echo $viewfetch['seller_updated_date']; ?></span></td>
													</tr>
														  <tr>
														  <?php
														  	
															$selreg = mysqli_query($con,"select * from registration where id='$session_user'");
														  	$fetch = mysqli_fetch_array($selreg);
															
														
															 $coun = $fetch['country'];
															
															$con = mysqli_query($con,"select * from country where country_id='$coun'");
															$confetch = mysqli_fetch_array($con);
															
														  
														  
														  ?>
														  
														  
															<td class="" align="left"><strong><?php echo $contry; ?></strong>
															<td align="left"><span  style="font-size:12px;"><?php echo $confetch['country_name']; ?></span></td>
												  </tr>
														  <tr>
															<td class="" align="left"><strong><?php echo $bussiness_type; ?></strong>
															<td align="left"><span  style="font-size:12px;"><?php echo $viewfetch['seller_businesstype'];?></span></td>
												  </tr>
														  <tr>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															</tr>
														 </table>
												</td>
												</tr>
												
												<tr height="23"><td>&nbsp;</td></tr>
												
												
											</table></td>
									</tr>
									
									<tr><td>&nbsp;</td></tr>
									
									<tr>
										<td class="" colspan="7" style="padding-left:5px" align="left"><strong><?php echo $detailed_selling_lead_desc; ?></strong></td>
									</tr>
									
									<tr>
					<td colspan="2" style="padding-left:5px" class="" align="left"><?php echo $viewfetch['seller_detaildescription']; ?></td>
									</tr>
									
									<tr height="45"><td align="center">
									   <?php /* <a href="view_sell_offer_details.php?id=<?php echo $_GET['id']; ?>"><input type="submit" class="search_bg" name="Submit" value="<?php echo $seller_edit_bkk;?>" /></a> */ ?>
									   <a href="javascript:void(0);" onclick="javascript:location.href='selling_view.php?id=<?php echo $_GET['id']; ?>'"><input type="button" class="search_bg" name="Submit" value="Back" /></a>
									   
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
