<?php
	require 'conecta.php';
	
	$idcaixa = $caixa;
	
	function somaRec($idcaixa){
		$sql = "select sum(valorrec) as totalrec from parcelarec where idcaixa = $idcaixa and status = 'P'";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$totalrec = mysqli_fetch_assoc($resultado);
		$totalrec = $totalrec['totalrec'];
		
		if(is_null($totalrec)){
			$totalrec = 0;
		}		
		
		return $totalrec;
	}
	
	function somaRecCan($idcaixa){
		$datacaixa = $_SESSION['datacaixa'];
		$sql = "select sum(valorrec) as totalreccan from parcelarec where idcaixa = $idcaixa and status = 'C' and datapag <> '$datacaixa'";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$totalreccan = mysqli_fetch_assoc($resultado);
		$totalreccan = $totalreccan['totalreccan'];
		
		if(is_null($totalreccan)){
			$totalreccan = 0;
		}
		
		return $totalreccan;
	}
	
	function somaPag($idcaixa){
		$sql = "select sum(valorpago) as totalpag from parcelapag where idcaixa = $idcaixa";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$totalpag = mysqli_fetch_assoc($resultado);
		$totalpag =  $totalpag['totalpag'];
		
		if(is_null($totalpag)){
			$totalpag = 0;
		}
		
		return $totalpag;
	}
	
	function somaPagCan($idcaixa){
		$sql = "select sum(valorpago) as totalpagcan from parcelapag where idcaixa = $idcaixa and status = 'C'";
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
		
		$totalpagcan = mysqli_fetch_assoc($resultado);
		$totalpagcan = $totalpagcan['totalpagcan'];
		
		if(is_null($totalpagcan)){
			$totalpagcan = 0;
		}
		
		return $totalpagcan;
	}
	
	function fechaCaixa($idcaixa){	
		$totRec = somaRec($idcaixa) + somaPagCan($idcaixa);
		$totPag = somaPag($idcaixa) + somaRecCan($idcaixa);
		
		$totalGeral = $totRec - $totPag;
		
		$sql = "update caixa set status = 'F', valor = $totalGeral where idcaixa = $idcaixa";
		
		$resultado = mysqli_query($GLOBALS['connection'], $sql);
	}
	
	fechaCaixa($idcaixa);
	header("location: index.php");
?>