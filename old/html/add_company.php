<?php
include("includes/header.php");
?>
<?php

$http = $_SERVER['REQUEST_SCHEME'];
$host = $_SERVER['HTTP_HOST'];
$base_dir  = __DIR__;
$doc_root  = ($_SERVER["DOCUMENT_ROOT"]);
$base_url  = preg_replace("!^{$doc_root}!", '', $base_dir);
$baseUrl = $http . "://" . $host . $base_url . "/";

$userId = $_SESSION['user_login'];

$userInfo = mysqli_query($con, "SELECT * from companyprofile where user_id='$userId'");


if (mysqli_num_rows($userInfo) < 1) {

    mysqli_query($con, "INSERT into companyprofile SET user_id =" . $userId);
?>
    <script>
        /* location.reload(); */
    </script>
<?php

}
if (isset($_REQUEST['Editsubmit'])) {
    $Companyname = $_REQUEST['companyname'];
     $Companymail = $_REQUEST['companymail'];
    $Bussinesstype = $_REQUEST['bussiness_type'];
    $P_service = $_REQUEST['P_service'];
    $Companyaddress = $_REQUEST['company_address'];
    $URL = $_REQUEST['url'];
    $Companydetails = $_REQUEST['company_details'];
    $Year = $_REQUEST['year'];
    $Certification = $_REQUEST['certification'];
    $brand = $_REQUEST['brand'];
    $noofemployee = $_REQUEST['noofemployee'];
    $bussinessowner = $_REQUEST['bussinessowner'];
    $registeredcapital = $_REQUEST['registeredcapital'];
    $ownertype = $_REQUEST['ownertype'];
    //$mainmarkets=$_REQUEST['mainmarkets'];
    ///  mainmarket ////  
    $mainmarket = $_REQUEST['market'];
    for ($c = 0; $c < sizeof($mainmarket); $c++) {
        $Mainmarket = implode(',', $_REQUEST['market']);
    }
    ///////////////
    $maincustomer = $_REQUEST['maincustomer'];
    $toannualsalesvolume = $_REQUEST['toannualsalesvolume'];

    $exportpercentage = $_REQUEST['exportpercentage'];
    $toannualpurchasevolume = $_REQUEST['toannualpurchasevolume'];

    $factorysize = $_REQUEST['factorysize'];
    $factorylocation = $_REQUEST['factorylocation'];
    $qaqc = $_REQUEST['quali'];
    $noofprodlines = $_REQUEST['noofprodlines'];
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
    $update_reg = "UPDATE `registration` SET `companyname` ='$Companyname' WHERE `id` ='$userId'";
    $update_reg_query = mysqli_query($con, $update_reg);
    $updatesql =  "UPDATE `companyprofile` set
  `companyname`='$Companyname',
  `mailid`='$Companymail',
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
  `exportpercentage` = '$exportpercentage',
  `toannualpurchasevolume` = '$toannualpurchasevolume',
  `factorysize`='$factorysize',
  `factorylocation`='$factorylocation',
  `qa/qc`='$qaqc',
  `noofprodlines`='$noofprodlines',
  `noofr&dstaff`='$noofrdstaff',
  `noofqcstaff`='$noofqcstaff',
  `mgmtcertification`='$Mgmcertification',
  `videos` = '$videos',
  `contactmant`='$contactmant1' WHERE `user_id` ='$userId' ";
 
    $up_query = mysqli_query($con, $updatesql);
}

$companyInfo = mysqli_fetch_array(mysqli_query($con, "select * from  companyprofile where  user_id='$userId'"));

