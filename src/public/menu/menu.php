<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu ADM</title>
</head>

<body>
	<style media="all" type="text/css">@import "menu/menu_style.css";</style>
    <div class="menu">
        <ul>
            <li><a href="index.php" target="_parent" >Início</a></li>
            <li><a href="" target="_parent" >Cliente</a>
                <ul>
                	<li><a href="buscacliente.php" target="_parent">Pesquisar Cliente</a></li>
                    <li><a href="cadclientefis.php" target="_parent">Pessoa Física</a></li>
                    <li><a href="cadclientejur.php" target="_parent">Pessoa Jurídica</a></li>
                </ul>
            </li>
            <li><a href="" target="_parent">Produto</a>
            	<ul>
                	<li><a href="cadproduto.php" target="_parent">Novo</a></li>
                </ul>
            </li>
            <li><a href="" target="_parent" >Vendas</a>
                <ul>
                    <li><a href="movVenda/buscaclivenda.php" target="_parent">Novo</a></li>
                    <li><a href="buscaclivenda.php" target="_parent">Alterar</a></li>
                </ul>
            </li>
            <li><a href="" target="_parent" >Contas</a>
                <ul>
                    <li><a href="buscacliconta.php" target="_parent">Lançar</a></li>
                    <li><a href="buscacontabaixar.php" target="_parent">Baixar</a></li>
                </ul>
            </li>
            <li><a href="" target="_parent" >Relatório</a>
                <ul>
                    <li><a href="ctiporelservicos.php" target="_parent">Vendas</a></li>
                    <li><a href="ctiporelcontas.php" target="_parent">Contas</a></li>
                </ul>
            </li>
            <li><a href="" target="_parent" >Empresa</a>
                <ul>
                    <li><a href="cadempresa.php" target="_parent">Empresa</a></li>
                </ul>
           	</li>
            <li><a href="" target="_parent" >Usuários</a>
            	<ul>
                    <li><a href="cadusuario.php" target="_parent">Novo</a></li>
                    <li><a href="buscausuario.php" target="_parent">Alterar</a></li>
                    <li><a href="trocasenha.php" tabindex="_parent">Senha</a></li>
                </ul>
            </li>
	        <li><a href="logout.php" target="_parent" >Sair</a>
            </li>
        </ul>
    </div>
</body>
</html>
