<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if($_REQUEST['submit'])
	{

		$showname = $_POST['showname'];
		$showname1 = mysqli_real_escape_string($con, $_POST['showname1']);
		$showname2 = mysqli_real_escape_string($con, $_POST['showname2']);
		$showname3 = mysqli_real_escape_string($con, $_POST['showname3']);
		$from_year = $_POST['from_year'];
		$from_month = $_POST['from_month'];
		$from_date = $_POST['from_day'];
		
		$to_year = $_POST['to_year'];
		$to_month = $_POST['to_month'];
		$to_date = $_POST['to_day'];
		
		$from = $from_year."-".$from_month."-".$from_date; 
		$from;
		//$from = $from_month." ".$from_date.", ".$from_year;
		$to = $to_year."-".$to_month."-".$to_date;
		//$to = $to_month." ".$to_date.", ".$to_year;
		
		$fromtime = $_POST['fromtime'];
		$totime = $_POST['totime'];
		
		$venue = $_POST['venue'];
		$venue1 = mysqli_real_escape_string($con, $_POST['venue1']);
		$venue2 = mysqli_real_escape_string($con, $_POST['venue2']);
		$venue3 = mysqli_real_escape_string($con, $_POST['venue3']);
		$address = mysqli_real_escape_string($con, $_POST['address']);
		$address1 = mysqli_real_escape_string($con, $_POST['address1']);
		$address2 = mysqli_real_escape_string($con, $_POST['address2']);
		$address3 = mysqli_real_escape_string($con, $_POST['address3']);
		$country = $_POST['country'];
		$photo = $_POST['uploadedfile'];
		
		$exhibitors_no = $_POST['exhibitors_no'];
		$exhibitors_history = $_POST['exhibitors_history'];
		$exhibitors_year = $_POST['exhibitors_year'];
		
		$attendees_no = $_POST['attendees_no'];
		$attendees_history = $_POST['attendees_history']; 
		$attendees_year = $_POST['attendees_year'];
		
		$exhibition_no = $_POST['exhibition_no'];
		$exhibition_history = $_POST['exhibition_history'];
		$exhibition_year = $_POST['exhibition_year'];


		$phone = $_POST['phone'];
		$fax = $_POST['fax'];
		$summary = mysqli_real_escape_string($con, $_POST['summary']);
		$summary1 = mysqli_real_escape_string($con, $_POST['summary1']); 
		$summary2 = mysqli_real_escape_string($con, $_POST['summary2']);  
		$summary3 = mysqli_real_escape_string($con, $_POST['summary3']); 


		$generalinformation = mysqli_real_escape_string($con, $_POST['generalinformation']);
		$generalinformation1 = mysqli_real_escape_string($con, $_POST['generalinformation1']);
		$generalinformation2 = mysqli_real_escape_string($con, $_POST['generalinformation2']);
		$generalinformation3 = mysqli_real_escape_string($con, $_POST['generalinformation3']);
		$industry = $_POST['industry'];
		$products = mysqli_real_escape_string($con, $_POST['products']);
		$products1 = mysqli_real_escape_string($con, $_POST['products1']);
		$products2 = mysqli_real_escape_string($con, $_POST['products2']);
		$products3 = mysqli_real_escape_string($con, $_POST['products3']);
		$attendee_information = mysqli_real_escape_string($con, $_POST['attendee_information']);
		$attendee_information1 = mysqli_real_escape_string($con, $_POST['attendee_information1']);
		$attendee_information2 = mysqli_real_escape_string($con, $_POST['attendee_information2']);
		$attendee_information3 = mysqli_real_escape_string($con, $_POST['attendee_information3']);
		$exhibitor_information = mysqli_real_escape_string($con, $_POST['exhibitor_information']);
		$exhibitor_information1 = mysqli_real_escape_string($con, $_POST['exhibitor_information1']);
		$exhibitor_information2 = mysqli_real_escape_string($con, $_POST['exhibitor_information2']);
		$exhibitor_information3 = mysqli_real_escape_string($con, $_POST['exhibitor_information3']);
		$show_organizer = $_POST['show_organizer'];
		
		$contact_person = $_POST['contact_person'];
		$jobtitle = $_POST['jobtitle'];
		$business_email = $_POST['business_email'];
		
		$businessphone = $_POST['businessphone'];
		$faxnumber = $_POST['faxnumber']; 
		$businessaddress = mysqli_real_escape_string($con, $_POST['businessaddress']);
		$businessaddress1 = mysqli_real_escape_string($con, $_POST['businessaddress1']);
		$businessaddress2 = mysqli_real_escape_string($con, $_POST['businessaddress2']);
		$businessaddress3 = mysqli_real_escape_string($con, $_POST['businessaddress3']);
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$country2 = $_POST['country2'];

		
		$filename=basename($_FILES['uploadedfile']['name']);
		$tmpfilename=$_FILES['uploadedfile']['tmp_name'];
		$uploadpath1="../uploads/".$filename;
   		move_uploaded_file($tmpfilename,$uploadpath1); 				
		
 		$sql =mysqli_query($con,"INSERT INTO tbl_tradeshow (
		show_name, 
		show_name_french,
		show_name_chinese,
		show_name_spanish,
		events_fromdate, 
		events_todate,
		from_time,
		to_time, 
		venue, 
		venue_french, 
		venue_chinese,
		venue_spanish, 
		address, 
		address_french,
		address_chinese,
		address_spanish,
		location,
		image, 
		exhibitors_no, 
		exhibitors_history, 
		exhibitors_year, 
		attendees_no, 
		attendees_history, 
		attendees_year,
		exhibition_no,
		exhibition_history,
		exhibition_year, 
		phone, 
		fax, 
		summary, 
		summary_french, 
		summary_chinese, 
		summary_spanish,
		general_information, 
		general_information_french, 
		general_information_chinese, 
		general_information_spanish,
		industry_focus, 
		productsfocus, 
		productsfocus_french, 
		productsfocus_chinese,
		productsfocus_spanish, 
		attendee_information, 
		attendee_information_french, 
		attendee_information_chinese, 
		attendee_information_spanish,
		exhibitors_information, 
		exhibitors_information_french, 
		exhibitors_information_chinese,
		exhibitors_information_spanish, 
		show_organizer, 
		contact_person, 
		job_title,
		business_email, 
		business_phone, 
		organizer_fax, business_address, 
		business_address_french,
		business_address_chinese,
		business_address_spanish,
		business_city, 
		business_state, 
		zipcode, 
		organizer_country,tstatus) VALUES ( 
		'$showname', 
		'$showname1', 
		'$showname2', 
		'$showname3',
		'$from', 
		'$to',
		'$fromtime',
		'$totime', 
		'$venue', 
		'$venue1', 
		'$venue2',
		'$venue3', 
		'$address', 
		'$address1', 
		'$address2', 
		'$address3',
		'$country',
		'$filename', 
		'$exhibitors_no', 
		'$exhibitors_history', 
		'$exhibitors_year', 
		'$attendees_no', 
		'$attendees_history', 
		'$attendees_year',
		'$exhibition_no', 
		'$exhibition_history',
		'$exhibition_year',
		'$phone', 
		'$fax', 
		'$summary', 
		'$summary1',
		'$summary2',
		'$summary3',
		'$generalinformation',
		'$generalinformation1',
		'$generalinformation2', 
		'$generalinformation3', 
		'$industry', 
		'$products', 
		'$products1', 
		'$products2', 
		'$products3',
		'$attendee_information', 
		'$attendee_information1', 
		'$attendee_information2', 
		'$attendee_information3',
		'$exhibitor_information', 
		'$exhibitor_information1', 
		'$exhibitor_information2', 
		'$exhibitor_information3',
		'$show_organizer', 
		'$contact_person', 
		'$jobtitle', 
		'$business_email', 
		'$businessphone', 
		'$faxnumber', 
		'$businessaddress', 
		'$businessaddress1', 
		'$businessaddress2', 
		'$businessaddress3',
		'$city', 
		'$state', 
		'$zip', 
		'$country2','admin')");
		
		header("location:successtradeshow.php");
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function tradeshowval()
{
if(document.frm_tradeshow.showname.value=="")
{
alert("Please Enter Your Show Name");
document.frm_tradeshow.showname.focus();
return false;
}
if(document.frm_tradeshow.showname1.value=="")
{
alert("Please Enter Your Show Name");
document.frm_tradeshow.showname1.focus();
return false;
}
if(document.frm_tradeshow.showname2.value=="")
{
alert("Please Enter Your Show Name");
document.frm_tradeshow.showname2.focus();
return false;
}
if(document.frm_tradeshow.from_year.value=="")
{
alert("Please Select The From Year");
document.frm_tradeshow.from_year.focus();
return false;
}

if(document.frm_tradeshow.from_month.value=="")
{
alert("Please Enter The From Month");
document.frm_tradeshow.from_month.focus();
return false;
}
if(document.frm_tradeshow.from_day.value=="")
{
alert("Please Enter The From Date");
document.frm_tradeshow.from_day.focus();
return false;
}

if(document.frm_tradeshow.to_year.value=="")
{
alert("Please Select The To Year");
document.frm_tradeshow.to_year.focus();
return false;
}

if(document.frm_tradeshow.to_month.value=="")
{
alert("Please Enter The To Month");
document.frm_tradeshow.to_month.focus();
return false;
}
if(document.frm_tradeshow.to_day.value=="")
{
alert("Please Enter The To Date");
document.frm_tradeshow.to_day.focus();
return false;
}
if(document.frm_tradeshow.fromtime.value=="")
{
alert("Please Enter The Start Time");
document.frm_tradeshow.fromtime.focus();
return false;
}
if(document.frm_tradeshow.totime.value=="")
{
alert("Please Enter The End Time");
document.frm_tradeshow.totime.focus();
return false;
}

if(document.frm_tradeshow.venue.value=="")
{
alert("Please Enter The Venue");
document.frm_tradeshow.venue.focus();
return false;
}
if(document.frm_tradeshow.venue1.value=="")
{
alert("Please Enter The Venue");
document.frm_tradeshow.venue1.focus();
return false;
}
if(document.frm_tradeshow.venue2.value=="")
{
alert("Please Enter The Venue");
document.frm_tradeshow.venue2.focus();
return false;
}
if(document.frm_tradeshow.address.value=="")
{
alert("Please Enter The Address");
document.frm_tradeshow.address.focus();
return false;
}
if(document.frm_tradeshow.address1.value=="")
{
alert("Please Enter The Address");
document.frm_tradeshow.address1.focus();
return false;
}
if(document.frm_tradeshow.address2.value=="")
{
alert("Please Enter The Address");
document.frm_tradeshow.address2.focus();
return false;
}
if(document.frm_tradeshow.country.value=="")
{
alert("Please Select The Country");
document.frm_tradeshow.country.focus();
return false;
}

var fnam=document.frm_tradeshow.uploadedfile.value;
if(document.frm_tradeshow.uploadedfile.value=="")
{
alert("Please Upload Your Product Image");
document.frm_tradeshow.uploadedfile.focus();
return false;
}

splt=fnam.split('.');
chksplt=splt[1].toLowerCase();

if(chksplt=='jpg'|| chksplt=='jpeg'){

}else{
alert(" Upload only jpg, jpeg image");
document.frm_tradeshow.uploadedfile.focus();
return false;
}

if(document.frm_tradeshow.exhibitors_no.value=="")
{
alert("Please Enter Your Number Of Exhibitors");
document.frm_tradeshow.exhibitors_no.focus();
return false;
}

if(isNaN(document.frm_tradeshow.exhibitors_no.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.exhibitors_no.focus();
		return false;
 }

if(document.frm_tradeshow.exhibitors_year.value=="")
{
alert("Please Select The Exhibitors Year");
document.frm_tradeshow.exhibitors_year.focus();
return false;
}

if(document.frm_tradeshow.attendees_no.value=="")
{
alert("Please Enter Your Number Of Attendees");
document.frm_tradeshow.attendees_no.focus();
return false;
}
if(isNaN(document.frm_tradeshow.attendees_no.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.attendees_no.focus();
		return false;
 }
if(document.frm_tradeshow.attendees_year.value=="")
{
alert("Please Enter Your Attended Year");
document.frm_tradeshow.attendees_year.focus();
return false;
}
if(document.frm_tradeshow.exhibition_no.value=="")
{
 alert("Please Enter The Exhibition Floor Size");
 document.frm_tradeshow.exhibition_no.focus();
 return false;
} 

if(isNaN(document.frm_tradeshow.exhibition_no.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.exhibition_no.focus();
		return false;
 }

if(document.frm_tradeshow.exhibition_year.value=="")
{
 alert("Please Select The Year Of Exhibiton");
 document.frm_tradeshow.exhibition_year.focus();
 return false;
} 
if(document.frm_tradeshow.phone.value=="")
{
 alert("Please Enter Your Phone Number");
 document.frm_tradeshow.phone.focus();
 return false;
} 
if(isNaN(document.frm_tradeshow.phone.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.phone.focus();
		return false;
 }
 if(document.frm_tradeshow.fax.value=="")
{
alert("Please Enter The Fax Number");
document.frm_tradeshow.fax.focus();
return false;
}

if(isNaN(document.frm_tradeshow.fax.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.fax.focus();
		return false;
 }
if(document.frm_tradeshow.summary.value=="")
{
alert("Please Enter The Summary");
document.frm_tradeshow.summary.focus();
return false;
}
if(document.frm_tradeshow.summary1.value=="")
{
alert("Please Enter The Summary");
document.frm_tradeshow.summary1.focus();
return false;
}
if(document.frm_tradeshow.summary2.value=="")
{
alert("Please Enter The Summary");
document.frm_tradeshow.summary2.focus();
return false;
}
if(document.frm_tradeshow.generalinformation.value=="")
{
alert("Please Enter The General Information");
document.frm_tradeshow.generalinformation.focus();
return false;
}
if(document.frm_tradeshow.generalinformation1.value=="")
{
alert("Please Enter The General Information");
document.frm_tradeshow.generalinformation1.focus();
return false;
}
if(document.frm_tradeshow.generalinformation2.value=="")
{
alert("Please Enter The General Information");
document.frm_tradeshow.generalinformation2.focus();
return false;
}
if(document.frm_tradeshow.industry.value=="")
{
alert("Please Select Your Industry");
document.frm_tradeshow.industry.focus();
return false;
}
if(document.frm_tradeshow.products.value=="")
{
 alert("Please Enter Product and Services");
 document.frm_tradeshow.products.focus();
 return false;
}
if(document.frm_tradeshow.products1.value=="")
{
 alert("Please Enter Product and Services");
 document.frm_tradeshow.products1.focus();
 return false;
}
if(document.frm_tradeshow.products2.value=="")
{
 alert("Please Enter Product and Services");
 document.frm_tradeshow.products2.focus();
 return false;
}
if(document.frm_tradeshow.attendee_information.value=="")
{
 alert("Please Enter Attendee Information");
 document.frm_tradeshow.attendee_information.focus();
 return false;
} 
if(document.frm_tradeshow.attendee_information1.value=="")
{
 alert("Please Enter Attendee Information");
 document.frm_tradeshow.attendee_information1.focus();
 return false;
} 
if(document.frm_tradeshow.attendee_information2.value=="")
{
 alert("Please Enter Attendee Information");
 document.frm_tradeshow.attendee_information2.focus();
 return false;
} 
if(document.frm_tradeshow.exhibitor_information.value=="")
{
 alert("Please Enter Attendee Information");
 document.frm_tradeshow.exhibitor_information.focus();
 return false;
} 
if(document.frm_tradeshow.exhibitor_information1.value=="")
{
 alert("Please Enter Attendee Information");
 document.frm_tradeshow.exhibitor_information1.focus();
 return false;
} 
if(document.frm_tradeshow.exhibitor_information2.value=="")
{
 alert("Please Enter Attendee Information");
 document.frm_tradeshow.exhibitor_information2.focus();
 return false;
} 
 if(document.frm_tradeshow.show_organizer.value=="")
 {
  alert("Please Enter The Show Organizer Name");
  document.frm_tradeshow.show_organizer.focus();
  return false;
 }
 
 if(document.frm_tradeshow.contact_person.value=="")
 {
  alert("Please Enter The Contct Person Name");
  document.frm_tradeshow.contact_person.focus();
  return false;
 }
   if(document.frm_tradeshow.jobtitle.value=="")
 {
  alert("Please Select The Jobtitle");
  document.frm_tradeshow.jobtitle.focus();
  return false;
 }
   if(document.frm_tradeshow.business_email.value=="")
 {
  alert("Please Enter The Business Email");
  document.frm_tradeshow.business_email.focus();
  return false;
 }
 
   if (echeck(document.frm_tradeshow.business_email.value)==false)
	{       
			document.frm_tradeshow.business_email.focus(); 
  			returnstatus=false;
			return false;
	}
   if(document.frm_tradeshow.businessphone.value=="")
 {
  alert("Please Enter The Business Phone No");
  document.frm_tradeshow.businessphone.focus();
  return false;
 }
 if(isNaN(document.frm_tradeshow.businessphone.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.businessphone.focus();
		return false;
 }
  if(document.frm_tradeshow.faxnumber.value=="")
 {
  alert("Please Enter The Fax Number");
  document.frm_tradeshow.faxnumber.focus();
  return false;
 }
 
 if(isNaN(document.frm_tradeshow.faxnumber.value))
 {
       alert("Please Enter Number only");
	   document.frm_tradeshow.faxnumber.focus();
		return false;
 }
 
   if(document.frm_tradeshow.businessaddress.value=="")
 {
  alert("Please Enter The Business Address");
  document.frm_tradeshow.businessaddress.focus();
  return false;
 }
  if(document.frm_tradeshow.businessaddress.value=="")
 {
  alert("Please Enter The Business Address");
  document.frm_tradeshow.businessaddress.focus();
  return false;
 }
  if(document.frm_tradeshow.businessaddress.value=="")
 {
  alert("Please Enter The Business Address");
  document.frm_tradeshow.businessaddress.focus();
  return false;
 }
if(document.frm_tradeshow.country2.value=="")
{
 alert("Please Select The Country Or Territory");
 document.frm_tradeshow.country2.focus();
 return false;
} 
 

}

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
</head>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="admin_tradeshow.php"><b>Trade Shows</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Add Trade Shows </h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="99%"  cellspacing="0" cellpadding="0" align="center" >
          <tr>
            <td><form action="" method="post" name="frm_tradeshow" onsubmit="return tradeshowval();" enctype="multipart/form-data"><table width="100%" height="133" cellpadding="3" cellspacing="0">
                <tr>
                  <td><!-- Table Begins-->
                      <table width="105%" border="0" cellpadding="3" cellspacing="0">
                        <tr>
                          <td align="left" class="sellerviewheading" colspan="3">Fast Facts</td>
                          </tr>
                        <tr>
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(English)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname" type="text" /></td>
                        </tr>
						<tr>
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(French)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname1" type="text" /></td>
                        </tr>
						<!--<tr>
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(Chinese)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname2" type="text" /></td>
                        </tr>
						<tr>-->
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(Spanish)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname3" type="text" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Event Date(s)</td>
                          <td>&nbsp;</td>
                          <td><table width="100%" border="0">
                              <tr>
                                <td width="5%" class="sellertext">From
                                    </th>
                                </td>
                                <td width="11%"><select name="from_year">
                                    <option value="">Year</option>
                                    <option value="1999" >1999</option>
                                    <option value="2000" >2000</option>
                                    <option value="2001" >2001</option>
                                    <option value="2002" >2002</option>
                                    <option value="2003" >2003</option>
                                    <option value="2004" >2004</option>
                                    <option value="2005" >2005</option>
                                    <option value="2006" >2006</option>
                                    <option value="2007" >2007</option>
                                    <option value="2008" >2008</option>
                                    <option value="2009" >2009</option>
                                    <option value="2010" >2010</option>
                                    <option value="2011" >2011</option>
                                    <option value="2012" >2012</option>
                                    <option value="2013" >2013</option>
                                    <option value="2014" >2014</option>
                                    <option value="2015" >2015</option>
                                    <option value="2016" >2016</option>
                                    <option value="2017" >2017</option>
                                    <option value="2018" >2018</option>
                                    <option value="2019" >2019</option>
                                    <option value="2020" >2020</option>
                                    <option value="2021" >2021</option>
                                    <option value="2022" >2022</option>
                                    <option value="2023" >2023</option>
                                    <option value="2024" >2024</option>
                                    <option value="2025" >2025</option>
                                    <option value="2026" >2026</option>
                                    <option value="2027" >2027</option>
                                    <option value="2028" >2028</option>
                                    <option value="2029" >2029</option>
                                    <option value="2030" >2030</option>
                                    <option value="2031" >2031</option>
                                    <option value="2032" >2032</option>
                                    <option value="2033" >2033</option>
                                    <option value="2034" >2034</option>
                                    <option value="2035" >2035</option>
                                    <option value="2036" >2036</option>
                                    <option value="2037" >2037</option>
                                    <option value="2038" >2038</option>
                                    <option value="2039" >2039</option>
                                    <option value="2040" >2040</option>
                                    <option value="2041" >2041</option>
                                    <option value="2042" >2042</option>
                                    <option value="2043" >2043</option>
                                    <option value="2044" >2044</option>
                                    <option value="2045" >2045</option>
                                    <option value="2046" >2046</option>
                                    <option value="2047" >2047</option>
                                    <option value="2048" >2048</option>
                                    <option value="2049" >2049</option>
                                    <option value="2050" >2050</option>
                                    <option value="2051" >2051</option>
                                    <option value="2052" >2052</option>
                                    <option value="2053" >2053</option>
                                    <option value="2054" >2054</option>
                                    <option value="2055" >2055</option>
                                    <option value="2056" >2056</option>
                                    <option value="2057" >2057</option>
                                    <option value="2058" >2058</option>
                                    <option value="2059" >2059</option>
                                    <option value="2060" >2060</option>
                                    <option value="2061" >2061</option>
                                    <option value="2062" >2062</option>
                                    <option value="2063" >2063</option>
                                    <option value="2064" >2064</option>
                                    <option value="2065" >2065</option>
                                    <option value="2066" >2066</option>
                                    <option value="2067" >2067</option>
                                    <option value="2068" >2068</option>
                                    <option value="2069" >2069</option>
                                    <option value="2070" >2070</option>
                                    <option value="2071" >2071</option>
                                    <option value="2072" >2072</option>
                                    <option value="2073" >2073</option>
                                    <option value="2074" >2074</option>
                                    <option value="2075" >2075</option>
                                    <option value="2076" >2076</option>
                                    <option value="2077" >2077</option>
                                    <option value="2078" >2078</option>
                                    <option value="2079" >2079</option>
                                    <option value="2080" >2080</option>
                                    <option value="2081" >2081</option>
                                    <option value="2082" >2082</option>
                                    <option value="2083" >2083</option>
                                    <option value="2084" >2084</option>
                                    <option value="2085" >2085</option>
                                    <option value="2086" >2086</option>
                                    <option value="2087" >2087</option>
                                    <option value="2088" >2088</option>
                                    <option value="2089" >2089</option>
                                    <option value="2090" >2090</option>
                                    <option value="2091" >2091</option>
                                    <option value="2092" >2092</option>
                                    <option value="2093" >2093</option>
                                    <option value="2094" >2094</option>
                                    <option value="2095" >2095</option>
                                    <option value="2096" >2096</option>
                                    <option value="2097" >2097</option>
                                    <option value="2098" >2098</option>
                                    <option value="2099" >2099</option>
                                    <option value="2100" >2100</option>
                                  </select>
                                </td>
                                <td width="12%"><select name="from_month">
                                    <option value="">Month</option>
                                    <option value="01" >January</option>
                                    <option value="02" >February</option>
                                    <option value="03" >March</option>
                                    <option value="04" >April</option>
                                    <option value="05" >May</option>
                                    <option value="06" >June</option>
                                    <option value="07" >July</option>
                                    <option value="08" >August</option>
                                    <option value="09" >September</option>
                                    <option value="10" >October</option>
                                    <option value="11" >November</option>
                                    <option value="12" >December</option>
                                  </select>
                                </td>
                                <td width="12%"><select name="from_day">
                                    <option value="">Day</option>
                                    <option value="01" >01</option>
                                    <option value="02" >02</option>
                                    <option value="03" >03</option>
                                    <option value="04" >04</option>
                                    <option value="05" >05</option>
                                    <option value="06" >06</option>
                                    <option value="07" >07</option>
                                    <option value="08" >08</option>
                                    <option value="09" >09</option>
                                    <option value="10" >10</option>
                                    <option value="11" >11</option>
                                    <option value="12" >12</option>
                                    <option value="13" >13</option>
                                    <option value="14" >14</option>
                                    <option value="15" >15</option>
                                    <option value="16" >16</option>
                                    <option value="17" >17</option>
                                    <option value="18" >18</option>
                                    <option value="19" >19</option>
                                    <option value="20" >20</option>
                                    <option value="21" >21</option>
                                    <option value="22" >22</option>
                                    <option value="23" >23</option>
                                    <option value="24" >24</option>
                                    <option value="25" >25</option>
                                    <option value="26" >26</option>
                                    <option value="27" >27</option>
                                    <option value="28" >28</option>
                                    <option value="29" >29</option>
                                    <option value="30" >30</option>
                                    <option value="31" >31</option>
                                </select></td>
                              </tr>
                            <tr>
                                <td width="2%" class="sellertext">To</td>
                              <td width="11%"><select name="to_year">
                                    <option value="">Year</option>
                                    <option value="1999" >1999</option>
                                    <option value="2000" >2000</option>
                                    <option value="2001" >2001</option>
                                    <option value="2002" >2002</option>
                                    <option value="2003" >2003</option>
                                    <option value="2004" >2004</option>
                                    <option value="2005" >2005</option>
                                    <option value="2006" >2006</option>
                                    <option value="2007" >2007</option>
                                    <option value="2008" >2008</option>
                                    <option value="2009" >2009</option>
                                    <option value="2010" >2010</option>
                                    <option value="2011" >2011</option>
                                    <option value="2012" >2012</option>
                                    <option value="2013" >2013</option>
                                    <option value="2014" >2014</option>
                                    <option value="2015" >2015</option>
                                    <option value="2016" >2016</option>
                                    <option value="2017" >2017</option>
                                    <option value="2018" >2018</option>
                                    <option value="2019" >2019</option>
                                    <option value="2020" >2020</option>
                                    <option value="2021" >2021</option>
                                    <option value="2022" >2022</option>
                                    <option value="2023" >2023</option>
                                    <option value="2024" >2024</option>
                                    <option value="2025" >2025</option>
                                    <option value="2026" >2026</option>
                                    <option value="2027" >2027</option>
                                    <option value="2028" >2028</option>
                                    <option value="2029" >2029</option>
                                    <option value="2030" >2030</option>
                                    <option value="2031" >2031</option>
                                    <option value="2032" >2032</option>
                                    <option value="2033" >2033</option>
                                    <option value="2034" >2034</option>
                                    <option value="2035" >2035</option>
                                    <option value="2036" >2036</option>
                                    <option value="2037" >2037</option>
                                    <option value="2038" >2038</option>
                                    <option value="2039" >2039</option>
                                    <option value="2040" >2040</option>
                                    <option value="2041" >2041</option>
                                    <option value="2042" >2042</option>
                                    <option value="2043" >2043</option>
                                    <option value="2044" >2044</option>
                                    <option value="2045" >2045</option>
                                    <option value="2046" >2046</option>
                                    <option value="2047" >2047</option>
                                    <option value="2048" >2048</option>
                                    <option value="2049" >2049</option>
                                    <option value="2050" >2050</option>
                                    <option value="2051" >2051</option>
                                    <option value="2052" >2052</option>
                                    <option value="2053" >2053</option>
                                    <option value="2054" >2054</option>
                                    <option value="2055" >2055</option>
                                    <option value="2056" >2056</option>
                                    <option value="2057" >2057</option>
                                    <option value="2058" >2058</option>
                                    <option value="2059" >2059</option>
                                    <option value="2060" >2060</option>
                                    <option value="2061" >2061</option>
                                    <option value="2062" >2062</option>
                                    <option value="2063" >2063</option>
                                    <option value="2064" >2064</option>
                                    <option value="2065" >2065</option>
                                    <option value="2066" >2066</option>
                                    <option value="2067" >2067</option>
                                    <option value="2068" >2068</option>
                                    <option value="2069" >2069</option>
                                    <option value="2070" >2070</option>
                                    <option value="2071" >2071</option>
                                    <option value="2072" >2072</option>
                                    <option value="2073" >2073</option>
                                    <option value="2074" >2074</option>
                                    <option value="2075" >2075</option>
                                    <option value="2076" >2076</option>
                                    <option value="2077" >2077</option>
                                    <option value="2078" >2078</option>
                                    <option value="2079" >2079</option>
                                    <option value="2080" >2080</option>
                                    <option value="2081" >2081</option>
                                    <option value="2082" >2082</option>
                                    <option value="2083" >2083</option>
                                    <option value="2084" >2084</option>
                                    <option value="2085" >2085</option>
                                    <option value="2086" >2086</option>
                                    <option value="2087" >2087</option>
                                    <option value="2088" >2088</option>
                                    <option value="2089" >2089</option>
                                    <option value="2090" >2090</option>
                                    <option value="2091" >2091</option>
                                    <option value="2092" >2092</option>
                                    <option value="2093" >2093</option>
                                    <option value="2094" >2094</option>
                                    <option value="2095" >2095</option>
                                    <option value="2096" >2096</option>
                                    <option value="2097" >2097</option>
                                    <option value="2098" >2098</option>
                                    <option value="2099" >2099</option>
                                    <option value="2100" >2100</option>
                                  </select>
                                </td>
                              <td width="12%"><select name="to_month">
                                    <option value="">Month</option>
                                    <option value="01" >January</option>
                                    <option value="02" >February</option>
                                    <option value="03" >March</option>
                                    <option value="04" >April</option>
                                    <option value="05" >May</option>
                                    <option value="06" >June</option>
                                    <option value="07" >July</option>
                                    <option value="08" >August</option>
                                    <option value="09" >September</option>
                                    <option value="10" >October</option>
                                    <option value="11" >November</option>
                                    <option value="12" >December</option>
                                  </select>
                                </td>
                              <td width="35%"><select name="to_day">
                                    <option value="">Day</option>
                                    <option value="01" >01</option>
                                    <option value="02" >02</option>
                                    <option value="03" >03</option>
                                    <option value="04" >04</option>
                                    <option value="05" >05</option>
                                    <option value="06" >06</option>
                                    <option value="07" >07</option>
                                    <option value="08" >08</option>
                                    <option value="09" >09</option>
                                    <option value="10" >10</option>
                                    <option value="11" >11</option>
                                    <option value="12" >12</option>
                                    <option value="13" >13</option>
                                    <option value="14" >14</option>
                                    <option value="15" >15</option>
                                    <option value="16" >16</option>
                                    <option value="17" >17</option>
                                    <option value="18" >18</option>
                                    <option value="19" >19</option>
                                    <option value="20" >20</option>
                                    <option value="21" >21</option>
                                    <option value="22" >22</option>
                                    <option value="23" >23</option>
                                    <option value="24" >24</option>
                                    <option value="25" >25</option>
                                    <option value="26" >26</option>
                                    <option value="27" >27</option>
                                    <option value="28" >28</option>
                                    <option value="29" >29</option>
                                    <option value="30" >30</option>
                                    <option value="31" >31</option>
                                  </select>
                                </td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Hours</td>
                          <td>&nbsp;</td>
                          <td><select name="fromtime">
                              <option value="">Select</option>
                              <option value="09:00">9:00</option>
                              <option value="01:00" >1:00</option>
                              <option value="02:00" >2:00</option>
                              <option value="03:00" >3:00</option>
                              <option value="04:00" >4:00</option>
                              <option value="05:00" >5:00</option>
                              <option value="06:00" >6:00</option>
                              <option value="07:00" >7:00</option>
                              <option value="08:00" >8:00</option>
                              <option value="09:00" >9:00</option>
                              <option value="10:00" >10:00</option>
                              <option value="11:00" >11:00</option>
                              <option value="12:00" >12:00</option>
                            </select>
                              <label for="fromam"> am</label>
                            to
                            <select name="totime">
                              <option value="">Select</option>
                              <option value="9:00">9:00</option>
                              <option value="1:00" >1:00</option>
                              <option value="2:00" >2:00</option>
                              <option value="3:00" >3:00</option>
                              <option value="4:00" >4:00</option>
                              <option value="5:00" >5:00</option>
                              <option value="6:00" >6:00</option>
                              <option value="7:00" >7:00</option>
                              <option value="8:00" >8:00</option>
                              <option value="9:00" >9:00</option>
                              <option value="10:00" >10:00</option>
                              <option value="11:00" >11:00</option>
                              <option value="12:00" >12:00</option>
                            </select>
                            <label for="toam"></label>
                            <label for="topm">pm</label>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue" />
                          </td>
                        </tr>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue1" />
                          </td>
                        </tr>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue2" />
                          </td>
                        </tr>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue3" />
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address" /></td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address1" /></td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address2" /></td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address3" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Location</td>
                          <td>&nbsp;</td>
                          <td><select name="country" class="text">
                              <option value="">Select Country</option>
                              <?php
								  $res1= "select * from country";
								  $sql=mysqli_query($con,$res1);
								  
								  while($result1=mysqli_fetch_array($sql)) 
								  {
								   ?>
                              <option value="<?php echo $result1['country_name']; ?>"><?php echo $result1['country_name'];?></option>
                              <?php
								  }	
									?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Logo</td>
                          <td>&nbsp;</td>
                          <td><input type="file" name="uploadedfile" />
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Event Scale Information</td>
                          <td>&nbsp;</td>
                          <td><table width="100%" border="0">
                              <tr>
                                <td width="25%" class="sellertext">No. of Exhibitors:
                                    </th>
                                </td>
                                <td width="16%"><input type="text" name="exhibitors_no" size="10" /></td>
                                <!-- <td width="14%" class="sellertext">History record:</td>
                                <td width="25%"><input type="text" name="exhibitors_history" /></td>-->
                                <td width="12%" class="sellertext">year of</td>
                                <td width="47%"><select name="exhibitors_year">
                                    <option value="">Select</option>
                                    <option value="1999" >1999</option>
                                    <option value="2000" >2000</option>
                                    <option value="2001" >2001</option>
                                    <option value="2002" >2002</option>
                                    <option value="2003" >2003</option>
                                    <option value="2004" >2004</option>
                                    <option value="2005" >2005</option>
                                    <option value="2006" >2006</option>
                                    <option value="2007" >2007</option>
                                    <option value="2008" >2008</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="sellertext">No. of Attendees:
                                    </th>
                                </td>
                                <td><input type="text" name="attendees_no" size="10" /></td>
                                <!--<td class="sellertext">History record:</td>
                                <td><input type="text" name="attendees_history" /></td>-->
                                <td class="sellertext">year of</td>
                                <td><select name="attendees_year" size="1">
                                    <option value="">Select</option>
                                    <option value="1999" >1999</option>
                                    <option value="2000" >2000</option>
                                    <option value="2001" >2001</option>
                                    <option value="2002" >2002</option>
                                    <option value="2003" >2003</option>
                                    <option value="2004" >2004</option>
                                    <option value="2005" >2005</option>
                                    <option value="2006" >2006</option>
                                    <option value="2007" >2007</option>
                                    <option value="2008" >2008</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="sellertext">Exhibition Floor Size(sqm):
                                    </th>
                                </td>
                                <td><input type="text" name="exhibition_no" size="10" value=""/></td>
                                <!--<td class="sellertext">History record:</td>
                                <td><input type="text" name="exhibition_history" /></td>-->
                                <td class="sellertext">year of</td>
                                <td><select name="exhibition_year">
                                    <option value="">Select</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>

                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                  </select>
                                </td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Phone</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="phone" value=""/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Fax</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="fax" value=""/></td>
                        </tr>
                        <tr>
                          <td align="left" class="sellerviewheading" colspan="3">Show Infomation</td>
                         </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary" cols="50" rows="4"></textarea>
                          </td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary1" cols="50" rows="4"></textarea>
                          </td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary2" cols="50" rows="4"></textarea>
                          </td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary3" cols="50" rows="4"></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation" cols="50" rows="6"></textarea>
                          </td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation1" cols="50" rows="6"></textarea>
                          </td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation2" cols="50" rows="6"></textarea>
                          </td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation3" cols="50" rows="6"></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Industry Focus</td>
                          <td>&nbsp;</td>
                          <td><select name="industry" class="text">
                              <option value="">Select Category</option>
                              <?php
								  $res2= "select * from category";
								  $sql2=mysqli_query($con,$res2);
								  
								  while($result2=mysqli_fetch_array($sql2)) 
								  {
								   ?>
                              <option value="<?php echo $result2['category']; ?>"><?php echo $result2['category'];?></option>
                              <?php
								  }	
									?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products" value="" /></td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products1" value="" /></td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products2" value="" /></td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products3" value="" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information" /></td>
                        </tr>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information1" /></td>
                        </tr>
						 <?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information2" /></td>
                        </tr><?php */?>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information3" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information" /></td>
                        </tr>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information1" /></td>
                        </tr>
						<?php /*?> <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information2" /></td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information3" /></td>
                        </tr>
                        <tr>
                          <td align="left" class="sellerviewheading" colspan="3">Organizer Contact Information</td>
                          </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Show Organizer</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="show_organizer" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Contact Person</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="contact_person" />
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Job Title</td>
                          <td>&nbsp;</td>
                          <td><select name="jobtitle">
                              <option value="">Select Job Title</option>
                              <option value="Director/CEO/General Manager"  >Director/CEO/General Manager</option>
                              <option value="Owner/Entrepreneur"  >Owner/Entrepreneur</option>
                              <option value="Marketing"  >Marketing</option>
                              <option value="Sales"  >Sales</option>
                              <option value="Purchasing"  >Purchasing</option>
                              <option value="Technical &amp; Engineering"  >Technical &amp; Engineering</option>
                              <option value="Administrative"  >Administrative</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Email</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="business_email" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Phone</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="businessphone" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Fax Number</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="faxnumber" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress" cols="50" rows="3"></textarea>
                          </td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress1" cols="50" rows="3"></textarea>
                          </td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress2" cols="50" rows="3"></textarea>
                          </td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress3" cols="50" rows="3"></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller">City</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="city" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller">State</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="state" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller">Zip/Postal Code</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="zip" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Country or Territory</td>
                          <td>&nbsp;</td>
                          <td><select name="country2" class="text">
                              <option value="">Select Country</option>
                              <?php
								  $res4= "select * from country";
								  $sql4=mysqli_query($con,$res4);
								  
								  while($result4=mysqli_fetch_array($sql4)) 
								  {
								   ?>
                              <option value="<?php echo $result4['country_name']; ?>"><?php echo $result4['country_name'];?></option>
                              <?php
								  }	
									?>
                            </select>
                          </td>
                        </tr>
                        <!-- <tr>
							<td align="right" class="seller"><font color="#FF0000">*</font> Confirm Text</td>
							<td>&nbsp;</td>
							<td><input type="text" name="textfield96" /></td>
						  </tr> 
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="sellercomments">Please type in the text you see into the field above. <br />
This prevents fraud. If you cannot see this image, <br />
<a href="" class="gboldli">click   	              here</a>.</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="sellercomments"> If the words are correct and you still cannot complete the process,   	              you may have encountered a cookie error. Please <a href="" class="gboldli">click here.</a></td>
						  </tr>-->
                        <tr height="3">
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td><input type="submit" name="submit" value="Submit" />
                            &nbsp;&nbsp;<input type="submit" name="Submit" value="Back" onclick="javascript:history.back();"/>                          </td>
                        </tr>
                      </table>
                    <!-- Table Ends-->
                  </td>
                </tr>
            </table></form></td>
          </tr>
        </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>