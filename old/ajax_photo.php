<?php
//include("../config/error.php");
include("db-connect/notfound.php"); 
$pro_id=$_REQUEST['id'];
//echo $categ;
?>
<div id="myDiv"></div>
<?php
$sql="SELECT * FROM product WHERE id='$pro_id'";
$res_pro=mysqli_query($con,$sql);
$fetch_pro=mysqli_fetch_array($res_pro);
$a1=$fetch_pro['photo1'];
$a2=$fetch_pro['photo2'];
$a3=$fetch_pro['photo3'];
$a4=$fetch_pro['photo4'];
$a5=$fetch_pro['photo5'];
if($a1&&$a2&&$a3&&$a4&&$a5)
{
	$count=6;
}
else if($a1&&$a2&&$a3&&$a4)
{
	$count=5;
}
else if($a1&&$a2&&$a3)
	
	{
		$count=4;
}
else if($a1&&$a2)
	
	{
		$count=3;
}
else if($a1)
	{
		$count=2;
}

if($count==6)
{
	echo "Maximum 5 Photos are allowed";
}

//$arr=array('$a1','$a2','$a3','$a4','$a5');
//echo $count;
$i=0;
while($count<=5)
{
	//echo $count;
?>
<input type='file' name='photo<?php echo $count; ?>' id='photo<?php echo $count; ?>'>
<?php
$count++;
}
?>
