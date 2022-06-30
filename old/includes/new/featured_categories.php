<?php
$currentFile = basename($_SERVER['PHP_SELF'], ".php");

$featuredPageId = 2;

if($currentFile == 'index')
{
    $featuredPageId = 1;
}
else if($currentFile == 'services' || $currentFile == 'service-categories')
{
    $featuredPageId = 3;
}

$featuredCategories = [];
$featuredCategoriesSelect = mysqli_query($con, "SELECT fc.*, c.category as category_name  FROM `featuredcategories` as fc, `category` as c WHERE fc.category_id = c.c_id AND fc.page_id =$featuredPageId LIMIT 0,6");
?>
<ul class="nav-after-banner justify-content-center text-justify" style="margin: 0px;">
    <?php
            while ($featuredRow = mysqli_fetch_array($featuredCategoriesSelect)) { 
                $c = mysqli_fetch_array($con->query("SELECT * FROM category WHERE c_id='".$featuredRow['category_id']."'"));
                if ($c['parent_id'] == '394') { ?>
                        <li><a class="" href="services.php?category=<?= $featuredRow['category_id'] ?>"><?= $featuredRow['category_name'] ?></a></li>
                    <?php    }
                    else{ ?>
                    <li><a class="" href="products.php?category=<?= $featuredRow['category_id'] ?>"><?= $featuredRow['category_name'] ?></a></li>
            <?php    }  }  ?>
        <!-- <li><a class="" href="products.php?category=< ?= $featuredRow['category_id'] ?>">< ?= $featuredRow['category_name'] ?></a></li> -->
    <li><a target="_blank" class="whatsapp-text cnt-btn" href="https://wa.me/+17723070151"><i style="color: #fff;" class="fa fa-whatsapp"> CONTACT US</i></a>
</li>
</ul>