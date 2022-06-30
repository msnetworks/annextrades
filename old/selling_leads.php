<?php
include("includes/header.php"); 

include('config.php');
$per_page = 3; 

//getting number of rows and calculating no of pages
//$select_1 = "select * from tbl_seller where status='1' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
if($_SESSION['language']=='english')
{
$sql = "select * from tbl_seller where status='1' and lang_status='0' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd = mysqli_query($con,$sql);
$count = mysqli_num_rows($rsd);
$pages = ceil($count/$per_page);

//$select_1 = "select * from tbl_seller where status='3' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql1 = "select * from tbl_seller where status='3' and lang_status='0' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd1 = mysqli_query($con,$sql1);
$count1 = mysqli_num_rows($rsd1);
$pages1 = ceil($count1/$per_page);

$sql2 = "select * from tbl_seller where status='2' and lang_status='0' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd2 = mysqli_query($con,$sql2);
$count2 = mysqli_num_rows($rsd2);
$pages2 = ceil($count2/$per_page);

//$select_1 = "select * from tbl_seller where status='0' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql3 = "select * from tbl_seller where status='0' and lang_status='0' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd3 = mysqli_query($con,$sql3);
$count3 = mysqli_num_rows($rsd3);
$pages3 = ceil($count3/$per_page);

}
else if($_SESSION['language']=='french')
{
$sql = "select * from tbl_seller where status='1' and lang_status='1' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd = mysqli_query($con,$sql);
$count = mysqli_num_rows($rsd);
$pages = ceil($count/$per_page);

//$select_1 = "select * from tbl_seller where status='3' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql1 = "select * from tbl_seller where status='3' and lang_status='1' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd1 = mysqli_query($con,$sql1);
$count1 = mysqli_num_rows($rsd1);
$pages1 = ceil($count1/$per_page);

$sql2 = "select * from tbl_seller where status='2' and lang_status='1' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd2 = mysqli_query($con,$sql2);
$count2 = mysqli_num_rows($rsd2);
$pages2 = ceil($count2/$per_page);

//$select_1 = "select * from tbl_seller where status='0' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql3 = "select * from tbl_seller where status='0' and lang_status='1' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd3 = mysqli_query($con,$sql3);
$count3 = mysqli_num_rows($rsd3);
$pages3 = ceil($count3/$per_page);

}
else
{
$sql = "select * from tbl_seller where status='1' and lang_status='2' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd = mysqli_query($con,$sql);
$count = mysqli_num_rows($rsd);
$pages = ceil($count/$per_page);

//$select_1 = "select * from tbl_seller where status='3' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql1 = "select * from tbl_seller where status='3' and lang_status='2' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd1 = mysqli_query($con,$sql1);
$count1 = mysqli_num_rows($rsd1);
$pages1 = ceil($count1/$per_page);

$sql2 = "select * from tbl_seller where status='2' and lang_status='2' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd2 = mysqli_query($con,$sql2);
$count2 = mysqli_num_rows($rsd2);
$pages2 = ceil($count2/$per_page);

//$select_1 = "select * from tbl_seller where status='0' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql3 = "select * from tbl_seller where status='0' and lang_status='2' and user_id='$session_user' and trash='0' ORDER BY seller_id DESC";
$rsd3 = mysqli_query($con,$sql3);
$count3 = mysqli_num_rows($rsd3);
$pages3 = ceil($count3/$per_page);

}

 ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load() {
        $("#loading").fadeIn(900, 0);
        $("#loading").html("<img src='bigLoader.gif' />");
    }
    //Hide Loading Image
    function Hide_Load() {
        $("#loading").fadeOut('slow');
    };


    //Default Starting Page Results

    $("#pagination span:first").css({
        'color': '#FF0084'
    }).css({
        'border': 'none'
    });

    Display_Load();

    $("#content").load("pagination_selling.php?page=1", Hide_Load());



    //Pagination Click
    $("#pagination span").click(function() {

        Display_Load();

        //CSS Styles
        $("#pagination span")
            .css({
                'border': 'solid #dddddd 1px'
            })
            .css({
                'color': '#0063DC'
            });

        $(this)
            .css({
                'color': '#FF0084'
            })
            .css({
                'border': 'none'
            });

        //Loading Data
        var pageNum = this.id;

        $("#content").load("pagination_selling.php?page=" + pageNum, Hide_Load());
    });


});
</script>


