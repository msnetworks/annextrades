<?php include("includes/header.php");
$sess_id = isset($_SESSION['user_login']) ? $_SESSION['user_login']:'';
//print_r($_REQUEST['property']);

 ?>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"> <span> <?php echo $upcoming_trade; ?></span></div>
<div style="border: solid 1px #CFCFCF;">

 
<table width="100%" border="0" cellpadding="3" cellspacing="0">
									 <?php 
$pro=$_REQUEST['id'];
$res="select * from tbl_tradeshow where show_id='$pro'";

$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
if($_SESSION['language']=='english')
{
$show=$result['show_name'];
$org=$result['show_organizer'];
$ven=$result['venue'];
$add=$result['address'];
$sum=$result['summary'];
$gen=$result['general_information'];
$attend=$result['attendee_information'];
$exhibit=$result['exhibitors_information'];
}
else if($_SESSION['language']=='french')
{
$show=$result['show_name_french'];
$org=$result['show_organizer'];
$ven=$result['venue_french'];
$add=$result['address_french'];
$sum=$result['summary_french'];
$gen=$result['general_information_french'];
$attend=$result['attendee_information_french'];
$exhibit=$result['exhibitors_information_french'];
}
else if($_SESSION['language']=='chinese')
{
$show=$result['show_name_chinese'];
$org=$result['show_organizer'];
$ven=$result['venue_chinese'];
$add=$result['address_chinese'];
$sum=$result['summary_chinese'];
$gen=$result['general_information_chinese'];
$attend=$result['attendee_information_chinese'];
$exhibit=$result['exhibitors_information_chinese'];
}
else
{
$show=$result['show_name_spanish'];
$org=$result['show_organizer'];
$ven=$result['venue_spanish'];
$add=$result['address_spanish'];
$sum=$result['summary_spanish'];
$gen=$result['general_information_spanish'];
$attend=$result['attendee_information_spanish'];
$exhibit=$result['exhibitors_information_spanish'];
}

