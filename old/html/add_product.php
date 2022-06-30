<?php 
error_reporting(0);
include("includes/header.php");

if($session_user=="")
{

header("location:login.php");

}

include("easythumbnail.class.php");
if(isset($_POST['submit']))
{





$p_name=$_POST['p_name'];
$p_keyword=$_POST['p_keyword'];

if($_POST['p_cat1']==394)
{
    $p_cat=$_POST['p_cat1'];
}
else
{
    $p_cat=$_POST['p_cat'];
}

$p_subcategory=$_POST['subcategory'];
$country=$_POST['country'];
$p_photo=basename($_FILES['image']['name']);
$p_bdes=mysqli_real_escape_string($con, $_POST['p_bdes']);
$p_ddes=mysqli_real_escape_string($con, $_POST['detail_description']);
$p_price=$_POST['p_price'];
$range1=$_POST['range1'];
$range2=$_POST['range2'];
$p_miniquantity=$_POST['p_miniquantity'];
$p_quantity=$_POST['p_quantity'];
$p_capacity=$_POST['p_capacity'];
$capacity=$_POST['capacity'];
$time=$_POST['time'];
$payment=$_POST['payment'];
if($_SESSION['language']=='english')
{
$lang_status='0';

}
else if($_SESSION['language']=='french')
{
$lang_status='1';

}
else if($_SESSION['language']=='chinese')
{
$lang_status='2';
}
else
{
$lang_status='3';
}
if($payment=='')
{
$p=$_POST['others'];
}
else
{
$p=$payment;
}
$pro_capacity=$p_capacity;
//$range12=$_POST['range12'];
$p_deliverytime=$_POST['p_deliverytime']." ".$_POST['time1'];
$p_packagedetails=mysqli_real_escape_string($con, $_POST['description']);

 $date=date("Y.m.d");
 
 $hh=$_SESSION['hh'];

$newfilename1=basename($_FILES['clg_0']['name']); 
$uploaddir1='productlogo/';
 $uploadfile1=$uploaddir1 . $newfilename1;
move_uploaded_file($_FILES['clg_0']['tmp_name'], $uploadfile1);
$ftimages1 = "blog_photo_thumbnail/".$newfilename1;
$thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

@$ftmp2 = $_FILES['clg_1']['tmp_name'];
@$oname2 = $_FILES['clg_1']['name'];
@$fname2 = $_FILES['clg_1']['name'];
$fsize2 = $_FILES['clg_1']['size'];
$ftype2 = $_FILES['clg_1']['type'];
$date2 =date("Y.m.d");
$newfilename2=basename($_FILES['clg_1']['name']);
$uploaddir2='productlogo/';
 $uploadfile2=$uploaddir2 . $newfilename2;
move_uploaded_file($_FILES['clg_1']['tmp_name'], $uploadfile2);
$ftimages2 = "blog_photo_thumbnail/".$newfilename2;
$thumb2= new EasyThumbnail($uploadfile2, $ftimages2, 120);

@$ftmp3 = $_FILES['clg_2']['tmp_name'];
@$oname3 = $_FILES['clg_2']['name'];
@$fname3 = $_FILES['clg_2']['name'];
$fsize3= $_FILES['clg_2']['size'];
$ftype3 = $_FILES['clg_2']['type'];
$date3 =date("Y.m.d");
 $newfilename3=basename($_FILES['clg_2']['name']); 
$uploaddir3='productlogo/';
 $uploadfile3=$uploaddir3 . $newfilename3;
move_uploaded_file($_FILES['clg_2']['tmp_name'], $uploadfile3);
$ftimages3 = "blog_photo_thumbnail/".$newfilename3;
$thumb3= new EasyThumbnail($uploadfile3, $ftimages3, 120);

@$ftmp4 = $_FILES['clg_3']['tmp_name'];
@$oname4 = $_FILES['clg_3']['name'];
@$fname4 = $_FILES['clg_3']['name'];
$fsize4= $_FILES['clg_3']['size'];
$ftype4 = $_FILES['clg_3']['type'];
$date4 =date("Y.m.d");
$newfilename4=basename($_FILES['clg_3']['name']);
$uploaddir4='productlogo/';
 $uploadfile4=$uploaddir4 . $newfilename4;
move_uploaded_file($_FILES['clg_3']['tmp_name'], $uploadfile4);
$ftimages4 = "blog_photo_thumbnail/".$newfilename4;
$thumb4= new EasyThumbnail($uploadfile4, $ftimages4, 120);

@$ftmp5 = $_FILES['clg_4']['tmp_name'];
@$oname5 = $_FILES['clg_4']['name'];
@$fname5 = $_FILES['clg_4']['name'];
$fsize5= $_FILES['clg_4']['size'];
$ftype5 = $_FILES['clg_4']['type'];
$date5 =date("Y.m.d");
$expiredate = date('Y.m.d', strtotime("+30 days"));
$newfilename5=basename($_FILES['clg_4']['name']);
$uploaddir5='productlogo/';
 $uploadfile5=$uploaddir5 . $newfilename5;
move_uploaded_file($_FILES['clg_4']['tmp_name'], $uploadfile5);
$ftimages5 = "blog_photo_thumbnail/".$newfilename5;
$thumb5= new EasyThumbnail($uploadfile5, $ftimages5, 120);

 $insertquery="INSERT INTO `product` (`userid` , `p_name` , `p_keyword` , `p_category` ,`p_subcategory`,`country`,`p_photo`, `p_bdes` , `p_ddes` , `p_price` , `range1` , `range2` ,`paymenttype` ,`p_min_quanity` , `p_quanity_type` , `p_capaacity` , `p_ctype` , `percapacity` , `range12` , `p_delivertytime` , `p_packingdetails` ,`udate`,`expiredate`,`status`,`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`lang_status`)
VALUES (
 '$session_user', '$p_name', '$p_keyword', '$p_cat','$p_subcategory','$country','$newfilename1','$p_bdes', '$p_ddes', '$p_price', '$range1', '$range2','$p', '$p_miniquantity', '$p_quantity', '$pro_capacity', '$capacity', '$time', '', '$p_deliverytime', '$p_packagedetails'
,'$date','$expiredate','1','$newfilename1','$newfilename2','$newfilename3','$newfilename4','$newfilename5','$lang_status')"; 
 

 /* $insertquery="INSERT INTO `product` (`userid` , `p_name` , `p_keyword` , `p_category` ,`p_subcategory`,`country`,`p_photo`, `p_bdes` , `p_ddes` , `p_price` , `range1` , `range2` ,`paymenttype` ,`p_min_quanity` , `p_quanity_type` , `p_capaacity` , `p_ctype` , `percapacity` , `range12` , `p_delivertytime` , `p_packingdetails` ,`udate`,`expiredate`,`status`,`photo1`,`photo2`,`photo3`,`photo4`,`photo5`)
VALUES (
 '$session_user', '$p_name', '$p_keyword', '$p_cat','$p_subcategory','$country','$newfilename1','$p_bdes', '$p_ddes', '$p_price', '$range1', '$range2','$p', '$p_miniquantity', '$p_quantity', '$pro_capacity', '$capacity', '$time', '', '$p_deliverytime', '$p_packagedetails'
,'$date','$expiredate','1','$newfilename1','$newfilename2','$newfilename3','$newfilename4','$newfilename5')"; */


mysqli_query($con,$insertquery) or mysqli_error($con);

header("location:my_products.php?suc");
}

