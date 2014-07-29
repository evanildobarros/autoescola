<?php require_once('../Connections/conexao.php'); ?>
<?php
@session_start();

include 'functions.php';
if (isset($_GET['acao']) && $_GET['acao'] == 'apagar') {
    $id = $_GET['id'];

    mysql_query("DELETE FROM lc_movimento WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&ok=2");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 'editar_cat') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    mysql_query("UPDATE lc_cat SET nome='$nome' WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_ok=3");
    exit();
}

if (isset($_GET['acao']) && $_GET['acao'] == 'apagar_cat') {
    $id = $_GET['id'];

    $qr=mysql_query("SELECT c.id FROM lc_movimento m, lc_cat c WHERE c.id=m.cat && c.id=$id");
    if (mysql_num_rows($qr)>0){
        header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_err=1");
        exit();
    }
    
    mysql_query("DELETE FROM lc_cat WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_ok=2");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 'editar_mov') {
    $id = $_POST['id'];
    $dia = $_POST['dia'];
    $tipo = $_POST['tipo'];
    $cat = $_POST['cat'];
    $descricao = $_POST['descricao'];
    $valor = str_replace(",", ".", $_POST['valor']);

    mysql_query("UPDATE lc_movimento SET dia='$dia', tipo='$tipo', cat='$cat', descricao='$descricao', valor='$valor' WHERE id='$id'");
    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&ok=3");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 2) {

    $nome = $_POST['nome'];

    mysql_query("INSERT INTO lc_cat (nome) values ('$nome')");

    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&cat_ok=1");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] == 1) {

    $data = $_POST['data'];
    $tipo = $_POST['tipo'];
    $cat = $_POST['cat'];
    $descricao = $_POST['descricao'];
    $valor = str_replace(",", ".", $_POST['valor']);

    $t = explode("/", $data);
    $dia = $t[0];
    $mes = $t[1];
    $ano = $t[2];

    mysql_query("INSERT INTO lc_movimento (dia,mes,ano,tipo,descricao,valor,cat) values ('$dia','$mes','$ano','$tipo','$descricao','$valor','$cat')");

    echo mysql_error();

    header("Location: ?mes=" . $_GET['mes'] . "&ano=" . $_GET['ano'] . "&ok=1");
    exit();
}

if (isset($_GET['mes']))
    $mes_hoje = $_GET['mes'];
else
    $mes_hoje = date('m');

if (isset($_GET['ano']))
    $ano_hoje = $_GET['ano'];
