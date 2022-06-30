<?php
    include "db-connect/notfound";
    

    $payment = $_REQUEST['payment']; 
    $vndor = $_REQUEST['vndor']; 
    if ($payment == authorize) {
        ?>
        <form action="authorize-terminal/index.php" name="myForm"  5000 method="POST">
            <input type="text" name="vndor" value="<?php echo $vndor; ?>" hidden/>
            <input type="submit" name="next" class="next action-button" value="Submit" /> 
        </form>
    <?php } else{
    ?>
    <form action="paypal-terminal/index.php" name="myForm" method="POST">
        <input type="text" name="vndor" value="<?php echo $vndor; ?>" hidden/>
        <input type="submit" name="next" class="next action-button" value="Submit" /> 
    </form>
    <?php } ?>
    