<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
	if(isset($_REQUEST['Submit_delete']))
	{
		$selected_friends = $_POST['check_list'];					
		foreach($selected_friends as $sel)
		{
			mysqli_query($con,"DELETE from `add_contacts` WHERE  `contact_id` = $sel");  			
		}  
		header("location:mycontacts.php?deleted"); 
	}
	
	if(isset($_REQUEST['sendmessage']))
	{
		$selected_friends = $_POST['check_list'];
		$i=0;
		$sel= implode(",",$selected_friends);			
		$_SESSION['checklisted']=$sel;	   
		header("location:compose_contact.php");
	}
?>
<script language="javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue) {
    //alert("test");
    if (!document.forms[FormName]) {
        return;
    }
    var objCheckBoxes = document.forms[FormName].elements[FieldName];

    if (!objCheckBoxes)
        return;
    var countCheckBoxes = objCheckBoxes.length;
    if (!countCheckBoxes) {
        objCheckBoxes.checked = CheckValue;
    } else {
        // set the check value for all check boxes
        for (var i = 0; i < countCheckBoxes; i++) {
            objCheckBoxes[i].checked = CheckValue;
        }
    }
}
</script>
<script language="javascript">
function checkbox_nn() {

    var lengthcount = document.contactlist.maxvalue.value;
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var check_list44 = "check_list[" + i + "]";
        var dom = document.getElementById(check_list44);
        if (dom.checked == true) {
            checkedcount++;
        }
    }
    if (checkedcount < 1) {
        alert("Select Atleast One Checkbox");
        return false;
    }
    if (confirm('Are you sure you want to Delete this Record?')) {

        return true;
    } else {
        return false;
    }
}

function compare() {

    if (document.contactlist.checkval.value == "") {
        alert('Select Atleast One Checkbox');
        return false;
    } else {
        if (confirm('Are you sure you want to Delete this Record?')) {
            return true;
        } else {
            return false;
        }
    }

}
</script>
<script type="text/javascript">
function checkbox_nnn() {

    var lengthcount = document.contactlist.maxvalue.value;
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var check_list44 = "check_list[" + i + "]";
        var dom = document.getElementById(check_list44);
        if (dom.checked == true) {
            checkedcount++;
        }
    }
    if (checkedcount < 1) {
        alert("Select Atleast One Checkbox");
        return false;
    }
}

function compare2() {

    if (document.contactlist.checkval.value == "") {
        alert('Select Atleast One Checkbox');
        return false;
    }
}
</script>
<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>
            <div class="body-right">

                <?php include("includes/menu.php"); ?>

                <div class="tabs-cont">
                    <div class="left">
                        <div class="bordersty">
                            <div class="headinggg"><?php echo $contact_list; ?></div>
                            <form name="contactlist" method="post" action="" onsubmit="return compare2();">
                                <table border="0" width="100%" style="margin-top:8px;">
                                    <?php if(isset($_REQUEST['updated'])) { ?>
                                    <tr>
                                        <td colspan="6" align="center" style="color:#C55000">
                                            <b><?php echo $update_success; ?>&nbsp;!</b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if(isset($_REQUEST['deleted'])) { ?>
                                    <tr>
                                        <td colspan="6" align="center" style="color:#C55000">
                                            <b><?php echo $delete_success; ?>&nbsp;!</b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if(isset($_REQUEST['delete'])) { ?>
                                    <tr>
                                        <td colspan="6" align="center" style="color:#C55000">
                                            <b><?php echo $delete_success; ?>&nbsp;!</b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if(isset($_REQUEST['added'])) { ?>
                                    <tr>
                                        <td colspan="6" align="center" style="color:#C55000">
                                            <b><?php echo $add_success; ?>&nbsp;!</b>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php 
if($_SESSION['language']=='english')
{
$select="select * from add_contacts where lang_status='0' and user_id='$session_user' and status!='1' ORDER BY contact_id DESC";
}
else if($_SESSION['language']=='french')
{
$select="select * from add_contacts where lang_status='1' and user_id='$session_user' and status!='1' ORDER BY contact_id DESC";
}
else
{
$select="select * from add_contacts where lang_status='2' and user_id='$session_user' and status!='1' ORDER BY contact_id DESC";
}
	//$select="select * from add_contacts where user_id='$session_user' and status!='1' ORDER BY contact_id DESC";
	$strget="";
	$rowsPerPage = '2';
	$result=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con));
	$pagingLink = getPagingLink1($select, $rowsPerPage,'olddiv=contactlist'); 
	$count=mysqli_num_rows(mysqli_query($con,$select));
	$i=0;
?>
                                    <?php if($count>0) { ?>
                                    <th width="16%"><a href="#"
                                            onClick="javascript:SetAllCheckBoxes('contactlist', 'check_list[]', true)"><?php echo $select_all; ?></a>&nbsp;/&nbsp;<a
                                            href="#"
                                            onClick="javascript:SetAllCheckBoxes('contactlist', 'check_list[]', false)"><?php echo $clear_all; ?></a><?php } ?>
                                    </th>
                                    <th width="20%"><?php echo $contact_name; ?></th>
                                    <th width="18%"><?php echo $company_name; ?></th>
                                    <th width="19%"><?php echo $type; ?></th>
                                    <th width="13%"><?php echo $country1; ?></th>
                                    <th width="14%">Option</th>
                                    <?php 
			if($count>0)
			{
				while($array=mysqli_fetch_array($result))
				{
					$id=$array['contact_id'];
		?>
                                    <tr>
                                        <td align="center"><input type="checkbox" name="check_list[]"
                                                value="<?PHP echo $array['contact_id']; ?>"
                                                id="check_list[<?PHP echo $i;?>]"
                                                onclick="javascript:document.contactlist.checkval.value=1;"
                                                style="line-height:25px;" /></td>
                                        <td align="center" style="line-height:30px;"><a
                                                href="viewcontact.php?view=<?php echo $id; ?>"><?php echo $array['firstname']; ?></a>
                                        </td>
                                        <td align="center" style="line-height:30px;">
                                            <?php echo $array['companyname']; ?></td>
                                        <td align="center" style="line-height:30px;">
                                            <?php echo $array['bussiness_type']; ?></td>
                                        <td align="center" style="line-height:30px;"><?php $con=$array['country'];
				$sel=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$con' "));
				echo $sel['country_name'];
			 ?></td>
                                        <td align="center" style="line-height:30px;"><a
                                                href="mycontacts_edit.php?contact_id=<?php echo $array['contact_id']; ?>"><img
                                                    src="images/1360413790_pencilangled.png" width="20"
                                                    height="15" /></a></td>
                                    </tr>
                                    <?php $i++; } ?>
                                    <?php } else { ?>
                                    <tr>
                                        <td>
                                        <td style="color:#C55000;" align="center" colspan="3"><b>
                                                <? echo $no_record; ?></b></td>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td align="center">
                                            <input type="hidden" name="checkval" />
                                            <?php if($count>0) { ?>
                                            <input name="Submit_delete" type="submit" class="search_bg"
                                                onclick="javascript:return compare();" value="<? echo $delete; ?>" />
                                        </td>
                                        <td align="center"><input type="submit" class="search_bg" name="sendmessage"
                                                value="<? echo $message; ?>" onclick="javascript:return compare2();" />
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <table>
                                            <tr align="right">
                                                <td colspan="12" align="right" style="text-align:center; width:300px;">
                                                    <div style="text-align:right; width:300px; padding-left:450px;">
                                                        <?php echo  $pagingLink;?></div>
                                                </td>
                                            </tr>
                                        </table>
                                    <tr>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>

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