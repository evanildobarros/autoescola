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
  $updateSQL = sprintf("UPDATE veiculo SET ano_fab=%s, marca_modelo=%s, cor=%s, especie=%s, km_inicial=%s, km_final=%s, manutencao=%s WHERE id_veiculo=%s",
                       GetSQLValueString($_POST['ano_fab'], "text"),
                       GetSQLValueString($_POST['marca_modelo'], "text"),
                       GetSQLValueString($_POST['cor'], "text"),
                       GetSQLValueString($_POST['especie'], "text"),
                       GetSQLValueString($_POST['km_inicial'], "text"),
                       GetSQLValueString($_POST['km_final'], "text"),
                       GetSQLValueString($_POST['manutencao'], "date"),
                       GetSQLValueString($_POST['id_veiculo'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_editar = "-1";
if (isset($_GET['id_veiculo'])) {
  $colname_editar = $_GET['id_veiculo'];
}
mysql_select_db($database_conexao, $conexao);
$query_editar = sprintf("SELECT * FROM veiculo WHERE id_veiculo = %s", GetSQLValueString($colname_editar, "int"));
$editar = mysql_query($query_editar, $conexao) or die(mysql_error());
$row_editar = mysql_fetch_assoc($editar);
$totalRows_editar = mysql_num_rows($editar);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador de Auto Escola</title>
</head>

<body onUnload="window.opener.location.reload()">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ano de Fabricação:</td>
      <td><input type="text" name="ano_fab" value="<?php echo htmlentities($row_editar['ano_fab'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Marca modelo:</td>
      <td><input type="text" name="marca_modelo" value="<?php echo htmlentities($row_editar['marca_modelo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cor:</td>
      <td><input type="text" name="cor" value="<?php echo htmlentities($row_editar['cor'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Especie:</td>
      <td><input type="text" name="especie" value="<?php echo htmlentities($row_editar['especie'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Km inicial:</td>
      <td><input type="text" name="km_inicial" value="<?php echo htmlentities($row_editar['km_inicial'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Km final:</td>
      <td><input type="text" name="km_final" value="<?php echo htmlentities($row_editar['km_final'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Manutenção:</td>
      <td><input type="text" name="manutencao" value="<?php echo htmlentities($row_editar['manutencao'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Atualisar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_veiculo" value="<?php echo $row_editar['id_veiculo']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($editar);
?>
