<?php
session_start();
?>
<?php require_once('Connections/conexao.php'); ?>
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

$maxRows_cliente = 10;
$pageNum_cliente = 0;
if (isset($_GET['pageNum_cliente'])) {
  $pageNum_cliente = $_GET['pageNum_cliente'];
}
$startRow_cliente = $pageNum_cliente * $maxRows_cliente;

$colname_cliente = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_cliente = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_cliente = sprintf("SELECT cli.cliente, s.valor, s.id_servico FROM cliente AS cli, serv AS s WHERE cli.id_cliente = %s order by cli.id_cliente DESC", GetSQLValueString($colname_cliente, "int"));
$query_limit_cliente = sprintf("%s LIMIT %d, %d", $query_cliente, $startRow_cliente, $maxRows_cliente);
$cliente = mysql_query($query_limit_cliente, $conexao) or die(mysql_error());
$row_cliente = mysql_fetch_assoc($cliente);

$cli2 = $row_cliente['cliente'];

if (isset($_GET['totalRows_cliente'])) {
  $totalRows_cliente = $_GET['totalRows_cliente'];
} else {
  $all_cliente = mysql_query($query_cliente);
  $totalRows_cliente = mysql_num_rows($all_cliente);
}
$totalPages_cliente = ceil($totalRows_cliente/$maxRows_cliente)-1;

$colname_servv = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_servv = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_servv = sprintf("SELECT * FROM serv WHERE id_cliente = %s ORDER BY int_id DESC", GetSQLValueString($colname_servv, "int"));
$servv = mysql_query($query_servv, $conexao) or die(mysql_error());
$row_servv = mysql_fetch_assoc($servv);
$totalRows_servv = mysql_num_rows($servv);

$colname_SSSS = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_SSSS = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_SSSS = sprintf("SELECT * FROM serv WHERE id_cliente = %s", GetSQLValueString($colname_SSSS, "int"));
$SSSS = mysql_query($query_SSSS, $conexao) or die(mysql_error());
$row_SSSS = mysql_fetch_assoc($SSSS);
$totalRows_SSSS = mysql_num_rows($SSSS);

$colname_cpf = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_cpf = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_cpf = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_cpf, "int"));
$cpf = mysql_query($query_cpf, $conexao) or die(mysql_error());
$row_cpf = mysql_fetch_assoc($cpf);
$totalRows_cpf = mysql_num_rows($cpf);

$colname_nota = "-1";
if (isset($_GET['int_id'])) {
  $colname_nota = $_GET['int_id'];
}
mysql_select_db($database_conexao, $conexao);
$query_nota = sprintf("SELECT * FROM nota WHERE int_id = %s", GetSQLValueString($colname_nota, "int"));
$nota = mysql_query($query_nota, $conexao) or die(mysql_error());
$row_nota = mysql_fetch_assoc($nota);
$totalRows_nota = mysql_num_rows($nota);

$val = $row_nota['valor'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
 
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
    $numeros[1][3] = 'três';
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
    $compl[1] = ' milhão ';
    $compl[2] = ' milhões ';
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


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/recibo_pagamento.css" type="text/css" />
<title> Recibo</title>
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
<style type="text/css">
<!--
.style22 {	font-size: 14px
}
.style25 {font-size: 24px}
.style26 {color: #FF0000}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<br />
<table width="1000" border="1" align="center" style="border-collapse:collapse; border-color:#FFF;">
  <tr>
    <td><img src="img/LOGO_CARRO2.png" alt="" /></td>
    <td><div align="left" class="style22">MARCELODESPACHANTE.TZ@HOTMAIL.COM<br />
      RUA TEREZA CRISTINA N&ordm; 228<br />
      (ESQ.COM A GET&Uacute;LIO VARGAS) CENTRO -IMPERATRIZ<br />
      FONE:(99) 99049882 |8123-4009| 3526-4102</div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><strong>:: RECIBO ::</strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
    <div class="box2 style26"><span class="style25">Valor: </span>
      <?php
//Agora um exemplo prático
     $valor = number_format($val,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$valor."</font>"; 
	
?></div>
      <div class="box1">
    
Recebi do(a) Sr.(a) <?php echo $row_nota['cliente']; ?> </strong>&nbsp;a quantia supra <strong>R$</strong>&nbsp;<strong><?php
//Agora um exemplo prático
     $valor = number_format($val,2,",",".");
    
    echo $valor.' ('.escreverValorMoeda($valor); echo ')'; 
	
?>
          </strong> referente a: &nbsp;<?php echo $row_nota['descricao']; ?> qual(is) lhe dou plena e geral quita&ccedil;&atilde;o.</p>
      <p>
    
    </div>
   </td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="414"><p align="center">_____________________________________________<br />
     <?php echo $row_nota['cliente']; ?><br />
    </p>    </td>
    <td width="406"><div align="center">__________________________________________<br />
    <?php echo $_SESSION['usuario']; ?><br />                                               
     <?php 
	require_once("datahora.php");
$op="Emitiu um Novo Recibo Avulso !";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
	?>
    </div></td>
  </tr>
  <tr>
    <td>
      <label>
      <div align="right">
        <input name="button2" type="submit" id="button2" onclick="MM_callJS('print();')" value="IMPRIMI" />
      </div>
      </label></td>
    <td><label></label>
      <label>
      <input name="button" type="submit" id="button" onclick="MM_goToURL('parent','emitir_nota_fiscal.php');return document.MM_returnValue" value="VOLTAR" />
      </label></td>
  </tr>
</table>
</form>   
</body>
</html>
<?php
mysql_free_result($cliente);

mysql_free_result($servv);

mysql_free_result($SSSS);

@mysql_free_result($cpf);

mysql_free_result($nota);
?>
