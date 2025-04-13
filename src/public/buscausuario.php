<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Buscar Usuario</title>
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
			?>
  		</div>
        <div id="conteúdo">
			<div class="barraTitulo">Usuário Alterar►Busca de Usuario</div>
        	<form name="frmbuscausuario" action="buscausuario.php" method="post">
            	<table>
                	<tr>
                    	<td width="90px">Login</td>
                        <td width="880px"><input type="text" name="login" size="140" /></td>
                        <td><input type="submit" value="Buscar" />
						</td>
                  	</tr>
               	</table>
            </form>
            <?php
				if($_POST){
					echo "<div class='barraTitulo'>Encontrados</div>";
					$login = $_POST['login'];
					$numLinha = 0;
					$sql = "select usuario.*, nivel.nome as nomenivel from usuario, nivel where (login like '%$login%') and (idusuario > 1) and (usuario.idnivel = nivel.idnivel)";
					$resultado = mysql_query($sql);
					$numRegistros = mysql_num_rows($resultado);
					if(!empty($numRegistros)){
			?>
            <table>
            	<tr>
                	<td width="160px">Nome
                    </td>
                    <td width="130px">Login
                    </td>
                    <td>
                    </td>
                </tr>
            <?php			
					}
					while($linha = mysql_fetch_array($resultado)){
						$numLinha++;
						if($numLinha % 2 == 0){
							$corLinha = "linhaClara2";
						}else{
							$corLinha = "linhaEscura2";
						}
			?>
            	<tr>
                	<form action="alterarusuario.php" method="post">
                    	<td class="<?php echo $corLinha; ?>">
                        	<?php echo $linha['nome']; ?>
                        </td>
                    	<td class="<?php echo $corLinha; ?>">
                        	<input type="hidden" name="idusuario" value="<?php echo $linha['idusuario']; ?>" />
							<?php echo $linha['login']; ?>
                        </td>
                   		<td class="<?php echo $corLinha; ?>" align="center">
                           	<input type="submit" name="btnEnviar" value="Selecionar" />
                        </td>
                   	</form>
                </tr>
            <?php
					}
			?>
			</table>
           	<?php
				}
			?>
        </div>
    </div>
</body>
</html>
