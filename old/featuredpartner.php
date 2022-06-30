<?php include("includes/header.php");
if(isset($_REQUEST['Submit']))
{
$session_user=$_SESSION['user_login'];

$name=$_REQUEST['name'];
$partnertype=$_REQUEST['partnertype'];
$companyname=$_REQUEST['companyname'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone'];
$fax=$_REQUEST['fax'];
$comments=$_REQUEST['comments'];
$entrydate=date('Y-m-d');
 include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_REQUEST['reg_answer']);
/*$valid="true";*/
  if($valid == true) {
if($_SESSION['language']=='english')
{
mysqli_query($con,"insert into featurepartner (partnertype, name, companyname, phone, email, fax, comments, entrydate, status, lang_status) values ('$partnertype', '$name', '$companyname', '$phone', '$email', '$fax', '$comments', '$entrydate','1','0')");
}
else if($_SESSION['language']=='french')
{
mysqli_query($con,"insert into featurepartner (partnertype, name_french, companyname_french, phone, email, fax, comments, entrydate, status, lang_status) values ('$partnertype', '$name', '$companyname', '$phone', '$email', '$fax', '$comments', '$entrydate','1','1')");
}
else if($_SESSION['language']=='chinese')
{
mysqli_query($con,"insert into featurepartner (partnertype, name_chinese, companyname_chinese, phone, email, fax, comments, entrydate, status, lang_status) values ('$partnertype', '$name', '$companyname', '$phone', '$email', '$fax', '$comments', '$entrydate','1','2')");
}
else
{
mysqli_query($con,"insert into featurepartner (partnertype, name_chinese, companyname_chinese, phone, email, fax, comments, entrydate, status, lang_status) values ('$partnertype', '$name', '$companyname', '$phone', '$email', '$fax', '$comments', '$entrydate','1','3')");
}


unset($_SESSION['tmp_name']);
unset($_SESSION['tmp_partnertype']);
unset($_SESSION['tmp_companyname']);
unset($_SESSION['tmp_email']);
unset($_SESSION['tmp_phone']);
unset($_SESSION['tmp_fax']);
unset($_SESSION['tmp_comments']);
header("location:sendfeatured.php?succ");
}
else

{
  $_SESSION['tmp_name']=$name;
  $_SESSION['tmp_partnertype']=$partnertype;
  $_SESSION['tmp_companyname']=$companyname;
  $_SESSION['tmp_email']=$email;
  $_SESSION['tmp_phone']=$phone;
  $_SESSION['tmp_fax']=$fax;
  $_SESSION['tmp_comments']=$comments;
 header("location:featuredpartner.php?cap_err");

}



} 
?>
<script type="text/javascript">

function validate(doc)
{
if(document.contact.partnertype.value=="")
{
alert("Please select the Partnership type");
document.contact.partnertype.focus();
return false;
}

if(document.contact.name.value=="")
{
alert("Please enter Your name");
document.contact.name.focus();
return false;
}
if(document.contact.companyname.value=="")
{
alert("Please enter Your Company name");
document.contact.companyname.focus();
return false;
}

if(document.contact.phone.value!="")
{
if(isNaN(document.contact.phone.value))
 {
       alert("Please Enter Number only");
	   document.contact.phone.focus();
		return false;
 }
 }

if(document.contact.fax.value=="")
{
if(isNaN(document.contact.fax.value))
 {
       alert("Please Enter Number only");
	   document.contact.fax.focus();
		return false;
 }
}


if(document.contact.email.value=="")
{
alert("Please enter the Email");
document.contact.email.focus();
return false;
}
if(echeck(document.contact.email.value)==false)
{
document.contact.email.focus();
return false;
}

if(document.contact.comments.value=="")
{
alert("Please enter the Comments");
document.contact.comments.focus();
return false;
}

if(document.contact.reg_answer.value=="")
{
alert("Please enter the security code");
document.contact.reg_answer.focus();
return false;
}


}



function echeck(str) 
{
 var at="@"
 var dot="."
 var lat=str.indexOf(at)
 var lstr=str.length
 var ldot=str.indexOf(dot)
 if (str.indexOf(at)==-1) 
 {
   alert("Invalid E-mail ID")
   return false
 }
 if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(at,(lat+1))!=-1)
 {
  alert("Invalid E-mail ID")
  return false
  }
 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
 {
  alert("Invalid E-mail ID")
  return false
 }
 if (str.indexOf(dot,(lat+2))==-1)
 {
  alert("Invalid E-mail ID")
  return false
 }		
 if (str.indexOf(" ")!=-1)
 {
  alert("Invalid E-mail ID")
  return false
 }
 return true					
}
</script>
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


<div class="body-cont"> 

<div class="body-cont1"> 
<div class="body-leftcont">
<div class="cate-cont"> 
<div class="cate-heading"> <?php echo $browse; ?> </div>
<?php include("includes/sidebar.php"); ?>



