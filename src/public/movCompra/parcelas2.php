	<?php
		require '../conection.php';
	?>
    <?php
			
			/*$datacaixa = $_SESSION['datacaixa'];
			$id = $_GET['id'];
			$form = $_GET['form'];
			$desconto = $_GET['desconto'];
			$_SESSION['prazo'] = $prazo = $_GET['prazo'];
			$valor = $_GET['valor'];
			$_SESSION['valorfinal'] = $valorfinal = $valor - $desconto;
			$num = 0;
			$sql = "select prazo.nome, iprazo.* from prazo, iprazo where (prazo.idprazo = $prazo) and (iprazo.idprazo = $prazo) order by dias";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			$numlin = mysqli_num_rows($resultado);
			$valorparc = number_format($valorfinal / $numlin, 2);
			$total = 0;*/
	
			?>
			<h3>Parcelas</h3>
			<table>
				<tr>
					<td>Num</td>
					<td>Vencimento</td>
					<td>Valor</td>
				</tr>
				<form action="../parcelas.php" method="post">
				<input type="hidden" name="form" value="<?php echo $form; ?>" />
			<?php
			while($linha = mysqli_fetch_array($resultado)){
				$num++;
				if($numlin == 1){//parcela unica
				?>
						<tr>
						<td>
							<input type="text" readonly name="num" size="4" style="text-align:right" value="<?php echo $num; ?>" />
						</td>
						<td>
							<input type="text" readonly name="datavcto" size="10" style="text-align:center" value="<?php echo $datavcto = date('d-m-Y', strtotime($datacaixa."+ ".$linha['dias']." day" ));?>" />
						</td>
						<td>
							<input type="text" readonly name="valorparc" size="7" style="text-align:right" value="<?php echo number_format($valorfinal, 2) ?>" />
							<?php 
								$total = $total + $valorparc;
							?>
						</td>
					</tr>
				<?php
					$parcelas[0] = array(1, 1, $datavcto, $valorfinal, 'A', $id);
					$_SESSION['parcelas'] = $parcelas;
				}else{//mais de uma parcela
				?>
				<tr>
					<td>
						<input type="text" readonly name="num" size="4" style="text-align:right" value="<?php echo $num; ?>" />
					</td>
					<td>
						<input type="text" readonly name="datavcto" size="10" style="text-align:center" value="<?php echo $datavcto = date('d-m-Y', strtotime($datacaixa."+ ".$linha['dias']." day" ));?>" />
					</td>
					<td>
						<?php
							if(($num == $numlin) ){
								//acerta o valor da ultima parcela para nao haver dizima periodica e nem resto
								$valorparc = number_format($valorparc - (($valorparc * $numlin) - $valorfinal), 2);
								?>
								<input type="text" readonly name="valorparc" size="7" style="text-align:right" value="<?php echo $valorparc; ?>" />
								<?php
							}else{
								?>
								<input type="text" readonly name="valorparc" size="7" style="text-align:right" value="<?php echo $valorparc; ?>" />
								<?php
							}
							$total = $total + $valorparc;
						?>
					</td>
				</tr>
				<?php
					$parcelas[$num - 1] = array($num, $numlin, $datavcto, $valorparc, 'A', $id);
					$_SESSION['parcelas'] = $parcelas;
				}
			}
			?>
			<tr>
				<td></td>
				<td></td>
				<td align="right">
					<input type="submit" value="Gravar" /><Br />
				</td>
			</tr>
				</form>
			</table>
			<table width="250px">
			<tr>
				<td width="90px">
					Total Venda
				</td>
				<td width="20px" align="right"> R$ </td>
				<td align="right">
					<?php
						echo strtr(number_format($valor, 2), ".", ",");
					?>
				</td>
			</tr>
			<tr>
				<td>
					Desconto
				</td>
				<td align="right"> R$ </td>
				<td align="right">
					<?php
						echo "- ".strtr(number_format($desconto, 2), ".", ",");
					?>
				</td>
			</tr>
			<tr>
				<td>
					Total Geral
				</td>
				<td align="right"> R$ </td>
				<td align="right">
					<?php
						echo strtr(number_format($valorfinal, 2), ".", ",");
					?>
				</td>
			</tr>
			
			</form>
			</table>
        <?php
        }
	?>
    <?php
		if($_POST){
			$parcelas = $_SESSION['parcelas'];			
			$num = count($parcelas);
			
			for($i = 0; $i <$num; $i++){
				$numparc = $parcelas[$i][0];
				$totalparc = $parcelas[$i][1];
				$datavcto = implode("-", array_reverse(explode("-", $parcelas[$i][2])));
				$valorparc = $parcelas[$i][3];
				$status = $parcelas[$i][4];
				$idvenda = $parcelas[$i][5];
				
				$sql = "insert into parcelarec(idparc, numparc, totparc, datavenc, valorparc, status, idvenda) values(null,$numparc, $totalparc, '$datavcto', $valorparc, '$status', $idvenda)";
				$resultado = mysqli_query($GLOBALS['connection'], $sql);
				
			}
			
			$valorfinal = $_SESSION['valorfinal'];
			$idvenda = $_SESSION['idvenda'];
			$prazo = $_SESSION['prazo'];

			unset($_SESSION['parcelas'], $_SESSION['valorfinal'], $_SESSION['idvenda'], $_SESSION['prazo']);
			
			$sql = "update venda set totalvenda = $valorfinal, prazo = $prazo where idvenda = $idvenda";
			mysqli_query($GLOBALS['connection'], $sql);
			?>
            <script type="text/javascript">envia();</script>
            <?php
		}
	?>