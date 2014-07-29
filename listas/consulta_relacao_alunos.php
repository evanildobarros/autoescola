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
	
	mysql_select_db($database_conexao, $conexao);
	$query_instrutor = "SELECT * FROM instrutor";
	$instrutor = mysql_query($query_instrutor, $conexao) or die(mysql_error());
	$row_instrutor = mysql_fetch_assoc($instrutor);
	$totalRows_instrutor = mysql_num_rows($instrutor);
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" href="../css/layout.css" type="text/css">
	<title>Gerenciador Auto Escola</title>
	<style type="text/css">
	<!--
.style2 {color: #FFFFFF}
	-->
	</style>
	</head>
	
	<body><br>
<br>
<br>

	<fieldset><legend>Mapa Instrutor</legend><br>
<br>

    <form name="form1" method="post" action="../Programacao/resultado_instrutor.php">
	<table width="500" border="0" align="center" style="border-collapse:collapse;">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><select name="instrutor" class="input3" id="instrutor">
          <option value="">Selecione </option>
          <?php
do {  
?><option value="<?php echo $row_instrutor['nome']?>"><?php echo $row_instrutor['nome']?></option>
          <?php
} while ($row_instrutor = mysql_fetch_assoc($instrutor));
  $rows = mysql_num_rows($instrutor);
  if($rows > 0) {
      mysql_data_seek($instrutor, 0);
	  $row_instrutor = mysql_fetch_assoc($instrutor);
  }
?>
        </select>
        <input name="button" type="submit" class="botao" id="button" value="Imprimir"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>
	<label></label>
	<label></label>
	</p>
	</form>
    
    </fieldset>
	
	
	
	</body>
	</html>
	<?php
	mysql_free_result($instrutor);
	?>
	
	<?php 
			
			$op="Consultou Relação de Alunos !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>