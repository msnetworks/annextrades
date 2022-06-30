<?php 
//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	include("includes/header.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	$editid=$_REQUEST['editid'];
 $edshow=mysqli_fetch_array(mysqli_query($con,"select * from tbl_tradeshow where show_id='$editid'"));
 $year=$edshow['events_fromdate'];
 $d=explode('-',$year);
 $year1=$d[0];
 $month=$d[1];
 $date=$d[2];
 $to=$edshow['events_todate'];
 $da=explode('-', $to);
 $years=$da[0];
 $months=$da[1];
 $dates=$da[2];
 $photo=$edshow['image'];
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
		
		$to = $to_year."-".$to_month."-".$to_date;
		
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

		if($filename!="")
		{
		$photofile=$filename;
		}
		else
		{
		$photofile=$photo;
 		}
		
		//echo "update tbl_tradeshow set show_name='$showname', events_fromdate='$from', events_todate='$to', from_time='$fromtime', to_time='$totime', venue='$venue', address='$address', location='$country', image='$photofile', exhibitors_no='$exhibitors_no', exhibitors_history='$exhibitors_history', exhibitors_year='$exhibitors_year', attendees_no='$attendees_no', attendees_history='$attendees_history', attendees_year='$attendees_year', exhibition_no='$exhibition_no', exhibition_history='$exhibition_history', exhibition_year='$exhibition_year', phone='$phone', fax='$fax', summary='$summary', general_information='$generalinformation', industry_focus='$industry', productsfocus='$products', attendee_information='$attendee_information', exhibitors_information='$exhibitor_information', show_organizer='$show_organizer', contact_person='$contact_person', job_title='$jobtitle', business_email='$business_email', business_phone='$businessphone', organizer_fax='$faxnumber', business_address='$businessaddress', business_city='$city', business_state='$state', zipcode='$zip', organizer_country='$country2' where show_id='$editid'";exit;
		
 $sql=mysqli_query($con,"update tbl_tradeshow set show_name='$showname',show_name_french='$showname1',show_name_chinese='$showname2',show_name_spanish='$showname3', events_fromdate='$from', events_todate='$to', from_time='$fromtime', to_time='$totime', venue='$venue', venue_french='$venue1', venue_chinese='$venue2', venue_spanish='$venue3', address='$address', address_french='$address1', address_chinese='$address2', address_spanish='$address3', location='$country', image='$photofile', exhibitors_no='$exhibitors_no', exhibitors_history='$exhibitors_history', exhibitors_year='$exhibitors_year', attendees_no='$attendees_no', attendees_history='$attendees_history', attendees_year='$attendees_year', exhibition_no='$exhibition_no', exhibition_history='$exhibition_history', exhibition_year='$exhibition_year', phone='$phone', fax='$fax', summary='$summary', summary_french='$summary1', summary_chinese='$summary2', summary_spanish='$summary3', general_information='$generalinformation', general_information_french='$generalinformation1', general_information_chinese='$generalinformation2', general_information_spanish='$generalinformation3', industry_focus='$industry', productsfocus='$products',productsfocus_french='$products1',productsfocus_chinese='$products2',productsfocus_spanish='$products3', attendee_information='$attendee_information', attendee_information_french='$attendee_information1', attendee_information_chinese='$attendee_information2',attendee_information_spanish='$attendee_information3', exhibitors_information='$exhibitor_information', exhibitors_information_french='$exhibitor_information1', exhibitors_information_chinese='$exhibitor_information2',exhibitors_information_spanish='$exhibitor_information3', show_organizer='$show_organizer', contact_person='$contact_person', job_title='$jobtitle', business_email='$business_email', business_phone='$businessphone', organizer_fax='$faxnumber', business_address='$businessaddress', business_address_french='$businessaddress1', business_address_chinese='$businessaddress2', business_address_spanish='$businessaddress3', business_city='$city', business_state='$state', zipcode='$zip', organizer_country='$country2' where show_id='$editid'");
		
		header("location:view_show1.php?sid=$editid");
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function active()
{
alert("Are you sure you wish to Active this Record?");
window.location.href="companyview.php?id=<?php echo $iddd;?>&idd=<?php echo $rowid;?>&act=active";
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
		<header><h3 class="tabs_involved">Edit Trade Shows </h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="99%"  cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td><form action="" method="post" name="trade" enctype="multipart/form-data"><table width="100%" height="133" cellpadding="3" cellspacing="0">
                <tr>
                  <td><!-- Table Begins-->
                      <table width="105%" border="0" cellpadding="3" cellspacing="0">
                        <tr>
                          <td align="left" class="sellerviewheading">Fast Facts</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(English)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname" type="text" value="<?PHP echo $edshow['show_name'];?>"/></td>
                        </tr>
						<tr>
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(French)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname1" type="text" value="<?PHP echo $edshow['show_name_french'];?>"/></td>
                        </tr>
						<?php /*?><tr>
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(Chinese)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname2" type="text" value="<?PHP echo $edshow['show_name_chinese'];?>"/></td>
                        </tr><?php */?>
						<tr>
                          <td width="28%" align="right" class="seller"><font color="#FF0000">*</font> Official Show Name&nbsp;&nbsp;(Spanish)</td>
                          <td width="1%">&nbsp;</td>
                          <td width="71%"><input name="showname3" type="text" value="<?PHP echo $edshow['show_name_spanish'];?>"/></td>
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
                                    <?php
									for($i=1999; $i<=2100; $i++)
									{
									?>
			<option value="<?php echo $i; ?>" <?PHP if($i==$year1) { ?> selected="selected" <?PHP } ?>><?php echo $i; ?></option>
									<?php
									}
									?>
                                  </select>
                                </td>
                                <td width="12%"><select name="from_month">
                                    <option value="">Month</option>
                                    <option value="01" <?php if($month==01){?> selected="selected" <?php } ?>>January</option>
                                    <option value="02" <?php if($month==02){?> selected="selected" <?php } ?>>February</option>
                                    <option value="03" <?php if($month==03){?> selected="selected" <?php } ?>>March</option>
                                    <option value="04" <?php if($month==04){?> selected="selected" <?php } ?>>April</option>
                                    <option value="05" <?php if($month==05){?> selected="selected" <?php } ?>>May</option>
                                    <option value="06" <?php if($month==06){?> selected="selected" <?php } ?>>June</option>
                                    <option value="07" <?php if($month==07){?> selected="selected" <?php } ?>>July</option>
                                    <option value="08" <?php if($month==08){?> selected="selected" <?php } ?>>August</option>
                                   <option value="09" <?php if($month==09){?> selected="selected" <?php } ?>>September</option>
                                    <option value="10" <?php if($month==10){?> selected="selected" <?php } ?>>October</option>
                                    <option value="11" <?php if($month==11){?> selected="selected" <?php } ?>>November</option>
                                    <option value="12" <?php if($month==12){?> selected="selected" <?php } ?>>December</option>
                                  </select>
                                </td>
                                <td width="12%"><select name="from_day">
                                    <option value="">Day</option>
                                    <option value="01" <?php if($date==01){?> selected="selected" <?php } ?>>01</option>
                                    <option value="02" <?php if($date==02){?> selected="selected" <?php } ?>>02</option>
                                    <option value="03" <?php if($date==03){?> selected="selected" <?php } ?>>03</option>
                                    <option value="04" <?php if($date==04){?> selected="selected" <?php } ?>>04</option>
                                    <option value="05" <?php if($date==05){?> selected="selected" <?php } ?>>05</option>
                                    <option value="06" <?php if($date==06){?> selected="selected" <?php } ?>>06</option>
                                    <option value="07" <?php if($date==07){?> selected="selected" <?php } ?>>07</option>
                                    <option value="08" <?php if($date==08){?> selected="selected" <?php } ?>>08</option>
                                    <option value="09" <?php if($date==09){?> selected="selected" <?php } ?>>09</option>
                                    <option value="10" <?php if($date==10){?> selected="selected" <?php } ?>>10</option>
                                    <option value="11" <?php if($date==11){?> selected="selected" <?php } ?>>11</option>
                                    <option value="12" <?php if($date==12){?> selected="selected" <?php } ?>>12</option>
                                    <option value="13" <?php if($date==13){?> selected="selected" <?php } ?>>13</option>
                                    <option value="14" <?php if($date==14){?> selected="selected" <?php } ?>>14</option>
                                    <option value="15" <?php if($date==15){?> selected="selected" <?php } ?>>15</option>
                                    <option value="16" <?php if($date==16){?> selected="selected" <?php } ?>>16</option>
                                    <option value="17" <?php if($date==17){?> selected="selected" <?php } ?>>17</option>
                                    <option value="18" <?php if($date==18){?> selected="selected" <?php } ?>>18</option>
                                    <option value="19" <?php if($date==19){?> selected="selected" <?php } ?>>19</option>
                                    <option value="20" <?php if($date==20){?> selected="selected" <?php } ?>>20</option>
                                    <option value="21" <?php if($date==21){?> selected="selected" <?php } ?>>21</option>
                                    <option value="22" <?php if($date==22){?> selected="selected" <?php } ?>>22</option>
                                    <option value="23" <?php if($date==23){?> selected="selected" <?php } ?>>23</option>
                                    <option value="24" <?php if($date==24){?> selected="selected" <?php } ?>>24</option>
                                    <option value="25" <?php if($date==25){?> selected="selected" <?php } ?>>25</option>
                                    <option value="26" <?php if($date==26){?> selected="selected" <?php } ?>>26</option>
                                    <option value="27" <?php if($date==27){?> selected="selected" <?php } ?>>27</option>
                                    <option value="28" <?php if($date==28){?> selected="selected" <?php } ?>>28</option>
                                    <option value="29" <?php if($date==29){?> selected="selected" <?php } ?>>29</option>
                                    <option value="30" <?php if($date==30){?> selected="selected" <?php } ?>>30</option>
                                    <option value="31" <?php if($date==31){?> selected="selected" <?php } ?>>31</option>
                                </select></td>
                              </tr>
                            <tr>
                                <td width="2%" class="sellertext">To</td>
                              <td width="11%"><select name="to_year">
                                    <option value="">Year</option>
                                  
									<?php
									for($i=1999; $i<=2100; $i++)
									{
									?>
									<option value="<?php echo $i; ?>" <?PHP if($i==$years) { ?> selected="selected" <?PHP } ?>><?php echo $i; ?></option>
									<?php
									}
									?>
                                  </select>
                                </td>
                              <td width="12%"><select name="to_month">
                                    <option value="">Month</option>
                                    <option value="01" <?php if($months==01){?> selected="selected" <?php } ?>>January</option>
                                    <option value="02" <?php if($months==02){?> selected="selected" <?php } ?>>February</option>
                                    <option value="03" <?php if($months==03){?> selected="selected" <?php } ?>>March</option>
                                    <option value="04" <?php if($months==04){?> selected="selected" <?php } ?>>April</option>
                                    <option value="05" <?php if($months==05){?> selected="selected" <?php } ?>>May</option>
                                    <option value="06" <?php if($months==06){?> selected="selected" <?php } ?>>June</option>
                                    <option value="07" <?php if($months==07){?> selected="selected" <?php } ?>>July</option>
                                    <option value="08" <?php if($months==08){?> selected="selected" <?php } ?>>August</option>
                                   <option value="09" <?php if($months==09){?> selected="selected" <?php } ?>>September</option>
                                    <option value="10" <?php if($months==10){?> selected="selected" <?php } ?>>October</option>
                                    <option value="11" <?php if($months==11){?> selected="selected" <?php } ?>>November</option>
                                    <option value="12" <?php if($months==12){?> selected="selected" <?php } ?>>December</option>
                                  </select>
                                </td>
                              <td width="35%"><select name="to_day">
                                    <option value="">Day</option>
                                   <option value="01" <?php if($dates==01){?> selected="selected" <?php } ?>>01</option>
                                    <option value="02" <?php if($dates==02){?> selected="selected" <?php } ?>>02</option>
                                    <option value="03" <?php if($dates==03){?> selected="selected" <?php } ?>>03</option>
                                    <option value="04" <?php if($dates==04){?> selected="selected" <?php } ?>>04</option>
                                    <option value="05" <?php if($dates==05){?> selected="selected" <?php } ?>>05</option>
                                    <option value="06" <?php if($dates==06){?> selected="selected" <?php } ?>>06</option>
                                    <option value="07" <?php if($dates==07){?> selected="selected" <?php } ?>>07</option>
                                    <option value="08" <?php if($dates==08){?> selected="selected" <?php } ?>>08</option>
                                    <option value="09" <?php if($dates==09){?> selected="selected" <?php } ?>>09</option>
                                    <option value="10" <?php if($dates==10){?> selected="selected" <?php } ?>>10</option>
                                    <option value="11" <?php if($dates==11){?> selected="selected" <?php } ?>>11</option>
                                    <option value="12" <?php if($dates==12){?> selected="selected" <?php } ?>>12</option>
                                    <option value="13" <?php if($dates==13){?> selected="selected" <?php } ?>>13</option>
                                    <option value="14" <?php if($dates==14){?> selected="selected" <?php } ?>>14</option>
                                    <option value="15" <?php if($dates==15){?> selected="selected" <?php } ?>>15</option>
                                    <option value="16" <?php if($dates==16){?> selected="selected" <?php } ?>>16</option>
                                    <option value="17" <?php if($dates==17){?> selected="selected" <?php } ?>>17</option>
                                    <option value="18" <?php if($dates==18){?> selected="selected" <?php } ?>>18</option>
                                    <option value="19" <?php if($dates==19){?> selected="selected" <?php } ?>>19</option>
                                    <option value="20" <?php if($dates==20){?> selected="selected" <?php } ?>>20</option>
                                    <option value="21" <?php if($dates==21){?> selected="selected" <?php } ?>>21</option>
                                    <option value="22" <?php if($dates==22){?> selected="selected" <?php } ?>>22</option>
                                    <option value="23" <?php if($dates==23){?> selected="selected" <?php } ?>>23</option>
                                    <option value="24" <?php if($dates==24){?> selected="selected" <?php } ?>>24</option>
                                    <option value="25" <?php if($dates==25){?> selected="selected" <?php } ?>>25</option>
                                    <option value="26" <?php if($dates==26){?> selected="selected" <?php } ?>>26</option>
                                    <option value="27" <?php if($dates==27){?> selected="selected" <?php } ?>>27</option>
                                    <option value="28" <?php if($dates==28){?> selected="selected" <?php } ?>>28</option>
                                    <option value="29" <?php if($dates==29){?> selected="selected" <?php } ?>>29</option>
                                    <option value="30" <?php if($dates==30){?> selected="selected" <?php } ?>>30</option>
                                    <option value="31" <?php if($dates==31){?> selected="selected" <?php } ?>>31</option>
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
                              <option value="09:00" <?PHP if($edshow['from_time']=="09:00") { ?> selected="selected" <?PHP } ?>>9:00</option>
                              <option value="01:00" <?PHP if($edshow['from_time']=="01:00") { ?> selected="selected" <?PHP } ?>>1:00</option>
                              <option value="02:00" <?PHP if($edshow['from_time']=="02:00") { ?> selected="selected" <?PHP } ?>>2:00</option>
                              <option value="03:00" <?PHP if($edshow['from_time']=="03:00") { ?> selected="selected" <?PHP } ?>>3:00</option>
                              <option value="04:00" <?PHP if($edshow['from_time']=="04:00") { ?> selected="selected" <?PHP } ?>>4:00</option>
                              <option value="05:00" <?PHP if($edshow['from_time']=="05:00") { ?> selected="selected" <?PHP } ?>>5:00</option>
                              <option value="06:00" <?PHP if($edshow['from_time']=="06:00") { ?> selected="selected" <?PHP } ?>>6:00</option>
                              <option value="07:00" <?PHP if($edshow['from_time']=="07:00") { ?> selected="selected" <?PHP } ?>>7:00</option>
                              <option value="08:00" <?PHP if($edshow['from_time']=="08:00") { ?> selected="selected" <?PHP } ?>>8:00</option>
                              <option value="09:00" <?PHP if($edshow['from_time']=="09:00") { ?> selected="selected" <?PHP } ?>>9:00</option>
                              <option value="10:00" <?PHP if($edshow['from_time']=="10:00") { ?> selected="selected" <?PHP } ?>>10:00</option>
                              <option value="11:00" <?PHP if($edshow['from_time']=="11:00") { ?> selected="selected" <?PHP } ?>>11:00</option>
                              <option value="12:00" <?PHP if($edshow['from_time']=="12:00") { ?> selected="selected" <?PHP } ?>>12:00</option>
                            </select>
                              <label for="fromam"> am</label>
                            to
                            <select name="totime">
                              <option value="">Select</option>
                              <option value="09:00" <?PHP if($edshow['to_time']=="09:00") { ?> selected="selected" <?PHP } ?>>9:00</option>
                              <option value="01:00" <?PHP if($edshow['to_time']=="01:00") { ?> selected="selected" <?PHP } ?>>1:00</option>
                              <option value="02:00" <?PHP if($edshow['to_time']=="02:00") { ?> selected="selected" <?PHP } ?>>2:00</option>
                              <option value="03:00" <?PHP if($edshow['to_time']=="03:00") { ?> selected="selected" <?PHP } ?>>3:00</option>
                              <option value="04:00" <?PHP if($edshow['to_time']=="04:00") { ?> selected="selected" <?PHP } ?>>4:00</option>
                              <option value="05:00" <?PHP if($edshow['to_time']=="05:00") { ?> selected="selected" <?PHP } ?>>5:00</option>
                              <option value="06:00" <?PHP if($edshow['to_time']=="06:00") { ?> selected="selected" <?PHP } ?>>6:00</option>
                              <option value="07:00" <?PHP if($edshow['to_time']=="07:00") { ?> selected="selected" <?PHP } ?>>7:00</option>
                              <option value="08:00" <?PHP if($edshow['to_time']=="08:00") { ?> selected="selected" <?PHP } ?>>8:00</option>
                              <option value="09:00" <?PHP if($edshow['to_time']=="09:00") { ?> selected="selected" <?PHP } ?>>9:00</option>
                              <option value="10:00" <?PHP if($edshow['to_time']=="10:00") { ?> selected="selected" <?PHP } ?>>10:00</option>
                              <option value="11:00" <?PHP if($edshow['to_time']=="11:00") { ?> selected="selected" <?PHP } ?>>11:00</option>
                              <option value="12:00" <?PHP if($edshow['to_time']=="12:00") { ?> selected="selected" <?PHP } ?>>12:00</option>
                            </select>
                            <label for="toam"></label>
                            <label for="topm">pm</label>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue" value="<?PHP echo $edshow['venue'];?>"/>
                          </td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue1" value="<?PHP echo $edshow['venue_french'];?>"/>
                          </td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue2" value="<?PHP echo $edshow['venue_chinese'];?>"/>
                          </td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Venue&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="venue3" value="<?PHP echo $edshow['venue_spanish'];?>"/>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address" value="<?PHP echo $edshow['address'];?>"/></td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address1" value="<?PHP echo $edshow['address_french'];?>"/></td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address2" value="<?PHP echo $edshow['address_chinese'];?>"/></td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Address&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="address3" value="<?PHP echo $edshow['address_spanish'];?>"/></td>
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
                              <option value="<?php echo $result1['country_name']; ?>" <?PHP if($edshow['location']==$result1['country_name']) { ?> selected="selected" <?PHP } ?>><?php echo $result1['country_name'];?></option>
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
                                <td width="16%"><input type="text" name="exhibitors_no" size="10" value="<?PHP echo $edshow['exhibitors_no'];?>"/></td>
                                <!-- <td width="14%" class="sellertext">History record:</td>
                                <td width="25%"><input type="text" name="exhibitors_history" /></td>-->
                                <td width="12%" class="sellertext">year of</td>
                                <td width="47%"><select name="exhibitors_year">
                                     <option value="">Select</option>
									 
									 <?php for($yr=date("Y")-10;$yr<=date("Y");$yr++) { ?>
                                    <option value="<?php echo $yr;?>" <?PHP if($edshow['exhibitors_year']==$yr) { ?> selected="selected" <?PHP } ?>><?php echo $yr;?></option>
                                   <?php } ?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="sellertext">No. of Attendees:
                                    </th>
                                </td>
                                <td><input type="text" name="attendees_no" size="10" value="<?PHP echo $edshow['attendees_no'];?>"/></td>
                                <!--<td class="sellertext">History record:</td>
                                <td><input type="text" name="attendees_history" /></td>-->
                                <td class="sellertext">year of</td>
                                <td><select name="attendees_year" size="1">
                                    <option value="">Select</option>
                                 
                                     <?php for($yr=date("Y")-10;$yr<=date("Y");$yr++) { ?>
                                    <option value="<?php echo $yr;?>" <?PHP if($edshow['attendees_year']==$yr) { ?> selected="selected" <?PHP } ?>><?php echo $yr;?></option>
                                   <?php } ?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="sellertext">Exhibition Floor Size(sqm):
                                    </th>
                                </td>
                                <td><input type="text" name="exhibition_no" size="10" value="<?PHP echo $edshow['exhibition_no'];?>"/></td>
                                <!--<td class="sellertext">History record:</td>
                                <td><input type="text" name="exhibition_history" /></td>-->
                                <td class="sellertext">year of</td>
                                <td><select name="exhibition_year">
                                    <option value="">Select</option>
                                  
									  <?php for($yr=date("Y")-10;$yr<=date("Y");$yr++) { ?>
                                    <option value="<?php echo $yr;?>" <?PHP if($edshow['exhibition_year']==$yr) { ?> selected="selected" <?PHP } ?>><?php echo $yr;?></option>
                                   <?php } ?>
                                  
                                  </select>
                                </td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Phone</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="phone" value="<?PHP echo $edshow['phone'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Fax</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="fax" value="<?PHP echo $edshow['fax'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="left" class="sellerviewheading">Show Infomation</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary" cols="50" rows="4"><?PHP echo $edshow['summary'];?></textarea>
                          </td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary1" cols="50" rows="4"><?PHP echo $edshow['summary_french'];?></textarea>
                          </td>
                        </tr>
					<?php /*?>	<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary2" cols="50" rows="4"><?PHP echo $edshow['summary_chinese'];?></textarea>
                          </td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Summary&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="summary3" cols="50" rows="4"><?PHP echo $edshow['summary_spanish'];?></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation" cols="50" rows="6"><?PHP echo $edshow['general_information'];?></textarea>
                          </td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation1" cols="50" rows="6"><?PHP echo $edshow['general_information_french'];?></textarea>
                          </td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation2" cols="50" rows="6"><?PHP echo $edshow['general_information_chinese'];?></textarea>
                          </td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> General Information&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="generalinformation3" cols="50" rows="6"><?PHP echo $edshow['general_information_spanish'];?></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Industry Focus</td>
                          <td>&nbsp;</td>
                          <td><select name="industry" class="text">
                              <option value="">Select Category</option>
                              <?php
							  if($_SESSION['language']=='english')
{
 $res2= "select * from category";
}
else if($_SESSION['language']=='french')
{
 $res2= "select * from category_french";
}
else
{
 //$res2= "select * from category_chinese";
}

								  //$res2= "select * from category";
								  $sql2=mysqli_query($con,$res2);
								  
								  while($result2=mysqli_fetch_array($sql2)) 
								  {
								   ?>
                        <option value="<?php echo $result2['category']; ?>" <?php if($edshow['industry_focus']==$result2['category']){?> selected="selected" <?php } ?>><?php echo $result2['category'];?></option>
                              <?php
								  }	
									?>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products" value="<?PHP echo $edshow['productsfocus'];?>" /></td>
                        </tr>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products1" value="<?PHP echo $edshow['productsfocus_french'];?>" /></td>
                        </tr>
						<?php /*?> <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products2" value="<?PHP echo $edshow['productsfocus_chinese'];?>" /></td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Products and Services Focus&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="products3" value="<?PHP echo $edshow['productsfocus_spanish'];?>" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information" value="<?PHP echo $edshow['attendee_information'];?>"/></td>
                        </tr>
						
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information1" value="<?PHP echo $edshow['attendee_information_french'];?>"/></td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information2" value="<?PHP echo $edshow['attendee_information_chinese'];?>"/></td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Attendee Information&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="attendee_information3" value="<?PHP echo $edshow['attendee_information_spanish'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information" value="<?PHP echo $edshow['exhibitors_information'];?>"/></td>
                        </tr>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information1" value="<?PHP echo $edshow['exhibitors_information_french'];?>"/></td>
                        </tr>
						<?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information2" value="<?PHP echo $edshow['exhibitors_information_chinese'];?>"/></td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Exhibitor Information&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="exhibitor_information3" value="<?PHP echo $edshow['exhibitors_information_spanish'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="left" class="sellerviewheading" colspan="3">Organizer Contact Information</td>
                          
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Show Organizer</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="show_organizer" value="<?PHP echo $edshow['show_organizer'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Contact Person</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="contact_person" value="<?PHP echo $edshow['contact_person'];?>"/>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Job Title</td>
                          <td>&nbsp;</td>
                          <td><select name="jobtitle">
                              <option value="">Select Job Title</option>
                              <option value="Director/CEO/General Manager" <?php if($edshow['job_title']=="Director/CEO/General Manager"){ ?> selected="selected" <?php } ?>>Director/CEO/General Manager</option>
                              <option value="Owner/Entrepreneur" <?php if($edshow['job_title']=="Owner/Entrepreneur"){ ?> selected="selected" <?php } ?>>Owner/Entrepreneur</option>
                              <option value="Marketing" <?php if($edshow['job_title']=="Marketing"){ ?> selected="selected" <?php } ?>>Marketing</option>
                              <option value="Sales" <?php if($edshow['job_title']=="Sales"){ ?> selected="selected" <?php } ?>>Sales</option>
                              <option value="Purchasing" <?php if($edshow['job_title']=="Purchasing"){ ?> selected="selected" <?php } ?>>Purchasing</option>
                              <option value="Technical &amp; Engineering" <?php if($edshow['job_title']=="Technical &amp; Engineering"){ ?> selected="selected" <?php } ?>>Technical &amp; Engineering</option>
                              <option value="Administrative" <?php if($edshow['job_title']=="Administrative"){ ?> selected="selected" <?php } ?>>Administrative</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Email</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="business_email" value="<?PHP echo $edshow['business_email'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Phone</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="businessphone" value="<?PHP echo $edshow['business_phone'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Fax Number</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="faxnumber" value="<?PHP echo $edshow['organizer_fax'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(English)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress" cols="50" rows="3"><?PHP echo $edshow['business_address'];?></textarea>
                          </td>
                        </tr>
						 <tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(French)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress1" cols="50" rows="3"><?PHP echo $edshow['business_address_french'];?></textarea>
                          </td>
                        </tr>
						 <?php /*?><tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(Chinese)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress2" cols="50" rows="3"><?PHP echo $edshow['business_address_chinese'];?></textarea>
                          </td>
                        </tr><?php */?>
						<tr>
                          <td align="right" class="seller"><font color="#FF0000">*</font> Business Address&nbsp;&nbsp;(Spanish)</td>
                          <td>&nbsp;</td>
                          <td><textarea name="businessaddress3" cols="50" rows="3"><?PHP echo $edshow['business_address_spanish'];?></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td align="right" class="seller">City</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="city" value="<?PHP echo $edshow['business_city'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller">State</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="state" value="<?PHP echo $edshow['business_state'];?>"/></td>
                        </tr>
                        <tr>
                          <td align="right" class="seller">Zip/Postal Code</td>
                          <td>&nbsp;</td>
                          <td><input type="text" name="zip" value="<?PHP echo $edshow['zipcode'];?>"/></td>
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
                              <option value="<?php echo $result4['country_name']; ?>" <?PHP if($edshow['organizer_country']==$result4['country_name']) { ?> selected="selected" <?PHP } ?>><?php echo $result4['country_name'];?></option>
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
                          <td><input type="submit" name="submit" value="Update"   />
                            &nbsp;&nbsp;<input type="button" name="Submit" value="Cancel" onclick="javascript:history.back();"/>                          </td>
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