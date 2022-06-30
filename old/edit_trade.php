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
$tradeid=$_REQUEST['tid'];

if(isset($_REQUEST['tradeupdate']))
{
$keyword=$_REQUEST['keyword'];
$select=$_REQUEST['select'];
$product=$_REQUEST['pdtcat'];
$region=$_REQUEST['region123'];
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

if($_REQUEST['region123']=="All")
{
$cat1=mysqli_query($con,"select * from country");
while($fct=mysqli_fetch_array($cat1))
{
$fcat .=$fct['country_id'].",";
}
}
if($_REQUEST['region123']!="All")
{
$cnt1=count($countryct);
for($j=0;$j<=$cnt1;$j++)
{
$fcat .=$countryct[$j].",";
}
}
/*echo "update trade_alert set keyword='$keyword',product_selection='$product',product='$cidlist',region_selection='$region',region='$fcat',selectinfo='$select' where user_id='$sess_id' and trade_id='$tradeid'";exit;*/

 mysqli_query($con,"update trade_alert set keyword='$keyword',product_selection='$product',product='$cidlist',region_selection='$region',region='$fcat',selectinfo='$select' where user_id='$sess_id' and trade_id='$tradeid'");
 header("location:trade_list.php?updatemessage=3");
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
<?PHP
$etrade=mysqli_query($con,"select * from trade_alert where trade_id='$tradeid' and user_id='$sess_id'");
$etrres=mysqli_fetch_array($etrade);
?>
 
<tr >  
<td valign="top" class="border_box"  >
<form action="" method="post" name="tradealert" onsubmit="return tradevalid();">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td>&nbsp;</td></tr>
    <tr>
      <td width="30%"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $enter_product_keyword; ?>: </strong></span> </td>
      <td colspan="3"><input name="keyword" type="text" id="keyword" value="<?PHP echo $etrres['keyword'];?>" maxlength="50" /></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td height="30"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $select_information; ?></strong></span></td>
      
		   <td width="27%" height="30"><input name="select" type="radio" value="product" <?PHP if($etrres['selectinfo']=="product") { ?>id="radio" checked="checked" <?PHP } ?>onclick="javascript:hideDiv('sample', 'allpdt');"/>
		     <?php echo $new_products; ?></td>&nbsp;&nbsp;
		     <td width="43%" height="30" colspan="2"><input name="select" type="radio" value="buyingleads" <?PHP if($etrres['selectinfo']=="buyingleads") { ?> id="radio2" checked="checked" <?PHP } ?> onclick="javascript:hideDiv('sample', 'allpdt');"/>
		     <?php echo $new_buying; ?><br /></td>
    </tr>
    <!--<tr>
      <td colspan="4"><span style="font-size:16px"><strong>&nbsp;&nbsp;Filters</strong></span></td>
      </tr>-->
    <tr>
      <td height="30"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $pro_cat_filter; ?></strong></span> </td>
      <td width="27%" height="30"><input name="pdtcat" type="radio" value="All"  id="allpdt" <?PHP if($etrres['product_selection']=="All") { ?> checked="checked" <?PHP } ?> onclick="javascript:hideDiv('sample', 'allpdt');"/>
        <?php echo $all_product_cat; ?></td>
      <td width="43%" height="30" colspan="2">
	 
	  <input name="pdtcat" type="radio"  id="pdtcat123" value="Selection Category" <?PHP if($etrres['product_selection']=="Selection Category") { ?> checked="checked" <?PHP } ?>  onclick="javascript:showDiv('sample', 'pdtcat123');"/>
	  <?php echo $my_preferred_location; ?></td>
    </tr>
	<div id="ss" style="display:none;">
	<tr><td></td></tr></div>
	
    <tr>
      <td height="4" colspan="4"> <div  id="sample" <?PHP if($etrres['product_selection']=="Selection Category") { ?> style="display:block;" <?PHP } else {?>  style="display:none;" <?php } ?> >
        <table height="" width="100%" align="center">
          <tr>
            <td colspan="3" ><span style="font-size:12px"><strong><?php echo $product_category_filter; ?></strong></span></td>
	  </tr>
       		<tr>
			
         <?PHP 
		    $tradeid;
		 	$cat=mysqli_query($con,"select * from category");
			$i=0;
			while($catres=mysqli_fetch_array($cat))
			{
			 	$cid=$catres['c_id'];
			
			$etrres=mysqli_fetch_array(mysqli_query($con,"select * from trade_alert where trade_id='$tradeid' and user_id='$sess_id'"));
			$crid=$etrres['product'];
			$exid1=explode(',',$crid);
			?>
       
			<td colspan="3"><input name="othercat[]" type="checkbox" id="othercat[]" value="<?PHP echo $cid;?>" 
		   <?php if (in_array($cid, $exid1)) {?>
		  checked="checked"
		  <?php } ?>
		  /><span style="font-size:12px">
              <?PHP
			echo $catres['category'];
			?></span></td>
		<?php
		$i++;
		if(($i%2)==0)
		{
		echo "<tr></tr>";
		}
		}
		
		?>
          </tr>
          </table>
	    </div></td>
      </tr> 
	
	
    <tr>
      <td height="30"><span style="font-size:12px"><strong>&nbsp;&nbsp;<?php echo $region_filter; ?></strong></span> </td>
      <td height="30"><input name="region123" type="radio" value="All"  id="all" <?PHP if($etrres['region_selection']=="All") { ?>id="radio" checked="checked" <?PHP } ?> onclick="javascript:hideDiv1('region', 'all');"/>
        <?php echo $all_countrie ; ?></td>
      <td height="30" colspan="2"> <input name="region123" type="radio" value="Selection Region" id="prdcty"  <?PHP if($etrres['region_selection']=="Selection Region") { ?>id="radio" checked="checked" <?PHP } ?> onclick="javascript:showDiv1('region', 'prdcty');"/>
        <?php echo $all_countrie="All countries and regions";
$preferred_region; ?></td>
    </tr>
    <tr>
      <td colspan="4"><div   id="region"  <?PHP if($etrres['product_selection']=="Selection Region") { echo "nfbsdjb"; ?> style="display:block;" <?PHP } else { ?>  style="display:none;" <?php } ?>><table width="100%" class="" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3"><span style="font-size:12px"><strong><?php echo $region_filter_preferred; ?></strong></span> </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
        <?PHP 
		$cat=mysqli_query($con,"select * from country");
			 
			  $i=0;
			  while($catres=mysqli_fetch_array($cat))
		     {
			  $cid=$catres['country_id'];
			 $region=mysqli_fetch_array(mysqli_query($con,"select * from trade_alert where trade_id='$tradeid' and user_id='$sess_id'"));
			  $regids=$region['region'];
			  $exid=explode(',',$regids);
			  	  
			  ?>

          <td colspan="3"><input name="countryct[]" type="checkbox" id="countryct[]" value="<?PHP echo $cid;?>" 
		   <?php if (in_array($cid, $exid)) {?>
		  checked="checked"
		  <?php } ?>
		  />
             <span style="font-size:12px"> <?PHP
			echo $catres[3];
			?></span></td>
			<?php
		$i++;
		if(($i%4)==0)
		{
		echo "<tr></tr>";
		}
		}
		//}
		?>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
      </table></div></td>
      </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td width="45%" align="right"><input name="tradeupdate" class="search_bg" type="submit" id="tradeupdate" value="<?php echo $update; ?>" /></td>
      <td width="55%" align="right"><a href="trade_list.php" onclick="javascript:go(-1);" class="topics"><?php echo $back; ?></a></td>
      <!--      <td width="49%"><input name="cancel" type="submit" id="cancel" value="Cancel" onclick="return cance();"/></td>
-->      
    </tr>
  </table>
</form></td>
</tr>
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
