<?php 
$pagename = "Products";
$page= 'product';
?>
<?php include("includes/new/header-inner-pages.php"); ?>

<script type="text/javascript">
	function searchlist(id) {
		var currentDiv;
		currentDiv = document.getElementById(id);
		if (currentDiv != null) {
			currentDiv.style.display = 'none';
		} else {
			currentDiv.style.display = 'block';
		}
	}

	function checkbox() {
		//alert("hai");
		var lengthcount = document.searching.maxvalue.value;
		//alert(lengthcount);
		var checkedcount = 0;
		for (var i = 0; i < lengthcount; i++) {
			var property = "property[" + i + "]";

			var dom = document.getElementById(property); //alert(dom);
			if (dom.checked == true) {
				checkedcount++;
			}
		}

		if (checkedcount < 1) {
			alert("Select Atleast One product");
			return false;
		} else if (checkedcount > 3) {
			alert("Select Maximum Three Products Only ");
			return false;
		}
	}

	function compare() {
		//alert("hai");
		var result = checkbox();
		if (result == false) {
			return false;
		} else {
			document.searching.submit();
		}
	}

	function comp() {
		document.searching.Submit.readOnly = false;
	}

	function checking() {
		alert("You can't add contact to your Own Product");
	}
</script>
<?php
	$pro_name = $_REQUEST["p_name"];
	$country = $_REQUEST["country"];
	$category = $_REQUEST["category"];
	$name = $_REQUEST['name'];

	if ($country == '0') {
		$country = "";
	}
	if ($pro_name != '') {
		$pro_name = $pro_name;
	}

	if ($category == '0') {
		$category = "";
	}
	if ($pro_name != "Type Keyword") { 
		$q1 = " AND (product.p_name like '%$pro_name%' OR product.p_keyword like '%$pro_name%')  ";
	}

	if ($country != "") {
		$q2 = " AND product.country = '$country' ";
	}

	if ($category != "") {
		$q3 = " AND (product.p_category = '$category' OR  product.p_subcategory = '$category')";
	}

	if ($name != "") {
		$q4 = " AND product.p_name LIKE '$name%'";
	}
	if ($pro_name != "Type Keyword") {
		$q6 = " UNION SELECT * FROM registration where companyname like '%$pro_name%'";
	}

	$query = $q1 . $q2 . $q3 . $q4;

	$query = substr($query, 5);

	if ($query != '') {
		if ($_SESSION['language'] == 'english') {
			$select = "SELECT *,product.id as proid,product.country as countyid from product where $query and product.status='2' and product.lang_status='0' and product.p_category !='394'  GROUP BY product.id order by udate  desc ";

		} else {
			$select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where $query and product.status='2' and product.lang_status='3' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
		}
	} else {
		if ($_SESSION['language'] == 'english') {

			$select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where product.status='2' and product.lang_status='0' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
		} else {
			$select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where product.status='2' and product.lang_status='3' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
		}
	}

	$strget = "";
	$rowsPerPage = 20;
	$result_query = getPagingQuery($select, $rowsPerPage, $strget);
	$result1 = mysqli_query($con, $result_query);

	$pagingLink = getPagingLink($select, $rowsPerPage, $sentsql);
?>

<?php
	if (isset($_GET['category']) &&  !empty($_GET['category'])) {
		$categorySelect = "SELECT * FROM category WHERE category.c_id=" . $_GET['category'];
		$categoryQuery = mysqli_query($con, $categorySelect);
		$categoryCount = mysqli_num_rows($categoryQuery);
		$categoryData = mysqli_fetch_array($categoryQuery);
	}
?>

