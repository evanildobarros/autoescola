<?php 
session_start();
?>
<?php require_once('../Connections/conexao.php'); ?><?php
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
  $insertSQL = sprintf("INSERT INTO movimento (id_cliente, `data`, cliente, servico, tipo, categoria, valor, status, mes, fornecedor) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_cliente'], "text"),
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['cliente'], "text"),
                       GetSQLValueString($_POST['servico'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['categoria'], "text"),
                       GetSQLValueString($_POST['valor'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['mes'], "text"),
                       GetSQLValueString($_POST['fornecedor'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_conexao, $conexao);
$query_fornecedor = "SELECT * FROM fornecedor";
$fornecedor = mysql_query($query_fornecedor, $conexao) or die(mysql_error());
$row_fornecedor = mysql_fetch_assoc($fornecedor);
$totalRows_fornecedor = mysql_num_rows($fornecedor);

mysql_select_db($database_conexao, $conexao);
$query_formap = "SELECT * FROM categoria";
$formap = mysql_query($query_formap, $conexao) or die(mysql_error());
$row_formap = mysql_fetch_assoc($formap);
$totalRows_formap = mysql_num_rows($formap);
?>

    <?php
$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
$hoje = getdate();
$dia = $hoje["mday"];
$mes = $hoje["mon"];
$nomemes = $meses[$mes];
$ano = $hoje["year"];
$diadasemana = $hoje["wday"];
$nomediadasemana = $diasdasemana[$diadasemana];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Despachante</title>
</head>

<body><br />
<br />
<br />
<br />
<fieldset><legend>Registro de despesas</legend><br />
<br />


<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
   
      
      <input type="hidden" name="data" value="<?php echo date("Y-m-d"); ?>" size="32" />
    <input type="hidden" name="id_cliente" value="<?php echo $_SESSION['MM_Username']; ?>" size="32" />
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nome:</td>
      <td><input type="text" name="cliente" value="" size="32" /></td>
    </tr>
      <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fornecedor:</td>
      <td><select name="fornecedor">
        <option value="">Selecione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_fornecedor['nome']?>"><?php echo $row_fornecedor['nome']?></option>
        <?php
} while ($row_fornecedor = mysql_fetch_assoc($fornecedor));
  $rows = mysql_num_rows($fornecedor);
  if($rows > 0) {
      mysql_data_seek($fornecedor, 0);
	  $row_fornecedor = mysql_fetch_assoc($fornecedor);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tipo de despesa:</td>
      <td valign="top"><textarea  name="servico" cols="" rows="" class="textarea" id="servico"></textarea></td>
    </tr>
    
     
   <input type="hidden" name="tipo" value="1" size="32" />
   
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Forma de Pagamento:</td>
      <td><select name="categoria">
        <option value="">Selecione</option>
        <?php
do {  
?>
        <option value="<?php echo $row_formap['Categoria']?>"><?php echo $row_formap['Categoria']?></option>
        <?php
} while ($row_formap = mysql_fetch_assoc($formap));
  $rows = mysql_num_rows($formap);
  if($rows > 0) {
      mysql_data_seek($formap, 0);
	  $row_formap = mysql_fetch_assoc($formap);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Valor:</td>
      <td><input type="text" name="valor" placeholder="R$" value="" size="10" /></td>
    </tr>
 
    
     <input type="hidden" name="status" value="1" size="32" />

  
  <input type="hidden" name="mes" value="<?php echo "$nomemes ";?>" size="32" />
  
  
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="botao" value="Registrar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

</fieldset>
<p>&nbsp;</p>
</body>

</html>
<?php
mysql_free_result($fornecedor);

mysql_free_result($formap);
?>
