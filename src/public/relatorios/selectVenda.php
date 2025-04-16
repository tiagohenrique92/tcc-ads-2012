<?php
	require "../conection.php";
	
	$dataini = implode("-", array_reverse(explode("/", $_GET['dataini'])));
	$datafin = implode("-", array_reverse(explode("/", $_GET['datafin'])));
	$soma = 0;
	$cont = 0;
	
	$sql = "select venda.*, prazo.nome as nomeprazo, cliente.nome as nome from venda, cliente, prazo where datavenda between '".$dataini."' and '".$datafin."' and venda.status <> 'C' and venda.idcli = cliente.idcli and venda.prazo_idprazo = prazo.idprazo";
	$select = mysqli_query($GLOBALS['connection'], $sql);
	$numrows = mysqli_num_rows($select);
	if($numrows > 0){
		?>
        <table width="100%;">
        	<thead>
                <tr>
                    <th align="left">Venda</th>
                    <th align="left">Data</th>
                    <th align="left">Cliente</th>
                    <th align="left">Status</th>
                    <th align="left">Prazo</th>
                    <th align="left">Total</th>
                </tr>
         	</thead>
        <?php
		while($linha = mysqli_fetch_assoc($select)){
			?>
            <tbody>
                <tr>
                    <td align="right"><?php echo $linha['idvenda'];?></td>
                    <td align="center"><?php echo implode("/", array_reverse(explode("-", $linha['datavenda'])));?></td>
                    <td align="left"><?php echo $linha['nome'];?></td>
                    <td align="center">
						<?php 
							switch($linha['status']){
								case 'PA':
									echo 'A pagar';
									break;
                                case 'PG':
                                    echo 'Pago';
                                    break;
								case 'AB':
									echo 'Aberto';
									break;
							}
                        ?>
                    </td>
                    <td align="left"><?php echo $linha['nomeprazo'];?></td>
                    <td align="right"><?php echo $linha['totalvenda'];?></td>
                </tr>
           	</tbody>
            <?php
			$soma += $linha['totalvenda'];
			$cont++;
		}
		?>
        	<tfoot>
            	<tr>
                	<th colspan="3" align="left">Número de vendas: <?php echo $cont; ?></th>
                	<th colspan="3" align="right">Total R$ <?php echo number_format($soma, 2); ?></th>
                </tr>
            </tfoot>
        </table>
        <?php
	}
?>