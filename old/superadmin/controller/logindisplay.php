<?php
//action.php
include('../../controller/config.php');

 
/* 
  $query = "SELECT * FROM login_tracker";
  $statement = $conn->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $count = $statement->rowCount();
 */
    $output = "
        <div class='card'>
            <div class='card-header'>
                <div class='row'>
                    <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12'><h5>User List</h5></div>
                    <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-right'>
                        <h4>Total Active User :<font class='text-success'> $count</font></h4>
                    </div>
                </div>
            </div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered first' id='myTbl'  border='1'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Login Time</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>    
                        <tbody>";
                             
                            $i = 1;
                            $query1=mysqli_query($conn, 'SELECT * FROM login_tracker order by id desc');
                            WHILE($row_adv1=mysqli_fetch_array($query1)){

                            $quya1=mysqli_query($conn, "SELECT * FROM registration where vendor_id = '".$row_adv1['vendor_id']."'");
                            $rowr1=mysqli_fetch_array($quya1);
            $output.= "    <tr>
                                <td>".$i."</td>
                                <td>".$rowr1['firstname']." ".$rowr1['lastname']."</td>
                                <td>".$rowr1['companyname']."</td>
                                <td>".$rowr1['email']."</td>
                                <td>".$rowr1['phone']."</td>
                                <td>"; if($row_adv1['status'] != '0'){ 
                                    
            $output.= "              <font color='#28a745' >Online</font> ";
                                    }else {
                                    
            $output.= "             <font color='#dc3545' >Offline</font>";
                                     } 
            $output.= "         </td>
                            </tr>";
                            
                             $i++; } 
            $output.= " </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class='card-footer text-right'>
                <h4><a class='btn btn-success' href='add_user.php'><i class='fa fa-plus'></i> Add User</a></h4>
            </div> -->
        </div>
            
    ";




  /* $output .= '
  <div class="table-responsive">
   <div align="right">
    '.$count.' Users Online
   </div>
   <table class="table table-bordered table-striped">
    <tr>
     <th>No.</th>
     <th>Email ID</th>
     <th>Image</th>
    </tr>
  ';

  $i = 0;
  foreach($result as $row)
  {
   $i = $i + 1;
   $output .= '
   <tr> 
    <td>'.$i.'</td>
    <td>'.$row["user_email"].'</td>
    <td><img src="images/'.$row["user_image"].'" class="img-thumbnail" width="50" /></td>
   </tr>
   ';
  }
  $output .= '</table>
  </div>'; */
  echo $output;



?>