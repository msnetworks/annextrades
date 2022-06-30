<?php
include("includes/header.php"); 

/* include('config.php'); */
$per_page = 20; 

//getting number of rows and calculating no of pages
$sql = "SELECT * FROM product WHERE userid='$session_user' AND status='1'";
$rsd = mysqli_query($con,$sql);
$count = mysqli_num_rows($rsd);
$pages = ceil($count/$per_page);

$sql1 = "SELECT * FROM product WHERE userid='$session_user' AND status='3'";
$rsd1 = mysqli_query($con,$sql1);
$count1 = mysqli_num_rows($rsd1);
$pages1 = ceil($count1/$per_page);

$sql2 = "SELECT * FROM product WHERE userid='$session_user' AND status='2'";
$rsd2 = mysqli_query($con,$sql2);
$count2 = mysqli_num_rows($rsd2);
$pages2 = ceil($count2/$per_page);

$sql3 = "SELECT * FROM product WHERE userid='$session_user' AND status='0'";
$rsd3 = mysqli_query($con,$sql3);
$count3 = mysqli_num_rows($rsd3);
$pages3 = ceil($count3/$per_page);

 ?>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> -->
<script type="text/javascript" src="js/ajaxfunctioncategory.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        //Display Loading Image
        function Display_Load() {
            $("#loading").fadeIn(900, 0);
            $("#loading").html("<img src='images/bigLoader.gif' width='20' Height='20' />");
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

        $("#content").load("pagination_data.php?page=1", Hide_Load());



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

            $("#content").load("pagination_data.php?page=" + pageNum, Hide_Load());
        });


    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        //Display Loading Image
        function Display_Load2() {
            $('#loading2').fadeIn(900, 0);
            $('#loading2').html("<img src='images/bigLoader.gif' width='20' Height='20'/>");
        }
        //Hide Loading Image
        function Hide_Load2() {
            $('#loading2').fadeOut('slow');
        };

        //Default Starting Page Results

        $("#pagination2 span:first").css({
            'color': '#FF0084'
        }).css({
            'border': 'none'
        });

        Display_Load2();

        $("#content2").load("pagination_data2.php?page=1", Hide_Load2());



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

            $("#content2").load("pagination_data2.php?page=" + pageNum2, Hide_Load2());
        });


    });
</script>

<script type="text/javascript">
$(document).ready(function() {

    //Display Loading Image
    function Display_Load1() {
        $("#loading1").fadeIn(900, 0);
        $("#loading1").html("<img src='images/bigLoader.gif' width='20' Height='20'/>");
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

    $("#content1").load("pagination_data1.php?page=1", Hide_Load1());



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

        $("#content1").load("pagination_data1.php?page=" + pageNum1, Hide_Load1());
    });


});
</script>

<script type="text/javascript">
    $(document).ready(function() {

        //Display Loading Image
        function Display_Load3() {
            $("#loading3").fadeIn(900, 0);
            $("#loading3").html("<img src='images/bigLoader.gif' width='20' Height='20'/>");
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

        $("#content3").load("pagination_data3.php?page=1", Hide_Load3());



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

            $("#content3").load("pagination_data3.php?page=" + pageNum3, Hide_Load3());
        });


    });
</script>


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
<div style="padding-left:300px; color:#009900; font-weight:bold;"> <?php echo $update_success; ?> </div>
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
                                <div id="leftcon_three_1" style="display: block; font-size:12px;" >
                                    <div style="width:100%; height:1000px; OVERFLOW: scroll;">
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
                                                            <!--<td width="50"><strong style="color:#C55000;">&nbsp;</strong></td>-->
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $photos; ?></strong></td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $product_descrip; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                            </td>
                                                            <td width="100"><strong
                                                                    style="color:#C55000;"><?php echo $action; ?></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

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

                                        </table>
                                    </div>
                                </div>

                                <div id="leftcon_three_2" style="display: none;">
                                    <div style="width:100%; height:800px; OVERFLOW: scroll;">
                                        <div id="marqueebox2" style="width:100%; overflow: scroll; margin-top: 0px;">

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
                                                            <!--<td width="50"><strong style="color:#C55000;">&nbsp;</strong></td>-->
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $photos; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $product_descrip; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                            </td>
                                                            <td width="100"><strong
                                                                    style="color:#C55000;"><?php echo $action; ?></strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>


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
                                <div style="width:100%; height:1000px; OVERFLOW: scroll;">
                                    <div id="marqueebox2" style="width:100%; overflow: scroll; margin-top: 0px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" >
                                                        <tr>
                                                            <!--<td width="50"><strong style="color:#C55000;">&nbsp;</strong></td>-->
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $photos; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $product_descrip; ?></strong>
                                                            </td>
                                                            <td><strong
                                                                    style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                            </td>
                                                            <td width="100"><strong
                                                                    style="color:#C55000;"><?php echo $action; ?></strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div id="loading2" class="loading2" style=""></div>
                                                    <div id="content2"></div>
                                                </td>
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="leftcon_three_4" style="display: none;">
                                <div style="width:100%; height:1000px; OVERFLOW: scroll;">
                                    <div id="marqueebox2" style="width:100%; overflow: scroll; margin-top: 0px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" >
                                                        <tr>
                                                            <td><strong style="color:#C55000;"><?php echo $photos; ?></strong>
                                                            </td>
                                                            <td><strong style="color:#C55000;"><?php echo $pro_name; ?></strong>
                                                            </td>
                                                            <td><strong style="color:#C55000;"><?php echo $product_descrip; ?></strong>
                                                            </td>
                                                            <td><strong style="color:#C55000;"><?php echo $update_date; ?></strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
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