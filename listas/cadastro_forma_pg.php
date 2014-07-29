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
		$insertSQL = sprintf("INSERT INTO f_pagamento (`desc`) VALUES (%s)",
		   GetSQLValueString($_POST['desc'], "text"));
		
		mysql_select_db($database_conexao, $conexao);
		$Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
		}
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/layout.css" type="text/css">
	    <link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
		<title>Gerenciador Auto Escola</title>
		<style type="text/css">
		<!--
		.style1 {color: #FFFFFF}
		-->
		</style>
		</head>
		
		<body><br />
<br />
<fieldset><legend>Forma de Pagamento</legend>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
		<table align="center" style="border-collapse:collapse;" width="500">
		<tr valign="baseline">
		  <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
		</tr>
		<tr valign="baseline">
		<td nowrap="nowrap" align="right">&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
		<tr valign="baseline">
		<td nowrap="nowrap" align="right">Forma de Pagamento:</td>
		<td><input name="desc" type="text" class="input3" value="" size="32" /></td>
		</tr>
		<tr valign="baseline">
		<td nowrap="nowrap" align="right">&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
		<tr valign="baseline">
		<td nowrap="nowrap" align="right">&nbsp;</td>
		<td><input type="submit" class="bt4" value="Cadastrar" /></td>
		</tr>
		</table>
		<input type="hidden" name="MM_insert" value="form1" />
		</form>
</fieldset>

		
	
		</body>
		</html>
