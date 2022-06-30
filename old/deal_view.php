<?php include("includes/new/header-inner-pages.php"); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$pro=$_REQUEST['id'];
$res="select * from featureproducts where id='$pro'";
$res1=mysqli_query($con,$res);
$result=mysqli_fetch_array($res1);
//echo '<pre>';
//print_r($result);
//echo '</pre>';

?>
<?php


                    if (isset($_REQUEST['submit_quote'])) {

                        $name = $_REQUEST['name']; // Get Name value from HTML Form
                        $mobile = $_REQUEST['phone'];  // Get Mobile No
                        $vendor_id = $_REQUEST['vendor_id'];  // Get Email Value
                        $message = $_REQUEST['message']; // Get Message Value
                        $emailadd =$_REQUEST['youremail'];


                        $mail = new PHPMailer();
                        require('smtpdetails.php');                      
                        //$mail->From->$email;
                        $mail->setFrom($emailadd);
                        $mail->addReplyTo($emailadd);
                       // $mail->FromName = $name;
                        //$mail->AddAddress("smiley18asha@gmail.com"); // On which email id you want to get the message
                        $mail->addAddress('info@annextrades.com');

                        // $mail->AddCC ($email);

                        $mail->IsHTML(true);
                        $mail->AllowEmpty = true;

                        $mail->Subject = "Get Quote Request"; // This is your subject

                        $mail->Body    = "Following are the details entered by the visitor:<br/><br/>
        Name: $name<br/>
        Mobile : $phone<br/>
        Vendor Id: $vendor_id<br/>
        Message: $message<br/>
        Email: $emailadd
        " ;
if (!$mail->send()) {
    //echo 'Message could not be sent.';
    $sentmessageerror ='*Your message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
    ?>

    <style>
    #info-message-error {
    color: red;
    font-size: 18px;
    font-weight: bold;
}
    </style>

    <script>
  setTimeout(function(){
    document.getElementById('info-message-error').style.display = 'none';
    
  }, 7000);
</script>


    <?php
} else {
   // echo 'Message has been sent';
    $sentmessagesuccess ="*Your message has been sent";

    ?>

<style>
    #info-message-success {
    color: green;
    font-size: 18px;
    font-weight: bold;
}
    </style>
    <script>
  setTimeout(function(){
    document.getElementById('info-message-success').style.display = 'none';
   
  }, 7000);
</script>

    <?php
}
}
    ?>
 

