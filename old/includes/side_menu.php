<?php include("includes/sess_check.php");  ?>
<div class="cate-cont">
    <div class="cate-list-cont">
        <ul>
            <?php
                 $select=mysqli_query($con,"select * from registration where id='$session_user' ");
                 $count=mysqli_num_rows($select);
                 $array=mysqli_fetch_array($select);
            ?>
            <div class="technology"><a href="myprofile.php"> <i class="fa fa-user-circle"></i>
                    Account Setting<!-- < ?php echo $account_settings; ?> --></a></div>

            <div class="thelanguage">
                <ul>
                    <li><a href="myprofile.php">- My Profile<!-- < ?php echo $my_profile; ?> --></a></li>
                    <li><a href="changepass.php">- Change Password<!-- < ?php echo $change_pass; ?> --></a></li>
                    <li><a href="editprofile.php">- Edit Profile<!-- < ?php echo $edit_profile; ?> --> </a></li>
                </ul>
            </div>

            <div class="technology"><a href="myprofile.php"> 
			<i class="fa fa-info-circle"></i> Member Details<!-- < ?php echo $member_details; ?> --></a></div>  

            

            <div class="thelanguage">
                <ul>
                    <li><a href="membership.php">- Upgrade Membership<!-- < ?php echo $upgrade_membership; ?> --></a></li>
                </ul>
            </div>
             <!-- <div class="technology"><a href="notifications.php"> 
            <i class="fa fa-bell" aria-hidden="true"></i> Notifications </a></div> -->
            <div class="technology"><a href="add_company.php"> 
            <i class="fa fa-industry" aria-hidden="true"></i> Add Company </a></div>

            <!-- <div class="thelanguage">
                <ul>    
                    <li><a href="company.php">- Company Details</a></li>
                    <li><a href="editcompany.php">- Edit Company</a></li>
                    
                </ul>
            </div> -->

            <!-- <div class="technology"><a href="myprofile.php"> <i class="fa fa-id-card"></i> < ?php echo $my_page; ?></a>
            </div>

            <div class="thelanguage">
                <ul>
                    <li><a href="mypage.php">- < ?php echo $my_page; ?></a></li>
                </ul>
            </div> -->


            <!-- <div class="technology"><a href="companyprofile.php"> <i class="fa fa-building"></i> < ?php echo $com_profile; ?></a></div>
            <?php 
                $select_comp="SELECT * FROM companyprofile WHERE user_id='$session_user'";
                $res_comp=mysqli_query($con,$select_comp);
                $num_comp=mysqli_num_rows($res_comp);
                if($num_comp==0)
                {
            ?>
            <div class="thelanguage">
                <ul>
                    <li><a href="add_company.php"> - < ?php echo $add_company; ?></a></li>
                </ul>
            </div>
            <?php } else { ?>
            <div class="thelanguage">
                <ul>
                    <li><a href="company.php">- < ?php echo $com_profile; ?></a></li>
                    <li><a href="editcompany.php">- < ?php echo $edit_company; ?></a></li>
                </ul>
            </div>

            <?php } ?> -->

            <div class="technology"><a href="mycontacts.php"> <i class="fa fa-address-book"></i> Contacts</a></div>

            <div class="thelanguage">
                <ul>
                    <li><a href="addcontact.php">- Add Contact</a></li>
                    <li><a href="mycontacts.php">- Contact List</a></li>
                    <li><a href="myblocklist.php">- Block List</a></li>
                    <li><a href="add_block_list.php">- Add Block List</a></li>
                    <li><a href="matching_buyers.php">- Matching Buyer</a></li>
                    <li><a href="matching_sellers.php">- Matching Sellers</a></li>
                </ul>
            </div>
            <?php if($array['usertype'] != 'Buyer'){ ?>
                <div class="technology">
                    <a href="my_products.php"> <i class="fa fa-cart-plus"></i> Products</a></div>

                <div class="thelanguage">
                    <ul>
                        <li><a href="my_products.php">- Manage Products </a></li>
                        <li><a href="add_product.php">- Add Products </a></li>
                        <li><a href="mng_ProPhotos.php">- Manage Product Photos </a></li>
                    </ul>
                </div>

                <div class="technology">
                    <a href="my_products.php"> <i class="fa fa-filter"></i> Selling Leads</a></div>

                <div class="thelanguage">
                    <ul>
                        <li><a href="selling_leads.php">- Selling Lead </a></li>
                        <li><a href="addsell_leads.php">- Add Selling Lead </a></li>
                    </ul>
                </div>
            <?php } ?>

            <div class="technology">
                <a href="my_products.php"> <i class="fa fa-suitcase"></i> Buy Leads</a></div>

            <div class="thelanguage">
                <ul>
                    <li><a href="buying_leads.php">- Manage Buying Leads </a></li>
                    <li><a href="addbuying_leads.php">- Add Buy </a></li>
                </ul>
            </div>

            <div class="technology">
                <a href="my_products.php"> <i class="fa fa-eye"></i> Trades</a></div>

            <div class="thelanguage">
                <ul>
                    <li><a href="trade_list.php">- Trade List</a></li>
                    <!--<li><a href="tradeshow.php">- Trade show </a></li>-->
                </ul>
            </div>

            <div class="technology">
                <a href="#"> <i class="fa fa-envelope-square"></i> Quote Requests</a></div>
            <?php 
                $select=mysqli_query($con,"select * from registration where id='$session_user' ");
                $count=mysqli_num_rows($select);
                $array=mysqli_fetch_array($select);
                $mail=$array['email'];
                $vendor_id = $array['vendor_id'];
                $sql_in=mysqli_query($con,"select * from getquote WHERE rec_vendor_id = '$vendor_id' AND status = '1' order by id desc");
                $count_in=mysqli_num_rows($sql_in);
                $sql_in1=mysqli_query($con,"select * from getquote WHERE sended_vendor_id = '$vendor_id' AND status = '1' order by id desc");
                $count_in1=mysqli_num_rows($sql_in1);
            ?>
            <div class="thelanguage">
                <ul>
                    <!-- <li><a href="compose.php">- Compose Mail<?php echo $compose_mail; ?></a></li> -->
                    <li><a href="requests.php">- Quote Request &nbsp;(<?php echo $count_in; ?>)</a></li>
                    <!-- <li><a href="send_request.php">- Sended Quote Request &nbsp;(<?php if($count_in1 == ''){ echo '0'; }else{ echo $count_in1;} ?>)</a></li>
                     -->
                    <!-- <li><a href="sentitems.php">- Sent Mail &nbsp;(<?php echo $count_sent; ?>)</a></li>
                    <li><a href="trash.php">- Trash &nbsp;(<?php echo $count_del; ?>)</a></li> -->
                </ul>
            </div>

            <div class="technology">
                <a href="#"> <i class="fa fa-envelope-square"></i> Mails</a></div>
            <?php 
                $select=mysqli_query($con,"select * from registration where id='$session_user' ");
                $count=mysqli_num_rows($select);
                $array=mysqli_fetch_array($select);
                $mail=$array['email'];
                
                $sql_in=mysqli_query($con,"select * from messages where from_mail not in (select contact_mail from `add_contacts` where status='1' and `user_id`='$session_user' ) and tostatus='0' and to_mail='$mail' order by `id` desc");
                $count_in=mysqli_num_rows($sql_in);
                
                $sql_sent=mysqli_query($con,"select * from `messages` where fromstatus='0' and user_id='$session_user' and from_mail='$mail'"); 
                $count_sent=mysqli_num_rows($sql_sent);
                
                $sql_del=mysqli_query($con,"select * from `messages` where  (tostatus='1' or fromstatus=1)  and (to_mail='$mail' or from_mail='$mail')"); 
                $count_del=mysqli_num_rows($sql_del);
            ?>
            <div class="thelanguage">
                <ul>
                    <li><a href="compose.php">- Compose Mail<?php echo $compose_mail; ?></a></li>
                    <li><a href="inbox.php">- Inbox &nbsp;(<?php echo $count_in; ?>)</a></li>
                    <li><a href="sentitems.php">- Sent Mail &nbsp;(<?php echo $count_sent; ?>)</a></li>
                    <li><a href="trash.php">- Trash &nbsp;(<?php echo $count_del; ?>)</a></li>
                </ul>
            </div>

           
        </ul>

    </div>

</div>