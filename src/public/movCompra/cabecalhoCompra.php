<?php
	require "../conection.php";
	$idcompra = $_SESSION['idcompra'];
	$sql = "select compra.*, fornecedor.razsoc from compra, fornecedor where idcompra = $idcompra and compra.idfor = fornecedor.idfor";
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
    	<td>Compra: <?php echo $linha['idcompra']; ?></td>	
        <td width="70">
        	<input type="button" id="gravar" value="Gravar" style="width:100%" />
        </td>
    </tr>
    <tr>
    	<td>Data da Compra: <?php echo implode("/", array_reverse(explode("-", $linha['datacompra'])));?></td>
        <td width="70"><input type="button" id="cancelar" value="Cancelar" style="width:100%" /></td>
    </tr>
    <tr>
    	<td>Fornecedor: <?php echo $linha['razsoc'];?></td>
        <td></td>
    </tr>
</table>