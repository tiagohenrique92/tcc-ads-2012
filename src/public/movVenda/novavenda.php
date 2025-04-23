<?php
	ob_start();
	require "../verificaLogin.php";
	verificaLogin('NOVAVENDA');

	if($_GET){
		$idcli = $_GET['id'];
		$data = $_SESSION['datacaixa'];
		$sql = "insert into venda(idvenda, datavenda, status, idcli) values(null, '$data', 'AB', $idcli)";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$_SESSION['vendaCadastrada'] = true;
		$sql = "select max(idvenda) as idvenda from venda";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$linha = mysqli_fetch_assoc($resultado);
		$_SESSION['idvenda'] = $linha['idvenda'];
		header("location: venda.php");
	}
?>
