<?php 

require_once('../Connections/conexao.php'); 

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
<title>Gerenciador Imobiliario</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
-->
</style>
<script type="text/javascript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<table width="1000" border="0" align="center" style="border-collapse:collapse;">
  <tr>
    <td colspan="3" bgcolor="#F4F4F4"><div style="padding:5px;  margin:0px 0px 0px 35px;"><img src="../img/logo.png" alt="" width="187" height="102" /></div></td>
  <td width="343" bgcolor="#F4F4F4"><div align="center" style="color:#FF3300; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;"><br />
          <br />
    FLUXO DE CAIXA</div></td>
    <td width="305" bgcolor="#F4F4F4"><div style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Av. Jer&ocirc;nimo de Albuquerque Pop Center Bloco C, Sala 08, , Cohab Anil III<br />
      S&atilde;o Lu&iacute;s, Maranh&atilde;o <br />
    CNPJ:9999.9999.0001-00</div></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F4F4F4"><HR /></td>
  </tr>
  <?php

$qr11=mysql_query("SELECT * FROM lc_movimento");
while ($row6=@mysql_fetch_array($qr11)){
$status = $row6['status'];

}
?>
  <tr>
    <td colspan="3" bgcolor="#F4F4F4"><div style="background:#FFF; border-radius:5px; border:1px solid #CCCCCC; margin:0px 0px 0px 20px; padding:7px; color:#666; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">M&ecirc;s refer&ecirc;ncia: <?php
$mes = $_POST['mes'];
$status = $_POST['tipo'];
echo $mes;
?></div></td>
    <td bgcolor="#F4F4F4">&nbsp;</td>
    <td bgcolor="#F4F4F4"><div style="background:#FFF; border-radius:5px; border:1px solid #CCCCCC; margin:0px 0px 0px 0px; padding:7px; color:#666; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Tipo: <?php if ($status == 1){ 
	                                                         echo "<font color=\"blue\">". RECEITA ."</font>"; 
															 }elseif($status == 0){
															 echo "<font color=\"RED\">". DESPESAS."</font>";
															 }
															 ?>
															  </div></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F4F4F4">&nbsp;</td>
  </tr>
  
  

 
</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse;">
  <tr>
    <td width="29" class="span8"></td>
    <td width="190" class="span8">Data de Emiss&atilde;o</td>
    <td width="114" class="span9">Lan&ccedil;amentos</td>
    <td class="span11">Forma de pagamento</td>
    <td class="span11">Cliente / Fornecedor</td>
    <td width="145" class="span11">Valor</td>
  </tr>
    <?php

$qr12=mysql_query("SELECT * FROM lc_movimento as m,lc_cat as c WHERE m.cat = c.id AND tipo = '$status' and m.m ='$mes'");
$cont = 0;
while ($row=@mysql_fetch_array($qr12)){
$cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
$venci = $row['vencimento'];


?>
  <tr bgcolor="<?php echo $cor ; ?>">
    <td><img width="17" height="15" src="../img/Green_check.png" /></td>
    <td class="span5"><?php 
	   $date = $row['vencimento']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?></td>
    <td class="span5"><?php echo $row['nome'];  ?></td>
    <td width="194" class="span5"><?php echo $row['fpagamento'];  ?></td>
    <td width="302" class="span5"><?php echo $row['fornecedor'];  ?><?php echo $row['cliente'];  ?></td>
    <td class="span5">R$ <?php $total = $row['valor'];
			echo number_format( $total  , 2 , ',' , '.' );  ?></td>
  </tr>
   <?php $cont ++; } ?> 
   <tr bgcolor="<?php echo $cor ; ?>">
     <td height="23" colspan="6"><hr /></td>
   </tr>
  <tr bgcolor="<?php echo $cor ; ?>">
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span style="font:Arial, Helvetica, sans-serif; color:#666; margin:0px 0px 0px 250px; font-weight:bold; font-size:20px;">Total</span></td>
    <td> <span style="font:Arial, Helvetica, sans-serif; color:#009999; margin:0px 0px 0px 0px; font-weight:bold; font-size:20px;">R$ <?php

$qr17=mysql_query("SELECT SUM(valor) as total FROM lc_movimento as m,lc_cat as c WHERE m.cat = c.id AND tipo = '$status' and m.m='$mes'");

while ($row=@mysql_fetch_array($qr17)){
$total = $row['total'];

			echo number_format( $total  , 2 , ',' , '.' );
}


?></span></td>
  </tr>
  <tr bgcolor="<?php echo $cor ; ?>">
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><form id="form1" name="form1" method="post" action="">
      <label>
        <input name="button2" type="submit" class="botao" id="button2" onclick="MM_goToURL('parent','consulta_mensal.php');return document.MM_returnValue" value="Voltar" />
        <input name="button" type="submit" class="botao" id="button" onclick="MM_callJS('print();')" value="IMPRIMIR" />
        </label>
      <label></label>
    </form>    </td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<br />

</body>
</html>
