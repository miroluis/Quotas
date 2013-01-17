<?php

  session_start();
  //if($_SESSION["Login"]="No"){
  if(!isset($_SESSION['myusername']) ){
    //!session_is_registered(myusername)){
    header("location:main_login.php");
  }
  

function LigaBD() {

	$host = "localhost";
	$username = "nfcportu_php";
	$password = "Php2012";
	mysql_connect($host, $username, $password) or die (mysql_error ());

//não é necessário seleccionar a BD pois é sempre a mesma mudam é as tabelas
/*	$cur_db_query = "SELECT * from curDB where id='0';";
	$rs_x = mysql_query($cur_db_query);
	$cur_db_rs = mysql_fetch_array($rs_x);
	$cur_db = $cur_db_rs[1];

// Seleciona o Banco de Dados
	mysql_select_db($cur_db) or die(mysql_error());
*/
	mysql_select_db("nfcportu_quotas") or die(mysql_error());
	//$q_2 = "USE `"."a9921428_quotas"."`";
}

function ProcuraDBselect(){
	//procura o agrupamento seleccionado
	//SELECT * FROM `curDB` WHERE 1
	$cur_db_query = "SELECT * FROM curDB WHERE 1;";
	$rs_x = mysql_query($cur_db_query);
	$cur_db_rs = mysql_fetch_array($rs_x);
	$cur_db = $cur_db_rs[1];

	return($cur_db);
}

function ProcuraAnos() {

	$cur_db = ProcuraDBselect();

//if($rs_x == null)
	//echo "<script type='text/javascript'> alert('rs_x é nulo'); </script>"; 

//echo "<script type='text/javascript'> alert('".$rs_x."'); </script>"; 
//echo "<script type='text/javascript'> alert('".$cur_db."'); </script>"; 

	//Procura dele o ano activo
	$curano_db_query = "SELECT * from ".$cur_db."_ano_activo where id='0';";
	$rs_ano = mysql_query($curano_db_query);
	$cur_ano_rs = mysql_fetch_array($rs_ano);
	$cur_ano = $cur_ano_rs[1];
	
	$strSQL = "SHOW tables;";//mostra as tabelas da BD ISTO NÂO PODE SER FEITO ASSIM 
	$rs = mysql_query($strSQL);

//echo "<script type='text/javascript'> alert('". $rs."'); </script>"; 



	Print	"<h4><p style='text-align:center' class='text-success'>".$_SESSION['myusername']." :: ".$cur_db." :: ".$cur_ano."</p></h4>";
	Print "<br><br>";

	Print "<div class='well container' style='background-color:#fff'>";
	Print "	<ul class='nav nav-tabs'>";

	while($row = mysql_fetch_array($rs)) {


		$nomeDB = substr($row[0],0,strpos($row[0],'_'));
		$nomeTabela = substr($row[0],strpos($row[0],'_')+1);

//echo "<script type='text/javascript'> alert('". $nomeTabela."'); </script>"; 

			//'$cur_db'
//		if(= ;)
		//if(($row[0] != "ano_activo") && ($row[0] != "guarda_email"))
		if(($nomeDB == $cur_db) && (strpos($row[0],"ano_activo") == false) && (!strpos($row[0],"guarda_email"))&& (!strpos($row[0],"configura_email")))
		{
		Print "<li class='active'>"; 
		Print "<a onclick=changeYear('".$nomeDB."_".$nomeTabela."');>".$nomeTabela. "</a> </li>\n";  		//.$nomeDB."_".$nomeTabela.  changeYear(this);
		}
	}
	

	Print "<li><a href='novoano.php'>Novo ano...</a></li>";
	Print "</ul>";

	}


	function setTable()
	{
		$cur_db = ProcuraDBselect();

		$ano = mysql_query("SELECT * FROM ".$cur_db."_ano_activo;");
		$ano_f = mysql_fetch_array($ano);
		//count($ano_f)
		//$demo = $ano_f[1];
//echo "<script type='text/javascript'> alert(".$demo."); </script>"; 
		if($order == "asc")
		{
		$strSQL = "SELECT * FROM ".$cur_db."_".$ano_f[1]." ORDER BY  ".$cur_db."_".$ano_f[1].".`nome` ASC;";
		}
		else if($order == "desc")
		{
		$strSQL = "SELECT * FROM ".$cur_db."_".$ano_f[1]." ORDER BY  ".$cur_db."_".$ano_f[1].".`nome` DESC;";
		}
		else
		{
			$strSQL = "SELECT * FROM ".$cur_db."_".$ano_f[1].";";
		}

		$rs = mysql_query($strSQL);

		//Print"<a>Francisco Couceiro</a><br>".$ano_f[1];
		
		Print "<table id='tabela' name='".$cur_db."_".$ano_f[1] ."' class='table table-condensed'>";

		Print "<tr>"; 
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

	function getLabel()
	{
			$cur_db = ProcuraDBselect();
		$ano = mysql_query("SELECT * FROM ".$cur_db."_ano_activo;");
		$ano_f = mysql_fetch_array($ano);
		$cur_ano = $ano_f[1];

		Print "<span id='curanoLabel' name='".$cur_db."_".$cur_ano."'class='label label-success' >Replica o ano: ".$cur_ano." (seleccionado)</span>";
	}

	function closedb()
	{
		mysql_close();
	}
?>