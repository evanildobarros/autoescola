<?php require("funcao_moeda.php"); ?>
<?php require("funcao_data.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Recibo</title>
<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
</style>
</head>

<body>
<table width="791" border="0" align="center" style=" border-collapse:collapse; border-bottom:1px solid #999999; border-left:1px solid #999999; border-right:1px solid #999999; border-top:1px solid #999999;">
  <tr>
    <td colspan="2" valign="top" bgcolor="#EFEFEF"><img src="../img/LOGO_CARRO.png" alt="" width="253" height="81" /></td>
    <td width="262" valign="top" bgcolor="#EFEFEF"><div align="center"><br />
    <span style="color:#FF0000; font-size:28px"><br />
    RECIBO</span></div></td>
    <td width="253" valign="top" bgcolor="#EFEFEF"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">Rua 19 Qda. 32 N&#176; 22 Vila Embratel<br />
Contatos: 3228-0014 / 8788-2808<br />
cep: 65080-140 - S&atilde;o Lu&iacute;s - MA<br />
CNPJ: 09.084.236/0001-28</span></td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#EFEFEF"><HR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#EAEAEA">
    <div style=" color:#FF0000; font-weight:bold; font-size:28px; width:280px; padding:7px; background:#FFFFFF; border:1px solid #CACACA; border-radius:5px;">
    
      N&#176; <?php echo date("md");?>
     <?php $id = $_GET['id']; echo $id; ?>
    </div></td>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td valign="top" bgcolor="#EAEAEA" align="center">
    <div style=" color:#000; font-weight:bold; font-size:28px; width:200px; padding:7px; background:#FFFFFF; border:1px solid #CACACA; border-radius:5px;">
    
    <?php $id = $_GET['id'];
          require_once('../Connections/conexao.php');

          $qr1=mysql_query("SELECT * FROM lc_movimento as m Where  m.id ='$id'");
          while ($row5=@mysql_fetch_array($qr1)){

          $vl = $row5['valor'];

          $valor = number_format($vl,2,",",".");
		  
		  echo "R$ ". $valor;
    
//
}
?>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4" valign="top" bgcolor="#EAEAEA">
    <div style=" color:#000; font-weight:bold; font-size:16px; width:800px; padding:7px; background:#FFFFFF; border:1px solid #CACACA; border-radius:5px;"><br />
    
    <p align="justify">Recibi(emos) do Centro de Formação de Condutores GIRO CERTO a Importância de <?php echo "R$ ".  $valor = number_format($vl,2,",",".")."<p align=\"left\">";
	echo ' *** ('.escreverValorMoeda($valor); echo ') *** , Referente ao(s) serviço(s) de: <p> <hr />'; 
	
		   ?>  
        <p align="left"><?php
$sql = mysql_query("SELECT serv2.servico as servicos 
FROM lc_movimento AS mov, serv, servicos AS serv2
WHERE mov.cliente = serv.cliente
AND serv2.id = serv.id_servico AND mov.id = $id");

while ($res = mysql_fetch_array($sql)){

$serv = $res['servicos'];
echo $serv."<BR>";

}

?> - (
<?php
$qr178=mysql_query("SELECT cat.nome as nome FROM lc_movimento as mov,lc_cat as cat WHERE mov.cat = cat.id AND mov.id = $id order by nome asc");
while ($row56=@mysql_fetch_array($qr178)){
$ene = $row56['nome'];
echo $ene;
}
?>



)
             <br />
           e por verdade, firmo-lhe o presente Recibo.</p>
    </div>              </td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#EAEAEA"></td>
  </tr>
  <tr>
    
    <td colspan="4" valign="top" bgcolor="#EAEAEA">    </td>
  </tr>
  <tr>
    <td width="23" valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td colspan="2" valign="top" bgcolor="#EAEAEA"><ul>
      <li><span class="style3">Atenção: Em caso de desistência o mesmo perderá 10% em cima do valor.<br />
        Não Incluso:<br />
        <strong>Exame Médico</strong>;<br />
        <strong>Taxa de emissão da</strong> <strong>CNH... R$ 15,94</strong></span><br />
      </li>
    </ul></td>
    <td valign="top" bgcolor="#EAEAEA"><?php echo "$nomediadasemana, $dia de $nomemes de $ano";?></td>
  </tr>
    <tr>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td width="307" valign="top" bgcolor="#EAEAEA"><br /></td>
    <td colspan="2" valign="top" bgcolor="#EAEAEA"><div align="center">________________________________________________________________<br />
    Assinatura</div></td>
  </tr>
    <tr>
      <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
      <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
      <td colspan="2" valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    </tr>
</table>





<br />
<br />
<br />
<br />
<table width="791" border="0" align="center" style=" border-collapse:collapse; border-bottom:1px solid #999999; border-left:1px solid #999999; border-right:1px solid #999999; border-top:1px solid #999999;">
  <tr>
    <td colspan="2" valign="top" bgcolor="#EFEFEF"><img src="../img/LOGO_CARRO.png" alt="" width="253" height="79" /></td>
    <td width="262" valign="top" bgcolor="#EFEFEF"><div align="center"><br />
            <span style="color:#FF0000; font-size:28px"><br />
              RECIBO</span></div></td>
    <td width="253" valign="top" bgcolor="#EFEFEF"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">Rua 19 Qda. 32 N&#176; 22 Vila Embratel<br />
      Contatos: 3228-0014 / 8788-2808<br />
      cep: 65080-140 - S&atilde;o Lu&iacute;s - MA<br />
      CNPJ: 09.084.236/0001-28</span></td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#EFEFEF"><hr /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#EAEAEA"><div style=" color:#FF0000; font-weight:bold; font-size:28px; width:280px; padding:7px; background:#FFFFFF; border:1px solid #CACACA; border-radius:5px;"> N&#176; <?php echo date("md");?>
            <?php $id = $_GET['id']; echo $id; ?>
    </div></td>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td valign="top" bgcolor="#EAEAEA" align="center"><div style=" color:#000; font-weight:bold; font-size:28px; width:230px; padding:7px; background:#FFFFFF; border:1px solid #CACACA; border-radius:5px;">
      <?php $id = $_GET['id'];
          require_once('../Connections/conexao.php');

          $qr1=mysql_query("SELECT * FROM lc_movimento as m Where  m.id ='$id'");
          while ($row5=@mysql_fetch_array($qr1)){

          $vl = $row5['valor'];

          $valor = number_format($vl,2,",",".");
		  
		  echo "R$ ". $valor;
    
//
}
?>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4" valign="top" bgcolor="#EAEAEA"><div style=" color:#000; font-weight:bold; font-size:16px; width:800px; padding:7px; background:#FFFFFF; border:1px solid #CACACA; border-radius:5px;"><br />
            <p align="justify">Recibi(emos) do Centro de Formação de Condutores GIRO CERTO a Importância de <?php echo "R$ ".  $valor = number_format($vl,2,",",".")."<p align=\"left\">";
	echo ' *** ('.escreverValorMoeda($valor); echo ') *** , Referente ao(s) serviço(s) de: <p> <hr />'; 
	
		   ?> </p>
      <p align="left">
        <?php
$sql = mysql_query("SELECT serv2.servico as servicos 
FROM lc_movimento AS mov, serv, servicos AS serv2
WHERE mov.cliente = serv.cliente
AND serv2.id = serv.id_servico AND mov.id = $id");

while ($res = mysql_fetch_array($sql)){

$serv = $res['servicos'];
echo $serv."<BR>";

}

?>- (
<?php
$qr178=mysql_query("SELECT cat.nome as nome FROM lc_movimento as mov,lc_cat as cat WHERE mov.cat = cat.id AND mov.id = $id order by nome asc");
while ($row56=@mysql_fetch_array($qr178)){
$ene = $row56['nome'];
echo $ene;
}
?>



)
              <br />
        e por verdade, firmo-lhe o presente Recibo.</p>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#EAEAEA"></td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#EAEAEA"></td>
  </tr>
  <tr>
    <td width="23" valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td colspan="2" valign="top" bgcolor="#EAEAEA"><ul>
      <li><span class="style3">Atenção: Em caso de desistência o mesmo perderá 10% em cima do valor.<br />
        Não Incluso:<br />
        <strong>Exame Médico</strong>;<br />
        <strong>Taxa de emissão da</strong> <strong>CNH... R$ 15,94</strong></span><br />
      </li>
    </ul></td>
    <td valign="top" bgcolor="#EAEAEA"><?php echo "$nomediadasemana, $dia de $nomemes de $ano";?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td width="307" valign="top" bgcolor="#EAEAEA"><br /></td>
    <td colspan="2" valign="top" bgcolor="#EAEAEA"><div align="center">________________________________________________________________<br />
      Assinatura</div></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td valign="top" bgcolor="#EAEAEA">&nbsp;</td>
    <td colspan="2" valign="top" bgcolor="#EAEAEA">&nbsp;</td>
  </tr>
</table>
</body>
</html>
