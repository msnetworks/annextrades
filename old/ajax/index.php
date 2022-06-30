<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax Add/Delete a Record with jQuery Fade In/Fade Out</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	//##### Add record when Add Record Button is click #########
	$("#FormSubmit").click(function (e) {
			e.preventDefault();
			if($("#contentText").val()==='')
			{
				alert("Please enter some text!");
				return false;
			}
		 	var myData = 'content_txt='+ $("#contentText").val(); //build a post data structure
			jQuery.ajax({
			type: "POST", // Post / Get method
			url: "response.php", //Where form data is sent on submission
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				$("#responds").append(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
			});
	});

	//##### Delete record when delete Button is click #########
	$("#responds").on("click", ".del_button", function(e) {
	//alert("dfjhsjk");
		e.preventDefault();
		 var clickedID = this.id.split('-'); //Split string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
		 
			jQuery.ajax({
			type: "POST", // Post / Get method
			url: "response.php", //Where form data is sent on submission
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				//If we get success response hide content user wants to delete.
				$('#item_'+DbNumberID).fadeOut("slow");
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
	});

});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="content_wrapper">
<ul id="responds">
<?php
//include db configuration file
include_once("config.php");

//MySQL query
echo "select * from tbl_seller where status='3' and user_id='209' and trash='0'";
$select="select * from tbl_seller where status='3' and user_id='209' and trash='0'";
$res_select=mysqli_query($con,$select);
echo $count=mysqli_num_rows($res_select);
//$Result = mysqli_query($con,"select * from tbl_seller where status='3' and user_id='209' and trash='0'") or die("selecr error");

//get all records from add_delete_record table
while($row = mysqli_fetch_array($res_select))
{
  ?>
  
  <table cellpadding="0" cellspacing="0" width="100%">

<tr><td>&nbsp;</td></tr>
<tr>
<!--<td width="50" align="center" valign="top"><input type="checkbox" name="checkbox[]" value="<?php //echo $seller_id;?>" />
<input type="checkbox" name="checkbox[]" value="<?PHP echo $seller_id;?>" id="checkbox[<?PHP echo $i;?>]" /></td>-->
<td width="150"><img src="<?php echo $image5;  ?>" width="80" height="80" /></td>
<td width="150"><strong><?php echo ucfirst($row['seller_subject']);?></strong></td>
<td width="150"><strong><?php echo ucfirst($row['seller_updated_date']);?></strong></td>
<td width="150"><strong><?php echo $row['seller_expired_date'];?></strong></td>
<td width="100" ><a href="#" class="del_button" id="del-<?php echo $row["seller_id"]; ?>">
  <img src="images/icon_del.gif" border="0" />
  </a></td>
</tr>
</table>
  
  <?php
}

//close db connection
mysqli_close($connecDB);
?>
</ul>

    <!--<div class="form_style">
    <textarea name="content_txt" id="contentText" cols="45" rows="5"></textarea>
    <button id="FormSubmit">Add record</button>
    </div>-->
</div>



</body>
</html>
