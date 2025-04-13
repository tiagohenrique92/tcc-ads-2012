<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Cadastro de Cliente</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="funcoes.js"></script>
</head>

<body onload="document.frmcadcliente.nome.focus()">
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
            <legend>Cadastro de Cliente - Pessoa Física</legend>
        	<form name="frmcadcliente" action="salvarcliente.php" method="post" onsubmit="return checarDadosObg(this.name)">
            	<input type="hidden" name="idcli" value="NULL" />
                <input type="hidden" name="status" value="A" />
            	<table>
                	<tr>
                    	<td width="90px">Nome</td>
                        <td><input required="required" type="text" name="nome" obg="true" size="60" maxlength="80" style="text-transform:uppercase" /></td>
                   	</tr>
                    <tr>
                    	<td>CPF</td>
                        <td><input required="required" type="text" name="cpf" obg="true" onblur="cpf.value = maskCpf(cpf.value, form.name)" size="24" maxlength="11" /></td>
                   	</tr>
                    <tr>
                    	<td>RG</td>
                        <td><input type="text" name="rg" size="24" /></td>
                   	</tr>
                    <tr>
                    	<td>Endereço</td>
                        <td><input type="text" name="endereco" size="60" style="text-transform:uppercase" /></td>
                   	</tr>
                    <tr>
                    	<td>Bairro</td>
                        <td><input type="text" name="bairro" size="60" style="text-transform:uppercase" /></td>
                   	</tr>
                    <tr>
	                   	<td>UF</td>
                        <td><select name="uf" onfocus="cidade.value=''" onblur="abreJanela(uf.value)">
							<?php
                                $sql = "select iduf, nome from uf order by nome";
                                $resuldado = mysql_query($sql);
                                while($linha = mysql_fetch_array($resuldado)){
                            ?>
                            <option value="<?php echo $linha['iduf']; ?>"> <?php echo $linha['nome']; ?></option>
                            <?php	
                                }
                            ?>
                            </select>
                      	</td>
                	</tr>
                    <tr>
                    	<td>Cidade</td>
                        <td>
                        	<input required="required" type="hidden" name="idcid" />
                        	<input required="required" type="text" name="cidade" readonly="readonly" size="24" obg="true" style="text-transform:uppercase" />
                       	</td>
                  	</tr>
                    <tr>
                    	<td>CEP</td>
                        <td><input required="required" type="text" name="cep" obg="true" onblur="cep.value = maskCep(cep.value)" size="24" maxlength="8" /></td>
                   	</tr>
                    <tr>
                    	<td>Fone</td>
                        <td><input type="text" name="fone" size="24" onblur="fone.value = maskFone(fone.value, this.name)" /></td>
                   	</tr>
                    <tr>
                    	<td>Celular</td>
                        <td><input type="text" name="celular" size="24" onblur="celular.value = maskFone(celular.value, this.name)" /></td>
                   	</tr>
                    <tr>
                    	<td>Email</td>
                        <td><input type="text" name="email" size="60" style="text-transform:lowercase" /></td>
                   	</tr>
                    <tr>
                    	<td>Contato</td>
                        <td><input required="required" type="text" name="contato" size="24"  obg="true" style="text-transform:uppercase"/></td>
                   	</tr>
            	</table>
                <input type="submit" name="btnEnviar" value="Salvar" class="botao" style="margin-left: 413px; margin-bottom:-11px;" />
            </form>
            </fieldset>
    	</div>
    </div>
</body>
</html>
	