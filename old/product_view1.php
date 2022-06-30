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
$pro=$_REQUEST['pid'];
$res="select * from featureproducts where id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
//echo '<pre>';
//print_r($result);
//echo '</pre>';
 if($_SESSION['language']=='english')
{
$delivery=$result['pakage_details'];
$address=$result['address'];
}
else if($_SESSION['language']=='french')
{
$delivery=$result['pakage_details_french'];
$address=$result['address_french'];
}
else if($_SESSION['language']=='chinese')
{
$delivery=$result['pakage_details_chinese'];
$address=$result['address_chinese'];
}
else
{
$delivery=$result['pakage_details_spanish'];
$address=$result['address_spanish'];
}
$id=$result['user_id'];

$res3=mysqli_query($con,"select * from country where country_id='$result[seller_country]'");
$result1=mysqli_fetch_array($res3);
$result1['country'];
?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <span> <?php echo ucfirst($result['f_pdt_name']);?></span></div>
<div style="border: solid 1px #CFCFCF;">




 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box" >
                            <tr>
                              <td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" >
                                <tr>
                                  <td ><table width="100%" >
                                      
                                      <tr>
                                        <td width="36%"><table width="103%" height="63">
                                            <tr>
                                              <td height="48"><?php if((file_exists("admin/picture/".$result['f_pdt_images']))&&($result['f_pdt_images']!='')) { ?><img src="<?php echo "admin/picture/".$result['f_pdt_images']; ?>" height="125" width="125" border="0"/><?php } else {  ?><img src="images/img_noimg.jpg" height="128" width="128" /><?php } ?></td>
                                            </tr>
                                        </table></td>
                                        <td width="64%"><table width="100%">
                                            <tr>
                                              <td width="49%" class="labelname"><?php echo $post_date; ?> :</td>
                                              <td width="51%" class="labeltext"><?php if($result['f_pdt_up_date']!='') {echo $result['f_pdt_up_date'];} else{ echo "<font color='red'>Not Mentioned</a>";}
										?></td>
                                          </tr>
                                            <tr>
                                              <td width="49%" class="labelname"><?php echo $expired_date; ?> :</td>
                                              <td width="51%" class="labeltext"><?php if($result['f_pdt_exp_date']!='') {echo $result['f_pdt_exp_date']; } else{ echo "<font color='red'>Not Mentioned</a>"; }?></td>
                                          </tr>
                                            <tr>
                                              <td class="labelname"><?php echo $minimum_order_qua; ?> :</td>
                                              <td width="51%" height="30" class="labeltext"><?php if($result['minimum_quantity']!='') {echo $result['minimum_quantity']; } else{ echo "<font color='red'>Not Mentioned</a>"; }?></td>
                                          </tr>
                                            <!--<tr>
                                              <td class="labelname"><?php echo $expired_date; ?>  :</td>
                                              <td class="labeltext"><?php echo str_replace('.','-',$result['f_pdt_exp_date']);?></td>
                                            </tr>-->
                                            <tr>
                                              <td class="labelname"><?php echo $delivery_lead; ?> :</td>
                                              <td  class="labeltext"><?PHP echo str_replace('.','-',$result['deliverytime']);?></td>
                                            </tr>
                                            <tr>
                                              <td class="labelname"><?php echo $delivery_details; ?> : </td>
                                              <td class="labeltext"><?php if($delivery!='') {echo $delivery; } else{ echo "<font color='red'>Not Mentioned</a>"; }?></td>
                                            </tr>
                                            <tr>
                                              <td class="labelname"><?php echo $supply_ability; ?> :</td>
                                              <td  class="labeltext"><?PHP if($result['minimum_quantity']!=''){ echo $result['minimum_quantity']; }else { echo "<font color='red'>Not Mentioned</a>"; }?><?PHP if($result['pdt_quantity']!='') {echo $result['pdt_quantity']; } else { echo "<font color='red'>Not Mentioned</a>"; }?></td>
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
				            /* $sql=(mysqli_query($con,"select * from  registration"));
							 $row=mysqli_fetch_array($sql);
							 $rid=$row['id'];
							 $sql_cp=(mysqli_query($con,"select * from companyprofile where user_id='$id'"));
							 $count_cp=mysqli_num_rows($sql_cp);
							 $row_cp=mysqli_fetch_array($sql_cp);*/
					?>
                                        <td height="25" colspan="3" align="left" valign="middle" class="cent_bold">&nbsp;&nbsp;<strong style="font-size:16px; color:#1E5477;"><?php echo $company_info; ?></strong> </td>
                                        <!--<td width="29%" rowspan="3" align="center"><a href=<?php if(isset($sess_id)){ ?>"featureaction.php?id=<?php echo $result['id'];?>"<?php }else{ ?>"login_1.php" <?php } ?> class="news">Online</a></td>-->
                                      </tr>
                                      <tr>
                                        <td width="35%" height="30" class="labelname"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $company_estabilished_on; ?>: </strong></span></td>
                                        <td width="36%" colspan="2" class="inTxtNormal"><span style="font-size:12px"><?php echo $result['company_start'];?></span></td>
                                      </tr>
                                      <tr>
                                        <td width="35%" height="30" class="labelname"><span style="font-size:12px;padding-left:3px;"><strong>&nbsp;<?php echo $address; ?>:</strong></span></td>
                                        <td colspan="2" class="inTxtNormal"><span style="font-size:12px"><?php echo $address;?></span></td>
                                      </tr>
                                      <?php
						     $sql=(mysqli_query($con,"select * from  registration"));
							$count=mysqli_num_rows($sql);
							$row=mysqli_fetch_array($sql);
							//echo $row['company_address'];
	                        $cou=$result['country'];					  
						    $sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
							$row_country=mysqli_fetch_array($sql_country);
							$row_country['country_name'];
						  ?>
                                      <tr>
                                        <td class="labelname"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $contry; ?> :</strong></span></td>
                                        <td class="inTxtNormal"><span style="font-size:12px"><?php echo $row_country['country_name'];?></span></td>
                                        <td rowspan="3" align="center" class="enquire"><?php if(isset($sess_id)){ ?><a href="featureaction.php?id=<?php echo $result['id'];?>" class="news buttonstyle" ><?php echo $inquiry; ?></a>  <?php }else{ ?><a href="login.php"class="news buttonstyle">Inquiry</a>  <?php } ?>
                                              <!--<input name="Submit" type="image" value="Contact now" src="images/bu_ContactNow.gif" />-->
                                        </a></td>
                                      </tr>
                                      <tr>
                                        <td><span class="blackBo"><strong>&nbsp;</strong></span></td>
                                        <td>&nbsp;</td>
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


