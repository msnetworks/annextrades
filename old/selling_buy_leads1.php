<?php include("includes/header.php");

//print_r($_REQUEST['property']);
$cat_id = $_REQUEST['cat_id'];
if($cat_id=="")
{
$cat_id=" ";
}
else
{
//echo $cat_id;
}
$subcat = $_REQUEST['subcat1_id'];
 ?>
		<script language="javascript" type="text/javascript">
	   
		
		function checkbox() {
	var lengthcount=document.searching.maxvalue.value;
alert(lengthcount);
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var property = "property["+i+"]";
	  var dom = document.getElementById(property);
	  //alert(property);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	alert(checkedcount);
	if(checkedcount < 1) {
			alert("Select Atleast One Selling Leads");
			return false;
		}
		if(checkedcount > 1) {
			alert("Select Only One Selling Leads");
			return false;
		}
}
function compare(){
 
	var result=checkbox();
	if(result == false) {
		return false;
	}
	else {
	
	 document.searching.submit();
	}
}
function comp()
{
document.searching.Submit.readOnly=false;
}

function checking()
{
alert("You can't add contact to your Own Product");
return false;
}



function chk_valcomp()
{
	var ses_val=document.searching.hidsess.value;
	var userid=document.searching.hiduserid.value;
	
	alert("hai");
	var res=checkbox();
	
	if(res==false) {
		return false;
	}
	else{
	if(ses_val==userid)
	{
		
		var res1=checking()
		if(res1==false)
		return false
	}
	}
}
</script>


<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?></div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside1.php"); ?>
</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>
<?php 
$pro=$_REQUEST['id'];
if($_SESSION['language']=='english')
{
$res="select * from buyingleads where status='2' and lang_status='0'";
}
else if($_SESSION['language']=='french')
{
$res="select * from buyingleads where status='2' and lang_status='1'";
}
else if($_SESSION['language']=='chinese')
{
$res="select * from buyingleads where status='2' and lang_status='2'";
}
else
{
$res="select * from buyingleads where status='2' and lang_status='3'";
}
//$res="select * from tbl_seller where seller_id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
$id=$result['user_id'];

$res3=mysqli_query($con,"select * from country where country_id='$result[country]'");
$result1=mysqli_fetch_array($res3);
$result1['country'];

?>
<div class="products-cate-cont1"> 

<div class="products-cate-heading"> <span> <?php echo $keyword1;?></span>   <span> <?php echo $selling_leads; ?></span>   </div>
<div style="border: solid 1px #CFCFCF;">


<table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box" >
                            <tr>
                              <td valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" >
                                
                                <?php
								if(isset($_REQUEST['subcat_id']))
								{
								$subcat_id=$_REQUEST['subcat_id'];
								}
								else
								{
								$subcat_id ="";
								}
