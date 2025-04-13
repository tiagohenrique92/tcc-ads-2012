<?php
	session_start();
	require("../conection.php");
	
	if(isset($_POST)){
		
		$idvenda = $_POST['idvenda'];
		
		/******Exclui os itens da venda*******/
		$sql = "delete from itemvenda where idvenda = ".$idvenda;
		
		if(!mysql_query($sql)){
			$erro = str_replace("'", "", mysql_error());
			$retorno = array('erro'=>mysql_errno(), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/******Exclui as parcelas da venda*******/
		$sql = "delete from parcelarec where idvenda = ".$idvenda;
		
		if(!mysql_query($sql)){
			$erro = str_replace("'", "", mysql_error());
			$retorno = array('erro'=>mysql_errno(), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/*****Exclui a Venda*******/
		
		$sql = "delete from venda where idvenda = ".$idvenda;
		
		if(!mysql_query($sql)){
			$erro = str_replace("'", "", mysql_error());
			$retorno = array('erro'=>mysql_errno(), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		$retorno = array('erro'=>0, 'msg'=>"Venda Cancelada");
		$retorno = json_encode($retorno);
		echo $retorno;
		exit;
	}