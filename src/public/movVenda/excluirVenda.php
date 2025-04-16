<?php
	session_start();
	require("../conection.php");
	
	if(isset($_POST)){
		
		$idvenda = $_POST['idvenda'];
		
		/*
		Verifica se existem recebimentos efetuados
		*/
		$sql = "select * from parcelarec where idvenda = ".$idvenda." and status = 'PG'";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$numReg = mysqli_num_rows($resultado);
		
		if($numReg > 0){
			$retorno = array('erro'=>'1', 'msg'=>'Esta venda já foi recebida parcial ou totalmente. Efetue primeiramente o estorno dos pagamentos.');
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		
		
		/*****Altera o status da Venda*******/
		
		$sql = "update venda set status = 'C' where idvenda = ".$idvenda;
		
		if(!$resultado = mysqli_query($GLOBALS['connection'], $sql)){
			$erro = str_replace("'", "", mysqli_error($GLOBALS['connection']));
			$retorno = array('erro'=>mysqli_errno($GLOBALS['connection']), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}else{
			/******Devolve as quantidades para o estoque*******/
			$sql = "select qtde, idpro from itemvenda where idvenda = '".$idvenda."'";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			
			while($linha = mysqli_fetch_assoc($resultado)){
				$sql = "update produto  set qtde = (qtde + ".$linha['qtde'].") where (idpro = ".$linha['idpro'].")";
				$result = mysqli_query($GLOBALS['connection'], $sql);
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
		}
		
		$retorno = array('erro'=>0, 'msg'=>"Venda Cancelada");
		$retorno = json_encode($retorno);
		echo $retorno;
		exit;
	}