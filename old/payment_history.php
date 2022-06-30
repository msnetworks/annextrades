<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	
	if(isset($_REQUEST['delete']))
	{
		$selected_friends = $_POST['checkbox'];
		foreach($selected_friends as $sel)
		{
		    //echo "update order_shopping set order_status=2 where id='$sel'"; exit;
			$del_val=mysqli_query($con,"update orders set order_status=1 where id='$sel'");  
						 
		}   
		if($del_val)
		{
		header("location:payment_history.php?del_succ");
		}
	}
	
	if(isset($_REQUEST['del']))
	{
	$del=$_REQUEST['del'];
	
	$del_qry1=mysqli_query($con,"update orders set order_status=1 where order_id='$del'");
	$del_qry2=mysqli_query($con,"update orders set order_status=1 where order_id='$del'");
	
	if(($del_qry1)&&($del_qry2))
	{
	header("location:payment_history.php?del_succ");
	}
	
	
	}
	
?>

<script type="text/javascript">

function show(value)
	{
		if(value=="compose")
		{
			//alert("hai");
			document.getElementById("compose").style.display='block';
			document.getElementById("inbox").style.display='none';
			document.getElementById("sent").style.display='none';
			document.getElementById("trash").style.display='none';
			document.getElementById("bulk").style.display='none';
		}
		else if(value=="inbox")
		{
			document.getElementById("inbox").style.display="block";
			document.getElementById("sent").style.display="none";
			document.getElementById("compose").style.display='none';
			document.getElementById("Trash").style.display='none';
			document.getElementById("bulk").style.display='none';
			document.getElementById('inboxopendiv').value=value;
		}
		else if(value=="sent")
		{
			document.getElementById("sent").style.display="block";
			document.getElementById("inbox").style.display="none";
			document.getElementById("compose").style.display='none';
			document.getElementById("trash").style.display='none';
			document.getElementById("bulk").style.display='none';	
			document.getElementById('sentopendiv').value=value;		
		}
		else if(value=="trash")
		{
			document.getElementById("trash").style.display="block";
			document.getElementById("inbox").style.display="none";
			document.getElementById("compose").style.display='none';
			document.getElementById("sent").style.display='none'; 
			document.getElementById("bulk").style.display='none';	
			document.getElementById('trashopendiv').value=value;		
		}
        else if(value=="bulk")
		{
			document.getElementById("bulk").style.display="block";
			document.getElementById("trash").style.display="none";
			document.getElementById("inbox").style.display="none";
			document.getElementById("compose").style.display='none';
			document.getElementById("sent").style.display='none';
			document.getElementById('bulkopendiv').value;			
		}
}

function openDiv(id)
{
	document.getElementById(id).style.display='block';
}

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

function checkbox1() 
{
	//alert("test");
	var lengthcount=document.inbox.maxvalue2.value;
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++)
	{
	 var checkbox = "checkbox["+i+"]";
	 var dom = document.getElementById(checkbox);
		if(dom.checked==true)
		{
			checkedcount++;
		}
	}
	if(checkedcount < 1)
	    {
			alert("Select Atleast One Checkbox");
			return false;
		}
	if(confirm('Are you sure you want to Delete this Record?') )
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
	var result=checkbox1();
	if(result == false)
	{
		return false;
	}
	else
	{
	 document.forms["inbox"].submit();
	}
}
</script>

