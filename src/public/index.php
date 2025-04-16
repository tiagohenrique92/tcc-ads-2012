<?php
	require 'verificaLogin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pear - Início</title>
<link href="menu/menu/menu_style.css" rel="stylesheet" type="text/css" />
<link href="cssPrincipal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="funcoes.js"></script>
</head>

<body>
    <div id="pagina">
    	<div id="menuTopo">
        	<?php
				require $menu;
			?>
  		</div>
    </div>
        <div id="conteúdo">
        	<h2>Olá <?php echo $nomeusuario;?>, Bem vindo ao sistema PEARSOFT</h2>
        	<?php
				$sql = "select datacaixa from caixa where idcaixa = (select max(idcaixa) as idcaixa from caixa) ";
				$resultado = mysqli_query($GLOBALS['connection'], $sql);
				$datacaixa = mysqli_fetch_assoc($resultado);
				$datacaixa = $datacaixa['datacaixa'];				
			?>
            <div id="caixa" style="position:absolute; top: -20px; right:5px">
                <form name="fecharCaixa" action="fecharcaixa.php" method="post">
                    <input type="hidden" name="idcaixa" value="<?php echo $caixa; ?>" />
                    <label style="font-size:31px; color:#060">CAIXA</label><br />
                    <?php
                        if($datacaixa < $data){
                            ?>
                            <label style="font-size:20px; color:#F00"><?php echo implode("/", array_reverse(explode("-", $datacaixa))); ?></label><br />
                            <input type="submit" name="btnEnviar" value="Fechar Caixa" />
                            <script type="text/javascript">
                                alert("Atenção: \nA data do caixa não corresponde com a data do sistema.\nTodos os recebimentos e pagamentos serão gravados com a data do caixa.\nPor favor realize o fechamento do caixa ou verifique a data do sistema.");
                            </script>
                            <?php
                        }else{
                            if($datacaixa > $data){
                                ?>
                                    <label style="font-size:20px; color:#F00"><?php echo implode("/", array_reverse(explode("-", $datacaixa))); ?></label><br />
                            <input type="submit" name="btnEnviar" value="Fechar Caixa" />
                                    <script type="text/javascript">
                                        alert("Atenção: \nA data do caixa não corresponde com a data do sistema.\nTodos os recebimentos e pagamentos serão gravados com a data do caixa.\nPor favor realize o fechamento do caixa ou verifique a data do sistema.");
                                    </script>
                                <?php
                            }else{
                            ?>
                            <label style="font-size:20px; color:#060"><?php echo  implode("/", array_reverse(explode("-",$datacaixa))); ?></label><br />
                            <input type="submit" name="btnEnviar" value="Fechar Caixa" />
                            <?php
                            }
                        }
                    ?>
                </form>
           	</div>
        </div>
    </div>
</body>
</html>
