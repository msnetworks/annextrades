<?php 
include("includes/header.php");
include("easythumbnail.class.php");
include_once("library/function.php");
$del=$_REQUEST['delid'];
$cname=$_REQUEST['cname'];
$se=mysqli_fetch_array(mysqli_query($con,"select * from product where id='$del'"));
$oldphoto1=$se['photo1'];
$oldphoto2=$se['photo2'];
$oldphoto3=$se['photo3'];
$oldphoto4=$se['photo4'];
$oldphoto5=$se['photo5'];

if(isset($_REQUEST['upload']))
{
if($_REQUEST['cname']=="photo1")
{
$del=$_REQUEST['delid'];
//$uploaddir1='productlogo/';
$newphoto1=$_FILES['photo1']['name'];
$uploadfile1=$uploaddir1 . $newphoto1;
move_uploaded_file($_FILES['photo1']['tmp_name'], $uploadfile1);
$ftimages1 = "productlogo/".$newphoto1;
$thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

if($newphoto1!="")
{
$photo1=$newphoto1; 
}
else
{
$photo1=$oldphoto1;
}
$p1update=mysqli_query($con,"update product set photo1='$photo1' where id='$del'");
header("location:morephotosupdated.php?err&id=$del");
}

if($_REQUEST['cname']=="photo2")
{
$del=$_REQUEST['delid'];
//$uploaddir1='productlogo/';
$newphoto1=$_FILES['photo2']['name'];
$uploadfile1=$uploaddir1 . $newphoto1;
move_uploaded_file($_FILES['photo2']['tmp_name'], $uploadfile1);
$ftimages1 = "productlogo/".$newphoto1;
$thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

if($newphoto1!="")
{
$photo1=$newphoto1; 
}
else
{
$photo1=$oldphoto2;
}
$p1update=mysqli_query($con,"update product set photo2='$photo1' where id='$del'");
header("location:morephotosupdated.php?err&id=$del");
}

if($_REQUEST['cname']=="photo3")
{
$del=$_REQUEST['delid'];
//$uploaddir1='productlogo/';
$newphoto1=$_FILES['photo3']['name'];
$uploadfile1=$uploaddir1 . $newphoto1;
move_uploaded_file($_FILES['photo3']['tmp_name'], $uploadfile1);
$ftimages1 = "productlogo/".$newphoto1;
$thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

if($newphoto1!="")
{
$photo1=$newphoto1; 
}
else
{
$photo1=$oldphoto3;
}
$p1update=mysqli_query($con,"update product set photo3='$photo1' where id='$del'");
header("location:morephotosupdated.php?err&id=$del");
}

if($_REQUEST['cname']=="photo4")
{
$del=$_REQUEST['delid'];
//$uploaddir1='productlogo/';
$newphoto1=$_FILES['photo4']['name'];
$uploadfile1=$uploaddir1 . $newphoto1;
move_uploaded_file($_FILES['photo4']['tmp_name'], $uploadfile1);
$ftimages1 = "productlogo/".$newphoto1;
$thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

if($newphoto1!="")
{
$photo1=$newphoto1; 
}
else
{
$photo1=$oldphoto4;
}
$p1update=mysqli_query($con,"update product set photo4='$photo1' where id='$del'");
header("location:morephotosupdated.php?err&id=$del");
}

if($_REQUEST['cname']=="photo5")
{
$del=$_REQUEST['delid'];
//$uploaddir1='productlogo/';
$newphoto1=$_FILES['photo5']['name'];
$uploadfile1=$uploaddir1 . $newphoto1;
move_uploaded_file($_FILES['photo5']['tmp_name'], $uploadfile1);
$ftimages1 = "productlogo/".$newphoto1;
$thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

if($newphoto1!="")
{
$photo1=$newphoto1; 
}
else
{
$photo1=$oldphoto5;
}
$p1update=mysqli_query($con,"update product set photo5='$photo1' where id='$del'");
header("location:morephotosupdated.php?err&id=$del");
}


}
 ?>
