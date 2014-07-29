<?php

 
session_start();

?>        
<?php require_once('../Connections/conexao.php'); ?><?php
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
$query_meses = "SELECT * FROM meses";
$meses = mysql_query($query_meses, $conexao) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);

$colname_movei = "-1";
if (isset($_POST['mes'])) {
  $colname_movei = $_POST['mes'];
}
$colname1_movei = "-1";
if (isset($_POST['tipo'])) {
  $colname1_movei = $_POST['tipo'];
}
mysql_select_db($database_conexao, $conexao);
$query_movei = sprintf("SELECT * FROM movimento WHERE mes LIKE%s AND tipo LIKE%s ORDER BY id_mov DESC", GetSQLValueString("%" . $colname_movei . "%", "text"),GetSQLValueString("%" . $colname1_movei . "%", "text"));
$movei = mysql_query($query_movei, $conexao) or die(mysql_error());
$row_movei = mysql_fetch_assoc($movei);
$totalRows_movei = mysql_num_rows($movei);

$maxRows_con2 = 1;
$pageNum_con2 = 0;
if (isset($_GET['pageNum_con2'])) {
  $pageNum_con2 = $_GET['pageNum_con2'];
}
$startRow_con2 = $pageNum_con2 * $maxRows_con2;

$colname_con2 = "-1";
if (isset($_POST['mes'])) {
  $colname_con2 = $_POST['mes'];
}
mysql_select_db($database_conexao, $conexao);
$query_con2 = sprintf("SELECT * FROM movimento WHERE mes LIKE %s ORDER BY id_mov DESC", GetSQLValueString("%" . $colname_con2 . "%", "text"));
$query_limit_con2 = sprintf("%s LIMIT %d, %d", $query_con2, $startRow_con2, $maxRows_con2);
$con2 = mysql_query($query_limit_con2, $conexao) or die(mysql_error());
$row_con2 = mysql_fetch_assoc($con2);

if (isset($_GET['totalRows_con2'])) {
  $totalRows_con2 = $_GET['totalRows_con2'];
} else {
  $all_con2 = mysql_query($query_con2);
  $totalRows_con2 = mysql_num_rows($all_con2);
}
$totalPages_con2 = ceil($totalRows_con2/$maxRows_con2)-1;

$maxRows_con3 = 1;
$pageNum_con3 = 0;
if (isset($_GET['pageNum_con3'])) {
  $pageNum_con3 = $_GET['pageNum_con3'];
}
$startRow_con3 = $pageNum_con3 * $maxRows_con3;

$colname_con3 = "-1";
if (isset($_POST['mes'])) {
  $colname_con3 = $_POST['mes'];
}
$colname1_con3 = "-1";
if (isset($_POST['tipo'])) {
  $colname1_con3 = $_POST['tipo'];
}
mysql_select_db($database_conexao, $conexao);
$query_con3 = sprintf("SELECT * FROM movimento WHERE mes LIKE%s AND tipo LIKE%s ORDER BY id_mov DESC", GetSQLValueString("%" . $colname_con3 . "%", "text"),GetSQLValueString("%" . $colname1_con3 . "%", "text"));
$query_limit_con3 = sprintf("%s LIMIT %d, %d", $query_con3, $startRow_con3, $maxRows_con3);
$con3 = mysql_query($query_limit_con3, $conexao) or die(mysql_error());
$row_con3 = mysql_fetch_assoc($con3);

if (isset($_GET['totalRows_con3'])) {
  $totalRows_con3 = $_GET['totalRows_con3'];
} else {
  $all_con3 = mysql_query($query_con3);
  $totalRows_con3 = mysql_num_rows($all_con3);
}
$totalPages_con3 = ceil($totalRows_con3/$maxRows_con3)-1;

mysql_select_db($database_conexao, $conexao);
$query_soma1 = "SELECT SUM(valor) as total FROM movimento WHERE tipo=0";
$soma1 = mysql_query($query_soma1, $conexao) or die(mysql_error());
$row_soma1 = mysql_fetch_assoc($soma1);
$totalRows_soma1 = mysql_num_rows($soma1);

mysql_select_db($database_conexao, $conexao);
$query_soma2 = "SELECT SUM(valor) as total FROM movimento WHERE tipo=1";
$soma2 = mysql_query($query_soma2, $conexao) or die(mysql_error());
$row_soma2 = mysql_fetch_assoc($soma2);
$totalRows_soma2 = mysql_num_rows($soma2);

$colname_total_s = "-1";
if (isset($_POST['tipo'])) {
  $colname_total_s = $_POST['tipo'];
}
$colname1_total_s = "-1";
if (isset($_POST['mes'])) {
  $colname1_total_s = $_POST['mes'];
}
mysql_select_db($database_conexao, $conexao);
$query_total_s = sprintf("SELECT SUM(valor) as total FROM movimento WHERE tipo LIKE %s AND mes LIKE %s ", GetSQLValueString("%" . $colname_total_s . "%", "text"),GetSQLValueString("%" . $colname1_total_s . "%", "text"));
$total_s = mysql_query($query_total_s, $conexao) or die(mysql_error());
$row_total_s = mysql_fetch_assoc($total_s);
$totalRows_total_s = mysql_num_rows($total_s);
$s1 = $row_soma1['total'];
$s2 = $row_soma2['total'];
$s_total = $s1 - $s2 ;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Relat&oacute;rio</title>
<style type="text/css">
<!--
.style1 {	color: #000099;
	font-weight: bold;
}
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {font-size: 24px}
.td{
   text-transform:uppercase;
   }
