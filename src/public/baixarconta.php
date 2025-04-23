<?php
	require "../conection.php";

	if($_GET){
		$id = $_GET['id'];
		$idvenda = $_GET['idvenda'];
		$idparc = $_GET['idparc'];
		$totparc = $_GET['totparc'];
		$valorparc = $_GET['valorparc'];
		$datapag = $datacaixa;	
		$sql = "update parcelarec set valorrec = $valorparc, status = 'P', idcaixa = $caixa, datapag = '$datapag' where idvenda = $idvenda and numparc = $idparc";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
	}


