			<?php
			@session_start();
			
			?>
			
		
			
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
			<head>
            
            <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
             
			
			<script language="JavaScript">
			function onDelete()
			{
			if(confirm('Deseja Realmente Excluir esses Arquivos ?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
			}
			</script>
			
			<script language=javascript>
function CheckAll() { 
			for (var i=0;i<document.frmMain.elements.length;i++) {
			var x = document.frmMain.elements[i];
			if (x.name == 'chkDel[]') { 
			x.checked = document.frmMain.selall.checked;
			} 
			} 
			}
</script>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<title>Gerenciador Auto Escola</title>
			
			</head>
			
			<?php
			require'../Connections/conexao.php';
			
			for($i=0;$i<count($_POST["chkDel"]);$i++)
			{
			if($_POST["chkDel"][$i] != "")
			{
			$strSQL = "DELETE FROM log";
			$strSQL .="WHERE cod = '".$_POST["chkDel"][$i]."' ";
			$objQuery = mysql_query($strSQL);
			}
			}
			
			$dat = date("Y-m-d");
			?>
            <?php  

function data_extenso(){ 
    // leitura das datas 
    $dia = date('d'); 
    $mes = date('m'); 
    $ano = date('Y'); 
     
    // configuração semana 
    $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) ); 

    switch($diasemana) { 
        case"0": $diasemana = "Domingo";          break; 
        case"1": $diasemana = "Segunda-Feira";  break; 
        case"2": $diasemana = "Terça-Feira";    break; 
        case"3": $diasemana = "Quarta-Feira";      break; 
        case"4": $diasemana = "Quinta-Feira";    break; 
        case"5": $diasemana = "Sexta-Feira";    break; 
        case"6": $diasemana = "Sábado";          break; 
    }  

    // configuração mes 
    switch ($mes){ 
        case 1: $mes = "Janeiro";     break; 
        case 2: $mes = "Fevereiro"; break; 
        case 3: $mes = "Março";     break; 
        case 4: $mes = "Abril";     break; 
        case 5: $mes = "Maio";        break; 
        case 6: $mes = "Junho";     break; 
        case 7: $mes = "Julho";     break; 
        case 8: $mes = "Agosto";     break; 
        case 9: $mes = "Setembro";     break; 
        case 10: $mes = "Outubro";     break; 
        case 11: $mes = "Novembro"; break; 
        case 12: $mes = "Dezembro"; break; 
    } 
     
    //Agora basta imprimir na tela... 
    return "$diasemana, $dia de $mes de $ano"; 
} 

$nome = $_GET['nome'];

?>
			
			<body>
			<br />
			<table width="800" border="0" align="center">
              <tr>
                <td width="570"><img src="../img/LOGO_CARRO.png" width="303" height="97" /></td>
