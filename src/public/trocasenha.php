<?php
	require 'verificaLogin.php';
	verificaLogin('TROCASENHA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Trocar Senha</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body onload="document.frmtrocasenha.senhaantiga.focus()">
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
  		</div>
        <div id="conteúdo">
        	<?php
				$sql = "select usuario.*, nivel.nome as nomenivel from usuario, nivel where (idusuario = $idusuario) and (usuario.idnivel = nivel.idnivel)";
				$resultado = mysql_query($sql);
				$linha = mysql_fetch_assoc($resultado);
				$status = $linha['status'];
				$nome = $linha['nome'];
				$login = $linha['login'];
				$nivel = $linha['idnivel'];
				$nomenivel = $linha['nomenivel'];
			?>
            <div class="barraTitulo">Usuário►Trocar Senha</div>
        	<form name="frmtrocasenha" action="salvarusuario.php" method="post">
            	<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>" />
                <input type="hidden" name="status" value="<?php echo $status; ?>" />
                <input type="hidden" name="pagina" value="trocasenha.php" />
                <input type="hidden" name="nivel" value="<?php echo $nivel;?>" />
            	<table>
                	<tr>
                    	<td width="120px">
                        	Nome
                        </td>
                        <td>
                        	<input type="text" name="nome" size="30" readonly="readonly" style="text-transform:uppercase" value="<?php echo $nome; ?>" />
                        </td>
                   	</tr>
                    <tr>
                    	<td>
                        	Login
                        </td>
                        <td>
                        	<input type="text" name="login" size="30" readonly="readonly" style="text-transform:uppercase;" value="<?php echo $login; ?>" readonly="readonly"/>
                        </td>
                   	</tr>
                    <tr>
                    	<td>
                        	Senha Antiga*
                        </td>
                        <td>
                        	<input type="password" name="senhaantiga" size="30" style="text-transform:uppercase" />
                        </td>
                   	</tr>
                    <tr>
                    	<td>
                        	Senha*
                        </td>
                        <td>
                        	<input type="password" name="senha" size="30" style="text-transform:uppercase" />
                        </td>
                   	</tr>
                    <tr>
                    	<td>
                        	Confirmar Senha*
                        </td>
                        <td>
                        	<input type="password" name="confsenha" size="30" style="text-transform:uppercase" />
                        </td>
                   	</tr>
            	</table>
                <p style="position:absolute; color:#FF0000; font-size:14px;">
                	<br />
					<?php 
                		if(isset($_SESSION['msg'])){
							echo $_SESSION['msg'];
							unset($_SESSION['msg']);
						}
					?>
               	</p>
                <input type="submit" name="btnEnviar" value="Trocar" />
            </form>
            </fieldset>
        </div>
    </div>
</body>
</html>
	