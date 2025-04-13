<?php
	require '../../conection.php';
	require '../../verificaLogin.php';
	verificaLogin('SALVARCIDADE');

	$uf = $_POST['uf'];
	$cidade = $_POST['cidade'];
	function resposta($dados){
		
	}
	
	if($uf == ""){$resposta = array('erro'=>'1', 'campo'=>'estado', 'msg'=>'O campo estado precisa ser preenchido');resposta($resposta);};
	$sql = "insert into cidade (idcid, nome, iduf) values ('NULL', '$cidade', $uf)";
	
	$resultado = mysql_query($sql);
	
	header("location: pesquisarcid.php");
	?>
</body>
</html>