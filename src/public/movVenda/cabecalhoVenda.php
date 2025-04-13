<?php
	require "../conection.php";
	$idvenda = $_SESSION['idvenda'];
	$sql = "select venda.*, cliente.nome from venda, cliente where idvenda = $idvenda and venda.idcli = cliente.idcli";
	$resultado = mysql_query($sql);
	$linha = mysql_fetch_assoc($resultado);
?>
<style type="text/css">
#tabela input{
	margin:0;
}
</style>
<table cellspacing="0" cellpadding="0" width="980" id="tabela">
	<tr>
    	<td>Venda: <?php echo $linha['idvenda']; ?></td>	
        <td width="70">
        	<input type="button" id="gravar" value="Gravar" style="width:100%" />
        </td>
    </tr>
    <tr>
    	<td>Data da Venda: <?php echo implode("/", array_reverse(explode("-", $linha['datavenda'])));?></td>
        <td width="70"><input type="button" id="cancelar" value="Cancelar" style="width:100%" /></td>
    </tr>
    <tr>
    	<td>Cliente: <?php echo $linha['nome'];?></td>
        <td></td>
    </tr>
</table>