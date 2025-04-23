$(function(){
	$('#btnEnviar').bind("click", function(){
		var form = $(this).parent('form').attr('id');
		var action = $(this).parent('form').attr('action');
		inserir(form, action);
	});
	
	$('#buscar').live("click", function(){
		var nome = $("#frmbuscacliente #nome").val();
		alterarCliente(nome);
	});
	$("#uf").change(function(){
		carregaComboCidade($(this).val());
	});
});

function inserir(form, action){
	var dados = $("#"+form).serialize();
	$("#"+form+" input[class='campoErro'],"+"#"+form+" textarea[class='campoErro'],"+"#"+form+" select[class='campoErro']").removeClass("campoErro");
	$.get(
		action,
		{dados:dados},
		function(resposta){
			if(resposta['erro'] == '1'){
				if(resposta['campo'] == ''){
					alert(resposta['msg']);
				}else{
					alert(resposta['msg']);
					$("#"+form+" #"+resposta['campo']).focus().addClass('campoErro');
				}
			}else{
				alert(resposta['msg']);
			}
		},
		'json'
	);
}

function alterarCliente(nome){
	$.get(
		'selectCliente.php',
		{nome:nome},
		function(resposta){
			$('#encontrados').html(resposta);
		},
		'html'
	);
}

//escolhe qual pagina vai ser aberta para alterar cliene
function destinoAlterarCliente(tipo, form){
	if(tipo == 'F'){
		$('form[name='+form+']').action = 'alterarclientefis.php';
		$('form[name='+form+']').submit();
	}
	if(tipo == 'J'){
		$('form[name=form]').action = 'alterarclientejur.php';
		$('form[name=form]').submit();
	}
}

function carregaComboCidade(uf){
	$.get(
		'buscacidade.php',
		{uf:uf},
		function(dados){
			$("#cidade").empty();
			$("<option value='0'>SELECIONE</option>").appendTo($("#cidade"));
			$.each(dados, function(key, value){
				$("#cidade").append("<option value="+value.idcid+">"+value.nome+"</option>");
			});
		},
		'json'
	);
}