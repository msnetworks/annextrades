<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<?php include("includes/header.php"); 
echo $userid=$_SESSION['user_login'];

echo $sel_sql="select * from notification where seller_id='$userid'";
    $res_sel=mysqli_query($con,$sel_sql);
    $result_sel=mysqli_fetch_array($res_sel);
    print_r($result_sel);



?>




<div class="body-cont">

    <div class="body-cont1">
        <div class="company__container">
            <?php include("includes/side_menu.php"); ?>



            <div class="body-right">

                <?php include("includes/menu.php"); ?>


               
                <div class="tabs-cont">
                    <div class="left">
                        <div style="border:1px solid #F0EFF0;" class="bordersty">
                          

                            <div>
                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <?php
    echo '<pre>';
    print_r($result_sel); 
echo '</pre>';
?>
    <tr>
      <th class="th-sm">Sr.No

      </th>
      <th class="th-sm">From

      </th>
      <th class="th-sm">Date

      </th>
      <th class="th-sm">Action

      </th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Tiger Nixon</td>
      <td>System Architect</td>
      <td>Edinburgh</td>
      <td>Delete</td>
      
    </tr>
    
  </tbody>
  
</table>


                            </div>



                        </div>







                    </div>
                </div>





            </div>




        </div>


    </div>


</div>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>

<?php include("includes/footer.php"); ?>