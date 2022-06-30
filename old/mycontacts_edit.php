<?php 
	include("includes/header.php");
	
	if($session_user=="")
	{
		header("location:login.php");
	}
	if(isset($_REQUEST['Editsubmit']))
	{ 
		$contact_id=$_REQUEST['contact_id'];  
  		$Firstname=$_REQUEST['firstname'];
  		$Lastname=$_REQUEST['lastname'];
  		$cmail=$_REQUEST['email'];
     	$Country=$_REQUEST['country']; 
   		$Street=$_REQUEST['streetname'];
  		$City=$_REQUEST['city'];
  		$State=$_REQUEST['state'];
  		$Countrycode=$_REQUEST['countrycode'];
  		$Areacode=$_REQUEST['areacode'];
  		$Phonenumber=$_REQUEST['phonenumber'];
  		$Faxnumber=$_REQUEST['faxnumber'];
  		$MobileNo=$_REQUEST['mobile'];
  		$Companyname=$_REQUEST['companyname'];
  		$B_type=$_REQUEST['bussiness_type'];
  		$Jobtitle=$_REQUEST['jobtitle'];
  		$Product_services=mysqli_real_escape_string($con, $_REQUEST['P_service']);   
		$zipcode=$_REQUEST['zipcode'];
  
  			/*echo "UPDATE `add_contacts` SET 
`firstname` = '$Firstname',`lastname` = '$Lastname',`country` = '$Country', contact_mail='$cmail',`streetaddress` = '$Street',`city` = '$City',`state` = '$State',`country_code` = '$Countrycode',`area_code` = '$Areacode',`zipcode` = '$zipcode',
`phone_number` = '$Phonenumber',`fax_number` = '$Faxnumber',`mobile` = '$MobileNo',`companyname` = '$Companyname',
`bussiness_type` = '$B_type',`jobtitle` = '$Jobtitle',`productservice` = '$Product_services' WHERE `contact_id` =$contact_id"; exit;*/
  
 			$updatesql ="UPDATE `add_contacts` SET 
`firstname` = '$Firstname',`lastname` = '$Lastname',`country` = '$Country', contact_mail='$cmail',`streetaddress` = '$Street',`city` = '$City',`state` = '$State',`country_code` = '$Countrycode',`area_code` = '$Areacode',`zipcode` = '$zipcode',
`phone_number` = '$Phonenumber',`fax_number` = '$Faxnumber',`mobile` = '$MobileNo',`companyname` = '$Companyname',
`bussiness_type` = '$B_type',`jobtitle` = '$Jobtitle',`productservice` = '$Product_services' WHERE `contact_id` =$contact_id"; 

 		$up_query=mysqli_query($con,$updatesql);
 		header("location:mycontacts.php?updated");
	}
?>

