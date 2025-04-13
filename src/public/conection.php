<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	$con = mysql_connect("localhost", "root");
	if(!mysql_select_db("sistema", $con)){
		echo "erro ao conectar no banco de dados";
	}
	
	if(!isset($_SESSION['logado'])){
		header('location: login.php');
		exit;
	}else{
		$idusuario = $_SESSION['idusuario'];
		$nivel = $_SESSION['nivel'];
		$menu = "menu/menu$nivel.php";
		$caixa = $_SESSION['caixa'];
		$datacaixa = $_SESSION['datacaixa'];
		$nomeusuario = $_SESSION['nomeusuario'];
	}