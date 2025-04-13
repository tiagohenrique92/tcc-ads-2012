<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Nova Venda</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
		require "verificaLogin.php";
		require "funcoes.php";
		
		if(!isset($_SESSION['vendaCadastrada'])){			
			$idcli = $_POST['idcli'];
			$_SESSION['tipo'] = $_POST['tipo'];
			$tipo = $_SESSION['tipo'];
			
			//verifica se é uma nova venda ou conclusão de uma venda já aberta
			switch($tipo){
				case "Novo":
					$idvenda = 'NULL';
					$datavenda = implode("/", array_reverse(explode("/", date("d/m/Y"))));
					$sql = "insert into venda(idvenda, idcli, datavenda, status, idcaixa) value('$idvenda', '$idcli', '$dataped', 'A', $caixa)";
					
					mysql_query($sql) or die("Erro para gravar a venda - ".mysql_error());
					$sql = "select max(idvenda) as idvenda from venda";
					$resultado = mysql_fetch_assoc(mysql_query($sql));
					$idvenda = $resultado['idvenda'];
					$totalVenda = 0;
					$_SESSION['vendaCadastrada'] = true;//registre a variavel venda cadastrada
					$_SESSION['idvenda'] = $idvenda;// registre na sessão o id da venda
				break;
				case "Concluir":
					$_SESSION['idvenda'] = $_POST['idvenda']; //registre na sessão o id da venda
					$_SESSION['vendaCadastrada'] = true;//registre a variavel venda cadastrada
					$idvenda = $_SESSION['idvenda'];
				break;
			}
		}else{
			$idvenda = $_SESSION['idvenda'];
			$btnEnviar = $_POST['btnEnviar'];
			
			switch ($_POST['btnEnviar']){
				case "Inserir":
					$idpro = "NULL";
					$idpro = $_POST['idpro'];
					$qtde = $_POST['qtde'];
					$descricao = $_POST['descricao'];
					$valor = $_POST['valor'];
					$total = $valor * $qtde;
					$idvenda = $_SESSION['idvenda'];
					
					//verifica se todos os campos foram preenchidos
					if(verificaCampos($idpro, $descricao, $total) == "ok"){
						//verifica se a idproerencia que o usuario quer cadastrar já existe no pedido				
						$sql = "select idvenda, idpro, descricao, valor, qtde, total, status from ipedido where (idvenda = $idvenda) and (idpro = $idpro)";
						if(!mysql_query($sql)){
							echo "Erro  para bsucar o item. <br>";
						}else{
							$resultado = mysql_query($sql);
							$numRegistros = mysql_num_rows($resultado);
							if (empty($numRegistros)){ 
								$sql = "insert into ipedido(idpro, idvenda, idpro, descricao, valor, qtde, total, status) values('$idpro', '$idvenda', '$idpro', '$descricao', '$valor', '$qtde', '$total', 'F')";
								if(!mysql_query($sql)){
									echo "Erro  para gravar o item. <br>";
								}else{
									echo "<p style='background-color:#000000; color:#00FF00; font-size:18px'>Item gravado.</p>";
								}
								
							}else{
								echo "<p style='background-color:#FFFF00; color:#FF0000; font-size:18px'>A idproerencia $idpro informada já está cadastrada neste pedido.<br /> Selecione a idproerencia na lista de itens do pedido para alterar suas propriedades.</p>";
							}
						}
					}else{
						echo "<p style='background-color:#FFFF00; color:#FF0000; font-size:18px'>Para gravar um item você precisa preencher os campos idproerencia, descricao, quantidade e preço OBRIGATÓRIAMENTE.<br>Os campos quantidade e preço não podem ser iguais a zero.</p>";
					}
				break;
				case "Gravar":
					$idvenda = $_SESSION['idvenda'];
					$valorTotal = somaTotal($idvenda);
					if($valorTotal == 0){
						$sql = "update pedido set valor = $valorTotal, status = 'C', idconta = 0 where idvenda = $idvenda";
					}else{
						$sql = "update pedido set valor = $valorTotal, status = 'A', idconta = 0 where idvenda = $idvenda";
					}
					if(!mysql_query($sql)){
						echo "Erro ao atualizar o valor total do pedido".mysql_error();
					}
					unset(
						$_SESSION['vendaCadastrada'], 
						$_SESSION['idvenda'], 
						$_SESSION['razsoc'], 
						$_SESSION['fone'],
						$_SESSION['email'], 
						$_SESSION['celular'], 
						$_SESSION['contato'], 
						$_SESSION['idcli'],
						$_SESSION['idpro'],
						$_SESSION['valor']
					);
					header("location: index.php");
				break;
				case "Alterar":
					$idpro = $_POST['idpro'];
					$idpro = $_POST['idpro'];
					$qtde = $_POST['qtde'];
					$descricao = $_POST['descricao'];
					$valor = $_POST['valor'];
					$total = $valor * $qtde;
					$idvenda = $_SESSION['idvenda'];
					
					if(verificaCampos($idpro, $descricao, $total) == "ok"){
						$sql = "update ipedido set descricao =  '$descricao', valor = $valor, qtde = $qtde, total = $total where (idvenda = $idvenda) and (idpro = $idpro)";
						
						if(!mysql_query($sql)){
							echo "Erro  para gravar o item. <br>";
						}else{
							echo "<p style='background-color:#000000; color:#00FF00; font-size:18px'>Item alterado.</p>";
						}
					}else{
						echo "<p style='background-color:#FFFF00; color:#FF0000; font-size:18px'>Para gravar um item você precisa preencher os campos idproerencia, descricao, quantidade e preço OBRIGATÓRIAMENTE.<br>Os campos quantidade e preço não podem ser iguais a zero.</p>";
					}
				break;
				case "SelItem":
					$idvenda = $_SESSION['idvenda'];
				break;
				case "Excluir":
					$idpro = $_POST['idpro'];
					$idvenda = $_SESSION['idvenda'];
					$sql = "delete from ipedido where ((idvenda = $idvenda) and (idpro = $idpro))";
					$resultado = mysql_query($sql);
					echo "<p style='background-color:#FFFF00; color:#FF0000; font-size:18px'>O item foi excluído.</p>";
				break;
			}
		}
