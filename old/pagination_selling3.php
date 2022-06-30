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
$select_app_pen="select * from tbl_seller where status='0' and user_id='$session_user' and trash='0' limit $start,$per_page ";
$res_app_pen=mysqli_query($con,$select_app_pen);
$num_rows=mysqli_num_rows($res_app_pen);
if($num_rows>0)
{

while($fetch_app_pen=mysqli_fetch_array($res_app_pen))
{
 $imgpath1 = "uploads/".$fetch_app_pen['seller_photo'];	
 $id = $fetch_app_pen['user_id'];
$seller_id = $fetch_app_pen['seller_id'];
$da = $fetch_app_pen['seller_updated_date'];
 
if(($fetch_app_pen['seller_photo'] != '') && (file_exists($imgpath1)))
{
  $image5="uploads/".$fetch_app_pen['seller_photo'];
}else{
  $image5="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
<table cellpadding="0" cellspacing="0" width="100%">

<tr><td>&nbsp;</td></tr>
<tr>
<!--<td width="50" align="center" valign="top"><input type="checkbox" name="checkbox[]" value="<?php //echo $seller_id;?>" />
<input type="checkbox" name="checkbox[]" value="<?PHP echo $seller_id;?>" id="checkbox[<?PHP echo $i;?>]" /></td>-->
<td width="150"><img src="<?php echo $image5;  ?>" width="80" height="80" /></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_app_pen['seller_subject']);?></strong></td>
<td width="150"><strong><?PHP echo ucfirst($fetch_app_pen['seller_updated_date']);?></strong></td>
<td width="150"><strong><?php echo $fetch_app_pen['seller_expired_date'];?></strong></td>
<td width="150"><strong><?php if($fetch_app_pen['payad_status']=='1') { echo "Sold"; } else { echo "Pending"; }?></strong></td>

<td width="100" ><strong style="padding-bottom:5px;"><a href="selling_view.php?id=<?php echo $fetch_app_pen['seller_id']; ?>"><span style=" padding-bottom:5px;"><?php echo $view; ?></span></a></strong>&nbsp;| &nbsp;<strong style="padding-bottom:5px;"><a href="selling_edit.php?id=<?php echo $fetch_app_pen['seller_id']; ?>"><span style=" padding-bottom:5px;"><?php echo $edit; ?></span></a></strong>&nbsp;| &nbsp;<span style="padding-top:5px;"><a onClick="return delete_fun4('<?php echo $fetch_app_pen['seller_id']; ?>','<?php echo $page; ?>');"><img src="images/close1.png" width="20" height="20" style="padding-top:5px;"  /></a></span></td>
</tr>
</table>
<?php } } else { ?>
<div style="padding:70px;"><?php echo $no_record; ?></div>
<?php } ?>
