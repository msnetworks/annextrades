<?php 
	include("includes/header.php");
	$subid=$_REQUEST['subid'];
	
	if(isset($_REQUEST['searchid']))
	{  
		$search=$_POST['sear'];
	   //echo "select * from  forumheading  as fh ,forums as fr   where fh.id=fr.parentid and fh.mainheading LIKE '%$search%' or fr.topic LIKE '%$search%'";
	   //$group=mysqli_query($con,"select * from  forumheading  as fh ,forums as fr   where fh.id=fr.parentid and fh.mainheading LIKE '%$search%' or fr.topic LIKE '%$search%'");
	   $group=mysqli_query($con,"select * from forumheading as fh ,forums as fr where fh.id=fr.parentid and fr.topic LIKE '%$search%'");
    }
	else
	{
		$group=mysqli_query($con,"select * from `forumheading`");
	}
?>
<script>
function fnClear()
{
	document.topicpost1.sear.value="";
}
function check2()
{
	var va=document.topicpost1.sear.value;
	if(va=="Search Forum")
	{
		alert("Please Enter any word");
		document.topicpost1.sear.focus();
		return false;
	}
	else if(va=="")
	{
		alert("Please Enter any word");
		document.topicpost1.sear.focus();
		return false;
	}
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

<div class="products-cate-heading"><?php echo $result_for; ?>&nbsp;:&nbsp;<?PHP echo $search;?></div>
<div style="border: solid 1px #CFCFCF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="1%" align="left" valign="top"></td>
                              <td width="98%" height="25" valign="middle" class="browse_center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="98%" height="22" class="browsetext"></td>
                                  </tr>
                              </table></td>
                              <td width="1%" align="right" valign="top"></td>
                            </tr>
                        </table>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box">
                            <tr>
                              <td valign="top"><table width="100%" border="0">
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="0" cellspacing="2">
                                      <tr>
                                        <form action="search_new.php?searchid" method="post" name="topicpost1" id="topicpost1">
                                          <td width="32%" height="36"><label>
                                            <input type="text" name="sear" value="<?php echo $search_new_serfro;?>" onclick="fnClear();"/>
                                          </label></td>
                                          <td width="68%"><input type="submit" class="search_bg" name="search" value="<?php echo $search; ?>" onclick="return check2();"/>
                                              <!--<input type="image" src="images/search.jpg" width="50" height="50" border="0" name="search" onclick="return check2();"/>--></td>
                                        </form>
                                      </tr>
                                    <tr>
                                        <td colspan="4" height="3">&nbsp;</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td><strong><?php echo $search_new_top;?></strong></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0">
                                      <?PHP 
				  
				  $count=mysqli_num_rows($group);
				 
				  if($count>0)
				  { $i=0;
				  while($row=mysqli_fetch_array($group))
					{
					$i++;
					
				/*	$group2=mysqli_query($con,"select * from `forums` where  parentid='$row[id]' and topic like '%$search%'");
					$num=mysqli_num_rows($group2);
					while($fetch2=mysqli_fetch_array($group2))
					{*/
				 ?>
                                      <tr>
                                        <td><a href="postreplydetails_new.php?fid=<?PHP echo  $row['fid'];?>" class="news"><?PHP echo $row['topic'];?></a></td>
                                      </tr>
                                      <tr>
                                        <td><?PHP echo $row['description'];?></td>
                                      </tr>
                                      <?PHP //}
				       }
				     }else {
				   ?>
                                      <tr>
                                        <td align="center" style="color:#FF0000;"><b><?php echo $no_record; ?></b></td>
                                      </tr>
                                      <?php
					}
				  ?>
                                  </table></td>
                                </tr>
                              </table></td>
                            </tr>
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