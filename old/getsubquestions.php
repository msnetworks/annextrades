<?php 
include "db-connect/notfound.php";
$id=$_REQUEST['id'];
if($_SESSION['language']=='english')
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_relatquestion WHERE belong_id='$id'");
}
else if($_SESSION['language']=='french')
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_relatquestion_french WHERE belong_id='$id'");
}
else if($_SESSION['language']=='chinese')
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_relatquestion_chinese WHERE belong_id='$id'");
}
else
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_relatquestion_spanish WHERE belong_id='$id'");
}

?>
<table>

<tr><td style="padding-left:3px;">
 <select name="select2" size="5" multiple="multiple" style="width:770px" onchange="getanswers(this.value);" class="inTxtNormal">
									<?php while($row=mysqli_fetch_assoc($sqlsubquestion)){ 
									
									?>
									<option value="<?php echo $row['id']; ?>" style="font-size:11px;"><?php echo $row['question']; ?></option>
									<?php } ?>
                                    </select>
</td></tr>
<tr><td><div id="answers"></div></td></tr>
</table>