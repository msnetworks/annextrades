<?php
include('../config.php');

$vendor_id=$_POST['vendor_id'];
$usr_id =$_POST['usr_id'];
$p_name =  $_POST['p_name'];

$quantities = $_POST['quantity'];
$p_quantity = $_POST['p_quantity'];

$prices =  $_POST['p_price'];
$prices1 =  $_POST['p_price1'];
$pdes =  $_POST['product_des'];
//$response = count($usr_id);
$count = count($usr_id);
$p = $_POST['p'];
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];
$p3 = $_POST['p3'];
$p4 = $_POST['p4'];
$file_name = $_FILES['photo']['name'];
$file_name1 = $_FILES['photo1']['name'];
$file_name2 = $_FILES['photo2']['name'];
$file_name3 = $_FILES['photo3']['name'];
$file_name4 = $_FILES['photo4']['name'];

for($i=0;$i<$count;$i++)
   {
    $p_des = htmlspecialchars($pdes[$i], ENT_QUOTES);
    //-----------Product Umage 1---------------
        if ($file_name[$i] != "") {
            $a1 = rand(10000, 99999);
            $imageFileType = strtolower(pathinfo($file_name[$i],PATHINFO_EXTENSION));
            $image1 = $a1.$file_name[$i];
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }else{ 
                
            $sourcePath = $_FILES['photo']['tmp_name'][$i];  
            $targetPath = "../../productlogo/".$image1;

            if(move_uploaded_file($sourcePath, $targetPath))  
            {  
                echo "Uploaded";
            }                
            $save = "../../productlogo/".$image1;   //This is the new file you saving
            $file = "../../productlogo/".$image1;   //This is the original file
            }
            print_r(error_get_last()); 
        }
        else{
            $image1 = $p[$i];
        }
   //-----------Product Umage 2---------------
       if ($file_name1[$i] != "") {
          
           $a2 = rand(10000, 99999);
           $imageFileType = strtolower(pathinfo($file_name1[$i],PATHINFO_EXTENSION));
           $image2 = $a2.$file_name1[$i];
           // Allow certain file formats
           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
           echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
           }else{ 
               
           $sourcePath = $_FILES['photo1']['tmp_name'][$i];  
           $targetPath = "../../productlogo/".$image2;

           if(move_uploaded_file($sourcePath, $targetPath))  
           {  
              // echo "Uploaded";
           }                
           $save = "../../productlogo/".$image2;   //This is the new file you saving
           $file = "../../productlogo/".$image2;   //This is the original file
           } 
           print_r(error_get_last()); 
       }
        else{
            $image2 = $p1[$i];
        }
   //-----------Product Umage 3---------------
       if ($file_name2[$i] != "") {
           $a3 = rand(10000, 99999);
           $imageFileType = strtolower(pathinfo($file_name2[$i],PATHINFO_EXTENSION));
           // Allow certain file formats
           $image3 = $a3.$file_name2[$i];
           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
           echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
           }else{ 
               
           $sourcePath = $_FILES['photo2']['tmp_name'][$i];  
           $targetPath = "../../productlogo/".$image3;

           if(move_uploaded_file($sourcePath, $targetPath))  
           {  
               echo "Uploaded";
           }                
           $save = "../../productlogo/".$image3;   //This is the new file you saving
           $file = "../../productlogo/".$image3;   //This is the original file
           }
           print_r(error_get_last()); 
       } 
       else{
            $image3 = $p2[$i];
        }
   //-----------Product Umage 4---------------
        if ($file_name3[$i] != "") {
            $a4 = rand(10000, 99999);
            $imageFileType = strtolower(pathinfo($file_name3[$i],PATHINFO_EXTENSION));
            $image4 = $a4.$file_name3[$i];
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }else{ 
                
            $sourcePath = $_FILES['photo3']['tmp_name'][$i];  
            $targetPath = "../../productlogo/".$image4;

            if(move_uploaded_file($sourcePath, $targetPath))  
            {  
                echo "Uploaded";
            }                
            $save = "../../productlogo/".$image4;   //This is the new file you saving
            $file = "../../productlogo/".$image4;   //This is the original file
            } 
            print_r(error_get_last()); 
        }
        else{
            $image4 = $p3[$i];
        }
        
   //-----------Product Umage 5---------------
       if ($file_name4[$i] != "") {
           $a5 = rand(10000, 99999);
           $imageFileType = strtolower(pathinfo($file_name4[$i],PATHINFO_EXTENSION));
           $image5 = $a5.$file_name4[$i];
           // Allow certain file formats
           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
           echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
           }else{ 
           $sourcePath = $_FILES['photo4']['tmp_name'][$i];  
           $targetPath = "../../productlogo/".$image5;
           //$compressedImage = compressImage($imageTemp, $imageUploadPath, 75); 
           if(move_uploaded_file($sourcePath, $targetPath))  
           {  
               echo "Uploaded";
           }                
           $save = "../../productlogo/".$image5;   //This is the new file you saving
           $file = "../../productlogo/".$image5;   //This is the original file
           }    
           print_r(error_get_last()); 
       }
       else{
        $image5 = $p4[$i];
        }
        //print_r(error_get_last()); 
        $p_des = htmlspecialchars($pdes[$i], ENT_QUOTES);
        $p_name = htmlspecialchars($p_name[$i], ENT_QUOTES);
        $update= $con->query("UPDATE product SET p_name = '$p_name', p_keyword = '$p_name', p_min_quanity = '$quantities[$i]',p_quanity_type= '$p_quantity[$i]', range1 = '$prices[$i]', range2 = '$prices1[$i]', p_ddes = '$p_des', p_photo = '$image1', photo1 = '$image1', photo2 = '$image2', photo3 = '$image3', photo4 = '$image4', photo5 = '$image5' WHERE id = '$usr_id[$i]'");
        
    }
    $response = "Update Successfully";
    echo json_encode($response);
   //echo "<script>location.href='../index.php?vendor_id=$vendor_id&edit=Success';</script>";

?>