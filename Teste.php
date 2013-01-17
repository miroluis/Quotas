<?php

$host = "localhost";
	$username = "nfcportu_php";//nfcportu_php";
	$password = "Php2012";//Php2012";
	mysql_connect($host, $username, $password) or die (mysql_error ());
Print "antes criar";

//$nomeTabela = new String

//$new_db = "teste";

//$q_1 = "CREATE DATABASE `".$new_db."` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";
$res = 	mysql_select_db("nfcportu_quotas") or die(mysql_error());
    //$q_2 = "USE `"."a9921428_quotas"."`";
    //	$res =  mysql_query($q_2);
	Print $res;


      $q_3 = "select * from Joao_configura_email";
	$res =  mysql_query($q_3);

	$row = mysql_fetch_array($res);

	Print $res;
	print("<br>");
	Print($row['email']);
mysql_close();

?>