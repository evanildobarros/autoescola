<?php 
session_start();

include 'functions.php';

require_once('../Connections/conexao.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conexao, $conexao);
$query_fpg = "SELECT * FROM forma_pg ORDER BY `desc` ASC";
$fpg = mysql_query($query_fpg, $conexao) or die(mysql_error());
$row_fpg = mysql_fetch_assoc($fpg);
$totalRows_fpg = mysql_num_rows($fpg);


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
	
	$cli = $_SESSION['MM_Username'];
}

if (isset($_POST['acao']) && $_POST['acao'] == 1) {

    $data        = $_POST['data'];
    $tipo        = $_POST['tipo'];
    $cat         = $_POST['cat'];
	$id_cli      = $_POST['id_cliente'];
	$cliente     = $_POST['cliente'];
    $descricao   = $_POST['descricao'];
    $valor       = str_replace(",", ".", $_POST['valor']);
	$valor2      = str_replace(",", ".", $_POST['valor2']);
	$status      = $_POST['status'];
	$vencimento  = $_POST['vencimento'];
	$fornecedor  = $_POST['fornecedor'];
	$f_pagamento = $_POST['fpagamento'];
	$nota        = $_POST['nota'];
	$m           = $_POST['m'];
    $fun         = $_POST['funcionario'];
    $t = explode("/", $data);
    $dia = $t[0];
    $mes = $t[1];
    $ano = $t[2];

    mysql_query("INSERT INTO lc_movimento (dia,mes,ano,cat,id_cliente,cliente,tipo,descricao,valor,valor2,status,vencimento,fpagamento,m,fornecedor,nota,funcionario) values ('$dia','$mes','$ano','$cat','$id_cli','$cliente','$tipo','$descricao','$valor','$valor2','$status','$vencimento','$f_pagamento','$m','$fornecedor','$nota','$fun')");

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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<meta name="LANGUAGE" content="Portuguese" />
<meta name="AUDIENCE" content="all" />
<meta name="RATING" content="GENERAL" />
<link href="../css/layout.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts.js">

</script>

   <script language="JavaScript">
        function abrir(URL) {
        
        var width = 400;
        var height = 400;
        
        var left = 50;
        var top = 50;
        
        window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
        
        }
        </script>
        <script>
			function alterna(tipo) {
			
			if (tipo == 2	) {
			document.getElementById("tipo1").style.display = "block";
			document.getElementById("tipo2").style.display = "none";
			} else {
			document.getElementById("tipo1").style.display = "none";
			document.getElementById("tipo2").style.display = "block";
			}
			
			}
</script>
			
</head>
<body>
<div class="banner">
<div class="logo"><img width="280" height="80" src="../img/logo.png"></div>
<div class="titulo">
	<span class="span1"><a style="color:#FFF; text-decoration:none;" href="?mes=<?php echo date('m')?>&ano=<?php echo date('Y')?>">Hoje: <?php echo date('d')?> de <?php echo mostraMes(date('m'))?> de <?php echo date('Y')?><br>
	Usuário: <span class="span2"><?php echo $_SESSION['MM_Username']; ?></span><br>
  <span ><a class="span15" href="../logout.php">sair</a></span></div>
</div>
<div class="cont_menu">
	<?php include('../listas/menu.php');  
	
	
	
	?>
<?php
mysql_free_result($fpg);
?>
	</div>
    
    <div class="conteudo"><br />
<br />

    <table cellpadding="1" cellspacing="10"  width="1100" align="center" style="background-color:#00CC33;">



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
    <td align="center" style="<?php if ($i!=12) echo "border-right:1px solid #FFF;"?> padding-right:5px">
    <a href="?mes=<?php echo $i?>&ano=<?php echo $ano_hoje?>" style="
    <?php if($mes_hoje==$i){?>    
    color:#006633; font-size:12px; padding:5px; text-decoration:none;
    <?php }else{?>
    color:#fff; font-size:12px; text-decoration:none;
    <?php }?>
    ">
    <?php echo mostraMes($i);?>
    </a>
    </td>
<?php
}
?>
</tr>
</table>
<br />



<table cellpadding="10" cellspacing="0" width="900" align="center" >
<tr>
<td colspan="2">

