<?php
	ob_start();
	require "verificaLogin.php";
	verificaLogin('NOVAVENDA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Inserir Produto</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body onload="document.frmbuscapro.barras.focus()">
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
        </div>
        <div id="conteúdo">
        	<?php
				if($_GET){
					$idcli = $_GET['id'];
					$data = $_SESSION['datacaixa'];
					$sql = "insert into venda(idvenda, datavenda, status, idcli) values(null, '$data', 'A', $idcli)";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
					$_SESSION['vendaCadastrada'] = true;
					$sql = "select max(idvenda) as idvenda from venda";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
					$linha = mysqli_fetch_assoc($resultado);
					$_SESSION['idvenda'] = $linha['idvenda'];
					header("location: venda.php");
				}
				if(!($_POST)){
					?>
                    <fieldset style="width:670px"><legend>Buscar Produto</legend>
                    	<form name="frmbuscapro" action="novavenda.php" method="post">
                        	<input type="hidden" name="barranome" value="B" />
                            <label>Barras</label>
                            <input type="text" name="barras" size="23" onclick="barranome.value='B'" />
                        	<label>Nome</label>
                            <input type="text" name="nome" size="43" onclick="barranome.value='N'" />
                            <input type="submit" name="btnEnviar" class="botao" value="Buscar" />
                        </form>
                    </fieldset>
                    <?php
					if($_SESSION['vendaCadastrada'] == true){
						$idvenda = $_SESSION['idvenda'];
						$sql = "select itemvenda.*, produto.nome from itemvenda, produto where idvenda = $idvenda and itemvenda.idpro = produto.idpro";
						$resultado = mysqli_query($GLOBALS['connection'], $sql);
						$numlinha = mysqli_num_rows($resultado);
						if($numlinha > 0){
							?>
                            <fieldset style="width:670px">
                            <legend><?php echo "Produtos da Venda:";?></legend>
                            <?php
							?>
								<table width="670px" border="1px">
                                	<tr style="background-color:#060; color:#FFF">
                                    	<td width="60">Produto</td>
                                        <td>Nome</td>
                                        <td>Preço</td>
                                        <td width="80">Quantidade</td>
                                        <td>Total</td>
                                        <td width="45" align="center">Excluir</td>
                                    </tr>
								<?php
								$totalvenda = 0;
								while($linha = mysqli_fetch_assoc($resultado)){
									$idpro = $linha['idpro'];
									$nome = $linha['nome'];
									$preco = $linha['precovenda'];
									$qtde = $linha['qtde'];
									$total = $linha['total'];
									$totalvenda = $totalvenda + $total;
									?>
										<tr>
											<td style="text-align:right"><?php echo $idpro; ?></td>
											<td><a style="text-decoration:none; color:#000000" href="incluirprodvenda.php?idpro=<?php echo $idpro; ?>&tipo=A&qtde=<?php echo $qtde; ?>"><?php echo $nome; ?></a></td>
											<td style="text-align:right"><?php echo $preco; ?></td>
											<td style="text-align:right"><?php echo $qtde; ?></td>
											<td style="text-align:right"><?php echo $total; ?></td>
                                            <td align="center"><a style="text-decoration:none; color:#000000" href="incluirprodvenda.php?idpro=<?php echo $idpro; ?>&tipo=E&qtde=<?php echo $qtde; ?>"><img src="menu/Trash-32.png" width="20" height="20" title="Excluir" /></a></td>
										</tr>
									<?php
								}
								?>
								</table>
                                
                                
                                <table width="670px">
                                	<tr align="right">
                                    	<td><h3 style="color:#090">Total R$ <?php echo strtr(number_format($totalvenda, 2), ".", ",") ; ?></h3>
                                        </td>
                                    </tr>
                                    <tr align="right">
                                    	<td>	
                                        <form name="frmsalvarvenda" action="configvenda.php" method="post">
                                            <input type="hidden" name="totalvenda" value="<?php echo $totalvenda; ?>" />
                                        	<input type="submit" name="btnEnviar" value="Gravar" class="botao" />
                                        </form>
                                        </td>
                                    </tr>
                                </table>
                                </fieldset>
								<?php
						}
					}
				}else{
					$barranome = $_POST['barranome'];
					$idvenda = $_SESSION['idvenda']; 
					?>
                    	<a style="text-decoration:none; color:#000000;" href="novavenda.php" title="Buscar Produto">Nova Busca</a>
                    <?php
					switch($barranome){
						case "B":
							$barras = $_POST['barras'];
							$sql = "select * from produto where barras = $barras and status = 'A' and idpro not in (select idpro from itemvenda where idvenda = $idvenda) order by nome";
							$resultado = mysqli_query($GLOBALS['connection'], $sql);
							$numlinha = mysqli_num_rows($resultado);
							if($numlinha <> 1){
								echo "<br />A pesquisa não encontrou resultados.";
								exit();
							}else{
								$linha = mysqli_fetch_assoc($resultado);
								$idpro = $linha['idpro'];
								$nome = $linha['nome'];
								$preco = $linha['precovenda'];
								$estoque = $linha['qtde'];
								$barras = $linha['barras'];
								header("location: incluirprodvenda.php?idpro=$idpro&tipo=N&qtde=0");
							}
						break;
						case "N";
							$nome = $_POST['nome'];
							$sql = "select * from produto where nome like '%$nome%' and status = 'A' and idpro not in (select idpro from itemvenda where idvenda = $idvenda) order by nome";
							$resultado = mysqli_query($GLOBALS['connection'], $sql);
							$numlinha = mysqli_num_rows($resultado);
							if($numlinha < 1){
								echo "<br />A pesquisa não encontrou resultados.";
								exit();
							}else{
								?>
								<table width="700px;" border="1px">
                                	<tr style="background-color:#060; color:#FFF">
                                    	<td>Produto</td>
                                        <td>Nome</td>
                                        <td>Preço</td>
                                        <td>Estoque</td>
                                        <td>Barras</td>
                                    </tr>
								<?php
								while($linha = mysqli_fetch_assoc($resultado)){
									$idpro = $linha['idpro'];
									$nome = $linha['nome'];
									$preco = $linha['precovenda'];
									$estoque = $linha['qtde'];
									$barras = $linha['barras'];
									?>
										<tr>
											<td style="text-align:right"><?php echo $idpro; ?></td>
											<td><a style="text-decoration:none; color:#000000" href="incluirprodvenda.php?idpro=<?php echo $idpro; ?>&tipo=N&qtde="><?php echo $nome; ?></a></td>
											<td style="text-align:right"><?php echo $preco; ?></td>
											<td style="text-align:right"><?php echo $estoque; ?></td>
											<td style="text-align:right"><?php echo $barras; ?></td>
										</tr>
									<?php
								}
								?>
								</table>
								<?php
							}
						break;
					}
				}
			?>
        </div>
    </div>
</body>
</html>
