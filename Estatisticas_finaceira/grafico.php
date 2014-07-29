<?php require_once('../Connections/conexao.php'); ?>
<?php


mysql_select_db($database_conexao, $conexao);
$query_total1 = "SELECT SUM( mov.valor ) AS valor, ac.filial FROM acesso AS ac, movimento AS mov WHERE ac.nome = mov.id_cliente and mov.tipo='0' And filial='Arari' GROUP BY ac.filial";
$total1 = mysql_query($query_total1, $conexao) or die(mysql_error());
$row_total1 = mysql_fetch_assoc($total1);
$totalRows_total1 = mysql_num_rows($total1);
$total1 = $row_total1['total1']; 
?>

<?php 
      include('../phpHtmlChart.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Gerenciador Auto escola</title>
</head>

<body>

     <?php
	

	$aGraphData = Array
		(array('Arari',      $total1, ' Particular'),
		 array('ALUQUEL',       $total2, ' Aluquel'),
		 array('APRENDIZAGEM', $total3, ' Aprendizagem'),
		 array('OFICIAL',  $total4, ' Aluquel'),
		 array('NAO INFORMADO',   $total5, ' Nao Informado')
		 
		 
	
		);

	echo phpHtmlChart($aGraphData, 'H', 'Total de Acidente por Categoria de Veiculo', 
	'Estatistica  de Acidentes de Transito Sao Luis-MA', '8pt', 400, 'px', 15, 'px');
?>

</body>
</html>
<?php
@mysql_free_result($total1);
?>