<h2><?php echo mostraMes($mes_hoje)?>/<?php echo $ano_hoje?></h2>
</td>
<td align="right">
<a class="span9" href="javascript:abrir('fornecedor.php')">[+] Forncedor</a>
<a href="javascript:;" onclick="abreFecha('add_cat')" ></a>
<a href="javascript:;" onclick="abreFecha('add_cat')" class="span11">[+] Adicionar Categoria</a>
<a href="javascript:;" onclick="abreFecha('add_movimento')" class="span10"><strong>[+] Adicionar Movimento</strong></a>
</td>
</tr>

<tr >
<td colspan="3" >

    <?php
if (isset($_GET['cat_err']) && $_GET['cat_err']==1){
?>

<div style="padding:5px; background-color:#FF[; text-align:center; color:#030">
<strong>Esta categoria não pode ser removida, pois há movimentos associados a esta</strong>
</div>

<?php }?>

    <?php
if (isset($_GET['cat_ok']) && $_GET['cat_ok']==2){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Categoria removida com sucesso!</strong>
</div>

<?php }?>
    
<?php
if (isset($_GET['cat_ok']) && $_GET['cat_ok']==1){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Categoria Cadastrada com sucesso!</strong>
</div>

<?php }?>
    
    <?php
if (isset($_GET['cat_ok']) && $_GET['cat_ok']==3){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Categoria alterada com sucesso!</strong>
</div>

<?php }?>

<?php
if (isset($_GET['ok']) && $_GET['ok']==1){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Movimento Cadastrado com sucesso!</strong>
</div>

<?php }?>

<?php
if (isset($_GET['ok']) && $_GET['ok']==2){
?>

<div style="padding:5px; background-color:#900; text-align:center; color:#FFF">
<strong>Movimento removido com sucesso!</strong>
</div>

<?php }?>
    
    <?php
if (isset($_GET['ok']) && $_GET['ok']==3){
?>

<div style="padding:5px; background-color:#FF6; text-align:center; color:#030">
<strong>Movimento alterado com sucesso!</strong>
</div>

<?php }?>

<div style=" background-color:#F1F1F1; padding:10px; border:1px solid #999; margin:5px; display:none" id="add_cat">
    <h3>Adicionar Categoria</h3>
    <table width="100%">
        <tr>
            <td valign="top">
    

<form method="post" action="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>">
<input type="hidden" name="acao" value="2" />

Nome: <input type="text" name="nome" size="20" maxlength="50" />

<br />
<br />

<input type="submit" class="botao" value="Enviar" />
</form>

            </td>
            <td valign="top" align="right">
                <b>Editar/Remover Categorias:</b><br/><br/>
<?php
$qr=mysql_query("SELECT id, nome FROM lc_cat");
while ($row=mysql_fetch_array($qr)){
?>
                <div id="editar2_cat_<?php echo $row['id']?>">
<?php echo $row['nome']?>  
                    
                     <a style="font-size:10px; color:#666" onclick="return confirm('Tem certeza que deseja remover esta categoria?\nAtenção: Apenas categorias sem movimentos associados poderão ser removidas.')" href="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>&acao=apagar_cat&id=<?php echo $row['id']?>" title="Remover">[remover]</a>
                     <a href="javascript:;" style="font-size:10px; color:#666" onclick="document.getElementById('editar_cat_<?php echo $row['id']?>').style.display=''; document.getElementById('editar2_cat_<?php echo $row['id']?>').style.display='none'" title="Editar">[editar]</a>
                    
                </div>
                <div style="display:none" id="editar_cat_<?php echo $row['id']?>">
                    
<form method="post" action="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>">
<input type="hidden" name="acao" value="editar_cat" />
<input type="hidden" name="id" value="<?php echo $row['id']?>" />
<input type="text" name="nome" value="<?php echo $row['nome']?>" size="20" maxlength="50" />
<input type="submit" class="botao" value="Alterar" />
</form> 
                </div>

<?php }?>

            </td>
        </tr>
    </table>
</div>



<div style=" background-color:#FBFBFB; padding:10px; border:1px solid #999; margin:5px; display:none" id="add_movimento">
<h3><font color="#CC0000">Contas a Pagar </font> / <font color="#0066FF">Contas a receber</font></h3>
<form method="post" action="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>">
<input type="hidden" name="acao" value="1" />
<input type="hidden"  name="id_cliente" value="<?php  echo $_SESSION['MM_Username']; ?>" />


<input type="hidden" name="data" size="11" maxlength="10" value="<?php echo date('d')?>/<?php echo $mes_hoje?>/<?php echo $ano_hoje?>" />
<input name="m" value="<?php echo mostraMes($mes_hoje)?>" type="hidden" />

