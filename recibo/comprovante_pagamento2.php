<?php
            if (!isset($_SESSION)) {
            @session_start();
            }
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
<?php require_once('../Connections/conexao.php'); 


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

$colname_mov = "-1";
if (isset($_GET['id_mov'])) {
  $colname_mov = $_GET['id_mov'];
}
mysql_select_db($database_conexao, $conexao);
$query_mov = sprintf("SELECT * FROM movimento WHERE id_mov = %s", GetSQLValueString($colname_mov, "int"));
$mov = mysql_query($query_mov, $conexao) or die(mysql_error());
$row_mov = mysql_fetch_assoc($mov);
$totalRows_mov = mysql_num_rows($mov);

$colname_aluno = "-1";
if (isset($_GET['id_mov'])) {
  $colname_aluno = $_GET['id_mov'];
}
mysql_select_db($database_conexao, $conexao);
$query_aluno = sprintf("select * from movimento as mov,alunos as al where mov.cliente = al.nome and  mov.id_mov = %s", GetSQLValueString($colname_aluno, "int"));
$aluno = mysql_query($query_aluno, $conexao) or die(mysql_error());
$row_aluno = mysql_fetch_assoc($aluno);
$totalRows_aluno = mysql_num_rows($aluno);

$colname_servico = "-1";
if (isset($_GET['id_mov'])) {
  $colname_servico = $_GET['id_mov'];
}
mysql_select_db($database_conexao, $conexao);
$query_servico = sprintf("SELECT * FROM movimento as mov, serv as sv WHERE mov. id_mov = %s AND mov.id_cliente = sv.id_cliente ", GetSQLValueString($colname_servico, "int"));
$servico = mysql_query($query_servico, $conexao) or die(mysql_error());
$row_servico = mysql_fetch_assoc($servico);
$totalRows_servico = mysql_num_rows($servico);

$val = $row_mov['valor'];

$ser = $row_servico['id_servico'];


 
/**
 * Retorna uma string do numero
 * 
 * @param string $n - Valor a ser traduzido,  apenas numeros inteiros
 * @example numeroEscrito('500');
 * @return string 
 */
function numeroEscrito($n) {
 
    $numeros[1][0] = '';
    $numeros[1][1] = 'um';
    $numeros[1][2] = 'dois';
    $numeros[1][3] = 'tr�s';
    $numeros[1][4] = 'quatro';
    $numeros[1][5] = 'cinco';
    $numeros[1][6] = 'seis';
    $numeros[1][7] = 'sete';
    $numeros[1][8] = 'oito';
    $numeros[1][9] = 'nove';
 
    $numeros[2][0] = '';
    $numeros[2][10] = 'dez';
    $numeros[2][11] = 'onze';
    $numeros[2][12] = 'doze';
    $numeros[2][13] = 'treze';
    $numeros[2][14] = 'quatorze';
    $numeros[2][15] = 'quinze';
    $numeros[2][16] = 'dezesseis';
    $numeros[2][17] = 'dezesete';
    $numeros[2][18] = 'dezoito';
    $numeros[2][19] = 'dezenove';
    $numeros[2][2] = 'vinte';
    $numeros[2][3] = 'trinta';
    $numeros[2][4] = 'quarenta';
    $numeros[2][5] = 'cinquenta';
    $numeros[2][6] = 'sessenta';
    $numeros[2][7] = 'setenta';
    $numeros[2][8] = 'oitenta';
    $numeros[2][9] = 'noventa';
 
    $numeros[3][0] = '';
    $numeros[3][1] = 'cem';
    $numeros[3][2] = 'duzentos';
    $numeros[3][3] = 'trezentos';
    $numeros[3][4] = 'quatrocentos';
    $numeros[3][5] = 'quinhentos';
    $numeros[3][6] = 'seiscentos';
    $numeros[3][7] = 'setecentos';
    $numeros[3][8] = 'oitocentos';
    $numeros[3][9] = 'novecentos';
 
    $qtd = strlen($n);
 
    $compl[0] = ' mil ';
    $compl[1] = ' milh�o ';
    $compl[2] = ' milh�es ';
    $numero = "";
    $casa = $qtd;
    $pulaum = false;
    $x = 0;
    for ($y = 0; $y < $qtd; $y++) {
 
        if ($casa == 5) {
 
            if ($n[$x] == '1') {
 
                $indice = '1' . $n[$x + 1];
                $pulaum = true;
            } else {
 
                $indice = $n[$x];
            }
 
            if ($n[$x] != '0') {
 
                if (isset($n[$x - 1])) {
 
                    $numero .= ' e ';
                }
 
                $numero .= $numeros[2][$indice];
 
                if ($pulaum) {
 
                    $numero .= ' ' . $compl[0];
                }
            }
        }
 
        if ($casa == 4) {
 
            if (!$pulaum) {
 
                if ($n[$x] != '0') {
 
                    if (isset($n[$x - 1])) {
 
                        $numero .= ' e ';
                    }
                }
            }
 
            $numero .= $numeros[1][$n[$x]] . ' ' . $compl[0];
        }
 
        if ($casa == 3) {
 
            if ($n[$x] == '1' && $n[$x + 1] != '0') {
 
                $numero .= 'cento ';
            } else {
 
                if ($n[$x] != '0') {
 
                    if (isset($n[$x - 1])) {
 
                        $numero .= ' e ';
                    }
 
                    $numero .= $numeros[3][$n[$x]];
                }
            }
        }
 
        if ($casa == 2) {
 
            if ($n[$x] == '1') {
 
                $indice = '1' . $n[$x + 1];
                $casa = 0;
            } else {
 
                $indice = $n[$x];
            }
 
            if ($n[$x] != '0') {
 
                if (isset($n[$x - 1])) {
 
                    $numero .= ' e ';
                }
 
                $numero .= $numeros[2][$indice];
            }
        }
 
        if ($casa == 1) {
 
            if ($n[$x] != '0') {
                if ($numeros[1][$n[$x]] <= 10)
                    $numero .= ' ' . $numeros[1][$n[$x]];
                else
                    $numero .= ' e ' . $numeros[1][$n[$x]];
            } else {
 
                $numero .= '';
            }
        }
 
        if ($pulaum) {
 
            $casa--;
            $x++;
            $pulaum = false;
        }
 
        $casa--;
        $x++;
    }
 
    return $numero;
}
?>

