<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query2=mysqli_query($conn, "SELECT * FROM `email_template` WHERE id='".$_GET['i']."' ");
        $row_adv2=mysqli_fetch_array($query2);
        
        $qur=mysqli_query($conn, "SELECT * FROM `registration` WHERE vendor_id='".$_GET['v_id']."' ");
        $rw=mysqli_fetch_array($qur);
    
?>
    <?php include"header.php"; ?>
    <style>
        p {
            color: #333;
        }
    </style>
        <!-- ============================================================== --> 
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="influence-profile">
                <div class="container-fluid dashboard-content">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-left"><a  href="add_etemp.php">Create Email</a></h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-right"><a  href="add_etemp.php">Add New Template</a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="controller/email_send.php?v_id=<?php echo $_GET['v_id']; ?>&i=<?php echo $_GET['i']; ?>" style="padding: 30px;" method="post">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email To" type="email" value="<?php echo $rw['email']; ?>" name="email">
                                    </div>
                                    <div class="form-group">
                                            <input  class="form-control" placeholder="Email Subject" value="<?php echo $row_adv2['subject']; ?>" type="text" name="subject">
                                        </div>
                                    <?php if ($_GET['i']==1) { ?>
                                        
                                        <div class="form-group">
                                            <!-- <textarea name="body"  class="form-control" id="body" cols="30" rows="10">< ?php echo html_entity_decode(htmlspecialchars($row_adv2['body'])); ?></textarea> -->
                                            <!-- <script>
                                                CKEDITOR.replace('body')
                                            </script> -->

                                        
                                            <p style="margin-left:48px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="https://annextrades.com/assets/images/logo.png" style="height:63px; width:499px" /></span></span></p>

                                            <br>
                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size: 11pt;">ANNEXTrades.com B2B Business Portal </span></span></span></p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size: 11pt;">Give Your Business Immediate U.S. Exposure and Promotion </span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Dear <?php echo $rw['firstname']; ?>,</span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Welcome to ANNEXTrades. </span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">This is an invitation to activate your account with <span style="color:#0563c1"><u><a href="http://www.annextrades.com" style="color:#0563c1; text-decoration:underline">www.annextrades.com</a></u></span> USA based B2B Portal.&nbsp; Use the details below to login, add your company details and add your product or service information.<br />
                                            Our goal is to start promoting your Product or Service in the United States and give you access to U.S. Buyers. </span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong>Account Username: Client Email ID</strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong>Click Here to login to </strong><br><span style="color:#0563c1"><u><strong><a href="http://www.annextrades.com/" style="color:#0563c1; text-decoration:underline" target="_blank">www.annextrades.com</a></strong></u></span> </span></span></p><br>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><?php echo $rw['firstname']; ?> Please login, add your company & product or service details, and complete payment.<br/>
                                            You are permitted to add up to <strong>20 Products or Service</strong>. If possible, please add multiple images and a full description for each product for best results.</span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Remember, for best results, add multiple images of your product along with a clear, Full Description. U.S. Buyers need this as basic information in order to make purchase decisions. </span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Select the Link below to learn how to Add your Product or Service Details: </span></span></span></p>

                                            <p style="margin-left:24px"><br />
                                            <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><a href="https://www.youtube.com/watch?v=gT0WRBmlPEk" style="color:#0563c1; text-decoration:underline" target="_blank"><span style="color:blue"><img src="https://annextrades.com/assets/images/mailimg/addingps.png" style="height:223px; width:265px" /></span></a></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Reply to this Email and R.S.V.P. for our next Webinar, and Speak Directly to our U.S.A. Team.</span></span></span></p>

                                            <p style="margin-left:24px"><br />
                                            <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><a href="http://evite.me/6dWxc4gd34" style="color:#0563c1; text-decoration:underline"><img src="https://annextrades.com/assets/images/mailimg/webinar.png" style="height:191px; width:286px" /></a></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0563c1"><u><a href="http://evite.me/6dWxc4gd34" style="color:#0563c1; text-decoration:underline">ANNEXTrades Team Invites You&nbsp; - Zoom Meeting Invitation&nbsp; | Evite</a></u></span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Please take a look at this short video to learn how our process works. </span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Introduction (English).</span></span></p>

                                            <p style="margin-left:24px"><br />
                                            <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                            <a href="https://www.youtube.com/watch?v=Mx4fOu7I6aw" style="color:#0563c1; text-decoration:underline" target="_blank">
                                            <span style="color:blue">
                                            <img src="https://annextrades.com/assets/images/mailimg/watchvid.jpg" style="width: 285px;" alt=""></span></a></span></span></p>
                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Presentation: 
                                            <span style="color:#0563c1"><u><a href="https://www.youtube.com/watch?v=Mx4fOu7I6aw" style="color:#0563c1; text-decoration:underline">https://www.youtube.com/watch?v=Mx4fOu7I6aw</a></u></span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px">
                                            <span style="font-size:11pt; font-family: 'Montserrat', sans-serif;">
                                            <img src="https://annextrades.com/assets/images/mailimg/howannex.png" style="width: 80%;"></span></p>
                                            <br><br>
                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 1 -</span></strong> <strong>ANNEXTrades B2B Business Portal: </strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Showcase your Product, Brand, Logo, or Services to millions of U.S. Customers. Your page will be promoted through Social &amp; Digital Media Marketing giving you direct access to customers. A User Dashboard will communicate directly with buyers. You will have a dedicated Company page. You will have access to our wonderful Customer Service Teams based in both the United States and India for support. </span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 2 -</span></strong> <strong>U.S. Business Address</strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">A U.S. location for Customer Returns.<br />
                                            Mail handling for your Business address with Mail Scanning.</span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 3 -</span></strong> <strong>U.S. Business Telephone Number (optional)</strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Be more accessible to potential customers with Auto Attendant and Call Forwarding features.<br />
                                            Your own Local or Toll-Free Phone number with advanced features &amp; voice over recordings for personalized messaging.</span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 4 -</span></strong> <strong>Live Receptionist</strong> <strong>(optional)</strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Never miss out on sales opportunities due to time differences or language barriers.<br />
                                            A Live receptionist will answer for you when you cannot. </span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Toll Free at: +1 (888)641-2950. WhatsApp us at: </span>
                                            <span style="color:#0563c1"><u><a href="https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc" style="color:#0563c1; text-decoration:underline" target="_blank">https://wa.me/17728779454</a></u></span> </span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                            <span style="color:black">Visit us at: </span>
                                            <span style="color:#0563c1"><u><a href="http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM" style="color:#0563c1; text-decoration:underline" target="_blank">www.annextrades.com</a></u></span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong>Your Bridge to Expansion and Increased Market Share, </strong></span></span></p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong>Establishing Companies in the United States</strong> </span></span></p>

                                            <p>&nbsp;</p> 
                                            <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:140px; padding:0; text-align:center; vertical-align:middle;" valign="middle" width="140">
                                                            <img alt="photograph" width="100" height="100" border="0" style="width:100px; height:100px; border-radius:50px; border:0;"  src="http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png">
                                                        </td>
                                                        <td style="border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;" valign="top"> 
                                                            <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;" valign="top">
                                                                            <strong><span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;">ANNEXTrades Teams</span></strong><br>    
                                                                            <span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;">Customer Support</span> 
                                                                        </td>     
                                                                    </tr>     
                                                                    <tr>     
                                                                        <td style="font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">email: welcome@annextrades.com<br> </span>    
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">phone: +1 (888)614-2950<span style="font-family:Verdana, sans-serif; font-size:10pt;"> | </span></span> 
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"></span> 
                                                                        </td>
                                                                    </tr>
                                                                    <tr>     
                                                                        <td style="font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"> </span> 
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">110 SE 6th Street Suite 1700</span> 
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">Ft. Lauderdale, Florida 33301</span>      
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>         
                                                        </td> 
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;" valign="middle" width="140"> 
                                                            <span><a href="https://www.facebook.com/Annexis.net/" target="_blank" rel="noopener"><img border="0" width="16" alt="facebook icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png"></a>&nbsp;</span><span><a href="https://twitter.com/annexisbusiness" target="_blank" rel="noopener"><img border="0" width="16" alt="twitter icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png"></a>&nbsp;</span><span><a href="https://www.linkedin.com/company/annexis-business-solutions" target="_blank" rel="noopener"><img border="0" width="16" alt="linkedin icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png"></a>&nbsp;</span><span><a href="https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm" target="_blank" rel="noopener"><img border="0" width="16" alt="google plus icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png"></a>&nbsp;</span>
                                                        </td>
                                                        <td style="padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;" valign="middle">
                                                            <a href="http://www.annextrades.com" target="_blank" rel="noopener" style=" text-decoration:none;"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt">www.annextrades.com</span></span></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table><br>
                                        </div>
                                    <?php }elseif ($_GET['i']==2) { ?>
                                        <div class="form-group">
                                        
                                            <p style="margin-left:48px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="https://annextrades.com/assets/images/logo.png" style="height:63px; width:499px" /></span></span></p>

                                            <br>
                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size: 11pt;">ANNEXTrades.com B2B Business Portal </span></span></span></p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size: 11pt;">Give Your Business Immediate U.S. Exposure and Promotion </span></span></span></p>

                                                                                    
                                            <p><br><br><br></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:10.5pt"><span style="background-color:white"><span style="font-family:Arial,sans-serif"><span style="color:#33475b">Immediate Action Required - Please Upload Your Details and Complete Your Registration</span></span></span></span></span></span></p>

                                            <p>&nbsp;</p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">USA Distributor:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['companyname']; ?></span></span></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Supplier ID:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['vendor_id']; ?></span></span></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Owner&rsquo;s Name:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?> </span></span></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Email ID: </strong><?php echo $rw['email']; ?></span></span></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Contact Number: </strong><?php echo $rw['phonenumber']; ?></span></span></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Company Rating:</span></span></strong> </span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="https://annextrades.com/assets/images/mailimg/starrating.png" style="width: 150px;" alt=""></span></span></p>
                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family: 'Montserrat', sans-serif;">Note. Earn your next Star Rating by adding your Company Details and Product or Service info.</span></span></span></p>

                                            <p>&nbsp;</p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Dear <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?>​,</span></span></span></span></p>

                                            <p>&nbsp;</p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0e101a">We want to thank you for taking the first step toward your USA Business Expansion.&nbsp;<br />
                                            This is an important notification that there has been no activity on your ANNEXTrades account for some time. Please take immediate action to begin your journey and become an active seller in an exciting U.S. Market. </span></span></span></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0e101a">Complete your registration by login into your account and enter your company &amp; product or service details. &nbsp; Also ensure your payment has been completed to activate your account. </span></span></span></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0e101a">We periodically send an email blast to introduce new suppliers such as yourself to interested U.S. buyers. If your product is not uploaded on our portal you will not be included in our introductions. It is imperative that you complete your registration and get active to benefit from the exciting opportunity to sell your products or services in the U.S. Market.</span></span></span></span></span></p>
                                                <br>
                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0e101a">To complete your registration, please Sign-In using: </span></span></span><u><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:blue"><a href="https://annextrades.com/login.php" style="color:#0563c1; text-decoration:underline" target="_self"><span style="color:blue">Annex Trades | Login</span></a></span></span></span></u></span></span></p>

                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0e101a">Follow the simple steps outline to submit the necessary details to complete your registration.</span></span></span></span></span></p>

                                            <p>&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Select the Link below to learn how to Add your Product or Service Details: </span></span></span></p>

                                            <p style="margin-left:24px"><br />
                                            <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><a href="https://www.youtube.com/watch?v=gT0WRBmlPEk" style="color:#0563c1; text-decoration:underline" target="_blank"><span style="color:blue"><img src="https://annextrades.com/assets/images/mailimg/addingps.png" style="height:223px; width:265px" /></span></a></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Reply to this Email and R.S.V.P. for our next Webinar, and Speak Directly to our U.S.A. Team.</span></span></span></p>

                                            <p style="margin-left:24px"><br />
                                            <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><a href="http://evite.me/6dWxc4gd34" style="color:#0563c1; text-decoration:underline"><img src="https://annextrades.com/assets/images/mailimg/webinar.png" style="height:191px; width:286px" /></a></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0563c1"><u><a href="http://evite.me/6dWxc4gd34" style="color:#0563c1; text-decoration:underline">ANNEXTrades Team Invites You&nbsp; - Zoom Meeting Invitation&nbsp; | Evite</a></u></span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Please take a look at this short video to learn how our process works. </span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Introduction (English).</span></span></p>

                                            <p style="margin-left:24px"><br />
                                            <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                            <a href="https://www.youtube.com/watch?v=Mx4fOu7I6aw" style="color:#0563c1; text-decoration:underline" target="_blank">
                                            <span style="color:blue">
                                            <img src="https://annextrades.com/assets/images/mailimg/watchvid.jpg" style="width: 285px;" alt=""></span></a></span></span></p>
                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Presentation: 
                                            <span style="color:#0563c1"><u><a href="https://www.youtube.com/watch?v=Mx4fOu7I6aw" style="color:#0563c1; text-decoration:underline">https://www.youtube.com/watch?v=Mx4fOu7I6aw</a></u></span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px">
                                            <span style="font-size:11pt; font-family: 'Montserrat', sans-serif;">
                                            <img src="https://annextrades.com/assets/images/mailimg/howannex.png" style="width: 80%;"></span></p>
                                            <br><br>
                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 1 -</span></strong> <strong>ANNEXTrades B2B Business Portal: </strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Showcase your Product, Brand, Logo, or Services to millions of U.S. Customers. Your page will be promoted through Social &amp; Digital Media Marketing giving you direct access to customers. A User Dashboard will communicate directly with buyers. You will have a dedicated Company page. You will have access to our wonderful Customer Service Teams based in both the United States and India for support. </span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 2 -</span></strong> <strong>U.S. Business Address</strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">A U.S. location for Customer Returns.<br />
                                            Mail handling for your Business address with Mail Scanning.</span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 3 -</span></strong> <strong>U.S. Business Telephone Number (optional)</strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Be more accessible to potential customers with Auto Attendant and Call Forwarding features.<br />
                                            Your own Local or Toll-Free Phone number with advanced features &amp; voice over recordings for personalized messaging.</span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="color:#00b0f0">Benefit 4 -</span></strong> <strong>Live Receptionist</strong> <strong>(optional)</strong></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Never miss out on sales opportunities due to time differences or language barriers.<br />
                                            A Live receptionist will answer for you when you cannot. </span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Toll Free at: +1 (888)641-2950. WhatsApp us at: </span>
                                            <span style="color:#0563c1"><u><a href="https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc" style="color:#0563c1; text-decoration:underline" target="_blank">https://wa.me/17728779454</a></u></span> </span></span></p>

                                            <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                            <span style="color:black">Visit us at: </span>
                                            <span style="color:#0563c1"><u><a href="http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM" style="color:#0563c1; text-decoration:underline" target="_blank">www.annextrades.com</a></u></span></span></span></p>

                                            <p style="margin-left:24px">&nbsp;</p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong>Your Bridge to Expansion and Increased Market Share, </strong></span></span></p>

                                            <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong>Establishing Companies in the United States</strong> </span></span></p>

                                            <p>&nbsp;</p> 
                                            <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:140px; padding:0; text-align:center; vertical-align:middle;" valign="middle" width="140">
                                                            <img alt="photograph" width="100" height="100" border="0" style="width:100px; height:100px; border-radius:50px; border:0;"  src="http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png">
                                                        </td>
                                                        <td style="border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;" valign="top"> 
                                                            <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;" valign="top">
                                                                            <strong><span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;">ANNEXTrades Teams</span></strong><br>    
                                                                            <span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;">Customer Support</span> 
                                                                        </td>     
                                                                    </tr>     
                                                                    <tr>     
                                                                        <td style="font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">email: welcome@annextrades.com<br> </span>    
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">phone: +1 (888)614-2950<span style="font-family:Verdana, sans-serif; font-size:10pt;"> | </span></span> 
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"></span> 
                                                                        </td>
                                                                    </tr>
                                                                    <tr>     
                                                                        <td style="font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"> </span> 
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">110 SE 6th Street Suite 1700</span> 
                                                                            <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">Ft. Lauderdale, Florida 33301</span>      
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>         
                                                        </td> 
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;" valign="middle" width="140"> 
                                                            <span><a href="https://www.facebook.com/Annexis.net/" target="_blank" rel="noopener"><img border="0" width="16" alt="facebook icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png"></a>&nbsp;</span><span><a href="https://twitter.com/annexisbusiness" target="_blank" rel="noopener"><img border="0" width="16" alt="twitter icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png"></a>&nbsp;</span><span><a href="https://www.linkedin.com/company/annexis-business-solutions" target="_blank" rel="noopener"><img border="0" width="16" alt="linkedin icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png"></a>&nbsp;</span><span><a href="https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm" target="_blank" rel="noopener"><img border="0" width="16" alt="google plus icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png"></a>&nbsp;</span>
                                                        </td>
                                                        <td style="padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;" valign="middle">
                                                            <a href="http://www.annextrades.com" target="_blank" rel="noopener" style=" text-decoration:none;"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt">www.annextrades.com</span></span></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table><br>
                                        </div>
                                    <?php }elseif ($_GET['i']=='3') { ?>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td>
                                                    <p style="margin-left:48px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="https://annextrades.com/assets/images/logo.png" style="height:63px; width:499px" /></span></span></p>

                                                <br>                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p style="text-align:center">&nbsp;</p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">USA Distributor:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['companyname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Supplier ID:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['vendor_id']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Owner&rsquo;s Name:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Email ID: </strong><?php echo $rw['email']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Contact Number: </strong><?php echo $rw['phonenumber']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img style="width: 150px;" src="https://annextrades.com/assets/images/mailimg/2starrating.png" alt="">
                                                                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family: 'Montserrat', sans-serif;">Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>

                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size: 11pt;"><span style="font-family: 'Montserrat', sans-serif;">Dear <?php echo $rw['firstname']; ?>,</span></span></strong></span></span></p>
                                
                                                <p style="text-align:center">&nbsp;</p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">This is a confirmation that we have received Product / Service details for review and approval.</span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Summary of submission:</span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">A review and approval of your submitted details will be performed within 24 to 48 hours. Please allow this time before your product will be viewed and active on our portal. Have a question? Please feel free to call us Toll Free at: +1 (888)641-2950 or email Customer Support at support@annextrades.com. Visit us at: <span style="color:#0563c1"><u><a href="http://www.annextrades.com" style="color:#0563c1; text-decoration:underline">www.annextrades.com</a></u></span></span></span></span></span></p>
                                
                                                <p>&nbsp;</p>
                                            </td>
                                        </tr>
                                        </table>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width:140px; padding:0; text-align:center; vertical-align:middle;" valign="middle" width="140">
                                                        <img alt="photograph" width="100" height="100" border="0" style="width:100px; height:100px; border-radius:50px; border:0;"  src="http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png">
                                                    </td>
                                                    <td style="border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;" valign="top"> 
                                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;" valign="top">
                                                                        <strong><span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;">ANNEXTrades Teams</span></strong><br>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;">Customer Support</span> 
                                                                    </td>     
                                                                </tr>     
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">email: welcome@annextrades.com<br> </span>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">phone: +1 (888)614-2950<span style="font-family:Verdana, sans-serif; font-size:10pt;"> | </span></span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"></span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"> </span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">110 SE 6th Street Suite 1700</span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">Ft. Lauderdale, Florida 33301</span>      
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>         
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;" valign="middle" width="140"> 
                                                        <span><a href="https://www.facebook.com/Annexis.net/" target="_blank" rel="noopener"><img border="0" width="16" alt="facebook icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png"></a>&nbsp;</span><span><a href="https://twitter.com/annexisbusiness" target="_blank" rel="noopener"><img border="0" width="16" alt="twitter icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png"></a>&nbsp;</span><span><a href="https://www.linkedin.com/company/annexis-business-solutions" target="_blank" rel="noopener"><img border="0" width="16" alt="linkedin icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png"></a>&nbsp;</span><span><a href="https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm" target="_blank" rel="noopener"><img border="0" width="16" alt="google plus icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png"></a>&nbsp;</span>
                                                    </td>
                                                    <td style="padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;" valign="middle">
                                                        <a href="http://www.annextrades.com" target="_blank" rel="noopener" style=" text-decoration:none;"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt">www.annextrades.com</span></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php }elseif ($_GET['i']=='4') { ?>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td>
                                                    <p style="margin-left:48px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="https://annextrades.com/assets/images/logo.png" style="height:63px; width:499px" /></span></span></p>

                                            <br>                                                </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p style="text-align:center">&nbsp;</p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">USA Distributor:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['companyname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Supplier ID:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['vendor_id']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Owner&rsquo;s Name:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Email ID: </strong><?php echo $rw['email']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Contact Number: </strong><?php echo $rw['phonenumber']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img style="width: 150px;" src="https://annextrades.com/assets/images/mailimg/2starrating.png" alt="">
                                                                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family: 'Montserrat', sans-serif;">Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>

                                                    <br>
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size: 11pt;"><span style="font-family: 'Montserrat', sans-serif;">Dear <?php echo $rw['firstname']; ?>,</span></span></strong></span></span></p>
                                
                                                <p style="text-align:center">&nbsp;</p>
                                
                                                
                                                    <p><span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Congratulations! <br> Your submission have been approved by the U.S. Team. &nbsp; Your account is now active on the ANNEXTrades&trade; Business Portal.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">The business portal link is:&nbsp;<a href="http://www.annextrades.com/" style="color:#0563c1; text-decoration:underline" target="_self">www.annextrades.com</a></span></span></span></span></span></p>

                                                    <p>
                                                    <span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">No further action is required at this time.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">If you have additional product or service you wish to upload to your account, from your user dashboard select "Add Product" and enter the appropriate information such as name, description, images and technical support will assist you to complete your listing.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Please contact Customer Service after new submission has been posted and allow 24 - 48 hrs for the change to be updated to your account.</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Customer Service can be contacted at&nbsp;<a href="tel:8001238632" style="color:#0563c1; text-decoration:underline" target="_blank">+1 (888) 641-2950</a>, WhatsApp us <a href="https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc" style="color:#0563c1; text-decoration:underline" target="_blank">+1 (772) 877-9454</a> or email Customer Support at support@annextrades.com. Visit us at: <span style="color:#0563c1"><u><a href="http://www.annextrades.com" style="color:#0563c1; text-decoration:underline">www.annextrades.com</a></u></span></span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Thanks again for being a valued&nbsp;<a href="http://annextrades.com/" style="color:#0563c1; text-decoration:underline" target="_blank">ANNEXTrades&trade;</a>&nbsp;family member!</span></span></span></span></span></p>

                                                    <p>&nbsp;</p>

                                                    <p><span style="font-size:11pt"><span style="background-color:white"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Kind Regards,</span></span></span></span></span></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width:140px; padding:0; text-align:center; vertical-align:middle;" valign="middle" width="140">
                                                        <img alt="photograph" width="100" height="100" border="0" style="width:100px; height:100px; border-radius:50px; border:0;"  src="http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png">
                                                    </td>
                                                    <td style="border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;" valign="top"> 
                                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;" valign="top">
                                                                        <strong><span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;">ANNEXTrades Teams</span></strong><br>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;">Customer Support</span> 
                                                                    </td>     
                                                                </tr>     
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">email: welcome@annextrades.com<br> </span>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">phone: +1 (888)614-2950<span style="font-family:Verdana, sans-serif; font-size:10pt;"> | </span></span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"></span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"> </span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">110 SE 6th Street Suite 1700</span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">Ft. Lauderdale, Florida 33301</span>      
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>         
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;" valign="middle" width="140"> 
                                                        <span><a href="https://www.facebook.com/Annexis.net/" target="_blank" rel="noopener"><img border="0" width="16" alt="facebook icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png"></a>&nbsp;</span><span><a href="https://twitter.com/annexisbusiness" target="_blank" rel="noopener"><img border="0" width="16" alt="twitter icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png"></a>&nbsp;</span><span><a href="https://www.linkedin.com/company/annexis-business-solutions" target="_blank" rel="noopener"><img border="0" width="16" alt="linkedin icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png"></a>&nbsp;</span><span><a href="https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm" target="_blank" rel="noopener"><img border="0" width="16" alt="google plus icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png"></a>&nbsp;</span>
                                                    </td>
                                                    <td style="padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;" valign="middle">
                                                        <a href="http://www.annextrades.com" target="_blank" rel="noopener" style=" text-decoration:none;"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt">www.annextrades.com</span></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php }elseif ($_GET['i']=='5') { ?>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td>
                                                    <p style="margin-left:48px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="https://annextrades.com/assets/images/logo.png" style="height:63px; width:499px" /></span></span></p>

                                            <br>                                                </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p style="text-align:center">&nbsp;</p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">USA Distributor:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['companyname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Supplier ID:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['vendor_id']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Owner&rsquo;s Name:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Email ID: </strong><?php echo $rw['email']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Contact Number: </strong><?php echo $rw['phonenumber']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img style="width: 150px;" src="https://annextrades.com/assets/images/mailimg/2starrating.png" alt="">
                                                                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family: 'Montserrat', sans-serif;">Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>

                                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img style="width: 285px;" src="https://annextrades.com/assets/images/mailimg/webinar.png" alt="">
                                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Link: </span></span><span style="color:#0563c1"><u><a href="http://evite.me/6dWxc4gd34" style="color:#0563c1; text-decoration:underline">ANNEXTrades Team Invites You - Zoom Meeting Invitation | Evite</a></u></span></span></span></p>
                                                    
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size: 11pt;"><span style="font-family: 'Montserrat', sans-serif;">Dear <?php echo $rw['firstname']; ?>,</span></span></strong></span></span></p>

                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:10.0pt"><span style="background-color:white"><span style="font-family:Arial,sans-serif"><span style="color:#2e3136">Please join us on a Free Webinar to learn what buyer are looking for and need from you to make a purchase request. What to do and say to convert your leads into sales.&nbsp; </span></span></span></span></span></span></p>

                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:10.0pt"><span style="background-color:white"><span style="font-family:Arial,sans-serif"><span style="color:#2e3136">Do you have any question about how our process work or how to get the best results?<br />
                                                Ask your questions directly to the USA Team. </span></span></span></span></span></span></p>

                                                <p style="text-align:center">&nbsp;</p>

                                                <p style="text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Use the Link Below to RSVP and Reserve You Spot.&nbsp; </span></span></span></span></p>

                                                <p style="text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFYAAAAuCAMAAACF+R5pAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAIKUExURf////7+/v39/fz8/Ojo6NDQ0KysrJSUlK2trbi4uKioqKWlpaKiopOTk4CAgH5+fn19fZGRkaOjo6ampre3t8PDw8nJydvb2+Pj4+3t7fj4+Pv7+/f3983NzWhoaD4+PjMzMzExMTAwMDIyMjQ0NDo6Ok5OTo6Ojt3d3dfX11VVVTY2NtnZ2UFBQTc3N0xMTIeHh9TU1Ovr6/X19fr6+vn5+fT09Ofn57u7u1tbWy8vL0NDQ/Dw8PLy8vHx8erq6uDg4NbW1ry8vIuLi2BgYEJCQjU1NV5eXoqKimlpadjY2Pb29rOzszk5OUtLS5aWlm5ubjg4OHV1dUBAQDw8PJqamkhISHNzc6qqqsvLy7CwsD8/P8HBwT09PWxsbGdnZ29vb+/v7+zs7NPT08LCwq+vr+bm5k1NTVBQUMjIyDs7O1dXV+7u7qurq0pKSmRkZNzc3J2dnVxcXF1dXV9fX9/f3/Pz85mZmd7e3mNjY5iYmGFhYUlJSampqURERLa2tk9PT1NTU1paWnt7e5CQkKSkpL6+vpeXl6CgoFJSUunp6Z+fny4uLnh4eC0tLW1tbdra2tXV1bGxseHh4Zubm0dHR7S0tLW1tYKCgqGhoczMzJycnGVlZYmJiZKSkrm5uUZGRoGBgXBwcMDAwMTExL+/v5WVlYODg3p6etLS0nZ2dkVFRYSEhAAAAMCWfIcAAACudFJOU///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////APxmpecAAAAJcEhZcwAAIdUAACHVAQSctJ0AAALMSURBVFhH7ZZLkqwgEEVrKQ4JRw5ZCjM3wJwZO5AFsNp3b2aiFGWXVkVHvEmfrtaUT5o/wMcff/xXYg1LWoL3KSQImwERDd776ly0oXep61RKmYjdDuS5sF2G5MXZpAtqFlWHulExQZv+cCnBZr7BySwaEeljjH7mzDw4HNHjnF/mTMWztf7IRhPWwa/AF1mbvEtFA71X9vLdyeSe1ULNiK7WdoAOk06JnGnygJc4ajhfXL5QC1uziUrvbco5b6FSv0R9x0Prqwc7EVX11I2GaRtSJS55pCvW6sOyatW8Mxbjn22VSE/roLgyEPw7OEsYZ7Fc6gzvtGlHSmCq9iREpg20yxpe/BGclh5HveQixoSuMoN1C7JYMSw5Ep8jPLJQoeodypVVJa8z8LDSPut+D21dk3dpKtZiqK4DaORL7ml9wAS5Y43KvQEvcn3yMwaacGMDIFPRZYUpcm9Ag0kdXDAmvicWC2keyuvcXV+GUP2Am4p6OlqbX+sN7Fa8J/pi2sbYouwnKSycEIem1IZfsBcAVqoKRtZaZv6l0HKicjxq9wWodxWQeRUAVp2UExW3f5ZtwqB7lbBbi61JBQGR3UwkNc1q9M0YPEIb6J5S1Kq5hzvgWRrPqK0S4Ha3p5yXV7g8Xhq7kVDbTUG54Qistbrafw6cOXHOnoSpdNFEOTOQ7aJlwDF31ZY28mk9tOzzQiAgREiEtwFXYI4KS5czzIeB2FJJTahp2LwiZ/eWLkDhqjZEeTelL2IFLTT9zspVek+tSWqpy5TAAfe1MqYNhlm1ydO0+a4M9k3pFpEnLn+4IOvcfDl705QJ6gSW4Qdqe6i5ZFsVfuVuw/rSiOJJ2r/AYy+gZnwvagO+CvGdDCHivO93iQ+JPFwZjilvODixyBw+X1hh3enxVTAcvkYNWWMmz19GtsfJB7FppOnLz0o/fx328y9d/k0ej3/DGR6vFtterAAAAABJRU5ErkJggg==" style="height:20px; width:37px" /><span style="color:#0563c1"><u><a href="http://evite.me/6dWxc4gd34" style="color:#0563c1; text-decoration:underline">ANNEXTrades Team Invites You - Zoom Meeting Invitation | Evite</a></u></span></span></span></p>

                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Regards, </span></span></span></span></p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width:140px; padding:0; text-align:center; vertical-align:middle;" valign="middle" width="140">
                                                        <img alt="photograph" width="100" height="100" border="0" style="width:100px; height:100px; border-radius:50px; border:0;"  src="http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png">
                                                    </td>
                                                    <td style="border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;" valign="top"> 
                                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;" valign="top">
                                                                        <strong><span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;">ANNEXTrades Teams</span></strong><br>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;">Customer Support</span> 
                                                                    </td>     
                                                                </tr>     
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">email: welcome@annextrades.com<br> </span>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">phone: +1 (888)614-2950<span style="font-family:Verdana, sans-serif; font-size:10pt;"> | </span></span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"></span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"> </span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">110 SE 6th Street Suite 1700</span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">Ft. Lauderdale, Florida 33301</span>      
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>         
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;" valign="middle" width="140"> 
                                                        <span><a href="https://www.facebook.com/Annexis.net/" target="_blank" rel="noopener"><img border="0" width="16" alt="facebook icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png"></a>&nbsp;</span><span><a href="https://twitter.com/annexisbusiness" target="_blank" rel="noopener"><img border="0" width="16" alt="twitter icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png"></a>&nbsp;</span><span><a href="https://www.linkedin.com/company/annexis-business-solutions" target="_blank" rel="noopener"><img border="0" width="16" alt="linkedin icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png"></a>&nbsp;</span><span><a href="https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm" target="_blank" rel="noopener"><img border="0" width="16" alt="google plus icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png"></a>&nbsp;</span>
                                                    </td>
                                                    <td style="padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;" valign="middle">
                                                        <a href="http://www.annextrades.com" target="_blank" rel="noopener" style=" text-decoration:none;"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt">www.annextrades.com</span></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php }elseif ($_GET['i']=='6') { ?>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                            
                                            <tr>

                                            <td colspan="2">
                                                <p style="text-align:center">&nbsp;</p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">USA Distributor:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['companyname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Supplier ID:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['vendor_id']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Owner&rsquo;s Name:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Email ID: </strong><?php echo $rw['email']; ?></span></span></span></span></p>
                                
                                                <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Contact Number: </strong><?php echo $rw['phonenumber']; ?></span></span></span></span></p>
                                
                                                <p style='text-align:center'>&nbsp;</p>
                                                <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif">This is your notice that we received your payment and your account status is "Active" </span></span></span></p>


                                                <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                                <p style="margin-left:24px">&nbsp;</p>

                                                <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                                <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Toll Free at: +1 (888)641-2950. WhatsApp us at: </span>
                                                <span style="color:#0563c1"><u><a href="https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc" style="color:#0563c1; text-decoration:underline" target="_blank">https://wa.me/17728779454</a></u></span> </span></span></p>

                                                <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                                <span style="color:black">Visit us at: </span>
                                                <span style="color:#0563c1"><u><a href="http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM" style="color:#0563c1; text-decoration:underline" target="_blank">www.annextrades.com</a></u></span></span></span></p>

                                                <p style="margin-left:24px">&nbsp;</p>

                                            </td>
                                        </tr>
                                        </table>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width:140px; padding:0; text-align:center; vertical-align:middle;" valign="middle" width="140">
                                                        <img alt="photograph" width="100" height="100" border="0" style="width:100px; height:100px; border-radius:50px; border:0;"  src="http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png">
                                                    </td>
                                                    <td style="border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;" valign="top"> 
                                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;" valign="top">
                                                                        <strong><span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;">ANNEXTrades Teams</span></strong><br>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;">Customer Support</span> 
                                                                    </td>     
                                                                </tr>     
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">email: welcome@annextrades.com<br> </span>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">phone: +1 (888)614-2950<span style="font-family:Verdana, sans-serif; font-size:10pt;"> | </span></span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"></span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"> </span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">110 SE 6th Street Suite 1700</span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">Ft. Lauderdale, Florida 33301</span>      
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>         
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;" valign="middle" width="140"> 
                                                        <span><a href="https://www.facebook.com/Annexis.net/" target="_blank" rel="noopener"><img border="0" width="16" alt="facebook icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png"></a>&nbsp;</span><span><a href="https://twitter.com/annexisbusiness" target="_blank" rel="noopener"><img border="0" width="16" alt="twitter icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png"></a>&nbsp;</span><span><a href="https://www.linkedin.com/company/annexis-business-solutions" target="_blank" rel="noopener"><img border="0" width="16" alt="linkedin icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png"></a>&nbsp;</span><span><a href="https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm" target="_blank" rel="noopener"><img border="0" width="16" alt="google plus icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png"></a>&nbsp;</span>
                                                    </td>
                                                    <td style="padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;" valign="middle">
                                                        <a href="http://www.annextrades.com" target="_blank" rel="noopener" style=" text-decoration:none;"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt">www.annextrades.com</span></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php }elseif($_GET['i']=='7'){?>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                            <tr>
                                                    <td>
                                                        <p style="margin-left:48px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img src="https://annextrades.com/assets/images/mailimg/milestone.png" style="width:300px" /></span></span></p>
                                                    </td>
                                            </tr>
                                            <tr>

                                                <td colspan="2">
                                                    <p style="text-align:center">&nbsp;</p>
                                    
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">USA Distributor:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['companyname']; ?></span></span></span></span></p>
                                    
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Supplier ID:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['vendor_id']; ?></span></span></span></span></p>
                                    
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Owner&rsquo;s Name:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?></span></span></span></span></p>
                                    
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Email ID: </strong><?php echo $rw['email']; ?></span></span></span></span></p>
                                    
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Contact Number: </strong><?php echo $rw['phonenumber']; ?></span></span></span></span></p>
                                    
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                                    
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img style="width: 150px;" src="https://annextrades.com/assets/images/mailimg/2starrating.png" alt="">
                                                    <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family: 'Montserrat', sans-serif;">Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>
                                                    
                                                    <p style='text-align:center'>&nbsp;</p>
                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif"><?php echo ucfirst($rw['firstname']).","; ?> ANNEXTrades thanks you for remaining focused on your journey to financial freedom. <br>Now that you are becoming an established brand with products visible to many U.S. Buyers,</span></span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif">we encourage you to take advantage of all our services and continue to give your company access to the exciting U.S. Market and grow your business to its' full potential.</span></span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif">This is a friendly reminder that your monthly subscription will expire in 3 days. </span></span></span></p>
                                                    <br>
                                                    
                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-family:Verdana,sans-serif"><span style="color:#0600ff">ANNEXTrades Membership Include:</span></span></strong></span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif"><span style="color:black">&bull; Boost Company Profile Rating &ndash; Build Buyer Confidence</span></span></span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif"><span style="color:black">&bull; Virtual Store with Catalogue &ndash; Convert Buyers</span></span></span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif"><span style="color:black">&bull; U.S. Sample Fulfilment Options &ndash; Respond Faster </span></span></span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif"><span style="color:black">&bull; Consultancy Add-On Services &ndash; Know Your Market</span></span></span></span></p>
                                                        <br>
                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif"><span style="color:black">Click </span></span><u><span style="font-family:Verdana,sans-serif"><span style="color:#0600ff">Here</span></span></u><span style="font-family:Verdana,sans-serif"><span style="color:black"> to pay now and avoid service interruptions.</span></span></span></span></p>

                                                    <p style="margin-left:24px">&nbsp;</p>

                                                    <img src="https://annextrades.com/assets/images/mailimg/monsubs.png" style="width: 300px;" alt="">
                                                    <p style="margin-left:24px">&nbsp;</p>

                                                    <p style="margin-left:24px; text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></span></p>

                                                    <p style="margin-left:24px">&nbsp;</p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">If you have any questions or feedback, please reply to this email or call us </span></span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:black">Toll Free at: +1 (888)641-2950. WhatsApp us at: </span>
                                                    <span style="color:#0563c1"><u><a href="https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc" style="color:#0563c1; text-decoration:underline" target="_blank">https://wa.me/17728779454</a></u></span> </span></span></p>

                                                    <p style="margin-left:24px"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                                    <span style="color:black">Visit us at: </span>
                                                    <span style="color:#0563c1"><u><a href="http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM" style="color:#0563c1; text-decoration:underline" target="_blank">www.annextrades.com</a></u></span></span></span></p>

                                                    <p style="margin-left:24px">&nbsp;</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width:140px; padding:0; text-align:center; vertical-align:middle;" valign="middle" width="140">
                                                        <img alt="photograph" width="100" height="100" border="0" style="width:100px; height:100px; border-radius:50px; border:0;"  src="http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png">
                                                    </td>
                                                    <td style="border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;" valign="top"> 
                                                        <table style="font-family:Verdana, sans-serif;" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;" valign="top">
                                                                        <strong><span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;">ANNEXTrades Teams</span></strong><br>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;">Customer Support</span> 
                                                                    </td>     
                                                                </tr>     
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">email: welcome@annextrades.com<br> </span>    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">phone: +1 (888)614-2950<span style="font-family:Verdana, sans-serif; font-size:10pt;"> | </span></span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"></span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>     
                                                                    <td style="font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;" valign="top">    
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;"> </span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">110 SE 6th Street Suite 1700</span> 
                                                                        <span style="font-family:Verdana, sans-serif; color:#444444; font-size:10pt;">Ft. Lauderdale, Florida 33301</span>      
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>         
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;" valign="middle" width="140"> 
                                                        <span><a href="https://www.facebook.com/Annexis.net/" target="_blank" rel="noopener"><img border="0" width="16" alt="facebook icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png"></a>&nbsp;</span><span><a href="https://twitter.com/annexisbusiness" target="_blank" rel="noopener"><img border="0" width="16" alt="twitter icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png"></a>&nbsp;</span><span><a href="https://www.linkedin.com/company/annexis-business-solutions" target="_blank" rel="noopener"><img border="0" width="16" alt="linkedin icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png"></a>&nbsp;</span><span><a href="https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm" target="_blank" rel="noopener"><img border="0" width="16" alt="google plus icon" style="border:0; height:16px; width:16px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png"></a>&nbsp;</span>
                                                    </td>
                                                    <td style="padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;" valign="middle">
                                                        <a href="http://www.annextrades.com" target="_blank" rel="noopener" style=" text-decoration:none;"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt"><span style="color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt">www.annextrades.com</span></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php }elseif($_GET['i']=='8'){ ?>
                                  
                                        <p style="text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:24.0pt"><span style="font-family:Calibri,sans-serif">NOTICE OF SERVICE INTERRUPTION </span></span></strong></span></span></p>

                                        <p style="text-align:center">&nbsp;</p>
                                    
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">USA Distributor:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['companyname']; ?></span></span></span></span></p>
                        
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Supplier ID:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['vendor_id']; ?></span></span></span></span></p>
                        
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Owner&rsquo;s Name:</span></span></strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;"> <?php echo $rw['firstname']; ?> <?php echo $rw['lastname']; ?></span></span></span></span></p>
                        
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Email ID: </strong><?php echo $rw['email']; ?></span></span></span></span></p>
                        
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">Contact Number: </strong><?php echo $rw['phonenumber']; ?></span></span></span></span></p>
                        
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-size:11.0pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades Company Rating:&nbsp;&nbsp; </span></span></strong></span></span></p>
                        
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><img style="width: 150px;" src="https://annextrades.com/assets/images/mailimg/2starrating.png" alt="">
                                                                                            <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family: 'Montserrat', sans-serif;">Note. Earn your next Star Rating: renew monthly subscription or complete 1<sup>st</sup> Sale.</span></span></span></p>

                                                    

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Dear <?php echo $rw['firstname']; ?> at <?php echo $rw['companyname']; ?>,</span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">​</span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Your monthly subscription has expired. This letter is to notify you that some of your account activity will be restricted due to non-payment. </span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">You can no longer access your user dashboard or respond to buyers through the ANNEXTrades portal. </span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="font-family:Verdana,sans-serif">Please Note.&nbsp; In cases where buyer contact us on your behalf, we will also notify them that you are no longer an active member of our network of distributor and we will direct them to someone else.&nbsp; </span></span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">As you already know, the United States is experiencing an exciting new International trend in Trading. The U.S. is depending less on China and is seeking more suppliers from India.</span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades will continue to provide Indian businesses exposure as preferred suppliers of Goods or Services to the United States. We want to keep you as a valued Client and support you to grow your business.</span></span></p>

                                        <p><br />
                                        <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><strong><span style="font-family:Calibri,sans-serif">To reactivate your account contact, Customer Service at ANNEXTrades </span></strong></span></span></p>

                                        <p>&nbsp;</p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;"><span style="color:#0600ff">ANNEXTrades Membership Include:</span></span></span></p>

                                        <ol>
                                            <li><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Boost Company Profile Rating &ndash; Build Buyer Confidence</span></span></li>
                                            <li><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Virtual Store with Catalogue &ndash; Convert Buyers</span></span></li>
                                            <li><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">U.S. Sample Fulfilment Options &ndash; Respond Faster </span></span></li>
                                            <li><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Consultancy Add-On Services &ndash; Know Your Market</span></span></li>
                                        </ol>

                                        <p><br />
                                        <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                        <img src="https://annextrades.com/assets/images/mailimg/monsubs.png" width="300px" alt="">
                                        <p style="text-align:center"><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">ANNEXTrades - Your Bridge to Expansion and Increased Market Share.</span></span></p>

                                        <p><br />
                                        <br />
                                        <span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">
                                        <img src="https://annextrades.com/assets/images/mailimg/cntimg.png" style="width: 200px;" alt="">
                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">How to Reach Us?<br />
                                        Email: support@annextrades.com<br />
                                        Call: +1 (888)641-2950. </span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">WhatsApp: <span style="color:#0563c1"><u><a href="https://wa.me/17728779454?fbclid=IwAR01oeAx2lJx3tfFEqB_mtVNRRgfXrgcZXHU6Mh6syorjNlOYSYMg45n8zc" style="color:#0563c1; text-decoration:underline" target="_blank">https://wa.me/17728779454</a></u></span> </span></span></p>

                                        <p><span style="font-size:11pt"><span style="font-family: 'Montserrat', sans-serif;">Visit: <span style="color:#0563c1"><u><a href="http://www.annextrades.com/?fbclid=IwAR34D-TN10f01d7ATKEJ_YlEmZ4R2KK6rGqz7Avzi0mGYGIYBrOyHQ1H_YM" style="color:#0563c1; text-decoration:underline" target="_blank">www.annextrades.com</a></u></span></span></span></p>

                                        <p style="margin-left:48px">&nbsp;</p>




                                        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                            <tbody>
                                                <tr>
                                                    <td style='width:140px; padding:0; text-align:center; vertical-align:middle;' valign='middle' width='140'>
                                                        <img alt='photograph' width='100' height='100' border='0' style='width:100px; height:100px; border-radius:50px; border:0;'  src='http://www.tclimoservices.com/wp-content/uploads/2018/12/0.png'>
                                                    </td>
                                                    <td style='border-bottom:2px solid; border-bottom-color:#ed5a24; padding:0; vertical-align:top;' valign='top'> 
                                                        <table style='font-family:Verdana, sans-serif;' cellpadding='0' cellspacing='0'>
                                                            <tbody>
                                                                <tr>
                                                                    <td style='font-family:Verdana, sans-serif; color:#ed5a24; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; vertical-align:top;' valign='top'>
                                                                        <strong><span style='font-family:Verdana, sans-serif; color:#ed5a24; font-size:14pt; font-style:italic;'>ANNEXTrades Teams</span></strong><br>    
                                                                        <span style='font-family:Verdana, sans-serif; color:#ed5a24; font-size:10pt;'>Customer Support</span> 
                                                                    </td>     
                                                                </tr>     
                                                                <tr>     
                                                                    <td style='font-family:Verdana, sans-serif; color:#444444; padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;' valign='top'>    
                                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>email: welcome@annextrades.com<br> </span>    
                                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>phone: +1 (888)614-2950<span style='font-family:Verdana, sans-serif; font-size:10pt;'> | </span></span> 
                                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'></span> 
                                                                    </td>
                                                                </tr>
                                                                <tr>     
                                                                    <td style='font-family:Verdana, sans-serif; color:#444444;  padding-bottom:6px; padding-top:0; padding-left:0; padding-right:0; line-height:18px; vertical-align:top;' valign='top'>    
                                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'> </span> 
                                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>110 SE 6th Street Suite 1700</span> 
                                                                        <span style='font-family:Verdana, sans-serif; color:#444444; font-size:10pt;'>Ft. Lauderdale, Florida 33301</span>      
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>         
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td style='font-family:Verdana, sans-serif; width:140px; padding-top:6px; padding-left:0; padding-right:0; text-align:center; vertical-align:middle;' valign='middle' width='140'> 
                                                        <span><a href='https://www.facebook.com/Annexis.net/' target='_blank' rel='noopener'><img border='0' width='16' alt='facebook icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/fb.png'></a>&nbsp;</span><span><a href='https://twitter.com/annexisbusiness' target='_blank' rel='noopener'><img border='0' width='16' alt='twitter icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/tt.png'></a>&nbsp;</span><span><a href='https://www.linkedin.com/company/annexis-business-solutions' target='_blank' rel='noopener'><img border='0' width='16' alt='linkedin icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/ln.png'></a>&nbsp;</span><span><a href='https://www.glassdoor.com/Overview/Working-at-Annexis-Business-Solutions-EI_IE2028455.11,37.htm' target='_blank' rel='noopener'><img border='0' width='16' alt='google plus icon' style='border:0; height:16px; width:16px' src='https://codetwocdn.azureedge.net/images/mail-signatures/generator/photo2/gp.png'></a>&nbsp;</span>
                                                    </td>
                                                    <td style='padding-top:6px; padding-bottom:0; padding-left:0; padding-right:0; vertical-align:middle;' valign='middle'>
                                                        <a href='http://www.annextrades.com' target='_blank' rel='noopener' style=' text-decoration:none;'><span style='color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt'><span style='color:#ed5a24; font-family:Verdana, sans-serif; font-size:10pt'>www.annextrades.com</span></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                    <div class="form-group" style="margin-top: 30px;">
                                        <input type="submit" class="btn btn-primary" value="SEND">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    <?php include"footer.php"; ?> 
    <?php
        }
        else{ 
                    header('location: auth/');
            } 
    ?>      