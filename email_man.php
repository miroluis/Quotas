<?php
	session_start();
	//if($_SESSION["Login"]="No"){
	if(!isset($_SESSION['myusername']) ){
		//!session_is_registered(myusername)){
		header("location:main_login.php");
	}

	//$myusername=$_POST['myusername']; 
	$to = $_POST['to'];
	$subject = $_POST['subject'];
	$body = $_POST['body'];


	if(mail($to, $subject, $body))
	{
		echo "Sent to: ".$to;
	}
	else 
	{
		echo "Error.";
	}
?>