<?php 
    include("config.php");
    $query2=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='".$_GET['vendor_id']."' ");
        $row_adv2=mysqli_fetch_array($query2);
    $query3=mysqli_query($conn, "SELECT * FROM `country` WHERE country_id='".$row_adv2['country']."' ");
    $row_adv3=mysqli_fetch_array($query3);

    $companyname = $row_adv2['companyname'];
    $contactperson = $row_adv2['firstname']." ".$row_adv2['lastname'];
    $email = $row_adv2['email'];
    $image = $row_adv2['photo'];
    $address = $row_adv2['street'];
    $city = $row_adv2['city'];
    $state = $row_adv2['state'];
    $pin = $row_adv2['zipcode'];
    $country = $row_adv3['country_name'];
    $userprofile = "
        <div class='row'>
            <div class='col-md-6'>
                <div class='row'>
                    <div class='col-md-6'>Company Name: </div>
                    <div class='col-md-6'>$companyname</div>
                    <div class='col-md-6'>Contact Person: </div>
                    <div class='col-md-6'>$contactperson</div>
                    <div class='col-md-6'>Email: </div>
                    <div class='col-md-6'>$email</div>
                </div>
            </div>
            <div class='col-md-6 text-right'><img style='width: 150px; height: 150px;' src='https://annextrades/company_logo/$image' alt=''></div>
            <div class='col-md-12'>
                <div class='row'>
                    <div class='col-md-3'>
                    Address
                    </div>
                    <div class='col-md-9'>
                        $address
                    </div>
                </div>
            </div>
        </div>
    ";
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: text/html; charset=utf-8");
    header("Content-Type: application/json");
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//$product = 'Working MS';
echo json_encode($userprofile);
?>