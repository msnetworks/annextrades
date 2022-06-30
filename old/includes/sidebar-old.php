<div class="cate-list-cont"> 
<?php /*?><?php 
$select_cat="SELECT * FROM category WHERE parent_id=''";
$res_cat=mysqli_query($con,$select_cat);
$num=mysqli_num_rows($res_cat);
while($fetch_cat=mysqli_fetch_array($res_cat))
{
?>
<div class="technology" style="height:22px;
display:block;
color:#727272;
padding:5px 0px 3px 2px;
text-decoration:none; 
background:url(../images/plus.jpg) 5px 12px no-repeat;
list-style:none;
color:#727272;
border-bottom:#b3b2b2 dotted 1px;" > <a href="#" style="color:#727272"><?php echo $fetch_cat['category']; ?></a>

<?php $sel_subcat = mysqli_query($con,"select * from category WHERE parent_id='$fetch_cat[c_id]' ");

while($sel_subcate=mysqli_fetch_array())
{
?>
<div class="thelanguage">
<?php echo $sel_subcate['category']; ?>
</div>


<?php  } ?> 
</div>
<?php  } ?><?php */?>


<?php 
if($_SESSION['language']=='english')
{
$select_cat="SELECT * FROM category WHERE parent_id='' ORDER BY category ASC LIMIT 0,10";
}
else if($_SESSION['language']=='french')
{
$select_cat="SELECT * FROM category_french WHERE parent_id='' ORDER BY category ASC LIMIT 0,10";
}
else if($_SESSION['language']=='chinese')
{
$select_cat="SELECT * FROM category_chinese WHERE parent_id='' ORDER BY category ASC LIMIT 0,10";
}
else 
{
$select_cat="SELECT * FROM category_spanish WHERE parent_id='' ORDER BY category ASC LIMIT 0,10";
}

$res_cat=mysqli_query($con,$select_cat);
$num=mysqli_num_rows($res_cat);

$i==1;
while($fetch_cat=mysqli_fetch_array($res_cat))
{
if($_SESSION['language']=='english')
{
$sel_subcat = mysqli_query($con,"select * from category WHERE parent_id='$fetch_cat[c_id]' ");
}
else if($_SESSION['language']=='french')
{
$sel_subcat = mysqli_query($con,"select * from category_french WHERE parent_id='$fetch_cat[c_id]' ");
}
else if($_SESSION['language']=='chinese')
{
$sel_subcat = mysqli_query($con,"select * from category_chinese WHERE parent_id='$fetch_cat[c_id]' ");
}
else 
{
$sel_subcat = mysqli_query($con,"select * from category_spanish WHERE parent_id='$fetch_cat[c_id]' ");
}
//$sel_subcat = mysqli_query($con,"select * from category WHERE parent_id='$fetch_cat[c_id]' ");
$num_count=mysqli_num_rows($sel_subcat);

//$sel_subcat1 = mysqli_query($con,"select * from category WHERE parent_id='$fetch_cat[c_id]' LIMIT 0,5 ");
?><div class="technology"  style="
min-height:22px;
display:block;
color:#727272;
padding:5px 0px 3px 2px;
text-decoration:none; 
list-style:none;
color:#727272;
border-bottom:#b3b2b2 dotted 1px;"><!--<a href="selling_buy_leads1.php?cat_id=<?php echo $fetch_cat['c_id']; ?>" onclick="javascript:window.location.href='selling_buy_leads1.php?cat_id=<?php echo $fetch_cat['c_id']; ?>'">--><?php echo $fetch_cat['category']."&nbsp;(".$num_count.")"; ?><!--</a>--><?php if($num_count!=0) { ?><img src="images/plus.gif" style="float:right;" /> <?php } ?>
</div>
<div class="thelanguage"><ul>
<?php 
while($sel_subcate=mysqli_fetch_array($sel_subcat))
{ ?><li  style="height:22px;display:block;color:#727272;padding:5px 0px 3px 20px;text-decoration:none; list-style:none;color:#727272;border-bottom:#b3b2b2 dotted 1px;"> <a href="selling_buy_leads1.php?subcat_id=<?php echo $sel_subcate['c_id']; ?>"><?php echo $sel_subcate['category']; ?></a> </li><?php } ?>
</ul>
</div>

<?php } ?>

<!--<div class="technology"  style="height:22px;
display:block;
color:#727272;
padding:5px 0px 3px 2px;
text-decoration:none; 
background:url(../images/plus.jpg) 5px 12px no-repeat;
list-style:none;
color:#727272;
border-bottom:#b3b2b2 dotted 1px;"> More
</div>

<div class="thelanguage"><ul>
<li style="height:22px;display:block;color:#727272;padding:5px 0px 3px 20px;text-decoration:none; list-style:none;color:#727272;border-bottom:#b3b2b2 dotted 1px;"> More</a> </li>
</ul>
</div>-->

<div style="padding-left:120px; color:#727272;"><a href="buyers1.php"><?php echo $more; ?>...</a></div>

</div>