<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load2() {
        $("#loading2").fadeIn(900, 0);
        $("#loading2").html("<img src='bigLoader.gif' />");
    }
    //Hide Loading Image
    function Hide_Load2() {
        $("#loading2").fadeOut('slow');
    };


    //Default Starting Page Results

    $("#pagination2 span:first").css({
        'color': '#FF0084'
    }).css({
        'border': 'none'
    });

    Display_Load2();

    $("#content2").load("pagination_selling2.php?page=1", Hide_Load2());



    //Pagination Click
    $("#pagination2 span").click(function() {

        Display_Load2();

        //CSS Styles
        $("#pagination2 span")
            .css({
                'border': 'solid #dddddd 1px'
            })
            .css({
                'color': '#0063DC'
            });

        $(this)
            .css({
                'color': '#FF0084'
            })
            .css({
                'border': 'none'
            });

        //Loading Data
        var pageNum2 = this.id;

        $("#content2").load("pagination_selling2.php?page=" + pageNum2, Hide_Load2());
    });


});
</script>

<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load1() {
        $("#loading1").fadeIn(900, 0);
        $("#loading1").html("<img src='bigLoader.gif' />");
    }
    //Hide Loading Image
    function Hide_Load1() {
        $("#loading1").fadeOut('slow');
    };


    //Default Starting Page Results

    $("#pagination1 span:first").css({
        'color': '#FF0084'
    }).css({
        'border': 'none'
    });

    Display_Load1();

    $("#content1").load("pagination_selling1.php?page=1", Hide_Load1());



    //Pagination Click
    $("#pagination1 span").click(function() {

        Display_Load1();

        //CSS Styles
        $("#pagination1 span")
            .css({
                'border': 'solid #dddddd 1px'
            })
            .css({
                'color': '#0063DC'
            });

        $(this)
            .css({
                'color': '#FF0084'
            })
            .css({
                'border': 'none'
            });

        //Loading Data
        var pageNum1 = this.id;

        $("#content1").load("pagination_selling1.php?page=" + pageNum1, Hide_Load1());
    });


});
</script>

<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load3() {
        $("#loading3").fadeIn(900, 0);
        $("#loading3").html("<img src='bigLoader.gif' />");
    }
    //Hide Loading Image
    function Hide_Load3() {
        $("#loading3").fadeOut('slow');
    };


    //Default Starting Page Results

    $("#pagination3 span:first").css({
        'color': '#FF0084'
    }).css({
        'border': 'none'
    });

    Display_Load3();

    $("#content3").load("pagination_selling3.php?page=1", Hide_Load3());



    //Pagination Click
    $("#pagination3 span").click(function() {

        Display_Load3();

        //CSS Styles
        $("#pagination3 span")
            .css({
                'border': 'solid #dddddd 1px'
            })
            .css({
                'color': '#0063DC'
            });

        $(this)
            .css({
                'color': '#FF0084'
            })
            .css({
                'border': 'none'
            });

        //Loading Data
        var pageNum3 = this.id;

        $("#content3").load("pagination_selling3.php?page=" + pageNum3, Hide_Load3());
    });


});
</script>

<script language="javascript" type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue) {


    if (!document.forms[FormName]) {

        return;
    }
    var objCheckBoxes = document.forms[FormName].elements[FieldName];

    if (!objCheckBoxes)
        return;
    var countCheckBoxes = objCheckBoxes.length;
    if (!countCheckBoxes) {
        objCheckBoxes.checked = CheckValue;

    } else {
        // set the check value for all check boxes
        for (var i = 0; i < countCheckBoxes; i++) {
            objCheckBoxes[i].checked = CheckValue;
        }
    }
}


function chkalert() {
    alert("dsa");
}

function checkbox1() {

    var lengthcount = document.frm_seller.maxvalue.value;

    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var checkbox = "checkbox[" + i + "]";
        var dom = document.getElementById(checkbox);
        if (dom.checked == true) {
            checkedcount++;
        }
    }
    if (checkedcount < 1) {
        alert("Select Atleast One Checkbox");
        return false;
    } else if (confirm('Are you sure you want to Delete this Record?')) {
        return true;
    } else {
        return false;
    }
}

