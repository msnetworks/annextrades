<?php 
	include("includes/header.php");
	//include("includes/pagination.php");
	
	if(isset($_REQUEST['delete']))
	{
		$selected_friends = $_POST['checkbox'];
		foreach($selected_friends as $sel)
		{
			mysqli_query($con,"UPDATE `getquote` SET `status`='0'  WHERE `id`=$sel");  
						 
		}   
		header("location:inbox.php?deleted"); 
	}
?>
<style>
    * {
  box-sizing: border-box;
}

body {
  background-color: #edeff2;
  font-family: "Calibri", "Roboto", sans-serif;
}

.chat_window {
  position: absolute;
  width: calc(100% - 20px);
  max-width: 800px;
  height: 500px;
  /* border-radius: 10px; */
  background-color: #fff;
  /* left: 50%; */
  /* top: 50%; */
  /* transform: translateX(-50%) translateY(-50%); */
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  background-color: #f8f8f8;
  overflow: hidden;
}

.top_menu {
  background-color: #fff;
  width: 100%;
  padding: 20px 0 15px;
  box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
}
.top_menu .buttons {
  margin: 3px 0 0 20px;
  position: absolute;
}
.top_menu .buttons .button {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 10px;
  position: relative;
}
.top_menu .buttons .button.close {
  background-color: #f5886e;
}
.top_menu .buttons .button.minimize {
  background-color: #fdbf68;
}
.top_menu .buttons .button.maximize {
  background-color: #a3d063;
}
.top_menu .title {
  text-align: center;
  color: #bcbdc0;
  font-size: 20px;
}

