<?php 
    include('../../controller/config.php');

    
    $query = $conn->query("UPDATE registration SET star_rating='".$_POST['rate']."' WHERE vendor_id='".$_POST['id']."' ");
      if ($query) {
        echo $_POST['rate'].$_POST['id'];

          //echo "<script>location.href='../registration_list.php';</script>";
      }else{
          echo $_POST['rate'].$_POST['id'];
      }

?>  