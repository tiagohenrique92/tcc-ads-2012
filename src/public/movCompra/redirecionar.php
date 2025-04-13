<?php
	session_start();
	
	if($_GET){
		$acao = $_GET['acao'];
		
		switch($acao){
			case "editarCompra":
				$_SESSION['idcompra'] = $_GET['id'];
				header("location:compra.php");
			break;
			case "excluirCompra":
				header("location:excluirCompra.php?id=".$_GET['id']);
			break;
		}
	}