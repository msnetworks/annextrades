<?php include("includes/header.php");

//print_r($_REQUEST['property']);

 ?>

<script type="text/javascript">
  function searchlist(id) {
    var currentDiv;
    currentDiv = document.getElementById(id);
    if (currentDiv != null) {
	currentDiv.style.display = 'none';
    }
	else{  
    currentDiv.style.display = 'block';
    }
}

function checkbox() {
//alert("hai");
	var lengthcount=document.searching.maxvalue.value;
//alert(lengthcount);
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var property = "property["+i+"]";
	 
	  var dom = document.getElementById(property);//alert(dom);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	
	if(checkedcount < 1) {
			alert("Select Atleast One product");
			return false;
		}
   else if(checkedcount>3)
   {
   	alert("Select Maximum Three Products Only ");
	return false;	
   }
}
function compare(){
 //alert("hai");
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

<div class="products-cate-cont"> 

<div class="products-cate-heading"> <span><strong> <?php echo $Product; ?></strong></span> <span style="float:right;"><a href="add_product.php" style="font-weight:bold;"><?php echo $add_product; ?></span></div>
<div style="border: solid 1px #CFCFCF;">


<?php 

$pro_name=$_REQUEST["p_name"];
 $country=$_REQUEST["country"];
 $category=$_REQUEST["category"];

 $name=$_REQUEST['name'];

if($country=='0')
{
$country="";
}

if($pro_name!='')
 {
 	 $pro_name=$pro_name;
	
 }
/*if($pro_name=='Type Keyword(s)')
 {
 	$pro_name="";
 }*/

if($category=='0')
{
$category="";
}
if($pro_name!="Type Keyword")
{
 $q1 = " AND (product.p_name like '%$pro_name%' OR product.p_keyword like '%$pro_name%')  ";
}

if($country!="")
{
 $q2 = " AND product.country = '$country' ";
}

if($category!="")
{
 $q3 = " AND product.p_category = '$category' ";
}
if($name!="")
{
$q4=" AND product.p_name LIKE '$name%'";
 //$q4 = " AND product.p_name like '$name%' ";
}


 $query = $q1.$q2.$q3.$q4;

$query =substr($query, 5);

if($query!='')
{
if($_SESSION['language']=='english')
{
 $select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where $query and product.status='2' and product.lang_status='0' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
else if($_SESSION['language']=='french')
{
 $select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where $query and product.status='2' and product.lang_status='1' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
else if($_SESSION['language']=='chinese')
{
 $select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where $query and product.status='2' and product.lang_status='2' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
else
{
 $select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where $query and product.status='2' and product.lang_status='3' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
}

else
{
if($_SESSION['language']=='english')
{
$select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where product.status='2' and product.lang_status='0' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
else if($_SESSION['language']=='french')
{
$select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where product.status='2' and product.lang_status='1' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
else if($_SESSION['language']=='chinese')
{
$select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where product.status='2' and product.lang_status='2' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
else
{
$select = "SELECT *,product.id as proid,product.country as countyid,registration.id as regid from product,registration,category where product.status='2' and product.lang_status='3' and category.c_id=product.p_category and registration.companyname!='' and registration.id=product.userid order by udate desc ";
}
 }

//$select_product="SELECT * FROM product WHERE status=1";
//$res_product=mysqli_query($con,$select_product);


$strget="";
$rowsPerPage = 5;
$result_query = getPagingQuery($select, $rowsPerPage, $strget);
$result_query;

$result1 = mysqli_query($con,$result_query);
$pagingLink = getPagingLink($select, $rowsPerPage, "qry=$sentsql");

//echo $ss=mysqli_num_rows(mysqli_query($con,$select));
if(mysqli_num_rows($result1) > 0)
  {
?>

 
<table cellpadding="0" cellspacing="0" width="100%" style="padding-left:10px;" >
<form id="form1" name="searching" method="post" action="<?php if(isset($sess_id)){?>proaction.php<?php }else{?>login.php <?php } ?>">
<tr><td>&nbsp;</td></tr>

<tr>

 <td height="35"><span style="font-size:10; color:#999; font-family:Arial, Helvetica, sans-serif;"><?php echo $select_to; ?> &nbsp;&nbsp;&nbsp; <a href="#" onclick="return compare();" class="topics2"><img src="images/mail2.jpg" border="0"/> <?php echo $inquiry_now; ?>
 <!--<input name="mainSubmit" type="image" onclick="return compare();" value="Contact now" src="images/bu_ContactNow.gif"/>-->
                                </a></span></td>
                              </tr>

<?php 



$i=0;
while($fetch_product=mysqli_fetch_array($result1))
{
$uid=$fetch_product['userid']; 
 

$con=$fetch_product['country'];
$select_country="SELECT * FROM country WHERE `country_id`='$con'";
$res_country=mysqli_query($con,$select_country);
$fetch_country=mysqli_fetch_array($res_country);

?>

<tr><td><table cellpadding="0" cellspacing="0" width="100%" >
<tr>
<td width="5%"><?php  if($uid==$sess_id){ ?>
<input type="checkbox" name="property[<?PHP echo $i; ?>]" id="property[<?PHP echo $i; ?>]" value="<?PHP echo $fetch_product['proid'] ?>"/>
 <?php } else { ?>
<input type="checkbox" name="property[<?PHP echo $i; ?>]2"  id="property[<?PHP echo $i; ?>]" value="<?PHP echo $fetch_product['proid'] ?>"/>
                                          <?php
   }
   ?>
</td>
<td width="10%">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><a href="productcompanyinfo.php?id=<?php echo $fetch_product['proid'];?>&amp;cid=<?php echo $fetch_product['p_category'];?>&amp;scid=<?php echo $fetch_product['p_subcategory'];?>"  style="text-decoration:none;">
												<?php if((file_exists("productlogo/".$fetch_product['p_photo']))&&($fetch_product['p_photo']!='')) { ?> 
			<img src="<?PHP echo "productlogo/".$fetch_product['p_photo'];?>" width="95" height="95" border="0" />
												<!--<span>
    <img src="<?PHP echo "productlogo/".$fetch_product['p_photo'];?>"  width="150px" height="150px"alt="large" /><br />
    <?php echo ucfirst($fetch_product['p_name']); ?></span>--> <?php } else {  ?><img src="productlogo/img_noimg.jpg" width="95" height="95" border="0" /><?php } ?></a></td>
</tr>
</table></td>
<td width="50%"><table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="250"><a  href="productcompanyinfo.php?id=<?php echo $fetch_product['proid'];?>&amp;cid=<?php echo $fetch_product['p_category'];?>&amp;scid=<?php echo $fetch_product['p_subcategory'];?>" class="bluelink"><strong><?php echo $fetch_product['p_name']; ?></strong></a></td><td width="70"><?php if((file_exists("flags/". $fetch_country['country_flag']))&&($fetch_country['country_flag']!='')) { ?><img src="flags/<?php echo $fetch_country['country_flag']; ?>" width="25" height="25" border="0" /><?php }else { ?><img src="flags/no_flag.png" width="25" height="25" border="0" /><?php } ?> <br /><?php echo $fetch_country['country_name']; ?></td><td width="50" class="enquire"><a href=
							<?php 
							//
							
							if($sess_id!="")
							{
							
							if($uid==$sess_id)
							{
							?>						"#" onclick="return checking();"
							<?php
						    }else{ 
							?>
							"proaction1.php?id=<?php echo $fetch_product['proid'];?>"
							<?php 
							}
							}else{ 
							?> "login.php" 
							<?php 
							} 
							?> class="buttonstyle"><!--<img src="images/mail2.jpg" border="0"/>--> <?php echo $inquiry; ?> </a></td>
</tr>
<tr>
<td><?php echo "Posted On:".str_replace(".","/",$fetch_product['udate']); ?> </td><!--<td><?php echo $fetch_country['country_name']; ?></td>-->
</tr>
<?php 
$select="select * from registration where id=$fetch_product[userid]";
$query=mysqli_query($con,$select);
$fetch=mysqli_fetch_array($query);
						
$uid=$row['userid'];
$sel=mysqli_query($con,"select * from companyprofile where user_id='$uid'");
	  
$sell=mysqli_fetch_array($sel);
$compid=$sell['id'];
$res=mysqli_query($con,"select * from companyrating where cownerid='$uid' and ratingcompany='$compid'");
$num=mysqli_num_rows($res);
$sum=0;
$sums=0;
while($fet=mysqli_fetch_array($res))
{
$rats=$fet['ratingpoint']; 
$sum=$sum + $rats;
$sums=$sum/$num;
}
$sum;
$sums;
 ?>


<tr>
<td><a href="company_profile.php?id=<?php echo $fetch_product['userid']; ?>" class="superdeal"><?php echo ucfirst($fetch['companyname']); ?></a>&nbsp;&nbsp;<?php echo $rating_pont; ?> (<?php echo $sums."%";?>)</td>
</tr>
</table>
</td>
</tr>

<tr><td>&nbsp;</td></tr>


</table></td></tr>

<?php $i++; } ?> 
 <input type="hidden" value="<?PHP echo $i; ?>" name="maxvalue" />

   </form >
</table >  

<?php } else { ?>


<div style="padding:100px; color:#FF0000; font-weight:bold;"> <?php echo $no_record; ?></div>

<?php } ?>


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


