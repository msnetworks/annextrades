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
$select_buy="SELECT * FROM buyingleads where id='$session_user' and status='1' and trash = 0 limit $start,$per_page ";
$res_buy=mysqli_query($con,$select_buy);
$num_rows_buy=mysqli_num_rows($res_buy);
if($num_rows_buy>0)
{
while($fetch_buy=mysqli_fetch_array($res_buy))
{
 $imgpath1 = "upload/".$fetch_buy['photo'];	
 $id = $fetch_buy['user_id'];
$seller_id = $fetch_buy['seller_id'];
$da = $fetch_buy['seller_updated_date'];
 
if(($fetch_buy['photo'] != '') && (file_exists($imgpath1)))
{
  $image5="upload/".$fetch_buy['photo'];
}else{
  $image5="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
<table cellpadding="0" cellspacing="0" width="100%">

<tr><td>&nbsp;</td></tr>
<tr>

<td width="150"><img src="<?php echo $image5;  ?>" width="80" height="80" /></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_buy['subject']);?></strong></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_buy['update_date']);?></strong></td>
<td width="150"><strong><?php echo $fetch_buy['expiredate'];?></strong></td>
<td width="100" ><strong style="padding-bottom:5px;"><a href="buying_view.php?id=<?php echo $fetch_buy['buy_id']; ?>"><span style=" padding-bottom:5px;"><?php echo $view; ?></span></a></strong> &nbsp;| &nbsp;<strong style="padding-bottom:5px;"><a href="buying_edit.php?id=<?php echo $fetch_buy['buy_id']; ?>"><span style=" padding-bottom:5px;"><?php echo $edit; ?></span></a></strong> &nbsp;| &nbsp;<span style="padding-top:5px;"><!--<a onClick="return delete_buy('<?php echo $fetch_buy['buy_id']; ?>','<?php echo $page; ?>');">--><a onClick="return delete_buy('<?php echo $fetch_buy['buy_id']; ?>','<?php echo $page; ?>');"><img src="images/close1.png" width="20" height="20" style="padding-top:5px;"  /></a></span></td>
</tr>
</table>
<?php } } else { ?>
<div style="padding:70px;"><?php echo $no_record; ?></div>
	<?php }  ?>