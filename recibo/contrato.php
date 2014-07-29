<?php require'../Connections/conexao.php'; ?>
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

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Gerenciador AutoEscola</title>
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
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
</head>

<body>
<table width="900" border="0" align="center">
  <tr>
    <td width="169"><img src="../img/LOGO_CARRO.png" width="279" height="105" /></td>
    <td width="715" valign="top"><span class="style1">O CENTRO DE FORMA&Ccedil;&Atilde;O DE CONDUTORES &quot;GIRO CERTO&quot; LTDA.., pessoa juridica de direito privado, inscrita no CNPJ<br />
  sob o n&ordm; 09.084.236/0001-28 com sede na Rua 19 Qda.32 n&ordm; 22 - Vila Embratel CEP:65080-140 S&atilde;o lu&iacute;s - Ma<br />
  credenciado junto ao DETRAN_MA, Portaria n&ordm; ____________ neste ato designado t&atilde;o somente de Auto Escola &quot;GIRO CERTO&quot;,<br />
    representado pelos seus direitos.</span></td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td>
  </tr>
</table>

<br />
<table width="900" border="0" align="center">
  <tr>
    <td colspan="6"><?php echo "$nomediadasemana, $dia de $nomemes de $ano";?><br /></td>
  </tr>
  <?php 
  $aluno = $_GET['id_aluno'];
  
  $sql = mysql_query("SELECT * FROM alunos WHERE id_aluno = '$aluno'");
  while ($resultado = @mysql_fetch_array($sql)){
  $nome = $resultado['nome'];
  $renach = $resultado['renach'];
  $endereco = $resultado['endereco'];
  $bairro = $resultado['bairro'];
  $comple = $resultado['complemento'];
  $cpf = $resultado['cpf'];
  $telefone = $resultado['telefone'];
  $email = $resultado['email'];
  
  
  ?>
  <tr>
    <td width="49"><strong>Aluno:    </strong></td>
    <td width="229"><div style="text-transform:capitalize"><?php echo $nome; ?> </div></td>
    <td width="74">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Endere&ccedil;o:</strong></td>
    <td><div style="text-transform:capitalize"><?php echo $endereco; ?></div></td>
    <td><strong>Bairro</strong></td>
    <td width="163"><div style="text-transform:capitalize"><?php echo $bairro; ?></div></td>
    <td width="40"><strong>Complemento:</strong></td>
    <td width="305"><div style="text-transform:capitalize"><?php echo $comple; ?></div></td>
  </tr>
  <tr>
    <td><strong>Muni&iacute;pio:</strong></td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>CPF:</strong></td>
    <td><div style="text-transform:capitalize"><?php echo $cpf; ?></div></td>
    <td><strong>RENACH:</strong></td>
    <td><?php echo $renach; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Celular::</strong></td>
    <td colspan="3"><div style="text-transform:capitalize"><?php echo $telefone; ?></div></td>
    <td><strong>Email:</strong></td>
    <td><?php echo $email; ?></td>
  </tr>
  <?php } ?>
