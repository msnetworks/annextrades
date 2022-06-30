<?php
include "db-connect/notfound.php";
$session_user=$_SESSION['user_login'];
$_SESSION['language'] = 'english';
include("language/".$_SESSION['language']."/language.php");
$per_page = 3; 

if($_GET)
{
$page=$_GET['page'];
}
$start = ($page-1)*$per_page;
$select_buy2="SELECT * FROM buyingleads where id='$session_user' and status='2' and trash = 0 limit $start,$per_page ";
$res_buy2=mysqli_query($con,$select_buy2);
$num_rows_buy2=mysqli_num_rows($res_buy2);
if($num_rows_buy2>0)
{
while($fetch_buy2=mysqli_fetch_array($res_buy2))
{
 $imgpath4 = "upload/".$fetch_buy2['photo'];	
if(($fetch_buy2['photo'] != '') && (file_exists($imgpath4)))
{
  $image1="upload/".$fetch_buy2['photo'];
}else{
  $image1="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
<table cellpadding="0" cellspacing="0" width="100%">

<tr><td>&nbsp;</td></tr>
<tr>

<td width="150"><img src="<?php echo $image1;  ?>" width="80" height="80" /></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_buy2['subject']);?></strong></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_buy2['update_date']);?></strong></td>
<td width="140"><strong><?php echo $fetch_buy2['expiredate'];?></strong></td>
<td width="120" ><strong style="padding-bottom:5px;"><a href="buying_view.php?id=<?php echo $fetch_buy2['buy_id']; ?>"><span style=" padding-bottom:5px;"><?php echo $view; ?></span></a></strong> &nbsp;| &nbsp;<strong style="padding-bottom:5px;"><a href="buying_edit.php?id=<?php echo $fetch_buy2['buy_id']; ?>"><span style=" padding-bottom:5px;"><?php echo $edit; ?></span></a></strong> &nbsp;| &nbsp;<span style="padding-top:5px;"><!--<a onClick="return delete_buy('<?php echo $fetch_buy2['buy_id']; ?>','<?php echo $page; ?>');">--><a onClick="return delete_new1('<?php echo $fetch_buy2['buy_id']; ?>','<?php echo $page; ?>');"><img src="images/close1.png" width="20" height="20" style="padding-top:5px;"  /></a></span></td>
</tr>
</table>
<?php } } else { ?>
<div style="padding:70px;"><?php echo $no_record; ?></div>
	<?php }  ?>