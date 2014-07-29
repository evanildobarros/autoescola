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


mysql_select_db($database_conexao, $conexao);
$query_meses = "SELECT * FROM meses";
$meses = mysql_query($query_meses, $conexao) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);


mysql_select_db($database_conexao, $conexao);
$query_soma1 = "SELECT SUM(valor) as total FROM movimento WHERE tipo = 0";
$soma1 = mysql_query($query_soma1, $conexao) or die(mysql_error());
$row_soma1 = mysql_fetch_assoc($soma1);
$totalRows_soma1 = mysql_num_rows($soma1);

mysql_select_db($database_conexao, $conexao);
$query_soma2 = "SELECT SUM(valor) as total FROM movimento WHERE tipo = 1";
$soma2 = mysql_query($query_soma2, $conexao) or die(mysql_error());
$row_soma2 = mysql_fetch_assoc($soma2);
$totalRows_soma2 = mysql_num_rows($soma2);

$s3 = $row_soma1['total'];
$s4 = $row_soma2['total'];
$s_total2 = $s3 - $s4; 

?>
 <?php
        if ((!isset($_POST['month'])) || (!isset($_POST['year']))) {
        $nowArray = getdate();
        $month = $nowArray['mon'];
        $year = $nowArray['year'];
        } else {
        $month = $_POST['month'];
        $year = $_POST['year'];
        }
        $start = mktime(12,0,0,$month,1,$year);
        $firstDayArray = getdate($start);
        ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
 <link rel="stylesheet" href="../css/layout.css" type="text/css" />
<title>Gerenciador AutoEscola</title>


<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>
<br>
<br>
<br>
<fieldset>
<legend>Contas Pagas</legend><br>


<table width="90%" border="0" style="border-collapse:collapse;" align="center">
 
  
<div class="box_select"><form name="form1" method="POST" action="../listas/layout_contas_pagas.php">
  
<select class="input" name="mes" id="mes">
  <option value="">Selecione o mês</option>
  <?php
do {  
?>
  <option value="<?php echo $row_meses['descricao']?>"><?php echo $row_meses['descricao']?></option>
  <?php
} while ($row_meses = mysql_fetch_assoc($meses));
  $rows = mysql_num_rows($meses);
  if($rows > 0) {
      mysql_data_seek($meses, 0);
	  $row_meses = mysql_fetch_assoc($meses);
  }
?>
           
         
    </select>           
    
        <input class="bt2" type="submit" name="button" id="button" value="Entrar">
   
</form></div>

<div style="margin:0px 0px 0px 100px;"><br>
  <br>
  <table width="600" border="0" align="center" style="border-collapse:collapse;">
<tr>
          <td colspan="2" ><br>
          </td>
  </tr>
        
        
        <tr>
        <td width="164" ><span class="td4">ENTRADA:</span></td>
        <td width="190"><span class="td6">R$&nbsp;<?php $total = $row_soma1['total']; echo number_format( $total  , 2 , ',' , '.' ); ?></span></td>
        </tr>
        <tr>
        <td ><span class="td4">SAIDA:</span></td>
        <td><span class="td5 style1">R$&nbsp;-<?php $total2 = $row_soma2['total'];  echo number_format( $total2  , 2 , ',' , '.' ); ?> </span></td>
    </tr>
        <tr>
        <td><span class="td4">TOTAL:</span></td>
        <td bgcolor="#333"><span class="td" style="font-size:26px; color:<?php if ($s_total2<0) echo "#fd0000"; else echo "#33FF00"?>">R$&nbsp;<?php echo number_format( $s_total2  , 2 , ',' , '.' ); ?></span></td>
    </tr>
  </table>
</div>

</div>
    


</fieldset>


    

</body>
</html>
</body>
</html>
<?php
mysql_free_result($meses);

mysql_free_result($soma1);

mysql_free_result($soma2);
?>

	
