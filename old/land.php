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

/*$udate_user=mysqli_query($con,"UPDATE registration SET usertype='$user_type', firstname='$fname',lastname='$lname',gender='$gender', phonenumber='$ph_no', mobile='$mble_no', faxnumber='$fax_no', street='$address', city='$city', state='$state', country='$country', zipcode='$zip_code',  companyname='$cmpny_name' WHERE id='$session_user'");

header("location:myprofile.php?suc");*/
}

 ?>
<script type="text/javascript">
			function ValidateForm()
              {
				//alert("hai"); 
				 var bussiness_type=document.addcompanydetails.bussiness_type.value;
				 var P_service=document.addcompanydetails.P_service.value;
				 var company_address=document.addcompanydetails.company_address.value;
				 var companylogo=document.addcompanydetails.companylogo.value;
				 var url=document.addcompanydetails.url.value;
			
			
			if(bussiness_type=="")
				{
					alert("Please Enter Bussiness Type ");
					document.addcompanydetails.bussiness_type.focus();
					return false
				}
			if(P_service=="")
				{
					alert("Please Enter Your Service ");
					document.addcompanydetails.P_service.focus();
					return false
				}
			if(company_address=="")
				{
					alert("Please Enter Company Address");
					document.addcompanydetails.company_address.focus();
					return false
			}			
			if(companylogo=="")
				{
					alert("Please Upload Company Logo");
					document.addcompanydetails.companylogo.focus();
					return false
				}
			
				var fnam=document.addcompanydetails.companylogo.value;
				var splt=fnam.split('.');
				var chksplt=splt[1].toLowerCase();
				
				if(chksplt=='jpg'|| chksplt=='jpeg' || chksplt=='gif')
				{
				}
				else
				{
				alert(" Upload Image with extensions only jpg, jpeg ");
				return false;
				}	
            
			if(document.addcompanydetails.brand.value=="")
		{
		 alert("Please Enter The Brand Name");
		 document.addcompanydetails.brand.focus();
		 return false;
		 }
			
			if(document.addcompanydetails.noofemployee.value=="")
		{
		 alert("Please Enter The No. of Employees");
		 document.addcompanydetails.noofemployee.focus();
		 return false;
		 }
			  if(url=="")
				{
					alert("Please Enter Company URL");
					document.addcompanydetails.url.focus();
					return false
				}	
	var tomatch= /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/
     if (tomatch.test(url))
     {
         
     }
     else
     {
         window.alert("Invalid. Try again. http://www.google.com");
		 document.addcompanydetails.url.focus()
         return false; 
	}
	
	if(document.addcompanydetails.year.value!="")
	{
		if(isNaN(document.addcompanydetails.year.value))
		{
			alert("Please Enter the year in Numeric Form");
			document.addcompanydetails.year.focus()
			return false;
		}
		if((document.addcompanydetails.year.value <=0)||(document.addcompanydetails.year.value.length !=4) )
		{
			alert("Please Enter the year in YYYY Format");
			document.addcompanydetails.year.focus()
			return false;
		}
	}
             }
			
			</script> 




<div class="body-cont"> 

<div class="body-cont1"> 
<?php include("includes/side_menu.php"); ?>



<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<!--<div class="banner-cont"><img src="images/headerbanner.jpg" alt="" width="538" height="198" /> </div>
<div class="join-cont"><a href="#"><img src="images/join.jpg" alt="" width="240" height="200" /></a> </div>-->

<div class="tabs-cont"> <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
<div   class="bordersty">
<div class="headinggg"><?php echo $myaccount; ?> </div>
<!--<form action="" name="profile_form" method="post" onSubmit="return validate1_form();" >-->
<table cellpadding="0" cellspacing="0" width="80%" align="center" style="padding-top:50px;">

<tr>
<td width="150px;">
<a href="myprofile.php"><?php echo $account_settings; ?></a>

</td>
<td width="150px;">
<a href="membership.php"><?php echo $member_details; ?></a>

</td>
<?php 
$select_comp="SELECT * FROM companyprofile WHERE user_id='$session_user'";
$res_comp=mysqli_query($con,$select_comp);
$num_comp=mysqli_num_rows($res_comp);
if($num_comp==0)
{
?>
<td width="150px;">
<a href="add_company.php"><?php echo $add_company; ?></a>

</td>
<?php } else { ?>
<td width="150px;">
<a href="company.php"><?php echo $com_profile; ?></a>

</td>
<?php } ?>

<td width="150px;">
<a href="mycontacts.php"><?php echo $contacts; ?></a>

</td>
</tr>

<tr><td>&nbsp;</td></tr>

<tr>
<td width="150px;">
<a href="my_products.php"><?php echo $Product; ?></a>

</td>
<td width="150px;">
<a href="selling_leads.php"><?php echo $selling_leads; ?></a>

</td>
<td width="150px;">
<a href="buying_leads.php"><?php echo $buy_leads; ?></a>

</td>
<td width="150px;">
<a href="trade_list.php"><?php echo $tradess; ?></a>

</td>
</tr>

<tr><td>&nbsp;</td></tr>

<tr>
<td width="150px;">
<a href="inbox.php"><?php echo $mail_box; ?></a>

</td>

<td width="150px;">
<a href="sold_product.php"><?php echo "My Sold Products"; ?></a>
</td>

<td width="150px;">
<a href="purchase_product.php"><?php echo "My Purchased Products"; ?></a>
</td>


<td width="150px;">
<a href="payment_history.php"><?php echo "Payment History"; ?></a>

</td>



</tr>

<tr><td>&nbsp;</td></tr>

</table>
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
