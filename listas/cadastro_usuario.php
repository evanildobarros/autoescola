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
  $insertSQL = sprintf("INSERT INTO acesso (usuario, senha, nome, email, telefone, filial, chave) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['filial'], "text"),
                       GetSQLValueString($_POST['chave'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_conexao, $conexao);
$query_filial = "SELECT * FROM filias";
$filial = mysql_query($query_filial, $conexao) or die(mysql_error());
$row_filial = mysql_fetch_assoc($filial);
$totalRows_filial = mysql_num_rows($filial);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/layout.css" type="text/css"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Auto escola</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body><br />
<br />


<fieldset><legend>Usu&aacute;rio</legend><br />

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="500" align="center" style="border-collapse:collapse;">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" ><div align="left" >&nbsp;nome do usu&aacute;rio:</div></td>
      <td><input name="nome" type="text" class="input3" value="" size="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">&nbsp; Login:</div></td>
      <td><input name="usuario" type="text" class="input3" value="" size="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">&nbsp; Senha:</div></td>
      <td><input name="senha" type="password" class="input3" value="" size="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">&nbsp; Email:</div></td>
      <td><input name="email" type="text" class="input3" value="" size="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">&nbsp; Telefone:</div></td>
      <td><input name="telefone" type="text" class="input3" value="" size="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">&nbsp; Filial:</div></td>
      <td><label>
        <select name="filial" class="input3" id="filial">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_filial['desc']?>"><?php echo $row_filial['desc']?></option>
          <?php
} while ($row_filial = mysql_fetch_assoc($filial));
  $rows = mysql_num_rows($filial);
  if($rows > 0) {
      mysql_data_seek($filial, 0);
	  $row_filial = mysql_fetch_assoc($filial);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">&nbsp; N&Iacute;vel de Acesso:</div></td>
      <td><label>
        <select name="chave" class="input3" id="chave">
          <option>Selecione</option>
          <option value="1">Administrador</option>
          <option value="2">Gerenciador do sistema</option>
          <option value="3">Atendentes</option>
        </select>
        <br />
        <br />
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="botao" value="Salvar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

</fieldset>
</body>
</html>
<?php
mysql_free_result($filial);
?>
