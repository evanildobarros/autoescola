	<?php
			@session_start();
			
	?>
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

$colname_cliente = "-1";
if (isset($_GET['id'])) {
  $colname_cliente = $_GET['id'];
}
mysql_select_db($database_conexao, $conexao);
$query_cliente = sprintf("SELECT ev1.id,
                                 ev1.event_shortdesc, 
                                 ev1.event_start, 
								 ev1.hora, 
								 ev1.aluno, 
								 ev2.instrutor, 
								 ev2.veiculo, 
								 ev2.categoria, 
								 ev1.tipo, 
								 ev1.descricao, 
								 ev1.mes 
								 FROM 
								 calendar_events AS ev1, calendar_events3 AS ev2 WHERE ev1.aluno = ev2.aluno AND  ev1.id = %s", GetSQLValueString($colname_cliente, "int"));
$cliente = mysql_query($query_cliente, $conexao) or die(mysql_error());
$row_cliente = mysql_fetch_assoc($cliente);
$totalRows_cliente = mysql_num_rows($cliente);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
             
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>cliente</title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body>
<p align="center"><strong>:: DETALHES ::</strong><br />
<hr /></p>
<table width="500" border="0" align="center">
  <tr>
    <td width="256" bgcolor="#EFEFEF"><div align="left">Aula reservada para o Aluno (a):</div></td>
    <td width="234" bgcolor="#F9F9F9"><div align="left"><?php echo $row_cliente['aluno']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF"><div align="left">Data</div></td>
    <td bgcolor="#F9F9F9"><div align="left">
      <?php 
	   $date = $row_cliente['event_start']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF"><div align="left">Nos Horarios de:</div></td>
    <td bgcolor="#F9F9F9"><div align="left"><?php echo $row_cliente['hora']; ?> &aacute;s <?php echo $row_cliente['event_shortdesc']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF"><div align="left">Instrutor:</div></td>
    <td bgcolor="#F9F9F9"><div align="left"><span class="span6"><?php echo $row_cliente['instrutor']; ?></span></div></td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF"><div align="left">Veiculo</div></td>
    <td bgcolor="#F9F9F9"><div align="left"><span class="span6"><?php echo $row_cliente['veiculo']; ?></span></div></td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF"><div align="left">Categoria Pretendida</div></td>
    <td bgcolor="#F9F9F9"><div align="left"><span class="span6"><?php echo $row_cliente['categoria']; ?></span></div></td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF"><div align="left">Tipo</div></td>
    <td bgcolor="#F9F9F9"><div align="left"><span class="span6"><?php echo $row_cliente['tipo']; ?></span></div></td>
  </tr>
  <tr>
    <td><div align="left"></div></td>
    <td><div align="left"></div></td>
  </tr>
</table>
<p>&nbsp;</p>
<p><span class="span6">
  </p>
  <?php
mysql_free_result($cliente);
?>
  <br />
</span></p>
