<?php 
include("includes/header.php");
$bid=$_REQUEST['id'];

//$select="select * from buyingleads where  id='$sess_id' order by buy_id desc";

$select="select * from buyingleads where  buy_id = '$bid'";
$select_query=mysqli_query($con,$select);
$select_fetch=mysqli_fetch_array($select_query);
$id=$select_fetch['buy_id'];

$res_buy="select * from registration where id='$session_user'";
$res_query=mysqli_query($con,$res_buy);
$res_fetch=mysqli_fetch_array($res_query);

  $imgpath1 = "upload/".$res_fetch['photo'];	
if(($res_fetch['photo'] != '') && (file_exists($imgpath1)))
{
  $image5="upload/".$res_fetch['photo'];
}else{
 $image5="blog_photo_thumbnail/profile_pic_small.gif";
}

 ?>


<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



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
                            <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
                              <tr>
                                <td colspan="3"  style="padding:5px; "><strong><?php echo $select_fetch['subject']; ?></strong></td>
                                </tr>
                              <tr>
                                <td width="39%" rowspan="6" align="center"><?php if((file_exists("upload/".$select_fetch['photo']))&&($select_fetch['photo']!='')) {  ?><img src="<?php echo "upload/".$select_fetch['photo'];?>" height="100" width="100"/><?php } else { ?><img src="upload/img_noimg.jpg" width="98" height="86" border="0" /><?php } ?></td>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="28%" align="left" valign="middle"><strong><?php echo $price_range; ?> :</strong></td>
                                <td width="33%"><?php echo $select_fetch['price'];?>&nbsp;&nbsp;<?php echo $select_fetch['range1'];?>&nbsp; ~ &nbsp;<?php echo $select_fetch['range2'];?> </td>
                              </tr>
                              <?php if($select_fetch['miniquantity']!="") { ?>
                              <tr>
									<td><strong><?php echo $min_qua; ?>:</strong></td>
                                <td><?php echo $select_fetch['miniquantity'];?>&nbsp;&nbsp;<?php echo $select_fetch['quantity'];?></td>
                              </tr>
							  <?php } ?>
                              <tr>
                                <td><strong><?php echo $post_date; ?> :</strong></td>
                                <td><?php echo $select_fetch['update_date'];?></td>
                              </tr>
                              <tr>
                                <td><strong><?php echo $expiry_date; ?> :</strong></td>
                                <td><?php echo $select_fetch['expiredate'];?></td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><!--<a href="buying_send_message.php?id=<?php echo $id; ?>">Online</a>--></td>
                                <td><!--<a href="buying_send_message.php?id=<?php echo $id; ?>"><input name="Submit" type="image" value="Contact now" src="images/bu_ContactNow.gif" /></a>--></td>
                              </tr>
                             
                              <tr>
                                <td><strong><?php echo $detailed_buying; ?></strong></td>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3"></td>
                                </tr>
                              
                              <tr>
                                <td><?php echo $select_fetch['detdes'];?></td>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3"><table width="100%">
                                    <tr>
                                      <td colspan="3"  style="padding:5px;"><strong><?php echo $contact_info; ?></strong></td>
                                    </tr>
                                    <tr>
                                      <td width="26%">&nbsp;</td>
                                      <td width="24%">&nbsp;<strong>&nbsp;<?php echo $company_name; ?>: </strong></td>
                                      <td width="50%"><?php echo $res_fetch['companyname'];?></td>
                                  </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;&nbsp;<strong><?php echo $contact_person; ?>: </strong></td>
                                      <td><?php echo $res_fetch['firstname'];?></td>
                                  </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;&nbsp;<strong><?php echo $street_address; ?>:</strong></td>
                                      <td><?php echo $res_fetch['street'];?></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;&nbsp;<strong><?php echo $city; ?>:</strong></td>
                                      <td><?php echo $res_fetch['city'];?></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;&nbsp;<strong><?php echo $province_state; ?>: </strong></td>
                                      <td><?php echo $res_fetch['state'];?></td>
                                    </tr>
								<?php
									$res=mysqli_query($con,"select * from country where country_id='$res_fetch[country]'");
 $result=mysqli_fetch_array($res);
 
 									?>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;&nbsp;<strong><?php echo $country_region; ?>:</strong></td>
                                      <td><?php echo $result['country_name'];?></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;&nbsp;<strong><?php echo $zip; ?>:</strong></td>
                                      <td><?php echo $res_fetch['zipcode'];?></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;&nbsp;<strong><?php echo $telephone; ?>:</strong></td>
                                      <td><?php echo $res_fetch['phonenumber'];?></td>
                                    </tr>
                                </table></td>
                              </tr>
                        <!--  <onclick="switchDiv('tabTwo','tabOne'), swapTabs('tab2');">
						onclick="switchDiv('tabOne','tabTwo'), swapTabs('tab1');"-->
                              <tr>
                                <td colspan="3" align="center"><input type="button" name="Submit" value="<?php echo $back; ?>" class="search_bg" onclick="javascript:location.href='buying_view.php?id=<?php echo $bid; ?>';"/></td>
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
