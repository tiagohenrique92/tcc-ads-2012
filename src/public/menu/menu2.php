<?php
	require("cfg.php");
	$servidor = $_SESSION['servidor'];
?>
<!--Menu Vendedor-->
<!--<style media="all" type="text/css">@import "menu/menu_style.css";</style>-->
<div class="menu">
	<ul>
		<li><a href="<?php echo $servidor;?>index.php" target="_parent" >Início</a></li>
		<li><a href="" target="_parent" >Cadastros</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadastros/cliente/cadclientefis.php" target="_parent">Cliente - Pessoa Física</a></li>
				<li><a href="<?php echo $servidor;?>cadastros/cliente/cadclientejur.php" target="_parent">Cliente - Pessoa Jurídica</a></li>
				<li><a href="<?php echo $servidor;?>cadastros/cliente/buscacliente.php" target="_parent">Cliente - Pesquisar</a></li>
                <li><hr /></li>
                <li><a href="<?php echo $servidor;?>cadastros/prazo/cadprazo.php" target="_parent">Prazo - Novo</a></li>
                <li><hr /></li>
                <li><a href="<?php echo $servidor;?>cadastros/cidade/pesquisarcid.php" target="_parent" >Cidades</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Movimentação</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movVenda/buscaclivenda.php" target="_parent">Venda - Nova</a></li>
				<li><a href="<?php echo $servidor;?>movVenda/cancelarvenda.php" target="_parent">Venda - Cancelar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Financeiro</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCR/buscacliconta.php" target="_parent">Recebimento - Baixar</a></li>
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
