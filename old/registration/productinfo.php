<?php
echo "ok";
include('../../controller/config.php');

$vendor_id =mysqli_real_escape_string($conn, $_POST['vendor_id']);
$usr_id =mysqli_real_escape_string($conn, $_POST['usr_id']);
foreach (array('p_name', 'p_price', 'quantity', 'product_des', 'photo', 'photo1', 'photo2', 'photo3', 'photo4') as $pos) {
    foreach ($_POST[$pos] as $id => $row) {
        $_POST[$pos][$id] = mysqli_real_escape_string($conn, $row);
    }
}

$p_name =  $_POST['p_name'];
$quantities = $_POST['quantity'];
$prices =  $_POST['p_price'];
$p_des =  $_POST['product_des'];
$file_name = $_FILES['photo']['name'];
$file_name1 = $_FILES['photo1']['name'];
$file_name2 = $_FILES['photo2']['name'];
$file_name3 = $_FILES['photo3']['name'];
$file_name4 = $_FILES['photo4']['name'];

$items = array();

$size = count($p_name);

for($i = 0 ; $i < $size ; $i++){
    // Check for part id
    if (empty($p_name[$i]) || empty($quantities[$i]) || empty($prices[$i])|| empty($p_des[$i]) || empty($file_name[$i])|| empty($file_name1[$i])|| empty($file_name2[$i])|| empty($file_name3[$i])|| empty($file_name4[$i])) {
        continue;
    }

    
    //-----------Product Umage 1---------------
        $a1 = rand(10000, 99999);
        $imageFileType = strtolower(pathinfo($file_name[$i],PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }else{ 
            
        $sourcePath = $_FILES['photo']['tmp_name'][$i];  
        $targetPath = "../product_image/".$a1.$file_name[$i];

        if(move_uploaded_file($sourcePath, $targetPath))  
        {  
            echo "Uploaded";
        }                
        $save = "../product_image/".$a1.$file_name[$i];   //This is the new file you saving
        $file = "../product_image/".$a1.$file_name[$i];   //This is the original file
    }  
    //-----------Product Umage 2---------------
        $a2 = rand(10000, 99999);
        $imageFileType = strtolower(pathinfo($file_name1[$i],PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }else{ 
            
        $sourcePath = $_FILES['photo1']['tmp_name'][$i];  
        $targetPath = "../product_image/".$a2.$file_name1[$i];

        if(move_uploaded_file($sourcePath, $targetPath))  
        {  
            echo "Uploaded";
        }                
        $save = "../product_image/".$a2.$file_name1[$i];   //This is the new file you saving
        $file = "../product_image/".$a2.$file_name1[$i];   //This is the original file
    } 
    //-----------Product Umage 3---------------
        $a3 = rand(10000, 99999);
        $imageFileType = strtolower(pathinfo($file_name2[$i],PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }else{ 
            
        $sourcePath = $_FILES['photo2']['tmp_name'][$i];  
        $targetPath = "../product_image/".$a3.$file_name2[$i];

        if(move_uploaded_file($sourcePath, $targetPath))  
        {  
            echo "Uploaded";
        }                
        $save = "../product_image/".$a3.$file_name2[$i];   //This is the new file you saving
        $file = "../product_image/".$a3.$file_name2[$i];   //This is the original file
    } 
    //-----------Product Umage 4---------------
        $a4 = rand(10000, 99999);
        $imageFileType = strtolower(pathinfo($file_name3[$i],PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }else{ 
            
        $sourcePath = $_FILES['photo3']['tmp_name'][$i];  
        $targetPath = "../product_image/".$a4.$file_name3[$i];

        if(move_uploaded_file($sourcePath, $targetPath))  
        {  
            echo "Uploaded";
        }                
        $save = "../product_image/".$a4.$file_name3[$i];   //This is the new file you saving
        $file = "../product_image/".$a4.$file_name3[$i];   //This is the original file
    } 
    //-----------Product Umage 4---------------
        $a5 = rand(10000, 99999);
        $imageFileType = strtolower(pathinfo($file_name4[$i],PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }else{ 
            
        $sourcePath = $_FILES['photo4']['tmp_name'][$i];  
        $targetPath = "../product_image/".$a5.$file_name4[$i];

        if(move_uploaded_file($sourcePath, $targetPath))  
        {  
            echo "Uploaded";
        }                
        $save = "../product_image/".$a5.$file_name4[$i];   //This is the new file you saving
        $file = "../product_image/".$a5.$file_name4[$i];   //This is the original file
    }    
    //print_r(error_get_last()); 

    $items[] = array(
        "p_name"     => $p_name[$i], 
        "quantity"    => $quantities[$i],
        "p_price"       => $prices[$i],
        "product_des"      => $p_des[$i],
        "photo"          => $a1.$file_name[$i],
        "photo1"          => $a2.$file_name1[$i],
        "photo2"          => $a3.$file_name2[$i],
        "photo3"          => $a4.$file_name3[$i],
        "photo4"          => $a5.$file_name4[$i]
    );
    
    

if (!empty($items)) {
    $values = array();
    foreach($items as $item){
        $values[] = "('$usr_id','{$item['p_name']}', '{$item['quantity']}', '{$item['p_price']}', '{$item['product_des']}', '{$item['photo']}','{$item['photo']}', '{$item['photo1']}', '{$item['photo2']}', '{$item['photo3']}', '{$item['photo4']}')";
        
        }
    }

    $values = implode(", ", $values);

    $sql = "INSERT INTO product_temp (userid, p_name, p_min_quantity, range1, product_des, p_photo, photo1, photo2, photo3, photo4, photo5) VALUES  {$values} " ;
    $result = mysqli_query($conn, $sql );
    var_dump($result);
    if ($result) {
        echo "<script>location.href='../newreg.php?vendor_id=$vendor_id&productinfo=Success&companyinfo=Success';</script>";
        echo 'Successful inserts: ' . mysqli_affected_rows($conn);
    } else {
        echo 'query failed: ' . mysqli_error($conn);
    }
}