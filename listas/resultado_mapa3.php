<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Mapa do Aluno</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
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
<table width="900" border="0" align="center" style="border-collapse:collapse;">
  <tr>
    <td width="256" bgcolor="#F3F3F3"><span style="padding:5px;"><img src="../img/LOGO_CARRO.png" alt="" width="288" height="75" /></span></td>
    <td width="386" bgcolor="#F3F3F3"><div align="center"><span style="color:#FF0000; font-weight:bold; font-size:28px; font-family:Arial, Helvetica, sans-serif;">Aulas Agendadas</span></div></td>
    <td width="244" bgcolor="#F3F3F3"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">Rua 19 Qda. 32 N&#176; 22 Vila Embratel<br />
Contatos: 3228-0014 / 8788-2808<br />
cep: 65080-140 - S&atilde;o Lu&iacute;s - MA<br />
CNPJ: 09.084.236/0001-28</span></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F3F3F3"><hr /></td>
  </tr>
</table>

<table width="900" border="0" align="center" style="border-collapse:collapse;">
 <?php 
require('../Connections/conexao.php');
$aluno = $_GET['aluno'];
 
 
 $sql = mysql_query("SELECT DISTINCT 
                                    cal1.aluno as aluno, 
									cal1.event_start as data,
									cal1.hora as hora,
									cal1.event_shortdesc as fim,
									cal2.categoria as categoria,
									cal2.tipo as tipo,
									cal2.instrutor as instrutor,
									cal2.veiculo as veiculo,
									al.endereco as endereco,
									al.telefone as telefone,
									al.email as email
									
									
									FROM calendar_events as cal1,calendar_events3 as cal2,alunos as al WHERE al.nome = cal1.aluno AND cal1.aluno = '$aluno' ");
									 while ($res = @mysql_fetch_array($sql)){
									 $aluno      = $res['aluno'];
									 $data       = $res['data'];
									 $hora1      = $res['hora'];
									 $hora2      = $res['fim'];
									 $cat        = $res['categoria'];
									 $tipo       = $res['tipo'];
									 $end        = $res['endereco'];
									 $tel        = $res['telefone'];
									 $email      = $res['email'];
									 $instrutor  = $res['instrutor'];
									 $veiculo    = $res['veiculo'];
									 
									 
									 
	}								 
									 
 ?>
  <tr>
    <td width="513" valign="top" bgcolor="#F8F8F8"><span style=" padding:5px; color:#666666; font-family:verdana; font-size:14px;">Aluno(a):</span> 
	
	<span style=" color:#666666; text-transform:capitalize; font-family:verdana; font-size:14px;"><?php echo $aluno; ?></span>
     
      <br />
      <span style=" padding:5px; color:#666666; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Endere&ccedil;o:</span> 
	  
	  <span style="color:#666; text-transform:capitalize; font-family:verdana; font-size:14px;"> <?php echo $end; ?></span><br />
     <span style=" padding:5px; color:#666; text-transform:capitalize; font-family:verdana; font-size:14px;"> Telefone: <?php echo $tel; ?><br />
    <span style=" padding:5px; color:#666; text-transform:capitalize; font-family:verdana; font-size:14px;">  Email: <?php echo $email; ?></span></p>      </td>
      <td width="371" valign="top" bgcolor="#F8F8F8"><span style="color:#666; text-transform:capitalize; font-family:verdana; font-size:14px;">Instrutor: <?php echo $instrutor; ?><br />
        Veiculo: <?php echo $cat; ?><br />
        Categoria Pretendida: <?php echo $veiculo; ?><br />
      Tipo de aula: <?php echo $tipo; ?></span></td>
  </tr>
 
  <tr>
    <td colspan="2" bgcolor="#F8F8F8"><hr /></td>
  </tr>
   
  <tr>
    <td bgcolor="#CCCCCC"><span style="color:#333; font-family:verdana; padding:5px;">Data</span></td>
    <td bgcolor="#CCCCCC"><span style="color:#333; font-family:verdana; ">Hor&aacute;rios</span></td>
  </tr>
  <?php 
require('../Connections/conexao.php');
require('funcao_data.php');
$aluno = $_GET['aluno'];
 
 
 $sql = mysql_query("SELECT DISTINCT 
                                    cal1.aluno, 
									cal1.event_start as data,
									cal1.hora as hora,
									cal1.event_shortdesc as fim,
									cal2.categoria as categoria,
									cal2.tipo as tipo,
									al.endereco as endereco
									
									
									FROM calendar_events as cal1,calendar_events3 as cal2,alunos as al WHERE al.nome = cal1.aluno AND cal1.aluno = '$aluno' order by data asc");
									 $cont = 0;
									 while ($res = @mysql_fetch_array($sql)){
									 $aluno   = $res['aluno'];
									 $data    = $res['data'];
									 $hora1   = $res['hora'];
									 $hora2   = $res['fim'];
									 $cat     = $res['categoria'];
									 $tipo    = $res['tipo'];
									 $end    = $res['endereco'];
									 $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
									 
									 
									 
 ?>
 <tr bgcolor="<?php echo $cor ; ?>">
    <td height="23" ><span style="color:#666666; margin:auto 5px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;"><?php 
	   $date = $res['data'];  
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?></span></td>
    <td height="23"><span style="color:#666666;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">De <?php echo $hora1; ?> &aacute;s <?php echo $hora2; ?> </span></td>
  </tr>
  <?php  $cont ++; } ?>
  <tr>
    <td height="23" colspan="2" bgcolor="#F8F8F8" >&nbsp;</td>
  </tr>
  <tr>
    <td height="23" bgcolor="#F8F8F8" >&nbsp;</td>
    <td height="23" bgcolor="#F8F8F8" ><span style="color:#333; margin:auto 5px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;"><?php echo "$nomediadasemana, $dia de $nomemes de $ano";?></span><hr /></td>
  </tr>
  <tr>
    <td height="23" colspan="2" bgcolor="#F8F8F8" ><ol>
      <li> <span style=" font-size:12px; color:#333; font-family:Verdana, Arial, Helvetica, sans-serif;">&Eacute; proibido aula particular, se ocorrer a Auto Escola n&atilde;o se responsabilizar&aacute;.         </span></li>
      <li><span style=" font-size:12px; color:#333; font-family:Verdana, Arial, Helvetica, sans-serif;">&Eacute; proibido acompanhantes nas aulas pr&aacute;ticas.        </span></li>
      <li><span style=" font-size:12px; color:#333; font-family:Verdana, Arial, Helvetica, sans-serif;">Para desmarcar aulas somente pelo fone: (98) 3228-0014 / 8788-2808, com 48 horas de anteced&ecirc;ncia. Caso n&atilde;o        desmarque, o aluno perder&aacute; as aulas.        </span></li>
      <li><span style=" font-size:12px; color:#333; font-family:Verdana, Arial, Helvetica, sans-serif;">Caso queria mudar de local de encontro, ligar direto para o instrutor com 2 (duas) horas de anteced&ecirc;ncia.
        </span></li>
      <li><span style=" font-size:12px; color:#333; font-family:Verdana, Arial, Helvetica, sans-serif;"> Obrigat&oacute;rio RG e licen&ccedil;a de aprendizagem nas aulas e provas pr&aacute;ticas.</span></li>
    </ol></td>
  </tr>
  <tr>
    <td height="23" colspan="2" bgcolor="#F8F8F8" >&nbsp;</td>
  </tr>
  <tr>
    <td height="23" bgcolor="#F8F8F8" >&nbsp;</td>
    <td height="23" bgcolor="#F8F8F8" ><div align="center">_____________________________________________<br />
      <span style=" color:#666666; text-transform:capitalize; font-family:verdana; font-size:14px;">Instrutor</span></div></td>
  </tr>
  <tr>
    <td height="23" colspan="2" bgcolor="#F8F8F8" >&nbsp;</td>
  </tr>
  <tr>
    <td height="23" bgcolor="#F8F8F8" >&nbsp;</td>
    <td height="23" bgcolor="#F8F8F8" ><form id="form1" name="form1" method="post" action="">
      <input name="button" type="submit" id="button" onclick="MM_goToURL('parent','layout_mapa2.php');return document.MM_returnValue" value="Voltar" />
      <input name="button2" type="submit" id="button2" onclick="MM_callJS('print();')" value="Imprimir" />
      </label>
    </form></td>
  </tr>
  <tr>
    <td height="23" colspan="2" bgcolor="#F8F8F8" >&nbsp;</td>
  </tr>
</table>


</body>
</html>
