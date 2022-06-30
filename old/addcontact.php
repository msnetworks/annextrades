<?php 
	include("includes/header.php");
	
	if($session_user=="")
	{
		header("location:login.php");
	}
	//$session_user=$_SESSION['user_login'];
	if(isset($_REQUEST['contact_Submit']))
	{
  		$user_id=$session_user;
 		$cmail=$_REQUEST['email'];
  		$Firstname=$_REQUEST['firstname'];
  		$Lastname=$_REQUEST['lastname'];
  		$Gender=$_REQUEST['gender'];
   		$Country=$_REQUEST['country'];
  		$Street=$_REQUEST['street'];
 		$Location=$_REQUEST['location'];
  		$City=$_REQUEST['city'];
   		$State=$_REQUEST['state'];
   		$Zipcode=$_REQUEST['zipcode'];
  		$Countrycode=$_REQUEST['countrycode'];
 		$Areacode=$_REQUEST['areacode'];
    	$Phonenumber=$_REQUEST['phoneno'];
   		$Faxnumber=$_REQUEST['faxno'];
    	$MobileNo=$_REQUEST['mobile'];
  		$Companyname=$_REQUEST['companyname'];
   
    	$B_type=$_REQUEST['bussiness_type'];
  		$Jobtitle=$_REQUEST['jobtitle'];
 		$Product_services=$_REQUEST['product_services']; 
   		$Date=date('Y-m-d');   
		if($_SESSION['language']=='english')
{
$lang_status='0';

}
else if($_SESSION['language']=='french')
{
$lang_status='1';

}
else if($_SESSION['language']=='chinese')
{
$lang_status='2';
}
else
{
$lang_status='3';
}
   
   		//echo "select * from add_contacts where contact_mail='$cmail' and userid='$session_user'";
    	$res=mysqli_query($con,"select * from add_contacts where contact_mail='$cmail' and userid='$session_user'");
		$num=mysqli_num_rows($res);
		if($num > 0)
		{
		header("Location:addcontact.php?err=1");
		}
		else
		{
		
			$insertsql ="INSERT INTO `add_contacts` ( `user_id` , `firstname` , `lastname` , `gender` , `country` , `streetaddress` , `city` , `state` , `zipcode` , `country_code` , `area_code` , `phone_number` , `fax_number` , `mobile` , `companyname` , `contact_mail` , `bussiness_type` , `jobtitle` , `productservice` , `dates`, `lang_status` )
VALUES (
'$user_id', '$Firstname', '$Lastname', '$Gender', '$Country', '$Street', '$City', '$State', '$Zipcode', '$Countrycode', '$Areacode', '$Phonenumber', '$Faxnumber', '$MobileNo', '$Companyname', '$cmail', '$B_type', '$Jobtitle', '$Product_services', '$Date','$lang_status')";

		$query=mysqli_query($con,$insertsql);

		header("Location:mycontacts.php?added");
  		}
	}

	else
	{

	} 
?>

