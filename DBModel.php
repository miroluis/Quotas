<?php

function LigaBD() {

	$host = "localhost";
	$username = "root";
	$password = "root";
	mysql_connect($host, $username, $password) or die (mysql_error ());

// Seleciona o Banco de Dados
	mysql_select_db("nfcportu_nfcconnect") or die(mysql_error());
}

function ProcuraAnos() {
		//Procura Anos Na Tabela Quotas
	$strSQL = "SHOW tables;";
	$rs = mysql_query($strSQL);

	while($row = mysql_fetch_array($rs)) {

		if(($row[0] != "users") && ($row[0] != "ano_activo"))
		{
		Print "<li class='active'>"; 
		Print "<a onclick='changeYear(this);'>".$row[0] . "</a> </li>\n";  		
		}
	}
	

	Print "<li><a id='novoanobtn' href='novoano.php?key='>Novo ano...</a></li>";
	Print "</ul>";

	}


	function setTable()
	{
		$ano = mysql_query("SELECT * FROM ano_activo;");
		$ano_f = mysql_fetch_array($ano);

		$strSQL = "SELECT * FROM ".$ano_f[1]." ;";
		$rs = mysql_query($strSQL);
		
		Print "<table id = 'tabela' name='".$ano_f[1] . "' class='table table-bordered table-striped table-hover'>";

		Print "<tr>"; 
	 		//<input type="checkbox" id="optionsCheckbox" value="option1">
		Print "<th><div class='btn-group'><button class='btn btn-info' onclick='checkUpdate(0);'>Selecionar</button><button class='btn btn-info dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button><ul class='dropdown-menu'><li><a onclick='checkUpdate(1);'>Devedores</a></li><li><a onclick='checkUpdate(2);'>Com recibo</a></li></ul></div></th> ";
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
			Print "<td><div class='btn-group'><button class='btn btn-mini btn-warning' id='editBtn' onclick='editRow(this);'><i class='icon-pencil'></i></button><button class='btn btn-mini btn-info' id='teste' onclick='moveRow(this,true);'><i class='icon-chevron-up'></i></button><button class='btn btn-mini btn-info' id='teste2' onclick='moveRow(this,false);'><i class='icon-chevron-down'></i></button><button class='btn btn-mini btn-danger' onclick='removeRow(this);'><i class='icon-remove'></i></button></div></td>";
			Print "</tr>"; 
		}
		Print "</table>"; 
		// Close the database connection

			
	}

	function closedb()
	{
		mysql_close();
	}
?>