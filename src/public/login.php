<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="cssLogin.css" rel="stylesheet" type="text/css" />
<title>Login</title>
</head>

<body onload="document.frmlogin.login.focus()">
	<?php
		$msg = "";
		if ($_POST) {
			$login = strtoupper($_POST['login']);
			$senha = strtoupper($_POST['senha']);
			$senha = md5($senha."KEY");
			
			require 'conecta.php';
			
			//vusca o login informado no banco de dados
			$sql = "select * from usuario where login = '$login'";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			$numLinhas = mysqli_num_rows($resultado);
			
			if(isset($numLinhas)){
				$linha = mysqli_fetch_assoc($resultado);
				$status = $linha['status'];
				
				//verifica se o usuario existe, se é ativo ou inativo
				switch($status){
					case "A":
						if($senha == $linha['senha']){
							$_SESSION['logado'] = true;
							$_SESSION['nivel'] = $linha['idnivel'];
							$_SESSION['idusuario'] = $linha['idusuario'];
							$_SESSION['nomeusuario'] = $linha['nome'];
							header('location: index.php');
						}else{
							$msg = "Senha incorreta.";
						}
					break;
					case "I":
						$msg = "Este usuário está inativo.";
					break;
					case "":
						$msg = "Usuário não cadastrado.";
					break;
				}
			}			
		}
	?>
	<div id="pagina">
    	<div id="login">
        	<form name="frmlogin" action="login.php" method="post">
        		<label for="login">Login</label>
                <input type="text" name="login" style="text-transform:uppercase; width:94%; margin-left: 5px;"  />
                <label for="senha">Senha</label>
                <input type="password" name="senha"  style="text-transform:uppercase; width:94%; margin-left:5px;"/>
                <input type="submit" value="Entrar" class="botao" style="position:absolute; left:25%; top:65%;" />
           	</form>
            <p style="position:absolute; bottom:-15px; color:#FF0000; font-size:14px; padding-left:0px;"><?php echo $msg; ?></p>
        </div>
    </div>
</body>
</html>
