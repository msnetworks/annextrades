<ul class="list-unstyled"  style="padding: 15px; height: 80%;">
    <?php
    $currentFile = basename($_SERVER['PHP_SELF'], ".php");
    ?>
    <?php
    $servicePageArray = ['service-categories', 'services'];
    // If page related to Services
        if (in_array($currentFile, $servicePageArray)) {
            $sel_subcat = mysqli_query($con, "SELECT * FROM category WHERE parent_id='394'");
            $num_count = mysqli_num_rows($sel_subcat);
            while ($sel_subcate = mysqli_fetch_array($sel_subcat)) { ?>
                <li>
                    <a href="services.php?category=<?php echo $sel_subcate['c_id']; ?>"><?php echo $sel_subcate['category']; ?></a>
                </li>
            <?php }
        } else {

        $select_cat = "SELECT * FROM category WHERE parent_id='' and c_id !='394' ORDER BY category ASC";
        $res_cat = mysqli_query($con, $select_cat);
        $num = mysqli_num_rows($res_cat);
 
        while ($fetch_cat = mysqli_fetch_array($res_cat)) {
            $sel_subcat = mysqli_query($con, "SELECT * FROM category WHERE parent_id='$fetch_cat[c_id]'");
            $num_count = mysqli_num_rows($sel_subcat);

            $sel_subcat1 = mysqli_query($con, "SELECT * FROM product WHERE p_category='$fetch_cat[c_id]' AND status='2'");
            $num_count1 = mysqli_num_rows($sel_subcat1);
        ?>  
             <?php if ($num_count1 == 0) { ?><?php }else{ ?>
            <li>
                <a href="products.php?category=<?php echo $fetch_cat['c_id']; ?>"><?php echo $fetch_cat['category']; ?></a>
                <?php /* if ($num_count1 == 0) { ?><?php }else{ */ ?>
                <ul class="list-unstyled">
                    <?php
                        while ($sel_subcate = mysqli_fetch_array($sel_subcat)) {
                            $sel_subcat2 = mysqli_query($con, "SELECT * FROM product WHERE p_subcategory='".$sel_subcate['c_id']."' AND status='2'");
                            $num_count2 = mysqli_num_rows($sel_subcat2); 
                    ?>  
                        <?php if ($num_count2 == 0) { ?><?php }else{ ?>
                        <li>
                            <a href="products.php?category=<?php echo $sel_subcate['c_id']; ?>"><?php echo $sel_subcate['category']."(".$num_count2.")"; ?></a>
                        </li>
                    <?php } } ?>
                </ul>
                    <?php } ?>
            </li>
        <?php } ?>

    <?php
    }
    ?>
</ul>