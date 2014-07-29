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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE alunos SET nome=%s, endereco=%s, bairro=%s, complemento=%s, municipio=%s, cpf=%s, cnh=%s, val_cnh=%s, renach=%s, telefone=%s, email=%s, aniversario=%s, observacao=%s WHERE id_aluno=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['complemento'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['cnh'], "text"),
                       GetSQLValueString($_POST['val_cnh'], "date"),
                       GetSQLValueString($_POST['renach'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['aniversario'], "date"),
                       GetSQLValueString($_POST['observacao'], "text"),
                       GetSQLValueString($_POST['id_aluno'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_edit = "-1";
if (isset($_GET['id_aluno'])) {
  $colname_edit = $_GET['id_aluno'];
}
mysql_select_db($database_conexao, $conexao);
$query_edit = sprintf("SELECT * FROM alunos WHERE id_aluno = %s", GetSQLValueString($colname_edit, "int"));
$edit = mysql_query($query_edit, $conexao) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Auto escola</title>
</head>

<body onUnload="window.opener.location.reload()">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Nome:</div></td>
      <td><input type="text" name="nome" value="<?php echo htmlentities($row_edit['nome'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Endereco:</div></td>
      <td><input type="text" name="endereco" value="<?php echo htmlentities($row_edit['endereco'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Bairro:</div></td>
      <td><input type="text" name="bairro" value="<?php echo htmlentities($row_edit['bairro'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Complemento:</div></td>
      <td><input type="text" name="complemento" value="<?php echo htmlentities($row_edit['complemento'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <input type="hidden" name="municipio" value="<?php echo htmlentities($row_edit['municipio'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Cpf:</div></td>
      <td><input type="text" name="cpf" value="<?php echo htmlentities($row_edit['cpf'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Cnh:</div></td>
      <td><input type="text" name="cnh" value="<?php echo htmlentities($row_edit['cnh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Val_cnh:</div></td>
      <td><input type="text" name="val_cnh" value="<?php echo htmlentities($row_edit['val_cnh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Renach:</div></td>
      <td><input type="text" name="renach" value="<?php echo htmlentities($row_edit['renach'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Telefone:</div></td>
      <td><input type="text" name="telefone" value="<?php echo htmlentities($row_edit['telefone'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Email:</div></td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_edit['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Aniversario:</div></td>
      <td><input type="text" name="aniversario" value="<?php echo htmlentities($row_edit['aniversario'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Observacao:</div></td>
      <td><input type="text" name="observacao" value="<?php echo htmlentities($row_edit['observacao'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Atualizar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_aluno" value="<?php echo $row_edit['id_aluno']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($edit);
?>

<?php 
			
			$op="Atualizou dados do aluno";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
