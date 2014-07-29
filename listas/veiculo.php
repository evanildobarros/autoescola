<?php
 @session_start();
?>
<?php require_once('../Connections/conexao.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

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
if (isset($_GET['id_cliente'])) {
  $colname_cliente = $_GET['id_cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_cliente = sprintf("SELECT * FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_cliente, "int"));
$cliente = mysql_query($query_cliente, $conexao) or die(mysql_error());
$row_cliente = mysql_fetch_assoc($cliente);
$totalRows_cliente = mysql_num_rows($cliente);

mysql_select_db($database_conexao, $conexao);
$query_marca = "SELECT * FROM marca_modelo";
$marca = mysql_query($query_marca, $conexao) or die(mysql_error());
$row_marca = mysql_fetch_assoc($marca);
$totalRows_marca = mysql_num_rows($marca);

mysql_select_db($database_conexao, $conexao);
$query_cor = "SELECT * FROM cor";
$cor = mysql_query($query_cor, $conexao) or die(mysql_error());
$row_cor = mysql_fetch_assoc($cor);
$totalRows_cor = mysql_num_rows($cor);

mysql_select_db($database_conexao, $conexao);
$query_CATEGORIA = "SELECT * FROM tcategorias";
$CATEGORIA = mysql_query($query_CATEGORIA, $conexao) or die(mysql_error());
$row_CATEGORIA = mysql_fetch_assoc($CATEGORIA);
$totalRows_CATEGORIA = mysql_num_rows($CATEGORIA);

mysql_select_db($database_conexao, $conexao);
$query_tipo = "SELECT * FROM ttiposv";
$tipo = mysql_query($query_tipo, $conexao) or die(mysql_error());
$row_tipo = mysql_fetch_assoc($tipo);
$totalRows_tipo = mysql_num_rows($tipo);

mysql_select_db($database_conexao, $conexao);
$query_combustivel = "SELECT * FROM combustivel";
$combustivel = mysql_query($query_combustivel, $conexao) or die(mysql_error());
$row_combustivel = mysql_fetch_assoc($combustivel);
$totalRows_combustivel = mysql_num_rows($combustivel);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Gerenciador Despachante</title>
<link rel="stylesheet" href="../css/layout.css" type="text/css">
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/MaskedInput.js"></script>
		<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
        </script>
</head>

<body>
<form action="../programacao/insert_veiculo.php" method="post" name="form1" id="form1">
<input type="hidden" value="<?php echo $row_cliente['id_cliente']; ?>" name="cliente" />
<input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="data" />
  <br />
  <br />
  <br />
  <fieldset>
  <legend>Cadastro de Ve&iacute;culo</legend>
  
  
  <br />
  <table width="892" border="0" align="center">
    <tr>
      <td valign="top" class="span5">Marca modelo</td>
      <td valign="top"><label>
        <select name="Marca_Modelo" id="Marca_Modelo">
          <option value="">Selecione</option>
          
        insert
        
        
          <?php
do {  
?>
          <option value="<?php echo $row_marca['descri']?>"><?php echo $row_marca['descri']?></option>
          <?php
} while ($row_marca = mysql_fetch_assoc($marca));
  $rows = mysql_num_rows($marca);
  if($rows > 0) {
      mysql_data_seek($marca, 0);
	  $row_marca = mysql_fetch_assoc($marca);
  }
?>
        </select>
      <a href="#" onclick="MM_openBrWindow('Marca_Modelo.php','','scrollbars=yes,resizable=yes,width=550,height=160')"><img width="30" height="30" src="../img/check_green.jpg" /></a></label></td>
      <td valign="top" class="span5">Placa</td>
      <td valign="top"><input name="placa" wdg:subtype="MaskedInput" wdg:mask="AAA - 9999" id="placa" value="" size="14" maxlength="12" wdg:restricttomask="no" wdg:type="widget" /></td>
      <td valign="top" class="span5">Renavam</td>
      <td valign="top"><input type="text" name="renavam" value="" size="15" /></td>
    </tr>
    <tr>
      <td valign="top" class="span5">&nbsp;</td>
      <td colspan="5" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="span5">Chassi</td>
      <td colspan="5" valign="top"><input type="text" name="chassi" value="" size="40" /></td>
    </tr>
    <tr>
      <td valign="top" class="span5">&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="top" class="span5">&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="top" class="span5">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="span5">Cor</td>
      <td><select name="cor" />
      
          <option value="">selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_cor['cor']?>"><?php echo $row_cor['cor']?></option>
          <?php
} while ($row_cor = mysql_fetch_assoc($cor));
  $rows = mysql_num_rows($cor);
  if($rows > 0) {
      mysql_data_seek($cor, 0);
	  $row_cor = mysql_fetch_assoc($cor);
  }
?>
          
          </select>
          </label>      </td>
      <td valign="top" class="span5">Categora</td>
      <td><select name="categoria" id="categoria">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_CATEGORIA['catDescricao']?>"><?php echo $row_CATEGORIA['catDescricao']?></option>
          <?php
} while ($row_CATEGORIA = mysql_fetch_assoc($CATEGORIA));
  $rows = mysql_num_rows($CATEGORIA);
  if($rows > 0) {
      mysql_data_seek($CATEGORIA, 0);
	  $row_CATEGORIA = mysql_fetch_assoc($CATEGORIA);
  }
?>
        </select>
          </select>
          </label>      </td>
      <td valign="top" class="span5">Tipo</td>
      <td><select name="tipo" id="tipo">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_tipo['tpvDescricao']?>"><?php echo $row_tipo['tpvDescricao']?></option>
          <?php
} while ($row_tipo = mysql_fetch_assoc($tipo));
  $rows = mysql_num_rows($tipo);
  if($rows > 0) {
      mysql_data_seek($tipo, 0);
	  $row_tipo = mysql_fetch_assoc($tipo);
  }
?>
        </select>
          </select>
          </label>      </td>
    </tr>
    <tr>
      <td valign="top" class="span5">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top" class="span5">&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="span5">Ano de Fabrica&ccedil;&atilde;o</td>
      <td valign="top"><input type="text" name="ano_fab_modelo" value="" size="32" /></td>
      <td valign="top" class="span5">Combustivel</td>
      <td><select name="combustivel" id="combustivel">
          <option value="value">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_combustivel['desc']?>"><?php echo $row_combustivel['desc']?></option>
          <?php
} while ($row_combustivel = mysql_fetch_assoc($combustivel));
  $rows = mysql_num_rows($combustivel);
  if($rows > 0) {
      mysql_data_seek($combustivel, 0);
	  $row_combustivel = mysql_fetch_assoc($combustivel);
  }
?>
        </select>
          </select>
          </label>      </td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="span5">&nbsp; </td>
      <td valign="top">&nbsp;</td>
      <td valign="top" class="span5">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="span5">Data de emiss&atilde;o da nota</td>
      <td valign="top"><input class="span5" type="date" name="data_nota" value="" size="32" /></td>
      <td valign="top" class="span5">Vencimento</td>
      <td valign="top"><input  class="span5" type="date" name="vencimento" value="" size="32" /></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><input type="hidden" name="aviso" value=" &raquo; Aguardando..." /></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top"><input type="submit" class="botao" value="Cadastrar" /></td>
    </tr>
  </table>
  </fieldset>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php


mysql_free_result($combustivel);

mysql_free_result($tipo);

mysql_free_result($CATEGORIA);


mysql_free_result($cor);
mysql_free_result($marca);
?>
