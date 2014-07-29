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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE movimento SET valor=%s, status=%s, tipo=%s WHERE id_mov=%s",
                       GetSQLValueString($_POST['valor'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['id_mov'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_mov = "-1";
if (isset($_GET['id_mov'])) {
  $colname_mov = $_GET['id_mov'];
}
mysql_select_db($database_conexao, $conexao);
$query_mov = sprintf("SELECT * FROM movimento WHERE id_mov = %s", GetSQLValueString($colname_mov, "int"));
$mov = mysql_query($query_mov, $conexao) or die(mysql_error());
$row_mov = mysql_fetch_assoc($mov);
$totalRows_mov = mysql_num_rows($mov);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Despachante</title>
</head>
<body onUnload="window.opener.location.reload()">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<input type="hidden" name="tipo" value="0" size="32">
<input type="hidden" name="status"  value="1">
  <table align="center"><tr valign="baseline"><td align="right" nowrap="nowrap"><table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Valor:</td>
      <td><input placeHolder="R$" type="text" name="valor" value="<?php echo htmlentities($row_mov['valor'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Baixar" /></td>
    </tr>
  </table></td>
    </tr>
</table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_mov" value="<?php echo $row_mov['id_mov']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($mov);
?>
