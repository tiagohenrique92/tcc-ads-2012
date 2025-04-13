$(function(){
	$("#btnGerar").click(function(){
		var dados = $("#frmRelatorio").serializeArray();
		if($("#dataini").val() == ''){
			alert("Inform uma data de inicio."); 
			return;
		}
		if($("#datafin").val() == ''){
			alert("Informe uma data de termino.");
			return;
		}
		$.get(
			'selectContas.php',
			{dados:dados},
			function(resposta){
				$("#encontrados").html(resposta);
			},
			'html'
		);
	});
});