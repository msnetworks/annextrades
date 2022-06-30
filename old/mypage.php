<?php include("includes/header.php");

if($session_user=="")
{

header("location:login.php");

}

//print_r($_REQUEST['property']);

 ?>

<script type="text/javascript">
function searchlist(id) {
    var currentDiv;
    currentDiv = document.getElementById(id);
    if (currentDiv != null) {
        currentDiv.style.display = 'none';
    } else {
        currentDiv.style.display = 'block';
    }
}

function checkbox() {
    //alert("hai");
    var lengthcount = document.searching.maxvalue.value;
    //alert(lengthcount);
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var property = "property[" + i + "]";

        var dom = document.getElementById(property); //alert(dom);
        if (dom.checked == true) {
            checkedcount++;
        }
    }

    if (checkedcount < 1) {
        alert("Select Atleast One product");
        return false;
    } else if (checkedcount > 3) {
        alert("Select Maximum Three Products Only ");
        return false;
    }
}

function compare() {
    //alert("hai");
    var result = checkbox();
    if (result == false) {
        return false;
    } else {

        document.searching.submit();
    }
}

function comp() {
    document.searching.Submit.readOnly = false;
}

function checking() {
    alert("You can't add contact to your Own Product");
}
</script>


<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <div class="body-leftcont">
                <div class="cate-cont">
                    <div class="cate-heading"> <?php echo $browse; ?></div>
                    <?php include("includes/sidebar.php"); ?>



                </div>

                <?php include("includes/innerside1.php"); ?>
            </div>





            <div class="body-right">

                <?php include("includes/menu.php"); ?>

                <div class="products-cate-cont">

                    <div class="products-cate-heading"><?php echo $my_page; ?></div>
                    <div style="border: solid 1px #CFCFCF;">

                        <link href="css/contentslider.css" rel="stylesheet" type="text/css" />
                        <script type="text/javascript" src="js/contentslider.js">
                        </script>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="26%" rowspan="3">

                                                <div id="slider1" class="contentslide"
                                                    style="width:250px;float:left;background-color:#CFF5FC">
                                                    <div class="opacitylayer">

                                                        <?php
 	//include "db-connect/notfound.php";
	
    $select="SELECT * FROM `tbl_tradeshow` where status='1' order by 'show_id' desc";

  // $strget="";
    //    $rowsPerPage =5;
    //    $query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
    //    $pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
$query=mysqli_query($con,$select);

   if(mysqli_num_rows($query) > 0)
  {
   while($fetch=mysqli_fetch_array($query))
	{ 
if($_SESSION['language']=='english')
{
 $showname = $fetch['show_name'];
}
else if($_SESSION['language']=='french')
{
 $showname = $fetch['show_name_french'];
}
else if($_SESSION['language']=='chinese')
{
 $showname = $fetch['show_name_chinese'];
}
else
{
 $showname = $fetch['show_name_spanish'];
}


                          $image = $fetch['image'];
						  //$showname = $fetch['show_name'];
						  $industry = $fetch['industry_focus'];
						 $fromdate = $fetch['events_fromdate']; 
						 $todate = $fetch['events_todate'];
 						
						$exe1=strtotime($fromdate);
							
							
						$startDate = mktime (0,0,0,date("m",$exe1),date("d",$exe1),date("Y",$exe1));
                        $finishDate = $startDate + (168 * 60 * 60); 
                        
						 $res=date('F j, Y',$finishDate); 
						 
						 $ress = date('F j, Y', strtotime('+7 days'));
						
		
						  $businesstype = split(",",$fromdate);
		
			
						  $businesstype[0];
						  $businesstype[1];
						 $businesstype[2];
			 
						  $todate = $fetch['events_todate'];
						  
						  $dateto = split(",",$todate);
						  $dateto[0];
						  $dateto[1];
						  $dateto[2];
						  
						  $location = $fetch['location'];
						 $fromdate;
					
 ?>
                                                        <div class="contentdiv">

                                                            <table width="100%" style="padding-top:20px;"
                                                                cellspacing="0">
                                                                <tr>

                                                                    <td width="24%" align="center"><?php
					   if(($image != "")&&(file_exists("uploads/".$image)))
					   {
					   ?>
                                                                        <img src="<?php echo "uploads/". $image;?>"
                                                                            height="100" width="100" />
                                                                        <?php
					  }
					  else
					  {
					  ?>
                                                                        <img src="images/img_noimg.jpg" height="100"
                                                                            width="100" />
                                                                        <?php
					  }
					  ?> </td>
                                                                    <td width="76%" valign="top" class="labelname"
                                                                        align="left">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <input type="hidden"
                                                                                    value="<?php echo $fetch['show_id'];?>"
                                                                                    name="ids[]" />
                                                                                <td height="25"><a class="tittlelink"
                                                                                        href="tradeshow_search.php?id=<?php echo $fetch['show_id'];?>"><?php echo $showname; ?></a>&nbsp;&nbsp;<?php echo $fetch['seller_updated_date']; ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="20" class="labelname">
                                                                                    <?php echo $industry; ?></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td height="20" class="labelname">
                                                                                    <?php echo $fromdate; ?>&nbsp;<?php echo $traders_to;?>
                                                                                    &nbsp; <?php echo $todate; ?></td>
                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>


                                                        <?php
			  }
			   }
			   ?>
                                                    </div>


                                                </div>
                                                <!--outer div ends -->



                                                <div id="slider1" class="contentslide" style="width:190px;float:left;">

                                                    <?php 