if(isset($_REQUEST['cat_submit']))
{
$other_cat=$_REQUEST['other_cat'];
$other_subcat=$_REQUEST['other_subcat'];

$qry1=mysqli_query($con,"insert into category(category,parent_id) values('$other_cat','')");
$cat_id=mysqli_insert_id();

$qry2=mysqli_query($con,"insert into category(category,parent_id) values('$other_subcat','$cat_id')");

if(($qry1) && ($qry2))
{
header("location:add_product.php");
}

}


if(isset($_REQUEST['sub_submit']))
{
$othr_cat=$_REQUEST['othr_cat'];
$othr_subcat=$_REQUEST['othr_subcat'];

$qry=mysqli_query($con,"insert into category(category,parent_id) values('$othr_subcat','$othr_cat')");

if($qry) 
{
header("location:add_product.php");
}

}


if(isset($_REQUEST['con_submit']))
{
$con_name=$_REQUEST['con_name'];

$qrry=mysqli_query($con,"insert into country(country_name) values('$con_name')");

if($qrry) 
{
header("location:add_product.php");
}

}

 ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
<script type="text/javascript" src="admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    // General options

    mode: "specific_textareas",
    editor_selector: "texteditor",
    mode: "textareas",
    theme: "advanced",
    editor_deselector: "noeditor",
    /*mode : "textareas",
    theme : "advanced",*/
    width: 450,
    height: 150,

    plugins: "style,layer,save,paste,advlist,autosave",
    // Theme options
    theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",
    theme_advanced_buttons2: "pastetext,pasteword,|,search,replace,|,bullist,numlist,link,unlink,anchor",

    theme_advanced_buttons3: "formatselect,fontselect,fontsizeselect",





    // Drop lists for link/image/media/template dialogs
    template_external_list_url: "lists/template_list.js",
    external_link_list_url: "lists/link_list.js",
    external_image_list_url: "lists/image_list.js",
    media_external_list_url: "lists/media_list.js",

    // Style formats
    style_formats: [{
            title: 'Bold text',
            inline: 'b'
        },
        {
            title: 'Red text',
            inline: 'span',
            styles: {
                color: '#ff0000'
            }
        },
        {
            title: 'Red header',
            block: 'h1',
            styles: {
                color: '#ff0000'
            }
        },
        {
            title: 'Example 1',
            inline: 'span',
            classes: 'example1'
        },
        {
            title: 'Example 2',
            inline: 'span',
            classes: 'example2'
        },
        {
            title: 'Table styles'
        },
        {
            title: 'Table row 1',
            selector: 'tr',
            classes: 'tablerow1'
        }
    ],

});
</script>
<script type="text/javascript">
function trim1(str) {

    if (!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/, '').replace(/[\s]+$/, '').replace(/[\s]{2,}/, ' ');
}
 