<script language="javascript">
function firstnamecheck()
{
var name=document.form1.firstname.value
if(name!="")
	      {
	       var iChars = " !@#$%^&*()+=-[]\\\';,./{}|\":<>?0123456789";
    	      for (var i = 0; i < name.length; i++)
	        	 {
  		           if (iChars.indexOf(name.charAt(i)) != -1)
			         {name="";
  			 alert ("Your  Name has special characters. \nThese are not allowed.\n Please remove them and try again.");
			          return false;
			        }
					
  		          }
 	         } 

}
function lastnamecheck()
{
var name=document.form1.lastname.value
if(name!="")
	      {
	       var iChars = " !@#$%^&*()+=-[]\\\';,./{}|\":<>?0123456789";
    	      for (var i = 0; i < name.length; i++)
	        	 {
  		           if (iChars.indexOf(name.charAt(i)) != -1)
			         {name="";
  			 alert ("Your  Name has special characters. \nThese are not allowed.\n Please remove them and try again.");
			          return false;
			        }
					
  		          }
 	         } 

}
function checkjsvalidation()
{
	var email=document.form1.email.value;
 	var firstname=document.form1.firstname.value;
 	var lastname=document.form1.lastname.value;
 	var country=document.form1.country.value;

 	var companyname=document.form1.companyname.value;
 	var department=document.form1.bussiness_type.value;
  	var jobtitle=document.form1.jobtitle.value;
 	var product_services=document.form1.P_service.value;
 
 	var street=document.form1.streetname.value;
 	var city=document.form1.city.value;
 	var state=document.form1.state.value;
	var zipcode=document.form1.zipcode.value;

 	var countrycode=document.form1.countrycode.value;
 
 	var areacode=document.form1.areacode.value;
 	var phoneno=document.form1.phonenumber.value;
 	var faxno=document.form1.faxnumber.value;
 	var mobile=document.form1.mobile.value;
	
	if(email=="")
	{
		alert("Please Enter a valid Email ID");
		document.form1.email.focus();
		return false
	}	
    else
	{
	    var as=echeck(email);
	    if(as==false)
	    {
			return false;
	    }
    }
	if(firstname=="")
	{
		alert("Please Enter a Firstname");
		document.form1.firstname.focus();
		return false
	}
		else
 	{
	    var result= firstnamecheck();
		if(result==false)
  		{  
		   //document.form1.firstname.focus();
			return false; 
  	    }
		
 	}
	if(lastname=="")
	{
		//alert("test");
		alert("Please Enter a Lastname");
		document.form1.lastname.focus();
		return false
	}
		else
 	{
	    var result= lastnamecheck();
		if(result==false)
  		{  
		   document.form1.lastname.focus();
			return false; 
  	    }
		
 	}
	if(country=="")
	{
	alert("Please Select a Country");
		document.form1.country.focus();
		return false
	}		
	
	if(companyname=="")
	{
	 alert("Please Enter Company Name");
	 document.form1.companyname.value="";
     return false;
	}
	
	/*if(companyname!="")
	{
	
		var noalpha = /^[a-zA-Z ]*$/;
	
	if (!noalpha.test(document.form1.companyname.value)) {
     alert("Special characters are not allowed in companyname field.");
	 document.form1.companyname.value="";
     return false;
	}
	}*/
	if(department=="")
	{
		alert("Please Select the Business Type");
		document.form1.bussiness_type.focus();
		return false
	}
	
	if(jobtitle=="")
	{
		alert("Please Enter the Job Title");
		document.form1.jobtitle.focus();
		return false
	}		    	 	
	if(product_services=="")
	{
		alert("Please Enter Product Services");
		document.form1.P_service.focus();
		return false
	}
	if(street=="")
	{
	alert("Enter the Street Address");
		document.form1.streetname.focus();
		return false
	}	
if(city=="")
	{
	alert("Enter the City");
		document.form1.city.focus();
		return false
	}
if(state=="")
	{
	alert("Enter the State");
		document.form1.state.focus();
		return false
	}
	if(zipcode=="")
	{
		alert("Please Enter Zip Code");
		document.form1.zipcode.focus();
		return false
	}
	if(isNaN(zipcode))
	 {
		alert("Please Enter Zip Code in Numbers only");
		document.form1.zipcode.focus();
		return false
	 } 
	if(countrycode=="")
	{
		alert("Please Enter Country Code");
		document.form1.countrycode.focus();
		return false
	}
	if(isNaN(countrycode))
	 {
		alert("Please Enter Country Code in Numbers only");
		document.form1.countrycode.focus();
		return false
	 } 
if(areacode=="")
	{
		alert("Please Enter Area Code");
		document.form1.areacode.focus();
		return false
	}
	if(isNaN(areacode))
 {
       alert("Please Enter Area code in Number only");
	   document.form1.areacode.focus();
		return false
 } 
if(phoneno=="")
	{
		alert("Please Enter Phone Number");
		document.form1.phonenumber.focus();
		return false
	}
if(isNaN(phoneno))
 {
       alert("Please Enter Phone Number in  Number only");
	   document.form1.phonenumber.focus();
		return false
 }

if(isNaN(faxno))
 {
       alert("Please Enter Fax Number in  Number only");
	   document.form1.faxnumber.focus();
		return false
 }  
if(isNaN(mobile))
 {
       alert("Please Enter Mobile Number in Number only");
	   document.form1.mobile.focus();
		return false
 } 
		
}
</script>

<script src="js/ajax.js"></script>
<script type="text/javascript">
function echeck(str) 
{

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}
		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }
		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
 		 return true
				
}
</script>

<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>
<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">

<div style="background-color:#29b1cb; height:25px; padding-top:10px;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $contacts; ?></b></div>
<div style="margin-left:10px; margin-top:10px;" align="center"><b style="font-size:14px;"><?php echo $edit_contact; ?></b></div>
<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
<?php 
	$contact=$_REQUEST['contact_id'];
	$sel_qry=mysqli_query($con,"select * from add_contacts where contact_id='$contact' ");
	$details=mysqli_fetch_array($sel_qry);
