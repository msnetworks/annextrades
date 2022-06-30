<?php 
	include("includes/header.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
	
	if(isset($_REQUEST['subid']))
	{
		$subid=$_REQUEST['subid'];
	}
	$query=mysqli_query($con,"select * from registration where id='$session_user'");
	$row=mysqli_fetch_array($query);
	$firstname=$row['firstname'];
	
	if(isset($_REQUEST['post']))
	{
		  $topic=$_REQUEST['topic'];
		  $msg=$_POST['msg'];
		  $today = date("F j, Y"); 
		  //$today1 = date("g:i a");
		  $today1 = date("g:i a"); 
		  //echo "SYSDATE()";
		  //echo "insert into forums(topic,parentid,description ,postedby,time,date)values('$topic','$subid','$msg','$firstname','$today','$today1()')"; exit;
		  mysqli_query($con,"insert into forums(topic,parentid,description ,postedby,time,date)values('$topic','$subid','$msg','$firstname','$today','$today1')");
		  header("location:subtopic_new.php?subid=$subid");
	}

?>
<script>
function checkval()
{

	if(trim(document.reply.topic.value)=="")
	{
	alert("Please Enter Topic");
	document.reply.topic.value="";
	document.reply.topic.focus();
	return false;
	}

	if(trim(document.reply.msg.value)=="")
	{
	alert("Please Enter Message");
	document.reply.msg.value="";
	document.reply.msg.focus();
	return false;
	}

}

function trim(str, chars) {
    return ltrim(rtrim(str, chars), chars);
}

function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

function rtrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
</script>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $my_coommunity; ?> </div>
<?php include("includes/sidebar.php"); ?>
</div>
<?php include("includes/innerside1.php"); ?>
</div>

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"><?php echo $post_new_top; ?></div>
<div style="border: solid 1px #CFCFCF;">
<table border="0" width="100%" style="padding-top:10px; padding-left:10px;">
<form action="" method="post" name="reply" id="reply">
	<tr>
		<td width="19%"><span style="color:#FF0000">*</span>&nbsp;<?php echo $subject; ?></td>
		<td width="81%"><input type="text" name="topic" id="topicSubject" style="width:260px; height:15px;"></td>
	</tr>
	<tr>
		<td width="19%"><span style="color:#FF0000">*</span>&nbsp;<?php echo $message; ?></td>
		<td width="81%"><textarea name="msg" rows="5" cols="30"></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding-top:10px;"><input name="post" type="submit" value="Post" class="search_bg" onclick="return checkval();"></td>
	</tr>
</form>	
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
<div>
