<?php
	require '../../conection.php';
	$nome = $_GET['nome'];
	$numLinha = 0;

	$sql = "select * from produto where nome like '%$nome%' order by status, nome";
	$resultado = mysqli_query($GLOBALS['connection'], $sql);
	$numReg = mysqli_num_rows($resultado);
	if($numReg > 0){
		?>
		 <table>
           	<tr>
                <td>Produto</td>
            	<td>Compra</td>
                <td>Venda</td>
                <td>Estoque</td>
        	</tr>
      	<?php
		while($linha = mysqli_fetch_assoc($resultado)){
			$numLinha++;
			if($numLinha % 2 == 0){
				$corLinha = "background: #CCC;";
				$corFonte = "color: #000;";
			}else{
				$corLinha = "background: #EEE;";
				$corFonte = "color: #000;";
			}
            $form = "frmSelProAlterar" . $numLinha;
			?>
            	<tr>
                	<form name="<?php echo $form; ?>" id="<?php echo $form; ?>" method="post" onsubmit="return false" >
                    	<td width="505px" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input form="<?php echo $form; ?>" type="hidden" name="status" id="status" value="<?php echo $linha['status']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="idpro" id="idpro" value="<?php echo $linha['idpro']; ?>" />
                            <input form="<?php echo $form; ?>" type="hidden" name="barras" id="barras" value="<?php echo $linha['barras']; ?>" />
                            <input form="<?php echo $form; ?>" type="hidden" name="nome" id="nome" value="<?php echo $linha['nome']; ?>" />
                            <?php echo $linha['nome']; ?>
                      	</td>
                        <td width="100px" align="right" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input form="<?php echo $form; ?>" type="hidden" name="pcompra" id="pcompra" value="<?php echo $linha['precocompra']; ?>" />
                            <?php echo $linha['precocompra']; ?>
                       	</td>
                        <td width="100px" align="right" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input form="<?php echo $form; ?>" type="hidden" name="pvenda" id="pvenda" value="<?php echo $linha['precovenda']; ?>" />
                            <?php echo $linha['precovenda']; ?>
                       	</td>
                        <td width="100px" align="right" style=" <?php echo $corLinha . $corFonte; ?> ">
                            <input form="<?php echo $form; ?>" type="hidden" name="qtde" id="qtde" value="<?php echo $linha['qtde'] ?>" />
                            <?php echo $linha['qtde'] ?>
                        </td>
                   		<td width="60px" style=" <?php echo $corLinha . $corFonte; ?>; text-align:center ">
                           	<input form="<?php echo $form; ?>" type="submit" id="<?php echo $form; ?>" class="btnAlterar" value="Alterar" />
                        </td>
                   	</form>
                </tr>
            <?php
		}
	}else{
		echo "A pesquisa não encontrou resultados.";
		
	}
?>