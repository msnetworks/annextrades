<?php
    @session_start();
    ob_start();
    
  
    include('config.php');
    include("easythumbnail.class.php");
    if(isset($_POST['submit']))
    {
        $userid = $_POST['userid'];
        $p_name=$_POST['p_name'];
        $p_keyword=$_POST['p_keyword'];
        
        if($_POST['p_cat1']==394)
        {
            $p_cat=$_POST['p_cat1'];
        }
        else
        {
            $p_cat=$_POST['p_cat'];
        }
        
            $p_subcategory=$_POST['subcategory'];
            $country=$_POST['country'];
            $p_bdes= htmlspecialchars($_POST['p_bdes'], ENT_QUOTES);
            $p_ddes= htmlspecialchars($_POST['detail_description'], ENT_QUOTES);
            $p_price=$_POST['p_price'];
            $range1=$_POST['range1'];
            $range2=$_POST['range2'];
            $p_miniquantity=$_POST['p_miniquantity'];
            $p_quantity=$_POST['p_quantity'];
            $p_capacity=$_POST['p_capacity'];
            $capacity=$_POST['capacity'];
            $time=$_POST['time'];
            $payment=$_POST['payment'];
            $p_photo=basename($_FILES['image']['name']);
            echo $p_photo;
            $lang_status='0';
            
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
            $p_deliverytime=$_POST['p_deliverytime']." ".$_POST['time1'];
            $p_packagedetails=mysqli_real_escape_string($con, $_POST['description']);
            
            $date=date("Y.m.d");
            
            $hh=$_SESSION['hh'];
            
            $newfilename1=basename($_FILES['clg_0']['name']); 
            $uploaddir1='../productlogo/';
            $uploadfile1=$uploaddir1 . $newfilename1;
            move_uploaded_file($_FILES['clg_0']['tmp_name'], $uploadfile1);
            $ftimages1 = "../blog_photo_thumbnail/".$newfilename1;
            $thumb1= new EasyThumbnail($uploadfile1, $ftimages1, 120);

            echo $newfilename1;

            @$ftmp2 = $_FILES['clg_1']['tmp_name'];
            @$oname2 = $_FILES['clg_1']['name'];
            @$fname2 = $_FILES['clg_1']['name'];
            $fsize2 = $_FILES['clg_1']['size'];
            $ftype2 = $_FILES['clg_1']['type'];
            $date2 =date("Y.m.d");
            $newfilename2=basename($_FILES['clg_1']['name']);
            $uploaddir2='../productlogo/';
            $uploadfile2=$uploaddir2 . $newfilename2;
            move_uploaded_file($_FILES['clg_1']['tmp_name'], $uploadfile2);
            $ftimages2 = "../blog_photo_thumbnail/".$newfilename2;
            $thumb2= new EasyThumbnail($uploadfile2, $ftimages2, 120);
            
            @$ftmp3 = $_FILES['clg_2']['tmp_name'];
            @$oname3 = $_FILES['clg_2']['name'];
            @$fname3 = $_FILES['clg_2']['name'];
            $fsize3= $_FILES['clg_2']['size'];
            $ftype3 = $_FILES['clg_2']['type'];
            $date3 =date("Y.m.d");
            $newfilename3=basename($_FILES['clg_2']['name']); 
            $uploaddir3='../productlogo/';
            $uploadfile3=$uploaddir3 . $newfilename3;
            move_uploaded_file($_FILES['clg_2']['tmp_name'], $uploadfile3);
            $ftimages3 = "../blog_photo_thumbnail/".$newfilename3;
            $thumb3= new EasyThumbnail($uploadfile3, $ftimages3, 120);
            
            @$ftmp4 = $_FILES['clg_3']['tmp_name'];
            @$oname4 = $_FILES['clg_3']['name'];
            @$fname4 = $_FILES['clg_3']['name'];
            $fsize4= $_FILES['clg_3']['size'];
            $ftype4 = $_FILES['clg_3']['type'];
            $date4 =date("Y.m.d");
            $newfilename4=basename($_FILES['clg_3']['name']);
            $uploaddir4='../productlogo/';
            $uploadfile4=$uploaddir4 . $newfilename4;
            move_uploaded_file($_FILES['clg_3']['tmp_name'], $uploadfile4);
            $ftimages4 = "../blog_photo_thumbnail/".$newfilename4;
            $thumb4= new EasyThumbnail($uploadfile4, $ftimages4, 120);

            @$ftmp5 = $_FILES['clg_4']['tmp_name'];
            @$oname5 = $_FILES['clg_4']['name'];
            @$fname5 = $_FILES['clg_4']['name'];
            $fsize5= $_FILES['clg_4']['size'];
            $ftype5 = $_FILES['clg_4']['type'];
            $date5 =date("Y.m.d");
            $expiredate = date('Y.m.d', strtotime("+30 days"));
            $newfilename5=basename($_FILES['clg_4']['name']);
            $uploaddir5='../productlogo/';
            $uploadfile5=$uploaddir5 . $newfilename5;
            move_uploaded_file($_FILES['clg_4']['tmp_name'], $uploadfile5);
            $ftimages5 = "../blog_photo_thumbnail/".$newfilename5;
            $thumb5= new EasyThumbnail($uploadfile5, $ftimages5, 120);
            
            $insertquery=$conn->query("INSERT INTO `product` (`userid` , `p_name` , `p_keyword` , `p_category` ,`p_subcategory`,`country`,`p_photo`, `p_bdes` , `p_ddes` , `p_price` , `range1` , `range2` ,`paymenttype` ,`p_min_quanity` , `p_quanity_type` , `p_capaacity` , `p_ctype` , `percapacity` , `range12` , `p_delivertytime` , `p_packingdetails` ,`udate`,`expiredate`,`status`,`photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`lang_status`)
            VALUES ( '$userid', '$p_name', '$p_keyword', '$p_cat','$p_subcategory','$country','$newfilename1','$p_bdes', '$p_ddes', '$p_price', '$range1', '$range2','$p', '$p_miniquantity', '$p_quantity', '$pro_capacity', '$capacity', '$time', '', '$p_deliverytime', '$p_packagedetails'
            ,'$date','$expiredate','1','$newfilename1','$newfilename2','$newfilename3','$newfilename4','$newfilename5','$lang_status')"); 
            
            
            /* mysqli_query($con,$insertquery) or mysqli_error($con); */
            if ($insertquery) {
                /* echo 'ok'; */
                header("location:../my_products.php?suc");
            }
            else {
                /* var_dump($conn, $insertquery); */
                echo 'error';
            }
    }
?>