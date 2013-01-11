<?php 
	session_start();
  //if($_SESSION["Login"]="No"){
  if(!isset($_SESSION['myusername']) ){
    //!session_is_registered(myusername)){
    header("location:main_login.php");
  }

  	$user = $_POST['user'];
  	$password = $_POST['password'];
  	$email = $_POST['email'];

	include('DBModel.php');
	ligaBD();

	//get curdb
	$cur_db_query = "SELECT * from users.curDB where id='0';";
	$rs_x = mysql_query($cur_db_query);
	$cur_db_rs = mysql_fetch_array($rs_x);
	$cur_db = $cur_db_rs[1];

	//add user
	$query = "INSERT INTO users.users (username,password,email,database_name) values ('".$user."','".$password."','".$email."','".$cur_db."');";
	$rs_y = mysql_query($query);
	
	closedb();

	header("location:index_quotas.php");

?>