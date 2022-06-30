<?php
	//session_start();
	//ob_start();
	
	include("../db-connect/notfound.php");
	if(!isset($_SESSION['adminusername']))
	{
		header("Location:index.php");
	}
	$sqlget=mysqli_query($con,"SELECT * FROM general");
	$row=mysqli_fetch_assoc($sqlget);
	
	if( isset($_REQUEST['mode']) ){
		$mode = $_REQUEST['mode'];
	}
	
	$cont_qry = "SELECT * FROM general";
	$cont_sql = mysqli_query($con,$cont_qry) or die( mysqli_error($con));
	$count = mysqli_num_rows($cont_sql);


	$policy = addslashes($_POST['policy']);
	$terms = addslashes($_POST['terms']);
	$about = addslashes($_POST['about']);
	
	
	if($count == 0){
		$sql = "INSERT INTO general(pripolicy, terms, about) VALUES('$policy', '$terms', '$about')";
	}
		
	if($mode == "privacy")
	{
		
		if($count > 0){
			$sql = "UPDATE general SET pripolicy = '$policy' ";
		}
		$suc_cont = "Privacy Policy content added successfully.";

	}else if($mode == "terms"){
		
				
		if($count > 0){
			$sql = "UPDATE general SET terms = '$terms' ";
		}
		$suc_cont = "Terms of Use content added successfully.";
		
	}else if($mode == "about"){
		
		
		if($count > 0){
			$sql = "UPDATE general SET about = '$about' ";
		}
		$suc_cont = "About Us content added successfully.";
		
	}
	
	$_SESSION['suc_cont'] = "<div class='menulinkadmin' style='text-decoration:none;'>$suc_cont</div>";
	
	$sql = mysqli_query($con,$sql) or die(mysqli_error($con));
	header("Location:pripolicy.php?mode=$mode");
	exit();
?>