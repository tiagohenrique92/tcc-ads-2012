<?php
	require "../verificaLogin.php";
	verificaLogin('BUSCACLIVENDA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Busca Cliente</title>
<link href="busca.css" rel="stylesheet" type="text/css" />
<link href="../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-1.7.2.js"></script>
<script type="text/javascript" src="../funcoes.js"></script>
</head>

<body onload="document.frmbuscacli.nome.focus()">
	<div id="pagina">
    	<div id="menuTopo">
        	<?php 
				require "../".$menu;
			?>
        </div>
        <div id="conteúdo">
        	<div id="busca">
                <div id="topo">
                    <div class="barraTitulo">Venda►Buscar Cliente</div>
                </div>
                <form name="frmbuscacli" action="buscaclivenda.php" method="post" onsubmit="return checarDadosObg(this.name)">
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
            <div id="vendasAbertas">
                <div class="barraTitulo">Vendas em aberto</div>
                <table>
                    <?php
						$sql = 
						"SELECT idvenda, cliente.nome FROM venda 
						LEFT JOIN cliente ON
						venda.idcli = cliente.idcli
						WHERE venda.status = 'AB' AND totalvenda IS NULL";
                        $resultado = mysqli_query($GLOBALS['connection'], $sql);
                        $numresult = mysqli_num_rows($resultado);
                        
						if($numresult >= 1){
							?>
                            <tr>
                            	<td width="80">Venda</td>
                                <td width="290">Cliente</td>
                                <td width="100">Opções</td>
                            </tr>
                            <?php
                            while($linha = mysqli_fetch_assoc($resultado)){
                                $idvenda = $linha['idvenda'];
                                $nome = $linha['nome'];

                                ?>
                                <tr>
                                    <td><?php echo $idvenda; ?></td>
                                    <td><?php echo $nome; ?></td>
                                    <td>
                                    	<a class="spriteIcons btnEdit" href="redirecionar.php?acao=editarVenda&id=<?php echo $idvenda; ?>" title="Editar Venda"></a>
                                        <a class="spriteIcons btnDel" id="<?php echo $idvenda; ?>" title="Excluir Venda"></a>
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
    <script type="text/javascript" src="js/buscaclivenda.js"></script>
</body>
</html>