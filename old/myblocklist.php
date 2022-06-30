<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
	if(isset($_REQUEST['Block_delete']))
	{
		$selected_friends = $_REQUEST['checklist123'];
		foreach($selected_friends as $sel)
		{
			mysqli_query($con,"UPDATE `add_contacts` SET `status`='2'  WHERE `contact_id`='$sel'");  
		}  
		header("location:myblocklist.php"); 
						
	}
?>
<script language="javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	//alert("test");
	if(!document.forms[FormName])
	{
		return;
	}
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
	{
		objCheckBoxes.checked = CheckValue;
		
	}
	else
	{
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
		{
			objCheckBoxes[i].checked = CheckValue;
		}
	}
}
</script>
<script language="javascript">
function checkbox_nn()
 {
 
 var lengthcount=document.contactlist.maxvalue.value;
 var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var check_list44 = "check_list["+i+"]";
	 var dom = document.getElementById(check_list44);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	if(checkedcount < 1) {
			alert("Select Atleast One Checkbox");
			return false;
		}
	if( confirm('Are you sure you want to Delete this Record?') )
						{
						
						return true;
						}
						else
						{	
						return false; 
						}
}

function compare()
{
   
	if(document.contactlist.checkval.value=="")
	{
	alert('Select Atleast One Checkbox');
	return false;
	}
	else
	{
	if( confirm('Are you sure you want to Delete this Record?') )
						{
						return true;
						}
						else
						{	
						return false; 
						}
	}

}
</script>
<script type="text/javascript">
function checkbox1() {
     
	var lengthcount=document.blocklist.maxvalue.value;
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var checklist = "checklist123["+i+"]";
	 var dom = document.getElementById(checklist);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	if(checkedcount < 1)
	    {
			alert("Select Atleast One Checkbox");
			return false;
		}
	if(confirm('Are you sure you want to Unblock this Record?'))
						{
						
						return true;
						}
						else
						{	
						return false; 
						}
}

function compare1(){
 
	var result=checkbox1();
	if(result == false) {
		return false;
	}
	else {	
	 document.forms["blocklist"].submit();
	 return true;
	}
}
</script>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="company__container">
<?php include("includes/side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="tabs-cont"> <div class="left">
<div class="bordersty">
<div class="headinggg"><?php echo $block_list; ?></div>
<form  name="blocklist" method="post" action="" onSubmit="return compare1();">
<table border="0" width="100%" style="margin-top:8px;">
<?php if(isset($_REQUEST['updated'])) { ?>
		<tr>
			<td colspan="6" align="center" style="color:#C55000">
				<b><?php echo $update_success; ?>&nbsp;!</b>
			</td>
		</tr>
<?php } ?>

<?php if(isset($_REQUEST['blocked'])) { ?>
		<tr>
			<td colspan="6" align="center" style="color:#C55000">
				<b><?php echo $blocked_error; ?>&nbsp;!</b>
			</td>
		</tr>
<?php } ?>

<?php 
	$select="SELECT * FROM `add_contacts` where status='1' and user_id='$session_user' order by `contact_id` desc";
	$strget="";
	$rowsPerPage = '5';
	$result=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con));
	$pagingLink = getPagingLink1($select, $rowsPerPage,'olddiv=contactlist'); 
	$count=mysqli_num_rows(mysqli_query($con,$select));
	$i=0;
