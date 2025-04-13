<?php
	require 'verificaLogin.php';
	verificaLogin('CONFIGVENDA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Salvar Venda</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="funcoes.js"></script>
<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript" src="funcoesJquery.js"></script>
<script type="text/javascript">function pausa(){ return false; }</script>
</head>

<body onload="document.forms['frmgravavenda'].desconto.focus()">
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
        </div>
        <div id="conteúdo">
        	<?php
				$idvenda = $_SESSION['idvenda'];
				$sql = "select * from prazo where status = 'A' order by nome";
				$resultado = mysql_query($sql);
				$totalvenda = number_format($_POST['totalvenda'], 2);
				?>
				<form name="frmgravavenda" method="post" action="index.php" onsubmit="return abreTelaParc(prazo.value, idvenda.value, totalvenda.value, desconto.value, this.name)">
					<input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>" />
					
					<label class="label">Total Venda</label>
					<input type="text" name="totalvenda" value="<?php echo $totalvenda; ?>" readonly="readonly" size="20" style="text-align:right;" /><br /><br />
					<label class="label">Desconto</label>
					<input  type="text" name="desconto" class="dinheiro" value="0" size="20" style="text-align:right" /><br /><br />
					 <label class="label">Prazo</label>
						<select class="label" name="prazo" onblur="abreTelaParc(prazo.value, '<?php echo $_SESSION['idvenda']; ?>', '<?php echo $totalvenda; ?>', ent.value, form.name)">
							<?php
								while($linha = mysql_fetch_array($resultado)){
									?>
										<option value="<?php echo $linha['idprazo']; ?>"><?php echo $linha['nome'];?></option>
									<?php
								}
							?>
						</select><br /><br />
					<input type="submit" name="btnEnviar" value="Próximo" />
				</form>
        </div>
    </div>
</body>
</html>