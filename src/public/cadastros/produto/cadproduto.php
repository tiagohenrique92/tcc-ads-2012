<?php
	require '../../verificaLogin.php';
	verificaLogin('CADPRODUTO');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Cadastro de Produto</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../funcoes.js"></script>
<script type="text/javascript" src="../../jquery-1.7.2.js"></script>
<script type="text/javascript" src="../../funcoesJquery.js"></script>
<script type="text/javascript" src="produto.js"></script>
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
#busca{
	width:495px;
	float:left;
}
#cadastro{
	width:495px;
	float:right;
}
#encontrados{
	0clear:left;
	float:left !important;
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
        	<div class="barraTitulo">Cadastros►Produto</div>
            <br />
        	<?php
				if($_GET){
					$idpro = $_GET['idpro'];
					$nome = $_GET['nome'];
					$pcompra = $_GET['pcompra'];
					$pvenda = $_GET['pvenda'];
					$barras = $_GET['barras'];
					$qtde = $_GET['qtde'];
					$status = $_GET['status'];
				}else{
					$idpro = '';
					$nome = '';
					$pcompra = '';
					$pvenda = '';
					$qtde = '';
					$barras = '';
					$status = 'A';
				}
			?>
            <div id="busca">
        		<fieldset style="width:465px">
        			<form id="frmbuscapro" action="resultbuscapro.php" method="get" onsubmit="return false">
                        <input type="hidden" name="frmname" value="frmcadpro" />
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" size="38" style="text-transform:uppercase" />
                        <input type="submit" name="btnEnviar" id="btnEnviar" value="Pesquisar" />
           			 </form>
            	</fieldset>
            	<div id="encontrados"></div>
            </div>
            <div id="cadastro">
                <fieldset style="width:465px">
                    <form id="frmcadpro" action="salvaproduto.php" method="get" onsubmit="return false">
                        <input type="hidden" name="idpro" id="idpro" />
                        <label for="nome">Nome*</label>
                        <input type="text" name="nome" id="nome" size="55" style="text-transform:uppercase" /><br />
                        <label for="barras">Barras*</label>
                        <input type="text" name="barras" id="barras" size="55" /><br />
                        <label for="pcompra">Compra*</label>
                        <input type="text" name="pcompra" id="pcompra" size="15" class="dinheiro" /><br />
                        <label for="pvenda">Venda*</label>
                        <input type="text" name="pvenda" id="pvenda" size="15" class="dinheiro" /><br />
                        <label for="qtde">Quantidade</label>
                        <input type="text" name="qtde" id="qtde" size="15" class="sonums" /><br />
                        <label for="status">Status*</label>
                        <label for="status">Ativo</label>
                       	<input type="radio" name="status" id="status" value="A" checked="checked" /><br />
                        <label for="">&nbsp;</label>
                        <label for="status">Inativo</label>	
                       	<input type="radio" name="status" id="status" value="I" /><br />
							
                        <input type="submit" name="btnGravar" id="btnGravar" value="Gravar" />
                	</form>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>