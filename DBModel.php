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
	$strSQL = "SELECT * ";
	$strSQL = $strSQL . " FROM quotas ";
	$rs = mysql_query($strSQL);

	while($row = mysql_fetch_array($rs)) {

		Print "<li class='active'>"; 
		Print "<a href='#'>".$row['ano'] . "</a> </li>";  		
	}


		//<li class="active">
		//		<a href="#">Home</a>
		//	</li>
		//	<li><a href="#">...</a></li>
		//	<li><a href="#">...</a></li>
	Print "</ul>";
}

?>