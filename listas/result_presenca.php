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

$colname_salas = "-1";
if (isset($_POST['sala'])) {
  $colname_salas = $_POST['sala'];
}
mysql_select_db($database_conexao, $conexao);
$query_salas = sprintf("SELECT * FROM turma WHERE sala LIKE %s", GetSQLValueString("%" . $colname_salas . "%", "text"));
$salas = mysql_query($query_salas, $conexao) or die(mysql_error());
$row_salas = mysql_fetch_assoc($salas);
$totalRows_salas = mysql_num_rows($salas);

mysql_select_db($database_conexao, $conexao);
$query_professor = "SELECT s.prof, s.periodo1, s.periodo2 FROM sala AS s, turma AS t WHERE s.descricao = t.sala";
$professor = mysql_query($query_professor, $conexao) or die(mysql_error());
$row_professor = mysql_fetch_assoc($professor);
$totalRows_professor = mysql_num_rows($professor);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Relatório - Lista de presença</title>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
	    <link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
</head>

<body>
<table width="817" border="0" align="center">
  <tr>
    <td width="466"><img src="../img/LOGO_CARRO.png" width="347" height="98" /></td>
    <td width="341" valign="top"><div align="left">Endere&ccedil;o: Rua 03 Qd.05 Casa 36 Cohatrac IV<br />
      telefone: (98) 8800-3198 | 81286981<br />
    email:eneylton@hotmail.com</div></td>
  </tr>
</table>

<table width="817" border="0" align="center">
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td valign="top"><span class="span8">PROFESSOR</span></td>
    <td width="396" valign="top"><span class="span8"><?php echo $row_professor['prof']; ?></span><br />
    <br /></td>
    <td width="318" valign="top"><div align="left">&nbsp;Inicio do curso:&nbsp; <?php 
	   $date = $row_professor['periodo1'];
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?>  Final: &nbsp;<?php $date = $row_professor['periodo2'];
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date; ?></div></td>
  </tr>
  <tr>
    <td width="89" valign="top" bgcolor="#d9d9d9"></td>
    <td colspan="2" valign="top" bgcolor="#d9d9d9"><span class="span6">Nome dos alunos</span></td>
  </tr>
  <?php do { ?>
    <tr>
      <td>&rang;</td>
      <td colspan="2"><span class="span11"><?php echo $row_salas['id_aluno']; ?></span></td>
    </tr>
    <?php } while ($row_salas = mysql_fetch_assoc($salas)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($salas);

mysql_free_result($professor);
?>
</body>
</html>
