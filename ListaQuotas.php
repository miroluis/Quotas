<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
session_start();
//if($_SESSION["Login"]="No"){
if(!isset($_SESSION['myusername']) ){
	//!session_is_registered(myusername)){
	header("location:main_login.php");
}
?>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Quotas</title>

	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">  

	<script language="JavaScript"></script> 

</head>
<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">
	<h1>Quotas do Ano 2011-2012</h1>

	<?php
	$host = "localhost";
	$username = "nfcportu_php";
	$password = "Php2012";
	mysql_connect($host, $username, $password) or die (mysql_error ());

	// Seleciona o Banco de Dados
	mysql_select_db("nfcportu_nfcconnect") or die(mysql_error());

	// Get data from the database depending on the value of the id in the URL
	//$strSQL = "SELECT * FROM entradas";
	$strSQL = "SELECT * ";
	$strSQL = $strSQL . " FROM elementos ";
	$rs = mysql_query($strSQL);
	
	//Print "<table border cellpadding=3>"; 
	Print "<table id = 'tabela' class='table table-bordered table-striped table-hover'>";

	Print "<tr>"; 
 		//<input type="checkbox" id="optionsCheckbox" value="option1">
	Print "<th><input type='checkbox' id='optionsCheckbox' value='option1'></th>";
	Print "<th>Nome</th> <th>Email</th><th>Secção</th><th>Quota</th><th>Recibo</th><th>Edit</th>";
	Print "</tr>";
	// Loop the recordset $rs
	while($row = mysql_fetch_array($rs)) {

		Print "<tr>"; 
 		Print "<td><input type='checkbox' id='optionsCheckbox' value='option1'></td>";//".$row['Plan'] . "
 		Print "<td>".$row['nome'] . "</td> "; 
 		Print "<td>".$row['email'] . " </td>";
		Print "<td>".$row['seccao'] ."</td>";//".$row['Plan'] . "
		Print "<td>"." </td>";
		Print "<td> </td>";//".$row['Remaning_Time'] . "
		$link = "<a href=/nfcconnect/EditaCartao.php?cardid=".$row['id_elementos'].">link</a>";//http://localhost
		Print "<td> ".$link." </td>";
		Print "</tr>"; 
	}
	Print "</table>"; 
	// Close the database connection
	mysql_close();	
	?>



	<a href="/nfcconnect/logout.php">Adiciona elemento</a>
	<br>
	<a href="/nfcconnect/logout.php">LogOut</a>

	  <div>
	
	    <h2>Today's date is:</h2>
	  
	    <span id="calendar"></span>
	  
	    <input type="button" id="myButton" value="Get Date" />
	
	
	  </div>

	<script type="text/javascript">
	
	  //Declare your function here
	
	  function showDate()
	
	  {
	
	  //the block of code starts here:
	
	  //First get all your vars ready
	
	  //This is how JavaScript retrieves today's date
	
	  var today = new Date();
	
	  //get hold of the calendar span element
	
	  //where today's date will be inserted
	
	  var myCalendar = document.getElementById("calendar");
	
	  //get hold of the button:you need this when it comes
	
	  //to change its value attribute
	
	  var myButton = document.getElementById("myButton");
	
	  //insert the date in the span element.
	
	  //toDateString() changes the date just retrieved
	
	  //into a user-friendly format for display
	
	  myCalendar.innerHTML = today.toDateString();
	
	  //change the value attribute of the button
	
	  //to say something more appropriate once the date is displayed
	
	  myButton.value = "Well done!";

	  console.log("clic");
	
	  }
	
	  </script>

 

<button class="btn btn-primary" onclick="showDate();">Adiciona mais amigos</button>
<br>

	<!--http://localhost-->
</body>
</html>
