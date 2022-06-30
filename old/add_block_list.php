<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
?>
<script language="javascript">
function ValidateForm123() {
    var email123 = document.addblocklist.contactmail.value;
    var country = document.addblocklist.country.value;

    if ((document.addblocklist.sel_option[0].checked == false) && (document.addblocklist.sel_option[1].checked ==
            false)) {
        alert("Please Select Whether You Want To Block By Email Or By Country ");
        document.addblocklist.sel_option[0].focus();
        return false;
    }
    if ((email123 == "") && (document.addblocklist.sel_option[0].checked == true)) {
        alert("Please Enter the Email-ID ");
        document.addblocklist.contactmail.focus();
        return false;
    }

    if (email123 != "") {
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email123))) {
            alert("Please Enter A Valid Email");
            document.addblocklist.email123.focus();
            return false;
        }
    }

    if ((country == "") && (document.addblocklist.sel_option[1].checked == true)) {
        alert("Please Select the Country ");
        document.addblocklist.country.focus();
        return false
    }
    return true;
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
                            <div class="headinggg"><?php echo $add_block_list; ?></div>
                            <?php 
	if(isset($_REQUEST['submit']))
	{
		$date=date('Y-m-d');
		$contactmail=$_REQUEST['contactmail'];
		$country=$_REQUEST['country'];
		$block_reason=$_REQUEST['txtdesc'];
		$select=mysqli_query($con,"select * from add_contacts where (contact_mail='$contactmail' or country='$country' ) and user_id='$session_user' ");
		$count=mysqli_num_rows($select);
		if($count>0)
		{
			//echo "update `add_contacts` set `status`='1', `dates`='$date',`block_reason`='$block_reason' where `contact_mail`='$contactmail' or `country`='$country' and `user_id`='$session_user'"; exit;
			
			$res=mysqli_query($con,"update `add_contacts` set `status`='1', `dates`='$date',`block_reason`='$block_reason' where `contact_mail`='$contactmail' or `country`='$country' and `user_id`='$session_user' ");
			header("location:myblocklist.php?blocked");
		}
		else
		{
			header("location:add_block_list.php?err=1");
		}
	}
?>
                            <form name="addblocklist" method="post" action="" onsubmit="return ValidateForm123();">
                                <div class="p-2">

                                    <?php if(isset($_REQUEST['err'])) { ?>
                                    <div class="input-group">
                                        <?php echo $conntact_error; ?>&nbsp;!
                                    </div>
                                    <?php } ?>
                                    <div class="input-group">
                                        <h6><?php echo $email_add; ?></h6>
                                        <input type="text" name="contactmail" id="email123">
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $country1; ?></h6>
                                        <select name="country">
                                            <option value=""><?php echo $sel_con; ?></option>
                                            <?php 
				$select=mysqli_query($con,"select * from country");
				while($con=mysqli_fetch_array($select))
				{
			?>
                                            <option value="<?php echo $con['country_id']; ?>">
                                                <?php echo $con['country_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $description; ?></h6>
                                        <textarea name="txtdesc" rows="5" cols="60"></textarea>
                                    </div>
                                    <div class="input-group">
                                        <div><?php echo $note1; ?>,<br />
                                            <?php echo $note2; ?>.</div>
                                    </div>
                                    <div class="input-group"><input type="submit" name="submit" class="search_bg"
                                            value="<?php echo $submit; ?>" />
                                    </div>
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