<script language="javascript">
function ValidateForm() {
    var email = document.addcontacts.email.value;
    var firstname = document.addcontacts.firstname.value;
    var lastname = document.addcontacts.lastname.value;
    var ch = document.addcontacts.gender[0].checked;
    var ch1 = document.addcontacts.gender[1].checked;
    var country = document.addcontacts.country.value;
    var street = document.addcontacts.street.value;
    var city = document.addcontacts.city.value;
    var state = document.addcontacts.state.value;
    var zipcode = document.addcontacts.zipcode.value;
    var countrycode = document.addcontacts.countrycode.value;
    var areacode = document.addcontacts.areacode.value;
    var phoneno = document.addcontacts.phoneno.value;
    var companyname = document.addcontacts.companyname.value;
    var bussiness_type = document.addcontacts.bussiness_type.value;
    var jobtitle = document.addcontacts.jobtitle.value;
    var product_services = document.addcontacts.product_services.value;

    if (email == "") {
        alert("Please Enter Your Business Email ID");
        document.addcontacts.email.focus();
        return false
    } else {

        var as = echeck(email);
        if (as == false) {
            return false;
        }

    }
    if (firstname == "") {
        alert("Please Enter the First Name");
        document.addcontacts.firstname.focus();
        return false
    }
    if (lastname == "") {
        alert("Please Enter the Last Name");
        document.addcontacts.lastname.focus();
        return false
    }
    if ((ch == false) && (ch1 == false)) {
        alert("Please Select the Gender");
        return false;
    }
    if (country == "") {
        alert("Please Choose the Country");
        document.addcontacts.country.focus();
        return false
    }
    if (street == "") {
        alert("Please Enter the Street Name");
        document.addcontacts.street.focus();
        return false
    }
    if (city == "") {
        alert("Please Enter the City Name");
        document.addcontacts.city.focus();
        return false
    }
    if (state == "") {
        alert("Please Enter the State");
        document.addcontacts.state.focus();
        return false
    }
    if (zipcode == "") {
        alert("Please Enter the Zipcode");
        document.addcontacts.zipcode.focus();
        return false
    }
    if (isNaN(zipcode)) {
        alert("Please Enter the Zipcode in Numbers only");
        document.addcontacts.zipcode.focus();
        return false
    }
    if ((countrycode == "") && (areacode == "") && (phoneno == "") && (document.addcontacts.mobile.value == "")) {
        alert("Please Enter Atleast One Contact Number");
        document.addcontacts.countrycode.focus();
        return false
    }
    if ((countrycode == "") && (document.addcontacts.mobile.value == "")) {
        alert("Please Enter the Country Code");
        document.addcontacts.countrycode.focus();
        return false
    }

    if (isNaN(countrycode)) {
        alert("Please Enter Country Code in Number only");
        document.addcontacts.countrycode.focus();
        return false
    }

    if ((areacode == "") && (document.addcontacts.mobile.value == "")) {
        alert("Please Enter the Areacode");
        document.addcontacts.areacode.focus();
        return false
    }
    if (isNaN(areacode)) {
        alert("Please Enter Areacode in Number only");
        document.addcontacts.areacode.focus();
        return false
    }
    if ((phoneno == "") && (document.addcontacts.mobile.value == "")) {
        alert("Please Enter the Phone Number");
        document.addcontacts.phoneno.focus();
        return false
    }

    if (isNaN(phoneno)) {
        alert("Please Enter the Phone Number in Number only");
        document.addcontacts.phoneno.focus();
        return false
    }
    if (isNaN(document.addcontacts.mobile.value)) {
        alert("Please Enter Number only");
        document.addcontacts.mobile.focus();
        return false
    }
    if (isNaN(document.addcontacts.faxno.value)) {
        alert("Please Enter Number only");
        document.addcontacts.faxno.focus();
        return false
    }
    if (companyname == "") {
        alert("Please Enter Companyname");
        document.addcontacts.companyname.focus();
        return false
    }

    var noalpha = /^[a-zA-Z ]*$/;

    if (!noalpha.test(document.addcontacts.companyname.value)) {
        alert("Special characters are not allowed in companyname field.");
        document.addcontacts.companyname.value = "";
        return false;
    }
    if (bussiness_type == "") {
        alert("Please Choose Your Bussiness Type");
        document.addcontacts.bussiness_type.focus();
        return false
    }
    if (jobtitle == "") {
        alert("Please Choose the Jobtitle");
        document.addcontacts.jobtitle.focus();
        return false
    }
    if (product_services == "") {
        alert("Please Enter Product Services");
        document.addcontacts.product_services.focus();
        return false
    }
    return true
}
</script>
<script src="js/ajax.js"></script>
<script type="text/javascript">
function echeck(str) {

    var at = "@"
    var dot = "."
    var lat = str.indexOf(at)
    var lstr = str.length
    var ldot = str.indexOf(dot)
    if (str.indexOf(at) == -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(at, (lat + 1)) != -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(dot, (lat + 2)) == -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(" ") != -1) {
        alert("Invalid E-mail ID")
        return false
    }
    return true

}
</script>

