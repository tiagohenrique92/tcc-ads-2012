<?php
	session_start();
	require("../conection.php");
	
	if($_POST){
		$parcelas = $_SESSION['parcelas'];
		$parcelas = json_decode($parcelas, 1);
		$idvenda = $_SESSION['idvenda'];
		$caixa = $_SESSION['caixa'];
		$valorfinal = $_POST['valorfinal'];
		$prazo = $_POST['prazo'];

        $sql = "delete from parcelarec where idvenda = " . $idvenda;
        mysqli_query($GLOBALS['connection'], $sql);
		
		foreach($parcelas as $parcela){
			$sql = "
			insert into parcelarec(idparc, numparc, totparc, datavenc, valorparc, status, idvenda, idcaixa) 
			values(
			null, 
			".$parcela['num'].", 
			".$parcela['total'].", 
			'".implode("-", array_reverse(explode("-", $parcela['vcto'])))."', 
			'".$parcela['valor']."', 
			'".$parcela['status']."', 
			".$idvenda.", 
			".$caixa."
			)";

			$resultado = mysqli_query($GLOBALS['connection'], $sql) or die("erro: ".mysqli_error($GLOBALS['connection']));
		}

		$sql = "update venda set totalvenda = ".$valorfinal.", prazo_idprazo = ".$prazo.", status = 'PA' where idvenda = ".$idvenda;
		$resultado = mysqli_query($GLOBALS['connection'], $sql) or die("erro: ".mysqli_error($GLOBALS['connection']));
		
		unset($_SESSION['idvenda']);
		
		$retorno = array('erro'=>0, 'msg'=>'Venda Finalizada. Efetuar Recebimento?');
		$retorno = json_encode($retorno);
		
		echo $retorno;
	}