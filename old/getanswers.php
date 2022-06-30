<?php 
include "db-connect/notfound.php";
$id=$_REQUEST['id'];
if($_SESSION['language']=='english')
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_answers WHERE belong_id='$id'");
}
else if($_SESSION['language']=='french')
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_answers_french WHERE belong_id='$id'");
}
else if($_SESSION['language']=='chinese')
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_answers_chinese WHERE belong_id='$id'");
}
else
{
$sqlsubquestion=mysqli_query($con,"SELECT * FROM faq_answers_spanish WHERE belong_id='$id'");
}

?>
<table>

<tr><td>
 <select name="select1" size="5" multiple="multiple" style="width:770px" class="inTxtNormal" >
									<?php while($row=mysqli_fetch_assoc($sqlsubquestion)){ 
									
									?>
									<option value="<?php echo $row['id']; ?>" style="font-size:11px;"><?php echo $row['answer']; ?></option>
									<?php } ?>
                                    </select>
</td></tr>
</table>