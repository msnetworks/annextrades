<?php 
	session_start();
	ob_start();
	if(!isset($_SESSION['admin_user']))
	{
		header("Location:index.php");
	}
	include("../db-connect/notfound.php");
	include("includes/header.php");
	
$sel_cms = mysqli_fetch_array(mysqli_query($con,"select * from cms"));

if(isset($_REQUEST['update']))
{
	$about_us=mysqli_real_escape_string($con, $_REQUEST['about_us']);
	$privacy_policy=mysqli_real_escape_string($con, $_REQUEST['privacy_policy']);
	$terms_conditions=mysqli_real_escape_string($con, $_REQUEST['terms_conditions']);
	$protecting = mysqli_real_escape_string($con, $_REQUEST['protecting']);
	$advantage = mysqli_real_escape_string($con, $_REQUEST['advantage']);
	$our_security = mysqli_real_escape_string($con, $_REQUEST['our_security']);
	
	$qry=mysqli_query($con,"UPDATE cms SET about_us='$about_us', privacy_policy='$privacy_policy',terms_conditions='$terms_conditions',protecting='$protecting',advantage='$advantage',our_security='$our_security' where cms_id='1'");
	
	//header("location:cms.php?succ");			
	
	if($qry) { ?><script>
				window.location="cms.php?succ";
				</script><?php }
}

?>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		
    	plugins : "style,layer,save,paste,advlist,autosave",
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",
		theme_advanced_buttons2 : "pastetext,pasteword,|,search,replace,|,bullist,numlist,link,unlink,anchor",
		
		theme_advanced_buttons3 : "formatselect,fontselect,fontsizeselect",
		
	

	

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

	});
	</script>
	
<script language="javascript">
function val()
{
	tinyMCE.triggerSave();
	
    if ( document.bulk_new.about_us.value=="")
    {
        alert ( "Please fill about us");
		document.bulk_new.about_us.focus();
        return false;
    }
	
	if ( document.bulk_new.privacy_policy.value =="")
    {
        alert ( "Please fill privacy policy");
		document.bulk_new.privacy_policy.focus();
        return false;
    }
	
	if ( document.bulk_new.protecting.value =="")
    {
        alert ( "Please fill privacy policy");
		document.bulk_new.protecting.focus();
        return false;
    }
	
	if ( document.bulk_new.terms_conditions.value=="")
    {
        alert ( "Please fill terms and conditions");
		document.bulk_new.terms_conditions.focus();
        return false;
    }
	
	if ( document.bulk_new.advantage.value=="")
    {
        alert ( "Please fill terms and conditions");
		document.bulk_new.advantage.focus();
        return false;
    }
	
	if ( document.bulk_new.our_security.value=="")
    {
        alert ( "Please fill terms and conditions");
		document.bulk_new.our_security.focus();
        return false;
    }
	
	return true;
}

</script>

<script language="javascript">
function validate()
{
	if(document.getElementById('about_us').value=="")
	{
		alert("Please fill about us");
		document.getElementById('about_us').focus();
		return false;
	}
	if(document.getElementById('privacy_policy').value=="")
	{
		alert("Please fill privacy policy");
		document.getElementById('privacy_policy').focus();
		return false;
	}
	if(document.getElementById('terms_conditions').value=="")
	{
		alert("Please fill terms and conditions");
		document.getElementById('terms_conditions').focus();
		return false;
	}
	if(document.getElementById('advantage').value=="")
	{
		alert("Please fill privacy policy");
		document.getElementById('advantage').focus();
		return false;
	}
	if(document.getElementById('our_security').value=="")
	{
		alert("Please fill terms and conditions");
		document.getElementById('our_security').focus();
		return false;
	}
}
</script>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">&nbsp;</h2><div class="btn_view_site"><a href="<?php echo $site_url; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">CMS</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
		<div style="float:left; text-align:left;">
	<div class="" style="width:700px;">
				
			<?php if(isset($_REQUEST['succ'])) { ?>
		<h4 class="alert_success1" style="padding-left:300px; color:#FF0000;">Updated Successfully!</h4>
				<?php } ?>
				
				<div class="module width_3_quarter" style="width:100%;">
		<header><h3 class="tabs_involved"> CMS Management  </h3>
		
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="bulk_new" action="" method="post" onsubmit="return val();" >
				<input type="hidden" name="cms_id" value="<?php echo $cms_id ?>" />
					
					<div class="de_lft" style="height:250px; width:100px;">About Us</div><div class="de_lft" style="width:300px;">
			<textarea cols="60" rows="10" name="about_us" id="about_us"><?php echo $sel_cms['about_us']; ?></textarea>
					</div>
					
					<div style="clear:both;"></div>
						<div class="de_lft" style="height:250px; width:100px;">Privacy Policy </div><div class="de_lft" style="width:300px;">
			<textarea cols="60" rows="10" name="privacy_policy" id="privacy_policy"><?php echo $sel_cms['privacy_policy']; ?></textarea>
					</div>
					<div style="clear:both;"></div>
					
					<div class="de_lft" style="height:250px; width:100px;">Protecting</div><div class="de_lft" style="width:400px;"> 
					
			<textarea cols="60" rows="10" name="protecting" id="protecting"><?php echo $sel_cms['protecting']; ?></textarea>
					
					</div>
					<div style="clear:both;"></div>
					
					<div class="de_lft" style="height:250px; width:100px;">Terms of Use</div><div class="de_lft" style="width:400px;"> 
					
			<textarea cols="60" rows="10" name="terms_conditions" id="terms_conditions"><?php echo $sel_cms['terms_conditions']; ?></textarea>
					
					</div>
					<div style="clear:both;"></div>
					
					<div style="clear:both;"></div>
					
					<div class="de_lft" style="height:250px; width:100px;">Advantage</div><div class="de_lft" style="width:400px;"> 
					
			<textarea cols="60" rows="10" name="advantage" id="advantage"><?php echo $sel_cms['advantage']; ?></textarea>
					
					</div>
					<div style="clear:both;"></div>
					
					<div style="clear:both;"></div>
					
					<div class="de_lft" style="height:250px; width:100px;">Our Security</div><div class="de_lft" style="width:400px;"> 
					
			<textarea cols="60" rows="10" name="our_security" id="our_security"><?php echo $sel_cms['our_security']; ?></textarea>
					
					</div>
					<div style="clear:both;"></div>
								
			<div class="de_lft" style="height:35px;"></div><div class="de_lft">
			&nbsp;
			<input type="submit" value="Update" name="update" class="alt_btn" >
					</div>
		</form>
			</div>
		</div>
		
		</div>
		  </div>
		</div>
		<div class="de_lft">&nbsp;</div>
</body>
</html>