<?php include("includes/header.php");

//print_r($_REQUEST['property']);

 ?>

<script type="text/javascript">
  function searchlist(id) {
    var currentDiv;
    currentDiv = document.getElementById(id);
    if (currentDiv != null) {
	currentDiv.style.display = 'none';
    }
	else{  
    currentDiv.style.display = 'block';
    }
}

function checkbox() {
//alert("hai");
	var lengthcount=document.searching.maxvalue.value;
//alert(lengthcount);
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var property = "property["+i+"]";
	 
	  var dom = document.getElementById(property);//alert(dom);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	
	if(checkedcount < 1) {
			alert("Select Atleast One product");
			return false;
		}
   else if(checkedcount>3)
   {
   	alert("Select Maximum Three Products Only ");
	return false;	
   }
}
function compare(){
 //alert("hai");
	var result=checkbox();
	if(result == false) {
		return false;
	}
	else {
	
	 document.searching.submit();
	}
}
function comp()
{
document.searching.Submit.readOnly=false;
}

function checking()
{
alert("You can't add contact to your Own Product");
}
</script>


<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"><?php echo $detail_story; ?></div>
<div style="border: solid 1px #CFCFCF;">

<?php if(isset($_REQUEST['id'])) { ?>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="26%" style="padding-left:10px;"><a href="successstory.php"><?php echo $add_new_success; ?></a></td>
	</tr>
<tr>
	<?php 
		$suc=$_REQUEST['id'];
		if($_SESSION['language']=='english')
		{
	$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='0' and test_id='$suc' ORDER by test_id DESC");
		
		}
		else if($_SESSION['language']=='french')
		{
		$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='1' and test_id='$suc' ORDER by test_id DESC");
		
		}
		else if($_SESSION['language']=='chinese')
		{
		$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='2' and test_id='$suc' ORDER by test_id DESC");
		}
		else
		{
		$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='3' and test_id='$suc' ORDER by test_id DESC");
		}
		/*$select=mysqli_query($con,"select * from testimonials where testrelease='Yes' and status='1' and lang_status='0' and test_id='$suc' ORDER by test_id DESC");*/
		$success=mysqli_fetch_array($select);
		
	?>
<td><table cellpadding="0" cellspacing="0" width="100%">
<tr>

<td width="30%" style="padding-left:50px;">
			<?php if($success['photo'] == "") { ?>
			<img src="blog_photo_thumbnail/img_noimg.jpg" width="55" height="55" />
			<?php } else { ?>
			<img src="blog_photo_thumbnail/<?php echo $success['photo']; ?>" width="55" height="55" />
			<?php } ?>
</td>
<td>
<table cellpadding="0" cellspacing="0" width="100%">
<tr style="line-height:25px;">
<td><?php echo $regards; ?>,</td><td>:</td><td><?php echo $success['testname']; ?></td>
</tr>
<tr style="line-height:25px;">
<td><?php echo $city; ?></td><td>:</td><td><?php echo $success['testcity']; ?></td>
</tr>
<tr style="line-height:25px;">
<?php if($success['testcompany']=="") { ?>
<td><?php echo $company; ?></td><td>:</td><td><?php echo "Nil"; ?></td>
<?php } else if($success['testcompany']!="") { ?>
<td><?php echo $company; ?></td><td>:</td><td><?php echo $success['testcompany']; ?></td>
<?php } ?>
</tr>
<tr style="line-height:25px;">
<td><?php echo $posted_date; ?></td><td>:</td><td>(<?php echo $success['enterdate']; ?>)</td>
</tr>
</table>
</td>
</tr>
</table></td></tr>


<tr style="line-height:17px;">
<td style="padding-left:10px;"><?php echo $success['testnote']; ?></td></tr>
</table>

<?php } else { ?>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="26%" style="padding-left:10px;"><a href="successstory.php"><?php echo $add_new_success; ?></a></td>
	</tr>

	<?php 
	if($_SESSION['language']=='english')
{
$select="select * from testimonials where testrelease='Yes' and status='1' and lang_status='0' ORDER by test_id DESC";
}
else if($_SESSION['language']=='french')
{
$select="select * from testimonials where testrelease='Yes' and status='1' and lang_status='1' ORDER by test_id DESC";
}
else if($_SESSION['language']=='chinese')
{
$select="select * from testimonials where testrelease='Yes' and status='1' and lang_status='2' ORDER by test_id DESC";
}
else
{
$select="select * from testimonials where testrelease='Yes' and status='1' and lang_status='3' ORDER by test_id DESC";
}
		
		$strget="";
		$rowsPerPage = '10';
		$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
		$pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
		while($succ=mysqli_fetch_array($query))
		{
		 
	?>
<tr>
<td><table cellpadding="0" cellspacing="0" width="100%">
<tr>

<td width="30%" style="padding-left:50px;">
			<?php if($succ['photo'] == "") { ?>
			<img src="blog_photo_thumbnail/img_noimg.jpg" width="55" height="55" />
			<?php } else { ?>
			<img src="blog_photo_thumbnail/<?php echo $succ['photo']; ?>" width="55" height="55" />
			<?php } ?>
</td>
<td>
<table cellpadding="0" cellspacing="0" width="100%">
<tr style="line-height:25px;">
<td><?php echo $regards; ?>,</td><td>:</td><td><?php echo $succ['testname']; ?></td>
</tr>
<tr style="line-height:25px;">
<td><?php echo $city; ?></td><td>:</td><td><?php echo $succ['testcity']; ?></td>
</tr>
<tr style="line-height:25px;">
<?php if($succ['testcompany']=="") { ?>
<td><?php echo $company; ?></td><td>:</td><td><?php echo "Nil"; ?></td>
<?php } else if($succ['testcompany']!="") { ?>
<td><?php echo $company; ?></td><td>:</td><td><?php echo $succ['testcompany']; ?></td>
<?php } ?>
</tr>
<?php /*?><tr style="line-height:25px;">
<td>Company</td><td>:</td><td><?php echo $succ['testcompany']; ?></td>
</tr><?php */?>
<tr style="line-height:25px;">
<td><?php echo $posted_date; ?></td><td>:</td><td>(<?php echo $succ['enterdate']; ?>)</td>
</tr>
</table>
</td>
</tr>
</table></td></tr>


<tr style="line-height:17px;">
<td style="padding-left:10px;"><?php echo $succ['testnote']; ?></td></tr>

<?php } } ?>
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


