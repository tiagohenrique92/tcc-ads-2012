<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>busca</title>
</head>

<body>
	<script type="text/javascript">
		function cidade(){
			var cidade = document.formbusca.cidade.value;
			alert(cidade);
		}
	</script>
	<?php
		mysql_connect("localhost", "root");
		mysql_select_db("pear");

	?>
    	<form name="formbusca" action="busca.php" method="post">
    		<input type="submit" name="btnUF" value="PR" class="botaoUF" />
    		<input type="submit" name="btnUF" value="SP" class="botaoUF" />
       	</form>
    <?php
    	if(isset($_POST['btnUF'])){
			$uf = $_POST['btnUF'];
			$sql = "select * from cidade where iduf = (select iduf from uf where sigla = '$uf')";
			$resultado = mysql_query($sql);
	?>
    	<form name="formbusca" action="busca.php" method="post">
			<select name="cidade" style="width:300px" onblur="cidade()">
            <?php
				while($linha = mysql_fetch_array($resultado)){
					$cidade = $linha['cidade'];
					$idcid = $linha['idcid'];
			?>
			   <option value="<?php echo $idcid; ?>"><?php echo $cidade; ?></option>
			<?php
				}
			?>
            </select>
            <?php
    	}else{
			if(isset($_POST['btnCidade'])){
				$cidade = $_POST['cidade'];
				?>	
            	<form name="formbusca" action="busca.php" method="post">
            		<select name="cidade" style="width:300px">
                    	<option value="<?php echo $cidade; ?>"><?php echo $cidade; ?></option>
                	</select>
            	<?php
			}
		}
	?>
    	<input type="submit" name="btnCidade" value="Selecionar" />
    </form>
</body>
</html>