<?php
	require "../conection.php";

	if($_GET){
		$idcompra = $_GET['idcompra'];
		$idparc = $_GET['idparc'];
		$totparc = $_GET['totparc'];
		$valorparc = (float) $_GET['valorparc'];
		$status = "P";
		$datapag = $datacaixa;
		$sql = "update parcelapag set status = '$status', valorpago = '$valorparc', idcaixa = '$caixa', datapag = '$datapag' where idcompra = $idcompra and numparc = $idparc";
		
		if(mysqli_query($GLOBALS['connection'], $sql)){
			$sql = "select * from parcelapag where idcompra = ".$idcompra." and status = 'A'";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			$numReg = mysqli_num_rows($resultado);
			
			if($numReg > 0){
				$sql = "update compra set status = 'PA' where idcompra = ".$idcompra;
			}else{
				$sql = "update compra set status = 'PG' where idcompra = ".$idcompra;
			}
			$resultado = mysqli_query($GLOBALS['connection'], $sql);	
			
			$resposta = array("erro"=>0, "msg"=>"Parcela paga.");
		}else{
			$resposta = array("erro"=>1, "msg"=>"Erro ao receber parcela.".mysqli_error($GLOBALS['connection']));
		}
		$resposta = json_encode($resposta);
		echo $resposta;
	}


