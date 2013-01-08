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
<!DOCTYPE html>
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
	$username = "root";
	$password = "root";
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
	Print "<th><input type='checkbox' id='optionsCheckboxgeral' value='option1'	onclick='updateCheckboxes();'></th> ";
	Print "<th>Nome</th> <th>Email</th><th>Secção</th><th>Quota</th><th>Recibo</th><th>Edit</th>";
	Print "</tr>";
	// Loop the recordset $rs
	while($row = mysql_fetch_array($rs)) {

		Print "<tr>"; 
 		Print "<td><input type='checkbox' id='entryCheckbox' value='option1'></td>";//".$row['Plan'] . "
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

	<button class="btn btn-primary" type="button" onclick='insnewRow();'>Adicionar elemento</button>
	<br>
	
	<div class="centered-content">
    	
      	Escreva aqui o e-mail a ser enviado:
    	<br>

    	<textarea class="field span10" id="textareaemail" name="textareEmail" rows="5" placeholder="Introduza o texto a enviar..."></textarea>
    	<br>
    	<button class="btn btn-primary" type="button" onclick='sendemail();'>Send</button>
	</div>

	<a href="logout.php">LogOut</a>


	<script type="text/javascript">
	
	  //Declare your function here
	  function updateCheckboxes()
	  {
	  	var checkgeral = document.getElementById('optionsCheckboxgeral').checked;
	  	var inputs = document.getElementsByTagName('input');

	  	for(var i=0; i<inputs.length; i++){
	  		if(inputs[i].getAttribute('type')=='checkbox'){
	  			var ident = inputs[i].id;
	  			if(ident.indexOf('entryCheckbox') != -1)
	  				inputs[i].checked = checkgeral;
	  		}
	  	} 
	  }

		function sendemail()
		{
			var texto = document.getElementById('textareaemail').value;

			var table=document.getElementById("tabela");
			var tablerows = table.rows;
			var cells;

			for(var i=1;i<(tablerows.length);i++ )
			{
				cells = tablerows[i].getElementsByTagName('td');
				for(var j=0;j<(cells.length);j++ )
				{
					if(cells[j].childNodes[0].id == document.getElementById('entryCheckbox').id)
					{
						if(cells[j].childNodes[0].checked)
						{
							var name = cells[1].innerHTML;
							var email = cells[2].innerHTML;
							var text = getEmailText();
							//send e-mail code block here
							alert("name: " + name + "; email: " + email);
							break;
						}
					}
					
				}
			}
		
		}

		function insnewRow()
		{
			var x=document.getElementById('tabela').insertRow(document.getElementById('tabela').rows.length);
			var a=x.insertCell(0);
			var b=x.insertCell(1);
			var c=x.insertCell(2);
			var d=x.insertCell(3);
			var e=x.insertCell(4);
			var f=x.insertCell(5);
			var g=x.insertCell(6);
			
			a.innerHTML="<input type='checkbox' id='entryCheckbox' value='option1'>";
			b.innerHTML="Nome";
			c.innerHTML="Email";
			d.innerHTML="";
			e.innerHTML="";
			f.innerHTML="";
			g.innerHTML="";
			
		}
		
		function getEmailText()
		{
			var text = document.getElementById('textareaemail').value;
			return text;
		}
	</script>

	<!--http://localhost-->
</body>
</html>
