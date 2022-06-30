<?php 
	include("includes/header.php");
	include("includes/pagination.php");
?>
<script language="JavaScript" src="js/sendajax.js"></script>
<script language="JavaScript" src="js/scripts.js"></script>
<script language="JavaScript" src="js/faq.js"></script>
<script type="text/javascript" src="js/subMenu.js"></script>
<script language="JavaScript">
function bookmark_us(url, title) {
    if (window.sidebar) {
        var side;
        side = window.sidebar.addPanel(title, url, "");
    } else if (window.opera && window.print) {
        var elem = document.createElement('a');
        alert(elem);
        elem.setAttribute('href', url);
        elem.setAttribute('title', title);
        elem.setAttribute('rel', 'sidebar');
        elem.click();
    } else if (document.all)

        window.external.AddFavorite(url, title);
}

function emailThisPage(url) {
    var newwindow = window.open(url, 'name', 'width=510,height=600,scrollbars=yes');
}

function showLevel2(selectedValue) {
    var nowLevel2Id = document.getElementById('nowLevel2Div').value;
    if (nowLevel2Id == '') {
        document.getElementById('div2_0').style.display = 'none';
        document.getElementById('div' + selectedValue).style.display = '';
        document.getElementById('nowLevel2Div').value = selectedValue;
        document.getElementById('nowLevel3Div').value = '';
    } else {
        document.getElementById('div' + selectedValue).style.display = '';
        document.getElementById('div' + nowLevel2Id).style.display = 'none';
        document.getElementById('div2_0').style.display = 'none';
        document.getElementById('nowLevel2Div').value = selectedValue;
        var nowLevel3Id = document.getElementById('nowLevel3Div').value;

        document.getElementById('nowLevel3Div').value = '';
        document.getElementById('div2_0_0').style.display = 'none';
        if (nowLevel3Id != '') {
            document.getElementById('div' + nowLevel3Id).style.display = 'none';
        }

        document.getElementById('btnnext').disabled = true;
    }
}

function showLevel3(selectedValue) {
    var nowId = document.getElementById('nowLevel3Div').value;
    if (nowId == '') {
        document.getElementById('div2_0_0').style.display = 'none';

        if (document.getElementById('select' + selectedValue).length == 0) {
            document.getElementById('div' + selectedValue).style.display = 'none';
        } else {
            document.getElementById('div' + selectedValue).style.display = '';
        }
        document.getElementById('nowLevel3Div').value = selectedValue;
    } else {

        if (document.getElementById('select' + selectedValue).length == 0) {
            document.getElementById('div' + selectedValue).style.display = 'none';
        } else {
            document.getElementById('div' + selectedValue).style.display = '';
        }
        document.getElementById('div' + nowId).style.display = 'none';
        document.getElementById('nowLevel3Div').value = selectedValue;

        document.getElementById('btnnext').disabled = true;
    }

    if (selectedValue == '2_1_1' || selectedValue == '2_2_1' || selectedValue == '2_1_4' || selectedValue == '2_4_5' ||
        selectedValue == '2_4_7' || selectedValue == '2_5_3' || selectedValue == '2_6_1') {
        document.getElementById('btnnext').disabled = false;
        document.getElementById('btnnext').focus();
        document.getElementById('gotoId').value = selectedValue + '_1';
    }
}

function getToGoId(selectedValue) {
    var selectedValueLength = selectedValue.length;

    if (selectedValueLength > 7) {
        selectedValue = selectedValue.substring(0, 7);

        var selectElementId = 'select' + selectedValue.substring(0, 5);

        var theSelect = document.getElementById(selectElementId);
        var theSelectlength = theSelect.options.length;
        for (var i = 0; i < theSelectlength; i++) {
            var optionValue = theSelect.options[i].value;
            if (optionValue.substring(0, 7) == selectedValue) {
                theSelect.options[i].selected = true;
            }
        }
    }
    document.getElementById('btnnext').disabled = false;
    document.getElementById('btnnext').focus();
    document.getElementById('gotoId').value = selectedValue;

}

function goToURL() {
    var goToURLId = document.getElementById('gotoId').value;
    window.location.href = "/trade/help/faq/" + goToURLId;
}


var xmlHttp;
try {
    xmlHttp = new XMLHttpRequest();

} catch (e) {
    try {
        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlHttp = new AcitveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            alert(e.description);
        }
    }
}
// Ajax code -  End here 
</script>
<div class="body-cont">

    <div class="body-cont1">
        <div class="body-leftcont">
            <?php include("includes/help_side_menu.php"); ?>
        </div>

        <div class="body-right">

            <?php include("includes/menu.php"); ?>

            <div class="tabs-cont" style="margin-top:0">
                <div class="left">
                    <div class="p-2" style="padding-top:0">
                        <div class="products-cate-heading"><h5><?php echo $faq_contact; ?></h5>
                        </div>
                        <table border="0" width="100%" style="margin-top:20px; font-size: 15px" cellpadding="2" cellspacing="2">
                            <form id="form1" name="form1" method="post" action="">
                                <tr>
                                    <td><span style="margin-left:10px;"><?php echo $welcome_help_center; ?>!</span></td>
                                </tr>
                                <tr>
                                    <td><span style="margin-left:10px;"><?php echo $frequentily_asked_ques; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="margin-left:10px;"><?php echo $answer_to_ur_ques; ?><a
                                                href="contact.php"> <?php echo $con_customer_ser; ?></a></span></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:10px;"><b><?php echo $faq_ques_type; ?></b></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:30px;">1.&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $select_sub; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left:30px;">2.&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sel_ques; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left:30px;">3.&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sel_ans; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="18" colspan="2" align="center" valign="top" class="">
                                        <table width="98%" border="0" cellspacing="2" cellpadding="2"
                                            style="margin-top:20px;">
                                            <tr>
                                                <td align="center"><label>
                                                        <select name="select3" size="5" multiple="multiple"
                                                            onchange="getsubquestion(this.value);" style="width:770px"
                                                            class="inTxtNormal">
                                                            <?php 
									if($_SESSION['language']=='english')
{
$sqlfaqquestion=mysqli_query($con,"select * from faq_question");

}
else if($_SESSION['language']=='french')
{
$sqlfaqquestion=mysqli_query($con,"select * from faq_question_french");
}
else if($_SESSION['language']=='chinese')
{
$sqlfaqquestion=mysqli_query($con,"select * from  faq_question_chinese");
}
else
{
$sqlfaqquestion=mysqli_query($con,"select * from  faq_question_spanish");
}

										
										while($row=mysqli_fetch_assoc($sqlfaqquestion))
										{ 
									?>
                                                            <option style=" height:20px;"
                                                                value="<?php echo $row['id']; ?>"
                                                                style="font-size:11px;"><?php echo $row['question']; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </label></td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <div id="subquestions"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <div id="answers"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <div class="body-cont4">

        </div>

    </div>


</div>


</div>

<?php include("includes/footer.php"); ?>