<td width="414"><div align="left"><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Rua 19 Qda. 32 N&#176; 22 Vila Embratel<br />
Contatos: 3228-0014 / 8788-2808<br />
cep: 65080-140 - S&atilde;o Lu&iacute;s - MA<br />
CNPJ: 09.084.236/0001-28</span></div></td>
              </tr>
            </table>
			<br />
			<form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="800" border="0" align="center" bordercolor="#666" class="td2" style="border-collapse:collapse;">
			
			<tr>
			  <td colspan="7" valign="baseline"><hr /></td>
			  </tr>
			<tr>
			  <td valign="baseline"><div style="text-transform:uppercase;">NOME DO ALUNO:</div></td>
			  <td colspan="6"  valign="top" class="td" ><div style="text-transform:uppercase;"><?php  echo $nome; ?></div></td>
			  </tr>
			<tr>
			  <td valign="baseline"><div style="text-transform:uppercase;">Instrutor:</div> </td>
			  <td colspan="6"  valign="top" class="td" ><span class="span6">
			                   <?php $sql3 = mysql_query("SELECT * FROM calendar_events as ev1,calendar_events3 as ev3 WHERE  
			                                              ev1.aluno = '$nome'");
														  while($rs = @mysql_fetch_array($sql3)){
														  $intrutor = $rs['instrutor'];
														  $vei      = $rs['veiculo'];
														  $desc      = $rs['descricao'];
														  
														  
														  }
														  ?>
                                                          
                                                          <?php echo $intrutor;  ?>
              </span></td>
			  </tr>
			<tr>
			  <td valign="baseline"><div style="text-transform:uppercase;">Veiculo:</div> </td>
			  <td colspan="6"  valign="top" class="td" ><span class="span6"><?php echo $vei;  ?></span></td>
			  </tr>
			<tr>
			  <td valign="baseline"><div style="text-transform:uppercase;">Observação:</div> </td>
			  <td colspan="6"  valign="top" class="td" ><span class="span6"><?php echo $desc;  ?></span></td>
			  </tr>
			<tr>
			  <td valign="baseline"></td>
			  <td  valign="top" class="td" ></td>
			  <td colspan="5"  valign="top" class="td">&nbsp;</td>
			  </tr>
			<tr>
			<td width="165" valign="baseline"><div align="left">Data</div></td>
			<td width="143"  valign="top" class="td" >&nbsp;</td>
			<td colspan="3"  valign="top" class="td"><div align="left">Hor&aacute;rios</div></td>
			<td width="46"  valign="top" class="td"><div align="center">Tipo<br />
            </div></td>
			<td width="5"  valign="top" class="td">&nbsp;</td>
			</tr>
			<?php
			
			
			require'../Connections/conexao.php';
			
			$p = $_GET["p"];

            if(isset($p)) {
            $p = $p;
            } else {
            $p = 1;
            }
			
			
			
			$qnt = 10;
			$inicio = ($p*$qnt) - $qnt;
			
			if($_REQUEST['filtro'] == ' ' )
			$filtro = '';
			else
			$filtro = $_REQUEST['filtro'];
			
			if($_REQUEST['filtro1'] == ' ' )
			$filtro1 = '';
			else
			$filtro1 = $_REQUEST['filtro1'];
			
			$sql = "SELECT ev1.event_start, ev1.hora, ev1.event_shortdesc, ev3.veiculo, ev1.mes,ev3.instrutor as inst, ev3.categoria, ev3.tipo, ev3.descricao
FROM calendar_events AS ev1, calendar_events3 AS ev3
WHERE ev1.aluno = '$nome'";
			
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
			<input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id_aluno"];?>">
			</label>			  <span class="span6"><?php 
	   $date = $resultado['event_start'];  
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?> </span></td>
			<td valign="top" class="td3">&nbsp;</td>
			<td colspan="3" valign="top" class="td3"><span class="span6">Das <?php echo $resultado['hora']; ?> &agrave;s <?php echo $resultado['event_shortdesc']; ?></span></td>
			<td valign="top" bgcolor="<?php echo $cor ; ?>" class="td3"><span class="span6"><?php echo $resultado['tipo']; ?></span></td>
			</tr>
			<tr><?php $cont ++; }?>
			<?php
			$sql_select_all = "SELECT * from alunos";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 3;
			?>
			<td colspan="6" align="center" valign="top"><div align="left"><br />
			<br />
		      - &Eacute; proibido aula particular, se ocorrer a Auto Escola n&atilde;o se responsabilizar&aacute;.<br />
		      - &Eacute; proibido acompanhantes nas aulas pr&aacute;ticas.<br />
		      - Para desmarcar aulas somente pelo fone: (98) <span style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">3228-0014 / 8788-2808</span>, com 48 horas de anteced&ecirc;ncia. Caso n&atilde;o <br />
		      desmarque, o aluno perder&aacute; as aulas.<br />
		      - Caso queria mudar de local de encontro, ligar direto para o instrutor com 2 (duas) horas de anteced&ecirc;ncia.<br />
		      - Obrigat&oacute;rio RG e licen&ccedil;a de aprendizagem nas aulas e provas pr&aacute;ticas.<br />
			</div></td>
			</tr>
			<tr>
			  <td colspan="2" align="center" valign="top"><br />
			    <br />
			    <br />
			    _______________________________________<br />
			    <span class="span6">Assinatura</span></td>
			  <td width="119" align="center" valign="top">&nbsp;</td>
			  <td width="89" align="center" valign="top">&nbsp;</td>
			  <td colspan="2" align="center" valign="top"><p><br />
			    <br />
	            <br />
	            <span class="span6">S&atilde;o lu&iacute;s de </span>_____/______/________<br />
			    </p>			    </td>
			  </tr>
			</table>
			</form>
			
			
			
			</div>
		
			</body>
			<?php 
			
			$op="Consultou Operações !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
			</html>