<?php 
	include("includes/header.php");
	
	$aid=$_REQUEST['id'];
$query=mysqli_query($con,"select * from registration where id='$session_user'");
$row=mysqli_fetch_array($query);
$firstname=$row['firstname'];
$idd=$row['id'];
 
 $mainarticlesid=$_SESSION['mainarticlesid'];
 
if(isset($_REQUEST['Submit']))
{
  $id=$_REQUEST['articleid'];
  $msg=$_POST['msg'];
  $today = date("F j, Y"); 
  $today1 = date("g:i a");
 /*  $query1=mysqli_query($con,"select * from articles where id='$aid'");
   $row1=mysqli_fetch_array($query1);
   $in=$row1['info'];
   $userid=$row1['userid'];
   $subject="Articles comments";
   $query2=mysqli_query($con,"select * from registration where id='$userid'");
   $row2=mysqli_fetch_array($query2);
   $to=$row2['email'];
  if($in=='on')
  {
  mail($to,$subject,$msg);
  }*/
  
  mysqli_query($con,"insert into comments(articlesid,mainarticlesid,userid,postedby,date,time,reply)values('$id',$mainarticlesid,'$idd','$row[firstname]','$today','$today1','$msg')");
  //header("location:articles_new.php?id=$mainarticlesid");
  header("location:articlesdetails_new.php?id=$id");
 }
 
 if(isset($_REQUEST['articleid']))
 {
 $aid=$_REQUEST['articleid'];
 $query=mysqli_query($con,"select * from articles where id='$aid' and mainarticlesid='$mainarticlesid' ");
 $r=mysqli_fetch_array($query);
  $r['subject'];
 }

if(isset($_REQUEST['commentsid']))
 {
   $commentsid=$_REQUEST['commentsid'];
  $query1=mysqli_query($con,"select * from comments where id='$commentsid' and mainarticlesid='$mainarticlesid' ");
 $r1=mysqli_fetch_array($query1);
 //print_r($r1);
}

if(isset($_REQUEST['editcom']))
{
   $id=$_REQUEST['commentsid'];
   $msg=$_POST['msg'];
   $today = date("F j, Y"); 
   $today1 = date("g:i a");
  /* $query1=mysqli_query($con,"select * from articles where id='$aid'");
   $row1=mysqli_fetch_array($query1);
   $in=$row1['info'];
   $userid=$row1['userid'];
   $subject="Articles comments";
   $query2=mysqli_query($con,"select * from registration where id='$userid'");
   $row2=mysqli_fetch_array($query2);
   $to=$row2['email'];
  if($in=='on')
  {
  mail($to,$subject,$msg);
  }*/
  
  //echo "update comments set date='$today',time='$today1',reply='$msg' where id='$id'";exit;
  mysqli_query($con,"update comments set date='$today',time='$today1',reply='$msg' where id='$id'");
  
  	//header("location:articles_new.php?id=$mainarticlesid");
	header("location:articlesdetails_new.php?id=$aid");
}
?>

<script>

function checkval()
{

if(document.form1.msg.value=="")
{
 alert("Please Enter comments");
	document.form1.msg.focus();
	return false;
}
}

function check2()
{
//var va=document.form2.msg.value;
if(document.form2.msg.value=="")
{
 alert("Please Enter comments");
	document.form2.msg.focus();
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
<?php if(isset($_REQUEST['addcomments'])) { ?> 
<div class="products-cate-heading"><?php echo $add_your_comm; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
<form id="form1" name="form1" method="post" action="">
	<tr>
		<td><span style="color:#FF0000;">*</span><b>&nbsp;<?php echo $subject; ?></b></td>
		<td><input type="text" name="subject" value="<?php echo $r['subject'];?>" style="width:340px; height:15px;"></td>
	</tr>
	<tr>
		<td><span style="color:#FF0000;">*</span><b>&nbsp;<?php echo $comments; ?></b></td>
		<td><textarea name="msg" rows="3" cols="40"></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding-top:10px;"><input type="submit" name="Submit" class="search_bg" value="<?php echo $post; ?>" onclick="return checkval();"/></td>
	</tr>
</form>	
</table>
</div>
<?php } 
	if(isset($_REQUEST['editcomments'])) 
	{ 
		 $commentsid=$_REQUEST['commentsid'];
         $query1=mysqli_query($con,"select * from comments where id='$commentsid' and mainarticlesid='$mainarticlesid' ");
         $r1=mysqli_fetch_array($query1);
		 $articleid=$r1['articlesid'];
		 $que=mysqli_query($con,"select * from articles where id='$articleid'");
		 $r2=mysqli_fetch_array($que);
	?>	
<div class="products-cate-heading"><?php echo $edit_ur_comm; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table border="0" width="100%" style="padding-top:10px; padding-left:5px;">
 <form  name="form2" method="post" action="">
	<tr>
		<td><span style="color:#FF0000;">*</span><b>&nbsp;<?php echo $subject; ?></b></td>
		<td><input type="text" name="subject" value="<?php echo $r2['subject']; ?>" readonly="true" style="width:340px; height:15px;"></td>
	</tr>
	<tr>
		<td><span style="color:#FF0000;">*</span><b>&nbsp;<?php echo $comments; ?></b></td>
		<td><textarea name="msg" rows="3" cols="40"><?php echo $r1['reply']; ?></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding-top:10px;"><input type="submit" class="search_bg" name="editcom" value="<?php echo $post; ?>" onclick="return check2()"/></td>
	</tr>
</form>	
</table>
</div>
<?php } ?>			

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