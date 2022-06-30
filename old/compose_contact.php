<?php 
	include("includes/header.php");
	include("includes/pagination.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
?>

<script type="text/javascript">
function popUp1(URL)
{
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300,left = 150,top = 234');");
}
</script>

<script type="text/javascript">
function ValidateForm()
{
	if(document.compose.to.value=="")
	{
		alert("Please Enter to Address");
		document.compose.to.focus();
		return false;
	}
	
	if(document.compose.subject.value=="")
	{
		alert("Please Enter The Subject");
		document.compose.subject.focus();
		return false;
	}			
			
	if(document.compose.message.value=="")
	{
		alert("Please Enter The Message");
		document.compose.message.focus();
		return false;
	}					
}

function echeck(str) 
{

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}
		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }
		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
 		 return true
				
}


</script>

<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $compose; ?></b></div>
<form id="form1" name="compose" method="post" action="save.php" onsubmit="return ValidateForm();">
<table border="0" width="100%" style="margin-top:20px; margin-left:40px;">
<?php 
	$sql=mysqli_query($con,"select * from registration where id='$session_user' ");
	$compose=mysqli_fetch_array($sql);
?>
<?php 
	if(isset($_REQUEST['success'])) {
?>
<tr>
		<td colspan="3" align="center" style="color:#C55000"><b><?php echo $send_success; ?>&nbsp;!</b></td>
</tr>
<?php } ?>
	<tr>
		<td width="9%" style="line-height:30px;"><span style="color:#FF0000">*</span><b>&nbsp;<?php echo $from; ?></b></td>
		<td width="2%" style="line-height:30px;"><b>:</b></td>
		<td width="89%" style="line-height:30px;"><input type="text" name="from" id="from" value="<?php echo $compose['email']; ?>" readonly="readonly" style="width:250px; height:15px;"></td>
	</tr>
	
	<tr>
		<td style="line-height:30px;"><span style="color:#FF0000">*</span><b>&nbsp;<?php echo $to; ?></b></td>
		<td style="line-height:30px;"><b>:</b></td>
		<?php
			if(isset($_SESSION['checklisted']))
			{
			$seltest=$_SESSION['checklisted']; 
			$z=explode(",",$seltest); 
			if($z[0]!='')
			{
				for($j=0;$j<count($z);$j++)
					{						 
						$select="select * from add_contacts where contact_id='$z[$j]'";
						$res=mysqli_query($con,$select);							
						$res_fetch=mysqli_fetch_array($res);
						$resultarray=$res_fetch['contact_mail'];
						$xyz.="$resultarray".","; 														
					}			
			} 
			
			if(isset($_REQUEST['MM']))
			{
				$userid=$_REQUEST['MM'];
				$select="select * from add_contacts where contact_id='$z[$j]'";
						$res=mysqli_query($con,$select);							
						$res_fetch=mysqli_fetch_array($res);
						$resultarray=$res_fetch['contact_mail'];
						$xyz=$resultarray;
			}
	   ?>
		<td style="line-height:30px;"><input type="text" name="to" id="to" value="<?php echo $xyz; ?>" readonly="true" style="width:250px; height:15px;" />
		<a href="javascript:popUp1('contact_list.php')" class="topics2"><?php echo $add_contact_list; ?></a></td>
		<?php
			unset($xyz);
			unset($_SESSION['checklisted']);
			}
			else
			{ 
				if(isset($_REQUEST['MM']))
				{
					$inid=$_REQUEST['MM'];
					$res=mysqli_fetch_array(mysqli_query($con,"select * from `add_contacts` where contact_id='$inid'"));
					$fmail=$res['contact_mail'];
		?>
		<td style="line-height:30px;"><input type="text" value="<?php echo $fmail;?>" readonly="true" style="width:250px; height:15px;" />
		<a href="javascript:popUp1('contact_list.php')" class="topics2"><?php echo $add_contact_list; ?></a></td>
		<?php
			}
			else
			{
		?>
		<td style="line-height:30px;"><input type="text" readonly="true" style="width:250px; height:15px;" />
		<a href="javascript:popUp1('contact_list.php')" class="topics2"><?php echo $add_contact_list; ?></a></td>
		<?php
			}
			}
		?>
	</tr>
	<tr>
		<td style="line-height:30px;"><span style="color:#FF0000">*</span>&nbsp;<b><?php echo $subject; ?></b></td>
		<td style="line-height:30px;"><b>:</b></td>
		<td style="line-height:30px;"><input type="text" name="subject" id="subject" style="width:250px; height:15px;"></td>
	</tr>
	<tr>
		<td style="line-height:30px;"><span style="color:#FF0000">*</span>&nbsp;<b><?php echo $message; ?></b></td>
		<td style="line-height:30px;"><b>:</b></td>
		<td style="line-height:30px;"><textarea name="message" id="message" rows="3" cols="40"></textarea></td>
	</tr>
	<tr>
		<td height="35" colspan="3" align="left"><div align="center"><input type="submit" class="search_bg" name="Submit_compose" value="<?php echo $submit; ?>" /></div></td>
	</tr>
</table>
</form>
</div>

</div></div>

</div>

<div class="body-cont4"> 

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
