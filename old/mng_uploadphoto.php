<?php 
include("includes/header.php");
 include("easythumbnail.class.php");
if($session_user=="")
{

header("location:login.php");

}

$sess_id=$_SESSION['user_login'];
$queryselect=mysqli_query($con,"SELECT * FROM product where userid='$sess_id'");

if(isset($_REQUEST['Submit']))
{


 $photo1=$_FILES['clg_0']['name'];

if($photo1!='')
{
@$ftmp = $_FILES['clg_0']['tmp_name'];
@$oname = $_FILES['clg_0']['name'];
@$fname = $_FILES['clg_0']['name'];
$fsize = $_FILES['clg_0']['size'];
$ftype = $_FILES['clg_0']['type'];
$date=date("Y.m.d");
 $pcate1=$_REQUEST['p_cat1'];
 $spcate1=$_REQUEST['subcategory11'];
$newfilename=basename($_FILES['clg_0']['name']);
$uploaddir='productlogo/';
$uploadfile=$uploaddir . $newfilename;
move_uploaded_file($_FILES['clg_0']['tmp_name'], $uploadfile);
$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);
mysqli_query($con,"insert into photo(pid,userid,photo,size,type,pdate,cid,scid)values('','$sess_id','$photo1','$fsize','$ftype','$date','$pcate1','$spcate1')");
}

$photo2=basename($_FILES['clg_1']['name']);
if($photo2!='')
{
@$ftmp = $_FILES['clg_1']['tmp_name'];
@$oname = $_FILES['clg_1']['name'];
@$fname = $_FILES['clg_1']['name'];
$fsize = $_FILES['clg_1']['size'];
$ftype = $_FILES['clg_1']['type'];
$date=date("Y.m.d");
 $pcate2=$_REQUEST['p_cat2'];
 $spcate2=$_REQUEST['subcategory12'];
$newfilename=basename($_FILES['clg_1']['name']);
$uploaddir='productlogo/';
$uploadfile=$uploaddir . $newfilename;
move_uploaded_file($_FILES['clg_1']['tmp_name'], $uploadfile);
$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);

/*$uploaddir='productlogo/';
$uploadfile=$uploaddir . basename($_FILES['photo2']['name']);
move_uploaded_file($_FILES['photo2']['tmp_name'], $uploadfile);*/
mysqli_query($con,"insert into photo(pid,userid,photo,size,type,pdate,cid,scid)values('$id','$sess_id','$photo2','$fsize','$ftype','$date','$pcate2','$spcate2')");
}

$photo3=basename($_FILES['clg_2']['name']);
if($photo3!='')
{
@$ftmp = $_FILES['clg_2']['tmp_name'];
@$oname = $_FILES['clg_2']['name'];
@$fname = $_FILES['clg_2']['name'];
$fsize = $_FILES['clg_2']['size'];
$ftype = $_FILES['clg_2']['type'];
$date=date("Y.m.d");
 $pcate3=$_REQUEST['p_cat3'];
 $spcate3=$_REQUEST['subcategory13'];
$newfilename=basename($_FILES['clg_2']['name']);
$uploaddir='productlogo/';
$uploadfile=$uploaddir . $newfilename;
move_uploaded_file($_FILES['clg_2']['tmp_name'], $uploadfile);
$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);

/*$uploaddir='productlogo/';
$uploadfile=$uploaddir . basename($_FILES['photo3']['name']);
move_uploaded_file($_FILES['photo3']['tmp_name'], $uploadfile);
*/mysqli_query($con,"insert into photo(pid,userid,photo,size,type,pdate,cid,scid)values('$id','$sess_id','$photo3','$fsize','$ftype','$date','$pcate3','$spcate3')");
}

