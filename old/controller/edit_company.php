<?php 

include('config.php');

if (isset($_REQUEST['Editsubmit'])) {
    
    $userId = $_GET['id'];
    
    $Companyname = $_REQUEST['companyname'];
     $Companymail = $_REQUEST['companymail'];
    $Bussinesstype = $_REQUEST['bussiness_type'];
    $P_service = $_REQUEST['P_service'];
    $Companyaddress = $_REQUEST['company_address'];
    $URL = $_REQUEST['url'];
    $Companydetails = htmlspecialchars($_REQUEST['company_details'], ENT_QUOTES);
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
    $img = $_FILES["companylogo"]["name"];
    //$response = $img;
    if ($img != "") {
        
        $six = mt_rand(100000, 999999);
        
        $target_dir = "../company_images/";
        $target_file =  $target_dir. $six . basename($_FILES["companylogo"]["name"]);
        $target_file1 =  $six . basename($_FILES["companylogo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        
        $check = getimagesize($_FILES["companylogo"]["tmp_name"]);
        if($check !== false) {
            /* echo "File is an image - " . $check["mime"] . "."; */
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["companylogo"]["size"] > 2000000) {
        //echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["companylogo"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["companylogo"]["name"]). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
            print_r(error_get_last()); 
        }
        }
    }
    else{
        $target_file1 = $_POST['logo'];
    }
    /* $Companylogo = basename($_FILES['companylogo']['name']);
    $logo = $_POST['logo'];
    if ($Companylogo == "") {
        $Photo = $logo;
    } else {
        $an = rand(100000, 999999);
        $Photo = $an.$Companylogo;
        $uploaddir = '../company_images/';
        $uploadfile = $uploaddir .$an. $Companylogo;
        $imagename = $an.$_FILES['companylogo']['tmp_name'];
        if (move_uploaded_file($imagename, $uploadfile)) {
            echo "uploaded successfully";
        } else {
            print_r(error_get_last()); 
            echo "error";
        }
    } */
    
    /* Video & Photos */
    $videos = $_REQUEST['videos'];
    
    //exit();
    
    /* Video & Photos */
    
    
    
    $ck = mysqli_query($conn, "SELECT user_id FROM companyprofile WHERE user_id = '$userId'");
    
    $check = mysqli_num_rows($ck);
    
    $update_reg = "UPDATE `registration` SET `companyname` ='$Companyname' WHERE `user_id` ='$userId'";
    $update_reg_query = mysqli_query($conn, $update_reg);
    
        if ($check != NULL) {
            $updatesql =  "UPDATE `companyprofile` set
            `companyname`='$Companyname',
            `mailid`='$Companymail',
            `bussiness_type`='$Bussinesstype',
            `P_service`='$P_service' ,
            `company_address`='$Companyaddress' ,
            `companylogo`= '$target_file1',
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
            
            $up_query = mysqli_query($conn, $updatesql);

            if ($up_query) {
                $qry = $conn->query("UPDATE registration SET photo = '$target_file1' WHERE id = '$userId'");
                echo $Photo;
                var_dump($up_query);
                
                 header('location:../add_company.php?succ'); 
            }
            else{
                var_dump($upquery);
            }
        }else{
            $insertsql =  "INSERT INTO `companyprofile` set
            `user_id`='$userId',
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
            `contactmant`='$contactmant1'";
            
            /* $in_query = mysqli_query($conn, $insertsql); */
            if ($conn->query($insertsql)) {
                echo '1';
               // header('location:../add_company.php');
            }
            else{
                /* echo '123'; */
                print_r($conn -> error_list);
                echo("Errorcode: " . $conn -> errno);
                echo("Error description: " . $conn -> error);
                var_dump($conn, $insertsql); 
              //  header('location:../add_company.php');
            }
            $mysqli -> close();
        }
    }

?>