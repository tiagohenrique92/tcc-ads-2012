<?php
	require 'conecta.php';
	if(!isset($_SESSION['logado'])){
		header('location: login.php');
		exit;
	}else{
		$idusuario = $_SESSION['idusuario'];
		$nivel = $_SESSION['nivel'];
		$menu = "menu/menu$nivel.php";
		$caixa = $_SESSION['caixa'];
		$datacaixa = $_SESSION['datacaixa'];
		$nomeusuario = $_SESSION['nomeusuario'];
	}
	
	function verificaLogin($verificar) {
		$acessos = array(
			//administrador nivel = 1
			1 => array(
				'CADCLIENTEFIS',
				'SALVARCLIENTE',
				'CADCLIENTEJUR',
				'BUSCACLIENTE',
				'ALTERARCLIENTEFIS',
				'ALTERARCLIENTEJUR',
				'CADPRODUTO',
				'RESULTBUSCAPRO',
				'SALVAPRODUTO',
				'BUSCACLIVENDA',
				'NOVAVENDA',
				'INCLUIRPRODVENDA',
				'CONFIGVENDA',
				'CANCELARVENDA',
				'BUSCACLIVENDA',
				'NOVACOMPRA',
				'INCLUIRPRODCOMPRA',
				'CONFIGCOMPRA',
				'CANCELARCOMPRA',
				'BUSCAFORCOMPRA',
				'TROCASENHA',
				'BAIXARCONTA',
				'CADFORNECEDORJUR',
				'SALVARFORNECEDOR',
				'BUSCAFORNECEDOR',
				'ALTERARFORNECEDORJUR',
				'PESQUISARCID',
				'SALVARCIDADE',
				'CADPRAZO',
				'CADITEMPRAZO',
				'BUSCAPRAZO',
				'CADUSUARIO',
				'BAIXARCONTA',
				'BUSCACLICONTA',
				'BUSCACONTAREC',
				'BUSCACONTAPAG'
			),
			//vendedor nivel = 2
			2 => array(
				'CADCLIENTEFIS',
				'SALVARCLIENTE',
				'CADCLIENTEJUR',
				//'BUSCACLIENTE',
				//'ALTERARCLIENTEFIS',
				//'ALTERARCLIENTEJUR',
				//'CADPRODUTO',
				//'RESULTBUSCAPRO',
				//'SALVAPRODUTO',
				'BUSCACLIVENDA',
				'NOVAVENDA',
				'INCLUIRPRODVENDA',
				'CONFIGVENDA',
				//'CANCELARVENDA',
				'TROCASENHA',
				//'BAIXARCONTA',
				//'CADFORNECEDORJUR',
				//'SALVARFORNECEDOR',
				//'BUSCAFORNECEDOR',
				//'ALTERARFORNECEDORJUR',
				'PESQUISARCID',
				'SALVARCIDADE',	
				'CADPRAZO',
				'CADITEMPRAZO',
				//'BUSCAPRAZO',
				//'CADUSUARIO',		
			),
			//financeiro nivel = 3
			3 => array(
				//'CADCLIENTEFIS',
				//'SALVARCLIENTE',
				//'CADCLIENTEJUR',
				//'BUSCACLIENTE',
				//'ALTERARCLIENTEFIS',
				//'ALTERARCLIENTEJUR',
				//'CADPRODUTO',
				//'RESULTBUSCAPRO',
				//'SALVAPRODUTO',
				//'BUSCACLIVENDA',
				//'NOVAVENDA',
				//'INCLUIRPRODVENDA',
				//'CONFIGVENDA',
				//'CANCELARVENDA',
				'TROCASENHA',
				'BUSCACLICONTA',
				'BUSCACONTAREC',
				'BAIXARCONTA',
				//'CADFORNECEDORJUR',
				//'SALVARFORNECEDOR',
				//'BUSCAFORNECEDOR',
				//'ALTERARFORNECEDORJUR',
				//'PESQUISARCID',
				//'SALVARCIDADE',	
				//'CADPRAZO',
				//'CADITEMPRAZO',
				//'BUSCAPRAZO',
				//'CADUSUARIO',		
			),
			//comprador nivel = 4
			4 => array(
				//'CADCLIENTEFIS',
				//'SALVARCLIENTE',
				//'CADCLIENTEJUR',
				//'BUSCACLIENTE',
				//'ALTERARCLIENTEFIS',
				//'ALTERARCLIENTEJUR',
				'CADPRODUTO',
				'RESULTBUSCAPRO',
				'SALVAPRODUTO',
				//'BUSCACLIVENDA',
				//'NOVAVENDA',
				//'INCLUIRPRODVENDA',
				//'CONFIGVENDA',
				//'CANCELARVENDA',
				'TROCASENHA',
				//'BAIXARCONTA',
				'CADFORNECEDORJUR',
				'SALVARFORNECEDOR',
				'BUSCAFORNECEDOR',
				//'ALTERARFORNECEDORJUR',
				'PESQUISARCID',
				'SALVARCIDADE',
				'CADPRAZO',
				'CADITEMPRAZO',
				'BUSCAPRAZO',
				'CADUSUARIO'
			),
			//banca nivel = 5
			5 => array(
				'CADCLIENTEFIS',
				'SALVARCLIENTE',
				'CADCLIENTEJUR',
				'BUSCACLIENTE',
				'ALTERARCLIENTEFIS',
				'ALTERARCLIENTEJUR',
				'CADPRODUTO',
				'RESULTBUSCAPRO',
				'SALVAPRODUTO',
				'BUSCACLIVENDA',
				'NOVAVENDA',
				'INCLUIRPRODVENDA',
				'CONFIGVENDA',
				'CANCELARVENDA',
				'TROCASENHA',
				'BAIXARCONTA',
				'CADFORNECEDORJUR',
				'SALVARFORNECEDOR',
				'BUSCAFORNECEDOR',
				'ALTERARFORNECEDORJUR',
				'PESQUISARCID',
				'SALVARCIDADE',
				'CADPRAZO',
				'CADITEMPRAZO',
				'BUSCAPRAZO',
				'CADUSUARIO',
				'SALVARUSUARIO',
				'BUSCACLICONTA',
				'BUSCACONTAREC'
			)
		);
		
		if( ! in_array($verificar, $acessos[$_SESSION['nivel']]) ) {
			header('location: '.$_SESSION['servidor'].'index.php');
			exit;
		}
	}
