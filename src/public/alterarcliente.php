<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Alterar Cliente</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="funcoes.js"></script>
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
        	<fieldset style="width:500px; color:#009900;">
            <legend>Alterar Cliente</legend>
        	<form name="frmcadcliente" action="salvarcliente.php" method="post">
            	<input type="hidden" name="idcli" value="<?php echo $_POST['idcli']; ?>" />
            	<table>
                	<tr>
                    	<td width="90px">Razão Social</td>
                        <td><input type="text" name="nome" size="60" maxlength="80" style="text-transform:uppercase" value="<?php echo $_POST['nome']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>CNPJ</td>
                        <td><input type="text" name="cnpj" onblur="cnpj.value = maskCnpj(cnpj.value)" size="25" value="<?php echo $_POST['cnpj']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>IE</td>
                        <td><input type="text" name="ie" size="25" value="<?php echo $_POST['ie']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>Endereço</td>
                        <td><input type="text" name="endereco" size="60" style="text-transform:uppercase" value="<?php echo $_POST['endereco']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>Bairro</td>
                        <td><input type="text" name="bairro" size="60" style="text-transform:uppercase" value="<?php echo $_POST['bairro']; ?>" /></td>
                   	</tr>
                    <tr>
	                   	<td>UF</td>
                        <td><select name="uf" onfocus="cidade.value=''" onblur="abreJanela(uf.value)">
                        	<option value="<?php echo $_POST['uf']; ?>" selected="selected">
                            	<?php echo $_POST['estado']; ?>
                            </option>
							<?php
								$uf = $_POST['uf'];
                               	$sql = "select iduf, nome from uf where iduf <> $uf order by nome";
                                $result = mysql_query($sql);
								
                                while($linha = mysql_fetch_array($result)){	
                            ?>
                            <option value="<?php echo $linha['iduf']; ?>">
                           		<?php echo $linha['nome']; ?>
                            </option>
                            <?php	
                                }
                            ?>
                            </select></td>
                	</tr>
                    <tr>
                    	<td>Cidade</td>
                        <td>
                        	<input type="hidden" name="idcid" />
                        	<input type="text" name="cidade" readonly="readonly" size="24" obg="true" style="text-transform:uppercase"  value="<?php echo $_POST['cidade']; ?>" />
                       </td>
                  	</tr>
                    <tr>
                    	<td>CEP</td>
                        <td><input type="text" name="cep" size="25" onblur="cep.value = maskCep(cep.value)" value="<?php echo $_POST['cep']; ?>" maxlength="8" /></td>
                   	</tr>
                    <tr>
                    	<td>Fone</td>
                        <td><input type="text" name="fone" size="25" onblur="fone.value = maskFone(fone.value)" value="<?php echo $_POST['fone']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>Celular</td>
                        <td><input type="text" name="celular" size="25" onblur="celular.value = maskFone(celular.value)" value="<?php echo $_POST['celular']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>Email</td>
                        <td><input type="text" name="email" size="60" style="text-transform:lowercase" value="<?php echo $_POST['email']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>Contato</td>
                        <td><input type="text" name="contato" size="25"  style="text-transform:uppercase" value="<?php echo $_POST['contato']; ?>" /></td>
                   	</tr>
                    <tr>
                    	<td>Status</td>
                        <td>
                        	<?php if($_POST['status'] == 'A'){ ?>
                            		<input type="radio" name="status" value="A" checked="checked" />Ativo
									<input type="radio" name="status" value="I" />Inativo 
							<?php }else{ ?>		
                            		<input type="radio" name="status" value="A"  />Ativo
									<input type="radio" name="status" value="I" checked="checked" />Inativo 
							<?php }	?>
                        </td>
                    </tr>
            	</table>
                <input type="submit" name="btnEnviar" value="Alterar" class="botao" style="margin-left: 413px; margin-bottom:-11px;" />
            </form>
            </fieldset>
        </div>
    </div>
</body>
</html>
	