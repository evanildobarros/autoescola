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
			$query_ssala = "SELECT * FROM sala";
			$ssala = mysql_query($query_ssala, $conexao) or die(mysql_error());
			$row_ssala = mysql_fetch_assoc($ssala);
			$totalRows_ssala = mysql_num_rows($ssala);
			?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<link rel="stylesheet" href="../css/layout.css" type="text/css">
	     <link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
			
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Gerenciador Auto Escola</title>
			<style type="text/css">
			<!--
			.style1 {color: #FFFFFF}
			-->
			</style>
			</head>
			
			<body><br />
<br />
<fieldset><legend>Lista de Presen&ccedil;a</legend>
<form id="form1" name="form1" method="post" action="result_presenca.php">
			<table width="500" border="0" align="center" style="border-collapse:collapse;">
			<tr>
			<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr>
			<td width="209" class="td4">Sala de aula</td>
			<td width="281"><select name="sala" class="input3" id="sala">
			<option value="">Selecione uma Sala</option>
			<?php
			do {  
			?>
			<option value="<?php echo $row_ssala['descricao']?>"><?php echo $row_ssala['descricao']?></option>
			<?php
			} while ($row_ssala = mysql_fetch_assoc($ssala));
			$rows = mysql_num_rows($ssala);
			if($rows > 0) {
			mysql_data_seek($ssala, 0);
			$row_ssala = mysql_fetch_assoc($ssala);
			}
			?>
			</select></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td><input name="button" type="submit" class="botao" id="button" value="Pesquisar" /></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			</table>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<label></label>
			<label></label>
			</form>
</fieldset>
			
			

			
			<?php
			mysql_free_result($ssala);
			?>
            
            	<?php 
			
			$op="Imprimiu lista de presença !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