?>
<script type="text/javascript">
    function ValidateForm() {
        //alert("hai"); 
        var bussiness_type = document.addcompanydetails.bussiness_type.value;
        var P_service = document.addcompanydetails.P_service.value;
        var company_address = document.addcompanydetails.company_address.value;
        var companylogo = document.addcompanydetails.companylogo.value;
        var url = document.addcompanydetails.url.value;


        if (bussiness_type == "") {
            alert("Please Enter Bussiness Type ");
            document.addcompanydetails.bussiness_type.focus();
            return false
        }
        if (P_service == "") {
            alert("Please Enter Your Service ");
            document.addcompanydetails.P_service.focus();
            return false
        }
        if (company_address == "") {
            alert("Please Enter Company Address");
            document.addcompanydetails.company_address.focus();
            return false
        }
        if (companylogo == "") {
            alert("Please Upload Company Logo");
            document.addcompanydetails.companylogo.focus();
            return false
        }

        var fnam = document.addcompanydetails.companylogo.value;
        var splt = fnam.split('.');
        var chksplt = splt[1].toLowerCase();

        if (chksplt == 'jpg' || chksplt == 'jpeg' || chksplt == 'gif') {} else {
            alert(" Upload Image with extensions only jpg, jpeg ");
            return false;
        }

        if (document.addcompanydetails.brand.value == "") {
            alert("Please Enter The Brand Name");
            document.addcompanydetails.brand.focus();
            return false;
        }

        if (document.addcompanydetails.noofemployee.value == "") {
            alert("Please Enter The No. of Employees");
            document.addcompanydetails.noofemployee.focus();
            return false;
        }
        if (url == "") {
            alert("Please Enter Company URL");
            document.addcompanydetails.url.focus();
            return false
        }
        var tomatch = /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/
        if (tomatch.test(url)) {

        } else {
            window.alert("Invalid. Try again. http://www.google.com");
            document.addcompanydetails.url.focus()
            return false;
        }

        if (document.addcompanydetails.year.value != "") {
            if (isNaN(document.addcompanydetails.year.value)) {
                alert("Please Enter the year in Numeric Form");
                document.addcompanydetails.year.focus()
                return false;
            }
            if ((document.addcompanydetails.year.value <= 0) || (document.addcompanydetails.year.value.length != 4)) {
                alert("Please Enter the year in YYYY Format");
                document.addcompanydetails.year.focus()
                return false;
            }
        }
    }
</script>

<?php
if (isset($_REQUEST['succ'])) { ?>
    <div style="padding-left:300px; color:#009900; font-weight:bold;"> Confirmation Mail Sent To Your Email </div>
<?php } ?>



