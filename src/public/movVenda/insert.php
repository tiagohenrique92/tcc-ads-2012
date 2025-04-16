<?php
	require "../conection.php";
	if($_POST){
		$dados = $_POST['dados'];
		$idvenda = $dados['idvenda'];
		$idpro = $dados['idpro'];
		$qtde = $dados['qtde'];
		$preco = $dados['preco'];
		$total = $dados['qtde'] * $dados['preco'];
		
		$sql = "insert into itemvenda(idvenda, idpro, qtde, precovenda, total) values($idvenda, $idpro, $qtde, $preco, $total)";
		
		$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
		
	}
?>