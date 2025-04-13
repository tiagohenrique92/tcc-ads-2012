<?php
	require "../conection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Compra</title>
<link href="compra.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/produtos.js"></script>
<link href="../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../".$menu;
			?>
        </div>
    	<div id="topo">
        	<div id="cabecalho">
            	<div class="barraTitulo">
            		<p>Nova Compra</p>
                </div>
                <div>
                	<?php
						require 'cabecalhoCompra.php';
					?>
                </div>
            </div>
        </div>
        <div id="busca">
        	<div id="campoBusca">
            	<div class="barraTitulo">
        			<p>Buscar Produto</p>
                </div>
                <div>
                	<form onsubmit="return false" id="frmBuscaProduto">
                    	<input type="radio" name="rdnomecodigo" value="n" id="rdnome" checked="checked">Nome
                        <input type="radio" name="rdnomecodigo" value="c" id="rdbarras" />Barras
                        <input type="text" name="valbusca" id="valbusca" style="width: 799px" autofocus="autofocus" />
                        <input type="button" name="btnNovo" id="btnNovo" value="Novo" />
                    </form>
                </div>
            </div>
            <div id="resultBusca">
            	<div class="barraTitulo">
            		<p>Produtos Encontrados</p>
                </div>
                <div class="barraSubTitulo">
                	<table width="100%" height="100%" cellspacing="5px">
                        <tr>
                            <td width="45px" align="center">#</td>
                            <td width="60px" align="center">Barras</td>
                            <td>Nome</td>
                            <td width="35px" align="center">Preço</td>
                            <td width="70px" align="center">Add</td>
                        </tr>
                 	</table>
                </div>
                <div id="encontrados">
                   	<?php
						require "buscaprodutocompra.php";
					?>
                </div>
            </div>
            <div id="insert">
            	<div class="barraTitulo">
        			<p>Inserir Produto</p>
                </div>
                <div id="InserirProduto">
                <form id="frmInserirProduto" onsubmit="return false">
                	<input type="hidden" name="idcompra" id="idcompra" value="<?php echo $_SESSION['idcompra']; ?>" />
                    <input type="hidden" name="idpro" id="idpro" />
                    <label for="barras">Barras</label>
                    <input type="text" readonly="readonly" name="barras" id="barras" size="7" />
                    <label for="nome">Nome</label>
                    <input type="text" readonly="readonly" name="nome" id="nome" size="30" />
                    <label for="preco">Preço</label>
                    <input type="text" readonly="readonly" name="preco" id="preco" size="7" />
                    <label for="qtde">Qtde</label>
                    <input type="text" name="qtde" id="qtde"  size="7" autofocus="autofocus"/>
                    <input type="submit" name="btnInserir" class="btnInserir" value="Inserir" />
                    <input type="submit" name="btnAlterar" class="btnAlterar" value="Alterar" style="display:none" />
                </form>
                </div>
            </div>
        </div>
        <div id="itemCompra">
        	<div class="barraTitulo">
            	<p>Itens da Compra</p>
            </div>
        	<div id="itensCompra"></div>
        </div>
        <div id="finalizacao">
        	<div class="barraTitulo" style="width:495px; display:block">
            	<p>Valores da Compra</p>
            </div>
            <div id="valores">
            	<?php
                	$sql = "select * from prazo where (status = 'A') order by nome";
					$resultado = mysql_query($sql);
				?>
            	<form name="frmValores" id="frmValores" onsubmit="return false">
                	<label for="subtotal" style="width:61px; display:inline-block">Sub-Total</label>
                    <input type="text" name="subtotal" id="subtotal" readonly="readonly" style="width:95px; text-align:right" /><br />
                    <label for="desconto" style="width:61px; display:inline-block">Desconto</label>
                    <input type="text" name="desconto" id="desconto" style="width:95px; text-align:right"/>
                    <select name="tipodesc" id="tipodesc">
                    	<option value="p">%</option>
                        <option value="d">$</option>                        
                    </select><br />
                    <label for="total" style="width:59px; display:inline-block" >Total</label>
                    <input type="text" name="total" id="total" readonly="readonly" style="width:95px; text-align:right" /><br />
                    <label for="prazo" style="width:59px; display:inline-block;" >Prazo</label>
                    <select name="prazo" id="prazo">
                    <?php
						while($linha = mysql_fetch_array($resultado)){
							?>
								<option value="<?php echo $linha['idprazo']; ?>"><?php echo $linha['nome'];?></option>
							<?php
						}
					?>
                    </select><br />
                    <input type="submit" name="gerarParcelas" id="gerarParcelas" value="Calcular Parcelas" />
                </form>
            </div>
            <div id="parcelas">
            	<div class="barraTitulo">
                	<p>Parcelas</p>
                </div>
                <div id="itemparcelas">
                </div>
            </div>
        </div>
    </div>
</body>
</html>