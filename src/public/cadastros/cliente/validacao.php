<?php
	function CPF($valor){
		$cpf = substr($valor, 0, 9);
		
		if(strlen($valor) < 11){
			return false;
			exit;
		}
		
		switch($valor){
			case '00000000000':
			case '11111111111':
			case '22222222222':
			case '33333333333':
			case '44444444444':
			case '55555555555':
			case '66666666666':
			case '77777777777':
			case '88888888888':
			case '99999999999':
				return false;
				exit;
			break;
		}
		
		$soma = 0;
		$num = 10;
		
		for($i = 0; $i < 9; $i++){
			$soma += $cpf[$i] * $num;
			$num--;
		}
		
		$digito = 11 - ($soma % 11);
	
		if($digito > 9){
			$cpf = $cpf."0";
		}else{
			$cpf = $cpf.$digito;
		}
		
		$soma = 0;
		$num = 11;
		
		for($i = 0; $i < 10; $i++){
			$soma += $cpf[$i] * $num;
			$num--;
		}
		
		$digito = 11 - ($soma % 11);
	
		if($digito > 9){
			$cpf = $cpf."0";
		}else{
			$cpf = $cpf.$digito;
		}	
		
		if($cpf == $valor){
			return true;
			exit;
		}else{
			return false;
			exit;
		}
	}
	
	function CNPJ($valor){
		
		$cnpj = substr($valor, 0, 12);
		
		if(strlen($valor) < 14){
			return false;
			exit;
		}
		
		switch($valor){
			case '00000000000000':
			case '11111111111111':
			case '22222222222222':
			case '33333333333333':
			case '44444444444444':
			case '55555555555555':
			case '66666666666666':
			case '77777777777777':
			case '88888888888888':
			case '99999999999999':
				return false;
				exit;
			break;
		}
		
		$soma = 0;
		$num = array("5","6","7","8","9","2","3","4","5","6","7","8","9");
		
		for($i = 0; $i < 12; $i++){
			$soma += $cnpj[$i] * $num[$i + 1];
		}
		
		if(($soma % 11 < 2) || ($soma % 11 == 10)){
			$dig1 = 0;
		}else{
			$dig1 = $soma % 11;
		}
		
		$cnpj = $cnpj . $dig1;
		
		$soma = 0;
		for($i = 0; $i < 13; $i++){
			$soma += $cnpj[$i] * $num[$i];
		}

		if(($soma % 11 < 2) || ($soma % 11 == 10)){
			$dig2 = 0;
		}else{
			$dig2 = $soma % 11;
		}
		
		$cnpj = $cnpj . $dig2;
		
		if($cnpj == $valor){
			return true;
			exit;
		}else{
			return false;
			exit;
		}
	}