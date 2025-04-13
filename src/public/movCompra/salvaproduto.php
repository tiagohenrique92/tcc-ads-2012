<?php
	require "../verificaLogin.php";
	require "../funcoes.php";
	verificaLogin('SALVAPRODUTO');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Salvar Produto</title>
</head>

<body>
	<?php
		$idpro = $_POST['idpro'];
		$nome = strtoupper($_POST['nome']);
		$pcompra = $_POST['pcompra'];
		$pvenda = $_POST['pvenda'];
		$barras = $_POST['barras'];
		$status = $_POST['status'];
		
		if(empty($idpro)){
			$sql = "insert into produto(idpro, nome, precocompra, precovenda, barras, status) values('NULL', '$nome', '$pcompra', '$pvenda',  $barras, '$status')";
		}else{
			$sql = "update produto set nome = '$nome', precocompra = '$pcompra', precovenda = '$pvenda', barras = $barras, status = '$status' where idpro = $idpro";
		}
		if(!mysql_query($sql)){
			echo "Erro para gravar o produto";
			?>
            <a href="index.php">Voltar</a>
            <?php
		}else{
			?>
            	<script type="text/javascript">
					alert("Salvo com sucesso");
					self.close();
				</script>
            <?php
			//header("location: index.php");
		}
	?>
</body>
</html>