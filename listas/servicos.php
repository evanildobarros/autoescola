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
		
		$colname_cliente = "-1";
		if (isset($_GET['id_aluno'])) {
		$colname_cliente = $_GET['id_aluno'];
		}
		mysql_select_db($database_conexao, $conexao);
		$query_cliente = sprintf("SELECT * FROM alunos WHERE id_aluno = %s", GetSQLValueString($colname_cliente, "int"));
		$cliente = mysql_query($query_cliente, $conexao) or die(mysql_error());
		$row_cliente = mysql_fetch_assoc($cliente);
		$totalRows_cliente = mysql_num_rows($cliente);
		
		mysql_select_db($database_conexao, $conexao);
$query_forma_pagamento = "SELECT * FROM forma_pg";
$forma_pagamento = mysql_query($query_forma_pagamento, $conexao) or die(mysql_error());
$row_forma_pagamento = mysql_fetch_assoc($forma_pagamento);
$totalRows_forma_pagamento = mysql_num_rows($forma_pagamento);
		
		@session_start();
		
		$data2 = date("Y-m-d");
		?>
		<?php
		$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Mar�o", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
		$diasdasemana = array (1 => "Segunda-Feira",2 => "Ter�a-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "S�bado",0 => "Domingo");
		$hoje = getdate();
		$dia = $hoje["mday"];
		$mes = $hoje["mon"];
		$nomemes = $meses[$mes];
		$ano = $hoje["year"];
		$diadasemana = $hoje["wday"];
		$nomediadasemana = $diasdasemana[$diadasemana];
		
		?>
		
		
		
		<html>
		<head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
		<link rel="stylesheet" href="../css/layout.css" type="text/css">
		<title>Gerenciador Auto Escola</title>
		<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #009933}
-->
        </style>
		</head>
		<body><br>
		<br>
		
		<form action="servicos_result.php" method='POST'>
		<fieldset>
		<legend>Registrar Servi&ccedil;os</legend>
		
		<table width="907" border="0" align="center">
		<tr>
		<td colspan="6">&nbsp;</td>
		<td width="119">
        <?php $nome_post = $_POST['nome']; ?>
        <input name='id_cliente' type="hidden" size="50" id="id_cliente" value="<?php echo $_SESSION['MM_Username']; ?>" >
		<input name='cliente' type="hidden" size="50" id="cliente" value="<?php echo $row_cliente['nome']; ?>" >
		<input name='data' type="hidden" size="50" id="data" value="<?php echo $data2; ?>" >
		
		<input type="hidden" name="mes" value="<?php echo $nomemes; ?>"></td>
		<td width="1">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="4" valign="top"><input type="checkbox" name="id_servico[]" value="1" />
		<label for="checkbox"><span class="span5">1 HABILITA&Ccedil;&Atilde;O CAT. A  - <span class="span8">R$ 600,00 no Cart&atilde;o ate 4x</span></span></label>
		<br>
		<input type="checkbox" name="id_servico[]2" value="27" />
        <label for="checkbox"><span class="span5">1 HABILITA&Ccedil;&Atilde;O CAT. A  - <span class="span8">R$ 550,00  &Aacute; v&iacute;sta </span>
         <span class="style2"><strong>(Promo&ccedil&atilde;o R$ 500,00)</strong></span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]3" value="3" />
        <label for="checkbox"><span class="span5">1 HABILITA&Ccedil;&Atilde;O CAT. B  - <span class="span8">R$ 800,00 no Cart&atilde;o ate 4x</span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]4" value="28" />
        <label for="checkbox"><span class="span5">1 HABILITA&Ccedil;&Atilde;O CAT. B  - <span class="span8">R$ 750,00 &Aacute; vista </span> <span class="style2"><strong>(Promo&ccedil&atilde;o R$ 680,00)</strong></span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]5" value="2" />
        <label for="checkbox"><span class="span5">1 HABILITA&Ccedil;&Atilde;O CAT. AB  - <span class="span8">R$ 1100,00 no Cart&atilde;o ate 4x</span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]6" value="29" />
        <label for="checkbox"><span class="span5">1 HABILITA&Ccedil;&Atilde;O CAT. AB  - <span class="span8">R$ 1000,00  &Aacute; vista </span> <span class="style2"><strong>(Promo&ccedil&atilde;o R$ 950,00)</strong></span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]7" value="4" />
        <label for="checkbox"><span class="span5">ADI&Ccedil;&Atilde;O CAT. A  - <span class="span8">R$ 450,00 no Cart&atilde;o ate 4x</span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]8" value="30" />
        <label for="checkbox"><span class="span5">ADI&Ccedil;&Atilde;O CAT. A  - <span class="span8">R$ 400,00  &Aacute; vista</span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]9" value="5" />
        <label for="checkbox"><span class="span5">ADI&Ccedil;&Atilde;O CAT. B  - <span class="span8">R$ 600,00 no Cart&atilde;o ate 4x</span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]9" value="31" />
        <label for="checkbox"><span class="span5">ADI&Ccedil;&Atilde;O CAT. B  - <span class="span8">R$ 500,00  &Aacute; vista R$ 550,00 </span><span class="style2"><strong>(Promo&ccedil&atilde;o R$ 500,00)</strong></span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]10" value="31" />
        <label for="checkbox"><span class="span5">ADI&Ccedil;&Atilde;O CAT. D  - <span class="span8">R$ 700,00 no Cart&atilde;o ate 4x</span></span></label>
        <br>
        <input type="checkbox" name="id_servico[]10" value="35" />
        <label for="checkbox"><span class="span5">ADI&Ccedil;&Atilde;O CAT. D  - <span class="span8">R$ 580,00  &Aacute; vista R$ 650,00 </span><span class="style2"><strong>(Promo&ccedil&atilde;o R$ 580,00)</strong></span></span></label>
