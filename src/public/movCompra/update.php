<?php
	require "../conection.php";
	if($_POST){
		$dados = $_POST['dados'];
		$idcompra = $dados['idcompra'];
		$idpro = $dados['idpro'];
		$qtde = $dados['qtde'];
		$preco = $dados['preco'];
		$total = $dados['qtde'] * $dados['preco'];
		
		if($qtde == 0){
			$sql = "delete from itemcompra where idcompra = $idcompra and idpro = $idpro";	
			$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
		}
		
		if($qtde > 0){	
			$sql = "update itemcompra set qtde = $qtde, total = '$total' where idcompra = $idcompra and idpro = $idpro";
			$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
		}
		
	}
?>