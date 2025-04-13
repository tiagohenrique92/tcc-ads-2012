<?php
	session_start();
	require '../conection.php';
	if($_POST){
		$dados = $_POST['dados'];
		$prazo = $dados['prazo'];
		$valorfinal = $dados['total'];
		$datacaixa = $_SESSION['datacaixa'];
		$num = 0;
	}

	$sql = "select prazo.nome, iprazo.* from prazo, iprazo where (prazo.idprazo = $prazo) and (iprazo.idprazo = $prazo) order by dias";
	$resultado = mysql_query($sql);
	$numlin = mysql_num_rows($resultado);
	$valorparc = number_format($valorfinal / $numlin, 2);
	$total = 0;
?>
<table>
    <tr>
        <td style="width:65px; text-align:left">Num</td>
        <td style="width:95px; text-align:left">Vencimento</td>
        <td style="width:75px; text-align:left">Valor</td>
    </tr>
</table>
<table>
<?php

	while($linha = mysql_fetch_assoc($resultado)){
		$num++;
		if($numlin == 1){//parcela unica
		?>
        <tr>
            <td>
                <input type="text" readonly name="num" size="4" style="text-align:right" value="<?php echo $num; ?>" />
            </td>
            <td>
                <input type="text" readonly name="datavcto" size="10" style="text-align:center" value="<?php echo $datavcto = date('d-m-Y', strtotime($datacaixa."+ ".$linha['dias']." day" ));?>" />
            </td>
            <td>
                <input type="text" readonly name="valorparc" size="7" style="text-align:right" value="<?php echo number_format($valorfinal, 2) ?>" />
                <?php 
                    $total = $total + $valorparc;
                ?>
            </td>
        </tr>
        <?php
			$parcelas[$num - 1] = array("num"=>$num, "total"=>$numlin, "vcto"=>$datavcto, "valor"=>$valorparc, "status"=>"AB");
			$_SESSION['parcelas'] = json_encode($parcelas);
		}else{//mais de uma parcela
		?>
        <tr>
            <td>
                <input type="text" readonly name="num" size="4" style="text-align:right" value="<?php echo $num; ?>" />
            </td>
            <td>
                <input type="text" readonly name="datavcto" size="10" style="text-align:center" value="<?php echo $datavcto = date('d-m-Y', strtotime($datacaixa."+ ".$linha['dias']." day" ));?>" />
            </td>
            <td>
                <?php
                    if(($num == $numlin) ){
                        //acerta o valor da ultima parcela para nao haver dizima periodica e nem resto
                        $valorparc = number_format($valorparc - (($valorparc * $numlin) - $valorfinal), 2);
                        ?>
                        <input type="text" readonly name="valorparc" size="7" style="text-align:right" value="<?php echo $valorparc; ?>" />
                        <?php
                    }else{
                        ?>
                        <input type="text" readonly name="valorparc" size="7" style="text-align:right" value="<?php echo $valorparc; ?>" />
                        <?php
                    }
                    $total = $total + $valorparc;
                ?>
            </td>
        </tr>
        <?php
			//$parcelas[$num - 1] = "{'num':".$num.", 'total':".$numlin.", 'vcto':'".$datavcto."', 'valor':'".$valorparc."', 'status':'A'}";
			$parcelas[$num - 1] = array("num"=>$num, "total"=>$numlin, "vcto"=>$datavcto, "valor"=>$valorparc, "status"=>"AB");
        }
	}

	$_SESSION['parcelas'] = json_encode($parcelas);
?>
</table>