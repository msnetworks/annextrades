<?php

include("config.php");

        $query2=mysqli_query($conn, "SELECT * FROM `product` WHERE id='".$_GET['product_id']."' ");
            $row_adv2=mysqli_fetch_array($query2);

        $query3=mysqli_query($conn, "SELECT * FROM `registration` WHERE id='".$row_adv2['userid']."' ");
            $row_adv4=mysqli_fetch_array($query3);
        $cntry = $conn->query("SELECT * FROM country WHERE country_id = '".$row_adv2['country']."'");
            $country = mysqli_fetch_array($cntry);

        $cat = $conn->query("SELECT * FROM category WHERE c_id = '".$row_adv2['p_category']."'");
            $category = mysqli_fetch_array($cat);

        $subcat = $conn->query("SELECT * FROM category WHERE c_id = '".$row_adv2['p_subcategory']."'");
            $subcategory = mysqli_fetch_array($subcat);

        $packdetails = html_entity_decode($row_adv2['p_packingdetails']);
        $pddes =  html_entity_decode($row_adv2['p_ddes']);
        $pbdes = html_entity_decode($row_adv2['p_bdes']);


$product ="
    <form class='needs-validation' id='form' method='POST' enctype='multipart/form-data' action='controller/edit_product.php?product_id'". $_GET['product_id']."' novalidate>
        <div class='row'>
            <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustom01'>Product ID</label>
                <input type='text' class='form-control' id='validationCustom01' name='id' placeholder='Product Id' value='". $row_adv2['id']."' readonly>
            </div>
            <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustom01'>Company Name</label>
                <input type='text' class='form-control' id='validationCustom01' name='companyname' placeholder='Company Name' value='". $row_adv4['companyname']."' readonly>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
                <br>
            </div>
              <div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustom01'>Contact Person</label>
                <input type='text' class='form-control' id='validationCustom01' name='id' placeholder='Contact Person' value='". $row_adv4['firstname'].' '.$row_adv4['lastname']."' readonly>
            </div>
            <div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustom01'>Email</label>
                <input type='text' class='form-control' id='validationCustom01' name='id' placeholder='Email' value='". $row_adv4['email']."' readonly>
            </div>
            <div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustom01'>Phone</label>
                <input type='text' class='form-control' id='validationCustom01' name='id' placeholder='Phone' value='". $row_adv4['phonenumber']."' readonly>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
                <br>
            </div>
            <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 '>
                <label for='validationCustom01'>Product Name</label>
                <input type='text' class='form-control' name='p_name' id='validationCustom01' value='". $row_adv2['p_name']."'required >
                <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    Done
                </div>
            </div>
            <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 '>
                <label for='validationCustom02'>Keyword</label>
                <input type='text' class='form-control' name='p_keyword' id='validationCustom02' value='". $row_adv2['p_keyword']."' required>
                <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    Done
                </div>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br></div> 
            <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustomCate'>Category</label>
                <input type='text' name='p_category' class='form-control' value='". $category['category']."' id='validationCustomquantity'>
            </div>
            <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustomSC'>Sub Category</label>
                <input type='text' name='p_subcategory' class='form-control' value='". $subcategory['category']."' id='validationCustomquantity'>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustomCountry'>Country</label>
                <input type='text' name='country' class='form-control' value='". $country['country_name']."' id='validationCustomquantity'>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '><br></div>
            <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustomquantity'>Minimum Quantity</label>
                <input type='text' name='p_miniquantity' class='form-control' value='". $row_adv2['p_min_quanity']."' id='validationCustomquantity'>
                <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    Done
                </div>
            </div>
            <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12'>
                <label for='validationCustomquantity'>Minimum Quantity Unit</label>
                <input type='text' name='p_miniquantity' class='form-control' value='". $row_adv2['p_min_quanity']."' id='validationCustomquantity'>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label for='p-ddes'>Product Detail Description</label>
                <textarea name='text' class='form-control' id='p-ddes' required'".$pddes."</textarea>
                
                <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    Done
                </div>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label for='p-bdes'>Product Brief Description</label>
                <textarea name='p_bdes' class='form-control'id='p-bdes' required'".$pbdes."</textarea>
                
                <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    Done
                </div>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustomUnit'>Price Range</label>
                <div class='row'>
                    <div class='col-xl-2 col-lg-2 col-md-3 col-sm-3 col-3'>
                        <input type='text' name='unit' class='form-control' value='USD ($)*' id='validationCustomUnit' readonly>
                        <div class='invalid-feedback'>
                        Required
                        </div>
                        <div class='valid-feedback'>
                            Done
                        </div>
                    </div>
                    <div class='col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5'>
                    <input type='number' name='range1' class='form-control' placeholder='From' id='validationCustomUnit' required>
                        <div class='invalid-feedback'>
                        Required
                        </div>
                        <div class='valid-feedback'>
                            Done
                        </div>
                    </div>
                    <div class='col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5'>
                    <input type='number' name='range2' class='form-control' placeholder='To' id='validationCustomUnit' required>
                        <div class='invalid-feedback'>
                        Required
                        </div>
                        <div class='valid-feedback'>
                            Done
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label style='padding-right: 20px;' for='payment'>Payment Terms/label>
                <input type='radio' name='payment' value='L/C' id='lc'><label style='padding-right: 20px;' for='lc'>L/C</label>
                <input type='radio' name='payment' value='D/A' id='da'><label style='padding-right: 20px;' for='da'>D/A</label>
                <input type='radio' name='payment' value='D/P' id='dp'><label style='padding-right: 20px;' for='dp'>D/P</label>
                <input type='radio' name='payment' value='T/T' id='tt'><label style='padding-right: 20px;' for='tt'>T/T</label>
                <input type='radio' name='payment' value='Western Union' id='wu'><label style='padding-right: 20px;' for='wu'>Western Union</label>
                <input type='radio' name='payment' value='Money Gram' id='mg'><label style='padding-right: 20px;' for='mg'>Money Gram</label>
                <input type='radio' name='payment' value='Other' id='other'><label style='padding-right: 20px;' for='other'>Other</label>
                <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    Done
                </div>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label for='productionCapacity'>Production Capacity</label>
                <div class='row'>
                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4'>
                        <input type='numbers' name='p_capacity' class='form-control'  value='". $row_adv2['p_capaacity']."' id='productionCapacity'>
                        <div class='invalid-feedback'>
                        Required
                        </div>
                        <div class='valid-feedback'>
                            Done
                        </div>
                    </div>
                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4'>
                        <select type='select' name='capacity' class='form-control' id='productionUnit'>
                        <option value='>Select ProductioUnit</option>
                        <option value='Bag/Bags'>Bag/Bags</option>
                        <option value='Barrel/Barrels'>Barrel/Barrels</option>
                        <option value='Cubic Meter'>Cubic Meter</option>
                        <option value='Dozen'>Dozen</option>
                        <option value='Gallon'>Gallon</option>
                        <option value='Gram'>Gram</option>
                        <option value='Kilogram'>Kilogram</option>
                        <option value='Long Ton'>Long Ton</option>
                        <option value='Mertic Ton'>Mertic Ton</option>
                        <option value='Ounce'>Ounce</option>
                        <option value='Pair'>Pair</option>
                        <option value='Pack/Packs'>Pack/Packs</option>
                        <option value='Piece/Pieces'>Piece/Pieces</option>
                        <option value='Pound'>Pound</option>
                        <option value='Set/Sets'>Set/Sets</option>
                        <option value='Short Ton'>Short Ton</option>

                        </select>
                        <div class='invalid-feedback'>
                        Required
                        </div>
                        <div class='valid-feedback'>
                            Done
                        </div>
                    </div>
                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4'>
                        <select type='select' name='p_deliverytime' class='form-control' id='productionTime'>
                            <option value='>Select Timeoption>
                            <option value='Day'>Day</option>
                            <option value='Week'>Week</option>
                            <option value='Month'>Month</option>
                            <option value='Year'>Year</option>
                        </select>
                        <div class='invalid-feedback'>
                        Required
                        </div>
                        <div class='valid-feedback'>
                            Done
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label for='p-bdes'>Packaging Details</label>
                <textarea name='description' class='form-control' id='description''".$packdetails."</textarea>
               <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    Done
                </div>
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
                
                <!--input type='text' name='pho1' value='". $row_adv2['photo1']."' hidden/-->
                <!--input type='file' id='slogo1' name='photo1' class='inputfile'  /-->
                <label for='slogo1' style='height: 151px; width: 151px; border: 1px solid #333;'>
                <img id='blaha' style='width: 149px; height: 149px;' src='https://annextrades.com/productlogo/".$row_adv2['photo1']."' alt='Add Image 1' /></label>
               
            
                <!--input type='text' name='pho2' value='". $row_adv2['photo2']."' hidden/-->
                
                <!--input type='file' id='slogo2' name='photo2' class='inputfile'  /-->
                <label for='slogo2' style='height: 151px; width: 151px; border: 1px solid #333;'>
                <img id='blahb' style='width: 149px; height: 149px;' src='https://annextrades.com/productlogo/".$row_adv2['photo2']."' alt='Add Image 2' /></label>
                
            
                <!--input type='text' name='pho3' value='". $row_adv2['photo3']."' hidden/-->
                <!--input type='file' id='slogo7' name='photo3' class='inputfile'  /-->
                <label for='slogo7' style='height: 151px; width: 151px; border: 1px solid #333;'>
                <img id='blahc' style='width: 149px; height: 149px;'  src='https://annextrades.com/productlogo/".$row_adv2['photo3']."' alt='Add Image 3' /></label>
                
            
                <!--input type='text' name='pho4' value='". $row_adv2['photo4']."' hidden/-->
                
                <!--input type='file' id='slogo3' name='photo4' class='inputfile'  /-->
                <label for='slogo3' style='height: 151px; width: 151px; border: 1px solid #333;'>
                <img id='blahd' style='width: 149px; height: 149px;' src='https://annextrades.com/productlogo/".$row_adv2['photo4']."' alt='Add Image 4' /></label>
                
            
                <!--input type='text' name='pho5' value='". $row_adv2['photo5']."' hidden/-->
                <!--input type='file' id='slogo4' name='photo5' class='inputfile' /-->
                <label for='slogo4' style='height: 151px; width: 151px; border: 1px solid #333;'>
                <img id='blahe'  style='width: 149px; height: 149px;' src='https://annextrades.com/productlogo/".$row_adv2['photo5']."' alt='Add Image 5' /></label>
                
                
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '><br></div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                <label for='validationCustomDate'>Date of Update</label>
                <input type='datetime' name='date' class='form-control' value='". date('y.d.m')."' id='validationCustomdate' readonly>
                <div class='invalid-feedback'>
                Required
                </div>
                <div class='valid-feedback'>
                    <font color='#28a745'>Valid!</font>
                </div>
            </div>
            
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
                <br><br>
            </div>   
            <!--div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 '>
                <button class='btn btn-primary' type='submit'><b>UPDATE</b></button>
            </div-->
            <div class=ol-xl-8 col-lg-8md-12 col-sm-12 col-12 text-right'>
        "; 
        /* if ($row_adv2['status'] != '1'){ 
            $product.="<a hrefcontroller/statupdate.php?product_id'". $row_adv2['id']."&status=1&id'". $_GET['id']."' class='btn btn-dark'  style='color: #fff;'><b>DISAPPROVED</b></a>";
                } if ($row_adv2['status'] != '3'){
            $product.="<a hrefcontroller/statupdate.php?product_id'". $row_adv2['id']."&status=3&id'". $_GET['id']."' class='btn btn-warning'  style='color: #fff;'><b>EDITING REQUIRED</b></a>";
                } if($row_adv2['status'] != '2'){ 
            $product.="<a hrefcontroller/statupdate.php?product_id'". $row_adv2['id']."&status=2&id'". $_GET['id']."' class='btn btn-success'><b>APPROVE</b></a>";
                } */
            $product.="</div>
        </div>
    </form> ";
 
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: text/html; charset=utf-8");
    header("Content-Type: application/json");
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//$product = 'Working MS';
echo json_encode($product);
?>