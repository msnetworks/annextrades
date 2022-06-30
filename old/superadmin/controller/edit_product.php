<?php 
    include('../../controller/config.php');
   /*  if(isset($_POST['submit']))
        { */
            
        $p_name= htmlspecialchars($_POST['p_name'], ENT_QUOTES);
        $p_keyword= htmlspecialchars($_POST['p_keyword'], ENT_QUOTES);

        $p_cat=$_POST['p_cat'];
        $p_subcategory=$_POST['subcategory'];
        $country=$_POST['country'];
        $p_photo=basename($_FILES['image']['name']);
        $p_bdes= htmlspecialchars($_POST['p_bdes'], ENT_QUOTES);
        $p_ddes= htmlspecialchars($_POST['p_ddes'], ENT_QUOTES);
        $p_price=$_POST['p_price'];
        $range1=$_POST['range1'];
        $range2=$_POST['range2'];
        $p_miniquantity=$_POST['p_miniquantity'];
        $p_quantity=$_POST['p_quantity'];
        $p_capacity=$_POST['p_capacity']; 
        $capacity=$_POST['capacity'];
        $time=$_POST['time'];
        $payment=$_POST['payment'];
        $aa=$_FILES['photo1']['name'];
        $bb=$_FILES['photo2']['name'];
        $cc=$_FILES['photo3']['name'];
        $dd=$_FILES['photo4']['name'];
        $ee=$_FILES['photo5']['name'];
        if($aa != "")
        {   
            $r = rand(100, 999);
            $newphoto1= $r.basename($_FILES["photo1"]["name"]);
            $target_dir = "../../productlogo/";
            $target_file = $target_dir . $r.basename($_FILES["photo1"]["name"]);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            move_uploaded_file($_FILES["photo1"]["tmp_name"], $target_file);
            $ftimages1 = "../../../blog_photo_thumbnail/".$r.$newphoto1;
            move_uploaded_file($_FILES["photo1"]["tmp_name"], $ftimages1);
            /* $thumb1= new EasyThumbnail($target_file, $ftimages1, 120); */
            //echo $ftimages1;

        }
        else
        {
        $newphoto1=$_POST['pho1'];
        }
        if($bb != '')
        {
            $s = rand(1000, 9999);
        $newphoto2= $s.basename($_FILES['photo2']['name']);
        $target_dir = "../../productlogo/";
        $target_file = $target_dir .$s. basename($_FILES["photo2"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        move_uploaded_file($_FILES["photo2"]["tmp_name"], $target_file);
        $ftimages2 = "../../blog_photo_thumbnail/".$s.$newphoto2;
        move_uploaded_file($_FILES["photo1"]["tmp_name"], $ftimages2);
        //echo $ftimages1;

        }
        else
        {
        $newphoto2=$_POST['pho2'];
        }
        if($cc != '')
        {
            $t = rand(10000, 99999);
            $newphoto3= $t.basename($_FILES['photo3']['name']);
                $target_dir = "../../productlogo/";
                $target_file = $target_dir .$t. basename($_FILES["photo3"]["name"]);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                move_uploaded_file($_FILES["photo3"]["tmp_name"], $target_file);
                $ftimages3 = "../../blog_photo_thumbnail/".$t.$newphoto3;
                move_uploaded_file($_FILES["photo1"]["tmp_name"], $ftimages3);
                /* $thumb3= new EasyThumbnail($target_file, $ftimages3, 120); */
                //echo $ftimages1;
        }
        else
        {
        $newphoto3=$_POST['pho3'];
        }
        if($dd != '')
        {
            $u = rand(100000, 999999);
            $newphoto4= $u.basename($_FILES['photo4']['name']);
                $target_dir = "../../productlogo/";
                $target_file = $target_dir .$u. basename($_FILES["photo4"]["name"]);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                move_uploaded_file($_FILES["photo4"]["tmp_name"], $target_file);
                $ftimages4 = "../../blog_photo_thumbnail/".$u. $newphoto4;
                move_uploaded_file($_FILES["photo1"]["tmp_name"], $ftimages4);
                //echo $ftimages1;

        }
        else
        {
        $newphoto4=$_POST['pho4'];
        }
        if($ee != '')
        {   
            $v= rand(1000000, 9999999);
            $newphoto5= $v.basename($_FILES['photo5']['name']);
                $target_dir = "../../productlogo/";
                $target_file = $target_dir .$v. basename($_FILES["photo5"]["name"]);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                move_uploaded_file($_FILES["photo5"]["tmp_name"],$target_file);
                $ftimages5 = "../../blog_photo_thumbnail/".$v.$newphoto5;
                move_uploaded_file($_FILES["photo5"]["tmp_name"], $ftimages5);
                //echo $ftimages1;
        }
        else
        {
        $newphoto5=$_POST['pho5'];
        }

        if($payment=='')
        {
        $p=$_POST['others'];
        }
        else
        {
        $p=$payment;
        }
        $pro_capacity=$p_capacity;
        //$range12=$_POST['range12'];
        $p_deliverytime=$_POST['p_deliverytime'];
        $p_packagedetails=mysqli_real_escape_string($conn, $_POST['description']);
        
        $date=date("Y.m.d");
        
        $hh=$_SESSION['hh'];
        $insertquery=$conn->query("UPDATE `product` SET `p_name` = '$p_name', `p_keyword` = '$p_keyword', `p_category` = '$p_cat', `p_subcategory`= '$p_subcategory',
        `country`='$country', `p_photo` = '$newphoto1', `p_bdes` = '$p_bdes', `p_ddes` = '$p_ddes', `p_price` = '$p_price', `range1` = '$range1',
        `range2` = '$range2', `paymenttype` ='$payment', `p_min_quanity` = '$p_miniquantity', `p_quanity_type` = '$p_quantity', `p_capaacity` = '$p_capacity',
        `p_ctype` = '$capacity', `percapacity` = 'time', `range12` = '', `p_delivertytime` = '$p_deliverytime', `p_packingdetails` = '$p_packagedetails', `udate` = '$date',expiredate='$expiredate',`status`='1',photo1='$newphoto1',photo2='$newphoto2',photo3='$newphoto3',photo4='$newphoto4',photo5='$newphoto5'
        WHERE `id` ='".@$_GET['product_id']."' "); 



        /* $q = mysqli_query($conn,$insertquery); */
        var_dump($conn,$insertquery);
        if ($insertquery) {
        
        $p_id = $_GET['product_id'];
        $cm_id = $_GET['id'];
            echo $conn->error;
            echo "<script>location.href ='../edit_newproduct.php?product_id=$p_id&id=$cm_id&msg=Success'</script>";
        }
        else {
            echo $conn->error;

            error_log();
           echo "<script>location.href ='../edit_newproduct.php?product_id=$p_id&id=$cm_id&msg=Failed'</script>";

        }
        /* } */

?>