$id=$result['show_id'];
$res3=mysqli_query($con,"select * from country where country_name='$result[location]'");
$result1=mysqli_fetch_array($res3);
?>
                                      <tr>
                                        <td><table width="100%" height="124" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td colspan="3"><strong><?php echo ucfirst($show);?></strong></td>
                                            </tr>
                                            <tr>
                                              <td width="19%" align="center" style="padding:10px;"><?php if(($result['image']!='')&&(file_exists("uploads/".$result['image']))) { ?>
                                              <img src="<?php echo "uploads/". $result['image'];?>" height="75" width="75"/><?php } else { ?><img src="images/img_noimg.jpg"<?php } ?></td>
                                              <td width="37%" align="center" valign="top"></td>
                                              <td width="44%" rowspan="2" valign="middle"><label>
                                                <?PHP 
		$verquery=mysqli_query($con,"select * from register");
		if($sess_id=="")
		{
		
		?>
                                                <a href="login_1.php" class="news"> <?php echo $tradeshow_search_connow;?></a>&nbsp;&nbsp;/
                                                &nbsp;&nbsp;<a href="login_1.php" class="news"><?php echo $tradeshow_search_rltfr;?></a>
                                                        <?PHP }
		else {}
		?>
                                              </label></td>
                                            </tr>
                                            <tr>
                                              <td height="18" align="left" valign="baseline" class="" ><strong style="color:#1E5477; font-size:16px;"><?php echo $fast_facts; ?></strong></td>
                                              <td height="18" align="left" valign="baseline">&nbsp;</td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td height="199"><table width="100%" height="124" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td colspan="3" align="left" valign="top"><label></label>
                                                  <table width="100%" border="0" cellspacing="2" cellpadding="3">
                                                    <tr>
                                                      <td width="43%" class="futured"><strong><?php echo $show_organizer; ?>:</strong></td>
                                                      <td width="4%">&nbsp;</td>
                                                      <td width="53%" class="normal"><?php echo $org;?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $even_date; ?>:</strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php 
															$date_temp=explode("-",$result['events_fromdate']);
															echo $from_dte_new = $date_temp[2]."-".$date_temp[1]."-".$date_temp[0];
														?>
															<b>-to-</b>
														<?php 
															$date_temp=explode("-",$result['events_todate']);
															echo $to_dte_new = $date_temp[2]."-".$date_temp[1]."-".$date_temp[0];
														?>
													  </td>
                                                    </tr>
													<tr>
                                                      <td class="futured"><strong><?php echo $even_date; ?> :</strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal">
													  	<?php 
															echo $result['from_time'];
														?>
															<b>-to-</b>
														<?php 
															echo $result['to_time'];
														?>
													  </td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $venue; ?>:</strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php echo $ven;?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $address; ?>:</strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php echo $add;?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $no_of_exhibitors; ?>: </strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php echo $result['exhibitors_no'];?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $no_of_attenance; ?>:</strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php echo $result['attendees_no'];?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $exhibition_floor_size; ?> </strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php echo $result['exhibition_no'];?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $phone; ?>:</strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php echo $result['phone'];?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="futured"><strong><?php echo $fax; ?>:</strong></td>
                                                      <td>&nbsp;</td>
                                                      <td class="normal"><?php echo $result['fax'];?></td>
                                                    </tr>
                                                </table></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td class="cent_bold"><strong style="color:#1E5477; font-size:16px;"><?php echo $summary; ?></strong>
                                          <div style="border-bottom:1px solid #ccc; padding:0px 0px 5px 0px;"><img src="images/spacer.gif"  height="3"/></div></td></tr>
                                      <tr>
                                        <td class="inTxtNormal"><div align="justify" style="text-indent:35px;"><?php echo $sum;?></div></td>
                                      </tr>
                                      <tr>
                                        <td class="inTxtHead">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td class="cent_bold"><strong style="color:#1E5477; font-size:16px;"><?php echo $general_info; ?></strong>
                                          <div style="border-bottom:1px solid #ccc; padding:0px 0px 5px 0px;"><img src="images/spacer.gif"  height="3"/></div></td></tr>
                                      <tr>
                                        <td class="inTxtNormal"><div align="justify" style="text-indent:35px;"><?php echo $gen;?></div></td>
                                      </tr>
                                      <tr>
                                        <td class="inTxtHead">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td class="cent_bold"><strong style="color:#1E5477; font-size:16px;"><?php echo $attenace_info; ?></strong>
                                          <div style="border-bottom:1px solid #ccc; padding:0px 0px 5px 0px;"><img src="images/spacer.gif"  height="3"/></div></td></tr>
                                      <tr>
                                        <td class="inTxtNormal"><div align="justify" style="text-indent:35px;"><?php echo $attend;?></div></td>
                                      </tr>
                                      <tr>
                                        <td class="inTxtHead">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td class="cent_bold"><strong style="color:#1E5477; font-size:16px;"><?php echo $exhibitor_info; ?></strong>
                                          <div style="border-bottom:1px solid #ccc; padding:0px 0px 5px 0px;"><img src="images/spacer.gif"  height="3"/></div></td></tr>
                                      <tr>
                                        <td class="inTxtNormal"><div align="justify" style="text-indent:35px;"><?php echo $exhibit; ?> </div></td>
                                      </tr>
                                      <tr>
                                        <td class="inTxtHead">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td class=""><strong style="color:#1E5477; font-size:16px;"><?php echo $show_organizer_info; ?></strong></td>
                                      </tr>
                                      <tr>
                                        <td class="inTxtNormal"><div align="justify" style="text-indent:35px;"><?php echo $result['show_organizer'];?></div></td>
                                      </tr>
                                      <tr>
                                        <td><?php if(isset($sess_id))
				 {
				 ?>
                                            <a href="tradecontactsend.php?id=<?php echo $result['show_id']; ?>" class="topics2"><?php echo $contact_now; ?></a>&nbsp;&nbsp;/<a href="tradecontact.php?id=<?php echo $result['show_id']; ?>" class="topics2">&nbsp;&nbsp;<?php echo $contact_view_details; ?></a>
                                            <?php }else{ ?>
                                            <a href="login.php" class="topics2"><?php echo $contact_now; ?></a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="login.php" class="topics2"><?php echo $contact_view_details; ?></a>
                                            <?php } ?>
                                        </td>
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