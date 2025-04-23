<?php 
	require '../../verificaLogin.php';
	verificaLogin('PESQUISARCID');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Buscar Cidade</title>
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
        	<div class="barraTitulo">Cadastro►Cidade</div><br />
        	<?php 
				if($_GET){
					$cidade = $_GET['cidade'];
					$uf = $_GET['uf'];
                    $sql = "select nome from uf where iduf = $uf";
                    $resultado = mysqli_query($GLOBALS['connection'], $sql);
					$estado = mysqli_fetch_assoc($resultado);
					$estado = $estado['nome'];					
					?>
					<fieldset>
                        <form name="frmbuscacid" action="salvarcidade.php" method="post" >
                        	<label for="cidade">Cidade</label>
                            <input type="text" name="cidade" size="100" value="<?php echo $cidade; ?>" readonly="readonly" style="text-transform:uppercase" />
                            <label for="uf">UF</label>
                            <input type="hidden" name="uf" value="<?php echo $uf; ?>" />
                            <input type="text" name="estado" readonly="readonly" value="<?php echo $estado; ?>"  />                            <input type="submit" name="btnEnviar" value="Gravar" />
                        </form>
                    </fieldset>
                    <?php										
				}else{
					?>
                        <fieldset>
                        <form name="frmbuscacid" id="frmbuscacid" action="pesquisarcid.php" method="post" >
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" size="100" autofocus="autofocus" style="text-transform:uppercase" />
                            <label for="uf">UF</label>
                            <select name="uf">
							<?php
                                $sql = "select iduf, nome from uf order by nome";
                                $resultado = mysqli_query($GLOBALS['connection'], $sql);
                                while($linha = mysqli_fetch_array($resultado)){
                            ?>
                            <option value="<?php echo $linha['iduf']; ?>"> <?php echo $linha['nome']; ?></option>
                            <?php	
                                }
                            ?>
                            </select>
                            <input type="submit" value="Buscar" />
                        </form>
                        </fieldset>
                 	<?php
               	}
       				if($_POST){
					$uf = $_POST['uf'];
					$cidade = strtoupper($_POST['cidade']);
					$sql = "select cidade.nome as cidade, uf.nome as uf from cidade, uf where cidade.nome like '%$cidade%' and cidade.iduf = $uf and cidade.iduf = uf.iduf order by cidade";
					$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));
					$numlinha = mysqli_num_rows($resultado);
					if($numlinha < 1){
						echo "Nenhum resultado foi encontrado para: ".$cidade." no estado informado.<br>";
						echo "Deseja cadastrar ".$cidade."?";
						?>
                        	<form action="pesquisarcid.php" method="get">
                            	<input type="hidden" name="cidade" value="<?php echo $cidade; ?>" />
                                <input type="hidden" name="uf" value="<?php echo $uf; ?>" />
                            	<input type="submit" name="btnEnviar" value="Sim" />
                                <input type="button" name="btnSair" value="Não" />
                            </form>
                        <?php
					}else{
						?>
                        <div style="overflow-y:auto; height:340px;">
                        	<table>
                            	<tr>
                                	<td width="250px">
                                    	Cidade
                                    </td>
                                    <td width="250px">
                                    	UF
                                   	</td>
                                </tr>
                                <?php
									while($linha = mysqli_fetch_array($resultado)){
										?>
                                        <tr>
                                        	<td>
                                            	<?php echo $linha['cidade']; ?>
                                            </td>
                                            <td>
                                            	<?php echo $linha['uf']; ?>
                                            </td>
                                        </tr>
                                        <?php
									}
								?>
                            </table>
                       	</div>
                        <?php
					}
				}
			?>
        </div>
    </div>
</body>
</html>