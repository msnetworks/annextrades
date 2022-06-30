<?php 
include("includes/header.php");
$id=$_REQUEST['id'];
$sess_id=$_SESSION['sess_id']; 
$id=$_REQUEST['id'];
$selectproduct=mysqli_query($con,"select * from product where id='$id'");
$rowproduct=mysqli_fetch_array($selectproduct);


if(isset($_REQUEST['cname']))
{
if($_REQUEST['cname']=='photo1')
{
$del=$_REQUEST['delid'];
$cname=$_REQUEST['cname'];

//echo "update product set photo1='' where id='$del'"; break;
$up=mysqli_query($con,"update product set photo1='' where id='$del'");

header("location:morephotos.php?succ&id=$del");
}
}
if(isset($_REQUEST['cname']))
{
if($_REQUEST['cname']=='photo2')
{
$del=$_REQUEST['delid'];
$cname=$_REQUEST['cname'];

$up=mysqli_query($con,"update product set photo2='' where id='$del'");
header("location:morephotos.php?succ&id=$del");
}
}
if(isset($_REQUEST['cname']))
{
if($_REQUEST['cname']=='photo3')
{
$del=$_REQUEST['delid'];
$cname=$_REQUEST['cname'];

$up=mysqli_query($con,"update product set photo3='' where id='$del'");
header("location:morephotos.php?succ&id=$del");
}
}

if(isset($_REQUEST['cname']))
{
if($_REQUEST['cname']=='photo4')
{
$del=$_REQUEST['delid'];
$cname=$_REQUEST['cname'];

$up=mysqli_query($con,"update product set photo4='' where id='$del'");
header("location:morephotos.php?succ&id=$del");
}
}

if(isset($_REQUEST['cname']))
{
if($_REQUEST['cname']=='photo5')
{
$del=$_REQUEST['delid'];
$cname=$_REQUEST['cname'];

$up=mysqli_query($con,"update product set photo5='' where id='$del'");
header("location:morephotos.php?succ&id=$del");
}
}
 ?>
 <style type="text/css">

 </style>
 
<div class="body-cont">
	<div class="body-cont1"> 
		<div class="company__container">
			<?php include("includes/side_menu.php"); ?>
			<div class="body-right"> 
				<?php include("includes/menu.php"); ?>
				<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
					<div   class="bordersty">
						<div class="headinggg"><?php echo $product_photos; ?> </div>
						<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
						<table width="100%" border="0" cellpadding="2" cellspacing="2">
							<?php 
								if(isset($_REQUEST['succ']))
								{
							?>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td colspan="4" style="color:#006600; font-weight:bold; padding-left:75px;"> <?php echo $delete_success; ?>...</td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="2"  ><span style="font-size:14px"><strong><?php echo $morephotos_pro;?></strong></span></td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<?php
												if($rowproduct['photo1']=="" && $rowproduct['photo2']=="" && $rowproduct['photo3']=="" && $rowproduct['photo4']=="" && $rowproduct['photo5']=="")
												{
											?>
											<td align="center"><span style="color:#FF0000"><?php echo $no_photos_found; ?></span></td>
											<?php
											}
											else
											{
											if($rowproduct['photo1']=="")
											{
											}else{
											?>
											<td width="20%" align="center"  nowrap="nowrap"><img src="<?PHP echo "productlogo/".$rowproduct['photo1'];?>" name="p_photo" width="100" height="100" border="0"><br />
											<a href="morephotos.php?delid=<?php echo $id;?>&cname=photo1" class="bottomlink" onclick="return confirm('Are you sure you wish to Delete this Record?');"><?php echo $delete; ?></a>&nbsp;/&nbsp;<a href="morephotosupdated.php?delid=<?php echo $id;?>&cname=photo1" class="bottomlink"><?php echo $update; ?></a></td>
											<?php
											}
											if($rowproduct['photo2']=="")
											{
											}else{
											?>
											<td width="20%" align="center" nowrap="nowrap"><img src="<?PHP echo "productlogo/".$rowproduct['photo2'];?>" name="p_photo"  width="100" height="100" border="0"><br />
											<a href="morephotos.php?delid=<?php echo $id;?>&cname=photo2" class="bottomlink" onclick="return confirm('Are you sure you wish to Delete this Record?');">
											<?php echo $delete; ?></a>&nbsp;/&nbsp;<a href="morephotosupdated.php?delid=<?php echo $id;?>&cname=photo2" class="bottomlink"><?php echo $update; ?></a></td>
											<?php
											}
											if($rowproduct['photo3']=="")
											{
											}else{
											?>
											<td width="20%" align="center" nowrap="nowrap"><img src="<?PHP echo "productlogo/".$rowproduct['photo3'];?>" name="p_photo" width="100" height="100" border="0"><br />
											<a href="morephotos.php?delid=<?php echo $id;?>&cname=photo3" class="bottomlink" onclick="return confirm('Are you sure you wish to Delete this Record?');"><?php echo $delete; ?></a>&nbsp;/&nbsp;<a href="morephotosupdated.php?delid=<?php echo $id;?>&cname=photo3" class="bottomlink"><?php echo $update; ?></a></td>
											<?php
											}
											if($rowproduct['photo4']=="")
											{
											}else{
											?>
											<td width="20%" align="center" nowrap="nowrap"><img src="<?PHP echo "productlogo/".$rowproduct['photo4'];?>" name="p_photo" width="100" height="100" border="0"><br />
											<a href="morephotos.php?delid=<?php echo $id;?>&cname=photo4" class="bottomlink" onclick="return confirm('Are you sure you wish to Delete this Record?');"><?php echo $delete; ?></a>&nbsp;/&nbsp;<a href="morephotosupdated.php?delid=<?php echo $id;?>&cname=photo4" class="bottomlink"><?php echo $update; ?></a></td>
											<?php
											}
											if($rowproduct['photo5']=="")
											{
											}else{
											?>
											<td width="20%" align="center" nowrap="nowrap"><img src="<?PHP echo "productlogo/".$rowproduct['photo5'];?>" name="p_photo" width="100" height="100" border="0"><br />
											<a href="morephotos.php?delid=<?php echo $id;?>&cname=photo5" class="bottomlink" onclick="return confirm('Are you sure you wish to Delete this Record?');"><?php echo $delete; ?></a>&nbsp;/&nbsp;<a href="morephotosupdated.php?delid=<?php echo $id;?>&cname=photo5" class="bottomlink"><?php echo $update; ?></a></td>
											<?php
												}
												}
											?>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>


<?php include("includes/footer.php"); ?>
