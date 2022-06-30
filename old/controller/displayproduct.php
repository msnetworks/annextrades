<?php
include('config.php');
$product="";
            $query1=mysqli_query($conn, "SELECT * FROM product order by udate desc");
            WHILE($row_adv1=mysqli_fetch_array($query1)){
            $product_id = $row_adv1['id'];
            $productname = $row_adv1['p_name'];
            $quy1=mysqli_query($conn, "SELECT * FROM registration where id = '".$row_adv1['userid']."'");
            $rowv1=mysqli_fetch_array($quy1);
            $companyname = $rowv1['companyname'];
            $firstname = $rowv1['firstname'];
            $lastname = $rowv1['lastname'];
    $product.= "
    <tr>
        <td>$product_id</td>
        <td>$productname</td>
        <td>$companyname</td>
        <td>$firstname $lastname</td>
        <td>".$row_adv1['udate']."</td>
        <td>";
            if($row_adv1['status'] == '2') { 

        $product.= "<font color='#28a745' >Approved</font>";
            }
            elseif($row_adv1['status'] == '1') {
            
        $product.= "<font color='#dc3545' >Not Approved</font>";
            }else{ 
            $product.= "<font color='#dc3545' >Editing Required</font>";
            }
            $product.= " </td>
        <td><a href='productdetails?product_id=".$row_adv1['id']."' style='color: #d70404;'>View</a></td>
    </tr>";
    } 
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, HEAD, PUT, PATCH, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Authorization, X-Custom-Header');
    
    //$product = "Working MS";
    
    echo json_encode($product);
?>