$photo4=basename($_FILES['clg_3']['name']);
if($photo4!='')
{
@$ftmp = $_FILES['clg_3']['tmp_name'];
@$oname = $_FILES['clg_3']['name'];
@$fname = $_FILES['clg_3']['name'];
$fsize = $_FILES['clg_3']['size'];
$ftype = $_FILES['clg_3']['type'];
$date=date("Y.m.d");
/*$uploaddir='productlogo/';
$uploadfile=$uploaddir . basename($_FILES['photo4']['name']);
move_uploaded_file($_FILES['photo4']['tmp_name'], $uploadfile);*/

$newfilename=basename($_FILES['clg_3']['name']);
  $pcate4=$_REQUEST['p_cat4'];
  $spcate4=$_REQUEST['subcategory14'];
$uploaddir='productlogo/';
$uploadfile=$uploaddir . $newfilename;
move_uploaded_file($_FILES['clg_3']['tmp_name'], $uploadfile);
$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);
mysqli_query($con,"insert into photo(pid,userid,photo,size,type,pdate,cid,scid)values('$id','$sess_id','$photo4','$fsize','$ftype','$date','$pcate4','$spcate4')");
}

$photo5=basename($_FILES['clg_4']['name']);
if($photo5!='')
{ 
@$ftmp = $_FILES['clg_4']['tmp_name'];
@$oname = $_FILES['clg_4']['name'];
@$fname = $_FILES['clg_4']['name'];
 $fsize = $_FILES['clg_4']['size'];
 $ftype = $_FILES['clg_4']['type'];
$date=date("Y.m.d");

$pcate5=$_REQUEST['p_cat5'];
 $spcate5=$_REQUEST['subcategory15'];
$newfilename=basename($_FILES['clg_4']['name']);
$uploaddir='productlogo/';
$uploadfile=$uploaddir . $newfilename;
move_uploaded_file($_FILES['clg_4']['tmp_name'], $uploadfile);
$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);

/*
$uploaddir='productlogo/';
$uploadfile=$uploaddir . basename($_FILES['photo5']['name']);
move_uploaded_file($_FILES['photo5']['tmp_name'], $uploadfile);
*/
mysqli_query($con,"insert into photo(pid,userid,photo,size,type,pdate,cid,scid)values('$id','$sess_id','$photo5','$fsize','$ftype','$date','$pcate5','$spcate5')");
}

if($photo1=="" && $photo2=="" && $photo3=="" && $photo4=="" && $photo5=="")
{
header("location:mng_uploadphoto.php?err");
}
else
{
header("location:mng_ProPhotos.php?succ");
}
}

 ?>
<script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
<script type="text/javascript" src="admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		
		mode : "specific_textareas",
		editor_selector : "texteditor",
		mode:"textareas",
		theme : "advanced",
		editor_deselector : "noeditor",
		/*mode : "textareas",
		theme : "advanced",*/
		width : 450,
		height : 150,
		
    	plugins : "style,layer,save,paste,advlist,autosave",
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",
		theme_advanced_buttons2 : "pastetext,pasteword,|,search,replace,|,bullist,numlist,link,unlink,anchor",
		
		theme_advanced_buttons3 : "formatselect,fontselect,fontsizeselect",
		
	

	

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

	});
	</script> 
<script type="text/javascript">

