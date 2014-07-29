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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM calendar_events WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($deleteSQL, $conexao) or die(mysql_error());
  
  
}

$colname_exacluir = "-1";
if (isset($_GET['id'])) {
  $colname_exacluir = $_GET['id'];
}
mysql_select_db($database_conexao, $conexao);
$query_exacluir = sprintf("SELECT * FROM calendar_events WHERE id = %s", GetSQLValueString($colname_exacluir, "int"));
$exacluir = mysql_query($query_exacluir, $conexao) or die(mysql_error());
$row_exacluir = mysql_fetch_assoc($exacluir);
$totalRows_exacluir = mysql_num_rows($exacluir);

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="../css/layout.css" type="text/css" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador AutoEscola</title>
<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
</head>

<body onUnload="window.opener.location.reload()">

<form name="form1" method="post" action="">
<br>
<table width="224" border="1" align="center" style="border-collapse:collapse;">

    <tr>
      <td width="405" bgcolor="#666666"><div align="center" class="span">
        <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>">
        CANCELAR RESERVA</div></td>
    </tr>

   
    <tr>
      <td><label>
        <div align="center">
          <input name="button" type="submit" class="botao" id="button" value="Sim">
          <input name="button2" type="button" class="botao" id="button2" onClick="MM_callJS('close();')" value="N&atilde;o">
        </div>
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($exacluir);
?>
