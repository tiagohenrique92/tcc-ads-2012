$(function(){
	/**Busca de cliente**/
	$('#nome').bind('keyup', function(){
		carregaCliente(this.value)
	});
	
})

/*************FUNÇÕES*************/

/**Carrega Cliente**/
function carregaCliente(valbusca){
	busca =  valbusca;
	
	if(busca != '' && busca.length >= 2){
		$.get(
			'buscacliente.php',
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