</table>
<br />
<table width="900" border="0" align="center">
  <tr>
    <td><strong>Servi&ccedil;os</strong></td>
    <td colspan="2"><strong>Taxas</strong></td>
  </tr>
   <?php 
  
  $sql2 = mysql_query("SELECT servic.servico as sv,servic.valor as vlr, serv.categoria as cat, serv.valor as vd FROM serv, alunos AS al, servicos AS servic
                       WHERE serv.cliente = al.nome
                       AND servic.id = serv.id_servico
                       AND id_aluno = '$aluno'");
					   $cont = 0;
                 while ($resultado = @mysql_fetch_array($sql2)){
                 $servico = $resultado['sv'];
                 $valor = $resultado['vlr'];
				 $cat = $resultado['cat'];
				 $vd   = $resultado['vd'];
  
 $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
  
   ?> 
 <tr bgcolor="<?php echo $cor ; ?>">
    <td>
    <?php  echo "&raquo; ".$servico. " / "; ?>    </td>
    <td colspan="2"><?php
     $vl = number_format($valor,2,",",".");
    
      echo "<font size=\"3\"> R$</strong> "."<font size=\"3\">".$vl."</font>"; 
	
?></td>
  </tr>
  <?php $cont ++;  } ?>
  <tr>
    <td><strong>Valor Total </strong></td>
    <td colspan="2">  
      <?php 
  
  $sql2 = mysql_query("SELECT SUM(servic.valor) as total  FROM serv, alunos AS al, servicos AS servic
                       WHERE serv.cliente = al.nome
                       AND servic.id = serv.id_servico
                       AND id_aluno = '$aluno'");
                 while ($resultado = @mysql_fetch_array($sql2)){
                
                 $valor = $resultado['total'];
  

     $vl = number_format($valor,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$vl."</font>"; 
	

  }
   ?> 
  <tr></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="394"><strong>Forma de Pagamento</strong></td>
    <td width="227"><?php echo $cat; ?></td>
    <td width="265"><strong>Valor com Desconto:</strong>      <?php $vl = number_format($vd,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$vl."</font>";  ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>CONTRATO DE PRESTA&Ccedil;&Atilde;O DE SERVI&Ccedil;OS</strong></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><p><br />
      PROVA DE LEGISLA&Ccedil;&Atilde;O:&nbsp;&nbsp; <strong> <?php 
  
  $sql4 = mysql_query("SELECT le.data as dat,le.aluno 
FROM legislacao AS le, alunos AS al
WHERE le.aluno = '$nome' ORDER BY le.id DESC limit 1");
					   
                 while ($resultado = @mysql_fetch_array($sql4)){
                 
				
			
	   $date = $dat = $resultado['dat'];
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	
                  }
  
   ?>  </strong>&nbsp;&nbsp; PROVA DE TRAFEGO:&nbsp;&nbsp; <strong> <?php 
  
  $sql4 = mysql_query("SELECT tra.data as dat, tra.aluno
FROM trafego AS tra, alunos AS al
WHERE tra.aluno = '$nome' ORDER BY tra.id DESC limit 1");
					   
                 while ($resultado = @mysql_fetch_array($sql4)){
                 
				
			
	   $date = $dat = $resultado['dat'];
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	
                  }
  
   ?>  </strong>&nbsp;&nbsp;</p>
      <p>RECEBER A MINHA CARTEIRA CNH: DETRAN PROPRIO CANDIDATO ( ) CASA PELO CORREIO ( )</p>
      <p>CL&Aacute;SULA PRIMEIRA: - A contrata&ccedil;&atilde;o se compromete prestar o servi&ccedil;o de aquisi&ccedil;&atilde;o de 1&ordf; habilita&ccedil;&atilde;o, renova&ccedil;&atilde;o, mudan&ccedil;a de categoria e adi&ccedil;&atilde;o de CNH.</p>
      <p>CL&Aacute;SULA SEGUNDA: - O servi&ccedil;o de 1&ordf; habilita&ccedil;&atilde;o &eacute; composto de curso te&oacute;rico com dura&ccedil;&atilde;o de 45 (quarenta e cinco) horas/aula e curso pr&aacute;tico de dire&ccedil;&atilde;o ve&iacute;culos com dura&ccedil;&atilde;o de 20 (vinte) horas/aula.</p>
      <p>CL&Aacute;SULA TERCEIRA: - Cada hora de curso pr&aacute;tico de dire&ccedil;&atilde;o veicular categoria &ldquo;B&rdquo; ter&aacute; uma dura&ccedil;&atilde;o de 60 (sessenta) minutos em carro pequeno com ar-condicionado e dire&ccedil;&atilde;o hidr&aacute;ulica.</p>
      <p>CL&Aacute;SULA QUARTA: - Quando o candidato for aprovado no Exame Te&oacute;rico receber&aacute; do DETRAN sua licen&ccedil;a de aprendizagem e dever&aacute; apresentar-se &agrave; sede da Contratada para marcar suas aulas Pr&aacute;ticas de Dire&ccedil;&atilde;o Veicular.</p>
      <p>PARAFRADO &Uacute;NICO: Para iniciar a 1&ordf; (primeira) aula pr&aacute;tica de dire&ccedil;&atilde;o veicular, o candidato dever&aacute; apresentar-se &agrave; sede da Contratada (com cal&ccedil;ados adequados). A demais aula caber&aacute; a Contratada buscar e deixar o candidato em sua resid&ecirc;ncia ou trabalho, dependendo do local ap&oacute;s seu t&eacute;rmino, excluindo-se alguns bairros que ficam em locais que n&atilde;o fazem parte da nossa jurisdi&ccedil;&atilde;o: bairros estes que ser&aacute; citado pelo (a) funcion&aacute;rios.</p>
      <p>CL&Aacute;SULA QUINTA: - O candidato a obter a CNH de moto, caminh&atilde;o e &ocirc;nibus ou carreta dever&aacute;, encontra-se com o instrutor pr&aacute;tico no local e hor&aacute;rio combinado por ambos.</p>
      <p>CL&Aacute;SULA SEXTA: - A matricula ser&aacute; feita mediante entrega das Xerox dos documentos de identidade, CPF, comprovante de resid&ecirc;ncia atualizado. Depois receber&aacute; um comprovante para fazer sua foto e assinatura digitais coletadas no sistema do DETRAN, sem os quais a contratada n&atilde;o se responsabilizar&aacute; pelo atraso do inicio dos servi&ccedil;os contratados.</p>
      <p>PARAGRAFO &Uacute;NICO: - Caso o candidato falte qualquer dia do curso te&oacute;rico dever&aacute; aguardar o inicio da pr&oacute;xima turma a fim de concluir sua carga hor&aacute;ria.</p>
      <p>CL&Aacute;SULA S&Eacute;TIMA: - A Contratada n&atilde;o se responsabilizar&aacute; pelo cumprimento da carga hor&aacute;ria do curso te&oacute;rico, caso o candidato n&atilde;o cheque com anteced&ecirc;ncia m&iacute;nima de 15 (quinze) minutos do inicio da aula.</p>
      <p>CL&Aacute;SULA OITAVA: - A Contratada s&oacute; marcara o exame te&oacute;rico e o exame pr&aacute;tico, junto ao DETRAN, quando o candidato concluir a carga hor&aacute;ria do curso te&oacute;rico e pr&aacute;tico.</p>
      <p>PARAGRAFO &Uacute;NICO: - Os Exames te&oacute;ricos e pr&aacute;ticos s&oacute; ser&atilde;o marcados mediante solicita&ccedil;&atilde;o por escrito do candidato, atrav&eacute;s de formul&aacute;rio pr&oacute;prio da contratada.</p>
      <p>CL&Aacute;SULA NONA: - Para a realiza&ccedil;&atilde;o do exame te&oacute;rico, o candidato dever&aacute; apresenta-se ao DETRAN com 30 (trinta) minutos de anteced&ecirc;ncia munido dos documentos de identidade e CPF, originais de trajando-se adequadamente ( Art. 147 do C&oacute;digo tr&acirc;nsito Brasileiro).</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA: - O exame m&eacute;dico e psicol&oacute;gico ser&aacute; de total responsabilidade do cliente, depois que o DETRAN-MA direcionou n&atilde;o temos mais nenhuma responsabilidade se o mesmo estiver lan&ccedil;ado.</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA PRIMEIRA: - Aulas pr&aacute;ticas de dire&ccedil;&atilde;o veicular, em carro pequeno, Moto, Caminh&atilde;o, &Ocirc;nibus e Carretas s&oacute; ser&atilde;o marcadas com a presen&ccedil;a obrigat&oacute;ria do candidato ou seu representante na sede ou filial da Contratada munido de sua licen&ccedil;a de Aprendizagem (LADV).</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA SEGUNDA: - Casa o candidato falte ou fique reprovado no exame Te&oacute;rico e Pr&aacute;tico no DETRAN, dever&aacute; efetuar o pagamento de taxa de pend&ecirc;ncia (conforme legisla&ccedil;&atilde;o em vigor), para que seja marcado novo exame. No exame Pr&aacute;tico tamb&eacute;m dever&aacute; ser pago a taxa de aluguel do carro para novo exame.</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA TERCEIRO: - Se o candidato necessitar de aulas extras dever&aacute; solicitar, pessoalmente ou por seu representante, na sede ou filial da contratada e efetuar agendamento e o pagamento das aulas solicitadas.</p>
      <p>PARAGRAFO &Uacute;NICO: - A contratada reserva-se o direito de n&atilde;o efetuar marca&ccedil;&atilde;o de aulas pr&aacute;ticas de dire&ccedil;&atilde;o veicular por telefone.</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA QUARTA: - O candidato dever&aacute; efetuar o pagamento de taxa de Segunda via caso perca ou em caso de expirar o prazo de validade de sua licen&ccedil;a de aprendizagem que &eacute; de (noventa dias).</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA QUINTA: - Caso haja necessidade, o candidato dever&aacute; desmarcar suas aulas Pr&aacute;ticas com anteced&ecirc;ncia m&iacute;nima de 24 (vinte e quatro) horas, S&aacute;bado at&eacute; as 12h00min horas, n&atilde;o funcionamos aos domingos caso contr&aacute;rio sua aula ser&aacute; computada como ministrada.</p>
      <p>PARAGRAFO &Uacute;NICO: - Haver&aacute; toler&acirc;ncia de atraso de 20 (vinte) minutos para aula Pr&aacute;tica tanto por parte do contratante quanto por parte da contratada.</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA SEXTA: - Caso o candidato n&atilde;o se sinta satisfeito com as aulas ministrado pelo Instrutor Pr&aacute;tico, poder&aacute; comunicar por escrito &aacute; Contratada e solicitar substitui&ccedil;&atilde;o do mesmo.</p>
      <p>PARAGRAFO PRIMEIRO: - Os danos causados ao veiculo por culpa exclusiva do contratante ser&atilde;o de sua plena e total responsabilidade (em especial os candidatos de mudan&ccedil;a C, D e E).</p>
      <p>PARAGRAFO SEGUNDO: - Se o contratante confirmar a data de seu exame te&oacute;rico ou pr&aacute;tico e n&atilde;o comparecer ao DETRAN, o mesmo dever&aacute; arcar com a taxa de remarca&ccedil;&atilde;o e o aluguel do carro.</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA S&Eacute;TIMA: - Caso ocorra reajuste das taxas do DETRAN ou taxas de Servi&ccedil;os caber&aacute; ao Contratante o pagamento da diferen&ccedil;a para a contratada.</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA OITAVA: - A contratada n&atilde;o arcar&aacute; com o deslocamento do contratante &aacute; sua resid&ecirc;ncia ou trabalho, ap&oacute;s o exame de dire&ccedil;&atilde;o veicular.</p>
      <p>CL&Aacute;SULA D&Eacute;CIMA NONA: - A contratada reserva-se o direito de n&atilde;o permitir que o contratante tenha acompanhamento de familiares e/ou amigos durante suas aulas pr&aacute;ticas de dire&ccedil;&atilde;o veicular.</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA: - A Contratante esclarece que a emiss&atilde;o de sua permiss&atilde;o para dirigir (CNH) Carteira Nacional de Habilita&ccedil;&atilde;o e de inteira responsabilidade do DETRAN-MA.</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA PRIMEIRA: - A Contratada disponibiliza os dias de segunda a sexta-feira, nos turnos matutino e vespertino e s&aacute;bado no turno matutino, para aula pr&aacute;tica de dire&ccedil;&atilde;o ao contratante, em caso de aula noturna, s&aacute;bado &agrave; tarde e domingo o candidato pagara uma diferen&ccedil;a a contratada.</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA SEGUNDA: - A forma de pagamento ficar&aacute; a crit&eacute;rio de ambas as partes, no momento da contrata&ccedil;&atilde;o.</p>
      <p>AVISTA______________
        <?php 
  
  $sql2 = mysql_query("SELECT SUM(servic.valor) as total  FROM serv, alunos AS al, servicos AS servic
                       WHERE serv.cliente = al.nome
                       AND servic.id = serv.id_servico
                       AND id_aluno = '$aluno'");
                 while ($resultado = @mysql_fetch_array($sql2)){
                
                 $valor = $resultado['total'];
  

     $vl = number_format($valor,2,",",".");
    
      echo "<font size=\"3\"> R$</strong> "."<font size=\"3\">".$vl."</font>"; 
	

  }
   ?>
      _____________________CART&Atilde;O______________________
     
      ____________________</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA TERCEIRA: - Se for acordado o pagamento da presta&ccedil;&atilde;o de servi&ccedil;o de forma parcelada, caber&aacute; ao contratante o pagamento das parcelas at&eacute; o vencimento estabelecido, atrav&eacute;s de boleto banc&aacute;rio expedido pela contratada e junto s&oacute; redes banc&aacute;rias. Depois do vencimento, o pagamento s&oacute; poder&aacute; ser efetuado nas ag&ecirc;ncias banc&aacute;rias citadas, al&eacute;m do principal, juros de mora de 1% a.m. (um por cento ao m&ecirc;s) acrescidos de multa contratual de 2% (dois por cento), sobre o valor da presta&ccedil;&atilde;o e, ap&oacute;s 05 (cinco) dias decorridos do vencimento, o pagamento s&oacute; ser&aacute; realizado em cart&oacute;rio de protesto.</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA QUARTA: - A Contratada fica desobrigada de marcar exames junto ao DETRAN-MA ou institui&ccedil;&otilde;es credenciadas caso o contratante se encontre inadimplente.</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA QUINTA: - Este contrato tem validade de um ano a partir da data de assinatura das partes. Expirando este prazo, a contrata estar&aacute; isenta de quaisquer obriga&ccedil;&otilde;es para com a contratante.</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA SEXTA: - Se o contratante der causa &agrave; rescis&atilde;o do presente contrato, pagar&aacute; 10% (dez por cento) do valor do pacote a titulo de multa contratual.</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA SETIMA: - A contratada, a fim de garantir a efici&ecirc;ncia total dos servi&ccedil;os, se responsabiliza em presta todos os servi&ccedil;os citados no presente contrato, por&eacute;m esclarece que depende exclusivamente do sistema operacional do DETRAN-MA (SEATI).</p>
      <p>CL&Aacute;SULA VIG&Eacute;SIMA OITAVA: - Fica eleito o f&oacute;rum da comarca de S&atilde;o Luis &ndash; MA para dirimir quaisquer d&uacute;vidas ou conflitos referentes ao presente contrato.</p>
      <p>O CANDIDATO DEVE SE APRESENTAR PARA AULAS E PROVAS PR&Aacute;TICAS VESTINDO CAL&Ccedil;A E COM SAPATOS FECHADOS OU T&Ecirc;NIS, CASO CONTR&Aacute;RIO O MESMO PODER&Aacute; PERDER SUA AULA OU PROVA, E A CONTRATADA N&Atilde;O SE PRESPONSABILIZAR&Aacute; PELO FATO OCORRIDO.</p>
      <p>OBS:</p>
      <p>S&atilde;o Luis (MA), _____de_________________de__________.</p>
      <p>_____________________________ __________________________</p>
      <p>Contratante aluno (a) Secretaria</p>
      <p>_________________________________ ___________________________</p>
      <p>Respons&aacute;vel (Pai, M&atilde;e) CFC GIRO CERTO</p>
      <p><br />
    </p></td>
  </tr>
  <tr>
    <td height="46">&nbsp;</td>
    <td height="46" colspan="2"><form id="form1" name="form1" method="post" action="">
      <label>
      <input name="button" type="submit" id="button" onclick="MM_goToURL('parent','../listas/layout_contrato.php');return document.MM_returnValue" value="VOLTAR" />
      </label>
      <label>
      <input name="button2" type="submit" id="button2" onclick="MM_callJS('print();')" value="IMPRIMIR" />
      </label>
    </form></td>
  </tr>
</table>
</body>
</html>
