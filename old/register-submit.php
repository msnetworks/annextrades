<?php 
  
$con = new mysqli("localhost","root","Annexis@123","annexis_directory");
	
// Check connection
if ($mysqli ->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
  //headers.append('Access-Control-Allow-Origin', 'https://annexis.net/registration/register-submit.php');
  //headers.append('Access-Control-Allow-Credentials', 'true');
/* include "language/english/language.php"; */
  $ip=$_SERVER['REMOTE_ADDR'];
     /* if(isset($_GET['submit']))
      
      {     */ header("Access-Control-Allow-Origin: *");
              $vendor_id=mysqli_real_escape_string($con, $_GET['vendor_id']);
              $package=mysqli_real_escape_string($con, $_GET['package']);
              $firstname=mysqli_real_escape_string($con, $_GET['firstname']); 
              $lastname=mysqli_real_escape_string($con, $_GET['lastname']);
              $companyname=mysqli_real_escape_string($con, $_GET['companyname']);
              $pan_no=mysqli_real_escape_string($con, $_GET['pan_no']);
              /* $gender=mysqli_real_escape_string($con, $_GET['gender']);
              $address=mysqli_real_escape_string($con, $_GET['street']);
              $city=mysqli_real_escape_string($con, $_GET['city']);
              $zip=mysqli_real_escape_string($con, $_GET['zipcode']);
              $state=mysqli_real_escape_string($con, $_GET['state']);
              $country=mysqli_real_escape_string($con, $_GET['country1']); */
              $phone=mysqli_real_escape_string($con, $_GET['phonenumber']);
              $email=mysqli_real_escape_string($con, $_GET['email']);
              $email_code=mysqli_real_escape_string($con, $_GET['email_verify']);
              $password=mysqli_real_escape_string($con, $_GET['pky']);
              $state=mysqli_real_escape_string($con, $_GET['state']);
              $user_type=mysqli_real_escape_string($con, $_GET['user_type']);
              $newsletter=mysqli_real_escape_string($con, $_GET['newsletter_option']);
              $source_url=mysqli_real_escape_string($con, $_GET['source_url']);

              $lang_status='0';

              $select_user="SELECT * FROM registration WHERE email='$email' "; 
              $res_user=mysqli_query($con,$select_user);
              $fetch_user=mysqli_fetch_array($res_user);
              $email_address=$fetch_user['email'];
			  
              if($email_address == ""){ 
               
                /* $insert_qry="INSERT INTO registration (vendor_id, firstname, lastname, gender, companyname, street, city, zipcode, phonenumber, email, email_verify,package, password, country, state, usertype, newsletter_option, ip_address, added_date, userstatus, lang_status, memberid) VALUES 
                ('$vendor_id', '$firstname', '$lastname', '$gender', '$companyname', '$address', '$city', '$zip', '$phone', '$email', $email_code,'$package', '$password', '$country', '$state', '$user_type', '$newsletter', '$ip', NOW() , '1', '$lang_status', 'Free')"; 
 */
                  $insert_qry="INSERT INTO registration (vendor_id, firstname, lastname, phonenumber, companyname, pan_no, email, email_verify, package, password, usertype, newsletter_option, ip_address, added_date, userstatus, lang_status, memberid) VALUES 
                  ('$vendor_id', '$firstname', '$lastname', '$phone', '$companyname', '$pan_no', '$email', $email_code,'$package', '$password', '$user_type', '$newsletter', '$ip', NOW() , '1', '$lang_status', 'Free')"; 


                  if($con->query($insert_qry) === TRUE){
                    $q = $con->query("SELECT * FROM registration WHERE vendor_id = '$vendor_id'");
                    $r = mysqli_fetch_array($q);
                    $v = $r['vendor_id'];
                  
                     //header("location:https://annexis.net/registration/?vendor_id=$vendor_id&package=$package&source=$source_url&msg=Success");
                    // header("");
                    $resp = "Success Annextrades";
                  }
                  else{
                       $resp = $con->error;
                    //header("location:https://annexis.net/registration/?package=$package&source=$source_url&msg=Failed");
                        //echo $con->error;
                  }
                }else{
                  $resp = "Email already exist in Annextrades"; 
                  //header("location:https://annexis.net/registration/?vendor_id=$v&package=$package&source=$source_url&msg=EmailExist");
              } 
				
               echo json_encode($resp); 
?>
