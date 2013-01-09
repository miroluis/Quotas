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
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<script language="JavaScript"></script> 


	
</head>
<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">
	<h1 style='text-align:center'>Quotas do Ano 2011-2012</h1>
	<br><br>

	<div class='container' >
		<ul class="nav nav-tabs">
		

	<?php

		include('DBModel.php');

		LigaBD();

		ProcuraAnos();

	// Get data from the database depending on the value of the id in the URL
	//$strSQL = "SELECT * FROM entradas";
	$strSQL = "SELECT * ";
	$strSQL = $strSQL . " FROM elementos ";
	$rs = mysql_query($strSQL);

    //Print "<div class='container' >";

	Print "<table id = 'tabela' class='table table-bordered table-striped table-hover'>";

	Print "<tr>"; 
 		//<input type="checkbox" id="optionsCheckbox" value="option1">
	Print "<th><input type='checkbox' id='optionsCheckboxgeral'	onclick='updateCheckboxes();'></th> ";
	Print "<th>Nome</th> <th>Email</th><th>Secção</th><th>Quota</th><th>Recibo</th><th>Acção</th>";
	Print "</tr>";
	// Loop the recordset $rs
	while($row = mysql_fetch_array($rs)) {

		Print "<tr>"; 
 		Print "<td><input type='checkbox' id='entryCheckbox'></td>";//".$row['Plan'] . "
 		Print "<td>".$row['nome'] . "</td> "; 
 		Print "<td>".$row['email'] . " </td>";
		Print "<td>".$row['seccao'] ."</td>";//".$row['Plan'] . "
		Print "<td>".$row['quota']. " </td>";
		Print "<td>" .$row['recibo']. "</td>";//".$row['Remaning_Time'] . "
		Print "<td><div class='btn-group'><button class='btn btn-mini' id='editBtn' onclick='editRow(this);'><i class='icon-pencil'></i></button><button class='btn btn-mini' id='teste' onclick='moveRow(this,true);'><i class='icon-chevron-up'></i></button><button class='btn btn-mini' id='teste2' onclick='moveRow(this,false);'><i class='icon-chevron-down'></i></button><button class='btn btn-mini btn-warning' onclick='removeRow(this);'><i class='icon-remove'></i></button></div></td>";
		Print "</tr>"; 
	}
	Print "</table>"; 
	// Close the database connection
	mysql_close();	
	?>

    


	
		<!--<div class="btn-group span5">-->
			<a class="btn btn-primary" type="button" onclick='insnewRow();'>Adicionar elemento</a>
			<a class="btn btn-primary inline" type="button" onclick='saveTable();'>Guardar nova ordem</a>
		<!--</div>-->
	</div>
	<br><br>
	
			<div class="btn-group">
                <button class="btn btn-info">Selecionar</button>
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="#home">Devedores</a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
                

	<div style="text-align:center">
    	
      	Escreva aqui o e-mail a ser enviado:
    	<br>
    	<form>
	    	<textarea class="field span10" id="textareaemail" name="textareEmail" rows="5" placeholder="Introduza o texto a enviar..."></textarea>
	    	<br>
	    	<button class="btn btn-primary" onclick='sendemail();' type="button">Send</button>
	    	<br><br>
    	</form>
    	<div class="alert fade in" id="alertaid" style="display:none; width:300px; text-align:center;">
    		<button type="button" class="close">&times;</button>
    		Your error message goes here...
		</div>
	</div>

 	<br>
	<a href="logout.php">LogOut</a>


	

	
	<script type="text/javascript">

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
				

				var table=document.getElementById("tabela");
				var tablerows = table.rows;
				var cells;

				for(var i=1;i<(tablerows.length);i++ )
				{
					cells = tablerows[i].cells;
					
					if(cells[0].childNodes[0].id == document.getElementById('entryCheckbox').id)
					{
						if(cells[0].childNodes[0].checked)
						{
							var name = cells[1].innerHTML;
							var email = cells[2].innerHTML;
							var text = getEmailText();
							//send e-mail code block here
							
							$.post("email_man.php", { to : email, subject : name, body : text},
							function(data) {
							alert(data);
							
							});

							
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
			
			a.innerHTML="<td><input type='checkbox' id='entryCheckbox' value='option1'></td>";
			b.innerHTML="<td><input type='text' id='txtNome' style='width:100px' placeholder='Nome...'></td>";
			c.innerHTML="<td><input type='text' id='txtEmail' style='width:100px' placeholder='Email...'></td>";
			d.innerHTML="<td><select id='comboSeccao'><option>Lobitos</option><option>Exploradores</option><option>Pioneiros</option><option>Caminheiros</option><option>Chefes</option></select></td>";
			e.innerHTML="<td><input type='text' id='txtQuota' style='width:100px' placeholder='Quota...'></td>";
			f.innerHTML="<td><input type='text' id='txtRecibo' style='width:100px' placeholder='Recibo...'></td>";
			g.innerHTML="<td><div class='btn-group'><button class='btn btn-mini btn-warning' id='teste1' onclick='fixontable(this);'><i class='icon-ok'></i></button><button class='btn btn-mini' id='teste' onclick='moveRow(this,true);'><i class='icon-chevron-up'></i></button><button class='btn btn-mini' id='teste2' onclick='moveRow(this,false);'><i class='icon-chevron-down'></i></button><button class='btn btn-mini btn-warning' onclick='removeRow(this);'><i class='icon-remove'></i></button></div></td>";

			updateCheckboxes();
		}
		

		function getEmailText()
		{
			var text = document.getElementById('textareaemail').value;
			return text;
		}

		function fixontable(ele)
		{
			var elem = ele;
			var currow = elem.parentNode.parentNode.parentNode;
			var cells_row = currow.cells;

			var curcells = currow.getElementsByTagName('td');
			var a = curcells[1].childNodes[0].value;
			var b = curcells[2].childNodes[0].value;
			var c = curcells[3].childNodes[0].value;
			var d = curcells[4].childNodes[0].value;
			var e = curcells[5].childNodes[0].value;

			cells_row[1].innerHTML = a;
			cells_row[2].innerHTML = b;
			cells_row[3].innerHTML = c;
			cells_row[4].innerHTML = d;
			cells_row[5].innerHTML = e;
			cells_row[6].innerHTML = "<div class='btn-group'><button class='btn btn-mini' id='editBtn' onclick='editRow(this);'><i class='icon-pencil'></i></button><button class='btn btn-mini' id='teste' onclick='moveRow(this,true);'><i class='icon-chevron-up'></i></button><button class='btn btn-mini' id='teste2' onclick='moveRow(this,false);'><i class='icon-chevron-down'></i></button><button class='btn btn-mini btn-warning' onclick='removeRow(this);'><i class='icon-remove'></i></button></div>";

			var query = "INSERT into elementos (nome,email,seccao,quota,recibo) values ('"+a+"','"+b+"','"+c+"','"+d+"','"+e+"');";
				$.post("managedb.php", { sql_query : query},
					function(data) {
					alert("Insert return: " + data);
					});
		}

		function saveTable()
		{
			
			var querys = "TRUNCATE TABLE elementos;";
			$.post("managedb.php", { sql_query : querys},
					function(data) {
					alert("Truncate return: " + data);
					var tablerows = document.getElementById('tabela').rows;

					for(var i=1;i<tablerows.length;i++)
					{
						var row = tablerows[i];
						var cells = row.getElementsByTagName('td');
						var a = cells[1].innerHTML;
						var b = cells[2].innerHTML;
						var c = cells[3].innerHTML;
						var d = cells[4].innerHTML;
						var e = cells[5].innerHTML;
						

						var query = "INSERT into elementos (nome,email,seccao,quota,recibo) values ('"+a+"','"+b+"','"+c+"','"+d+"','"+e+"');";
						$.post("managedb.php", { sql_query : query},
							function(data) {
								alert("Insert return: " + data);
							});
					}
					});

			

			
		}

		function moveRow(trigger, up)
		{
			var curRow = trigger.parentNode.parentNode.parentElement;
			var index = curRow.rowIndex;

			var x = null;

			if(up)
			{
				if(--index != 0)
				{
					x=document.getElementById('tabela').insertRow(index);
				
				}
			}
			else
			{
				if((++index) != (curRow.parentElement.length - 1))
				{
					
					x=document.getElementById('tabela').insertRow(++index);
				
				}
			}

			if(x != null)
			{
				var a=x.insertCell(0);
				var b=x.insertCell(1);
				var c=x.insertCell(2);
				var d=x.insertCell(3);
				var e=x.insertCell(4);
				var f=x.insertCell(5);
				var g=x.insertCell(6);
				
				var cells_row = curRow.cells;
				
				a.innerHTML=cells_row[0].innerHTML;
				b.innerHTML=cells_row[1].innerHTML;
				c.innerHTML=cells_row[2].innerHTML;
				d.innerHTML=cells_row[3].innerHTML;
				e.innerHTML=cells_row[4].innerHTML;
				f.innerHTML=cells_row[5].innerHTML;
				g.innerHTML=cells_row[6].innerHTML;
				curRow.parentElement.deleteRow(curRow.rowIndex);

				
			}
			
		}

		function removeRow(ele)
		{
			var row = ele.parentNode.parentNode.parentNode;
			var cells = row.getElementsByTagName('td');
			var nome = cells[1].innerHTML;
			var email = cells[2].innerHTML;
			var table =document.getElementById('tabela');
			
			table.deleteRow(row.rowIndex);

			var query = "DELETE FROM elementos WHERE nome = '"+nome+"' AND email = '"+email+"';";
				$.post("managedb.php", { sql_query : query},
					function(data) {
					alert("Delete row return: " + data);
					window.location.reload();
					});
			
		}
		
	</script>

	<!--http://localhost-->
</body>
</html>
