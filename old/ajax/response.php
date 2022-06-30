<?php
//include db configuration file
include_once("config.php");

if(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))
{	//continue only if POST value "recordToDelete" is available and it's numeric

	/* 
	sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT 
	removes all characters except digits, plus and minus sign.
	*/
 	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	$delete = mysqli_query($con,"update `tbl_seller` set trash='1' where `seller_id` = '".$idToDelete."' and user_id='209'");
	//try deleting record using the record ID we received from POST
	 
		//If mysql delete redord is unsuccessful out put error 
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
}
else
{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
mysqli_close($connecDB);
?>