$(function(){
	/**Busca de fornecedor**/
	$('#nome').bind('keyup', function(){
		carregaFornecedor(this.value)
	});
	
})

/*************FUNÇÕES*************/

/**Carrega Fornecedor**/
function carregaFornecedor(valbusca){
	busca =  valbusca;
	
	if(busca != '' && busca.length >= 2){
		$.get(
			'buscafornecedor.php',
			{valbusca:busca},
			function(dados){
				$('#encontrados').html(dados);
			},
			'html'
		);
	}else{
		$('#encontrados').empty();
	}
};