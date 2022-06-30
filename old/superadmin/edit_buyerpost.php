<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query3=mysqli_query($conn, "SELECT * FROM `registration` WHERE id='".$_GET['id']."' ");
        $row_adv4=mysqli_fetch_array($query3);
        $query2=mysqli_query($conn, "SELECT * FROM `landing_post` WHERE id='".$_GET['id']."' ");
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
                            <h3 class="mb-2">Buyer Post</h3><div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Buyer Post</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><h5>Post Details</h5></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if ($_SESSION['msg'] == 'success') { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Edit Success!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php } ?>
                                <?php if ($_SESSION['msg'] == 'failed') { ?>
                                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Failed to edit.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php } ?>
                                <form class="needs-validation" action="controller/edit_buyer_post.php?id=<?php echo $_GET['id']; ?>" id="form" method="POST" name="myForm" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label for="firstname">Buyer Name *</label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $row_adv2['name']; ?>" id="firstname" required>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label for="firstname">Company Name *</label>
                                            <input type="text" class="form-control" name="companyname" value="<?php echo $row_adv2['companyname']; ?>" id="companynanme" required>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="lastname">Type *</label>
                                            <select name="user_type" class="form-control" id="type" required>
                                                <option <?php if($row_adv2['user_type']== 'Buyer'){ echo 'selected';}; ?> value="Buyer">Buyer</option>
                                                <option <?php if($row_adv2['user_type']== 'Seller'){ echo 'selected';}; ?> value="Seller">Seller</option>
                                                <option <?php if($row_adv2['user_type']== 'Service Provider'){ echo 'selected';}; ?> value="Service Provider">Service Provider</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                            <label for="firstname">Video Code *</label>
                                            <input type="text" class="form-control" name="video" value="<?php echo $row_adv2['video']; ?>" id="firstname" required>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <label for="lastname">Description</label>
                                            <textarea name="description" class="form-control" id="description" cols="30" rows="5"><?php echo $row_adv2['description']; ?></textarea>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustomDate">Date of Post</label>
                                            <input type="datetime" name="date" class="form-control" value="<?php echo date('y.d.m'); ?>" id="validationCustomdate" readonly>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                            <label for="validationCustomDate">Added By</label>
                                            <input type="text" name="added_by" class="form-control" value="<?php echo $_SESSION['super_name']; ?>" id="validationCustomdate" readonly>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <br><br>
                                        </div>   
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <button class="btn btn-primary" type="submit"><b>SUBMIT</b></button>
                                        </div>
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