<?php
	ob_start();
	require '../../verificaLogin.php';
	verificaLogin('CADPRAZO');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Cadastro de Prazo</title>
<link href="../../cssPrincipal.css" rel="stylesheet" type="text/css" />
<link href="../../menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="pagina">
    	<div id="menuTopo">
        	<?php
				require "../../".$menu;
			?>
        </div>
        <div id="conteúdo">
        	<div class="barraTitulo">Cadastro►Prazo</div>
        	<fieldset>
                <form action="cadprazo.php" method="get">
                    <label class="label">Descrição</label>
                    <input type="text" name="descricao" size="115" style="text-transform:uppercase" />
                    <input type="submit" name="btnEnviar" value="Próximo" />
                </form>
            </fieldset>
			<?php
				if(isset($_GET['descricao'])){
					if(trim($_GET['descricao']) == ""){
						echo "Não é possivel cadastrar um prazo sem nome.";
					}else{
						$descricao = strtoupper($_GET['descricao']);
						$sql = "insert into prazo values('NULL', '$descricao', 'A')";
						$resultado = mysql_query($sql);
						$idprazo = mysql_insert_id();
						header("location: caditemprazo.php?idprazo=$idprazo");
					}				
				}
			?>
        </div>
    </div>
</body>
</html>