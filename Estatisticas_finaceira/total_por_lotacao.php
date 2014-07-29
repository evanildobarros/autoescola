<?php require_once('../Connections/conexao.php'); ?>
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

mysql_select_db($database_conexao, $conexao);
$query_total = "SELECT SUM( mov.valor ) AS valor, ac.filial FROM acesso AS ac, lc_movimento AS mov WHERE ac.usuario = mov.id_cliente and mov.tipo='1' GROUP BY ac.filial";
$total = mysql_query($query_total, $conexao) or die(mysql_error());
$row_total = mysql_fetch_assoc($total);
$totalRows_total = mysql_num_rows($total);

mysql_select_db($database_conexao, $conexao);
$query_total2 = "SELECT SUM(valor) FROM lc_movimento WHERE tipo='1'";
$total2 = mysql_query($query_total2, $conexao) or die(mysql_error());
$row_total2 = mysql_fetch_assoc($total2);
$totalRows_total2 = mysql_num_rows($total2);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/estatistica.css" type="text/css" />
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Autoescola</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #00FF66}
-->
</style>
</head>

<body><br />
<br />
<br />

<fieldset><legend>Total de Receita por lota&ccedil&atilde;o</legend><br />


<table width="1000" border="0" align="center" style="border-collapse:collapse;">

  <tr>
    <td width="836" bgcolor="#FFCC00"><span style="color:#6666; padding:5px;">Escrit&oacute;rio</span><br /></td>
    <td width="154" bgcolor="#666"><div align="center" style="color:#fff; margin:0px 0px 0px 20px;">Valor</div></td>
  </tr>
  <?php
  $cont = 0;
   do { $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
			?>
			<tr bgcolor="<?php echo $cor ; ?>">
      <td ><div class="td2"><?php echo $row_total['filial']; ?></div></td>
      <td><div align="center">R$ 	
        <?php $vl = $row_total['valor']; 
	  echo number_format( $vl  , 2 , ',' , '.' );
	  ?> 
        </div></td>
    </tr>
    <?php $cont ++; } while ($row_total = mysql_fetch_assoc($total)); ?>
</table>
<table width="1000" border="0" align="center" style="border-collapse:collapse;">
  <tr>
    <td width="835" bgcolor="#FFCC00"><span style="color:#666; padding:5px;">
      &nbsp;Total<br />
    </span></td>
    <td width="155" bgcolor='#FEFAC0'><div align="center"><span style="color:#00CC33; font-weight:bold;">R$
    
      <?php $vl2 = $row_total2['SUM(valor)'];
	 echo number_format( $vl2  , 2 , ',' , '.' );
	    ?>
    </span></div></td>
  </tr>
 
</table>


</fieldset>


</body>
</html>
<?php
mysql_free_result($total);

mysql_free_result($total2);
?>


	<?php 
			
			$op="Consultou estica financeira (total por lotação !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
