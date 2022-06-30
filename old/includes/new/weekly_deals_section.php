<div class="weekly-deals-wrapper">
    <div class="container">
        <h2>Weekly Deals</h2>
        <div class="item-flex-row">
            <?php
            $featuredProducts = "SELECT * FROM featureproducts ORDER BY RAND() LIMIT 0,4";
           
            $featuredProductsData = mysqli_query($con, $featuredProducts);
            while ($featuredProduct = mysqli_fetch_array($featuredProductsData)) {
                // echo "<pre>";
                // print_r($featuredProduct);
                $product = $featuredProduct['f_pdt_name'];
                $company = $featuredProduct['companyname'];
                if ((file_exists("admin/picture/" . $featuredProduct['f_pdt_images'])) && ($featuredProduct['f_pdt_images'] != '')) {

                    $image = "admin/picture/" . $featuredProduct['f_pdt_images'];
                } else {
                    $image = "admin/picture/img_noimg.jpg";
                }
            ?>

                <div class="item-box">
                    <figure><a href="deal_view.php?id=<?php echo $featuredProduct['id']; ?>"><img src="<?= $image ?>" alt=""></a></figure>
                    <div class="item-box-info" style="padding-top: 15px;">
                        <h6><a href="deal_view.php?id=<?php echo $featuredProduct['id']; ?>"><?php echo $product; ?></a></h6>
                       
                        <div class="item-price-range"><strong><?php echo $by; ?></strong> <?php echo $company; ?></div>
                        <div class="item-min-order">
                            <small>
                            <?php if($featuredProduct['minimum_quantity']!=''){ echo $featuredProduct['minimum_quantity'];}?><?php if($featuredProduct['pdt_quantity']!='') {echo $featuredProduct['pdt_quantity']; }?>
                            </small>
                        </div>
                        <!-- <div class="item-desc">Genuine lambskin leather two zipped chest and front pockets and two...
                        </div> 
                        <div class="item-price-range"><strong>$129.99 - 109.99/ Unit</strong></div>
                        <div class="item-min-order"><small>1 Pieces (Min. Order )</small></div>
                        <div><a href="#" class="item-contact-btn">Contact Now</a></div>-->
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
        <div class="text-center">
        <?php 
            $sid = "/servicecompanyinfo.php?id=".$_GET['id']."&cid=".$_GET['cid']."&scid=".$_GET['scid'];
            //echo $sid;
            if($_SERVER['REQUEST_URI'] == '/service-categories.php' || $_SERVER['REQUEST_URI'] == $sid){
        ?>
            <a href="deals.php" style="background: #2baae1 !important;" class="view-all-deals-btn">View All Deals</a>
            <?php } else{?>
                <a href="deals.php" class="view-all-deals-btn">View All Deals</a>
            <?php } ?>
        </div>
    </div>
</div>