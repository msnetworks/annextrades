<?php 
  $currentFile =basename($_SERVER['PHP_SELF'], ".php");;
?>

<div class="menu">
    <ul>

        <li><a href="products.php"
                <?php if($currentFile=="products" || $currentFile=="buyers1" || $currentFile=="selling_buy_leads1" || $currentFile=="selling_buy_leads1") { ?>
                class="active" <?php } ?>>Products<?php //echo $sell_now; ?></a></li>

        <!-- <li><a href="sellnow.php?DIVIDd=StabTwo" <?php if($currentFile=="sellnow" || $currentFile=="companyinfo") { ?>
                class="active" <?php } ?>><?php echo $buy_now; ?></a></li> -->

        <!--<li><a href="sellnow.php?DIVIDd=StabOne" <?php if($currentFile=="index" || $currentFile=="sellnow" || $currentFile=="companyinfo") { ?> class="active" <?php } ?>><?php echo $sell_now; ?></a></li> 
<li><a href="buyers1.php?DIVIDd=StabOne" <?php if($currentFile=="index" || $currentFile=="buyers1" || $currentFile=="selling_buy_leads1" || $currentFile=="selling_buy_leads1") { ?> class="active" <?php } ?>><?php echo $buy_now; ?></a></li>-->
        <li><a href="products1.php?DIVIDd=StabThree"
                <?php if($currentFile=="products1" || $currentFile=="productcompanyinfo" ) { ?>  <?php } ?>>Services</a></li>
        <!-- <li><a href="forums.php"
                <?php if($currentFile=="forums" || $currentFile=="mainarticles" || $currentFile=="forum_new" | $currentFile=="articles_new") { ?>
                class="active" <?php } ?>><?php echo $community; ?></a>
        </li>
        <li><a href="traders.php?DIVIDd=StabFour"
                <?php if($currentFile=="traders" || $currentFile=="tradeshow_search" || $currentFile=="tradeshow" ) { ?>
                class="active" <?php } ?>><?php echo $trade; ?></a></li>
        <li style="background:none;"><a href="help.php"
                <?php if($currentFile=="help" || $currentFile=="faq_contactus" || $currentFile=="buying_over" || $currentFile=="post_buy_help" || $currentFile=="selling_over" || $currentFile=="post_sell_help" || $currentFile=="community_help" || $currentFile=="addcomments_help" || $currentFile=="discuss_help" || $currentFile=="posting_rule_help" || $currentFile=="terms_of_use" || $currentFile=="privacy_policy" ) { ?>
                class="active" <?php } ?>><?php echo $help; ?></a></li> -->
                
        <li><a href="contact.php"
                <?php if($currentFile=="contact" ) { ?> class="active"
                <?php } ?>><?php echo $contactus; ?></a></li>      
    </ul>
</div>