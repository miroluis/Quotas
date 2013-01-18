<?php
	session_start();
	//if($_SESSION["Login"]="No"){
	if(!isset($_SESSION['myusername']) ){
		//!session_is_registered(myusername)){
		header("location:main_login.php");
	}

//echo "<script type='text/javascript'> alert('entrei managedb'); </script>"; 	
	$host = "localhost";
	$username = "root";
	$password = "root";
	mysql_connect($host, $username, $password) or die (mysql_error ());

	// Seleciona o Banco de Dados
/*
	$cur_db_query = "SELECT * from curDB where id='0';";
	$rs_x = mysql_query($cur_db_query);
	$cur_db_rs = mysql_fetch_array($rs_x);
	$cur_db = $cur_db_rs[1];
// Seleciona o Banco de Dados
	mysql_select_db($cur_db) or die(mysql_error());
*/
	mysql_select_db("nfcportu_quotas") or die(mysql_error());

	$sql_query=$_POST['sql_query']; 
	$get=$_POST['get']; 

//echo "<script type='text/javascript'> alert('". $sql_query."'); </script>"; 
	//$sql_query = "insert into c_exemplo (nome,email,seccao,quota,recibo) values ('u','','Lobitos','','')";
	
	$result=mysql_query(stripslashes($sql_query));



	mysql_close();
	echo $result;//stripslashes($sql_query);
	// $result;

?>