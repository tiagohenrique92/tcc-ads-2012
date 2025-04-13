<?php
	require("cfg.php");
	$servidor = $_SESSION['servidor'];
?>
<!--Menu Administrador-->
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
				<li><a href="<?php echo $servidor;?>cadastros/fornecedor/cadfornecedorjur.php" target="_parent">Fornecedor - Pessoa Jurídica</a></li>
				<li><a href="<?php echo $servidor;?>cadastros/fornecedor/buscafornecedor.php" target="_parent">Fornecedor - Pesquisar</a></li>
                <li><hr /></li>
				<li><a href="<?php echo $servidor;?>cadastros/produto/cadproduto.php" target="_parent">Produto - Novo</a></li>
                <li><hr /></li>
                <li><a href="<?php echo $servidor;?>cadastros/prazo/cadprazo.php" target="_parent">Prazo - Novo</a></li>
                <li><a href="<?php echo $servidor;?>cadastros/prazo/buscaprazo.php" target="_parent">Prazo - Alterar</a></li>
                <li><hr /></li>
                <li><a href="<?php echo $servidor;?>cadastros/cidade/pesquisarcid.php" target="_parent" >Cidades</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Movimentação</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movVenda/buscaclivenda.php" target="_parent">Venda - Nova</a></li>
				<li><a href="<?php echo $servidor;?>movVenda/cancelarvenda.php" target="_parent">Venda - Cancelar</a></li>
                <li><hr /></li>
				<li><a href="<?php echo $servidor;?>movCompra/buscaforcompra.php" target="_parent">Compra - Nova</a></li>
				<li><a href="<?php echo $servidor;?>movCompra/cancelarcompra.php" target="_parent">Compra - Cancelar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Financeiro</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCR/buscacliconta.php" target="_parent">Recebimento - Baixar</a></li>                <li><a href="<?php echo $servidor;?>movCR/buscacliestorno.php" target="_parent">Recebimento - Estornar</a></li>
                <li><hr /></li>
				<li><a href="<?php echo $servidor;?>movCP/buscaforconta.php" target="_parent">Pagamento - Baixar</a></li>
                <li><a href="<?php echo $servidor;?>movCP/buscaforestorno.php" target="_parent">Pagamento - Estornar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Relatório</a>
			<ul>
            	<li><a href="<?php echo $servidor;?>relatorios/ctiporelproduto.php" target="_parent">Produtos</a></li>
				<li><a href="<?php echo $servidor;?>relatorios/ctiporelvendas.php" target="_parent">Vendas</a></li>
				<li><a href="<?php echo $servidor;?>relatorios/ctiporelcompras.php" target="_parent">Compras</a></li>
				<li><a href="<?php echo $servidor;?>relatorios/ctiporelcontas.php" target="_parent">Financeiro</a></li>
			</ul>
		</li>
        <li><a href="" target="_parent" >Configurações</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadusuario.php" target="_parent">Usuário - Novo</a></li>
				<li><a href="<?php echo $servidor;?>buscausuario.php" target="_parent">Usuário - Alterar</a></li>
				<li><a href="<?php echo $servidor;?>trocasenha.php" target="_parent">Senha</a></li>
			</ul>
		</li>
		<li><a href="<?php echo $servidor;?>logout.php" target="_parent" >Sair</a>
		</li>
	</ul>
</div>
