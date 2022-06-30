<?php
include "db-connect/notfound.php"; 
$sess_id=$_SESSION['user_login'];


$_SESSION['language'] = 'english';
include("language/".$_SESSION['language']."/language.php"); 

$id=$_REQUEST['id'];

$res=mysqli_fetch_array(mysqli_query($con,"select * from companyprofile where user_id='$id'"));
$cid=$res['id'];

$fetch=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$id'"));

 $cou=$fetch['country'];					  
						    $sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
							$row_country=mysqli_fetch_array($sql_country);
							$row_country['country_name'];

$today=date('Y-m-d');
							
if(isset($_REQUEST['Submit']))
{
 $rate=$_REQUEST['rate']; 

//echo "insert into companyrating (ratingcompany, otterid, ratingpoint, entrydate) values ('$cid', '$id', '$rate', '$today')";exit;
$ins=mysqli_query($con,"insert into companyrating (ratingcompany, cownerid, otterid, ratingpoint, entrydate) values ('$cid', '$id', '$sess_id', '$rate', '$today')");

header("location:ratingresult.php?id=$id");
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lower  Market</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="js/tab.js" type="text/javascript"></script>
</head>

<body>

<div class="fullcontainer">
  <div class="body-cont"> 

<div class="body-cont1">
  <div class="body-right1"> 



<table width="100%" height="198" border="0" cellpadding="0" cellspacing="0"  >
            <tr>
              <td height="3" colspan="4" align="center"></td>
            </tr>
           <!-- <tr>
              <td colspan="4" align="center"><?php  echo $help_companyinfocompinfo;?></td>
            </tr>-->
				<tr>
                        <td colspan="4" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                              <td width="1%" align="right" valign="top" style="background-color:#29B1CA;"><!--<img src="images/blue_head_left.jpg" width="7" height="31" />--></td>
                              <td width="98%" height="25" valign="middle" class="browse_center" style="background-color:#29B1CA;"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="98%" height="22" class="browsetext" style="background-color:#29B1CA;"><?php echo $company_info; ?></td>
                                  </tr>
                              </table></td>
                              <td width="1%" align="left" valign="top" style="background-color:#29B1CA;"><!--<img src="images/blue_head_right.jpg" width="7" height="31" />--></td>
                            </tr>
                        </table></td>
                      </tr>
					 <tr>
             
              <td height="24" colspan="4" class="border_box" valign="top" align="center">
			  <form name="companyrate" method="post" action="" onsubmit="return validate(this);">
			  			<table cellspacing="0" width="100%" cellpadding="0" border="0" style="border:1px solid #29B1CA;">
            <tr>
             
              <td height="24" colspan="4" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td width="8%" height="26">&nbsp;</td>
              <td width="28%"><font class="normal"><?php echo $company_name; ?></font></td>
              <td width="4%" align="center">:</td>
              <td width="60%" height="26"><font class="normal"><?php echo $res['companyname'];?></font></td>
            </tr>
			 <tr>
              <td width="8%" height="26">&nbsp;</td>
              <td width="28%"><font class="normal"><?php echo $city; ?></font></td>
              <td width="4%" align="center">:</td>
              <td width="60%" height="26"><font class="normal"><?php echo $fetch['city'];?></font></td>
            </tr>
			<tr>
              <td width="8%" height="26">&nbsp;</td>
              <td width="28%"><font class="normal"><?php echo $state; ?></font></td>
              <td width="4%" align="center">:</td>
              <td width="60%" height="26"><font class="normal"><?php echo $fetch['state'];?></font></td>
            </tr>
			<tr>
              <td width="8%" height="26">&nbsp;</td>
              <td width="28%"><font class="normal"><?php echo $country; ?></font></td>
              <td width="4%" align="center">:</td>
              <td width="60%" height="26"><font class="normal"><?php echo $row_country['country_name'];?></font></td>
            </tr>
			 <tr>
             
              <td height="24" colspan="4" align="center">&nbsp;</td>
            </tr>
			<tr>
              <td colspan="4" align="center"><strong><?php echo $company_rating; ?></strong></td>
            </tr>
            
			<tr>
              <td width="8%" height="26">&nbsp;</td>
              <td height="26" colspan="3"><span style="color:#FF0000"><?php echo $rating_success; ?></span></td>
              </tr>
			  
           
            <tr>
              <td colspan="4" align="center"><a href="javascript:self.close();" class="bluueboldli2">
                <input type="submit" class="search_bg" name="Submit" value="<?php echo $close; ?>" onclick="javascript:self.close();"/>
               </a></td>
              </tr>
			  
			  </table></form>
				</td>
			 		</tr>
			  		
			  
            
          </table>
  </div>
</div>
</div>


</div>

</body>
</html>
