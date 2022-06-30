<?php include("includes/header.php");


 ?>
<div class="body-cont">

    <div class="body-cont1">
        <div class="body-leftcont">
            <div class="cate-cont">
                <div class="cate-heading"> <?php echo $browse; ?> </div>
                <?php include("includes/sidebar.php"); ?>
            </div>
            <?php include("includes/innerside1.php"); ?>
        </div>
        <div class="body-right">
            <?php include("includes/menu.php"); ?>
            <div class="products-cate-cont">
                <div class="products-cate-heading"> <?php echo $product_cat; ?> <span style="float:right;"><a
                            href="addbuying_leads.php" style="font-weight:bold;"><?php echo $add_buy; ?></a></span>
                </div>
                <?php
if($_SESSION['language']=='english')
{
$query ="select * from category where parent_id='' AND c_id != 394 order by category";
}
else if($_SESSION['language']=='french')
{
$query ="select * from category_french where parent_id='' order by category";
}
else if($_SESSION['language']=='chinese')
{
$query ="select * from category_chinese where parent_id='' order by category";
}
else
{
$query ="select * from category_spanish where parent_id='' order by category";
}

//echo $query;

$strget="";
$rowsPerPage = 10;
$result_query = getPagingQuery($query, $rowsPerPage, $strget);
$result1 = mysqli_query($con,$result_query);
$pagingLink = getPagingLink($query, $rowsPerPage, "qry=$strget");
$num_count=mysqli_num_rows($result1);
$i=1;
//$maxcount = round(mysqli_num_rows($query)/2);
while($fetch = mysqli_fetch_array($result1))
{
$sub1=$fetch['c_id'];
//echo "select * from buyingleads where category='$sub1' and status='2' ";
if($_SESSION['language']=='english')
{
$querycount=mysqli_query($con,"select * from category where parent_id='$sub1' order by category");
}
else if($_SESSION['language']=='french')
{
$querycount=mysqli_query($con,"select * from category_french where parent_id='$sub1' order by category");
}
else if($_SESSION['language']=='chinese')
{
$querycount=mysqli_query($con,"select * from category_chinese where parent_id='$sub1' order by category");
}
else
{
$querycount=mysqli_query($con,"select * from category_spanish where parent_id='$sub1' order by category");

}

$co=mysqli_num_rows($querycount);

  

?>
                <div class="procate-cont">
                    <div class="procate-heading" style="padding-left:5px;"><?php echo $fetch['category']; ?>
                        <?php if($co!="") {  ?><a href="subbuyers1.php?cat_id=<?php echo $fetch['c_id']; ?>"
                            class="tradenews" style="padding-left:5px;"><?php echo "(".$co.")";  ?></a>
                        <?php } else { echo "(".$co.")"; } ?>
                    </div>


                    <div class="procate-cont-img"><a href="selling_buy_leads1.php?cat_id=<?php echo $fetch['c_id']; ?>"
                            class="tradenews"><?php if(($fetch['cat_image'] == "") || (!file_exists("admin/category_images/".
$fetch['cat_image'] )) ) { ?>
                            <img src="images/img_noimg.jpg" width="74" height="74" />
                            <?php } else { ?>
                            <img src="admin/category_images/<?php echo $fetch['cat_image']; ?>" width="74"
                                height="74" />
                            <?php } ?></a></div>
                    <div class="procatelist">
                        <?php
if($co>0)
{
$sub=$fetch['c_id'];
//echo "select * from category where parent_id='$sub'  LIMIT 0,4 ";
if($_SESSION['language']=='english')
{
$sel = mysqli_query($con,"select * from category where parent_id='$sub'   LIMIT 0,1 ");
}
else if($_SESSION['language']=='french')
{
$sel = mysqli_query($con,"select * from category_french where parent_id='$sub'   LIMIT 0,1 ");
}
else if($_SESSION['language']=='chinese')
{
$sel = mysqli_query($con,"select * from category_chinese where parent_id='$sub'   LIMIT 0,1 ");
}
else
{
$sel = mysqli_query($con,"select * from category_spanish where parent_id='$sub'   LIMIT 0,1 ");
}
//$sel = mysqli_query($con,"select * from category where parent_id='$sub'   LIMIT 0,1 ");

while($fet = mysqli_fetch_array($sel))
{
$subcat = $fet['c_id'];
$subcat1 = $fet['category']; 
?>
                        <?php //echo $subcat1; //if($j==1) { echo "...";} else {echo ","; }?> <br />
                        <?php } }  else {?> <?php //echo $nocat; ?> <?php } ?>
                        <!--<a href="#">of the printing and types</a>  (2105)<br/>
  <a href="#">Lorem Ipsum is simply</a> (215)<br/> cv-->
                    </div>




                </div>
                <?php
//echo $maxcount;
if($i&1) { ?>
                <!--<div class="line"></div>-->
                <?php 
//$i=0;
}
else
{
?>
                <div class="line"></div>
                <?php } ?>
                <?php $i++;	 } ?>


                <div class="line"></div>
                <div style="clear:both">
                    <?PHP echo $pagingLink;
     echo "<br>";?>
                </div>



            </div>

            <?php include("includes/innerside2.php"); ?>

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
function getPagingLink($sql, $itemPerPage = 5, $strGet)
{
	global $con;
	$result        = mysqli_query($con,$sql) or die(mysqli_error($con));
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
		
	
	 @$totalPages    = ceil($totalResults / $itemPerPage);
	
		
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
				$prev = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">| Prev |</a> ";
			} else {
				$prev = " <a href=\"$self?$strGet\" class=\"topics2\">| Prev |</a> ";
			}	
				
			$first = " <a href=\"$self?$strGet\" class=\"topics2\"> First</a> ";
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">| Next</a> ";
			$last = " <a href=\"$self?page=$totalPages&$strGet\" class=\"topics2\">| Last</a> ";
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
				  
					$pagingLink[] = " <a href=\"$self?$strGet\" class=\"topics2\">$page</a> ";
				} else {	
				 
					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">$page</a> ";
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