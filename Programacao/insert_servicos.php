<?php 
if (!isset($_SESSION)) {
  @session_start();
  include ("../datahora.php");
}

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO serv (id_cliente, id_servico, `data`, tipo, categoria, descricao, valor, valor2, status, mes, cliente, venci) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_cliente'], "int"),
                       GetSQLValueString($_POST['id_servico'], "text"),
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['categoria'], "text"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['valor'], "text"),
                       GetSQLValueString($_POST['valor2'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['mes'], "text"),
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['venci'], "date"));
					   
					   
					   $data             = $_POST['data'];
					   $tipo             = $_POST['tipo'];
					   $categoria        = $_POST['categoria'];
					   $descricao        = $_POST['descricao'];
					   $val              = $_POST['valor'];
					   $val2             = $_POST['valor2'];
					   $status           = $_POST['status'];
					   $mes              = $_POST['mes'];
					   $cliente            = $_POST['cliente'];
					   $vencimento       = $_POST['venci'];
					   
					   
					   
					   
					   
					   
					  
					  

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

$colname_aluno = "-1";
if (isset($_GET['id_aluno'])) {
  $colname_aluno = $_GET['id_aluno'];
}
mysql_select_db($database_conexao, $conexao);
$query_aluno = sprintf("SELECT * FROM alunos WHERE id_aluno = %s", GetSQLValueString($colname_aluno, "int"));
$aluno = mysql_query($query_aluno, $conexao) or die(mysql_error());
$row_aluno = mysql_fetch_assoc($aluno);
$totalRows_aluno = mysql_num_rows($aluno);

header('location:../Cadastros/cadastro_servicos2.php');

?>

<?php 
require_once("../datahora.php");
$op="Cadastro Um Novo Serviço !";
$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES ('', '$tipo', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
mysql_query($sql5);
?><br>
<br>
<?php 
$sql6 = "INSERT INTO movimento (id_mov, data, cliente, tipo,categoria,descricao, valor,valor2,status, mes) 
VALUES ('', '$vencimento','$cliente','$tipo','$categoria','$descricao', '$val','$val2','$status', '$mes')";
mysql_query($sql6);
?>

<?php
mysql_free_result($aluno);
?>
