<?php 
include("includes/header.php");
 include("easythumbnail.class.php");
if($session_user=="")
{

header("location:login.php");

}

$sess_id=$_SESSION['user_login'];


$sql=mysqli_query($con,"select * from  registration where id='$sess_id'");
$count=mysqli_num_rows($sql);
$row=mysqli_fetch_array($sql);

if(isset($_REQUEST['tradealert']))
{
$date=date("F j, Y");
$keyword=$_REQUEST['keyword'];
$select=$_REQUEST['select'];
$product=$_REQUEST['pdtcat'];
$region=$_REQUEST['region'];
$othercat=$_REQUEST['othercat'];
$countryct=$_REQUEST['countryct'];

if($_REQUEST['pdtcat']=="All")
{
$pdtcat=mysqli_query($con,"select * from category");
while($pdtres=mysqli_fetch_array($pdtcat))
{

$cidlist .= $pdtres['c_id'].",";

}
}
if($_REQUEST['pdtcat']!="All")
{
$cnt=count($othercat);
for($i=0;$i<=$cnt;$i++)
{
$cidlist .=$othercat[$i].",";
}
}

if($_REQUEST['region']=="All")
{
$cat1=mysqli_query($con,"select * from country");
while($fct=mysqli_fetch_array($cat1))
{
$fcat .=$fct['country_id'].",";
}
}
if($_REQUEST['region']!="All")
{
$cnt1=count($countryct);
for($j=0;$j<=$cnt1;$j++)
{
$fcat .=$countryct[$j].",";
}
}
/*echo "insert into trade_alert(user_id,keyword,product_selection,region_selection,selectinfo,product,region)values('$sess_id', '$keyword', '$product','$region','$select', '$cidlist', '$fcat')";exit;*/

mysqli_query($con,"insert into trade_alert(user_id,keyword,product_selection,region_selection,selectinfo,product,region,entrydate)values('$sess_id', '$keyword', '$product','$region','$select', '$cidlist', '$fcat','$date')");
header("location:trade_list.php");
}
 ?>


<script language="javascript">
function tradevalid()
{
if(document.tradealert.keyword.value=="")
{
alert("Please Enter the Keyword");
document.tradealert.keyword.focus();
return false;
}
}
</script>
<script language="javascript" type="text/javascript">
function showDiv(divId1, divId2)
{
	if(document.getElementById(divId2).checked == true)
		document.getElementById(divId1).style.display='block';
	else
		document.getElementById(divId2).style.display='none';	
}
function hideDiv(divId1, divId2)
{
	if(document.getElementById(divId2).checked == true)
		document.getElementById(divId1).style.display='none';
	else
		document.getElementById(divId1).style.display='none';	
}


</script>

<script language="javascript" type="text/javascript">
function showDiv1(divId1, divId2)
{
	if(document.getElementById(divId2).checked == true)
		document.getElementById(divId1).style.display='block';
	else
		document.getElementById(divId2).style.display='none';	
}
function hideDiv1(divId1, divId2)
{
	if(document.getElementById(divId2).checked == true)
		document.getElementById(divId1).style.display='none';
	else
		document.getElementById(divId1).style.display='none';	
}


</script>
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div class="headinggg"> <?php echo $my_trade_alert; ?></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        
                                        <tr>
                                          <td  ><form action="" method="post" name="tradealert" id="tradealert" >
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td colspan="4">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td width="30%"><span class="seller" style="font-size:12px">&nbsp;&nbsp;<?php echo $enter_product_keyword; ?></span></td>
                                                  <td colspan="3"><input name="keyword" type="text" id="keyword" /></td>
                                                </tr>
                                                <tr>
                                                  <td colspan="4">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td><span style="font-size:12px" class="seller">&nbsp;&nbsp;<?php echo $select_information; ?></span></td>
                                                  <td colspan="3"><input name="select" type="radio" value="product"  id="radio" checked="checked" onclick="javascript:hideDiv('sample','allpdt');"/>
                                                    <?php echo $new_products; ?>&nbsp;&nbsp;
                                                    <input name="select" type="radio" value="buyingleads"  id="radio2" onclick="javascript:hideDiv('sample', 'allpdt');"/>
