<?php
include("db-connect/notfound.php");
$session_user=$_SESSION['user_login'];
//$_SESSION['language'] = 'english';
include("language/".$_SESSION['language']."/language.php");
 $dd=$_REQUEST['id'];
 
 $per_page = 3; 

if($_GET)
{
$page=$_GET['page'];
}
$start = ($page-1)*$per_page;


if(isset($_REQUEST['id']))
		{
			$selected = $_REQUEST['id'];
			
			$delete =mysqli_query($con,"DELETE FROM `product` WHERE `id` = '$selected' and userid='$session_user'"); 
			
 $select_app_pen="SELECT * FROM product WHERE userid='$session_user' AND status='1' limit $start,$per_page ";
$res_app_pen=mysqli_query($con,$select_app_pen);
$num_rows=mysqli_num_rows($res_app_pen);
?>
<tr>
<td><div style="color:#006600;"><?php echo $delete_success; ?></div></td></tr>
<tr><td>&nbsp;</td></tr>
<?php
if($num_rows>0)
{
while($fetch_app_pen=mysqli_fetch_array($res_app_pen))
{
$imgpath1 = "blog_photo_thumbnail/".$fetch_app_pen['p_photo'];	
if(($fetch_app_pen['p_photo'] != '') && (file_exists($imgpath1)))
{
  $image5="blog_photo_thumbnail/".$fetch_app_pen['p_photo'];
}else{
  $image5="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
<table cellpadding="0" cellspacing="0" width="100%">

<tr><td>&nbsp;</td></tr>
<tr>
<td width="150"><img src="<?php echo $image5;  ?>" width="80" height="80" /></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_app_pen['p_name']);?></strong></td>
<td width="150"><strong><?php echo substr($fetch_app_pen['p_bdes'],0,50)."...";?></strong></td>
<td width="150"><strong><?PHP echo $fetch_app_pen['udate'];?></strong></td>
<td width="100" ><strong style="padding-bottom:5px;"><a href="product_view.php?id=<?php echo $fetch_app_pen['id']; ?>"><span style=" padding-bottom:5px;"><?php echo $view; ?></span></a></strong>&nbsp;| &nbsp;<span style="padding-top:5px;"><a onClick="return delete_pro('<?php echo $fetch_app_pen['id']; ?>','<?php echo $page; ?>');"><img src="images/close1.png" width="20" height="20" style="padding-top:5px;"  /></a></span></td>
</tr>
</table>
<?php } } else { ?>
<div style="padding:70px;"><?php echo $no_record; ?></div>
<?php } 
			
		}
?>