<div class="body-cont">
    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>
            <div class="body-right">
                <?php include("includes/menu.php"); ?>
                <div class="tabs-cont">
                    <div class="left" style="border:1px solid #F0EFF0; border-radius:5px;">
                        <div class="bordersty">
                            <div class="headinggg"> Company Details </div>
                            <div class="input-group">
                                        <label><span style="color:#FF0000">*</span><span><?php echo $required_info; ?></span>
                                        </label>
                                    </div>
                           
                                <div class="input-group">
                                <h6>Images</h6>
                                   
                                    <div style="width: 200px; height: 200px;" class="dropBoxContainer">
                                        <form action="<?= $baseUrl ?>upload.php" class="dropzone" id="dropzoneFrom">
                                        </form>
                                    </div>
                                    <div align="center">
                                        <button style="visibility: hidden;" type="button" class="btn btn-info" id="submit-all">Upload</button>
                                    </div>
                                    <div class="container" id="preview"></div>
                                </div>


                            <form action="" name="profile_form" method="post" onSubmit="return validate1_form();">
                                <div class="p-2">
                                    <div>
                                        <?php echo $createcompanyprofile_add; ?>
                                    </div>


                                   
                                    <?php
                                    $sql = (mysqli_query($con, "select * from  registration where id='$session_user'"));
                                    $count = mysqli_num_rows($sql);
                                    $row = mysqli_fetch_array($sql);
                                    $cou = $row['country'];

                                    $sql_country = (mysqli_query($con, "select * from country where country_id='$cou'"));
                                    $row_country = mysqli_fetch_array($sql_country);
                                    $row_country['country_name'];
                                    ?>
                                    <div class="input-group">
                                        <h6><?php echo $country1; ?></h6>
                                        <div><?php echo $row_country['country_name']; ?></div>
                                    </div>

                                    <div class="input-group">

                                        <h6><span style="color:#FF0000">*</span><?php echo $company_name; ?>
                                        </h6>
                                        <input name="companyname" value="<?php echo  $companyInfo['companyname']; ?>" type="text" class="txtfield2_new" id="companyname" />
                                    </div>

                                    <div class="input-group">

                                        <h6><?php echo $bussiness_mail; ?></h6>
                                         <input name="companymail" value="<?php echo  $companyInfo['mailid']; ?>" type="text" class="txtfield2_new" id="companymail" />

                                       <!-- <div class="inTxtNormal"><?php echo $row['email']; ?></div> -->
                                    </div>
                                    <div class="input-group">

                                        <h6><span style="color:#FF0000">*</span><?php echo $bussiness_type; ?>
                                        </h6>

                                        <select name="bussiness_type" class="txtfield2_new" id="bussiness_type">
                                            <option value="">Select Type </option>
                                            <option value="manfacturer" <?php if ($companyInfo['bussiness_type'] == 'manfacturer') { ?> selected="selected" <?php } ?>>Manufacturer</option>
                                            <option value="trading company" <?php if ($companyInfo['bussiness_type'] == 'trading company') { ?> selected="selected" <?php } ?>>Trading Company </option>
                                            <option value="buying office" <?php if ($companyInfo['bussiness_type'] == 'buying office') { ?> selected="selected" <?php } ?>>Buying Office</option>
                                            <option value="distrubutor/wholesale" <?php if ($companyInfo['bussiness_type'] == 'distrubutor/wholesale') { ?> selected="selected" <?php } ?>>Distributor/Wholesale</option>
                                            <option value="goverment ministry" <?php if ($companyInfo['bussiness_type'] == 'overment ministry') { ?> selected="selected" <?php } ?>>Goverment Ministry </option>
                                            <option value="bissiness service" <?php if ($companyInfo['bussiness_type'] == 'bussiness service') { ?> selected="selected" <?php } ?>>Bussiness Service</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><span style="color:#FF0000">*</span>
                                            <?php echo $product_service; ?>
                                        </h6>

                                        <input name="P_service" value="<?php echo $companyInfo['P_service'];  ?>" type="text" class="txtfield2_new" id="P_service" />
                                        <div class="info"><?php echo $eg_product; ?></div>
                                    </div>
                                    <div class="input-group">

                                        <h6><span style="color:#FF0000">*</span><?php echo $com_address; ?>
                                        </h6>

                                        <input name="company_address" value="<?php echo $companyInfo['company_address'];  ?>" type="text" class="txtfield2_new" id="company_address" />
                                    </div>
                                    <div class="input-group">
                                        <h6><span style="color:#FF0000">*</span>
                                            <?php echo $com_logo; ?></h6>
                                        <input type="file" name="companylogo" id="companylogo" class="txtfield2_new" />
                                        <div class="info"><?php echo $eg_logo; ?></div>
                                    </div>
                                    <div class="input-group">

                                        <h6><span style="color:#FF0000">*</span><?php echo $brands; ?></h6>

                                        <input name="brand" value="<?php echo $companyInfo['brand'];  ?>" type="text" class="txtfield2_new" " />
                                        </div>
                                        <div class=" input-group">

                                        <h6><span style="color:#FF0000">*</span><?php echo $no_of_employers; ?>
                                        </h6>

                                        <select name="noofemployee" class="txtfield2_new" id="noofemployee">
                                            <option value="">Select Type </option>
                                            <option value="Less than 5 People" <?php if ($companyInfo['noofemployee'] == 'Less than 5 People') { ?> selected="selected" <?php } ?>>Less than 5 People</option>
                                            <option value="11 - 50 People" <?php if ($companyInfo['noofemployee'] == '11 - 50 People') { ?> selected="selected" <?php } ?>>11 - 50 People </option>
                                            <option value="51 - 100 People" <?php if ($companyInfo['noofemployee'] == '51 - 100 People') { ?> selected="selected" <?php } ?>>51 - 100 People</option>
                                            <option value="101 - 500 People" <?php if ($companyInfo['noofemployee'] == '101 - 500 People') { ?> selected="selected" <?php } ?>>101 - 500 People</option>
                                            <option value="501 - 1000 People" <?php if ($companyInfo['noofemployee'] == '501 - 1000 People') { ?> selected="selected" <?php } ?>>501 - 1000 People </option>
                                            <option value="Above 1000 People" <?php if ($companyInfo['noofemployee'] == 'Above 1000 People') { ?> selected="selected" <?php } ?>>Above 1000 People</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><span style="color:#FF0000">*</span><?php echo $com_url; ?></h6>

                                        <input  value="<?php echo $companyInfo['url'];  ?>" type="text" class="txtfield2_new" id="url" />
                                        <div class="info">eg.. http://www.you.com</div>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $company_intro; ?>
                                        </h6>

                                        <input name="company_details" value="<?php echo $companyInfo['company_details'];  ?>" type="text" class="txtfield2_new" id="company_details" />
                                        <div class="info"><?php echo $egg1; ?>... </div>
                                    </div>
                                    <div class="input-group">
                                        <h5><?php echo $ownership_capital; ?></h5>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $year_established; ?></h6>
                                        <input name="year" value="<?php echo $companyInfo['year'];  ?>" type="text" class="txtfield2_new" id="year" />
                                        <div class="info">eg.. 1985</div>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $bussiness_owner; ?></h6>

                                        <input name="bussinessowner" value="<?php echo $companyInfo['bussinessowner'];  ?>" type="text" class="txtfield2_new" id="bussinessowner" />
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $registerd_capital; ?></h6>

                                        <select name="registeredcapital" class="txtfield2_new" id="registeredcapital">
                                            <option value="">Select Type </option>
                                            <option value="Below US$100 Thousand" <?php if ($companyInfo['registeredcapital'] == 'Below US$100 Thousand') { ?> selected="selected" <?php } ?>>Below US$100 Thousand</option>
                                            <option value="US$101 - US$500 Thousand" <?php if ($companyInfo['registeredcapital'] == 'US$101 - US$500 Thousand') { ?> selected="selected" <?php } ?>>US$101 - US$500 Thousand </option>
                                            <option value="US$501 - US$1 Million" <?php if ($companyInfo['registeredcapital'] == 'US$501 - US$1 Million') { ?> selected="selected" <?php } ?>>US$501 - US$1 Million</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $ownership_type; ?></h6>

                                        <select name="ownertype" class="txtfield2_new" id="ownertype">
                                            <option value="">Select Type </option>
                                            <option value="Corporation/Linited Company" <?php if ($companyInfo['ownertype'] == 'Corporation/Linited Company') { ?> selected="selected" <?php } ?>>Corporation/Linited Company</option>
                                            <option value="Partner Ship" <?php if ($companyInfo['ownertype'] == 'Partner Ship') { ?> selected="selected" <?php } ?>>Partner Ship </option>
                                            <option value="Other" <?php if ($companyInfo['ownertype'] == 'Other') { ?> selected="selected" <?php } ?>>Other</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <h5><?php echo $trade_market; ?></h5>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $main_market; ?></h6>

                                        <?php
                                        $markets = $companyInfo['mainmarkets'];
                                        $mainmark = explode(",", $markets);

                                        ?>

                                        <div>
                                            <label><input name="market[]" type="checkbox" value="North America" <?PHP if (in_array("North America", $mainmark)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $north_america; ?></label>
                                            <label>
                                                <input name="market[]" type="checkbox" value="South America" <?PHP if (in_array("South America", $mainmark)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $south_america; ?>
                                            </label>
                                            <label>
                                                <input name="market[]" type="checkbox" value="Eastern Europe" <?PHP if (in_array("Eastern Europe", $mainmark)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $eastern_eroupe ?>
                                            </label>

                                            <label><input name="market[]" type="checkbox" value="Southeast Asia" <?PHP if (in_array("Southeast Asia", $mainmark)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $southeast_asia; ?></label>
                                            <label><input name="market[]" type="checkbox" value="Africa" <?PHP if (in_array("Africa", $mainmark)) { ?>checked="checked" <?PHP } ?> /> <?php echo $africa; ?></label>
                                            <label><input name="market[]" type="checkbox" value="Oceania" <?PHP if (in_array("Oceania", $mainmark)) { ?>checked="checked" <?PHP } ?> /> <?php echo $Oceania; ?></label>

                                            <label><input name="market[]" type="checkbox" value="Mid East" <?PHP if (in_array("Mid East", $mainmark)) { ?>checked="checked" <?PHP } ?> /> <?php echo $mid_east; ?></label>
                                            <label><input name="market[]" type="checkbox" value="Eastern Asia" <?PHP if (in_array("Eastern Asia", $mainmark)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $eastern_asia; ?></label>
                                            <label><input name="market[]" type="checkbox" value="Western Europe" <?PHP if (in_array("Western Europe", $mainmark)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $western_europe; ?></label>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <h6><?php echo $main_customer; ?></h6>
                                        <input name="maincustomer" value="<?php echo $companyInfo['maincustomer'];  ?>" type="text" class="txtfield2_new" id="maincustomer" />
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $tot_annual; ?></h6>

                                        <select name="toannualsalesvolume" class="txtfield2_new" id="toannualsalesvolume">
                                            <option value="">Please Select </option>
                                            <option value="Below US$1 Million" <?php if ($companyInfo['toannualsalesvolume'] == 'Below US$1 Million') { ?> selected="selected" <?php } ?>>Below US$1 Million</option>
                                            <option value="US$101 - US$500 Million" <?php if ($companyInfo['toannualsalesvolume'] == 'US$101 - US$500 Million') { ?> selected="selected" <?php } ?>>US$101 - US$500 Million </option>
                                            <option value="US$501 - US$1 Million" <?php if ($companyInfo['toannualsalesvolume'] == 'US$501 - US$1 Million') { ?> selected="selected" <?php } ?>>US$501 - US$1 Million</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6>Export Percentage </h6>

                                        <select name="exportpercentage" class="txtfield2_new" id="exportpercentage">
                                            <option value="">Please Select </option>
                                            <option value="1% - 10%" <?php if ($companyInfo['exportpercentage'] == '1% - 10%') { ?> selected="selected" <?php } ?>>1% - 10%</option>
                                            <option value="11% - 20%" <?php if ($companyInfo['exportpercentage'] == '11% - 20%') { ?> selected="selected" <?php } ?>>11% - 20% </option>
                                            <option value="21% - 30%" <?php if ($companyInfo['exportpercentage'] == '21% - 30%') { ?> selected="selected" <?php } ?>>21% - 30%</option>
                                            <option value="31% - 40%" <?php if ($companyInfo['exportpercentage'] == '31% - 40%') { ?> selected="selected" <?php } ?>>31% - 40%</option>
                                            <option value="41% - 50%" <?php if ($companyInfo['exportpercentage'] == '41% - 50%') { ?> selected="selected" <?php } ?>>41% - 50%</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $tot_annual_volume; ?></h6>

                                        <select name="toannualpurchasevolume" class="txtfield2_new" id="toannualpurchasevolume">
                                            <option value="">Please Select </option>
                                            <option value="Below US$1 Million" <?php if ($companyInfo['toannualpurchasevolume'] == 'Below US$1 Million') { ?> selected="selected" <?php } ?>>Below US$1 Million</option>
                                            <option value="US$101 - US$500 Million" <?php if ($companyInfo['toannualpurchasevolume'] == 'US$101 - US$500 Million') { ?> selected="selected" <?php } ?>>US$101 - US$500 Million </option>
                                            <option value="US$501 - US$1 Million" <?php if ($companyInfo['toannualpurchasevolume'] == 'US$501 - US$1 Million') { ?> selected="selected" <?php } ?>>US$501 - US$1 Million</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <h5><?php echo $factory_info; ?></h5>
                                    </div>
                                    <div class="input-group">
                                        <h6><?php echo $factory_size; ?></h6>

                                        <select name="factorysize" class="txtfield2_new" id="factorysize">
                                            <option value="">Please Select </option>
                                            <option value="Below 1000 Square meter" <?php if ($companyInfo['factorysize'] == 'Below 1000 Square meter') { ?> selected="selected" <?php } ?>>Below 1000 Square meter</option>
                                            <option value="1000 - 3000 Square meter" <?php if ($companyInfo['factorysize'] == '1000 - 3000 Square meter') { ?> selected="selected" <?php } ?>>1000 - 3000 Square meter </option>
                                            <option value="3000 - 5000 Square meter" <?php if ($companyInfo['factorysize'] == '3000 - 5000 Square meter') { ?> selected="selected" <?php } ?>>3000 - 5000 Square meter</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $factory_location; ?></h6>

                                        <input name="factorylocation" value="<?php echo $companyInfo['factorylocation'];  ?>" type="text" class="txtfield2_new" id="factorylocation" />
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $qa; ?></h6>

                                        <select name="quali" class="txtfield2_new" id="qa/qc">
                                            <option value="">Please Select </option>
                                            <option value="In House" <?php if ($companyInfo['qa/qc'] == 'In House') { ?> selected="selected" <?php } ?>>In House</option>
                                            <option value="Third Parties" <?php if ($companyInfo['qa/qc'] == 'Third Parties') { ?> selected="selected" <?php } ?>>Third Parties </option>
                                            <option value="No" <?php if ($companyInfo['qa/qc'] == 'No') { ?> selected="selected" <?php } ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $no_production_lines; ?></h6>

                                        <select name="noofprodlines" class="txtfield2_new" id="noofprodlines">
                                            <option value="">Please Select </option>
                                            <option value="1" <?php if ($companyInfo['noofprodlines'] == '1') { ?> selected="selected" <?php } ?>>1</option>
                                            <option value="2" <?php if ($companyInfo['noofprodlines'] == '2') { ?> selected="selected" <?php } ?>>2 </option>
                                            <option value="3" <?php if ($companyInfo['noofprodlines'] == '3') { ?> selected="selected" <?php } ?>>3</option>
                                            <option value="4" <?php if ($companyInfo['noofprodlines'] == '4') { ?> selected="selected" <?php } ?>>4</option>
                                            <option value="5" <?php if ($companyInfo['noofprodlines'] == '5') { ?> selected="selected" <?php } ?>>5 </option>
                                            <option value="6" <?php if ($companyInfo['noofprodlines'] == '6') { ?> selected="selected" <?php } ?>>6</option>
                                            <option value="7" <?php if ($companyInfo['noofprodlines'] == '7') { ?> selected="selected" <?php } ?>>7</option>
                                            <option value="8" <?php if ($companyInfo['noofprodlines'] == '8') { ?> selected="selected" <?php } ?>>8 </option>
                                            <option value="9" <?php if ($companyInfo['noofprodlines'] == '9') { ?> selected="selected" <?php } ?>>9</option>
                                            <option value="10" <?php if ($companyInfo['noofprodlines'] == '10') { ?> selected="selected" <?php } ?>>10</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $no_rd_staff; ?></h6>

                                        <select name="noofrdstaff" class="txtfield2_new" id="noofrdstaff">
                                            <option value="">Please Select </option>
                                            <option value="Less than 5 People" <?php if ($companyInfo['noofr&dstaff'] == 'Less than 5 People') { ?> selected="selected" <?php } ?>>Less than 5 People</option>
                                            <option value="5 - 10 People" <?php if ($companyInfo['noofr&dstaff'] == '5 - 10 People') { ?> selected="selected" <?php } ?>>5 - 10 People </option>
                                            <option value="11 - 20 People" <?php if ($companyInfo['noofr&dstaff'] == '11 - 20 People') { ?> selected="selected" <?php } ?>>11 - 20 People</option>
                                            <option value="21 - 30 People" <?php if ($companyInfo['noofr&dstaff'] == '21 - 30 People') { ?> selected="selected" <?php } ?>>21 - 30 People</option>
                                            <option value="31 - 40 People" <?php if ($companyInfo['noofr&dstaff'] == '31 - 40 People') { ?> selected="selected" <?php } ?>>31 - 40 People </option>
                                            <option value="41 - 50 People" <?php if ($companyInfo['noofr&dstaff'] == '41 - 50 People') { ?> selected="selected" <?php } ?>>41 - 50 People</option>
                                            <option value="51 - 60 People" <?php if ($companyInfo['noofr&dstaff'] == '51 - 60 People') { ?> selected="selected" <?php } ?>>51 - 60 People</option>
                                        </select>
                                    </div>
                                    <div class="input-group">

                                        <h6><?php echo $no_of_qc_staff; ?></h6>

                                        <select name="noofqcstaff" class="txtfield2_new" id="noofqcstaff">
                                            <option value="">Please Select </option>
                                            <option value="Less than 5 People" <?php if ($companyInfo['noofqcstaff'] == 'Less than 5 People') { ?> selected="selected" <?php } ?>>Less than 5 People</option>
                                            <option value="5 - 10 People" <?php if ($companyInfo['noofqcstaff'] == '5 - 10 People') { ?> selected="selected" <?php } ?>>5 - 10 People </option>
                                            <option value="11 - 20 People" <?php if ($companyInfo['noofqcstaff'] == '11 - 20 People') { ?> selected="selected" <?php } ?>>11 - 20 People</option>
                                            <option value="21 - 30 People" <?php if ($companyInfo['noofqcstaff'] == '21 - 30 People') { ?> selected="selected" <?php } ?>>21 - 30 People</option>
                                            <option value="31 - 40 People" <?php if ($companyInfo['noofqcstaff'] == '31 - 40 People') { ?> selected="selected" <?php } ?>>31 - 40 People </option>
                                            <option value="41 - 50 People" <?php if ($companyInfo['noofqcstaff'] == '41 - 50 People') { ?> selected="selected" <?php } ?>>41 - 50 People</option>
                                            <option value="51 - 60 People" <?php if ($companyInfo['noofqcstaff'] == '51 - 60 People') { ?> selected="selected" <?php } ?>>51 - 60 People</option>
                                        </select>
                                    </div>

                                    <?php

                                    $resmail = $companyInfo['mgmtcertification'];
                                    $pieces = explode(",", $resmail);
                                    ?>
                                    <div class="input-group">

                                        <h6><?php echo $managemrnt_certification; ?></h6>

                                        <div>
                                            <label><input name="mgmcertification[]" type="checkbox" id="mgmcertification" value="HACCP" <?PHP if (in_array('HACCP', $pieces)) { ?>checked="checked" <?PHP } ?> /> HACCP</label>
                                            <label><input type="checkbox" name="mgmcertification[]" value="ISO 17799" <?PHP if (in_array('ISO 17799', $pieces)) { ?>checked="checked" <?PHP } ?> />
                                                ISO 17799</label>
                                            <label><input type="checkbox" name="mgmcertification[]" value="ISO 9000/9001/9004/19001:200" <?PHP if (in_array('ISO 9000/9001/9004/19001:200', $pieces)) { ?>checked="checked" <?PHP } ?> /> ISO
                                                9000/9001/9004/19001:2000</label>

                                            <label><input type="checkbox" name="mgmcertification[]" value="QHASA 18001" <?PHP if (in_array('QHASA 18001', $pieces)) { ?>checked="checked" <?PHP } ?> /> OHASA 18001</label>
                                            <label><input type="checkbox" name="mgmcertification[]" value="QS-9000" <?PHP if (in_array('QS-9000', $pieces)) { ?>checked="checked" <?PHP } ?> />
                                                QS-9000</label>
                                            <label><input type="checkbox" name="mgmcertification[]" value="TL 9000" <?PHP if (in_array('TL 9000', $pieces)) { ?>checked="checked" <?PHP } ?> />
                                                TL 9000</label>

                                            <label><input type="checkbox" name="mgmcertification[]" value="ISO 14000/14001" <?PHP if (in_array('ISO 14000/14001', $pieces)) { ?>checked="checked" <?PHP } ?> /> ISO 14000/14001</label>
                                            <label><input type="checkbox" name="mgmcertification[]" value="Others" <?PHP if (in_array('Others', $pieces)) { ?>checked="checked" <?PHP } ?> />
                                                Others</label>
                                            <label><input type="checkbox" name="mgmcertification[]" value="SA80000" <?PHP if (in_array('SA80000', $pieces)) { ?>checked="checked" <?PHP } ?> />
                                                SA80000</label>
                                        </div>


                                    </div>
                                    <div class="input-group">
                                        <?PHP
                                        $manufact = $companyInfo['contactmant'];
                                        $manufacture = explode(",", $manufact);
                                        ?>
                                        <h6><?php echo $contract_manufacturing; ?></h6>
                                        <div>
                                            <label><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="OEM Service Offered" <?PHP if (in_array('OEM Service Offered', $manufacture)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $oem_services; ?></label>
                                            <label><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="Buyer Label Offered" <?PHP if (in_array('Buyer Label Offered', $manufacture)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $buyer_label_offered; ?></label>
                                            <label><input name="contactmfcr[]" type="checkbox" id="contactmfcr[]" value="Design Service Offered" <?PHP if (in_array('Design Service Offered', $manufacture)) { ?>checked="checked" <?PHP } ?> />
                                                <?php echo $design_service_offered; ?></label>
                                        </div>
                                    </div>

                                    <?php
                                   
                                    $videos = $companyInfo['videos'];
                                   
                                    ?>

                                    <div class="input-group">
                                        <h6>Videos (Enter YouTube video URL)</h6>
                                        <input type="url" name="videos" value="<?=$videos?>">
                                    </div>


                                    <div class="input-group">
                                        <input name="Editsubmit" class="search_bg" type="submit" id="Addsubmit123" value="<?php echo $submit; ?>" />

                                    </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

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
                formData.append('company_id', <?=$companyInfo['id'] ?>);
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
            url: "<?= $baseUrl ?>upload.php?company_id=<?= $companyInfo['id'] ?>",
            success: function(data) {
                $('#preview').html(data);
            }
        });
    }

    $(document).on('click', '.remove_image', function() {
        var name = $(this).attr('id');
        $.ajax({
            url: "<?= $baseUrl ?>upload.php",
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

<?php include("includes/footer.php"); ?>