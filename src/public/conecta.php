<?php
	session_start();
	mysql_connect("localhost", "root", "123456");
	mysql_select_db("sistema");
	
	$data = date('Y-m-d');
	
	//regata o id do ultimo caixa - caixa atual
	function idcaixaAtual(){
		$sql = "select max(idcaixa) as idcaixa from caixa";
		$resultado = mysql_query($sql);
		
		$idcaixa = mysql_fetch_assoc($resultado);
		$idcaixa = $idcaixa['idcaixa'];
		
		return $idcaixa;
	}
	
	//resgata o status do caixa
	function statusCaixa($idcaixa){
		$sql = "select status from caixa where idcaixa = $idcaixa";
		$resultado = mysql_query($sql);
		
		$status = mysql_fetch_assoc($resultado);
		$status = $status['status'];
		
		return $status;
	}
	
	//resgata a data do caixa atual
	function dataCaixa($idcaixa){
		$sql = "select datacaixa from caixa where idcaixa = $idcaixa";
		$resultado = mysql_query($sql);
		
		$datacaixa = mysql_fetch_assoc($resultado);
		$datacaixa = $datacaixa['datacaixa'];
		
		return $datacaixa;
	}

	//verifica se existe um caixa, caso não exista cria um novo
	if(is_null(idcaixaAtual())){
		$sql = "insert into caixa values('NULL', '$data', 0, 'A')";
		$resultado = mysql_query($sql);
		
		$caixa = idcaixaAtual();
		$_SESSION['caixa'] = $caixa;
		$_SESSION['datacaixa'] = dataCaixa($caixa);
		
	}else{//caso exista e seu status for 'F' - Fechado, cria um novo incrementando 1 dia na data do ultimo
		if(statusCaixa(idcaixaAtual()) == 'F'){
			$dataCaixa = date("Y-m-d", strtotime(dataCaixa(idcaixaAtual())."+ 1 day"));
			$sql = "insert into caixa values('NULL', '$dataCaixa', 0, 'A')";
			$resultado = mysql_query($sql);
			
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