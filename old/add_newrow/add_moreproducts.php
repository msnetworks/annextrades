<?php 
if(isset($_POST['submit']))
{

/*$newfilename=basename($_FILES['clg_0']['name']);
$uploaddir='upload/';
$uploadfile=$uploaddir . $newfilename;
if(move_uploaded_file($_FILES['clg_0']['tmp_name'], $uploadfile))
{
echo "uploaded successfully";
}
else
{
echo "error";
}*/


}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script src="add_delRow.js" type="text/javascript"></script>
<script type="text/javascript">
function validation()
{
var a=document.image_form.clg_0.value;
var c=document.image_form.clg_1.value;
var d=document.image_form.clg_2.value;
var e=document.image_form.clg_3.value;
if(a!="")
{
splt=a.split('.');
chksplt=splt[1].toLowerCase();

if(chksplt=='jpg' || chksplt=='jpeg'|| chksplt=='bmp'|| chksplt=='png'|| chksplt=='gif'){

}else{
alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
document.image_form.clg_0.value='';
document.image_form.clg_0.focus();
return false;
}
}



if(c!="")
{
splt1=c.split('.');
chksplt1=splt1[1].toLowerCase();

if(chksplt1=='jpg' || chksplt1=='jpeg'|| chksplt1=='bmp'|| chksplt1=='png'|| chksplt1=='gif'){

}else{
alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
document.image_form.clg_1.value='';
document.image_form.clg_1.focus();
return false;
}
}


if(d!="")
{
splt2=d.split('.');
chksplt2=splt2[1].toLowerCase();

if(chksplt2=='jpg' || chksplt2=='jpeg'|| chksplt2=='bmp'|| chksplt2=='png'|| chksplt2=='gif'){

}else{
alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
document.image_form.clg_2.value='';
document.image_form.clg_2.focus();
return false;
}
}


if(d!="")
{
splt3=e.split('.');
chksplt3=splt3[1].toLowerCase();

if(chksplt3=='jpg' || chksplt3=='jpeg'|| chksplt3=='bmp'|| chksplt3=='png'|| chksplt3=='gif'){

}else{
alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
document.image_form.clg_3.value='';
document.image_form.clg_3.focus();
return false;
}
}

return true;
}
</script>
</head>

<body>

<form name="image_form" method="post" enctype="multipart/form-data" onsubmit="return validation();">

<table width="450" id="dataTable">
		

<tr height="35">
                              <td align="left" class="polldes"><span class="message"></span></td>
                              <td align="center" class="name1">:</td>
                              <td  align="left" valign="top">
							  <table id="dataTable" width="100%">
							  <tr>
							  <td width="1">&nbsp;							  </td>
							  <td width="1"></td>
							  <td width="221">
                                <input type="file" name="clg_0" id="clg_0" size="40" value="" onKeyDown="return chkkeycode(event,this.id)" class="textarea" /> 
								
							<div id="b_0_err" style="display:none; color:#FF3300;"></div>
							</td>
							
							  <td width="30"><img src="plus_icon.png" border="0" onClick="addRow_new('dataTable','clg','clgfrm','clgto')" title="Add New Point" /></td>
							  
							 
							  
							  </tr>
							 
							  </table></td>
                            </tr>





		  </table>
		   <tr><td> <input type="submit" name="submit" value="Submit" /></td></tr>
</form>


</body>
</html>
