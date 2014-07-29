<?php

  @session_start();

?>

<?php
require'../Connections/conexao.php'; 

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
$query_muni = "SELECT * FROM municipio";
$muni = mysql_query($query_muni, $conexao) or die(mysql_error());
$row_muni = mysql_fetch_assoc($muni);
$totalRows_muni = mysql_num_rows($muni);
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<title>Gerenciador AutoEscola</title>
<script type="text/javascript">
		function maskIt(w,e,m,r,a){
        
        // Cancela se o evento for Backspace
        if (!e) var e = window.event
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        
        // Variáveis da função
        var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre  = (a ) ? a.pre : "";
        var pos  = (a ) ? a.pos : "";
        var ret  = "";

        if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;

        // Loop na máscara para aplicar os caracteres
        for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
                if(mask.charAt(x)!='#'){
                        ret += mask.charAt(x); x++;
                } else{
                        ret += txt.charAt(y); y++; x++;
                }
        }
        
        // Retorno da função
        ret = (!r) ? ret : ret.reverse()        
        w.value = pre+ret+pos;
}

// Novo método para o objeto 'String'
String.prototype.reverse = function(){
        return this.split('').reverse().join('');
};
		</script>
<script>
			function alterna(tipo) {
			
			if (tipo == 1) {
			document.getElementById("tipo1").style.display = "block";
			document.getElementById("tipo2").style.display = "none";
			} else {
			document.getElementById("tipo1").style.display = "none";
			document.getElementById("tipo2").style.display = "block";
			}
			
			}
</script>
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

<form method="post" name="form1" action="../programacao/insert_cliente.php">
  <fieldset style="border-radius: 4px; min-height:150px;">
  <legend>Cadastro de Clientes</legend>
  <table width="824" align="center">
  
      <input type="hidden" name="data" value="<?php echo date("Y-m-d"); ?>" size="32">
      <input type="hidden" name="login" value="<?php echo $_SESSION['MM_Username']; ?>" size="32">
      <tr valign="baseline">
        <td colspan="4" align="right" nowrap>&nbsp;</td>
      </tr>
     <tr valign="baseline">
      <td width="135" align="left" nowrap><span class="span5">Cliente:</span></td>
      <td width="331"><input type="text" name="cliente" value="" size="40"></td>
      <td width="121"><span class="span5">Apelido:</span></td>
      <td width="217"><input type="text" name="apelido" value="" size="15"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="left"><span class="span5">Endere&ccedil;o:</span></td>
      <td><input type="text" name="endereco" value="" size="32"></td>
      <td><span class="span5">Bairro:</span></td>
      <td><input type="text" name="bairro" value="" size="15"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="left"><span class="span5">Municipio:</span></td>
      <td><label>
        <select name="municipio" id="municipio">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_muni['municipio']?>"><?php echo $row_muni['municipio']?></option>
          <?php
} while ($row_muni = mysql_fetch_assoc($muni));
  $rows = mysql_num_rows($muni);
  if($rows > 0) {
      mysql_data_seek($muni, 0);
	  $row_muni = mysql_fetch_assoc($muni);
  }
?>
        </select>
      </label></td>
      <td><span class="span5">Ponto Refer&ecirc;ncia:</span></td>
      <td><input type="text" name="local" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="left"><span class="span5">Selecione</span></td>
      <td><div align="left">
<span class="span5">CPF&nbsp;</span>	
<input type="radio" name="tipo" value="1" onClick="alterna(this.value);" />
<span class="span5">CNPJ&nbsp;</span>
<input type="radio" name="tipo" value="2" onClick="alterna(this.value);" /></td>
      <td><span class="span5">CPF Procurador:</span></td>
      <td><input type="text" name="cpf_procu" onkeyup="maskIt(this,event,'###.###.###-##')" /></td>
    </tr>
  
    <tr valign="baseline">
      <td align="right" nowrap>&nbsp;</td>
      <td colspan="3">
              <div id="tipo1" style="display:none;">
			  <input name="cpf_titular" type="text" onkeypress="return mascara(event,this,'###.###.###-##');" value="" size="14" maxlength="14">
			  </div>
        <div id="tipo2" style="display:none;">
			  <input name="cnpj" type="text" onkeypress="return mascara(event,this,'##.###.###/####-##');" value="" size="18" maxlength="18">
	    </div></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="left"><span class="span5">N&ordm; da Procura&ccedil;&atilde;o:</span></td>
      <td colspan="3"><input type="text" name="procuracao" value="" size="15"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="left"><span class="span5">Telefone:</span></td>
      <td> <input type="text" name="telefone" onkeyup="maskIt(this,event,'(##)####-####')" /></td>
      <td><span class="span5">Email:</span></td>
      <td><input type="text" name="email" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="left"><span class="span5">Data de Anivers&aacute;rio:</span></td>
      <td colspan="3"><input class="span5" type="date" name="aniversario" value="" size="32">
                      <input class="input" type="hidden" value="Aguardando..." name="status2">
			          <input class="input" type="hidden" value="Ligar para o cliente" size="32" name="status" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="right" nowrap>&nbsp;</td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input class="botao" type="submit" value="Cadastrar"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
  
  
  </fieldset>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($muni);
?>
