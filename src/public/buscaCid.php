<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
	a{
		color:#009900; text-decoration:none;
	}
	
	#linkCidade{
		color:#FFFFFF; background-color:#006600;
	}
	
	#linkCidade:hover{
		color:#FFFFFF; background-color:#009900; font-style:italic;
	}
</style>
<script type="text/javascript">
	function adiciona(nome, idcid, form){
		form = form;
		nome = nome;
		idcid = idcid;
		
		window.opener.document.forms[form].cidade.value = nome;
		window.opener.document.forms[form].idcid.value = idcid;
		window.opener.document.forms[form].cep.focus();
		self.close();
	}
	function fechar(form){
		form = form;
		window.opener.document.forms[form].uf.focus();
		self.close();
	}
</script>
<title>Busca de Cidades</title>
</head>

<body>
	<?php
		require 'verificaLogin.php';
		$iduf = $_GET['uf'];
		$form = $_GET['form'];
		$sql = "select cidade.*, uf.sigla from cidade, uf where cidade.iduf = $iduf and uf.iduf = $iduf order by cidade.nome";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		$numlinhas = mysqli_num_rows($resultado);

       	if($numlinhas > 0){
			?>
            Cidades - <a href= "#" onclick = "fechar('<?php echo $form;?>')">Trocar Estado</a>
          	<table border="1px">
            <?php
                while($linha = mysqli_fetch_array($resultado)){
                    $idcid = $linha['idcid'];
                    $nome = $linha['nome'];
                    $uf = $linha['sigla'];
					?>
                    	<tr>
                        	<td><a href= "#" onclick = "adiciona('<?php echo $nome; ?>', '<?php echo $idcid; ?>', '<?php echo $form; ?>')"><?php echo $nome; ?></a> </td>
                        </tr>
                    <?php
				}
                ?>
           	</table>
			<?php
		}else{
			echo "Não foram encotradas cidades para o estado solicitado";
			?><a href="#" onclick="fechar();"> | Cancelar |</a><?php
		}
	?>
</body>
</html>