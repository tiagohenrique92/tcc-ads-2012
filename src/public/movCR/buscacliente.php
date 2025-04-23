<?php
	require "../conection.php";
	if(!isset($_SESSION)){
		session_start();
	}
	
	$nome = '';

	if(isset($_GET)){
		$nome = $_GET['valbusca'];		
		$sql = "select idcli, nome, fone, celular from cliente where (nome like '%$nome%') and (idcli in (select idcli from venda where status in ('AB', 'PA'))) order by nome";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$numlinhas = mysqli_num_rows($resultado);
		if($numlinhas == 0){
			echo "<br />A pesquisa não encontrou resultados.";
			exit();
		}
		?>
        <div class="barraTitulo">Clientes Encontrados</div>
		<table>
			<tr>
				<td width="250">Cliente</td>
				<td width="85">Fone</td>
				<td width="85">Celular</td>
			</tr>
			<?php
			while($linha = mysqli_fetch_array($resultado)){
				$idcli = $linha['idcli'];
				$nome = $linha['nome'];
				$fone = $linha['fone'];
				$celular = $linha['celular'];
				?>
				<tr>
					<td><a style="text-decoration:none; color:#000000" href="buscacontarec.php?id=<?php echo $idcli; ?>&ordem=<?php echo 'idvenda'; ?>"><?php echo $nome; ?></a></td>
					<td><?php echo $fone; ?></td>
					<td><?php echo $celular; ?></td>
				</tr>
				<?php
			}
     	}
        ?>
		</table>