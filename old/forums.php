<?php 
	include("includes/header.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
?>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"><?php echo $my_coommunity; ?></div>
<?php /*?><?php include("includes/sidebar.php"); ?><?php */?>
<?php include("includes/comm_side_menul.php"); ?>
</div>
<?php include("includes/innerside1.php"); ?>
</div>

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"><?php echo $forums_list; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
	<tr>
		<td width="35%"><b><?php echo $forums; ?></b></td>
		<td width="42%"><b><?php echo $update_date; ?></b></td>
		<td width="23%"><b><?php echo $no_of_forums; ?></b></td>
	</tr>
	<?php 
		//echo "select * from forumheading where parentid='0'"; exit;
		if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select * from forumheading where parentid='0' ");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select * from forumheading_french where parentid='0' ");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select * from forumheading_chinese where parentid='0' ");
}
else
{
$select=mysqli_query($con,"select * from forumheading_spanish where parentid='0' ");
}

		
		while($forum=mysqli_fetch_array($select))
		{
			$sub=$forum['id'];
			//echo "select * from forumheading where parentid='$sub'"; exit;
			if($_SESSION['language']=='english')
{
$query=mysqli_query($con,"select * from forumheading where parentid='$sub' ");
}
else if($_SESSION['language']=='french')
{
$query=mysqli_query($con,"select * from forumheading_french where parentid='$sub' ");
}
else
{
$query=mysqli_query($con,"select * from forumheading_chinese where parentid='$sub' ");
}

			
			$count=mysqli_num_rows($query);
	?>
	<tr>
		<td style="line-height:10px;"><a href="forum_new.php?id=<?php echo $sub; ?>"><?php echo $forum['mainheading']; ?></a></td>
		<td style="line-height:10px;"><?php echo $forum['date']; ?></td>
		<td align="center" style="line-height:25px;"><?php echo $count; ?></td>
	</tr>
	<?php } ?>
</table>
<div><?PHP echo $pagingLink;
     echo "<br>";?>
</div>
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


