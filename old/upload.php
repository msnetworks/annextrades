<?php
include("db-connect/notfound.php");
$base_dir  = __DIR__;
$directoryPath = str_replace('admin', '', $base_dir);
$folder_name = $directoryPath . "/company_images/";

$http = $_SERVER['REQUEST_SCHEME'];
$host = $_SERVER['HTTP_HOST'];
$base_dir  = __DIR__;
$doc_root  = ($_SERVER["DOCUMENT_ROOT"]);
$base_url  = preg_replace("!^{$doc_root}!", '', $base_dir);
$directoryUrl = $http . "://" . $host . $base_url . "/company_images/";

$directoryUrl = str_replace('/admin', '', $directoryUrl);
define('directoryUrl', $directoryUrl);
$companyId = $_REQUEST['company_id'];



if (!empty($_FILES)) {
    $temp_file = $_FILES['file']['tmp_name'];
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = date('Ydmhis') . rand() . "." . $ext;
    $location = $folder_name . $fileName;
    move_uploaded_file($temp_file, $location);   

    $insertQuery = mysqli_query($con, "INSERT INTO company_images SET company_id = " . $companyId . ", image = '" . $fileName . "'") or mysqli_error("TEst");
}

if (isset($_REQUEST["name"])) {
    $filename = $folder_name . $_REQUEST["name"];
    $insertQuery = mysqli_query($con, "DELETE FROM company_images WHERE image = '" . $_REQUEST["name"]."'");
    unlink($filename);
}

$result = array();

//$files = scandir($folder_name);

// Fetch Images
$companyQuery = mysqli_query($con, "SELECT * FROM company_images WHERE company_id=". $companyId);
$output .= "";
$output .= '<div class="row">';
while ($row = mysqli_fetch_array($companyQuery)) :
    
    $output .= '<div class="col-md-3">
    <img src="' . directoryUrl . $row['image'] . '" class="img-thumbnail" width="175" height="175" style="height:175px;" />
    <button type="button" class="btn btn-link remove_image" id="' . $row['image'] . '">Remove</button>
   </div>
   ';
    
endwhile;
$output .= '</div>';

echo $output;