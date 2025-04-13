$(function(){
	/**Busca de fornecedor**/
	$('#nome').bind('keyup', function(){
		carregaFornecedor(this.value)
	});
	
	
	/**Excluir Compra**/
	$('.btnDel').bind("click", function(){
		excluirCompra($(this).attr("id"));
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

/**Excluir Compra**/
function excluirCompra(idcompra){
	var msg = "Deseja cancelar esta compra?";
	if(confirm(msg)){
		$.post(
			"excluirCompra.php",
			{"idcompra":idcompra},
			function(retorno){
				var erro = retorno['erro'];
				var msg = retorno['msg'];
				
				if(erro == 0){
					alert(msg);
					window.location.reload();
				}else{
					alert("Erro ao tentar cancelar a compra.\n\n"+erro+" - "+msg);
				}
			},
			"json"
		);
	}
}