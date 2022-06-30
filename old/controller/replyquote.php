
<?php include("config.php");
    $select="select * from getquote WHERE product_id = '".$_GET['p_id']."' and sender_vendor_id = '".$_GET['s_id']."' or rec_vendor_id = '".$_GET['s_id']."'  and rec_vendor_id = '".$_GET['r_id']."' or sender_vendor_id = '".$_GET['r_id']."' order by id ASC";
    $h = mysqli_query($conn,$select); 
    WHILE($g = mysqli_fetch_array($h)){ 
    if ($g['reply_by'] != $_GET['re_id']) {

    $reply = "<li class='message left appeared'>
        <div class='avatar' style='background-color: #fff!important;'><img src='https://annextrades.com/assets/images/annexis-emblem.png' style='width:60px;' alt=''></div>
        <div class='text_wrapper'>
            <div class='text' style='color: #574b4b;'".$g['quote']."</div>
            <div style='font-size: 12px; padding-top: 10px;' class='pull-right text'><b>Date Time:".$g['date']."</b></div>
        </div>
    </li>";
    }else{ 
    $result.="<input type='text' name='product_id' value=".$_GET['p_id']."' hidden />
    <li class='message right appeared'>
        <div class='avatar'>
            <div style='width: 60px; padding: 22.5px; color: #fff; font-weight: bold;'".$fn[0]." </div>
        </div>
        <div class='text_wrapper'>
            <div class='text' style='color: #574b4b;'>". $g['quote']."</div>
            <div style='font-size: 12px; padding-top: 10px;' class='pull-left text'><b>Date Time:".$g['date']." </b></div>
        </div>
    </li>";
} } 

echo $reply;

 
 ?>