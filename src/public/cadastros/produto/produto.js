$(function(){
	$('#btnGravar').bind("click", function(){
		var form = $(this).parent('form').attr('id');
		var action = $(this).parent('form').attr('action');
		inserir(form, action);
	});
	
	$(".btnAlterar").live("click", function(){
		var form = $(this).attr("id") ;
		var teste = $("#"+form).serializeArray();
		$.each(teste, function(indice, campo){
			if(campo.name == 'status'){
				if(campo.value == 'A'){
					$("#frmcadpro #status[value='A']").attr("checked", true);
				}else{
					$("#frmcadpro #status[value='I']").attr("checked", true);
				}
			}else{
				$("#frmcadpro #"+campo.name).val(campo.value);
			}
		});
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