<?php 
include("includes/header.php");
 include("easythumbnail.class.php");
if($session_user=="")
{

header("location:login.php");

}

$sess_id=$_SESSION['user_login'];

 ?>

<script language="javascript" type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
	{
		
		return;
	}
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
	{
		objCheckBoxes.checked = CheckValue;
		
	}
	else
	{
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
		{
			objCheckBoxes[i].checked = CheckValue;
		}
	}
}

function checkbox1() {
     
	var lengthcount=document.editrade.maxvalue.value;
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++)
	{
	 var checkbox = "checkbox["+i+"]";
	 var dom = document.getElementById(checkbox);
		if(dom.checked==true)
		{
			checkedcount++;
		}
	}
	if(checkedcount < 1)
	    {
			alert("Select Atleast One Checkbox");
			return false;
		}
	if( confirm('Are you sure you want to Delete this Record?') )
						{
						return true;
						}
						else
						{	
						return false; 
						}
}
function compare(){
  	if(document.editrade.maxvalue.value=="")
	{
	alert('Select Atleast One Checkbox');
	return false;
	}
	else
	{
	if( confirm('Are you sure you want to Delete this Record?') )
						{
						return true;
						}
						else
						{	
						return false; 
						}
	}
	//var result=checkbox1();
	//if(result == false)
	//{
	//	return false;
	//}
	//else
	//{
		// document.inbox.submit();
	//}
}

</script>
<script language="javascript" type="text/javascript">
function show(value)
{
if(value=="productcate")
		{
			//alert("hai");
			document.getElementById("productcate").style.display='block';
		}
		else
		{
		 document.getElementById("productcate").style.display='none';
		} 	
}


