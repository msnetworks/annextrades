<?
include "../db-connect/notfound.php";
$get_val = $_REQUEST['get_val'];
$get_val = str_replace("www.","",$get_val);
if($get_val !="annexisbusinessdirectory.com"){ 
 $get_val= $_SERVER['HTTP_HOST']; 
 $get_val = str_replace("www.","",$get_val);
}
$getva = md5($get_val);
$GetRec = mysqli_fetch_array(mysqli_query($con,"select cms_on from b2b_cms"));
@extract($GetRec);
if($cms_on != $getva){
    mysqli_query($con,"update b2b_cms set cms_approve_st='$getva',cms_approve ='$get_val'");
}
?>