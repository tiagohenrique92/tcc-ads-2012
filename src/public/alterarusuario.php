<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Alterar Usuario</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
		require 'verificaLogin.php';
?>
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
				
				if(isset($_POST['btnEnviar'])){
					$btnEnviar = $_POST['btnEnviar'];
					if($btnEnviar == "Selecionar"){
						$_SESSION['idParaAlteracao'] = $_POST['idusuario'];
					}
				}
				
				$idusuario = $_SESSION['idParaAlteracao'];
				
				$sql = "select usuario.*, nivel.nome as nomenivel from usuario, nivel where ((idusuario = $idusuario) and(usuario.idnivel = nivel.idnivel))";
				$resultado = mysqli_query($GLOBALS['connection'], $sql);
				while($linha = mysqli_fetch_assoc($resultado)){
					$status = $linha['status'];
					$nome = $linha['nome'];
					$login = $linha['login'];
					$nivel = $linha['idnivel'];
					$nomenivel = $linha['nomenivel'];
				}
			?>
  		</div>
        <div id="conteúdo">
        	<div class="barraTitulo">Usuário►Alterar</div>
        	<form name="frmcadusuario" action="salvarusuario.php" method="post">
            	<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>" />
                <input type="hidden" name="status" value="<?php echo $status; ?>" />
                <input type="hidden" name="pagina" value="alterarusuario.php" />
            	<table>
                	<tr>
                    	<td width="120px">
                        	Nome*
                        </td>
                        <td>
                        	<input type="text" name="nome" size="30" style="text-transform:uppercase" value="<?php echo $nome; ?>" />
                        </td>
                   	</tr>
                    <tr>
                    	<td>
                        	Login*
                        </td>
                        <td>
                        	<input type="text" name="login" size="30" style="text-transform:uppercase;" value="<?php echo $login; ?>" readonly="readonly"/>
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
                    <tr>
	                   	<td>Nivel de Acesso*</td>
                        <td><select name="nivel">
                        	<option value="<?php echo $nivel; ?>">
                            	<?php echo $nomenivel; ?>
                            </option>
							<?php
                                $sql = "select idnivel, nome from nivel where (idnivel <> $nivel)";
                                $resuldado = mysqli_query($GLOBALS['connection'], $sql);
                                while($linha = mysqli_fetch_array($resuldado)){
                            ?>
                            		<option value="<?php echo $linha['idnivel']; ?>">
										<?php echo $linha['nome']; ?>
                            		</option>
                            <?php	
                                }
                            ?>
                            </select>
                       	</td>
                	</tr>
                    <tr>
                    	<td>Status*</td>
                        <td>
                        	<?php if($status == 'A'){ ?>
                            		<input type="radio" name="status" value="A" checked="checked" />Ativo
									<input type="radio" name="status" value="I" />Inativo 
							<?php }else{ ?>		
                            		<input type="radio" name="status" value="A"  />Ativo
									<input type="radio" name="status" value="I" checked="checked" />Inativo 
							<?php }	?>
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
                <input type="submit" name="btnEnviar" value="Alterar" />
            </form>
        </div>
    </div>
</body>
</html>
	