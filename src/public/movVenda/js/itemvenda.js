// JavaScript Document

$(function(){
	$('.btnEdit').bind('click', function(){
		$('#frmInserirProduto #barras', window.parent.document).attr('value', $(this).attr('barras'));
		$('#frmInserirProduto #idpro', window.parent.document).attr('value', $(this).attr('idpro'));
		$('#frmInserirProduto #nome', window.parent.document).attr('value', $(this).attr('nomepro'));
		$('#frmInserirProduto #estoque', window.parent.document).attr('value', $(this).attr('estoque'));
		$('#frmInserirProduto #preco', window.parent.document).attr('value', $(this).attr('precopro'));
		$('#frmInserirProduto #qtde', window.parent.document).attr('value', $(this).attr('qtdepro'));
		$('#frmInserirProduto .btnInserir', window.parent.document).hide();
		$('#frmInserirProduto .btnAlterar', window.parent.document).show();
		
		$('#insert', window.parent.document).show();		
		return false;
	});
});