<?php
	ob_start();
	require '../../verificaLogin.php';
	verificaLogin('CADITEMPRAZO');
?>
<!DOCTYPE html PUBLIC "-//W3verificaLogin(C//DTverificaLogin(verificaLogin(D XHTverificaLogin(verificaLogin(ML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Cadastro de Prazo</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body onload="document.forms[0].dias.focus()">
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../../".$menu;
			?>
       	</div>
        <div id="conteúdo">
        	<div class="barraTitulo">Cadastro►Prazo►Dias do Prazo</div>
        	<?php
				$j = 0;
                $idprazo = $_GET['idprazo'];
				
				$sql = "select nome from prazo where idprazo = $idprazo";
				$resultado = mysqli_query($GLOBALS['connection'], $sql);
				$prazo = mysqli_fetch_array($resultado);
				$prazo = $prazo['nome'];
			?>
            
        	<fieldset style="width:180px">
            <legend>Cadastro de Prazo</legend>
            	<form action="caditemprazo.php" method="get">
                	<h3>Prazo: <?php echo $prazo; ?></h3>
                	<label class="label" style="width:73px">Dias</label>
                    <input type="hidden" name="idprazo" value="<?php echo $idprazo; ?>" />
                    <input type="hidden" name="listar" />
                    <input type="text" autofocus="autofocus" name="dias" size="6" /><br />
                    <input type="button" name="Finalizar" value="Finalizar" onclick="location='../../index.php'" />
                    <input type="submit" value="Adicionar" />
                </form>
            </fieldset>
            
            <?php
				if(isset($_GET['excluir'])){
					$idprazo = $_GET['idprazo'];
					$iditemprazo = $_GET['iditemprazo'];
					$sql = "delete from iprazo where iditemprazo = $iditemprazo and idprazo = $idprazo";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
					
					header("location: caditemprazo.php?idprazo=$idprazo&listar");
					exit();
				}
				if(isset($_GET['dias'])){
					$dias = $_GET['dias'];
                	$sql = "insert into iprazo(iditemprazo, idprazo, dias) values(null, $idprazo, $dias)";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
				}
				
				if(isset($_GET['listar'])){
					$sql = "select * from iprazo where idprazo = $idprazo order by dias";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
					
					?>
                    <fieldset style="width:180px">
                    <table>
                    	<tr>
                        	<td align="left" width="50px">Parcela</td>
                            <td align="right" width="60px">Dias</td>
                            <td align="center" width="55px">Excluir</td>
                        </tr>
                    <?php
					while($linha = mysqli_fetch_array($resultado)){
						$j++;
						?>
                        <tr align="right">
                        	<td><?php echo $j; ?></td>
                            <td><?php echo $linha['dias'];?></td>
                            <td align="center"><a href="caditemprazo.php?idprazo=<?php echo $idprazo;?>&iditemprazo=<?php echo $linha['iditemprazo'];?>&excluir"><img src="../../menu/Trash-32.png" title="Excluir" width="25" height="25" /></a></td>
                        </tr>
                        <?php
					}
					?>
                    </table>
                    </fieldset>
                   	<?php
                }else{
                   // header("location: index.php");
                }
			?>
        </div>
  	</div>
</body>
</html>