</div>

<?php include("includes/innerside3.php"); ?>
</div>





<div class="body-right"> 

<?php include("includes/menu.php"); ?>

<div class="products-cate-cont"> 

<div class="products-cate-heading"> <span><strong> <?php echo $partner_with; ?> <?php echo $webname; ?></strong></span></div>
<div style="border: solid 1px #CFCFCF;">


                  <table width="100%">
				  <form name="contact" method="post" action="" onsubmit="return validate(this);">
                    <tr>
                    <td colspan="2" class="inTxtNormal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($webname); ?> <?php echo $content1; ?> <?php echo $webname; ?> <?php echo $content2; ?>.</td>  
                    </tr>
                    <tr>
                      <td colspan="2" class="inTxtNormal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $content3; ?> <?php echo $webname; ?> <?php echo $content4; ?>:</td>
                    </tr>
                   <tr>
				   <?php
if(isset($_REQUEST['cap_err']))
{
?>
<td align="center" style="color:#FF0000; font-weight:bold; font-size:12px;">Captcha Error, Try again !!!</td>
<?php }

 ?></tr>

                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    
                     <tr>
                      <td width="44%" height="25" align="right"><em style="color:#FF0000;">*</em> <?php echo $select_partner_type; ?>:</td><td width="56%">&nbsp;
					  <select name="partnertype" id="partnertype" style="width:165px;">
                      <option value=""><?php echo $select_partner_type; ?></option>
					  <option value="Reseller Partners"><?php echo $reseller_partner ?></option>
					  <option value="Marketing and Content Partners"><?php echo $marketing_content; ?></option>
					  <option value="Trade show & Association Partners"><?php echo $trade_partner; ?></option>
					  <option value="Third party trade services"><?php echo $third_party_trade; ?></option>
					  </select>
                      </td>
                    </tr>
					<tr>
                 <td height="25" align="right"><em style="color:#FF0000;">*</em> <?php echo $name; ?>:</td><td>&nbsp;&nbsp;<input type="text" name="name" value="<?php if(isset($_SESSION['tmp_name'])) {  echo  $_SESSION['tmp_name']; } ?>" style="width:163px;"/>
                      </td>
                    </tr>
					<tr>
                      <td height="25" align="right"><em style="color:#FF0000;">*</em> <?php echo $company_name; ?>:</td>
                      <td>&nbsp;&nbsp;<input type="text" name="companyname" id="companyname" value="<?php if(isset($_SESSION['tmp_companyname'])) {  echo  $_SESSION['tmp_companyname']; } ?>" style="width:163px;"/>
                      </td>
                    </tr>
					<tr>
                      <td height="25" align="right"><?php echo $phone_number; ?>:</td>
					  <td>&nbsp;&nbsp;<input type="text" name="phone" id="phone" value="<?php if(isset($_SESSION['tmp_phone'])) {  echo  $_SESSION['tmp_phone']; } ?>"  style="width:163px;" />
                      </td>
                    </tr>
					<tr>
                      <td height="25" align="right"><?php echo $fax_number; ?>:</td>
					  <td>&nbsp;&nbsp;<input type="text" name="fax" id="fax" value="<?php if(isset($_SESSION['tmp_fax'])) {  echo  $_SESSION['tmp_fax']; } ?>" style="width:163px;"/>
                      </td>
                    </tr>
					<tr>
                      <td height="25" align="right"><em style="color:#FF0000;">*</em> <?php echo $email; ?>:</td>
                      <td>&nbsp;&nbsp;<input type="text" name="email" id="email" value="<?php if(isset($_SESSION['tmp_email'])) {  echo  $_SESSION['tmp_email']; } ?>" style="width:163px;"/>
                      </td>
                    </tr>
					<tr>
                      <td align="right" valign="top"><em style="color:#FF0000;">*</em> <?php echo $other_requests_comments; ?>:</td>
					  <td>&nbsp;&nbsp;<textarea name="comments" id="comments" style="width:200px; height:70px;"><?php if(isset($_SESSION['tmp_comments'])) {  echo  $_SESSION['tmp_comments']; } ?></textarea>
                      </td>
                    </tr>
					<tr>
        <td height="25" align="right" ><?php echo $code; ?>: </td>
        <td>
	
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
  
    <td align="right"><em style="color:#FF0000;">*</em> <?php echo $enter_code; ?>: </td>
  
<td style="padding-left:6px;"><input name="reg_answer" id="reg_answer" type="text" style="width:163px;" autocomplete="OFF"/></td>

  </tr>
  
  <tr>
  <td colspan="2">&nbsp;</td>
  </tr>

<tr>

  <td colspan="2" align="center">
  <input type="submit" class="search_bg" name="Submit" value="<?php echo $submit; ?>" /></td>
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


