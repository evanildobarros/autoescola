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
		$query_munic = "SELECT * FROM municipio";
		$munic = mysql_query($query_munic, $conexao) or die(mysql_error());
		$row_munic = mysql_fetch_assoc($munic);
		$totalRows_munic = mysql_num_rows($munic);
		?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Gerenciador Auto Escola</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="../css/layout.css" type="text/css">
	     <link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
		<style type="text/css">
		<!--
		.style1 {color: #FFFFFF}
		-->
		</style>
		<script type="text/javascript">
		function mascara(e,src,mask) {
		if(window.event) { 
		_TXT = e.keyCode; 
		} else 
		if(e.which) { 
		_TXT = e.which; 
		}
		if(_TXT > 47 && _TXT < 58) {
		var i = src.value.length; 
		var saida = mask.substring(0,1); 
		var texto = mask.substring(i);
		if(texto.substring(0,1) != saida) { 
		src.value += texto.substring(0,1); 
		}
		return true; 
		} else { 
		if (_TXT != 8) { 
		return false; 
		} else { 
		return true; 
		}
		}
		}
		</script>
		</head>
		
		<body><br>
<br>
<fieldset><legend>Instrutor</legend>
<form method="post" name="form1" action="../Programacao/insert_instrutor.php">
		<table width="500" align="center" style=" border-collapse:collapse;">
		<tr valign="baseline">
		<td colspan="4" align="right" nowrap><span class="td7"><font color="#666666">        
		  <input type="hidden" name="aluno" value="" size="32">		  <span class="td7"><font color="#666666">		  <input type="hidden" name="data" value="<?php echo date("Y-m-d"); ?>" size="32"></td>
		</tr>
		
		
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7"><font color="#666666">Nome:</div></td>
		<td><input name="nome" type="text" class="input3" value="" size="32"></td>
		<td><font color="#666666">Apelido:
		  </div></td>
		<td><input name="apelido" type="text" class="input3" value="" size="10"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7"><font color="#666666">Endereco:
		  </div></td>
		<td><input name="endereco" type="text" class="input3" value="" size="32"></td>
		<td><span class="td7"><font color="#666666">Bairro:
		  </div></td>
		<td><input name="bairro" type="text" class="input3" value="" size="10"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7">Complemento:
		  </div></td>
		<td><input name="complemento" type="text" class="input3" value="" size="32"></td>
		<td>Municipio:
		  </div></td>
		<td><select name="municipio" class="input3" id="municipio">
          <option value="">Selecione</option>
          <?php
		do {  
		?>
          <option value="<?php echo $row_munic['municipio']?>"><?php echo $row_munic['municipio']?></option>
          <?php
		} while ($row_munic = mysql_fetch_assoc($munic));
		$rows = mysql_num_rows($munic);
		if($rows > 0) {
		mysql_data_seek($munic, 0);
		$row_munic = mysql_fetch_assoc($munic);
		}
		?>
        </select></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><font color="#666666">Cpf:
		  </div></td>
		<td><input name="cpf" type="text" class="input3" onKeyPress="return mascara(event,this,'###.###.###-##');" value="" size="14" maxlength="14"></td>
		<td><font color="#666666">Cnh:
		  </div></td>
		<td><input name="cnh" type="text" class="input3" value="" size="10"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7"><font color="#666666"><font color="#666666">Renach:
		  </div></td>
		<td><input name="renach" type="text" class="input3" value="" size="14"></td>
		<td>Validade cnh:
		  </div></td>
		<td><input name="val_cnh" type="date" class="input3" value="" size="32"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7"><font color="#666666">Telefone:
		  </div></td>
		<td><label>
		  <input type="text" name="telefone" value="" onKeyPress="return mascara(event,this,'## ####-####');" size="15" maxlength="12">
		</label></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7">Email:
		  </div></td>
		<td colspan="3"><input name="email" type="text" class="input3" value="" size="32"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7">Apto Categoria:</td>
		<td colspan="3"><input name="apto" type="radio" value="a">
		  A
            <input name="apto" type="radio" value="b">
            B
            <input name="apto" type="radio" value="c">
            C
            <input name="apto" type="radio" value="d">
            D
            <input name="apto" type="radio" value="e">
          E 
          <input name="apto" type="radio" value="AD">
          A
D 
          <input name="apto" type="radio" value="AE">
          AE
<br>
          <br></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><span class="td7"><font color="#666666"><font color="#666666">Aniversario:
		  </div></td>
		<td colspan="3"><input name="aniversario" type="date" class="input3" value="" size="32"></td>
		</tr>
		<tr valign="baseline">
		<td align="left" valign="top" nowrap><span class="td7">Observacao:
		  </div></td>
		<td colspan="3"><textarea class="textarea" name="observacao" cols="" rows=""></textarea>
		  <br></td>
		
		
		<tr valign="baseline">
		<td nowrap align="left"><div align="left"></div></td>
		<td colspan="3"><input type="submit" class="botao" value="Salvar"></td>
		</tr>
		</table>
<input type="hidden" name="MM_insert" value="form1">
		</form>
</fieldset>
		
	
		</body>
		</html>
		<?php
		mysql_free_result($munic);
		?>
