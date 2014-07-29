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
			$strSQL = "DELETE FROM cliente";
			$strSQL .="WHERE id_cliente = '".$_POST["chkDel"][$i]."' ";
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
			<form name="form2" method="post" action="layout_placas.php">
			<label>
			<input class="input"  type="text" name="filtro" id="filtro">
			</label>
			<label>
			<input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
			</label>
			&nbsp; &nbsp; &nbsp;<span class="span7">Cadastrar nova placa</span>
			</form>
			</td>
			</tr>
			</table>
			
			
			<form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1000" border="0" align="center" bordercolor="#666" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			<td width="127" valign="baseline">
			 
			<input name="selall" id="check" type="checkbox" value="" onclick="CheckAll()" />&nbsp;&nbsp;
		
			<input class="bt5" type="submit" name="button2" id="button2" value="Deletar" />			</td>
			<td width="197" valign="top" class="td" >&nbsp;</td>
			<td width="204"  valign="top" class="td" ><br /></td>
			<td width="177"  valign="top" class="td"><br /></td>
			<td colspan="2" valign="top" class="td"><br />			
			  <br />			  <br /></td>
			</tr>
			<?php
			
			
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
			
		     $sql = "SELECT vei.id_veiculo, cli.cliente, vei.placa, vei.renavam
                FROM veiculos AS vei, cliente AS cli
                WHERE vei.cliente = cli.id_cliente AND cli.cliente like '".$filtro."%' ORDER BY cli.id_cliente DESC LIMIT $inicio, $qnt";
			
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
			<input type="checkbox" name="chkDel[]" value="<?php echo $resultado["cod"];?>">
			</label></td>
			<td valign="top" class="td3"><span class="span6"><?php echo $resultado['cliente']; ?></span></td>
			
			<td class="td3" valign="top"><?php if ($resultado['placa'] == '')
		                        { echo "<span class=\"span8\">Insira nova placa</span>";
								} else {
								echo "<span class=\"span6\">".$resultado['placa']."</span>";
								}
								; ?></td>
			<td valign="top" class="td3"><span class="span6"><?php if ($resultado['renavam'] == '')
		                        { echo "<span class=\"span9\">Insira o Renavam</span>";
								} else {
								echo "<span class=\"span6\">".$resultado['renavam']."</span>";
								}
								; ?></span></td>
			<td width="155" valign="top" class="td3"><div align="center">
<img src="../img/PLCA.jpg" onclick="MM_openBrWindow('ad_placa.php?id_veiculo=<?php echo $resultado['id_veiculo'] ?>','','scrollbars=yes,resizable=yes,width=400,height=200')" /></div></td>
			</tr>
			<tr><?php $cont ++; }?>
			<?php
			$sql_select_all = "SELECT vei.id_veiculo, cli.cliente, vei.placa, vei.renavam
                FROM veiculos AS vei, cliente AS cli
                WHERE vei.cliente = cli.id_cliente";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 3;
			?>
			<td colspan="5" align="center" valign="top"><br />
			
			<?php
			
			echo "<a class=\"pag\" href='layout_placas.php?p=1' target='_self'><span class=\"\">&laquo; Anterior</span></a> ";
			
			for($i = $p-$max_links; $i <= $p-1; $i++) {
			
			if($i <=0) {
			
			} else {
			
			echo "<a class=\"pag\" href='layout_placas.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<span class=\"pag2\"> " .$p." ". "</span>";
			
			for($i = $p+1; $i <= $p+$max_links; $i++) {
			
			if($i > $pags)
			{
			
			}
			
			else
			{
			
			echo "<a class=\"pag\"  href='layout_placas.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<a class=\"pag\" href='layout_placas.php?p= " .$pags."' target='_self'><span class=\"\">Pr&oacute;xima &raquo;</span></a> ";
			
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