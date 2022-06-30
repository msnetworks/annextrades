<?php 
    $con = new mysqli('localhost', 'root', 'Annexis@123', 'annexis_directory');
    $pbdes = htmlspecialchars($_POST['pbdes']);
    $pddes = htmlspecialchars($_POST['pddes']);
    if (isset($_POST['submit'])) {
    $q = mysqli_query($con, "UPDATE product SET p_bdes = '$pbdes', p_ddes = '$pddes' WHERE id='710'");
    if($q){
        echo 'done';
    }
    else{
        echo 'failed';
        display_errors();
    }
    }
    $d = $con->query("SELECT * FROM product where id = '".@$_GET['id']."'")
?>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<form action="" method="POST">
    
    <textarea name="pbdes" id="" cols="30" rows="10">
        Product Specification 
        Material Rubber 
        Usage/Application 
        Industrial Color 
        Black Thickness 5-30 mm 
        Shape Round Pack 
        Type Packet Brand 
        Fusion Polymer Industries
    </textarea>
    <textarea name="pddes" id="" cols="30" rows="10">
       
    </textarea>
    <input type="submit" name="submit" value="SUBMIT">
</form>
<script>
    CKEDITOR.replace('pbdes');
</script>
<script>
    CKEDITOR.replace('pddes');
</script>

