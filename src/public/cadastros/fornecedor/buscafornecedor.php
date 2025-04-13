<?php
		require '../../verificaLogin.php';
		verificaLogin('BUSCAFORNECEDOR');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GEM - Buscar Fornecedor</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../jquery-1.7.2.js"></script>
<script type="text/javascript" src="fornecedor.js"></script>
<script type="text/javascript" src="funcoes.js"></script>
</head>

<body onload="document.forms[0].fantasia.focus()">
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../../".$menu;
			?>
  		</div>
        <div id="conteúdo">
        	<div class="barraTitulo">Busca de Fornecedor</div>
				<form name="frmbuscafornecedor" id="frmbuscafornecedor" method="post" onsubmit="return false">
                    <table>
                        <tr>
                            <td width="100px">Razão Social</td>
                            <td><input type="text" name="fantasia" id="fantasia" size="130" /></td>
                            <td width="50px"><input type="submit" value="Buscar" id="buscar" /></td>
                        </tr>
                    </table>
                </form>
                <div class="barraTitulo">Encontrados</div>
            	<div id="encontrados"></div>
            <?php
				if($_POST){
					$fantasia = $_POST['fantasia'];
					$numLinha = 0;

					$sql = "select fornecedor.*, uf.iduf as estado, cidade.idcid as cidade from fornecedor, uf, cidade where (fornecedor.fantasia like '%$fantasia%') and (fornecedor.iduf = uf.iduf) and (fornecedor.idcid = cidade.idcid) order by fornecedor.status, fornecedor.fantasia ";
					$resultado = mysql_query($sql);
					if(mysql_num_rows($resultado) <> 0){
			?>
            <table>
            	<tr>
                	<td>Resultados</td>
                    <td></td>
                </tr>
           	</table>
            <?php			
					}else{
						echo "A pesquisa não encontrou resultados.";
					}
					while($linha = mysql_fetch_array($resultado)){
						$numLinha++;
						if($numLinha % 2 == 0){
							$corLinha = "background-color:#009900;";
							$corFonte = "color:#FFFFFF;";
						}else{
							$corLinha = "background-color:#00CC00;";
							$corFonte = "color:#FFFFFF;";
						}
						if($linha['status'] == "I"){
							$corFonte = "color:#FF0000; background-color:#FFFF00;";
						}
			?>
            <table>
            	<tr>
                	<form name="frmSelForAlterar<?php echo $numLinha; ?>" method="post" >
                    	<td width="505px" style=" <?php echo $corLinha . $corFonte; ?> ">
                        	<input type="hidden" name="status" value="<?php echo $linha['status']; ?>" />
                        	<input type="hidden" name="idfor" value="<?php echo $linha['idfor']; ?>" />
                            <input type="hidden" name="razsoc" value="<?php echo $linha['razsoc']; ?>" />
                            <input type="hidden" name="fantasia" value="<?php echo $linha['fantasia']; ?>" />
                            <input type="hidden" name="endereco" value="<?php echo $linha['endereco']; ?>" />
                        	<input type="hidden" name="bairro" value="<?php echo $linha['bairro']; ?>" />
                        	<input type="hidden" name="idcid" value="<?php echo $linha['idcid']; ?>" />
                            <input type="hidden" name="cidade" value="<?php echo $linha['cidade']; ?>" />
                        	<input type="hidden" name="uf" value="<?php echo $linha['iduf']; ?>" />
                            <input type="hidden" name="estado" value="<?php echo $linha['estado'] ?>" />
                        	<input type="hidden" name="cep" value="<?php echo $linha['cep']; ?>" />
                        	<input type="hidden" name="cnpjcpf" value="<?php echo $linha['cnpjcpf']; ?>" />
                        	<input type="hidden" name="ierg" value="<?php echo $linha['ierg']; ?>" />
                        	<input type="hidden" name="fone" value="<?php echo $linha['fone']; ?>" />
                        	<input type="hidden" name="celular" value="<?php echo $linha['celular']; ?>" />
                            <input type="hidden" name="email" value="<?php echo $linha['email']; ?>" />
                        	<input type="hidden" name="contato" value="<?php echo $linha['contato']; ?>" />
                            <input type="hidden" name="tipo" value="<?php echo $linha['tipo']; ?>" />
                        	<?php echo $linha['fantasia']; ?>
                        </td>
                   		<td width="100px" style=" <?php echo $corLinha . $corFonte; ?>; text-align:center ">
                           	<input type="submit" value="Alterar" style="border:none; <?php echo $corLinha . $corFonte; ?>; font-family:Verdana, Arial, Helvetica, sans-serif " onclick="destinoAlterarFornecedor(tipo.value, form.name)"/>
                        </td>
                   	</form>
                </tr>
            </table>
            <?php
					}
				}
			?>
        </div>
    </div>
</body>
</html>
