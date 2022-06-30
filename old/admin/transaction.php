<?php 
include("../db-connect/notfound.php");
include("includes/header.php");
include "includes/pagination.php";
$keyword=$_REQUEST['keyword'];
$show=$_REQUEST['show'];
if(!isset($_SESSION['admin_user']))
{
	header("Location:index.php");
}
if($_REQUEST['del_id'])
{
	$ord_id=$_REQUEST['del_id'];
	$del=mysqli_query($con,"update orders set order_status=2 where id='$ord_id'");
	
	if($del)
	{
	header("location: transaction.php?del");
	}
}

if(isset($_REQUEST['reset']))
{
header("location:transaction.php?datepicker=&tospicker=&product=&sort=&search=Search");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script language="javascript">
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 2,
			dateFormat: 'yy-mm-dd',
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/demos_ddd.css">
<script language="javascript">

		<script src="js/jquery-1.5.1.js"></script>
		<script src="js/jquery.ui.core.js"></script>
		<script src="js/jquery.ui.widget.js"></script>
		<script src="js/jquery.ui.datepicker.js"></script>
		<script>
		$(function() {
				$( "#datepicker").datepicker();
			});
			
		$(function() {
				$( "#tospicker").datepicker();
			});
		</script>
</script>

<script type="text/javascript">
function val_search()
{

if(document.getElementById('datepicker').value!= "")
{
if(document.getElementById('tospicker').value == "")
{
alert("Enter the to date");
document.getElementById('tospicker').focus();
return false;

}
}

}


</script>

<link href="../css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a href="#"><b>Transaction Details</b></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">
		<?php if(isset($_REQUEST['suc'])) { ?>
		<h4 class="alert_success">Updated Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['pass_suss'])) { ?>
		<h4 class="alert_success">Membership Added Successfully</h4>
		<?php } ?>
		<?php if(isset($_REQUEST['del'])) { ?>
		<h4 class="alert_error">Deleted Successfully</h4>
		<?php } ?>
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Transaction Details</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="98%" align="center" cellspacing="0">
			<tr><td align="center">
					<?php //include("buyingleadhead.php");?>
					<?php if(isset($_REQUEST['upd'])) { ?>
					<span style="color:#006600; font-weight:bold;">Updated successfully</span>
					<?php } ?>
				</td></tr>
				<tr><td><form name="searchform" method="get" action="transaction.php" onsubmit="return val_search();">
						<table width="100%" align="center" style="border:5px solid #99CCFF;">
						<tr>
						<td width="249" height="27" colspan="4" class="adminheaderlink" style="border-bottom:1px #CCCCCC solid; font-size:14px; font-weight:bold; padding-left:10px; ">
						Search
						</td>
						</tr>
						
							  <tr>
							  <td height="31" align="right"class="normal">From Date :</td>
							 <td> <input type="text" name="datepicker" id="datepicker" value="<?php echo $_REQUEST['datepicker']; ?>"/></td>
						
							  <td height="31" align="right" class="normal">To Date :
							  <td><input type="text" name="tospicker" id="tospicker" value="<?php echo $_REQUEST['tospicker']; ?>"/></td>
							  </tr>
							  
							  
							  	<tr>
							  <td height="31" align="right" class="normal">Product Name :</td>
				<td>
				     <select name="product" id="product" style="width:145px;">
					<option value="">Choose Product</option>
					<?php 
					$prod=mysqli_query($con,"select * from product where status=2");
					while($prod_row=mysqli_fetch_array($prod))
					{
					?>
					<option value="<?php echo $prod_row['id']; ?>" <?php if($_REQUEST['product']==$prod_row['id']) { ?> selected="selected"; <?php } ?>><?php echo $prod_row['p_name']; ?></option>
					
					<?php } ?>
					 </select>
				
				
					</td>
								<td align="right" class="normal">
								Sort By :</td>
								<td> 
								<input type="radio" name="sort" id="day" value="1" <?php if($_REQUEST['sort']=='1') { ?> checked="checked"; <?php } ?> />Day
								  <input type="radio" name="sort" id="month" value="2" <?php if($_REQUEST['sort']=='2') { ?> checked="checked"; <?php } ?>/> Month
								   <input type="radio" name="sort" id="year" value="3" <?php if($_REQUEST['sort']=='3') { ?> checked="checked"; <?php } ?>/> Year  
								   </td>
								
								</tr>
								
								
			<tr>
			<td>&nbsp;</td>
			<td height="34" align="center"><input type="submit" name="search" value="Search" style=" background-color:#CFCFCF;  border:0px; width:80px; height:25px; border-radius:3px; font-weight:bold; color:#000000 " /></td>
			<td height="34" align="center"><a href="transaction.php?reset"><input type="button" value="Reset" style=" background-color:#CFCFCF;  border:0px; width:80px; height:25px; border-radius:3px; font-weight:bold; " /></a></td>
			<td>&nbsp;</td>
			</tr>
			<!--<tr><td height="34" colspan="2" align="center"><a href="sellingexcl.php?key=<?php echo $keyword;?>&show=<?php echo $show;?>" class="news"><span style="font-size:13px">Export Sellers list in Excel Format</span></a></td></tr>-->
					  </table>
					  </form></td></tr>
				
				<tr><td height="358" valign="top" colspan="9">
					<table width="100%" align="center" cellspacing="0">
						<tr bgcolor="#99CCFF" class="normalbold">
						<!--<td width="141" height="32">&nbsp;&nbsp;Photo</td>-->
						<td width="4%" class="normalbold" >&nbsp;&nbsp;S.no</td>
						<td width="9%" class="normalbold" >&nbsp;&nbsp;Order Id</td>
						<!--<td width="16%" class="normalbold">&nbsp;&nbsp;Trans Id</td>-->
						<td width="12%" class="normalbold">&nbsp;&nbsp;Seller Name</td>
						<td width="14%" class="normalbold">&nbsp;&nbsp;Buyer Name</td>
						<td width="14%" class="normalbold">&nbsp;&nbsp;product Name</td>
						<td width="11%" class="normalbold">&nbsp;&nbsp;Amount</td>
						<td width="13%" class="normalbold">&nbsp;&nbsp;Payment Status</td>
						<td width="12%" class="normalbold">&nbsp;&nbsp;Date</td>
						<td width="5%" class="normalbold">&nbsp;&nbsp;Detail</td>
						<!--<td width="11%" class="normalbold">&nbsp;&nbsp;Posted IP</td>	-->			
						<td width="6%" class="normalbold" align="center">&nbsp;&nbsp;Action</td>						
					  </tr>
