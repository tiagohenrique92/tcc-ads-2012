<?php
	require "../conection.php";
	if($_POST){
		$dados = $_POST['dados'];
		$idcompra = $dados['idcompra'];
		$idpro = $dados['idpro'];
		$qtde = $dados['qtde'];
		$preco = $dados['preco'];
		$total = $dados['qtde'] * $dados['preco'];
		
		$sql = "insert into itemcompra(idcompra, idpro, qtde, precocompra, total) values($idcompra, $idpro, $qtde, $preco, $total)";
		
		$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
		
	}
?>