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

$maxRows_consultas = 10;
$pageNum_consultas = 0;
if (isset($_GET['pageNum_consultas'])) {
  $pageNum_consultas = $_GET['pageNum_consultas'];
}
$startRow_consultas = $pageNum_consultas * $maxRows_consultas;

$colname_consultas = "-1";
if (isset($_POST['event_start'])) {
  $colname_consultas = $_POST['event_start'];
}
$colname1_consultas = "-1";
if (isset($_POST['instrutor'])) {
  $colname1_consultas = $_POST['instrutor'];
}
mysql_select_db($database_conexao, $conexao);
$query_consultas = sprintf("SELECT C1.ID,  C1.event_start as DAT,   C1.ALUNO AS ALUNO,   C1.HORA AS HORA,   C1.event_shortdesc,   C3.INSTRUTOR AS INSTRUTOR,  C3.CATEGORIA AS CATEGORIA,   C3.VEICULO AS VEICULO,   C1.TIPO AS TIPO,   C1.DESCRICAO AS DESCRICAO FROM calendar_events AS C1,   calendar_events3 AS C3 WHERE C1.ALUNO = C3.ALUNO AND  C1.event_start  LIKE %s AND  C3.instrutor  LIKE %s", GetSQLValueString("%" . $colname_consultas . "%", "date"),GetSQLValueString("%" . $colname1_consultas . "%", "text"));
$query_limit_consultas = sprintf("%s LIMIT %d, %d", $query_consultas, $startRow_consultas, $maxRows_consultas);
$consultas = mysql_query($query_limit_consultas, $conexao) or die(mysql_error());
$row_consultas = mysql_fetch_assoc($consultas);

if (isset($_GET['totalRows_consultas'])) {
  $totalRows_consultas = $_GET['totalRows_consultas'];
} else {
  $all_consultas = mysql_query($query_consultas);
  $totalRows_consultas = mysql_num_rows($all_consultas);
}
$totalPages_consultas = ceil($totalRows_consultas/$maxRows_consultas)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Relação de Alunos</title>
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
</head>

<body>
<div class="container-fluid ">
     <div class="row-fluid class="alert alert-success"">
     
    
     <div class="span1"></div>
     <div class="span7">
    
      <h3>Instrutor: <?php echo $row_consultas['INSTRUTOR']; ?></h3>
     <h5>Veiculo: <?php echo $row_consultas['VEICULO']; ?></h5>
     Data: <?php 
	   $date =  $row_consultas['DAT']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?>
     <br />
     <br />    
     
     </div>
     <div class="span4"><img  src="../img/LOGO_CARRO.png" width="281" height="77" /></div>
     </div>
     </div>

<div class="container-fluid">
     <div class="row-fluid">
     <div class="span1"></div>
     <div class="span10">
     <table width="815" border="0" class="table-striped table table-hover">
  <tr>
    <td><strong>ALUNO</strong></td>
    <td><strong>INICIO</strong></td>
    <td><strong>FIM</strong></td>
    <td><strong>Categoria Pretendida</strong></td>
    <td><strong>Tipo</strong></td>
    <td><strong>Observações</strong></td>
    </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_consultas['ALUNO']; ?></td>
      <td>Das <?php echo $row_consultas['HORA']; ?></td>
      <td>as <?php echo $row_consultas['event_shortdesc']; ?></td>
      <td><?php echo $row_consultas['CATEGORIA']; ?></td>
      <td><?php echo $row_consultas['TIPO']; ?></td>
      <td><?php echo $row_consultas['DESCRICAO']; ?></td>
      </tr>
      <?php } while ($row_consultas = mysql_fetch_assoc($consultas)); ?>
    <tr>
      <td colspan="6"><form id="form1" name="form1" method="post" action="">
      
          <input class="btn btn-success" name="button" type="submit" id="button" onclick="MM_goToURL('parent','../listas/layout_mapa_instrutor2.php');return document.MM_returnValue" value="Voltar" />
          
                <input class="btn btn-primary" name="button2" type="submit" id="button2" onclick="MM_callJS('print();')" value="Imprimir" />
                
      </form></td>
      </tr>
</table>
     
     </div>
     <div class="span1"></div>
</div>
</div>


</body>
</html>
<?php
mysql_free_result($consultas);
?>
