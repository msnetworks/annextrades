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

/*$productselect="select * from `tbl_seller` where ((seller_subject LIKE '%$key%' or seller_keyword Like '%$key%') or (seller_description Like '$key%' or seller_detaildescription Like '$key')) and (status ='$status')";*/

$productselect="SELECT *,tbl_seller.seller_country as countyid,registration.id as regid from tbl_seller,registration,category where ((tbl_seller.seller_subject LIKE '%$key%' or tbl_seller.seller_keyword Like '%$key%') or (tbl_seller.seller_description Like '$key%' or tbl_seller.seller_detaildescription Like '$key')) and (tbl_seller.status ='$status') and category.c_id=tbl_seller.seller_category and registration.companyname!='' and registration.id=tbl_seller.user_id order by seller_id desc";

}
if((($_REQUEST['show']=="") && ($_REQUEST['key']=="")) || ($_REQUEST['show']=="All"))
{
$productselect="SELECT *,tbl_seller.seller_country as countyid,registration.id as regid from tbl_seller,registration,category where category.c_id=tbl_seller.seller_category and registration.companyname!='' and registration.id=tbl_seller.user_id order by seller_id desc";

}
        $csvoutput ="";  
		$header = "Report" ." ". "Selling Leads";
		$header .= "\n\n";
		$csvoutput .= $header;
		$str ="Username,Email,Selling Lead Type,Subject,Keyword,Category,Subcategory,Briefdescription,Detaildescription,Valid,Business Type,Business Range,Update Date,Expire Date,Companyname,Streetaddress,City,State,Country,Zipcode";
		$csvoutput .= $str;
		
		$query=mysqli_query($con,$productselect);
		$sss=0;
 	 	  while($result=mysqli_fetch_array($query))
		  {
		 $userid=$result['user_id'];
		 $reg=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$userid'"));
		 $country=$result['seller_country'];
		 $update=$result['seller_updated_date'];
		 $expdate=$result['seller_expired_date'];
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
		 
		 $btype=$result['seller_businesstype'];
		 $butype=explode(",",$btype);
		 foreach($butype as $bussinee)
		 {
		 $buss.=$bussinee;
		 }
		 $subcat=$result['seller_subcategory'];
		 $con=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$country'"));
		 $category=$result['seller_category'];
		 $cat=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$category'"));
		 $subcat=mysqli_fetch_array(mysqli_query($con,"select * from category where c_id='$subcat'"));
		 
		 $cat['category'];
		 $subcat['category'];
		 
		   $csvoutput .= "\n";
		   $string = "$reg[firstname],$reg[email],$result[seller_leadtype],$result[seller_subject],$result[seller_keyword],$cat[category],$subcat[category],$result[seller_description],$result[seller_detaildescription],$result[seller_valid],$buss,$result[seller_businessrange],$upexdate,$exdate,$result[seller_companyname],$result[seller_address],$result[seller_city],$result[seller_state],$con[country_name],$result[seller_zip]";
		   
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
