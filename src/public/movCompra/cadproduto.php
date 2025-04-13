<?php
	require '../verificaLogin.php';
	verificaLogin('CADPRODUTO');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Cadastro de Produto</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../funcoes.js"></script>
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
<script type="text/javascript" src="../funcoesJquery.js"></script>
</head>

<body>
    <div id="pagina">
        <div id="conteúdo">
        	<?php
				if($_GET){
					$idpro = $_GET['idpro'];
					$nome = $_GET['nome'];
					$pcompra = $_GET['pcompra'];
					$pvenda = $_GET['pvenda'];
					$barras = $_GET['barras'];
					$status = $_GET['status'];
				}else{
					$idpro = '';
					$nome = '';
					$pcompra = '';
					$pvenda = '';
					$barras = '';
					$status = 'A';
				}
			?>
            <fieldset style="color:#090; width: 480px;">
            <legend>Cadastro de Produto</legend>
	        	<form name="frmcadpro" action="salvaproduto.php" method="post" onsubmit="return qtdeMaiorZero(qtde.value)">
                <input type="hidden" name="idpro" value="<?php echo $idpro; ?>" />
                	<table width="480px">
                    	<tr>
                        	<td width="50px">
                            	<label>Nome</label>
                           	</td>
                            <td>
                    			<input type="text" name="nome" size="60" style="text-transform:uppercase" value="<?php echo $nome; ?>" />
                           	</td>
                    	</tr>
                        <tr>
                        	<td>
                            	<label>Barras</label>
                            </td>
                            <td>
                            	<input type="text" name="barras" size="60" value="<?php echo $barras; ?>" />
                           	</td>
                      	</tr>
                        <tr>
                        	<td>
                            	<label>Compra</label>
                            </td>
                            <td>
                            	<input type="text" name="pcompra" size="15" class="dinheiro" value="<?php echo $pcompra; ?>" />
                            </td>
                       	</tr>
                        <tr>
                        	<td>
                                <label>Venda</label>
                           	</td>
                            <td>
                                <input type="text" name="pvenda" size="15" class="dinheiro" value="<?php echo $pvenda; ?>"/>
                           	</td>
                       	</tr>
                        <tr>
                        	<td>
                            </td>
                        	<td>
                            	<?php
									if($status == 'I'){
								?>
                                <input type="radio" name="status" value="A"  />Ativo
                                <input type="radio" name="status" value="I" checked="checked" />Inativo
                                <?php
									}else{
								?>
                                <input type="radio" name="status" value="A" checked="checked" />Ativo
                                <input type="radio" name="status" value="I" />Inativo
                                <?php
									}
								?>									
                            </td>
                        </tr>
               		</table>
                    <table width="480px">
                        <tr>
                        	<td align="right">
                    			<input type="submit" class="botao" name="btnEnviar" value="Gravar" />
                           	</td>
                        </tr>
                  	</table>
    	        </form>
           	</fieldset>
        </div>
    </div>
</body>
</html>