?>
<table border="0" width="100%" style="margin-top:5px; margin-left:30px;">
	<tr>
		<td width="24%" style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $bussiness_mail; ?></td>
		<td width="2%" style="line-height:40px;">:</td>
		<td width="38%" style="line-height:40px;"><input type="text" name="email" value="<?php echo $details['contact_mail']; ?>" id="email" style="width:250px; height:15px;" readonly="readonly"></td>
		<td width="30%" id="rep_cmail"></td>
	</tr>		
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $fname; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><input type="text" name="firstname" id="firstname" value="<?php echo $details['firstname']; ?>" style="width:250px; height:15px;"></td>
	</tr>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $lname; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><input type="text" name="lastname" id="lastname" value="<?php echo $details['lastname']; ?>" style="width:250px; height:15px;"></td>
	</tr>
	<!--<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;Gender</td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><input type="radio" name="gender" value="Male">Male
		<input type="radio" name="gender" value="Female">Female
		</td>
	</tr>-->
	<?php 
		$conn=$details['country'];
		$sql=mysqli_query($con,"select * from country");
	?>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $country1; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><select style="width:250px; height:20px;" name="country" id="country">
			<option value=""><?php echo $sel_con; ?></option>
			<?php 
				while($con=mysqli_fetch_array($sql))
				{
			?>
			<option value="<?php echo $con['country_id']; ?>"<?php if($con['country_id'] == $conn) { ?> selected="selected" <?php } ?>><?php echo $con['country_name']; ?></option>
			<?php } ?>
		</select></td>
	</tr>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $company_name; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><input type="text" name="companyname" id="companyname" value="<?php echo $details['companyname']; ?>" style="width:250px; height:15px;"/>&nbsp;<!--<span style="font-size:12px">eg.. XYZ infotech</span>--></td>
		<td style="line-height:40px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $bussiness_type; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><select name="bussiness_type" id="bussiness_type" style="width:250px; height:20px;">
			<option value="">Select Type of Business</option>
			<option value="<?php echo $Manufacturer; ?>" <?php if($details['bussiness_type']="manufacturer") { ?> selected="selected"<?php } ?>>Manufacturer</option>
			<option value="trading company" <?php if($details['bussiness_type']="trading company") { ?> selected="selected"<?php } ?>><?php echo $tradeing_company; ?></option>
			<option value="buying office" <?php if($details['bussiness_type']="buying office") { ?> selected="selected"<?php } ?>><?php echo $buying_office; ?></option>
			<option value="distrubutor / wholeSale" <?php if($details['bussiness_type']="distrubutor / wholeSale") { ?> selected="selected"<?php } ?>><?php echo $distributorl; ?></option>
			<option value="goverment ministry" <?php if($details['bussiness_type']="goverment ministry") { ?> selected="selected"<?php } ?>><?php echo $govern_ministory; ?></option>
			<option value="bussiness service" <?php if($details['bussiness_type']="bussiness service") { ?> selected="selected"<?php } ?>><?php echo $bussi_service; ?></option>
		</select></td>
	</tr>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;Job Title</td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><select name="jobtitle" id="jobtitle" style="width:250px; height:20px;">
			<option value=""><?php echo $sel_job_title; ?></option>
			<option value="Director/CEO/General Manager" <?php if($details['jobtitle']="Director/CEO/General Manager") { ?> selected="selected"<?php } ?>><?php echo $director_ceo; ?></option>
			<option value="Sales" <?php if($details['jobtitle']="Sales") { ?> selected="selected"<?php } ?>>Sales</option>
			<option value="Purchasing" <?php if($details['jobtitle']="Purchasing") { ?> selected="selected"<?php } ?>><?php echo $purchasing; ?></option>
			<option value="Techinal & Engineer" <?php if($details['jobtitle']="Techinal & Engineer") { ?> selected="selected"<?php } ?>><?php echo $technical_engineering; ?></option>
		</select></td>
	</tr>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $contact_address; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><span style="font-size:12px"><?php echo $street_address; ?></span><br/><input type="text" name="streetname" id="streetname" value="<?php echo $details['streetaddress']; ?>" /></td>
		<td style="line-height:40px;"><span style="font-size:12px"><?php echo $city; ?></span><br/>
		  <input name="city" type="text" id="city" value="<?php echo $details['city']; ?>" /></td>
		<td width="6%" style="line-height:40px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="line-height:40px;"></td>
		<td style="line-height:40px;"></td>
		<td style="line-height:40px;"><span style="font-size:12px"><?php echo $state; ?></span><br/><input type="text" name="state" id="state" value="<?php echo $details['state']; ?>"/></td>
		<td style="line-height:40px;"><span style="font-size:12px"><?php echo $zip_code; ?></span><br/><input type="text" name="zipcode" id="zipcode" value="<?php echo $details['zipcode']; ?>" /></td>
		<td style="line-height:40px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $phone_number; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><span style="font-size:12px"><?php echo $country1; ?></span>&nbsp;
		<input type="text" name="countrycode" id="countrycode" value="<?php echo $details['country_code']; ?>" maxlength="3" size="3"/>&nbsp;&nbsp; 
		<span style="font-size:12px"><?php echo $area; ?></span>&nbsp;<input type="text" name="areacode" id="areacode" value="<?php echo $details['area_code']; ?>" maxlength="3" size="3"/>
		</td>
		<td style="line-height:40px;"><input type="text" name="phonenumber" id="phonenumber" value="<?php echo $details['phone_number']; ?>" /></td>
	</tr>
	<tr>
		<td style="line-height:40px;"></td>
		<td style="line-height:40px;"></td>
		<td style="line-height:40px;"><span style="font-size:12px"><?php echo $mbile_number; ?></span><br/><input type="text" name="mobile" id="mobile" value="<?php echo $details['mobile']; ?>"/></td>
		<td style="line-height:40px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="line-height:40px;"><?php echo $fax_number; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><input type="text" name="faxnumber" id="faxnumber" value="<?php echo $details['fax_number']; ?>" style="width:250px; height:15px;"/>&nbsp;<!--<span style="font-size:12px">only no - eg..415278</span>--></td>
		<td style="line-height:40px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="line-height:40px;"><span style="color:#FF0000">*</span>&nbsp;<?php echo $pro_services; ?></td>
		<td style="line-height:40px;">:</td>
		<td style="line-height:40px;"><textarea name="P_service" id="P_service" cols="29"><?php echo $details['productservice']; ?></textarea></td>
	</tr>
	<tr>
		<td colspan="3" align="center"><input type="submit" name="Editsubmit" class="search_bg" value="<?php echo $update; ?>" style="margin-top:20px; margin-bottom:20px;" onclick="javascript:return checkjsvalidation();" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="search_bg" value="<?php echo $cancel; ?>" style="margin-top:20px; margin-bottom:20px;" onclick="javascript:history.back();" /></td>
	</tr>