<?php echo $new_buying; ?><br /></td>
                                                </tr>
												<tr><td>&nbsp;</td></tr>
                                                <tr>
                                                  <td colspan="4"> <span  style="font-size:14px; font-weight:bold;" class="seller">&nbsp;&nbsp;<?php echo $Filters; ?></span></td>
                                                </tr>
												<tr><td>&nbsp;</td></tr>
                                                <tr>
                                                  <td height="30"><span style="font-size:12px" class="seller">&nbsp;&nbsp;<?php echo $pro_cat_filter; ?></span> </td>
                                                  <td width="27%" height="30"><input name="pdtcat" type="radio" value="All"  id="allpdt" checked="checked" onclick="javascript:hideDiv('sample', 'allpdt');"/>
                                                  <?php echo $all_product_cat; ?></td>
                                                  <td width="43%" height="30" colspan="2"><input name="pdtcat" type="radio"  id="pdtcat123" value="Selection Category" onclick="javascript:showDiv('sample', 'pdtcat123');"/>
                                                  <?php echo $my_preferred_location; ?></td>
                                                </tr>
                                                <div id="ss" style="display:none;">
                                                  <tr>
                                                    <td></td>
                                                  </tr>
                                                </div>
                                                <tr>
                                                  <td></td>
                                                </tr>
                                                <tr>
                                                  <td height="5" colspan="4" ><div id="sample" style="display:none;">
                                                      <table height="" width="100%" align="center" >
                                                        <tr>
                                                          <td colspan="4" ><span style="font-size:14px"><strong><?php echo $faq_startproooo;?></strong></span></td>
                                                        </tr>
                                                        <tr>
                                                          <?PHP 
		 
		 $cat=mysqli_query($con,"select * from category");
			
			$i=0;
			while($catres=mysqli_fetch_array($cat))
			{
			 $cid=$catres['c_id'];
			?>
                                                          <td  align="left"><input name="othercat[]" type="checkbox" id="othercat[]" value="<?PHP echo $cid;?>"/>
                                                              <span style="font-size:12px">
                                                              <?PHP
			echo $catres['category'];
			
			?>
                                                              </span></td>
                                                          <?php
		$i++;
		if(($i%3)==0)
		{
		echo "<tr></tr>";
		}
		}
		?>
                                                        </tr>
                                                        <tr>
                                                          <td width="15%" align="center" colspan="4"><input name="ok" type="submit" class="search_bg" id="ok" value="Ok" onclick="javascript:hideDiv('sample','pdtcat123');" /></td>
                                                        </tr>
                                                      </table>
                                                  </div></td>
                                                </tr>
                                                <tr>
                                                  <td></td>
                                                </tr>
                                                <tr>
                                                  <td height="30"><span style="font-size:12px" class="seller">&nbsp;&nbsp;<?php echo $region_filter; ?></span> </td>
                                                  <td height="30"><input name="region" type="radio" value="All"  id="all" checked="checked" onclick="javascript:hideDiv1('region123', 'all');"/>
                                                  <?php echo $all_countrie; ?></td>
                                                  <td height="30" colspan="2"><input name="region" type="radio" value="Selection Region" id="prdcty" onclick="javascript:showDiv1('region123', 'prdcty');"/>
                                                  <?php echo $preferred_region; ?></td>
                                                </tr>
                                                <tr>
                                                  <td colspan="4"><div id="region123" style="display:none;">
                                                      <table height="" width="100%" align="center" >
                                                        <tr>
                                                          <td colspan="4" ><span style="font-size:14px"><strong><?php echo $faq_startproorr;?></strong></span></td>
                                                        </tr>
                                                        <tr>
                                                          <?PHP $cat=mysqli_query($con,"select * from country");
			$i=0;
			while($catres=mysqli_fetch_array($cat))
			{
			 $cid=$catres[0];
			?>
                                                          <td align="left"><input name="countryct[]" type="checkbox" id="countryct[]" value="<?PHP echo $cid;?>"/>
                                                              <span style="font-size:12px">
                                                              <?PHP
			echo $catres[3];
			?>
                                                            </span> </td>
                                                          <?php
				$i++;
		if(($i%4)==0)
		{
		echo "<tr></tr>";
		}
		}
		?>
                                                        </tr>
                                                        <tr>
                                                          <td width="15%" align="center" colspan="4"><input name="regionok" type="submit" class="search_bg" id="regionok" value="Ok" onclick="javascript:hideDiv('region123', 'prdcty');" /></td>
                                                        </tr>
                                                      </table>
                                                  </div></td>
                                                </tr>
                                              </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="34%">&nbsp;</td>
                                                  <td width="9%"><input name="tradealert" type="submit" class="search_bg" id="tradealert" value="<?php echo $submit; ?>"  onclick="return tradevalid();" /></td>
                                                  <td width="49%"><input name="Input" type="submit" class="search_bg" onclick="javascript:history.go(-1);" value="<?php echo $cancel; ?>"/></td>
                                                  <td width="8%">&nbsp;</td>
                                                </tr>
                                              </table>
                                          </form></td>
                                        </tr>
                                      </table>
<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


<div class="body-cont4"> 






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
