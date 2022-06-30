<?php 
	include("includes/header.php");
	
	$mainarticlesid = $_GET['id'];
	$_SESSION['mainarticlesid']=$mainarticlesid;
	$headsql = "SELECT * FROM `mainarticles` WHERE `id` = '$mainarticlesid'";
	$headquery = mysqli_query($con,$headsql);
	$mainheading = mysqli_fetch_array($headquery);
	$main=$mainheading['articles'];
	$sear=$_REQUEST['sear'];
	
	
	if(isset($_REQUEST['delartid']))
	{
		$artid=$_REQUEST['delartid'];
		$art_mainid=$_REQUEST['artid'];
		mysqli_query($con,"Delete From `articles` where `id`='$artid'");
		
		header("location:articles_new.php?id=$art_mainid&del=1");
	}
?>
<script language="javascript">
/*function fnClear()
{
	document.topicpost1.sear.value="";
}*/
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
</script>
<script type="text/javascript">
function nextpage()
{
window.location.href="articlespost_new.php";
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
<?php echo $query['articles']; ?>
<div class="products-cate-heading"><?php echo $main; ?></div>
<div style="border: solid 1px #CFCFCF;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 		 <tr>
                            <form action="searcharticles_new.php?searchid" method="post" name="topicpost1" id="topicpost1" onsubmit="return check2();">
                <td width="34%" height="30">&nbsp;&nbsp;<input type="text" name="sear" value="" onclick="fnClear();"/></td>
                              <td width="27%"><input type="submit" class="search_bg" name="search" value="Search" onclick="return check()"/>
                              <!--<input type="image" src="images/search.jpg" width="30" height="30" border="0" name="search" onclick="return check()"/>--></td>
                            
                            <td width="39%" align="right" style="padding-right:10px;">
							<!--<a href="articlespost_new.php">-->
                <!--<input type="button" name="Submit" class="search_bg" value="Post Articles" onclick="javascript:nextpage();"/>-->             
				<a href="articlespost_new.php"><?php echo $add_new_articles; ?></a>
				</td>
							</form>
                          </tr>
</table>

<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
<?php if(isset($_REQUEST['del'])) { ?>
<tr>
	<td colspan="1" align="center" style="color:#FF0000;"><?php echo $article_success; ?>&nbsp;!</td>
</tr>
<?php } ?>
	<?php 
		//echo "select * from articles where mainarticlesid='$mainarticlesid' order by `id` desc";
		$select="select * from articles where mainarticlesid='$mainarticlesid' order by `id` desc";
		$strget="";
		$rowsPerPage =6;
		$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget,$mainarticlesid)) or die(mysqli_error($con)); 
		$pagingLink = getPagingLink($select, $rowsPerPage,$strget,$mainarticlesid); 
		$count=mysqli_num_rows(mysqli_query($con,$select));
		if($count>0)
		{
	?>
	<tr>
		<td><b><?php echo $subject; ?></b></td>
	</tr>
	<?php
		while($row=mysqli_fetch_array($query))
		{   
	?>
	<tr>
		<td><a href="articlesdetails_new.php?id=<?php echo $row['id'];?>"><?php echo $row['subject']; ?></a></td>
	</tr>
	<tr>
		<td><b><?php echo $author; ?> : </b><?php echo $row['author']; ?> <?php echo $on; ?> <?php echo $row['date']; ?> <?php echo $row['time']; ?></td>
	</tr>
	<tr>
		<td><?php echo $row['summary']; ?></td>
	</tr>
	<?php if($row['author']==$firstname) { ?>
	<tr>
                                  <form action="articlesedit_new.php?id=<?PHP echo $row['id'];?>" method="post" name="edit" id="edit">
                                    <td align="right" style="padding-right:10px;"><label>
                                        <div align="right">
                                          <input type="submit" class="search_bg" name="Submit2" value="Edit" />&nbsp;&nbsp;&nbsp;<?php if($session_user==$row['userid']) { ?><a href="javascript:void(0);" onclick="window.location='articles_new.php?delartid=<?php echo $row['id'];?>&artid=<?php echo $_REQUEST['id'];?>'">
										  
										  <input type="button" class="search_bg" name="delete" onclick="return confirm('Are You Sure You Want To Delete this Article');" value="Delete" />
										  
										  </a> <?php } ?>
                                        </div>
                                      </label></td>
                                  </form>
                                </tr>
								<?php } ?>
	<?php } } else { ?>
	<tr>
		<td style="color:#FF0000;" align="center"><b><?php echo $no_record; ?></b></td>
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


