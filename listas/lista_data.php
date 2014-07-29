			<?php
			@session_start();
			
			?>
			
			<?php
			
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
			$strSQL = "DELETE FROM alunos";
			$strSQL .="WHERE id_aluno = '".$_POST["chkDel"][$i]."' ";
			$objQuery = mysql_query($strSQL);
			}
			}

			$dat = date("Y-m-d");
			?>
			
			<body>
			<br />
			<br />
			<br />
			<table width="1000" border="0" align="center" style="border-collapse:collapse;">
			<tr>
			<td bgcolor="#FFFFFF" class="">
			<form name="form2" method="post" action="layout_legislacao_prova.php">
			<label>
			<input class="input"  type="text" name="filtro" id="filtro">
			</label>
			<label>
			<input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
			</label>
			&nbsp; &nbsp; &nbsp;<span class="span7">&nbsp; &nbsp; &nbsp;Exame de tr&aacute;fego
</span>
			</form>
			</td>
			</tr>
			</table>
			
			
			<form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1000" border="0" align="center" bordercolor="#666" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			<td width="129" valign="baseline">
			 
			<input name="selall" id="check" type="checkbox" value="" onclick="CheckAll()" />
		
			<input class="bt" type="submit" name="button2" id="button2" value="Deletar" />			</td>
			<td width="127" valign="top" class="td" ><br /></td>
			<td width="191"  valign="top" class="td" ><br />
			hor&aacute;rio</td>
			<td width="144"  valign="top" class="td"><br />
			data</td>
			<td width="117" valign="top" class="td"><br />			  
			  turno<br /></td>
			<td width="266" valign="top" class="td"><div align="center"><br />
			  Exame</div></td>
			</tr>
			<?php
			
			
		require'../Connections/conexao.php';
			
		$p = $_GET["p"];
			
		if(isset($p)) {
        $p = $p;
        } else {
        $p = 1;
        }
        
        $qnt = 5;
        $inicio = ($p*$qnt) - $qnt;
        
        if($_REQUEST['filtro'] == ' ' )
        $filtro = '';
        else
        $filtro = $_REQUEST['filtro'];
        
        if($_REQUEST['filtro1'] == ' ' )
        $filtro1 = '';
        else
        $filtro1 = $_REQUEST['filtro1'];
			
			$sql = "SELECT * from trafego WHERE aluno like '".$filtro."%' ORDER BY id DESC LIMIT $inicio, $qnt ";
			
			 $rs  = mysql_query($sql);
        
        function geraTimestamp($data) {
        $partes = explode('/', $data);
        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
        }
        $cont = 0;
        while ($resultado = @mysql_fetch_array($rs))
        {
         $data_inicial = date("y-m-d");
         $data_final = $resultado['data'];
	     $time_inicial = strtotime($data_inicial);
         $time_final = strtotime($data_final);
         $diferenca = $time_final - $time_inicial;
         $dias = (int)floor( $diferenca / (60 * 60 * 24));
        
        $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
        ?>
        <tr bgcolor="<?php echo $cor ; ?>">
        <td colspan="2" valign="top" class="td"><label>
        <input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id"];?>">
        <?php echo $resultado['aluno']; ?></label>          <font color="#666666"></td>
        <td valign="top"  class="td"><font color="#666666">Das <?php echo $resultado['hora']; ?> ás <?php echo $resultado['hora1']; ?> </td>
        
        <td valign="top"  class="td"><font color="#666666">
        <?php 
	   $date = $resultado['data'];
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?>
        
        </td>
        <td valign="top"  class="td"><font color="#666666"><?php echo $resultado['turno']; ?></td>
        
        <td valign="top"  class="td" align="left"><font color="#666666"><?php
		    if ($dias >= 10){
            echo "<img src=\"../img/01.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
		    }
		    else if ($dias == 10){
            echo "<img src=\"../img/01.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
		    }
		    else if ($dias == 9){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
		    }
		    else if ($dias == 8){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
		    }
		     else if ($dias == 7){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
		    }
		    else if ($dias == 6){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
		    } else if ($dias == 5){
            echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o  Exame!</span>"."</br>";
			 } else if ($dias == 4){
            echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
            }
			else if ($dias == 3){
             echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
             }
			else if ($dias == 2){
             echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Exame!</span>"."</br>";
			 }
			else if ($dias == 1){
             echo "<img src=\"../img/04.png\" />&nbsp; Falta ".$dias." Dia para o Exame!</span>"."</br>";
			
            } else if ($dias == 0){
            echo "<img src=\"../img/03.png\" />&nbsp; Dia do Exame!"."</br>";
            }
			else if ($dias <= 0){
            echo "<img src=\"../img/06.gif\" />&nbsp;&nbsp;passou o dia do Exame !"."</br>";
			}
			
            ?></td>
        </tr>
        <tr><?php $cont ++; }?>
        <?php
        $sql_select_all = "select * from trafego";
        
        $sql_query_all = @mysql_query($sql_select_all);
        
        $total_registros = @mysql_num_rows($sql_query_all);
        
        $pags = ceil($total_registros/$qnt);
        
        $max_links = 3;
        ?>
        <td colspan="6" align="center" valign="top"><br />
        
        <?php
        
        echo "<a class=\"pag\" href='layout_legislacao_prova.php?p=1' target='_self'>&laquo; Anterior</a> ";
        
        for($i = $p-$max_links; $i <= $p-1; $i++) {
        
        if($i <=0) {
        
        } else {
        
        echo "<a class=\"pag\" href='layout_legislacao_prova.php?p=".$i."' target='_self'>".$i."</a> ";
        }
        }
        
        echo "<span class=\"pag2\"> " .$p." ". "</span>";
        
        for($i = $p+1; $i <= $p+$max_links; $i++) {
        
        if($i > $pags)
        {
        
        }
        
        else
        {
        
        echo "<a class=\"pag\"  href='layout_legislacao_prova.php?p=".$i."' target='_self'>".$i."</a> ";
        }
        }
        
        echo "<a class=\"pag\" href='layout_legislacao_prova.php?p= " .$pags."' target='_self'>Pr&oacute;xima &raquo;</a> ";
        
        ?><br />
			<br /></td>
			</tr>
			</table>
			</form>
			
			
			
			</div>
		
			</body>
			<?php 
			
			$op="Cadastrou um novo Servico !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
			</html>