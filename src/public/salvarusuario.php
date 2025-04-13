<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Salvar Usuario</title>
</head>

<body>
	<?php
		require 'verificaLogin.php';
		require 'funcoes.php';
		
		$idusuario = strtoupper($_POST['idusuario']);
		$nome = strtoupper($_POST['nome']);
		$login = strtoupper($_POST['login']);
		$senha = strtoupper($_POST['senha']);
		$confsenha = strtoupper($_POST['confsenha']);
		$nivel = $_POST['nivel'];
		$status = strtoupper($_POST['status']);
		$btnEnviar = $_POST['btnEnviar'];
		$pagina = $_POST['pagina'];
		$editor = $_SESSION['idusuario'];
					
		//verifica se a acao é para alterar ou cadastrar um usuario
		switch ($btnEnviar){
			case "Salvar" :
				verifCampos($nome, $login, $senha, $confsenha, $pagina, $status);
				verifLogin($login, $pagina);
				verifSenhas('null', $senha, $confsenha, $pagina, 'salvar', $idusuario);
				
				$senha = md5($senha."KEY");
				$confsenha = md5($confsenha."KEY");
				
				$sql = "insert into usuario (idusuario, nome, login, senha, idnivel, status, editor) values('NULL', '$nome', '$login', '$senha', '$nivel', '$status', '$editor')";
			break;
			case "Trocar" :
				$senhaantiga = md5(strtoupper($_POST['senhaantiga'])."KEY");
				verifCampos($nome, $login, $senha, $confsenha, $pagina, $status);
				verifSenhas($senhaantiga, $senha, $confsenha, $pagina, 'trocar', $idusuario);			
				
				$senha = md5($senha."KEY");
				$confsenha = md5($confsenha."KEY");
				
				$sql = "update usuario set nome = '$nome', senha = '$senha', status = '$status', idnivel = '$nivel', editor = '$editor' where idusuario = '$idusuario'";
				
			break;
			case "Alterar" :
				verifCampos($nome, $login, $senha, $confsenha, $pagina, $status);
				verifSenhas('null', $senha, $confsenha, $pagina, 'alterar', $idusuario);			
				
				$senha = md5($senha."KEY");
				$confsenha = md5($confsenha."KEY");
				
				$sql = "update usuario set nome = '$nome', senha = '$senha', status = '$status', idnivel = '$nivel', editor = '$editor' where idusuario = '$idusuario'";
				
			break;
		}
		
		//verifica se o sistema salvou os dados e redireciona o usuario para a index.php
		if(mysql_query($sql)){
			if(($idusuario == $_SESSION['idusuario']) and ($status = 'I')){
				unset($_SESSION['logado']);
			}
			unset(
				$_SESSION['idParaAlteracao'],
				$_SESSION['msg']
			);
			header("location: index.php");
		}else{
			echo "Erro ao salvar usuario. <br>";
			echo "Erro: ".mysql_error();
		}			
	?>
</body>
</html>
