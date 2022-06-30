<?php
$pagename = "Home";
$page = 'home';
$baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
define('baseUrl', $baseUrl);


include "includes/new/header.php";
//require "formatimage.php";
if ($_SESSION['language'] == "") {
    header("location:index.php?lan=1");
}
if ($session_user) {
    mysqli_query($con, "UPDATE registration SET last_visit_date=NOW() WHERE id='$session_user' ");
}
?>

<style>
    .logo {
        width: 170px;
    }

    .logo img {
        max-width: 100%;
    }
    .product-box{
        /* background: #f9f9f9 !important; */
    }
    .pm{
        height: 0;
        line-height: 1.5em;
    }
</style>
<?php
if ($_SESSION['language'] == 'english') {
    $select = mysqli_query($con, "select * from testimonials where testrelease='Yes' and status='1' and lang_status='0' order by RAND() limit 0,2");
} else if ($_SESSION['language'] == 'french') {
    $select = mysqli_query($con, "select * from testimonials where testrelease='Yes' and status='1' and lang_status='1' order by RAND() limit 0,2");
} else if ($_SESSION['language'] == 'chinese') {
    $select = mysqli_query($con, "select * from testimonials where testrelease='Yes' and status='1' and lang_status='2' order by RAND() limit 0,2");
} else {
    //echo "select * from testimonials where testrelease='Yes' and status='1' and lang_status='3' order by RAND()"; exit;
    $select = mysqli_query($con, "select * from testimonials where testrelease='Yes' and status='1' and lang_status='3' order by RAND() limit 0,2");
}

$featuredNews = $select;
?>

<!-- banner start -->
<div class="banner">
    <!-- Set up your HTML -->
    <div id="owl-bannner" class="owl-carousel">
        <div class="slide-itm">
            <div class="row no-margin ">
                <div class="col-md-12 no-padding">
                    <div class="left-banner">
                        <img style="" src="assets/images/banner-2.jpg" alt="right-banner-img">
                        <div class="container">
                            <div class="banner-inner slide-1">
                                <div class="row">
                                    <div class="w-100">
                                        <h1><b>What can industry supported by over <span>1.3 Billion</span> people bring to your business table?</b></h1>
                                       <!--  <a class="btn-banner" href="#">New Opportunites</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-itm">
            <div class="row no-margin">
                <div class="col-md-12 no-padding">
                    <div class="left-banner">
                        <img style="" src="assets/images/banner-3.jpg" alt="right-banner-img">
                        <div class="container">
                            <div class="banner-inner slide-2">
                                <div class="row">
                                    <div class="w-100">
                                        <h1 class="text-dark"><b>Tap into new <span>Horizons</span> with increased market share.</b></h1>
                                        <ul>
                                            <li>More Choices</li>
                                            <li>Less limitations</li>
                                            <li>Exceed Demands</li>
                                            <li>Increase Profits</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-itm">
            <div class="row no-margin">
                <div class="col-md-12 no-padding">
                    <div class="left-banner">
                        <img style="" src="assets/images/banner.jpg" alt="right-banner-img">
                        <div class="container">
                            <div class="banner-inner slide-3">
                                <div class="row">
                                    <div class="w-100">
                                        <h1><b>A wealth of colorful & bold products and services at your fingertips.</b></h1>
                                        <!-- <a class="btn-banner" href="#">Global Expansion</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--?php include "includes/new/product_search.php"; ?-->
</div>
<!-- banner end -->
<!-- after-banner-nav start -->

<div class="bg-img-wrapper">
    <!--img class="bg-lft-bg" src="images/bg-lft.png" alt="info-lft">
    <div class="after-banner-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                < ?php //include "includes/new/featured_categories.php"; ?>
                </div>
            </div>
        </div>
    </div-->
    <!-- after-banner-nav end -->
    <!-- info-section start -->
    <!--?php include "includes/new/sub-menu.php"; ?-->
    <div class="info-section" style="margin: 30 0 0 0; padding: 0 0 0 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="info-left-image">
                        
                        <img style="width: 100%;" src="assets/images/quote.png" alt="info-lft">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="info-section" style="margin: 0px; padding: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-120" style="margin: 0px; padding: 0px;">
                    <div class="info-left-image">
                        <img style="width: 100%;" src="assets/images/Ask-yourself.jpg" alt="info-lft">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- info-section start -->