<?php
$qr=mysql_query("SELECT * FROM lc_cat order by nome asc");
if (mysql_num_rows($qr)==0)
	echo "Adicione ao menos uma categoria";

else{
?>
<table width="800" border="0" align="center">
  <tr>
    <td><strong>Fornecedor</strong></td>
    <td><select name="fornecedor">
<option value="">Selecione</option>
<?php
$qr11=mysql_query("SELECT * FROM fornecedor order by nome asc");
while ($row6=@mysql_fetch_array($qr11)){
$ene = $row6['nome'];

?>
<option value="<?php echo $ene; ?>"><?php echo $ene; ?></option>
<?php }?>
</select></td>
    <td><strong>Alunos</strong></td>
    <td><select name="cliente">
<option value="">Selecione</option>
<?php
$qr178=mysql_query("SELECT * FROM alunos order by nome asc");
while ($row56=@mysql_fetch_array($qr178)){
$ene = $row56['nome'];

?>
<option value="<?php echo $ene; ?>"><?php echo $ene; ?></option>
<?php }?>
</select><br />
</td>
    <td><strong>Instrutor</strong></td>
    <td><select name="funcionario">
<option value="">Selecione</option>
<?php
$qr178=mysql_query("SELECT * FROM instrutor order by nome asc");
while ($row56=@mysql_fetch_array($qr178)){
$ene = $row56['nome'];

?>
<option value="<?php echo $ene; ?>"><?php echo $ene; ?></option>
<?php }?>
</select></td>
    
  </tr>
  <tr>
  <td valign="top"><strong>Categoria:</strong></td>
  <td valign="top"><input type="hidden" name="status" value="1" />
<select name="cat">
<option>Selecione</option>
<?php
while ($row=mysql_fetch_array($qr)){
?>
<option value="<?php echo $row['id']?>"><?php echo $row['nome']?></option>
<?php }?>
</select></td>
  <td valign="top"><strong>tipo</strong></td>
  <td colspan="3"><label for="tipo_receita" style="color:#0033CC"><input type="radio" name="tipo" value="1" id="tipo_receita" /> Receita</label>&nbsp; 
<label for="tipo_despesa" style="color:#C00"><input type="radio" name="tipo" value="0" id="tipo_despesa" checked="checked" /> Despesa</label>
<label for="tipo_Emberto" style="color:#009999"><input type="radio" name="status" value="2" onclick="alterna(this.value);" /> Em Abero<br />
<div id="tipo1" style="display:none;">
			  <input name="valor2"  value="" class="placeholder" placeholder="Valor a ser cobrado !" size="25">
			  </div></td>

 
  </tr>
  <tr>
  <td><strong>Forma de Pagamento</strong></td>
  <td><select name="fpagamento">
<option>Selecione</option>
<?php
$qr1=mysql_query("SELECT * FROM forma_pg");
while ($row5=@mysql_fetch_array($qr1)){
$en = $row5['desc'];

?>
<option value="<?php echo $en; ?>"><?php echo $en; ?></option>
<?php }?>
</select></td>
  <td><strong>Vencimento</strong></td>
  <td><input type="date" name="vencimento" size="100px"/><span class="span8">* Campo Obrigatorio</span></td>
  
  </tr>
  <tr>
  <td><strong>Valor</strong></td>
  <td><input placeholder="R$" type="text" name="valor" size="8" maxlength="10" /></td>
  </tr>
  <tr>
  <td><strong>Descrição</strong></td>
  <td><textarea name="descricao" cols="" rows=""></textarea></td>
  
  </tr>
  <tr>
  <td><input type="submit" class="botao" value="Enviar" /></td>
  </tr>
</table>

</form>
<?php }?>
</div>
</td>
</tr>

<tr>
<td align="left" valign="top" width="450" style="background-color:#00CC33;">

<?php
$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=1 && mes='$mes_hoje' && ano='$ano_hoje'");
$row=mysql_fetch_array($qr);
$entradas=$row['total'];

$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=0 && mes='$mes_hoje' && ano='$ano_hoje'");
$row=mysql_fetch_array($qr);
$saidas=$row['total'];

