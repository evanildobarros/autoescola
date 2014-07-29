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
$query_cliente = sprintf("SELECT * FROM calendar_events WHERE id = %s", GetSQLValueString($colname_cliente, "int"));
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
<p><span class="span6"><?php echo $row_cliente['event_title']; ?> para o aluno(a) &nbsp;<?php echo $row_cliente['aluno']; ?><br />
no dia: <?php 
	   $date = $row_cliente['event_start']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?> <br />
no horário de <?php echo $row_cliente['hora']; ?> ás <?php echo $row_cliente['event_shortdesc']; ?><br />
</p>
<p class="span6">Instrutor : <?php echo $row_cliente['instrutor']; ?><br />
  Veiculo:  <?php echo $row_cliente['veiculo']; ?></p>
<p class="span6">Categoria: <?php echo $row_cliente['categoria']; ?><br />
   Tipo:  <?php echo $row_cliente['tipo']; ?></p>
<span class="span6">Observação: <?php echo $row_cliente['descricao']; ?></p>
<?php
mysql_free_result($cliente);
?>
<br />
</span>