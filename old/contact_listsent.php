<?php 
	include "db-connect/notfound.php";
	session_start();
	$session_user=$_SESSION['user_login'];
	
	$_SESSION['language'] = 'english';
include("language/".$_SESSION['language']."/language.php");
	
	if(isset($_REQUEST['Insert']))
	{
		$selected_friends = $_POST['check_list'];
		$i=0;
		$sel= implode(",",$selected_friends);			
		$_SESSION['checklistid']=$sel;	   
		echo"<script language='javascript'>
		opener.location='sent_compose.php?comp=$_REQUEST[comp]'
        self.close();
	    </script>";

	}
?>
<style type="text/css">
.head_new
{
background-color:#29B1CB; 
color:#FFFFFF;
height:25px;
padding-top:3px;
padding-left:10px;
}
a
{
text-decoration:none;
color:#005F8C;
}
a:hover
{
color:#000;
}
#insert_btn
{
border:none;
background-color:#01B0D6;
margin-left:10px;
width:85px;
height:25px;
cursor:pointer;
}
#insert_btn:hover
{
color:#FFFFFF;
}
</style>
<script type="text/javascript">

function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
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

function checkbox() {
     //alert("dfbjsdhfj");
	var lengthcount=document.contact_list.maxvalue.value;
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var checklist = "check_list["+i+"]";
	 var dom = document.getElementById(checklist);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	
	//alert(checkedcount);
	
	if(checkedcount < 1) {
			alert("Select Atleast One Checkbox");
			return false;
		}
	
}
function compare1(){
 	//alert("test");
	var result=checkbox();
	if(result == false) {
		return false;
	}
	else {
	
	 document.contact_list.submit();
	}
}

</script>
<div style="border:1px solid #CCCCCC;" class="bordersty">
		<div class="head_new"><b><?php echo $contact_list; ?></b></div>
		<form id="form2" name="contact_list" method="post" action="" onsubmit="return compare1();">
		<input type="hidden" name="opendiv" id="contactlistopendiv" value=""/>
	<table border="0" width="95%"  cellpadding="2" cellspacing="0" style="margin-top:8px;" align="center">
		<tr bgcolor="#97DDFF" height="30" >
		<th width="183" style="border-top-left-radius:10px;"><a href="#" class="bTxtM2" onclick="javascript:SetAllCheckBoxes('contact_list', 'check_list[]', true)"><?php echo $select_all; ?></a>&nbsp;/&nbsp;<a href="#" class="bTxtM2" onClick="javascript:SetAllCheckBoxes('contact_list', 'check_list[]', false)" ><?php echo $clear_all; ?></a></th>
		<th width="234"><?php echo $contact_name; ?></th>
		<th width="223"><?php echo $company_name; ?></th>
		<th width="173"><?php echo $type; ?></th>
		<th width="138" style="border-top-right-radius:10px;"><?php echo $country1; ?></th>
        </tr>
		<?php
			//echo "select * from add_contacts where status='0' and user_id='$session_user'"; exit;
			$select="select * from `add_contacts` where user_id='$session_user' ";
			$strget="";
			$rowsPerPage = '5';
			$query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
			$pagingLink = getPagingLink1($select, $rowsPerPage,'olddiv=contactlist'); 
			
			$num_rows=mysqli_num_rows(mysqli_query($con,$select)); 
			$i=0;
			 /*$query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
			$pagingLink = getPagingLink1($select, $rowsPerPage,'olddiv=contactlist'); */
			/*$count=mysqli_num_rows($select);*/
			//$query=mysqli_query($con,$select);
			//$i=0;
			if($num_rows>0)
			{ //echo "fsdkfjkas";			
				while($array=mysqli_fetch_array($query))
				{
		?>			
		<tr  height="25" >
			
			<td align="center" style="border-left:solid 1px #97DDFF;"><input type="checkbox"  name="check_list[]" value="<?PHP echo $array['contact_id']; ?>" id="check_list[<?PHP echo $i;?>]"/></td>
			<td align="center" style="line-height:30px;"><?php echo $array['firstname']; ?></td>
			<td align="center" style="line-height:30px;"><?php echo $array['companyname']; ?></td>
			<td align="center" style="line-height:30px;"><?php echo $array['bussiness_type']; ?></td>
			<?php 
				$country = $array['country'];  
				$sql_rr=mysqli_query($con,"select * from `country` where  country_id='$country'");   							                $row = mysqli_fetch_array($sql_rr); 
			?>
			<td align="center" style="line-height:30px;border-right:solid 1px #97DDFF;"><?php echo $row['country_name'];  ?></td>
		</tr>
		<tr height="5" bgcolor="#97DDFF">
        <td colspan="5"></td> 
        </tr>
        
        
			<?php
				$i++; 
				}
			?>
			<input type="hidden" value="<?PHP echo $i; ?>" name="maxvalue" />
			<?php 
				}
				else 
				{
			?>
						<tr><td colspan="6" align="center" class="inTxtSHead"><strong class="inTxtHead"><b style="color:#C55000"><?php echo $no_record; ?></b></strong></font> </td>
						</tr> <?php } ?><tr><td colspan="6" align="center" class="more"><?PHP echo $pagingLink;
     echo "<br>";?></td></tr>

	</table>
	<table>
		<tr>
			<td></td>
			<td></td>
			<td>
			<?php if($num_rows>0) { ?>
			<input type="submit" class="search_bg" name="Insert" id="insert_btn" value="<?php echo $Insert; ?>" />
			<?php } ?>
			</td>
		</tr>
	</table>
	</form>
</div>

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