<?php   
    SESSION_START();
    include('config.php');

    if (isset($_POST['addReviewBtn'])) {
        $userId = $_SESSION['user_login'];
        echo $userId;
        $pid = $_REQUEST['pid'];
        $review = $_REQUEST['add_review'];
        $rating = $_REQUEST['rating'];
        $id = $_GET['id'];
        $cid = $_GET['cid'];
        $scid = $_GET['scid'];

        $insertReview = mysqli_query($conn, "INSERT INTO rating_reviews SET userid='$userId', pid = '$pid', review = '" . $review . "', rating = '$rating'") or mysqli_error($con, "Can't insert review.");
        
        if ($_GET['type']=='product') {
            if ($insertReview) {
                header("location:../productcompanyinfo.php?id=$id&cid=$cid&scid=$scid&insertReview=yes");
            }else{
                var_dump($conn, $insertReview);
                header("location:../productcompanyinfo.php?id=$id&cid=$cid&scid=$scid&insertReview=no");
            }
        }
        else{
            if ($insertReview) {
                header("location:../servicecompanyinfo.php?id=$id&cid=$cid&scid=$scid&insertReview=yes");
            }else{
                header("location:../servicecompanyinfo.php?id=$id&cid=$cid&scid=$scid&insertReview=no");
            }
        }
    }
?>