<?php 
include("includes/header.php");
$reg_pro=mysqli_fetch_array(mysqli_query($con,"select * from registration where id='$_SESSION[user_login]'"));

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
function del_chage() {
    //alert("hello");
    if (document.getElementById('del_type').value == 1) {
        document.getElementById('del_val').style.display = "block";
    } else {
        document.getElementById('del_val').style.display = "none";
    }

}
</script>

<script language="javascript">
function trim1(str) {
    if (!str || typeof str != 'string')
        return null;
    return str.replace(/^[\s]+/, '').replace(/[\s]+$/, '').replace(/[\s]{2,}/, ' ');
}

function validation() {

    fnam = document.frm_seller.uploadedfile.value;

    if ((document.frm_seller.subject.value == '') || (trim1(document.frm_seller.subject.value) == '')) {

        alert("Please Enter Subject");
        document.frm_seller.subject.value = '';
        document.frm_seller.subject.focus();
        return false;
    }

    if ((document.frm_seller.keyword.value == '') || (trim1(document.frm_seller.keyword.value) == '')) {

        alert("Please Enter Keyword");
        document.frm_seller.keyword.value = '';
        document.frm_seller.keyword.focus();
        return false;
    }

    if (document.frm_seller.p_cat.value == '') {

        alert("Please Enter Category");
        document.frm_seller.p_cat.focus();
        return false;
    }

    if (document.frm_seller.subcategory.value == '') {

        alert("Please Enter Sub Category");
        document.frm_seller.subcategory.focus();
        return false;
    }

    if (document.frm_seller.briefdescription.value == '') {

        alert("Please Enter Brief Description");
        document.frm_seller.briefdescription.focus();
        return false;
    }


    if (document.frm_seller.price.value == '') {

        alert("Please enter the price");
        document.frm_seller.price.focus();
        return false;
    }

    if (document.frm_seller.cur_type.value == '') {

        alert("Please choose currency type");
        document.frm_seller.cur_type.focus();
        return false;
    }

    if (document.frm_seller.del_type.value == '') {

        alert("Please choose the delivery type");
        document.frm_seller.del_type.focus();
        return false;
    }

    if (document.frm_seller.del_type.value == 1) {
        if (document.frm_seller.del_charge.value == '') {
            alert("Please choose the delivery Charge");
            document.frm_seller.del_charge.focus();
            return false;
        }

        if (document.frm_seller.del_cur_type.value == '') {

            alert("Please choose delivery currency type");
            document.frm_seller.del_cur_type.focus();
            return false;
        }
    }


    if (document.frm_seller.valid.value == '') {

        alert("Please Enter Valid Duration");
        document.frm_seller.valid.focus();
        return false;
    }


    if (document.frm_seller.uploadedfile.value != '') {
        splt = fnam.split('.');
        chksplt = splt[1].toLowerCase();

        if (chksplt == 'jpg' || chksplt == 'gif' || chksplt == 'png' || chksplt == 'jpeg' || chksplt == 'bmp') {

        } else {
            alert(" Upload only jpg,jpeg,tif,bmp,gif,png ");
            return false;
        }
        /*alert("Please Upload The Product Photo");
        document.frm_seller.uploadedfile.focus();*/
        return true;
    }




    /*if(document.frm_seller.businesstype.value=='')
    {
    	
    	alert("Please Enter Business Type");
    	document.frm_seller.businesstype.focus();
    	return false;
    }
    /*if(document.frm_seller.businesstype.value=='')
				{
					
					alert("Please Enter Business Type");
					document.frm_seller.businesstype.focus();
					return false;
				}
				
				if(document.frm_seller.businessrange.value=='')
				{
					
					alert("Please Enter Business Range");
					document.frm_seller.businessrange.focus();
					return false;
				}*/
    if (document.frm_seller.businessrange.value == '') {

        alert("Please Enter Business Range");
        document.frm_seller.businessrange.focus();
        return false;
    }*/
    var lengthcount = document.frm_seller.maxvalue.value;
    var checkedcount = 0;
    for (var i = 1; i < lengthcount; i++) {
        var checklist = "checkbox[" + i + "]";
        var dom = document.getElementById(checklist);
        if (dom.checked == true) {
            checkedcount++;
        }
    }
    if (checkedcount == 0) {
        alert("Select Atleast One Business Type ");
        return false;
    }
    return true;
}

