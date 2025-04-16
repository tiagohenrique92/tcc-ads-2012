<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>
	<?php
		mysql_connect("localhost", "root");
		mysql_select_db("novo");
		/*	$i = 4777;
			$sql = "select codigo from municipios_ibge where codigo > $i";
			$resultado = mysqli_query($GLOBALS['connection'], $sql);
			$numlinhas = mysqli_num_rows($resultado);
			while($linha = mysqli_fetch_array($resultado)){
				$codigo = $linha['codigo'];
				$sql = "update municipios_ibge set codigo = ($i + 1) where codigo = $codigo";
				$result = mysqli_query($GLOBALS['connection'], $sql) or die(mysqli_error($GLOBALS['connection']). $i );
				
			
				$i++;
				echo $i."<br>";
			}
			echo "finalizado";
		*/
		
		$sql = "select * from uf";
	?>
</body>
</html>