<div class="container-fluid" style="background: #f2f2f2; margin-top: 15px; padding-bottom: 30px;">
    <div class="row">
        <div class="col-md-6">
            <!-- featured-slider start -->
            <div class="featured-slider">
                <div class="container-fluid-no-padding">
                    <div class="row-no-margin">
                        <div class="col-md-12">
                            <h2 class="title-h2" style="h2.title-h2:after { left: 20%!important; }">
                                <a class="text-dark" href="news/feature_guest_list.php"><b>Featured Guests</b></a>
                            </h2>
                        </div>
                        <div class="col-md-12">
                            <div class="featured-slider">
                                <div id="featured" class="owl-carousel" style="/* height: 350px !important; */">
                                <?php
                                    include('news/config.php');
                                    $f_trade = "SELECT * FROM feature_post WHERE active='yes' ORDER BY RAND() LIMIT 0,6";
                                    $f_guest = mysqli_query($connect, $f_trade);
                                ?>
                                    <?php if (mysqli_num_rows($f_guest) > 0) { ?>
                                        <?php while ($f_data = mysqli_fetch_array($f_guest)) { ?>
                                            <div class="slide-itm s-itm">
                                                <div class="featured-slider-box">
                                                    <div class="featured-box-img">
                                                        <?php if ($f_data['image'] == "") { ?>
                                                            <img src="blog_photo_thumbnail/img_noimg.jpg" />
                                                        <?php } else { ?>
                                                            <a href="news/feature_details.php?id=<?php echo $f_data['id']; ?>">
                                                                <img style="height: 303px!important; width: 303!important;" src="news/asset/img/feature/<?php echo $f_data['image']; ?>" />
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="featured-details-inner">
                                                        <p class="text-left" style="color: #333;"><b>
                                                            <?php echo $f_data['title'];
                                                             ?>
                                                        </b></p>
                                                        <div style="height: 110px; overflow: hidden; font-size: 15px!important; font-weight: 100 !important;">
                                                            <p class="text-left" >
                                                                <?php 
                                                                    $fcnt = htmlspecialchars_decode($f_data['content']);
                                                                    echo substr($fcnt, 0, 150)."...";
                                                                /* if (strlen($fcnt) > 200) {
                                                                    echo "...";
                                                                } */ ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div style="padding-top: 5px;" class="read-more-btn"><a style="font-size: 15px;" href="news/feature_details.php?id=<?php echo $f_data['id']; ?>">Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="slide-itm">
                                            <div class="featured-slider-box">
                                                <div class="featured-box-img">
                                                    <img src="assets/images/slider-1-img.png" alt="slider-1-img" class="">
                                                </div>
                                                <div class="featured-details-inner">
                                                    <p>No testimonials</p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product-slider end -->
        </div>
        
        <div class="col-md-6">
            
            <?php
            include('news/config.php');
            $select_trade = "SELECT * FROM posts WHERE active='yes' ORDER BY RAND() LIMIT 0,6";
            $res_trade = mysqli_query($connect, $select_trade);
            ?>

            <!-- business-slider start -->
            <div class="business-slider">
                <div class="container-fluid-no-padding">
                    <div class="row-no-margin">
                        <div class="col-md-12">
                            <h2 class="title-h2"  style="h2.title-h2:after { left: 20%!important; }">
                                <a class="text-dark" href="news/news_list.php"><b>Business News</b></a>
                            </h2>
                        </div>
                        <div class="col-md-12">
                            <div class="featured-slider">
                                <div id="business" class="owl-carousel">
                                    <?php
                                        while ($fetch_trade = mysqli_fetch_array($res_trade)) {
                                        
                                        $image = $fetch_trade['image'];
                                        $bcnt = htmlspecialchars_decode($fetch_trade['content']);
                                    ?>

                                        <div class="slide-itm s-itm">
                                            <div class="featured-slider-box">
                                                <div class="featured-box-img">
                                                <a href="news/news_details.php?id=<?php echo $fetch_trade['id']; ?>">
                                                    <img style="height: 303px!important;" src="news/asset/img/news/<?php echo $image; ?>" alt="slider-1-img" class="">
                                                </a>
                                                </div>
                                                <div class="featured-details-inner">
                                                    <p class="text-left" style="color: #333;"><b>
                                                        <?php echo $fetch_trade['title'];
                                                        ?>
                                                    </b></p>
                                                    <div style="height: 110px; overflow: hidden; font-size: 15px !important; font-weight: 100 !important;">
                                                        <p class="text-left" >
                                                            <?php 
                                                                $fcnt = htmlspecialchars_decode($fetch_trade['content']);
                                                                echo substr($fcnt, 0, 150)."...";
                                                            ?>
                                                        </p>
                                                    </div> 
                                                </div>
                                                <div style="padding-top: 5px;" class="read-more-btn"><a style="font-size: 15px;" href="news/news_details.php?id=<?php echo $fetch_trade['id']; ?>">Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product-slider end -->
        </div>
    </div>
</div>

<!-- vast-market start -->
<div class="container-fluid">
    <div class="vast-market" style="/* padding: 55px 0px 15px 15px; */">
        <div class="row">
            <div class="col-md-5" style="padding-left: 30px; padding-right: 0px;">
                <div class="left-slider-title text-justify">
                    <!-- <h2><b>Let ANNEXIS be your bridge to expansion into this vast market and resource. </b></h2> -->
                    <h2><b>Industry Info </b></h2><br>
                    <div style="padding-bottom: 50px;"></div>
                    <p>In a few words, an innovative yet affordable variety , products and services that are virtually endless and perhaps otherwise too costly or unavailable locally. Take advantage , these nearly endless options to achieve your personal best and reach that next level of growth now. Get inspired with fewer limitations and tap into a wealth , ideal concepts within a culturally rich think-tank literally at your fingertips. </p><br>
                    <p>We often think of India as a place with congested city streets, and markets with a variety , spices, foods and textiles. Business wise we think of IT services and call centers yet, India has far more to bring to the table. A large and diverse array of industries such as bulk agriculture, gold, holistic health, beauty and diet alternatives, precious stones, steel products, robotics and much more. </p>
                </div>
            </div>
            <div class="col-md-7" style="padding: 0;">
                <div class="slider-fashion-inner">
                    <div id="owl-fashion-men" class="owl-carousel">
                        <div class="slide-itm">
                            <h2 style="font-size: 30px; padding: 15;"><b>Food Processing Industry </b></h2><br>
                            <div class="product-box">
                                <div class="col-md-5 product-box-img">
                                    
                                    <!-- <p style="font-size: 18px; text-align: center; padding-bottom:15;"><b>Food Processing Industry </b></p> -->
                                    <img style="border-radius: 0px !important;" src="assets/images/slider-fp.jpeg" title="Food Processing Industry" alt="Food Processing Industry">
                                </div>
                                <div class="col-md-7 product-details ">
                                    <p>The Indian food and grocery market is the world’s sixth largest, with retail contributing 70 per
                                    cent of the sales. One of the large industries in India and is ranked fifth in terms of production,
                                    consumption and expected growth.</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-itm">
                            <h2 style="font-size: 30px; padding: 15;"><b>Textile Industry </b></h2><br>
                            <div class="product-box">
                                <div class="col-md-5 product-box-img">
                                    <!-- <p style="font-size: 18px; text-align: center;padding-bottom:15;"><b> </b></p> -->
                                    <img style="border-radius: 0px !important;" src="assets/images/textile.jpg" title="Textile Industry" alt="Textile Industry">
                                </div>
                                <div class="col-md-7 product-details w-100">
                                    <p>The Indian textiles industry, currently estimated at around US $150 billion, is expected to reach
                                    $250 billion by 2019. India’s textiles industry contributed seven per cent of the industry output
                                    (in value terms) of India in 2017-18.</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-itm">
                            <h2 style="font-size: 30px; padding: 15;"><b>Chemical Industry </b></h2><br>
                            <div class="product-box">
                                <div class="col-md-5 product-box-img">
                                    <!-- <p style="font-size: 18px; text-align: center;padding-bottom:15;"><b>Chemical Industry </b></p> -->
                                    <img style="border-radius: 0px !important;" src="assets/images/slider-ci.jpg" title="Chemical Industry" alt="Chemical Industry">
                                </div>
                                <div class="col-md-7 product-details w-100">
                                    <p>Chemical industry is sixth largest producer of chemicals worldwide
                                    and third largest producer in Asia. The size of Indian chemicals sector
                                    for the year 2015-16 was USD 142 billion.</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-itm">
                            <h2 style="font-size: 30px; padding: 15;"><b>Consumer Products </b></h2><br>
                            <div class="product-box">
                                <div class="col-md-5 product-box-img">
                                    <!-- <p style="font-size: 18px; text-align: center;padding-bottom:15;"><b>Consumer Products</b></p> -->
                                    <img style="border-radius: 0px !important;" src="assets/images/conp.jpg" title="Consumer Products" alt="Consumer Products">
                                </div>
                                <div class="col-md-7 product-details w-100">
                                    <p>Indian appliance and consumer electronics (ACE) market reached Rs 2.05 trillion
                                        (US$ 31.48 billion) in 2017. India is one of the largest growing electronics
                                        market
                                        in the world. Indian electronics market is expected to grow to $400 billion by
                                        2020.</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide-itm">
                            <h2 style="font-size: 30px; padding: 15;"><b>Health </b></h2><br>
                            <div class="product-box">
                                <div class="col-md-5 product-box-img">
                                    <!-- <p style="font-size: 18px; text-align: center;padding-bottom:15;"><b>Health    </b></p> -->
                                    <img style="border-radius: 0px !important;" src="assets/images/slider-h.jpg" alt="slider-1" style="margin: 0 15 !important;">
                                </div>
                                <div class="col-md-7 product-details w-100">
                                    <p>The healthcare market can increase threefold to $133.44 billion by 2022.
                                        India is experiencing 22-25 per cent growth in medical tourism and the industry
                                        is expected to double its size from present (April 2017) US$ 3 billion to US$ 6
                                        billion by 2018.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- vast-market end -->

<!-- looking-services start -->
<div class="looking-services-wrapper lookm">
    <div class="looking-services" style="margin: 0% 0%;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="l-s-inner">
                        <h3>Looking for great services at<br>incredible prices?</h3>
                        <div class="btn-box text-center">
                            <a class="btn-all-pro" href="services.php">View all Service providers</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tell-uswhtyouneed">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="l-s-inner">
                        <h3>Professional assistance is always available! </h3>
                        <div class="btn-box text-center">
                            <?php if (isset($session_user)) { ?>
                                <a href="addbuying_leads.php" class="btn-all-pro">Tell us what you need</a>
                            <?php } else { ?>
                                <a href="login.php" class="btn-all-pro">Tell us what you need</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- looking-services end -->

<!-- product-slider start -->
<?php
if ($_SESSION['language'] == 'english') {
    $select_latest = "SELECT *, product.id AS proid FROM product WHERE status='2' and lang_status='0' and p_category !='394' ORDER BY id DESC LIMIT 0,10";
} else if ($_SESSION['language'] == 'french') {
    $select_latest = "SELECT *, product.id AS proid FROM product WHERE status='2' and lang_status='1' ORDER BY id DESC LIMIT 0,10";
} else if ($_SESSION['language'] == 'chinese') {
    $select_latest = "SELECT *, product.id AS proid FROM product WHERE status='2' and lang_status='2' ORDER BY id DESC LIMIT 0,10";
} else {
    $select_latest = "SELECT *, product.id AS proid FROM product WHERE status='2' and lang_status='3' ORDER BY id DESC LIMIT 0,10";
}
$res_latest = mysqli_query($con, $select_latest);


?>

<div class="product-slider" style="background: #f2f2f2;padding: 30px 30px 20px 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title-h2"><b>Recent Products</b></h2>
            </div>
            <div class="col-md-12">
                <div class="product-slider-inner">
                    <div id="products" class="owl-carousel">
                        <?php while ($fetch_latest = mysqli_fetch_array($res_latest)) {

                            $uid = $fetch_latest['userid'];
                            $bdes = $fetch_latest['p_bdes'];
                            $imgpath = "productlogo/" . $fetch_latest['p_photo'];
                            if (($fetch_latest['p_photo'] != '') && (file_exists($imgpath))) {
                                $image = "productlogo/" . $fetch_latest['p_photo'];
                                 //echo $fetch_latest['p_photo'];
                               //echo $image = resize_image("productlogo/". $fetch_latest['p_photo'], 200, 200);
                            } else {
                                $image = "productlogo/img_noimg.jpg";
                            }
                        ?>
                            <div class="slide-itm">
                                <div class="product-box">
                                    <a href="productcompanyinfo.php?id=<?php echo $fetch_latest['id']; ?>&amp;cid=<?php echo $fetch_latest['p_category']; ?>&amp;scid=<?php echo $fetch_latest['p_subcategory']; ?>" title="<?php echo $fetch_latest['p_name']; ?>">
                                        <div class="product-box-img">
                                            <img src="<?php echo $image; ?>" alt="<?php echo $fetch_latest['p_name']; ?>" title="<?php echo $fetch_latest['p_name']; ?>">
                                        </div>
                                    </a>
                                    <div class="product-details-inner">
                                        <h3 class="text2" style="height: 60px;">
                                            <a style="font-size: 15px; color: #333;" href="productcompanyinfo.php?id=<?php echo $fetch_latest['id']; ?>&amp;cid=<?php echo $fetch_latest['p_category']; ?>&amp;scid=<?php echo $fetch_latest['p_subcategory']; ?>"  title="<?php echo $fetch_latest['p_name']; ?>"><b><?php echo $fetch_latest['p_name']; ?></b></a></h3>
                                        <div class="" style=" height: 110px; overflow: hidden;">
                                            <div class="text3">
                                                <font class="text-left">
                                                    <?php 
                                                    echo htmlspecialchars_decode($bdes);
                                                    ?>	
                                                </font>
                                            </div>
                                        </div>


                                        <h5 style="color: #333;"><b><?php echo (($fetch_latest['p_price'] == 'USD' || $fetch_latest['p_price'] == '') ? '$' : $fetch_latest['p_price']) . "" . $fetch_latest['range1'] . " - " . $fetch_latest['range2']; ?>/ Unit</b></h5>
                                        <?php if (isset($fetch_latest['p_min_quanity']) && !empty($fetch_latest['p_min_quanity'])) : ?>
                                            <p class="min-order"><?php echo $fetch_latest['p_min_quanity']; ?> Pieces (Min. Order )</p>
                                        <?php endif; ?>

                                        <a class="contact-now" href=<?php if ($sess_id != "") {
                                if ($uid == $sess_id) {
                            ?> "#" onclick="return checking();" <?php
                                } else {
                                    ?> "proaction1.php?id=<?php echo $fetch_latest['proid']; ?>" <?php
                                    }
                                } else {
                                        ?> "login-page.php?id=<?php echo $fetch_latest['proid'];?>" <?php
                                }
                                    ?>>Contact Now</a>

                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="btn-box text-center">
                    <a class="btn-all-pro" href="products.php">View all Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product-slider end -->

<!-- try-it-free start -->

<div class="try-it-free">
    <div class="container-fluid">
        <div class="row ">
        <a href="https://annextrades.com/chat/ash"><img src="https://annextrades.com/assets/images/ad.jpg" width="100%" alt=""></a>
        </div>
    </div>
</div>


<!-- recent-slider start -->
<?php
//echo $_SESSION['language']."ggghhgs"; exit;
if ($_SESSION['language'] == 'english') {
    //echo "testing1"; exit;
    $select_suuplier = "SELECT *, product.id AS proid FROM product WHERE status='2' and lang_status='0' and p_category='394'  ORDER BY id DESC LIMIT 0, 6 " ;
} 
$res_suplier = mysqli_query($con, $select_suuplier);
?>
<div class="recent-slider" style="background: #f2f2f2;padding: 30px 30px 30px 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title-h2"><b>Recent Services</b></h2>
            </div>
            <div class="col-md-12">
                <div class="product-slider-inner">
                    <div id="services" class="owl-carousel">
                        <?php
                        while ($fetch_sup = mysqli_fetch_array($res_suplier)) {
                            $bdess = $fetch_sup['p_bdes'];
                            $conname = $fetch_sup['country'];
                            $uid = $fetch_sup['userid'];
                            $sel_cou = mysqli_query($con, "select * from country where country_id='$conname'");
                            $cou_fetch = mysqli_fetch_array($sel_cou);

                            if ((file_exists("productlogo/" . $fetch_sup['photo1'])) && ($fetch_sup['photo1']) != '') {
                                $productPhoto = "productlogo/" . $fetch_sup['photo1'];
                            } else {
                                $productPhoto = "productlogo/img_noimg.jpg";
                            }
                        ?>
                            <div class="slide-itm">
                                <div class="product-box" style="">
                                    <a href="servicecompanyinfo.php?id=<?php echo $fetch_sup['id']; ?>&amp;cid=<?php echo $fetch_sup['p_category']; ?>&amp;scid=<?php echo $fetch_sup['p_subcategory']; ?>" class="bluelink">
                                        <div class="product-box-img">
                                            <img src="<?= $productPhoto ?>" alt="product-1" class="">
                                        </div>
                                    </a>
 
                                    <div class="product-details-inner">
                                        <h3 class="text2" style="height:60px;">
                                        <a style="font-size: 15px; color: #333;" href="servicecompanyinfo.php?id=<?php echo $fetch_sup['id']; ?>&amp;cid=<?php echo $fetch_sup['p_category']; ?>&amp;scid=<?php echo $fetch_sup['p_subcategory']; ?>" class="bluelink"><b><?php echo $fetch_sup['p_name']; ?></b></a></h3>
                                        <div style="height: 68px; overflow: hidden; font-weight: 100;">
                                            <div class="text3">
                                                <font class="text-left">
                                                    <?php 
                                                    echo htmlspecialchars_decode($bdess);
                                                    //$lnn =  substr($ln ,0, 80);
                                                    //echo $lnn;
                                                    ?>	
                                                </font>
                                            </div>
                                        </div>
                                        <!-- <h5>< ?php echo $cou_fetch['country_name']; ?></h5> -->
                                        <h5 style="font-size: 15px;"><b>$100 - $500/-</b><?php /* echo (($fetch_sup['p_price'] == 'USD' || $fetch_sup['p_price'] == '') ? '$100' : $fetch_sup['p_price']) . "" . $fetch_sup['range1']; */ ?> </h5>
                                        <h5 style="padding-top: 10;font-size: 15px;"">    <a style="color: #2baae1; border-bottom: 1px solid #2baae1;;" class="contact-vendor" href=<?php if ($sess_id != "") { if ($uid == $sess_id) { ?> "#" onclick="return checking();" 
                                                <?php } else { ?> "proaction1.php?id=<?php echo $fetch_sup['proid']; ?>" <?php } } else { ?> "login-page.php?id=<?php echo $fetch_sup['proid'];?>" <?php
                                                }
                                                ?>>
                                                Contact Now
                                            </a></h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <center><div class="btn-box text-center">
                    <a class="btn-all-pro1" href="services.php">View all Services</a>
                </div></center>
            </div>
        </div>
    </div>
</div>
<!-- recent-slider end -->
<!-- Testimonial -->
<div class="container-fluid" >

          <div class="row">
                  <div data-aos="fade-right" data-aos-offset="100" class="col-md-12 text-center" style="padding-top: 30px;">
                    <h1 class="testimonial text-center">What ANNEXTrades Sellers say?</h1> 
                  </div> 	
          </div>
          <div class="row text-center">
                <div class="col-md-4 text-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                  <div style="margin: 20px;">
                    <iframe style="width: 100%; height: 200px; padding-bottom: 15px;" src="https://www.youtube.com/embed/g4rF_YL6Cuo" frameborder="0"></iframe>
                    <div class="text-left">
                      <h5>Bhavesh Shah |  Glamdust LLC</h5>
                      Seller : <!-- </b>Product Received <br> -->Supplier of women undergarment, men’s undershirt and underwear, T-shirts and Men’s casual wears.                    
                    </div>
                </div>
                </div>
                <div class="col-md-4 text-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <div style="margin: 20px;">
                        <iframe style="width: 100%; height: 200px; padding-bottom: 15px;" src="https://www.youtube.com/embed/a5R5AOmm8yY" frameborder="0"></iframe>
                        <div class="text-left">
                        <h5>Mithun Waghmare |  MithCreation</h5>
                        Seller : <!-- </b>Product Received <br> -->Supplier of Organic Honey and Peanut Butter.                    
                        </div>
                    </div>
                </div>          
                <div class="col-md-4 text-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <div style="margin: 20px;">
                        <iframe style="width: 100%; height: 200px; padding-bottom: 15px;" src="https://www.youtube.com/embed/dLYrTMtCzu8" frameborder="0"></iframe>
                        <div class="text-left">
                        <h5>Zahid Shaikh |  Innovation Wood Craft</h5>
                        Seller : <!-- </b>Product Received <br> -->Supplier of woodcraft products – Puzzle games, wooden coasters, candle sticks, wooden bowls, trays, and decorative wooden items.                    
                        </div>
                    </div>
                </div>
           
                <div class="col-md-4 text-center" id="v1" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <div style="margin: 20px;">
                        <iframe style="width: 100%; height: 200px; padding-bottom: 15px;" src="https://www.youtube.com/embed/wXcNhlEghcY" frameborder="0"></iframe>
                        <div class="text-left">
                        <h5>Haseeb Rehman |  Anardi</h5>
                        Seller : <!-- </b>Product Received <br> -->Call Center Support and Digital Marketing.                    
                        </div>
                    </div>
                </div> 
                <div class="col-md-4 text-center" id="v2" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <div style="margin: 20px;">
                        <iframe style="width: 100%; height: 200px; padding-bottom: 15px;" src="https://www.youtube.com/embed/n6axv1fnW3o" frameborder="0"></iframe>
                        <div class="text-left">
                        <h5>Sameer |  Kyros Media</h5>
                        Seller : <!-- </b>Product Received <br> -->Website Design and Development                    
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center" id="v3" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <div style="margin: 20px;">
                        <iframe style="width: 100%; height: 200px; padding-bottom: 15px;" src="https://www.youtube.com/embed/BgyJ_1zkjFs" frameborder="0"></iframe>
                        <div class="text-left">
                        <h5>Rechna |  Ooras</h5>
                        Seller : <!-- </b>Product Received <br> -->Mobile Application Developer                    
                        </div>
                    </div>
                </div>
            
                <div class="col-md-12 d-flex justify-content-center">
                    <button class="btn-style btn-color-1" id="myBtn">VIEW MORE</button> 
                    <button class="btn-style btn-color-1" id="myBtn2">VIEW LESS</button> 
                </div>
            </div>
    <script>
        $("#myBtn").click(function () {
        $("#v1").css("display","block");
        $("#v2").css("display","block");
        $("#v3").css("display","block");
        $("#myBtn").css("display","none");
        $("#myBtn2").css("display","block");
        // $("#").show();   
        });

        $("#myBtn2").click(function () {
            $("#v1").css("display","none");
            $("#v2").css("display","none");
            $("#v3").css("display","none");
            $("#myBtn").css("display","block");
            $("#myBtn2").css("display","none");
            // $("#").show();   
        });
    </script>
    <div class="row">
        <div class="col-12">
            <h1 class="testimonial col-md-12 text-center"><br>What ANNEXTrades Buyers say?</h1><br><br>	
        </div>
    </div>
    <div class="row mb-5">
            <div class="col-md-4 text-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                <div style="margin: 20px;">
                    <iframe style="width: 100%; height: 200px;  padding-bottom: 15px;" src="https://www.youtube.com/embed/H2QJep4w03c" frameborder="0"></iframe>
                    <div class="text-left">
                      <h4>Charlie McNulty | Strategic Enterprises</h4>
                      Buyer : <!-- </b>Product Sold <br> -->Leather Goods - Bags, Backpacks, Wallets, Belts, and Jackets                     
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                <div style="margin: 20px;">
                    <iframe style="width: 100%; height: 200px;  padding-bottom: 15px;" src="https://www.youtube.com/embed/m4pu00ZQiQg" frameborder="0"></iframe>
                    <div class="text-left">
                      <h4>Joseph Roscillo | Bellalika Musical Instruments</h4>
                      Buyer : <!-- </b>Product Sold <br> -->Exotic Wood, Precious Metals and Custom Instrument Hardware                    
                    </div>
                </div>
            </div>          
            <div class="col-md-4 text-center" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                  <div style="margin: 20px;">
                    <iframe style="width: 100%; height: 200px;  padding-bottom: 15px;" src="https://www.youtube.com/embed/7DaLx4rGQ3s" frameborder="0"></iframe>
                    <div class="text-left">
                      <h4>Jean Delva | Apex Construction</h4>
                      Buyer : <!-- </b>Product Sold <br> -->Construction materials                    
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center" id="v4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
            </div>
            <div class="col-md-4 text-center" id="v5" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                  <div style="margin: 20px;">
                    <iframe style="width: 100%; height: 200px;  padding-bottom: 15px;" src="https://www.youtube.com/embed/3P3ut0r0Vgk" frameborder="0"></iframe>
                    <div class="text-left">
                      <h4>Andy Anderson | Anderson Apparels</h4>
                      Buyer : <!-- </b>Product Sold <br> -->Socks, Men &amp; women Underwear, Shirts (Dress &amp; Casual), Jeans and Active Wear                   
                       </div>
                </div>
            </div> 
            <div class="col-md-4 text-center" id="v6" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <button class="btn-style btn-color-1" id="myBtn3">VIEW MORE</button> 
                <button class="btn-style btn-color-1" id="myBtn4">VIEW LESS</button> 
            </div>
    </div>
    <script>
        $("#myBtn3").click(function () {
        $("#v4").css("display","block");
        $("#v5").css("display","block");
        $("#v6").css("display","block");
        $("#myBtn3").css("display","none");
        $("#myBtn4").css("display","block");
        // $("#").show();   
        });

        $("#myBtn4").click(function () {
            $("#v4").css("display","none");
            $("#v5").css("display","none");
            $("#v6").css("display","none");
            $("#myBtn3").css("display","block");
            $("#myBtn4").css("display","none");
            // $("#").show();   
        });
    </script>
<!-- End Testimonial -->
<!-- annexis start -->
<div class="annexis">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 imm" style="padding:0px;">
                <img width="100%" src="assets/images/shakehand_white.jpg" alt="">
            </div>
            <div class="col-md-6"  style="padding: 0px 20px 30px 30px;">
                <div class="annexis-inner">
                    <div ><!-- annexis-inner-box -->
                    <h2><b>Why ANNEXIS </b></h2>
                        <p style="font-size: 20px;"><b>Long Term Partnerships</b></h3><br>
                        <p style="font-size: 16px;">ANNEXIS business Directory provides the platform for consumers and suppliers to be introduced and forge long term partnerships; assisting thousands of companies in finding reliable, cost conscious and valuable business solutions. </p>
                    </div><br>
                    <div class="" >
                        <p style="font-size: 20px;"><b>Variety of Products & Services</b></h3><br>
                        <p>One spot to access manufacturers, OEMs, exporters, suppliers, wholesalers, retailers, and service providers. Also gain access to pertinent info to assist in your decision making during your expansion search, such as details on supplier experience and reputation, customer reviews and proper vetting of government registration.</p>
                    </div><br>
                    <div class="">
                        <p style="font-size: 20px;"><b>Direct Communication</b></h3><br>
                        <p style="font-size: 16px;">Many platforms restrict direct communication between supplier and service providers. We promote healthy relationship building and provide the technology to reach your interest via email or direct calling.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checking() {
        alert("You can't add contact to your Own Product");
    }
</script>
<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "ccc71f7abf6ba42df61c7480021eace46fa3c352e125d11c63d2d3bd75a9a895d98971cb48be2e8ee2912cf02d0355f8", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>

<?php include "includes/new/footer.php"; ?>