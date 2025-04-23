<?php
	require "../conection.php";
	if($_POST){
		$dados = $_POST['dados'];
		$idvenda = $dados['idvenda'];
		$idpro = $dados['idpro'];
		$qtde = $dados['qtde'];
		$preco = $dados['preco'];
		$total = $dados['qtde'] * $dados['preco'];
		
		if($qtde == 0){
			$sql = "delete from itemvenda where idvenda = $idvenda and idpro = $idpro";	
			$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
		}
		
		if($qtde > 0){	
			$sql = "update itemvenda set qtde = $qtde, total = '$total' where idvenda = $idvenda and idpro = $idpro";
			$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
		}
		
	}
?>