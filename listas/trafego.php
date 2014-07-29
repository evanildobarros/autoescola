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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO trafego (aluno, `data`, hora, hora1, turno) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['aluno'], "text"),
                       GetSQLValueString($_POST['data'], "date"),
                       GetSQLValueString($_POST['hora'], "text"),
					   GetSQLValueString($_POST['hora1'], "text"),
                       GetSQLValueString($_POST['turno'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

$colname_trafego = "-1";
if (isset($_GET['id_aluno'])) {
  $colname_trafego = $_GET['id_aluno'];
}
mysql_select_db($database_conexao, $conexao);
$query_trafego = sprintf("SELECT * FROM alunos WHERE id_aluno = %s", GetSQLValueString($colname_trafego, "int"));
$trafego = mysql_query($query_trafego, $conexao) or die(mysql_error());
$row_trafego = mysql_fetch_assoc($trafego);
$totalRows_trafego = mysql_num_rows($trafego);

mysql_select_db($database_conexao, $conexao);
$query_turno = "SELECT * FROM turno";
$turno = mysql_query($query_turno, $conexao) or die(mysql_error());
$row_turno = mysql_fetch_assoc($turno);
$totalRows_turno = mysql_num_rows($turno);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Auto Escola</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <input type="hidden" name="aluno" value="<?php echo $row_trafego['nome']; ?>" size="32">
    <input type="hidden" name="status" value="Aguardando resultado..." size="32">
  
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">Data:</div></td>
      <td><input type="date" name="data" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">Hora inicio:</div></td>
      <td><input type="time" name="hora" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">Hora fim:</div></td>
      <td><input type="time" name="hora1" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">Turno:</div></td>
      <td><label>
        <select name="turno" id="turno">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_turno['desc']?>"><?php echo $row_turno['desc']?></option>
          <?php
} while ($row_turno = mysql_fetch_assoc($turno));
  $rows = mysql_num_rows($turno);
  if($rows > 0) {
      mysql_data_seek($turno, 0);
	  $row_turno = mysql_fetch_assoc($turno);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" class="bt4" value="Marcar"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($trafego);

mysql_free_result($turno);
?>
