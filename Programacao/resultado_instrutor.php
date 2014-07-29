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

$maxRows_instrutor = 10;
$pageNum_instrutor = 0;
if (isset($_GET['pageNum_instrutor'])) {
  $pageNum_instrutor = $_GET['pageNum_instrutor'];
}
$startRow_instrutor = $pageNum_instrutor * $maxRows_instrutor;

$colname_instrutor = "-1";
if (isset($_POST['instrutor'])) {
  $colname_instrutor = $_POST['instrutor'];
}
mysql_select_db($database_conexao, $conexao);
$query_instrutor = sprintf("SELECT ev1.id, ev3.instrutor,ev3.aluno, ev1.event_start, ev1.hora, ev1.event_shortdesc, ev3.veiculo, ev1.mes, ev3.categoria, ev3.tipo, ev1.descricao FROM calendar_events AS ev1, calendar_events3 AS ev3 WHERE ev3.instrutor LIKE %s ORDER BY id,event_start asc", GetSQLValueString("%" . $colname_instrutor . "%", "text"));
$query_limit_instrutor = sprintf("%s LIMIT %d, %d", $query_instrutor, $startRow_instrutor, $maxRows_instrutor);
$instrutor = mysql_query($query_limit_instrutor, $conexao) or die(mysql_error());
$row_instrutor = mysql_fetch_assoc($instrutor);

if (isset($_GET['totalRows_instrutor'])) {
  $totalRows_instrutor = $_GET['totalRows_instrutor'];
} else {
  $all_instrutor = mysql_query($query_instrutor);
  $totalRows_instrutor = mysql_num_rows($all_instrutor);
}
$totalPages_instrutor = ceil($totalRows_instrutor/$maxRows_instrutor)-1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Autoescola</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
</head>

<body>
<table width="1000" border="0" align="center">
  <tr>
    <td width="629"><img src="../img/logo2.png" width="300" height="100"></td>
    <td width="361"><div align="left"><span class="span6">Rua 03 Qd 05 casa 36 cohatrac IV S&atilde;o Lu&iacute;s - MA<br />
      -Contatos: (98) 8128-6971 | 8800-3198<br />
    -eneylton@hotmail.com</span></div></td>
  </tr>
</table>
<br>
<hr />
<table width="1000" border="0" align="center">
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8"><div style="text-transform:uppercase; font-weight:bold; color:#006699;">INSTRUTOR : <?php echo $row_instrutor['instrutor']; ?></div>
    </strong></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Aluno<br>
        <br>
    </div></td>
    <td valign="top"><div align="left">Inicio da aula</div></td>
    <td valign="top"><div align="left">Final</div></td>
    <td valign="top"><div align="left">Data </div></td>
    <td valign="top"><div align="left">Veiculo</div></td>
    <td valign="top"><div align="left">Categoria</div></td>
    <td valign="top"><div align="left">Tipo</div></td>
    <td valign="top"><div align="left">Observação</div></td>
  </tr>
  <?php 
  $cont = 0;
  do {
  $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
   ?>
    <tr bgcolor="<?php echo $cor ; ?>">
      <td><div align="left"><?php echo $row_instrutor['aluno']; ?></div></td>
      <td><div align="left"><?php echo $row_instrutor['hora']; ?> H&oacute;ras</div></td>
      <td><div align="left"><?php echo $row_instrutor['event_shortdesc']; ?> H&oacute;ras</div></td>
      <td><div align="left">
        <?php 
	   $date = $row_instrutor['event_start']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?>
      </div></td>
      <td><div align="left"><?php echo $row_instrutor['veiculo']; ?></div></td>
      <td><div align="left"><?php echo $row_instrutor['categoria']; ?></div></td>
      <td><div align="left"><?php echo $row_instrutor['tipo']; ?></div></td>
      <td><div align="left"><?php echo $row_instrutor['descricao']; ?></div></td>
    </tr>
    <?php $cont ++; } while ($row_instrutor = mysql_fetch_assoc($instrutor)); ?>
</table>
<br>
<table width="1000" border="0" align="center">
  <tr>
    <td width="388">&nbsp;</td>
    <td width="596"><form name="form1" method="post" action="">
      <label>
      <input name="button" type="submit" class="botao" id="button" onClick="MM_goToURL('parent','../listas/layout_mapa_instrutor.php');return document.MM_returnValue" value="Voltar">
      </label>
      <label>
      <input name="button2" type="submit" class="botao" id="button2" onClick="MM_callJS('print();')" value="IMPRIMIR">
      </label>
    </form></td>
  </tr>
</table>
<br>
<br>
<?php if ($totalRows_instrutor == 0) { // Show if recordset empty ?>
  <table width="451" border="0" align="center">
    <tr>
      <td><div align="center" class="style1 style1">Nenhum aluno na sua lista !</div></td>
    </tr>
  </table>
  <?php } // Show if recordset empty ?>
</body>
</html>
<?php
mysql_free_result($instrutor);
?>
