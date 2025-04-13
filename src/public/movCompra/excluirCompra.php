<?php
	session_start();
	require("../conection.php");
	
	if(isset($_POST)){
		
		$idcompra = $_POST['idcompra'];
		
		/*
		Verifica se existem pagamentos efetuados
		*/
		$sql = "select * from parcelapag where idcompra = ".$idcompra." and status = 'P'";
		$resultado = mysql_query($sql);
		$numReg = mysql_num_rows($resultado);
		
		if($numReg > 0){
			$retorno = array('erro'=>'1', 'msg'=>'Esta compra já foi paga parcial ou totalmente. Efetue primeiramente o estorno dos pagamentos.');
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}
		
		/*****Altera o status da Compra*******/
		
		$sql = "select status from compra where idcompra = '".$idcompra."'";
		$resultado = mysql_query($sql);
		$statusCompra = mysql_fetch_assoc($resultado);
		
		if($statusCompra == 'AB'){
			$sql = "update compra set status = 'C' where idcompra = '".$idcompra."'";
			$resultado = mysql_query($sql);
			
			$retorno = array('erro'=>0, 'msg'=>"Compra Cancelada");
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;			
		}
		
		$sql = "update compra set status = 'C' where idcompra = '".$idcompra."'";
		
		if(!$resultado = mysql_query($sql)){
			$erro = str_replace("'", "", mysql_error());
			$retorno = array('erro'=>mysql_errno(), 'msg'=>$erro);
			$retorno = json_encode($retorno);
			echo $retorno;
			exit;
		}else{
			/******Remove as quantidades para o estoque*******/
			$sql = "select qtde, idpro from itemcompra where idcompra = '".$idcompra."'";
			$resultado = mysql_query($sql);
			
			while($linha = mysql_fetch_assoc($resultado)){
				$sql = "update produto set qtde = (qtde - ".$linha['qtde'].") where (idpro = ".$linha['idpro'].")";
				$result = mysql_query($sql);
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
		}
		
		$retorno = array('erro'=>0, 'msg'=>"Compra Cancelada");
		$retorno = json_encode($retorno);
		echo $retorno;
		exit;
	}