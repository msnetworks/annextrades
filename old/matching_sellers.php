<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
	date('F j, Y');
	$lastthreedate=date('F j, Y', strtotime("-3 day"));
?>
<script type="text/javascript">
function seller() {
    if (document.matchingsell.keyword.value == "") {
        alert("Please Select The Keyword");
        document.matchingsell.keyword.focus();
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
                            <div class="headinggg"><?php echo $matching_sellers; ?></b></div>
                            <form id="matchingsell" name="matchingsell" method="post" action=""
                                onSubmit="return seller();">
                                <table border="0" width="100%" style="padding-bottom:20px;">
                                    <tr>
                                        <td colspan="3" style="color:#155A8A"><?php echo $search_optionn; ?>.</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="padding-left:120px; line-height:30px;">
                                            <?php echo $country1;  ?></td>
                                        <td width="2%" style="line-height:30px;">:</td>
                                        <td width="73%" style="line-height:30px;"><select
                                                style="width:200px; height:20px;" name="country">
                                                <option value=""><?php echo $sel_con; ?></option>
                                                <?php 
				$select=mysqli_query($con,"select * from country");
				while($con=mysqli_fetch_array($select))
				{
			?>
                                                <option value="<?php echo $con['country_id']; ?>">
                                                    <?php echo $con['country_name']; ?></option>
                                                <?php } ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="padding-left:120px; line-height:30px;">
                                            <?php echo $time_posted; ?></td>
                                        <td style="line-height:30px;">:</td>
                                        <td style="line-height:30px;"><select name="timeposted" id="timeposted">
                                                <option value="" <?php if($_REQUEST['timeposted']=="") { ?>
                                                    selected="selected" <?php } ?>><?php echo $sel; ?></option>
                                                <option value="1" <?php if($_REQUEST['timeposted']=="1") { ?>
                                                    selected="selected" <?php } ?>><?php echo $today; ?></option>
                                                <option value="3" <?php if($_REQUEST['timeposted']=="3") { ?>
                                                    selected="selected" <?php } ?>><?php echo $last3; ?></option>
                                                <option value="5" <?php if($_REQUEST['timeposted']=="5") { ?>
                                                    selected="selected" <?php } ?>><?php echo $last5; ?></option>
                                                <option value="7" <?php if($_REQUEST['timeposted']=="7") { ?>
                                                    selected="selected" <?php } ?>><?php echo $last7; ?></option>
                                                <option value="10" <?php if($_REQUEST['timeposted']=="10") { ?>
                                                    selected="selected" <?php } ?>><?php echo $last10; ?></option>
                                                <option value="30" <?php if($_REQUEST['timeposted']=="30") { ?>
                                                    selected="selected" <?php } ?>><?php  echo $last30; ?></option>
                                                <option value="60" <?php if($_REQUEST['timeposted']=="60") { ?>
                                                    selected="selected" <?php } ?>><?php echo $last_2months; ?></option>
                                                <option value="180" <?php if($_REQUEST['timeposted']=="180") { ?>
                                                    selected="selected" <?php } ?>><?php echo $last_6months; ?></option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="padding-left:120px; line-height:30px;">
                                            <?php echo $keywords; ?></td>
                                        <td style="line-height:30px;">:</td>
                                        <td style="line-height:30px;"><select name="keyword">
                                                <option value=""><?php echo $sel; ?></option>
                                                <?php 
				$sql=mysqli_query($con,"select * from trade_alert where user_id='$session_user' ");
				while($sel_qry=mysqli_fetch_array($sql))
				{
			?>
                                                <option value="<?php echo $sel_qry['keyword']; ?>"
                                                    <?php if($_REQUEST['keyword'] == $sel_qry['keyword']) { ?>
                                                    selected="selected" <?php } ?>><?php echo $sel_qry['keyword']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>&nbsp;&nbsp;<a
                                                href="trade.php"><?php echo $clicl_to_more_key; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><input name="matsellers" class="search_bg"
                                                type="submit" id="matsellers" value="<?php echo $search; ?>"
                                                style="margin-top:20px; margin-bottom:20px;" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center">
                                            <table width="70%"
                                                style="border:1px solid #999999;width:550px;background-color:#CFF5FC; padding-bottom:10px;">
                                                <tr>
                                                    <td width="46%" align="center"><?php echo $subject; ?></td>
                                                    <td width="25%"><?php echo $country1; ?></td>
                                                    <td width="29%"><?php echo $date; ?></td>
                                                </tr>
                                                <?php 
					if(isset($_REQUEST['matsellers']))
					{
						$country=$_REQUEST['country'];
						$date=date("F j, Y");
						$lastthreedate=date('F j, Y', strtotime("-3 day"));
						$lastfivedate=date('F j, Y', strtotime("-5 day"));
						$lastsevendate=date('F j, Y', strtotime("-7 day"));
						$lasttendate=date('F j, Y', strtotime("-10 day"));
						$lastthirtydate=date('F j, Y', strtotime("-30 day"));
						$lasttwomonthdate=date('F j, Y', strtotime("-2 month"));
						$lastsixmonthdate=date('F j, Y', strtotime("-6 month"));
						$timeposted=$_REQUEST['timeposted'];
						$keyword=$_REQUEST['keyword'];
						
						$str="";
						
						if($country!="")
						{
						if($str!="")
						{
						$temp=" and ";
						}
						$str.= $temp."seller_country LIKE '%$country%'";
						}
						
						if($timeposted!="")
						{
						if($timeposted =='1')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$date' and seller_updated_date <= '$date'";
						}
						if($timeposted =='3')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$lastthreedate' and seller_updated_date <= '$date'";
						}
						if($timeposted =='5')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$lastfivedate' and seller_updated_date <= '$date'";
						}
						if($timeposted =='7')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$lastsevendate' and seller_updated_date <= '$date'";
						}
						if($timeposted =='10')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$lasttendate' and seller_updated_date <= '$date'";
						}
						if($timeposted =='30')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$lastthirtydate' and seller_updated_date <= '$date'";
						}
						if($timeposted =='60')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$lasttwomonthdate' and seller_updated_date <= '$date'";
						}
						if($timeposted =='180')
						{
							if($str!="")
							{
							 $temp=" and ";
							}
							$str.= $temp."seller_updated_date >='$lastsixmonthdate' and seller_updated_date <= '$date'";
						}
						}
						if($keyword!="")
						{
						if($str!="")
						{
						$temp=" and ";
						}
						$str.= $temp."seller_subject LIKE '%$keyword%' or seller_keyword LIKE '%$keyword%'";
						}
						
						if($str != "")
						{
						
						//echo "SELECT * FROM `tbl_seller` WHERE $str";
						
						$sql = "SELECT * FROM `tbl_seller` WHERE $str"; 
						
						}
					}
					$sellers=mysqli_query($con,$sql);	  
					$sellercnt=mysqli_num_rows($sellers);
					if($sellercnt > 0) 
					{
						while($sellres=mysqli_fetch_array($sellers))
						{
							$selid=$sellres['seller_id'];
				?>
                                                <tr>
                                                    <td colspan="1" align="center"><a
                                                            href="companyinfo.php?id=<?php echo $selid; ?>">
                                                            <?PHP echo $sellres['seller_subject'];?></a></td>
                                                    <td>
                                                        <?php 
							$ccode=$sellres['seller_country'];
							$cty=mysqli_fetch_array(mysqli_query($con,"select * from country where country_id='$ccode'"));
							echo $ctyres=$cty['country_name'];
						?>
                                                    </td>
                                                    <td>
                                                        <?PHP echo $sellres['seller_updated_date'];?>
                                                    </td>
                                                </tr>
                                                <?php } } else { ?>
                                                <tr>
                                                    <td colspan="3" align="center" style="color:#FF0000;">
                                                        <b><?php echo $no_record; ?></b></td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </td>
                                    </tr>
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