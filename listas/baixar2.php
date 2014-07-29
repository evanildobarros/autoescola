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
  $updateSQL = sprintf("UPDATE lc_movimento SET tipo=%s, valor=%s, status=%s, fpagamento=%s, form_pg=%s, form_pg2=%s WHERE id=%s",
                       GetSQLValueString($_POST['tipo'], "int"),
                       GetSQLValueString($_POST['valor'], "double"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['fpagamento'], "text"),
                       GetSQLValueString($_POST['form_pg'], "text"),
                       GetSQLValueString($_POST['form_pg2'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_baixa = "-1";
if (isset($_GET['id'])) {
  $colname_baixa = $_GET['id'];
}
mysql_select_db($database_conexao, $conexao);
$query_baixa = sprintf("SELECT * FROM lc_movimento WHERE id = %s", GetSQLValueString($colname_baixa, "int"));
$baixa = mysql_query($query_baixa, $conexao) or die(mysql_error());
$row_baixa = mysql_fetch_assoc($baixa);
$totalRows_baixa = mysql_num_rows($baixa);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Gerenciador imobiliario</title>
  <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
</head>

<body onUnload="window.opener.location.reload()">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="509" align="center">
    
       
        
      <tr valign="baseline">
        <td colspan="2" align="right" nowrap="nowrap"><div align="left">
          <input type="hidden" name="tipo" value="1" size="32" />
        </div></td>
      </tr>
      <tr valign="baseline">
      <td width="170" align="right" nowrap="nowrap">Forma de Pagamento</td>
      <td width="327"><select name="fpagamento">
<option>Selecione</option>
<?php
$qr1=mysql_query("SELECT * FROM forma_pg");
while ($row5=@mysql_fetch_array($qr1)){
$en = $row5['desc'];

?>
<option value="<?php echo $en; ?>"><?php echo $en; ?></option>
<?php }?>
</select></td>
    </tr>
  
      <input type="hidden" name="status" value="1" size="32" />
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Valor</td>
        <td><input type="text" placeholder="R$" name="valor" value="<?php echo htmlentities($row_baixa['valor'], ENT_COMPAT, 'utf-8'); ?>" size="20" />
        <br />
        <br /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td valign="top"><label>
          <input type="radio" name="form_pg" id="radio" value="Com Juros" />
        Com Juros 
        <input type="radio" checked="checked" name="form_pg" id="radio2" value="Sem Juros" />
        Sem Juros<br />
        <br />
        </label></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="radio" name="form_pg2" id="radio3" value="Com desconto" />
Com desconto
  <input type="radio" name="form_pg2" checked="checked" id="radio4" value="Sem desconto" />
Sem desconto<br />
<br /></td>
      </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="botao" value="Baixar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_baixa['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($baixa);
?>
