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
	Print "<th><input type='checkbox' id='optionsCheckboxgeral'	onclick='updateCheckboxes();'></th> ";
	Print "<th>Nome</th> <th>Email</th><th>Secção</th><th>Quota</th><th>Recibo</th>";
	Print "</tr>";
	// Loop the recordset $rs
	while($row = mysql_fetch_array($rs)) {

		Print "<tr>"; 
 		Print "<td><input type='checkbox' id='entryCheckbox'></td>";//".$row['Plan'] . "
 		Print "<td>".$row['nome'] . "</td> "; 
 		Print "<td>".$row['email'] . " </td>";
		Print "<td>".$row['seccao'] ."</td>";//".$row['Plan'] . "
		Print "<td>"." </td>";
		Print "<td> </td>";//".$row['Remaning_Time'] . "
		
		Print "</tr>"; 
	}
	Print "</table>"; 
	// Close the database connection
	mysql_close();	
	?>


	<div class="btn-group">
    	<a class="btn btn-primary" type="button" onclick='insnewRow();' style='margin-left:35px;'>Adicionar elemento</a>
    	<a class="btn dropdown-toggle" id='actiondropdown' data-toggle="dropdown" href="#">
    		Action
    		<span class="caret"></span>
    	</a>
    	<ul class="dropdown-menu span3 offset2">
    		<li>
    			<a href="#">
    				Edit
    			</a>
    		</li>
    		<li>
    			<a href="#">
    				Remove
    			</a>
    		</li>
    	</ul>
    </div>
	<br>
	
	<div class="centered-content">
    	
      	Escreva aqui o e-mail a ser enviado:
    	<br>

    	<textarea class="field span10" id="textareaemail" name="textareEmail" rows="5" placeholder="Introduza o texto a enviar..."></textarea>
    	<br>
    	<button class="btn btn-primary" type="button" onclick='sendemail();'>Send</button>
    	<br><br>
    	<div class="alert fade in" id="alertaid" style="display:none; width:300px; text-align:center;">
    		<button type="button" class="close">&times;</button>
    		Your error message goes here...
		</div>
	</div>

    
 	<br>
	<a href="logout.php">LogOut</a>

	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	<script type="text/javascript">
	  var unsavedEntrys = new Array();
	 	
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
			if(!checkUnsavedChanges())
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
								alert("name: " + name + "; email: " + email + "; text: " + text);
								break;
							}
						}
						
					}
				}
			}
			else
			{
				newalert('Existem elementos por guardar!');
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

			var rows_tab = document.getElementById('tabela').rows;
			unsavedEntrys[unsavedEntrys.length] = rows_tab[(rows_tab.length - 1)];
			updateCheckboxes();
		}
		
		function checkUnsavedChanges()
		{
			if(unsavedEntrys.length > 0) return true;

			return false;

		}

		function getEmailText()
		{
			var text = document.getElementById('textareaemail').value;
			return text;
		}

		function newalert(text)
		{
			$("#alertaid").show();
			document.getElementById('alertaid').innerHTML = "<button type='button' class='close'>&times;</button>" + text;
		}

		
		$('.alert .close').live("click", function(e) {
    	$(this).parent().hide();
});
		
	</script>

	<!--http://localhost-->
</body>
</html>
