<?php 
include("includes/header.php");
$id=$_REQUEST['id'];
//$sess_id=$_SESSION['sess_id']; 
$id=$_REQUEST['id'];


$queryselect=mysqli_query($con,"SELECT * FROM photo where userid='$session_user' order by id desc");
$count=mysqli_num_rows($queryselect);
//$queryselect1=mysqli_query($con,"SELECT * FROM `photo` where pid='$gid'and userid=''$sess_id");
//$fetchrow1=mysqli_fetch_array($queryselect1);


                 if(isset($_REQUEST['sub']))
				    {
					  print_r($_POST);
				      $selected_friends = $_POST['check_list'];
					  
					   
					    foreach($selected_friends as $sel)
					     { echo $sel;
						   echo "<br>";
						   echo "DELETE FROM `photo` WHERE `id` = '$sel' and userid='$session_user'";
						   mysqli_query($con,"DELETE FROM `photo` WHERE `id` = '$sel' and `userid`='$session_user'"); 
						 
						 }   
						header("location:mng_ProPhotos.php"); 
					}
 ?>
<link href="lightbox.css" rel="stylesheet" type="text/css" />
<link href="lightbox1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="lightbox.js"></script>
<script language="javascript">
function uppho() {
    window.location.href = "mng_uploadphoto.php";
}
</script>
<script language="javascript" type="text/javascript">
function checkbox() {
    var lengthcount = document.frmaction.maxvalue.value;
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var check_list = "check_list[" + i + "]";
        var dom = document.getElementById(check_list);
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

    var result = checkbox();
    if (result == false) {
        return false;
    } else {

        document.frmaction.submit();
    }
}



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
                    <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
                        <div class="bordersty">
                            <div class="headinggg"><?php echo $manage_prophotos; ?></div>
                            <!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <form name="formform" action="" method="post">
                                    <tr>
                                        <td height="40">
                                            <div align="right">
                                                <label>
                                                    <a href="mng_uploadphoto.php" class="bluebold">
                                                        <strong><?php echo $upload_image; ?></strong>
                                                    </a>

                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                                <?php
					$queryselect=mysqli_query($con,"SELECT * FROM photo where userid='$session_user' order by id desc");
