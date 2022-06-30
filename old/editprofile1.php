<?php 
include("includes/header.php");
if(isset($_POST['submit']))
{
$user_type=mysqli_real_escape_string($con, $_POST['user_type']);
$fname=mysqli_real_escape_string($con, $_POST['fname']);
$lname=mysqli_real_escape_string($con, $_POST['lname']);
$gender=mysqli_real_escape_string($con, $_POST['gender']);
$ph_no=mysqli_real_escape_string($con, $_POST['ph_no']);
$mble_no=mysqli_real_escape_string($con, $_POST['mble_no']);
$fax_no=mysqli_real_escape_string($con, $_POST['fax_no']);
//$mble_no=mysqli_real_escape_string($con, $_POST['mble_no']);
//$fax_no=mysqli_real_escape_string($con, $_POST['fax_no']);
$address=mysqli_real_escape_string($con, $_POST['address']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$country=mysqli_real_escape_string($con, $_POST['country']);
$zip_code=mysqli_real_escape_string($con, $_POST['zip_code']);
$cmpny_name=mysqli_real_escape_string($con, $_POST['cmpny_name']);
$newsletter=mysqli_real_escape_string($con, $_POST['newsletter']);
if($newsletter!="")
{
$newsletter1=0;

}
else
{
$newsletter1=1;
}

//echo "UPDATE registration SET usertype='$user_type', firstname='$fname',lastname='$lname',gender='$gender', phonenumber='$ph_no', mobile='$mble_no', faxnumber='$fax_no', street='$address', city='$city', state='$state', country='$country', zipcode='$zip_code',  companyname='$cmpny_name', newsletter_option='$newsletter1' WHERE id='$session_user'"; break;

$udate_user=mysqli_query($con,"UPDATE registration SET usertype='$user_type', firstname='$fname',lastname='$lname',gender='$gender', phonenumber='$ph_no', mobile='$mble_no', faxnumber='$fax_no', street='$address', city='$city', state='$state', country='$country', zipcode='$zip_code',  companyname='$cmpny_name', newsletter_option='$newsletter1' WHERE id='$session_user'");

header("location:myprofile.php?suc");
}

 ?>
<script type="text/javascript">
function validate1_form()
{
//alert("hai");
var fname=document.getElementById('fname').value;
if(fname=="")
{
alert("Enter The Firstname");
document.getElementById('fname').focus();
return false;
}
var lname=document.getElementById('lname').value;
if(lname=="")
{
alert("Enter The Lastname");
document.getElementById('lname').focus();
return false;
}
var ph_no=document.getElementById('ph_no').value;
if(ph_no=="")
{
alert("Enter The Phone Number");
document.getElementById('ph_no').focus();
return false;
}
else
{
if(isNaN(document.getElementById('ph_no').value))
{	
alert("Phone Number Can accept Number Only");
document.getElementById('ph_no').focus();
return false;
}
}

var address=document.getElementById('address').value;
if(address=="")
{
alert("Enter The Address");
document.getElementById('address').focus();
return false;
}

var city = document.getElementById('city').value;
if(city=="")
{
alert("Enter The City");
document.getElementById('city').focus();
return false;
}
var state = document.getElementById('state').value;
if(state=="")
{
alert("Enter The State");
document.getElementById('state').focus();
return false;
}
/*var country = document.getElementById('country').value;
if(country=="")
{
alert("Enter The Country");
document.getElementById('country').focus();
return false;
}*/
var zip_code = document.getElementById('zip_code').value;
if(zip_code=="")
{
alert("Enter The Zip code");
document.getElementById('zip_code').focus();
return false;
}

var cmpny_name = document.getElementById('cmpny_name').value;
if(cmpny_name=="")
{
alert("Enter The Company Name");
document.getElementById('cmpny_name').focus();
return false;
}


return true;
}

</script> 
 




<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->
<?php 
$user_type=$fetch_log['usertype']; 
if($user_type==1) { $usertype="Buyer"; } elseif($user_type==2) { $usertype="seller"; }  elseif($user_type==3) { $usertype="Both Buyer & Seller"; }  else { $usertype="Not Mentioned"; }
//$user_type=$fetch_log['gender']; 
//if($gender==1) { $gen="";
?>
<div class="tabs-cont"> <div class="left">
<div style="border:1px solid #F0EFF0;" class="bordersty">
<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >
<table cellpadding="0" cellspacing="0" width="100%" style="height:300px;" >
<tr>
<td width="80%" valign="top" style="padding-left:50px;" ><table align="center"  cellpadding="3" cellspacing="6" width="100%">
<tr>
<td><?php echo $user_typeee; ?> </td><td>:</td><td>

<input type="radio" name="user_type" id="user_type" value="1" <?php  if($user_type=="1") { ?> checked="checked" <?php } ?>/> <?php echo $buyer; ?> 
&nbsp; <input type="radio" name="user_type" value="2" <?php if($user_type=="2") { ?> checked="checked" <?php } ?>/> <?php echo $seller; ?> 
&nbsp; <input type="radio" id="user_type" name="user_type" value="3" <?php if($user_type=="3") { ?> checked="checked" <?php } ?>/> <?php echo $buyer_seller; ?></td>
</tr>
<tr>
<tr>
<td><?php echo$fname; ?> </td><td>:</td><td><input type="text" name="fname" id="fname" class="txtfield2" value="<?php echo $firstname; ?>" /></td>
</tr>
<tr>
<td><?php echo $lname; ?> </td><td>:</td><td><input type="text" name="lname" id="lname" class="txtfield2" value="<?php echo $fetch_log['lastname']; ?>" /></td>
</tr>
<!--<tr>
<td>Email </td><td>:</td><td><?php echo $fetch_log['email']; ?></td>
</tr>-->
<tr>
<td><?php echo $gender; ?> </td><td>:</td><td><input type="radio" name="gender" id="gender" value="Male" <?php if($fetch_log['gender']=="Male") {  ?> checked="checked" <?php } ?>/> Male 
&nbsp; <input type="radio" name="gender" value="Female" <?php if($fetch_log['gender']=="Female") {  ?> checked="checked" <?php } ?>/> Female </td>
</tr>
<tr>
<td><?php echo $phone_number; ?> </td><td>:</td><td><input type="text" name="ph_no" id="ph_no" class="txtfield2" value="<?php echo $fetch_log['phonenumber']; ?>" /></td>
</tr>

<tr>
<td><?php echo $mbile_number; ?> </td><td>:</td><td><input type="text" name="mble_no" id="mble_no" class="txtfield2" value="<?php echo $fetch_log['mobile']; ?>" /></td>
</tr>

<tr>
<td><?php echo $fax_number; ?> </td><td>:</td><td><input type="text" name="fax_no" id="fax_no" class="txtfield2" value="<?php echo $fetch_log['faxnumber']; ?>" /></td>
</tr>
<tr>
<td><?php echo $address; ?> </td><td>:</td><td><textarea name="address" id="address" class="txtarea1" ><?php echo $fetch_log['street']; ?></textarea></td>
</tr>
<tr>
<td><?php echo $city; ?> </td><td>:</td><td><input type="text" name="city" id="city" class="txtfield2" value="<?php echo $fetch_log['city']; ?>" /></td>
</tr>
<tr>
<td><?php echo $state; ?> </td><td>:</td><td><input type="text" name="state" id="state" class="txtfield2" value="<?php echo $fetch_log['state']; ?>" /></td>
</tr>
<tr>
<td><?php echo $country1; ?> </td><td>:</td><td><select name="country" id="country" class="listbox2">
        <option value="">---------- <?php echo$sel_con; ?> ----------</option>
		<?php 
		$select_country="SELECT * FROM country";
		$res_country=mysqli_query($con,$select_country);
		while($fet_country=mysqli_fetch_array($res_country))
		{
		if($fetch_log['country']==$fet_country['country_id'])
		{
		$selected="SELECTED";
		
		}
		else
		{
		$selected="";
		}
		?>
		<option value="<?php echo $fet_country['country_id']; ?>" <?php echo $selected; ?>><?php echo $fet_country['country_name']; ?></option>
		<?php } ?>
      </select>  </td>
</tr>
<tr>
<td><?php echo$zip_code; ?> </td><td>:</td><td><input type="text" name="zip_code" id="zip_code" class="txtfield2" value="<?php echo $fetch_log['zipcode']; ?>" /></td>
</tr>
<tr>
<td><?php echo $company_name; ?> </td><td>:</td><td><input type="text" name="cmpny_name" id="cmpny_name" class="txtfield2" value="<?php echo $fetch_log['companyname']; ?>" /></td>
</tr>
<tr>
<td>&nbsp; </td><td>&nbsp;</td><td align="left"><input type="checkbox" name="newsletter" id="newsletter" class="txtfield2" <?php if($fetch_log['newsletter_option']=='0') { ?> checked="checked" <?php } ?> value="yes" /><?php echo $newsletter; ?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="<?php echo $submit; ?>" ></td>
<td>&nbsp;</td>
</tr>

</table></td>
<!--<td width="50%" valign="top"><table cellpadding="3" cellspacing="3" width="100%" >
<tr>
<td>Firstname </td><td>:</td><td><?php //echo $firstname; ?></td>
</tr>
</table>
</td>-->
</tr>
</table>
</form>
<div>


</div>



</div>
				
				
				
				
			
				
			
			</div></div>
            
            
            
            

</div>


<div class="body-cont4"> 






</div>

</div>


</div>


</div>

<?php include("includes/footer.php"); ?>
