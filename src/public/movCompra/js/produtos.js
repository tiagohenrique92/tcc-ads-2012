$(function(){
	inicializa();
	
	$('#valbusca').bind('keyup', function(){
		carregaProduto(this.value)
	});
	
	$('#desconto').bind('keyup', function(){
		calculaTotal();
		zerarParcelas();
	});
	
	$('#tipodesc').bind('change', function(){
		$('#desconto').val('').keyup();
		zerarParcelas();
	});
	
	$('#prazo').bind('change', function(){
		zerarParcelas();
	});
	
	$('#gerarParcelas').bind('click', function(){
		gerarParcelas();
	});
	
	$('.btnInserir').bind('click', function(){
		var idpro = parseInt($('#frmInserirProduto #idpro').val());
		var qtde = parseInt($('#frmInserirProduto #qtde').val());
		var preco = $('#frmInserirProduto #preco').val();
		var idcompra = $('#frmInserirProduto #idcompra').val();
		var dados = new Array();
		dados = {'idpro':idpro, 'qtde':qtde, 'preco':preco, 'idcompra':idcompra};
		$('#frmInserirProduto #qtde').attr('value', '');
		insert(dados);
		zerarParcelas();
	});
	
	$('.btnAlterar').bind('click', function(){
		var idpro = parseInt($('#frmInserirProduto #idpro').val());
		var qtde = parseInt($('#frmInserirProduto #qtde').val());
		var preco = $('#frmInserirProduto #preco').val();
		var idcompra = $('#frmInserirProduto #idcompra').val();
		var dados = new Array();
		dados = {'idpro':idpro, 'qtde':qtde, 'preco':preco, 'idcompra':idcompra};
		$('#frmInserirProduto .btnInserir').show();
		$('#frmInserirProduto .btnAlterar').hide();
		update(dados);
		zerarParcelas();
	});
	
	$('#cancelar').bind("click", function(){
		var msg = "Deseja cancelar esta compra?";
		if(confirm(msg)){
			var idcompra = $('#frmInserirProduto #idcompra').val();
			$.post(
				"excluirCompra.php",
				{"idcompra":idcompra},
				function(retorno){
					var erro = retorno['erro'];
					var msg = retorno['msg'];
					
					if(erro == 0){
						alert(msg);
						window.location.replace("../");
					}else{
						alert("Erro ao tentar cancelar a compra.\n\n"+erro+" - "+msg);
					}
				},
				"json"
			);
		}
	});
	
	$('#gravar').bind("click", function(){
		var msgConfirm = "Finalizar compra?";
		
		if(confirm(msgConfirm)){
			var valorfinal = $('#total').val();
			var prazo = $("#prazo").val();

			$.post(
				"gravaCompra.php",
				{'valorfinal':valorfinal, 'prazo':prazo},
				function(retorno){
					var erro = retorno['erro'];
					if(erro == 0){
						if(confirm(retorno['msg'])){
							window.location.replace('../movCP/buscaforconta.php');
						}else{
							window.location.replace('../');
						}
					}else{
						alert('Ops! Houve um erro ao tentar gravar a compra. Contate o administrador do sistema.');
					}
				},
				"json"
			)
		}
	});
	
	$("#btnNovo").bind("click", function(){
		window.open("cadproduto.php", "teste", "width=475px, height=250px");
	});
});

/*******************************************FUNÇÕES**********************************************************/
/****Inicialização da Compra****/
function inicializa(){
	//inicializa campos do formulario
	if($('#subtotal').val() == ''){
		$('#subtotal').val(0);
	}
	if($('#total').val() == ''){
		$('#total').val(0);
	}
	
	$('#gravar').hide();
		
	//busca os itens da compra
	var idcompra = $('#frmInserirProduto #idcompra').val();		
	$('#itensCompra').load('itemcompra.php?idcompra='+idcompra, function(){

		//calcula o valor total
		calculaTotal();
	});
};

function gerarParcelas(){
	var dados = {'prazo':$('#prazo').val(), 'total':$('#total').val()};
	
	if(dados['total'] != 0){
		$.post(
			'parcelas.php',
			{'dados':dados},
			function(resposta){
				$('#parcelas').css({'display':'inline-block'});
				$('#itemparcelas').html(resposta);
			},
			'html'
		);
		$('#gravar').show();
	}
}

function zerarParcelas(){
	$('#itemparcelas').empty();
	$('#parcelas').hide();
	$('#gravar').hide();
}

function carregaProduto(valbusca){
	busca =  valbusca;
	if($('#rdnome').attr('checked')){
		var rdnomecodigo = $('#rdnome').val();
	}else{
		if(isNaN(busca)){
			alert("Somente números são permitidos.");
			$('#valbusca').attr('value', '');
			return false;
		}
		var rdnomecodigo = $('#rdbarras').val();
	}
	
	if(busca != ''){
		$.get(
			'buscaprodutocompra.php',
			{valbusca:busca, rdnomecodigo:rdnomecodigo},
			function(dados){
				$("#resultBusca").show();
				$('#encontrados').html(dados);
			},
			'html'
		);
	}else{
		$('#resultBusca').hide();
		$('#encontrados').empty();
	}
};

function insert(dados){
	$.post(
		'insert.php', 
		{dados:dados}, 
		function(){
			$('#itensCompra').load('itemcompra.php?idcompra='+dados['idcompra'], function(){
				calculaTotal();
			});
		},
		'html'
	);
	$('#insert').hide();
};

function update(dados){
	$.post(
		'update.php', 
		{dados:dados}, 
		function(){
			$('#itensCompra').load('itemcompra.php?idcompra='+dados['idcompra'], function(){
				calculaTotal();
			});
		},
		'html'
	);
	$('#insert').hide();
};

function calculaTotal(){
	var dados = {'desconto':$('#desconto').val(), 'tipodesc':$('#tipodesc').val(), 'subtotal':$('#subtotal').val()};
	if(dados['desconto'] == ''){
		dados['desconto'] = 0;
	}
	var tipodesc = dados['tipodesc'];
	var desconto = new Number(dados['desconto']);
	var subtotal = new Number(dados['subtotal']).toFixed(2);

	if(isNaN(desconto)){
		alert("O valor informado não é válido");
		$('#total').attr('value', subtotal);
		$('#desconto').attr('value', '');
		return;
	}
	if(tipodesc == 'd'){
		total = subtotal - desconto;
		var total = new Number(total).toFixed(2);
		if(total >= 0){
			$('#total').val(total);
		}else{
			alert("O total da compra não pode ficar negativo");
			$('#total').attr('value', subtotal);
			$('#desconto').attr('value', '');
		}
	}else{
		total = subtotal - (subtotal * (desconto / 100));
		var total = new Number(total).toFixed(2);
		if(total >= 0){
			$('#total').val(total);
		}else{
			alert("O total da compra não pode ficar negativo");
			$('#total').attr('value', subtotal);
			$('#desconto').attr('value', '');
		}
	}
}