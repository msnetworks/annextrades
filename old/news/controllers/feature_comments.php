<?php
    include'../config.php';
    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $comment = $_POST['message'];
        $author  = $_POST['author'];
        $email  = $_POST['email'];
        $spam    = $_POST['dontfill'];
        
        $date = date('d F Y');
        $time = date('H:i');
        
        if (strlen($comment) < 2) {
            echo '<div class="alert alert-danger">Your comment is too short</div>';
        } else {
            if (strlen($author) < 2) {
                echo '<div class="alert alert-warning">Your name is too short</div>';
            } else {
                if ($spam) { // Honeypot - Stop spam bots
                    echo '<div class="alert alert-danger">Spam comment has not been posted</div>';
                    exit("Spam Detected!");
                } else {
                    $runq = mysqli_query($connect, "INSERT INTO `feature_comments` (post_id, `comment`,author,email, date, time) VALUES ('$id', '$comment', '$author','$email', '$date', '$time')");
                    //  var_dump($connect, $runq);
                    if ($runq) {
                        echo "<script>location.href='../feature_details.php?id=$id&action=Success';</script>";
                    }
                    else {
                        echo "<script>location.href='../feature_details.php?id=$id&action=Failed';</script>";
                    }
                }
            }
        }
    }
?>