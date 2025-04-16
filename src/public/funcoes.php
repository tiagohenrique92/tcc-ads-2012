<?php
	//esta pagina serve apenas para hospedar as funções do sistema
	
	//verifica se o usuario preencheu todos os campos no cadastro de usuario
	function verifCampos($nome, $login, $senha, $confsenha, $pagina, $status){
		if((empty($nome)) or (empty($login)) or (empty($senha)) or (empty($confsenha))){
			if($status == 'A'){
				$_SESSION['msg'] = "Todos os campos devem ser preenchidos";
				header("location: $pagina");
				exit();
			}
		}
	}	
	
	//verifica se o login escolhido no cadastro de usuario já está em uso
	function verifLogin($login, $pagina){
		$sql = "select login from usuario where(login like '%$login%')";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$numRegistros = mysqli_num_rows($resultado);
		if(!empty($numRegistros)){
			$_SESSION['msg'] = "O login ".$login." já está em uso. Por favor escolha outro.";
			header("location: $pagina");
			exit();
		}
	}
	
	//verifica se as senhas escolhidas no cadastro de usuario correspondem
	function verifSenhas($senhaantiga, $senha, $confsenha, $pagina, $opcao, $idusuario){
		if($senha != $confsenha){
			$_SESSION['msg'] = "As senhas não correspondem!";
			header("location: $pagina");
			exit();
		}else{
			if($opcao == 'trocar'){
				$sql = "select senha from usuario where idusuario = '".$idusuario."'";
				$result = mysqli_query($GLOBALS['connection'], $sql);
				$senhaBd = mysqli_fetch_assoc($result);
				$senhaBd = $senhaBd['senha'];
				
				if($senhaantiga != $senhaBd){
					$_SESSION['msg'] = "A senha antiga está incorreta!";
					header("location: $pagina");
					exit();
				}
			}else{
				if($opcao == 'alterar'){
					if($senha != $confsenha){
						$_SESSION['msg'] = "As novas senhas não correspondem!";
						header("location: $pagina");
						exit();
					}
				}
			}
		}
	}

	//realiza a soma dos itens de um pedido e retorna a soma
	function somaTotal($idvenda){
		$sql = "select sum(total) as total from itemvenda where idvenda = $idvenda";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$linha = mysqli_fetch_array($resultado);
		$resultado = $linha['total'];
		if(($resultado == 0) or (is_null($resultado))){
			$totalvenda = 0;
		}else{
			$totalvenda = $resultado;
		}
		return($totalvenda);
	}
	
	//verifica se o usuario digitou todos os campos no cadastro de servico
	function verificaCampos($ref, $descricao, $total){
		if((empty($ref)) or (empty($descricao)) or ($total == 0)){
			$resultado = "vazio";
		}else{
			$resultado = "ok";
		}
		return($resultado);
	}
	
	//atribui a data de vencimento
	function datavcto(){
		$datavcto = strtotime("+ 1 month");
		$datavcto = date("d/m/Y", $datavcto);
		return $datavcto;
	}
	
	//funcao para gerar uma imagem
	function criaimg($origem, $destino, $largura, $altura){ 
		$imgorigem = imagecreatefromjpeg($origem);	
		$w = imagesx($imgorigem);
		$h = imagesy($imgorigem);
		$imgdestino = imagecreatetruecolor($largura, $altura);
		imagecopyresampled($imgdestino, $imgorigem, 0, 0, 0, 0, $largura, $altura, $w, $h);	
		imagejpeg($imgdestino, $destino, 80);
		imagedestroy($imgdestino);
	}
	
	//funcao para verificar e barrar quantidades negativas em cadastros
	function qtdeMaiorZero($valor){
		$qtde = $valor;
		if($qtde < 0){
			return false;
		}else{
			return true;
		}			
	}