?>
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
				
				if(!$_POST){
					header("location: index.php");
				}
				
				//busca dados do cliente través do id do pedido
				$sql = "select * from cliente where idcli = (select idcli from venda where idvenda = $idvenda)";
				$resultado = mysql_query($sql);
				while($linha = mysql_fetch_array($resultado)){
					$idcli = $linha['idcli'];
					$nome = $linha['nome'];
					$fone = $linha['fone'];
					$celular = $linha['celular'];
					$contato = $linha['contato'];
					$email = $linha['email'];
				}
			?>
  		</div>
        <div id="conteúdo">
        	<fieldset style="width:730px; color:#0099FF;">
            <legend>Venda</legend>
        	<form name="frmvenda" action="cadvenda.php" method="post">
            	<input type="hidden" name="idcli" value="<?php echo $idcli; ?>" />
                <input type="hidden" name="idvenda" value="NULL" />
                <input type="hidden" name="idpro" value="NULL" />
            	<table>
                	<tr>
                    	<td>Venda<br />
                        <input type="text" name="idvenda" size="7" style="text-align:right" value="<?php echo $idvenda; ?>" />
                        </td>
                    	<td>Razão Social<br />
                        <input type="text" name="nome" size="58" style="text-transform:uppercase" value="<?php echo $nome; ?>" />
                        </td>
                        <td>Data<br />
                        <input type="text" name="datavenda" size="14" value="<?php echo date("d/m/Y");?>" style="text-align:right"/><br/>
                        </td>
                        <td>Total<br />
                        <input type="text" name="totalvenda" size="14" value="<?php echo somaTotal($idvenda); ?>" style="text-align:right" readonly="readonly" />
                        </td>
              		</tr>
               	</table>
                <table>
                	<tr>
                    	<td>Email<br />
                        <input type="text" name="email" size="43" style="text-transform:lowercase" value="<?php echo $email; ?>" />
                        </td>
                    	<td>Contato<br />
                        <input type="text" name="contato" size="20"  style="text-transform:uppercase" value="<?php echo $contato;?>" />
                        </td>
                    	<td>Fone<br />
                        <input type="text" name="fone" size="15" value="<?php echo $fone; ?>" /></td>
                    	<td>Celular<br />
                        <input type="text" name="celular" size="15" value="<?php echo $celular; ?>" /></td>
                   	</tr>
             	</table>
          	</fieldset><br />
            <?php
				//exibe o formulario para alterar os dados do item da venda
				if(isset($btnEnviar) and ($btnEnviar == "SelItem")){
					$idpro = $_POST['idpro'];
					$sql = "select idpro from itemvenda where (idvenda = $idvenda) and (idpro = $idpro)";
					$resultado = mysql_query($sql);
					$idpro = mysql_fetch_assoc($resultado);
					$idpro = $idpro['idpro'];
			?>
            	<form action="cadvenda.php" method="post">
                	<input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>" />  
            		<input type="hidden" name="idpro" value="<?php echo $idpro; ?>" />
                    <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" />
                    <fieldset style="width:730px; color:#0099FF;">
                    <table>
                        <tr>
                            <td>
                                Produto<br />
                                <input type="text" name="idpro" size="5" value="<?php echo $idpro=$_POST['idpro']; ?>" style="text-align:right" readonly="readonly" />
                            </td>
                            <td>
                                Descrição<br />
                                <input type="text" name="descricao" size="53" value="<?php echo $descricao = $_POST['descricao']; ?>" />
                            </td>
                            <td>
                                Quantidade<br />
                                <input type="text" name="qtde" size="6" value="<?php echo $qtde = $_POST['qtde']; ?>" style="text-align:right" />
                            </td>
                            <td>
                                Preço<br />
                                <input type="text" name="valor" size="6" value="<?php echo $valor = $_POST['valor']; ?>" style="text-align:right" />
                            </td>
                        </tr>
                    </table>
                    <input name="btnEnviar" type="submit" style="border:none; background-color:#0099FF; color:#FFFFFF; width:70px; height:60px; font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif; margin-left: 599px; margin-bottom:-11px; " title="Alterar" value="Alterar" />
                    <input name="btnEnviar" type="submit"  style="border:none; background-color:#0099FF; color:#FFFFFF; width:70px; height:60px; font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif; margin-right:-14px; margin-bottom:-11px; " title="Excluir" value="Excluir"/>
                    </fieldset><br />
                </form>
           	<?php
				}else{
			?>
            	<form action="cadvenda.php" method="post">
                    <fieldset style="width:730px; color:#0099FF;">
                        <table>
                            <tr>
                                <td>Produto<br />
                                <input type="text" name="idpro" size="5" />
                                </td>
                                <td>Descrição<br />
                                <input type="text" name="descricao" size="58" />
                                </td>
                                <td>Quantidade<br />
                                <input type="text" name="qtde" size="6" value="1" />
                                </td>
                                <td>Preço<br />
                                <input type="text" name="valor" size="6" />
                                </td>
                                <td><input type="submit" name="btnEnviar" value="Inserir" style="border:none; background-color:#0099FF; color:#FFFFFF; width:100px; height:70px; font-size:18px; font-family:Verdana, Arial, Helvetica, sans-serif; margin-left: 18px; margin-top: -20px; margin-bottom: -25px;" /></td>
                            </tr>
                        </table>
                    </form>
                    </fieldset><br />
        	<?php
                }
				if(isset($_SESSION['vendaCadastrada'])){
					echo $sql = "select itemvenda.idvenda, itemvenda.idpro, produto.nome, itemvenda.precovenda, itemvenda.qtde, total from itemvenda, produto where idvenda = $idvenda and itemvenda.idpro = produto.idpro";
					$resultado = mysql_query($sql);
					$numRegistros = mysql_num_rows($resultado);
			?>	
					<fieldset style="width:730px; color:#0099FF;">
            <?php
				if(!empty($numRegistros)){
			?>
					<legend>Itens do Pedido</legend>
						<table style="margin-bottom:5px">
							<tr>
								<td width="69">idproerência</td>
								<td width="387">Descrição</td>
								<td width="76">Quantidade</td>
								<td width="76">Preço</td>
								<td>Total</td>
							</tr>
            <?php
						}
								while($linha = mysql_fetch_array($resultado)){
									$idpro = $linha['idpro'];
									$descricao = $linha['descricao'];
									$valor = $linha['valor'];
									$qtde = $linha['qtde'];
									$total = $linha['total'];
									$idpro = $linha['idpro'];
									?>
										<form action="cadservico.php" method="post">
                                        	<input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>"
                                            <input type="hidden" name="idpro" value="<?php echo $idpro; ?>"
											<tr>
												<td><input type="text" name="idpro" value="<?php echo $idpro; ?>" readonly="readonly" size="5" style="text-align:right" />
                                                </td>
                                                <td><input type="text" name="descricao" value="<?php echo $descricao; ?>" readonly="readonly" size="58" />
                                                </td>
                                                <td><input type="text" name="qtde" value="<?php echo $qtde; ?>" readonly="readonly" size="6" style="text-align:right" />
                                                </td>
                                                <td><input type="text" name="valor" value="<?php echo $valor; ?>" readonly="readonly" size="6" style="text-align:right"/>
                                                </td>
                                                <td>
                                                <input type="text" name="total" value="<?php echo $total; ?>" readonly="readonly" size="6" style="text-align:right" />
                                                <input type="image" name="btnEnviar" src="img/edit_32x32.png" width="20" height="20" title="Editar" value="SelItem"/>
                                                </td>
											</tr>
										</form>
									<?php
								}
							?>
                     	</table>
                        <table>
                        	<form action="cadservico.php" method="post">
                            	<tr>
                                	<td>
                                    	<input type="submit" name="btnEnviar" value="Gravar" style="border:none; background-color:#0099FF; color:#FFFFFF; width:100px; height:70px; font-size:18px; font-family:Verdana, Arial, Helvetica, sans-serif; margin-left: 640px; margin-top: -10px; margin-bottom: -14px;"/>
                                   	</td>
                                </tr>
                            </form>
	                   	</table>
					</fieldset>
            <?php
               	}
          	?>
        </div>
    </div>
</body>
</html>
	