$(function(){
	/**Busca de cliente**/
	$('#nome').bind('keyup', function(){
		carregaCliente(this.value)
	});
	
	
	/**Excluir Venda**/
	$('.btnDel').bind("click", function(){
		excluirVenda($(this).attr("id"));
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

/**Excluir Venda**/
function excluirVenda(idvenda){
	var msg = "Deseja cancelar esta venda?";
	if(confirm(msg)){
		$.post(
			"excluirVenda.php",
			{"idvenda":idvenda},
			function(retorno){
				var erro = retorno['erro'];
				var msg = retorno['msg'];
				
				if(erro == 0){
					alert(msg);
					window.location.reload();
				}else{
					alert("Erro ao tentar cancelar a venda.\n\n"+erro+" - "+msg);
				}
			},
			"json"
		);
	}
}