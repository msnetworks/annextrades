<?php include("includes/header.php"); ?>
<?php
if(isset($_REQUEST['succ'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;"> <?php echo $success_mail_msg; ?> </div>
<?php } ?>

<?php
if(isset($_REQUEST['suc'])) { ?>
<div style="padding-left:300px; color:#009900; font-weight:bold;"> <?php echo $update_success; ?> </div>
<?php } ?>



<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>



            <div class="body-right">

                <?php include("includes/menu.php"); ?>


                <?php 
                    $user_type=$fetch_log['usertype']; 
                    if($user_type==1) { $usertype="Buyer"; } elseif($user_type==2) { $usertype="seller"; }  elseif($user_type==3) { $usertype="Both Buyer & Seller"; }  else { $usertype="Not Mentioned"; }
                    $user_type=$fetch_log['gender']; 
                ?>
                <div class="tabs-cont">
                    <div class="left">
                        <div style="border:1px solid #F0EFF0;" class="bordersty">
                            <table cellpadding="0" cellspacing="0" width="100%" style="height:300px;">
                                <tr>
                                    <td width="80%" valign="top" style="padding-left:50px;">
                                        <table align="center" cellpadding="3" cellspacing="6" width="100%">
                                            <tr>
                                                <td width="36%"><?php echo $user_typeee; ?> </td>
                                                <td width="18%">:</td>
                                                <td width="46%"><?php echo $usertype; ?></td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td>First Name</td>
                                                <td>:</td>
                                                <td><?php echo $firstname; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Last Name</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['lastname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['gender']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telephone Number</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['phonenumber']; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mobile Number<?php echo $mbile_number; ?> </td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['mobile']; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Fax Number</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['faxnumber']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['street']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>City</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['city']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>State</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['state']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Country</td>
                                                <td>:</td>
                                                <td><?php echo country($fetch_log['country']); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Zipcode</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['zipcode']; ?></td>
                                            </tr>


                                            <tr>
                                                <td>Company Name</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['companyname']; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Paypal Id</td>
                                                <td>:</td>
                                                <td><?php echo $fetch_log['paypal_id']; ?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3">
                                                    <a href="editprofile.php" class="search_bg"
                                                        style="padding:3px 7px 3px 7px;">Edit Profile</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div>


                            </div>



                        </div>







                    </div>
                </div>





            </div>




        </div>


    </div>


</div>

<?php include("includes/footer.php"); ?>