if((isset($_REQUEST['cat_id'])) || (isset($_REQUEST['subcat_id'])))
{
if($_SESSION['language']=='english')
{
$select = "SELECT * FROM `buyingleads` WHERE (category='$cat_id' or subcategory='$subcat_id') and status='2' and lang_status='0'";
}
else if($_SESSION['language']=='french')
{
$select = "SELECT * FROM `buyingleads` WHERE (category='$cat_id' or subcategory='$subcat_id') and status='2' and lang_status='1'";
}
else if($_SESSION['language']=='chinese')
{
$select = "SELECT * FROM `buyingleads` WHERE (category='$cat_id' or subcategory='$subcat_id') and status='2' and lang_status='2'";
}
else
{
$select = "SELECT * FROM `buyingleads` WHERE (category='$cat_id' or subcategory='$subcat_id') and status='2' and lang_status='3'";
}
 //$select = "SELECT * FROM `tbl_seller` WHERE (seller_category='$cat_id' or seller_subcategory='$cat_id') and status='2'";

$strget="";
        $rowsPerPage =5;
        $query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
        $pagingLink = getPagingLink($select, $rowsPerPage,$strget); 

//$query1 = mysqli_query($con,$select);

$co=mysqli_num_rows(mysqli_query($con,$select));
if(mysqli_num_rows($query) > 0)
  {
?>
                                <form id="form1" name="searching" method="post" action="<?php if(isset($sess_id)){?>send_action1.php<?php }else{?>login.php <?php } ?>">
                                  <tr>
                                    <td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" >
									<tr>
									<td>&nbsp;</td>
									</tr>
                                        <!--<tr>
                                          <td height="35" ><span style="font-size:14;"><strong>Select to</strong></span>
										  <img src="images/mail2.jpg" border="0"/>
                                           <?php if($_SESSION['user_login']!="") { ?>
                                              <a href="#" onclick="return chk_valcomp();" class="topics2">Inquiry</a>
											  <?php } else { ?>
											  <a href="login.php" class="topics2"> Inquiry</a>
											  <?php } ?>
                                               
                                              <input type="hidden" name="hidsess" value="<?php echo $_SESSION['user_login'];?>" />
											  <input type="hidden" name="hiduserid" value="" />
                                             </td>
                                        </tr>-->
                                        <?php
  $i=0;
 while($row = mysqli_fetch_array($query))
{ 
$uid=$row['user_id'];
$con=$row['country'];
//echo "select * from country where country_id='$con'";

 $res=mysqli_query($con,"select * from country where country_id='$con'");
 $result=mysqli_fetch_array($res);
 ?>
                                        <tr>
                                          <td><table width="100%" cellpadding="2" cellspacing="2" >
                                              <tr>
                                                <td align="center" valign="top"><?php
					  if($uid==$sess_id)
					  {
					  ?>
                                                    <input type="checkbox" name="property[<?PHP echo $i; ?>]"  id="property[<?PHP echo $i; ?>]" onclick="document.searching.ids.value=<?php echo $row['buy_id'];?>;document.searching.hiduserid.value=<?php echo $row['user_id'];?>;" value="<?PHP echo $row['buy_id'] ?>"  />
                                                    <?php
					  }
					  else
					  {
					  ?>
                                                    <input type="checkbox" name="property[]"  id="property[<?PHP echo $i; ?>]" value="<?PHP echo $row['buy_id'] ?>"/>
                                                    <?php
					  }
					  ?>
                                                </td>
                                                <td width="24%"><?php if(($row['photo']!='') && (file_exists("upload/". $row['photo']))) { ?><img src="<?php echo "upload/". $row['photo'];?>" height="75" width="75"/><?php } else { ?><img src="upload/img_noimg.jpg" height="75" width="75"/><?php } ?></td>
                                                <td width="76%"><table width="100%">
                                                    <tr>
                                                      <input type="hidden" value="" name = "ids" />
                                                      <td><a  class="news" href="companyinfo1.php?id=<?php echo $row['buy_id'];?>"><?php echo ucfirst($row['subject']); ?></a><span style="font-size:12px">&nbsp;&nbsp;<?php echo $row['update_date']; ?></span></td>
                                                      <td align="center"><img src="<?php echo "flags/".$result['country_flag'];?>"  width="25" height="25" border="0" /></td>
                                                      <!-- <td width="23%"><a href=
							<?php if(isset($sess_id))
							{
							if($uid==$sess_id)
							{
							?>
							"#" onclick="return checking();"
							<?php
							}else{
							?>"send_action.php?id=<?php echo $row['buy_id'];?>"
							<?php 
							}
							}else{ 
							?>"login_1.php" 
							<?php 
							} 
							?> class="news">Online</a></td>-->
                                                    </tr>
                                                    <tr>
                                                      <td width="61%">&nbsp;</td>
                                                      <td width="13%" align="center" valign="middle"><span style="font-size:12px"><?php echo $result['country_name']; ?></span></td>
                                                      <td width="26%" align="center" valign="middle"  class="enquire"><a href=
							<?php if(isset($sess_id))
							{ 
							if($uid==$sess_id)
							{
							?>
							"#" onclick="return checking();"
							<?php
							}else{
							?>"send_action.php?id=<?php echo $row['buy_id'];?>"
							<?php 
							}
							}else{ 
							?>"login.php?id=<?php echo $row['buy_id'];?>" 
							<?php 
							} 
							?> class="buttonstyle" ><?php echo $inquiry; ?> <?php  //echo $selling_buy_leads1_connw;?></a></td>
                                                    </tr>
                                                    <?php
						  $uid=$row['id'];
  $sel=mysqli_query($con,"select * from companyprofile where user_id='$uid'");
      
	  
	   $sell=mysqli_fetch_array($sel);
	   //{
	   $compid=$sell['id'];
	   
	  $res=mysqli_query($con,"select * from companyrating where cownerid='$uid' and ratingcompany='$compid'");
	  $num=mysqli_num_rows($res);
	  $sum=0;
	  $sums=0;
	  while($fet=mysqli_fetch_array($res))
	  {
	  
	  //echo $fet['id'];
	  $rats=$fet['ratingpoint']; 
	  $sum=$sum + $rats;
	   $sums=$sum/$num;
      }
	 $sum;
	 $sums;
						  ?>
                                                    <tr>
                                                      <td colspan="3"><span style="font-size:12px"><?php echo $row['briefdes']; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="3"><a href="company_profile.php?id=<?php echo $row['user_id'];?>" class="topics"><?php echo ucfirst($row['companyname']); ?></a><span style="font-size:12px"> &nbsp;&nbsp; <?php echo $selling_buy_leads1_rtpt;?>(<?php echo $sums."%";?>)</span></td>
                                                    </tr>
                                                </table></td>
                                              </tr>
                                          </table>
                                              <!--<div><img src="images/spacer.gif" height="4" /></div>-->
                                          </td>
                                        </tr>
                                        <?php
			     $i++;
			   }

?>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <!--<tr>
                <td><img src="images/spacer.gif" width="1" height="10" /></td>
              </tr>-->
                                    <input type="hidden" value="<?PHP echo $i; ?>" name="maxvalue" />
                                  </tr>
                                </form>
                                <?php
}
else
{

                 echo "<tr>";
                  echo "<td align='center' class='nresult'><font color='#FF0000'>$no_record</font></td>";
                  echo "</tr>";
	
	
}
}	?>
                                <tr>
                                  <td align="center" height="25"><?PHP echo $pagingLink;
     echo "<br>";?></td>
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