?>
<?php if($count>0) { $i=0; ?>
		<th width="16%"><a href="#" onClick="javascript:SetAllCheckBoxes('blocklist', 'checklist123[]', true)">Select all</a>&nbsp;/&nbsp;<a href="#" onClick="javascript:SetAllCheckBoxes('blocklist', 'checklist123[]', false)">Clear all</a><?php } ?></th>
		<th width="20%"><?php echo $name; ?></th>
		<th width="18%"><?php echo $email; ?></th>
		<th width="19%"><?php echo $country1; ?></th>
		<th width="13%"><?php echo $description; ?></th>
		<th width="14%"><?php echo $date; ?></th>
		<?php 
			if($count>0)
			{
				$i=0;
				while($array=mysqli_fetch_array($result))
				{
		?>
		<tr>
			<td align="center"><input type="checkbox"  name="checklist123[]" value="<?PHP echo $array['contact_id']; ?>" id="checklist123[<?PHP echo $i;?>]" style="line-height:25px;"/></td>
			<td align="center" style="line-height:30px;"><?php echo $array['firstname']; ?></td>
			<td align="center" style="line-height:30px;"><?php echo $array['contact_mail']; ?></td>
			<td align="center" style="line-height:30px;"><?php $con=$array['country'];
				$sel=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$con' "));
				echo  $sel['country_name'];
			 ?></td>
			<td align="center" style="line-height:30px;"><?php echo $array['block_reason']; ?></td>
			<td align="center" style="line-height:30px;"><?php echo $array['dates']; ?></td>
		</tr>
		<?php $i++; } ?>
		 <input type="hidden" value="<?PHP echo $i; ?>" name="maxvalue" />
		<?php } else { ?>
		<tr>
			<td>
				<td style="color:#C55000;" align="center" colspan="3"><b><?php echo $no_record; ?></b></td>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td align="center">
			<input type="hidden" name="checkval" />
			<?php if($count>0) { ?>
			<input name="Block_delete" type="submit" class="search_bg" value="<?php echo $unblock; ?>" /></td>
			<?php } ?>
		</tr>
		<tr>
		<table><tr align="right"> 
   			<td  colspan="12" align="right" style="text-align:center; width:300px;"><div style="text-align:right; width:300px; padding-left:450px;"><?php echo  $pagingLink;?></div></td> 
    	</tr></table>
		<tr>
	</table>
</form>
</div>

</div></div>

</div>



</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
<div>
<?php
 function getPagingQuery1($sql, $itemPerPage = 1)
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
function getPagingLink1($sql, $itemPerPage = 1,$strGet)
{
	global $con;
	$result        = mysqli_query($con,$sql) or die(mysqli_error($con));
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
		
	
	$totalPages    = ceil($totalResults / $itemPerPage);
	
		
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
				$prev = "<span><a href='$self?page=$page&$strGet'>&laquo;Previous</a></span>";
			} else {
				$prev = "<span><a href='$self?$strGet'>&laquo;Previous</a></span>";
			}	
				
			$first = "<span><a href='$self?$strGet'>&laquo;First</a></span>";
		} else {
			$prev  = "<span class='previous-off'>&laquo;Previous</span>"; // we're on page one, don't show 'previous' link
			$first = "<span class='previous-off'>&laquo;First</span>"; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = "<span class='next'><a href='$self?page=$page&$strGet'>Next &raquo;</a></span>";
			$last = "<span class='next'><a href='$self?page=$totalPages&$strGet'>Last &raquo;</a></span>";
		} else {
			$next = "<span class='previous-off'>Next &raquo;</span>"; // we're on the last page, don't show 'next' link
			$last = "<span class='previous-off'>Last &raquo;</span>"; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
			    
				$pagingLink[] = "<span class='active'>$page</span>";   // no need to create a link to current page
			} else {
				if ($page == 1) {
				  
					$pagingLink[] = "<span><a href='$self?$strGet'>$page</a></span>";
				} else {	
				 
					$pagingLink[] = "<span><a href='$self?page=$page&$strGet'>$page</a></span>";
				}	
			}
		}
		
		$pagingLink = implode('  ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = "<div id=\"pagination-flickr\">". $first ."&nbsp;|&nbsp;". $prev ."&nbsp;|&nbsp;". $pagingLink ."&nbsp;|&nbsp;". $next ."&nbsp;|&nbsp;". $last ."</div>";
		
	}
	
	//if(empty($pagingLink)) { $pagingLink="<font  align='center' class='footer'>  First | Prev | 1 | 2 | 3 | Next | Last </font>"; }
	return $pagingLink;
}
 ?> 
</div>