<div class="items-row-wrapper">
	<div class="container">
		<!--div class="page-breadcrumb">
			<ul class="list-unstyled">
				<li><a href="products.php">Products</a><?php if (count($categoryCount) > 0) { ?> > <?php } ?> </li>
				<?php if (count($categoryCount) > 0) { ?>
					<li><?= $categoryData['category']; ?></li>
				<?php }  ?>
			</ul>
		</div-->
		<div class="row-title-header">
			<h3 class="row-title">
				<?php if (count($categoryCount) > 0) {
					echo $categoryData['category'];
				} else {
					echo "Products";
				}
				?>
			</h3>
		</div>
		<div class="item-flex-row">
			<?php
				if (mysqli_num_rows($result1) > 0) {
					$i = 0;
					while ($product = mysqli_fetch_array($result1)) {
					//echo $pro_name;
					$uid = $product['userid'];
					$country = $product['country'];
					$select_country = "SELECT * FROM country WHERE `country_id`='$country'";
					$res_country = mysqli_query($con, $select_country);
					$fetch_country = mysqli_fetch_array($res_country);
					$imgpath = "productlogo/" . $product['p_photo'];
					if (($product['p_photo'] != '') && (file_exists($imgpath))) {
						$image = "productlogo/" . $product['p_photo'];
				} else {
					$image = "productlogo/img_noimg.jpg";
				}
			?>
			<div class="item-box">
				<figure><a href="productcompanyinfo.php?id=<?php echo $product['id']; ?>&amp;cid=<?php echo $product['p_category']; ?>&amp;scid=<?php echo $product['p_subcategory']; ?>"><img class="w-100" src="<?= $image ?>" alt="<?php echo $product['p_name']; ?>"></a></figure>
					<div class="item-box-info">
						<h6><a href="productcompanyinfo.php?id=<?php echo $product['id']; ?>&amp;cid=<?php echo $product['p_category']; ?>&amp;scid=<?php echo $product['p_subcategory']; ?>"><b><?php echo $product['p_name']; ?></b></a></h6>
						<div style="height: 70px; overflow: hidden; font-weight: 100!important;">
							<div class="text3" >
								<font class="text-left"  style="font-size: 15px;"><?php echo htmlspecialchars_decode(html_entity_decode($product['p_bdes']));; ?></font>	
							</div>
						</div>
						<div class="item-price-range" style="padding-top: 10px;">
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
							<a class="item-contact-btn" href=<?php if ($sess_id != "") {if ($uid == $sess_id) { ?> "#" onclick="return checking();" 
								<?php
									} else {
									?> "proaction1.php?id=<?php echo $product['proid']; ?>"
								<?php }														
									} 
									else 
									{ 
								?> "login.php" 
								<?php
									}
								?>> Contact Now
							</a>	
						</div>
					</div>
				</div>
				<?php	}	} else {	?>
				<div style="padding:100px; color:#FF0000; font-weight:bold;"> <?php echo $no_record; ?></div>
				<?php } ?>
			</div>
			<div class="page-pagination">
				<?php echo $pagingLink; ?>
			</div>
		</div>
	</div>
	<!-- Weekly Deels -->
	<?php include "includes/new/weekly_deals_section.php"; ?>

	</script>
	<?php include "includes/new/footer.php"; ?>

	<?php
	function getPagingQuery($sql, $itemPerPage = 5)
	{
		if (isset($_GET['page']) && (int) $_GET['page'] > 0) {
			$page = (int) $_GET['page'];
		} else {
			$page = 1;
		}

		// start fetching from this row number
		$offset = ($page - 1) * $itemPerPage;

		return $sql . " LIMIT $offset, $itemPerPage";
	}
	function getPagingLink($sql, $itemPerPage = 5, $strGet)
	{
		global $con, $category;

	$result        = mysqli_query($con, $sql) or die(mysqli_error($con));
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
	@$totalPages    = ceil($totalResults / $itemPerPage);
	// how many link pages to show
	$numLinks      = 10;

	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

		if (isset($_GET['page']) && (int) $_GET['page'] > 0) {
			$pageNumber = (int) $_GET['page'];
		} else {
			$pageNumber = 1;
		}

		$categoryStrQuery = "category=". $category;

		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = " <a href=\"$self?page=$page&$strGet&$categoryStrQuery\" class=\"navi-item navi-prev \">
				<svg width='6' height='10' viewBox='0 0 6 10' fill='none' xmlns='http://www.w3.org/2000/svg'>
					<path fill-rule='evenodd' clip-rule='evenodd' d='M5.44187 0.183056C5.68595 0.42713 5.68595 0.822853 5.44187 1.06693L1.50886 4.99994L5.44187 8.93294C5.68595 9.17702 5.68595 9.57274 5.44187 9.81681C5.1978 10.0609 4.80207 10.0609 4.558 9.81681L0.183056 5.44187C-0.0610186 5.1978 -0.0610186 4.80207 0.183056 4.558L4.558 0.183056C4.80207 -0.0610186 5.1978 -0.0610186 5.44187 0.183056Z' />
				</svg>
				</a>";
			} else {
				$prev = " <a href=\"$self?$strGet&$categoryStrQuery\" class=\"navi-item navi-prev\">
				<svg width='6' height='10' viewBox='0 0 6 10' fill='none' xmlns='http://www.w3.org/2000/svg'>
					<path fill-rule='evenodd' clip-rule='evenodd' d='M5.44187 0.183056C5.68595 0.42713 5.68595 0.822853 5.44187 1.06693L1.50886 4.99994L5.44187 8.93294C5.68595 9.17702 5.68595 9.57274 5.44187 9.81681C5.1978 10.0609 4.80207 10.0609 4.558 9.81681L0.183056 5.44187C-0.0610186 5.1978 -0.0610186 4.80207 0.183056 4.558L4.558 0.183056C4.80207 -0.0610186 5.1978 -0.0610186 5.44187 0.183056Z' />
				</svg>
				</a> ";
			}
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
		}

		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?page=$page&$strGet&$categoryStrQuery\" class=\"navi-item navi-next\">
				<svg width='6' height='10' viewBox='0 0 6 10' fill='none' xmlns='http://www.w3.org/2000/svg'>
					<path fill-rule='evenodd' clip-rule='evenodd' d='M0.183007 9.81682C-0.061068 9.57275 -0.061068 9.17702 0.183007 8.93295L4.11601 4.99994L0.183008 1.06694C-0.0610673 0.82286 -0.0610672 0.427138 0.183008 0.183063C0.427082 -0.0610118 0.822805 -0.0610117 1.06688 0.183063L5.44182 4.55801C5.6859 4.80208 5.6859 5.1978 5.44182 5.44188L1.06688 9.81682C0.822804 10.0609 0.427081 10.0609 0.183007 9.81682Z' />
				</svg>
			</a>";
		} else {
			$next = ''; // we're on the last page, don't show 'next' link			
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;
		$end   = min($totalPages, $end);

		$pagingLink = array();
		for ($page = $start; $page <= $end; $page++) {
			if ($page == $pageNumber) {
				$pagingLink[] = "<a class='navi-item active'>" . $page . "</a>";   // no need to create a link to current page
			} else {
				if ($page == 1) {
					$pagingLink[] = " <a href=\"$self?$strGet&$categoryStrQuery\" class=\"navi-item\">$page</a> ";
				} else {
					$pagingLink[] = " <a href=\"$self?page=$page&$strGet&$categoryStrQuery\" class=\"navi-item\">$page</a> ";
				}
			}
		}
		$pagingLink = implode('', $pagingLink);
		// return the page navigation link
		$pagingLink = $prev . $pagingLink . $next;
	}
	return $pagingLink;
} 
?>