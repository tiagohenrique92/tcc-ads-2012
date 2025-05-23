<?php
	require '../../verificaLogin.php';
  	require 'validacao.php';
	verificaLogin('SALVARFORNECEDOR');
	
	parse_str($_GET['dados'], $dados);
	$tipo = $dados['tipo'];
	$idfor = strtoupper($dados['idfor']);
	$razsoc = strtoupper($dados['razsoc']);
	$fantasia = strtoupper($dados['fantasia']);
	$endereco = strtoupper($dados['endereco']);
	$bairro = strtoupper($dados['bairro']);
	$idcid = strtoupper($dados['cidade']);
	$uf = strtoupper($dados['uf']);
	$cep = strtoupper($dados['cep']);
	$fone = strtoupper($dados['fone']);
	$celular = strtoupper($dados['celular']);
	$email = strtolower($dados['email']);
	$cnpjcpf = strtoupper($dados['cnpjcpf']);
	$ierg = strtoupper($dados['ierg']);
	$contato = strtoupper($dados['contato']);
	$status = strtoupper($dados['status']);
	$opcao = $dados['opcao'];
	
	function retorno($dados){
		$resposta = json_encode($dados);
		echo $resposta;
		exit;
	}
	
	//Validações:
	
	if(strlen($razsoc) < 2){
		$resposta = array('erro'=>'1', 'campo'=>'razsoc', 'msg'=>'O campo razão social precisa ter no mínimo 2 caracteres');
		retorno($resposta);
	}
	if(strlen($fantasia) < 2){
		$resposta = array('erro'=>'1', 'campo'=>'fantasia', 'msg'=>'O campo fantasia precisa ter no mínimo 2 caracteres');
		retorno($resposta);
	}
	if(strlen($cep) < 7){
		$resposta = array('erro'=>'1', 'campo'=>'cep', 'msg'=>'O campo cep precisa ter no mínimo 7 caracteres');
		retorno($resposta);
	}
	if(strlen($contato) < 2){
	  	$resposta = array('erro'=>'1', 'campo'=>'contato', 'msg'=>'O campo contato precisa ter no mínimo 2 caracteres');
		retorno($resposta);
	}
	if($uf == 0){
	  	$resposta = array('erro'=>'1', 'campo'=>'uf', 'msg'=>'Selecione um estado');
		retorno($resposta);
	}
	if($idcid == 0){
	  	$resposta = array('erro'=>'1', 'campo'=>'cidade', 'msg'=>'Selecione uma cidade');
		retorno($resposta);
	}
	
	if($tipo == 'F'){
		if(!CPF($cnpjcpf)){
			$resposta = array('erro'=>'1', 'campo'=>'cnpjcpf', 'msg'=>'CPF inválido!');
			retorno($resposta);
		}
	}else{
		if(!CNPJ($cnpjcpf)){
			$resposta = array('erro'=>'1', 'campo'=>'cnpjcpf', 'msg'=>'CNPJ inválido!');
			retorno($resposta);
		}
	}	
	
	switch ($opcao){
		case "Salvar" :
			$sql = "insert into fornecedor (idfor, razsoc, fantasia, cnpjcpf, ierg, endereco, bairro, idcid, cep, fone, celular, email, contato, status, tipo) values(null, '$razsoc', '$fantasia', '$cnpjcpf', '$ierg', '$endereco', '$bairro', '$idcid', '$cep', '$fone', '$celular', '$email', '$contato', '$status', '$tipo')";
		break;
		case "Alterar" :
			$sql = "update fornecedor set razsoc = '$razsoc', fantasia = '$fantasia', cnpjcpf = '$cnpjcpf', ierg = '$ierg', endereco = '$endereco', bairro = '$bairro', idcid = '$idcid', cep = '$cep', fone = '$fone', celular = '$celular', email = '$email', contato = '$contato', status = '$status' where idfor = '$idfor'";
		break;
	}
      
    $insert = mysqli_query($GLOBALS['connection'], $sql);
	if(mysqli_errno($GLOBALS['connection']) == 0){
		$resposta = array('erro'=>'0', 'campo'=>'', 'msg'=>'Fornecedor cadastrado');
		retorno($resposta);
	}else{
		switch(mysqli_errno($GLOBALS['connection'])){
			case '1062':
				if($tipo == 'F'){
					$resposta = array('erro'=>'1', 'campo'=>'cnpjcpf', 'msg'=>'Ops! O CPF informado já está cadastrado.');
					retorno($resposta);
				}else{
					$resposta = array('erro'=>'1', 'campo'=>'cnpjcpf', 'msg'=>'Ops! O CNPJ informado já está cadastrado.');
					retorno($resposta);
				}
			break;
			default:
				$resposta = array('erro'=>'1', 'campo'=>'', 'msg'=>'Ops! Erro ao salvar fornecedor.');
				retorno($resposta);
			break;
		}
	}		