function textCounter(field, countfield, maxlimit) {

    if (field.value.length > maxlimit) // if the current length is more than allowed
        field.value = field.value.substring(0, maxlimit); // don't allow further input
    else
        countfield.value = maxlimit - field.value.length;
}
</script>
<script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
<?php /*?><?php
if(isset($_REQUEST['succ'])) { ?>
<style type="text/css">
< !-- .style1 {
    font-weight: bold
}

-->
</style>

<div style="padding-left:300px; color:#009900; font-weight:bold;"> Confirmation Mail Sent To Your Email </div>
<?php } ?><?php */?>



<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>



            <div class="body-right">

                <?php include("includes/menu.php"); ?>

                <!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
                <?php
   		  $sql_ed=(mysqli_query($con,"select * from companyprofile where user_id='$session_user'"));
		  $row_ed=mysqli_fetch_array($sql_ed);
		  //print_r($row_ed);
		  $row_ed['P_service'];
		  $Logo= $row_ed['companylogo']; 
?>
                <div class="tabs-cont">
                    <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
                        <div class="bordersty">
                            <div class="headinggg"> <?php echo $add_sel_lead; ?></div>
                            <!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->

                            <form action="action.php" method="post" enctype="multipart/form-data" name="frm_seller"
                                id="frm_seller">

                                <div class="p-2">
                                    <div class="input-group">
                                        <h6>
                                            <span style="color:#FF0000">*</span><?php echo $selling_lead_type; ?>
                                        </h6>
                                        <div>
                                            <label>
                                                <input type="radio" name="leadtype" value="sell" checked="checked" />
                                                <?php echo $sell; ?>
                                            </label>
                                            <label><input type="radio" name="leadtype" value="agent" />
                                                <?php echo $agent; ?></label>
                                            <label>
                                                <input type="radio" name="leadtype" value="cooperation" />
                                                <?php echo $cooperation; ?>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="input-group">
                                        <h6> <span style="color:#FF0000">*</span><?php echo $pro_name; ?>
                                        </h6>
                                        <input type="text" name="subject" class="" value="" />
                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $keyword; ?></h6>
                                        <input type="text" name="keyword" class="" value="" />
                                        <div class="info"><?php echo $plz_input; ?>. </div>
                                    </div>
                                    <div class="input-group">
                                        <h6>
                                            <span style="color:#FF0000">*</span><?php echo $category; ?>
                                        </h6>
                                        <select name="p_cat" id="city" class=""
                                            onchange="Javascript:FUNCTION1(this.value);">
                                            <option value="">-- <?php echo $sel_cat; ?> --
                                            </option>
                                            <?php 
												if($_SESSION['language']=='english')
													{
												$select_cate="SELECT * FROM category WHERE parent_id='' order by category";
													
													}
													else if($_SESSION['language']=='french')
													{
													$select_cate="SELECT * FROM category_french WHERE parent_id='' order by category";
													}
													else if($_SESSION['language']=='chinese')
													{
													$select_cate="SELECT * FROM category_chinese WHERE parent_id='' order by category";
													}
													else
													{
													$select_cate="SELECT * FROM category_spanish WHERE parent_id='' order by category";
													}
																						
																						$res_cate=mysqli_query($con,$select_cate);
																						while($fetch_cate=mysqli_fetch_array($res_cate))
																						{											
																						?>
                                            <option value="<?php echo $fetch_cate['c_id']; ?>">
                                                <?php echo $fetch_cate['category']; ?>
                                            </option>
                                            <?php } ?>

                                        </select>

                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $sub_cat; ?></h6>

                                        <div id="subcat12">
                                            <select name="subcategory" class="">
                                                <option value="">--
                                                    <?php echo $sel_sub_cat;?> --</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="input-group">
                                        <h6>
                                            <span style="color:#FF0000">*</span><?php echo $breif_des; ?>
                                        </h6>
                                        <textarea name="briefdescription" cols="40" class="txtarea1" rows="3"
                                            onkeydown="textCounter(this.form.briefdescription, this.form.remLen,128);"
                                            onkeyup="textCounter(this.form.briefdescription, this.form.remLen,128); "></textarea><br />
                                        <?php echo $max; ?> <span class="redbold" id="newcharcount"> <input
                                                name="remLen" type="text" id="remLen" value="128" size="3" maxlength="3"
                                                readonly="readonly" /> </span>
                                        <?php echo $char_left; ?>


                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $detail_des; ?></h6>
                                        <textarea name="detail_description" id="detail_description"
                                            class="texteditor"></textarea>

                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $valid_for; ?>
                                        </h6>
                                        <select name="valid" class="">
                                            <option value="12">12 <?php echo $months; ?>
                                            </option>
                                            <option value="6">6 <?php echo $months; ?>
                                            </option>
                                            <option value="4">4 <?php echo $months; ?>
                                            </option>
                                            <option value="2">2 <?php echo $months; ?>
                                            </option>
                                        </select>
                                    </div>

                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $price; ?></h6>
                                        <div class="d-flex">
                                            <input type="text" name="price" id="price"/>&nbsp;&nbsp;<select
                                                name="cur_type" id="cur_type" class="txtfield_small">
                                                <option value=""><?php echo $currency; ?>
                                                </option>
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
                                                <option value="OTHER"> <?php echo $OTHER; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $delivery_type; ?>
                                        </h6>
                                        <select name="del_type" id="del_type" class="" onchange="del_chage();">
                                            <option value=""> <?php echo $selectt; ?>
                                            </option>
                                            <option value="1"> <?php echo $deliver_user; ?>
                                            </option>
                                            <option value="2"><?php echo $need_buyer; ?>
                                            </option>
                                        </select>
                                    </div>


                                    <div class="input-group">

                                        <h6>
                                            <span style="color:#FF0000">*</span><?php echo $delivery_charge; ?>
                                        </h6>
                                        <div class="d-flex">
                                            <input type="text" name="del_charge" id="del_charge" />&nbsp;&nbsp;
                                            <select name="del_cur_type" id="del_cur_type" class="txtfield_small">
                                                <option value="">
                                                    <?php echo $currency; ?>
                                                </option>
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
                                                <option value="OTHER">
                                                    <?php echo $OTHER; ?> </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <h6><?php echo $attach_product_photo; ?></h6>
                                        <input type="file" name="uploadedfile" value="" class="" />
                                        <?php //echo $filename;?>
                                    </div>

                                    <div class="input-group normalbold">
                                        <strong><?php echo $desc; ?></strong></strong></div>

                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span><?php echo $bussiness_type; ?>
                                        </h6>
                                        <?php $i=1; ?>
                                        <div class="inTxtNormal">
                                            <label>
                                                <input type="checkbox" name="businesstype[]" value="Manufacturer"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $Manufacturer; ?> <br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]" value="Trading Company"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $tradeing_company; ?> <br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]" value="Buying Office"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $buying_office; ?> <br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]" value="Agent"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $agent; ?> <br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]"
                                                    value="Distributor/Wholesaler"
                                                    id="checkbox[<?php echo $i;?>]" /><?php echo $distributor; ?>
                                                <br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]"
                                                    value="Government ministry/Bureau/Commission"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $government_ministry; ?><br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]" value="Association"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $association; ?> <br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]"
                                                    value="Business Service (Transportation, finance, travel, Ads, etc)"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $bussi_service; ?> <br />
                                                <?php $i++;?>
                                            </label>
                                            <label>
                                                <input type="checkbox" name="businesstype[]" value="Other"
                                                    id="checkbox[<?php echo $i;?>]" />
                                                <?php echo $others; ?>
                                                <input type="hidden" value="<?PHP echo $i; ?>" name="maxvalue" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $business_range; ?></h6>
                                        <div class="inTxtNormal">
                                            <?php echo $sell_index_proser;?>
                                            <br />
                                            <input type="text" name="businessrange" value="" class=""
                                                size="25" />
                                        </div>
                                </div>
                                <div class="input-group">
                                    <strong> <?php echo $desc_long; ?>.</strong>
                                </div>

                                <div class="input-group">
                                    <h5><?php echo $com_address; ?><h5>
                                </div>
                                <div>
                                    <div>
                                        <?php
												
														$profilesql = mysqli_query($con,"select * from registration where id='$session_user'");
														
												
														$profilefetch = mysqli_fetch_array($profilesql);
														
											
												?>
                                        <div class="input-group">
                                            <h6 class="inTxtNormal"><?php echo $company_name; ?></h6>
                                            <input type="text" name="companyname" class="txtfield3_new"
                                                value="<?php echo $profilefetch['companyname']; ?>" readonly="" />
                                        </div>
                                        <div class="input-group">
                                            <h6 class="inTxtNormal">
                                                <?php echo $street_address; ?></h6>
                                            <input type="text" name="streetaddress" class="txtfield3_new"
                                                value="<?php echo $profilefetch['street']; ?>" readonly="" />

                                        </div>
                                        <div class="input-group">
                                            <h6 class="inTxtNormal"><?php echo $city; ?>
                                            </h6>
                                            <input type="text" name="city" class="txtfield3_new" readonly=""
                                                value="<?php echo $profilefetch['city']; ?>" />

                                        </div>
                                        <div class="input-group">
                                            <h6 class="inTxtNormal"><?php echo $province_state; ?></h6>
                                            <input type="text" name="state" class="txtfield3_new" readonly=""
                                                value="<?php echo $profilefetch['state'];?>" />
                                        </div>
                                        <?php
											  $country =$profilefetch['country'];
					                         $sql_rr=mysqli_query($con,"select * from `country` where  country_id='$country'");   							                                             $row = mysqli_fetch_array($sql_rr); 
					                          ?>
                                        <div class="input-group">
                                            <h6 class="inTxtNormal">Country<?php //echo $country; ?></h6>

                                            <input type="text" name="country1" class="txtfield3_new" readonly=""
                                                value="<?php echo $row['country_name'];?>" />
                                            <input type="hidden" name="country" class="txtfield3_new" readonly=""
                                                value="<?php echo $row['country_id'];?>" />

                                        </div>
                                        <div class="input-group">
                                            <h6 class="inTxtNormal"><?php echo $zip_postal; ?></h6>
                                            <input type="text" name="zip" readonly="" class="txtfield3_new"
                                                value="<?php echo $profilefetch['zipcode'];?>" />
                                        </div>
                                    </div>
                                </div>



                                <div class="input-group">
                                    <div align="center" colspan="4" class="seller" valign="top">
                                        <?php if($reg_pro['paypal_id'] != "") { ?>
                                        <input name="submit" type='submit' class="search_bg"
                                            value="<?php echo $submit; ?>"
                                            onclick="return validation();" /><?php } else {  ?>

                                        <a href="editprofile.php?pay_err" class="search_bg"
                                            style="padding:4px;">Submit</a>
                                        <?php } ?>
                                        <!--<div><input type="submit" name="preview" value="Preview" onclick="javascript:showPreview();"/></div> -->
                                    </div>
                                </div>



                        </div>

                        </form>

                        <div>


                        </div>



                    </div>







                </div>
            </div>





        </div>



    </div>


</div>


</div>

<?php include("includes/footer.php"); ?>