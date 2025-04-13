$(function(){
	$('#btnEnviar').bind("click", function(){
		var form = $(this).parent('form').attr('id');
		var action = $(this).parent('form').attr('action');
		inserir(form, action);
	});
	
	$('#buscar').live("click", function(){
		var nome = $("#frmbuscafornecedor #fantasia").val();
		alterarFornecedor(nome);
	});
	
	$('#uf').change(function(){
		var uf = $(this).val();
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
	});
	
	/*$('#btnEnviar').bind("click", function(){
		var form = $(this).parent('form').attr('id');
		var action = $(this).parent('form').attr('action');
		inserir(form, action);
	});*/
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

function alterarFornecedor(nome){
	$.get(
		'selectFornecedor.php',
		{nome:nome},
		function(resposta){
			$('#encontrados').html(resposta);
		},
		'html'
	);
}

function destinoAlterarFornecedor(tipo, form){
	var tipo = tipo;
	var form = form;
	
	if(tipo == 'F'){
		document.forms[form].action = 'alterarfornecedorfis.php';
		document.forms[form].submit();
	}
	if(tipo == 'J'){
		document.forms[form].action = 'alterarfornecedorjur.php';
		document.forms[form].submit();
	}
}