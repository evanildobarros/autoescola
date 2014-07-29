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

$colname_proces = "-1";
if (isset($_GET['cliente'])) {
  $colname_proces = $_GET['cliente'];
}
mysql_select_db($database_conexao, $conexao);
$query_proces = sprintf("SELECT *  FROM processo WHERE cliente = %s", GetSQLValueString($colname_proces, "text"));
$proces = mysql_query($query_proces, $conexao) or die(mysql_error());
$row_proces = mysql_fetch_assoc($proces);
$totalRows_proces = mysql_num_rows($proces);

$cliente = $row_proces['cliente'];
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gereciador Despachante</title>
</head>

<body>
<form name="frmMain" action="lista_detalhes.php" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1000" border="0" align="center">
              <tr>
                <td width="827"><img src="../img/LOGO_CARRO2.jpg" alt="" width="500" height="80" /></td>
                <td width="157" valign="top">Endereço:</td>
              </tr>
            </table>
			<table width="1000" border="0" align="center" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			  <td colspan="6" valign="baseline">&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="6" valign="baseline"><HR /></td>
			  </tr>
			<tr>
			  <td colspan="2" valign="baseline"><p>LISTA DETALHADA</p>
		      <p>Nº DO PROCESSO:<?php echo $row_proces['codigo']; ?><br />
		        <br />
		      CLIENTE: <?php echo $row_proces['cliente']; ?><br />
		      <br />
		      INICIO DO PROCESSO:<?php echo $row_proces['entrada']; ?></p></td>
			  <td valign="baseline">&nbsp;</td>
			  <td colspan="3" valign="baseline">&nbsp;</td>
			  </tr>
			<tr>
			<td width="49" valign="baseline">&nbsp;</td>
			<td width="217" valign="top" class="td" ><br />
			  Local de Origem<br /></td>
			<td width="312"  valign="top" class="td" ><br />
			  Descrição do processo</td>
			<td width="189"  valign="top" class="td"><br />
			  Data da movimentação</td>
			<td width="133"  valign="top" class="td"><div align="center"><br />
			  Hora</div></td>
			<td width="74" align="center" valign="top" class="td"><br />			
			  Status<br /></td>
			</tr>
			<?php
			
			
			require_once('../Connections/conexao.php');
			
			$p = $_GET["p"];
			
			if(isset($p)) {
			$p = $p;
			} else {
			$p = 1;
			}
			
			$qnt = 8;
			$inicio = ($p*$qnt) - $qnt;
			
			if($_REQUEST['filtro'] == ' ' )
			$filtro = '';
			else
			$filtro = $_REQUEST['filtro'];
			
			if($_REQUEST['filtro1'] == ' ' )
			$filtro1 = '';
			else
			$filtro1 = $_REQUEST['filtro1'];
			
			$sql = "SELECT * from processo WHERE cliente = '".$cliente."' AND cliente like '".$filtro."%' ORDER BY id_processo DESC LIMIT $inicio, $qnt ";
			
			$rs  = mysql_query($sql);
			
			function geraTimestamp($data) {
			$partes = explode('/', $data);
			return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
			}
			$cont = 0;
			while ($resultado = @mysql_fetch_array($rs))
			{
			
			
			$cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
			?>
		<tr bgcolor="<?php echo $cor ; ?>">
			<td valign="top"><label>
			<input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id_processo"];?>">
			</label></td>
			<td valign="top" class="td3"><span class="span6"><?php echo $resultado['local']; ?></span></td>
			
			<td valign="top" class="td3"><span class="span6"><?php echo $resultado['descricao']; ?></span></td>
			<td valign="top" class="td3"><span class="span6">
			<?php echo $resultado['movimentacao']; ?></span></td>
			<td valign="top" class="td3"><div align="center"><?php echo $resultado['hora']; ?></div></td>
			<td valign="top" class="td3"><div align="left"><?php if ($resultado['status'] == 1)
		{
		echo "<img src=\"../img/001.jpg\">";
		} else if ($resultado['status'] == 2){
		echo "<img src=\"../img/002.jpg\">";
		}
		else if ($resultado['status'] == 3){
		echo "<img src=\"../img/003.jpg\">";
		}
		else if ($resultado['status'] == 4){
		echo "<img src=\"../img/004.jpg\">";
		}
		
		
		
		
		 ?></div></td>
			</tr>
			<tr><?php $cont ++; }?>
			<?php
			$sql_select_all = "SELECT * from processo WHERE cliente = '".$cliente."'";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 3;
			?>
			<td colspan="6" align="center" valign="top"><br />
			  IMPRIMIR<br />
			<br /></td>
			</tr>
			</table>
</form>
</body>
</html>
<?php
mysql_free_result($proces);
?>
