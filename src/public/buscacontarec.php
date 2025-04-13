<?php
	require 'verificaLogin.php';
	verificaLogin('BUSCACONTAREC');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Parcelas a Receber</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
        </div>
        <div id="conteúdo">
        	<?php
				if(isset($_GET['id'])){
					$idcli = $_GET['id'];
					$ordem = $_GET['ordem'];
					$sql = "select parcelarec.*, venda.idcli, venda.datavenda from parcelarec, venda where (venda.idcli = $idcli) and (parcelarec.idvenda = venda.idvenda) and (parcelarec.status = 'A') order by $ordem, numparc, idvenda";
					$resultado = mysql_query($sql);
					?>
                    <hr />
                    <form action="buscacontarec.php" method="get">
                        <label>Ordenar Por:</label>
                        <br />
                        <input type="hidden" name="id" value="<?php echo $idcli; ?>" />
                        <input type="radio" name="ordem" value="idvenda" checked="checked" />Venda
                        <input type="radio" name="ordem" value="datavenda" />Data-Venda
                        <input type="radio" name="ordem" value="datavenc" />Vencimento
                        <input type="radio" name="ordem" value="valorparc" />Valor  
                        <input type="submit" value="Ordenar" />     
                    </form>
                    <hr />
                    <table>
                        <tr>
                            <td width="70px">Venda</td>
                            <td width="100px">Data da Venda</td>
                            <td width="70px">Nº da Parcela</td>
                            <td width="70px">Total de Parcelas</td>
                            <td width="100px">Vencimento</td>
                            <td width="80px">Valor</td>
                            <td width="50px">Baixar</td>
                        </tr>
                	<?php
					while($linha = mysql_fetch_array($resultado)){
						$idvenda = $linha['idvenda'];
						$datavenda = implode("/", array_reverse(explode("-", $linha['datavenda'])));
						$idparc = $linha['numparc'];
						$totalparc = $linha['totparc'];
						$datavenc = implode("/", array_reverse(explode("-", $linha['datavenc'])));
						$valorparc = $linha['valorparc'];
						?>
                        <form action="baixarconta.php" method="post">
                        	<input type="hidden" name="idcli" value="<?php echo $idcli; ?>" />
                        <tr>
                        	<td align="right"><input type="text" name="idvenda" size="10px" readonly="readonly" value="<?php echo $idvenda; ?>" style="text-align:right" /></td>
                            <td align="center"><input type="text" name="datavenda" size="10px" readonly="readonly" value="<?php echo $datavenda; ?>" style="text-align:center" /></td>
                            <td align="right"><input type="text" name="idparc" size="10px" readonly="readonly" value="<?php echo $idparc; ?>" style="text-align:right" /></td>
                            <td align="right"><input type="text" name="totparc" size="12px" readonly="readonly" value="<?php echo $totalparc; ?>" style="text-align:right" /></td>
                            <td align="center"><input type="text" name="datavenc" size="10px" readonly="readonly" value="<?php echo $datavenc; ?>" style="text-align:center" /></td>
                            <td align="right"><input type="text" name="valorparc" size="10px" readonly="readonly" value="<?php echo $valorparc; ?>" style="text-align:right" /></td>
                            <td align="center"><input type="image" src="menu/Tick-32.png" width="25" height="25" title="Baixar Conta"/></td>
                        </tr>
                        </form>
                        <?php
					}
					?>
                    </table>
                    <hr />
                    <?php
				}
			?>
        </div>
    </div>
</body>
</html>