<?php
include("includes/header.php");

if (isset($_REQUEST['delete'])) {
	$iddd = $_REQUEST['id'];
	$update_com_photo = "UPDATE companyprofile SET companylogo='' WHERE id='$iddd'";
	mysqli_query($con, $update_com_photo);
}

?>
<script type="text/javascript">
	function ValidateForm() {
		alert("hai");
		var bussiness_type = document.addcompanydetails.bussiness_type.value;
		var P_service = document.addcompanydetails.P_service.value;
		var company_address = document.addcompanydetails.company_address.value;
		var companylogo = document.addcompanydetails.companylogo.value;
		var url = document.addcompanydetails.url.value;


		if (bussiness_type == "") {
			alert("Please Enter Bussiness Type ");
			document.addcompanydetails.bussiness_type.focus();
			return false
		}
		if (P_service == "") {
			alert("Please Enter Your Service ");
			document.addcompanydetails.P_service.focus();
			return false
		}
		if (company_address == "") {
			alert("Please Enter Company Address");
			document.addcompanydetails.company_address.focus();
			return false
		}
		if (companylogo == "") {
			alert("Please Upload Company Logo");
			document.addcompanydetails.companylogo.focus();
			return false
		}

		var fnam = document.addcompanydetails.companylogo.value;
		var splt = fnam.split('.');
		var chksplt = splt[1].toLowerCase();

		if (chksplt == 'jpg' || chksplt == 'jpeg') {} else {
			alert(" Upload Image with extensions only jpg, jpeg ");
			return false;
		}

		if (document.addcompanydetails.brand.value == "") {
			alert("Please Enter The Brand Name");
			document.addcompanydetails.brand.focus();
			return false;
		}

		if (document.addcompanydetails.noofemployee.value == "") {
			alert("Please Enter The No. of Employees");
			document.addcompanydetails.noofemployee.focus();
			return false;
		}
		if (url == "") {
			alert("Please Enter Company URL");
			document.addcompanydetails.url.focus();
			return false
		}
		var tomatch = /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/
		if (tomatch.test(url)) {

		} else {
			window.alert("Invalid. Try again. http://www.google.com");
			document.addcompanydetails.url.focus()
			return false;
		}

		if (document.addcompanydetails.year.value != "") {
			if (isNaN(document.addcompanydetails.year.value)) {
				alert("Please Enter the year in Numeric Form");
				document.addcompanydetails.year.focus()
				return false;
			}
			if ((document.addcompanydetails.year.value <= 0) || (document.addcompanydetails.year.value.length != 4)) {
				alert("Please Enter the year in YYYY Format");
				document.addcompanydetails.year.focus()
				return false;
			}
		}
	}
</script>
<script language="javascript">
	function confirm_delete() {
		if (confirm('Are you sure want to delete this record?')) {
			return true;
		} else {
			return false;
		}
	}
</script>

<?php /*?><?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;" > Updated Suceessfully </div>
<?php } ?>
<?php */ ?>


