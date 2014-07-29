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
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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

//Ex.:  data_extenso(); 
//retorno   Terça-Feira, 27 de Novembro de 2012 
?>
			
			<body>
			<br />
			<br />
			<table width="1000" border="0" align="center" style="border-collapse:collapse;">
			<tr>
			<td bgcolor="#FFFFFF" class="">
			<form name="form2" method="post" action="layout_carga_simulador.php">
			<label>
			<input class="input"  type="text" name="filtro" id="filtro">
			</label>
			<label>
			<input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
			</label>
			&nbsp; &nbsp; &nbsp;<span class="span7">Cargar hor&aacute;ria  em rela&ccedil;&atilde;o as aulas no simulador 
			</span>
			</form>
			</td>
			</tr>
			</table>
			
			
			<form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1000" border="0" align="center" bordercolor="#666" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			<td width="129" valign="baseline">
			 
			<input name="selall" id="check" type="checkbox" value="" onclick="CheckAll()" />&nbsp;&nbsp;
		
			<input class="bt5" type="submit" name="button2" id="button2" value="Deletar" />			</td>
			<td width="112" valign="top" class="td" >&nbsp;</td>
			<td width="267"  valign="top" class="td" ><br /></td>
			<td width="348"  valign="top" class="td"><br /></td>
			<td width="122" colspan="2" valign="top" class="td"><br />			
			  <br />			  <br /></td>
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
			
			 $sql = "SELECT DISTINCT id,aluno,qtd,hora from carga2 WHERE aluno like '".$filtro."%' ORDER BY id DESC LIMIT $inicio, $qnt";
			
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
        <td colspan="2" valign="top" class="td"><label>
        <input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id"];?>">
        </label>          <font color="#666666"><?php echo $resultado['aluno']; ?></td>
        <td valign="top"  class="td"><font color="#666666"><?php
		
		                        if ($resultado['qtd'] == '')
		                        { echo "<font color=\"red\">Nenhuma aula registrada !";
								} else {
								echo $resultado['qtd']." Aula(s) Registrada(s) !";
								}
								?></td>
        
        <td valign="top"  class="td" align="left"><span class="style2">Restam</span>&nbsp;<font color="#666666">&nbsp;
<?php
		
	
$hora = $resultado['hora'];

$horaacesso = "$hora"; 
$horasaida  = "45"; 


list($horas_acesso,$minutos_acesso,$segundos_acesso) = explode(":", 
$horaacesso); 

$horas_acesso1 = $horas_acesso * 3600; 
$minutos_acesso1 = $minutos_acesso * 60; 

$total_acesso = $horas_acesso1 + $minutos_acesso1 + $segundos_acesso; 

list($horas_saida,$minutos_saida,$segundos_saida) = explode(":", 
$horasaida); 

$horas_saida1 = $horas_saida * 3600; 
$minutos_saida1 = $minutos_saida * 60; 

$total_saida = $horas_saida1 + $minutos_saida1 + $segundos_saida; 

$total = ($total_saida - $total_acesso); 

$time = ($total/3600); 
list($horas) = explode(".", $time); 
$resto_segundos = ($total % 3600);// resto da divisao por 3600 
$c = ($resto_segundos/60); 
list($minutos) = explode(".", $c); 
$segundos = ($total % 60); 

echo $permanencia = $horas.":".$minutos.":".$segundos;
if ($horas == 5){
echo  "<font color=\"red\" >   Hóras Apenas ! (Atenção)</font>&nbsp; &nbsp; <img src=\"../img/03.gif\" /> ";
}else if($horas == 1){
echo  " Carga horaria esgotada ! <img src=\"../img/06.gif\" /> ";
}else{
echo "<font color=\"blue\"> h&oacute;ras para conclus&atilde;o do curso</font>";
}
?> 
	
		<span class="style2"></span></td>
        <td align="left" valign="top"  class="td style1"><div align="center"><a href="#" onclick="MM_openBrWindow('registrar_simulador.php?id=<?php echo $resultado['id']; ?>','','scrollbars=yes,resizable=yes,width=300,height=160')"><img src="../img/BTS.jpg" /></a></div></td>
        </tr>
        <tr><?php $cont ++; }?>
			<?php
			$sql_select_all = "select * from carga";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 3;
			?>
			<td colspan="5" align="center" valign="top"><br />
			
			<?php
			
			echo "<a class=\"pag\" href='layout_carga_simulador.php?p=1' target='_self'><span class=\"\">&laquo; Anterior</span></a> ";
			
			for($i = $p-$max_links; $i <= $p-1; $i++) {
			
			if($i <=0) {
			
			} else {
			
			echo "<a class=\"pag\" href='layout_carga_simulador.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<span class=\"pag2\"> " .$p." ". "</span>";
			
			for($i = $p+1; $i <= $p+$max_links; $i++) {
			
			if($i > $pags)
			{
			
			}
			
			else
			{
			
			echo "<a class=\"pag\"  href='layout_carga_simulador.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<a class=\"pag\" href='layout_carga_simulador.php?p= " .$pags."' target='_self'><span class=\"\">Pr&oacute;xima &raquo;</span></a> ";
			
			?><br />
			<br /></td>
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