$count=mysqli_num_rows($queryselect);
					?>
                                <tr>
                                    <td height="30" class="blackBo">&nbsp;&nbsp;<strong><?php echo $your_photos; ?>
                                            <?PHP echo $count;?> <?php echo $photos; ?></strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <form name="frmaction" action="" method="post" onsubmit="return compare();">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <?php if($count > 0) { ?>
                                                <tr>
                                                    <td height="30">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="22%">&nbsp;&nbsp;<a href="#"
                                                                        onclick="javascript:SetAllCheckBoxes('frmaction', 'check_list[]', true)"><?php echo $select_all; ?></a><a
                                                                        href="#" class="topics"
                                                                        onclick="javascript:SetAllCheckBoxes('frmaction', 'check_list[]', true)"></a>
                                                                    &nbsp;/&nbsp; <a href="#"
                                                                        onclick="javascript:SetAllCheckBoxes('frmaction', 'check_list[]', false)"><?php echo $clear_all; ?></a><a
                                                                        href="#" class="topics"
                                                                        onclick="javascript:SetAllCheckBoxes('frmaction', 'check_list[]', false)"></a>
                                                                </td>
                                                                <td width="14%"><input type="submit" class="search_bg"
                                                                        name="sub" value="Delete" /></td>
                                                                <td width="41%"><a href="#"></a></td>
                                                                <td width="23%">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td>
                                                                    <table width="100%" border="0" cellspacing="2"
                                                                        cellpadding="0" style="padding:2px; ">
                                                                        <tr>

                                                                            <td width="25%" class="blackBo" height="25"
                                                                                style="padding-left:5px;" colspan="2"
                                                                                align="center">
                                                                                <strong><?php echo $photos; ?></strong>
                                                                            </td>
                                                                            <td width="25%" class="blackBo"
                                                                                style="padding-left:5px;"
                                                                                align="center">
                                                                                <strong><?php echo $photo_name; ?></strong>
                                                                            </td>
                                                                            <td width="25%" class="blackBo"
                                                                                style="padding-left:5px;"
                                                                                align="center">
                                                                                <strong><?php echo $size; ?></strong>
                                                                            </td>
                                                                            <td width="25%" class="blackBo"
                                                                                style="padding-left:5px;"
                                                                                align="center">
                                                                                <strong><?php echo $update_date; ?></strong>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <table width="100%" border="0" cellspacing="0"
                                                                        cellpadding="0">
                                                                        <?PHP 
							$select="SELECT * FROM photo where userid='$session_user' order by id desc";
							$strget="";
							$rowsPerPage =5;
							$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
							$pagingLink = getPagingLink($select, $rowsPerPage,$strget);  
							$i=0;
						 $co=mysqli_num_rows(mysqli_query($con,$select));
						 if($co>0)
						 {
					  while($fetchrow=mysqli_fetch_array($query))
							     {
								 if($fetchrow['photo']!='img_noimg.jpg') 
								 {
								?>

                                                                        <tr>
                                                                            <td>
                                                                                <table width="100%" border="0"
                                                                                    cellspacing="2" cellpadding="0">
                                                                                    <tr>
                                                                                        <td width="4%" height="22"
                                                                                            valign="top"><label>
                                                                                                <input type="checkbox"
                                                                                                    name="check_list[]"
                                                                                                    value="<?PHP echo $fetchrow['id'];?>"
                                                                                                    id="check_list[<?PHP echo $i;?>]" />
                                                                                            </label></td>
                                                                                        <td width="21%" align="center">
                                                                                            <a href="<?PHP echo "
                                                                                                productlogo/".$fetchrow['photo'];?>"
                                                                                                rel="lightbox"
                                                                                                class="greevbold"><img
                                                                                                    src="<?PHP echo "
                                                                                                    blog_photo_thumbnail/".$fetchrow['photo'];?>"
                                                                                                    width="98"
                                                                                                    height="86"
                                                                                                    border="0" /></a>
                                                                                        </td>
                                                                                        <td width="26%" align="center">
                                                                                            <?PHP echo $fetchrow['photo'];?>
                                                                                        </td>
                                                                                        <td width="25%" align="center">
                                                                                            <?PHP echo number_format(($fetchrow['size']/1024),0) ."  " . "Kb";?>
                                                                                        </td>
                                                                                        <td width="24%" align="center">
                                                                                            <?PHP echo $fetchrow['pdate'];?>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <?PHP $i++;} }
						  ?>
                                                                        <input type="hidden" value="<?PHP echo $i; ?>"
                                                                            name="maxvalue" />
                                                                        <?php } else
						  {
						  ?>
                                                                        <tr>
                                                                            <td align="center"><span
                                                                                    class="redbold"><?php echo $mng_ProPhotos_nproph;?></span>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
												  }?>
                                                                        <!-- <tr>
                            <td class="inbgAinn"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="5%" height="22"><label>
                                  <input type="checkbox" name="checkbox" value="checkbox" />
                                </label></td>
                                <td width="18%"><img src="images/logo_in.jpg" width="98" height="86" /></td>
                                <td width="31%"> absolutely-innocent-princes</td>
                                <td width="11%">89484</td>
                                <td width="20%">jpg(768x1024)</td>
                                <td width="15%">2008.03.16</td>
                                </tr>
                            </table></td>
                          </tr>-->
                                                                        <!--<tr>
                            <td class="inbgAinn"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="5%" height="22"><label>
                                  <input type="checkbox" name="checkbox" value="checkbox" />
                                </label></td>
                                <td width="18%"><img src="images/logo_in.jpg" width="98" height="86" /></td>
                                <td width="31%"> absolutely-innocent-princes</td>
                                <td width="11%">89484</td>
                                <td width="20%">jpg(768x1024)</td>
                                <td width="15%">2008.03.16</td>
                                </tr>
                            </table></td>
                          </tr>-->
                                                                        <!--<tr>
                            <td class="inbgAinn"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="5%" height="22"><label>
                                  <input type="checkbox" name="checkbox" value="checkbox" />
                                </label></td>
                                <td width="18%"><img src="images/logo_in.jpg" width="98" height="86" /></td>
                                <td width="31%"> absolutely-innocent-princes</td>
                                <td width="11%">89484</td>
                                <td width="20%">jpg(768x1024)</td>
                                <td width="15%">2008.03.16</td>
                                </tr>
                            </table></td>
                          </tr>-->
                                                                        <!--<tr>
                            <td class="inbgAinn"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="5%" height="22"><label>
                                  <input type="checkbox" name="checkbox" value="checkbox" />
                                </label></td>
                                <td width="18%"><img src="images/logo_in.jpg" width="98" height="86" /></td>
                                <td width="31%"> absolutely-innocent-princes</td>
                                <td width="11%">89484</td>
                                <td width="20%">jpg(768x1024)</td>
                                <td width="15%">2008.03.16</td>
                                </tr>
                            </table></td>
                          </tr>-->
                                                                        <tr>
                                                                            <td align="center" height="25">
                                                                                <?PHP echo $pagingLink;
     echo "<br>";?>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                                </tr>
                            </table>



                            <div>


                            </div>



                        </div>







                    </div>
                </div>





            </div>



        </div>


    </div>


</div>

<?php include("includes/footer.php"); ?>

<?PHP
 function getPagingQuery($sql, $itemPerPage = 10)
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
function getPagingLink($sql, $itemPerPage = 5,$strGet)
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
	
	if(empty($pagingLink)) { $pagingLink="<font color='#CCCCCC'>  First | Prev | 1 | 2 | 3 | Next | Last </font>"; }
	return $pagingLink;
}
 ?>