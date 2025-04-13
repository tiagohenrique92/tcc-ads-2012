$(function(){
	$("#btnGerar").click(function(){
		var tipo = $("#tipo").val();
		
		$.get(
			'selectProduto.php',
			{tipo:tipo},
			function(resposta){
				$("#encontrados").html(resposta);
			},
			'html'
		);
	});
});