<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>
            <div class="body-right">

                <?php include("includes/menu.php"); ?>
                <div class="tabs-cont">
                    <div class="left">
                        <div class="bordersty">

                            <div class="headinggg"><?php echo $add_contact_info; ?>
                            </div>
                            <form name="addcontacts" method="post" onsubmit="return ValidateForm()">
                                <table border="0" width="100%" style="margin-top:25px; margin-left:30px;">
                                    <tr>
                                        <td width="25%" style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $bussiness_mail; ?></td>
                                        <td width="2%" style="line-height:40px;">:</td>
                                        <td width="37%" style="line-height:40px;"><input type="text" name="email"
                                                id="email" onblur="javascript:cmailavaliability(this.value);"
                                                style="width:250px; height:15px;"></td>
                                        <td id="rep_cmail"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $fname; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><input type="text" name="firstname" id="firstname"
                                                style="width:250px; height:15px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $lname; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><input type="text" name="lastname" id="lastname"
                                                style="width:250px; height:15px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $gender; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><input type="radio" name="gender"
                                                value="Male"><?php echo $male; ?>
                                            <input type="radio" name="gender" value="Female"><?php echo $female; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $country1; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><select style="width:250px; height:20px;"
                                                name="country" id="country">
                                                <option value=""><?php echo $sel_con; ?></option>
                                                <?php 
			if($_SESSION['language']=='english')
		{
		$select=mysqli_query($con,"select * from country");
		}
		else if($_SESSION['language']=='french')
		{
		$select=mysqli_query($con,"select * from country_french");
		}
		else
		{
		$select=mysqli_query($con,"select * from country_chinese");
		}
				//$select=mysqli_query($con,"select * from country");
				while($con=mysqli_fetch_array($select))
				{
			?>
                                                <option value="<?php echo $con['country_id']; ?>">
                                                    <?php echo $con['country_name']; ?></option>
                                                <?php } ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $contact_address; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><span
                                                style="font-size:12px"><?php echo $street_address; ?></span><br /><input
                                                type="text" name="street" id="street" /></td>
                                        <td style="line-height:40px;"><span
                                                style="font-size:12px"><?php echo $city; ?></span><br />
                                            <input name="city" type="text" id="city" /></td>
                                        <td style="line-height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"></td>
                                        <td style="line-height:40px;"></td>
                                        <td style="line-height:40px;"><span
                                                style="font-size:12px"><?php echo $state; ?></span><br /><input
                                                type="text" name="state" id="state" /></td>
                                        <td style="line-height:40px;"><span
                                                style="font-size:12px"><?php echo $zip_code; ?></span><br /><input
                                                type="text" name="zipcode" id="zipcode" /></td>
                                        <td style="line-height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $phone_number; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><span
                                                style="font-size:12px"><?php echo $country1; ?></span>&nbsp;
                                            <input type="text" name="countrycode" id="countrycode" maxlength="3"
                                                size="3" />&nbsp;&nbsp;
                                            <span style="font-size:12px"><?php echo $area; ?></span>&nbsp;<input
                                                type="text" name="areacode" id="areacode" maxlength="3" size="3" />
                                        </td>
                                        <td style="line-height:40px;"><input type="text" name="phoneno" id="phoneno" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"></td>
                                        <td style="line-height:40px;"></td>
                                        <td style="line-height:40px;"><span
                                                style="font-size:12px"><?php echo $mbile_number; ?></span><br /><input
                                                type="text" name="mobile" id="mobile" /></td>
                                        <td style="line-height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;">&nbsp;&nbsp;&nbsp;<?php echo $fax_number; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><input type="text" name="faxno" id="faxno"
                                                style="width:250px; height:15px;" />&nbsp;
                                            <!--<span style="font-size:12px">only no - eg..415278</span>-->
                                        </td>
                                        <td style="line-height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $company_name; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><input type="text" name="companyname"
                                                id="companyname" style="width:250px; height:15px;" />&nbsp;
                                            <!--<span style="font-size:12px">eg.. XYZ infotech</span>-->
                                        </td>
                                        <td style="line-height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $bussiness_type; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><select name="bussiness_type" id="bussiness_type"
                                                style="width:250px; height:20px;">
                                                <option value=""><?php echo $sel_type_bussi; ?></option>
                                                <option value="manufacturer"><?php echo $Manufacturer; ?></option>
                                                <option value="trading company"><?php echo $tradeing_company; ?>
                                                </option>
                                                <option value="buying office"><?php echo $buying_office; ?></option>
                                                <option value="distrubutor / wholeSale "><?php echo $distributor; ?>
                                                </option>
                                                <option value="goverment ministry"><?php echo $govern_ministory; ?>
                                                </option>
                                                <option value="bussiness service"><?php echo $bussi_service; ?></option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $job_title; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><select name="jobtitle" id="jobtitle"
                                                style="width:250px; height:20px;">
                                                <option value=""><?php echo $sel_job_title; ?></option>
                                                <option value="Director/CEO/General Manager">
                                                    <?php echo $director_ceo; ?></option>
                                                <option value="Sales"><?php echo $sales; ?></option>
                                                <option value="Purchasing"><?php echo $purchasing; ?></option>
                                                <option value="Techinal & Engineer">
                                                    <?php echo $technical_engineering; ?></option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:40px;"><span
                                                style="color:#FF0000">*</span>&nbsp;<?php echo $pro_services; ?></td>
                                        <td style="line-height:40px;">:</td>
                                        <td style="line-height:40px;"><textarea name="product_services"
                                                id="product_services" cols="29"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><input type="submit" name="contact_Submit"
                                                class="search_bg" value="<?php echo $submit; ?>"
                                                style="margin-top:20px; margin-bottom:20px;" /></td>
                                    </tr>
                                </table>

                        </div>

                    </div>
                </div>

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