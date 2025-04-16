<?php
	require "../conection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Busca Cliente</title>
<link href="../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<link href="venda.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/produtos.js"></script>
<script type="text/javascript" src="funcoes.js"></script>
</head>

<body onload="document.frmbuscacli.nome.focus()">
	<div id="pagina">
    	<div id="menuTopo">
        	<?php 
				require "../".$menu;
			?>
        </div>
        <div id="conteúdo">
        	<div class="barraTitulo">
            	<p>Cancelar Venda►Buscar Cliente</p>
            </div>
            <div id="busca">
                <form name="frmbuscacli" action="cancelarvenda.php" method="post" onsubmit="return checarDadosObg(this.name)">
                    <table>
                        <tr>
                            <td width="50px">Nome</td>
                            <td><input type="text" id="nome" name="nome" obg="true" style="text-transform:uppercase"/></td>
                        </tr>
                    </table>
                </form>
        		<div id="resultBusca">
            		<div id="encontrados"></div>
               	</div>
           	</div>
        	<?php
				if(!($_POST)){
					?>
                    <!--fieldset style="width:557px; color:#009900;">
                    <form name="frmbuscacli" action="cancelarvenda.php" method="post" onsubmit="return checarDadosObg(this.name)">
                        	<table>
                                <tr>
                                    <td width="90px">Nome</td>
                                    <td width="200px"><input type="text" name="nome" obg="true" style="text-transform:uppercase" size="60" /></td>
                                    <td width="80px"><input type="submit" name="btnEnviar" class="botao" value="Buscar" style="margin-right: -16px; margin-top:-16px; margin-bottom:-14px;" /></td>
                              	</tr>
                          	</table>
                        </form>
                    </fieldset-->
                    <?php
				}else{
					?>
                    <a style="text-decoration:none; color:#000000;" href="cancelarvenda.php" title="Nova Busca">Nova Busca</a>
                    <?php
					$btnEnviar = $_POST['btnEnviar'];
					switch($btnEnviar){
						case "Buscar":
							$nome = strtoupper($_POST['nome']);
							$sql = "select idcli, nome, fone, celular from cliente where nome like '%$nome%' order by nome";
							$resultado = mysqli_query($GLOBALS['connection'], $sql);
							$numlinhas = mysqli_num_rows($resultado);
							if($numlinhas == 0){
								echo "<br />A pesquisa não encontrou resultados.";
								exit();
							}
							?>
                            <table border="1" width="700px;">
                            	<tr style="background-color:#060; color:#FFF">
                                	<td>Cliente</td>
                                    <td>Fone</td>
                                    <td>Celular</td>
                                </tr>
								<?php
                                while($linha = mysqli_fetch_array($resultado)){
									$idcli = $linha['idcli'];
									$nome = $linha['nome'];
									$fone = $linha['fone'];
									$celular = $linha['celular'];
                                    ?>
                                    <tr>
                                        <td><a style="text-decoration:none; color:#000000" href="selvendacanc.php?id=<?php echo $idcli; ?>"><?php echo $nome; ?></a></td>
                                        <td><?php echo $fone; ?></td>
                                        <td><?php echo $celular; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                            <?php
						break;
					}
				}
			?>
        </div>
    </div>
</body>
</html>