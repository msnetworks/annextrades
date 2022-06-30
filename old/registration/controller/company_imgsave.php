    <?php
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
                echo "Sorry, there was an error uploading your file.";
                print_r(error_get_last()); 
            }
            }
        $query = $con->query("UPDATE registration SET  photo = '$target_file1' WHERE vendor_id= '".$_GET['vendor_id]."'");
        
    ?>