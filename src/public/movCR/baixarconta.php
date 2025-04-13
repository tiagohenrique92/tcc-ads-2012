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
		
		if(mysql_query($sql)){
			$resposta = array("erro"=>0, "msg"=>"Parcela recebida.");
		}else{
			$resposta = array("erro"=>1, "msg"=>"Erro ao receber parcela.".mysql_error());
		}
		$resposta = json_encode($resposta);
		echo $resposta;
	}


