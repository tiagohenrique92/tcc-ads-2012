/*
funcao que verifica se a quantidade passada pelo usuario é maior que a quantidade
do estoque
*/
function checharQtde(estoque, qtde, qtdeanterior){
	var estoque = new number(estoque);
	var qtde = new number(qtde);
	var qtdeanterior = new number(qtdeanterior);
	alert(estoque);
	alert(qtde);
	alert(qtdeanterior);
	var teste;
	teste = estoque + qtdeanterior;
	alert(teste);
	if((teste) >= qtde){
		return true;
	}else{
		alert("A quantidade máxima em estoque é de "+estoque);
		return false;
	}
}

//escolhe qual pagina vai ser aberta para alterar cliene
function destinoAlterarCliente(tipo, form){
	var tipo = tipo;
	var form = form;
	
	if(tipo == 'F'){
		document.forms[form].action = 'alterarclientefis.php';
		document.forms[form].submit();
	}
	if(tipo == 'J'){
		document.forms[form].action = 'alterarclientejur.php';
		document.forms[form].submit();
	}
}

//escolhe qual pagina vai ser aberta para alterar fornecedor
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

/* função para verificar qtdes negativas em cadastros*/
function qtdeMaiorZero(valor){
	var qtde = valor;

	if(qtde < 0){
		alert("O valor do campo quantidade deve ser maior ou igual a zero!");
		return false;
	}else{
		return true;
	}
}