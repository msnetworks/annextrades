<?php include("includes/header.php");


$ordr=mysqli_fetch_array(mysqli_query($con,"select * from orders where id='$_REQUEST[tid]'"));
$ussr=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$ordr[user_id]'"));
$prodt=mysqli_fetch_array(mysqli_query($con,"select * from tbl_seller where seller_id='$ordr[product_id]'"));

 ?>
<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;" > <?php echo $success_mail_msg; ?> </div>
<?php } ?>

<?php
if(isset($_REQUEST['suc'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;" > <?php echo $update_success; ?> </div>
<?php } ?>



<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<?php 
$user_type=$fetch_log['usertype']; 
if($user_type==1) { $usertype="Buyer"; } elseif($user_type==2) { $usertype="seller"; }  elseif($user_type==3) { $usertype="Both Buyer & Seller"; }  else { $usertype="Not Mentioned"; }
$user_type=$fetch_log['gender']; 
//if($gender==1) { $gen="";
?>
<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb; height:30px;"><b style="color:#FFFFFF; margin-left:12px; padding-top:10px; font-size:14px;"><?php echo $my_orders; ?></b></div>
<table cellpadding="0" cellspacing="0" width="100%" style="height:300px;" >
<tr>
<td width="80%" valign="top" style="padding-left:50px;" ><table align="center"  cellpadding="3" cellspacing="6" width="100%">
<tr>
<td width="16%"><?php echo "Order_id"; ?> </td>
<td width="3%">:</td>
<td width="81%"><?php echo $ordr['order_id']; ?></td>
</tr>
<tr>
<tr>
<td><?php echo "Txn id"; ?> </td><td>:</td><td><?php echo $ordr['trans_id']; ?></td>
</tr>
<?php /*?><tr>
<td><?php echo $sell_name; ?> </td><td>:</td><td><?php echo $ussr['firstname']; ?></td>
</tr><?php */?>
<tr>
<td><?php echo "Product Name"; ?> </td><td>:</td><td><?php echo $prodt['seller_subject']; ?></td>
</tr>
<tr>
<td><?php echo $amount; ?> </td><td>:</td><td><?php echo $ordr['net_amount']; ?>$</td>
</tr>
<tr>
<td><?php echo "payment status"; ?> </td><td>:</td><td>
<?php if($ordr['payment_status']=="1") { echo "Paid"; } else { echo "Pending"; } ?>
</td>
</tr>

<tr>
<td><?php echo $date; ?> </td><td>:</td><td><?php echo date("d-m-Y",strtotime($ordr['date'])); ?></td>
</tr>

<?php /*?><tr>
<td valign="top"><?php echo $product_image; ?> </td><td valign="top">:</td><td><img src="productlogo/<?php echo $ordr['product_image1']; ?>" width="100" height="100"/></td>
</tr>
<?php */?>
<tr>
<td colspan="4" style="border-bottom:1px #CCCCCC solid;">&nbsp;</td>
</tr>
<tr>
<td colspan="4" align="left"><a href="javascript: history.go(-1)" style="background:#CCCCCC; padding:4px 5px 4px 5px; border-radius:3px; border:0px; color:#000000; font-weight:bold;"><?php echo $back; ?></a></td>
</tr>

</table></td>
<!--<td width="50%" valign="top"><table cellpadding="3" cellspacing="3" width="100%" >
<tr>
<td>Firstname </td><td>:</td><td><?php //echo $firstname; ?></td>
</tr>
</table>
</td>-->
</tr>
</table>

<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>

<!--<div class="body-cont2"> 

<div class="advantage-cont"> 

<div class="advantage-heading"> Advantage</div>

<div class="advantage-icon"><img src="images/adv-icon.jpg" alt="" width="83" height="83" /> </div>

<div class="advantage-content">Are you interested register your web site for  B2B Website ?  you can register your company in a few mouse clicks and benefit from an offer that is perfectly adapted to your ... </div>

</div>

<div class="contspe"> <img src="images/spe2.jpg" alt="" /> </div>

<div class="advantage-cont"> 

<div class="advantage-heading"> Our security</div>

<div class="advantage-icon2"><img src="images/security.jpg" alt="" width="110" height="70" /></div>

<div class="advantage-content">Data exchange connections between trading partners must be secure. The first step to achieving secure e-business is to understand the technological capabilities of each trading partner by conducting an audit.</div>

</div>

</div>-->




<!--<div class="body-cont3"> 
<div class="leadscont"> 
<div class="leads-top"> 

<div class="leads-heading">New Buying Leads</div>
<div class="post-now"> <a href="#">Post Now</a> </div>

<div class="leads-heading2">New Selling Leads</div>
<div class="post-now"> <a href="#">Post Now</a> </div>

</div>


<div class="leads-content"> 
<div class="newleads-cont">  

<div class="leades1"> 
<ul>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>


<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>
</ul>

</div>

</div>

<div class="spe3"> </div>

<div class="newleads-cont2">  

<div class="leades1"> 
<ul>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>


<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>


<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>
</ul>

</div>

</div>

</div>
<div class="leads-bot"> </div>

</div>


<div class="ad"><a href="#"><img src="images/ad.jpg" alt="" width="395" height="174" /></a> </div>

</div>-->




<div class="body-cont4"> 

<!--<div class="box-cont"> 
<div class="box-top"> Trade Shows</div>
<div class="box-bg"> 

<div class="tradeshow"> <a href="#"><strong>Asia Apparel Expo - Berlin </strong></a><br/>  
  <strong>Date : </strong>Mar 08, 2013 - Mar 10, 2013 <br/>  
  <strong>Venue :</strong> Lorem ipsum dolor <br/>  
<strong>Indusstry :</strong> consectetur adipiscing </div>

<div class="tradeshow"> <a href="#"><strong>Asia Apparel Expo - Berlin </strong></a><br/>  
  <strong>Date : </strong>Mar 08, 2013 - Mar 10, 2013 <br/>  
  <strong>Venue :</strong> Lorem ipsum dolor <br/>  
<strong>Indusstry :</strong> consectetur adipiscing </div>

<div class="more"><a href="#">Read More </a></div>


</div>
<div class="box-bot"> </div>

</div>-->



<!--<div class="box-cont"> 
<div class="box-top">Sucessful Stories</div>
<div class="box-bg"> 

<div class="sucessphoto-cont"> 
<div class="sucess-photo"><img src="images/Zita_Gong.jpg" alt="" width="55" height="55" /> </div>

<div class="sucess-photoname"> Maya Machinery Co., Ltd.
Zita Gong [China]
</div>

<div class="sucessphoto-content">Hello, everyone! I'm Zita Gong, from Maya Machinery Co., Ltd.. Established in Shanghai, our company exports used construction machinery, including second-hand truck crane...[Details] </div>

</div>

<div class="more"><a href="#">Read More </a></div>


</div>
<div class="box-bot"> </div>

</div>-->


<!--<div class="box-cont"> 
<div class="box-top">New Suppliers / Manufacturers</div>
<div class="box-bg"> 

<div class="newmanu"> 
<ul> 

<li> <a href="#">Lorem ipsum dolor sit amet, </a></li>
<li><a href="#">consectetur adipiscing elit. </a></li>
<li><a href="#">Curabitur nibh libero, </a></li>
<li><a href="#">pellentesque nec posuere </a></li>
<li><a href="#">consequat cursus </a></li>
<li><a href="#">consequat magna </a></li>
<li><a href="#">Nullam mattis venenatis </a></li>
<li><a href="#">condimentum. </a></li>

</ul>

</div>




</div>
<div class="box-bot"> </div>

</div>-->


<!--<div class="bookmark">
 <div class="bookmark-heading"><strong>Bookmark &amp; Share
     </p>
  </strong>
   <div class="bookmark-icon"><a href="#"><img src="images/facebook.png" alt="" width="32" height="32" /></a></div>
  <div class="bookmark-icon"><a href="#"><img src="images/twitter.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/linkedin.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/google.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/stumbleupon.png" alt="" width="32" height="32" /></a></div>
  <div class="bookmark-icon"><a href="#"><img src="images/blogger.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/lastfm.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/delicious.png" alt="" width="32" height="32" /></a></div>

<div class="bookmark-icon"><a href="#"><img src="images/aim.png" alt="" width="32" height="32" /></a></div>
  <div class="bookmark-icon"><a href="#"><img src="images/digg.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/technorati.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/vimeo.png" alt="" width="32" height="32" /></a></div>

<div class="bookmark-icon"><a href="#"><img src="images/tumblr.png" alt="" width="32" height="32" /></a></div>
  <div class="bookmark-icon"><a href="#"><img src="images/myspace.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/picasa.png" alt="" width="32" height="32" /></a></div>
<div class="bookmark-icon"><a href="#"><img src="images/flickr.png" alt="" width="32" height="32" /></a></div>
</div>

</div>-->






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
