<?php
include'../../config.php';
if (isset($_POST['add'])) {
    $title       = addslashes($_POST['title']);
    //$image       = addslashes($_POST['image']);
    $active      = addslashes($_POST['active']);
    $category_id = addslashes($_POST['category_id']);
    $content     = htmlspecialchars($_POST['content']);
    $date        = date('d F Y');
    $time        = date('H:i');

    $six = mt_rand(100000, 999999);
    
    $target_dir = "../../asset/img/feature/";
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

    $add = "INSERT INTO `feature_post` (category_id, title, image, content, date, time, active) VALUES ('$category_id', '$title', '$target_file1', '$content', '$date', '$time', '$active')";
    $sql = mysqli_query($connect, $add);
    
    $run      = mysqli_query($connect, "SELECT * FROM `settings`");
    $site     = mysqli_fetch_assoc($run);
    $from     = $site['email'];
    $sitename = $site['sitename'];
    
    $run3 = mysqli_query($connect, "SELECT * FROM `feature_post` WHERE title='$title'");
    $row3 = mysqli_fetch_assoc($run3);
    $id3  = $row3['id'];
    
    $run2 = mysqli_query($connect, "SELECT * FROM `newsletter`");
    while ($row = mysqli_fetch_assoc($run2)) {
        $emails = $row['email'];
        
        $to = $emails;
        
        $subject = $title;
        
        $message = '
<html>
<head>
  <title>' . $title . '</title>
</head>
<body>
  <center><a href="' . $site_url . '/feature_post.php?id=' . $id3 . '" title="Read more"><h2>' . $title . '</h2></a></center><br />
  <center><img src="' . $image . '" width="600px" height="350px"/></center><br />
  ' . html_entity_decode($content) . '
</body>
</html>
';
        
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        
        $headers .= 'To: ' . $emails . ' <' . $emails . '>' . "\r\n";
        $headers .= 'From: ' . $sitename . ' <' . $from . '>' . "\r\n";
        
        @mail($to, $subject, $message, $headers);
    }
    
    echo '<meta http-equiv="refresh" content="0;url=../feature_posts.php">';
}
?>