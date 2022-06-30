<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>
            <div class="body-right">

                <?php include("includes/menu.php"); ?>

                <div class="tabs-cont">
                    <div class="left">
                        <div class="bordersty">
                        <div class="headinggg"><?php echo $sent_items; ?></div>
                            
                            <?php 
	$view_msg=$_REQUEST['view'];
	$sql=mysqli_query($con,"select * from `messages` where  id='$view_msg' ");
	$count_msg=mysqli_num_rows($sql);
	$array_msg=mysqli_fetch_array($sql);
?>
                            <?php 
	if(isset($_REQUEST['delete']))
	{
	 	$deleteid=$_REQUEST['delid'];
 	 	$updatetsql_d ="UPDATE `messages` SET `fromstatus`='1'  WHERE `id`='$deleteid'";
 	 	$query_up_d=mysqli_query($con,$updatetsql_d);
 		header("location:sentitems.php?deleted"); 
	}
?>
                            <form id="form1" name="c_message" method="post"
                                action="sent_items_view.php?delid=<?php echo $view_msg; ?>">
                                <table border="0" width="100%" style="margin-top:20px; margin-left:40px;">
                                    <!-- <tr>
                                        <td width="11%" style="line-height:30px;"><b><?php echo $to; ?></b></td>
                                        <td width="2%" style="line-height:30px;"><b>:</b></td>
                                        <td width="87%" style="line-height:30px;"><?php echo $array_msg['to_mail']; ?>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td style="line-height:30px;"><b><?php echo $subject; ?></b></td>
                                        <td style="line-height:30px;"><b>:</b></td>
                                        <td style="line-height:30px;"><?php echo $array_msg['subject']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height:30px;"><b><?php echo $message; ?></b></td>
                                        <td style="line-height:30px;"><b>:</b></td>
                                        <td style="line-height:30px;"><?php echo $array_msg['message']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td style="padding-left:150px;"><input type="button" name="Submit"
                                                value="<?php echo $reply; ?>" class="search_bg" style="width: 100px"
                                                onClick="javascript:location.href='sent_compose.php?comp=<?php echo $view_msg; ?>';" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="submit" name="delete" class="search_bg" style="width: 100px"
                                                value="<?php echo $delete; ?>" onClick="if(confirm('Are you sure you want to Delete this Record?'))
                        {  				
							return true;
						}
						else
						{	
							return false; 
						}" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


</div>

<?php include("includes/footer.php"); ?>

 

