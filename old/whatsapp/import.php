<?php
// Load the database configuration file
include_once '../controller/config.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>
<style>
 .mrg-cont{
     margin: 30px;

 }
</style>
</head>
<body>
    <div class="container">
        <div class="mrg-cont">
            <h3 style="text-align: center;">Whatsapp NumbersMessage</h3>
            <!-- Import link -->
            <div class="mrg-cont text-left">
                <a href="index.php" class="btn btn-success"><i class="plus"></i> WHATSAPP MESSAGE</a>
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
            </div>
            <!-- Display status message -->
            <?php if(!empty($statusMsg)){ ?>
            <div class="col-xs-12">
                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
            </div>
            <?php } ?>
            <div class="row">
                <!-- CSV file upload form -->
                <div class="col-md-12 border" id="importFrm" style="display: none;">
                    <form class="mrg-cont" action="import_action.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                    </form>
                </div>

                <!-- Data list table --> 
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#ID</th>
                            <!-- <th>Name</th>
                            <th>Email</th> -->
                            <th>Phone</th>
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Get member rows
                    $result = $conn->query("SELECT * FROM whatsapp ORDER BY id ASC");
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <!-- <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td> -->
                            <td><?php echo $row['phonenumber']; ?></td>
                            <!-- <td><?php echo $row['status']; ?></td> -->
                        </tr>
                    <?php } }else{ ?>
                        <tr><td colspan="5">No member(s) found...</td></tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>