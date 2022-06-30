<?PHP 
include "db-connect/notfound.php";
$id = $_GET['id'];
$sql = "SELECT * FROM `category` WHERE `parent_id`='$id'";
$query = mysqli_query($con,$sql);
?>
<select name="subcategory" onchange="document.buying.sub_cat.value=this.value;" class="select1 form-control">
 <option value="">Select Sub Category</option>
 <?PHP
while($sub = mysqli_fetch_array($query))
{
?>
<option value="<?PHP echo $sub['c_id'];?>"><?PHP echo $sub['category']; ?></option>
<?PHP 
}
?>
</select>