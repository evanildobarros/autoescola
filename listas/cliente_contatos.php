<?php
session_start();
require'../Connections/conexao.php';
?>

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE cliente SET status2=%s WHERE id_cliente=%s",
                       GetSQLValueString($_POST['status2'], "text"),
                       GetSQLValueString($_POST['id_cliente'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_contatios = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_contatios = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_contatios = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_contatios, "int"));
$contatios = mysql_query($query_contatios, $conexao) or die(mysql_error());
$row_contatios = mysql_fetch_assoc($contatios);
$totalRows_contatios = mysql_num_rows($contatios);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador despachante</title>
<link rel="stylesheet" type="text/css" href="css/venci.css" />
<link rel="stylesheet" type="text/css" href="classes.css" />
<style type="text/css">
<!--
body {
	background-image: url(img/pat_03.png);
}
-->
</style></head>

<body onUnload="window.opener.location.reload()">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Situação</strong>:</td>
      <td>
<input name="status2" type="radio" value="Entregue" /> Entregue<br />
<input name="status2" type="radio" value="Pendente" /> Pendente<br />
<input name="status2" type="radio" value="Cancelado" /> Cancelado<br />
<br /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="bt2" type="submit" value="Atualizar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_cliente" value="<?php echo $row_contatios['id_cliente']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($contatios);
?>

    
    <?php 
	
$op="Atualizou estatus do Contato !";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
	?>