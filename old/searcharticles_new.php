<?php 
	include("includes/header.php");
	$mainarticlesid=$_SESSION['mainarticlesid'];
	$searched=$_REQUEST['sear'];
 	if(isset($_REQUEST['searchid']))
	{  
		$searched=$_POST['sear'];
    }
	
	if(isset($_REQUEST['search']))
	{
		$search=$_REQUEST['search'];
	}
?>
<script>
function fnClear()
{
document.topicpost1.sear.value="";

}
function nextpage()
{
window.location.href="articlespost_new.php";
}

function check()
{ 
var email=document.topicpost1.sear.value;

	
	if(email=="")
	{
		alert("search field must be filled out!");
		document.topicpost1.sear.focus();
		return false
    }
	if(email=="search Articles")
	{
		alert("search field must be filled out!");
		document.topicpost1.sear.focus();
		return false
    }
}	
</script>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading">My Community</div>
<?php /*?><?php include("includes/sidebar.php"); ?><?php */?>
<?php include("includes/comm_side_menul.php"); ?>
</div>
<?php include("includes/innerside1.php"); ?>
</div>

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 
<div class="products-cate-heading">Result For : <?php echo $searched; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:10px; padding-left:5px;">
                        
                        <tr>
                          <form action="searcharticles_new.php?searchid" method="post" name="topicpost1" id="topicpost1">
                            <td width="30%" height="30">&nbsp;<input type="text" name="sear" value="" onclick="fnClear();"/></td>
                            <td width="15%" valign="bottom"><input type="submit" class="search_bg" name="search" value="Search" onclick="return check()"/>
                            <!--<input type="image" src="images/search.jpg" width="50" height="50" border="0" name="search" onclick="return check()"/>--></td>
                            <td width="55%" valign="bottom" align="right" style="padding-right:10px;">
                              <!--<input type="submit" class="search_bg" name="Submit2" value="Add New Articles" onclick="javascript:nextpage();"/>-->
							 <a href="articlespost_new.php">Add New Articles</a>
                            </td>
                          </form>
                        </tr>
                    </table>
					
					<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
						<tr>
							<td width="396"><b>Article Subject</b></td>
							<td width="353"><b>Author</b></td>
							<td width="210"><b>Publish Time</b></td>
						</tr>
						<?php 
							$select="select * from `articles` where mainarticlesid='$mainarticlesid' and subject like '%$searched%' order by `id` desc";
							$strget="";
							$rowsPerPage =10;
							$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget,$search)) or die(mysqli_error($con)); 
							$pagingLink = getPagingLink($select, $rowsPerPage,$strget,$search);
				   			$count=mysqli_num_rows(mysqli_query($con,$select));
				   			if($count>0)
				   			{
				  				while($row=mysqli_fetch_array($query))
				     			{
						?>
						<tr>
							<td><a href=""><?php echo $row['subject'];?></a></td>
							<td><?php echo $row['author'];?></td>
							<td><?php echo $row['date'];?></td>
						</tr>
						<?php } } else { ?>
						<tr>
							<td style="color:#FF0000;" align="center" colspan="3"><b>No Records Found</b></td>
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


