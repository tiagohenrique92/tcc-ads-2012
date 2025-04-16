  <?php
      require 'verificaLogin.php';
	  verificaLogin('SALVARCLIENTE');
	  
      $tipo = $_POST['tipo'];
      $idcli = strtoupper($_POST['idcli']);
      $nome = strtoupper($_POST['nome']);
      $endereco = strtoupper($_POST['endereco']);
      $bairro = strtoupper($_POST['bairro']);
      $idcid = strtoupper($_POST['idcid']);
      $uf = strtoupper($_POST['uf']);
      $cep = strtoupper($_POST['cep']);
      $fone = strtoupper($_POST['fone']);
      $celular = strtoupper($_POST['celular']);
      $email = strtolower($_POST['email']);
      $cnpjcpf = strtoupper($_POST['cnpjcpf']);
      $ierg = strtoupper($_POST['ierg']);
      $contato = strtoupper($_POST['contato']);
      $status = strtoupper($_POST['status']);
      $opcao = $_POST['btnEnviar'];
      
      switch ($opcao){
          case "Salvar" :
              $sql = "insert into cliente (idcli, nome, cnpjcpf, ierg, endereco, bairro, idcid, iduf, cep, fone, celular, email, contato, status, tipo) values(null, '$nome', '$cnpjcpf', '$ierg', '$endereco', '$bairro', '$idcid', '$uf', '$cep', '$fone', '$celular', '$email', '$contato', '$status', '$tipo')";
          break;
          case "Alterar" :
              $sql = "update cliente set nome = '$nome', cnpjcpf = '$cnpjcpf', ierg = '$ierg', endereco = '$endereco', bairro = '$bairro', idcid = '$idcid', iduf = '$uf', cep = '$cep', fone = '$fone', celular = '$celular', email = '$email', contato = '$contato', status = '$status' where idcli = '$idcli'";
          break;
      }
      
      if(mysqli_query($GLOBALS['connection'], $sql)){
          header("location: index.php");
      }else{
          echo "Erro ao salvar cliente. <br>";
          echo "Erro: ".mysqli_error($GLOBALS['connection']);
      }		

