<?php 
include("includes/header.php");

//session_start();
$today=date("F j, Y");
date('Y-m-d');
$today=date("F j, Y");

if(isset($_REQUEST['Submit']))
{
//echo "sridevi";
$subject=$_REQUEST['subject'];
$keyword=$_REQUEST['keyword'];
$keyword1=$_REQUEST['keyword1'];
$keyword2=$_REQUEST['keyword2'];
$category=$_REQUEST['p_cat'];
//echo "<BR>";
$subcategory=$_REQUEST['sub_cat'];
//echo "<BR>";
$briefdes=$_REQUEST['briefdes'];
$detdes=$_REQUEST['detdes'];
$purchase=$_REQUEST['purchase'];
$valid=$_REQUEST['valid'];

if($valid=='1 Week')
$expired = date("F j, Y", strtotime("+1 week"));
if($valid=='2 Weeks')
$expired = date("F j, Y", strtotime("+14 days"));
if($valid=='1 Month')
$expired = date("F j, Y", strtotime("+1 month"));
if($valid=='2 Months')
$expired = date("F j, Y", strtotime("+2 months"));
if($valid=='4 Months')
$expired = date("F j, Y", strtotime("+4 months"));
if($valid=='6 Months')
$expired = date("F j, Y", strtotime("+6 months"));
if($valid=='12 Months')
$expired = date("F j, Y", strtotime("+12 months"));



$mycontact=$_REQUEST['mycontact'];
$price=$_REQUEST['price'];
$range1=$_REQUEST['range1'];
$range2=$_REQUEST['range2'];
$miniquantity=$_REQUEST['miniquantity'];
$quantity=$_REQUEST['quantity'];
$certificate=$_REQUEST['certificate'];
$company = $_REQUEST['companyname'];
$address = $_POST['streetaddress'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		$post_ip=$_SERVER['REMOTE_ADDR'];
	 $up_date= date("d.m.y");
	
$newfilename=basename($_FILES['userfile']['name']);
$filetemp=$_FILES['userfile']['tmp_name'];


move_uploaded_file($filetemp,"blog_photo_thumbnail/".$newfilename);



$src="blog_photo_thumbnail/".$newfilename;
$des="upload/".$newfilename;
copy($src,$des);


//$ftimages = "blog_photo_thumbnail/".$newfilename;
//$thumb= new EasyThumbnail($uploadfile, $ftimages, 120);



$select_buy="select * from registration where id='$session_user'";

$select_query=mysqli_query($con,$select_buy);

$select_count=mysqli_num_rows($select_query);

$select_fetch=mysqli_fetch_array($select_query);

$country = $select_fetch['country'];

$buyid=$select_fetch['id'];

$idd=$session_user;

$post_id=$_SERVER['REMOTE_ADDR'];

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

//echo "insert into buyingleads (id, subject, photo, keyword, keyword1, keyword2, category, subcategory, briefdes, detdes, purchase, valid, mycontact, price, range1, range2, miniquantity, quantity, certificate, ver_code, update_date, expiredate,  up_date, companyname, streetaddress, city, state, country, zip, status, lang_status) values ('$idd', '$subject', '$newfilename', '$keyword', '$keyword1', '$keyword2', '$category', '$subcategory', '$briefdes', '$detdes', '$purchase', '$valid', '$mycontact', '$price', '$range1', '$range2', '$miniquantity', '$quantity', '$certificate', '$ver_code', '$today','$expired',  '$up_date', '$company', '$address','$city','$state','$country','$zip','1','$lang_status')"; exit;

 $res1="insert into buyingleads (id, subject, photo, keyword, keyword1, keyword2, category, subcategory, briefdes, detdes, purchase, valid, mycontact, price, range1, range2, miniquantity, quantity, certificate, ver_code, update_date, expiredate,  up_date, companyname, streetaddress, city, state, country, zip, status, lang_status,post_ip) values ('$idd', '$subject', '$newfilename', '$keyword', '$keyword1', '$keyword2', '$category', '$subcategory', '$briefdes', '$detdes', '$purchase', '$valid', '$mycontact', '$price', '$range1', '$range2', '$miniquantity', '$quantity', '$certificate', '$ver_code', '$today','$expired',  '$up_date', '$company', '$address','$city','$state','$country','$zip','1','$lang_status','$post_ip')"; 

$result_sql1=mysqli_query($con,$res1) or die("insert error");

$selecttrade=mysqli_query($con,"select * from trade_alert where (keyword like '$subject%' or keyword like '$keyword' or keyword like '$keyword1' or keyword like '$keyword2') and  selectinfo='buyingleads'");

while($rowfetch=mysqli_fetch_array($selecttrade))
{
$tradeuserid=$rowfetch['user_id'];
$selectreg=mysqli_query($con,"select * from registration where id='$tradeuserid'");
$fetchreg=mysqli_fetch_array($selectreg);
$em=$fetchreg['email'];
$Firstname=$fetchreg['firstname'];
$selectreg1=mysqli_query($con,"select * from registration where id='$sess_id'");
$fetchreg1=mysqli_fetch_array($selectreg1);
$em1=$fetchreg1['email'];
$sub=$subject;
$msg=
"<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FBFFF8\" style=\"border:1px solid #FE7903;\">
  <tr bgcolor=\"#FFEAC2\">
    <td colspan=\"2\"><div style=\"font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#ff7300; text-align:left; padding-bottom:10px; line-height:26px;text-align:center;\">
You're an $webname Member!<br>
</div></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Dear $Firstname,</span></td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
   </tr>
  
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">I have already a member in $webname. And given below for the my detail description of purchase Requirement.</span> </td>
    
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
    
  </tr>
  <tr><td colspan=\"2\" height=\"25\"><span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#FF7300; font-weight:bold; padding-bottom:6px;\">Detail description in my Buying leads</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\"> $briefdes</span></td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:21px;\">$detdes</span></td>
  </tr>
 
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<a href=\"$signin\">Sign in now!</a></td>
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
    
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">Wishing you the very best of business,</span></td>
  </tr>
  <tr>
    <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\" height=\"25\">&nbsp;&nbsp;<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:13px;\">$webname Service Team</span></td>
  </tr>
</table>";

$headers = 'From:' . $em1 ."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

mail($em,$sub,$msg,$headers);

}

if($result_sql1)
{
header("location:buying_leads.php");
}

}

if(isset($_REQUEST['catte']))
{
$cate=$_REQUEST['category'];
}

 ?>
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
function validate(doc) {
    var fnam = document.buying.userfile.value;

    if (document.buying.subject.value == "") {
        alert("Please enter the Buying Lead Headline");
        document.buying.subject.focus();
        return false;
    }

    if (fnam != "") {
        splt = fnam.split('.');
        chksplt = splt[1].toLowerCase();

        if (chksplt == 'jpg' || chksplt == 'jpeg' || chksplt == 'bmp' || chksplt == 'png' || chksplt == 'gif') {

        } else {
            alert(" Upload only jpg,jpeg,bmp,png and Gif Files");
            document.buying.userfile.value = '';
            document.buying.userfile.focus();
            return false;
        }

    }


    var key = document.buying.keyword.value;
    if (key == "") {
        alert("Please enter the keyword");
        document.buying.keyword.focus();
        return false;
    }
    var noalpha = /^[a-zA-Z ]*$/;
    var key1 = document.buying.keyword1.value;
    var key2 = document.buying.keyword2.value;

    if (key1 != "") {
        if (!noalpha.test(key1)) {
            alert("Special Characters Are Not Allowed In Keyword1 .");
            document.buying.keyword1.value = "";
            document.buying.keyword1.focus();
            return false;
        }
    }

    if (key2 != "") {
        if (!noalpha.test(key2)) {
            alert("Special Characters Are Not Allowed In Keyword2 .");
            document.buying.keyword2.value = "";
            document.buying.keyword2.focus();
            return false;
        }
    }
    if (document.buying.p_cat.value == "") {
        alert("Please select the category");
        document.buying.p_cat.focus();
        return false;
    }


    if (document.buying.sub_cat.value == "") {
        alert("Please select the subcategory");
        document.buying.sub_cat.focus();
        return false;
    }

    if (document.buying.briefdes.value == "") {
        alert("Please enter the Brief description");
        document.buying.briefdes.focus();
        return false;
    }

    if (document.buying.valid.value == "") {
        alert("Please select the Valid days");
        document.buying.valid.focus();
        return false;
    }
    if (document.buying.mycontact.value == "") {
        alert("Please select the Mycontact");
        document.buying.mycontact.focus();
        return false;
    }
    if (document.buying.price.value == "") {
        alert("Please select the Currency Type");
        document.buying.price.focus();
        return false;
    }
    if ((document.buying.range1.value == "") || (document.buying.range1.value <= 0)) {
        alert("Please Enter Price Range1");
        document.buying.range1.focus();
        return false
    }
    if (isNaN(document.buying.range1.value)) {
        alert("Please Enter Number only");
        document.buying.range1.focus();
        return false
    }
    if ((document.buying.range2.value == "") || (document.buying.range2.value <= 0)) {
        alert("Please Enter Price Range2");
        document.buying.range2.focus();
        return false



    }
    if (isNaN(document.buying.range2.value)) {
        alert("Please Enter Number only");
        document.buying.range2.focus();
        return false
    }
    if (parseInt(document.buying.range2.value) <= parseInt(document.buying.range1.value)) {
        alert("The Max Range Should Be Greater than Min Ramnge");
        document.buying.range2.focus();
        return false
    }
    if (document.buying.miniquantity.value == "") {
        alert("Please Enter Minimum Quantity");
        document.buying.miniquantity.focus();
        return false

    }
    if (isNaN(document.buying.miniquantity.value) || (document.buying.miniquantity.value <= 0)) {
        alert("Please Enter Number only");
        document.buying.miniquantity.focus();
        return false
    }


    if (document.buying.quantity.value == "Unit") {
        alert("Please Enter Quantity Unit ");
        document.buying.quantity.focus();
        return false

    }

}
</script>

<script type="text/javascript">
function doPreview() {
    var newwin = window.open("buying_preview.php");
    //var newWin = window.open("", "Preview","width=500,height=300");
    //var newWin = "buying_preview.php"
    newWin.document.write("<html><body>" + document.getElementById('detdes').value, document.getElementById('price')
        .value, document.getElementById('range1').value + "</body></html>");
    newWin.document.close();
}

function textCounter(field, countfield, maxlimit) {

    if (field.value.length > maxlimit) // if the current length is more than allowed
        field.value = field.value.substring(0, maxlimit); // don't allow further input
    else
        countfield.value = maxlimit - field.value.length;
}
</script>

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

                <!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

                <div class="tabs-cont">
                    <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
                        <div class="bordersty">
                            <div class="headinggg"><strong> <?php echo $add_buy; ?></strong></div>
                            <!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
                            <form id="buying" name="buying" method="post" action="" enctype="multipart/form-data"
                                onsubmit="return validate(this);">


                                <div class="p-2">
                                    <div class="input-group">
                                        <h5><?php echo $basic_info; ?></h5>
                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $buying_headline; ?></h6>
                                        <input type="text" name="subject" class="" />
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $attachment_product_photo; ?></h6>
                                        <input type="file" name="userfile" id="userfile" />
                                        <br />
                                        <span class="textsmall" id="notice"></span>
                                    </div>

                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $keyword; ?></h6>
                                        <input type="text" name="keyword" class="" />
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $more_kewords; ?>
                                        </h6>
                                        <input type="text" name="keyword1" class="_new" maxlength="20"
                                            style="width:163px;" />
                                        <input type="text" name="keyword2" class="_new" maxlength="20"
                                            style="width:163px;" />
                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $category; ?></h6>

                                        <select name="p_cat" id="city" onchange="FUNCTION1(this.value);"
                                            class="">
                                            <option value=""><?php echo $sel_cat; ?></option>
                                            <?php 
                                                    $select_cate="SELECT * FROM category WHERE parent_id=''";
                                                    $res_cate=mysqli_query($con,$select_cate);
                                                    while($fetch_catw=mysqli_fetch_array($res_cate))
                                                    {					  
                                                ?>
                                            <option value="<?php echo $fetch_catw['c_id']; ?>">
                                                <?php echo $fetch_catw['category']; ?></option>
                                            <?php } ?>

                                        </select>
                                        <!-- <a href="addbuying_leads.php?catte"> + Add Other</a> -->
                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*
                                            </span><?php echo $sub_cat; ?></h6>

                                        <div id="subcat12">
                                            <select name="subcategory" class="">
                                                <option value=""><?php echo $sel_sub_cat; ?></option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="sub_cat" value="" />

                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $breif_des; ?>
                                        </h6>
                                        <textarea name="briefdes" cols="40" class="txtarea1" rows="3"
                                            onkeydown="textCounter(this.form.briefdescription, this.form.remLen,128);"
                                            onkeyup="textCounter(this.form.briefdescription, this.form.remLen,128); "></textarea><br />
                                        <?php echo $max; ?> <span class="redbold" id="newcharcount"> <input
                                                name="remLen" type="text" id="remLen" value="128" size="3" maxlength="3"
                                                readonly="readonly" /> </span>
                                        <?php echo $char_left; ?>
                                        <!--onkeyup="document.getElementById('newcharcount').innerHTML=this.value.length ;"  -->
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $detail_des; ?></h6>
                                        <textarea name="detdes" id="detdes" class="texteditor"></textarea>
                                    </div>

                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $expired_date; ?></h6>
                                        <select name="valid" class="">
                                            <option value=""><?php echo "select"; ?></option>
                                            <option value="1 weeks">1 <?php echo $week; ?></option>
                                            <option value="2 weeks">2 <?php echo $week; ?></option>
                                            <option value="1 Months">1 <?php echo $months;?></option>
                                            <option value="2 Months">2 <?php echo $months;?></option>
                                            <option value="4 Months">4 <?php echo $months;?></option>
                                            <option value="6 Months">6 <?php echo $months;?></option>
                                            <option value="12 Months">12 <?php echo $months;?></option>

                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <h6> <span style="color:#FF0000">*</span><?php echo $contact_preference; ?></h6>
                                        <div><label><input name="mycontact" type="radio"
                                                    value="Allowall suppliers to contact me(More quotations)"
                                                    checked="checked" />
                                                <?php echo $allow_more; ?></label></div>
                                        <div><label><input name="mycontact" type="radio"
                                                    value="Allow all suppliers to contact me by email only while concealing my other contact details" />
                                                <?php echo $allow_supliers; ?></label></div>
                                        <div><label><input name="mycontact" type="radio"
                                                    value="Only paid suppliers may contact me(Less quotations)" />
                                                <?php echo $less_only; ?></label></div>
                                    </div>


                                    <div class="input-group">
                                        <h5><?php echo $my_reqirement; ?></h5>
                                    </div>


                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $price_range; ?></h6>

                                        <div class="d-flex">
                                            <select name="price" id="price" class="txtfield_small">
                                                <option value=""><?php echo $currency; ?></option>
                                                <option value="USD">USD </option>
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
                                                <option value="OTHER"> <?php echo $OTHER; ?> </option>
                                            </select>&nbsp;&nbsp;
                                            <input type="text" name="range1" id="range1" class="txtfield_small" />
                                            &nbsp;&nbsp;~&nbsp;&nbsp;
                                            <input type="text" name="range2" id="range2" class="txtfield_small" />
                                        </div>
                                    </div>


                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $minimum_order_qua; ?></h6>
                                        <div class="d-flex">
                                            <input type="text" name="miniquantity" id="miniquantity"
                                                class="txtfield_small" />&nbsp;&nbsp;
                                            <select name="quantity" id="quantity" class="txtfield_small"
                                                style="width:140px;">
                                                <option value="Unit"><?php echo $Unit; ?></option>
                                                <option value="Bag/Bags"><?php echo $bag; ?> </option>
                                                <option value="Barrel/Barrels"> <?php echo $barrel; ?>
                                                </option>
                                                <option value="Bushel/Bushels"> <?php echo $Bushel; ?>
                                                </option>
                                                <option value="Cubic meter"> <?php echo $cubic_meter; ?>
                                                </option>
                                                <option value="Dozen"><?php echo $Dozen; ?></option>
                                                <option value="Gallon"> <?php echo $Gallon; ?></option>
                                                <option value="Gram"> <?php echo $Gram; ?> </option>
                                                <option value="Kilogram"> <?php echo $Kilogram; ?> </option>
                                                <option value="Kilometer"> ><?php echo $Kilometer; ?>
                                                </option>
                                                <option value="Long Ton"> <?php echo $long_ton;?> </option>
                                                <option value="Meter"> <?php echo $Meter; ?> </option>
                                                <option value="Metric Ton"><?php echo $metric_ton; ?>
                                                </option>
                                                <option value="Ounce"> <?php echo $Ounce; ?> </option>
                                                <option value="Pair"> <?php echo $Pair; ?> </option>
                                                <option value="Pack/Packs"> <?php echo $pack; ?> </option>
                                                <option value="Piece/Pieces"> <?php echo $pieces; ?>
                                                </option>
                                                <option value="Pound"> <?php echo $pound; ?> </option>
                                                <option value="Set/Sets"><?php echo $set; ?></option>
                                                <option value="Short Ton"> <?php echo $short_ton; ?>
                                                </option>
                                                <option value="Square Meter"> <?php echo $squre_meter; ?>
                                                </option>
                                                <option value="Ton"> <?php echo $ton; ?> </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $certificat_require; ?></h6>
                                        <textarea name="certificate" class="txtarea1" cols="35"></textarea>
                                    </div>
                                    <?php
                                        $profilesql = mysqli_query($con,"select * from registration where id='$session_user'");				
										$profilefetch = mysqli_fetch_array($profilesql);
                                    ?>
                                    <div class="input-group">
                                        <h5><?php echo $com_address; ?></h5>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $company_name; ?></h6>
                                        <input type="text" name="companyname" class=""
                                            value="<?php echo $profilefetch['companyname']; ?>" readonly="" />
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $street_address; ?>
                                        </h6>
                                        <input type="text" name="streetaddress" class=""
                                            value="<?php echo $profilefetch['street']; ?>" readonly="" />
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $city; ?></h6>
                                        <input type="text" name="city" class="" readonly=""
                                            value="<?php echo $profilefetch['city']; ?>" />
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $province_state; ?></h6>
                                        <input type="text" name="state" class="" readonly=""
                                            value="<?php echo $profilefetch['state'];?>" />
                                    </div>
                                    <?php
                                        $country =$profilefetch['country'];
                                        $sql_rr=mysqli_query($con,"select * from `country` where  country_id='$country'");   							                                             $row = mysqli_fetch_array($sql_rr); 
                                    ?>
                                    <div class="input-group">
                                        <h6><?php echo $country; ?></h6>
                                        <input type="text" name="country" class="" readonly=""
                                            value="<?php echo $row['country_name'];?>" />
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $zip_postal; ?></h6>
                                        <input type="text" name="zip" readonly="" class=""
                                            value="<?php echo $profilefetch['zipcode'];?>" />
                                    </div>
                                    <div class="input-group">
                                        <input type="submit" class="search_bg" name="Submit"
                                            value="<?php echo $submit; ?>" />
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

<?php include("includes/footer.php"); ?>