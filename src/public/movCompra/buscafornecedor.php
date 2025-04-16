<?php
	require "../conection.php";
	if(!isset($_SESSION)){
		session_start();
	}
	
	$nome = '';

	if(isset($_GET)){
		$nome = $_GET['valbusca'];		
		$sql = "select idfor, razsoc, fone, celular from fornecedor where razsoc like '%$nome%' and status = 'A' order by razsoc";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$numlinhas = mysqli_num_rows($resultado);
		
		if($numlinhas == 0){
			echo "<br />A pesquisa não encontrou resultados.";
			exit();
		}
		?>
		<div class="barraTitulo">Fornecedores Encontrados</div>
        <table>
			<tr>
				<td width="250">Fornecedor</td>
				<td width="85">Fone</td>
				<td width="85">Celular</td>
			</tr>
            
		<?php
		while($linha = mysqli_fetch_array($resultado)){
			$idfor = $linha['idfor'];
			$nome = $linha['razsoc'];
			$fone = $linha['fone'];
			$celular = $linha['celular'];
			?>
			<tr>
				<td><a style="text-decoration:none; color:#000000" href="novacompra.php?id=<?php echo $idfor; ?>"><?php echo $nome; ?></a></td>
				<td><?php echo $fone; ?></td>
				<td><?php echo $celular; ?></td>
			</tr>
			<?php
		}
	}
	?>
		</table>