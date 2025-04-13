<?php
	session_start();
	require("../conection.php");
	
	if(isset($_POST)){
		
		$idcompra = $_POST['idcompra'];
		
		/******Exclui os itens da compra*******/
		$sql = "delete from itemcompra where idcompra = ".$idcompra;
		
		if(!mysql_query($sql)){
			$erro = str_replace("'", "", mysql_error());
			$retorno = array('erro'=>mysql_errno(), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/******Exclui as parcelas da compra*******/
		$sql = "delete from parcelapag where idcompra = ".$idcompra;
		
		if(!mysql_query($sql)){
			$erro = str_replace("'", "", mysql_error());
			$retorno = array('erro'=>mysql_errno(), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/*****Exclui a compra*******/
		
		$sql = "delete from compra where idcompra = ".$idcompra;
		
		if(!mysql_query($sql)){
			$erro = str_replace("'", "", mysql_error());
			$retorno = array('erro'=>mysql_errno(), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		$retorno = array('erro'=>0, 'msg'=>"Compra Cancelada");
		$retorno = json_encode($retorno);
		echo $retorno;
		exit;
	}