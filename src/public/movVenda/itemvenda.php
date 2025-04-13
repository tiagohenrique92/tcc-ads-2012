<table width="100%" cellspacing="3px">
	<tr>
    	<td  width="50px" align="center">#</td>
    	<td width="130px" align="left">Barras</td>
        <td>Nome</td>
        <td width="70px" align="left">Qtde</td>
        <td width="70px" align="left">Preco</td>
       	<td width="70px" align="left">Total</td>
        <td width="50px" align="center">Editar</td>
    </tr>
<?php
	require "../conection.php";
	if($_GET){
		$i =0;
		$soma = 0;
		$idvenda = $_GET['idvenda'];
		
		$sql = "select itemvenda.*, produto.nome as nome, produto.barras as barras, produto.qtde as estoque from itemvenda, produto where idvenda = $idvenda and produto.idpro = itemvenda.idpro";
		
		$resultado = mysql_query($sql);
		
		while($linha = mysql_fetch_assoc($resultado)){
			$i++;
			$soma = $soma + $linha['total'];
			?>
            <tr>
            	<td align="center"><?php echo $i;?></td>
            	<td align="right"><?php echo $linha['barras']; ?></td>
                <td><?php echo $linha['nome']; ?></td>
                <td align="right"><?php echo $linha['qtde']; ?></td>
                <td align="right"><?php echo $linha['precovenda']; ?></td>
                <td align="right"><?php echo $linha['total']; ?></td>
                <td align="center">
                	<a href="#" class="spriteIcons btnEdit" title="Editar" estoque="<?php echo ($linha['estoque'] + $linha['qtde']);?>" barras="<?php echo $linha['barras'];?>" idpro="<?php echo $linha['idpro']?>" nomepro="<?php echo $linha['nome']?>" qtdepro="<?php echo $linha['qtde']?>" precopro="<?php echo $linha['precovenda']?>"></a>
                </td>
            </tr>
            <?php
		}
	}
?>
</table>
<table width="100%">
	<tr>
    	<td align="right" style="padding:0 55px 0 0;">
        	Total Geral: R$ <?php echo number_format($soma, 2);?>
        </td>
    </tr>
</table>
<script type="text/javascript" src="js/itemvenda.js"></script>
<script type="text/javascript">
	var subtotal = Number(<?php echo $soma; ?>).toFixed(2); 
	$('#frmValores #subtotal', window.parent.document).attr('value', subtotal); 
</script>