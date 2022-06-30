<div class="body-right2">

    <!--<div class="bluebox-cont2"> 
<div class="blueheading2">Related Links</div>
<div class="blue-content2">Related Suppliers - 23456<br />
  Related Trade Leads - 23456</div>

</div>-->



    <div class="bluebox-cont2">
        <div class="blueheading2"><?php echo $featured; ?></div>
        <div class="blue-content2">
            <?php 
$select_featurre="SELECT * FROM featureproducts ORDER BY RAND() LIMIT 0,3";
$res_featutte=mysqli_query($con,$select_featurre);
while($feature_fetch=mysqli_fetch_array($res_featutte))
{
 if($_SESSION['language']=='english')
{
$product=$feature_fetch['f_pdt_name'];
$company=$feature_fetch['companyname'];
}
else if($_SESSION['language']=='french')
{
$product=$feature_fetch['f_pdt_name_french'];
$company=$feature_fetch['companyname_french'];
}
else if($_SESSION['language']=='chinese')
{
$product=$feature_fetch['f_pdt_name_chinese'];
$company=$feature_fetch['companyname_chinese'];
}
else
{
$product=$feature_fetch['f_pdt_name_spanish'];
$company=$feature_fetch['companyname_spanish'];
}

/*$imgpath = "admin/picture/".$fetch_pro['f_pdt_images'];
	 if(($fetch_pro['f_pdt_images'] != '') && (file_exists($imgpath)))
	 {
		$FeatureProducts="admin/picture/".$fetch_pro['f_pdt_images'];
	 } else {
	   $FeatureProducts = "images/img_noimg.jpg";
	 }*/
	 
if((file_exists("admin/picture/".$feature_fetch['f_pdt_images']))&&($feature_fetch['f_pdt_images']!='')) {

$imageeee1="admin/picture/".$feature_fetch['f_pdt_images'];
}
else
{
$imageeee1="admin/picture/img_noimg.jpg";
}
?>
            <div class="related-product-cont">

                <div class="related-img"><img src="<?php echo $imageeee1; ?>" alt="" width="51" height="51" /> </div>

                <div class="related-pro-content"><strong> <a
                            href="product_view1.php?pid=<?php echo $feature_fetch['id']; ?>"><?php echo $product; ?></a></strong>
                    <br /> <span> <b><?php echo $by; ?></b> <?php echo $company; ?>
                    </span><br />
                    <span><?php if($feature_fetch['minimum_quantity']!=''){ echo $feature_fetch['minimum_quantity'];}?><?php if($feature_fetch['pdt_quantity']!='') {echo $feature_fetch['pdt_quantity']; }?>
                    </span>
                </div>
            </div>

            <?php } ?>

            <!--<div class="related-product-cont">

<div class="related-img"><img src="images/related-product.jpg" alt="" width="51" height="51" /> </div>

<div class="related-pro-content"><strong> <a href="#">P10 LED Screen 
Display</a></strong> <br/>  <span> <b>by</b> Shenzhen Donglian
Electronics Technology </span></div>
 </div>-->


            <!--<div class="related-product-cont">

<div class="related-img"><img src="images/related-product.jpg" alt="" width="51" height="51" /> </div>

<div class="related-pro-content"><strong> <a href="#">P10 LED Screen 
Display</a></strong> <br/>  <span> <b>by</b> Shenzhen Donglian
Electronics Technology </span></div>
 </div>-->


        </div>

    </div>

    <div></div>

    <?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='0' order by RAND()");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='1' order by RAND()");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='2' order by RAND()");
}
else
{
$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='3' order by RAND()");
}
	
	$success=mysqli_fetch_array($select);
	
?>

    <!-- <div class="bluebox-cont2">
        <div class="blueheading2"><?php echo $succ_sto; ?></div>
        <div class="blue-content2">
            <div class="related-product-cont">

                <div class="related-img2">
                    <a href="detailstory.php?id=<?php echo $success['test_id']; ?>"><?php if($success['photo'] == "") { ?>
                        <img src="blog_photo_thumbnail/img_noimg.jpg" width="55" height="55" />
                        <?php } else { ?>
                        <img src="blog_photo_thumbnail/<?php echo $success['photo']; ?>" width="55" height="55" />
                        <?php } ?></a>
                </div>

                <div class="related-pro-content2"><a
                        href="detailstory.php?id=<?php echo $success['test_id']; ?>"><?php echo $success['testcompany']; ?><br /><?php echo $success['testname']; ?>[<?php echo $success['testcountry']; ?>]</a>
                </div>

                <div class="sucess-cont">
                    <?php echo substr($success['testnote'],0,150); if(strlen($success['testnote'])>150) { echo "..."; } ?><a
                        href="detailstory.php">.[<?php echo $more; ?>] </a></div>

            </div>


        </div>

    </div> -->


    <div class="ad1"><?php 
						$sql="SELECT * FROM addmanager where status='1' LIMIT 0,1";
						$query=mysqli_query($con,$sql);
						$count=mysqli_num_rows($query);
						$details=mysqli_fetch_array($query);
						
echo $details['body'];?>
    </div>

</div>