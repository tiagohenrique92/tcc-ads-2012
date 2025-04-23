<?php
	require '../../conection.php';
	$nome = $_GET['nome'];
	$numLinha = 0;

	$sql = "select fornecedor.*, uf.nome as estado, cidade.iduf, cidade.nome as cidade from fornecedor, uf, cidade where (fornecedor.fantasia like '%$nome%') and (cidade.iduf = uf.iduf) and (fornecedor.idcid = cidade.idcid) order by fornecedor.status, fornecedor.fantasia ";
	$resultado = mysqli_query($GLOBALS['connection'], $sql);
	$numReg = mysqli_num_rows($resultado);
	if($numReg > 0){
		?>
		 <table>
           	<tr>
                <td>Fornecedor</td>
            	<td>Cidade</td>
                <td>Estado</td>
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
            $form = "frmSelForAlterar" . $numLinha;
			?>
            	<tr>
                	<form id="<?php echo $form; ?>" action="/cadastros/fornecedor/alterarfornecedorjur.php" method="post" >
                    	<td width="505px" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input form="<?php echo $form; ?>" type="hidden" name="status" value="<?php echo $linha['status']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="idfor" value="<?php echo $linha['idfor']; ?>" />
                            <input form="<?php echo $form; ?>" type="hidden" name="razsoc" value="<?php echo $linha['razsoc']; ?>" />
                            <input form="<?php echo $form; ?>" type="hidden" name="fantasia" value="<?php echo $linha['fantasia']; ?>" />
                            <input form="<?php echo $form; ?>" type="hidden" name="endereco" value="<?php echo $linha['endereco']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="bairro" value="<?php echo $linha['bairro']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="idcid" value="<?php echo $linha['idcid']; ?>" />
                            <?php echo $linha['fantasia']; ?>
                      	</td>
                        <td width="300px" style=" <?php echo $corLinha . $corFonte; ?> ">
                            <input form="<?php echo $form; ?>" type="hidden" name="cidade" value="<?php echo $linha['cidade']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="uf" value="<?php echo $linha['iduf']; ?>" />
                            <?php echo $linha['cidade']; ?>
                       	</td>
                        <td width="300px" style=" <?php echo $corLinha . $corFonte; ?> ">
                            <input form="<?php echo $form; ?>" type="hidden" name="estado" value="<?php echo $linha['estado'] ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="cep" value="<?php echo $linha['cep']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="cnpjcpf" value="<?php echo $linha['cnpjcpf']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="ierg" value="<?php echo $linha['ierg']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="fone" value="<?php echo $linha['fone']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="celular" value="<?php echo $linha['celular']; ?>" />
                            <input form="<?php echo $form; ?>" type="hidden" name="email" value="<?php echo $linha['email']; ?>" />
                        	<input form="<?php echo $form; ?>" type="hidden" name="contato" value="<?php echo $linha['contato']; ?>" />
                            <input form="<?php echo $form; ?>" type="hidden" name="tipo" value="<?php echo $linha['tipo']; ?>" />
                            <?php echo $linha['estado'] ?>
                        </td>
                   		<td width="60px" style=" <?php echo $corLinha . $corFonte; ?>; text-align:center ">
                           	<input form="<?php echo $form; ?>" type="submit" value="Alterar" />
                        </td>
                   	</form>
                </tr>
            <?php
		}
	}else{
		echo "A pesquisa não encontrou resultados.";
		
	}
?>