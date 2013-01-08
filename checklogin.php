<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="root"; // Mysql password 
$db_name="nfcportu_nfcconnect"; // Database name 
$tbl_name="users"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Print "O que pedimos à base de dados foi <br>";
// Print $sql;
// Print "<br> e que tal? <br>";

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

	// Register $myusername, $mypassword and redirect to file "login_success.php"
//	session_start();

	//session_register("myusername");
	//session_register("mypassword"); 
	session_start();
	$_SESSION['myusername'] = $username;
	//$_SESSION['mypassword'] = 'val';
	header("location:index.php");//teste.php");
}
else {
	echo "Wrong Username or Password";
	header("location:ListaEntradas.php");
}
?>