function trim1(str)
{
	
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}
function validate(doc)
{
	
								var a=document.product.clg_0.value;
								//alert(c);
								//alert(d);
								if(a=="")
								{
								alert("Please upload image file");
								document.product.clg_0.value='';
								document.product.clg_0.focus();
								return false;
								}
								if(a!="")
								{
								//alert(a);
								splt=a.split('.');
								chksplt=splt[1].toLowerCase();
								
								if(chksplt=='jpg' || chksplt=='jpeg'|| chksplt=='bmp'|| chksplt=='png'|| chksplt=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_0.value='';
								document.product.clg_0.focus();
								return false;
								}
								}
								
								
								var c=document.product.clg_1.value;
								if(c!="")
								{
								splt1=c.split('.');
								chksplt1=splt1[1].toLowerCase();
								
								if(chksplt1=='jpg' || chksplt1=='jpeg'|| chksplt1=='bmp'|| chksplt1=='png'|| chksplt1=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_1.value='';
								document.product.clg_1.focus();
								return false;
								}
								}
								
								var d=document.product.clg_2.value;
								if(d!="")
								{
								splt2=d.split('.');
								chksplt2=splt2[1].toLowerCase();
								
								if(chksplt2=='jpg' || chksplt2=='jpeg'|| chksplt2=='bmp'|| chksplt2=='png'|| chksplt2=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_2.value='';
								document.product.clg_2.focus();
								return false;
								}
								}
								
								var e=document.product.clg_3.value;
								if(e!="")
								{
								splt3=e.split('.');
								chksplt3=splt3[1].toLowerCase();
								
								if(chksplt3=='jpg' || chksplt3=='jpeg'|| chksplt3=='bmp'|| chksplt3=='png'|| chksplt3=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_3.value='';
								document.product.clg_3.focus();
								return false;
								}
								}
								var f=document.product.clg_4.value;
								if(f!="")
								{
								splt4=f.split('.');
								chksplt4=splt4[1].toLowerCase();
								
								if(chksplt4=='jpg' || chksplt4=='jpeg'|| chksplt4=='bmp'|| chksplt4=='png'|| chksplt4=='gif'){
								
								}else{
								alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
								document.product.clg_4.value='';
								document.product.clg_4.focus();
								return false;
								}
								}
	}
 


function show2(addcomments2)
{
	
 document.getElementById(addcomments2).style.display = "block";

}
function hide2(addcomments2)
{
	document.getElementById(addcomments2).style.display = "none";
}

</script>

<script src="js/add_delRow.js" type="text/javascript"></script>

 
<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;" > <?php echo $success_mail_msg; ?> </div>
<?php } ?>



<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
<?php 
$user_type=$fetch_log['usertype']; 
if($user_type==1) { $usertype="Buyer"; } elseif($user_type==2) { $usertype="seller"; }  elseif($user_type==3) { $usertype="Both Buyer & Seller"; }  else { $usertype="Not Mentioned"; }
//$user_type=$fetch_log['gender']; 
//if($gender==1) { $gen="";
?>
<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<div class="headinggg"> <?php echo $upload_product_photo; ?></div>
<form id="form1" name="product" method="post" action="" enctype="multipart/form-data" onsubmit="return validate(this);">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr><td>&nbsp;</td></tr>
              <?php
			  if(isset($_REQUEST['err']))
			  {
			 ?>
              <tr><td align="center" height="25"><span class="style1"><?php echo $mng_uploadphoto_uplodany?></span></td>
              </tr>
			  <?php
                } 
			  ?>
			  
			 
              <tr>
                <td>
                  <table cellpadding="0" cellspacing="0" width="100%" id="dataTable">


<tr>
<td width="200" valign="top"> <?php echo $photos; ?></td><td width="100">:</td><td><input type="file" name="clg_0" id="clg_0" size="40" value="" onKeyDown="return chkkeycode(event,this.id)" class="textarea" /> <div id="b_0_err" style="display:none; color:#FF3300;"></div>
							</td>
							  <td width="30"><img src="plus_icon.png" border="0" onClick="addRow_new('dataTable','clg','clgfrm','clgto')" title="Add New Point" /></td>
</tr>
</table>
                                                              </td>
              </tr>
			  
			  
			  <tr>
                      <td colspan="4" align="center">
                        <input name="Submit" type="submit" class="search_bg" onclick="return checkup();" value="<?php echo $upload; ?>"/>
                        &nbsp;&nbsp;<input type="button" class="search_bg" name="Submit2" value="<?php echo $cancel; ?>" onclick="javascript:history.back();"/></td>
                    </tr>
			  
            </table>
</form>
<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


<div class="body-cont4"> 






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
