<?php
	ob_start();
	require "../verificaLogin.php";
	verificaLogin('NOVAVENDA');

	if($_GET){
		$idcli = $_GET['id'];
		$data = $_SESSION['datacaixa'];
		$sql = "insert into venda(idvenda, datavenda, status, idcli) values('NULL', '$data', 'AB', $idcli)";
		$resultado = mysql_query($sql);
		$_SESSION['vendaCadastrada'] = true;
		$sql = "select max(idvenda) as idvenda from venda";
		$resultado = mysql_query($sql);
		$linha = mysql_fetch_assoc($resultado);
		$_SESSION['idvenda'] = $linha['idvenda'];
		header("location: venda.php");
	}
?>
