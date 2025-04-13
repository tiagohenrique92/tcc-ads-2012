<?php
	require 'verificaLogin.php';
	verificaLogin('CADUSUARIO');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Cadastro de Usuários</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body onload="document.frmcadusuario.nome.focus()">
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
  		</div>
        <div id="conteúdo">
        	<div class="barraTitulo">Cadastro►Usuário</div>
        	<form name="frmcadusuario" action="salvarusuario.php" method="post">
            	<input type="hidden" name="idusuario" value="NULL" />
                <input type="hidden" name="status" value="A" />
                <input type="hidden" name="pagina" value="cadusuario.php" />
            	<table>
                	<tr>
                    	<td width="120px">Nome*</td>
                        <td><input type="text" name="nome" size="30" style="text-transform:uppercase" /></td>
                   	</tr>
                    <tr>
                    	<td>Login*</td>
                        <td><input type="text" name="login" size="30" style="text-transform:uppercase" /></td>
                   	</tr>
                    <tr>
                    	<td>Senha*</td>
                        <td><input type="password" name="senha" size="30" style="text-transform:uppercase" /></td>
                   	</tr>
                    <tr>
                    	<td>Confirmar Senha*</td>
                        <td><input type="password" name="confsenha" size="30" style="text-transform:uppercase" /></td>
                   	</tr>
                    <tr>
	                   	<td>Nivel de Acesso</td>
                        <td><select name="nivel">
							<?php
                                $sql = "select idnivel, nome from nivel";
                                $resuldado = mysql_query($sql);
                                while($linha = mysql_fetch_array($resuldado)){
                            ?>
                            <option value=<?php echo $linha['idnivel']; ?>> <?php echo $linha['nome']; ?></option>
                            <?php	
                                }
                            ?>
                            </select>
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
                <input type="submit" name="btnEnviar" value="Salvar" />
            </form>
        </div>
    </div>
</body>
</html>
	