<?php
		require '../../verificaLogin.php';
		verificaLogin('BUSCACLIENTE');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Buscar Cliente</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../jquery-1.7.2.js"></script>
<script type="text/javascript" src="cliente.js"></script>
<!--script type="text/javascript" src="funcoes.js"></script-->
</head>

<body onload="document.forms[0].nome.focus()">
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../../".$menu;
			?>
  		</div>
        <div id="conteúdo">
        	<div class="barraTitulo">Busca de Cliente</div>
				<form name="frmbuscacliente" id="frmbuscacliente" method="post" onsubmit="return false" >
                    <table>
                        <tr>
                            <td width="100px">Razão Social</td>
                            <td><input type="text" name="nome" id="nome" size="130" /></td>
                            <td width="50px"><input type="submit" value="Buscar" id="buscar" />
                            </td>
                        </tr>
                    </table>
                </form>
          	<div class="barraTitulo">Encontrados</div>
            <div id="encontrados"></div>
        </div>
    </div>
</body>
</html>
