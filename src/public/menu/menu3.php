<?php
	require("cfg.php");
	$servidor = $_SESSION['servidor'];
?>
<!--Menu Financeiro-->
<!--<style media="all" type="text/css">@import "menu/menu_style.css";</style>-->
<div class="menu">
	<ul>
		<li><a href="<?php echo $servidor;?>index.php" target="_parent" >Início</a></li>
		<li><a href="" target="_parent" >Financeiro</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCR/buscacliconta.php" target="_parent">Recebimento - Baixar</a></li>
                <li><hr /></li>
				<li><a href="<?php echo $servidor;?>movCP/buscaforconta.php" target="_parent">Pagamento - Baixar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Relatório</a>
			<ul>
				<li><a href="<?php echo $servidor;?>relatorios/ctiporelcontas.php" target="_parent">Financeiro</a></li>
			</ul>
		</li>
        <li><a href="" target="_parent" >Configurações</a>
			<ul>
				<li><a href="<?php echo $servidor;?>trocasenha.php" target="_parent">Senha</a></li>
			</ul>
		</li>
		<li><a href="<?php echo $servidor;?>logout.php" target="_parent" >Sair</a>
		</li>
	</ul>
</div>
