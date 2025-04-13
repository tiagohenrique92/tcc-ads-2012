<?php
	ob_start();
	require "verificaLogin.php";
	verificaLogin('INCLUIRPRODVENDA');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Incluir Produto</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="funcoes.js"></script>
</head>

<body onload="document.frmincluirpro.qtde.focus()">
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
        </div>
        <div id="conteúdo">
        	<a style="text-decoration:none; color:#000000;" href="novavenda.php" title="Buscar Produto">Nova Busca</a>
            <?php
				if($_GET){
					$idpro = $_GET['idpro'];
					$qtde = $_GET['qtde'];
					$tipo = $_GET['tipo'];
					
					$sql = "select * from produto where idpro = $idpro";
					$resultado = mysql_query($sql);
					$linha = mysql_fetch_assoc($resultado);
					
					$nome = $linha['nome'];
					$preco = $linha['precovenda'];
					$estoque = $linha['qtde'];
					$barras = $linha['barras'];
					?>
                    	<form name="frmincluirpro" method="post" action="incluirprodvenda.php" onsubmit="return checharQtde(<?php echo $estoque; ?>, qtde.value, qtdeanterior.value)">
                        	<label>Produto</label>
                        	<input type="text" name="idpro" style="text-align:right" size="10" readonly="readonly" value="<?php echo $idpro; ?>" />
                            <label>Nome</label>
                            <input type="text" name="nome" size="75" readonly="readonly" value="<?php echo $nome; ?>" /><br />
                            <label>Estoque</label>
                            <input type="text" name="estoque" style="text-align:right" size="10" readonly="readonly" value="<?php echo $estoque; ?>" />
                            <label>Preço</label>
                            <input type="text" name="preco" style="text-align:right" size="10" readonly="readonly" value="<?php echo $preco; ?>" />
                            <label>Barras</label>
                            <input type="text" name="barras" style="text-align:right" size="16" readonly="readonly" value="<?php echo $barras; ?>" />
                            <?php
								if($tipo == "N"){
							?>
                            	<input type="hidden" name="qtdeanterior" value="<?php echo $qtde; ?>" />
                            	<label>Quantidade</label>
                                <select name="qtde">
                                	<?php
										for($i = 1; $i<= $estoque; $i++){
											?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php
										}
									?>
                                </select>
                            <?php
								}
								if($tipo == "A"){
							?>
                            	<label>Qtde-Atual</label>
                            	<input type="text" name="qtdeanterior" size="6" style="text-align:right" disabled="disabled" value="<?php echo $qtde; ?>" />
                            	<label>Qtde-Nova</label>
                            	<select name="qtde">
                                	<?php
										for($i = 1; $i<= ($estoque + $qtde); $i++){
											?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php
										}
									?>
                                </select>
                            <?php
								}
								if($tipo == "E"){
									$sql = "delete from itemvenda where idpro = $idpro";
									$resultado = mysql_query($sql);
									header("location: novavenda.php");
								}
							?>
                            <input type="submit" name="btnInserir" value="Inserir" />
                        </form>
                    <?php
				}
				if($_POST){
					$idpro = $_POST['idpro'];
					$nome = $_POST['nome'];
					$preco = $_POST['preco'];
					$estoque = $_POST['qtde'];
					$barras = $_POST['barras'];
					$qtde = $_POST['qtde'];
					$total = $qtde * $preco;
					$idvenda = $_SESSION['idvenda'];
					
					$sql = "select * from itemvenda where idpro = $idpro and idvenda = $idvenda";
					$resultado = mysql_query($sql);
					$numlinhas = mysql_num_rows($resultado);
					
					if($numlinhas < 1){
						$sql = "insert into itemvenda(idvenda, idpro, qtde, precovenda, total) values($idvenda, $idpro, $qtde, '$preco', '$total')";		
					}else{
						$sql = "update itemvenda set qtde = $qtde, total = '$total' where idpro = $idpro and idvenda = $idvenda";
					}
					
					$resultado = mysql_query($sql);
					header("location: novavenda.php");
				}
			?>
        </div>
    </div>
</body>
</html>