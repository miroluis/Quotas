<?php
	$host = "localhost";
	$username = "root";
	$password = "root";
	mysql_connect($host, $username, $password) or die (mysql_error ());

	// Seleciona o Banco de Dados
	mysql_select_db("nfcportu_nfcconnect") or die(mysql_error());

	$nome=$_POST['nome']; 
	$email=$_POST['email']; 
	$seccao=$_POST['seccao']; 
	$quota=$_POST['quota']; 
	$recibo=$_POST['recibo']; 
	$sql = "insert into elementos (nome,email,seccao,quota,recibo) values ('"+nome+"','"+email+"','"+seccao+"','"+quota+"','"+recibo+"')";
	$result=mysql_query($sql);
	echo $result;
?>