<?php
	session_start();
	//if($_SESSION["Login"]="No"){
	if(!isset($_SESSION['myusername']) ){
		//!session_is_registered(myusername)){
		header("location:main_login.php");
	}
	
	$host = "localhost";
	$username = "root";
	$password = "root";
	mysql_connect($host, $username, $password) or die (mysql_error ());

	// Seleciona o Banco de Dados
	mysql_select_db("nfcportu_nfcconnect") or die(mysql_error());

	$sql_query=$_POST['sql_query']; 
	$get=$_POST['get']; 

	$result=mysql_query($sql_query);

	echo $result;
?>