<?php
include("../db-connect/notfound.php");
include("includes/header.php");
if (!isset($_SESSION['admin_user'])) {
    header("Location:index.php");
}


$page_id = $_REQUEST['page_id'];

if($page_id==1)
{
    $pageName = "Home";
}
else if($page_id==2)
{
    $pageName = "Product";
}
else if($page_id==3)
{
    $pageName = "Services";
}

if (isset($_REQUEST['editfeatured'])) {


    $featured_categories = $_REQUEST['featured_categories'];
    if(count($featured_categories)> 0)
    {
        mysqli_query($con, "DELETE FROM featuredcategories where page_id='$page_id'");
        foreach($featured_categories as $featured_category_id)
        {
            mysqli_query($con, "INSERT into featuredcategories SET 	page_id = ".$page_id.", category_id = ".$featured_category_id);
            echo $con->error;
        }
    }
    header("location:featuredcategories.php?edited");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><?php echo ucwords($webname); ?> Admin</title>
    <link href="../css/sytle.css" rel="stylesheet" type="text/css" />

    <link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <header id="header">
        <hgroup>
            <h1 class="site_title"><a href="dashboard.php">Website Admin</a></h1>
            <h2 class="section_title">dashboard</h2>
            <div class="btn_view_site"><a href="<?php echo $signin; ?>" target="_blank">View Site</a></div>
        </hgroup>
    </header> <!-- end of header bar -->

    <section id="secondary_bar">
        <div class="user">
            <p>Admin
                <!-- (<a href="#">3 Messages</a>)-->
            </p>
            <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
        </div>
        <div class="breadcrumbs_container">
            <article class="breadcrumbs"><a href="dashboard.php">Website Admin</a>
                <div class="breadcrumb_divider"></div> <a href="featuredcategories.php"><b>Feature Categories</b></a>
            </article>
        </div>
    </section><!-- end of secondary bar -->

    <?php include "includes/left_menu.php"; ?>

    <section id="main" class="column">
        <?php if (isset($_REQUEST['suc'])) { ?>
            <h4 class="alert_success">Updated Successfully</h4>
        <?php } ?>
        <?php if (isset($_REQUEST['pass_suss'])) { ?>
            <h4 class="alert_success">Membership Added Successfully</h4>
        <?php } ?>
        <?php if (isset($_REQUEST['succ'])) { ?>
            <h4 class="alert_success">Deleted Successfully</h4>
        <?php } ?>

        <article class="module width_3_quarter">
            <header>
                <h3 class="tabs_involved">Edit Feature Categories</h3>
                <h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
            </header>
            <div class="tab_container">
                <div id="tab1" class="tab_content">
                    <table width="98%" align="center" cellspacing="0" style="border:solid 1px #fff;">

                        <tr>
                            <td valign="top">
                                <form action="" method="post" name="category" enctype="multipart/form-data" onsubmit="return validatecategory()">
                                    <table width="80%" height="" align="center">

                                        <tr>
                                            <td width="108" height="60" class="inTxtNormal" style="font-size:12px;"><strong> Select Categories for <?=$pageName?> Page:
                                           

                                            </strong></td>
                                            <td width="179">

                                                <select class="js-example-basic-multiple" name="featured_categories[]" multiple="multiple">
                                                   
                                                </select>      

                                        </tr>
                                        <tr>
                                            <td height="60">&nbsp;</td>
                                            <td><input type="submit" name="editfeatured" value="Update" /></td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div><!-- end of #tab1 -->
            </div><!-- end of .tab_container -->
        </article><!-- end of content manager article -->
        <div class="clear"></div>
        <div class="spacer"></div>
    </section>

<?php
$featuredCategories = [];
$featuredCategoriesSelect = mysqli_query($con, "select * from featuredcategories where page_id = '$page_id'");
while($featuredRow = mysqli_fetch_array($featuredCategoriesSelect))
{    
    $featuredCategories[] = $featuredRow['category_id']; 
}


// Get all Categories
$categoriesSelect= mysqli_query($con, "select * from category");





$catogoriesData = [];
while($row = mysqli_fetch_array($categoriesSelect))
{   
    if(in_array($row['c_id'], $featuredCategories))
    {
        $catogoriesData[] = ['id'=>$row['c_id'], 'text' => $row['category'], 'selected' => true];  
    }
    else
    {
        $catogoriesData[] = ['id'=>$row['c_id'], 'text' => $row['category']];  
    }   
   
}

?>
<script>
    var catogoriesData = [];
    catogoriesData = <?php echo json_encode($catogoriesData) ?>;
</script>


    <script>
        jQuery(document).ready(function() {
            jQuery('.js-example-basic-multiple').select2( {data: catogoriesData});
        });
    </script>
    <style>
        .js-example-basic-multiple
        {
            width: 500px;
            height: 300px !important;
        }
        .select2-container--default .select2-selection--multiple
        {
            padding: 5px 0px 10px 5px;
        }

    </style>
    </body>

</html>