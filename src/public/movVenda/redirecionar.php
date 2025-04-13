<?php
	session_start();
	
	if($_GET){
		$acao = $_GET['acao'];
		
		switch($acao){
			case "editarVenda":
				$_SESSION['idvenda'] = $_GET['id'];
				header("location:venda.php");
			break;
			case "excluirVenda":
				header("location:excluirVenda.php?id=".$_GET['id']);
			break;
		}
	}