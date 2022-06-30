<?php include("includes/header.php");
if(isset($_REQUEST['Submit']))
{
include("easythumbnail.class.php");
$newfilename=basename($_FILES['uploadedfile']['name']);

$target_path = "uploads/";

$target_path = $target_path . $newfilename;
move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
$ftimages = "blog_photo_thumbnail/".$newfilename;
$thumb= new EasyThumbnail($target_path, $ftimages, 500);


$testname=$_REQUEST['name'];
$testemail=$_REQUEST['email'];
$testphoto=$newfilename;

$testphone=$_REQUEST['mobile'];
$testcity=$_REQUEST['city'];
$testcountry=$_REQUEST['country'];
$testcompany=$_REQUEST['company'];
$testnote=$_REQUEST['story'];
$testrelease=$_REQUEST['testyes'];
$today = date("F j, Y");    
if($_SESSION['language']=='english')
{
$lang_status='0';

}
else if($_SESSION['language']=='french')
{
$lang_status='1';

}
else if($_SESSION['language']=='chinese')
{
$lang_status='2';
}
else
{
$lang_status='3';
}

 include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_REQUEST['reg_answer']);
/*$valid="true";*/
  if($valid == true) {
$sql_insert="INSERT INTO `testimonials` (`testname`,`testemail`,photo,`testphone`,`testcity`,`testcountry`,`testcompany`,`testnote`,`testrelease`,`enterdate`,`lang_status`) VALUES ('$testname','$testemail','$testphoto','$testphone','$testcity','$testcountry','$testcompany','$testnote','$testrelease','$today','$lang_status')";
//echo $sql_insert;
//exit;
$insert_user=mysqli_query($con,$sql_insert);

if($insert_user)
{
 //$msg="<font color='red'>Your Testimonial Form Successfully Registered</font>";
 header("location:story_succ.php?");

		unset($_SESSION['tmp_name']);
		unset($_SESSION['tmp_email']);
		unset($_SESSION['tmp_mobile']);
		unset($_SESSION['tmp_city']);
		unset($_SESSION['tmp_country']);
		unset($_SESSION['tmp_company']);
		unset($_SESSION['tmp_story']);
		unset($_SESSION['tmp_testyes']);
		
			}
			else
{
echo "error";
}
			 }
			else
			{
 $_SESSION['tmp_name']=$testname;
 $_SESSION['tmp_email']=$testemail;
 $_SESSION['tmp_mobile']=$testphone;
 $_SESSION['tmp_city']=$testcity;
 $_SESSION['tmp_country']=$testcountry;
 $_SESSION['tmp_company']=$testcompany;
 $_SESSION['tmp_story']=$testnote;
 $_SESSION['tmp_testyes']=$testrelease;
header("location:successstory.php?cap_err");
}
}
?>

<script type="text/javascript">
  function searchlist(id) {
    var currentDiv;
    currentDiv = document.getElementById(id);
    if (currentDiv != null) {
	currentDiv.style.display = 'none';
    }
	else{  
    currentDiv.style.display = 'block';
    }
}

function checkbox() {
//alert("hai");
	var lengthcount=document.searching.maxvalue.value;
//alert(lengthcount);
	var checkedcount=0;
	for(var i=0; i<lengthcount; i++) {
	 var property = "property["+i+"]";
	 
	  var dom = document.getElementById(property);//alert(dom);
		if(dom.checked==true) {
			checkedcount++;
		}
	}
	
	if(checkedcount < 1) {
			alert("Select Atleast One product");
			return false;
		}
   else if(checkedcount>3)
   {
   	alert("Select Maximum Three Products Only ");
	return false;	
   }
}
function compare(){
 //alert("hai");
	var result=checkbox();
	if(result == false) {
		return false;
	}
	else {
	
	 document.searching.submit();
	}
}
function comp()
{
document.searching.Submit.readOnly=false;
}

function checking()
{
alert("You can't add contact to your Own Product");
}
</script>
<script type="text/javascript">