<br>
        </strong></span></span></label>        <br />
		<br>
		<td colspan="4" valign="top"><input type="checkbox" name="id_servico[]11" value="36" />
          <label for="checkbox"><span class="span5">Aula extra Moto  - <span class="span8">R$ 20,00 </span></span></label>
          <br>
          <input type="checkbox" name="id_servico[]12" value="37" />
          <label for="checkbox"><span class="span5">Aula extra Carro  - <span class="span8">R$ 35,00 </span></span></label>
          <br>
          <input type="checkbox" name="id_servico[]13" value="38" />
          <label for="checkbox"><span class="span5">Aula extra &Ocirc;nibus  - <span class="span8">R$ 70,00 </span></span></label>
          <br>
          <input type="checkbox" name="id_servico[]14" value="39" />
          <label for="checkbox"><span class="span5">Aluguel Moto - <span class="span8">R$ 50,00 </span></span></label>
          <br>
          <input type="checkbox" name="id_servico[]15" value="40" />
          <label for="checkbox"><span class="span5">Aluguel Carro - <span class="span8">R$ 70,00</span></span></label>
          <br>
          <input type="checkbox" name="id_servico[]16" value="41" />
          <label for="checkbox"><span class="span5">Aluguel &Ocirc;nibus - <span class="span8">R$ 120,00</span></span></label>
          <br>
          <input type="checkbox" name="id_servico[]17" value="42" />
          <label for="checkbox"><span class="span5">Curso de Infrator - <span class="span8">R$ 100,00</span></span></label>
          <br>
          <input type="checkbox" name="id_servico[]18" value="43" />
          <label for="checkbox"><span class="span5">Curso de Renova&ccedil&atilde;o - <span class="span8">R$ 100,00</span></span></label>
<br>
		  <br>          </tr>
		<tr>
		<td colspan="9">&nbsp;    <input class="input radius" name='cat' type='hidden' size="15" id="cat" value="1"  >		</tr>
		<tr>
		<td width="151"><span class="span5">Valor a ser pago</span>   
		<td width="180"><input class="input radius" name='valor' type='text' size="15" id="valor" placeholder="R$" >
		<td width="180"><span class="span5 style1">Valor parcelado</span>        
		<td colspan="4">
		  <input class="input2" name='valor2' type='text' size="15" id="valor2" placeholder="R$" >		</tr>
		<tr>
		<td><span class="span5">Vencimento</span>
		<td colspan="6"><input name="venci" type="date" class="span5" id="venci" value="" size="15">
		  <span class="style1">* </span>		  </tr>
		<tr>
		  <td colspan="7"><br><hr />    		  </tr>
		<tr>
		<td><span class="span5">Forma de Pagamento </span>   
		<td><label>
		<select name="f_pagamento" id="categoria">
		  <option value="Selecione"></option>
		  <?php
do {  
?>
		  <option value="<?php echo $row_forma_pagamento['desc']?>"><?php echo $row_forma_pagamento['desc']?></option>
		  <?php
} while ($row_forma_pagamento = mysql_fetch_assoc($forma_pagamento));
  $rows = mysql_num_rows($forma_pagamento);
  if($rows > 0) {
      mysql_data_seek($forma_pagamento, 0);
	  $row_forma_pagamento = mysql_fetch_assoc($forma_pagamento);
  }
?>
	    </select>
		</label>
        <td colspan="5">        
        <input checked type="radio" name="tipo" id="tipo" value="1">
		<span class="span5">Receita</span>
		<input type="radio" name="tipo" id="tipo2" value="1">
		<span class="span5 style1">Aguardando pagamento da parcela</span></tr>
		<tr>
		<td colspan="7">&nbsp;  	    </tr> <input type="hidden" name="forma_pagamento" value="1">
		<tr>
		<td><span class="span5">Situa&ccedil;&atilde;o</span>  
		<td colspan="8"><input class="input radius" checked type="radio" name="status" id="status" value="1">
		<span class="span5">Pago</span>
		<input class="input radius" type="radio" name="status" id="status" value="2">
       	
        <span class="span5"> Em aberto </span></td>
		</tr>
		<tr>
		<td>  
		<td colspan="8">&nbsp;</td>
		</tr>
		<tr>
		<td valign="top"><span class="span5">Observa&ccedil;&atilde;o </span>   
		<td colspan="2" valign="top"><textarea class="span6" name="descricao" id="descricao" cols="50" rows="5"></textarea></td>
		<td width="39" valign="top">&nbsp;</td>
		<td width="129" valign="top"><input class="botao" type='submit' value='Registrar' name='bt'></td>
		<td width="55" valign="top">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td width="15" valign="top">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="9" valign="top">  
	      <div align="right"></div>		</tr>
		</table>
		</fieldset>
		
	
	
		</td>
		
		</form>
		
		
		
		</body>
		</html>
		<?php
		@mysql_free_result($cliente);
		
		@mysql_free_result($forma_pagamento);
		?>