function show1(value)
{
if(value=="regioncate")
		{
			document.getElementById("regioncate").style.display='block';
		}
		else
		{
		 document.getElementById("productcate").style.display='none';
		} 	
}
function popUp(URL) 
{
  window.open(URL, '','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100');
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

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div class="headinggg"> <?php echo $my_trade_alert;?></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #0075b0">
	



<?PHP $um=$_REQUEST['updatemessage'];
if($um==3)
{
 $upmessage="Your Trade Alert Has Been Updated Successfully";
} 
?>
	<tr>
	  <td align="center" class="border_box" colspan="7" ><font color="#E10071"><span style="font-size:14px"><?PHP echo $upmessage;?></span></font></td>
	  </tr>
	  <?PHP $trade=$_REQUEST['tradedel'];
if($trade==5)
{
 $deleted="Your Trade Alert Has Been Deleted Successfully";
} 
?>

	  
	<tr>
	  <td align="center" colspan="3" class="border_box" ><font color="#FF0000"><span style="font-size:14px"><?PHP echo $deleted;?></span></font></td>
	  </tr>
	<tr>
	<td class="border_box" colspan="3">
	<form action="" method="post" name="editrade" id="editrade" >
	 &nbsp;&nbsp;<a href="trade.php"><?php echo $add_new_key; ?> </a><a href="trade.php" class="news"></a>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
			<td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #EFEEEE;"> 
               <?php 	
						 	$sql_r=mysqli_query($con,"select * from `registration` where  id='$sess_id'"); 
							$count_r=mysqli_num_rows($sql_r);
							$array_r=mysqli_fetch_array($sql_r);
							$mail= $array_r['email'];
							//echo "select * from `trade_alert` where user_id='$sess_id'";exit;
							if($_SESSION['language']=='english')
						{
						$select=mysqli_query($con,"select * from `trade_alert` where user_id='$sess_id' AND lang_status='0'");
						}
						else if($_SESSION['language']=='french')
						{
						$select=mysqli_query($con,"select * from `trade_alert` where user_id='$sess_id' AND lang_status='1'");
						}
						else
						{
						$select=mysqli_query($con,"select * from `trade_alert` where user_id='$sess_id' AND lang_status='2'");
						}
						//$select=mysqli_query($con,"select * from `trade_alert` where user_id='$sess_id'");							
		                    $listcnt=mysqli_num_rows($select);
				?>
						
			 
			      <tr >
                    <td height="30" width="129">
				
				  <strong ><a href="#" onclick="javascript:SetAllCheckBoxes('editrade', 'checkbox[]', true)"><?php echo $select_all; ?></a><a href="#" class="topics2" onclick="javascript:SetAllCheckBoxes('editrade', 'checkbox[]', true)"></a> / <a href="#" onclick="javascript:SetAllCheckBoxes('editrade', 'checkbox[]', false)"><?php echo $clear_all ; ?></a><a href="#" class="topics2" onclick="javascript:SetAllCheckBoxes('editrade', 'checkbox[]', false)"></a> </strong></td>
                    <td width="134" class=""><strong><?php echo $keywords; ?></strong></td>
                    <td width="140" class=""><strong><?php echo $info; ?></strong></td>
                    <td width="173" class=""><strong><?php echo $category_filter; ?></strong></td>
                    <td width="114" class=""><strong><?php echo $region_filter; ?></strong></td>
                    <td width="35" class=""><strong><?php echo $edit; ?></strong></td>
                  </tr>
                  <tr>
                    <td colspan="6" align="center" style="border-bottom:1px solid #EFEEEE;"><img src="images/spacer.gif" width="1" height="1" /> </td>
                  </tr>
                <?PHP 
				  $i=0;
				  
				  if(mysqli_num_rows($select)> 0) {
				  while($array_in=mysqli_fetch_array($select))
				  { 
				  $tradeid=$array_in['trade_id'];
				 ?>
                  <tr class="inbgAinn">
                    <td width="129" height="30" class="bluebold" align="center"><!-- check box select all-->
                        <input type="checkbox" name="checkbox[]" value="<?php echo $tradeid; ?>" id="checkbox[<?PHP echo $i;?>]" /></td>
                    <!---->
                    <td><a href="edit_trade.php?tid=<?PHP echo $tradeid;?>" class="topics2"><?PHP echo $array_in['keyword'];?></a></td>
                    <td><span style="font-size:12"><?PHP echo $array_in['selectinfo'];?></span></td>
						<?PHP 
						  $catids=$array_in['product']; 
					      ?>
                    <td>
					<?PHP 
					if($array_in['product_selection']=="All") 
					{ 
					?>
					<span style="font-size:12"><?PHP echo $array_in['product_selection'];?></span>
					<?PHP
					 } 
					 else 
					 {
					 ?>
					 <a href="Javascript:popUp('product_category.php?cids=<?PHP echo $catids;?>');" class="bottomlink"><?PHP echo $array_in['product_selection'];?></a>
					 <?PHP 
					 } 
					 ?>
					 </td>
					
		          	<?PHP 
					   $catids1=$array_in['region']; 
					 ?>
					
                    <td>
					<?PHP 
					if($array_in['region_selection']=="All") 
					{ 
					?>
					<span style="font-size:12"><?PHP echo $array_in['region_selection'];?></span>
					<?PHP 
					}
					else
					{
					?>
					<a href="javascript:popUp('region_category.php?rids=<?PHP echo $catids1;?>');"  class="bottomlink" ><?PHP echo $array_in['region_selection'];?></a>
					<?PHP
					 }
					 ?>
					 </td>
                    <td align="left" class="inTxtNormal"><a href="edit_trade.php?tid=<?PHP echo $tradeid;?>" class="news"><?php echo $edit; ?><!--<input type="image" name="imageField" src="images/edit_f2.png" />--></a></td>
                  </tr>
                              
				                    <!--<tr>
                    <td colspan="6" align="center" bgcolor="#FFFFFF" style="border-top:1px solid #EFEEEE;border-bottom:1px solid #EFEEEE;"><img src="images/spacer.gif" width="1" height="5" /> </td>
                  </tr>-->
                            
                 <!-- <tr>
                    <td height="30" colspan="6" align="center" class="inTxtSHead"><div align="center" class="inTxtHead"><strong>No Records Found</strong></div></td>
                  </tr>-->
                <?PHP
				$i++;
				 }
				 
				 }
				 else {
                 ?>
				  <tr>
                    <td colspan="6" align="center" style="border-bottom:1px solid #EFEEEE;" class="blackBo"> <?php echo $no_trade_alert;?>. <a href="trade.php" class="bluueboldli"><?php echo $add_new_alert; ?></a></td>
                  </tr>
				  <?php } ?>
				   <input name="maxvalue" type="hidden" value="<?php echo $i; ?>" />
				 </table></td>
			</tr>
			<tr>
			  <td align="center" height="35"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%" align="center">
<?php   if(mysqli_num_rows($select)> 0) { ?>
      <input name="tradedelete" type="submit" class="search_bg" id="tradedelete" onclick="return checkbox1();" value="<?php echo $delete; ?>" /> <?php } ?>
    </td>
    <td width="69%" class="more"></td>
  </tr>
</table></td>
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



</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
