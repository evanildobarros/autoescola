<?php require_once('../Connections/conexao.php'); ?>
<?php
@session_start();
		require'../Connections/conexao.php';	
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
            
			<title>Gerenciador Despachante</title>
			
			</head>
			
			<?php
			$mes = $_POST['mes'];

          
			
			for($i=0;$i<count($_POST["chkDel"]);$i++)
			{
			if($_POST["chkDel"][$i] != "")
			{
			$strSQL = "DELETE FROM processo";
			$strSQL .="WHERE id_processo = '".$_POST["chkDel"][$i]."' ";
			$objQuery = mysql_query($strSQL);
			}
			}
			
			$dat = date("Y-m-d");
			?>
			
			<body>
			<br />
			<br />
			<table width="1000" border="0" align="center" style="border-collapse:collapse;">
			<tr>
			  <td bgcolor="#FFFFFF" class=""> <div style="margin:30px 0px 0px 0px; font-family: verdana, arial black;font-size:18px;
color:#999999;">M&ecirc;s  de Origem: <?php echo $mes; ?></div>

	

              
 <div style="margin:-30px 0px 0px 800px; font-family: verdana, arial black;font-size:18px;
color:#FFCC33;">Total Geral <?php 
			
		
			$sql5 = mysql_query("select sum(valor2) as total from movimento Where mes = '$mes' and tipo='1'");
			
			while ($result = mysql_fetch_array($sql5)){
			$total = $result['total'];
			echo number_format( $total  , 2 , ',' , '.' );
			}
			
			
			
			?></div>
	          <br />
	          <br /></td>
			  </tr>
			<tr>
			<td bgcolor="#FFFFFF" class="">
			<form name="form2" method="post" action="layout_entrega.php">
			<label>
			<input class="input"  type="text" name="filtro" id="filtro">
			</label>
			<label>
			<input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
			</label>
			<span class="span7">&nbsp; &nbsp; &nbsp;movimenta&Ccedil;&Atilde;o financeiRA CONTAs a receber</span>
			</form>			</td>
			</tr>
			</table>
			
			
			<form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1000" border="0" align="center" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			<td width="123" valign="baseline">
			 
			<input name="selall" id="check" type="checkbox" value="" onclick="CheckAll()" />
		
			<input class="botao" type="submit" name="button2" id="button2" value="Deletar" />			</td>
			<td width="111" valign="top" class="td" ><br /></td>
			<td width="217"  valign="top" class="td" ><br /></td>
			<td width="184"  valign="top" class="td"><br /></td>
			<td width="112" align="center" valign="top" class="td">
            <td></td><br />
  			<br /></td>
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
			
			  $sql = "SELECT * from movimento WHERE mes = '$mes' AND tipo='1' AND status = '2'  AND 
        cliente like '".$filtro."%' AND status like '".$filtro1."%' ORDER BY id_mov DESC LIMIT $inicio, $qnt";
			
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
        <input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id_mov"];?>">
        </label>          <span class="span6"><?php echo $resultado['cliente']; ?></span></td>
        <td valign="top" class="td"><span class="span6"><?php echo $resultado['descricao']; ?></span></td>
        <td valign="top" class="td"><span class="span6"><?php echo $resultado['categoria']; ?></span></td>
        <td valign="top" class="td"><?php if ($resultado['status'] == 2){
               echo "<span class=\"span22\">Em Aberto</span>"; 
               }    ?>            </td>
        <td width="112" valign="top" class="td"><span class="span6">R$&nbsp;<?php $total10 = $resultado['valor2']; echo number_format( $total10  , 2 , ',' , '.' ); ?></span></td>
        <td width="111" valign="top" class="td"><div align="center"><a href="#" onclick="MM_openBrWindow('../financeiro/baixar_pagamento.php?id_mov=<?php echo $resultado['id_mov']  ?>','','scrollbars=yes,resizable=yes,width=400,height=160')"><img src="../img/BTD.jpg" /></a></div></td>
        </tr>
        <tr><?php $cont ++; }?>
			<?php
			$sql_select_all = "select * from movimento";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 3;
			?>
			<td colspan="7" align="center" valign="top"><br />
			
			<?php
			
			echo "<a class=\"pag\" href='layout_entrega.php?p=1' target='_self'><span class=\"\">&laquo; Anterior</span></a> ";
			
			for($i = $p-$max_links; $i <= $p-1; $i++) {
			
			if($i <=0) {
			
			} else {
			
			echo "<a class=\"pag\" href='layout_entrega.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<span class=\"pag2\"> " .$p." ". "</span>";
			
			for($i = $p+1; $i <= $p+$max_links; $i++) {
			
			if($i > $pags)
			{
			
			}
			
			else
			{
			
			echo "<a class=\"pag\"  href='layout_entrega.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<a class=\"pag\" href='layout_entrega.php?p= " .$pags."' target='_self'><span class=\"\">Pr&oacute;xima &raquo;</span></a> ";
			
			?><br />
			<br /></td>
			</tr>
			</table>
			</form>
			
			
			
			</div>
		
			</body>
			<?php 
			
			$op="Consultou Exame de legislação !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
</html>