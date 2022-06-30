<?php 
	include("includes/header.php");
	$mainarticlesid=$_SESSION['mainarticlesid'];
	
	$query=mysqli_query($con,"select * from registration where id='$session_user'");
	$row=mysqli_fetch_array($query);
	$firstname=$row['firstname'];

	$id=$_REQUEST['id'];
	if(isset($_REQUEST['artid']))
	{
		$artid=$_REQUEST['artid'];
		$cmntsid=$_REQUEST['cid'];
		$delqry=mysqli_query($con,"delete from comments where articlesid='$artid' and id='$cmntsid'");
		header("location:articlesdetails_new.php?id=$id&del=1");
	}
?>
<script language="javascript">
function fnClear()
{
	document.topicpost1.sear.value="";
}
function check2()
{
	//alert("good");
	var va=document.topicpost1.sear.value;
	if(va=="")
	{
		//alert("test");
		alert("Please Enter any word");
		document.topicpost1.sear.focus();
		return false;
	}
	return true;
}

function del(aid,id)
{
	var s=confirm('Are You Sure You Want To Delete This Comment?');
	if(s==false)
	{
		return false;
	}
	else
	{
		window.location="articlesdetails_new.php?cid="+aid+"&artid="+id+"&id="+<?php echo $id; ?>;
	}
}
</script>
<script type="text/javascript">
function nextpage()
{
window.location.href="articlespost_new.php";
}
function nextpages()
{
window.location.href="comments_new.php?addcomments&articleid=<?PHP echo $_REQUEST['id'];?>";
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
<div class="products-cate-heading"><?php echo $article_view; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table width="100%" border="0">
				 
                  <tr>
                    <form name="topicpost1" method="post" action="searcharticles_new.php?searchid">
                    <td width="29%" height="30"><label>
                      <input type="text" name="sear" value="<?php echo $search_articles; ?>" onclick="fnClear();"/>
                    </label></td>
                    <td width="13%"><input type="submit" class="search_bg" name="search" value="<?php echo $search; ?>" onclick="return check()"/>
                    <!--<input type="image" src="images/search.jpg" width="50" height="40" border="0" name="search" onclick="return check()"/>--></td></form>
                    <td width="11%">&nbsp;</td>
                    <td width="24%"><label><!--<a href="articlespost_new.php">-->
                      <input name="Submit2" class="search_bg" type="submit" value="<?php echo $post_articles; ?>" onclick="javascript:nextpage();"/>
                    </label></td>
                    <td width="23%"><label><!--<a href="comments_new.php?addcomments&&id=<?PHP echo $_REQUEST['id'];?>">-->
                      <input name="Submit" class="search_bg" type="submit" value="<?php echo $add_comments; ?>" onclick="javascript:nextpages();"/>
                    </label></td>
                  </tr>
                </table>
				<?php
			  		$mainarticlesid=$_SESSION['mainarticlesid'];
					$id=$_REQUEST['id'];
					$query=mysqli_query($con,"select * from articles where id='$id' and mainarticlesid='$mainarticlesid'");
					$fetch=mysqli_fetch_array($query);
                    $fetch['subject'];
			   	?>
				<table border="0" width="100%" style="padding-top:10px; padding-left:20px;">
				<?php if(isset($_REQUEST['del'])) { ?>
					<tr>
						<td colspan="3" align="center" style="color:#FF0000;"><?php echo $article_success; ?> !</td>
					</tr>
				<?php } ?>
					<tr>
						<td width="14%"><b><?php echo $subject; ?></b></td>
						<td width="3%"><b>:</b></td>
						<td width="83%"><?php echo $fetch['subject']; ?></td>
					</tr>
					<tr>
						<td><b><?php echo $author; ?></b></td>
						<td><b>:</b></td>
						<td><?php echo $fetch['author']; ?> <?php echo $on; ?> <?php echo $fetch['date']; ?> <?php echo $fetch['time']; ?></td>
					</tr>
					<tr>
						<td><b><?php echo $summary; ?></b></td>
						<td><b>:</b></td>
						<td><?php echo $fetch['summary']; ?></td>
					</tr>
					<tr>
						<td><b><?php echo $description; ?></b></td>
						<td><b>:</b></td>
						<td><?php echo $fetch['description']; ?></td>
					</tr>
				</table>
				<?php
					$select="select * from comments where articlesid='$id' and mainarticlesid='$mainarticlesid'";
					$strget="";
					$rowsPerPage =10;
					$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
					$pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
					$count=mysqli_num_rows(mysqli_query($con,$select));
					if($count>0)
					{
						while($row1=mysqli_fetch_array($query))
						{
				?>
				<table border="0" width="100%" style="padding-top:10px; padding-left:20px;">
					<tr>
						<td colspan="3"><b><?php echo $related_comments; ?> : </b></td>
					</tr>
					<tr>
						<td width="15%"><?php echo $re; ?></td>
						<td width="4%"><b>:</b></td>
						<td width="81%"><?php echo $row1['reply'];?></td>
					</tr>
					<tr>
						<td><?php echo $by; ?></td>
						<td><b>:</b></td>
						<td><?php echo $row1['postedby'];?> <?php echo $on; ?> <?php echo $row1['date'];?> <?php echo $row1['time'];?></td>
					</tr>
					<tr>
						<td><?php echo $subject; ?></td>
						<td><b>:</b></td>
						<td><?php echo $fetch['subject'];?></td>
					</tr>
					<form name="form" method="post" action="comments_new.php?editcomments&commentsid=<?PHP echo $row1['id'];?>&articleid=<?php echo $id;?>">
					<tr><?php if($row1[postedby]==$firstname) { ?>
						<td colspan="3" align="right" style="padding-right:10px;"><input name="replyedit" class="search_bg"  type="submit" value="<?php echo $edit; ?>" />
						&nbsp;&nbsp;&nbsp;<input name="delete" class="search_bg"  type="button" value="<?php echo $delete; ?>" onclick="return del(<?php echo $row1['id'];?>,<?php echo $id;?>);" />
						</td>
					</tr><?php } ?>
					</form>
				</table>
				<?php } } ?>
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