<div class="prod-single-wrapper">
    <div class="container">
        <div class="page-breadcrumb">
            <ul class="list-unstyled">
                <li><a href="products.php">Deals</a> > </li>
                <?php if (!empty($result['f_pdt_name'])) : ?><li><a href="#"><?= $result['f_pdt_name'] ?></a></li> <?php endif; ?> 

            </ul>
        </div>
    </div>
    <div class="container">        
        
            
               
                <div class="single-section-1">
                    <div class="single-section-1-left">
                        
                        <div class="full-preview-image">
                            <?php if((file_exists("admin/picture/".$result['f_pdt_images']))&&($result['f_pdt_images']!='')) { ?><img src="<?php echo "admin/picture/".$result['f_pdt_images']; ?>" /><?php } else {  ?><img src="images/img_noimg.jpg" height="128" width="128" /><?php } ?>
                            
                        </div>
                    </div>                  

                    <div class="single-section-1-right">
                        <h3><?= $result['f_pdt_name']; ?></h3>                        
                       

                        <ul class="list-unstyled col-three deal">
                            <li>
                                <b><?php echo $result['f_pdt_up_date']; ?></b>
                                <p class="m-0">Post Date</p>
                            </li>
                            
                            <li>
                                <b><?php echo $result['f_pdt_exp_date']; ?></b>
                                <p class="m-0">Expire Date</p>
                            </li>
                            <li>
                                <b><?php echo $result['minimum_quantity']; ?></b>
                                <p class="m-0">Minimum Order Quantity</p>
                            </li>

                        </ul>
 <ul class="list-unstyled col-three deal">
                            <li>
                                <b><?php echo $result['deliverytime']; ?></b>
                                <p class="m-0">Delivery Lead Time </p>
                            </li>
                            
                            <li>
                                <b><?php echo $result['pakage_details']; ?></b>
                                <p class="m-0">Delivery Details</p>
                            </li>
                            <li>
                                <b><?php echo $result['minimum_quantity'].' '.$result['pdt_quantity']; ?></b>
                                <p class="m-0">Supply Ability </p>
                            </li>
                        </ul>

                         <h5>Company Information</h5>
                        <ul class="list-unstyled col-three">
                            <li>
                                <b><?php echo $result['companyname']?></b>
                                <p class="m-0">Company Name</p>
                            </li>
                            <li>
                                <b><?php echo $result['company_start']?></b>
                                <p class="m-0">Established On</p>
                            </li>
                            <?php
                             $sql=(mysqli_query($con,"select * from  registration"));
                            $count=mysqli_num_rows($sql);
                            $row=mysqli_fetch_array($sql);
                            //echo $row['company_address'];
                            $cou=$result['country'];                      
                            $sql_country=(mysqli_query($con,"select * from country where country_id='$cou'"));
                            $row_country=mysqli_fetch_array($sql_country);
                            $row_country['country_name'];
                          ?>
                            <li>
                                <b><?php echo $row_country['country_name'];?></b>
                                <p class="m-0">Country</p>
                            </li>
                            
                        </ul>

                        <div>
                            <?php if(isset($sess_id)){ ?><a href="featureaction.php?id=<?php echo $result['id'];?>" class="theme-btn" ><?php echo $inquiry; ?></a>  <?php }else{ ?><a href="login.php"class="theme-btn">Inquiry</a>  <?php } ?>
                            
                        </div>

                    </div>
                </div>

                <div class="single-section-2">
                    <div class="single-section-2-left">
                       

                        <div class="company-tabs-wrapper">
                            <ul class="nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="about-company-tab" data-toggle="tab" href="#about-company" role="tab" aria-controls="about-company" aria-selected="true">Company Information</a>
                                </li>                          
                                
                                
                            </ul>
                            <div class="tab-content">
                                
                                        
                                
                                <div class="tab-pane fade show active" id="about-company" role="tabpanel">
                                    <h2 class="tab-title">Company Details</h2>
                                    <div class="col-two-wrap">
                                        <ul class="list-unstyled col-two">
                                            <?php if($result): ?>                                                
                                            <li>
                                                <p class="m-0">Company Name</p>
                                                <strong><?=(isset($result['companyname']) && !empty($result['companyname'])) ? $result['companyname'] : "N/A";?></strong>
                                            </li>
                                            <li>
                                                <p class="m-0">Member Since</p>
                                                 <strong><?=(isset($result['company_start']) && !empty($result['company_start'])) ? $result['company_start'] : "N/A";?></strong>
                                            </li>
                                            <li>
                                                <p class="m-0">Country</p>
                                                 <strong><?=(isset($row_country['country_name']) && !empty($row_country['country_name'])) ? $row_country['country_name'] : "N/A";?></strong>
                                            </li>
                                            <li>
                                                <p class="m-0">Address</p>
                                                <strong><?=(isset($result['address']) && !empty($result['address'])) ? $result['address'] : "N/A";?></strong>
                                            </li>
                                            <li>
                                                <p class="m-0">Company Email</p>
                                               <strong><?=(isset($result['companyemail']) && !empty($result['companyemail'])) ? $result['companyemail'] : "N/A";?></strong></li>
                                            
                                            <?php else: ?>
                                                <li>
                                                    <div class="alert alert-warning">Company information is not available.</div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                  <div class="single-section-2-right">
                        <p id="info-message-success"><?php echo $sentmessagesuccess; ?></p>
                        <p id="info-message-error"><?php echo $sentmessageerror; ?></p>
                        <h2 class="tab-title">Get Quote</h2>
                        <form action="" method="post" >
                            <div class="form-group">
                                <input type="text" placeholder="Enter your name" class="form-control" name="name" required>
                            </div>
                           
                            <div class="form-group">
                    <input type="email" placeholder="Enter your Email" class="form-control" value="<?php echo $gemail; ?>" name="youremail" required>
                            </div>
                        
                            <div class="form-group">
                                <input type="text" placeholder="Enter your mobile number" class="form-control" name="phone" required>
                            </div>
                            
                            <div class="form-group">
                                <input type="text" placeholder="Vendor ID" class="form-control" name="vendor_id" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message" name="message" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit_quote" class="theme-btn" value="SEND ME A QUOTE" />

                            </div>
                        </form>
                        <div class="text-center note-msg">By sending a request, you accept our <a href="#">Terms of Use</a> and <a href="">Privacy policy</a></div>

                        <div class="ad-set-wrapper pt-4">
                            <div><img src="./assets/images/ad.jpg" class="w-100" alt=""></div>
                        </div>
                    </div>
     

<?php 

if(isset($_POST['submit_quote'])){

        $name=$_POST['name']; // Get Name value from HTML Form
        $mobile=$_POST['phone'];  // Get Mobile No
        $vendor_id=$_POST['vendor_id'];  // Get Email Value
        $message=$_POST['message']; // Get Message Value
      
          
        $mail = new PHPMailer();
          
        //$mail->IsSMTP();
        $mail->Host = gethostname(); // Your Domain Name
          
        $mail->SMTPAuth = true;
        // $mail->Port = 587;
        // $mail->Username = "info@websapex.com"; // Your Email ID
        // $mail->Password = "DT~-RQyJlaFV"; // Password of your email id
          
        $mail->From = "asha.pixlerlab@gmail.com";
        $mail->FromName = "Annexies";
        $mail->AddAddress ("smiley18asha@gmail.com"); // On which email id you want to get the message
       // $mail->AddCC ($email);
          
        $mail->IsHTML(true);
          
        $mail->Subject = "Get Quote Request"; // This is your subject

        $mail->Body    = "Name: $name<br/>
        Mobile : $phone<br/>
        Vendor Id: $vendor_id<br/>
        Message: $message";
          
        // HTML Message Starts here
          
        
        // HTML Message Ends here
        //$mail->send();
          
              
       
     if(!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        //echo '<script type="text/javascript">alert("Mailer Error: "' . $mail->ErrorInfo");</script>';
        echo '<script type="text/javascript">alert("Mailer Error: $mail->ErrorInfo");</script>';
     } else {
        echo '<script type="text/javascript">alert("Message has been sent");</script>';
     }
  
    }

?>



                </div>
           
       
    </div>
</div>





<?php include "includes/new/footer.php"; ?>