<?php 
include("includes/header.php");
$id=$_REQUEST['id'];
$sess_id=$_SESSION['sess_id']; 
$id=$_REQUEST['id'];
$selectproduct=mysqli_query($con,"select * from product where id='$id'");
$rowproduct=mysqli_fetch_array($selectproduct);
 ?>
 <style type="text/css">

 </style>
 
    <div class="body-cont">
      <div class="body-cont1">
        <div class="company__container">
          <?php include("includes/side_menu.php"); ?>
          <div class="body-right">
            <?php include("includes/menu.php"); ?>
              <!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
              <div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
              <div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
                <div   class="bordersty">
                  <div class="headinggg"><?php echo $product_view; ?> </div>
                    <!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
                    <p>
                      <?PHP /* echo $rowproduct['p_bdes']; */
                        $bdes=$rowproduct['p_bdes'];
                          /*  $bdes =  html_entity_decode($bdes); 
                            $bdes= strip_tags($bdes); */
                            /* echo $bdes ; */
                          
                      ?>
                    </p>
                    <table width="100%" height="733" border="0" cellpadding="2" cellspacing="2"  style="padding-left:50px;">
                      <tr>
                        <td colspan="2"><strong><?php echo $basic_info; ?></strong></td>
                      </tr>
                      <tr>
                        <td width="39%" class="" align="left"><?php echo $pro_name;?>:</td>
                        <td width="61%"><span style="font-size:12px"><?PHP echo $rowproduct['p_name'];?></span></td>
                      </tr>
                      <tr>
                        <td width="39%" class=""><?php echo $pro_keyword; ?>:</td>
                        <td width="61%"><span style="font-size:12px"><?PHP echo $rowproduct['p_keyword']?></span></td>
                      </tr>
                      <?PHP //echo $rowproduct['p_category'];
                      //echo "SELECT * FROM `category` where c_id='$rowproduct[p_category]'";
                        $querycat=mysqli_query($con,"SELECT * FROM `category` where c_id='$rowproduct[p_category]'");
                        $r=mysqli_fetch_array($querycat);
                      ?>
                      <tr>
                        <td class=""><?php echo $pro_cat; ?>:</td>
                        <td><span style="font-size:12px"><?PHP echo $r['category'];?></span></td>
                      </tr>
                      <tr>
                        <?PHP 
                        //echo "SELECT * FROM `category` where c_id='$rowproduct[p_subcategory]'";   
                          $querycat1=mysqli_query($con,"SELECT * FROM `category` where c_id='$rowproduct[p_subcategory]'");
                          $r1=mysqli_fetch_array($querycat1);
                        ?>
                        <td width="39%" class=""><?php echo $sel_pro_cat; ?></td>
                        <td width="61%"><span style="font-size:12px"><?PHP echo $r1['category']; ?></span></td>
                      </tr>
                      <tr>
                        <td width="39%" class=""><?php echo $country; ?></td>
                          <?PHP 
                        
                        $qq=mysqli_query($con,"select * from country where country_id='$rowproduct[country]'");
                        $rr=mysqli_fetch_array($qq);
                        ?>
                        <td width="61%"><span style="font-size:12px"><?PHP echo $rr['country_name']; ?></span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong><?php echo $make_your_product; ?> </strong></td>
                      </tr>
                      <tr>
                        <td class=""><?php echo $product_photo; ?>:</td>
                        <td>
                        <?PHP /* echo "productlogo/".$rowproduct['p_photo']; */ ?>
                        <img src="<?PHP echo ($rowproduct['p_photo']!=""&& (file_exists("productlogo/".$rowproduct['p_photo'])))  ?     "productlogo/".$rowproduct['p_photo']  :  "productlogo/profile_pic_small.gif" ; ?>" name="p_photo" border="0" style="width: 300px;"><br /> <a href="morephotos.php?id=<?php echo $id;?>" class="topics"><b><?php echo $more_photos; ?></b></a>
                        <div id="addcomments"  "z-index:3; visibility:block; position:fixed;" ></div></td>
                      </tr>
                      <tr>
                        <td class=""><span style="font-size:14px"><?php echo $breif_des; ?></span> </td>
                        <td class=""><span style="font-size:12px"><?PHP echo html_entity_decode($bdes); ?></span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong><?php echo $add_detailed_pro; ?></strong></td>
                      </tr>
                      <tr>
                        <td class=""><?php $detail_des; ?></td>
                        <td class=""><span style="font-size:12px">
                          <?PHP echo htmlspecialchars_decode(html_entity_decode($rowproduct['p_ddes']));?> </span></td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <table width="100%">
                            <tr>
                              <td colspan="3"><strong><?php echo $sel_payment_shipping; ?></strong></td>
                            </tr>
                            <tr>
                              <td width="40%" class=""><?php echo $price_range; ?></td>
                              <td colspan="2"><span style="font-size:12px"><?PHP echo $rowproduct['p_price']; ?>&nbsp;&nbsp;
                              <?PHP echo $rowproduct['range1']?>&nbsp;~&nbsp;                                        
                              <?PHP echo $rowproduct['range2']?></span></td>
                            </tr>
                            <tr>
                              <td width="40%" class=""><?php echo $payment_terms; ?>:</td>
                              <td colspan="2"><span style="font-size:12px"><?PHP echo $rowproduct['paymenttype'];?></span></td>
                            </tr>
                            <tr>
                              <td class=""><?php echo $minimum_order_qua; ?></td>
                              <td width="15%"><span style="font-size:12px"><?PHP echo $rowproduct['p_min_quanity']?></span></td>
                              <td width="45%"></td>
                            </tr>
                            <tr>
                              <td class="blackBo">&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                        <!--  <onclick="switchDiv('tabTwo','tabOne'), swapTabs('tab2');">
                                onclick="switchDiv('tabOne','tabTwo'), swapTabs('tab1');"-->
                      <tr>
                        <td colspan="2">
                          <table width="100%">
                            <tr>
                              <td colspan="3"><strong><?php echo $show_buy_abil; ?> </strong></td>
                            </tr>
                            <tr>
                              <td class=""><?php echo $production_capacity; ?>:</td>
                              <td colspan="2"><span style="font-size:12px"><?PHP echo $rowproduct['p_capaacity']?>&nbsp;&nbsp;<?PHP echo $rowproduct['p_ctype']?>
                              &nbsp;<?php echo $mng_productedit_pr;?> &nbsp; <?PHP echo $rowproduct['percapacity'];?>                                   </span> </tr>
                            <tr>
                              <td width="38%" class=""><?php echo $delivery_time; ?>:</td>                 
                              <td colspan="2" class=""><span style="font-size:12px"><?PHP echo $rowproduct['p_delivertytime']?></span></td>
                            </tr>
                            <tr>
                              <td><?php echo $packaging_details; ?>:</td>
                              <td colspan="2" class=""><label>
                                <span style="font-size:12px"><?PHP echo $rowproduct['p_packingdetails']?></span>
                              </label></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td width="37%" class="inTxtNormal">&nbsp;</td>
                              <td width="25%" class="inTxtNormal">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><input class="search_bg" type="button" name="Submit" value="<?php echo $back; ?>" onclick="javascript:history.go(-1);"/></td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  <div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

<?php include("includes/footer.php"); ?>
