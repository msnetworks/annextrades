<?php 
include("../db-connect/notfound.php");
include("includes/header.php");

if(!isset($_SESSION['admin_user']))
	{
        header("Location:index.php");
    }	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucwords($webname);?> Admin</title>
<link href="../css/sytle.css" rel="stylesheet" type="text/css" />

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
			<h2 class="section_title">dashboard</h2><div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Admin<!-- (<a href="#">3 Messages</a>)--></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="dashboard.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Manage Feature Categories</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include "includes/left_menu.php"; ?>
	
	<section id="main" class="column">		
		<?php if(isset($_REQUEST['edited'])) { ?>
		<h4 class="alert_success">Category Edited Successfully</h4>
		<?php } ?>		
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Manage Feature Categories</h3><h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
		<!--<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>-->
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table width="697" cellspacing="0"> 
			<thead> 
				<tr  style="background-color:#CCCCCC;"> 
   					<th width="67" height="33">S.No</th> 
    				<th width="115">Page Name</th>
					<th width="114">Actions</th> 
				</tr> 
			</thead> 
			<tbody>
                <tr>
                    <td align="center" height="40"><?php echo 1; ?></td>					
					<td align="center"><b style="color:#000099;">Home Page</b></td>
					<td align="center"><a href="edit_featuredcategories.php?page_id=1"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a></td>
                </tr>

                <tr>
                    <td align="center" height="40"><?php echo 2; ?></td>					
					<td align="center"><b style="color:#000099;">Product Page</b></td>
					<td align="center"><a href="edit_featuredcategories.php?page_id=2"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a></td>
                </tr>

                <tr>
                    <td align="center" height="40"><?php echo 3; ?></td>					
					<td align="center"><b style="color:#000099;">Services Page</b></td>
					<td align="center"><a href="edit_featuredcategories.php?page_id=3"><img src="images/images (1).jpg" style="width:17px; height:17px;"/></a></td>
                </tr>			  
				
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
</body>

</html>