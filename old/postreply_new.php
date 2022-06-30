<?php 
	include("includes/header.php");
	if($session_user=="")
	{
		header("location:login.php");
	}
	
	if(isset($_REQUEST['fid']))
	{
		$fid=$_REQUEST['fid'];
		$select=mysqli_query($con,"select * from forums where fid='$fid'");
		$fetch=mysqli_fetch_array($select);
		$ffid=$fetch['parentid'];
	}
	$rid=$_REQUEST['rid'];

	$query=mysqli_query($con,"select * from registration where id='$session_user'");
	$row=mysqli_fetch_array($query);
	$firstname=$row['firstname'];

	if(isset($_REQUEST['reply2']))
	{
		  $querymain=mysqli_query($con,"select * from forums where fid='$fid'");
		  $fetchmain=mysqli_fetch_array($querymain);
		  $mainheadingid=$fetchmain['mainheadingid'];
		 $topic=$_REQUEST['topic'];
		 $msg=$_POST['msg'];
		 $today = date("F j, Y"); 
		 $today1 = date("g:i a"); 
		mysqli_query($con, "insert into forumreply(topicid,reply,replytime,replydate,postedby)values('$fid','$msg','$today1','$today','$firstname')");
		header("location:subtopic_new.php?subid=$ffid");
	}
	if(isset($_REQUEST['replyeditpost']))
	{
		$topic=$_REQUEST['topic1'];
		$msg=$_POST['msg1'];
		$today = date("F j, Y"); 
		$today1 = date("g:i a"); 
		 mysqli_query($con,"update forumreply  set reply='$msg',replytime='$today1',replydate='$today' where rid='$rid'");
		 header("location:subtopic_new.php?subid=$ffid");
	}
?>
<script>
function checkvalid()
{

	if(document.reply.msg.value=="")
	{
	alert("Please Enter Message");
	document.reply.msg.focus();
	return false;
	}
}
function check1()
{
	if(document.reply1.msg1.value=="")
	{
	alert("Please Enter Message");
	document.reply1.msg1.focus();
	return false;
	}
}
</script>
<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"><?php echo $my_coommunity; ?></div>
<?php /*?><?php include("includes/sidebar.php"); ?><?php */?>
<?php include("includes/comm_side_menul.php"); ?>
</div>
<?php include("includes/innerside1.php"); ?>
</div>

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"></div>
<div style="border: solid 1px #CFCFCF;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="1%" align="left" valign="top"></td>
                              <td width="98%" height="25" valign="middle" class="browse_center"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="98%" height="22" class="browsetext"><?php echo $postreply_new_pstrep;?></td>
                                  </tr>
                              </table></td>
                              <td width="1%" align="right" valign="top"></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="border_box">
                            <tr>
                              <td valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
                                
                                <tr>
                                  <td valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                            <tr> </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td><?PHP 
					 if(isset($_REQUEST['reply1']))
					 {
					   $select=mysqli_query($con,"select * from forums where fid='$fid'");
					   while($row=mysqli_fetch_array($select))
					   {
					 ?>
                                            <form action="" method="post" name="reply" id="reply">
                                              <table id="form" border="0" cellpadding="3" cellspacing="2" width="100%">
                                                <tr>
                                                  <th width="30%" class="seller" align="left"><span style="color:#FF0000;">*</span> <?php echo $subject; ?></th>
                                                  <td><input name="topic" type="text" class="textBox" id="topicSubject" value="<?PHP echo $row['topic']; ?>" size="40" readonly="true"/>                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td height="80" valign="top" class="seller" align="left"><span style="color:#FF0000;">*</span>&nbsp;<b><?php echo $message; ?></b></td>
                                                  <td rowspan="2" valign="top"><textarea name="msg" rows="3" cols="40"></textarea></td>
                                                </tr>
                                                <tr>
                                                  <td colspan="4" align="center"><input name="reply2" class="search_bg" type="submit" value="<?php echo $submit; ?>"  onclick="return checkvalid();"/></td>
                                                </tr>
                                              </table>
                                            </form>
                                          <?PHP } }
					 if(isset($_REQUEST['replyedit']))
					 { 
					   $rid=$_REQUEST['rid'];
					  $select=mysqli_query($con,"select * from forums where fid='$fid'");
			           while($row=mysqli_fetch_array($select))
			           {
					    $selectreply=mysqli_query($con,"select * from forumreply where topicid='$row[fid]' and rid='$rid'");
					    $fetchrow=mysqli_fetch_array($selectreply);					   
					?>
                                            <form action="" method="post" name="reply1" id="reply">
                                              <table id="form" border="0" cellpadding="3" cellspacing="2" width="100%" style="border:0px solid #000000;">
                                                <tr>
                                                  <th width="30%" class="" align="left"><font class="redbold">*</font> <strong><?php echo $subject; ?>:</strong></th>
                                                  <td><input name="topic1" type="text" class="textBox" id="topicSubject" value="<?PHP echo $row['topic'];?>" size="53" maxlength="256" readonly="true"/>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td height="72" valign="top" class=""><font class="redbold">*</font> <strong><?php echo $message; ?>:</strong></td>
                                                  <td rowspan="2" valign="top"><textarea name="msg1" rows="3" cols="40"><?PHP echo $fetchrow['reply'];?></textarea>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td colspan="4" align="center"><input name="replyeditpost" type="submit" value="<?php echo $post; ?>" class="search_bg"  onclick="return check();"/></td>
                                                </tr>
                                              </table>
                                            </form>
                                          <?PHP }}?>
                                        </td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td></td>
                                </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                        <tr>
					  	<td >
						 <table cellpadding="0" cellspacing="0" border="0" width="100%" >
						 	
						</table>
					</td>
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
<div>
