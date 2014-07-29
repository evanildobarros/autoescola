<?php
session_start();

?>
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
$query_alunos = "SELECT * FROM alunos";
$alunos = mysql_query($query_alunos, $conexao) or die(mysql_error());
$row_alunos = mysql_fetch_assoc($alunos);
$totalRows_alunos = mysql_num_rows($alunos);

mysql_select_db($database_conexao, $conexao);
$query_instrutor = "SELECT * FROM instrutor";
$instrutor = mysql_query($query_instrutor, $conexao) or die(mysql_error());
$row_instrutor = mysql_fetch_assoc($instrutor);
$totalRows_instrutor = mysql_num_rows($instrutor);

mysql_select_db($database_conexao, $conexao);
$query_veiculo = "SELECT * FROM veiculo";
$veiculo = mysql_query($query_veiculo, $conexao) or die(mysql_error());
$row_veiculo = mysql_fetch_assoc($veiculo);
$totalRows_veiculo = mysql_num_rows($veiculo);

?>




<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>calendario</title>
<link rel="stylesheet" href="../css/menu.css" type="text/css" />
<link rel="stylesheet" href="../css/cadastros.css" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
</head>
<body onUnload="window.opener.location.reload()">

<br>
<br>
<br>

<fieldset><legend>Agendar</legend><br>
<br>

<form method="post" action='../Programacao/event.php'>
<table width="660" border="0" align="center" style="border-collapse:collapse;">
  
  
  <tr>
    <td width="135" valign="top" class="td2"><font color="#333">Aluno:</font></td>
    <td width="208" valign="top"><select name="aluno" id="aluno">
      <option value="value">Selecione</option>
      <?php
do {  
?>
      <option value="<?php echo $row_alunos['nome']?>"><?php echo $row_alunos['nome']?></option>
      <?php
} while ($row_alunos = mysql_fetch_assoc($alunos));
  $rows = mysql_num_rows($alunos);
  if($rows > 0) {
      mysql_data_seek($alunos, 0);
	  $row_alunos = mysql_fetch_assoc($alunos);
  }
?>
    </select>
      <span class="td2">
      <input type="hidden" name="mes" id="mes" value="<?php if ($m == 1){
	  echo "Janeiro";
	  } else if ($m == 2){
	  echo "Fevereiro";
	  }  else if ($m == 3){
	  echo "Mar&ccedil;o";
	  }  
	  else if ($m == 4){
	  echo "Abril";
	  }  
	  else if ($m == 5){
	  echo "Maio";
	  } else if ($m == 6){
	  echo "Junho";
	  } else if ($m == 7){
	  echo "Julho";
	  } else if ($m == 8){
	  echo "Agosto";
	  } else if ($m == 9){
	  echo "Setembro";
	  }  else if ($m == 10){
	  echo "Outubro";
	  }  else if ($m == 11){
	  echo "Novembro";
	  } else if ($m == 12){
	  echo "Dezembro";
	  }       
	  
	  
	  
	  
	  
	  
	  ?>"
      
      
      
      
      
      >
      </span></td>
    <td width="63" valign="top"class="td2"><font color="#333">Instrutor</font></td>
    <td width="140" valign="top"><select name="instrutor" id="instrutor">
      <option value="value">Selecione</option>
      <?php
do {  
?>
      <option value="<?php echo $row_instrutor['nome']?>"><?php echo $row_instrutor['nome']?></option>
      <?php
} while ($row_instrutor = mysql_fetch_assoc($instrutor));
  $rows = mysql_num_rows($instrutor);
  if($rows > 0) {
      mysql_data_seek($instrutor, 0);
	  $row_instrutor = mysql_fetch_assoc($instrutor);
  }
?>
    </select></td>
    <td width="39" valign="top">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="5" valign="top"class="td2"><br>
      <br></td>
    </tr>

  <tr>
   <td valign="top"class="td2"><font color="#333">Veiculo</font>
      </p>
      <label></label>
      </p></td>
    <td colspan="4" valign="top"><select name="veiculo" id="veiculo">

      <option value="">Selecione</option>
      <?php
do {  
?>
      <option value="<?php echo $row_veiculo['marca_modelo']?>"><?php echo $row_veiculo['marca_modelo']?> | Cor &raquo; <?php echo $row_veiculo['cor']?>  </option>
      <?php
} while ($row_veiculo = mysql_fetch_assoc($veiculo));
  $rows = mysql_num_rows($veiculo);
  if($rows > 0) {
      mysql_data_seek($veiculo, 0);
	  $row_veiculo = mysql_fetch_assoc($veiculo);
  }
?>
    </select>
      <br>
      <br></td>
    </tr>
  <tr>
    <td valign="top"class="td2"><font color="#333">Categoria</font></td>
    <td colspan="4" valign="top"><label>
    <font color="#333"><input type="radio" name="categoria" id="categoria" value="A">
A
<input type="radio" checked name="categoria" id="categoria2" value="B">
B
<input type="radio" name="categoria" id="categoria3" value="C">
C
<input type="radio" name="categoria" id="categoria4" value="D">
D
<input type="radio" name="categoria" id="categoria5" value="E">
E <br></font>
    <br>
    </label></td>
    </tr>
  <tr>
   <td colspan="5" valign="top"class="td2"><font color="#333"><input type="hidden" name="tipo">
  
    <input name="descricao" type="hidden"></td>
    </tr>
  
  <tr>
    <td valign="top">&nbsp;</td>
    <td colspan="4" valign="top"><input name="submit" type="submit" class="botao" value="Reservar"></td>
  </tr>
</table>

</form>

</fieldset>
</body>
</html>
<?php
mysql_free_result($alunos);

mysql_free_result($instrutor);

mysql_free_result($veiculo);
?>

