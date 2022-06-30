<?php 
include "db-connect/notfound.php";
$session_user=$_SESSION['user_login'];
//$_SESSION['language'] = 'english';
include("language/english/language.php");
$per_page2 = 20; 

if($_GET)
{
$page=$_GET['page'];
}

$start2 = ($page-1)*$per_page2;
$select_approve="SELECT * FROM product WHERE userid='$session_user' AND status='2' limit $start2,$per_page2";
$res_approve=mysqli_query($con,$select_approve);
$num_approve=mysqli_num_rows($res_approve);
if($num_approve>0) {
while($fetch_approve=mysqli_fetch_array($res_approve))
{
$imgpath1 = "blog_photo_thumbnail/".$fetch_approve['p_photo'];	
if(($fetch_approve['p_photo'] != '') && (file_exists($imgpath1)))
{
  $image5="blog_photo_thumbnail/".$fetch_approve['p_photo'];
}else{
  $image5="blog_photo_thumbnail/profile_pic_small.gif";
}
?>
<style>
  td{
    width : 20%;
    padding: 5 10; 
    font-size: 13px;
    font weight: 100;
  }
</style>

<table cellpadding="0" cellspacing="0" width="100%">

<!-- <tr><td>&nbsp;</td></tr> -->
<tr>
<td><img src="<?php echo $image5;  ?>" width="80" height="80" /></td>
<td><strong><?php echo $fetch_approve['p_name']; ?></strong></td>
<td><strong><?php echo substr(htmlspecialchars_decode($fetch_approve['p_bdes']),0,50)."...";?></strong></td>
<td><strong><?php echo $fetch_approve['udate']; ?></strong></td>
<td><strong style="padding-bottom:5px;">
<a href="product_view.php?id=<?php echo $fetch_approve['id']; ?>"><span style=" padding-bottom:5px;"><?php echo $view; ?></span></a></strong> 
&nbsp;| &nbsp; <a href="edit_product.php?id=<?php echo $fetch_approve['id']; ?>"><span style=" padding-bottom:5px;"><?php echo $edit; ?></span></a>&nbsp;| &nbsp;
<span style="padding-top:5px;"><a onClick="return delete_pro2('<?php echo $fetch_approve['id']; ?>','<?php echo $page; ?>');"><img src="images/close1.png" width="20" height="20" style="padding-top:5px;"  /></a></span>

</td>
</tr>
</table>
<?php } }  else {?>

<div style="padding:70px;"><?php echo $no_record; ?></div>
<?php } ?>