<?php
	session_start();
	require("../conection.php");
	
	if(isset($_POST)){
		
		$idvenda = $_POST['idvenda'];
		
		/******Exclui os itens da venda*******/
		$sql = "delete from itemvenda where idvenda = ".$idvenda;
		
		if(!mysqli_query($GLOBALS['connection'], $sql)){
			$erro = str_replace("'", "", mysqli_error($GLOBALS['connection']));
			$retorno = array('erro'=>mysqli_errno($GLOBALS['connection']), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/******Exclui as parcelas da venda*******/
		$sql = "delete from parcelarec where idvenda = ".$idvenda;
		
		if(!mysqli_query($GLOBALS['connection'], $sql)){
			$erro = str_replace("'", "", mysqli_error($GLOBALS['connection']));
			$retorno = array('erro'=>mysqli_errno($GLOBALS['connection']), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/*****Exclui a Venda*******/
		
		$sql = "delete from venda where idvenda = ".$idvenda;
		
		if(!mysqli_query($GLOBALS['connection'], $sql)){
			$erro = str_replace("'", "", mysqli_error($GLOBALS['connection']));
			$retorno = array('erro'=>mysqli_errno($GLOBALS['connection']), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		$retorno = array('erro'=>0, 'msg'=>"Venda Cancelada");
		$retorno = json_encode($retorno);
		echo $retorno;
		exit;
	}