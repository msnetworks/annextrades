<?php 
	include("includes/header.php");
	include("includes/pagination.php");
	
	if(isset($_REQUEST['delete']))
	{
	 	$deleteid=$_REQUEST['delid'];
 	 	$updatetsql_d ="UPDATE `messages` SET `tostatus`='1'  WHERE `id`='$deleteid'";
 	 	$query_up_d=mysqli_query($con,$updatetsql_d);
 		header("location:inbox.php"); 
	}
?>

<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({

    // General options

    mode: "textareas",

    theme: "advanced",

    plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,inlinepopups,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,visualchars,nonbreaking,xhtmlxtras,template",

    // Theme options

    theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,code,fullscreen",

    theme_advanced_buttons2: "formatselect,fontselect,fontsizeselect",

    theme_advanced_buttons3: "",


    theme_advanced_toolbar_location: "top",

    theme_advanced_toolbar_align: "left",

    theme_advanced_statusbar_location: "bottom",

    theme_advanced_resizing: true,



    // Example content CSS (should be your site CSS)

    content_css: "css/content.css",



    // Drop lists for link/image/media/template dialogs

    template_external_list_url: "lists/template_list.js",

    external_link_list_url: "lists/link_list.js",

    external_image_list_url: "lists/image_list.js",

    media_external_list_url: "lists/media_list.js",



    // Replace values for the template plugin

    template_replace_values: {

        username: "Some User",

        staffid: "991234"

    }

});
</script>
<script>
function doPreview() {
    var newWin = window.open("", "Preview", "width=500,height=300");
    newWin.document.write("<html><body>" + document.getElementById('from').value, document.getElementById('to').value,
        document.getElementById('subject').value, document.getElementById('message').value + "</body></html>");
    newWin.document.close();
}
</script>

<script type="text/javascript">
function popUp1(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, '" + id +
        "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=350,left = 150,top = 234');"
    );
}
</script>

<script type="text/javascript">
function ValidateForm() {
    //var to=document.compose.to.value;
    tinyMCE.triggerSave();
    if (document.compose.to.value == "") {
        alert("Please Enter to Address");
        document.compose.to.focus();
        return false;
    }



    /*	 if (echeck(document.compose.to.value)==false)
    	{       
    			document.compose.to.focus(); 
      			returnstatus=false;
    			return false;
    	}*/

    if (document.compose.to.value != "") {

        var status = true;
        var i = 0;
        var emails = document.compose.to.value.split(",");
        for (i = 0; i < emails.length; i++) {
            if (!validation(trim(emails[i]))) {
                alert("Incorrect format: " + emails[i]);
                //status = false;
                document.compose.to.focus();
                return false;
            }
        }

    }


    if (document.compose.subject.value == "") {
        alert("Please Enter The Subject");
        document.compose.subject.focus();
        return false;

    }

    if (document.compose.message.value == "") {
        alert("Please Enter The Message");
        document.compose.message.focus();
        return false;

    }
}

function validation(email) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    return reg.test(email);
}

function trim(str) {
    var str = str.replace(/^\s\s*/, ''),
        ws = /\s/,
        i = str.length;
    while (ws.test(str.charAt(--i)));
    return str.slice(0, i + 1);
}

