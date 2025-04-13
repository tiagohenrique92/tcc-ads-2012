<?php
	require("cfg.php");
	$servidor = $_SESSION['servidor'];
?>
<!--Menu Administrador-->
<style media="all" type="text/css">@import "menu/menu_style.css";</style>
<div class="menu">
	<ul>
		<li><a href="<?php echo $servidor;?>index.php" target="_parent" >Início</a></li>
		<li><a href="" target="_parent" >Cliente</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadclientefis.php" target="_parent">Pessoa Física</a></li>
				<li><a href="<?php echo $servidor;?>cadclientejur.php" target="_parent">Pessoa Jurídica</a></li>
				<li><a href="<?php echo $servidor;?>buscacliente.php" target="_parent">Pesquisar Cliente</a></li>
			</ul>
		</li>
        <li><a href="" target="_parent" >Fornecedor</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadfornecedorjur.php" target="_parent">Pessoa Jurídica</a></li>
				<li><a href="<?php echo $servidor;?>buscafornecedor.php" target="_parent">Pesquisar Fornecedor</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent">Produto</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadproduto.php" target="_parent">Novo</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Venda</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movVenda/buscaclivenda.php" target="_parent">Nova</a></li>
				<li><a href="<?php echo $servidor;?>movVenda/cancelarvenda.php" target="_parent">Cancelar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Compra</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCompra/buscaforcompra.php" target="_parent">Nova</a></li>
				<li><a href="<?php echo $servidor;?>movCompra/cancelarcompra.php" target="_parent">Alterar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Contas a Receber</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCR/buscacliconta.php" target="_parent">Baixar</a></li>
			</ul>
		</li>
        <li><a href="" target="_parent" >Contas a Pagar</a>
			<ul>
				<li><a href="<?php echo $servidor;?>movCP/buscaforconta.php" target="_parent">Baixar</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Relatório</a>
			<ul>
				<li><a href="<?php echo $servidor;?>ctiporelvendas.php" target="_parent">Vendas</a></li>
				<li><a href="<?php echo $servidor;?>ctiporelcompras.php" target="_parent">Compras</a></li>
				<li><a href="<?php echo $servidor;?>ctiporelcontas.php" target="_parent">Contas</a></li>
			</ul>
		</li>
        <li><a href="" target="_parent" >Prazo</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadprazo.php" target="_parent">Novo</a></li>
                <li><a href="<?php echo $servidor;?>buscaprazo.php" target="_parent">Alterar</a></li>
                
			</ul>
		</li>
		<li><a href="" target="_parent" >Empresa</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadempresa.php" target="_parent">Empresa</a></li>
			</ul>
		</li>
		<li><a href="" target="_parent" >Usuários</a>
			<ul>
				<li><a href="<?php echo $servidor;?>cadusuario.php" target="_parent">Novo</a></li>
				<li><a href="<?php echo $servidor;?>buscausuario.php" target="_parent">Alterar</a></li>
				<li><a href="<?php echo $servidor;?>trocasenha.php" target="_parent">Senha</a></li>
			</ul>
		</li>
        <li><a href="<?php echo $servidor;?>pesquisarcid.php" target="_parent" >Cidades</a>
		</li>
		<li><a href="<?php echo $servidor;?>logout.php" target="_parent" >Sair</a>
		</li>
	</ul>
</div>
