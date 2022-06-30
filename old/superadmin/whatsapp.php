<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query3=mysqli_query($conn, "SELECT * FROM `registration` WHERE id='".$_GET['id']."' ");
        $row_adv4=mysqli_fetch_array($query3);
        $query2=mysqli_query($conn, "SELECT * FROM `product` WHERE id='".$_GET['product_id']."' ");
            $row_adv2=mysqli_fetch_array($query2);
            
?>
    <?php include"header.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <!-- ============================================================== -->
                    <!-- pageheader -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h3 class="mb-2">Create New Campaign</h3><div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Create New Campaign</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- campaign data -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- campaign tab one -->
                            <!-- ============================================================== -->
                            <div class="card">

                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><h5>Campaign Detail</h5></div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" id="form" method="POST" action="controller/whatsapp.php" novalidate>
                                        <div class="row">
                                            
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="email">Message ID *</label>
                                                <input type="text" class="form-control" name="message">
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <br>
                                            </div> 
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="email">Contact Lot Name *</label>
                                                <select type="select" name="lot" class="form-control">
                                                    <?php 
                                                        $lot = $conn->query("SELECT * FROM whatsapp_lot ORDER by lot ASC");
                                                        while ($lots = mysqli_fetch_array($lot)) { 
                                                    ?>
                                                    <option value="<?php echo $lots['lot']; ?>" <?php if($lots['lot'] == 'Test'){ echo 'selected'; }?>><?php echo $lots['lot']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <br>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <button class="btn btn-primary" type="submit"><b>SUBMIT</b></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-right">
                                    <h4><a class="btn btn-success" href="import_contact.php">Import Contact</a></h4>
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