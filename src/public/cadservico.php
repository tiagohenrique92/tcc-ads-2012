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
		
		if(!isset($_SESSION['pedidoCadastrado'])){			
			$idcli = $_POST['idcli'];
			$_SESSION['tipo'] = $_POST['tipo'];
			$tipo = $_SESSION['tipo'];
			
			//verifica se é um novo pedido ou conclusão de um pedido já aberto
			switch($tipo){
				case "Novo":
					$idpedido = 'NULL';
					$dataped = implode("/", array_reverse(explode("/", date("d/m/Y"))));
					$sql = "insert into pedido(idpedido, idcli, dataped) value('$idpedido', '$idcli', '$dataped')";
					
					mysql_query($sql) or die("Erro para gravar o pedido - ".mysql_error());
					$sql = "select max(idpedido) as idpedido from pedido";
					$resultado = mysql_fetch_assoc(mysql_query($sql));
					$idpedido = $resultado['idpedido'];
					$totalPed = 0;
					$_SESSION['pedidoCadastrado'] = true;//registre a variavel pedido cadastrado
					$_SESSION['idpedido'] = $idpedido;// registre na sessão o id do pedido
				break;
				case "Concluir":
					$_SESSION['idpedido'] = $_POST['idpedido']; //registre na sessão o id do pedido
					$_SESSION['pedidoCadastrado'] = true;//registre a variavel pedido cadastrado
					$idpedido = $_SESSION['idpedido'];
				break;
			}
		}else{
			$idpedido = $_SESSION['idpedido'];
			$btnEnviar = $_POST['btnEnviar'];
			
			switch ($_POST['btnEnviar']){
					case "Inserir":
						$iditem = "NULL";
						$ref = $_POST['ref'];
						$qtde = $_POST['qtde'];
						$descricao = $_POST['descricao'];
						$valor = $_POST['valor'];
						$total = $valor * $qtde;
						$idpedido = $_SESSION['idpedido'];
						
						//verifica se todos os campos foram preenchidos
						if(verificaCampos($ref, $descricao, $total) == "ok"){
							//verifica se a referencia que o usuario quer cadastrar já existe no pedido				
							$sql = "select idpedido, ref, descricao, valor, qtde, total, status from ipedido where (idpedido = $idpedido) and (ref = $ref)";
							if(!mysql_query($sql)){
								echo "Erro  para bsucar o item. <br>";
							}else{
								$resultado = mysql_query($sql);
								$numRegistros = mysql_num_rows($resultado);
								if (empty($numRegistros)){ 
									$sql = "insert into ipedido(iditem, idpedido, ref, descricao, valor, qtde, total, status) values('$iditem', '$idpedido', '$ref', '$descricao', '$valor', '$qtde', '$total', 'F')";
									if(!mysql_query($sql)){
										echo "Erro  para gravar o item. <br>";
									}else{
										echo "<p style='background-color:#000000; color:#00FF00; font-size:18px'>Item gravado.</p>";
									}
									
								}else{
									echo "<p style='background-color:#FFFF00; color:#FF0000; font-size:18px'>A referencia $ref informada já está cadastrada neste pedido.<br /> Selecione a referencia na lista de itens do pedido para alterar suas propriedades.</p>";
								}
							}
						}else{
							echo "<p style='background-color:#FFFF00; color:#FF0000; font-size:18px'>Para gravar um item você precisa preencher os campos referencia, descricao, quantidade e preço OBRIGATÓRIAMENTE.<br>Os campos quantidade e preço não podem ser iguais a zero.</p>";
						}
					break;
					case "Gravar":
						$idpedido = $_SESSION['idpedido'];
						$valorTotal = somaTotal($idpedido);
						if($valorTotal == 0){
							$sql = "update pedido set valor = $valorTotal, status = 'C', idconta = 0 where idpedido = $idpedido";
						}else{
							$sql = "update pedido set valor = $valorTotal, status = 'A', idconta = 0 where idpedido = $idpedido";
						}
						if(!mysql_query($sql)){
							echo "Erro ao atualizar o valor total do pedido".mysql_error();
						}
						unset(
							$_SESSION['pedidoCadastrado'], 
							$_SESSION['idpedido'], 
							$_SESSION['razsoc'], 
							$_SESSION['fone'],
							$_SESSION['email'], 
							$_SESSION['celular'], 
							$_SESSION['contato'], 
							$_SESSION['idcli'],
							$_SESSION['iditem'],
							$_SESSION['valor']
						);
						header("location: index.php");
					break;
					case "Alterar":
						$iditem = $_POST['iditem'];
						$ref = $_POST['ref'];
						$qtde = $_POST['qtde'];
						$descricao = $_POST['descricao'];
						$valor = $_POST['valor'];
						$total = $valor * $qtde;
						$idpedido = $_SESSION['idpedido'];
						
						if(verificaCampos($ref, $descricao, $total) == "ok"){
							$sql = "update ipedido set descricao =  '$descricao', valor = $valor, qtde = $qtde, total = $total where (idpedido = $idpedido) and (iditem = $iditem)";
							
							if(!mysql_query($sql)){
								echo "Erro  para gravar o item. <br>";
							}else{
								echo "<p style='background-color:#000000; color:#00FF00; font-size:18px'>Item alterado.</p>";
							}
						}else{
							echo "<p style='background-color:#FFFF00; color:#FF0000; font-size:18px'>Para gravar um item você precisa preencher os campos referencia, descricao, quantidade e preço OBRIGATÓRIAMENTE.<br>Os campos quantidade e preço não podem ser iguais a zero.</p>";
						}
					break;
					case "SelServico":
						$idpedido = $_SESSION['idpedido'];
					break;
					case "Excluir":
						$iditem = $_POST['iditem'];
						$idpedido = $_SESSION['idpedido'];
						$sql = "delete from ipedido where ((idpedido = $idpedido) and (iditem = $iditem))";
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
				$sql = "select * from cliente where idcli = (select idcli from pedido where idpedido = $idpedido)";
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
            <legend>Cadastro de Serviço</legend>
        	<form name="frmcadservico" action="cadservico.php" method="post">
            	<input type="hidden" name="idcli" value="<?php echo $idcli; ?>" />
                <input type="hidden" name="idservico" value="NULL" />
                <input type="hidden" name="iditem" value="NULL" />
            	<table>
                	<tr>
                    	<td>Pedido<br />
                        <input type="text" name="idpedido" size="7" style="text-align:right" value="<?php echo $idpedido; ?>" />
                        </td>
                    	<td>Razão Social<br />
                        <input type="text" name="nome" size="58" style="text-transform:uppercase" value="<?php echo $nome; ?>" />
                        </td>
                        <td>Data<br />
                        <input type="text" name="dataped" size="14" value="<?php echo date("d/m/Y");?>" style="text-align:right"/><br/>
                        </td>
                        <td>Total<br />
                        <input type="text" name="totalPed" size="14" value="<?php echo somaTotal($idpedido); ?>" style="text-align:right" readonly="readonly" />
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
				//exibe o formulario para alterar os dados do item do pedido
				if(isset($btnEnviar) and ($btnEnviar == "SelServico")){
					$ref = $_POST['ref'];
					$sql = "select iditem from ipedido where (idpedido = $idpedido) and (ref = $ref)";
					$resultado = mysql_query($sql);
					$iditem = mysql_fetch_assoc($resultado);
					$iditem = $iditem['iditem'];
			?>
            	<form action="cadservico.php" method="post">
                	<input type="hidden" name="idpedido" value="<?php echo $idpedido; ?>" />  
            		<input type="hidden" name="iditem" value="<?php echo $iditem; ?>" />
                    <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" />
                    <fieldset style="width:730px; color:#0099FF;">
                    <table>
                        <tr>
                            <td>
                                Referência<br />
                                <input type="text" name="ref" size="5" value="<?php echo $ref=$_POST['ref']; ?>" style="text-align:right" readonly="readonly" />
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
            	<form action="cadservico.php" method="post">
                    <fieldset style="width:730px; color:#0099FF;">
                        <table>
                            <tr>
                                <td>Referência<br />
                                <input type="text" name="ref" size="5" />
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
				if(isset($_SESSION['pedidoCadastrado'])){
					$sql = "select iditem, ref, descricao, valor, qtde, total from ipedido where idpedido = $idpedido";
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
								<td width="69">Referência</td>
								<td width="387">Descrição</td>
								<td width="76">Quantidade</td>
								<td width="76">Preço</td>
								<td>Total</td>
							</tr>
            <?php
						}
								while($linha = mysql_fetch_array($resultado)){
									$ref = $linha['ref'];
									$descricao = $linha['descricao'];
									$valor = $linha['valor'];
									$qtde = $linha['qtde'];
									$total = $linha['total'];
									$iditem = $linha['iditem'];
									?>
										<form action="cadservico.php" method="post">
                                        	<input type="hidden" name="idpedido" value="<?php echo $idpedido; ?>"
                                            <input type="hidden" name="iditem" value="<?php echo $iditem; ?>"
											<tr>
												<td><input type="text" name="ref" value="<?php echo $ref; ?>" readonly="readonly" size="5" style="text-align:right" />
                                                </td>
                                                <td><input type="text" name="descricao" value="<?php echo $descricao; ?>" readonly="readonly" size="58" />
                                                </td>
                                                <td><input type="text" name="qtde" value="<?php echo $qtde; ?>" readonly="readonly" size="6" style="text-align:right" />
                                                </td>
                                                <td><input type="text" name="valor" value="<?php echo $valor; ?>" readonly="readonly" size="6" style="text-align:right"/>
                                                </td>
                                                <td>
                                                <input type="text" name="total" value="<?php echo $total; ?>" readonly="readonly" size="6" style="text-align:right" />
                                                <input type="image" name="btnEnviar" src="img/edit_32x32.png" width="20" height="20" title="Editar" value="SelServico"/>
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
	