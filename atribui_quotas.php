<?php

  session_start();
  //if($_SESSION["Login"]="No"){
  if(!isset($_SESSION['myusername']) ){
    //!session_is_registered(myusername)){
    header("location:main_login.php");
  }
echo "<script type='text/javascript'> alert('ola'); </script>"; 
	$qLobitos = $_POST['qLobitos'];
	$qExploradores = $_POST['qExploradores'];
	$qPioneiros = $_POST['qPioneiros'];
	$qCaminheiros = $_POST['qCaminheiros'];
	$qChefes = $_POST['qChefes'];
	$ano = $_POST['ano'];

	include('DBModel.php');
	ligaBD();
echo "<script type='text/javascript'> alert('". $ano."'); </script>"; 
	$strSQL = "SELECT * FROM $ano;";
	$rs = mysql_query($strSQL);

	while($row = mysql_fetch_array($rs)) {

		if($row['seccao'] == "Lobitos")
		{
			trocaQuotas($row['id'],$qLobitos,$ano);
		}
		else if($row['seccao'] == "Exploradores")
		{
			trocaQuotas($row['id'],$qExploradores,$ano);
		}
		else if($row['seccao'] == "Pioneiros")
		{
			trocaQuotas($row['id'],$qPioneiros,$ano);
		}
		else if($row['seccao'] == "Caminheiros")
		{
			trocaQuotas($row['id'],$qCaminheiros,$ano);
		}
		else if($row['seccao'] == "Chefes")
		{
			trocaQuotas($row['id'],$qChefes,$ano);
		}
	}

	function trocaQuotas($id,$quota,$ano_f)
	{

		$query = "UPDATE ".$ano_f." SET quota='".$quota."' WHERE id='".$id."';";
		echo $query."\n";
		$rs = mysql_query($query);
	}

	
	closedb();
?>