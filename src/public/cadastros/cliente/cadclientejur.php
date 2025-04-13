<?php
		require '../../verificaLogin.php';
		verificaLogin('CADCLIENTEJUR');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Cadastro de Cliente</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../jquery-1.7.2.js"></script>
<script type="text/javascript" src="cliente.js"></script>
<style type="text/css">
label, input, select{
	display:block; float:left;	
}

label{
	width:90px;
}
select{
	min-width:190px;
}
br{
	clear:left;	
}
</style>
</head>

<body>

    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../../".$menu;
			?>
  		</div>
        <div id="conteúdo">
        	<div class="barraTitulo">Cadastros►Cliente►Pessoa Jurídica</div>
            <br />
        	<fieldset style="width:500px; left:50%; margin-left:-250px; position:relative;">
        	<form id="frmcadcliente" action="salvarcliente.php" method="get" onsubmit="return false">
            	<input type="hidden" name="idcli" id="idcli" value="NULL" />
                <input type="hidden" name="status" id="status" value="A" />
                <input type="hidden" name="tipo" id="tipo" value="J" />
                <input type="hidden" name="opcao" id="opcao" value="Salvar" />
            	<label for="nome">Razão Social*</label>
                <input type="text" name="nome" id="nome" size="60" maxlength="80" /><br />
                <label for="cnpjcpf">CNPJ*</label>
                <input type="text" name="cnpjcpf" id="cnpjcpf" size="24" maxlength="18" /><br />
                <label for="ierg">IE</label>
                <input type="text" name="ierg" id="ierg" size="24" /><br />
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" size="60" style="text-transform:uppercase" /><br />
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" id="bairro" size="60" style="text-transform:uppercase" /><br />
                <label for="uf">UF*</label>
                <select name="uf" id="uf">
                 	<option value="0">SELECIONE</option>
					<?php
                        $sql = "select iduf, nome from uf order by nome";
                        $resuldado = mysql_query($sql);
                        while($linha = mysql_fetch_array($resuldado)){
                    ?>
                    <option value="<?php echo $linha['iduf']; ?>"> <?php echo $linha['nome']; ?></option>
                    <?php	
                        }
                    ?>
               	</select><br />
                <label for="cidade">Cidade*</label>
                <select name="cidade" id="cidade">
                	<option value="0">SELECIONE</option>
                </select><br />
               	<label for="cep">CEP*</label>
                <input type="text" name="cep" id="cep" size="24" maxlength="8" /><br />
                <label for="fone">Fone</label>
                <input type="text" name="fone" id="fone" size="24" /><br />
                <label for="celular">Celular</label>
                <input type="text" name="celular" id="celular" size="24" /><br />
                <label for="email">Email</label>
                <input type="text" name="email" id="email" size="60" style="text-transform:lowercase" /><br />
                <label for="contato">Contato*</label>
                <input type="text" name="contato" id="contato" size="24" style="text-transform:uppercase"/><br />
                <input type="submit" name="btnEnviar" id="btnEnviar" value="Salvar" />
            </form>
            </fieldset>
    	</div>
    </div>
</body>
</html>
	