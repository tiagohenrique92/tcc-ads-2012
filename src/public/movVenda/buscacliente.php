<?php
	require "../conection.php";
	if(!isset($_SESSION)){
		session_start();
	}
	
	$nome = '';

	if(isset($_GET)){
		$nome = $_GET['valbusca'];		
		$sql = "select idcli, nome, fone, celular from cliente where nome like '%$nome%' and status = 'A' order by nome";
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
				<td><a style="text-decoration:none; color:#000000" href="novavenda.php?id=<?php echo $idcli; ?>"><?php echo $nome; ?></a></td>
				<td><?php echo $fone; ?></td>
				<td><?php echo $celular; ?></td>
			</tr>
			<?php
		}
	}
	?>
		</table>