function emailThisPage(url)
{
  var newwindow=window.open(url,'name','width=510,height=600,scrollbars=yes');
}
function validates()
{
	
	var name =document.testimonials.name.value;
 
	var email = document.testimonials.email.value;
	
	var mobile =document.testimonials.mobile.value;
	var city =document.testimonials.city.value;
	
	var country =document.testimonials.country.value;
	
	var company =document.testimonials.company.value;
	
	var story =document.testimonials.story.value;
	
	var testyes =document.testimonials.testyes.value;
    var security =document.testimonials.reg_answer.value;

	if(name== "")
	{
		alert("Please Enter the User Name");
		document.testimonials.name.focus();
		return false;
	}
	
	var nameval=name.charAt(0);
	if(nameval==" ")
	{
		alert("The Username doesn't Start with Space ");
		document.testimonials.name.focus()
		return false;
	}
	/*var noalpha=/^[a-zA-Z ]*$/;
	if (!noalpha.test(name)) 
	{
		alert("The Username should not Contain Special Characters");
		document.testimonials.name.focus()
		return false;
	} */
	
	if(email== "")
	{
		alert("Please Enter the E-mail ");
		document.testimonials.email.focus()
		return false;
	}
	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))
	{
		alert("Please Enter the Correct Email Format");
		document.testimonials.email.focus()
	 		return false;
	}
	
	if(mobile== "")
	{
		alert("Please Enter the Mobile / Phone number ");
		document.testimonials.mobile.focus()
		return false;
	}
	if(isNaN(mobile))
	{
	alert("The Mobile / Phone Must be a number");
	document.testimonials.mobile.focus()
	return false;
	}
	
	if(country== "")
	{
		alert("Please Select the Country");
		document.testimonials.country.focus();
		return false;
	}
	
	if(city== "")
	{
		alert("Please Enter the City ");
		document.testimonials.city.focus();
		return false;
	}
	/*if (!noalpha.test(city)) {
	alert("Please Enter the City Name Without Special Characters ");
		document.testimonials.city.focus();
		return false;
	}*/
	
	if(document.testimonials.uploadedfile.value!="")
 	{  
 	/*alert("Please Upload your Photo");
	return false;
 	}*/
 var fnam=document.testimonials.uploadedfile.value;
 /*alert (fnam);
 exit;*/
 var splt=fnam.split('.');
var chksplt=splt[1].toLowerCase();


if(chksplt=='jpg'|| chksplt=='jpeg')
{
}
else{
alert(" Upload only jpg,jpeg ");
return false;
}
}
	
	
	/*if(company== "")
	{
	alert("Please Enter the Company Name");
	document.testimonials.company.focus();
	return false;
	}  */
	if(story== "")
	{
	alert("Please Enter the Testimonial");
	document.testimonials.story.focus();
	return false;
	}	
	
	if(security== "")
	{
	alert("Please Enter the security code");
	document.testimonials.reg_answer.focus();
	return false;
	}
	
}
function len()
{
document.testimonials.name.value="";
document.testimonials.email.value="";
document.testimonials.mobile.value="";
document.testimonials.city.value="";
document.testimonials.country.value="";
document.testimonials.company.value="";
document.testimonials.story.value="";
document.testimonials.name.focus();
return false;
}
function textCounter(field, countfield, maxlimit) {

if (field.value.length > maxlimit) // if the current length is more than allowed
field.value =field.value.substring(0, maxlimit); // don't allow further input
else
countfield.value = maxlimit - field.value.length;}

</script>

<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>

</div>

<?php include("includes/innerside1.php"); ?>
</div>

<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"><?php echo $send_as_success_story; ?></div>
<div style="border: solid 1px #CFCFCF;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">


<?php if(isset($_REQUEST['succ'])) { ?>
<tr>
	<td colspan="5" align="center" style="color:#FF0000; margin-top:10px;">&nbsp;!</td>
</tr>
<?php } ?>

<?php if(isset($_REQUEST['cap_err'])) { ?>
<tr>
	<td colspan="5" align="center" style="color:#FF0000; margin-top:10px;">Captcha error,Try again!!!</td>
</tr>
<?php } ?>