function validate(doc) {
    //alert("sdfjsd")


    if ((trim1(document.product.p_name.value) == "") || (document.product.p_name.value == "")) {
        alert("Please enter the product Name");
        document.product.p_name.focus();
        return false;
    }

    if ((trim1(document.product.p_keyword.value) == "") || (document.product.p_keyword.value == "")) {
        alert("Please enter the product keyword");
        document.product.p_keyword.focus();
        return false;
    }

    if ( $('.product-service:visible select').val() == "") {
        alert("Please enter the product Category");
        $('.product-service:visible select').focus();
        return false;
    }


    if ( document.product.subcategory.value == "") {
        alert("Please enter the product SubCategory");
        document.product.subcategory.focus();
        return false;
    }

    if (document.product.country.value == "") {
        alert("Please enter the  Country");
        document.product.country.focus();
        return false;
    }


    if (document.product.p_bdes.value == "") {
        alert("Please Enter the product brief description");
        document.product.p_bdes.focus();
        return false;
    }

    //alert(c);
    //alert(d);

    /*if(document.product.p_price.value=="")
	{
		alert("Please Select the Currency");
		document.product.p_price.focus();
		return false;
	}*/

    if (document.product.range1.value == "") {
        alert("Please Enter the price");
        document.product.range1.focus();
        return false;
    }

    if (isNaN(document.product.range1.value)) {
        alert("price from should be number only");
        document.product.range1.focus();
        return false;
    }
    /*if(document.product.range2.value=="")
	{
		alert("Please Enter the Maximum Range");
		document.product.range2.focus();
		return false;
	}
if(isNaN(document.product.range2.value))
	{
		alert("Range To should be number only");
		document.product.range2.focus();
		return false;
	}*/

    /* if(document.product.payment.value=="")
	{
		alert("Please Enter the Payment Terms");
		document.product.payment.focus();
		return false;
	}*/

    if (document.product.p_miniquantity.value == "") {
        alert("Please Enter the Quantity ");
        document.product.p_miniquantity.focus();
        return false;
    }
    if (isNaN(document.product.p_miniquantity.value)) {
        alert("Quantity should be number only");
        document.product.p_miniquantity.focus();
        return false;
    }


    /*if(document.product.p_capacity.value=="")
    	{
    		alert("Please Enter the Production Capacity");
    		document.product.p_capacity.focus();
    		return false;
    	}
    if(isNaN(document.product.p_capacity.value))
    	{
    		alert("Capacity should be number only");
    		document.product.p_capacity.focus();
    		return false;
    	}

    	if(document.product.capacity.value=="")
    	{
    		alert("Please Enter the Capacity Unit");
    		document.product.capacity.focus();
    		return false;
    	}
    	if(document.product.time.value=="")
    	{
    		alert("Please Enter the Time Of Production");
    		document.product.time.focus();
    		return false;
    	}
    	
    	if(document.product.p_deliverytime.value=="")
    	{
    		alert("Please Enter the Delivery Time Of Production");
    		document.product.p_deliverytime.focus();
    		return false;
    	}*/

    if (document.product.clg_0.value != "") {
        var ss = document.product.clg_0.value;
        var index = ss.lastIndexOf(".");
        var sstring = ss.substring(index + 1);
        var ssivanew = sstring.toLowerCase();
        if (ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" &&
            ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF") {
            alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
            document.product.clg_0.value = '';
            document.product.clg_0.focus();
            return false;
        }
    }


    if (document.product.clg_1.value != "") {
        var ss = document.product.clg_1.value;
        var index = ss.lastIndexOf(".");
        var sstring = ss.substring(index + 1);
        var ssivanew = sstring.toLowerCase();
        if (ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" &&
            ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF") {
            alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
            document.product.clg_1.value = '';
            document.product.clg_1.focus();
            return false;
        }
    }


    if (document.product.clg_2.value != "") {
        var ss = document.product.clg_2.value;
        var index = ss.lastIndexOf(".");
        var sstring = ss.substring(index + 1);
        var ssivanew = sstring.toLowerCase();
        if (ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" &&
            ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF") {
            alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
            document.product.clg_2.value = '';
            document.product.clg_2.focus();
            return false;
        }
    }


    if (document.product.clg_3.value != "") {
        var ss = document.product.clg_3.value;
        var index = ss.lastIndexOf(".");
        var sstring = ss.substring(index + 1);
        var ssivanew = sstring.toLowerCase();
        if (ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" &&
            ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF") {
            alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
            document.product.clg_3.value = '';
            document.product.clg_3.focus();
            return false;
        }
    }

    if (document.product.clg_4.value != "") {
        var ss = document.product.clg_4.value;
        var index = ss.lastIndexOf(".");
        var sstring = ss.substring(index + 1);
        var ssivanew = sstring.toLowerCase();
        if (ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" &&
            ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF") {
            alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
            document.product.clg_4.value = '';
            document.product.clg_4.focus();
            return false;
        }
    }

}



