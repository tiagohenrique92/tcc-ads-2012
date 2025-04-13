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
		
		foreach($parcelas as $parcela){
			$sql = "
			insert into parcelapag(idparc, numparc, totparc, datavenc, valorparc, status, idcompra, idcaixa) 
			values(
			'null', 
			".$parcela['num'].", 
			".$parcela['total'].", 
			'".implode("-", array_reverse(explode("-", $parcela['vcto'])))."', 
			'".$parcela['valor']."', 
			'".$parcela['status']."', 
			".$idcompra.", 
			".$caixa."
			)";

			$resultado = mysql_query($sql) or die("erro: ".mysql_error());
		}

		$sql = "update compra set totalcompra = ".$valorfinal.", prazo = ".$prazo.", status = 'AP' where idcompra = ".$idcompra;
		$resultado = mysql_query($sql) or die("erro: ".mysql_error());
		
		$sql = "select * from itemcompra where idcompra = ".$idcompra;
		$produtos = mysql_query($sql) or die("erro:".mysql_error());
		
		while($produto = mysql_fetch_assoc($produtos)){
			$sql = "update produto set qtde = qtde + ".$produto['qtde']." where idpro = ".$produto['idpro'];
			mysql_query($sql);
		};
		
		unset($_SESSION['idcompra']);
		
		$retorno = array('erro'=>0, 'msg'=>'Compra Finalizada. Efetuar Pagamento?');
		$retorno = json_encode($retorno);
		
		echo $retorno;
	}