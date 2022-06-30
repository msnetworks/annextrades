<?php
    include'../config.php';

    $category_id = $_POST['category_id'];

    $sql ="SELECT * FROM service_subcategory WHERE category_id = '$category_id'";
    $result = mysqli_query($connect, $sql) or die( mysqli_error($connect));
    ?>
    <option value="">Select SubCategory</option>
    <?php
    while($row = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $row['id'];?>"><?php echo $row['subcategory'];?></option>
    <?php
    }
?>