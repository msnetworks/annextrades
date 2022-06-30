<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/help_side_menu.php"); ?>
<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div style="background-color:#29b1cb; height:25px; padding-top:7px;"><b style="color:#FFFFFF; margin-left:12px; font-size:14px;"><?php echo $frequently_asked; ?></b></div>
<div style="color:#C55000; margin-left:10px; margin-top:15px;"><b style="font-size:14px;"><?php echo $top_ques; ?></b></div>

<table border="0" width="100%" style="margin-top:10px;">
<?php 
if($_SESSION['language']=='english')
{
$select=mysqli_query($con,"select * from que_ans");
}
else if($_SESSION['language']=='french')
{
$select=mysqli_query($con,"select * from que_ans_french");
}
else if($_SESSION['language']=='chinese')
{
$select=mysqli_query($con,"select * from que_ans_chinese");
}
else
{
$select=mysqli_query($con,"select * from que_ans_spanish");
}
	//$select=mysqli_query($con,"select * from que_ans");
	while($questions=mysqli_fetch_array($select))
	{
?>
	<tr>
		<td width="2%" style="padding-left:60px;"><li><strong></strong></li></td>
		<td width="98%" style="color:#727272;"><a href="help_view.php?view=<?php echo $questions['id']; ?>"><?php echo $questions['question']; ?></a></td>
	</tr>
<?php } ?>

<table>
	<tr>
		<td style="padding-left:700px;"><a href="faq_contactus.php"><?php echo $more; ?>...</a></td>
	</tr>
</table>
</table>



<div style="border-bottom:1px solid #efefef; height:1px; margin-top:10px;"></div>
<div style="color:#C55000; margin-left:10px; margin-top:15px;"><b style="font-size:14px;"><?php echo $help_topics; ?></b></div>

<table border="0" width="100%" style="margin-top:10px;">
<?php 
if($_SESSION['language']=='english')
{
$sel_qry=mysqli_query($con,"select * from helptopic_category");
}
else if($_SESSION['language']=='french')
{
$sel_qry=mysqli_query($con,"select * from helptopic_category_french");
}
else if($_SESSION['language']=='chinese')
{
$sel_qry=mysqli_query($con,"select * from helptopic_category_chinese");
}
else
{
$sel_qry=mysqli_query($con,"select * from helptopic_category_spanish");
}
	
	while($category=mysqli_fetch_array($sel_qry))
	{
?>
	<tr>
		<td style="color:#727272; padding-left:50px;"><?php echo $category['category']; ?></td>
	</tr>
	<tr>
		<td><table border="0" cellspacing="5"  style="padding-left:70px;">
		<tr>
			<?php 
				$id=$category['id'];
				if($_SESSION['language']=='english')
{
$selsubcat=mysqli_query($con,"select * from helptopic where category_id='$id' ");
}
else if($_SESSION['language']=='french')
{
$selsubcat=mysqli_query($con,"select * from helptopic_french where category_id='$id' ");
}
else if($_SESSION['language']=='chinese')
{
$selsubcat=mysqli_query($con,"select * from helptopic_chinese where category_id='$id' ");
}
else
{
$selsubcat=mysqli_query($con,"select * from helptopic_spanish where category_id='$id' ");
}
				//$selsubcat=mysqli_query($con,"select * from helptopic where category_id='$id' ");
				$i=0;
				while($subcat=mysqli_fetch_array($selsubcat))
				{
					$i++;
			?>
			
				<td><?php if($i!=1) { echo "|"; } echo '&nbsp;'; ?><a href="<?php echo $subcat['topic_link']; ?>"><?php echo $subcat['topicname']; ?></a></td>
				<?php if($i%3==0) { ?>
			
			<tr><?php } ?>
			<?php } ?>
			</tr>
		</table></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
<?php } ?>
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
