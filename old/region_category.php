<?PHP 
ob_start();
session_start();
$sess_id=$_SESSION['sess_id']; 
include ("db-connect/notfound.php");
//include "styles.php";
					   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $webname;?></title>
<meta name="keywords" content="<?php echo $webkeyword;?>" />
<meta name="description" content="<?php echo $webdes;?>" />

<link href="css/sytle.css" rel="stylesheet" type="text/css" />
<link href="css/community.css" rel="stylesheet" type="text/css" />
<link href="css/tabN.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table width="80%" cellspacing="0" cellpadding="0"  align="center" style="border:1px solid #EFEEEE;" >
   

  <tr>
                         <td width="1%" height="8" style="background-color:#29B1C9;" align="right"><!--<img src="images/blue_head_left.jpg" width="7" height="31" />--></td>
                        <td width="100%"   class="browse_center" style="background-color:#29B1C9;"><span class="browsetext"><?php echo $product_category_filter; ?></span></td>
                        <td width="1%" style="background-color:#29B1C9;" align="left"><!--<img src="images/blue_head_right.jpg" width="7" height="31" />--></td>
                      </tr>
                 <tr>
				 	<td colspan="3" class="border_box" valign="top">
					
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <?PHP 
				  $rrid=$_REQUEST['rids'];
                  $id1=explode(",",$rrid);

                   foreach($id1 as $rval)
					  {
					  $cids=$rval;
					   //echo "select * from country where country_id='$rval'";exit;
					  $cat1=mysqli_query($con,"select * from country where country_id='$rval'");
					  while($catres1=mysqli_fetch_array($cat1))
					  {
					  ?>
  <tr>
    <td colspan="4">&nbsp;&nbsp;<span style="font-size:14px"><strong><?PHP echo $catres1['country_name'];?></strong></span></td>
  </tr>
  <?PHP
  
					   }
					   }
					   ?>
</table>

					</td>
				 </tr>
					   
					   <tr>
                        <td align="right" valign="top"><img src="images/blue_left_bot.jpg" width="7" height="7" /></td>
                        <td class="bluebotbg"></td>
                        <td align="left" valign="top"><img src="images/blue_right_bot.jpg" width="7" height="7" /></td>
                      </tr>
</table>
</body>
</html>
