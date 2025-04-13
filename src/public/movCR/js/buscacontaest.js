$(function(){
	/**Busca inical das parcelas**/
	buscaParcelas($("#idcli").val(), $('input[name="ordem"]').val());
	
	/**Busca ordenando as parcelas**/
	$('input[name="ordem"]').bind("click", function(){
		buscaParcelas($("#idcli").val(), $(this).val());
	});
	
	/**Baixa parcela**/
	$("#btnEnviar").bind("click", function(){
		estornarParcela();
		return false;
	});
});

function buscaParcelas(idcliente, ordem){
	$.get(
		'buscaParcelasEst.php',
		{"id":idcliente, "ordem":ordem},
		function(dados){
			$('#encontrados').html(dados);
		},
		'html'
	);
}

function estornarParcela(){
	var form = '#confestornarconta';
	var idcli = $(form+" #idcli").val();
	var idvenda = $(form+" #idvenda").val();
	var idparc = $(form+" #idparc").val();
	var totparc = $(form+" #totparc").val();
	var valorparc = $(form+" #valorparc").val();
	$.get(
		'estornarconta.php',		
		{"idcli":idcli, "idvenda":idvenda, "idparc":idparc, "totparc":totparc, "valorparc":valorparc},
		function(dados){
			alert(dados['msg']);
			window.location.reload();
		},
		'json'
	);
}