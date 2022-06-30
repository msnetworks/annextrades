<?php 
	include("includes/header.php");
	$session_user=$_SESSION['user_login'];
	$query=mysqli_query($con,"select * from registration where id='$session_user'");
	$row=mysqli_fetch_array($query);
	$firstname=$row['firstname'];
	
	if(isset($_REQUEST['fid']))
	{
	 	$fid=$_REQUEST['fid'];
	   	$querymain=mysqli_query($con,"select * from forums where fid='$fid'");
	   	$fetchmain=mysqli_fetch_array($querymain);
	   	$mainheadingid=$fetchmain['mainheadingid'];
		$views=0;
	 	$query=mysqli_query($con,"select * from forums where fid='$fid'");
	  	$fetch=mysqli_fetch_array($query); 
	  	$views=$fetch['views']+1; 
	  	//$fetch['views'];
	  	//$views=$views+1;
	  	mysqli_query($con,"update forums set views=$views where fid=$fid");
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
<?php

	$mainheadingid=$fetchmain['mainheadingid'];
	if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select * from forums where fid='$fid'");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select * from forums_french where fid='$fid'");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select * from forums_chinese where fid='$fid'");
}
else
{
$select=mysqli_query($con,"select * from forums_spanish where fid='$fid'");
}

	//$select=mysqli_query($con,"select * from forums where fid='$fid'");
    $row=mysqli_fetch_array($select);
?>
<div class="products-cate-heading"><?php echo $row['topic']; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table border="0" width="100%">
<form action="postreply_new.php?fid=<?PHP echo $row['fid'];?> " method="post" name="form" id="form">
	<tr>
		<td align="right"><input type="submit" class="search_bg" name="reply1" value="<?php echo $reply; ?>" style="margin-top:10px; margin-right:10px;"/></td>
	</tr>
</form>
</table>
<table border="0" width="100%" style="padding-left:10px;">
	<tr>
		<td><b><?php echo $row['description']; ?></b></td>
	</tr>
	<?php
	if($_SESSION['language']=='english')
{
$select="select * from forumreply where lang_status='0' and topicid='$fid'";  
}
else if($_SESSION['language']=='french')
{
$select="select * from forumreply where lang_status='1' and topicid='$fid'";  
}
else if($_SESSION['language']=='chinese')
{
$select="select * from forumreply where lang_status='2' and topicid='$fid'";  
}
else
{
$select="select * from forumreply where lang_status='3' and topicid='$fid'";  
}


		//$select="select * from forumreply where topicid='$fid'";  
		$strget="";
		$rowsPerPage =10;
		$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
		$pagingLink = getPagingLink($select, $rowsPerPage,$strget,$fid); 
		if($_SESSION['language']=='english')
{
$s2=mysqli_query($con,"select count(*) as coun from forumreply where lang_status='0' and topicid='$fid'");
}
else if($_SESSION['language']=='french')
{
$s2=mysqli_query($con,"select count(*) as coun from forumreply where lang_status='1' and topicid='$fid'");
}
else if($_SESSION['language']=='chinese')
{
$s2=mysqli_query($con,"select count(*) as coun from forumreply where lang_status='2' and topicid='$fid'");
}
else
{
$s2=mysqli_query($con,"select count(*) as coun from forumreply where lang_status='3' and topicid='$fid'");
}

		//$s2=mysqli_query($con,"select count(*) as coun from forumreply where topicid='$fid'");
		$rw1=mysqli_fetch_array($s2);
		$count=$rw1['coun'];
		$i=1;
		$line_count=$co=mysqli_num_rows(mysqli_query($con,$select));
		if($co>0)
		{
	    	while($row1=mysqli_fetch_array($query))
			{
	?>
	<tr>
		<td><?php echo $row1['replydate'];?></td>
	</tr>
	<tr>
		<td><?php echo $row['topic'];?></td>
	</tr>
	<tr>
		<td><?php echo $re; ?> : <b><?php echo ucfirst($row1['reply']); ?></b></td>
	</tr>
	<tr>
		<td><?php echo $by; ?> <?php echo $row1['postedby'];?></td>
	</tr>
	
	<form action="postreply_new.php?fid=<?PHP echo $row['fid'];?>&amp;&amp;rid=<?PHP echo $row1['rid'];?>" method="post" name="form" id="form">

                                                <tr>
                                                  <?PHP if($row1[postedby]==$firstname){?>
                                                  <td width="13%"><input type="submit" name="replyedit" value="Edit" class="search_bg"/></td>
                                                  <?PHP }?>
                                                  <td width="87%" colspan="3" align="right"><!--<input type="submit" name="reply1" value="<?php echo $postreplydetails_new_rep;?>"/>--></td>
                                                </tr>
                                              </form>

	<?php 
		 $line_count = $line_count-1;
		if($line_count != 0)
		{ 
	?>
    <tr><td style="color:#29B1CA;">__________________________________________________________________________________</td></tr>
	
<?php } else { } } } else { ?>
<tr>
<td align="center" style="color:#FF0000;"><b>No Records found</b></td></tr><?php } ?></table>
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
<div>
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
</div> 