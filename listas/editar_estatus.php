<?php
			session_start();
	
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
  $updateSQL = sprintf("UPDATE trafego SET status=%s WHERE id=%s",
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_aluno = "-1";
if (isset($_GET['id'])) {
  $colname_aluno = $_GET['id'];
}
mysql_select_db($database_conexao, $conexao);
$query_aluno = sprintf("SELECT * FROM trafego WHERE id = %s", GetSQLValueString($colname_aluno, "int"));
$aluno = mysql_query($query_aluno, $conexao) or die(mysql_error());
$row_aluno = mysql_fetch_assoc($aluno);
$totalRows_aluno = mysql_num_rows($aluno);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Auto Escola</title>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
</style>
</head>
<body onUnload="window.opener.location.reload()">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="334" align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#000000"><div align="left"><br>
          <span class="style2">Situa&ccedil;&atilde;o</span><br>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap class="span6">Situa&ccedil;&atilde;o:</td>
      <td class="span6"><input name="status" type="radio" value="1">
      Aprovado 
        <label>
        <input type="radio" name="status" id="radio" value="2">
      Reprovado<br>
        <br>
        </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" class="botao" value="Salvar"></td>
    </tr>
  </table>
  <br>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_aluno['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($aluno);
?>

<?php 
		
			$op="Cadastrou Situação do aluno!";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
