<?php
	session_start();
	require("../conection.php");
	
	if(isset($_POST)){
		
		$idcompra = $_POST['idcompra'];
		
		/*
		Verifica se existem pagamentos efetuados
		*/
		$sql = "select * from parcelapag where idcompra = ".$idcompra." and status = 'P'";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$numReg = mysqli_num_rows($resultado);
		
		if($numReg > 0){
			$retorno = array('erro'=>'1', 'msg'=>'Esta compra já foi paga parcial ou totalmente. Efetue primeiramente o estorno dos pagamentos.');
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/*****Altera o status da Compra*******/
		
		$sql = "select status from compra where idcompra = '".$idcompra."'";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$statusCompra = mysqli_fetch_assoc($resultado);
		
		if($statusCompra == 'AB'){
			$sql = "update compra set status = 'C' where idcompra = '".$idcompra."'";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			
			$retorno = array('erro'=>0, 'msg'=>"Compra Cancelada");
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;			
		}
		
		$sql = "update compra set status = 'C' where idcompra = '".$idcompra."'";
		
		if(!$resultado = mysqli_query($GLOBALS['connection'], $sql)){
			$erro = str_replace("'", "", mysqli_error($GLOBALS['connection']));
			$retorno = array('erro'=>mysqli_errno($GLOBALS['connection']), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}else{
			/******Remove as quantidades para o estoque*******/
			$sql = "select qtde, idpro from itemcompra where idcompra = '".$idcompra."'";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			
			while($linha = mysqli_fetch_assoc($resultado)){
				$sql = "update produto set qtde = (qtde - ".$linha['qtde'].") where (idpro = ".$linha['idpro'].")";
				$result = mysqli_query($GLOBALS['connection'], $sql);
			}
			
			/******Exclui as parcelas da compra*******/
			$sql = "delete from parcelapag where idcompra = ".$idcompra;
			
			if(!mysqli_query($GLOBALS['connection'], $sql)){
				$erro = str_replace("'", "", mysqli_error($GLOBALS['connection']));
				$retorno = array('erro'=>mysqli_errno($GLOBALS['connection']), 'msg'=>$erro);
				$retorno = json_encode($retorno);
				echo $retorno;
				exit;
			}
		}
		
		$retorno = array('erro'=>0, 'msg'=>"Compra Cancelada");
		$retorno = json_encode($retorno);
		echo $retorno;
		exit;
	}