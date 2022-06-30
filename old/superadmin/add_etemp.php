<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query2=mysqli_query($conn, "SELECT * FROM `email_template` WHERE id='".$_GET['i']."' ");
        $row_adv2=mysqli_fetch_array($query2);
        $v_id=$_GET['v_id'];
        
        
?>
    <?php include"header.php"; ?>
    
        <style>
            .ck-editor__editable_inline {
                min-height: 150px;
                max-height: 300px;
            }
            .inputfile {
                width: 0.1px;
                height: 0.1px;
                opacity: 0;
                overflow: hidden;
                position: absolute;
                z-index: -1;
                }
        </style>
        <!-- ============================================================== --> 
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="influence-profile">
                <div class="container-fluid dashboard-content">
                <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h3 class="mb-2">Email Template</h3><div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Email Template</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- campaign tab one -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-md-12" >
                        <h5 class="card-header text-center"><a href="add_etemp.php?1">Email Template</a></h5>
                            <div class="card">
                                <form action="controller/add_etemp.php?action=<?php if($_GET['i']!=''){ echo "update";}else{ echo "addnew";} ?>&v_id=<?php echo $v_id; ?>&i=<?php echo $_GET['i']; ?>" class="needs-validation" method="post">
                                    <div class="form-group" style="padding: 15px;">
                                        <input type="text" class="form-control" name="subject" id="" value="<?php echo $row_adv2['subject']; ?>" placeholder="Email Subject">
                                    </div>
                                    <div class="form-group" style="padding: 15px;">
                                        <textarea name="body" id="e-ddes" cols="30" rows="10" placeholder="Email Body..."><?php echo html_entity_decode($row_adv2['body']);?></textarea>
                                        <script>
                                            CKEDITOR.replace( 'e-ddes' );
                                        </script>
                                    </div>
                                    <div class="form-group" style="padding: 15px;">
                                        <input type="submit" value="SUBMIT" class="form-control" name="" id="">
                                    </div>
                                </form>
                                <!-- <div class="card-body">
                                    Dear {{ contact.firstname }},<br>
                                        Welcome to ANNEXTrades. <br>
                                        This is your invitation to start your Free 14-Day Trial with www.annextrades.com USA based B2B
                                        Portal. Use the details below to login, add your company details and add your product or service
                                        information. <br>
                                        Our goal is to start promoting your Product or Service in the United States and give you access to
                                        U.S. Buyers. <br>
                                        Account Username: Client Email ID <br>
                                        Temporary Password: First Name@annexis <br>
                                        Click Here to login to www.annextrades.com <br>
                                        Trial Period Start Date: <br>
                                        Trial Period End Date: <br>
                                        {{ contact.firstname }} please login and add your Company and Product details. <br>
                                        You are permitted to add up to 20 Products or Service. If possible, please add multiple images and a
                                        full description for each product for best results. <br>
                                        Remember, for best results, add multiple images of your product along with a clear, Full Description. <br>
                                        U.S. Buyers need this as basic information in order to make purchase decisions. <br>
                                        Select the Link below to learn how to Add your Product or Service Details: <br>
                                        Reply to this Email and R.S.V.P. for our next Webinar, and Speak Directly to our
                                        U.S.A. Team. <br>
                                        ANNEXTrades Team Invites You - Zoom Meeting Invitation | Evite <br>
                                        Please take a look at this short video to learn how our process works. <br>
                                        ANNEXTrades Introduction (English). <br>
                                        Presentation: https://www.youtube.com/watch?v=Mx4fOu7I6aw <br>
                                        Benefit 1 - ANNEXTrades B2B Business Portal: <br>
                                        Showcase your Product, Brand, Logo, or Services to millions of U.S. Customers. Your page will be
                                        promoted through Social & Digital Media Marketing giving you direct access to customers. A User
                                        Dashboard will communicate directly with buyers. You will have a dedicated Company page. You will
                                        have access to our wonderful Customer Service Teams based in both the United States and India for
                                        support. <br>
                                        Benefit 2 - U.S. Business Address <br>
                                        A U.S. location for Customer Returns. <br>
                                        Mail handling for your Business address with Mail Scanning. <br>
                                        Benefit 3 - U.S. Business Telephone Number (optional) <br>
                                        Be more accessible to potential customers with Auto Attendant and Call Forwarding features. <br>
                                        Your own Local or Toll-Free Phone number with advanced features & voice over recordings for
                                        personalized messaging. <br>
                                        Benefit 4 – Live Receptionist (optional) <br>
                                        Never miss out on sales opportunities due to time differences or language barriers. <br>
                                        A Live receptionist will answer for you when you cannot. <br>
                                        ANNEXTrades - Your Bridge to Expansion and Increased Market Share. <br>
                                        If you have any questions or feedback, please reply to this email or call us
                                        Toll Free at: 1(800)123-8632. WhatsApp us at: https://wa.me/17728779454 <br>
                                        Visit us at: www.annextrades.com <br>
                                        Your Bridge to Expansion and Increased Market Share, <br>
                                    Establishing Companies in the United States <br>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end campaign tab one -->
                <!-- ============================================================== -->
            </div>
                    <!-- ============================================================== -->
                    <!-- end campaign data -->
                    <!-- ============================================================== -->
        </div>  
    </div>
        <!-- ============================================================== -->
        <!-- end content -->
            <?php include"footer.php"; ?> 
            <?php
            }
                else{ 
                            header('location: auth/');
                    } 
            ?>      