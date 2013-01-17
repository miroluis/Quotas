<?php

$host="localhost"; // Host name 
$username="nfcportu_php"; // Mysql username 
$password="Php2012"; // Mysql password 
$db_name="nfcportu_quotas"; // Database name 
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
	$cur_db_rs = mysql_fetch_array($result);
	$select_db = "UPDATE  curDB SET database_name='".$cur_db_rs[4]."' WHERE id='0';";
  	$r_tres = mysql_query($select_db);
	// Register $myusername, $mypassword and redirect to file "login_success.php"
//	session_start();

	//session_register("myusername");
	//session_register("mypassword"); 
	session_start();
	$_SESSION['myusername'] = $myusername;
	//$_SESSION['mypassword'] = 'val';
	mysql_close();
	header("location:index_quotas.php");
}
else {
	header("location:index.html?key=failed");
	mysql_close();
}

?>