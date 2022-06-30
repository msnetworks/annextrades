<div class="cate-cont help__sideBar">
<div class="cate-heading"><?php echo $help; ?></div>
<div class="cate-list-cont">
<ul>
<div class="technology">
<a href="#"><?php echo $faq_contact; ?></a></div>

<div class="thelanguage">
<ul>
<li><a href="faq_contactus.php"><?php echo $faq_contact; ?></a></li>
</ul>
</div>

<div class="technology">
<a href="#"><?php echo $buying; ?></a></div>

<div class="thelanguage">
<ul>
<li><a href="buying_over.php"><?php echo $buy_overview; ?></a></li>
<li><a href="post_buy_help.php"><?php echo $pose_buy_leads; ?></a></li>
</ul>
</div>

<div class="technology">
<a href="#"><?php echo $selling; ?></a></div>

<div class="thelanguage">
<ul>
<li><a href="selling_over.php"><?php echo $selling_overview; ?></a></li>
<li><a href="post_sell_help.php"><?php echo $post_selling_leads; ?></a></li>
</ul>
</div>

<div class="technology">
<a href="#"><?php echo $community; ?></a></div>

<div class="thelanguage">
<ul>
<li><a href="community_help.php"><?php echo $overview; ?></a></li>
<li><a href="addcomments_help.php"><?php echo $add_comments; ?></a></li>
<li><a href="discuss_help.php"><?php echo $participate_discuss; ?></a></li>
<li><a href="posting_rule_help.php"><?php echo $posting_moderation; ?></a></li>
</ul>
</div>

<div class="technology">
<a href="#"><?php echo$rules_palicies; ?></a></div>

<div class="thelanguage">
<ul>
<li><a href="terms_of_use.php"><?php echo $terms_use; ?></a></li>
<li><a href="privacy_policy.php"><?php echo $privacy; ?></a></li>
</ul>
</div>

</ul>
</div>
<div class="ad1"><?php 
						$sql="SELECT * FROM addmanager where status='1' LIMIT 1,1";
						$query=mysqli_query($con,$sql);
						$count=mysqli_num_rows($query);
						$details=mysqli_fetch_array($query);
						
echo $details['body'];?>
 </div> 
</div>

