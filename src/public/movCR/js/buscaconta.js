$(function(){
	/**Busca inical das parcelas**/
	buscaParcelas($("#idcli").val(), $('input[name="ordem"]').val());
	
	/**Busca ordenando as parcelas**/
	$('input[name="ordem"]').bind("click", function(){
		buscaParcelas($("#idcli").val(), $(this).val());
	});
	
	/**Baixa parcela**/
	$("#btnEnviar").bind("click", function(){
		baixarParcela();
		return false;
	});
});

function buscaParcelas(idcliente, ordem){
	$.get(
		'buscaParcelas.php',
		{"id":idcliente, "ordem":ordem},
		function(dados){
			$('#encontrados').html(dados);
		},
		'html'
	);
}

function baixarParcela(){
	var form = '#confbaixarconta';
	var idcli = $(form+" #idcli").val();
	var idvenda = $(form+" #idvenda").val();
	var idparc = $(form+" #idparc").val();
	var totparc = $(form+" #totparc").val();
	var valorparc = $(form+" #valorparc").val();
	$.get(
		'baixarconta.php',		
		{"idcli":idcli, "idvenda":idvenda, "idparc":idparc, "totparc":totparc, "valorparc":valorparc},
		function(dados){
			alert(dados['msg']);
			window.location.reload();
		},
		'json'
	);
}