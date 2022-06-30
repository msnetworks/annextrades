<?php
    include('config.php');

    $vendor_id=mysqli_real_escape_string($conn, $_GET['vendor_id']);
    $companyname=mysqli_real_escape_string($conn, $_GET['companyname']);
    $address=mysqli_real_escape_string($conn, $_GET['street']);
    $city=mysqli_real_escape_string($conn, $_GET['city']);
    $zip=mysqli_real_escape_string($conn, $_GET['zipcode']);
    $city=mysqli_real_escape_string($conn, $_GET['city']);
    $state=mysqli_real_escape_string($conn, $_GET['state']);
    $country=mysqli_real_escape_string($conn, $_GET['country']);
    $type=mysqli_real_escape_string($conn, $_GET['type']);
    $company_des = mysqli_real_escape_string($conn, $_GET['company_des'], ENT_QUOTES);

    $six = mt_rand(100000, 999999);
    
    $target_dir = "../company_image/";
    $target_file =  $target_dir. basename($_FILES["photo"]["name"]);
    $target_file1 =  basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["photo"]["tmp_name"]);
      if($check !== false) {
        /* echo "File is an image - " . $check["mime"] . "."; */
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 2000000) {
      echo "<script>alert('Sorry, your file is too large.')</script>";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
      } else {
        /* echo "Sorry, there was an error uploading your file.";
        print_r(error_get_last()); */
      }
    }
    
    $query = $conn->query("UPDATE registration SET companyname = '$companyname', street = '$address', city = '$city', state = '$state', zipcode = '$zip', country = '$country', photo = '$target_file1', type = '$type', company_des = '$company_des' WHERE vendor_id= '$vendor_id'");
    echo $conn->error;
    
    //$response = "success";
    //@header("Access-Control-Allow-Origin: *");
    //@header("location:https://annextrades.com/controller/companyinfo.php?vendor_id=$vendor_id&companyname=$companyname&street=$address&city=$city&state=$state&country=$country&zipcode=$zip&type=$type", true);
    
    echo "<script>location.href='https://annexis.net/registration/newreg.php?vendor_id=$vendor_id&companyinfo=Success';</script>";
    
?>