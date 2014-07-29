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
		$insertSQL = sprintf("INSERT INTO veiculo (ano_fab, marca_modelo, cor, especie, km_inicial, km_final, manutencao) VALUES (%s, %s, %s, %s, %s, %s, %s)",
			   GetSQLValueString($_POST['ano_fab'], "date"),
			   GetSQLValueString($_POST['marca_modelo'], "text"),
			   GetSQLValueString($_POST['cor'], "text"),
			   GetSQLValueString($_POST['especie'], "text"),
			   GetSQLValueString($_POST['km_inicial'], "text"),
			   GetSQLValueString($_POST['km_final'], "text"),
			   GetSQLValueString($_POST['manutencao'], "date"));
		
		mysql_select_db($database_conexao, $conexao);
		$Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
		}
		
		mysql_select_db($database_conexao, $conexao);
		$query_cor = "SELECT * FROM cor";
		$cor = mysql_query($query_cor, $conexao) or die(mysql_error());
		$row_cor = mysql_fetch_assoc($cor);
		$totalRows_cor = mysql_num_rows($cor);
		
		mysql_select_db($database_conexao, $conexao);
		$query_especie = "SELECT * FROM especie";
		$especie = mysql_query($query_especie, $conexao) or die(mysql_error());
		$row_especie = mysql_fetch_assoc($especie);
		$totalRows_especie = mysql_num_rows($especie);
		?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<link rel="stylesheet" href="../css/layout.css" type="text/css">
	    <link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
		
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Gerenciador Auto escola</title>
		</head>
		
		<body><br>
<br>
<fieldset><legend>Ve&Iacute;culos</legend>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
		<table width="500" align="center">
		<tr valign="baseline">
		<td colspan="2" nowrap class="td2"><br>
		<br></td>
		</tr>
		<tr valign="baseline">
		<td nowrap>Ano de fabricacão:</td>
		<td><input name="ano_fab" type="text" class="input3" value="" size="10"></td>
		</tr>
		<tr valign="baseline">
		<td>Marca/modelo:</td>
		<td><input name="marca_modelo" type="text" class="input3" value="" size="32"></td>
		</tr>
		<tr valign="baseline">
		<td >Especie:</td>
		<td><select name="especie" id="especie">
		<option value="value">Selecione</option>
		<?php
		do {  
		?>
		<option value="<?php echo $row_especie['desc']?>"><?php echo $row_especie['desc']?></option>
		<?php
		} while ($row_especie = mysql_fetch_assoc($especie));
		$rows = mysql_num_rows($especie);
		if($rows > 0) {
		mysql_data_seek($especie, 0);
		$row_especie = mysql_fetch_assoc($especie);
		}
		?>
		</select>      </td>
		</tr>
		<tr valign="baseline">
		<td >Cor:</td>
		<td><select name="cor" id="cor">
		<option value="">Selecione</option>
		<?php
		do {  
		?>
		<option value="<?php echo $row_cor['desc']?>"><?php echo $row_cor['desc']?></option>
		<?php
		} while ($row_cor = mysql_fetch_assoc($cor));
		$rows = mysql_num_rows($cor);
		if($rows > 0) {
		mysql_data_seek($cor, 0);
		$row_cor = mysql_fetch_assoc($cor);
		}
		?>
		</select>      </td>
		</tr>
		<tr valign="baseline">
		<td>Km_inicial:</td>
		<td><input name="km_inicial" type="text" class="input3" value="" size="32"></td>
		</tr>
		<tr valign="baseline">
		<td >Km_final:</td>
		<td><input name="km_final" type="text" class="input3" value="" size="32"></td>
		</tr>
		<tr valign="baseline">
		<td >Primeira Revisão:</td>
		<td><input name="manutencao" type="date" class="input3" value="" size="32"></td>
		</tr>
		<tr valign="baseline">
		<td >&nbsp;</td>
		<td><input type="submit" class="botao" value="Cadastrar"></td>
		</tr>
		</table>
		<input type="hidden" name="MM_insert" value="form1">
		</form>

</fieldset>
		
		
		</body>
		</html>
		<?php
		mysql_free_result($cor);
		
		mysql_free_result($especie);
		?>
