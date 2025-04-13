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
		
		if(mysql_query($sql)){
			$sql = "select * from parcelapag where idcompra = ".$idcompra." and status = 'A'";
			$resultado = mysql_query($sql);
			$numReg = mysql_num_rows($resultado);
			
			if($numReg > 0){
				$sql = "update compra set status = 'PA' where idcompra = ".$idcompra;
			}else{
				$sql = "update compra set status = 'PG' where idcompra = ".$idcompra;
			}
			$resultado = mysql_query($sql);	
			
			$resposta = array("erro"=>0, "msg"=>"Parcela paga.");
		}else{
			$resposta = array("erro"=>1, "msg"=>"Erro ao receber parcela.".mysql_error());
		}
		$resposta = json_encode($resposta);
		echo $resposta;
	}