function show2(addcomments2) {

    document.getElementById(addcomments2).style.display = "block";

}

function hide2(addcomments2) {
    document.getElementById(addcomments2).style.display = "none";
}
</script>

<script type="text/javascript">
function cat_val() {
    //alert("hello");
    if (document.getElementById('other_cat').value == "") {
        alert("Enter the category name");
        document.getElementById('other_cat').focus();
        return false;
    }

    if (document.getElementById('other_subcat').value == "") {
        alert("Enter the sub category name");
        document.getElementById('other_subcat').focus();
        return false;
    }

}


function sub_val() {
    //alert("hello");
    if (document.getElementById('othr_cat').value == "") {
        alert("Choose category name");
        document.getElementById('othr_cat').focus();
        return false;
    }

    if (document.getElementById('othr_subcat').value == "") {
        alert("Enter the sub category name");
        document.getElementById('othr_subcat').focus();
        return false;
    }

}

function con_val() {
    //alert("hello");
    if (document.getElementById('con_name').value == "") {
        alert("Enter the country name");
        document.getElementById('con_name').focus();
        return false;
    }

}
</script>


<script src="js/add_delRow.js" type="text/javascript"></script>


<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;"> <?php echo $success_mail_msg; ?> </div>
<?php } ?>



<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>

            <div class="body-right">

                <?php include("includes/menu.php"); ?>

                <div class="tabs-cont">
                    <div class="left">
                        <div style="border:1px solid #F0EFF0;" class="bordersty">
                            <div class="headinggg">Add Product/Service<?php //echo $add_product; ?></div>
                            <form id="form1" name="product" method="post" action="" enctype="multipart/form-data"
                                onsubmit="return validate(this);">

                                <div class="p-2">
                                    <div class="input-group">
                                        <h5><?php echo $basic_info; ?></h5>
                                    </div>
                                    <div class="input-group">
                                        <h6><span class="mandory">*</span>Name</h6>
                                        <input type="text" name="p_name" id="p_name" class="txtfield2_new" value="" />
                                    </div>



                                    <div class="input-group">
                                        <h6><span class="mandory">*</span>Keyword</h6>
                                        <input type="text" name="p_keyword" id="p_keyword" class="txtfield2_new"
                                            value="" />
                                    </div>
                                    <div class="input-group">
                                        <h6>Choose One</h6>
                                        <select class="select1" name="" id="choose__one">
                                            <option value="Product">Product</option>
                                            <option value="Services">Services</option>
                                        </select>
                                    </div>
                                    <div class="input-group product-service prod__cat">
                                        <h6><span class="mandory">*</span>Select Category
                                        </h6>

                                        <select name="p_cat" onchange="Javascript:FUNCTION1(this.value);"
                                            class="select1">
                                            <option value=""><?php echo $sel_cat; ?>
                                            </option>
                                            <?php 
                                                                           
                                            $select_cate="SELECT * FROM category WHERE  parent_id='' and c_id !='394'";
                                             $res_cate=mysqli_query($con,$select_cate);
                                                                            while($fetch_cate=mysqli_fetch_array($res_cate))
                                                                            {
                                                                        ?>
                                            <option value="<?php echo $fetch_cate['c_id']; ?>">
                                                <?php echo $fetch_cate['category']; ?>
                                            </option>
                                            <?php } ?>

                                        </select>
                                        <!-- <div width="267" valign="top">
                                                                     <a href="#"onclick="showpop1();"> +Add Other</a>
                                                                </div> -->
                                    </div>

                                    <div class="input-group product-service services__cat hide">
                                        <h6><span class="mandory">*</span>
                                            <?php //echo $pro_cat; ?>
                                            Select Category
                                        </h6>


                                        <select name="p_cat1"  onchange="Javascript:FUNCTION1(this.value);"
                                            class="select1">
                                            <option value=""><?php echo $sel_cat; ?>
                                            </option>
                                            <?php 
                                                                           
                                                                                $select_cate="SELECT * FROM category WHERE c_id ='394'";
                                                                                                                                                      
                                                                             $res_cate=mysqli_query($con,$select_cate);
                                                                            while($fetch_cate=mysqli_fetch_array($res_cate))
                                                                            {
                                                                        ?>
                                            <option value="<?php echo $fetch_cate['c_id']; ?>">
                                                <?php echo $fetch_cate['category']; ?>
                                            </option>
                                            <?php } ?>

                                        </select>
                                        <!-- <div width="267" valign="top">
                                                                    <a href="#"onclick="showpop1();"> +Add Other</a>
                                                                </div> -->
                                    </div>

                                    <div class="input-group">
                                        <h6><span class="mandory">*</span>
                                            <?php //echo $sel_pro_cat; ?> Select Sub Category
                                        </h6>

                                        <div id="subcat12">
                                            <select name="subcategory" class="select1">
                                                <option value=""><?php echo $sel_sub_cat; ?>
                                                </option>
                                            </select>
                                        </div>
                                        <!-- <div valign="top">
                                                                    <a href="#" onclick="showpop2();">+Add Other</a>
                                                                </div> -->
                                    </div>


                                    <div class="input-group">
                                        <h6><span class="mandory">*</span><?php echo $country; ?>
                                        </h6>


                                        <select name="country" class="select1">
                                            <option value=""><?php echo $sel_con; ?>
                                            </option>
                                            <?php
