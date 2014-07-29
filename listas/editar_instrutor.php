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
  $updateSQL = sprintf("UPDATE instrutor SET `data`=%s, nome=%s, apelido=%s, endereco=%s, bairro=%s, complemento=%s, municipio=%s, cpf=%s, cnh=%s, val_cnh=%s, renach=%s, telefone=%s, email=%s, apto=%s, aniversario=%s, observacao=%s WHERE id_instrutor=%s",
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['apelido'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['complemento'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['cnh'], "text"),
                       GetSQLValueString($_POST['val_cnh'], "text"),
                       GetSQLValueString($_POST['renach'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['apto'], "text"),
                       GetSQLValueString($_POST['aniversario'], "text"),
                       GetSQLValueString($_POST['observacao'], "text"),
                       GetSQLValueString($_POST['id_instrutor'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_editar = "-1";
if (isset($_GET['id_instrutor'])) {
  $colname_editar = $_GET['id_instrutor'];
}
mysql_select_db($database_conexao, $conexao);
$query_editar = sprintf("SELECT * FROM instrutor WHERE id_instrutor = %s", GetSQLValueString($colname_editar, "int"));
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
      <td nowrap="nowrap" align="right"><div align="left">Data:</div></td>
      <td><input type="text" name="data" value="<?php echo htmlentities($row_editar['data'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Nome:</div></td>
      <td><input type="text" name="nome" value="<?php echo htmlentities($row_editar['nome'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Apelido:</div></td>
      <td><input type="text" name="apelido" value="<?php echo htmlentities($row_editar['apelido'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Endereco:</div></td>
      <td><input type="text" name="endereco" value="<?php echo htmlentities($row_editar['endereco'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Bairro:</div></td>
      <td><input type="text" name="bairro" value="<?php echo htmlentities($row_editar['bairro'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Complemento:</div></td>
      <td><input type="text" name="complemento" value="<?php echo htmlentities($row_editar['complemento'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Municipio:</div></td>
      <td><input type="text" name="municipio" value="<?php echo htmlentities($row_editar['municipio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Cpf:</div></td>
      <td><input type="text" name="cpf" value="<?php echo htmlentities($row_editar['cpf'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Cnh:</div></td>
      <td><input type="text" name="cnh" value="<?php echo htmlentities($row_editar['cnh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Val_cnh:</div></td>
      <td><input type="text" name="val_cnh" value="<?php echo htmlentities($row_editar['val_cnh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Renach:</div></td>
      <td><input type="text" name="renach" value="<?php echo htmlentities($row_editar['renach'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Telefone:</div></td>
      <td><input type="text" name="telefone" value="<?php echo htmlentities($row_editar['telefone'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Email:</div></td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_editar['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Apto:</div></td>
      <td><input type="text" name="apto" value="<?php echo htmlentities($row_editar['apto'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Aniversario:</div></td>
      <td><input type="text" name="aniversario" value="<?php echo htmlentities($row_editar['aniversario'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Observacao:</div></td>
      <td><input type="text" name="observacao" value="<?php echo htmlentities($row_editar['observacao'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"></div></td>
      <td><input type="submit" value="Atualisar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_instrutor" value="<?php echo $row_editar['id_instrutor']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($editar);
?>