<?php 
	
$strval="";				
if(isset($_REQUEST['search']))
{

$product=$_REQUEST['product'];
$date="";
 $dat1=date("Y-m-d");
 $dat2=strtotime($dat1);
$sort=$_REQUEST['sort'];


$from_date=date("Y-m-d",strtotime($_REQUEST['datepicker']));
$to_date=date("Y-m-d",strtotime($_REQUEST['tospicker']));
// echo $from_date;
 //echo $to_date; exit;

	//echo $country; exit;
if($product != "")	
{
 if($strval != "")
 {
    $strval .= " and (product_id = $product)";
 }
 else
 {
	$strval = " and (product_id = $product)";
}
}

if($sort != "")
{
if($sort=='1')
{
$dat1=date("Y-m-d");
 $date.=$dat1;
 if($strval != "")
 {
    $strval .= " and (date = $date)";
 }

else
{
    $strval = " and (date = $date)";
} 
}
//echo $strval; exit;
}

if($sort != "")
{
if($sort=='2')
{
$date1=date("Y-m-d");

$dat3 = strtotime("-30 day", $dat2);
 $date.=date("Y-m-d",$dat3);
 if($strval != "")
 {
    $strval .= " and (date between '$date' and '$date1')";
 }

else
{
    $strval = " and (date between '$date' and '$date1')";
} 
}
//echo $strval; exit;
}


if($sort != "")
{
if($sort=='3')
{
$date2=date("Y-m-d");
$dat5 = strtotime("-365 days", $dat2);
$date.=date("Y-m-d",$dat5); 
 if($strval != "")
 {
    $strval .= " and (date between '$date' and '$date2')";
 }

else
{
    $strval = " and (date between '$date' and '$date2')";
} 
}
//echo $strval; exit;
}


if(($from_date != "1970-01-01") && ($to_date !="1970-01-01"))
{
//$date=date('y/m/d',strtotime('$tech_date_frm'));
    if($strval != "")
	{
		$strval .= " and (date between '$from_date' AND '$to_date')";
	}
	else
	{
		$strval = " and (date between '$from_date' AND '$to_date')";
	}

//echo $strval; exit;
}


}
  else
 {
 $strval="";
 }
 
 //echo date("Y-m-d",strtotime($date));

