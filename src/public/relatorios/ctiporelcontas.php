<?php
	require "../conection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Relatórios</title>
<link href="../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<link href="../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../cssPrint.css" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
<script type="text/javascript" src="contas.js"></script>
<style type="text/css">
th{
	background:#EEE;
	color:#000;
}
</style>
</head>

<body>
<?php
	include "../".$menu;
?>
	<div id="pagina">
        <div id="conteúdo">
        	<div class="barraTitulo">Relatórios►Contas</div>
            <div class="config">
            	<br />
            	<fieldset>
                <form method="get" onsubmit="return false" id="frmRelatorio">
                	<fieldset style="width:120px; height:90px; float:left">
                		<label for="tipo">Tipo</label><br />
                    	<input type="radio" name="tipo" id="tipo" value="0" />Recebimento
                    	<input type="radio" name="tipo" id="tipo" value="1" />Pagamento
                	</fieldset>
                    <fieldset style="width:400px; height:90px; float:left">
                        <label for="intinicial">Data Inicial</label><br />
                        <input type="text" name="intinicial" id="intinicial" value="<?php echo implode("/", array_reverse(explode("-", $_SESSION['datacaixa']))); ?>"  /><br />
                        <label for="intfinal">Data Final</label><br />
                        <input type="text" name="intfinal" id="intfinal" value="<?php echo date("d/m/Y", (strtotime("+1 month") + $_SESSION['datacaixa'])); ?>" />
                   	</fieldset>
                    <fieldset style="width:120px; height:90px; float:left">
                        <label for="status">Status</label><br />
                        <input type="radio" name="status" id="status" value="0" />Receber/Pagar
                        <input type="radio" name="status" id="status" value="1" />Recebido/Pago
                   	</fieldset>
                    <input type="submit" value="Gerar" id="btnGerar" />
                </form>
                </fieldset>
            </div>
            <div id="encontrados"></div>
        </div>
    </div>
</body>
</html>