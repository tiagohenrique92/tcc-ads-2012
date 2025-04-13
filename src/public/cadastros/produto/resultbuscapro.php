<?php
	require '../../conection.php';
	$nome = $_GET['nome'];
	$numLinha = 0;

	$sql = "select * from produto where nome like '%$nome%' order by status, nome";
	$resultado = mysql_query($sql);
	$numReg = mysql_num_rows($resultado);
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
		while($linha = mysql_fetch_assoc($resultado)){
			$numLinha++;
			if($numLinha % 2 == 0){
				$corLinha = "background: #CCC;";
				$corFonte = "color: #000;";
			}else{
				$corLinha = "background: #EEE;";
				$corFonte = "color: #000;";
			}
			?>
            	<tr>
                	<form name="frmSelProAlterar<?php echo $numLinha; ?>" id="frmSelProAlterar<?php echo $numLinha; ?>" method="post" onsubmit="return false" >
                    	<td width="505px" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input type="hidden" name="status" id="status" value="<?php echo $linha['status']; ?>" />
                        	<input type="hidden" name="idpro" id="idpro" value="<?php echo $linha['idpro']; ?>" />
                            <input type="hidden" name="barras" id="barras" value="<?php echo $linha['barras']; ?>" />
                            <input type="hidden" name="nome" id="nome" value="<?php echo $linha['nome']; ?>" />
                            <?php echo $linha['nome']; ?>
                      	</td>
                        <td width="100px" align="right" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input type="hidden" name="pcompra" id="pcompra" value="<?php echo $linha['precocompra']; ?>" />
                            <?php echo $linha['precocompra']; ?>
                       	</td>
                        <td width="100px" align="right" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input type="hidden" name="pvenda" id="pvenda" value="<?php echo $linha['precovenda']; ?>" />
                            <?php echo $linha['precovenda']; ?>
                       	</td>
                        <td width="100px" align="right" style=" <?php echo $corLinha . $corFonte; ?> ">
                            <input type="hidden" name="qtde" id="qtde" value="<?php echo $linha['qtde'] ?>" />
                            <?php echo $linha['qtde'] ?>
                        </td>
                   		<td width="60px" style=" <?php echo $corLinha . $corFonte; ?>; text-align:center ">
                           	<input type="submit" id="frmSelProAlterar<?php echo $numLinha; ?>" class="btnAlterar" value="Alterar" />
                        </td>
                   	</form>
                </tr>
            <?php
		}
	}else{
		echo "A pesquisa não encontrou resultados.";
		
	}
?>