if($_SESSION['language']=='english')
{
$select_con="SELECT * FROM country";
}
else if($_SESSION['language']=='french')
{
$select_con="SELECT * FROM country_french";
}
else if($_SESSION['language']=='chinese')
{
$select_con="SELECT * FROM country_chinese";
}
else
{
$select_con="SELECT * FROM country_spanish";
}
//$select_con="SELECT * FROM country";
$res_con=mysqli_query($con,$select_con);
while($fetch_con=mysqli_fetch_array($res_con))
{
?>
                                            <option value="<?php echo $fetch_con['country_id']; ?>">
                                                <?php echo $fetch_con['country_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <!-- <div valign="top">
                                                                    <a href="#" onclick="showpop3();">+Add Other</a>
                                                                </div> -->
                                    </div>

                                    <div class="input-group">
                                        <h6><span class="mandory">*</span>
                                            <?php echo $breif_des; ?> </h6>


                                        <textarea name="p_bdes" id="p_bdes" class="txtarea1"></textarea>
                                    </div>


                                    <div class="input-group">
                                        <h5><?php echo $add_product_photo; ?></h5>

                                    </div>

                                    <div class="input-group">
                                        <table cellpadding="0" cellspacing="0" width="100%" id="dataTable">
                                            <tr>
                                                <td width="200"><?php echo $photos; ?></td>
                                                <td width="314"><input type="file" name="clg_0" id="clg0" size="40"
                                                        value="" onKeyDown="return chkkeycode(event,this.id)"
                                                        class="textarea" />
                                                    <div id="b_0_err" style="display:none; color:#FF3300;">
                                                    </div>
                                                </td>
                                                <td width="268"><img src="plus_icon.png" border="0"
                                                        onClick="addRow_new('dataTable','clg','clgfrm','clgto')"
                                                        title="Add New Point" /></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="input-group">
                                        <h5><?php echo $add_detailed_pro; ?></h5>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $detail_des;?></h6>
                                        <textarea name="detail_description" id="detail_description" class="texteditor"
                                            style="width:150px; height:100px;"></textarea>
                                    </div>



                                    <div class="input-group">
                                        <h6><span class="mandory">*</span><?php echo $price;?>
                                        </h6>
                                        <div class="d-flex">
                                            <select name="p_price" class="txtfield_small">
                                                <option value="">
                                                    <?php echo $currency; ?>
                                                </option>
                                                <option value="USD"> USD </option>
                                                <option value="GBP"> GBP </option>
                                                <option value="RMB"> RMB </option>
                                                <option value="EUR"> EUR </option>
                                                <option value="AUD"> AUD </option>
                                                <option value="CAD"> CAD </option>
                                                <option value="CHF"> CHF </option>
                                                <option value="JPY"> JPY </option>
                                                <option value="HKD"> HKD </option>
                                                <option value="NZD"> NZD </option>
                                                <option value="SGD"> SGD </option>
                                                <option value="Other">
                                                    <?php echo $other; ?>
                                                </option>
                                            </select>
                                            &nbsp;&nbsp;
                                            <input type="text" name="range1" class="txtfield_small" />
                                            &nbsp;~&nbsp;
                                            <input type="text" name="range2" class="txtfield_small" />
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <h6><span class="mandory">*</span>Payment
                                            Terms </h6>
                                        <div>
                                            <label>
                                                <input name="payment" type="radio" value="L/C" checked="checked"
                                                    id="free1" onclick="javascript:hide2('addcomments2');" />
                                                <span style="font-size:12"><?php echo $lc;?></span>
                                            </label>
                                            <label>
                                                <input name="payment" type="radio" value="D/A"
                                                    onclick="javascript:hide2('addcomments2');" />
                                                <span style="font-size:12"><?php echo $da; ?>
                                                </span>
                                            </label>
                                            <label>
                                                <input name="payment" type="radio" value="D/P"
                                                    onclick="javascript:hide2('addcomments2');" />
                                                <span style="font-size:12"><?php echo $dp; ?></span>
                                            </label>
                                            <label>
                                                <input name="payment" type="radio" value="T/T"
                                                    onclick="javascript:hide2('addcomments2');" />
                                                <span style="font-size:12"><?php echo $tt; ?></span>
                                            </label>
                                            <label>
                                                <input name="payment" type="radio" value="Western Union"
                                                    onclick="javascript:hide2('addcomments2');" />
                                                <span style="font-size:12"><?php echo $western_union; ?></span>
                                            </label>
                                            <label>
                                                <input name="payment" type="radio" value="MoneyGram"
                                                    onclick="javascript:hide2('addcomments2');" />
                                                <span style="font-size:12"><?php echo $money_gram; ?></span>
                                            </label>
                                            <label><input name="payment" type="radio" value=""
                                                    onclick="javascript:show2('addcomments2');" />
                                                <span style="font-size:12">
                                                    <?php echo $others; ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div id="addcomments2" style="display:none"><input type="text" name="others"
                                                id="others" class="txtfield2_new" value="" /></div>
                                    </div>

                                    <div class="input-group">
                                        <h6><span class="mandory">*</span><?php echo $qty;?>
                                        </h6>
                                        <input type="text" name="p_miniquantity" class="txtfield2_new" />
                                    </div>


                                    <div class="input-group">
                                        <h5><?php echo $show_buy_abil; ?></h5>
                                    </div>

                                    <div class="input-group">
                                        <h6>
                                            <?php echo $production_capacity; ?>
                                        </h6>
                                        <div class="d-flex">
                                            <input type="text" name="p_capacity" class="txtfield_small"
                                                maxlength="4" />&nbsp;&nbsp;
                                            <select name="capacity" class="txtfield_small">
                                                <option value="">
                                                    <?php echo $sel_unit_type; ?>
                                                </option>
                                                <option value="Bag/Bags">
                                                    <?php echo $bag; ?>
                                                </option>
                                                <option value="Barrel/Barrels">
                                                    <?php echo $barrel; ?> </option>
                                                <option value="Cubic Meter">
                                                    <?php echo $cubic_meter; ?>
                                                </option>
                                                <option value="Dozen">
                                                    <?php echo $Dozen; ?>
                                                </option>
                                                <option value="Gallon">
                                                    <?php echo $Gallon; ?>
                                                </option>
                                                <option value="Gram">
                                                    <?php echo $Gram; ?>
                                                </option>
                                                <option value="Kilogram">
                                                    <?php echo $Kilogram; ?>
                                                </option>
                                                <option value="Kilometer">
                                                    <?php echo $Kilometer;?>
                                                </option>
                                                <option value="Long Ton">
                                                    <?php echo $long_ton; ?>
                                                </option>
                                                <option value="Meter">
                                                    <?php echo $Meter; ?>
                                                </option>
                                                <option value="Mertic Ton">
                                                    <?php echo $metric_ton; ?>
                                                </option>
                                                <option value="Ounce">
                                                    <?php echo $Ounce; ?>
                                                </option>
                                                <option value="Pair">
                                                    <?php echo $Pair; ?>
                                                </option>
                                                <option value="pack/packs">
                                                    <?php echo $pack; ?>
                                                </option>
                                                <option value="Piece/Pieces">
                                                    <?php echo $pieces; ?> </option>
                                                <option value="Pound">
                                                    <?php echo $pound; ?>
                                                </option>
                                                <option value="Set/Sets">
                                                    <?php echo $set; ?>
                                                </option>
                                                <option value="Short Ton">
                                                    <?php echo $short_ton; ?>
                                                </option>
                                            </select>
                                            &nbsp;&nbsp;
                                            <select name="time" class="txtfield_small">
                                                <option value="">
                                                    <?php echo $time; ?></option>
                                                <option value="Day">
                                                    <?php echo $day; ?></option>
                                                <option value="Week">
                                                    <?php echo $week; ?>
                                                </option>
                                                <option value="Month">
                                                    <?php echo $month; ?>
                                                </option>
                                                <option value="Year">
                                                    <?php echo $year; ?>
                                                </option>
                                            </select> </div>

                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $delivery_time; ?> </h6>

                                        <div class="d-flex">
                                            <input type="text" name="p_deliverytime" id="p_deliverytime"
                                                class="txtfield2_new" value="" />
                                            &nbsp;&nbsp;
                                            <select name="time1" class="txtfield_small">
                                                <option value="">
                                                    <?php echo $time; ?></option>
                                                <option value="Hours">Hours</option>
                                                <option value="Days">
                                                    <?php echo $day; ?>
                                                </option>
                                                <option value="Weeks">
                                                    <?php echo $week; ?>
                                                </option>
                                                <option value="Months">
                                                    <?php echo $month; ?>
                                                </option>
                                                <option value="Years">
                                                    <?php echo $year; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $packaging_details;?> </h6>

                                        <textarea name="description" id="description" class="txtarea1"></textarea>
                                    </div>
                                    <div class="input-group">
                                        <input type="submit" name="submit" value="<?php echo $submit; ?>">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<style type="text/css">
.black_overlay {
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 200%;
    background-color: black;
    z-index: 1001;
    -moz-opacity: 0.7;
    opacity: .570;
    filter: alpha(opacity=70);
}

.white_content {
    display: none;
    position: absolute;
    top: 40%;
    left: 35%;
    width: 40%;
    height: 30%;
    padding: 16px;
    border: 7px solid #29B1C9;
    border-radius: 10px;
    background-color: white;
    z-index: 1002;
    overflow: auto;
}
</style>
<style type="text/css">
.black_overlay1 {
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 200%;
    background-color: black;
    z-index: 1001;
    -moz-opacity: 0.7;
    opacity: .570;
    filter: alpha(opacity=70);
}

.white_content1 {
    display: none;
    position: absolute;
    top: 40%;
    left: 35%;
    width: 40%;
    height: 30%;
    padding: 16px;
    border: 7px solid #29B1C9;
    border-radius: 10px;
    background-color: white;
    z-index: 1002;
    overflow: auto;
}

.hide {
    display: none;
}
</style>
<script type="text/javascript">
function showpop1() {

    document.getElementById('light').style.display = 'block';
    document.getElementById('fade').style.display = 'block';
}
</script>

<script type="text/javascript">
function showpop2() {

    document.getElementById('light1').style.display = 'block';
    document.getElementById('fade1').style.display = 'block';
}
</script>

<script type="text/javascript">
function showpop3() {

    document.getElementById('light2').style.display = 'block';
    document.getElementById('fade2').style.display = 'block';
}

$('#choose__one').on('change', function() {
    var val = this.value;
    if (val == 'Services') {
        $('.services__cat').show();
        $('.prod__cat').hide();
    } else {
        $('.prod__cat').show();
        $('.services__cat').hide();
    }
})
</script>



<div id="light" class="white_content" style="display:none">
    <form action="" name="myf" id="myf" method="post" onsubmit="return cat_val();">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" style="border-bottom:1px #CCCCCC solid; font-size:14px; font-weight:bold;">Add Category
                    / Subcategory </td>
                <td style="border-bottom:1px #CCCCCC solid; float:right;"> <img src="images/icn_alert_error.png"
                        onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';"
                        style="width:14px; height:14px;" /></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>Category</td>

                <td><input type="text" name="other_cat" id="other_cat" /></td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>

            <tr>
                <td>Sub Category</td>

                <td><input type="text" name="other_subcat" id="other_subcat" /></td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="cat_submit" id="cat_submit" value="Add" />

                    <input type="button"
                        onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';"
                        value="Cancel" class="button1">

                </td>
            </tr>
        </table>
    </form>
</div>
<div id="fade" class="black_overlay">&nbsp;</div>


<div id="light1" class="white_content1">
    <form action="" name="myff" id="myff" method="post" onsubmit="return sub_val();">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" style="border-bottom:1px #CCCCCC solid; font-size:14px; font-weight:bold;">Add
                    Subcategory </td>
                <td style="border-bottom:1px #CCCCCC solid; float:right;"> <img src="images/icn_alert_error.png"
                        onclick="document.getElementById('light1').style.display='none';document.getElementById('fade1').style.display='none';"
                        style="width:14px; height:14px;" /></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>Category</td>

                <td>
                    <select name="othr_cat" id="othr_cat" style="width:148px;">

                        <option value="">Choose Category</option>
                        <?php 
						$cat_sel="SELECT * FROM category where parent_id=''";
						$res_cat=mysqli_query($con,$cat_sel);
						while($fetch_cat=mysqli_fetch_array($res_cat))
						{
						?>
                        <option value="<?php echo $fetch_cat['c_id']; ?>"><?php echo $fetch_cat['category']; ?></option>
                        <?php } ?>


                    </select>

                </td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>

            <tr>
                <td>Sub Category</td>

                <td><input type="text" name="othr_subcat" id="othr_subcat" /></td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="sub_submit" id="sub_submit" value="Add" />

                    <input type="button"
                        onclick="document.getElementById('light1').style.display='none';document.getElementById('fade1').style.display='none';"
                        value="Cancel" class="button1">

                </td>
            </tr>
        </table>
    </form>

</div>
<div id="fade1" class="black_overlay1">&nbsp;</div>

<div id="light2" class="white_content1">
    <form action="" name="myfff" id="myfff" method="post" onsubmit="return con_val();">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" style="border-bottom:1px #CCCCCC solid; font-size:14px; font-weight:bold;">Add Country
                </td>
                <td style="border-bottom:1px #CCCCCC solid; float:right;"> <img src="images/icn_alert_error.png"
                        onclick="document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none';"
                        style="width:14px; height:14px;" /></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>


            <tr>
                <td>Country Name</td>

                <td><input type="text" name="con_name" id="con_name" /></td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="con_submit" id="con_submit" value="Add" />

                    <input type="button"
                        onclick="document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none';"
                        value="Cancel" class="button1">

                </td>
            </tr>
        </table>
    </form>

</div>
<div id="fade2" class="black_overlay1">&nbsp;</div>

<?php include("includes/footer.php"); ?>