<?php
    include('../config.php');

    $vendor_id=mysqli_real_escape_string($con, $_POST['vendor_id']);
    $userid=mysqli_real_escape_string($con, $_POST['userid']);
    $email=mysqli_real_escape_string($con, $_POST['email']);
    $type=mysqli_real_escape_string($con, $_POST['type']);
    $companyname=mysqli_real_escape_string($con, $_POST['companyname']);
    $address=mysqli_real_escape_string($con, $_POST['street']);
    $city=mysqli_real_escape_string($con, $_POST['city']);
    $zip=mysqli_real_escape_string($con, $_POST['zip']);
    $state=mysqli_real_escape_string($con, $_POST['state']);
    $country=mysqli_real_escape_string($con, $_POST['country1']);
    $company_des = mysqli_real_escape_string($con, htmlspecialchars($_POST['company_des'], ENT_QUOTES));
    $caddress = $address.", ".$city.", ".$state.", (".$zip.")";
    //echo $company_des;
    $img = $_FILES["photo"]["name"];
    //$response = $img;
    if ($img != "") {
        
        $six = mt_rand(100000, 999999);
        
        $target_dir = "../../company_images/";
        $target_file =  $target_dir. $six . basename($_FILES["photo"]["name"]);
        $target_file1 =  $six . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
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
        if ($_FILES["photo"]["size"] > 2000000) {
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
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
            print_r(error_get_last()); 
        }
        }
    }
    else{
        $target_file1 = $_POST['img'];
    }
    $query = $con->query("UPDATE registration SET companyname = '$companyname', company_des = '$company_des', street = '$address', state='$state', city = '$city', zipcode = '$zip', country = '$country', photo = '$target_file1' , type = '$type' WHERE vendor_id= '$vendor_id'");
    if ($query) {

        $chk = $con->query("SELECT * FROM companyprofile WHERE user_id = '$userid'");
        if (mysqli_num_rows($chk) > 0) {
            $query2 = $con->query("UPDATE companyprofile SET companyname = '$companyname', mailid='$email', P_service='$type', company_address = '$caddress', companylogo = '$target_file1',company_details = '$company_des' WHERE user_id = '$userid' ");
            
        }else{
            $query2 = $con->query("INSERT INTO companyprofile SET user_id = '$userid', companyname = '$companyname', mailid='$email', P_service='$type', company_address = '$caddress', companylogo = '$target_file1',company_details = '$company_des'");
        }
        //echo $con->error;
        
        $response = "Company Information Saved Succesfully";
        
        //echo json_encode($response);
        echo "<script>location.href='../index.php?vendor_id=$vendor_id';</script>"; 
         // @header("location:https://annextrades.com/controller/companyinfo.php?vendor_id=$vendor_id&companyname=$companyname&street=$address&city=$city&state=$state&country=$country&zipcode=$zip&type=$type&photo=$target_file1", true);
    }
    else {
        //echo $con->error;
        echo "<script>location.href='../index.php?companyinfo=Success';</script>";
    }
    
    
?>