<script type="text/javascript">
function checkbox() 
{
	//alert("test");     
	var lengthcount=document.sent.maxvalue.value;
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var checklist = "checklist["+i+"]";
	 var dom = document.getElementById(checklist);
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
function compare1(){
 
	var result=checkbox();
	if(result == false) {
		return false;
	}
	else {
	
	 document.sent.submit();
	}
}
</script>

<script type="text/javascript">
function checkbox2() 
{
	//alert("test");     
	var lengthcount=document.trash.maxvalue3.value;
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var checklist = "checklist_tr["+i+"]";
	 var dom = document.getElementById(checklist);
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

function compare2()
{
	var result=checkbox2();
	if(result == false)
	 {
		return false;
	 }
	else
	 {
	 document.trash.submit();
	 }
}
</script>

<style type="text/css">

.alert_error {
display: block;
width: 95%;
margin: 20px 3% 0 3%;
margin-top: 40px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
background: #F3D9D9 url(images/icn_alert_error.png) no-repeat;
background-position: 10px 10px;
border: 1px solid #D20009;
color: #7B040F;
padding: 10px 0;
text-indent: 40px;
font-size: 14px;}

</style>

<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>
<?php if(isset($_REQUEST['del_succ'])) { ?>
		<h4 class="alert_error">Deleted Successfully</h4>
		<?php } ?>
<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<form name="inbox" method="post" action="" onsubmit="return compare();">
<input type="hidden" name="opendiv" id="inboxopendiv" value="" />
<div style="background-color:#29b1cb; height:30px;">
<b style="color:#FFFFFF; margin-left:12px; padding-top:10px; font-size:14px;"><?php echo $payment_history; ?></b></div>
<div>
		<?php
		
		   //echo "select * from orders where (user_id = '$session_user' and order_status=0) and payment_status=1 order by id desc";
		 
			$select="select * from orders where (user_id = '$session_user' and order_status=0) and payment_status=1 order by id desc";
			$strget="";
			$rowsPerPage = '10';
			$result=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con));
			$pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
			$count_msg=mysqli_num_rows(mysqli_query($con,$select));
		?>
	<table border="0" width="100%" style="margin-top:8px;">
	<?php if(isset($_REQUEST['deleted'])) { ?>
		<tr>
			<td colspan="4" align="center" style="color:#C55000">
				<b><?php echo $delete_success; ?>&nbsp;!</b>
			</td>
		</tr>
	<?php } ?>
	<?php if(isset($_REQUEST['success'])) { ?>
		<tr>
			<td colspan="4" align="center" style="color:#C55000">
				<b><?php echo $send_success; ?>&nbsp;!</b>
			</td>
		</tr>
	<?php } ?>
	<?php if($count_msg>0) 
			{ 
				$i=0;
			?>
	<!--	<th width="16%"><a href="#" onclick="javascript:SetAllCheckBoxes('inbox', 'checkbox[]', true)"><?php echo $sel; ?></a>&nbsp;/&nbsp;<a href="#" onclick="javascript:SetAllCheckBoxes('inbox', 'checkbox[]', false)"><?php echo $clear_all;  }?></a><?php  ?></th><!--  -->
	    <th width="13%"><?php echo "Order id"; ?></th>
		<th width="13%"><?php echo "Txn id"; ?></th>
		<th width="12%"><?php echo "Product Name"; ?></th>
		<th width="12%"><?php echo $amount; ?></th>
		<th width="16%"><?php echo "payment status"; ?></th>
		<th width="12%"><?php echo $date; ?></th>
		<th width="7%"><?php echo $view;?>/<?php echo $cancel; ?></th>
		
		<?php 
			if($count_msg>0)
			{
				$i=0;
				while($array_msg=mysqli_fetch_array($result))
				{
				$ussr=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$array_msg[user_post_id]'"));
				$product=mysqli_fetch_array(mysqli_query($con,"select * from tbl_seller where seller_id='$array_msg[product_id]'"));
				
		?>
		<tr>
			<td align="center"><?php echo $array_msg['order_id']; ?></td>
			<td align="center" style="line-height:30px;"><?php echo $array_msg['trans_id']; ?></td>
			<td align="center" style="line-height:30px;"><b><?php echo $product['seller_subject']; ?></b></a></td>
	        <td align="center" style="line-height:30px;"><?php echo $array_msg['net_amount']; ?>$</td>
			<td align="center" style="line-height:30px;">
			<?php if($array_msg['payment_status']=='1') { echo "Paid"; } else { echo "Pending"; } ?></td>
			<td align="center" style="line-height:30px;"><?php echo date("d-m-Y",strtotime($array_msg['date'])); ?></td>
		  <td align="center" style="line-height:30px;"><a href="trans_details.php?tid=<?php echo $array_msg['id']; ?>"><img src="images/view4.png" alt="View" title="View" style="width:17px; height:17px;"/></a>/<a href="payment_history.php?del=<?php echo $array_msg['order_id']; ?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }"><img src="images/close1.png" alt="delete" title="Delete" style="width:17px; height:17px;"/></a></td>
			
	</tr>
	<tr>
	<td colspan="8" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
	</tr>
	
	
		<?php $i++; } ?>
		<input type="hidden" value="<?php echo $i; ?>" name="maxvalue2" />
		<?php } else { ?>
		<tr>
       <td style="color:#C55000;" colspan="8" align="center"><b><?php echo $no_record; ?></b></td>

		</tr>
		<?php } ?>
		<!--<tr>
			<td align="left" colspan="8">
			<input type="hidden" name="checkval" />
			<?php if($count_msg>0) { ?>
			<input type="submit" value="<?php echo $delete; ?>" name="delete" class="search_bg" />
			<?php } ?>
			</td>
		</tr>-->
		<tr>
		<table><tr align="right"> 
   			<td  colspan="12" align="right" style="text-align:center; width:300px;"><div style="text-align:right; width:300px; padding-left:450px;"><?php echo  $pagingLink;?></div></td> 
    	</tr></table>
		<tr>
	</table>
	
</div>
</form>
</div>

</div></div>

</div>

<div class="body-cont4"> 

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