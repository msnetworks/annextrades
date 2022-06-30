<?php session_start();?>
<?php if(@$_SESSION['user_login']!=''){
	include("../registration/config.php");
	include'controller/select_fetch.php';
?>      
        <?php header('location:user_profile.php'); ?>
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
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Welcome</h2>
                            <p class="pageheader-text">Annexis Business Soluitons</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Home</li>
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
                                    <button class="btn btn-link collapsed col-xl-12" type="button" id="collap" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      
                                    </button>
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
					header('location: auth/');
            } 
        ?> 