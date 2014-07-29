<?php require_once('Connections/conexao.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}




$maxRows_total = 10;
$pageNum_total = 0;
if (isset($_GET['pageNum_total'])) {
  $pageNum_total = $_GET['pageNum_total'];
}
$startRow_total = $pageNum_total * $maxRows_total;

mysql_select_db($database_conexao, $conexao);
$query_total = "SELECT ac.filial AS LOTAcaoO,   count(case when MONTH(data) =   '1' then '01-Janeiro'   end)   as  Janeiro,  count(case when MONTH(data) =   '2' then '02-Fevereiro' end)   as  Fevereiro,   count(case when MONTH(data) =   '3' then '03-Marco'     end)   as  Marco,     count(case when MONTH(data) =   '4' then '04-Abril'     end)   as  Abril,    count(case when MONTH(data) =   '5' then '05-Maio'      end)   as  Maio,    count(case when MONTH(data) =   '6' then '06-Junho'     end)   as  Junho,     count(case when MONTH(data) =   '7' then '07-Julho'     end)   as  Julho,    count(case when MONTH(data) =   '8' then '08-Agosto'    end)   as  Agosto,    count(case when MONTH(data) =   '9' then '09-Setembro'  end)   as  Setembro,    count(case when MONTH(data) =   '10' then '10-Outubro'   end)  as  Outubro,    count(case when MONTH(data) =   '11' then '11-Novembro'  end)  as  Novembro,    count(case when MONTH(data) =   '12' then '12-Dezembro'  end)  as  Dezembro,  SUM(valor) as Total FROM acesso AS ac, movimento AS mov WHERE ac.usuario = mov.id_cliente AND mov.tipo='0' GROUP BY ac.filial";
$query_limit_total = sprintf("%s LIMIT %d, %d", $query_total, $startRow_total, $maxRows_total);
$total = mysql_query($query_limit_total, $conexao) or die(mysql_error());
$row_total = mysql_fetch_assoc($total);

if (isset($_GET['totalRows_total'])) {
  $totalRows_total = $_GET['totalRows_total'];
} else {
  $all_total = mysql_query($query_total);
  $totalRows_total = mysql_num_rows($all_total);
}
$totalPages_total = ceil($totalRows_total/$maxRows_total)-1;

mysql_select_db($database_conexao, $conexao);
$query_total2 = "SELECT SUM(valor) FROM movimento where tipo='0'";
$total2 = mysql_query($query_total2, $conexao) or die(mysql_error());
$row_total2 = mysql_fetch_assoc($total2);
$totalRows_total2 = mysql_num_rows($total2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/estatistica.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Despachante</title>
<style type="text/css">
<!--
.style2 {color: #666666}
-->
</style>
</head>

<body>
<table width="1200" border="0" align="center" style="border-collapse:collapse;">
  <tr>
    <td colspan="14" bgcolor="#FFFFFF"><span class="td"><span class="style2">Quantidade de Alunos Matriculados por M&ecirc;s</span><br />
      <br />
          <br />
</span></td>
  </tr>
  <tr>
    <td bgcolor="#666"><span class="td4">LOTA&ccedil;&atilde;o </span></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Janeiro</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Feverira</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Mar&ccedil;o</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Abril</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Maio</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Junho</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Julho</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Agosto</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Setembro</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Outubro</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Novembro</span></font></td>
    <td bgcolor="#666"><font color="#999999"><span class="td">Dezembro</span></font></td>
    <td bgcolor="#666" ><font color="#999999"><span class="td">Total</span></font></td>
  </tr>
  <?php 
  $cont = 0;
  do { 
   $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
  ?>
      <tr bgcolor="<?php echo $cor ; ?>">
        <td bgcolor="#333"><span class="td"><?php echo $row_total['LOTAcaoO']; ?></span></td>
        <td><span class="td2"><?php echo $row_total['Janeiro']; ?></td>
        <td><span class="td2"><?php echo $row_total['Fevereiro']; ?></td>
        <td><span class="td2"><?php echo $row_total['Marco']; ?></td>
        <td><span class="td2"><?php echo $row_total['Abril']; ?></td>
        <td><span class="td2"><?php echo $row_total['Maio']; ?></td>
        <td><span class="td2"><?php echo $row_total['Junho']; ?></td>
        <td><span class="td2"><?php echo $row_total['Julho']; ?></td>
        <td><span class="td2"><?php echo $row_total['Agosto']; ?></td>
        <td><span class="td2"><?php echo $row_total['Setembro']; ?></td>
        <td><span class="td2"><?php echo $row_total['Outubro']; ?></td>
        <td><span class="td2"><?php echo $row_total['Novembro']; ?></td>
        <td><span class="td2"><?php echo $row_total['Dezembro']; ?></td>
        <td>R$ <?php $vl1 = $row_total['Total']; $vl1 = $row_total['Total']; 
	  echo number_format( $vl1  , 2 , ',' , '.' );
	  ?></td>
      </tr>
       <?php $cont ++; } while ($row_total = mysql_fetch_assoc($total)); ?>
    <tr>
      <td colspan="13" bgcolor="#666" class="td3"><span >Total</td>
      <td  bgcolor="#666" class="td3">R$ <?php $vl = $row_total2['SUM(valor)']; $vl = $row_total2['SUM(valor)']; 
	  echo number_format( $vl  , 2 , ',' , '.' );
	  ?></font></td>
    </tr>
</table>

</body>
</html>
<?php
mysql_free_result($total);

mysql_free_result($total2);
?>

	<?php 
			
			$op="Consultou Quantida de alunos por mês !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>