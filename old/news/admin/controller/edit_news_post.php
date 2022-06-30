
<?php
include'../../config.php';
if (isset($_POST['submit'])) {
    $id = addslashes($_POST['id']);
    $title       = addslashes($_POST['title']);
    $active      = addslashes($_POST['active']);
    $category_id = addslashes($_POST['category_id']);
    $source_url = addslashes($_POST['source_url']);
    $sort_summary = addslashes($_POST['sort_summary']);
    $content     = htmlspecialchars($_POST['content']);
    
    $a = basename($_FILES["image"]["name"]);
    
    if($a !=''){
    
    $six = mt_rand(100000, 999999);
    
    $target_dir = "../../asset/img/news/";
    $target_file =  $target_dir. $six . basename($_FILES["image"]["name"]);
    $target_file1 =  $six . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 2000000) {
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
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
        }else{
            $target_file1 = $_POST["image1"];
        }
        $img = $target_file1;
    $edit = "UPDATE posts SET title='$title', active='$active', image = '$img', category_id='$category_id', source_url='$source_url' , sort_summary='$sort_summary', content='$content' WHERE id='$id'";
        $sql  = mysqli_query($connect, $edit);
    if($sql){
        
        echo '<meta http-equiv="refresh" content="0;url=../news_posts.php?msg=Success">';
        }
        else{
        echo '<meta http-equiv="refresh" content="0;url=../news_posts.php?msg=Failed">';

            echo $connect->errno;
        }
}
?>