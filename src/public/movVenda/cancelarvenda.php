<?php
	require "../verificaLogin.php";
	verificaLogin('BUSCACLIVENDA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Busca Cliente</title>
<link href="../cssPrincipal.css" rel="stylesheet" type="text/css" />
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
        	<div class="barraTitulo">Cancelar Venda►Buscar Cliente</div>

        	<div id="busca">
                <form name="frmbuscacli" action="buscaclivenda.php" method="post" onsubmit="return checarDadosObg(this.name)">
                    <table>
                        <tr>
                            <td width="50px">Nome</td>
                            <td><input type="text" id="nome" name="nome" obg="true" style="text-transform:uppercase"/></td>
                        </tr>
                    </table>
                </form>
           	</div>
            <div id="resultBusca" style="width:100%">
                <div id="encontrados" style="width:100%">
                	<?php
						if(isset($_GET['id'])){
							$id = $_GET['id'];
							
							$sql = "select venda.*, cliente.nome as nome from venda, cliente where (venda.idcli = cliente.idcli) and (venda.idcli = ".$id.") and (venda.status in ('AB', 'PA', 'PG'))";
							$result = mysql_query($sql);
							$numReg = mysql_num_rows($result);
							
							if($numReg > 0){
								?>
                                <table>
                                    <tr>
                                        <td width="70px">Venda</td>
                                        <td width="380px">Cliente</td>
                                        <td width="100px">Data da Venda</td>
                                        <td width="80px">Valor</td>
                                        <td width="50px"></td>
                                    </tr>
                                <?php
								while($linha = mysql_fetch_assoc($result)){
									echo "
									<tr>
                                        <td align='right'>".$linha['idvenda']."</td>
                                        <td>".$linha['nome']."</td>
                                        <td align='center'>".implode("/", array_reverse(explode("-", $linha['datavenda'])))."</td>
                                        <td align='right'>".$linha['totalvenda']."</td>
                                        <td><a class='spriteIcons btnDel' id='".$linha['idvenda']."' title='Excluir Venda'></a></td>
                                    </tr>
									";
								}
								?>
                                </table>
                                <?php
							}else{
								echo "Nenhuma venda foi encontrada.";
							}
						}
					?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/cancvenda.js"></script>
</body>
</html>