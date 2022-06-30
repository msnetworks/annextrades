<?php include("includes/header.php");

//print_r($_REQUEST['property']);

 ?>

<script type="text/javascript">
  function searchlist(id) {
    var currentDiv;
    currentDiv = document.getElementById(id);
    if (currentDiv != null) {
	currentDiv.style.display = 'none';
    }
	else{  
    currentDiv.style.display = 'block';
    }
}

function checkbox() {
//alert("hai");
	var lengthcount=document.searching.maxvalue.value;
//alert(lengthcount);
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var property = "property["+i+"]";
	 
	  var dom = document.getElementById(property);//alert(dom);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	
	if(checkedcount < 1) {
			alert("Select Atleast One product");
			return false;
		}
   else if(checkedcount>3)
   {
   	alert("Select Maximum Three Products Only ");
	return false;	
   }
}
function compare(){
 //alert("hai");
	var result=checkbox();
	if(result == false) {
		return false;
	}
	else {
	
	 document.searching.submit();
	}
}
function comp()
{
document.searching.Submit.readOnly=false;
}

function checking()
{
alert("You can't add contact to your Own Product");
}
</script>


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
$res="select * from buyingleads where buy_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
 
//$id=$result['user_id'];
$id=$result['id'];
$res3=mysqli_query($con,"select * from country where country_id='$result[seller_country]'");
$result1=mysqli_fetch_array($res3);
$result1['country'];
?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <span> <?php echo $result['subject']; ?></span></div>
<div style="border: solid 1px #CFCFCF;">




 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box" >
                            <tr>
                              <td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" >
                                <tr>
                                  <td ><table width="100%" >
                                      
                                      <tr>
                                        <td width="36%"><table width="103%" height="63">
                                            <tr>
                                              <td height="48"><?php if((file_exists("upload/".$result['photo']))&&($result['photo']!='')) { ?><img src="<?php echo "upload/".$result['photo']; ?>" height="125" width="125" border="0"/><?php } else {  ?><img src="images/img_noimg.jpg" height="128" width="128" /><?php } ?></td>
                                            </tr>
                                        </table></td>
										<?php 
							$conname=$result['country'];
							$sel_cou=mysqli_query($con,"select * from country where country_id='$conname'");
							$cou_fetch=mysqli_fetch_array($sel_cou);
							?>
                                        <td width="64%"><table width="100%">
                                            <tr>
                                              <td width="45%" class="labelname"><strong><?php echo $place_origin; ?> :</strong></td>
                                              <td width="55%" class="labeltext"><span style="font-size:12px"><?php echo $cou_fetch['country_name'];?></span></td>
                                            </tr>
                                           <!-- <tr>
                                              <td width="45%" class="labelname"><strong><?php echo $product_model; ?> : </strong></td>
                                              <td width="55%" class="labeltext"><span style="font-size:12px"><?php echo $result['keyword'];?></span></td>
                                            </tr>-->
                                            <tr>
                                              <td class="labelname"><strong><?php echo $post_date; ?> : </strong></td>
                                              <td width="55%" height="30" class="labeltext"><span style="font-size:12px"><?php echo $result['update_date'];?></span></td>
                                            </tr>
                                            <tr>
                                              <td class="labelname"><strong><?php echo $product_descrip; ?> :</strong></td>
                                              <td class="labeltext"><span style="font-size:12px"><?php echo $result['briefdes'];?></span></td>
                                            </tr>
                                            <tr>
                                              <td class="labelname"><strong><?php echo $price_range; ?> :</strong></td>
                                              <td  class="labeltext"><span style="font-size:12px"><?php echo $result['price']."~~".$result['range1']."/".$result['range2'];?></span></td>
                                            </tr>
                                            <tr>
                                              <td class="labelname"><strong><?php echo $minimum_order_qua; ?></strong></td>
                                              <td class="labeltext"><span style="font-size:12px"><?php echo $result['miniquantity'];?></span></td>
                                            </tr>
                                            <tr>
                                              <td class="labelname"><strong><?php echo $expiry_date; ?> :</strong></td>
                                              <td  class="labeltext"><span style="font-size:12px"><?php echo $result['expiredate'];?></span></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr> </tr>
                                <tr>
                                  <td ><table width="100%" background="1" >
                                      <tr>
                     <?PHP 
				 		  $sql_cp=(mysqli_query($con,"select * from  companyprofile where user_id='$id'"));
							 $count_cp=mysqli_num_rows($sql_cp);
							 $row_cp=mysqli_fetch_array($sql_cp);
					?>
                                        <td height="25" colspan="3" align="left" valign="middle" class="cent_bold">&nbsp;&nbsp;<strong style="font-size:16px; color:#1E5477;"><?php echo $company_info; ?></strong> </td>
                                        <!--<td width="29%" rowspan="3" align="center"><a href=<?php if(isset($sess_id)){ ?>"featureaction.php?id=<?php echo $result['id'];?>"<?php }else{ ?>"login_1.php" <?php } ?> class="news">Online</a></td>-->
                                      </tr>
                                      <tr>
                                        <td width="35%" height="30" class="labelname"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $date_joined; ?> :</strong></span></td>
                                        <td width="36%" colspan="2" class="inTxtNormal"><span style="font-size:12px"><?php echo $row_cp['year'];?></span></td>
                                      </tr>
                                      <tr>
                                        <td class="labelname"><span style="font-size:12px"><strong>&nbsp;<?php echo $product_service; ?>:</strong></span></td>
                                        <td colspan="2" class="inTxtNormal"><span style="font-size:12px"><?php echo $row_cp['P_service'];?></span></td>
                                      </tr>
                                       <?php
						     $sql=(mysqli_query($con,"select * from  registration"));
							$count=mysqli_num_rows($sql);
							$row=mysqli_fetch_array($sql);
							//echo $row['company_address'];
	                        $cou=$row['country'];					  
						    $sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
							$row_country=mysqli_fetch_array($sql_country);
							$row_country['country_name'];
						  ?>
                                      <tr>
                                        <td class="labelname"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $contry; ?> :</strong></span></td>
                                        <td class="inTxtNormal"><span style="font-size:12px"><?php echo $row_country['country_name'];?></span></td>
                                        <td rowspan="3" align="center" class="enquire"><a href=
					<?php 
					if(isset($sess_id))
					{
					if($id==$sess_id)
					{
					?>
					"#" onclick="return checking();"
					<?php 
					}else{
					?>
					"catmail.php?buyid=<?php echo $result['buy_id'];?>"
					<?php 
					}
					}else{ 
					?>"login.php" 
					<?php 
					} 
					?> class="topics2"> <?php echo $inquiry; ?></a>  
                                              <!--<input name="Submit" type="image" value="Contact now" src="images/bu_ContactNow.gif" />-->
                                        </a></td>
                                      </tr>
                                      <tr>
                                        <td><span class="blackBo"><strong>&nbsp;<?php echo $bussiness_type; ?> :</strong></span></td>
                                        <td><?php echo $row_cp['bussiness_type'];?></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <!--<td width="32%" height="30">Terms Of Payment:&nbsp;&nbsp;<span class="orgli"><?PHP echo $result['payment_terms'];?></span></td>-->
                                            </tr>
                                            <tr> </tr>
                                            <tr>
                                              <td colspan="3">&nbsp;</td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table></td>
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


