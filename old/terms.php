<?php 
include("db-connect/notfound.php"); 
$select_cms=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM cms"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #26ADC6; border-radius:5px;">
<tr>
<td height="30" style=" background-color:#26ADC6; " ><?php echo $terms_use; ?></td></tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align="justify" >
<?php echo $select_cms['terms_conditions']; ?>
</td></tr>




</table>


</body>
</html>