<?php
session_start();
$sess_id=$_SESSION['user_login']; 

include("db-connect/notfound.php");

if($_REQUEST['submit'])
	{

		$showname = $_POST['showname'];
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
		$from_am_pm = $_POST['from_am_pm'];
		$fromtime .= " ".$from_am_pm;
		//echo "<br>";
		$totime = $_POST['totime'];
		$to_am_pm = $_POST['to_am_pm'];
		$totime .= " ".$to_am_pm;
		//echo "<br>";exit();
		
		$venue = $_POST['venue'];
		$address = $_POST['address'];
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
		$summary = $_POST['summary']; 


		$generalinformation = $_POST['generalinformation'];
		$industry = $_POST['industry'];
		$products = $_POST['products'];
		$attendee_information = $_POST['attendee_information'];
		$exhibitor_information = $_POST['exhibitor_information'];
		$show_organizer = $_POST['show_organizer'];
		
		$contact_person = $_POST['contact_person'];
		$jobtitle = $_POST['jobtitle'];
		$business_email = $_POST['business_email'];
		
		$businessphone = $_POST['businessphone'];
		$faxnumber = $_POST['faxnumber']; 
		$businessaddress = $_POST['businessaddress'];
		
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$country2 = $_POST['country2'];

		
		$filename=basename($_FILES['uploadedfile']['name']);
		$tmpfilename=$_FILES['uploadedfile']['tmp_name'];
		$uploadpath1="uploads/".$filename;
   		move_uploaded_file($tmpfilename,$uploadpath1); 				
		
 		/*echo "INSERT INTO tbl_tradeshow (
		show_name, 
		events_fromdate, 
		events_todate,
		from_time,
		to_time, 
		venue, 
		address, 
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
		general_information, 
		industry_focus, 
		productsfocus, 
		attendee_information, 
		exhibitors_information, 
		show_organizer, 
		contact_person, 
		job_title,
		business_email, 
		business_phone, 
		organizer_fax, business_address, 
		business_city, 
		business_state, 
		zipcode, 
		organizer_country) VALUES ( 
		'$showname', 
		'$from', 
		'$to',
		'$fromtime',
		'$totime', 
		'$venue', 
		'$address', 
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
		'$generalinformation', 
		'$industry', 
		'$products', 
		'$attendee_information', 
		'$exhibitor_information', 
		'$show_organizer', 
		'$contact_person', 
		'$jobtitle', 
		'$business_email', 
		'$businessphone', 
		'$faxnumber', 
		'$businessaddress', 
		'$city', 
		'$state', 
		'$zip', 
		'$country2')";  exit;
		*/

		$sql = "INSERT INTO tbl_tradeshow (
		show_name, 
		events_fromdate, 
		events_todate,
		from_time,
		to_time, 
		venue, 
		address, 
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
		general_information, 
		industry_focus, 
		productsfocus, 
		attendee_information, 
		exhibitors_information, 
		show_organizer, 
		contact_person, 
		job_title,
		business_email, 
		business_phone, 
		organizer_fax, business_address, 
		business_city, 
		business_state, 
		zipcode, 
		organizer_country) VALUES ( 
		'$showname', 
		'$from', 
		'$to',
		'$fromtime',
		'$totime', 
		'$venue', 
		'$address', 
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
		'$generalinformation', 
		'$industry', 
		'$products', 
		'$attendee_information', 
		'$exhibitor_information', 
		'$show_organizer', 
		'$contact_person', 
		'$jobtitle', 
		'$business_email', 
		'$businessphone', 
		'$faxnumber', 
		'$businessaddress', 
		'$city', 
		'$state', 
		'$zip', 
		'$country2')"; 
		
		  header("Location:tradeshow.php"); 
		$result = mysqli_query($con,$sql) or die("Error in inserting trade show".mysqli_error($con)); 
  return $result;


	}

?>

