<?php
@session_start();
	
	
switch ($_SESSION['chave']){
	case 1:
		$grupo = "gerenciadores do sistema";
		break;
	case 2:
		$grupo = "Administração";
		break;
	case 3:
		$grupo = "Instrutores e/ou utilizadores comum";
		break;
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
  $insertSQL = sprintf("INSERT INTO alunos (login, `data`, nome, endereco, bairro, complemento, municipio, cpf, cnh, val_cnh, renach, telefone, email, aniversario, observacao) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['data'], "date"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['complemento'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['cnh'], "text"),
                       GetSQLValueString($_POST['val_cnh'], "text"),
                       GetSQLValueString($_POST['renach'], "text"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['aniversario'], "date"),
                       GetSQLValueString($_POST['observacao'], "text"));
					   
					   $nome = $_POST['nome'];
					   $qtd  = 'Nenhuma Aula !';

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}
header('location:../listas/layout_ad_servico2.php');
?>

<?php 


$sql5 = "INSERT INTO carga (id,aluno,qtd) VALUES ('','$nome','$qtd')";
mysql_query($sql5);
?>

<?php 


$sql6 = "INSERT INTO carga1 (id,aluno,qtd) VALUES ('','$nome','$qtd')";
mysql_query($sql6);
?>


<?php 


$sql7 = "INSERT INTO carga2 (id,aluno,qtd) VALUES ('','$nome','$qtd')";
mysql_query($sql7);
?>