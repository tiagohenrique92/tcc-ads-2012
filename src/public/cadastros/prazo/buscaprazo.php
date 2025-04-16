<?php
	ob_start();
	require '../../verificaLogin.php';
	verificaLogin('BUSCAPRAZO');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Buscar Prazo</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../../".$menu;
			?>
        </div>
        <div id="conteúdo">
        	<div class="barraTitulo">Cadastro►Prazo►Alterar</div>
            <br />
        	<fieldset>
            <table>
            	<tr>
                    <td width="220px" align="left">Descrição</td>
                    <td>Situação</td>
                    <td></td>
                </tr>
            	<?php 
					$sql = "select * from prazo order by nome";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
					
					while($linha = mysqli_fetch_array($resultado)){
						?>
                        <tr>
                        	<td align="left"><?php echo $linha['nome'];?></td>
                            <td>
                            	<?php
									if($linha['status'] == 'A'){
										?>
                                        	<a href="buscaprazo.php?idprazo=<?php echo $linha['idprazo'];?>&sit=D" style="text-decoration:none; color:#090">Ativado</a>
                                        <?php
									}else{
										?>
                                        	<a href="buscaprazo.php?idprazo=<?php echo $linha['idprazo'];?>&sit=A" style="text-decoration:none; color:#F00">Desativado</a>
                                        <?php
									}
								?>
                            </td>
                            <td>
                            	<a href="caditemprazo.php?idprazo=<?php echo $linha['idprazo']; ?>&listar" style="text-decoration:none; color:#060">Alterar</a>
                            </td>
                       	</tr>
                        <?php
					}
				?>
                
                <?php
					if($_GET){
						$idprazo = $_GET['idprazo'];
						$sit = $_GET['sit'];
						
						switch($sit){
							case 'A':
								$sql = "update prazo set status = '$sit' where idprazo = $idprazo";
							break;
							case 'D':
								$sql = "update prazo set status = '$sit' where idprazo = $idprazo";
							break;
						}
						
						$resultado = mysqli_query($GLOBALS['connection'], $sql);
						
						header("location: buscaprazo.php");
						exit();
					}
				?>
          	</table>
            </fieldset>
        </div>
    </div>
</body>
</html>