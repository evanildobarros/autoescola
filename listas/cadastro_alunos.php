		<?php require_once('../Connections/conexao.php'); ?><?php
		
		@session_start();
		
		?>
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
		$query_municipio = "SELECT * FROM municipio";
		$municipio = mysql_query($query_municipio, $conexao) or die(mysql_error());
		$row_municipio = mysql_fetch_assoc($municipio);
		$totalRows_municipio = mysql_num_rows($municipio);
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="../css/layout.css" type="text/css">
	     <link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
		<title>Gerenciador Auto Escola</title>
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
		<style type="text/css">
		<!--
		.style1 {color: #FFFFFF}
		-->
		</style>
		</head>
		
		<body><br>
<br>

		
		<fieldset><legend>Cadastro de Alunos</legend>
        <form method="post" name="form1" action="../Programacao/insert_aluno.php">
		<table width="500" align="center" style="border-collapse:collapse;">
		<tr valign="baseline">
		<td colspan="4" align="right" nowrap><div align="left">
		  <input type="hidden" name="login" value="<?php echo $_SESSION['MM_Username']; ?>" size="32">
		<input type="hidden"  name="data" value="<?php echo date("y-m-d"); ?>" size="32">
		
		</div>      </td>
		</tr>
		
		<tr valign="baseline">
		<td width="138" align="left" nowrap><div align="left"><span class="td7"><font color="#666666">Nome:</font></div></td>
		<td colspan="3"><input name="nome" type="text" class="input3" value="" size="50">
		  <br>
		  <br></td>
		</tr>
		<tr valign="baseline">
		  <td height="21" align="right" nowrap><div align="left">Nome do pai</div></td>
		  <td><input name="pai" type="text" class="input3" id="pai" value="" size="32"></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr valign="baseline">
		  <td height="21" align="right" nowrap><div align="left">Nome da M&atilde;e</div></td>
		  <td><input name="mae" type="text" class="input3" id="mae" value="" size="32"></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr valign="baseline">
		<td nowrap align="left"><div align="left"><span class="td7"><font color="#666666">Endereco:</div></td>
		<td width="223"><input name="endereco" type="text" class="input3" value="" size="32"></td>
		<td width="89"><div align="left"><span class="td7"><font color="#666666">Bairro:</div></td>
		<td><input name="bairro" type="text" class="input3" value="" size="20"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="right"><div align="left"><span class="td7"><font color="#666666">Complemento:</div></td>
		<td><input name="complemento" type="text" class="input3" value="" size="32"></td>
		<td><div align="left"><span class="td7"><font color="#666666">Municipio:</div></td>
		<td><select name="municipio" class="input3" id="municipio">
		  
		  <?php
do {  
?><option value="<?php echo $row_municipio['municipio']?>"><?php echo $row_municipio['municipio']?></option>
		  <?php
} while ($row_municipio = mysql_fetch_assoc($municipio));
  $rows = mysql_num_rows($municipio);
  if($rows > 0) {
      mysql_data_seek($municipio, 0);
	  $row_municipio = mysql_fetch_assoc($municipio);
  }
?>
        </select></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="right">&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr valign="baseline">
		  <td nowrap align="right"><div align="left">Rg</div></td>
		  <td><input name="rg" type="text" class="input3" id="rg" onKeyPress="return mascara(event,this,'###.###.###-##');" value="" size="14" maxlength="14"></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr valign="baseline">
		<td nowrap align="right"><div align="left"><span class="td7"><font color="#666666">Cpf:</div></td>
		<td><label>
		  <input name="cpf" type="text" class="input3" onKeyPress="return mascara(event,this,'###.###.###-##');" value="" size="14" maxlength="14">
		</label></td>
		<td><div align="left"><span class="td7"><font color="#666666">Cnh:</div></td>
		<td><input name="cnh" type="text" class="input3" value="" size="14"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="left"><div align="left"><span class="td7"><font color="#666666">Validade cnh:</div></td>
		<td><input name="val_cnh" type="date" class="input3" value="" size="32"></td>
		<td><div align="left"><span class="td7"><font color="#666666">Renach:</div></td>
		<td><input name="renach" type="text" class="input3" value="" size="14"></td>
		</tr>
		<tr valign="baseline">
		<td colspan="4" align="left" nowrap>&nbsp;</td>
		</tr>
		
		
		<tr valign="baseline">
		<td nowrap align="right"><div align="left"><span class="td7"><font color="#666666">Telefone:</div></td>
		<td colspan="3"> <input type="text" name="telefone" value="" onkeypress="return mascara(event,this,'####-####');" size="15" maxlength="12"><font color="#FF0000">exe:  9999-9999</td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="right"><div align="left"><span class="td7"><font color="#666666">Email:</div></td>
		<td><input name="email" type="text" class="input3" value="" size="32"></td>
		<td><div align="left"><span class="td7"><font color="#666666">Anivers&aacute;rio:</div></td>
		<td><input name="aniversario" type="date" class="input3" value="" size="15"></td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="right">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
		</tr>
		<tr valign="baseline">
		<td nowrap align="right"><div align="left"><span class="td7"><font color="#666666">Categoria Pretendida:</div></td>
		<td colspan="3" valign="top"><label></label>
		  
		  <input type="radio" name="observacao" id="radio" value="a">
		  <span class="span6">a</span>
          <input type="radio" name="observacao" id="radio" value="b">
		  <span class="span6">b<bspan>
          <input type="radio" name="observacao" id="radio" value="ab">
		  <span class="span6">ab</span>
          <input type="radio" name="observacao" id="radio" value="Reciclagem a b c d e">
		  <span class="span6">Reciclagem a b c d e</span>          </td>
		</tr>
		<tr valign="baseline">
		  <td nowrap align="right">&nbsp;</td>
		  <td colspan="3">&nbsp;</td>
		  </tr>
		<tr valign="baseline">
		<td nowrap align="right"><div align="left"></div></td>
		<td colspan="3"><input type="submit" class="botao" value="Salvar"></td>
		</tr>
		</table>
		<input type="hidden" name="MM_insert" value="form1">
		</form>
        </fieldset>
		</body>
		</html>
		<?php
		mysql_free_result($municipio);
		?>
