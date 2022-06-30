<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	
	if(isset($_REQUEST['Submit_trash']))
	{
		$selected_friends = $_POST['checklist_tr']; 
		foreach($selected_friends as $sel)
		{     
			$delquery=mysqli_fetch_array(mysqli_query($con,"select * from `messages` where id='$sel'"));
			$tostatus=$delquery['tostatus'];
   			$fromstatus=$delquery['fromstatus'];
			$dqry=mysqli_query($con,"DELETE from `messages` WHERE  `id` ='$sel'");  
		}   
		header("location:trash.php?tras"); 
	}
?>

<script language="javascript">
function show(value) {

    if (value == "compose") {
        //alert("hai");
        document.getElementById("compose").style.display = 'block';
        document.getElementById("inbox").style.display = 'none';
        document.getElementById("sent").style.display = 'none';
        document.getElementById("trash").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';

    } else if (value == "inbox") {
        document.getElementById("inbox").style.display = "block";
        document.getElementById("sent").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("Trash").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';
        document.getElementById('inboxopendiv').value = value;

    } else if (value == "sent") {
        document.getElementById("sent").style.display = "block";
        document.getElementById("inbox").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("trash").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';
        document.getElementById('sentopendiv').value = value;
    } else if (value == "trash") {
        document.getElementById("trash").style.display = "block";
        document.getElementById("inbox").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("sent").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';
        document.getElementById('trashopendiv').value = value;
    } else if (value == "bulk") {
        document.getElementById("bulk").style.display = "block";
        document.getElementById("trash").style.display = "none";
        document.getElementById("inbox").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("sent").style.display = 'none';
        document.getElementById('bulkopendiv').value;
    }


}

function openDiv(id) {
    document.getElementById(id).style.display = 'block';
}
</script>

<script language="javascript" type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue) {
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

function checkbox1() {

    var lengthcount = document.inbox.maxvalue.value;
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var checkbox = "checkbox[" + i + "]";
        var dom = document.getElementById(checkbox);
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
    if (document.inbox.checkval.value == "") {
        alert('Select Atleast One Checkbox');
        return false;
    } else {
        if (confirm('Are you sure you want to Delete this Record?')) {
            return true;
        } else {
            return false;
        }
    }
    //var result=checkbox1();
    //if(result == false)
    //{
    //	return false;
    //}
    //else
    //{
    // document.inbox.submit();
    //}
}
</script>

<script type="text/javascript">
function checkbox2() {

    var lengthcount = document.trash.maxvalue3.value;
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var checklist = "checklist_tr[" + i + "]";
        var dom = document.getElementById(checklist);
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

/*function compare2()
{
  	if(document.trash.checkval2.value=="")
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
}*/

function compare2() {
    var result = checkbox2();
    if (result == false) {
        return false;
    } else {
        //document.trash.submit();
        document.forms["trash"].submit();
    }
}
</script>

<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>
            <div class="body-right">

                <?php include("includes/menu.php"); ?>

                <!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
                <div class="tabs-cont">
                    <div class="left">
                        <div style="border:1px solid #F0EFF0;" class="bordersty">
                            <form action="" method="post" name="trash" id="trash" onsubmit="return compare2();">
                                <input type="hidden" name="opendiv" id="trashopendiv" value="" />
                                <div class="headinggg"><?php echo $trash_items; ?>
                                </div>
                                <div>
                                    <?php 
			$sql_r=mysqli_query($con,"select * from registration where id='$session_user'"); 
			$count_r=mysqli_num_rows($sql_r);
			$array_r=mysqli_fetch_array($sql_r);
			$em=$array_r['email']; 
			
			$select="select * from `messages` where  (tostatus='1' or fromstatus=1)  and (to_mail='$em' or from_mail='$em')";
			
			$strget="";
			$rowsPerPage = '5';
			$result=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con));
			$pagingLink = getPagingLink1($select, $rowsPerPage,'olddiv=sent'); 
			$count_msg=mysqli_num_rows(mysqli_query($con,$select));
			$i=0;
		?>
                                    <table border="0" width="100%" style="margin-top:8px;">
                                        <?php if(isset($_REQUEST['tras'])) { ?>
                                        <tr>
                                            <td colspan="5" align="center" style="color:#C55000">
                                                <b><?php echo $delete_success; ?>&nbsp;!</b>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php if($count_msg>0) 
			{ 
			?>
                                        <th width="23%"><a href="#" class="topics"
                                                onclick="javascript:SetAllCheckBoxes('trash','checklist_tr[]',true)"><?php echo $select_all; ?></a>&nbsp;/&nbsp;<a
                                                href="#" class="topics"
                                                onclick="javascript:SetAllCheckBoxes('trash','checklist_tr[]',false)"><?php echo $clear_all; ?></a><?php } ?>
                                        </th>
                                        <th><?php echo $from; ?></th>
                                        <th width="29%"><?php echo $sender; ?></th>
                                        <th width="25%"><?php echo $subject; ?></th>
                                        <th width="23%"><?php echo $date; ?></th>
                                        <?php 
			if($count_msg>0)
			{
				$i=0;
				while($array_msg=mysqli_fetch_array($result))
				{
		?>
                                        <tr>
                                            <td align="center"><input type="checkbox" name="checklist_tr[]"
                                                    value="<?php echo $array_msg['id']; ?>"
                                                    id="checklist_tr[<?php echo $i; ?>]" style="line-height:25px;" />
                                            </td>
                                            <td align="center" style="line-height:30px;">
                                                <?php echo $array_msg['from_mail']; ?></td>
                                            <td align="center" style="line-height:30px;">
                                                <?php echo $array_msg['to_mail']; ?></td>
                                            <td align="center" style="line-height:30px;"><a
                                                    href="trash_view.php?view=<?php echo $array_msg['id']; ?>"><b><?php echo $array_msg['subject']; ?></b></a>
                                            </td>
                                            <td align="center" style="line-height:30px;">
                                                <?php echo $array_msg['date']; ?></td>
                                        </tr>
                                        <?php $i++; } ?>
                                        <input type="hidden" value="<?php echo $i; ?>" name="maxvalue3" />
                                        <?php } else { ?>
                                        <tr>
                                            <td style="color:#C55000;" align="center" colspan="4">
                                                <b><?php echo $no_record; ?></b></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td align="center">
                                                <?php if($count_msg>0) { ?>
                                                <input type="submit" class="search_bg" name="Submit_trash"
                                                    value="<?php echo $delete; ?>" />
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <table>
                                                <tr align="right">
                                                    <td colspan="12" align="right"
                                                        style="text-align:center; width:300px;">
                                                        <div style="text-align:right; width:300px; padding-left:450px;">
                                                            <?php echo  $pagingLink;?></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        <tr>
                                    </table>

                                </div>
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