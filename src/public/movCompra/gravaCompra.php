<?php
	session_start();
	require("../conection.php");
	
	if($_POST){
		$parcelas = $_SESSION['parcelas'];
		$parcelas = json_decode($parcelas, 1);
		$idcompra = $_SESSION['idcompra'];
		$caixa = $_SESSION['caixa'];
		$valorfinal = $_POST['valorfinal'];
		$prazo = $_POST['prazo'];

        $sql = "delete from parcelapag where idcompra = " . $idcompra;
        mysqli_query($GLOBALS['connection'], $sql);
		
		foreach($parcelas as $parcela){
			$sql = "
			insert into parcelapag(idparc, numparc, totparc, datavenc, valorparc, status, idcompra, idcaixa) 
			values(
			null, 
			".$parcela['num'].", 
			".$parcela['total'].", 
			'".implode("-", array_reverse(explode("-", $parcela['vcto'])))."', 
			'".$parcela['valor']."', 
			'".$parcela['status']."', 
			".$idcompra.", 
			".$caixa."
			)";

			$resultado = mysqli_query($GLOBALS['connection'], $sql) or die("erro: ".mysqli_error($GLOBALS['connection']));
		}

		$sql = "update compra set totalcompra = ".$valorfinal.", prazo_idprazo = ".$prazo.", status = 'PA' where idcompra = ".$idcompra;
		$resultado = mysqli_query($GLOBALS['connection'], $sql) or die("erro: ".mysqli_error($GLOBALS['connection']));
		
		$sql = "select * from itemcompra where idcompra = ".$idcompra;
		$produtos = mysqli_query($GLOBALS['connection'], $sql) or die("erro:".mysqli_error($GLOBALS['connection']));
		
		while($produto = mysqli_fetch_assoc($produtos)){
			$sql = "update produto set qtde = qtde + ".$produto['qtde']." where idpro = ".$produto['idpro'];
			mysqli_query($GLOBALS['connection'], $sql);
		};
		
		unset($_SESSION['idcompra']);
		
		$retorno = array('erro'=>0, 'msg'=>'Compra Finalizada. Efetuar Pagamento?');
		$retorno = json_encode($retorno);
		
		echo $retorno;
	}