<div class="body-cont">

	<div class="body-cont1">
		<div class="company__container">
			<?php include("includes/side_menu.php"); ?>



			<div class="body-right">

				<?php include("includes/menu.php"); ?>

				<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

				<div class="tabs-cont">
					<div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
						<div class="bordersty">
							<div class="headinggg"> <?php echo $company_details; ?></div>
							<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
							<table width="100%" border="0" cellpadding="3" cellspacing="2">
								<tr>
									<td>&nbsp;</td>
								</tr>
								<?php if (isset($_REQUEST['succ'])) { ?>
									<tr>
										<td style="color:#009900; font-weight:bold;" colspan="4" align="center"><?php echo $company_success; ?> !</td>
									</tr>
								<?php } ?>
								<?php
								if ($_SESSION['language'] == 'english') {
									$sql = (mysqli_query($con, "select * from  registration where lang_status='0' and id='$session_user'"));
								} else if ($_SESSION['language'] == 'french') {
									$sql = (mysqli_query($con, "select * from  registration where lang_status='1' and id='$session_user'"));
								} else {
									$sql = (mysqli_query($con, "select * from  registration where lang_status='2' and id='$session_user'"));
								}

								$count = mysqli_num_rows($sql);
								$row = mysqli_fetch_array($sql);
								//echo $row['email'];

								$cou = $row['country'];
								$sql_country = (mysqli_query($con, "select * from country where country_id='$cou'"));
								$row_country = mysqli_fetch_array($sql_country);
								$row_country['country_name'];
								?>
								<tr>
									<td width="10%">&nbsp;</td>
									<td align="left" class=""><span style="font-size:12px"><strong><?php echo $country; ?></strong></span></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_country['country_name']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td width="37%" align="left" class=""><strong><?php echo $company_name; ?></strong></td>
									<td width="3%" align="center" class="blackBo">:</td>
									<td width="50%" class="" align="left"><span style="font-size:12px"><?php echo $row['companyname']; ?></span></td>
								</tr>
								<?php
								//echo "select * from  companyprofile where user_id='$session_user'"; 
								if ($_SESSION['language'] == 'english') {
									$sql_cp = (mysqli_query($con, "select * from  companyprofile where lang_status='0' and user_id='$session_user'"));
								} else if ($_SESSION['language'] == 'french') {
									$sql_cp = (mysqli_query($con, "select * from  companyprofile where lang_status='1' and user_id='$session_user'"));
								} else {
									$sql_cp = (mysqli_query($con, "select * from  companyprofile where lang_status='2' and user_id='$session_user'"));
								}

								$count_cp = mysqli_num_rows($sql_cp);
								$row_cp = mysqli_fetch_array($sql_cp);


								?>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $bussiness_mail; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row['email']; ?></span></td>
								</tr>
								<?php /*?><tr>
					  <td>&nbsp;</td>
                        <td align="left" class=""><strong>Business Type</strong></td>
                        <td align="center" class="blackBo">:</td>
                        <?php $Bty= $row_cp['bussiness_type']; if($Bty==""){ $BTY="No Records";} else{$BTY=$Bty;} ?>
                        <td class="" align="left"><span style="font-size:12px"><?php echo $BTY; //echo $row_cp['bussiness_type'];?></span></td>
                      </tr><?php */ ?>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $bussiness_type; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<?php
									$type = $row_cp['bussiness_type'];
									if ($_SESSION['language'] == 'english') {
										$sel_type = mysqli_query($con, "select * from business_type where buss_id='$type' ");
									} else if ($_SESSION['language'] == 'french') {
										$sel_type = mysqli_query($con, "select * from business_type_french where buss_id='$type' ");
									} else {
										$sel_type = mysqli_query($con, "select * from business_type_chinese where buss_id='$type' ");
									}

									$sel_type = mysqli_query($con, "select * from business_type where buss_id='$type' ");
									$array = mysqli_fetch_array($sel_type);
									?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $array['buss_type']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $product_service; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<?php $Pser = $row_cp['P_service'];
									if ($Pser == "") {
										$PSER = "No Records";
									} else {
										$PSER = $Pser;
									} ?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $PSER; //echo $row_cp['P_service'];
																							?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $com_address; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<?php $Ads = $row_cp['company_address'];
									if ($Ads == "") {
										$ADS = "No Records";
									} else {
										$ADS = $Ads;
									} ?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $ADS; //echo $row_cp['company_address'];
																							?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $com_logo; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="inTxtNormal" align="left">
										<?php
										$imgpath1 = "logo/" . $row_cp['companylogo'];
										if ($row_cp['companylogo'] == "" || !file_exists($imgpath1)) {
										?>
											<img src="<?php echo "blog_photo_thumbnail/profile_pic_small.gif"; ?>" width="75" height="75">
										<?php
										} else {
										?>

											<img src="<?php echo "logo/" . $row_cp['companylogo']; ?>" width="75" height="75" /> &nbsp;&nbsp;<a href="company.php?id=<?php echo $row_cp['id']; ?>&delete" onclick="return confirm_delete();">Delete</a>
										<?php
										}

										?>


										<!--<img src="<?php //echo $Photo; 
														?>" width="50" height="50" />-->
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $com_url; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<?php $Url = $row_cp['url'];
									if ($Url == "") {
										$URL = "No Records";
									} else {
										$URL = $Url;
									} ?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $URL; //echo $row_cp['url'];
																							?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong>
											<?php echo $company_intro; ?> </strong></td>
									<td align="center" class="blackBo">:</td>
									<?php $Cdts = $row_cp['company_details'];
									if ($Cdts == "") {
										$CDTS = "No Records";
									} else {
										$CDTS = $Cdts;
									} ?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $CDTS; //echo $row_cp['company_details'];
																							?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $year_established ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<?php $Yr = $row_cp['year'];
									if ($Yr == "") {
										$YR = "No Records";
									} else {
										$YR = $Yr;
									} ?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $YR; //echo $row_cp['year'];
																							?></span></td>
								</tr>
								<tr>
									<td height="35">&nbsp;</td>
									<td align="left" class=""><strong><?php echo $managemrnt_certification; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<?php $Mgt = $row_cp['mgmtcertification'];
									if ($Mgt == "") {
										$MGMT = "No Records";
									} else {
										$MGMT = $Mgt;
									} ?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $MGMT; //echo $row_cp['mgmtcertification'];
																							?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $brands; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<?php $Bd = $row_cp['brand'];
									if ($Bd == "") {
										$BRD = "No Records";
									} else {
										$BRD = $Bd;
									} ?>
									<td class="" align="left"><span style="font-size:12px"><?php echo $BRD; //echo $row_cp['brand'];
																							?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $bussiness_owner; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['bussinessowner']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $registerd_capital; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['registeredcapital']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $ownership_type; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['ownertype']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $main_market; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['mainmarkets']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $main_customer; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['maincustomer']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $tot_annual; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['toannualsalesvolume']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $export; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['exportpercentage']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $tot_annual_volume; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['toannualpurchasevolume']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $factory_size; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['factorysize']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $factory_location; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['factorylocation']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $qa; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['qa/qc']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $no_production; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['noofprodlines']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $no_rd_staff; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['noofr&dstaff']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $no_of_qc_staff; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['noofqcstaff']; ?></span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class=""><strong><?php echo $con_manage; ?></strong></td>
									<td align="center" class="blackBo">:</td>
									<td class="" align="left"><span style="font-size:12px"><?php echo $row_cp['contactmant']; ?></span></td>
								</tr>
								<tr>
									<td colspan="4" align="center" style="padding-top:10px;"><a href="editcompany.php"><input type="submit" class="search_bg" value="<?php echo $edit; ?>" /></a></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td colspan="3" class="" align="center">
										<!--   <a href="editcompanyprofile.php" ><input type="button" class="search_bg" name="btnedit" value="edit"  /></a> -->
										<!--						  <a href="javascript:void(0);" onClick="javascript:location.href='editcompanyprofile.php'"><input type="button" class="search_bg" name="btnedit" value="edit"  /></a>-->

										<?php
										$comp_sel = mysqli_num_rows(mysqli_query($con, "select * from companyprofile where user_id=$sess_id"));

										if ($comp_sel > 0) {
											$action_url = "editcompanyprofile.php";
										} else {
											$action_url = "createcompanyprofile.php";
										}
										?>
										<!--   <a href="editcompanyprofile.php" ><input type="button" class="search_bg" name="btnedit" value="edit"  /></a> -->
										<!--<a href="javascript:void(0);" onClick="javascript:location.href='<?php echo $action_url; ?>'"><input type="button" class="search_bg" name="btnedit" value="edit"  /></a>-->
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