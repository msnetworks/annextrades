<?php session_start();?>
<?php if(@$_SESSION['user_login']!=''){
    include("../registration/config.php");
    $query2=mysqli_query($con, "SELECT * FROM `registration` WHERE id='".$_SESSION['user_login']."' ");
    $row_adv2=mysqli_fetch_array($query2);
    if($row_adv2['expiry_date'] <
     date('Y-m-d H:i:s')){ 
?>      
    <?php include"header.php"; ?>
        <style>
            .dropdown-menu
            {
                background-color: #fff;
                border: 1 #5969ff;
                color: #5969ff;
            }
            .btn-secondary{
                background: #5969ff;
                border-color:  #333 !important;
                color: #fff;
            }
            .secondary.dropdown-toggle{
                background: #5969ff;
                border-color:  #333 !important;
                color: #fff;
            }
            .ho:hover{
                background-color: #4254fd !important;
            }
        </style>
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper" style="margin-left: 0px;">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Welcome</h2>
                            <p class="pageheader-text">Annexis Business Solutions</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Trail Exprie</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                  <h2 class="mb-0">
                                    Payment pending...!!
                                  </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
          <?php include"footer.php"; ?>
        
          <?php
            } 
            else{
                header('location: user_profile.php');
            }    
        } 
        else{ 
					header('location: auth/');
            } 
        ?> 