.messages {
  position: relative;
  list-style: none;
  padding: 20px 10px 0 10px;
  margin: 0;
  height: 347px;
  overflow: scroll;
}
.messages .message {
  clear: both;
  overflow: hidden;
  margin-bottom: 20px;
  transition: all 0.5s linear;
  opacity: 0;
}
.messages .message.left .avatar {
  background-color: #f5886e;
  float: left;
}
.messages .message.left .text_wrapper {
  background-color: #ffe6cb;
  margin-left: 20px;
}
.messages .message.left .text_wrapper::after, .messages .message.left .text_wrapper::before {
  right: 100%;
  border-right-color: #ffe6cb;
}
.messages .message.left .text {
  color: #c48843;
}
.messages .message.right .avatar {
  background-color: #fdbf68;
  float: right;
}
.messages .message.right .text_wrapper {
  background-color: #c7eafc;
  margin-right: 20px;
  float: right;
}
.messages .message.right .text_wrapper::after, .messages .message.right .text_wrapper::before {
  left: 100%;
  border-left-color: #c7eafc;
}
.messages .message.right .text {
  color: #45829b;
}
.messages .message.appeared {
  opacity: 1;
}
.messages .message .avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: inline-block;
}
.messages .message .text_wrapper {
  display: inline-block;
  padding: 20px;
  border-radius: 6px;
  width: calc(100% - 85px);
  min-width: 100px;
  position: relative;
}
.messages .message .text_wrapper::after, .messages .message .text_wrapper:before {
  top: 18px;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.messages .message .text_wrapper::after {
  border-width: 13px;
  margin-top: 0px;
}
.messages .message .text_wrapper::before {
  border-width: 15px;
  margin-top: -2px;
}
.messages .message .text_wrapper .text {
  font-size: 18px;
  font-weight: 300;
}

.bottom_wrapper {
  position: relative;
  width: 100%;
  background-color: #fff;
  padding: 20px 20px;
  position: absolute;
  bottom: 0;
}
.bottom_wrapper .message_input_wrapper {
  display: inline-block;
  /* height: 50px; */
  border-radius: 25px;
  /* border: 1px solid #bcbdc0; */
  width: calc(100% - 160px);
  position: relative;
  padding: 0 20px;
}
.bottom_wrapper .message_input_wrapper .message_input {
  border: none;
  height: 100%;
  box-sizing: border-box;
  width: calc(100% - 40px);
  position: absolute;
  outline-width: 0;
  color: gray;
}
.bottom_wrapper .send_message {
  width: 140px;
  /* height: 50px; */
  display: inline-block;
  border-radius: 50px;
  background-color: #a3d063;
  border: 2px solid #a3d063;
  color: #fff;
  cursor: pointer;
  transition: all 0.2s linear;
  text-align: center;
  float: right;
}
.bottom_wrapper .send_message:hover {
  color: #a3d063;
  background-color: #fff;
}
.bottom_wrapper .send_message .text {
  font-size: 18px;
  font-weight: 300;
  display: inline-block;
  line-height: 48px;
}

.message_template {
  display: none;
}
.message {
  overflow-y: scroll;
  overscroll-behavior-y: contain;
  scroll-snap-type: y proximity;
}

</style>
<script type="text/javascript">
function show(value) {
    if (value == "compose") {
        //alert("hai");
        document.getElementById("compose").style.display = 'block';
        document.getElementById("inbox").style.display = 'none';
        document.getElementById("sent").style.display = 'none';
        document.getElementById("trash").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';
    } else if (value == "inbox") {
        document.getElementById("inbox").style.display = "block";
        document.getElementById("sent").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("Trash").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';
        document.getElementById('inboxopendiv').value = value;
    } else if (value == "sent") {
        document.getElementById("sent").style.display = "block";
        document.getElementById("inbox").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("trash").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';
        document.getElementById('sentopendiv').value = value;
    } else if (value == "trash") {
        document.getElementById("trash").style.display = "block";
        document.getElementById("inbox").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("sent").style.display = 'none';
        document.getElementById("bulk").style.display = 'none';
        document.getElementById('trashopendiv').value = value;
    } else if (value == "bulk") {
        document.getElementById("bulk").style.display = "block";
        document.getElementById("trash").style.display = "none";
        document.getElementById("inbox").style.display = "none";
        document.getElementById("compose").style.display = 'none';
        document.getElementById("sent").style.display = 'none';
        document.getElementById('bulkopendiv').value;
    }
}

function openDiv(id) {
    document.getElementById(id).style.display = 'block';
}

function SetAllCheckBoxes(FormName, FieldName, CheckValue) {
    //alert("test");
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

function checkbox1() {
    //alert("test");
    var lengthcount = document.inbox.maxvalue2.value;
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
    }
    if (confirm('Are you sure you want to Delete this Record?')) {
        return true;
    } else {
        return false;
    }
}

function compare() {
    var result = checkbox1();
    if (result == false) {
        return false;
    } else {
        document.forms["inbox"].submit();
    }
}
</script>

<script type="text/javascript">
function checkbox() {
    //alert("test");     
    var lengthcount = document.sent.maxvalue.value;
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var checklist = "checklist[" + i + "]";
        var dom = document.getElementById(checklist);
        if (dom.checked == true) {
            checkedcount++;
        }
    }
    if (checkedcount < 1) {
        alert("Select Atleast One Checkbox");
        return false;
    }
    if (confirm('Are you sure you want to Delete this Record?')) {

        return true;
    } else {
        return false;
    }
}

function compare1() {

    var result = checkbox();
    if (result == false) {
        return false;
    } else {

        document.sent.submit();
    }
}
</script>

<script type="text/javascript">
function checkbox2() {
    //alert("test");     
    var lengthcount = document.trash.maxvalue3.value;
    var checkedcount = 0;
    for (var i = 0; i < lengthcount; i++) {
        var checklist = "checklist_tr[" + i + "]";
        var dom = document.getElementById(checklist);
        if (dom.checked == true) {
            checkedcount++;
        }
    }
    if (checkedcount < 1) {
        alert("Select Atleast One Checkbox");
        return false;
    }
    if (confirm('Are you sure you want to Delete this Record?')) {

        return true;
    } else {
        return false;
    }
}

