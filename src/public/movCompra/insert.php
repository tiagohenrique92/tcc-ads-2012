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
		
		$resultado = mysql_query($sql) or die(mysql_error());
		
	}
?>