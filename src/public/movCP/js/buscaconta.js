$(function(){
	/**Busca inical das parcelas**/
	buscaParcelas($("#idfor").val(), $('input[name="ordem"]').val());
	
	/**Busca ordenando as parcelas**/
	$('input[name="ordem"]').bind("click", function(){
		buscaParcelas($("#idfor").val(), $(this).val());
	});
	
	/**Baixa parcela**/
	$("#btnEnviar").bind("click", function(){
		baixarParcela();
		return false;
	});
});

function buscaParcelas(idfornecedor, ordem){
	$.get(
		'buscaParcelas.php',
		{"id":idfornecedor, "ordem":ordem},
		function(dados){
			$('#encontrados').html(dados);
		},
		'html'
	);
}

function baixarParcela(){
	var form = '#confbaixarconta';
	var idfor = $(form+" #idfor").val();
	var idcompra = $(form+" #idcompra").val();
	var idparc = $(form+" #idparc").val();
	var totparc = $(form+" #totparc").val();
	var valorparc = $(form+" #valorparc").val();
	$.get(
		'baixarconta.php',		
		{"idfor":idfor, "idcompra":idcompra, "idparc":idparc, "totparc":totparc, "valorparc":valorparc},
		function(dados){
			alert(dados['msg']);
			window.location.reload();
		},
		'json'
	);
}