</table>
</form>
</div>

</div></div>

</div>

<div class="body-cont4"> 

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
<div>
<?php
 function getPagingQuery1($sql, $itemPerPage = 1)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
	
}
function getPagingLink1($sql, $itemPerPage = 1,$strGet)
{
	global $con;
	$result        = mysqli_query($con,$sql) or die(mysqli_error($con));
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
		
	
	$totalPages    = ceil($totalResults / $itemPerPage);
	
		
	// how many link pages to show
	$numLinks      = 10;

		
	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
	
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
		
		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
			$pageNumber = (int)$_GET['page'];
		} else {
			$pageNumber = 1;
		}
		
		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = "<span><a href='$self?page=$page&$strGet'>&laquo;Previous</a></span>";
			} else {
				$prev = "<span><a href='$self?$strGet'>&laquo;Previous</a></span>";
			}	
				
			$first = "<span><a href='$self?$strGet'>&laquo;First</a></span>";
		} else {
			$prev  = "<span class='previous-off'>&laquo;Previous</span>"; // we're on page one, don't show 'previous' link
			$first = "<span class='previous-off'>&laquo;First</span>"; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = "<span class='next'><a href='$self?page=$page&$strGet'>Next &raquo;</a></span>";
			$last = "<span class='next'><a href='$self?page=$totalPages&$strGet'>Last &raquo;</a></span>";
		} else {
			$next = "<span class='previous-off'>Next &raquo;</span>"; // we're on the last page, don't show 'next' link
			$last = "<span class='previous-off'>Last &raquo;</span>"; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
			    
				$pagingLink[] = "<span class='active'>$page</span>";   // no need to create a link to current page
			} else {
				if ($page == 1) {
				  
					$pagingLink[] = "<span><a href='$self?$strGet'>$page</a></span>";
				} else {	
				 
					$pagingLink[] = "<span><a href='$self?page=$page&$strGet'>$page</a></span>";
				}	
			}
		}
		
		$pagingLink = implode('  ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = "<div id=\"pagination-flickr\">". $first ."&nbsp;|&nbsp;". $prev ."&nbsp;|&nbsp;". $pagingLink ."&nbsp;|&nbsp;". $next ."&nbsp;|&nbsp;". $last ."</div>";
		
	}
	
	//if(empty($pagingLink)) { $pagingLink="<font  align='center' class='footer'>  First | Prev | 1 | 2 | 3 | Next | Last </font>"; }
	return $pagingLink;
}
 ?> 
</div>