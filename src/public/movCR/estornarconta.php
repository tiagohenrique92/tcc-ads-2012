<?php
	require "../conection.php";

	if($_GET){
		$idvenda = $_GET['idvenda'];
		$idparc = $_GET['idparc'];
		$totparc = $_GET['totparc'];
		$status = "AB";
		$sql = "update parcelarec set status = '$status', valorrec = NULL, idcaixa = '$caixa', datapag = NULL where idvenda = $idvenda and numparc = $idparc";
		
		if(mysqli_query($GLOBALS['connection'], $sql)){
			$sql = "select * from parcelarec where idvenda = ".$idvenda." and status in('PG', 'PA')";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			$numReg = mysqli_num_rows($resultado);
			
			if($numReg > 0){
				$sql = "update venda set status = 'PA' where idvenda = ".$idvenda;
			}else{
				$sql = "update venda set status = 'AB where idvenda = ".$idvenda;
			}
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			
			$resposta = array("erro"=>0, "msg"=>"Parcela estornada.");
		}else{
			$resposta = array("erro"=>1, "msg"=>"Erro ao estornar parcela.".mysqli_error($GLOBALS['connection']));
		}
		$resposta = json_encode($resposta);
		echo $resposta;
	}


