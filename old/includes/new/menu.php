<?php
    $currentFile = basename($_SERVER['PHP_SELF'], ".php");

    $firstCharacter = $firstname[0];
?>
 
<!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
</button-->
<div class="collapse navbar-collapse " id="collapsibleNavbar">
        <ul class="navbar-nav ">
                <li class="nav-item" style="background:<?php if ($currentFile == 'services' ||   $currentFile == 'servicecompanyinfo'){ ?>#2baae1;<?php }else{ ?> #ff7900;<?php }?> padding: 15px "><a style="color: #fff;" href="https://annextrades.com/chatnow"><b>HOW IT WORKS</b></a></li>
                <li class="nav-item">
                        <a class="nav-link <?php if ($currentFile == 'products' || $currentFile == 'productcompanyinfo' ){ ?>active<?php } ?>" href="products.php" style="font-size: 15px;"> <b>Products</b></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link <?php if ($currentFile == 'services' ||   $currentFile == 'servicecompanyinfo'){ ?>active1<?php } ?>" href="services.php" style="font-size: 15px;"><b>Services</b></a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link < ?php if ($currentFile == "contact") { ?>active< ?php } ?>" href="contact.php">Contact Us</a>
                </li> -->

                <?php if ($session_user == "") { ?>

                        <li class="nav-item">
                                <a class="nav-link " href="login.php" style="font-size: 15px;"><b>Sign In</b></a>
                                /<a class="nav-link " href="/registration/" style="font-size: 15px;"><b>Join Free</b></a>
                               <!--  /<a class="nav-link " href="http://annexis.net/registration/?package=BusinessPortal&source=Annextrades" style="font-size: 15px;"><b>Join Free</b></a> -->
                        </li>


                <?php } else { //echo $session_user; ?>
                        <?php 
                                $d= mysqli_query($con, "SELECT * FROM registration WHERE id='$session_user' ");
                                $data = mysqli_fetch_array($d);
                                $fn = $data['firstname'];    
                        ?>
                        <li class="nav-item">
                               <!--?php  if($firstname !=""){ ?-->
                               
                <div class="dropdown" tab="1">
                        <?php   

                       /*  @$sid = "/servicecompanyinfo.php?id=".$_GET['id']."&cid=".$_GET['cid']."&scid=".$_GET['scid'];
                        @$cid = "/services.php?category=".$_GET['category'];
                        @$ccid = "/services.php?page=2&qry=&category="; 
                        //echo $sid;
                                if($_SERVER['REQUEST_URI'] == '/service-categories.php' ||  $_SERVER['REQUEST_URI'] == '/services.php' || $_SERVER['REQUEST_URI'] == $cid || $_SERVER['REQUEST_URI'] == $sid || $_SERVER['REQUEST_URI'] == $ccid){
                        */
                        if ($currentFile == 'services' ||   $currentFile == 'servicecompanyinfo'){ 
                        ?>
                        <button class="dropbtn" style="color: #2baae1;"><?php echo $data['firstname']; ?>&nbsp; &nbsp;<span  style="background: #2baae1 !important;" class="name-round"><?php echo $fn[0]; ?></span> </button>
                        <?php }else{ ?>
                        <button class="dropbtn"><?php echo $data['firstname']; ?>&nbsp; &nbsp;<span class="name-round"><?php echo $fn[0]; ?></span> </button>
                        <?php } ?>
                        <div class="dropdown-content">
                                <a href="add_company.php">Dashboard</a>
                                <a href="myprofile.php">My profile</a>
                                <a href="logout.php">Logout</a>
                        </div>
                </div>  
                <!--?php  } 
                else{ ?-->
                <!--div class="dropdown">
                        <button class="dropbtn">My Account</button>
                        <div class="dropdown-content">
                        <a href="add_company.php">Dashboard</a>
                        <a href="myprofile.php">My profile</a>
                        <a href="logout.php">Logout</a>
                </div>
        </div>  
        
        < ?php } ?-->              

                                                              
                        </li>
                        
                <?php } ?>
                <?php 
                        /* @$sid = "/servicecompanyinfo.php?id=".$_GET['id']."&cid=".$_GET['cid']."&scid=".$_GET['scid'];
                        @$cid = "/services.php?category=".$_GET['category'];
                        @$ccid = "/services.php?page=2&qry=&category=";
                        //echo $sid;
                        if($_SERVER['REQUEST_URI'] == '/service-categories.php' ||  $_SERVER['REQUEST_URI'] == '/services.php' || $_SERVER['REQUEST_URI'] == $cid || $_SERVER['REQUEST_URI'] == $sid || $_SERVER['REQUEST_URI'] == $ccid){ */
                        if ($currentFile == 'services' ||   $currentFile == 'servicecompanyinfo'){
                ?>
                <li class="nav-item">
                   <?php if(isset($sess_id)){ ?><a class="nav-link btn-style btn-color-1" style="background: #2baae1 !important;" href="addbuying_leads.php">POST REQUEST</a>  <?php }else{ ?><a class="nav-link btn-style btn-color-1" style="background: #2baae1 !important;" href="login.php">POST REQUEST</a>  <?php } ?>
                </li>
                <?php } else{ ?>
                <li class="nav-item">
                   <?php if(isset($sess_id)){ ?><a class="nav-link btn-style btn-color-1" href="addbuying_leads.php">POST REQUEST</a>  <?php }else{ ?><a class="nav-link btn-style btn-color-1" href="login.php">POST REQUEST</a>  <?php } ?>
                </li>
                <?php } ?>
        </ul>
</div>