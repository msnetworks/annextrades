<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Bulk Product</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add Bulk Product</h4>         
              <div class="box-container-toggle">
                <div class="box-content">
                  <center>
                    <form id="uploadForm" style="form {display: block; margin-top: 0em; padding: 15px !important;}" name="update_excel" action="" method="post" enctype="multipart/form-data">
                        <div class="tp-header text-center" style="padding-top:20px!important;">
                            <legend>Import CSV/Excel file</legend>
                        </div>
                        <div class="upld" style="margin:20px!important;">
                            <div class="">
                                <input type="file" name="file" id="FileName">
                            </div>
                            <div class="SuccessMgs display-none"></div>
                        </div>
                        <div class="controls">
                            <button type="submit" style="margin:20px!important;" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                        </div>
                    </form>
                  <!--div class="tp-upload-box">
                    <form id="uploadForm" style="form {display: block; margin-top: 0em; padding: 15px !important;}" name="update_excel" action="" method="post" enctype="multipart/form-data">
                        <div class="tp-header text-center" style="padding-top:20px!important;">
                            <legend>Import CSV/Excel file</legend>
                        </div>
                        <div class="tp-body upld" style="margin:20px!important;">
                            <div class="tp-file-upload">
                                <input type="file" name="file" id="FileName" class="tp-upload">
                                <label for="FileName" class="tp-uploader tp-b-dashed tp-b-radius-10 tp-bg-1" id="file-uploader">
                                    <span class="fa fa-cloud-upload"></span>
                                    <div class="selectFile">Choose a file</div>
                                    <div class="selectFile"><span class="done"></span></div>
                                </label>
                            </div>
                            <div class="SuccessMgs display-none"></div>
                        </div>
                        <div class="controls">
                            <button type="submit" style="margin:20px!important;" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                        </div>
                    </form>
                </div-->
                
                
                             

<?php

$conn = mysqli_connect('localhost', 'root', '', 'blog');
if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	          //It wiil insert a row to our subject table from our csv file`
	           $sql = "INSERT into product(id,	userid,	p_name,	p_keyword,	p_category,	p_subcategory, country,	p_photo,
               	p_bdes,	p_ddes,	p_price, range1, range2, paymenttype, p_min_quanity, p_quanity_type, p_capaacity, p_ctype, percapacity,
                    range12, p_delivertytime, p_packingdetails, udate, expiredate, status, lang_status, viewcount,	groupname,
                    photo1,	photo2,	photo3,	photo4,	photo5 ) 
	            	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]','$emapData[8]','$emapData[9]',
                    '$emapData[10]','$emapData[11]','$emapData[12]','$emapData[13]','$emapData[14]','$emapData[15]','$emapData[16]','$emapData[17]','$emapData[18]',
                    '$emapData[19]','$emapData[20]','$emapData[21]','$emapData[22]','$emapData[23]','$emapData[24]','$emapData[25]','$emapData[26]','$emapData[27]',
                    '$emapData[28]','$emapData[29]','$emapData[30]','$emapData[31]','$emapData[32]' )";
	         //we are using mysqli_query function. it returns a resource on true else False on error
	          $result = mysqli_query($conn, $sql,);
				if(! $result )
				{
					//echo "<script type=\"text/javascript\">
					//		alert('Invalid File:Please Upload CSV File.');
					//		window.location = \"add_bulk_product.php\"
					//	</script>";
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type='text/javascript'>
						alert('CSV File has been successfully Imported.');
						window.location ='add_bulk_product.php'
					</script>";
            //echo '<meta http-equiv="refresh" content="0;url=products_list.php">';
			 

			 //close of connection
			mysqli_close($conn); 
				
		 	
			
		 }
	}	
    

?></center>                               
                  </div>
              </div>
            </div>
        </div>
      </div>

 
    </div>
  </div>
  
<script>
    CKEDITOR.replace( 'content' );
</script>
<?php
include "footer.php";
?>