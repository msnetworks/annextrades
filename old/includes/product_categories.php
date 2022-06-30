<div class="cate-list-cont">

    <?php 
if($_SESSION['language']=='english')
{
$select_cat="SELECT * FROM category WHERE parent_id='' and c_id !='394'  ORDER BY category ASC";
}
else if($_SESSION['language']=='french')
{
$select_cat="SELECT * FROM category_french WHERE parent_id='' ORDER BY category ASC";
}
else if($_SESSION['language']=='chinese')
{
$select_cat="SELECT * FROM category_chinese WHERE parent_id='' ORDER BY category ASC";
}
else 
{
$select_cat="SELECT * FROM category_spanish WHERE parent_id='' ORDER BY category ASC";
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

$num_count=mysqli_num_rows($sel_subcat);

?>

<div class="technology">
        <?php echo $fetch_cat['category']."&nbsp;(".$num_count.")"; ?><?php if($num_count!=0) { ?><?php } ?>

        <div class="thelanguage">
        <ul>
            <?php 
while($sel_subcate=mysqli_fetch_array($sel_subcat))
{ ?><li> <a href="products.php?category=<?php echo $sel_subcate['c_id'];?>"><?php echo $sel_subcate['category']; ?></a>
            </li><?php } ?>
        </ul>
    </div>
    </div>


    

    <?php } ?>



    <!-- <div style="padding-left:120px; color:#727272;"><a href="buyers1.php"><?php echo $more; ?>...</a></div> -->

</div>