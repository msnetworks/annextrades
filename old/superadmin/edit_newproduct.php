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
        .modal-dialog {
            max-width: 1000px; 
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
                                <h3 class="mb-2">Edit Product</h3><div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12"><h5>Edit Product Details</h5></div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right"><h5>Current Status : 
                                            <?php if($row_adv2['status'] == '2') { ?>
                                                <font color="#28a745" >Approved</font>
                                            <?php }elseif($row_adv2['status'] == '1') { ?>
                                                <font color="#dc3545" >Not Approved</font>
                                            <?php }elseif($row_adv2['status'] == '3'){ ?>
                                                <font color="#dc3545" >Editing Required</font>
                                            <?php } ?>
                                        </h5></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" id="form" method="POST" enctype="multipart/form-data" action="controller/edit_product.php?product_id=<?php echo $_GET['product_id']; ?>&id=<?php echo $_GET['id']; ?>" novalidate>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Product ID</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="id" placeholder="Product Id" value="<?php echo $row_adv2['id']; ?>" readonly>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Company Name</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="companyname" placeholder="Company Name" value="<?php echo $row_adv4['companyname']; ?>" readonly>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Contact Person</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="id" placeholder="Contact Person" value="<?php echo $row_adv4['firstname']." ".$row_adv4['lastname']; ?>" readonly>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Email</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="id" placeholder="Email" value="<?php echo $row_adv4['email']; ?>" readonly>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Phone</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="id" placeholder="Phone" value="<?php echo $row_adv4['phonenumber']; ?>" readonly>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <br>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Product Name</label>
                                                <input type="text" class="form-control" name="p_name" id="validationCustom01" value="<?php echo $row_adv2['p_name'];?>"required >
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Keyword</label>
                                                <input type="text" class="form-control" name="p_keyword" id="validationCustom02" value="<?php echo $row_adv2['p_keyword'];?>">
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div> 
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomCate">Select Category</label>
                                                
                                                <select type="text" class="form-control" name="p_cat" id="validationCustomCate">
                                                    <option value="">Select Category</option>
                                                    <?php
                                                        if($row_adv4['type'] != 'Product'){
                                                            $cate = $conn->query("SELECT * FROM category where parent_id = ''");
                                                            }else{
                                                                $cate = $conn->query("SELECT * FROM category where parent_id = ''");
                                                            }
                                                        WHILE($category = mysqli_fetch_array($cate)){ ?>
                                                        <option value="<?php echo $category['c_id']; ?>" <?php if($row_adv2['p_category'] == $category['c_id']){ echo "selected"; } ?>><?php echo $category['category']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                                
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomSC">Select Sub Category</label>
                                                <select name="subcategory" class="form-control"  id="validationCustomSC">
                                                <?php if ($row_adv2['p_subcategory'] != "") {
                                                        $scate = $conn->query("SELECT * FROM category where c_id = '".$row_adv2['p_subcategory']."'");
                                                        $sbb = mysqli_fetch_array($scate);
                                                        echo "<option value='".$row_adv2['p_subcategory']."'>".$sbb['category']."</option>";
                                                    }else{
                                                        echo "<option value=''>Select Sub Category</option>"; }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomCountry">Select Country</label>
                                                <select name="country" name="country" class="form-control"  id="validationCustomCountry">
                                                    <option value="95">India</option>
                                                    <?php
                                                        $cntry = $conn->query("SELECT * FROM country");
                                                        WHILE($country = mysqli_fetch_array($cntry)){
                                                            echo "<option value = '".$country['country_id']."'>".$country['country_name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br></div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomquantity">Minimum Quantity</label>
                                                <input type="text" name="p_miniquantity" class="form-control" value="<?php echo $row_adv2['p_min_quanity']; ?>" required>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                                <label for="validationCustomquantity">Minimum Quantity Unit</label>
                                                <select type="select" name="p_quantity" class="form-control" id="productionUnit">
                                                <option value="">Select Quantity Unit</option>
                                                <option value="Bag/Bags" <?php if($row_adv2['p_quanity_type'] == 'Bag/Bags'){ echo "selected"; } ?>>Bag/Bags</option>
                                                <option value="Barrel/Barrels" <?php if($row_adv2['p_quanity_type'] == 'Barrel/Barrels'){ echo "selected"; } ?>>Barrel/Barrels</option>
                                                <option value="Cubic Meter" <?php if($row_adv2['p_quanity_type'] == 'Cubic Meter'){ echo "selected"; } ?>>Cubic Meter</option>
                                                <option value="Dozen" <?php if($row_adv2['p_quanity_type'] == 'Dozen'){ echo "selected"; } ?>>Dozen</option>
                                                <option value="Gallon" <?php if($row_adv2['p_quanity_type'] == 'Gallon'){ echo "selected"; } ?>>Gallon</option>
                                                <option value="Gram" <?php if($row_adv2['p_quanity_type'] == 'Gram'){ echo "selected"; } ?>>Gram</option>
                                                <option value="Kilogram" <?php if($row_adv2['p_quanity_type'] == 'Kilogram'){ echo "selected"; } ?>>Kilogram</option>
                                                <option value="Long Ton" <?php if($row_adv2['p_quanity_type'] == 'Long Ton'){ echo "selected"; } ?>>Long Ton</option>
                                                <option value="Mertic Ton" <?php if($row_adv2['p_quanity_type'] == 'Mertic Ton'){ echo "selected"; } ?>>Mertic Ton</option>
                                                <option value="Ounce" <?php if($row_adv2['p_quanity_type'] == 'Ounce'){ echo "selected"; } ?>>Ounce</option>
                                                <option value="Pair" <?php if($row_adv2['p_quanity_type'] == 'Pair'){ echo "selected"; } ?>>Pair</option>
                                                <option value="Pack/Packs" <?php if($row_adv2['p_quanity_type'] == 'Pack/Packs'){ echo "selected"; } ?>>Pack/Packs</option>
                                                <option value="Piece/Pieces" <?php if($row_adv2['p_quanity_type'] == 'Piece/Pieces'){ echo "selected"; } ?>>Piece/Pieces</option>
                                                <option value="Pound" <?php if($row_adv2['p_quanity_type'] == 'Pound'){ echo "selected"; } ?>>Pound</option>
                                                <option value="Set/Sets" <?php if($row_adv2['p_quanity_type'] == 'Set/Sets'){ echo "selected"; } ?>>Set/Sets</option>
                                                <option value="Short Ton" <?php if($row_adv2['p_quanity_type'] == 'Short Ton'){ echo "selected"; } ?>>Short Ton</option>

                                                </select>
                                                <div class="invalid-feedback">
                                                Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="p-ddes">Product Detail Description</label>
                                                <textarea name="p_ddes" class="form-control" id="p-ddes" required><?php echo html_entity_decode($row_adv2['p_ddes']); ?></textarea>
                                                <script>
                                                    CKEDITOR.replace('p-ddes')
                                                    /* ClassicEditor
                                                        .create( document.querySelector( '#p-ddes' ) )
                                                        .then (editor => {
                                                            editorTextarea = editor;
                                                            })
                                                            .catch (error => {
                                                                console.error (error);
                                                        }); */
                                                        
                                                        /* editor.on( 'required', function( evt ) {
                                                            editor.showNotification( 'This field is required.', 'warning' );
                                                            evt.cancel();
                                                        } ); */
                                                </script>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="p-bdes">Product Brief Description</label>
                                                <textarea name="p_bdes" class="form-control"id="p-bdes"><?php echo html_entity_decode($row_adv2['p_bdes']); ?></textarea>
                                                <script>
                                                    CKEDITOR.replace('p-bdes');
                                                    /* ClassicEditor
                                                        .create( document.querySelector( '#p-bdes' ) )
                                                        .then (editor => {
                                                            editorTextarea = editor;
                                                            })
                                                            .catch (error => {
                                                                console.error (error);
                                                        }); */
                                                </script>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustomUnit">Price Range</label>
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-3">
                                                        <input type="text" name="unit" class="form-control" value="USD ($)*" id="validationCustomUnit" readonly>
                                                        <div class="invalid-feedback">
                                                        Required
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Done
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                                        <input type="number" name="range1" class="form-control" placeholder="From" <?php if($row_adv2['range1'] != ''){ echo "value='".$row_adv2['range1']."'";} ?> id="validationCustomUnit">
                                                        <div class="invalid-feedback">
                                                        Required
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Done
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                                        <input type="number" name="range2" class="form-control" placeholder="To" <?php if($row_adv2['range2'] != ''){ echo "value='".$row_adv2['range2']."'";} ?>" id="validationCustomUnit">
                                                        <div class="invalid-feedback">
                                                        Required
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Done
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label style="padding-right: 20px;" for="payment">Payment Terms:</label>
                                                <input type="radio" name="payment" required value="L/C" <?php if($row_adv2['paymenttype']=='L/C'){ echo "checked";}; ?> id="lc"><label style="padding-right: 20px;" for="lc">L/C</label>
                                                <input type="radio" name="payment" required value="D/A" <?php if($row_adv2['paymenttype']=='D/A'){ echo "checked";}; ?> id="da"><label style="padding-right: 20px;" for="da">D/A</label>
                                                <input type="radio" name="payment" required value="D/P" <?php if($row_adv2['paymenttype']=='D/P'){ echo "checked";}; ?> id="dp"><label style="padding-right: 20px;" for="dp">D/P</label>
                                                <input type="radio" name="payment" required value="T/T" <?php if($row_adv2['paymenttype']=='T/T'){ echo "checked";}; ?> id="tt"><label style="padding-right: 20px;" for="tt">T/T</label>
                                                <input type="radio" name="payment" required value="Western Union" <?php if($row_adv2['paymenttype']=='Western Union'){ echo "checked";}; ?> id="wu"><label style="padding-right: 20px;" for="wu">Western Union</label>
                                                <input type="radio" name="payment" required value="Money Gram" <?php if($row_adv2['paymenttype']=='Money Gram'){ echo "checked";}; ?> id="mg"><label style="padding-right: 20px;" for="mg">Money Gram</label>
                                                <input type="radio" name="payment" required value="Other" <?php if($row_adv2['paymenttype']=='Other'){ echo "checked";}; ?> id="other"><label style="padding-right: 20px;" for="other">Other</label>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="productionCapacity">Production Capacity</label>
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                        <input type="numbers" name="p_capacity" class="form-control"  value="<?php echo $row_adv2['p_capaacity']; ?>" id="productionCapacity">
                                                        <div class="invalid-feedback">
                                                        Required
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Done
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                        <select type="select" name="capacity" class="form-control" id="productionUnit">
                                                        <option value="">Select Production Unit</option>
                                                        <option value="Bag/Bags" <?php if($row_adv2['p_ctype'] == 'Bag/Bags'){ echo "selected"; } ?>>Bag/Bags</option>
                                                        <option value="Barrel/Barrels" <?php if($row_adv2['p_ctype'] == 'Barrel/Barrels'){ echo "selected"; } ?>>Barrel/Barrels</option>
                                                        <option value="Cubic Meter" <?php if($row_adv2['p_ctype'] == 'Cubic Meter'){ echo "selected"; } ?>>Cubic Meter</option>
                                                        <option value="Dozen" <?php if($row_adv2['p_ctype'] == 'Dozen'){ echo "selected"; } ?>>Dozen</option>
                                                        <option value="Gallon" <?php if($row_adv2['p_ctype'] == 'Gallon'){ echo "selected"; } ?>>Gallon</option>
                                                        <option value="Gram" <?php if($row_adv2['p_ctype'] == 'Gram'){ echo "selected"; } ?>>Gram</option>
                                                        <option value="Kilogram" <?php if($row_adv2['p_ctype'] == 'Kilogram'){ echo "selected"; } ?>>Kilogram</option>
                                                        <option value="Long Ton" <?php if($row_adv2['p_ctype'] == 'Long Ton'){ echo "selected"; } ?>>Long Ton</option>
                                                        <option value="Mertic Ton" <?php if($row_adv2['p_ctype'] == 'Mertic Ton'){ echo "selected"; } ?>>Mertic Ton</option>
                                                        <option value="Ounce" <?php if($row_adv2['p_ctype'] == 'Ounce'){ echo "selected"; } ?>>Ounce</option>
                                                        <option value="Pair" <?php if($row_adv2['p_ctype'] == 'Pair'){ echo "selected"; } ?>>Pair</option>
                                                        <option value="Pack/Packs" <?php if($row_adv2['p_ctype'] == 'Pack/Packs'){ echo "selected"; } ?>>Pack/Packs</option>
                                                        <option value="Piece/Pieces" <?php if($row_adv2['p_ctype'] == 'Piece/Pieces'){ echo "selected"; } ?>>Piece/Pieces</option>
                                                        <option value="Pound" <?php if($row_adv2['p_ctype'] == 'Pound'){ echo "selected"; } ?>>Pound</option>
                                                        <option value="Set/Sets" <?php if($row_adv2['p_ctype'] == 'Set/Sets'){ echo "selected"; } ?>>Set/Sets</option>
                                                        <option value="Short Ton" <?php if($row_adv2['p_ctype'] == 'Short Ton'){ echo "selected"; } ?>>Short Ton</option>

                                                        </select>
                                                        <div class="invalid-feedback">
                                                        Required
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Done
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                        <select type="select" name="p_deliverytime" class="form-control" id="productionTime">
                                                            <option value="">Select Time</option>
                                                            <option value="Day" <?php if($row_adv2['p_delivertytime'] == 'Day'){ echo "selected"; } ?>>Day</option>
                                                            <option value="Week" <?php if($row_adv2['p_delivertytime'] == 'Week'){ echo "selected"; } ?>>Week</option>
                                                            <option value="Month" <?php if($row_adv2['p_delivertytime'] == 'Month'){ echo "selected"; } ?>>Month</option>
                                                            <option value="Year" <?php if($row_adv2['p_delivertytime'] == 'Year'){ echo "selected"; } ?>>Year</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                        Required
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Done
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="p-bdes">Packaging Details</label>
                                                <textarea name="description" class="form-control" id="description"><?php echo html_entity_decode($row_adv2['p_packingdetails']); ?></textarea>
                                                <script>
                                                    CKEDITOR.replace('description');
                                                    /* ClassicEditor
                                                        .create( document.querySelector( '#description' ) )
                                                        .then (editor => {
                                                            editorTextarea = editor;
                                                            })
                                                            .catch (error => {
                                                                console.error (error);
                                                        }); */
                                                </script>
                                                <div class="invalid-feedback">
                                                   Required
                                                </div>
                                                <div class="valid-feedback">
                                                    Done
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br></div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                
                                                <input type='text' name="pho1" value="<?php echo $row_adv2['photo1']; ?>" hidden/>
                                                <input type='file' id="slogo1" name="photo1" accept="image/x-png,image/gif,image/jpeg" class="inputfile" onchange="<?php echo "rll".$i; ?>(this);" />
                                                <label for="slogo1" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                <img id="blaha" style="width: 149px; height: 149px;" src="../productlogo/<?php echo $row_adv2['photo1']; ?>" alt="Add Image 1" /></label>
                                                <script>
                                                    function <?php echo "rll".$i; ?>(input) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#blaha')
                                                                    .attr('src', e.target.result)
                                                                    .width(149)
                                                                    .height(149);
                                                            };
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
                                                </script>
                                            
                                                <input type='text' name="pho2" value="<?php echo $row_adv2['photo2']; ?>" hidden/>
                                                <input type='file' id="slogo2" name="photo2" accept="image/x-png,image/gif,image/jpeg" class="inputfile" onchange="<?php echo "rlla".$i; ?>(this);" />
                                                <label for="slogo2" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                <img id="blahb" style="width: 149px; height: 149px;" src="../productlogo/<?php echo $row_adv2['photo2']; ?>" alt="Add Image 2" /></label>
                                                <script>
                                                
                                                    function <?php echo "rlla".$i; ?>(input) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#blahb')
                                                                    .attr('src', e.target.result)
                                                                    .width(149)
                                                                    .height(149);
                                                            };
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
                                                </script>
                                            
                                                <input type='text' name="pho3" value="<?php echo $row_adv2['photo3']; ?>" hidden/>
                                                <input type='file' id="slogo7" name="photo3" class="inputfile" accept="image/x-png,image/gif,image/jpeg" onchange="<?php echo "rl2".$i; ?>(this);" />
                                                <label for="slogo7" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                <img id="blahc" style="width: 149px; height: 149px;"  src="../productlogo/<?php echo $row_adv2['photo3']; ?>" alt="Add Image 3" /></label>
                                                <script>
                                                    function <?php echo "rl2".$i; ?>(input) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#blahc')
                                                                    .attr('src', e.target.result)
                                                                    .width(149)
                                                                    .height(149);
                                                            };
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
                                                </script>
                                            
                                                <input type='text' name="pho4" value="<?php echo $row_adv2['photo4']; ?>" hidden/>
                                                
                                                <input type='file' id="slogo3" name="photo4" class="inputfile" accept="image/x-png,image/gif,image/jpeg" onchange="<?php echo "rl3".$i; ?>(this);" />
                                                <label for="slogo3" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                <img id="blahd" style="width: 149px; height: 149px;" src="../productlogo/<?php echo $row_adv2['photo4']; ?>" alt="Add Image 4" /></label>
                                                <script>
                                                    function <?php echo "rl3".$i; ?>(input) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#blahd')
                                                                    .attr('src', e.target.result)
                                                                    .width(149)
                                                                    .height(149);
                                                            };
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
                                                </script>
                                            
                                                <input type='text' name="pho5" value="<?php echo $row_adv2['photo5']; ?>" hidden/>
                                                <input type='file' id="slogo4" name="photo5" class="inputfile" accept="image/x-png,image/gif,image/jpeg" onchange="<?php echo "rl4".$i; ?>(this);" />
                                                <label for="slogo4" style="height: 151px; width: 151px; border: 1px solid #333;">
                                                <img id="blahe"  style="width: 149px; height: 149px;" src="../productlogo/<?php echo $row_adv2['photo5']; ?>" alt="Add Image 5" /></label>
                                                <script>
                                                    function <?php echo "rl4".$i; ?>(input) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#blahe')
                                                                    .attr('src', e.target.result)
                                                                    .width(149)
                                                                    .height(149);
                                                            };
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
                                                </script>
                                                
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
                                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 text-right">
                                            <?php if ($row_adv2['status'] != '1'){ ?>
                                            <a href="controller/status_update.php?product_id=<?php echo $row_adv2['id']; ?>&status=1&id=<?php echo $_GET['id']; ?>" class="btn btn-dark"  style="color: #fff;"><b>DISAPPROVED</b></a>
                                            <?php } if ($row_adv2['status'] != '3'){ ?>
                                            <a data-toggle="modal" data-target="#myModal" href="#controller/status_update.php?product_id=<?php echo $row_adv2['id']; ?>&status=3&id=<?php echo $_GET['id']; ?>" class="btn btn-warning"  style="color: #fff;"><b>EDITING REQUIRED</b></a>
                                            
                                            <?php } if($row_adv2['status'] != '2'){ ?>
                                            <a href="controller/status_update.php?product_id=<?php echo $row_adv2['id']; ?>&status=2&id=<?php echo $_GET['id']; ?>" class="btn btn-success"><b>APPROVE</b></a>
                                            <?php } ?>
                                            <?php if($_SESSION['super_type'] == "superadmin"){ ?><a href="controller/delete_product.php?product_id=<?php echo $row_adv2['id']; ?>&status=2&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure wants to delete?')" class="btn btn-danger"><b>DELETE</b></a><?php } ?>
                                        </div>
                                        <!-- Modal Trigger -->
                                        <!-- Trigger the modal with a button -->

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">
                                                
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Editing Required</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="controller/status_update.php?product_id=<?php echo $row_adv2['id']; ?>&status=3&id=<?php echo $_GET['id']; ?>" method="post">
                                                            <textarea name="message" class="form-control" id="messge" cols="30" rows="10"></textarea><br>
                                                            <script>
                                                                CKEDITOR.replace('messge');
                                                            </script>
                                                            <input type="submit" class="btn btn-primary" value="SUBMIT">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                          <!-- Modal Trigger -->
                            
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