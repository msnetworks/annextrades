<?php
include "db-connect/notfound.php";
$session_user=$_SESSION['user_login'];
//$_SESSION['language'] = 'english';
include("language/".$_SESSION['language']."/language.php");
$per_page = 3; 

if($_GET)
{
$page=$_GET['page'];
}
$start = ($page-1)*$per_page;
$select_buy1="SELECT * FROM buyingleads where id='$session_user' and status='3' and trash = 0 limit $start,$per_page ";
$res_buy1=mysqli_query($con,$select_buy1);
$num_rows_buy1=mysqli_num_rows($res_buy1);
if($num_rows_buy1>0)
{
while($fetch_buy1=mysqli_fetch_array($res_buy1))
{
 $imgpath2 = "upload/".$fetch_buy1['photo'];	
 $id = $fetch_buy1['user_id'];
$seller_id = $fetch_buy1['seller_id'];
$da = $fetch_buy1['seller_updated_date'];
 
if(($fetch_buy1['photo'] != '') && (file_exists($imgpath2)))
{
  $image2="upload/".$fetch_buy1['photo'];
}else{
  $image2="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
<table cellpadding="0" cellspacing="0" width="100%">

<tr><td>&nbsp;</td></tr>
<tr>

<td width="150"><img src="<?php echo $image2;  ?>" width="80" height="80" /></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_buy1['subject']);?></strong></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_buy1['update_date']);?></strong></td>
<td width="150"><strong><?php echo $fetch_buy1['expiredate'];?></strong></td>
<td width="100" ><strong style="padding-bottom:5px;"><a href="buying_view.php?id=<?php echo $fetch_buy1['buy_id']; ?>"><span style="padding-bottom:5px;"><?php echo $view; ?></span></a></strong> &nbsp;| &nbsp;<strong style="padding-bottom:5px;"><a href="buying_edit.php?id=<?php echo $fetch_buy1['buy_id']; ?>"><span style="padding-bottom:5px;"><?php echo $edit; ?></span></a></strong> &nbsp;| &nbsp;<span style="padding-top:5px;"><!--<a onClick="return delete_buy('<?php echo $fetch_buy1['buy_id']; ?>','<?php echo $page; ?>');">--><a onClick="return delete_new('<?php echo $fetch_buy1['buy_id']; ?>','<?php echo $page; ?>');"><img src="images/close1.png" width="20" height="20" style="padding-top:5px;"  /></a></span></td>
</tr>
</table>
<?php } } else { ?>
<div style="padding:70px;"><?php echo $no_record; ?></div>
	<?php }  ?>