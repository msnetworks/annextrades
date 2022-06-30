<?php 
	include("includes/header.php");
	$sub=$_REQUEST['id'];
	if($_SESSION['language']=='english')
{
$sel=mysqli_query($con,"select * from forumheading where id='$sub' ");
}
else if($_SESSION['language']=='french')
{
$sel=mysqli_query($con,"select * from forumheading_french where id='$sub' ");
}
else if($_SESSION['language']=='chinese')
{
$sel=mysqli_query($con,"select * from forumheading_chinese where id='$sub' ");
}
else
{
$sel=mysqli_query($con,"select * from forumheading_spanish where id='$sub' ");
}
	
	$heading=mysqli_fetch_array($sel);
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

<div class="products-cate-heading"><?php echo $heading['mainheading']; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
	<tr>
		<td width="37%"><b><?php echo $subject; ?></b></td>
		<td width="39%"><b><?php echo $latest_topic; ?></b></td>
		<td width="24%"><b><?php echo $topics; ?></b></td>
	</tr>
	<?php 
	if($_SESSION['language']=='english')
{
$trade=mysqli_query($con,"select * from forumheading where parentid='$sub' ");
}
else if($_SESSION['language']=='french')
{
$trade=mysqli_query($con,"select * from forumheading_french where parentid='$sub' ");
}
else if($_SESSION['language']=='chinese')
{
$trade=mysqli_query($con,"select * from forumheading_chinese where parentid='$sub' ");
}
else
{
$trade=mysqli_query($con,"select * from forumheading_spanish where parentid='$sub' ");
}
		//$trade=mysqli_query($con,"select * from forumheading where parentid='$sub' ");
		$num_count=mysqli_num_rows($trade);
		while($heading=mysqli_fetch_array($trade))
		{
			$topic_id=$heading['id'];
			if($_SESSION['language']=='english')
{
$sel_qry=mysqli_query($con,"select * from forums where parentid='$topic_id' ");
}
else if($_SESSION['language']=='french')
{
$sel_qry=mysqli_query($con,"select * from forums_french where parentid='$topic_id' ");
}
else if($_SESSION['language']=='chinese')
{
$sel_qry=mysqli_query($con,"select * from forums_chinese where parentid='$topic_id' ");
}
else
{
$sel_qry=mysqli_query($con,"select * from forums_spanish where parentid='$topic_id' ");
}
			
			$topic_count=mysqli_num_rows($sel_qry);
			if($_SESSION['language']=='english')
{
$query=mysqli_query($con,"select * from forums where parentid='$topic_id' order by fid desc");
}
else if($_SESSION['language']=='french')
{
$query=mysqli_query($con,"select * from forums_french where parentid='$topic_id' order by fid desc");
}
else if($_SESSION['language']=='chinese')
{
$query=mysqli_query($con,"select * from forums_chinese where parentid='$topic_id' order by fid desc");
}
else
{
$query=mysqli_query($con,"select * from forums_spanish where parentid='$topic_id' order by fid desc");
}	
			
			$topic_list=mysqli_fetch_array($query);
	?>
	<tr>
		<td style="line-height:25px;"><a href="subtopic_new.php?subid=<?php echo $topic_id; ?>"><?php echo $heading['mainheading']; ?></a></td>
		<td style="line-height:25px;"><?php echo $topic_list['topic']; ?></td>
		<td style="line-height:25px;"><?php echo $topic_count; ?></td>
	</tr>
	<?php } ?>
	<?php if ($num_count==0) { ?>
	<tr>
		<td align="center" colspan="3" style="color:#FF0000"><b><?php echo $no_record; ?></b></td>
	</tr>
	<?php } ?>
	
	<?php
	if($_SESSION['language']=='english')
{
$queryview=mysqli_query($con,"select * from forumheading  where id='$sub'");
}
else if($_SESSION['language']=='french')
{
$queryview=mysqli_query($con,"select * from forumheading_french  where id='$sub'");
}
else if($_SESSION['language']=='chinese')
{
$queryview=mysqli_query($con,"select * from forumheading_chinese  where id='$sub'");
}
else
{
$queryview=mysqli_query($con,"select * from forumheading_spanish  where id='$sub'");
}

		//$queryview=mysqli_query($con,"select * from forumheading  where id='$sub'");
		$num_countttt=mysqli_num_rows($queryview);
		while($rowview=mysqli_fetch_array($queryview))
		{
			$id=$rowview['id'];
			if($_SESSION['language']=='english')
{
$q2=mysqli_query($con,"select * from forumheading where parentid='$id'");
}
else if($_SESSION['language']=='french')
{
$q2=mysqli_query($con,"select * from forumheading_french where parentid='$id'");
}
else if($_SESSION['language']=='chinese')
{
$q2=mysqli_query($con,"select * from forumheading_chinese where parentid='$id'");
}
else
{
$q2=mysqli_query($con,"select * from forumheading_spanish where parentid='$id'");
}
			//$q2=mysqli_query($con,"select * from forumheading where parentid='$id'");
			
		
			while($r2=mysqli_fetch_array($q2))
			{
				$id2=$r2['id'];
				if($_SESSION['language']=='english')
{
$q3=mysqli_query($con,"select * from forums where parentid='$id2' order by fid desc limit 0,10");
}
else if($_SESSION['language']=='french')
{
$q3=mysqli_query($con,"select * from forums_french where parentid='$id2' order by fid desc limit 0,10");
}
else if($_SESSION['language']=='chinese')
{
$q3=mysqli_query($con,"select * from forums_chinese where parentid='$id2' order by fid desc limit 0,10");
}
else
{
$q3=mysqli_query($con,"select * from forums_spanish where parentid='$id2' order by fid desc limit 0,10");
}

				//$q3=mysqli_query($con,"select * from forums where parentid='$id2' order by fid desc limit 0,10");
				$numm_count=mysqli_num_rows($q3);
			if($numm_count>0)
			{
			?><tr>
			<td><b><?php echo$most_viewed_top; ?></b></td>
		</tr> <?php 
				while($r3=mysqli_fetch_array($q3))
				{
					$fid=$r3['fid'];
					$q=mysqli_query($con,"select * from forumreply where topicid='$fid' ");
					$co=mysqli_num_rows($q);
					$des=$r3['topic'];
					$length=strlen($des); 
					if($length>=10)
					{
						$des1=substr($des,'0','10'); 
						$des=$des1;
					}
	?>
	<tr>
		<td>
			<table border="0" width="80%">
				
				<tr>
					<td style="padding-left:30px;"><span style="color:#FF0000;">*</span>&nbsp;<a href="postreplydetails_new.php?fid=<?php echo $fid; ?>"><?php echo $des; ?></a></td>
				</tr>
				<tr>
					<td style="padding-left:60px;"><?php echo $tot_replies; ?> : <?php echo $co; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<?php } } } } ?>
	
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


