<?php
	require("cfg.php");
	$servidor = $_SESSION['servidor'];
?>
<!--Menu Comprador-->
<!--<style media="all" type="text/css">@import "menu/menu_style.css";</style>-->
<div class="menu">
	<ul>
		<li><a href="<?php echo $servidor;?>index.php" target="_parent" >Início</a></li>
		<li><a href="" target="_parent" >Cadastros</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadastros/fornecedor/cadfornecedorjur.php" target="_parent">Fornecedor - Pessoa Jurídica</a></li>
				<li><a href="<?php echo $servidor;?>cadastros/fornecedor/buscafornecedor.php" target="_parent">Fornecedor - Pesquisar</a></li>
                <li><hr /></li>
				<li><a href="<?php echo $servidor;?>cadastros/produto/cadproduto.php" target="_parent">Produto - Novo</a></li>
                <li><hr /></li>
                <li><a href="<?php echo $servidor;?>cadastros/prazo/cadprazo.php" target="_parent">Prazo - Novo</a></li>
                <li><hr /></li>
                <li><a href="<?php echo $servidor;?>cadastros/cidade/pesquisarcid.php" target="_parent" >Cidades</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Movimentação</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCompra/buscaforcompra.php" target="_parent">Compra - Nova</a></li>
				<li><a href="<?php echo $servidor;?>movCompra/cancelarcompra.php" target="_parent">Compra - Cancelar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Financeiro</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCP/buscaforconta.php" target="_parent">Pagamento - Baixar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Relatório</a>
			<ul>
				<li><a href="<?php echo $servidor;?>relatorios/ctiporelcompras.php" target="_parent">Compras</a></li>
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