<script language="javascript">
function photoup1()
{
	if(document.uploadphoto.photo1.value=="")
	{
		alert('Please upload image');
		document.uploadphoto.photo1.focus();
		return false;
	}

	if(document.uploadphoto.photo1.value!="")
	{
		var str = document.uploadphoto.photo1.value.substring(document.uploadphoto.photo1.value.indexOf('.'));
		if(str=='.jpg'||str=='.gif' || str=='.jpeg')
		{
			return true;
		}
		else
		{
			alert("Upload only jpg and gif");
			return false;
		}
	}
}

function photoup2()
{
	if(document.uploadphoto.photo2.value!="")
	{
		var str = document.uploadphoto.photo2.value.substring(document.uploadphoto.photo2.value.indexOf('.'));
		if(str=='.jpg'||str=='.gif' || str=='.jpeg')
		{
			return true;
		}
		else
		{
			alert("Upload only jpg and gif");
			//document.photo.attachfile1.value="";
			//document.photo.attachfile1.focus();
			return false;
		}
	}
}

function photoup3()
{
	if(document.uploadphoto.photo3.value!="")
	{
		var str = document.uploadphoto.photo3.value.substring(document.uploadphoto.photo3.value.indexOf('.'));
		if(str=='.jpg'||str=='.gif' || str=='.jpeg')
		{
			return true;
		}
		else
		{
			alert("Upload only jpg and gif");
			//document.photo.attachfile1.value="";
			//document.photo.attachfile1.focus();
			return false;
		}
	}
}

function photoup4()
{
	if(document.uploadphoto.photo4.value!="")
	{
		var str = document.uploadphoto.photo4.value.substring(document.uploadphoto.photo4.value.indexOf('.'));
		if(str=='.jpg'||str=='.gif' || str=='.jpeg')
		{
			return true;
		}
		else
		{
			alert("Upload only jpg and gif");
			//document.photo.attachfile1.value="";
			//document.photo.attachfile1.focus();
			return false;
		}
	}
}

function photoup5()
{
	if(document.uploadphoto.photo5.value!="")
	{
		var str = document.uploadphoto.photo5.value.substring(document.uploadphoto.photo5.value.indexOf('.'));
		if(str=='.jpg'||str=='.gif' || str=='.jpeg')
		{
			return true;
		}
		else
		{
			alert("Upload only jpg and gif");
			//document.photo.attachfile1.value="";
			//document.photo.attachfile1.focus();
			return false;
		}	
	}
}
</script>
 
