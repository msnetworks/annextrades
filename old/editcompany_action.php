<?php 
//print_r($_REQUEST); exit;
 ob_start();
 session_start();
 $session_user=$_SESSION['user_login'];
 include "db-connect/notfound.php";
 include("easythumbnail.class.php");
 
  $sql_ed=(mysqli_query($con,"select * from companyprofile where user_id='$sess_id'"));
  $row_ed=mysqli_fetch_array($sql_ed);
  $Logo=$row_ed['companylogo'];
  
if(isset($_REQUEST['Editsubmit']))
{
$Companyname=$_REQUEST['companyname'];
$Bussinesstype=$_REQUEST['bussiness_type']; 
$P_service=$_REQUEST['P_service'];
$Companyaddress=$_REQUEST['company_address'];
$URL=$_REQUEST['url'];
$Companydetails=$_REQUEST['company_details'];
$Year=$_REQUEST['year'];
$Certification=$_REQUEST['certification'];  
$brand=$_REQUEST['brand'];
$noofemployee=$_REQUEST['noofemployee'];
$bussinessowner=$_REQUEST['bussinessowner2'];
$registeredcapital=$_REQUEST['registeredcapital'];
$ownertype=$_REQUEST['ownertype'];
//$mainmarkets=$_REQUEST['mainmarkets'];
        ///  mainmarket ////  
 $mainmarket = $_REQUEST['market'];		  	 
 for($c = 0; $c < sizeof($mainmarket); $c++)
  {
   $Mainmarket = implode(',',$_REQUEST['market']); 
  } 
    ///////////////
$maincustomer=$_REQUEST['maincustomer2'];
$exportpercentage=$_REQUEST['exportpercentage'];
$toannualsalesvolume=$_REQUEST['toannualsalesvolume'];
$toannualpurchasevolume=$_REQUEST['toannualpurchase'];
$factorysize=$_REQUEST['factorysize'];
$factorylocation=$_REQUEST['factorylocation'];
$qaqc=$_REQUEST['quali'];
$noofprodlines=$_REQUEST['noofprodline'];
$noofrdstaff=$_REQUEST['noofrdstaff'];
$noofqcstaff=$_REQUEST['noofqcstaff'];
//$mgmtcertification=$_REQUEST['mgmtcertification'];
	          ///  Management Certificate ////  
 $mgmcertification = $_REQUEST['mgmcertification'];		  	 
 for($h = 0; $h < sizeof($mgmcertification); $h++)
  {
   $Mgmcertification = implode(',',$_REQUEST['mgmcertification']); 
  } 
	     /////////////
$contactmant=$_REQUEST['contactmfcr'];
  for($W = 0; $W < sizeof($contactmant); $W++)
  {
   $contactmant1 = implode(',',$_REQUEST['contactmfcr']); 
  } 

/*$Companylogo= basename($_FILES['companylogo']['name']);
$uploaddir='logo/';
$uploadfile=$uploaddir . basename($_FILES['companylogo']['name']);
if(move_uploaded_file($_FILES['companylogo']['tmp_name'], $uploadfile))
{
//echo "uploaded successfully";
}
else
{
//echo "error";
}
*/

$filename=basename($_FILES['companylogo']['name']);

$tmpfilename=$_FILES['companylogo']['tmp_name'];
$uploadpath1="logo/".$filename;
move_uploaded_file($tmpfilename,$uploadpath1); 	

$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);

/*$newfilename=basename($_FILES['companylogo']['name']);
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
*/
//$ftimages = "blog_photo_thumbnail/".$Companylogo;
//$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);

/*if($Companylogo=="") 
{
 $Photo=$Logo; 
 }else {
 $Photo=$Companylogo;
 }*/

if($filename!="")
{
$photofile=$filename;
}
else
{
$photofile=$Logo;
 }


$update_reg= "UPDATE `registration` SET `companyname` ='$Companyname' WHERE `id` ='$sess_id'"; 
$update_reg_query=mysqli_query($con,$update_reg);


/*echo "UPDATE `companyprofile` set
`companyname`='$Companyname',
`bussiness_type`='$Bussinesstype',
`P_service`='$P_service' ,
`company_address`='$Companyaddress' ,
`companylogo`= '$photofile',
`url`='$URL',
`company_details`='$Companydetails',
`year`= '$Year' ,
`certification`='$Certification',
`brand`='$brand',
`noofemployee`='$noofemployee',
`bussinessowner`='$bussinessowner',
`registeredcapital`='$registeredcapital',
`ownertype`='$ownertype',
`mainmarkets`='$Mainmarket',
`maincustomer`='$maincustomer',
`toannualsalesvolume`='$toannualsalesvolume',
`toannualpurchasevolume`='$toannualpurchasevolume',
`exportpercentage`='$exportpercentage',
`factorysize`='$factorysize',
`factorylocation`='$factorylocation',
`qa/qc`='$qaqc',
`noofprodlines`='$noofprodlines',
`noofr&dstaff`='$noofrdstaff',
`noofqcstaff`='$noofqcstaff',
`mgmtcertification`='$Mgmcertification',
`contactmant`='$contactmant1' WHERE `user_id` ='$session_user' ";  break;*/

$updatesql =  "UPDATE `companyprofile` set
`companyname`='$Companyname',
`bussiness_type`='$Bussinesstype',
`P_service`='$P_service' ,
`company_address`='$Companyaddress' ,
`companylogo`= '$photofile',
`url`='$URL',
`company_details`='$Companydetails',
`year`= '$Year' ,
`certification`='$Certification',
`brand`='$brand',
`noofemployee`='$noofemployee',
`bussinessowner`='$bussinessowner',
`registeredcapital`='$registeredcapital',
`ownertype`='$ownertype',
`mainmarkets`='$Mainmarket',
`maincustomer`='$maincustomer',
`toannualsalesvolume`='$toannualsalesvolume',
`toannualpurchasevolume`='$toannualpurchasevolume',
`exportpercentage`='$exportpercentage',
`factorysize`='$factorysize',
`factorylocation`='$factorylocation',
`qa/qc`='$qaqc',
`noofprodlines`='$noofprodlines',
`noofr&dstaff`='$noofrdstaff',
`noofqcstaff`='$noofqcstaff',
`mgmtcertification`='$Mgmcertification',
`contactmant`='$contactmant1' WHERE `user_id` ='$session_user' ";
  $up_query=mysqli_query($con,$updatesql);
  




 $sql=(mysqli_query($con,"select * from  companyprofile where user_id='$session_user'"));
 $count=mysqli_num_rows($sql);
 //$row=mysqli_fetch_array($sql);
 
 ////////// REFRESH PAGE ///////////	
 
 header("location:company.php?succ");
 
 ////////////////////
 
 
 

if($count == 1)
{
 
//header("Location:companyprofilemain.php?error=10");
} 
}
if($_REQUEST['error']==10){

//echo '<script>javascript:show("editcompanydetails")
}
 ?>
 		 