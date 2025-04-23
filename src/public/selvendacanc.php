<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Selecionar Venda</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="funcoes.js"></script>
<script type="text/javascript">
	function confirmaExclusao(idvenda){
		var idvenda = idvenda;
		if(confirm("Deseja realmente cancelar a venda: "+idvenda)){
			location = "selvendacanc.php?idvenda="+idvenda;
		}else{
			alert("operacao cancelada");
		}
	}
</script>
</head>

<body>
	<?php
		ob_start();
		require 'verificaLogin.php';
	?>
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
        </div>
        <div id="conteúdo">
        	<?php 
				if(isset($_GET['id'])){
					$idcli = $_GET['id'];
					$sql = "select * from venda where idcli = $idcli and status <> 'C'";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
					$numresult = mysqli_num_rows($resultado);
					if($numresult < 1){
						echo "Não foram encontradas vendas para este cliente.";
					}else{
						?>
						<table>
							<tr>
								<td>
									Venda
								</td>
								<td>
									Data
								</td>
								<td>
									Total
								</td>
								<td>
									Cancelar
								</td>
							</tr>
						<?php
							while($linha = mysqli_fetch_assoc($resultado)){
								?>
								<tr>
									<td>
										<?php echo $linha['idvenda'];?>
									</td>
									<td>
										<?php echo implode("/", array_reverse(explode("-", $linha['datavenda'])));?>
									</td>
									<td>
										<?php echo $linha['totalvenda'];?>
									</td>
									<td>
										<a href="#" onclick="confirmaExclusao('<?php echo $linha['idvenda'];?>')">Cancelar</a>
									</td>
								</tr>
								<?php
							}
						?>
						</table>
						<?php
					}
				}
				if(isset($_GET['idvenda'])){
					$idvenda = $_GET['idvenda'];
					$sql = "update venda set status = 'C' where idvenda = $idvenda";
					$resultado = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']));;
					header("location: index.php");
				}
			?>
        </div>
    </div>
</body>
</html>