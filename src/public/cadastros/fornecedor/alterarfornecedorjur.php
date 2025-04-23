<?php
	require '../../verificaLogin.php';
	verificaLogin('ALTERARFORNECEDORJUR');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Alterar Fornecedor</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../jquery-1.7.2.js"></script>
<script type="text/javascript" src="fornecedor.js"></script>
<script type="text/javascript" src="funcoes.js"></script>
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
        	<div class="barraTitulo">Cadastros►Fornecedor►Alterar►Pessoa Jurídica</div>
            <br />
        	<fieldset style="width:500px; left:50%; margin-left:-250px; position:relative;">
            <form name="frmcadfornecedor" id="frmcadfornecedor" action="salvarfornecedor.php" onsubmit="return false" method="post">
            	<input type="hidden" name="idfor" value="<?php echo $_POST['idfor']; ?>" />
                <input type="hidden" name="tipo" value="<?php echo $_POST['tipo']; ?>" />
                <input type="hidden" name="opcao" id="opcao" value="Alterar" />
            	<label for="razsoc">Razão Social</label>
                <input type="text" name="razsoc" id="razsoc" size="60" maxlength="80" style="text-transform:uppercase" value="<?php echo $_POST['razsoc']; ?>" /><br />
                <label for="razsoc">Fantasia</label>
                <input type="text" name="fantasia" id="fantasia" size="60" maxlength="80" style="text-transform:uppercase" value="<?php echo $_POST['fantasia']; ?>" /><br />
                <label for="cnpjcpf">CNPJ</label>
                <input type="text" name="cnpjcpf" id="cnpjcpf" size="25" value="<?php echo $_POST['cnpjcpf']; ?>" /><br />
                <label for="ierg">IE</label>
                <input type="text" name="ierg" size="25" value="<?php echo $_POST['ierg']; ?>" /><br />
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endreco" size="60" style="text-transform:uppercase" value="<?php echo $_POST['endereco']; ?>" /><br />
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" id="bairro" size="60" style="text-transform:uppercase" value="<?php echo $_POST['bairro']; ?>" /><br />
                <label for="uf">UF</label>
                <select name="uf" id="uf">
                	<option value="<?php echo $_POST['uf']; ?>" selected="selected">
                    	<?php echo $_POST['estado']; ?>
                   	</option>
					<?php
                        $sql = "select iduf, nome from uf where iduf <> '".$_POST['uf']."' order by nome";
                        $resuldado = mysqli_query($GLOBALS['connection'], $sql);
                        while($linha = mysqli_fetch_array($resuldado)){
                    ?>
                    <option value="<?php echo $linha['iduf']; ?>"> <?php echo $linha['nome']; ?></option>
                    <?php	
                        }
                    ?>
               	</select><br />
                <label for="cidade">Cidade</label>
                <select name="cidade" id="cidade">
                	<option value="<?php echo $_POST['idcid']; ?>" selected="selected">
                    	<?php echo $_POST['cidade']; ?>
                   	</option>
                    <?php
                        $sql = "select idcid, nome from cidade where idcid <> '".$_POST['idcid']."' order by nome";
                        $resuldado = mysqli_query($GLOBALS['connection'], $sql);
                        while($linha = mysqli_fetch_array($resuldado)){
                    ?>
                    <option value="<?php echo $linha['idcid']; ?>"> <?php echo $linha['nome']; ?></option>
                    <?php	
                        }
                    ?>
                </select><br />
                <label for="cep">CEP</label>
                <input type="text" name="cep" size="25" value="<?php echo $_POST['cep']; ?>" maxlength="8" /><br />
                <label for="fone">Fone</label>
                <input type="text" name="fone" size="25" value="<?php echo $_POST['fone']; ?>" /><br />
                <label for="celular">Celular</label>
                <input type="text" name="celular" size="25" value="<?php echo $_POST['celular']; ?>" /><br />
                <label for="email">Email</label>
                <input type="text" name="email" size="60" style="text-transform:lowercase" value="<?php echo $_POST['email']; ?>" /><br />
                <label for="contato">Contato</label>
                <input type="text" name="contato" size="25"  style="text-transform:uppercase" value="<?php echo $_POST['contato']; ?>" /><br />
                <label for="status">Status</label>
                <?php if($_POST['status'] == 'A'){ ?>
                		<label for="status">Ativo</label>
                        <input type="radio" name="status" value="A" checked="checked" /><br  />
                        <label for="">&nbsp;</label>
                        <label for="status">Inativo</label>	
                        <input type="radio" name="status" value="I" /> 
                <?php }else{ ?>		
                		<label for="status">Ativo</label>
                        <input type="radio" name="status" value="A"  /><br />
                        <label for="">&nbsp;</label>
                        <label for="status">Inativo</label>
                        <input type="radio" name="status" value="I" checked="checked" /> 
                <?php }	?>
                <br />
                <input type="submit" name="btnEnviar" value="Alterar" id="btnEnviar" />
            </form>
            </fieldset>
        </div>
    </div>
</body>
</html>
	