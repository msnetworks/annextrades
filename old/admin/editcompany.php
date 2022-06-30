<?php
//session_start();
//ob_start();


$http = $_SERVER['REQUEST_SCHEME'];
$host = $_SERVER['HTTP_HOST'];
$base_dir  = __DIR__;
$doc_root  = ($_SERVER["DOCUMENT_ROOT"]);
$base_url  = preg_replace("!^{$doc_root}!", '', $base_dir);
$baseUrl = $http . "://" . $host . $base_url;
$baseUrl = str_replace('admin', '', $baseUrl);

include("../db-connect/notfound.php");
include("includes/header.php");
if (!isset($_SESSION['admin_user'])) {
  header("Location:index.php");
}
$idd = $_REQUEST['id'];
$rid = $_REQUEST['idd'];

$sql_ed = (mysqli_query($con, "select * from companyprofile where user_id='$rid'"));
$row_ed = mysqli_fetch_array($sql_ed);
$Logo = $row_ed['companylogo'];

if (isset($_REQUEST['Editsubmit'])) {
  $Companyname = $_REQUEST['companyname'];
  $Bussinesstype = $_REQUEST['bussiness_type'];
  $P_service = $_REQUEST['P_service'];
  $Companyaddress = $_REQUEST['company_address'];
  $URL = $_REQUEST['url'];
  $Companydetails = $_REQUEST['company_details'];
  $Year = $_REQUEST['year'];
  $Certification = $_REQUEST['certification'];
  $brand = $_REQUEST['brand'];
  $noofemployee = $_REQUEST['noofemployee'];
  $bussinessowner = $_REQUEST['bussinessowner2'];
  $registeredcapital = $_REQUEST['registeredcapital'];
  $ownertype = $_REQUEST['ownertype'];
  //$mainmarkets=$_REQUEST['mainmarkets'];
  ///  mainmarket ////  
  $mainmarket = $_REQUEST['market'];
  for ($c = 0; $c < sizeof($mainmarket); $c++) {
    $Mainmarket = implode(',', $_REQUEST['market']);
  }
  ///////////////
  $maincustomer = $_REQUEST['maincustomer2'];
  $toannualsalesvolume = $_REQUEST['toannualsalesvolume'];
  $factorysize = $_REQUEST['factorysize'];
  $factorylocation = $_REQUEST['factorylocation'];
  $qaqc = $_REQUEST['quali'];
  $noofprodlines = $_REQUEST['noofprodline'];
  $noofrdstaff = $_REQUEST['noofrdstaff'];
  $noofqcstaff = $_REQUEST['noofqcstaff'];
  //$mgmtcertification=$_REQUEST['mgmtcertification'];
  ///  Management Certificate ////  
  $mgmcertification = $_REQUEST['mgmcertification'];
  for ($h = 0; $h < sizeof($mgmcertification); $h++) {
    $Mgmcertification = implode(',', $_REQUEST['mgmcertification']);
  }
  /////////////
  $contactmant = $_REQUEST['contactmfcr'];
  for ($W = 0; $W < sizeof($contactmant); $W++) {
    $contactmant1 = implode(',', $_REQUEST['contactmfcr']);
  }

  $Companylogo = basename($_FILES['companylogo']['name']);

  if ($Companylogo == "") {
    $Photo = $Logo;
  } else {
    $Photo = $Companylogo;
  }

  /* Video & Photos */
  $videos = $_REQUEST['videos'];


  /* Video & Photos */

  $uploaddir = 'logo/';
  $uploadfile = $uploaddir . basename($_FILES['companylogo']['name']);
  if (move_uploaded_file($_FILES['companylogo']['tmp_name'], $uploadfile)) {
    //echo "uploaded successfully";
  } else {
    //echo "error";
  }
  $update_reg = "UPDATE `registration` SET `companyname` ='$Companyname' WHERE `id` ='$rid'";
  $update_reg_query = mysqli_query($con, $update_reg);
  $updatesql =  "UPDATE `companyprofile` set
`companyname`='$Companyname',
`bussiness_type`='$Bussinesstype',
`P_service`='$P_service' ,
`company_address`='$Companyaddress' ,
`companylogo`= '$Photo',
`url`='$URL',
`company_details`='$Companydetails',
`year`= '$Year' ,
`certification`='$Certification',
`brand`='$brand',
`noofemployee`='$noofemployee',
`bussinessowner`='$bussinessowner',
`registeredcapital`='$registeredcapital',
`ownertype`='$ownertype',
`mainmarkets`='$Mainmarket',
`maincustomer`='$maincustomer',
`toannualsalesvolume`='$toannualsalesvolume',
`factorysize`='$factorysize',
`factorylocation`='$factorylocation',
`qa/qc`='$qaqc',
`noofprodlines`='$noofprodlines',
`noofr&dstaff`='$noofrdstaff',
`noofqcstaff`='$noofqcstaff',
`mgmtcertification`='$Mgmcertification',
`videos` = '$videos',
`contactmant`='$contactmant1' WHERE `user_id` ='$rid' ";
  $up_query = mysqli_query($con, $updatesql);
  $sql = (mysqli_query($con, "select * from  companyprofile where  user_id='$rid'"));
  $count = mysqli_num_rows($sql);
  //$row=mysqli_fetch_array($sql);
  ////////// REFRESH PAGE ///////////	
  header("location:companyprofile.php?edited");
  ////////////////////
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title><?php echo ucwords($webname); ?> Admin</title>
  <link href="../css/sytle.css" rel="stylesheet" type="text/css" />
  <link href="css/core-inetdir1.css" rel="stylesheet" type="text/css" />
  <script language="javascript" src="../ajaxfunction.js"></script>

  <script language="javascript">
    function featureval() {
      if (document.feature.pdtname.value == "") {
        alert("Please Enter The Product Name");
        document.feature.pdtname.focus();
        return false;
      }
      /*if(document.feature.file.value=="")
      {
       alert("Please Upload The Product Image");
       document.feature.file.focus();
       return false;
       }*/
      if (document.feature.file.value != "") {
        var str = document.feature.file.value.substring(document.feature.file.value.indexOf('.'));
        if (str == '.jpg' || str == '.gif' || str == '.jpeg') {
          return true;
        } else {
          alert("Upload only jpg, jpeg and gif");
          return false;
        }
      }
      if (document.feature.startyear.value == "") {
        alert("Please Enter Your Company Established Year");
        document.feature.startyear.focus();
        return false;
      }
      if (document.feature.country.value == "") {
        alert("Please Select The Country");
        document.feature.country.focus();
        return false;
      }
      if (document.feature.address.value == "") {
        alert("Please Enter The Address");
        document.feature.address.focus();
        return false;
      }

      if (document.feature.p_price.value == "") {
        alert("Please Select Pay Category");
        document.feature.p_price.focus();
        return false;
      }
      if (document.feature.range1.value == "") {
        alert("Please Enter The Minimum Amount");
        document.feature.range1.focus();
        return false;
      }
      if (isNaN(document.feature.range1.value)) {
        alert("Please Enter Only Numeric Values");
        document.feature.range1.focus();
        return false;
      }
      if (document.feature.range2.value == "") {
        alert("Please Enter The Maximum Amount");
        document.feature.range2.focus();
        return false;
      }

      if (isNaN(document.feature.range2.value)) {
        alert("Please Enter Only Numeric Values");
        document.feature.range2.focus();
        return false;
      }
      if (document.feature.p_miniquantity.value == "") {
        alert("Please Enter The Minimum Quantity Of Product");
        document.feature.p_miniquantity.focus();
        return false;
      }

      if (isNaN(document.feature.p_miniquantity.value)) {
        alert("Please Enter Only Numeric Values");
        document.feature.p_miniquantity.focus();
        return false;
      }
      if (document.feature.p_quantity.value == "") {
        alert("Please Select The Mode Of Order");
        document.feature.p_quantity.focus();
        return false;
      }


      if (document.feature.p_capacity.value == "") {
        alert("Please Enter Production Capacity");
        document.feature.p_capacity.focus();
        return false;
      }

      if (isNaN(document.feature.p_capacity.value)) {
        alert("Please Enter Only Numeric Values");
        document.feature.p_capacity.focus();
        return false;
      }

      if (document.feature.capacity.value == "") {
        alert("Please Select Unit Type");
        document.feature.capacity.focus();
        return false;
      }
      if (document.feature.time.value == "") {
        alert("Please Select Time");
        document.feature.time.focus();
        return false;
      }

      if (document.feature.p_deliverytime.value == "") {
        alert("Please Enter The Product Delivery Time");
        document.feature.p_deliverytime.focus();
        return false;
      }
      if (document.feature.p_packagedetails.value == "") {
        alert("Please Enter The Package Details");
        document.feature.p_packagedetails.focus();
        return false;
      }
    }
  </script>
</head>
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
      <div class="breadcrumb_divider"></div> <a href="companyprofile.php"><b>Company</b></a>
    </article>
  </div>
</section><!-- end of secondary bar -->

<?php include "includes/left_menu.php"; ?>

<section id="main" class="column">
  <?php if (isset($_REQUEST['edited'])) { ?>
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
      <h3 class="tabs_involved">Edit Company Details</h3>
      <h2 style="padding-top:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1);" style="color:#009900;">Back</a></h2>
    </header>
    <div class="tab_container">
      <div id="tab1" class="tab_content">
        <?php
        $sql_ed = (mysqli_query($con, "select * from companyprofile where id='$idd'"));
        $row_ed = mysqli_fetch_array($sql_ed);
        //print_r($row_ed);
        $row_ed['P_service'];
        $Logo = $row_ed['companylogo'];
        ?>
        <table width="98%" border="0" align="right" cellspacing="0" cellpadding="0">

          <tr>
            <td>
                <table width="100%">
                  <tr>
                    <td>

        <div style="width: 200px; height: 200px;" class="dropBoxContainer">
          <form action="<?=$baseUrl?>upload.php" class="dropzone" id="dropzoneFrom">
          </form>
        </div>
        <div align="center">
          <buttons style="visibility: hidden;" type="button" class="btn btn-info" id="submit-all">Upload</button>
        </div>
        <div class="container" id="preview"></div>
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
          <tr>
            <td class="inbg2">
              <form action="" method="post" name="editcompanydetails" id="form1" enctype="multipart/form-data">
                <table width="100%" border="0" style="margin-top:15px;">
                  <!--<tr>
                          <td colspan="3" bgcolor="#99CCFF"><div align="left" class="inTxtHead">Edit Company Details</div></td>
                          </tr>-->
                  <tr>
                    <td colspan="3" align="center"><?php echo $Updated; ?> </td>
                  </tr>
                  <?php
                  $sql = (mysqli_query($con, "select * from  registration where id='$rid'"));
                  $count = mysqli_num_rows($sql);
                  $row = mysqli_fetch_array($sql);
                  $cou = $row['country'];
                  ?>
                  <tr>
                    <td width="47%" align="right" class="blackBo">Company Name </td>
                    <td width="4%" align="center" class="blackBo">:</td>
                    <td width="49%" class="bluebold"><input name="companyname" type="text" class="textBox" id="companyname" value="<?php echo  $row['companyname']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Bussiness Type </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><select name="bussiness_type" class="textBox" id="bussiness_type">
                        <option value="">Select Type </option>
                        <option value="manfacturer" <?php if ($row_ed['bussiness_type'] == 'manfacturer') { ?> selected="selected" <?php } ?>>Manufacturer</option>
                        <option value="trading company" <?php if ($row_ed['bussiness_type'] == 'trading company') { ?> selected="selected" <?php } ?>>Trading Company </option>
                        <option value="buying office" <?php if ($row_ed['bussiness_type'] == 'buying office') { ?> selected="selected" <?php } ?>>Buying Office</option>
                        <option value="distrubutor/wholesale" <?php if ($row_ed['bussiness_type'] == 'distrubutor/wholesale') { ?> selected="selected" <?php } ?>>Distributor/Wholesale</option>
                        <option value="goverment ministry" <?php if ($row_ed['bussiness_type'] == 'overment ministry') { ?> selected="selected" <?php } ?>>Goverment Ministry </option>
                        <option value="bissiness service" <?php if ($row_ed['bussiness_type'] == 'bussiness service') { ?> selected="selected" <?php } ?>>Bussiness Service</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Product Service </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="P_service" type="text" class="textBox" id="P_service" value="<?php echo $row_ed['P_service'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Company Address </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="company_address" type="text" class="textBox" id="company_address" value="<?php echo $row_ed['company_address'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Company Logo </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="companylogo" type="file" id="companylogo" value="" /><img src="<?php echo "blog_photo_thumbnail/" . $row_ed['companylogo'];  ?>" width="60" height="60" border="0" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Brand(s)</td>
                    <td align="center" class="blackBo">:</td>

                    <td class="bluebold"><input name="brand" type="text" class="textBox" id="<?php echo $row_ed['brand'];  ?>" value="<?php echo $row_ed['brand'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">No. Of Employees</td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">
                      <select name="noofemployee" class="textBox" id="noofemployee">
                        <option value="">Select Type </option>
                        <option value="Less than 5 People" <?php if ($row_ed['noofemployee'] == 'Less than 5 People') { ?> selected="selected" <?php } ?>>Less than 5 People</option>
                        <option value="11 - 50 People" <?php if ($row_ed['noofemployee'] == '11 - 50 People') { ?> selected="selected" <?php } ?>>11 - 50 People </option>
                        <option value="51 - 100 People" <?php if ($row_ed['noofemployee'] == '51 - 100 People') { ?> selected="selected" <?php } ?>>51 - 100 People</option>
                        <option value="101 - 500 People" <?php if ($row_ed['noofemployee'] == '101 - 500 People') { ?> selected="selected" <?php } ?>>101 - 500 People</option>
                        <option value="501 - 1000 People" <?php if ($row_ed['noofemployee'] == '501 - 1000 People') { ?> selected="selected" <?php } ?>>501 - 1000 People </option>
                        <option value="Above 1000 People" <?php if ($row_ed['noofemployee'] == 'Above 1000 People') { ?> selected="selected" <?php } ?>>Above 1000 People</option>
                      </select> </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Company Website URL </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="url" type="text" class="textBox" id="url" value="<?php echo $row_ed['url'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td height="40" align="right" class="blackBo">Detailed Company Introduction </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="company_details" type="text" class="textBox" id="company_details" value="<?php echo $row_ed['company_details'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td width="100%" height="31" colspan="3">
                      <div style="color:#000099; font-size:14px;"><span><b>Ownership &amp; Capital</b></span></div>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Year Established </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="year" type="text" class="textBox" id="year" value="<?php echo $row_ed['year'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" class="blackBo">Legal Representative / Bussiness Owner</td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="bussinessowner2" type="text" class="textBox" id="<?php echo $row_ed['bussinessowner'];  ?>" value="<?php echo $row_ed['bussinessowner'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Registered Capital </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">
                      <select name="registeredcapital" class="textBox" id="registeredcapital">
                        <option value="">Select Type </option>
                        <option value="Below US$100 Thousand" <?php if ($row_ed['registeredcapital'] == 'Below US$100 Thousand') { ?> selected="selected" <?php } ?>>Below US$100 Thousand</option>
                        <option value="US$101 - US$500 Thousand" <?php if ($row_ed['registeredcapital'] == 'US$101 - US$500 Thousand') { ?> selected="selected" <?php } ?>>US$101 - US$500 Thousand </option>
                        <option value="US$501 - US$1 Million" <?php if ($row_ed['registeredcapital'] == 'US$501 - US$1 Million') { ?> selected="selected" <?php } ?>>US$501 - US$1 Million</option>
                      </select> </td>
                  </tr>
                  <tr>
                    <td height="29" align="right" class="blackBo">Ownership Type</td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">
                      <select name="ownertype" class="textBox" id="ownertype">
                        <option value="">Select Type </option>
                        <option value="Corporation/Linited Company" <?php if ($row_ed['ownertype'] == 'Corporation/Linited Company') { ?> selected="selected" <?php } ?>>Corporation/Linited Company</option>
                        <option value="Partner Ship" <?php if ($row_ed['ownertype'] == 'Partner Ship') { ?> selected="selected" <?php } ?>>Partner Ship </option>
                        <option value="Other" <?php if ($row_ed['ownertype'] == 'Other') { ?> selected="selected" <?php } ?>>Other</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="3">
                      <div style="color:#000099; font-size:14px;"><span><b>Trade &amp; Market</b></span></div>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Main Markets</td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">
                      <table width="100%" border="0">
                        <tr>
                          <?PHP
                          $markets = $row_ed['mainmarkets'];
                          $mainmark = explode(",", $markets);
                          $mainmark1 = $mainmark[0];
                          $mainmark2 = $mainmark[1];
                          $mainmark3 = $mainmark[2];
                          $mainmark4 = $mainmark[3];
                          $mainmark5 = $mainmark[4];
                          $mainmark6 = $mainmark[5];
                          $mainmark7 = $mainmark[6];
                          $mainmark8 = $mainmark[7];
                          $mainmark9 = $mainmark[8];
                          ?>

                          <th width="7%" class="inTxtNormal" scope="row">
                            <input name="market[]" type="checkbox" value="North America" <?PHP if ($mainmark1 == "North America") { ?>checked="checked" <?PHP } ?> /></th>
                          <td width="25%" class="inTxtNormal">North America</td>
                          <td width="6%" class="inTxtNormal"><input name="market[]" type="checkbox" value="South America" <?PHP if ($mainmark4 == "South America") { ?>checked="checked" <?PHP } ?> /></td>
                          <td width="24%" class="inTxtNormal">South America</td>
                          <td width="7%" class="inTxtNormal"><input name="market[]" type="checkbox" value="Eastern Europe" <?PHP if ($mainmark7 == "Eastern Europe") { ?>checked="checked" <?PHP } ?> /></td>
                          <td width="31%" class="inTxtNormal">Eastern Europe </td>
                        </tr>
                        <tr>
                          <th class="inTxtNormal" scope="row"><input name="market[]" type="checkbox" value="Southeast Asia" <?PHP if ($mainmark2 == "Southeast Asia") { ?>checked="checked" <?PHP } ?> /></th>
                          <td class="inTxtNormal">Southeast Asia </td>
                          <td class="inTxtNormal"><input name="market[]" type="checkbox" value="Africa" <?PHP if ($mainmark5 == "Africa") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">Africa</td>
                          <td class="inTxtNormal"><input name="market[]" type="checkbox" value="Oceania" <?PHP if ($mainmark8 == "Oceania") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">Oceania</td>
                        </tr>
                        <tr>
                          <th class="inTxtNormal" scope="row"><input name="market[]" type="checkbox" value="Mid East" <?PHP if ($mainmark3 == "Mid East") { ?>checked="checked" <?PHP } ?> /></th>
                          <td class="inTxtNormal">Mid East </td>
                          <td class="inTxtNormal"><input name="market[]" type="checkbox" value="Eastern Asia " <?PHP if ($mainmark6 == "Eastern Asia") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">Eastern Asia </td>
                          <td class="inTxtNormal"><input name="market[]" type="checkbox" value="Westaern Europe " <?PHP if ($mainmark9 == "Westaern Europe") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">Westaern Europe </td>
                        </tr>
                      </table> <label></label>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Main Customer(s)</td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="maincustomer2" type="text" class="textBox" id="maincustomer2" value="<?php echo $row_ed['maincustomer'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Total Annual Sales Volume </td>
                    <td align="center" class="blackBo">&nbsp;</td>
                    <td class="bluebold">

                      <select name="toannualsalesvolume" class="textBox" id="toannualsalesvolume">
                        <option value="">Please Select </option>
                        <option value="Below US$1 Million" <?php if ($row_ed['toannualsalesvolume'] == 'Below US$1 Million') { ?> selected="selected" <?php } ?>>Below US$1 Million</option>
                        <option value="US$101 - US$500 Million" <?php if ($row_ed['toannualsalesvolume'] == 'US$101 - US$500 Million') { ?> selected="selected" <?php } ?>>US$101 - US$500 Million </option>
                        <option value="US$501 - US$1 Million" <?php if ($row_ed['toannualsalesvolume'] == 'US$501 - US$1 Million') { ?> selected="selected" <?php } ?>>US$501 - US$1 Million</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Export Percentage </td>
                    <td align="center" class="blackBo">&nbsp;</td>
                    <td class="bluebold">
                      <select name="exportpercentage" class="textBoxSi" id="exportpercentage">
                        <option value="">Please Select </option>
                        <option value="1% - 10%" <?php if ($row_ed['exportpercentage'] == '1% - 10%') { ?> selected="selected" <?php } ?>>1% - 10%</option>
                        <option value="11% - 20%" <?php if ($row_ed['exportpercentage'] == '11% - 20%') { ?> selected="selected" <?php } ?>>11% - 20% </option>
                        <option value="21% - 30%" <?php if ($row_ed['exportpercentage'] == '21% - 30%') { ?> selected="selected" <?php } ?>>21% - 30%</option>
                        <option value="31% - 40%" <?php if ($row_ed['exportpercentage'] == '31% - 40%') { ?> selected="selected" <?php } ?>>31% - 40%</option>
                        <option value="41% - 50%" <?php if ($row_ed['exportpercentage'] == '41% - 50%') { ?> selected="selected" <?php } ?>>41% - 50%</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td height="28" align="right" class="blackBo">Total Annual Purchase Volume </td>
                    <td align="center" class="blackBo">&nbsp;</td>
                    <td class="bluebold">
                      <select name="toannualpurchase" class="textBox">
                        <option value="">Please Select </option>
                        <option value="Below US$1 Million" <?php if ($row_ed['toannualpurchasevolume'] == 'Below US$1 Million') { ?> selected="selected" <?php } ?>>Below US$1 Million</option>
                        <option value="US$101 - US$500 Million" <?php if ($row_ed['toannualpurchasevolume'] == 'US$101 - US$500 Million') { ?> selected="selected" <?php } ?>>US$101 - US$500 Million </option>
                        <option value="US$501 - US$1 Million" <?php if ($row_ed['toannualpurchasevolume'] == 'US$501 - US$1 Million') { ?> selected="selected" <?php } ?>>US$501 - US$1 Million</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="3">
                      <div style="color:#000099; font-size:14px;"><span><b>Factory Information</b></span></div>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Factory Size </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">
                      <select name="factorysize" class="textBox" id="factorysize">
                        <option value="">Please Select </option>
                        <option value="Below 1000 Square meter" <?php if ($row_ed['factorysize'] == 'Below 1000 Square meter') { ?> selected="selected" <?php } ?>>Below 1000 Square meter</option>
                        <option value="1000 - 3000 Square meter" <?php if ($row_ed['factorysize'] == '1000 - 3000 Square meter') { ?> selected="selected" <?php } ?>>1000 - 3000 Square meter </option>
                        <option value="3000 - 5000 Square meter" <?php if ($row_ed['factorysize'] == '3000 - 5000 Square meter') { ?> selected="selected" <?php } ?>>3000 - 5000 Square meter</option>
                      </select> </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Factory Location </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold"><input name="factorylocation" type="text" class="textBox" id="factorylocation" value="<?php echo $row_ed['factorylocation'];  ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">QA/QC</td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">

                      <select name="quali" class="textBoxSi" id="qa/qc">
                        <option value="">Please Select </option>
                        <option value="In House" <?php if ($row_ed['qa/qc'] == 'In House') { ?> selected="selected" <?php } ?>>In House</option>
                        <option value="Third Parties" <?php if ($row_ed['qa/qc'] == 'Third Parties') { ?> selected="selected" <?php } ?>>Third Parties </option>
                        <option value="No" <?php if ($row_ed['qa/qc'] == 'No') { ?> selected="selected" <?php } ?>>No</option>
                      </select> </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">No. of Production Lines </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">

                      <select name="noofprodline" class="textBoxSi" id="noofprodline">
                        <option value="">Please Select </option>
                        <option value="1" <?php if ($row_ed['noofprodlines'] == '1') { ?> selected="selected" <?php } ?>>1</option>
                        <option value="2" <?php if ($row_ed['noofprodlines'] == '2') { ?> selected="selected" <?php } ?>>2 </option>
                        <option value="3" <?php if ($row_ed['noofprodlines'] == '3') { ?> selected="selected" <?php } ?>>3</option>
                        <option value="4" <?php if ($row_ed['noofprodlines'] == '4') { ?> selected="selected" <?php } ?>>4</option>
                        <option value="5" <?php if ($row_ed['noofprodlines'] == '5') { ?> selected="selected" <?php } ?>>5 </option>
                        <option value="6" <?php if ($row_ed['noofprodlines'] == '6') { ?> selected="selected" <?php } ?>>6</option>
                        <option value="7" <?php if ($row_ed['noofprodlines'] == '7') { ?> selected="selected" <?php } ?>>7</option>
                        <option value="8" <?php if ($row_ed['noofprodlines'] == '8') { ?> selected="selected" <?php } ?>>8 </option>
                        <option value="9" <?php if ($row_ed['noofprodlines'] == '9') { ?> selected="selected" <?php } ?>>9</option>
                        <option value="10" <?php if ($row_ed['noofprodlines'] == '10') { ?> selected="selected" <?php } ?>>10</option>
                      </select> </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">No. of R&amp;D Staff </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">

                      <select name="noofrdstaff" class="textBox">
                        <option value="">Please Select </option>
                        <option value="Less than 5 People" <?php if ($row_ed['noofr&dstaff'] == 'Less than 5 People') { ?> selected="selected" <?php } ?>>Less than 5 People</option>
                        <option value="5 - 10 People" <?php if ($row_ed['noofr&dstaff'] == '5 - 10 People') { ?> selected="selected" <?php } ?>>5 - 10 People </option>
                        <option value="11 - 20 People" <?php if ($row_ed['noofr&dstaff'] == '11 - 20 People') { ?> selected="selected" <?php } ?>>11 - 20 People</option>
                        <option value="21 - 30 People" <?php if ($row_ed['noofr&dstaff'] == '21 - 30 People') { ?> selected="selected" <?php } ?>>21 - 30 People</option>
                        <option value="31 - 40 People" <?php if ($row_ed['noofr&dstaff'] == '31 - 40 People') { ?> selected="selected" <?php } ?>>31 - 40 People </option>
                        <option value="41 - 50 People" <?php if ($row_ed['noofr&dstaff'] == '41 - 50 People') { ?> selected="selected" <?php } ?>>41 - 50 People</option>
                        <option value="51 - 60 People" <?php if ($row_ed['noofr&dstaff'] == '51 - 60 People') { ?> selected="selected" <?php } ?>>51 - 60 People</option>
                      </select> </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">No. of QC Staff </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">

                      <select name="noofqcstaff" class="textBox" id="noofqcstaff">
                        <option value="">Please Select </option>
                        <option value="Less than 5 People" <?php if ($row_ed['noofqcstaff'] == 'Less than 5 People') { ?> selected="selected" <?php } ?>>Less than 5 People</option>
                        <option value="5 - 10 People" <?php if ($row_ed['noofqcstaff'] == '5 - 10 People') { ?> selected="selected" <?php } ?>>5 - 10 People </option>
                        <option value="11 - 20 People" <?php if ($row_ed['noofqcstaff'] == '11 - 20 People') { ?> selected="selected" <?php } ?>>11 - 20 People</option>
                        <option value="21 - 30 People" <?php if ($row_ed['noofqcstaff'] == '21 - 30 People') { ?> selected="selected" <?php } ?>>21 - 30 People</option>
                        <option value="31 - 40 People" <?php if ($row_ed['noofqcstaff'] == '31 - 40 People') { ?> selected="selected" <?php } ?>>31 - 40 People </option>
                        <option value="41 - 50 People" <?php if ($row_ed['noofqcstaff'] == '41 - 50 People') { ?> selected="selected" <?php } ?>>41 - 50 People</option>
                        <option value="51 - 60 People" <?php if ($row_ed['noofqcstaff'] == '51 - 60 People') { ?> selected="selected" <?php } ?>>51 - 60 People</option>
                      </select> </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Management Certification </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">
                      <table width="100%" border="0">
                        <tr>
                          <?PHP $resmail = $row_ed['mgmtcertification'];
                          $pieces = explode(",", $resmail);
                          $resmail1 = $pieces[0];
                          $resmail2 = $pieces[1];
                          $resmail3 = $pieces[2];
                          $resmail4 = $pieces[3];
                          $resmail5 = $pieces[4];
                          $resmail6 = $pieces[5];
                          $resmail7 = $pieces[6];
                          $resmail8 = $pieces[7];
                          $resmail9 = $pieces[8];
                          ?>
                          <td width="11%" align="center" class="inTxtNormal"><input name="mgmcertification[]" type="checkbox" value="HACCP" <?PHP if ($resmail1 == "HACCP") { ?>checked="checked" <?PHP } ?> /></td>
                          <td width="52%" class="inTxtNormal">HACCP</td>
                          <td width="8%" align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="ISO 17799" <?PHP if ($resmail6 == "ISO 17799") { ?>checked="checked" <?PHP } ?> /></td>
                          <td width="29%" class="inTxtNormal">ISO 17799 </td>
                        </tr>
                        <tr>
                          <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="ISO 9000/9001/9004/19001:200" <?PHP if ($resmail2 == "ISO 9000/9001/9004/19001:200") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">ISO 9000/9001/9004/19001:2000 </td>
                          <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="QHASA 18001" <?PHP if ($resmail7 == "QHASA 18001") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">OHASA 18001 </td>
                        </tr>
                        <tr>
                          <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="QS-9000" <?PHP if ($resmail3 == "QS-9000") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">QS-9000</td>
                          <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="TL 9000" <?PHP if ($resmail8 == "TL 9000") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">TL 9000 </td>
                        </tr>
                        <tr>
                          <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="ISO 14000/14001" <?PHP if ($resmail4 == "ISO 14000/14001") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">ISO 14000/14001 </td>
                          <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="Others" <?PHP if ($resmail9 == "Others") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">Others</td>
                        </tr>
                        <tr>
                          <td align="center" class="inTxtNormal"><input type="checkbox" name="mgmcertification[]" value="SA80000" <?PHP if ($resmail5 == "SA80000") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">SA80000</td>
                          <td colspan="2" align="center" class="inTxtNormal">&nbsp;</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="blackBo">Contact Manufacturing </td>
                    <td align="center" class="blackBo">:</td>
                    <td class="bluebold">
                      <table width="100%" border="0">
                        <tr>
                          <?PHP
                          $manufact = $row_ed['contactmant'];
                          $manufacture = explode(",", $manufact);
                          $manufact1 = $manufacture[0];
                          $manufact2 = $manufacture[1];
                          $manufact3 = $manufacture[2];
                          ?>
                          <td width="11%" align="center" class="inTxtNormal"><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="OEM Service Offered" <?PHP if ($manufact1 == "OEM Service Offered") { ?>checked="checked" <?PHP } ?> /></td>
                          <td width="39%" class="inTxtNormal">OEM Service Offered </td>
                          <td width="7%" align="center" class="inTxtNormal"><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="buyer Label Offered" <?PHP if ($manufact3 == "buyer Label Offered") { ?>checked="checked" <?PHP } ?> /></td>
                          <td width="43%" class="inTxtNormal">Buyer Label Offered </td>
                        </tr>
                        <tr>
                          <td align="center" class="inTxtNormal"><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="Design Service Offered" <?PHP if ($manufact2 == "Design Service Offered") { ?>checked="checked" <?PHP } ?> /></td>
                          <td class="inTxtNormal">Design Service Offered </td>
                          <td colspan="2" align="center" class="inTxtNormal">&nbsp;</td>
                        </tr>
                      </table>
                    </td>
                  </tr>


                  <?php
                  $videos = $row_ed['videos'];
                 
                                    
                  ?>

                  <tr>
                    <td width="47%" align="right" class="blackBo">Videos (Enter YouTube video URL) </td>
                    <td width="4%" align="center" class="blackBo">:</td>
                    <td width="49%" class="bluebold">
                      <input type="url" name="videos" value="<?=$videos?>">
                    </td>
                  </tr>

                  <tr>
                    <td height="40" colspan="3" align="center">
                      <!--<input name="Editsubmit" type="submit"  value="Submit" onClick="return ValidateForm1();" />-->
                      <input name="Editsubmit" type="submit" value="Submit" />
                      &nbsp;&nbsp;<input type="submit" name="Submit" value="Cancel" onclick="javascript:history.back();" /> </td>
                  </tr>
                </table>
              </form>
            </td>
          </tr>
        </table>


        
      </div><!-- end of #tab1 -->
    </div>
    </div><!-- end of .tab_container -->
  </article><!-- end of content manager article -->
  <div class="clear"></div>
  <div class="spacer"></div>
</section>


<link href="css/basic.min.css" rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>


<script>
  list_image();
  Dropzone.options.dropzoneFrom = {
    autoProcessQueue: true,
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    init: function() {
      var submitButton = document.querySelector('#submit-all');
      myDropzone = this;
      submitButton.addEventListener("click", function() {
        myDropzone.processQueue();
      });

      this.on('sending', function(file, xhr, formData) {
        formData.append('company_id', <?= $_REQUEST['id'] ?>);
      });

      this.on("complete", function() {
        if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
          var _this = this;
          _this.removeAllFiles();
        }
        list_image();
      });
    },
  };



  function list_image() {
    $.ajax({
      url: "<?=$baseUrl ?>upload.php?company_id=<?= $_REQUEST['id'] ?>",
      success: function(data) {
        $('#preview').html(data);
      }
    });
  }

  $(document).on('click', '.remove_image', function() {
    var name = $(this).attr('id');
    $.ajax({
      url: "<?=$baseUrl ?>upload.php",
      method: "POST",
      data: {
        name: name
      },
      success: function(data) {
        list_image();
      }
    })
  });
</script>



<script>
  jQuery(document).ready(function() {
    jQuery('#videos').select2({
      tags: true
    });
  });
</script>
<style>
  .dropBoxContainer {
    position: relative;
  }

  .dropBoxContainer #dropzoneFrom {
    position: absolute;
  }


  .js-example-basic-multiple {
    width: 500px;
    height: 100px !important;
  }

  .select2-container--default .select2-selection--multiple {
    padding: 5px 0px 10px 5px;
  }

  /* The total progress gets shown by event listeners */
  #total-progress {
    opacity: 0;
    transition: opacity 0.3s linear;
  }

  /* Hide the progress bar when finished */
  #previews .file-row.dz-success .progress {
    opacity: 0;
    transition: opacity 0.3s linear;
  }

  /* Hide the delete button initially */
  #previews .file-row .delete {
    display: none;
  }

  /* Hide the start and cancel buttons and show the delete button */

  #previews .file-row.dz-success .start,
  #previews .file-row.dz-success .cancel {
    display: none;
  }

  #previews .file-row.dz-success .delete {
    display: block;
  }
</style>
</body>

</html>