<form id="testimonials" name="testimonials" method="post" action="" enctype="multipart/form-data" onsubmit="return validates()">
				  <tr><td colspan="4"><div align="right"><span style="color:#FF0000">*</span><span style="font-size:12px; color:#000000; padding-right:10px;">&nbsp;<?php echo $required_info; ?></span></div></td></tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right" width="30%" height="34"><span style="color:#FF0000">*</span> <span style="font-size:12px; color:#000000;">&nbsp;<?php echo $name; ?>&nbsp;&nbsp;</span></td>
                      <td width="3%">:</td>
                      <td width="60%"><label>
                        <input name="name" type="text" id="name" value="<?php if(isset($_SESSION['tmp_name'])) { echo  $_SESSION['tmp_name']; } ?>" />
                      </label></td>
                    </tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right" height="36"><span style="color:#FF0000">*</span> <span style="font-size:12px; color:#000000;">&nbsp;<?php echo $email; ?>&nbsp;&nbsp;</span></td>
                      <td>:</td>
                      <td><label>
                        <input name="email" type="text" id="email" value="<?php if(isset($_SESSION['tmp_email'])) { echo  $_SESSION['tmp_email']; } ?>"/>
                      </label></td>
                    </tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right" height="33"><span style="color:#FF0000">*</span><span style="font-size:12px; color:#000000;">&nbsp;<?php echo $phone; ?>&nbsp;&nbsp;</span></td>
                      <td>:</td>
                      <td>
                      <input name="mobile" type="text" id="mobile" maxlength="10" value="<?php if(isset($_SESSION['tmp_mobile'])) { echo  $_SESSION['tmp_mobile']; } ?>"/>                      </td>
                    </tr>
                  
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right" height="34"><span style="color:#FF0000">*</span> <span style="font-size:12px; color:#000000;"><?php echo $country; ?>&nbsp;&nbsp;</span></td>
                      <td>:</td>
						<td width="60%" >
						<select name="country" class="textBox" style="width:148px;">
						<option value="">Choose Country</option>
						<?php
						if($_SESSION['language']=='english')
						{
						$sql = mysqli_query($con,"SELECT * FROM country");
						}
						else if($_SESSION['language']=='french')
						{
						$sql = mysqli_query($con,"SELECT * FROM country_french");
						}
						else if($_SESSION['language']=='chinese')
						{
						$sql = mysqli_query($con,"SELECT * FROM country_chinese");
						}
						else
						{
						$sql = mysqli_query($con,"SELECT * FROM country_spanish");
						}
						//$sql = mysqli_query($con,"SELECT * FROM country");
						while($result=mysqli_fetch_array($sql)) 
						{
						?>
						<option value="<?php echo $result['country_name']; ?>"><?php echo $result['country_name'];?></option>
						<?php
						}	
						?>
					  </select>						</td>
                    </tr>
					  <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right" height="30"><span style="color:#FF0000">*</span><span style="font-size:12px; color:#000000">&nbsp;<?php echo $city; ?>&nbsp;&nbsp;</span></td>
                      <td>:</td>
                      <td><label>
                        <input name="city" type="text" id="city" value="<?php if(isset($_SESSION['tmp_city'])) { echo  $_SESSION['tmp_city']; } ?>"/>
                      </label></td>
                    </tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right" height="31">&nbsp;&nbsp;&nbsp;<span style="font-size:12px; color:#000000;">&nbsp;<?php echo $company_name; ?>&nbsp;&nbsp;</span></td>
                      <td>:</td>
                      <td><label>
                        <input name="company" type="text" id="company" value="<?php if(isset($_SESSION['tmp_company'])) { echo  $_SESSION['tmp_company']; } ?>"/>
                      </label></td>
                    </tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right">&nbsp;&nbsp;&nbsp;<span style="font-size:12px; color:#000000"><?php echo $photo_attachment; ?>&nbsp;&nbsp;</span>&nbsp;:
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                     </td>
                      <td>&nbsp;</td>
                      <td><input name="uploadedfile" type="file" id="uploadedfile" /></td>
                    </tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td><div align="left"></div></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td align="right" ><span style="color:#FF0000">*</span> <span style="font-size:12px; color:#000000;">&nbsp;<?php echo $my_testmonial; ?>&nbsp;&nbsp;</span></td>
                      <td>:</td>
                      <td><label>
                        <textarea name="story" id="story" cols="30" rows="4" onkeydown="textCounter(this.form.story, this.form.remLen,150);"
onkeyup="textCounter(this.form.story, this.form.remLen,150); "><?php if(isset($_SESSION['tmp_story'])) { echo  $_SESSION['tmp_story']; } ?></textarea><br />
<?php echo $max; ?> <span class="redbold" id="newcharcount">  <input name="remLen" type="text" id="remLen" value="150" size="3" maxlength="3" readonly="readonly" style="margin-top:10px;" /> </span> <?php echo $char_left; ?>
                      </label></td>
                    </tr>
                    <tr>
					<td width="7%" height="98">&nbsp;</td>
                      <td align="right" >&nbsp;
                        <span style="color:#FF0000">* </span><span style="font-size:12px; color:#000000;">&nbsp;<?php echo $do_u_success; ?>?</span></td>
                      <td>:</td>
                      <td><input name="testyes" type="radio" value="Yes" checked="checked" />
                        <span style="font-size:12px; color:#000000;"><?php echo "Yes";?></span>
