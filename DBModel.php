<?php

  session_start();
  //if($_SESSION["Login"]="No"){
  if(!isset($_SESSION['myusername']) ){
    //!session_is_registered(myusername)){
    header("location:main_login.php");
  }
  

function LigaBD() {

	$host = "localhost";
	$username = "root";
	$password = "root";
	mysql_connect($host, $username, $password) or die (mysql_error ());

	$cur_db_query = "SELECT * from users.curDB where id='0';";
	$rs_x = mysql_query($cur_db_query);
	$cur_db_rs = mysql_fetch_array($rs_x);
	$cur_db = $cur_db_rs[1];

// Seleciona o Banco de Dados
	mysql_select_db($cur_db) or die(mysql_error());

}

function ProcuraAnos() {
	
	$cur_db_query = "SELECT * from users.curDB where id='0';";
	$rs_x = mysql_query($cur_db_query);
	$cur_db_rs = mysql_fetch_array($rs_x);
	$cur_db = $cur_db_rs[1];

	$curano_db_query = "SELECT * from ".$cur_db.".ano_activo where id='0';";
	$rs_ano = mysql_query($curano_db_query);
	$cur_ano_rs = mysql_fetch_array($rs_ano);
	$cur_ano = $cur_ano_rs[1];
	
	$strSQL = "SHOW tables;";
	$rs = mysql_query($strSQL);

	Print	"<br><p style='text-align:center' class='text-success'>".$cur_db." - ".$cur_ano."</p>";
	Print "<br><br>";

	Print "<div class='well container' >";
	Print "	<ul class='nav nav-tabs'>";

	while($row = mysql_fetch_array($rs)) {

		if(($row[0] != "ano_activo") && ($row[0] != "guarda_email"))
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

		if($order == "asc")
		{
		$strSQL = "SELECT * FROM ".$ano_f[1]." ORDER BY  ".$ano_f[1].".`nome` ASC;";
		}
		else if($order == "desc")
		{
		$strSQL = "SELECT * FROM ".$ano_f[1]." ORDER BY  ".$ano_f[1].".`nome` DESC;";
		}
		else
		{
			$strSQL = "SELECT * FROM ".$ano_f[1].";";
		}

		$rs = mysql_query($strSQL);
		
		Print "<table id = 'tabela' name='".$ano_f[1] . "' class='table table-hover'>";

		Print "<tr class='success'>"; 
	 		//<input type="checkbox" id="optionsCheckbox" value="option1">
		Print "<th><div class='btn-group'><button class='btn btn-info' onclick='checkUpdate(0);'>Selecionar</button><button class='btn btn-info dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button><ul class='dropdown-menu'><li><a onclick='checkUpdate(1);'>Devedores</a></li><li><a onclick='checkUpdate(2);'>Com recibo</a></li></ul></div></th> ";
		Print "<th>Nome</th> <th>Email</th><th>Secção</th><th>Quota</th><th>Recibo</th><th>Acção</th>";
		Print "</tr>";
		// Loop the recordset $rs
		while($row = mysql_fetch_array($rs)) {

			Print "<tr id='".$row['id']."'>"; 
	 		Print "<td><input type='checkbox' id='entryCheckbox'></td>";//".$row['Plan'] . "
	 		Print "<td>".$row['nome'] . "</td> "; 
	 		Print "<td>".$row['email'] . " </td>";
			Print "<td>".$row['seccao'] ."</td>";//".$row['Plan'] . "
			Print "<td>".$row['quota']. " </td>";
			Print "<td>" .$row['recibo']. "</td>";//".$row['Remaning_Time'] . "
			Print "<td><div class='btn-group'><button class='btn btn-mini btn-warning' id='editBtn' onclick='editRow(this);'><i class='icon-pencil'></i></button><button class='btn btn-mini btn-danger' onclick='removeRow(this);'><i class='icon-remove'></i></button></div></td>";
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