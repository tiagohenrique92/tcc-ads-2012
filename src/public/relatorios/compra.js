$(function(){
	$("#btnGerar").click(function(){
		var dataini = $("#intinicial").val();
		var datafin = $("#intfinal").val();
		if(dataini == ''){
			alert("Inform uma data de inicio."); 
			return;
		}
		if(datafin == ''){
			alert("Informe uma data de termino.");
			return;
		}
		$.get(
			'selectCompra.php',
			{dataini:dataini, datafin:datafin},
			function(resposta){
				$("#encontrados").html(resposta);
			},
			'html'
		);
	});
});