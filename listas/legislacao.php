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
  $insertSQL = sprintf("INSERT INTO legislacao (aluno, `data`, hora, hora1, turno, status) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['aluno'], "text"),
                       GetSQLValueString($_POST['data'], "date"),
                       GetSQLValueString($_POST['hora'], "text"),
					   GetSQLValueString($_POST['hora1'], "text"),
                       GetSQLValueString($_POST['turno'], "text"),
					   GetSQLValueString($_POST['status'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

$colname_leg = "-1";
if (isset($_GET['id_aluno'])) {
  $colname_leg = $_GET['id_aluno'];
}
mysql_select_db($database_conexao, $conexao);
$query_leg = sprintf("SELECT * FROM alunos WHERE id_aluno = %s", GetSQLValueString($colname_leg, "int"));
$leg = mysql_query($query_leg, $conexao) or die(mysql_error());
$row_leg = mysql_fetch_assoc($leg);
$totalRows_leg = mysql_num_rows($leg);

mysql_select_db($database_conexao, $conexao);
$query_TURNO = "SELECT * FROM turno";
$TURNO = mysql_query($query_TURNO, $conexao) or die(mysql_error());
$row_TURNO = mysql_fetch_assoc($TURNO);
$totalRows_TURNO = mysql_num_rows($TURNO);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
<title>Gerenciador Auto escola</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <input type="hidden" name="aluno" value="<?php echo $row_leg['nome']; ?>" size="32">
    <input type="hidden" name="status" value="Aguardando resultado..." size="32">
   
    <tr valign="baseline">
      <td nowrap align="right"><div align="left" class="span6">Data:</div></td>
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
        <option value="value">Selecione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_TURNO['desc']?>"><?php echo $row_TURNO['desc']?></option>
        <?php
} while ($row_TURNO = mysql_fetch_assoc($TURNO));
  $rows = mysql_num_rows($TURNO);
  if($rows > 0) {
      mysql_data_seek($TURNO, 0);
	  $row_TURNO = mysql_fetch_assoc($TURNO);
  }
?>
      </select>
      </label>
<input type="hidden" name="status" value="Aguardando resultado..." size="32">
      </td>
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
mysql_free_result($leg);

mysql_free_result($TURNO);
?>

	<?php 
		
			$op="Marcou exame de legislação !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
