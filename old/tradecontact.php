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

<div class="products-cate-heading"> <span><strong> <?php echo $contact_info; ?></strong> </span></div>
<div style="border: solid 1px #CFCFCF;">

 
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                                
                                <?php
			  $pro=$_REQUEST['id'];
$res="select * from tbl_tradeshow where show_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
			  ?>
                                <form id="trade_search" name="trade_search" method="post" action="">
                                  <tr>
                                    <td valign="top" ><table width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $show_org; ?>:</strong></td>
                                          <td class="inTxtNormal"><?php echo $result['show_organizer'];?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $contact_person; ?>:</strong></td>
                                          <td class="inTxtNormal"><?php echo $result['contact_person'];?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $contact_title; ?>:</strong></td>
                                          <td class="inTxtNormal"><?php echo $result['job_title']; ?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $contact_address; ?>:</strong></td>
                                          <td class="inTxtNormal"><?php echo $result['business_address']; ?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $email_add; ?>:</strong></td>
                                          <td class="inTxtNormal"><?PHP echo $result['business_email'];?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $zip_code; ?>:</strong></td>
                                          <td class="inTxtNormal"><?php echo $result['zipcode']; ?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $telephone; ?>:</strong></td>
                                          <td class="inTxtNormal"><?php echo $result['business_phone']; ?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;&nbsp;<strong><?php echo $fax; ?>:</strong></td>
                                          <td class="inTxtNormal"><?php echo $result['organizer_fax']; ?></td>
                                        </tr>
                                        <tr>
                                          <td height="25">&nbsp;</td>
                                          <td align="right"><a href="tradeshow_search.php?id=24"><?php echo $back_to_show; ?></a><a href="tradeshow_search.php?id=<?php echo $result['show_id'];?>" class="topics2"></a></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr> </tr>
                                  <tr>
                                    <td><img src="images/spacer.gif" width="1" height="10" /></td>
                                  </tr>
                                </form>
                                <tr>
                                  <td >&nbsp;</td>
                                </tr>
                                <tr> </tr>
                              </table>  


</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>