function echeck(str) {

    var at = "@"
    var dot = "."
    var lat = str.indexOf(at)
    var lstr = str.length
    var ldot = str.indexOf(dot)
    if (str.indexOf(at) == -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(at, (lat + 1)) != -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(dot, (lat + 2)) == -1) {
        alert("Invalid E-mail ID")
        return false
    }
    if (str.indexOf(" ") != -1) {
        alert("Invalid E-mail ID")
        return false
    }
    return true
}
</script>

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
                        <div style="border:1px solid #F0EFF0;" class="bordersty">
                            <div class="headinggg"><?php echo $compose; ?>
                            </div>
                            <?php 
                                    //echo "select * from  registration where id='$session_user'"; exit;
                                    $sql=mysqli_query($con,"select * from  registration where id='$session_user'"); 
                                    $row=mysqli_fetch_array($sql);
                                        ?>
                            <form id="form1" name="compose" method="post" action="save.php"
                                onsubmit="return ValidateForm();">
                                <div id="compose">
                                    <div class="p-2">
                                        <?php 
                                            if(isset($_REQUEST['success'])) {
                                        ?>
                                        <div class="input-group">
                                            <div style="color:#C55000">
                                                <b><?php echo $send_success; ?>&nbsp;!</b></div>
                                        </div>
                                        <?php } ?>
                                        <div class="input-group">
                                            <!-- <h6>< ?php echo $from; ?></h6> -->
                                            <input type="text" name="from" id="from"
                                                value="<?php echo $row['email']; ?>" style="width:250px; height:15px;"
                                                hidden>
                                        </div>
                                        <?php /*?><?php echo $row['email']; exit; ?><?php */?>
                                        <div class="input-group">
                                            <!-- <h6>< ?php echo $to; ?></h6> -->
                                            <?php
                                                //echo $_SESSION['checklistid']; break;
                                                if(isset($_SESSION['checklistid']))
                                                {
                                                    $seltest=$_SESSION['checklistid']; 
                                                    $z=explode(",",$seltest); 
                                                    $z[0];
                                                    if($z[0]!='')
                                                    {
                                                        for($j=0;$j<count($z);$j++)
                                                    {						 
                                                        $k=count($z)-1;
                                                        $select="select * from add_contacts where contact_id='$z[$j]'";
                                                        $res=mysqli_query($con,$select);							
                                                        $res_fetch=mysqli_fetch_array($res);
                                                        $resultarray=$res_fetch['contact_mail'];
                                                        if($j!=$k)
                                                        {
                                                            $xy.="$resultarray".",";
                                                        }
                                                        else
                                                        {
                                                            $xy1.="$resultarray";
                                                        }
                                                        $xyz=$xy.$xy1;
                                                    }		
                                                }
                                            ?>
                                            <!-- <div class="d-flex"-->
                                                <input type="text" name="to" id="to" value="<?php echo $xyz; ?>"
                                                    hidden/>&nbsp;&nbsp;
                                                <!-- <a href="javascript:popUp1('contact_list.php')"
                                                    class="news">< ?php echo $add_contact_list; ?></a> -->
                                            <!--/div> -->
                                            <?php
                                                unset($xyz);
                                                unset($_SESSION['checklistid']);
                                                }
                                                else
                                                { 
                                                    if(isset($_REQUEST['comp']))
                                                    {
                                                        $inid=$_REQUEST['comp'];
                                                        $res=mysqli_fetch_array(mysqli_query($con,"select * from messages where id='$inid'"));
                                                        $fmail=$res['from_mail'];
                                            ?>
                                            <!-- <div class="d-flex"--><input type="text" name="to" id="to" value="<?php echo $fmail;?>"
                                                    style="width:250px; height:15px;" hidden/>&nbsp;&nbsp;
                                                <!-- <a href="javascript:popUp1('contact_list.php')"
                                                    class="news">< ?php echo $add_contact_list; ?></a> -->
                                            <!--/div> -->
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <div class="d-flex">
                                                <input type="text" name="to" id="to" style="width:250px; height:15px;" hidden/>&nbsp;&nbsp;
                                                <!-- <a href="javascript:popUp1('contact_list.php')"
                                                    class="news">< ?php echo $add_contact_list; ?></a> -->
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            </div>
                                            <div class="input-group">
                                                <h6><?php echo $subject; ?></h6>
                                                <input type="text" name="subject" id="subject" value="<?php echo $res['subject']; ?>" style="width:250px; height:15px;">
                                            </div>
                                            <div class="input-group">
                                                <h6><?php echo $message; ?><h6>
                                                        <textarea name="message" id="message" rows="3" cols="40"></textarea>
                                            </div>
                                            <div class="input-group">
                                                <input type="submit" class="search_bg" name="Submit_compose"
                                                    value="<?php echo $submit; ?>" />
                                            </div>
                                    </div>
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