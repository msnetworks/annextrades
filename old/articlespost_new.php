<?php 
	include("includes/header.php");
	$query=mysqli_query($con,"select * from registration where id='$session_user'");
	$row=mysqli_fetch_array($query);
	$firstname=$row['firstname'];
	$id=$row['id'];
	
	$mainarticlesid=$_SESSION['mainarticlesid'];
	
	if(isset($_REQUEST['submit']))
	{
		 $subject=$_POST['subject'];
		 $msg=$_POST['msg'];
		 $summary=$_POST['summary'];
		 //$reply=$_POST['reply'];
		 $today = date("F j, Y"); 
		 $today1 = date("g:i a");
		
		mysqli_query($con,"insert into articles(mainarticlesid,userid,subject,summary,author,date,time,description)values('$mainarticlesid','$id','$subject','$summary','$firstname','$today','$today1','$msg')");
		 
		header("location:articles_new.php?id=$mainarticlesid");
	}
?>
<script language="javascript">
function trim1(str)
{
	
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}
function validate()
{
var subject=document.articles.subject.value;
var summary=document.articles.summary.value;
var msg=document.articles.msg.value;
		if((subject=="")||(trim1(subject)==''))
		{
		alert("Please enter the subject");
		document.articles.subject.value='';
		document.articles.subject.focus();
		return false;
		}
		if((summary=="")||(trim1(summary)==''))
		{
		alert("Please enter the summary");
		document.articles.summary.value='';
		document.articles.summary.focus();
		return false;
		}
		
		if((msg=="")||(trim1(msg)==''))
		{
		alert("Please enter the Message");
		document.articles.msg.value='';
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
<div class="cate-heading"><?php echo $my_coommunity; ?></div>
<?php /*?><?php include("includes/sidebar.php"); ?><?php */?>
<?php include("includes/comm_side_menul.php"); ?>
</div>
<?php include("includes/innerside1.php"); ?>
</div>

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 
<div class="products-cate-heading"><?php echo $article_post; ?></div>
<div style="border: solid 1px #CFCFCF;">

<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
<form id="form1" name="articles" method="post" action="" onSubmit="return validate()">
	<tr>
		<td><span style="color:#FF0000">*</span>&nbsp;<b><?php echo $subject; ?></b></td>
		<td><input name="subject" type="text" style="width:260px; height:15px;"></td>
	</tr>
	<tr>
		<td><span style="color:#FF0000">*</span>&nbsp;<b><?php echo $summary; ?></b></td>
		<td><textarea name="summary" rows="2" cols="30"></textarea></td>
	</tr>
	<tr>
		<td><span style="color:#FF0000">*</span>&nbsp;<b><?php echo $message; ?></b></td>
		<td><textarea name="msg" rows="5" cols="30" ></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding-top:10px;"><input type="submit" class="search_bg" name="submit" value="<?php echo $post; ?>"/></td>
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


