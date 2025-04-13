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
		
		$resultado = mysql_query($sql) or die(mysql_error());
		
	}
?>