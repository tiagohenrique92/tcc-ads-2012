<?php
	require "../conection.php";
	
	$dataini = implode("-", array_reverse(explode("/", $_GET['dataini'])));
	$datafin = implode("-", array_reverse(explode("/", $_GET['datafin'])));
	$soma = 0;
	$cont = 0;
	
	$sql = "select compra.*, prazo.nome as nomeprazo, fornecedor.razsoc as nome from compra, fornecedor, prazo where datacompra between '".$dataini."' and '".$datafin."' and compra.status <> 'CA' and compra.idfor = fornecedor.idfor and compra.prazo = prazo.idprazo";
	$select = mysql_query($sql);
	$numrows = mysql_num_rows($select);
	if($numrows > 0){
		?>
        <table width="100%;">
        	<thead>
                <tr>
                    <th align="left">Compra</th>
                    <th align="left">Data</th>
                    <th align="left">Fornecedor</th>
                    <th align="left">Status</th>
                    <th align="left">Prazo</th>
                    <th align="left">Total</th>
                </tr>
         	</thead>
        <?php
		while($linha = mysql_fetch_assoc($select)){
			?>
            <tbody>
                <tr>
                    <td align="right"><?php echo $linha['idcompra'];?></td>
                    <td align="center"><?php echo implode("/", array_reverse(explode("-", $linha['datacompra'])));?></td>
                    <td align="left"><?php echo $linha['nome'];?></td>
                    <td align="center">
						<?php 
							switch($linha['status']){
								case 'C':
									echo 'Cancelado';
									break;
								case 'AP':
									echo 'À pagar';
									break;
								case 'AB':
									echo 'Aberto';
									break;
							}
                        ?>
                    </td>
                    <td align="left"><?php echo $linha['nomeprazo'];?></td>
                    <td align="right"><?php echo $linha['totalcompra'];?></td>
                </tr>
           	</tbody>
            <?php
			$soma += $linha['totalcompra'];
			$cont++;
		}
		?>
        	<tfoot>
            	<tr>
                	<th colspan="3" align="left">Número de compras: <?php echo $cont; ?></th>
                	<th colspan="3" align="right">Total R$ <?php echo number_format($soma, 2); ?></th>
                </tr>
            </tfoot>
        </table>
        <?php
	}
?>