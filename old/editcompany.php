<?php 
include("includes/header.php");
if(isset($_POST['submit']))
{
$user_type=mysqli_real_escape_string($con, $_POST['user_type']);
$fname=mysqli_real_escape_string($con, $_POST['fname']);
$lname=mysqli_real_escape_string($con, $_POST['lname']);
$gender=mysqli_real_escape_string($con, $_POST['gender']);
$ph_no=mysqli_real_escape_string($con, $_POST['ph_no']);
$mble_no=mysqli_real_escape_string($con, $_POST['mble_no']);
$fax_no=mysqli_real_escape_string($con, $_POST['fax_no']);
//$mble_no=mysqli_real_escape_string($con, $_POST['mble_no']);
//$fax_no=mysqli_real_escape_string($con, $_POST['fax_no']);
$address=mysqli_real_escape_string($con, $_POST['address']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$country=mysqli_real_escape_string($con, $_POST['country']);
$zip_code=mysqli_real_escape_string($con, $_POST['zip_code']);
$cmpny_name=mysqli_real_escape_string($con, $_POST['cmpny_name']);

/*$udate_user=mysqli_query($con,"UPDATE registration SET usertype='$user_type', firstname='$fname',lastname='$lname',gender='$gender', phonenumber='$ph_no', mobile='$mble_no', faxnumber='$fax_no', street='$address', city='$city', state='$state', country='$country', zipcode='$zip_code',  companyname='$cmpny_name' WHERE id='$session_user'");

header("location:myprofile.php?suc");*/
}

 ?>
<script type="text/javascript">
			function ValidateForm()
              {
				//alert("hai"); 
				 var bussiness_type=document.addcompanydetails.bussiness_type.value;
				 var P_service=document.addcompanydetails.P_service.value;
				 var company_address=document.addcompanydetails.company_address.value;
				 var companylogo=document.addcompanydetails.companylogo.value;
				 var url=document.addcompanydetails.url.value;
			
			
			if(bussiness_type=="")
				{
					alert("Please Enter Bussiness Type ");
					document.addcompanydetails.bussiness_type.focus();
					return false
				}
			if(P_service=="")
				{
					alert("Please Enter Your Service ");
					document.addcompanydetails.P_service.focus();
					return false
				}
			if(company_address=="")
				{
					alert("Please Enter Company Address");
					document.addcompanydetails.company_address.focus();
					return false
			}			
			if(companylogo=="")
				{
					alert("Please Upload Company Logo");
					document.addcompanydetails.companylogo.focus();
					return false
				}
			
				var fnam=document.addcompanydetails.companylogo.value;
				var splt=fnam.split('.');
				var chksplt=splt[1].toLowerCase();
				
				if(chksplt=='jpg'|| chksplt=='jpeg')
				{
				}
				else
				{
				alert(" Upload Image with extensions only jpg, jpeg ");
				return false;
				}	
            
			if(document.addcompanydetails.brand.value=="")
		{
		 alert("Please Enter The Brand Name");
		 document.addcompanydetails.brand.focus();
		 return false;
		 }
			
			if(document.addcompanydetails.noofemployee.value=="")
		{
		 alert("Please Enter The No. of Employees");
		 document.addcompanydetails.noofemployee.focus();
		 return false;
		 }
			  if(url=="")
				{
					alert("Please Enter Company URL");
					document.addcompanydetails.url.focus();
					return false
				}	
	var tomatch= /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/
     if (tomatch.test(url))
     {
         
     }
     else
     {
         window.alert("Invalid. Try again. http://www.google.com");
		 document.addcompanydetails.url.focus()
         return false; 
	}
	
	if(document.addcompanydetails.year.value!="")
	{
		if(isNaN(document.addcompanydetails.year.value))
		{
			alert("Please Enter the year in Numeric Form");
			document.addcompanydetails.year.focus()
			return false;
		}
		if((document.addcompanydetails.year.value <=0)||(document.addcompanydetails.year.value.length !=4) )
		{
			alert("Please Enter the year in YYYY Format");
			document.addcompanydetails.year.focus()
			return false;
		}
	}
             }
			
			</script> 
 




<div class="body-cont"> 

<div class="body-cont1"> 
  <div class="company__container">
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
<?php
   			 $sql_ed=(mysqli_query($con,"select * from companyprofile where user_id='$session_user'"));
		  $row_ed=mysqli_fetch_array($sql_ed);
		  //print_r($row_ed);
		  $row_ed['P_service'];
		  $Logo= $row_ed['companylogo']; 
?>
<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div   class="bordersty">
<div class="headinggg"> <?php echo $company_details; ?></div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<table width="100%" >
<tr>
<td colspan="3"  ><form action="editcompany_action.php" method="post" name="editcompanydetails" id="form1" enctype="multipart/form-data">
                      <table width="100%" border="0">
                        <tr>
                          <td colspan="4" class="" align="right"><span style="color:#FF0000">*</span><?php echo $required_info; ?></td>
                          </tr>
						  <tr>
                          <td colspan="4" align="center"><?php echo $Updated; ?> </td>
                          </tr>
						  <?php
						    $sql=(mysqli_query($con,"select * from  registration where id='$session_user'"));
							$count=mysqli_num_rows($sql);
							$row=mysqli_fetch_array($sql);
							$cou=$row['country'];
						  ?>
						  <tr>
						  <td width="4%">&nbsp;</td>
                          <td width="35%" align="left" class=""><span style="color:#FF0000">*&nbsp;</span><span style="font-size:12px"><strong><?php echo $company_name; ?>  </strong></span></td>
                          <td width="5%" align="center" class="blackBo">:</td>
                          <td width="56%" class="bluebold"><input name="companyname" type="text" class="txtfield2_new" id="companyname" value="<?php echo  $row['companyname']; ?>" /></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $bussiness_type; ?></strong></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><select name="bussiness_type" class="txtfield2_new" id="bussiness_type">
                              <option value=""><?php echo $sel; ?></option>
							  <?php 
							  $type=$row_ed['bussiness_type'];
							  $query=mysqli_query($con,"select * from business_type");
							  while($array=mysqli_fetch_array($query)) { ?>
							  <option value="<?php echo $array['buss_id']; ?>" <?php if($array['buss_id']==$type) { ?> selected="selected" <?php } ?>><?php echo $array['buss_type']; ?></option>
							  <?php } ?></select>
</td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $product_service; ?></strong></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="inTxtSmall"><p>
                            <input name="P_service" type="text" class="txtfield2_new" id="P_service"   value="<?php echo $row_ed['P_service'];  ?>" />
                          </p>
                          <p><span style="font-size:12px;">&nbsp;<?php echo $eg_product; ?></span></p></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $com_address; ?></strong></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><input name="company_address" type="text" class="txtfield2_new" id="company_address"  value="<?php echo $row_ed['company_address'];  ?>" /></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class="" height="56"><p style="font-size:12px"><strong>&nbsp;&nbsp;</strong></p>
                          <p style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $com_logo; ?></strong></p></td>
                          <td align="center" class="blackBo"><p>&nbsp;</p>
                          <p>:</p></td>
                          <td class="bluebold" height="56"><input name="companylogo" type="file" id="companylogo"/><?php
						  $imgpath1 = "blog_photo_thumbnail/".$row_ed['companylogo'];	
						   if ($row_ed['companylogo'] == "" || !file_exists($imgpath1))  
								{ 
								?>
							<img src="<?php echo "blog_photo_thumbnail/profile_pic_small.gif"; ?>" width="50" height="50">  
								<?php
								} else { 
								?>
								
							<img src="<?php echo "logo/".$row_ed['companylogo']; ?>"width="50" height="50" /> 
								<?php
								}
								?><?php echo $eg_logo; ?> </td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $brands; ?></strong></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><input name="brand" type="text" class="txtfield2_new" id="<?php echo $row_ed['brand'];  ?>" value="<?php echo $row_ed['brand'];  ?>" /></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $no_of_employers; ?></strong></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold">
						  <select name="noofemployee" class="txtfield2_new" id="noofemployee">
                              <option value=""><?php echo $sel; ?> </option>
<option value="Less than 5 People" <?php if($row_ed['noofemployee']=='Less than 5 People'){ ?> selected="selected"<?php }?>><?php echo $less_5_people; ?></option>
<option value="11 - 50 People" <?php if($row_ed['noofemployee']=='11 - 50 People'){ ?> selected="selected"<?php }?>><?php echo $ten_people; ?></option>
<option value="51 - 100 People"  <?php if($row_ed['noofemployee']=='51 - 100 People'){ ?> selected="selected"<?php }?>><?php echo $fifty_people; ?></option>
<option value="101 - 500 People"  <?php if($row_ed['noofemployee']=='101 - 500 People'){ ?> selected="selected"<?php }?>><?php echo $hundred_people; ?></option>
<option value="501 - 1000 People"  <?php if($row_ed['noofemployee']=='501 - 1000 People'){ ?> selected="selected"<?php }?>><?php echo $five_hundres_people; ?></option>
<option value="Above 1000 People"  <?php if($row_ed['noofemployee']=='Above 1000 People'){ ?> selected="selected"<?php }?>><?php echo $above_thousand_people; ?></option>
</select>						  </td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="color:#FF0000">*&nbsp;</span><strong><?php echo $com_url; ?></strong></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="inTxtSmall"><p>
                            <input name="url" type="text" class="txtfield2_new" id="url"  value="<?php echo $row_ed['url'];  ?>" />
                          </p>
                          <p>eg..http://www.you.com</p></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $company_intro; ?></strong></span> </td>
                          <td align="center" class="blackBo">:</td>
                          <td class="inTxtSmall"><p>
                            <input name="company_details" type="text" class="txtfield2_new" id="company_details"  value="<?php echo $row_ed['company_details'];  ?>" />
</p>
                          <p>                          <?php echo $egg1; ?>..</p></td>
                        </tr>
                        <!--<tr>
                          <td colspan="4" align="left" class="inTxtSHead"><div align="left" class="inTxtHead"><span>Ownership &amp; Capital</span></div></td>
                          </tr>-->
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $year_established; ?></strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="inTxtSmall"><p>
                            <input name="year" type="text" class="txtfield2_new" id="year"  value="<?php echo $row_ed['year'];  ?>" />
                          </p>
                          <p>eg.. 1985 </p></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td height="30" align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $bussiness_owner; ?></strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><input name="bussinessowner2" type="text" class="txtfield2_new" id="<?php echo $row_ed['bussinessowner'];  ?>" value="<?php echo $row_ed['bussinessowner'];  ?>" /></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $registerd_capital; ?></strong></span> </td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold">
						  <select name="registeredcapital" class="txtfield2_new" id="registeredcapital">
                              <option value=""><?php echo $editcompanyprofile_selty;?> </option>
<option value="Below US$100 Thousand" <?php if($row_ed['registeredcapital']=='Below US$100 Thousand'){ ?> selected="selected"<?php }?>><?php echo $below11; ?></option>
<option value="US$101 - US$500 Thousand" <?php if($row_ed['registeredcapital']=='US$101 - US$500 Thousand'){ ?> selected="selected"<?php }?>><?php echo $below22; ?></option>
<option value="US$501 - US$1 Million"  <?php if($row_ed['registeredcapital']=='US$501 - US$1 Million'){ ?> selected="selected"<?php }?>><?php echo $below33; ?></option>
</select>  </td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $ownership_type; ?></strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold">
						  <select name="ownertype" class="txtfield2_new" id="ownertype">
                              <option value=""><?php echo $sel;?> </option>
<option value="Corporation/Limited Company" <?php if($row_ed['ownertype']=='Corporation/Limited Company'){ ?> selected="selected"<?php }?>><?php echo $limited_company; ?></option>
<option value="Partner Ship" <?php if($row_ed['ownertype']=='Partner Ship'){ ?> selected="selected"<?php }?>><?php echo $partner_ship; ?> </option>
<option value="Other"  <?php if($row_ed['ownertype']=='Other'){ ?> selected="selected"<?php }?>><?php echo $other; ?></option>
</select></td>
                        </tr>
                        <!--<tr>
						
                          <td colspan="4" align="right" class=""><div align="left"><span style="font-size:16px"><strong>Trade &amp; Market</strong></span></div></td>
                          </tr>-->
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class="" valign="top"><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $main_market; ?></strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><table width="100%" border="0">
                            <tr>
							<?PHP  
							$markets=$row_ed['mainmarkets'];
							$mainmark = explode(",", $markets);
                            $mainmark1 = $mainmark[0];
							$mainmark2 = $mainmark[1];
							$mainmark3 = $mainmark[2];
							$mainmark4 = $mainmark[3];
							$mainmark5 = $mainmark[4];
							$mainmark6 = $mainmark[5];
							$mainmark7 = $mainmark[6];
							$mainmark8 = $mainmark[7];
							$mainmark9 = $mainmark[8];
							?>
							
                              <th width="7%" class="" scope="row"><input name="market[]" type="checkbox"  value="North America" <?PHP if($mainmark1=="North America") {?>checked="checked" <?PHP }?>/></th>
                              <td width="25%" class=""><?php echo $north_america; ?></td>
                              <td width="6%" class=""><input name="market[]" type="checkbox"  value="South America" <?PHP if($mainmark4=="South America") {?>checked="checked" <?PHP }?>/></td>
                              <td width="24%" class=""><?php echo $south_america; ?></td>
                              <td width="7%" class=""><input name="market[]" type="checkbox"  value="Eastern Europe" <?PHP if($mainmark7=="Eastern Europe") {?>checked="checked" <?PHP }?>/></td>
                              <td width="31%" class=""><?php echo $eastern_eroupe; ?></td>
                            </tr>
                            <tr>
							
                              <th height="30" class="inTxtNormal" scope="row"><input name="market[]" type="checkbox" value="Southeast Asia" <?PHP if($mainmark2=="Southeast Asia") {?>checked="checked" <?PHP }?>/></th>
                              <td class=""><?php echo $southeast_asia; ?></td>
                              <td class=""><input name="market[]" type="checkbox" value="Africa" <?PHP if($mainmark5=="Africa") {?>checked="checked" <?PHP }?>/></td>
                              <td class=""><?php echo $africa; ?></td>
                              <td class=""><input name="market[]" type="checkbox"  value="Oceania" <?PHP if($mainmark8=="Oceania") {?>checked="checked" <?PHP }?>/></td>
                              <td class=""><?php echo $Oceania; ?></td>
                            </tr>
                            <tr>
							
                              <th class="" scope="row"><input name="market[]" type="checkbox" value="Mid East" <?PHP if($mainmark3=="Mid East") {?>checked="checked" <?PHP }?>/></th>
                              <td class=""><?php echo $mid_east; ?></td>
                              <td class=""><input name="market[]" type="checkbox"  value="Eastern Asia " <?PHP if($mainmark6=="Eastern Asia") {?>checked="checked" <?PHP }?>/></td>
                              <td class=""><?php echo $eastern_asia; ?></td>
                              <td class=""><input name="market[]" type="checkbox"  value="Westaern Europe " <?PHP if($mainmark9=="Westaern Europe") {?>checked="checked" <?PHP }?>/></td>
                              <td class=""><?php echo $western_europe; ?></td>
                            </tr>
                          </table>                          <label></label></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $main_customer; ?></strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><input name="maincustomer2" type="text" class="txtfield2_new" id="maincustomer2" value="<?php echo $row_ed['maincustomer'];  ?>" /></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $tot_annual; ?></strong></span> </td>
                          <td align="center" class="blackBo">&nbsp;</td>
                          <td class="bluebold">
						  
						  <select name="toannualsalesvolume" class="txtfield2_new" id="toannualsalesvolume">
                              <option value=""><?php echo $sel; ?> </option>
<option value="Below US$1 Million" <?php if($row_ed['toannualsalesvolume']=='Below US$1 Million'){ ?> selected="selected"<?php }?>><?php echo $belowww1; ?></option>
<option value="US$101 - US$500 Million" <?php if($row_ed['toannualsalesvolume']=='US$101 - US$500 Million'){ ?> selected="selected"<?php }?>><?php echo $belowww2; ?> </option>
<option value="US$501 - US$1 Million"  <?php if($row_ed['toannualsalesvolume']=='US$501 - US$1 Million'){ ?> selected="selected"<?php }?>><?php echo $belowww3; ?></option>
</select></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $export; ?> </strong></span></td>
                          <td align="center" class="blackBo">&nbsp;</td>
                          <td class="bluebold">
						   <select name="exportpercentage" class="txtfield2_new" id="exportpercentage">
                              <option value=""><?php echo $sel; ?> </option>
<option value="1% - 10%" <?php if($row_ed['exportpercentage']=='1% - 10%'){ ?> selected="selected"<?php }?>>1% - 10%</option>
<option value="11% - 20%" <?php if($row_ed['exportpercentage']=='11% - 20%'){ ?> selected="selected"<?php }?>>11% - 20% </option>
<option value="21% - 30%"  <?php if($row_ed['exportpercentage']=='21% - 30%'){ ?> selected="selected"<?php }?>>21% - 30%</option>
<option value="31% - 40%"  <?php if($row_ed['exportpercentage']=='31% - 40%'){ ?> selected="selected"<?php }?>>31% - 40%</option>
<option value="41% - 50%"  <?php if($row_ed['exportpercentage']=='41% - 50%'){ ?> selected="selected"<?php }?>>41% - 50%</option>
</select></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $tot_annual_volume; ?></strong></span> </td>
                          <td align="center" class="blackBo">&nbsp;</td>
                          <td class="bluebold">						 
						  <select name="toannualpurchase" class="txtfield2_new" >
                              <option value=""><?php echo $sel;?> </option>
<option value="Below US$1 Million" <?php if($row_ed['toannualpurchasevolume']=='Below US$1 Million'){ ?> selected="selected"<?php }?>><?php echo $belowww1; ?></option>
<option value="US$101 - US$500 Million" <?php if($row_ed['toannualpurchasevolume']=='US$101 - US$500 Million'){ ?> selected="selected"<?php }?>><?php echo $belowww2; ?> </option>
<option value="<?php echo $belowww3; ?>"  <?php if($row_ed['toannualpurchasevolume']=='US$501 - US$1 Million'){ ?> selected="selected"<?php }?>><?php echo $belowww4; ?></option>
</select></td>
                        </tr>
                        <!--<tr>
						
                          <td colspan="4" align="left" class="inTxtSHead"><div align="left"><span class="inTxtHead">Factory Information </span></div></td>
                          </tr>-->
                        <tr>
						<td>&nbsp;</td>
                         <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $factory_size; ?></strong></span> </td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"> 
						     <select name="factorysize" class="txtfield2_new" id="factorysize">
                              <option value=""><?php echo $sel; ?> </option>
<option value="Below 1000 Square meter" <?php if($row_ed['factorysize']=='Below 1000 Square meter'){ ?> selected="selected"<?php }?>><?php echo $square_meter11; ?></option>
<option value="1000 - 3000 Square meter" <?php if($row_ed['factorysize']=='1000 - 3000 Square meter'){ ?> selected="selected"<?php }?>><?php echo $square_meter2; ?> </option>
<option value="3000 - 5000 Square meter"  <?php if($row_ed['factorysize']=='3000 - 5000 Square meter'){ ?> selected="selected"<?php }?>><?php echo $square_meter3; ?></option>
</select>			                    </td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $factory_location; ?> </strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><input name="factorylocation" type="text" class="txtfield2_new" id="factorylocation" value="<?php echo $row_ed['factorylocation'];  ?>" /></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $qa; ?></strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"> 
						
						  <select name="quali" class="txtfield2_new" id="quali">
                              <option value=""><?php echo $sel;?> </option>
<option value="In House" <?php if($row_ed['qa/qc']=='In House'){ ?> selected="selected"<?php }?>><?php echo $inhouse; ?></option>
<option value="Third Parties" <?php if($row_ed['qa/qc']=='Third Parties'){ ?> selected="selected"<?php }?>><?php echo $third_parties; ?> </option>
<option value="No"  <?php if($row_ed['qa/qc']=='No'){ ?> selected="selected"<?php }?>><?php echo $no; ?></option>
</select>                    </td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $no_production_lines; ?></strong></span> </td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold">
						    
						      <select name="noofprodline" class="txtfield2_new" id="noofprodline">
                              <option value=""><?php echo $sel; ?> </option>
<option value="1" <?php if($row_ed['noofprodlines']=='1'){ ?> selected="selected"<?php }?>>1</option>
<option value="2" <?php if($row_ed['noofprodlines']=='2'){ ?> selected="selected"<?php }?>>2 </option>
<option value="3"  <?php if($row_ed['noofprodlines']=='3'){ ?> selected="selected"<?php }?>>3</option>
<option value="4" <?php if($row_ed['noofprodlines']=='4'){ ?> selected="selected"<?php }?>>4</option>
<option value="5" <?php if($row_ed['noofprodlines']=='5'){ ?> selected="selected"<?php }?>>5 </option>
<option value="6"  <?php if($row_ed['noofprodlines']=='6'){ ?> selected="selected"<?php }?>>6</option>
<option value="7" <?php if($row_ed['noofprodlines']=='7'){ ?> selected="selected"<?php }?>>7</option>
<option value="8" <?php if($row_ed['noofprodlines']=='8'){ ?> selected="selected"<?php }?>>8 </option>
<option value="9"  <?php if($row_ed['noofprodlines']=='9'){ ?> selected="selected"<?php }?>>9</option>
<option value="10"  <?php if($row_ed['noofprodlines']=='10'){ ?> selected="selected"<?php }?>>10</option>
</select>                                  </td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $no_rd_staff; ?> </strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"> 
						   
						     <select name="noofrdstaff" class="txtfield2_new" >
                              <option value=""><?php echo $sel; ?> </option>
<option value="Less than 5 People" <?php if($row_ed['noofr&dstaff']=='Less than 5 People'){ ?> selected="selected"<?php }?> >Less than 5 People</option>
<option value="5 - 10 People" <?php if($row_ed['noofr&dstaff']=='5 - 10 People'){ ?> selected="selected"<?php }?> >5 - 10 People</option>
<option value="11 - 20 People"  <?php if($row_ed['noofr&dstaff']=='11 - 20 People'){ ?> selected="selected"<?php }?>>11 - 20 People</option>
<option value="21 - 30 People" <?php if($row_ed['noofr&dstaff']=='21 - 30 People'){ ?> selected="selected"<?php }?>>21 - 30 People</option>
<option value="31 - 40 People" <?php if($row_ed['noofr&dstaff']=='31 - 40 People'){ ?> selected="selected"<?php }?>>31 - 40 People</option>
<option value="41 - 50 People"  <?php if($row_ed['noofr&dstaff']=='41 - 50 People'){ ?> selected="selected"<?php }?>>41 - 50 People</option>
<option value="51 - 60 People" <?php if($row_ed['noofr&dstaff']=='51 - 60 People'){ ?> selected="selected"<?php }?>>51 - 60 People</option>
</select>                               </td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $no_of_qc_staff; ?></strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold">
						 
						   <select name="noofqcstaff" class="txtfield2_new" id="noofqcstaff">
                              <option value=""><?php echo $sel; ?> </option>
<option value="Less than 5 People" <?php if($row_ed['noofqcstaff']=='Less than 5 People'){ ?> selected="selected"<?php }?>>Less than 5 People</option>
<option value="5 - 10 People" <?php if($row_ed['noofqcstaff']=='5 - 10 People'){ ?> selected="selected"<?php }?>>5 - 10 People </option>
<option value="11 - 20 People"  <?php if($row_ed['noofqcstaff']=='11 - 20 People'){ ?> selected="selected"<?php }?>>11 - 20 People</option>
<option value="21 - 30 People" <?php if($row_ed['noofqcstaff']=='21 - 30 People'){ ?> selected="selected"<?php }?>>21 - 30 People</option>
<option value="31 - 40 People" <?php if($row_ed['noofqcstaff']=='31 - 40 People'){ ?> selected="selected"<?php }?>>31 - 40 People </option>
<option value="41 - 50 People"  <?php if($row_ed['noofqcstaff']=='41 - 50 People'){ ?> selected="selected"<?php }?>>41 - 50 People</option>
<option value="51 - 60 People" <?php if($row_ed['noofqcstaff']=='51 - 60 People'){ ?> selected="selected"<?php }?>>51 - 60 People</option>
</select>                          </td>
                          </tr>
                        <tr>
						<td height="181">&nbsp;</td>
                          <td align="left" class="" valign="top"><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $managemrnt_certification; ?> </strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><table width="100%" border="0">
                            <tr>
							<?PHP $resmail=$row_ed['mgmtcertification'];
							   $pieces = explode(",", $resmail);
                               $resmail1 = $pieces[0];
                               $resmail2 = $pieces[1];
							   $resmail3 = $pieces[2];
                               $resmail4 = $pieces[3];
							   $resmail5 = $pieces[4];
                               $resmail6 = $pieces[5];
							   $resmail7 = $pieces[6];
                               $resmail8 = $pieces[7];
							   $resmail9 = $pieces[8];
							?>
                              <td width="5%" height="30" align="center" class=""><input name="mgmcertification[]" type="checkbox"  value="HACCP"  <?PHP if($resmail1=="HACCP") {?>checked="checked" <?PHP }?> /></td>
                              <td width="47%" class="">HACCP</td>
                              <td width="6%" align="center" class=""><input type="checkbox" name="mgmcertification[]" value="ISO 17799" <?PHP if($resmail6=="ISO 17799") {?>checked="checked" <?PHP }?>/></td>
                              <td width="42%" class="">ISO 17799 </td>
                            </tr>
                            <tr>
							
                              <td height="28" align="center" class=""><input type="checkbox" name="mgmcertification[]" value="ISO 9000/9001/9004/19001:200" <?PHP if($resmail2=="ISO 9000/9001/9004/19001:200") {?>checked="checked" <?PHP }?>/></td>
                              <td class="">ISO 9000/9001/9004/19001:2000 </td>
                              <td align="center" class=""><input type="checkbox" name="mgmcertification[]" value="QHASA 18001" <?PHP if($resmail7=="QHASA 18001") {?>checked="checked" <?PHP }?> /></td>
                              <td class="">OHASA 18001</td>
                            </tr>
                            <tr>
							
                              <td height="29" align="center" class=""><input type="checkbox" name="mgmcertification[]" value="QS-9000" <?PHP if($resmail3=="QS-9000") {?>checked="checked" <?PHP }?> /></td>
                              <td class="">QS-9000</td>
                              <td align="center" class=""><input type="checkbox" name="mgmcertification[]" value="TL 9000" <?PHP if($resmail8=="TL 9000") {?>checked="checked" <?PHP }?>/></td>
                              <td class="">TL 9000</td>
                            </tr>
                            <tr>
							
                              <td height="32" align="center" class=""><input type="checkbox" name="mgmcertification[]" value="ISO 14000/14001" <?PHP if($resmail4=="ISO 14000/14001") {?>checked="checked" <?PHP }?> /></td>
                              <td class="">ISO 14000/14001</td>
                              <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="Others" <?PHP if($resmail9=="Others") {?>checked="checked" <?PHP }?>/></td>
                              <td class=""><?php echo $OTHER; ?></td>
                            </tr>
                            <tr>
                              <td align="center" class=""><input type="checkbox" name="mgmcertification[]" value="SA80000" <?PHP if($resmail5=="SA80000") {?>checked="checked" <?PHP }?>/></td>
                              <td class="">SA80000</td>
                              <td colspan="2" align="center" class="">&nbsp;</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
						<td>&nbsp;</td>
                          <td align="left" class=""><span style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $contract_manufacturing; ?> </strong></span></td>
                          <td align="center" class="blackBo">:</td>
                          <td class="bluebold"><table width="100%" border="0">
                            <tr>
							<?PHP 
							   $manufact=$row_ed['contactmant'];
							   $manufacture = explode(",", $manufact);
                               $manufact1 = $manufacture[0];
                               $manufact2 = $manufacture[1];
							   $manufact3 = $manufacture[2];
                             ?>
                              <td width="5%" align="center" class=""><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="OEM Service Offered" <?PHP if($manufact1=="OEM Service Offered") {?>checked="checked" <?PHP }?>/></td>
                              <td width="47%" class=""><?php echo $oem_services; ?></td>
                              <td width="6%" align="center" class=""><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="buyer Label Offered" <?PHP if($manufact3=="buyer Label Offered") {?>checked="checked" <?PHP }?>/></td>
                              <td width="42%" class=""><?php echo $buyer_label_offered; ?></td>
                            </tr>
                            <tr>
                              <td align="center" class=""><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="Design Service Offered" <?PHP if($manufact2=="Design Service Offered") {?>checked="checked" <?PHP }?>/></td>
                              <td class=""><?php echo $design_service_offered; ?></td>
                              <td colspan="2" align="center" class="inTxtNormal">&nbsp;</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="40" colspan="4" align="center"><input name="Editsubmit" type="submit" value="<?php echo $submit; ?>"  class="search_bg"  onClick="return ValidateForm();" />
						  <input class="search_bg" name="" type="button" value="Cancel"   onClick="javascript:history.back();" />						  </td>
                        </tr>
                      </table>
                  </form></td>
				  </tr></table>

<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>



</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
