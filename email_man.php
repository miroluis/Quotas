<?php
  session_start();
  //if($_SESSION["Login"]="No"){
  if(!isset($_SESSION['myusername']) ){
    //!session_is_registered(myusername)){
    header("location:main_login.php");
  }
  
 require_once "Mail.php";
 include('DBModel.php');
 $from = "tesoureiro@cnepenela.com";//José Palaio <
  $to = $_POST['to'];
  $subject = $_POST['subject'];
  $body = $_POST['body'];
 
 //Guarda e-mail
  ligaBD();
  $strSQL = "INSERT into guarda_email (email,body) values ('".$to."','".$body."');";
  $rs = mysql_query($strSQL);
  closedb();

 $host = "smtp.gmail.com";
 $port = "587";
 $username = "tesoureiro@cnepenela.com";
 $password = "VillaPalaio2013";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
    'port' => $port,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 /*
 $mime = new Mail_mime($crlf);
$mime->setTXTBody("This is a test email message");
$mime->setHTMLBody($body);
$body = $mime->get();
$headers = $mime->headers($headers);
*/
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
    $strSQL = "INSERT into guarda_email (email,body) values ('".$to."','".$body."');";
  $rs = mysql_query($strSQL);
  if($rs == "1")
   echo("<p>Message successfully sent!</p>");
  }
 ?>