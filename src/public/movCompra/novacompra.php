<?php
	ob_start();
	require "../verificaLogin.php";
	verificaLogin('NOVACOMPRA');

	if($_GET){
		$idfor = $_GET['id'];
		$data = $_SESSION['datacaixa'];
		$sql = "insert into compra(idcompra, datacompra, status, idfor) values('NULL', '$data', 'AB', $idfor)";
		$resultado = mysql_query($sql);
		$_SESSION['compraCadastrada'] = true;
		$sql = "select max(idcompra) as idcompra from compra";
		$resultado = mysql_query($sql);
		$linha = mysql_fetch_assoc($resultado);
		$_SESSION['idcompra'] = $linha['idcompra'];
		header("location: compra.php");
	}
?>
