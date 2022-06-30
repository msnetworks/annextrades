<?php
 function getPagingQuery1($sql, $itemPerPage = 20)
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
function getPagingLink1($sql, $itemPerPage = 20,$strGet)
{
	global $con;
	$result        = mysqli_query($con,$sql) or die(mysqli_error($con));
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
		
	
	$totalPages    = ceil($totalResults / $itemPerPage);
	
		
	// how many link pages to show
	$numLinks      = 4;

		
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
				$prev = "<li><a href='$self?page=$page&$strGet'>&laquo;Previous</a></li>";
			} else {
				$prev = "<li><a href='$self?$strGet'>&laquo;Previous</a></li>";
			}	
				
			$first = "<li><a href='$self?$strGet'>&laquo;First</a></li>";
		} else {
			$prev  = "<li class='previous-off'>&laquo;Previous</li>"; // we're on page one, don't show 'previous' link
			$first = "<li class='previous-off'>&laquo;First</li>"; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = "<li class='next'><a href='$self?page=$page&$strGet'>Next &raquo;</a></li>";
			$last = "<li class='next'><a href='$self?page=$totalPages&$strGet'>Last &raquo;</a></li>";
		} else {
			$next = "<li class='previous-off'>Next &raquo;</li>"; // we're on the last page, don't show 'next' link
			$last = "<li class='previous-off'>Last &raquo;</li>"; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
			    
				$pagingLink[] = "<li class='active'>$page</li>";   // no need to create a link to current page
			} else {
				if ($page == 1) {
				  
					$pagingLink[] = "<li><a href='$self?$strGet'>$page</a></li>";
				} else {	
				 
					$pagingLink[] = "<li><a href='$self?page=$page&$strGet'>$page</a></li>";
				}	
			}
		}
		
		$pagingLink = implode('  ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = "<ul id=\"pagination-flickr\">". $first . $prev . $pagingLink . $next . $last ."</ul>";
		
	}
	
	//if(empty($pagingLink)) { $pagingLink="<font  align='center' class='footer'>  First | Prev | 1 | 2 | 3 | Next | Last </font>"; }
	return $pagingLink;
}

  
 ?> 
 
 
