<?php
 ob_start();
 session_start();
 $session_user=$_SESSION['user_login'];
 include "db-connect/notfound.php";
  include("easythumbnail.class.php");
  $sql=(mysqli_query($con,"select * from  registration where id='$sess_id'"));
							$count=mysqli_num_rows($sql);
							$row=mysqli_fetch_array($sql);
							
					//		print_r();
							
if(isset($_REQUEST['Addsubmit123']))
{
 $User_id=$session_user;
 $Companyname=$row['companyname'];	
 $Bussinessmail=$row['email'];
 $companyname=$_REQUEST['companyname'];	
 $Bussinesstype=$_REQUEST['bussiness_type']; 
 $P_service=$_REQUEST['P_service'];
 $Companyaddress=$_REQUEST['company_address'];
  // $Companylogo=$_REQUEST['company_logo']; 
 $URL=$_REQUEST['url'];
 $Companydetails=$_REQUEST['company_details'];
 $Year=$_REQUEST['year'];
 $Certification=$_REQUEST['certification'];
 
          ///  mainmarket ////  
 $mainmarket = $_REQUEST['market'];		  	 
 for($c = 0; $c < sizeof($mainmarket); $c++)
  {
   $Mainmarket = implode(',',$_REQUEST['market']); 
  } 
	     /////////////
  $Brand = $_REQUEST['brand'];   
  $NoofEmployee=$_REQUEST['noofemployee']; 
  $Bussinessowner = $_REQUEST['bussinessowner']; 
  $Registeredcapital=$_REQUEST['registeredcapital']; 
  $Ownertype = $_REQUEST['ownertype']; 
  $Maincustomer = $_REQUEST['maincustomer']; 
  $Toannualsalesvolume = $_REQUEST['toannualsalesvolume']; 
  $Exportpercentage = $_REQUEST['exportpercentage']; 
  $Toannualpurchase = $_REQUEST['toannualpurchase']; 
  $Factorysize = $_REQUEST['factorysize']; 
  $Factorylocation = $_REQUEST['factorylocation']; 
  $Qaqc = $_REQUEST['qa/qc']; 
  $Noofprodline = $_REQUEST['noofprodline'];
  $Noofrdstaff = $_REQUEST['noofrdstaff'];
  $Noofqcstaff = $_REQUEST['noofqcstaff'];
		          ///  Management Certificate ////  
 $mgmcertification = $_REQUEST['mgmcertification'];		  	 
 for($h = 0; $h < sizeof($mgmcertification); $h++)
  {
   $Mgmcertification = implode(',',$_REQUEST['mgmcertification']); 
  } 
	     /////////////
		          ///  Contact Manfacure ////  
  $contactmfcr[] = $_REQUEST['contactmfcr'];		  	 
 for($g = 0; $g < sizeof($contactmfcr); $g++)
  {
 $Contactmfcr = implode(',',$_REQUEST['contactmfcr']); 
  } 
	   
if($row['companyname']!="")
{
$cname=$Companyname;
}else{
$cname=$companyname;
}

$newfilename=basename($_FILES['companylogo']['name']);
$uploaddir='logo/';
$uploadfile=$uploaddir . $newfilename;
if(move_uploaded_file($_FILES['companylogo']['tmp_name'], $uploadfile))
{
echo "uploaded successfully";
}
else
{
echo "error";
}
$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);

$todate=date('Y-m-d');

$insertsql ="INSERT INTO companyprofile (user_id , companyname , bussiness_type , P_service , company_address , mailid , companylogo , url , company_details , year , brand , noofemployee , bussinessowner , registeredcapital , ownertype , mainmarkets ,maincustomer, toannualsalesvolume , exportpercentage , toannualpurchasevolume , factorysize , factorylocation , `qa/qc` , noofprodlines , `noofr&dstaff` , noofqcstaff ,mgmtcertification, contactmant, add_date )
VALUES ('$User_id', '$cname', '$Bussinesstype', '$P_service', '$Companyaddress', '$Bussinessmail', '$newfilename', '$URL', '$Companydetails', '$Year','$Brand', '$NoofEmployee', '$Bussinessowner', '$Registeredcapital', '$Ownertype', '$Mainmarket','$Maincustomer', '$Toannualsalesvolume', '$Exportpercentage', '$Toannualpurchase', '$Factorysize', '$Factorylocation', '$Qaqc', '$Noofprodline', '$Noofrdstaff', '$Noofqcstaff','$Mgmcertification', '$Contactmfcr', '$todate' )";   
 $query=mysqli_query($con,$insertsql); 
 
 if($row['companyname']=="")
 {
 mysqli_query($con,"update registration set companyname='$cname' where id='$session_user'");
 }
 
 
  
 ////////// REFRESH PAGE ///////////	
 
 header("location:company.php");
 
 ////////////////////

 
//$sql=(mysqli_query($con,"select * from  companyprofile where  user_id='$sess_id'"));
//$count=mysqli_num_rows($sql);
//$row=mysqli_fetch_array($sql);

if($count == 0)
{
//header("Location:login.php?error=1");
} 
else
{
//echo  $_SESSION['sess_id']=$row['id'];  
//header("Location:welcome_1.php");
} 


}
 ?> 