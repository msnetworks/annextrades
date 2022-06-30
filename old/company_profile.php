<?php include("includes/header.php");
 $id=$_REQUEST['id'];

$sql=(mysqli_query($con,"select * from  registration where id='$id'"));
$count=mysqli_num_rows($sql);
$row=mysqli_fetch_array($sql);


//echo $row['company_address'];
$cou=$row['country'];					  
$sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
$row_country=mysqli_fetch_array($sql_country);
$row_country['country_name'];
 
//echo "select * from companyprofile where user_id='$id' and approval_status='0'";
$sql_cp=(mysqli_query($con,"select * from companyprofile where user_id='$id' and approval_status='0'"));
 $count_cp=mysqli_num_rows($sql_cp);
 $row_cp=mysqli_fetch_array($sql_cp);
$ccid=$row_cp['id'];
$uid=$row_cp['user_id'];
?>

<script type="text/javascript">

function popUp1(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300,left = 150,top = 234');");
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





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading" > <span style="font-weight:bold;"> <?php echo $com_profile; ?></span></div>
<div style="border: solid 1px #CFCFCF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr></tr>
                                  
								  <?php
								  if($count_cp > 0)
								  {
								  ?>
								  <tr>
                                    <td><table width="100%" height="443" border="0"  bordercolor="" cellpadding="0" cellspacing="0" >
                                      <tr>
                                        <td><form action="" method="post" enctype="multipart/form-data" name="buying" id="buying" onsubmit="return validate(this)">
                                          <input type="hidden" id="hiddivval" name="divval" value=""/>
                                            <table width="100%" border="0" cellpadding="6" cellspacing="0" >
                                             <!-- <tr class="titlelink">
                                                <td colspan="4" align="center" class="prodcuts_search"><strong>My Company Profiles<strong></td>
                                              </tr>-->
											  <tr>
											  <td>&nbsp;</td></tr>
                                              <tr>
                                                <td width="4%">&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $country; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_country['country_name']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td width="44%" align="left" class="prodcuts_search"><strong><?php echo $company_name; ?></strong></td>
                                                <td width="3%" align="center" class="">:</td>
                                                <td width="49%" class="normal"><?php  echo $row['companyname']; ?></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $bussiness_mail; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row['email']; ?></td>
                                              </tr>
                                              <?php
			  if($row_cp['bussiness_type']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $business_type; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['bussiness_type'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['P_service']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $product_service; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['P_service'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['company_address']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $com_address; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['company_address'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $com_logo; ?></strong></td>
                                                <td align="center" class="normal">:</td>
                                                <td><?php if ($row_cp['companylogo'] == "")  { $Photo="Logo/img_noimg.jpg";  } else { $Photo = "Logo/".$row_cp['companylogo']; }?>
                                                    <img src="<?php echo $Photo; ?>" width="50" height="50" /></td>
                                              </tr>
                                              <?php
			  if($row_cp['url']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $com_url; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['url'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['company_details']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $company_intro; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['company_details'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['year']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $year_established; ?></strong> </td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['year'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['mgmtcertification']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $managemrnt_certification; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['mgmtcertification'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['brand']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search" ><strong><?php echo $brands; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['brand'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['bussinessowner']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $bussiness_owner; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['bussinessowner'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['registeredcapital']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $registerd_capital; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['registeredcapital'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['ownertype']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $ownership_type; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['ownertype'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['mainmarkets']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $main_market; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['mainmarkets'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['maincustomer']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $main_customer ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class=""><?php echo $row_cp['maincustomer'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['toannualsalesvolume']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $tot_annual; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['toannualsalesvolume'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['exportpercentage']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $export; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['exportpercentage'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['toannualpurchasevolume']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $tot_annual_volume; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['toannualpurchasevolume'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['factorysize']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $factory_size; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['factorysize'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['factorylocation']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $factory_location; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['factorylocation'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['qa/qc']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $qa; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['qa/qc'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['noofprodlines']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $no_production; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['noofprodlines'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['noofr&dstaff']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $no_rd_staff; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['noofr&dstaff'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['noofqcstaff']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><strong><?php echo $no_of_qc_staff; ?></strong></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['noofqcstaff'];?></td>
                                              </tr>
                                              <?php
			  }else{}
			  if($row_cp['contactmant']!="")
			  {
			  ?>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td align="left" class="prodcuts_search"><?php echo $con_manage; ?></td>
                                                <td align="center" class="">:</td>
                                                <td class="normal"><?php echo $row_cp['contactmant'];?></td>
                                              </tr>
                                              <?php
			 }else{}
			 ?>
                                              <tr>
                                                <td align="center" class="" colspan="4">&nbsp;</td>
                                              </tr>
                                              <?php
			  //echo "select * from companyrating where otterid='$sess_id' and ratingcompany='$ccid'";
			  $se=mysqli_query($con,"select * from companyrating where otterid='$sess_id' and ratingcompany='$ccid'");
			  $num=mysqli_num_rows($se);
			 // echo $uid;
			  if($_SESSION['user_login']!="")
			  {
			  if($num > 0)
			  {
			if($uid==$sess_id)
		   	{
			
			 ?>
                                              <tr>
                                                <td align="left" class="" colspan="4"><strong><?php echo $give_company_rating; ?>?</strong><a href="#" onclick="return checking();" class="topics"><?php echo $clk_here; ?> </a></td>
                                              </tr>
                                              <?php
		   }else{
		   ?>
                                              <tr>
                                                <td align="left" class="" colspan="4"><strong><?php echo $give_company_rating; ?>?</strong><a href="javascript:popUp1('companyratingres.php?id=<?php echo $id;?>')" class="topics"><?php echo $clk_here; ?></a></td>
                                              </tr>
                                              <?php
		   }
		   }else{
			 ?>
                                              <tr>
                                                <td align="left" class="prodcuts_search" colspan="4"><strong><?php echo $give_company_rating; ?>?</strong><a href="javascript:popUp1('companyrating.php?id=<?php echo $id;?>')" class="topics"><?php echo $clk_here; ?> </a></td>
                                              </tr>
                                              <?php
			  }
			   }else{}
			  ?>
                                            </table>
                                        </form></td>
                                      </tr>
                                    </table></td>
                                  </tr>
								   <?php
							  }
							  else
							  {
							  ?>
							  <tr><td align="center">&nbsp;</td></tr>
							  <tr><td align="center" colspan="4"><font color="#FF0000"><?php echo $no_record; ?></font></td></tr>
							  <?php
							  }
							  ?>
								  
             
                              </table>


					  </div>

</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>


