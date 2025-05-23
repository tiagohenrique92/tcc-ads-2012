<?php
	require "../conection.php";
	
	if(isset($_GET['id'])){
		$idcli = $_GET['id'];
		$ordem = $_GET['ordem'];
		$sql = "select parcelarec.*, venda.idcli, venda.datavenda from parcelarec, venda where (venda.idcli = $idcli) and (parcelarec.idvenda = venda.idvenda) and (parcelarec.status = 'AB') order by $ordem, numparc, idvenda";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$numResultado = mysqli_num_rows($resultado);
		?>
       	<div class="barraTitulo">Encontrados</div>
        <?php
			if(empty($numResultado)){
				echo "Este cliente não possui parcelas em aberto.";	
				exit;
			}
		?>
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
		while($linha = mysqli_fetch_array($resultado)){
			$idvenda = $linha['idvenda'];
			$datavenda = implode("/", array_reverse(explode("-", $linha['datavenda'])));
			$idparc = $linha['numparc'];
			$totalparc = $linha['totparc'];
			$datavenc = implode("/", array_reverse(explode("-", $linha['datavenc'])));
			$valorparc = $linha['valorparc'];
            $form = $idvenda . "_" . $idparc;
			?>
			<form id="<?php echo $form; ?>" class="frmBaixar">
				<input form="<?php echo $form; ?>" type="hidden" name="idcli" value="<?php echo $idcli; ?>" />
			<tr>
				<td align="right"><input form="<?php echo $form; ?>" type="text" name="idvenda" size="10px" readonly="readonly" value="<?php echo $idvenda; ?>" style="text-align:right" /></td>
				<td align="center"><input form="<?php echo $form; ?>" type="text" name="datavenda" size="10px" readonly="readonly" value="<?php echo $datavenda; ?>" style="text-align:center" /></td>
				<td align="right"><input form="<?php echo $form; ?>" type="text" name="idparc" size="10px" readonly="readonly" value="<?php echo $idparc; ?>" style="text-align:right" /></td>
				<td align="right"><input form="<?php echo $form; ?>" type="text" name="totparc" size="12px" readonly="readonly" value="<?php echo $totalparc; ?>" style="text-align:right" /></td>
				<td align="center"><input form="<?php echo $form; ?>" type="text" name="datavenc" size="10px" readonly="readonly" value="<?php echo $datavenc; ?>" style="text-align:center" /></td>
				<td align="right"><input form="<?php echo $form; ?>" type="text" name="valorparc" size="10px" readonly="readonly" value="<?php echo $valorparc; ?>" style="text-align:right" /></td>
				<td align="center"><input form="<?php echo $form; ?>" type="submit" name="btSelecionar" value="Baixar" /></td>
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
$(function(){
	$('.frmBaixar').on('submit', function(e){
        e.preventDefault();
        var inputs = $(this).serializeArray()
		document.getElementById('idcli').value = inputs.find(e => e.name === 'idcli').value;
		document.getElementById('idvenda').value = inputs.find(e => e.name === 'idvenda').value;
		document.getElementById('idparc').value = inputs.find(e => e.name === 'idparc').value;
		document.getElementById('totparc').value = inputs.find(e => e.name === 'totparc').value;
		document.getElementById('valorparc').value = inputs.find(e => e.name === 'valorparc').value;
		return false;
	});
});
</script>