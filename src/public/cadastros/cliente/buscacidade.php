<?php
	require "../../conecta.php";
	
	if(isset($_GET)){
		$uf = $_GET['uf'];
		$cidades = array();
		$contador = 0;
	
		$sql = "select * from cidade where iduf = ".$uf." order by nome";
		$resultado = mysql_query($sql);
		while($linha = mysql_fetch_assoc($resultado)){
			$contador++;
			$cidades[$contador] = array('idcid'=>$linha['idcid'], 'nome'=>$linha['nome']);
		}
		$cidades = json_encode($cidades);
		print_r($cidades);
	}