<?php
/**
 * Retorna uma string do valor 
 *  
 * @param string $n - Valor a ser traduzido, pode ser no formato americano ou brasileiro
 * @example escreverValorMoeda('1.530,64');
 * @example escreverValorMoeda('1530.64');
 * @return string 
 */
function escreverValorMoeda($n){
    //Converte para o formato float 
    if(strpos($n, ',') !== FALSE){
        $n = str_replace('.','',$n); 
        $n = str_replace(',','.',$n);
    }
 
    //Separa o valor "reais" dos "centavos"; 
    $n = explode('.',$n);
 
    return ucfirst(numeroEscrito($n[0])). ' reais' . ((isset($n[1]) && $n[1] > 0)?' e '.numeroEscrito($n[1]).' centavos.':'');
 
}

$cpf = $row_cliente['cpf_titular'];
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Auto Escola</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {
	font-size: 18px;
	font-weight: bold;
}
.style3 {font-size: 16px;
text-transform:uppercase;}
-->
</style>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>

<style media="print">
.botao {
display: none;
}
</style>
</head>

<body>
<table width="90%" border="0" align="center">
  <tr>
    <td width="29%" rowspan="2" valign="top"><img src="../img/logo23.png" alt="" width="181" height="76"></td>
    <td colspan="2"><div class="style1" align="left"></div></td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="62%"><div align="left">Endere&ccedil;o: Rua 03 Qd.05 Casa 36 Cohatrac IV<br>
      telefone: (98) 8800-3198 | 81286981<br>
      email:eneylton@hotmail.com</div></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
</table>

<table width="90%" border="0" align="center">
  <tr>
    <td colspan="3"><span class="style2">N&ordm; DO RECIBO:&nbsp;&nbsp;<?php echo date("dym")?><?php echo $row_aluno['']; ?></span>      <div align="right"><strong>
        <?php
