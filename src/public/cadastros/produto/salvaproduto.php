<?php
	require "../../verificaLogin.php";
	require "../../funcoes.php";
	verificaLogin('SALVAPRODUTO');
	
	parse_str($_GET['dados'], $dados);
	$idpro = trim($dados['idpro']);
	$nome = trim(strtoupper($dados['nome']));
	$pcompra = trim($dados['pcompra']);
	$pvenda = trim($dados['pvenda']);
	$qtde = trim($dados['qtde']);
	$barras = trim($dados['barras']);
	$status = trim($dados['status']);
	
	function retorno($dados){
		$resposta = json_encode($dados);
		echo $resposta;
		exit;
	}
	
	if($nome == ""){
		$resposta = array('erro'=>'1', 'campo'=>'nome', 'msg'=>'O campo nome não pode ficar vazio');
		retorno($resposta);
	}
	if($barras == ""){
		$resposta = array('erro'=>'1', 'campo'=>'barras', 'msg'=>'O campo codigo de barras nao pode ficar vazio');
		retorno($resposta);
	}
	if($pcompra == ""){
		$resposta = array('erro'=>'1', 'campo'=>'pcompra', 'msg'=>'O campo preço de compra não pode ficar vazio');
		retorno($resposta);
	}
	if($pvenda == ""){
		$resposta = array('erro'=>'1', 'campo'=>'pvenda', 'msg'=>'O campo preço de venda não pode ficar vazio');
		retorno($resposta);
	}
	if($qtde < 0){
	  	$resposta = array('erro'=>'1', 'campo'=>'qtde', 'msg'=>'O campo qtde não pode ser negativo');
		retorno($resposta);
	}
	if($qtde == ""){
		$qtde = 0;
	}
	if($status == ""){
	  	$resposta = array('erro'=>'1', 'campo'=>'status', 'msg'=>'Selecione um status');
		retorno($resposta);
	}

	if(empty($idpro)){
		$sql = "insert into produto(idpro, nome, precocompra, precovenda, qtde, barras, status) values(null, '$nome', '$pcompra', '$pvenda', $qtde, $barras, '$status')";
	}else{
		$sql = "update produto set nome = '$nome', precocompra = '$pcompra', precovenda = '$pvenda', barras = $barras, status = '$status', qtde = '$qtde' where idpro = $idpro";
	}
	if(!mysqli_query($GLOBALS['connection'], $sql)){
		echo mysqli_error($GLOBALS['connection']);
		$resposta = array('erro'=>'1', 'campo'=>'', 'msg'=>'Erro ao salvar produto');
		retorno($resposta);
	}else{
		$resposta = array('erro'=>'0', 'campo'=>'', 'msg'=>'Produto Gravado');
		retorno($resposta);
	}
?>