<?php
	require "../conection.php";
	
	$tipo = (int) $_GET['tipo'];
	
	switch($tipo){
		case 0:
			$where = "where (qtde > 0)";
		break;
		case 1:
			$where = "where (qtde = 0)";
		break;
		case 2:
			$where = "where (qtde >= 0)";
		break;
	}
	
	$sql = "select * from produto ".$where." order by nome";
	$select = mysql_query($sql);
	$numrows = mysql_num_rows($select);
	if($numrows > 0){
		?>
        <table width="100%;">
        	<thead>
                <tr>
                    <th align="left">Produto</th>
                    <th align="left">Nome</th>
                    <th align="left">Quantidade</th>
                    <th align="left">Preço-Compra</th>
                    <th align="left">Preço-Venda</th>
                    <th align="left">Barras</th>
                    <th align="left">Status</th>
                </tr>
         	</thead>
        <?php
		while($linha = mysql_fetch_assoc($select)){
			?>
            <tbody>
                <tr>
                    <td align="right"><?php echo $linha['idpro'];?></td>
                    <td align="left"><?php echo $linha['nome'];?></td>
                    <td align="right"><?php echo $linha['qtde'];?></td>
                    <td align="right"><?php echo "R$ ".$linha['precocompra'];?></td>
                    <td align="right"><?php echo "R$ ".$linha['precovenda'];?></td>
                    <td align="right"><?php echo $linha['barras'];?></td>
                    <td align="center"><?php if($linha['status'] == 'A'){ echo 'Ativo'; }else{ echo 'Inativo'; }?></td>
                </tr>
           	</tbody>
            <?php
		}
		?>
        </table>
        <?php
	}
?>