//Agora um exemplo pr&aacute;tico
     $valor = number_format($val,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$valor."</font>"; 
	
?>
    </strong></div></td>
  </tr>
  <tr>
    <td width="51%">Recebemos do Sr. (a) <span style="text-transform:"><?php echo $row_mov['cliente']; ?></span>
    <div style="text-transform:"></div></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>Endere&ccedil;o: <?php echo $row_aluno['endereco']; ?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>CPF: <?php echo $row_aluno['cpf']; ?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">a quantia de R$<strong>
    <?php

     $valor = number_format($val,2,",",".");
    
    echo $valor.' ('.escreverValorMoeda($valor); echo ')'; 
	
?>
    </strong></td>
  </tr>
  <tr>
    <td>Referente ao(s) Servi�os:      </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><?php 
require_once('../Connections/conexao.php'); 
$id = $_GET['id_mov']; 

$sql = mysql_query("Select srv.servico as Servico From movimento as mov, serv as sv,servicos as srv WHERE mov.id_mov = '$id' AND 
sv.cliente = mov.cliente and sv.id_servico = srv.id");
while ($resultado = mysql_fetch_array($sql)){

$servico = $resultado['Servico'];

echo"&raquo; " .$servico."<br>";

}
?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Data: <?php echo "$nomediadasemana, $dia de $nomemes de $ano";?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>______________________<br>
       <div style="text-transform:capitalize;"><?php echo $row_mov['cliente']; ?></div><br></td>
    <td colspan="2"><p align="right">______________________<br>
    Assinatura do Recebedor</p>    </td>
  </tr>
</table>

----------------------------------------------------------------------------------------------------------<br>

<table width="90%" border="0" align="center">
  <tr>
    <td width="29%" rowspan="2" valign="top"><img src="../img/logo23.png" alt="" width="181" height="76"></td>
    <td colspan="2"><div class="style1" align="left"></div></td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="62%"><div align="left">Endere&ccedil;o: Rua 03 Qd.05 Casa 36 Cohatrac IV<br>
      telefone: (98) 8800-3198 | 81286981<br>
      email:eneylton@hotmail.com</div></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
</table>

<table width="90%" border="0" align="center">
  <tr>
    <td width="51%"><span class="style2">N&ordm; DO RECIBO:&nbsp;&nbsp;<?php echo date("dym")?><?php echo $row_aluno['']; ?></span></td>
    <td width="21%">&nbsp;</td>
    <td width="28%"><div align="right"><strong>
      <?php
     $valor = number_format($val,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$valor."</font>"; 
	
?>
    </strong></div></td>
  </tr>

  <tr>
    <td colspan="3">Recebemos do Sr. (a) <span style="text-transform:"><?php echo $row_mov['cliente']; ?></span>
    <div style="text-transform:"></div></td>
  </tr>
  <tr>
    <td colspan="3">Endere&ccedil;o: <?php echo $row_aluno['endereco']; ?></td>
  </tr>
  <tr>
    <td colspan="3">CPF: <?php echo $row_aluno['cpf']; ?></td>
  </tr>
  <tr>
    <td colspan="3">a quantia de R$<strong>
      <?php

     $valor = number_format($val,2,",",".");
    
    echo $valor.' ('.escreverValorMoeda($valor); echo ')'; 
	
?>
    </strong></td>
  </tr>
  <tr>
    <td>Referente ao Servi&ccedil;os:: </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><?php 
require_once('../Connections/conexao.php'); 
$id = $_GET['id_mov']; 

$sql = mysql_query("Select srv.servico as Servico From movimento as mov, serv as sv,servicos as srv WHERE mov.id_mov = '$id' AND 
sv.cliente = mov.cliente and sv.id_servico = srv.id");
while ($resultado = mysql_fetch_array($sql)){

$servico = $resultado['Servico'];

echo"&raquo; " .$servico."<br>";

}
?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Data: <?php echo "$nomediadasemana, $dia de $nomemes de $ano";?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
 
    <td>________________________<br>
        <div style="text-transform:capitalize;"><?php echo $row_mov['cliente']; ?></div><br></td>
    <td colspan="2"><p align="right">________________________<br>
      Assinatura do Recebedor</p></td>
  </tr>
  <tr>
    <td><form name="form1" method="post" action="">
      <label></label>
      <label></label>
    </form>    </td>
    <td><input class="botao" name="button2" type="submit" id="button2" onClick="MM_goToURL('parent','../listas/layout_balanco.php');return document.MM_returnValue" value="VOLTAR">
    <input class="botao" name="button" type="submit" id="button" onClick="MM_callJS('print();')" value="IMPRIMIR"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
@mysql_free_result($mov);

@mysql_free_result($aluno);

@mysql_free_result($servico);
?>



