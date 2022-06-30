<?php
include("includes/header.php"); 
include("includes/sess_check.php"); 
include('config.php');
$per_page = 3; 

//getting number of rows and calculating no of pages
//$select_1 = "select * from tbl_seller where status='1' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql = "SELECT * FROM buyingleads where id='$session_user' and status='1' and trash = 0 order by `buy_id` desc";
$rsd = mysqli_query($con,$sql);
$count = mysqli_num_rows($rsd);
$pages = ceil($count/$per_page);

//$select_1 = "select * from tbl_seller where status='3' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql1 = "SELECT * FROM buyingleads where id='$session_user' and status='3' and trash = 0 order by `buy_id` desc";
$rsd1 = mysqli_query($con,$sql1);
$count1 = mysqli_num_rows($rsd1);
$pages1 = ceil($count1/$per_page);

$sql2 = "SELECT * FROM buyingleads where id='$session_user' and status='2' and trash = 0 order by `buy_id` desc";
$rsd2 = mysqli_query($con,$sql2);
$count2 = mysqli_num_rows($rsd2);
$pages2 = ceil($count2/$per_page);

//$select_1 = "select * from tbl_seller where status='0' and user_id='$sess_id' and trash='0' ORDER BY seller_id DESC";
$sql3 = "SELECT * FROM buyingleads where id='$session_user' and status='0' and trash = 0 order by `buy_id` desc";
$rsd3 = mysqli_query($con,$sql3);
$count3 = mysqli_num_rows($rsd3);
$pages3 = ceil($count3/$per_page);

 ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load() {
        $("#loading").fadeIn(900, 0);
        $("#loading").html("<img src='images/bigLoader.gif' width='25' height='25' />");
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

    $("#content").load("pagination_buying.php?page=1", Hide_Load());



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

        $("#content").load("pagination_buying.php?page=" + pageNum, Hide_Load());
    });


});
</script>


<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load2() {
        $("#loading2").fadeIn(900, 0);
        $("#loading2").html("<img src='images/bigLoader.gif' width='25' height='25'/>");
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

    $("#content2").load("pagination_buying2.php?page=1", Hide_Load2());



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

        $("#content2").load("pagination_buying2.php?page=" + pageNum2, Hide_Load2());
    });


});
</script>

<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load1() {
        $("#loading1").fadeIn(900, 0);
        $("#loading1").html("<img src='images/bigLoader.gif' width='25' height='25'/>");
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

    $("#content1").load("pagination_buying1.php?page=1", Hide_Load1());




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

        $("#content1").load("pagination_buying1.php?page=" + pageNum1, Hide_Load1());
    });


});
</script>

<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load3() {
        $("#loading3").fadeIn(900, 0);
        $("#loading3").html("<img src='images/bigLoader.gif' width='25' height='25' />");
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

    $("#content3").load("pagination_buying3.php?page=1", Hide_Load3());



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

        $("#content3").load("pagination_buying3.php?page=" + pageNum3, Hide_Load3());
    });


});
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
                                <?php echo $approved; ?> </li>

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
                                                            style="color:#C55000;"><?php echo $expired_date;?></strong>
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
                                                <td colspan="4">
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
                                                    <div id="loading2" style=""></div>
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

                            <!--<div class="emil_div">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="middle"> <img src="images/mail.jpg" alt="" width="28" height="32" /></td>
    <td align="center" valign="middle"><?php echo $update_product; ?>.</td>
    <td align="left"  valign="middle"> <input type="text" value="<?php echo $email_add; ?>" /></td>
        <td align="left" valign="middle"><input name="" type="button" value="<?php echo $subscribe="Subscribe"; ?>" class="subscribe-btn"/>  </td>
  </tr>
</table>

					</div>-->
                        </div>


                    </div>
                </div>

            </div>

            <!--<div class="body-cont2"> 

<div class="advantage-cont"> 

<div class="advantage-heading"> Advantage</div>

<div class="advantage-icon"><img src="images/adv-icon.jpg" alt="" width="83" height="83" /> </div>

<div class="advantage-content">Are you interested register your web site for  B2B Website ?  you can register your company in a few mouse clicks and benefit from an offer that is perfectly adapted to your ... </div>

</div>

<div class="contspe"> <img src="images/spe2.jpg" alt="" /> </div>

<div class="advantage-cont"> 

<div class="advantage-heading"> Our security</div>

<div class="advantage-icon2"><img src="images/security.jpg" alt="" width="110" height="70" /></div>

<div class="advantage-content">Data exchange connections between trading partners must be secure. The first step to achieving secure e-business is to understand the technological capabilities of each trading partner by conducting an audit.</div>

</div>

</div>-->




            <!--<div class="body-cont3"> 
<div class="leadscont"> 
<div class="leads-top"> 

<div class="leads-heading">New Buying Leads</div>
<div class="post-now"> <a href="#">Post Now</a> </div>

<div class="leads-heading2">New Selling Leads</div>
<div class="post-now"> <a href="#">Post Now</a> </div>

</div>


<div class="leads-content"> 
<div class="newleads-cont">  

<div class="leades1"> 
<ul>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>


<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>
</ul>

</div>

</div>

<div class="spe3"> </div>

<div class="newleads-cont2">  

<div class="leades1"> 
<ul>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>


<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>

<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>


<li> <div class="flag"><a href="#"><img src="images/leads-flag.jpg" alt="" width="14" height="11" /></a> </div>

<div class="lead-name"><a href="#">Fashionale Co.,Ltd  </a></div>
<div class="leads-date"> Dec 28</div>

</li>
</ul>

</div>

</div>

</div>
<div class="leads-bot"> </div>

</div>


<div class="ad"><a href="#"><img src="images/ad.jpg" alt="" width="395" height="174" /></a> </div>

</div>-->





        </div>


    </div>


</div>

<?php include("includes/footer.php"); ?>