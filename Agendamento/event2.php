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

$mysql = mysql_connect("localhost", "root", "jedai2003");
mysql_select_db("AutoEscola", $mysql) or die(mysql_error());

// Add our new events
if ($_POST){
	$m = $_POST['m'];
	$d = $_POST['d'];
	$y = $_POST['y'];

	// Formatting for SQL datetime (if this is edited, it will NOT work.)
	$event_date = $y."-".$m."-".$d." ".$_POST["event_time_hh"].":".$_POST["event_time_mm"].":00";

	$insEvent_sql = "INSERT INTO calendar_events1 (event_title,
			                                      event_shortdesc, 
												  event_start,
												  hora,
												  aluno,
												  instrutor,
												  veiculo,
												  categoria,
												  tipo,descricao,mes) VALUES('".$_POST["event_title"]."',
			                                                         '".$_POST["event_shortdesc"]."','$event_date',
																	 '".$_POST["hora"]."',
																	 '".$_POST["aluno"]."',
																	 '".$_POST["instrutor"]."',
																	 '".$_POST["veiculo"]."',
																	 '".$_POST["categoria"]."',
																	 '".$_POST["tipo"]."',
																	 '".$_POST["descricao"]."',
																	 '".$_POST["mes"]."')";
	$insEvent_res = mysql_query($insEvent_sql, $mysql)
			or die(mysql_error($mysql));
				
} else {
	$m = $_GET['m'];
	$d = $_GET['d'];
	$y = $_GET['y'];
}
// Show the events for this day:
$getEvent_sql = "SELECT event_title, event_shortdesc,
		         date_format(event_start, '%l:%i %p') as fmt_date,
				 hora,
				 aluno,
				 instrutor,
				 veiculo,
				 categoria,
				 tipo,
				 descricao,mes
				 FROM
		         calendar_events1 
				 WHERE 
				 month(event_start) = '".$m."'
		         AND dayofmonth(event_start) = '".$d."' 
				 AND year(event_start)= '".$y."' 
				 ORDER BY event_start";
$getEvent_res = mysql_query($getEvent_sql, $mysql)
		or die(mysql_error($mysql));



mysql_close($mysql);


@header('location:../listas/layout_ag_simulador.php');
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>calendario</title>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<body><br>
<br>

<fieldset><legend>Agendar</legend>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table width="660" border="0" align="center" style="border-collapse:collapse;">
  <tr>
    <td colspan="5" valign="top"><span class="td"><br>
    </span>      <label></label></td>
    </tr>
  
  <tr>
    <td width="135" valign="top" class="td2"><font color="#333">Aluno:</font></td>
    <td valign="top"><select name="aluno" id="aluno">
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
      <input type="hidden" name="mes" id="mes" value="<?php echo $mes2; ?>">
      </span></td>
    <td width="63" valign="top"class="td2"><font color="#333">InstRUtor</font></td>
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
   <td valign="top"class="td2"><font color="#333">Inicio da Aula</font></td>
    <td width="208" valign="top"><select name="hora" id="hora">
      <option>Selecione</option>
      <option value="7:00">7:00</option>
      <option value="7:30">7:30</option>
      <option value="8:00">8:00</option>
      <option value="8:30">8:30</option>
      <option value="9:00">9:00</option>
      <option value="9:30">9:30</option>
      <option value="10:00">10:00</option>
      <option value="10:30">10:30</option>
      <option value="11:00">11:00</option>
      <option value="11:30">11:30</option>
      <option value="12:00">12:00</option>
      <option value="12:30">12:30</option>
      <option value="13:00">13:00</option>
      <option value="13:30">13:30</option>
      <option value="14:00">14:00</option>
      <option value="14:30">14:30</option>
      <option value="15:00">15:00</option>
      <option value="15:30">15:30</option>
      <option value="16:00">16:00</option>
      <option value="16:30">16:30</option>
      <option value="17:00">17:00</option>
      <option value="17:30">17:30</option>
      <option value="9:00">18:00</option>
    </select></td>
    <td valign="top"class="td2"><font color="#333">Fim</font></td>
    <td colspan="2" valign="top"><select name="event_shortdesc" id="event_shortdesc">
      <option>Selecione</option>
      <option value="7:00">7:00</option>
      <option value="7:30">7:30</option>
      <option value="8:00">8:00</option>
      <option value="8:30">8:30</option>
      <option value="9:00">9:00</option>
      <option value="9:30">9:30</option>
      <option value="10:00">10:00</option>
      <option value="10:30">10:30</option>
      <option value="11:00">11:00</option>
      <option value="11:30">11:30</option>
      <option value="12:00">12:00</option>
      <option value="12:30">12:30</option>
      <option value="13:00">13:00</option>
      <option value="13:30">13:30</option>
      <option value="14:00">14:00</option>
      <option value="14:30">14:30</option>
      <option value="15:00">15:00</option>
      <option value="15:30">15:30</option>
      <option value="16:00">16:00</option>
      <option value="16:30">16:30</option>
      <option value="17:00">17:00</option>
      <option value="17:30">17:30</option>
      <option value="9:00">18:00</option>
    </select>
      <br>
      <br></td>
  </tr>

  <tr>
   <td valign="top"class="td2"><font color="#333">Veiculo</font>

      </p>
      <label></label>
      </p></td>
    <td valign="top"><select name="veiculo">
    
    <option value="Simulador">Simulador</option>
    </select></td>
    <td colspan="3" valign="top"><br>
      <br></td>
    </tr>
  <tr>
    <td valign="top"class="td2"><font color="#333">Categoria</font></td>
    <td colspan="4" valign="top"><label>
    <font color="#333"><input type="radio" name="categoria" id="categoria" value="A">
A
<input checked type="radio" name="categoria" id="categoria2" value="B">
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
   <td valign="top"class="td2"><font color="#333">Tipo</font></td>
    <td colspan="4" valign="top"><font color="#333"><input checked type="radio" name="tipo"  value="Aula">
      Aula
        <input type="radio" name="tipo"  value="Exame">
Exame</font>
<p></p></td>
  </tr>
  <tr>
   <td valign="top"class="td2"><font color="#333">Observa&ccedil;&atilde;o</font></td>
    <td colspan="4" valign="top"><textarea name="descricao" id="descricao" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td colspan="5" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td colspan="4" valign="top"><input name="submit" type="submit" class="botao" value="Reservar"></td>
  </tr>
</table>

<input type="hidden" name="m" value="<?php echo $m; ?>">
<input type="hidden" name="d" value="<?php echo $d; ?>">
<input type="hidden" name="y" value="<?php echo $y; ?>">
</form>
</fieldset>
</body>
</html>
<?php
mysql_free_result($alunos);

mysql_free_result($instrutor);

mysql_free_result($veiculo);
?>

