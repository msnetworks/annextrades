<?PHP 
/* include "../controller/config.php";
$id = $_POST['id'];
//$result = $id;
$sql = "SELECT * FROM `category` WHERE `parent_id`='$id'";
$query = mysqli_query($con,$sql);
while($sub = mysqli_fetch_array($query))
{
//$result = "<option value='".$sub['c_id']."'>".$sub['category']."</option>";
}
echo json_decode($result); */
?>
<?php
require_once "../controller/config.php";
$category_id = $_POST["category_id"];
$result = mysqli_query($conn,"SELECT * FROM category where parent_id = $category_id");
?>
<option value="">Select SubCategory</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["c_id"];?>"><?php echo $row["category"];?></option>
<?php
}
?>