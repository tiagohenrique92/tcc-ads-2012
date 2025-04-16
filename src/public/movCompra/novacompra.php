<?php
	ob_start();
	require "../verificaLogin.php";
	verificaLogin('NOVACOMPRA');

	if($_GET){
		$idfor = $_GET['id'];
		$data = $_SESSION['datacaixa'];
		$sql = "insert into compra(idcompra, datacompra, status, idfor) values(null, '$data', 'AB', $idfor)";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$_SESSION['compraCadastrada'] = true;
		$sql = "select max(idcompra) as idcompra from compra";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$linha = mysqli_fetch_assoc($resultado);
		$_SESSION['idcompra'] = $linha['idcompra'];
		header("location: compra.php");
	}
?>
