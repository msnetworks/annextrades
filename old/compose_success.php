<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	
	if(isset($_REQUEST['delete']))
	{
		$selected_friends = $_POST['checkbox'];
		foreach($selected_friends as $sel)
		{
			mysqli_query($con,"UPDATE `messages` SET `tostatus`='1'  WHERE `id`=$sel");  
						 
		}   
		header("location:inbox.php"); 
	}
?>

<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
<?php 
$user_type=$fetch_log['usertype']; 
if($user_type==1) { $usertype="Buyer"; } elseif($user_type==2) { $usertype="seller"; }  elseif($user_type==3) { $usertype="Both Buyer & Seller"; }  else { $usertype="Not Mentioned"; }
$user_type=$fetch_log['gender']; 
//if($gender==1) { $gen="";
?>
<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="79%" valign="top"><b><?php echo $send_success; ?></b></td>
                    
                  </tr>
                  
                
                  
                </table>
</div>

</div></div>

</div>

<div class="body-cont4"> 

</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
