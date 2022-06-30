<?php include("includes/header.php");

//print_r($_REQUEST['property']);

 ?>

<script type="text/javascript">
function checking()
{
alert("You can't add contact to your Own Product");
}
</script>


<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>





<div class="body-right"> 

<?php include("includes/menu.php"); 

$pro=$_REQUEST['id'];

$res="select * from tbl_seller where seller_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
 
$id=$result['user_id'];

$res3=mysqli_query($con,"select * from country where country_id='$result[seller_country]'");
$result1=mysqli_fetch_array($res3);
$result1['country'];

?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"> <?php echo ucfirst($result['seller_subject']);?></div>
<div style="border: solid 1px #CFCFCF;">


 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="79%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <!--<tr>
                        <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="1%" align="left" valign="top"><img src="images/blue_head_left.jpg" width="7" height="31" /></td>
                              <td width="98%" height="25" valign="middle" class="browse_center"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
							
                                  <tr>
                                    <td width="98%" height="22" class="browsetext"></td>
                                  </tr>
                              </table></td>
                              <td width="1%" align="right" valign="top"><img src="images/blue_head_right.jpg" width="7" height="31" /></td>
                            </tr>
                        </table></td>
                      </tr>-->
                      <tr>
                        <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box" >
                            <tr>
                              <td valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
                               
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="3" cellspacing="0" class="">
                                      <tr>
                                        <td><table width="100%" >
                                            
                                            <tr>
                                              <td width="36%" ><table width="100%" height="63">
                                                  <tr>
                                                    <td height="48" align="center"><?php if((file_exists("uploads/".$result['seller_photo']))&&($result['seller_photo']!='')) { ?><img src="<?php echo "uploads/".$result['seller_photo'];?>" height="125" width="125"/><?php } else { ?><img src="upload/img_noimg.jpg" height="125" width="125"/><?php } ?></td>
                                                  </tr>
                                              </table></td>
                                              <td width="64%"><table width="100%">
                                                  <tr>
                                                    <td width="54%" class="labelname"><strong><?php echo $place_origin; ?> :</strong></td>
                                                    <?php 
							$conname=$result['seller_country'];
							$sel_cou=mysqli_query($con,"select * from country where country_id='$conname'");
							$cou_fetch=mysqli_fetch_array($sel_cou);
							?>
                                                    <td width="46%" class="labeltext"><?php echo $cou_fetch['country_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if((file_exists("flags/". $cou_fetch['country_flag']))&&($cou_fetch['country_flag']!='')) { ?><img src="<?php echo "flags/".$cou_fetch['country_flag'];?>" width="25" height="25"/><?php }else { ?><img src="flags/no_flag.png" width="25" height="25" border="0" /><?php } ?> </td>
                                                  </tr>
                                                  <tr>
                                                    <td width="36%" class="labelname"><strong><?php echo $post_date; ?> :</strong></td>
                                                    <td width="64%" class="labeltext"><?php echo $result['seller_updated_date'];?></td>
                                                  </tr>
                                                 <!-- <tr>
                                                    <td width="54%" class="labelname"><strong><?php echo $product_model; ?> :</strong></td>
                                                    <td width="46%" class="labeltext"><?php echo $result['seller_keyword'];?></td>
                                                  </tr>-->
                                                  <tr>
                                                    <td class="labelname"><strong><?php echo $expiry_date; ?> :</strong></td>
                                                    <td class="labeltext"><?php echo $result['seller_expired_date'];?></td>
                                                  </tr>
                                                  <tr>
                                                    <td width="54%" class="labelname" valign="top"><strong><?php echo $product_descrip; ?> : </strong></td>
                                                    <td width="46%" class="labeltext"><?php echo $result['seller_description']; ?></td>
                                                  </tr>
                                              </table></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr> </tr>
                                      <tr>
                                        <td><table width="100%" background="1" >
                                            <tr>
                                              <?PHP 
				    $sql=(mysqli_query($con,"select * from  registration"));
							
				    $row=mysqli_fetch_array($sql);
				    $rid=$row['id'];
				  	$sql_cp=(mysqli_query($con,"select * from companyprofile where user_id='$id'"));
					$count_cp=mysqli_num_rows($sql_cp);
					$row_cp=mysqli_fetch_array($sql_cp);
					?>
                                              <td colspan="4" align="left" valign="middle" style="padding-left:0px;" class="prodcuts_search">&nbsp;&nbsp;&nbsp;<strong style="font-size:16px;" > <?php echo $company_info; ?> </strong> </td>
                                              <td width="27%" rowspan="3" align="center"><a href=
					<?php 
					if($sess_id!='')
					{
					if($id==$sess_id)
					{
					?>
					"#" onclick="return checking();"
					<?php
					}else{
					?>
					"send_action2.php?id=<?php echo $result['seller_id'];?>"
					<?php 
					}
					}else{ 
					?>"login.php" 
					<?php 
					} 
					?> class="news"><!--<?php echo $online; ?>--></a></td>
                                            </tr>
                                            <tr>
                                              <td width="34%" class="labelname"><strong>&nbsp;&nbsp;<?php echo $date_joined; ?> :</strong></td>
                                              <td colspan="3" class="labeltext"><?php echo $row_cp['year'];?></td>
                                            </tr>
                                            <tr>
                                              <td width="26%" class="labelname"style="padding-left:4px;"><strong>&nbsp;<?php echo $product_service; ?>:</strong></td>
                                              <td colspan="3" class="labeltext"><?php echo $row_cp['P_service'];?></td>
                                            </tr>
                            <?php
						    $sql=(mysqli_query($con,"select * from  registration where id='$id'"));
							$count=mysqli_num_rows($sql);
							$row=mysqli_fetch_array($sql);
							//echo $row['company_address'];
	                        $cou=$row['countrycode'];					  
						    $sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
							$row_country=mysqli_fetch_array($sql_country);
							$row_country['country_name'];
						  ?>
                                            <tr>
                                              <td class="labelname"><strong>&nbsp;&nbsp;<?php echo $contry; ?> :</strong></td>
                                              <td width="25%" class="labeltext"><?php echo $row_country['country_name'];?></td>
                                              <td width="16%" rowspan="3" align="left" class="enquire"><a href=
					<?php 
					if($sess_id!='')
					{
					if($id==$sess_id)
					{
					?>
					"#" onclick="return checking();"
					<?php
					}else{
					?>
					"send_action2.php?id=<?php echo $result['seller_id'];?>"
					<?php 
					}
					}else{ 
					?>"login.php" 
					<?php 
					} 
					?> class="news buttonstyle"><?php echo $inquiry; ?></a></td>
                                            </tr>
                                            <tr>
                                              <td class="labelname"><strong>&nbsp;&nbsp;<?php echo $bussiness_type; ?> :</strong></td>
											  
                                              <td class="labeltext"><?php $bus_type=mysqli_fetch_array(mysqli_query($con,"select * from business_type where buss_id='$row_cp[bussiness_type]'"));
											  echo $bustype=$bus_type['buss_type'];
											  ?></td>
                                            </tr>
                                           
                                            <tr>
                                              <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td colspan="3"style="padding-left:7px;"><strong><?php echo $doonot_find; ?>?</strong><a href="buying_leads2.php"><?php echo $post_a_buy; ?>.</a><!--<a href="buying_leads2.php" class="news"></a>--></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="10" valign="top"></td>
                                </tr>
                                <!--<tr>
                                  <td><?PHP //include("feature_product.php");?></td>
                                </tr>-->
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                      
                    </table></td>
                                      </tr>
                  
                
                  
                </table>  




<div><?PHP echo $pagingLink;
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


