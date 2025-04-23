<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Salvar Venda</title>
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="funcoes.js"></script>
<script type="text/javascript">function pausa(){ return false; }</script>
</head>

<body onload="document.forms['frmgeraparcelas'].ent.focus()">
	<?php
		require 'verificaLogin.php';
	?>
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
        </div>
        <div id="conteúdo">
        	<?php 
				$idvenda = $_POST['idvenda'];
				$totalvenda = $_POST['totalvenda'];
				
				if($_GET){
					$prazo = $_GET['prazo'];
					
					echo $numparc;
				}else{
					$sql = "select * from prazo order by nome";
					$resultado = mysqli_query($GLOBALS['connection'], $sql);
					
					?>
                    <form name="frmgeraparcelas" action="salvavenda.php" method="post" onsubmit="return pausa()">
                    	<label>Entrada</label>
                        <input type="text" name="ent" value="0" />
                        <label>Prazo</label>
                        <select name="prazo" onblur="abreTelaParc(prazo.value, '<?php echo $idvenda; ?>', '<?php echo $totalvenda; ?>', ent.value, form.name)">
                        	<option value="Selecione" selected="selected">Selecione</option>
                        	<?php
								while($linha = mysqli_fetch_array($resultado)){
									?>
                                    	<option value="<?php echo $linha['idprazo']; ?>"><?php echo $linha['nome'];?></option>
                                    <?php
								}
							?>
                        </select>
                        <input type="submit" name="btnEnviar" value="Salvar" />
                    </form>
                    <?php
				}
			?>
        </div>
    </div>
</body>
</html>