<?php 
	//session_start();
	//ob_start();
	include("../db-connect/notfound.php");
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
$show=$_REQUEST['show'];
$key=$_REQUEST['key'];

if(isset($_REQUEST['key']))
{
$key=$_REQUEST['key'];


$productselect="select * from `companyprofile` where companyname LIKE '%$key%' or bussiness_type Like '%$key%' or P_service Like '$key%' or company_address Like '$key'";

}
if($_REQUEST['key']=="")
{
$productselect="select * from `companyprofile`";

}
        $csvoutput ="";  
		$header = "Report" ." ". "Companyprofile";
		$header .= "\n\n";
		$csvoutput .= $header;
		$str ="Username,Email,Companyname,Bussiness type,Product Service,Company Address,Company Website,Company Detail,Year Established,Certification,Brand,No.of Employee,Business Owner,Registered Capital,Owner Type,Main Markets,Main Customer,Total Annual Sales Volume,Export Percentage,Total Annual Purchase Volume,Factory Size,factorylocation,QA/QC,No. of Production Lines,No. of R&D Staff,No. of QC Staff,Contact Manufacturing,Update Date";
		$csvoutput .= $str;
		
		$query=mysqli_query($con,$productselect);
		$sss=0;
 	 	  while($result=mysqli_fetch_array($query))
		  {
		 $qaqc=$result['qa/qc'];
		 $noofr=$result['noofr&dstaff'];
		 $userid=$result['user_id'];
		 $mainmarket=$result['mainmarkets'];
		 $main1=explode(",",$mainmarket);
		 foreach($main1 as $main2)
		 {
		 $mainmar.=$main2;
		 }
		 $contant=$result['contactmant'];
		 $cont=explode(",",$contant);
		 foreach($cont as $cont1)
		 {
		 $cont2.=$cont1;
		 }
		 $cert=$result['mgmtcertification'];
		 $cert1=explode(",",$cert);
		 foreach($cert1 as $cert2)
		 {
		 $cert3.=$cert2;
		 }
		 $reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$userid'"));
		 $country=$result['country'];
		 $con=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
		 
		   $csvoutput .= "\n";
		   $string = "$reg[firstname],$reg[email],$result[companyname],$result[bussiness_type],$result[P_service],$result[company_address],$result[url],$result[company_details],$result[year],$cert3,$result[brand],$result[noofemployee],$result[bussinessowner],$result[registeredcapital],$result[ownertype],$mainmar,$result[maincustomer],$result[toannualsalesvolume],$result[exportpercentage],$result[toannualpurchasevolume],$result[factorysize],$result[factorylocation],$qaqc,$result[noofprodlines],$noofr,$result[noofqcstaff],$cont2,$result[add_date]";
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
