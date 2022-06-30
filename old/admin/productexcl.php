<?php 
	//session_start();
	ob_start();
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

$productselect="select * from `product` where ((p_name LIKE '%$key%' or p_keyword Like '%$key%') or (p_bdes Like '$key%' or p_ddes Like '$key')) and (status='$status')";
}

if((($_REQUEST['show']=="") && ($_REQUEST['key']=="")) || ($_REQUEST['show']=="All"))
{
$productselect="SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
        $csvoutput ="";  
		$header = "Report" ." ". "Products";
		$header .= "\n\n";
		$csvoutput .= $header;
		$str ="Username,Email,Subject,Keyword,Category,Subcategory,Briefdescription,Price Range,Payment Type,Minimam Order Quantity,Production Capacity,Delivery Time,Packaging Detail,Update Date,Expire Date,Companyname,Streetaddress,City,State,Country,Zipcode";
		$csvoutput .= $str;
		
		$query=mysqli_query($con,$productselect);
		$sss=0;
 	 	  while($result=mysqli_fetch_array($query))
		  {
		 $userid=$result['userid'];
		 $reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$userid'"));
		 
		 $country=$result['country'];
		 $update=$result['udate'];
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
		 
		 $subcat=$result['p_subcategory'];
		 $production=$result['p_capaacity']."-".$result['p_ctype']." "."per"." ".$result['percapacity'];
		 $miniorder=$result['p_min_quanity']."-".$result['p_quanity_type'];
		 $price=$result['p_price']."-".$result['range1']." to ".$result['range2'];
		 $con=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
		 $category=$result['p_category'];
		 $cat=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$category'"));
		 $subcat=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$subcat'"));
		 
		 $cat['category'];
		 $subcat['category'];
		 $ddes=strip_tags($result[p_ddes]);
		   $csvoutput .= "\n";
		   $string = "$reg[firstname],$reg[email],$result[p_name],$result[p_keyword],$cat[category],$subcat[category],$result[p_bdes],$price,$result[paymenttype],$miniorder,$production,$result[p_delivertytime],$result[p_packingdetails],$upexdate,$exdate,$reg[companyname],$reg[street],$reg[city],$reg[state],$con[country_name],$reg[zipcode]";
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
