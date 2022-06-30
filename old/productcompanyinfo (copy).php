<?php include("includes/header.php");

$catname = @mysqli_fetch_object(mysqli_query($con,"select * from category where c_id=".$_REQUEST['cid']));
$subcatname = @mysqli_fetch_object(mysqli_query($con,"select * from category where c_id=".$_REQUEST['scid']));
//print_r($_REQUEST['property']);

 ?>

<link rel="stylesheet" href="css/lightbox.min.css">
<script type="text/javascript" src="js/lightbox.js"></script>

<div class="body-cont">

    <div class="body-cont1">
        <div class="productSingleContainer">

            <div class="PSRow1">
                <div class="bigImageBox">
                    <figure>
                    </figure>
                    <div class="smallImagesRow">

                    </div>
                </div>
                <div class="PPrimaryDetails">

                </div>
            </div>

            <div>
                <!-- <div class="products-cate-heading"> <span><strong> <?php echo $pro_details; ?></strong></span></div> -->
                <div>

                    <div>

                        <!-- <div class="bluelink" style="text-decoration:none; padding-bottom:10px;"><a
                                href="index.php"><?php echo $home; ?></a> <a
                                href="products1.php"><?php echo $Product; ?></a> <a
                                href="selling_buy_leads1.php?cat_id=<?php echo $catname->c_id; ?>">
                                <?php echo $catname->category; ?></a> </div> -->

                        <?php

                                      //include ("db-connect/notfound.php");
                                      //$sess_id=$_SESSION['sess_id']; 
                                      if(isset($_REQUEST['id']))
                                      {
                                      $pro=$_REQUEST['id'];
                                      $prouser=mysqli_query($con,"select * from product where id='$pro' and status='2'");
                                      $prouser_fetch=mysqli_fetch_array($prouser);
                                      $prouerid=$prouser_fetch['userid'];

                                      $res1="select * from product where userid='$prouerid' and `id`='$pro' and status='2'";
                                      }
                                      else
                                      {
                                      $prouerid=$_REQUEST['uid'];
                                      $res1="select * from product where userid='$prouerid' and status='2'";
                                      } 
                                      $cid = $_REQUEST['cid'];
                                      $sid = $_REQUEST['scid'];
                                      $res="select * from product where userid='$prouerid' and status='2'";
                                      $strget="uid=$prouerid&cid=$cid&scid=$sid";
                                              $rowsPerPage =1;
                                              $query=mysqli_query($con,getPagingQuery($res1, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
                                              $pagingLink = getPagingLink($res, $rowsPerPage,$strget); 
                                      $id=$result['userid'];

                                      $res3=mysqli_query($con,"select * from country where country_id='$result[country]'");
                                      $result1=mysqli_fetch_array($res3);
                                      $result1['country_name'];

                                    ?>
                        <?php while($result=mysqli_fetch_array($query)){ ?>
                    </div>

                    <div>


                        <div class="PSRow1">
                            <div class="bigImageBox">
                                <figure>
                                    <?php if(isset($_REQUEST['photo1'])) { ?>
                                    <?php if((file_exists("productlogo/".$result['photo1']))&&($result['photo1'])!='') { ?>
                                    <img src="<?php echo "productlogo/".$result['photo1'];?>" /><?php } else { ?><img
                                        src="productlogo/img_noimg.jpg" /><?php } ?>
                                    <?php } elseif(isset($_REQUEST['photo2'])) { ?>
                                    <?php if((file_exists("productlogo/".$result['photo2']))&&($result['photo2'])!='') { ?><img
                                        src="<?php echo "productlogo/".$result['photo2'];?>" /><?php } else { ?><img
                                        src="productlogo/img_noimg.jpg" /><?php } ?>
                                    <?php } elseif(isset($_REQUEST['photo3'])) { ?>
                                    <?php if((file_exists("productlogo/".$result['photo3']))&&($result['photo3'])!='') { ?><img
                                        src="<?php echo "productlogo/".$result['photo3'];?>" /><?php } else { ?><img
                                        src="productlogo/img_noimg.jpg" /><?php } ?>
                                    <?php  } elseif(isset($_REQUEST['photo4'])) { ?>
                                    <?php if((file_exists("productlogo/".$result['photo4']))&&($result['photo4'])!='') { ?><img
                                        src="<?php echo "productlogo/".$result['photo4'];?>" /><?php } else { ?><img
                                        src="productlogo/img_noimg.jpg" /><?php } ?>
                                    <?php  } elseif(isset($_REQUEST['photo5'])) { ?>
                                    <?php if((file_exists("productlogo/".$result['photo5']))&&($result['photo5'])!='') { ?><img
                                        src="<?php echo "productlogo/".$result['photo5'];?>" /><?php } else { ?><img
                                        src="productlogo/img_noimg.jpg" /><?php } ?>
                                    <?php } else { ?>
                                    <?php if((file_exists("productlogo/".$result['p_photo']))&&($result['p_photo'])!='') { ?><img
                                        src="<?php echo "productlogo/".$result['p_photo'];?>" /><?php } else { ?><img
                                        src="productlogo/img_noimg.jpg" /><?php } ?>
                                    <?php } ?>

                                </figure>
                                <div class="smallImagesRow">
                                    <?php 
                                        if(isset($_REQUEST['id']))
                                        {
                                        $pro=$_REQUEST['id'];
                                            $prouser=mysqli_query($con,"select * from product where id='$pro'");
                                            $prouser_fetch=mysqli_fetch_array($prouser);
                                            $prouerid=$prouser_fetch['userid'];
                                            $cids=$prouser_fetch['p_category'];
                                            $scids=$prouser_fetch['p_subcategory'];
                                            $qury=mysqli_query($con,"select * from product where userid='$prouerid' and id='$pro' and p_category='$cids' and p_subcategory='$scids' and status='2'");
                                            }
                                            else
                                            {
                                                $pid=$result['id'];
                                                    $cpid=$result['p_category'];
                                                    $scpid=$result['p_subcategory'];
                                                $qury=mysqli_query($con,"select * from product where id='$pid' and p_category='$cpid' and p_subcategory='$scpid' and status='2'");			 
                                            }
                                                $qury_count=mysqli_num_rows($qury);
                                                $query_fetch=mysqli_fetch_array($qury);
                                            if($qury_count>0)
                                            {  
                                        ?>

                                    <?php if($query_fetch['photo1']=="") { ?>
                                    <!-- <div class="image__small"><img
                                                                        src="productlogo/img_noimg.jpg"
                                                                        height="50" width="50" /></div> -->
                                    <?php } else { ?>
                                    <div class="image__small">
                                        <a href="<?php  echo "productlogo/".$query_fetch['photo1']; ?>"
                                            data-lightbox="image" class="orgli">
                                            <img src="<?php echo "productlogo/".$query_fetch['photo1']; ?>" />
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <?php if($query_fetch['photo2']=="") { ?>
                                    <!-- <div class="image__small"><img
                                                                        src="productlogo/img_noimg.jpg"
                                                                        height="50" width="50" /></div> -->
                                    <?php } else { ?>
                                    <div class="image__small">
                                        <a href="<?php  echo "productlogo/".$query_fetch['photo2']; ?>"
                                            data-lightbox="image" class="orgli">
                                            <img src="<?php echo "productlogo/".$query_fetch['photo2']; ?>" />
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <?php if($query_fetch['photo3']=="") { ?>
                                    <!-- <div class="image__small"><img
                                                                        src="productlogo/img_noimg.jpg"
                                                                        height="50" width="50" /></div> -->
                                    <?php } else { ?>
                                    <div class="image__small">
                                        <a href="<?php  echo "productlogo/".$query_fetch['photo3']; ?>"
                                            data-lightbox="image" class="orgli">
                                            <img src="<?php echo "productlogo/".$query_fetch['photo3']; ?>" />
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <?php if($query_fetch['photo4']=="") { ?>
                                    <!-- <div class="image__small"><img
                                                                        src="productlogo/img_noimg.jpg"
                                                                        height="50" width="50" /></div> -->
                                    <?php } else { ?>
                                    <div class="image__small">
                                        <a href="<?php  echo "productlogo/".$query_fetch['photo4']; ?>"
                                            data-lightbox="image" class="orgli">
                                            <img src="<?php echo "productlogo/".$query_fetch['photo4']; ?>" />
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <?php if($query_fetch['photo5']=="") { ?>
                                    <!-- <div class="image__small"><img
                                                                        src="productlogo/img_noimg.jpg"
                                                                        height="50" width="50" /></div> -->
                                    <?php } else { ?>
                                    <div class="image__small">
                                        <a href="<?php  echo "productlogo/".$query_fetch['photo5']; ?>"
                                            data-lightbox="image" class="orgli">
                                            <img src="<?php echo "productlogo/".$query_fetch['photo5']; ?>" />
                                        </a>
                                    </div>
                                    <?php } } else { ?>
                                    <div class="redbold">
                                        <?php echo $productcompanyinfo_nre;?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="PPrimaryDetails">
                                <h4><?php echo $result['p_name'];?></h4>
                                <div class="p__price">
                                    <strong>Price:</strong>
                                    <?php echo $result['p_price']." ".$result['range1']." - ".$result['range2'];?>
                                </div>
                                <div class="p__paymentTerms">
                                    <strong>Payment Terms:</strong>
                                    <?php echo $result['paymenttype'];?>
                                </div>

                                <div class="p__minimumQut">
                                    <strong>Minimum Order Quantity:</strong>
                                    <?php echo $result['p_min_quanity'];?>
                                </div>

                                <div class="p__deliveryTime">
                                    <strong>Delivery Time:</strong>
                                    <?php echo $result['p_delivertytime'];?>
                                </div>

                                <div class="subplierInfoBox">
                                    <h5>Supplier Information</h5>
                                    <?php 
                                      if($_SESSION['language']=='english')
                                      {
                                        $sql_cp=(mysqli_query($con,"select * from companyprofile where lang_status='2' and user_id='$prouerid'"));
                                      }
                                      else if($_SESSION['language']=='french')
                                      {
                                      $select="select * from testimonials where testrelease='Yes' and status='1' and lang_status='1' ORDER by test_id DESC";
                                      }
                                      else if($_SESSION['language']=='chinese')
                                      {
                                      $select="select * from testimonials where testrelease='Yes' and status='1' and lang_status='2' ORDER by test_id DESC";
                                      }
                                      else
                                      {
                                      $select="select * from testimonials where testrelease='Yes' and status='1' and lang_status='3' ORDER by test_id DESC";
                                      }

                                        $sql_cp=(mysqli_query($con,"select * from registration where id='$prouerid'"));
                                        $count_cp=mysqli_num_rows($sql_cp);
                                        $row_cp=mysqli_fetch_array($sql_cp);
                                        //echo "<pre>";
                                        //print_r($row_cp);
                                        //echo $row_cp['add_date']."aa";

                                        $added_date = explode(" ", $row_cp['added_date']);                                        
                                        $added_date = $added_date[0];
                                        $added_date = date("m-d-Y", strtotime($added_date));

                                    ?>
                                    <ul>
                                        <li><strong>Name: </strong> <?php if($row_cp['firstname']!=''){echo $row_cp['firstname'];}?> <?php if($row_cp['lastname']!=''){echo $row_cp['lastname'];}?></li>
                                        <li><strong>Member Since: </strong>  <?php if($row_cp['added_date']!=''){echo $added_date;}else {echo "-" ;}?></li>
                                        <!-- <li><strong>Company Website: </strong> <?php if($row_cp['url']!=''){echo $row_cp['url'];} else {echo "-" ;}?></li> -->
                                        <li><strong>Company Tel.: </strong> <?php if($row_cp['phonenumber']!=''){echo $row_cp['phonenumber'];} else {echo "-" ;}?></li>
                                    </ul>
                                </div>

                                <div>
                                    <a href="proaction1.php?id=<?php echo $result['id'];?>"
                                        class="buttonstyle"><?php echo $inquiry; ?></a>
                                </div>
                            </div>
                        </div>
                        <?php 
                          $conname=$result['country'];
                          $sel_cou=mysqli_query($con,"select * from country where country_id='$conname'");
                          $cou_fetch=mysqli_fetch_array($sel_cou);
                          $pdesc=$result['p_bdes'];
                          $pbrifdesc=$result['p_ddes'];                                                      
                        ?>
                        <div class="PSRow2">
                            <h5>Detailed Description</h5>
                            <div><?php echo $pdesc;?></div>

                            <h5>Key Specifications/Special Features</h5>
                            <div><?php echo $pbrifdesc; ?></div>
                        </div>

                        <?php } ?>

                    </div>

                    <div style="text-align: center">
                        <div class="pagination">
                            <?php echo $pagingLink; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php //include("includes/innerside2.php"); ?>
        </div>
    </div>
</div>


</div>

<?php include("includes/footer.php"); ?>

<?PHP
 function getPagingQuery($sql, $itemPerPage = 5)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
	
}
function getPagingLink($sql, $itemPerPage = 5,$strGet)
{
  global $con;
	$result        = mysqli_query($con,$sql) or die(mysqli_error($con));
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
		
	
	$totalPages    = ceil($totalResults / $itemPerPage);
	
		
	// how many link pages to show
	$numLinks      = 10;

		
	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
	
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
		
		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
			$pageNumber = (int)$_GET['page'];
		} else {
			$pageNumber = 1;
		}
		
		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = " <a href=\"$self?page=$page&$strGet\" class=\"news\">| Prev |</a> ";
			} else {
				$prev = " <a href=\"$self?$strGet\" class=\"news\">| Prev |</a> ";
			}	
				
			$first = " <a href=\"$self?$strGet\" class=\"news\"> First</a> ";
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}
	

		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?page=$page&$strGet\" class=\"news\">| Next</a> ";
			$last = " <a href=\"$self?page=$totalPages&$strGet\" class=\"news\">| Last</a> ";
		} else {
			$next = ''; // we're on the last page, don't show 'next' link
			$last = ''; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
			    
				$pagingLink[] = " $page ";   // no need to create a link to current page
			} else {
				if ($page == 1) {
				  
					$pagingLink[] = " <a href=\"$self?$strGet\" class=\"news\">$page</a> ";
				} else {	
				 
					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\" class=\"news\">$page</a> ";
				}	
			}
	
		}
		
		$pagingLink = implode(' | ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
		
	}
	
	
	return $pagingLink;
}
 ?>
<script>
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
})
</script>