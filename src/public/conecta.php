<?php
	session_start();
    $GLOBALS['connection'] = mysqli_connect("mysql", "root", "123456", "sistema");
//	mysqli_select_db($GLOBALS['connection'], "sistema");
	
	$data = date('Y-m-d');
	
	//regata o id do ultimo caixa - caixa atual
	function idcaixaAtual(){
		$sql = "select max(idcaixa) as idcaixa from caixa";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$idcaixa = mysqli_fetch_assoc($resultado);
		$idcaixa = $idcaixa['idcaixa'];

		return $idcaixa;
	}
	
	//resgata o status do caixa
	function statusCaixa($idcaixa){
		$sql = "select status from caixa where idcaixa = $idcaixa";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$status = mysqli_fetch_assoc($resultado);
		$status = $status['status'];
		
		return $status;
	}
	
	//resgata a data do caixa atual
	function dataCaixa($idcaixa){
		$sql = "select datacaixa from caixa where idcaixa = $idcaixa";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$datacaixa = mysqli_fetch_assoc($resultado);
		$datacaixa = $datacaixa['datacaixa'];
		
		return $datacaixa;
	}

	//verifica se existe um caixa, caso não exista cria um novo
	if(is_null(idcaixaAtual())){
		$sql = "insert into caixa values(null, '$data', 0, 'A')";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$caixa = idcaixaAtual();
		$_SESSION['caixa'] = $caixa;
		$_SESSION['datacaixa'] = dataCaixa($caixa);
		
	}else{//caso exista e seu status for 'F' - Fechado, cria um novo incrementando 1 dia na data do ultimo
		if(statusCaixa(idcaixaAtual()) == 'F'){
			$dataCaixa = date("Y-m-d", strtotime(dataCaixa(idcaixaAtual())."+ 1 day"));
			$sql = "insert into caixa values(null, '$dataCaixa', 0, 'A')";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			
			$caixa = idcaixaAtual();
			$_SESSION['caixa'] = $caixa;
			$_SESSION['datacaixa'] = dataCaixa($caixa);
		}else{//caso exista e esteja aberto, guarda na session o id deste caixa
			$caixa = idcaixaAtual();
			$_SESSION['caixa'] = $caixa;
			$_SESSION['datacaixa'] = dataCaixa($caixa);
		}
	}
?>