$select1="select * from tbl_tradeshow where status=1 order by RAND() limit 1"; 

$query1=mysqli_fetch_array(mysqli_query($con,$select1));

if($_SESSION['language']=='english')
{
$show=$query1['show_name'];
}
else if($_SESSION['language']=='french')
{
$show=$query1['show_name_french'];
}
else if($_SESSION['language']=='chinese')
{
$show=$query1['show_name_chinese'];
}
else
{
$show=$query1['show_name_spanish'];
}

$img=$query1['image'];

?>

                                                    <table width="100%" style="padding-top:20px;" cellspacing="0">
                                                        <tr>

                                                            <td width="24%" align="center"><?php
					   if(($img != "")&&(file_exists("uploads/".$img)))
					   {
					   ?>
                                                                <img src="<?php echo "uploads/". $img;?>" height="100"
                                                                    width="100" />
                                                                <?php
					  }
					  else
					  {
					  ?>
                                                                <img src="images/img_noimg.jpg" height="100"
                                                                    width="100" />
                                                                <?php
					  }
					  ?> </td>
                                                            <td width="76%" valign="top" class="labelname" align="left">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <input type="hidden"
                                                                            value="<?php echo $query1['show_id'];?>"
                                                                            name="ids[]" />
                                                                        <td height="25"><a class="tittlelink"
                                                                                href="tradeshow_search.php?id=<?php echo $query1['show_id'];?>"><?php echo $show; ?></a>&nbsp;&nbsp;
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="20" class="labelname">
                                                                            <?php echo $query1['industry_focus']; ?>
                                                                        </td>
                                                                    </tr>

                                                                    <!--<tr><td height="20" class="labelname"><?php echo $query1['events_fromdate']; ?>&nbsp;
								   &nbsp; <?php echo $query1['events_todate']; ?></td>
                                </tr>-->

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>








                                                </div>



                                            </td>




                                        </tr>
                                        <?php /*
$query1=mysqli_query($con,$select);
if(mysqli_num_rows($query1) > 0)
  {
   $fetch1=mysqli_fetch_array($query1)
	 ?>
                                <td width="18%" rowspan="3" align="left" valign="middle"><?php $image1 = $fetch1['image']; ?><?php
					   if(($image1 != "")&&(file_exists("uploads/".$image1)))
					   {
					   ?>
                                    <a class="tittlelink"
                                        href="tradeshow_search.php?id=<?php echo $fetch1['show_id'];?>"><img
                                            src="<?php echo "uploads/". $image1;?>" height="75" width="75"
                                            border="0" /></a>
                                    <?php
					  }
					  else
					  {
					  ?>
                                    <img src="images/img_noimg.jpg" height="75" width="75" />
                                    <?php
					  }
					  ?> </td>

                                <td width="56%" class="labelname" style="padding-top:20px"><a class="tittlelink"
                                        href="tradeshow_search.php?id=<?php echo $fetch1['show_id'];?>"><?php echo $fetch1['show_name']; ?></a>&nbsp;&nbsp;<?php echo $fetch1['seller_updated_date']; ?>
                                </td>


                            </tr>

                            <tr>
                                <td class="labelname"><?php echo $fetch1['industry_focus']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" class="labelname">
                                    <?php echo $fetch1['events_fromdate'];  ?>&nbsp;<?php echo " ".$traders_to;?>
                                    &nbsp;<?php echo $fetch1['events_todate']; ?></td>
                            </tr>
                            <?php } */ ?>

                        </table>
                        </td>
                        </tr>
                        </table>

                        <div class="pagination" id="paginate-slider1"></div>

                        <script type="text/javascript">
                        ContentSlider("slider1", 2000)
                        </script>


                        <div>
                            <?PHP echo $pagingLink;
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