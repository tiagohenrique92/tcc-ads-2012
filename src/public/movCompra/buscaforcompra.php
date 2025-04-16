<?php
	require "../verificaLogin.php";
	verificaLogin('BUSCAFORCOMPRA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Busca Fornecdor</title>
<link href="busca.css" rel="stylesheet" type="text/css" />
<link href="../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
<script type="text/javascript" src="../funcoes.js"></script>
</head>

<body onload="document.frmbuscafor.nome.focus()">
	<div id="pagina">
    	<div id="menuTopo">
        	<?php 
				require "../".$menu;
			?>
        </div>
        <div id="conteúdo">
        	<div id="busca">
                <div id="topo">
                    <div class="barraTitulo">Compra►Buscar Fornecedor</div>
                </div>
                <form name="frmbuscafor" action="buscaforcompra.php" method="post" onsubmit="return checarDadosObg(this.name)">
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
            <div id="comprasAbertas">
                <div class="barraTitulo">Compras em aberto</div>
                <table>
                    <?php
						$sql = 
						"SELECT IDCOMPRA, FORNECEDOR.RAZSOC AS NOME FROM COMPRA 
						LEFT JOIN FORNECEDOR ON
						COMPRA.IDFOR = FORNECEDOR.IDFOR
						WHERE COMPRA.STATUS = 'AB' AND TOTALCOMPRA = 0";
                        $resultado = mysqli_query($GLOBALS['connection'], $sql);
                        $numresult = mysqli_num_rows($resultado);
                        
						if($numresult >= 1){
							?>
                            <tr>
                            	<td width="80">Compra</td>
                                <td width="290">Fornecedor</td>
                                <td width="100">Opções</td>
                            </tr>
                            <?php
                            while($linha = mysqli_fetch_assoc($resultado)){
                                $idcompra = $linha['IDCOMPRA'];
                                $nome = $linha['NOME'];

                                ?>
                                <tr>
                                    <td><?php echo $idcompra; ?></td>
                                    <td><?php echo $nome; ?></td>
                                    <td>
                                    	<a class="spriteIcons btnEdit" href="redirecionar.php?acao=editarCompra&id=<?php echo $idcompra; ?>" title="Editar Compra"></a>
                                        <a class="spriteIcons btnDel" id="<?php echo $idcompra; ?>" title="Excluir Compra"></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
          	</div>
        </div>
    </div>
    <script type="text/javascript" src="js/buscaforcompra.js"></script>
</body>
</html>