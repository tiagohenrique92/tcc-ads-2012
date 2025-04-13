<?php
	require "../conection.php";
	if(!isset($_SESSION)){
		session_start();
	}
	$barras = 0;
	$nome = '';
	$idcompra = $_SESSION['idcompra'];
	if(isset($_GET['rdnomecodigo'])){
		if($_GET['rdnomecodigo'] == 'n'){
			$nome = $_GET['valbusca'];
			$where = " where nome like '%$nome%' and status = 'A' and idpro not in (select idpro from itemcompra where idcompra = $idcompra)";
		}else{
			$barras = $_GET['valbusca'];
			$where = " where barras = $barras and status = 'A' and idpro not in (select idpro from itemcompra where idcompra = $idcompra)";
		}
	}
	
	$sql = "SELECT * FROM PRODUTO";
	
	if(isset($where)){
		$sql = $sql . $where;
	}
	$select = mysql_query($sql);
	function listarProduto($select){
		$i = 0;
		while($produto = mysql_fetch_assoc($select)){
			$i++;
			?>
            <tr>
                <td width="50px" align="center"><?php echo $i;?></td>
                <td width="60px" align="center"><?php echo $produto['barras'];?></td>
                <td><?php echo $produto['nome'];?></td>
                <td width="70px" align="center"><?php echo $produto['qtde']; ?></td>
                <td width="70px" align="center"><?php echo $produto['precocompra']; ?></td>
                <td width="40px" align="center">
                	<a href="#" class="spriteIcons btnAdd" title="Selecionar" barras="<?php echo $produto['barras']?>" nomepro="<?php echo $produto['nome']?>" qtdepro="<?php echo $produto['qtde']?>" precopro="<?php echo $produto['precocompra']?>" idpro=<?php echo $produto['idpro']; ?>></a>
                </td>
            </tr>
            <?php
  		}
	}
?>
<table width="100%" height="100%" cellspacing="3px">
    <?php
		if((isset($_GET['valbusca']) && (trim($_GET['valbusca']) != ''))){
			listarProduto($select);
		}
	?>
</table>
<script type="text/javascript">
$(function(){	
	$('.btnAdd').bind('click', function(){
		$('#frmInserirProduto #barras', window.parent.document).attr('value', $(this).attr('barras'));
		$('#frmInserirProduto #nome', window.parent.document).attr('value', $(this).attr('nomepro'));
		$('#frmInserirProduto #estoque', window.parent.document).attr('value', $(this).attr('qtdepro'));
		$('#frmInserirProduto #preco', window.parent.document).attr('value', $(this).attr('precopro'));
		$('#frmInserirProduto #idpro', window.parent.document).attr('value', $(this).attr('idpro'));
		
		$('#insert', window.parent.document).show();		
		$('#valbusca', window.parent.document).attr('value', '');
		$('#valbusca', window.parent.document).keyup();

		$('#busca #resultBusca', window.parent.document).hide();
		return false;
	});
});
</script>