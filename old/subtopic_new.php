<?php 
	include("includes/header.php");
	if(isset($_REQUEST['subid']))
	{
		$subid=$_REQUEST['subid'];
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
<!--<script language="javascript">
function check2()
{
	var sear=document.getElementById.sear.value;
	if(sear=="")
	{
		alert("Please Enter any Keyword");
		document.topicpost1.sear.focus();
		return false
	}	
	//var firstname=document.addcontacts.firstname.value;
}
</script>-->
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

<div class="products-cate-heading"><?php echo $sub_topics; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table width="100%" border="0" cellpadding="0" cellspacing="2" 	>
                                            <tr>
                                              <form action="search_new.php?searchid" method="post" name="topicpost1" id="topicpost1" onsubmit="return check2();">
                                                <td width="23%" height="36"><label>
                                                  <input type="text" name="sear" value="" onclick="fnClear();"/>
                                                </label></td>
                                                <td width="54%"><input class="search_bg" type="submit" name="search" value="<?php echo $search; ?>" onclick="return check2();"/>
                                                    <!--<input type="image" src="images/search.jpg" width="40" height="40" border="0" name="search" onclick="return check2();"/>-->
                                                  </a></td>
                                              </form>
                                              <form action="forumpost_new.php?subid=<?PHP echo $subid;?>" method="post" name="topicpost" id="topicpost">
                                                <td width="23%" colspan="2" align="left" class="bluebold"><input type="submit" value="<?php echo $post_topic; ?>" class="search_bg" name="subtopic"/></td>
                                              </form>
                                            </tr>
                                            <tr>
                                              <td colspan="4" height="3">&nbsp;</td>
                                            </tr>
                                        </table>

<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
	<tr>
		<td width="37%"><b><?php echo $subject; ?></b></td>
		<td width="40%"><b><?php echo $latest_update; ?></b></td>
		<td width="23%"><b><?php echo $view_replie; ?></b></td>
	</tr>
	<?php
	if($_SESSION['language']=='english')
{
$select="select * from forums where parentid='$subid' order by `fid` desc";
}
else if($_SESSION['language']=='french')
{
$select="select * from forums_french where parentid='$subid' order by `fid` desc";
}
else if($_SESSION['language']=='chinese')
{
$select="select * from forums_chinese where parentid='$subid' order by `fid` desc";
}
else
{
$select="select * from forums_spanish where parentid='$subid' order by `fid` desc";
}

		//$select="select * from forums where parentid='$subid' order by `fid` desc";
		$strget="subid=$subid";
		$rowsPerPage =10;
		$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
		$pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
		$count=mysqli_num_rows(mysqli_query($con,$select));
		if($count>0)
		{
			$i=0;
			while($row=mysqli_fetch_array($query))
			{
			 	if($_SESSION['language']=='english')
{
$rowre=mysqli_query($con,"select * from forumreply where lang_status='0' and topicid='$row[fid]' order by rid desc");
}
else if($_SESSION['language']=='french')
{
$rowre=mysqli_query($con,"select * from forumreply where lang_status='1' and topicid='$row[fid]' order by rid desc");
}
else if($_SESSION['language']=='chinese')
{
$rowre=mysqli_query($con,"select * from forumreply where lang_status='2' and topicid='$row[fid]' order by rid desc");
}
else
{
$rowre=mysqli_query($con,"select * from forumreply where lang_status='3' and topicid='$row[fid]' order by rid desc");
}

				//$rowre=mysqli_query($con,"select * from forumreply where topicid='$row[fid]' order by rid desc");
			    $fetch=mysqli_fetch_array($rowre);
			    $count=mysqli_num_rows($rowre);
	?>
	<tr>
		<td style="line-height:25px;"><a href="postreplydetails_new.php?fid=<?php echo $row['fid']; ?>"><?php echo $row['topic']; ?></a></td>
		<td style="line-height:25px;"><?php if($count>0){ echo $fetch['replydate']." "."|"." ".$fetch['replytime']; } else {} ?></td>
		<td style="line-height:25px;"><?php echo $row['views'];?> / <a href="postreplydetails_new.php?fid=<?php echo $row['fid']; ?>"><?php echo $count; ?></a></td>
	</tr>
	<tr>
		<td style="line-height:25px;"><b><?php echo $author; ?> : </b><?php echo $row['postedby']; ?> <?php echo $on; ?> <?php echo $row['time']; ?>&nbsp;<?php echo $row['date']; ?></td>
	</tr>
	<?php } } else { ?>
	<tr>
		<td align="center" colspan="3" style="color:#FF0000"><b><?php echo $no_record; ?></b></td>
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