function compare2() {
    var result = checkbox2();
    if (result == false) {
        return false;
    } else {
        document.trash.submit();
    }
}
</script>

<div class="body-cont">
    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>
            <div class="body-right">
                <?php include("includes/menu.php"); ?>
                <div class="tabs-cont">
                    <div class="left">
                        <div style="border:1px solid #F0EFF0;" class="bordersty">
                           <!--  <form name="inbox" method="post" action="" onsubmit="return compare();"> -->
                                <input type="hidden" name="opendiv" id="inboxopendiv" value="" />
                                <div>
                                    <div class="chat_window">
                                        <div class="headinggg">Deal Conversation</div>
                                        <?php
                                             $pr="SELECT * FROM `product` WHERE id = '".$_GET['id']."' ";
                                             $ph = mysqli_query($con,$pr);
                                             $ph_v = mysqli_fetch_array($ph); 
                                             $pr1="SELECT * FROM `registration` WHERE id = '".$ph_v['userid']."' ";
                                             $ph1 = mysqli_query($con,$pr1);
                                             $ph_v1 = mysqli_fetch_array($ph1);
                                        ?>
                                        <div class="top_menu">
                                            <div class="buttons">
                                                <div class="button close"></div>
                                                <div class="button minimize"></div>
                                                <div class="button maximize"></div>
                                            </div>
                                            <div class="title"><?php echo $ph_v['p_name']; ?></div>
                                        </div>
                                        <ul class="messages" id="message" style="padding: 20px;">
                                            <?php 
                                                $sel_qry=mysqli_query($con,"select * from registration where id = '$session_user' ");
                                                $count=mysqli_num_rows($sel_qry);
                                                $array=mysqli_fetch_array($sel_qry);
                                                $mail=$array['email'];
                                                $vendor_id = $array['vendor_id'];
                                                $select="select * from getquote WHERE product_id = '".$_GET['id']."' and sender_vendor_id = '".$_GET['s_id']."' or rec_vendor_id = '".$_GET['s_id']."'  and rec_vendor_id = '$vendor_id' or sender_vendor_id = '$vendor_id' order by id ASC";
                                                $h = mysqli_query($con,$select); 
                                                $sel="SELECT * FROM getquote WHERE product_id = '".$_GET['id']."' and sender_vendor_id = '".$_GET['s_id']."' or rec_vendor_id = '".$_GET['s_id']."'  and rec_vendor_id = '$vendor_id' or sender_vendor_id = '$vendor_id' order by id ASC LIMIT 1";
                                                $k = mysqli_query($con,$sel); 
                                                $i = mysqli_fetch_array($k);
                                               
                                            ?>
                                            <?php WHILE($g = mysqli_fetch_array($h)){ 
                                                if ($g['reply_by'] != $vendor_id) {
                                            ?>
                                                <li class="message left appeared">
                                                    <div class="avatar" style="background-color: #fff!important;"><img src="https://annextrades.com/assets/images/annexis-emblem.png" style="width:60px;" alt=""></div>
                                                    <div class="text_wrapper">
                                                        <div class="text" style="color: #574b4b;"><?php echo $g['quote'];?></div>
                                                        <div style="font-size: 12px; padding-top: 10px;" class="pull-right text"><b>Date Time: <?php echo $g['date'];?></b></div>
                                                    </div>
                                                </li>
                                            <?php }else{ ?>
                                                <input type="text" name="product_id" value="<?php echo $_GET['id']; ?>" hidden />

                                                <li class="message right appeared">
                                                    <div class="avatar">
                                                        <div style="width: 60px; padding: 22.5px; color: #fff; font-weight: bold;"><?php echo $fn[0]; ?> </div>
                                                    </div>
                                                    <div class="text_wrapper">
                                                        <div class="text" style="color: #574b4b;"><?php echo $g['quote'];?></div>
                                                        <div style="font-size: 12px; padding-top: 10px;" class="pull-left text"><b>Date Time: <?php echo $g['date'];?></b></div>
                                                    </div>
                                                </li>
                                            <?php } } ?>
                                            <div id="reply"></div>
                                        </ul>
                                        <script>
                                            function loadlink(){
                                                $('#links').load('test.php',function () {
                                                    $(this).unwrap();
                                                });
                                            }

                                            loadlink(); // This will run on page load
                                            setInterval(function(){
                                                loadlink() // this will run after every 5 seconds
                                            }, 5000);
                                        </script>
                                        <div class="bottom_wrapper clearfix">
                                            <div class="message_input_wrapper">
                                            
                                                <form id="chat">
                                                    <input type="text" name="product_id" value="<?php echo $_GET['id']; ?>" hidden />
                                                    <input type="text" name="rec_vendor_id" value="<?php echo $ph_v1['vendor_id']; ?>" hidden />
                                                    <input type="text" name="sender_vendor_id" id="r_id1" value="<?php echo $i['sender_vendor_id']; ?>" hidden />
                                                    <input type="text" name="reply_vendor_id" id="r_id2" value="<?php echo $vendor_id; ?>" hidden />
                                                    <input class="message_input" name="message" style="/* height: 40px !important; */" placeholder="Type your message here..." ></div>
                                                    <button type="submit" id="submit" class="send_message" name="submit_quote"><i style="padding: 10px;" class='fa fa-paper-plane'></i>&nbsp;SEND</button>
                                                    <input type="reset" id="reset" value="Reset Form" hidden/>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message_template">
                                        <li class="message">
                                            <div class="avatar"></div>
                                            <div class="text_wrapper">
                                                <div class="text"></div>
                                            </div>
                                        </li>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<script>
    (function () {
    var Message;
    Message = function (arg) {
        this.text = arg.text, this.message_side = arg.message_side;
        this.draw = function (_this) {
            return function () {
                var $message;
                $message = $($('.message_template').clone().html());
                $message.addClass(_this.message_side).find('.text').html(_this.text);
                $('.messages').append($message);
                return setTimeout(function () {
                    return $message.addClass('appeared');
                }, 0);
            };
        }(this);
        return this;
    };
    
}.call(this));
</script>
<script>
    $("#chat").on('submit', function(e){
        e.preventDefault();
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            method: 'POST',
            url: 'controller/chat_reply.php',
            data: data,
            dataType: 'json',
            success: function ( response ){ 
                
                if(response != ''){
                    var rep = $('#r_id2').val();
                    /* console.log(rep); */
                    if ($('#r_id2').val() == response.reply_by) {   
                        $('#reply').html(`<li class="message right appeared">
                            <div class="avatar">
                                <div style="width: 60px; padding: 22.5px; color: #fff; font-weight: bold;"><?php echo $fn[0]; ?> </div>
                            </div>
                            <div class="text_wrapper">
                                <div class="text" style="color: #574b4b;">`+response.quote+`</div>
                                <div style="font-size: 12px; padding-top: 10px;" class="pull-left text"><b>Date Time: `+response.date+`</b></div>
                            </div>
                        </li>`);
                        $('#reset').click();
                    }
                    else{
                        $('#reply').html(`<li class="message left appeared">
                                <div class="avatar" style="background-color: #fff!important;"><img src="https://annextrades.com/assets/images/annexis-emblem.png" style="width:60px;" alt=""></div>
                                <div class="text_wrapper">
                                    <div class="text" style="color: #574b4b;">`+response.quote+`</div>
                                    <div style="font-size: 12px; padding-top: 10px;" class="pull-right text"><b>Date Time: `+response.date+`</b></div>
                                </div>
                            </li>
                        `);
                        $('#reset').click();
                    }
                }
            }
        });
    });
</script>
<?php include("includes/footer.php"); ?>
<div>
    
</div>