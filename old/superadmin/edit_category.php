<?php session_start();?>
<?php if(@$_SESSION['super_adm']!=''){
    include("../controller/config.php");
        $query3=mysqli_query($conn, "SELECT * FROM `category` WHERE c_id='".$_GET['c_id']."' ");
        $row_adv2=mysqli_fetch_array($query3);
            
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
                                <h3 class="mb-2">Edit Category</h3><div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><h5>Edit Category Details</h5></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" id="form" method="POST" enctype="multipart/form-data" action="controller/edit_category.php?p_id=<?php echo $_GET['p_id']; ?>" novalidate>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Category ID</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="c_id" placeholder="Category Id" value="<?php echo $row_adv2['c_id']; ?>" readonly>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Category Name</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="companyname" placeholder="Company Name" value="<?php echo $row_adv2['category']; ?>">
                                            </div>
                                            
                                                
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomDate">Date of Update</label>
                                                <input type="datetime" name="date" class="form-control" value="<?php echo date('y.d.m'); ?>" id="validationCustomdate" readonly>
                                                <div class="invalid-feedback">
                                                Required
                                                </div>
                                                <div class="valid-feedback">
                                                    <font color="#28a745">Valid!</font>
                                                </div>
                                            </div>
                                            
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <br><br>
                                        </div>   
                                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                            <button class="btn btn-primary" type="submit"><b>UPDATE</b></button>
                                        </div>
                                    </div>
                                </form>
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
        
        <script>
            $('#validationCustomCate').on('change',function() {
                var category_id = $('#validationCustomCate').val();
                console.log(category_id);
            $.ajax({
            url: "categorysel.php",
            type: "POST",
            data: {
            category_id: category_id
            },
            cache: false,
            success: function(result){
                console.log(result);
                
            $("#validationCustomSC").html(result);
            }
            });
            });
        </script>
            <?php include"footer.php"; ?> 
            
            <?php
            }
                else{ 
                            header('location: auth/');
                    } 
            ?>      