.style6 {font-size: 17px; font-weight: bold; }
.style10 {font-size: 15px}
.style11 {text-transform: uppercase; font-size: 12px; }
.style22 {	font-size: 14px
}
-->
</style>
</head>

<body>
<table width="1027" border="0" align="center">
  <tr>
    <td width="352" valign="top" bgcolor="#FFFFFF"><img src="../img/logo23.png" width="298" height="139" /></td>
    <td width="452" valign="top" bgcolor="#FFFFFF"><div align="left" class="style22"><br />
      <br />
      Enedere&ccedil;o: rua 03 qd.05 casa 36 Cohatrac IV<br />
    proximo a quadra de esporte<br />
    Fone: (98) 8800-3198 | 8128-6981</div></td>
    <td width="209" valign="top" bgcolor="#FFFFFF"><div align="right"><span class="style3">N&ordm; <?php echo date("md"); ?><?php echo $row_con2['id_mov']; ?></span></div></td>
  </tr>
</table>

<hr>
<table width="1027" border="0" align="center">
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><div align="center"><strong>::: RELAT&Oacute;RIO MENSAL ::::</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">M&Ecirc;S DE ORIGEM DA MOVIMENTA&Ccedil;&Atilde;O</td>
  </tr>
  <?php do { ?>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style1" style="text-transform:uppercase;"><?php echo $row_con2['mes']; ?></span></td>
  </tr>
  <?php } while ($row_con2 = mysql_fetch_assoc($con2)); ?>
</table>
<br />
<table width="1027" border="0" align="center">
  <tr>
    <td bgcolor="#FFFFFF">TIPO DE MOVIMENTA&Ccedil;&Atilde;O</td>
  </tr>
  <?php do { ?>
  <tr>
    <td bgcolor="#FFFFFF"><?php if ($row_con3['tipo']==0) echo "<font color=\"#000099\"><strong>RECEITA</strong></font>"; else echo "<font color=\"Red\"><strong>DESPESAS</strong></font>"?>    </td>
  </tr>
  <?php } while ($row_con3 = mysql_fetch_assoc($con3)); ?>
</table>
<br />
<br />
<table width="1027" border="0" align="center">
  <tr>
    <td width="318" valign="top" bgcolor="#FFFFFF"><span class="style6">DATA DA MOVIMENTA&Ccedil;&Atilde;O</span></td>
    <td width="275" valign="top" bgcolor="#FFFFFF"><span class="style6">USU&Aacute;RIO</span></td>
    <td width="284" valign="top" bgcolor="#FFFFFF"><span class="style6">CATEGORIA<br />
          <br />
    </span></td>
    <td width="132" valign="top" bgcolor="#FFFFFF"><span class="style6">VALOR</span></td>
  </tr>
  <?php 
   $cont = 0;
   do 
   
   { 
    $cor = ($cont%2 == 0)? "#e1e1e1":"ffffff";
   ?>
  <tr bgcolor="<?php echo $cor ; ?>">
    <td valign="top" bgcolor="#FFFFFF"><span class="style10"><?php 
	   $date = $row_movei['data'];
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?></span></td>
    <td valign="top" bgcolor="#FFFFFF"><span class="style11"><?php echo $row_movei['id_cliente']; ?></span></td>
    <td valign="top" bgcolor="#FFFFFF" class="style11"><?php echo $row_movei['categoria']; ?></td>
    <td valign="top" bgcolor="#FFFFFF"><span class="style10">R$ <?php $total2 = $row_movei['valor'];  echo number_format( $total2  , 2 , ',' , '.' ); ?></span></td>
  </tr>
  <?php $cont ++; } while ($row_movei = mysql_fetch_assoc($movei)); ?>
</table>
<br />
<table width="1027" border="1" bordercolor="#CCCCCC" align="center" style="border-collapse:collapse">
  <tr>
    <td bgcolor="#FFFFFF"><div align="right"><span class="style2">TOTAL R$</span><span class="style3"><strong><span class="style2">
      <?php if ($row_con3['tipo']==0) $total2 = $row_total_s['total']; echo number_format( $total2  , 2 , ',' , '.' ); ?>
    </span></strong></span></div></td>
  </tr>
</table>
</body>
</html>


<?php
mysql_free_result($meses);

mysql_free_result($movei);

mysql_free_result($con2);

mysql_free_result($con3);

mysql_free_result($soma1);

mysql_free_result($soma2);

mysql_free_result($total_s);
?>

<?php 

$op="Imprimiu Relatório / balaço financeiro !";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
?>