$resultado_mes=$entradas-$saidas;
?>

    <fieldset style="width:500px; border:1px solid #0099CC;">
        <legend style="font-size:14px;">Entradas e Saídas deste mês</legend><br />

        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td><span style="font-size:18px; color:#3b5998;">Entradas:</span></td>
                <td align="right"><span style="font-size:18px; color:#3b5998;"><?php echo formata_dinheiro($entradas) ?></span></td>
            </tr>
            <tr>
                <td><span style="font-size:18px; color:#C00">Saídas:</span></td>
                <td align="right"><span style="font-size:18px; color:#C00"><?php echo formata_dinheiro($saidas) ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr size="1" />
                </td>
            </tr>
            <tr>
                <td><strong style="font-size:22px; color:<?php if ($resultado_mes < 0) echo "#C00"; else echo "#3b5998" ?>">Resultado:</strong></td>
                <td align="right"><strong style="font-size:22px; color:<?php if ($resultado_mes < 0) echo "#C00"; else echo "#3b5998" ?>"><?php echo formata_dinheiro($resultado_mes) ?></strong></td>
            </tr>
        </table>
    </fieldset>

</td>

<td width="15">
</td>

<td align="left" valign="top" width="450" style="background-color:#FFCC33;">
<fieldset style="width:500px">
<legend style="font-size:14px; border:1px solid #003366;">Balanço Geral</legend><br />


<?php

$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=1 ");
$row=mysql_fetch_array($qr);
$entradas=$row['total'];

$qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=0 ");
$row=mysql_fetch_array($qr);
$saidas=$row['total'];

$resultado_geral=$entradas-$saidas;
?>


<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><span style="font-size:18px; color:#3b5998">Entradas:</span></td>
<td align="right"><span style="font-size:18px; color:#3b5998"><?php echo formata_dinheiro($entradas)?></span></td>
</tr>
<tr>
<td><span style="font-size:18px; color:#C00">Saídas:</span></td>
<td align="right"><span style="font-size:18px; color:#C00"><?php echo formata_dinheiro($saidas)?></span></td>
</tr>
<tr>
<td colspan="2">
<hr size="1" />
</td>
</tr>
<tr>
<td><strong style="font-size:22px; color:<?php if ($resultado_geral<0) echo "#C00"; else echo "#3b5998"?>">Resultado:</strong></td>
<td align="right"><strong style="font-size:22px; color:<?php if ($resultado_geral<0) echo "#C00"; else echo "#3b5998"?>"><?php echo formata_dinheiro($resultado_geral)?></strong></td>
</tr>
</table>

</fieldset>
</td>

</tr>
</table>
<br />


<table cellpadding="5" cellspacing="0" width="1100" align="center">
<tr>
<td colspan="2">
    <div style="float:right; text-align:right">
<form name="form_filtro_cat" method="get" action=""  >
<input type="hidden" name="mes" value="<?php echo $mes_hoje?>" >
<input type="hidden" name="ano" value="<?php echo $ano_hoje?>" >
    Filtrar por categoria:  <select name="filtro_cat" onchange="form_filtro_cat.submit()">
<option value="">Tudo</option>
<?php
$qr=mysql_query("SELECT DISTINCT c.id, c.nome FROM lc_cat c, lc_movimento m WHERE m.cat=c.id && m.mes='$mes_hoje' && m.ano='$ano_hoje'");
while ($row=mysql_fetch_array($qr)){
?>
<option <?php if (isset($_GET['filtro_cat']) && $_GET['filtro_cat']==$row['id'])echo "selected=selected"?> value="<?php echo $row['id']?>"><?php echo $row['nome']?></option>
<?php }?>
</select>
  <input type="submit" value="Filtrar" class="botao" />
</form>
    </div>

<h2>Movimentos deste Mês</h2>

</td>
</tr>
<?php
$filtros="";
if (isset($_GET['filtro_cat'])){
	if ($_GET['filtro_cat']!=''){	
		$filtros="&& cat='".$_GET['filtro_cat']."'";
                
                $qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=1 && mes='$mes_hoje' && ano='$ano_hoje' $filtros");
                $row=mysql_fetch_array($qr);
                $entradas=$row['total'];

                $qr=mysql_query("SELECT SUM(valor) as total FROM lc_movimento WHERE tipo=0 && mes='$mes_hoje' && ano='$ano_hoje' $filtros");
                $row=mysql_fetch_array($qr);
                $saidas=$row['total'];

                $resultado_mes=$entradas-$saidas;
                
        }
}

