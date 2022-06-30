<?php 
    include('../../controller/config.php');
   
    $a=$conn->query("SELECT * FROM registration where email like '%annexisdirectory%'");
    ?>    
    <ul>
    <?php WHILE($b=mysqli_fetch_array($a)){
    ?>  
        <li><?php echo $b['id']." -> ".$b['vendor_id']." -> ".$b['companyname']." -> ".$b['firstname']; ?></li>
    <?php }
?>
</ul>    