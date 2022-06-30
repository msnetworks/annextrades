<?php
include('config.php');
$data="";
        $query1=mysqli_query($conn, "SELECT * FROM registration order by id desc");
            WHILE($row_adv1=mysqli_fetch_array($query1)){
                $vendor_id = $row_adv1['vendor_id'];
                $firstname = $row_adv1['firstname'];
                $lastname = $row_adv1['lastname'];
                $usertype = $row_adv1['usertype'];
                $email = $row_adv1['email'];
$data.= "
    <tr>
        <td>$vendor_id</td>
        <td>$firstname $lastname</td>
        <td>$usertype</td>
        <td>$email</td>
        <td>";
        if($row_adv1['email_verify'] == 'Verified'){

            $data.= "<font color='#28a745' >Verified</font>";
        
        }else {
            $data.= "<font color='#dc3545'>Not Verified</font>";
            } 
            $data.= "</td>
        <td>".$row_adv1['password']."</td>
        <td>".$row_adv1['companyname']."</td>
        <td>".$row_adv1['phonenumber']."</td>
        <td>".$row_adv1['added_date']."</td>
        <td>".$row_adv1['expiry_date']."</td>
        <td>";
            if($row_adv1['payment'] == 'Yes') { 

        $data.= "<font color='#28a745' >Active</font>";
            }
            else {
            
        $data.= "<font color='#dc3545' >Not Active</font>";
            } 
        $data.= "</td>
        <td>".$row_adv1['payment']."</td>
        <td><a href='#user_profile.php?vendor_id='".$row_adv1['vendor_id']."' style='color: #d70404;'>View</a></td>
    </tr>";
    } 
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, HEAD, PUT, PATCH, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Authorization, X-Custom-Header');

//$data = "Working MS";
echo json_encode($data);


?>