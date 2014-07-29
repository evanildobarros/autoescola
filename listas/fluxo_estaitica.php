<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
<title>Gerenciador despachante</title>
</head>

<body>
<br />
<br />
<br />
<table width="624" border="0" align="center">

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php
require_once('../Connections/conexao.php');

$sql1 = @mysql_query("SELECT COUNT( * ) AS total1 ,usuario FROM acesso AS ace, cliente AS cli WHERE ace.usuario = cli.login GROUP BY cli.login");
$sql2 = @mysql_query("SELECT COUNT(*) as total2 FROM cliente");

$res = (@mysql_fetch_array($sql2));


$cont = 0;
while ($resultado = @mysql_fetch_array($sql1)){

$printe = $resultado['usuario'];

$total_largura =($resultado['total1'] / $res['total2']) * 100;

$cor = ($cont%2 == 0)? "#EDEDED":"#F9F9F9";

?>
 <tr bgcolor="<?php echo $cor ; ?>">
    <td width="163"><span class="span6"><?php echo $printe; ?></span></td>
    <td width="451"><div style="background:#003399; text-align:right; color:#00FFFF; width:<?php echo $total_largura; ?>%;"><span class="span23"><?php echo round($total_largura)." % </br>";  ?></span></div></td>
  </tr>
  <?php $cont ++; } ?>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="span6">ESTAT&Iacute;STICA RELACIONADA AO FUNCION&aacute;RIO DO M&ecirc;S</span></td>
  </tr>
</table>



</body>
</html>
