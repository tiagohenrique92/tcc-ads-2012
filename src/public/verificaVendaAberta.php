<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Vendas em Aberto</title>
</head>

<body>
	<?php
	//seleciona a venda que ainda está em abeto
	$sql = "select venda.idvenda, venda.idcli, datavenda, cliente.nome from venda, cliente where ((cliente.idcli = venda.idcli) and (totalvenda is NULL)) order by nome";
		$resultado = mysql_query($sql);
		$numLinha = mysql_num_rows($resultado);
		if ($numLinha > 0){
			$numLinha = 0;
			echo "<h1>Atenção:</h1><p style='color:#FF0000; font-size:18px'>O sistema detectou a presença de uma venda que não foi gravada.<br> Antes de abrir novas vendas você deverá Gravar ou Cancelar esta venda.</p>";
			?>
			<table>
            	<tr>
                	<td width="300">
                    	Cliente
                    </td>
                    <td width="10">
                    	Venda
                    </td>
                    <td width="100">
                    	Data
                    </td>
                </tr>
            <?php
			//lista a venda em aberto
			while($linha = mysql_fetch_array($resultado)){
			?>
            	<tr>
                	<form action="cadvenda.php" method="post">
                        <input type="hidden" name="idvenda" value="<?php echo $linha['idvenda'];?>" />
                        <input type="hidden" name="idcli" value="<?php echo $linha['idcli']; ?>" />
                        <input type="hidden" name="tipo" value="Concluir" />
                    	<td width="300px" style=" background-color:#0080FF; color:#FFFFFF; ">
                        	<?php echo $linha['nome']; ?>
                        </td>
                        <td width="10" style=" background-color:#0080FF; color:#FFFFFF;; text-align:right ">
                        	<?php echo $linha['idvenda']; ?>
                        </td>
                        <td width="100" style=" background-color:#0080FF; color:#FFFFFF;; text-align:center ">
                        	<?php echo  implode("/", array_reverse(explode("-", $linha['datavenda']))); ?>
                        </td>
                   		<td width="100px" style=" background-color:#0080FF; color:#FFFFFF;; text-align:center ">
                           	<input type="submit" name="btnEnviar" value="Selecionar" style="border:none; background-color:#0080FF; color:#FFFFFF;; font-family:Verdana, Arial, Helvetica, sans-serif "/>
                        </td>
                   	</form>
                </tr>
            <?php
			}
			?>
            </table>
           	<?php
			exit();
		}
	?>
</body>
</html>
