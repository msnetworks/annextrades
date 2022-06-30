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

if((isset($_REQUEST['show']) && isset($_REQUEST['key'])) || (isset($_REQUEST['show'])) || (isset($_REQUEST['key'])))
{

$show=$_REQUEST['show'];
$key=$_REQUEST['key'];

if($_REQUEST['show']=="Approval Pending")
{
$status='1';
}
if($_REQUEST['show']=="Editing Required")
{
$status='3';
}
if($_REQUEST['show']=="Approved")
{
$status='2';
}
if($_REQUEST['show']=="Expired")
{
$status='0';
}


$productselect="select * from buyingleads where ((subject LIKE '%$key%' or keyword Like '%$key%') or (keyword1 Like '$key%' or keyword2 Like '$key') or (detdes Like '$key' or briefdes Like '$key')) and (status='$status')";

//$productselect="select * from registration";

}
if((($_REQUEST['show']=="") && ($_REQUEST['key']=="")) || ($_REQUEST['show']=="All"))
{
/*$productselect="select * from buyingleads";*/

$productselect="SELECT *,buyingleads.country as countyid,registration.id as regid from buyingleads,registration,category where category.c_id=buyingleads.category and registration.companyname!='' and registration.id=buyingleads.id order by buy_id desc";

}
        $csvoutput ="";  
		$header = "Report" ." ". "Buying Leads";
		$header .= "\n\n";
		$csvoutput .= $header;
		$str ="Username,Email,Subject,Keyword,Keyword1,Keyword2,Category,Subcategory,Briefdescription,Detaildescription,Valid,Mycontact,Price Range,Minimam Order Quantity,Certification,Update Date,Expire Date,Companyname,Streetaddress,City,State,Country,Zipcode";
		$csvoutput .= $str;
		
		$query=mysqli_query($con,$productselect);
		$sss=0;
 	 	  while($result=mysqli_fetch_array($query))
		  {
		 $userid=$result['id'];
		 $reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$userid'"));
		 $country=$result['country'];
		 $update=$result['update_date'];
		 $expdate=$result['expiredate'];
		 $expd=explode(" ",$update);
		 $expd[0];
		 $ex1=$expd[1];
		 $expd[2];
		 $exrdate=explode(" ",$expdate);
		 $ex1ex=explode(",",$ex1);
		 $ex1ex[0];
		 $ex2=$exrdate[1];
		 $ex22=explode(",",$ex2);
		 $upexdate=$expd[0]."-".$ex1ex[0]."-".$expd[2];
		 $exdate=$exrdate[0]."-".$ex22[0]."-".$exrdate[2];
		 
		 $subcat=$result['subcategory'];
		 $miniorder=$result['miniquantity']."-".$result['quantity'];
		 $price=$result['price']."-".$result['range1']." to ".$result['range2'];
		 $con=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
		 $category=$result['category'];
		 $cat=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$category'"));
		 $subcat=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$subcat'"));
		 
		 $cat['category'];
		 $subcat['category'];
		 
		   $csvoutput .= "\n";
		   $string = "$reg[firstname],$reg[email],$result[subject],$result[keyword],$result[keyword1],$result[keyword2],$cat[category],$subcat[category],$result[briefdes],$result[detdes],$result[valid],$result[mycontact],$price,$miniorder,$result[certificate],$upexdate,$exdate,$result[companyname],$result[streetaddress],$result[city],$result[state],$con[country_name],$result[zip]";
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
