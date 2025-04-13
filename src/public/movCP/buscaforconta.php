<?php
	require "../verificaLogin.php";
	verificaLogin('BUSCAFORCOMPRA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Busca Forncedor</title>
<link href="busca.css" rel="stylesheet" type="text/css" />
<link href="../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
<script type="text/javascript" src="../funcoes.js"></script>
</head>

<body onload="document.frmbuscafor.nome.focus()">
	<div id="pagina">
    	<div id="menuTopo">
        	<?php 
				require "../".$menu;
			?>
        </div>
        <div id="conteúdo">
        	<div id="busca">
                <div id="topo">
                    <div class="barraTitulo">Contas a Pagar►Buscar Fornecedor</div>
                </div>
                <form name="frmbuscafor" method="post">
                    <table>
                        <tr>
                            <td width="50px">Nome</td>
                            <td><input type="text" id="nome" name="nome" obg="true" style="text-transform:uppercase"/></td>
                        </tr>
                    </table>
                </form>
        		<div id="resultBusca">
            		<div id="encontrados"></div>
               	</div>
                <div id="contas"></div>
           	</div>
        </div>
    </div>
    <script type="text/javascript" src="js/buscaforconta.js"></script>
</body>
</html>