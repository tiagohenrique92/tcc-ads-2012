<?php
	require '../verificaLogin.php';
	verificaLogin('BUSCACONTAREC');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Parcelas a Receber</title>
<link href="busca.css" rel="stylesheet" type="text/css" />
<link href="../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
</head>

<body>
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../".$menu;
			?>
        </div>
        <div id="conteúdo">
        	<div id="topo">
            	<div class="barraTitulo">Contas a Receber►Selecionar Conta</div>
                
                <?php
					if(isset($_GET['id'])){
						$idcli = $_GET['id'];
						$sql = "select * from cliente where idcli = ".$idcli;
						$resultado = mysql_query($sql);
						$cliente = mysql_fetch_assoc($resultado);
						$nome = $cliente['nome'];
					}
				?>
                <div class="barraSubTitulo">Cliente►<?php echo $nome; ?></div>
                <form id="formOrdernar" method="get">
                    <label>Ordenar Por:</label>
                    <br />
                    <input type="hidden" name="id" id="idcli" value="<?php echo $idcli; ?>" />
                    <input type="radio" name="ordem" value="idvenda" checked="checked" />Venda
                    <input type="radio" name="ordem" value="datavenda" />Data-Venda
                    <input type="radio" name="ordem" value="datavenc" />Vencimento
                    <input type="radio" name="ordem" value="valorparc" />Valor       
                </form>
          	</div>
            <div id="resultBusca">
            	<div id="encontrados">
                </div>
            </div>
            <div id="lancamento">
            	<div class="barraTitulo">Baixar Conta</div>
                <form id="confbaixarconta" action="baixarconta.php" method="get">
					<input type="hidden" name="idcli" id="idcli" value="<?php echo $idcli; ?>" />
					<label>Venda</label>
					<input type="text" name="idvenda" id="idvenda" readonly="readonly" size="15" style="text-align:right" />
					<label>Parcela</label>
					<input type="text" name="idparc" id="idparc" readonly="readonly" size="15" style="text-align:right" />
                    <label>Total de Parcelas</label>
					<input type="text" name="totparc" id="totparc" readonly="readonly" size="15" style="text-align:right" />
					<label>Valor</label>
					<input type="text" name="valorparc" id="valorparc" readonly="readonly" size="15" style="text-align:right"  />
					<input type="submit" name="btnEnviar" id="btnEnviar" value="Confirmar" />
				</form>
            </div>
      	</div>
    </div>
    <script type="text/javascript" src="js/buscaconta.js"></script>
</body>
</html>