<?php include("includes/new/header-inner-pages.php"); ?>

<?php
$categoryIds  = '352, 473, 537';

$select_cat = "SELECT * FROM category WHERE c_id IN ($categoryIds) ORDER BY category ASC LIMIT 3";
$res_cat = mysqli_query($con, $select_cat);
$num = mysqli_num_rows($res_cat);

?>

<div class="items-row-wrapper">
	<div class="container">
		<?php while ($fetch_cat = mysqli_fetch_array($res_cat)) { ?>
			<?php
			$selectProducts = "SELECT *,product.id AS proid,product.country AS countyid FROM product 
					  WHERE product.status='2' 
					  AND product.lang_status='0' 					  
					  AND product.p_subcategory = " . $fetch_cat['c_id'] . "  
					  GROUP BY product.id 
					  ORDER BY udate  DESC
					  LIMIT 0,8";
			$productsData = mysqli_query($con, $selectProducts);
			?>
			<div class="row-title-header">
				<h3 class="row-title"><?= $fetch_cat['category'] ?></h3>
				<div><a href="products.php?category=<?= $fetch_cat['c_id'] ?>" class="view-all-btn">View All</a></div>
			</div>
			<div class="item-flex-row">
				<?php while ($product = mysqli_fetch_array($productsData)) { ?>
					<?php
					$uid = $product['userid'];

					$imgpath = "productlogo/" . $product['p_photo'];
					if (($product['p_photo'] != '') && (file_exists($imgpath))) {
						$image = "productlogo/" . $product['p_photo'];
					} else {
						$image = "productlogo/img_noimg.jpg";
					}
					?>
					<div class="item-box">
						<figure><a href="productcompanyinfo.php?id=<?php echo $product['id']; ?>&amp;cid=<?php echo $product['p_category']; ?>&amp;scid=<?php echo $product['p_subcategory']; ?>"><img src="<?= $image ?>" alt="<?php echo $product['p_name']; ?>"></a></figure>
						<div class="item-box-info">
							<h6><a href="productcompanyinfo.php?id=<?php echo $product['id']; ?>&amp;cid=<?php echo $product['p_category']; ?>&amp;scid=<?php echo $product['p_subcategory']; ?>"><?php echo $product['p_name']; ?></a></h6>
							<div class="item-desc">
								<?php echo substr($product['p_bdes'], 0, 85);
								if (strlen($product['p_bdes']) > 85) {
									echo "...";
								} ?>
							</div>
							<div class="item-price-range">
								<strong>
									<?php echo (($product['p_price'] == 'USD' || $product['p_price'] == '') ? '$' : $product['p_price']) . "" . formatPrice($product['range1']) . " - " . formatPrice($product['range2']); ?>/ Unit
								</strong>
							</div>
							<div class="item-min-order"><small>
									<?php if (isset($product['p_min_quanity']) && !empty($product['p_min_quanity'])) : ?>
										<p class="min-order"><?php echo $product['p_min_quanity']; ?> Pieces (Min. Order )</p>
									<?php endif; ?>
								</small></div>
							<div>
								<a class="item-contact-btn" 
								href=<?php if ($sess_id != "") {																
										if ($uid == $sess_id) {
										?> "#" onclick="return checking();" <?php
										} else {
										?> "proaction1.php?id=<?php echo $product['proid']; ?>" <?php
										}
									} else {
									?> "login-page.php?id=<?php echo $product['proid'];?>" <?php
									}
									?>>Contact Now</a>
								</div>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
<!-- Weekly Deels -->
<?php include "includes/new/weekly_deals_section.php"; ?>


<script>
    function checking() {
        alert("You can't add contact to your Own Product");
    }
</script>
<?php include "includes/new/footer.php"; ?>