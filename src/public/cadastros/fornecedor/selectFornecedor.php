<?php
	require '../../conection.php';
	$nome = $_GET['nome'];
	$numLinha = 0;

	$sql = "select fornecedor.*, uf.nome as estado, cidade.nome as cidade from fornecedor, uf, cidade where (fornecedor.fantasia like '%$nome%') and (fornecedor.iduf = uf.iduf) and (fornecedor.idcid = cidade.idcid) order by fornecedor.status, fornecedor.fantasia ";
	$resultado = mysql_query($sql);
	$numReg = mysql_num_rows($resultado);
	if($numReg > 0){
		?>
		 <table>
           	<tr>
                <td>Fornecedor</td>
            	<td>Cidade</td>
                <td>Estado</td>
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
                	<form name="frmSelForAlterar<?php echo $numLinha; ?>" method="post" onsubmit="return false" >
                    	<td width="505px" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input type="hidden" name="status" value="<?php echo $linha['status']; ?>" />
                        	<input type="hidden" name="idfor" value="<?php echo $linha['idfor']; ?>" />
                            <input type="hidden" name="razsoc" value="<?php echo $linha['razsoc']; ?>" />
                            <input type="hidden" name="fantasia" value="<?php echo $linha['fantasia']; ?>" />
                            <input type="hidden" name="endereco" value="<?php echo $linha['endereco']; ?>" />
                        	<input type="hidden" name="bairro" value="<?php echo $linha['bairro']; ?>" />
                        	<input type="hidden" name="idcid" value="<?php echo $linha['idcid']; ?>" />
                            <?php echo $linha['fantasia']; ?>
                      	</td>
                        <td width="300px" style=" <?php echo $corLinha . $corFonte; ?> ">
                            <input type="hidden" name="cidade" value="<?php echo $linha['cidade']; ?>" />
                        	<input type="hidden" name="uf" value="<?php echo $linha['iduf']; ?>" />
                            <?php echo $linha['cidade']; ?>
                       	</td>
                        <td width="300px" style=" <?php echo $corLinha . $corFonte; ?> ">
                            <input type="hidden" name="estado" value="<?php echo $linha['estado'] ?>" />
                        	<input type="hidden" name="cep" value="<?php echo $linha['cep']; ?>" />
                        	<input type="hidden" name="cnpjcpf" value="<?php echo $linha['cnpjcpf']; ?>" />
                        	<input type="hidden" name="ierg" value="<?php echo $linha['ierg']; ?>" />
                        	<input type="hidden" name="fone" value="<?php echo $linha['fone']; ?>" />
                        	<input type="hidden" name="celular" value="<?php echo $linha['celular']; ?>" />
                            <input type="hidden" name="email" value="<?php echo $linha['email']; ?>" />
                        	<input type="hidden" name="contato" value="<?php echo $linha['contato']; ?>" />
                            <input type="hidden" name="tipo" value="<?php echo $linha['tipo']; ?>" />
                            <?php echo $linha['estado'] ?>
                        </td>
                   		<td width="60px" style=" <?php echo $corLinha . $corFonte; ?>; text-align:center ">
                           	<input type="submit" value="Alterar" onclick="destinoAlterarFornecedor(tipo.value, form.name)"/>
                        </td>
                   	</form>
                </tr>
            <?php
		}
	}else{
		echo "A pesquisa não encontrou resultados.";
		
	}
?>