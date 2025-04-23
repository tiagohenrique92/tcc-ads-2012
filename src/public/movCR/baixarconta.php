<?php
	require "../conection.php";

	if($_GET){
		$idvenda = $_GET['idvenda'];
		$idparc = $_GET['idparc'];
		$totparc = $_GET['totparc'];
		$valorparc = (float) $_GET['valorparc'];
		$status = "PG";
		$datapag = $datacaixa;
		$sql = "update parcelarec set status = '$status', valorrec = '$valorparc', idcaixa = '$caixa', datapag = '$datapag' where idvenda = $idvenda and numparc = $idparc";
		
		if(mysqli_query($GLOBALS['connection'], $sql)){
			$resposta = array("erro"=>0, "msg"=>"Parcela recebida.");
		}else{
			$resposta = array("erro"=>1, "msg"=>"Erro ao receber parcela.".mysqli_error($GLOBALS['connection']));
		}
		$resposta = json_encode($resposta);
		echo $resposta;
	}


