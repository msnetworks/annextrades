<?php 
	//session_start();
	ob_start();
	
	include("../db-connect/notfound.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	if((isset($_REQUEST['key'])) || (isset($_REQUEST['searchin'])))
	{
	$keyword=$_REQUEST['key'];
	if($_REQUEST['searchin']=="username")
		{
		//echo "select * from registration where firstname like '%$keyword%' or lastname like '%$keyword%'";
			$productselect="select * from registration where firstname like '%$keyword%' or lastname like '%$keyword%'";
		}
		if($_REQUEST['searchin']=="company")
		{
		//echo "select * from registration where companyname like '%$keyword%'";
			$productselect="select * from registration where companyname like '%$keyword%'";
		}
	}
	
	if(($_REQUEST['key']=="") && ($_REQUEST['searchin']==""))
	{
$productselect="select * from registration";
	}
        $csvoutput ="";  
		$header = "Report";
		$header .= "\n\n";
		$csvoutput .= $header;
		$str ="Usermail,Security Question,Security Answers,Firstname,Lastname,Gender,Street,City,State,Zipcode,Country,Countrycode,Areacode,Phonenumber,Faxnumber,Mobile,Companyname,Membershiptype,Update";
		$csvoutput .= $str;
		
		$query=mysqli_query($con,$productselect);
		$sss=0;
 	 	  while($result=mysqli_fetch_array($query))
		  {
		  
		 $country=$result['country'];
		 $con=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
	
		   $csvoutput .= "\n";
		   $string = "$result[email],$result[security_question],$result[security_answers],$result[firstname],$result[lastname],$result[gender],$result[street],$result[city],$result[state],$result[zipcode],$con[country_name],$result[countrycode],$result[areacode],$result[phonenumber],$result[faxnumber],$result[mobile],$result[companyname],$result[membershiptype],$result[date]";
		   $csvoutput .= $string;
		   
		}
	
		$csvoutput .= "\n";
		$csvoutput .= "\n";
		$csvoutput .= "\n";
		
		$csvoutput .= "\n";
		$date=date("d-m-y ");
		$filename = "Report-$date.csv";
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition:  attachment; filename=\"".$filename."\"");
		echo($csvoutput);
	
?>
