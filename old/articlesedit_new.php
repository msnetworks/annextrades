<?php 
	include("includes/header.php");
	$id=$_REQUEST['id'];
 	$query1=mysqli_query($con,"select * from articles where id='$id'");
 	$row=mysqli_fetch_array($query1);
 	$row['subject'];
	$mainarticlesid=$_SESSION['mainarticlesid'];

	if(isset($_REQUEST['submit']))
	{
		 $subject=$_POST['subject'];
		 $msg=$_POST['msg'];
		 $summary=$_POST['summary'];
		 $today = date("F j, Y"); 
		 $today1 = date("g:i a");
		 mysqli_query($con,"update articles set subject='$subject',summary='$summary',date='$today',time='$today1',description='$msg' where id='$id'");
	     header("location:articles_new.php?id=$mainarticlesid");
	}
?>
<script language="javascript">
function chkval()
{
	var subject=document.articles.subject.value;
	var summary=document.articles.summary.value;
	var msg=document.articles.msg.value;
	if(subject=="")
	{
		alert("please enter the subject");
		document.articles.subject.focus();
		return false;
	}
	if(summary=="")
	{
		alert("please enter the summary");
		document.articles.summary.focus();
		return false;
	}
	if(msg=="")
	{
		alert("please enter the Message");
		document.articles.msg.focus();
		return false;
	}
	return true;
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
<div class="products-cate-heading">Articles Edit</div>
<div style="border: solid 1px #CFCFCF;">

<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
<form id="form1" name="articles" method="post" action="">
	<tr>
		<td><span style="color:#FF0000">*</span>&nbsp;<b>Subject</b></td>
		<td><input name="subject" type="text" value="<?php echo $row['subject'];?>" style="width:260px; height:15px;"></td>
	</tr>
	<tr>
		<td><span style="color:#FF0000">*</span>&nbsp;<b>Summary</b></td>
		<td><textarea name="summary" rows="2" cols="30"><?php echo $row['summary'];?></textarea></td>
	</tr>
	<tr>
		<td><span style="color:#FF0000">*</span>&nbsp;<b>Message</b></td>
		<td><textarea name="msg" rows="5" cols="30" ><?php echo $row['description'];?></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding-top:10px;"><input type="submit" name="submit" class="search_bg" value="Post" onclick="return chkval();" /></td>
	</tr>
</form>	
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


