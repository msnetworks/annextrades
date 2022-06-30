<div class="bluebox-cont"> 

<div class="blueheading"> <?php echo $location; ?></div>
<div class="blue-content">
<ul> 
<?php 
$select_count="SELECT * FROM country ORDER BY RAND() LIMIT 0,5";
$res_count=mysqli_query($con,$select_count);
while($fetch_count=mysqli_fetch_array($res_count))
{
 $country_iddd=$fetch_count['country_id'];
$select_prodct="SELECT * FROM product WHERE country='$country_iddd' AND status=2";
$res_product=mysqli_query($con,$select_prodct);
$counttttt=mysqli_num_rows($res_product);
if((file_exists("flags/".$fetch_count['country_flag']))&&($fetch_count['country_flag']!='')) {

$imageeee="flags/".$fetch_count['country_flag'];
}
else
{
$imageeee="flags/no_flag.png";
}
 
 ?>

<li> <div class="flag1"><img src="<?php echo $imageeee; ?>" alt="" width="14" height="11" /></div>
<div class="location"><a href="products1.php?country=<?php echo $fetch_count['country_id']; ?>"> <?php echo $fetch_count['country_name']; ?> </a><span>(<?php echo $counttttt; ?>)</span></div> </li>
<?php } ?>
<!--
<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>

<li> <div class="flag1"><img src="images/flag5.jpg" alt="" width="14" height="11" /></div>
<div class="location"><a href="#"> China </a><span>(2485)</span></div> </li>-->


</ul>

<!--<span class="more2"><a href="#"> More....</a></span>--></div>

</div>

<div class="bluebox-cont"> 

<div class="blueheading"><?php echo $featured_part; ?></div>
<div class="blue-content">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box1">
                        <tr>
                          <td valign="top">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <?php
						  $sel_featurepart=mysqli_query($con,"select * from featurepartner where status=0 order by RAND() limit 1");
						  $fea_par=mysqli_fetch_array($sel_featurepart);
						  $count_featurepart=mysqli_num_rows($sel_featurepart);
						  
						  ?>
                              <tr>
                                <td width="7%" class="futuretext">&nbsp;</td>
                                <td width="34%" class="futuretext">&nbsp;</td>
                                <td width="59%" class="futuretext">&nbsp;</td>
                              </tr>
                              <tr>

                                <td class="futuretext" colspan="3">
								<span><?php echo $partner_with; ?></span>&nbsp;&nbsp;<a href="featuredpartner.php" style="text-decoration:underline;"><?php echo $send_req; ?></a></td>
                              </tr>
							  
							  
							  <tr>

                                <td class="futuretext" colspan="3">&nbsp;								</td>
                              </tr>
							  
							  <?php if($count_featurepart>0) {
							  if($_SESSION['language']=='english')
                          {
                            $name1=$fea_par['name'];
                            $company1=$fea_par['companyname'];
                          }
							else if($_SESSION['language']=='french')
							{
							$name1=$fea_par['name_french'];
							$company1=$fea_par['companyname_french'];
							}
							else if($_SESSION['language']=='chinese')
							{
							$name1=$fea_par['name_chinese'];
							$company1=$fea_par['companyname_chinese'];
							}
						  else
							{
							$name1=$fea_par['name_spanish'];
							$company1=$fea_par['companyname_spanish'];
							}
							  
							   ?>
							  <tr>
							  <td colspan="3">
							  
							  <table width="100%" cellspacing="0" cellpadding="0">
							  <tr>
							  <td width="40" style="font-weight:bold;">
							  <?php if($name1 != "") { echo $name; }   ?> </td>
							  <td width="60" style="font-weight:bold; color:#0893CA;">
							  <?php if($name1 != "") { echo $name1; }?></td>
							  </tr>
							  
							   
							   <tr>
							  <td style="font-weight:bold;"><?php if($company1 != "") { echo $company; }?> </td>
							  <td style="font-weight:bold; color:#0893CA;"><?php if($company1 != "") {  echo $company1; } ?>
								</td>
							  </tr>
							  
							   </table>
							   </td>
							  </tr>
							  <tr>
							  <!--<td style="font-weight:bold;">E-mail </td>-->
							  <td style="font-weight:bold; color:#0893CA;"><?php if($name1 != "") { echo $fea_par['email']; }
								?></td>
							  </tr>
							  
							 
							  
							  
							  <?php } ?>
							  
                          </table></td>
                        </tr>
                    </table>
<!--<span class="more2"><a href="#"> More....</a></span>--></div>

</div>


<!--<div class="bluebox-cont"> 

<div class="blueheading">Group Products</div>
<div class="blue-content">
  <a href="#">All Products</a> <br/> 
  <strong><a href="#">1  Product Per Company </a></strong></div>

</div>-->

<!--<div class="bluebox-cont"> 

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

</div>-->