//echo "select * from orders where order_status!=2 $strval"; 
           $select="select * from orders where order_status!=2 $strval";

		  $strget="datepicker=$from_date&tospicker=$to_date&product=$product&sort=$sort&search=Search";
              $rowsPerPage =20;
              //$query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
			  $query=mysqli_query($con,getPagingQuery1($select, $rowsPerPage,$strget)) or die(mysqli_error($con));
              //$pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
			  $pagingLink = getPagingLink1($select, $rowsPerPage,$strget); 
			  $count=mysqli_num_rows($query);
			  	if(isset($_REQUEST['page']))
					{
						$n=(($_REQUEST['page'] -1) *20 )+1;
					}
					else
					{
						$n=1;
					}
	                if($count > 0)
					{
					   
						
						?>
						
						<?php 
							while($selling=mysqli_fetch_array($query))
							{
							$user=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$selling[user_id]'"));
							$product=mysqli_fetch_array(mysqli_query($con,"select * from product where id='$selling[product_id]'"));
							$sell=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$product[userid]'"));
							
						?>
						<tr>
						<td colspan="10">
							<table width="100%">
							  <tr>
				<!--<td width="140" height="102" align="center"><img src="<?php echo $image;?>" width="98" height="86" /></td>-->
							  <td width="3%" valign="top" style="font-size:13px;">&nbsp;<?php echo $n;?></td>
							 
							  <td width="10%" valign="top" style="font-size:13px;">&nbsp;<?php echo $selling['order_id'];?></td>
							  
						<!--	  <td width="16%" valign="top" style="font-family:'Times New Roman', Times, serif; font-size:13px;">&nbsp;<?php /*?><?php if($selling['trans_id']!="") { echo $selling['trans_id']; } else { echo "Nil"; }?><?php */?></td>-->
							  
							  <td width="12%" valign="top" style="font-size:13px;">&nbsp;<?php echo $sell['firstname'];?></td>
							  
							  <td width="14%" valign="top" style="font-size:13px;">&nbsp;<?php echo $user['firstname'];?></td>
							  
							  <td width="14%" valign="top" style="font-size:13px;">&nbsp;<?php echo $product['p_name'];?></td>
							  
							  <td width="11%" valign="top" style="font-size:13px;">&nbsp;<?php echo $selling['net_amount'];?>$</td>
							  
							  <td width="13%" valign="top" style="font-size:13px;">&nbsp;<?php if($selling['payment_status']=="1")
							  {
							  
							 echo "Paid";
							  } else 
							  {
							  
							  echo "Pending";
							  }
							  
							  
							  ?>	 </td>
							   <td width="12%" valign="top" style="font-size:13px;">&nbsp;<?php echo date("d-m-Y",strtotime($selling['date']));?></td>
							  
							  
							  <td width="5%" valign="top" align="center"><a href="trans_details.php?sid=<?php echo $selling['id'];?>" class="bluebold"><img src="images/view4.png" style="width:20px; height:20px;" /></a></td>
							 
							  <td width="6%" valign="top" align="center">
							 <a href="transaction.php?del_id=<?php echo $selling['id'];?>" onclick="return confirm('Are you sure you wish to delete this record?');" style="text-decoration:none;">&nbsp;&nbsp;<img src="../images1/delete.jpg" alt="Delete" title="Delete" border="0" /></a></td>
							 
							 
						 	</tr></table>
						 </td>
						</tr>
						<tr><td></td></tr>
						<?php $n++;}?>
					
						<tr><td colspan="10" align="center"><?php echo $pagingLink;?></td></tr>
						
						<tr><td colspan="10" align="center">&nbsp;</td></tr>
						<?php }else{?>
					
						<tr>
						  <td colspan="10" align="center" class="redboldlink" height="25">No Products Found</td>
						</tr>
						<?php }?>
				  </table>
				</td></tr>
		  </table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>
</html>