<?php 
include("includes/header.php"); 
?>
<div class="body-cont"> 
<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> Browse Category </div>
<?php include("includes/sidebar.php"); ?>

</div>

<div class="bluebox-cont"> 

<div class="blueheading"> Locations</div>
<div class="blue-content">
<ul> 
<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>


</ul>

<span class="more2"><a href="#"> More....</a></span></div>

</div>




<div class="bluebox-cont"> 

<div class="blueheading">Group Products</div>
<div class="blue-content">
  <a href="#">All Products</a> <br/> 
  <strong><a href="#">1  Product Per Company </a></strong></div>

</div>

<div class="bluebox-cont"> 

<div class="blueheading">Search Options</div>
<div class="blue-content">
  <table width="167" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" align="left" valign="top"><select name="select2" id="select2" class="selectbox">
        <option>Select Certification</option>
      </select>      </td>
    </tr>
    <tr>
      <td width="22" align="left" valign="top"><input type="checkbox" name="checkbox" id="checkbox" /></td>
      <td width="145" align="left" valign="top">Show Premium Suppliers</td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><input type="submit" name="button" id="button" value="Search" class="search-btn" /></td>
    </tr>
  </table>
</div>

</div>

</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"> Product Category > <a href="#">Garments </a>   </div>
<?php 
$select_product="SELECT * FROM product WHERE status=1";
$res_product=mysqli_query($con,$select_product);
while($fetch_product=mysqli_fetch_array($res_product))
{
$imgpath = "productlogo/".$fetch_product['p_photo'];	
if(($fetch_product['p_photo'] != '') && (file_exists($imgpath)))
{
 $image="productlogo/".$fetch_product['p_photo'];
}else{
 $image="productlogo/img_noimg.jpg";
}
?>

<div class="procate-cont1"> 
<div class="procate-cont-img" style="float:left;"><img src="<?php echo $image; ?>" alt="" width="74" height="74" /> </div>
<div class="procate-heading1" style="float:left; width:400px; padding-top:5px; padding-left:10px;"><a href="#"> <?php echo $fetch_product['p_name']; ?></a></div>
<div class="procatelist1" style="float:left; width:400px; padding-top:5px; padding-left:15px;"> <a href="#"><!--Loremasddddddddsdsdsdsds Ipsum is simply</a>  (105)<br/>
  <a href="#">of the printing and sdsdsd sdkjsd  sdhjsd types</a>  (2105)<br/>
  <a href="#">Lorem Ipsum is simply wwd wew 2we we we</a> (215)<br/>-->
  <?php echo $fetch_product['p_ddes']; ?>
</div>

<div style="width:100px; float:left; text-align:right;">
Inquiry
</div>
</div>

<?php } ?>



<div class="line"></div>







</div>

<div class="body-right2"> 

<div class="bluebox-cont2"> 
<div class="blueheading2">Related Links</div>
<div class="blue-content2">Related Suppliers - 23456<br />
  Related Trade Leads - 23456</div>

</div>



<div class="bluebox-cont2"> 
<div class="blueheading2">Related Products</div>
<div class="blue-content2"> 
<div class="related-product-cont">

<div class="related-img"><img src="images/related-product.jpg" alt="" width="51" height="51" /> </div>

<div class="related-pro-content"><strong> <a href="#">P10 LED Screen 
Display</a></strong> <br/>  <span> <b>by</b> Shenzhen Donglian
Electronics Technology </span></div>
 </div>
 
 <div class="related-product-cont">

<div class="related-img"><img src="images/related-product.jpg" alt="" width="51" height="51" /> </div>

<div class="related-pro-content"><strong> <a href="#">P10 LED Screen 
Display</a></strong> <br/>  <span> <b>by</b> Shenzhen Donglian
Electronics Technology </span></div>
 </div>
 
 
 <div class="related-product-cont">

<div class="related-img"><img src="images/related-product.jpg" alt="" width="51" height="51" /> </div>

<div class="related-pro-content"><strong> <a href="#">P10 LED Screen 
Display</a></strong> <br/>  <span> <b>by</b> Shenzhen Donglian
Electronics Technology </span></div>
 </div>
 
 
</div>

</div>

<div></div>





<div class="bluebox-cont2"> 
<div class="blueheading2">Sucess Storeis</div>
<div class="blue-content2">
  <div class="related-product-cont">

<div class="related-img2"><img src="images/sucess-stories-img.jpg" alt="" width="55" height="55" /></div>

<div class="related-pro-content2"><span>Maya Machinery 
Co., Ltd. Zita Gong 
[China] </span></div>

<div class="sucess-cont"> Hello, everyone! I'm Zita Gong, from Maya Machinery Co., Ltd.. Established in Shanghai, our company exports used construction machinery, including second-hand truck crane.. <a href="#">.[Details] </a></div>

 </div>
 
 
</div>

</div>


<div class="ad">
<?php 
						$sql="SELECT * FROM addmanager where status='1' LIMIT 2,1";
						$query=mysqli_query($con,$sql);
						$count=mysqli_num_rows($query);
						$details=mysqli_fetch_array($query);
						if($count==0)
						{
	                ?>
<a href="#"><img src="images/ad.jpg" alt="" width="395" height="174" /></a> 


<?php } else { ?>
<?php echo $details['body'];?>
<?php } ?>
</div> 

</div>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>