<div class="body-cont">
	<div class="body-cont1"> 
		<div class="company__container">
			<?php include("includes/side_menu.php"); ?>
			<div class="body-right"> 
				<?php include("includes/menu.php"); ?>
        <div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
          <div class="bordersty">
            <div class="headinggg"><?php echo $upload_phot; ?> </div>
              <!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="titlestyle"><!--&nbsp;&nbsp;&nbsp;Update Product Photo --></td>
                </tr>

                <!--<tr>
                  <td align="center" valign="top"><font color="#FF0000"><strong><?php echo $msg; ?></strong></font></td>
                </tr>-->
                <?php
                  if(isset($_REQUEST['err']))
                  {
                  $idd=$_REQUEST['id'];
                ?>

              <tr>
                <td  class="innertablestyle" align="center" height="190">
                  <table style="border:1px solid #D70000;">
                    <tr>
                      <td style="padding:10px;color:#990000;"><b><?php echo $success_uploa; ?></b></td>
                    </tr>
                  </table>
                </td></tr>
              <meta http-equiv="refresh" content="3;URL=morephotos.php?id=<?php echo $idd;?>" />
              <tr>
                <td>&nbsp;</td>
              </tr>
              <?php
                }
              ?>
              <?php
              if(isset($_REQUEST['cname']))
              {
              ?>
              <tr>
                <td  class="innertablestyle">
                  <form action="" method="post" enctype="multipart/form-data"  name="uploadphoto" id="uploadphoto">
                    <?php
                      if(isset($_REQUEST['cname']))
                      {
                      if($_REQUEST['cname']=='photo1')
                      {
                    ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="45%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="23%" height="30" align="right"><span style="color:#990000;font-size:12px"><b> <?php echo $my_photo; ?>&nbsp;&nbsp;</b></span></td>
                        <td width="77%" height="30" valign="top"><input type="file" name="photo1" value="" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td></td><td height="30" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="upload" style="background-color:#FFCC99;" type="submit" id="upload" value="<?php echo $submit; ?>" onclick="return photoup1();"/></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                      </tr>
                    </table>
                </td>
                <td width="20%">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="5px"></td>
                    </tr>
                    <tr>
                      <td align="center"><span style="color:#990000;font-size:12px"><b><?php echo $your_photo; ?></b></span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><img src="<?PHP echo "productlogo/".$se['photo1']; ?>" width="80" height="80"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
              </table>
              <?php
                }
                }
                if(isset($_REQUEST['cname']))
                {
                  if($_REQUEST['cname']=='photo2')
                {
              ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="45%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="23%" height="30" align="right"><span style="color:#990000;font-size:12px"><b> <?php echo $my_photo; ?>&nbsp;&nbsp;</b></span></td>
                  <td width="77%" height="30" valign="top"><input type="file" name="photo2" value="" /></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td></td><td height="30" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="upload" style="background-color:#FFCC99;" type="submit" id="upload" value="<?php echo $submit; ?>" onclick="return photoup2();"/></td>
                </tr>
                <tr>
                  <td colspan="2" align="right">&nbsp;</td>
                </tr>
              </table>
            </td>
            <td width="20%">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><span style="color:#990000;font-size:12px"><b><?php echo $your_photo; ?></b></span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><img src="<?PHP echo "productlogo/".$se['photo2']; ?>" width="80" height="80"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
              <?php
              }
              }
              ?>
              <?php
              if(isset($_REQUEST['cname']))
              {
              if($_REQUEST['cname']=='photo3')
              {
              ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="45%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="23%" height="30" align="right"><span style="color:#990000;font-size:12px"><b> <?php echo $my_photo; ?>&nbsp;&nbsp;</b></span></td>
                        <td width="77%" height="30" valign="top"><input type="file" name="photo3" value="" />
                            </td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td></td><td height="30" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="upload" style="background-color:#FFCC99;" type="submit" id="upload" value="<?php echo $submit; ?>" onclick="return photoup3();"/></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="20%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center"><span style="color:#990000;font-size:12px"><b><?php echo $your_photo; ?></b></span></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                  <tr>
                        <td align="center">
              <img src="<?PHP echo "productlogo/".$se['photo3']; ?>" width="80" height="80">
              </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                    
                  </tr>
                </table>
              <?php
              }
              }
              ?>

              <?php
              if(isset($_REQUEST['cname']))
              {
              if($_REQUEST['cname']=='photo4')
              {
              ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="45%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="23%" height="30" align="right"><span style="color:#990000;font-size:12px"><b> <?php echo $my_photo; ?>&nbsp;&nbsp;</b></span></td>
                        <td width="77%" height="30" valign="top"><input type="file" name="photo4" value="" />
                            </td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
              <td></td><td height="30" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="upload" style="background-color:#FFCC99;" type="submit" id="upload" value="<?php echo $submit; ?>" onclick="return photoup4();"/></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="20%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center"><span style="color:#990000;font-size:12px"><b><?php echo $your_photo; ?></b></span></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                  <tr>
                        <td align="center">
              <img src="<?PHP echo "productlogo/".$se['photo4']; ?>" width="80" height="80">
              </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                    
                  </tr>
                </table>
              <?php
              }
              }
              ?>
              <?php
              if(isset($_REQUEST['cname']))
              {
              if($_REQUEST['cname']=='photo5')
              {
              ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="45%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="23%" height="30" align="right"><span style="color:#990000;font-size:12px"><b> <?php echo $my_photo; ?>&nbsp;&nbsp;</b></span></td>
                        <td width="77%" height="30" valign="top"><input type="file" name="photo5" value="" />
                            </td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                  <td></td><td height="30" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="upload" style="background-color:#FFCC99;" type="submit" id="upload" value="<?php echo $submit; ?>" onclick="return photoup5();"/></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="20%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center"><span style="color:#990000;font-size:12px"><b><?php echo $your_photo; ?></b></span></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                  <tr>
                        <td align="center">
              <img src="<?PHP echo "productlogo/".$se['photo5']; ?>" width="80" height="80">
              </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                    
                  </tr>
                </table>
              <?php
              }
              }
              ?>
              </form></td>
              </tr>

  <?php
  }
  ?>

  </table>



<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