$qr=mysql_query("SELECT * FROM lc_movimento WHERE mes='$mes_hoje' && ano='$ano_hoje' $filtros ORDER By id desc");
$cont=0;
while ($row=mysql_fetch_array($qr)){
$cont++;

$cat=$row['cat'];
$qr2=mysql_query("SELECT DISTINCT nome FROM lc_cat WHERE id='$cat'");
$row2=mysql_fetch_array($qr2);
$categoria=$row2['nome'];

?>
<tr style="background-color:<?php if ($cont%2==0) echo "#F1F1F1"; else echo "#E0E0E0"?>" >
<td align="center" width="15"></td>
<td class="font">

<span class="span10">
        <?php 
	   $date = $row['vencimento']; 
	  
	   $your_date = date("d/m/Y", strtotime($date));
	   echo $your_date;
	   ?> | <?php echo $row['id_cliente']?> | <span class="span3"><?php echo $row['cliente']?><?php echo $row['funcionario']?><?php echo $row['fornecedor']?></span>
        <span class="span11">  </span> | 
      <span class="span11"><?php echo $row['fpagamento']?></span> | 
	  <?php echo $row['descricao']?> <?php echo $row['desc']?> <em> |
	  
	  <span class="span19"><?php echo $row['form_pg']?></span> | 
      <span class="span45"><?php echo $row['form_pg2']?></span>
      (<a href="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>&filtro_cat=<?php echo $cat?>"><?php echo $categoria?></a>)</em> 
       [<a href="recibo3.php?id=<?php echo $row['id']; ?>">Recibo</a>]
       <a href="javascript:;" style="font-size:10px; color:#666" onclick="document.getElementById('editar_mov_<?php echo $row['id']?>').style.display='';  " title="Editar"><img width="17" height="17" src="../img/pen_write_edit.png" /></a>
       
       
       </td>
<td align="right"><strong style="color:<?php if ($row['tipo']==0) echo "#C00"; else echo "#030"?>"><?php if ($row['tipo']==0) echo "-"; else echo "+"?><?php echo formata_dinheiro($row['valor'])?></strong></td>
</tr>
    <tr style="display:none; background-color:<?php if ($cont%2==0) echo "#F1F1F1"; else echo "#E0E0E0"?>" id="editar_mov_<?php echo $row['id']?>">
        <td colspan="3">
            <hr/>
            <form method="post" action="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>">
            <input type="hidden" name="acao" value="editar_mov" />
            <input type="hidden" name="id" value="<?php echo $row['id']?>" />
            
            <b>Dia:</b> <input type="text" name="dia" size="3" maxlength="2" value="<?php echo $row['dia']?>" />&nbsp;|&nbsp;
            <b>Tipo:</b> <label for="tipo_receita<?php echo $row['id']?>" style="color:#030"><input <?php if($row['tipo']==1) echo "checked=checked"?> type="radio" name="tipo" value="1" id="tipo_receita<?php echo $row['id']?>" /> Receita</label>&nbsp; <label for="tipo_despesa<?php echo $row['id']?>" style="color:#C00"><input <?php if($row['tipo']==0) echo "checked=checked"?> type="radio" name="tipo" value="0" id="tipo_despesa<?php echo $row['id']?>" /> Despesa</label>&nbsp;|&nbsp;
            <b>Categoria:</b>
<select name="cat">
<?php
$qr2=mysql_query("SELECT * FROM lc_cat");
while ($row2=mysql_fetch_array($qr2)){
?>
    <option <?php if($row2['id']==$row['cat']) echo "selected"?> value="<?php echo $row2['id']?>"><?php echo $row2['nome']?></option>
<?php }?>
</select>&nbsp;|&nbsp;
            <b>Valor:</b> R$<input type="text" value="<?php echo $row['valor']?>" name="valor" size="8" maxlength="10" />
            <br/>
            <b>Descricao:</b> <input type="text" name="descricao" value="<?php echo $row['descricao']?>" size="70" maxlength="255" />
            
            <input type="submit" class="botao" value="Alterar" />
            </form> 
            <div style="text-align: right">
            <a style="color:#FF0000" onclick="return confirm('Tem certeza que deseja apagar?')" href="?mes=<?php echo $mes_hoje?>&ano=<?php echo $ano_hoje?>&acao=apagar&id=<?php echo $row['id']?>" title="Remover">[remover]</a> 
            </div>
            <hr/>
        </td>
    </tr>
      
<?php
}
?>
<tr>
<td colspan="3" align="right">
<strong style="font-size:22px; color:<?php if ($resultado_mes<0) echo "#C00"; else echo "#030"?>"><?php echo formata_dinheiro($resultado_mes)?></strong>
</td>
</tr>
</table>
<br />
<br />
<table cellpadding="5" cellspacing="0" width="900" align="center">
<tr>
<td align="right">

</td>
</tr>
</table>
    </div>

</body>
</html>