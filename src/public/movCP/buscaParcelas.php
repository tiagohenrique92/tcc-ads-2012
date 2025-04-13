<?php
	require "../conection.php";
	
	if(isset($_GET['id'])){
		$idfor = $_GET['id'];
		$ordem = $_GET['ordem'];
		$sql = "select parcelapag.*, compra.idfor, compra.datacompra from parcelapag, compra where (compra.idfor = $idfor) and (parcelapag.idcompra = compra.idcompra) and (parcelapag.status = 'A') order by $ordem, numparc, idcompra";
		$resultado = mysql_query($sql);
		$numResultado = mysql_num_rows($resultado);
		?>
       	<div class="barraTitulo">Encontrados</div>
        <?php
			if(empty($numResultado)){
				echo "Este fornecedor não possui parcelas em aberto.";	
				exit;
			}
		?>
		<table>
			<tr>
				<td width="70px">Compra</td>
				<td width="100px">Data da Compra</td>
				<td width="70px">Nº da Parcela</td>
				<td width="70px">Total de Parcelas</td>
				<td width="100px">Vencimento</td>
				<td width="80px">Valor</td>
				<td width="50px">Baixar</td>
			</tr>
		<?php
		while($linha = mysql_fetch_array($resultado)){
			$idcompra = $linha['idcompra'];
			$datacompra = implode("/", array_reverse(explode("-", $linha['datacompra'])));
			$idparc = $linha['numparc'];
			$totalparc = $linha['totparc'];
			$datavenc = implode("/", array_reverse(explode("-", $linha['datavenc'])));
			$valorparc = $linha['valorparc'];
			?>
			<form class="frmBaixar">
				<input type="hidden" name="idfor" value="<?php echo $idfor; ?>" />
			<tr>
				<td align="right"><input type="text" name="idcompra" size="10px" readonly="readonly" value="<?php echo $idcompra; ?>" style="text-align:right" /></td>
				<td align="center"><input type="text" name="datacompra" size="10px" readonly="readonly" value="<?php echo $datacompra; ?>" style="text-align:center" /></td>
				<td align="right"><input type="text" name="idparc" size="10px" readonly="readonly" value="<?php echo $idparc; ?>" style="text-align:right" /></td>
				<td align="right"><input type="text" name="totparc" size="12px" readonly="readonly" value="<?php echo $totalparc; ?>" style="text-align:right" /></td>
				<td align="center"><input type="text" name="datavenc" size="10px" readonly="readonly" value="<?php echo $datavenc; ?>" style="text-align:center" /></td>
				<td align="right"><input type="text" name="valorparc" size="10px" readonly="readonly" value="<?php echo $valorparc; ?>" style="text-align:right" /></td>
				<td align="center"><input type="submit" name="btSelecionar" value="Baixar" /></td>
			</tr>
			</form>
			<?php
		}
		?>
		</table>
		<?php
	}
?>

<style type="text/css">
#encontrados table{
	width:680px;
	left:50%;
	position:relative;
	margin:0 0 0 -340px;
}
</style>

<script type="text/javascript">
baixar();

function baixar(){
	$('.frmBaixar').submit(function(){
		document.getElementById('idfor').value = this.idfor.value;
		document.getElementById('idcompra').value = this.idcompra.value;
		document.getElementById('idparc').value = this.idparc.value;
		document.getElementById('totparc').value = this.totparc.value;
		document.getElementById('valorparc').value = this.valorparc.value;
		return false;
	});
}
</script>