else
    $ano_hoje = date('Y');

		
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
            <script language="JavaScript">
        function abrir(URL) {
        
        var width = 300;
        var height = 180;
        
        var left = 50;
        var top = 50;
        
        window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
        
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
            
			<title>Gerenciador Imobiliaria</title>
			
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
			<div class="banner">
	
	<div class="logo"><img width="280" height="80" src="../img/logo.png"></div>
	<div class="titulo">
	<span class="span1"><a style="color:#FFF; text-decoration:none;" href="?mes=<?php echo date('m')?>&amp;ano=<?php echo date('Y')?>">Hoje: <?php echo date('d')?> de <?php echo mostraMes(date('m'))?> de <?php echo date('Y')?></a><br>
	Usuário: <span class="span2"><?php echo $_SESSION['MM_Username']; ?></span><br>
    <span ><a class="span15" href="../logout.php">sair</a></span></div>
	
	
	</div>
	<div class="cont_menu">
	<?php include('../listas/menu.php');  ?>
	</div>
    <div class="conteudo"><br />
<br />

    
    <table cellpadding="1" cellspacing="5"  width="1200" align="center" style="background-color:#00CC33;">

<tr>

<td width="70">
<select onchange="location.replace('?mes=<?php echo $mes_hoje?>&ano='+this.value)">
<?php
for ($i=2008;$i<=2020;$i++){
?>
<option value="<?php echo $i?>" <?php if ($i==$ano_hoje) echo "selected=selected"?> ><?php echo $i?></option>
<?php }?>
</select>
</td>


<?php
for ($i=1;$i<=12;$i++){
	?>
    <td align="center" style="<?php if ($i!=12) echo "border-right:1px solid #FFF;"?>">
    <a href="?mes=<?php echo $i?>&ano=<?php echo $ano_hoje?>" style="
    <?php if($mes_hoje==$i){?>    
    color:#00FFFF; font-size:13px; font-weight:bold; padding:5px; text-decoration:none;
    <?php }else{?>
    color:#fff; font-size:13px; text-decoration:none;
    <?php }?>
    ">
    <?php echo mostraMes($i);?>
    </a>
    </td>
<?php
}
?>
</tr>

<tr>
<td>



</td>
</tr>
</table><br />


    
    <table width="1200" border="0" align="center" style="border-collapse:collapse;">
			<tr>
			  <td bgcolor="#FFFFFF" class="">
              
              <div style="margin:0px 0px 0px 700px; font-family: verdana, arial black;font-size:18px;
color:#CC0033;">Total Geral <?php 
			
		
			$sql5 = mysql_query("SELECT SUM(valor2) as total from lc_movimento WHERE tipo = '0' AND status='2' AND mes='$mes_hoje'");
			
			while ($result = @mysql_fetch_array($sql5)){
			$total = $result['total'];
			echo number_format( $total  , 2 , ',' , '.' );
			}
			
			
			
			?></div>
	          </td>
			  </tr>
			<tr>
			<td bgcolor="#FFFFFF" class="">
			<form name="form2" method="post" action="layout_contas_devedor.php">
			<label>
			<input class="input"  type="text" name="filtro" id="filtro">
			</label>
			<label>
			<input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
			</label>
			<span class="span7">&nbsp; &nbsp; &nbsp;Lan&ccedil;amentos ( Contas a Pagar)</span>
			</form>			</td>
			</tr>
			</table>
			
			
			<form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
			<table width="1200" border="0" align="center" class="td2" style="border-collapse:collapse;">
			
			
	  
			<tr>
			<td width="209" valign="baseline">
			 
			<input name="selall" id="check" type="checkbox" value="" onclick="CheckAll()" />
		
			<input class="botao" type="submit" name="button2" id="button2" value="Deletar" />			</td>
			<td  valign="top" class="td" ><br /></td>
			<td  valign="top" class="td" ><br /></td>
			<td  valign="top" class="td"><br /></td>
			<td  align="center" valign="top" class="td">
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
			
			$qnt = 20;
			$inicio = ($p*$qnt) - $qnt;
			
			if($_REQUEST['filtro'] == ' ' )
			$filtro = '';
			else
			$filtro = $_REQUEST['filtro'];
			
			if($_REQUEST['filtro1'] == ' ' )
			$filtro1 = '';
			else
			$filtro1 = $_REQUEST['filtro1'];
			
			 $sql = "SELECT lcm.id,lcm.vencimento,lcm.valor2,lcm.dia,lcm.mes,lcm.ano,lcm.cliente,lcm.fornecedor,lcm.descricao,lcm.mes,cat.nome,lcm.valor,lcm.status from lc_movimento as lcm,lc_cat as cat WHERE lcm.cat = cat.id AND mes='$mes_hoje' AND lcm.tipo = '0' AND lcm.status='2' AND lcm.fornecedor like '".$filtro."%' ORDER BY lcm.id DESC LIMIT $inicio, $qnt  ";
			
			$rs  = mysql_query($sql);
			
			function geraTimestamp($data) {
			$partes = explode('/', $data);
			return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
			}
			$cont = 0;
			while ($resultado = @mysql_fetch_array($rs))
        {
         $data_inicial = date("Y-m-d");
         $data_final = $resultado['vencimento'];
	     $time_inicial = strtotime($data_inicial);
         $time_final = strtotime($data_final);
         $diferenca = $time_final - $time_inicial;
         $dias = (int)floor( $diferenca / (60 * 60 * 24));
        
        $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
        ?>
		 <tr bgcolor="<?php echo $cor ; ?>">
        <td valign="top" class="td"><label>
        <input type="checkbox" name="chkDel[]" value="<?php echo $resultado["id"];?>">
        </label>          <span class="span6"><?php echo $resultado['cliente']; ?><?php echo $resultado['fornecedor']; ?></span></td>
        <td valign="middle" class="td"><div align="center"><span class="span6"><?php 
	   $date = $resultado['vencimento']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?></span></div></td>
        <td valign="middle" class="td"><span class="span6"><?php echo $resultado['nome']; ?></span></td>
        
        <td valign="middle" class="td"><?php if ($resultado['status'] == 2){
               echo "<span class=\"span22\">Em Aberto</span>"; 
               }    ?> </td>
        <td  valign="middle" class="td"><span class="span6">R$&nbsp;<?php $total10 = $resultado['valor2']; echo number_format( $total10  , 2 , ',' , '.' ); ?></span></td>
        <td  valign="middle" class="td"><span class="span6"> <?php
		    if ($dias >= 10){
            echo "<img src=\"../img/01.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 10){
            echo "<img src=\"../img/01.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 9){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 8){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 7){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    }
		    else if ($dias == 6){
            echo "<img src=\"../img/05.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
		    } else if ($dias == 5){
            echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o  Pagamento!</span>"."</br>";
			 } else if ($dias == 4){
            echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
            }
			else if ($dias == 3){
             echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
             }
			else if ($dias == 2){
             echo "<img src=\"../img/04.png\" />&nbsp; Faltam ".$dias." Dias para o Pagamento!</span>"."</br>";
			 }
			else if ($dias == 1){
             echo "<img src=\"../img/04.png\" />&nbsp; Falta ".$dias." Dia para o Pagamento!</span>"."</br>";
			
            } else if ($dias == 0){
            echo "<img src=\"../img/03.png\" />&nbsp; Dia do Pagamento!"."</br>";
            }
			else if ($dias <= 0){
            echo "<img src=\"../img/06.gif\" />&nbsp;&nbsp;passou o dia do Pagamento!"."</br>";
			}
			
            ?></span></td>
        
                <td  valign="top" class="td"><div align="center"><a  href="javascript:abrir('baixar.php?id=<?php echo $resultado['id']; ?>')"><img width="80" height="35" src="../img/icon_baixar.gif" /></a></div></td>
        </tr>
        <tr><?php $cont ++; }?>

			<?php
			$sql_select_all = "select * from lc_movimento";
			
			$sql_query_all = @mysql_query($sql_select_all);
			
			$total_registros = @mysql_num_rows($sql_query_all);
			
			$pags = ceil($total_registros/$qnt);
			
			$max_links = 3;
			?>
			<td colspan="7" align="center" valign="top"><br />
			
			<?php
			
			echo "<a class=\"pag\" href='layout_contas_devedor.php?p=1' target='_self'><span class=\"\">&laquo; Anterior</span></a> ";
			
			for($i = $p-$max_links; $i <= $p-1; $i++) {
			
			if($i <=0) {
			
			} else {
			
			echo "<a class=\"pag\" href='layout_contas_devedor.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<span class=\"pag2\"> " .$p." ". "</span>";
			
			for($i = $p+1; $i <= $p+$max_links; $i++) {
			
			if($i > $pags)
			{
			
			}
			
			else
			{
			
			echo "<a class=\"pag\"  href='layout_contas_devedor.php?p=".$i."' target='_self'>".$i."</a> ";
			}
			}
			
			echo "<a class=\"pag\" href='layout_contas_devedor.php?p= " .$pags."' target='_self'><span class=\"\">Pr&oacute;xima &raquo;</span></a> ";
			
			?><br />
			<br /></td>
			</tr>
			</table>
            </form>
    
    </div>
			
			
			
			
			
			</div>
		
			</body>
			<?php 
			
			$op="Consultou Exame de legislação !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
</html>