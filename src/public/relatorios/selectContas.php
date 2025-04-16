<?php
	require "../conection.php";
	$dados = $_GET['dados'];
	$valores = array();

	foreach($dados as $dado){
		$valores[$dado['name']] = $dado['value'];
	};

	$soma =0;
	$somaRec =0;
	$somaPag =0;
	$somaArec = 0;
	$somaApag =0;
	$cont = 0;
	
	switch($valores['tipo']){
		case '0':
			if($valores['status'] == '0'){
				$status = '"AB", "PA"';
				$tabela = "parcelarec";
				$data = 'datavenc';
				$dataini = implode("-", array_reverse(explode("/", $valores['intinicial'])));
				$datafin = implode("-", array_reverse(explode("/", $valores['intfinal'])));
			}else{
				$status = '"PG", "PA"';
				$data = 'datapag';
				$tabela = "parcelarec";
				$dataini = implode("-", array_reverse(explode("/", $valores['intinicial'])));
				$datafin = implode("-", array_reverse(explode("/", $valores['intfinal'])));
			}			
		break;
		case '1':
			if($valores['status'] == '0'){
				$status = '"A", "PA"';
				$tabela = "parcelapag";
				$data = 'datavenc';
				$dataini = implode("-", array_reverse(explode("/", $valores['intinicial'])));
				$datafin = implode("-", array_reverse(explode("/", $valores['intfinal'])));
			}else{
				$status = '"P", "PA"';
				$tabela = "parcelapag";
				$data = 'datapag';
				$dataini = implode("-", array_reverse(explode("/", $valores['intinicial'])));
				$datafin = implode("-", array_reverse(explode("/", $valores['intfinal'])));
			}
		break;
	}
	
	$sql = "select ".$tabela.".* from ".$tabela." where ".$data." between '".$dataini."' and '".$datafin."' and ".$tabela.".status in (".$status.")";
	$select = mysqli_query($GLOBALS['connection'], $sql);
	$numrows = mysqli_num_rows($select);
	if($numrows > 0){
		?>
        <table width="100%;">
        	<thead>
                <tr>
                	<th align="left"><?php if($valores['tipo'] == '0'){ echo "Venda";}else{echo "Compra";}?></th>
                    <th align="left">Parcela</th>
                    <th align="left">Total</th>
                    <th align="left"><?php if($valores['status'] == '0'){echo "Vencimento";}else{echo "Pagamento";} ?></th>
                    <th align="left">Status</th>
                    <th align="left">Valor</th>
                    <th align="left"><?php if($valores['tipo'] == '0'){ echo "Recebido";}else{echo "Pago";}?></th>
                    <th align="left"><?php if($valores['tipo'] == '0'){ echo "Receber";}else{echo "Pagar";}?></th>
                </tr>
         	</thead>
        <?php
		while($linha = mysqli_fetch_assoc($select)){
			if(($cont % 2) == '0'){
				$corLinha = '#EEE';
			}else{
				$corLinha = '#CCC';
			}
			?>
            <tbody>
                <tr>
                	<td align="right" bgcolor="<?php echo $corLinha; ?>"><?php if($valores['tipo'] == '0'){ echo $linha['idvenda'];}else{echo $linha['idcompra'];} ?></td>
                    <td align="right" bgcolor="<?php echo $corLinha; ?>"><?php echo $linha['numparc'];?></td>
                    <td align="right" bgcolor="<?php echo $corLinha; ?>"><?php echo $linha['totparc'];?></td>
                    <td align="center" bgcolor="<?php echo $corLinha; ?>"><?php echo implode("/", array_reverse(explode("-", $linha[$data])));?></td>
                    <td align="center" bgcolor="<?php echo $corLinha; ?>">
						<?php 
							switch($linha['status']){
								case "AB":
									echo "Aberto";
								break;
								case "AP":
									echo "A Pagar";
								break;
								case "PG":
									echo "Pago";
								break;
								case "P":
									echo "Pago";
								break;
								case "A":
									echo "Aberto";
								break;
								case "C":
									echo "Cancelado";
								break;
								case "PA":
									echo "Parcial";
								break;
							}
						?>
                    </td>
                    <td align="right" bgcolor="<?php echo $corLinha; ?>"><?php echo number_format($linha['valorparc'], 2);?></td>
                    <td align="right" bgcolor="<?php echo $corLinha; ?>"><?php if($valores['tipo'] == '0'){echo number_format($linha['valorrec'] ,2);}else{echo number_format($linha['valorpago'] ,2);}?></td>
                    <td align="right" bgcolor="<?php echo $corLinha; ?>"><?php if($valores['tipo'] == '0'){echo number_format($linha['valorparc'] - $linha['valorrec'], 2);}else{echo number_format($linha['valorparc'] - $linha['valorpago'], 2);} ?></td>
                </tr>
           	</tbody>
            <?php
			$soma += $linha['valorparc'];
			if($valores['tipo'] == '0'){
				$somaRec += $linha['valorrec'];
				$somaArec += ($linha['valorparc'] - $linha['valorrec']);
			}else{
				$somaPag += $linha['valorpago'];
				$somaApag += ($linha['valorparc'] - $linha['valorpago']);
			}
			$cont++;
		}
		?>
        	<tfoot>
            	<tr>
                	<th colspan="2" align="left">Número de parcelas: <?php echo $cont; ?></th>
                	<th colspan="2" align="left">Total R$ <?php echo number_format($soma, 2); ?></th>
                    <th colspan="2" align="left"><?php if($valores['tipo'] == '0'){echo "Total Recebido R$ ".number_format($somaRec, 2);}else{echo "Total Pago R$ ".number_format($somaPag, 2);} ?></th>
                    <th colspan="2" align="left"><?php if($valores['tipo'] == '0'){echo "Total a Receber R$ ".number_format($somaArec, 2);}else{echo "Total a Pagar R$ ".number_format($somaApag, 2);} ?></th>
                </tr>
            </tfoot>
        </table>
        <?php
	}
?>