<input name="testyes" type="radio" value="No" />
                     <span style="font-size:12px; color:#000000;"><?php echo "No";?></span></td>
                    </tr>
					
					<tr>
        <td colspan="2" height="25" align="right" > <?php echo $code; ?>:</td>
        <td colspan="2">
	
	<div>
	<div style="float:left; ">
      <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="securimage_show.php?sid=<?php echo md5(time()) ?>" /></div>
        <div style="float:left;">
		<div>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
			    <param name="allowScriptAccess" value="sameDomain" />
			    <param name="allowFullScreen" value="false" />
			    <param name="movie" value="securimage_play.swf?audio=securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5" />
			    <param name="quality" value="high" />
			
			    <param name="bgcolor" value="#ffffff" />
			    <embed src="securimage_play.swf?audio=securimage_play.php&amp;bgColor1=#777&amp;bgColor2=#fff&amp;iconColor=#000&amp;roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			  </object>
</div>
  <div>      
        
        <!-- pass a session id to the query string of the script to prevent ie caching -->
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = 'securimage_show.php?sid=' + Math.random(); return false"><img src="images/refresh.gif" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" /></a>
</div>
</div>

</div>

</td>

  </tr>
  

  <tr>
  
    <td colspan="2" align="right"><em style="color:#FF0000;">*</em><?php echo $enter_code; ?>:</td>
  
<td colspan="2" style="padding-left:20px;"><input name="reg_answer" id="reg_answer" type="text" style="width:163px;" autocomplete="OFF"/></td>

  </tr>
  <tr>
  <td colspan="4">&nbsp;</td>
  </tr>
					
                    <tr>
                      <td colspan="4" style="padding-left:150px;"><label></label>
                        <label>
                        <input name="Submit" type="submit" class="search_bg" value="<?php echo $submit; ?>" />
                        </label>
                        <label>
                        <input name="Reset" type="reset" class="search_bg" onclick="javascript:len();" value="<?php echo $reset ; ?>" />
                        </label></td>
                      </tr>
                    <tr>
					<td width="7%">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="4" align="center" valign="middle"><span class="textbold">
                        
                      </span></td>
                      </tr>
					  </form>
                  </table>

<div><?PHP echo $pagingLink;
     echo "<br>";?>
</div>
</div>
</div>
<?php include("includes/innerside2.php"); ?>

</div>
</div>
</div>


</div>

<?php include("includes/footer.php"); ?>
<?PHP
 function getPagingQuery($sql, $itemPerPage = 5)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
	
}
function getPagingLink($sql, $itemPerPage = 5, $strGet)
{
	global $con;
	$result        = mysqli_query($con,$sql) or die(mysqli_error($con));
	$pagingLink    = '';
	$totalResults  = mysqli_num_rows($result);
		
	
	 @$totalPages    = ceil($totalResults / $itemPerPage);
	
		
	// how many link pages to show
	$numLinks      = 10;

		
	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
	
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
		
		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
			$pageNumber = (int)$_GET['page'];
		} else {
			$pageNumber = 1;
		}
		
		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">| Prev |</a> ";
			} else {
				$prev = " <a href=\"$self?$strGet\" class=\"topics2\">| Prev |</a> ";
			}	
				
			$first = " <a href=\"$self?$strGet\" class=\"topics2\"> First</a> ";
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">| Next</a> ";
			$last = " <a href=\"$self?page=$totalPages&$strGet\" class=\"topics2\">| Last</a> ";
		} else {
			$next = ''; // we're on the last page, don't show 'next' link
			$last = ''; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
			    
				$pagingLink[] = " $page ";   // no need to create a link to current page
			} else {
				if ($page == 1) {
				  
					$pagingLink[] = " <a href=\"$self?$strGet\" class=\"topics2\">$page</a> ";
				} else {	
				 
					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">$page</a> ";
				}	
			}
	
		}
		
		$pagingLink = implode(' | ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
		
	}
	
	
	return $pagingLink;
}
 ?> 