function compare() {
    /*if(document.frm_seller.checkval.value=="")
	{
	alert('Select Atleast One Checkbox');
	return false;
	}
	else
	{
	if( confirm('Are you sure you want to Delete this Record?') )
						{
						return true;
						}
						else
						{	
						return false; 
						}
	}  */
    var result = checkbox1();
    if (result == false) {
        return false;
    } else {
        document.forms['frm_seller'].submit();
    }
}
</script>
<!--<script src="js/jquery-1.2.3.pack.js"></script>
<script src="js/runonload.js"></script>
<script src="js/tutorial.js"></script>-->

<style>
a:hover {

    color: #DF3D82;
    text-decoration: underline;

}

#loading {
    width: 100%;
    position: absolute;
}

#pagination {
    text-align: center;
    margin-left: 120px;
}

/*span{	
list-style: none; 
float: left; 
margin-right: 16px; 
padding:5px; 
border:solid 1px #dddddd;
color:#0063DC; 
}*/
span:hover {
    color: #FF0084;
    cursor: pointer;
}
</style>
<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;"> <?php echo $success_mail_msg; ?> </div>
<?php } ?>

<?php
if(isset($_REQUEST['suc'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;"> <?php echo $update_success; ?>.. </div>
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
                    <div class="left">



                        <ul class="mar_top left_tab1">
                            <li class="left_hover" id="three1" onmouseover="leftTab('three',1,4)">
                                <?php echo $approval_pending; ?></li>
                            <li class="" id="three2" onmouseover="leftTab('three',2,4)">
                                <?php echo $editing_required; ?></li>
                            <li class="" id="three3" onmouseover="leftTab('three',3,4)">
                                <?php echo $approved; ?></li>

                            <li class="" id="three4" onmouseover="leftTab('three',4,4)">
                                <?php echo $expired; ?></span> </li>


                        </ul>

                        <div class="left_div_one1">
                            <div style="display: block; font-size:12px; height:400px;" id="leftcon_three_1">
                                <!--<div style="width:190px;  float:left;"><strong>Photo</strong></div>
<div style="width:190px;  float:left;"><strong>Product Name</strong></div>
<div style="width:190px;  float:left;"><strong>Product Description</strong></div>
<div style="width:190px;  float:left;"><strong>Update Date</strong></div>-->
                                <?php /*?><?php
							
	if(isset($_REQUEST['delete']))
		{
				$selected = $_POST['checkbox'];
				
				foreach($selected as $sel)
				{
				echo "update `tbl_seller` set trash='1' where `seller_id` = '$sel' and user_id='$session_user'";
				$delete = mysqli_query($con,"update `tbl_seller` set trash='1' where `seller_id` = '$sel' and user_id='$session_user'");
				$del = mysqli_fetch_array($delete); 
				}   
				//header("location:selling_leads.php"); 
				
		}
	
	?><?php */?>
                                <!--<div id="message">

</div>-->
                                <!--<form method="post" enctype="multipart/form-data" name="frm_seller" id="frm_seller" onsubmit="return compare();">-->
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <!--<tr><td>
</td></tr>-->
                                    <!--<tr>
		<td >
		<table width="30%" cellpadding="0" cellspacing="0">
		<tr>
		<td>
		&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:SetAllCheckBoxes('frm_seller','checkbox[]',true)" class="topics">Sellect all </a> &nbsp;/&nbsp; <a href="#" class="topics" onclick="javascript:SetAllCheckBoxes('frm_seller','checkbox[]',false)">Clear all </a></td>
		<td >
		   <input type="submit" class="search_bg" name="delete" value="<?php //echo $manage_selling_leads_dt;?>" onclick="return checkbox1();"/>  
		<input type="submit" class="search_bg" name="delete" value="delete" /> 
		<input type="submit" name="submit" class="button" id="submit_btn" value="delete" />
</td>
</tr>
</table>
</td>
</tr>-->

                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td>
                                                        <div id="delete_result"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--<td width="50"><strong style="color:#C55000;">&nbsp;</strong></td>-->
                                                    <td width="150"><strong
                                                            style="color:#C55000;"><?php echo $photos; ?></strong></td>
                                                    <td width="150"><strong
                                                            style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                    </td>
                                                    <td width="150"><strong
                                                            style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                    </td>
                                                    <td width="150"><strong
                                                            style="color:#C55000;"><?php echo $expired_date; ?></strong>
                                                    </td>
                                                    <td width="150"><strong
                                                            style="color:#C55000;"><?php echo "Product Status"; ?></strong>
                                                    </td>
                                                    <td width="100"><strong
                                                            style="color:#C55000;"><?php echo $action; ?></strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <?php /*?><?php 
$select_app_pen="SELECT * FROM product WHERE userid='$session_user' AND status='1' ";
$res_app_pen=mysqli_query($con,$select_app_pen);
$num_rows=mysqli_num_rows($res_app_pen);
if($num_rows!="") 
{
while($fetch_app_pen=mysqli_fetch_array($res_app_pen))
{
 $imgpath1 = "blog_photo_thumbnail/".$fetch_app_pen['p_photo'];	
if(($fetch_app_pen['p_photo'] != '') && (file_exists($imgpath1)))
{
  $image5="blog_photo_thumbnail/".$fetch_app_pen['p_photo'];
}else{
  $image5="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td width="150"><img src="<?php echo $image5;  ?>" width="80" height="80" />
                                        </td>
                                        <td><strong>
                                                <?PHP echo ucfirst($fetch_app_pen['p_name']);?></strong></td>
                                        <td><strong><?php echo $fetch_app_pen['p_bdes'];?></strong></td>
                                        <td><strong>
                                                <?PHP echo $fetch_app_pen['udate'];?></strong></td>
                                    </tr>
                                    <?php } ?><?php */?>
                                    <tr>
                                        <td>
                                            <div id="loading" style="height:100px;"></div>
                                            <div id="content"></div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <ul id="pagination">
                                                <?php
				//Show page links
				for($i=1; $i<=$pages; $i++)
				{
					echo '<span id="'.$i.'">'.$i.'</span>&nbsp;';
				}
				?>
                                            </ul>
                                        </td>
                                    </tr>

                                    <?php /*?><?php }else { ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>No Results found</td>
                                    </tr>
                                    <?php } ?><?php */?>

                                </table>
                                </form>

                            </div>



                            <div id="leftcon_three_2" style="display: none;">
                                <div style="width:779px; height:400px; OVERFLOW: hidden;">
                                    <div id="marqueebox2" style="width:779px; overflow: hidden; margin-top: 0px;">

                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td>
                                                                <div id="delete_result"></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $photos; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $expired_date; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo "Product Status"; ?></strong>
                                                            </td>
                                                            <td width="100"><strong
                                                                    style="color:#C55000;"><?php echo $action; ?></strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <?php /*?><?php 
$select_edit="SELECT * FROM product WHERE userid='$session_user' AND  status='3' ";
$res_edit=mysqli_query($con,$select_edit);
$num_rows_edit=mysqli_num_rows($res_edit);
if($num_rows_edit!="") {
while($fet_edit=mysqli_fetch_array($res_edit))
{
$imgpath = "blog_photo_thumbnail/".$fet_edit['p_photo'];	
if(($fet_edit['p_photo'] != '') && (file_exists($imgpath)))
{
 $image="blog_photo_thumbnail/".$fet_edit['p_photo'];
}else{
 $image="blog_photo_thumbnail/profile_pic_small.jpg";
}
?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td width="150"><img src="<?PHP echo $image; ?>" width="80"
                                                        height="80" /></td>
                                                <td><strong><?php echo $fet_edit['p_name']; ?></strong></td>
                                                <td><strong><?php echo $fet_edit['udate'];?></strong></td>
                                                <td><strong>Edit</strong></td>
                                            </tr>
                                            <?php }  } else { ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>No Results found</td>
                                            </tr>
                                            <?php } ?><?php */?>
                                            <tr>
                                                <td>
                                                    <div id="loading1" style="height:100px;"></div>
                                                    <div id="content1"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <ul id="pagination1">
                                                        <?php
				//Show page links
				for($j=1; $j<=$pages1; $j++)
				{
					echo '<span id="'.$j.'">'.$j.'</span>&nbsp;';
				}
				?>
                                                    </ul>
                                                </td>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                            </div>

                            <div id="leftcon_three_3" style="display: none;">
                                <div style="width:779px; height:400px; OVERFLOW: hidden;">
                                    <div id="marqueebox2" style="width:779px; overflow: hidden; margin-top: 0px;">

                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $photos; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $expired_date; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo "Product Status"; ?></strong>
                                                            </td>
                                                            <td width="100"><strong
                                                                    style="color:#C55000;"><?php echo $action; ?></strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <?php /*?><?php 
$select_app_pen="SELECT * FROM product WHERE userid='$session_user' AND status='1' ";
$res_app_pen=mysqli_query($con,$select_app_pen);
$num_rows=mysqli_num_rows($res_app_pen);
if($num_rows!="") 
{
while($fetch_app_pen=mysqli_fetch_array($res_app_pen))
{
 $imgpath1 = "blog_photo_thumbnail/".$fetch_app_pen['p_photo'];	
if(($fetch_app_pen['p_photo'] != '') && (file_exists($imgpath1)))
{
  $image5="blog_photo_thumbnail/".$fetch_app_pen['p_photo'];
}else{
  $image5="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td width="150"><img src="<?php echo $image5;  ?>" width="80"
                                                        height="80" /></td>
                                                <td><strong>
                                                        <?PHP echo ucfirst($fetch_app_pen['p_name']);?></strong></td>
                                                <td><strong><?php echo $fetch_app_pen['p_bdes'];?></strong></td>
                                                <td><strong>
                                                        <?PHP echo $fetch_app_pen['udate'];?></strong></td>
                                            </tr>
                                            <?php } ?><?php */?>
                                            <tr>
                                                <td>
                                                    <div id="loading2" style="height:100px;"></div>
                                                    <div id="content2"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <ul id="pagination2">
                                                        <?php
				//Show page links
				for($k=1; $k<=$pages2; $k++)
				{
					echo '<span id="'.$k.'">'.$k.'</span>&nbsp;';
				}
				?>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php /*?><?php }else { ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>No Results found</td>
                                            </tr>
                                            <?php } ?><?php */?>

                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div id="leftcon_three_4" style="display: none;">
                                <div style="width:779px; height:400px; OVERFLOW: hidden;">
                                    <div id="marqueebox2" style="width:779px; overflow: hidden; margin-top: 0px;">

                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $photos; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo $expired_date; ?></strong>
                                                            </td>
                                                            <td width="150"><strong
                                                                    style="color:#C55000;"><?php echo "Product Status"; ?></strong>
                                                            </td>

                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <?php /*?><?php 
$select_app_pen="SELECT * FROM product WHERE userid='$session_user' AND status='1' ";
$res_app_pen=mysqli_query($con,$select_app_pen);
$num_rows=mysqli_num_rows($res_app_pen);
if($num_rows!="") 
{
while($fetch_app_pen=mysqli_fetch_array($res_app_pen))
{
 $imgpath1 = "blog_photo_thumbnail/".$fetch_app_pen['p_photo'];	
if(($fetch_app_pen['p_photo'] != '') && (file_exists($imgpath1)))
{
  $image5="blog_photo_thumbnail/".$fetch_app_pen['p_photo'];
}else{
  $image5="blog_photo_thumbnail/profile_pic_small.gif";
}
// echo ($fetchrow['p_photo']!=""&& (file_exists("blog_photo_thumbnail/".$fetchrow['p_photo'])))  ?     "blog_photo_thumbnail/".$fetchrow['p_photo']  :  "blog_photo_thumbnail/profile_pic_small.gif" ; 
?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td width="150"><img src="<?php echo $image5;  ?>" width="80"
                                                        height="80" /></td>
                                                <td><strong>
                                                        <?PHP echo ucfirst($fetch_app_pen['p_name']);?></strong></td>
                                                <td><strong><?php echo $fetch_app_pen['p_bdes'];?></strong></td>
                                                <td><strong>
                                                        <?PHP echo $fetch_app_pen['udate'];?></strong></td>
                                            </tr>
                                            <?php } ?><?php */?>
                                            <tr>
                                                <td>
                                                    <div id="loading3" style="height:100px;"></div>
                                                    <div id="content3"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <ul id="pagination3">
                                                        <?php
				//Show page links
				for($l=1; $l<=$pages3; $l++)
				{
					echo '<span id="'.$l.'">'.$l.'</span>&nbsp;';
				}
				?>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php /*?><?php }else { ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>No Results found</td>
                                            </tr>
                                            <?php } ?><?php */?>

                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>



        </div>


    </div>


</div>

<?php include("includes/footer.php"); ?>