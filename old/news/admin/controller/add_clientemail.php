<?php
include'../../config.php';


if (isset($_POST['add'])) {
    
    $email = $_POST['email'];

    $a = $connect->query("SELECT * FROM client_emails WHERE email = '$email' ");
    $b = mysqli_num_rows($a);

    if ($b == '0') {
        $c = $connect->query("INSERT INTO client_emails SET email = '$email' ");
        if ($c) {
            echo '<meta http-equiv="refresh" content="0;url=../add_clientemail.php?msg=Success">';
        }
        else {
            echo '<meta http-equiv="refresh" content="0;url=../add_clientemail.php?msg=Failed">';
        }
    }
    else {
        echo '<meta http-equiv="refresh" content="0;url=../add_clientemail.php?msg=EmailExist">';
    }
}
?>