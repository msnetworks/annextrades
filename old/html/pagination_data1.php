<?php 
include "db-connect/notfound.php";
$session_user=$_SESSION['user_login'];
//$_SESSION['language'] = 'english';
include("language/".$_SESSION['language']."/language.php");
$per_page1 = 3; 

if($_GET)
{
$page4=$_GET['page'];
}
$start1 = ($page4-1)*$per_page1;
$select_edit="SELECT * FROM product WHERE userid='$session_user' AND  status='3' limit $start1,$per_page1 ";
$res_edit=mysqli_query($con,$select_edit);
$num_rows_edit=mysqli_num_rows($res_edit);

if($num_rows_edit>0)
{
while($fet_edit=mysqli_fetch_array($res_edit))
{
$imgpath = "blog_photo_thumbnail/".$fet_edit['p_photo'];	
if(($fet_edit['p_photo'] != '') && (file_exists($imgpath)))
{
 $image="blog_photo_thumbnail/".$fet_edit['p_photo'];
}else{
 $image="blog_photo_thumbnail/profile_pic_small.gif";
}
?>

<table cellpadding="0" cellspacing="0" width="100%">

<tr><td>&nbsp;</td></tr>
<tr>

<td width="150"><img src="<?php echo $image;  ?>" width="80" height="80" /></td>
<td width="150"><strong><?php echo $fet_edit['p_name']; ?></strong></td>
<td width="150"><strong><?php echo substr($fet_edit['p_bdes'],0,50)."...";?></strong></td>
<td width="150"><strong><?php echo $fet_edit['udate'];?></strong></td>
<!--<td width="150"><strong><?php echo $fetch_buy2['expiredate'];?></strong></td>-->
<td width="150" ><strong style="padding-bottom:5px;">
<a href="product_view.php?id=<?php echo $fet_edit['id']; ?>"><span style=" padding-bottom:5px;"><?php echo $view; ?></span></a></strong> 
&nbsp;| &nbsp; <a href="edit_product.php?id=<?php echo $fet_edit['id']; ?>"><span style=" padding-bottom:5px; font-weight:bold;"><?php echo $edit; ?></span></a>&nbsp;| &nbsp;
<span style="padding-top:5px;"><a onClick="return delete_pro1('<?php echo $fet_edit['id']; ?>','<?php echo $page4; ?>');"><img src="images/close1.png" width="20" height="20" style="padding-top:5px;"  /></a></span>

</td>
</tr>
</table>
<?php }
}
else
{  ?>
<div style="padding:70px;"><?php echo $no_record; ?></div>
 <?php }?>