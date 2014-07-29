<?php
session_start();

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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title id='titulo'>Livro caixa <?php echo $lc_titulo?></title>
<meta name="LANGUAGE" content="Portuguese" />
<meta name="AUDIENCE" content="all" />
<meta name="RATING" content="GENERAL" />
<link rel="stylesheet" href="../css/layout.css" type="text/css">
	<link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
	<title>Gerenciador Imobiliaria</title>
<script language="javascript" src="scripts.js"></script>
</head>
<body>

<div class="banner">
	
	<div class="logo"><img width="280" height="80" src="../img/logo.png"></div>
	<div class="titulo">
	<span class="span1"> <a style="color:#FFF; text-decoration:none;" href="?mes=<?php echo date('m')?>&amp;ano=<?php echo date('Y')?>">Hoje: <?php echo date('d')?> de <?php echo mostraMes(date('m'))?> de <?php echo date('Y')?></a><br>
	Usuário: <span class="span2"><?php echo $_SESSION['MM_Username']; ?></span><br>
  <span ><a class="span15" href="../logout.php">sair</a></span></div>
	
	
</div>
	<div class="cont_menu">
	<?php include('../listas/menu.php');  ?>
	</div>
	<div class="conteudo"><br />
<br />

    <table cellpadding="1" cellspacing="10"  width="900" align="center" style="background-color:#FFCC00;">

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
    <td align="center" style="<?php if ($i!=12) echo "border-right:1px solid #FFF;"?> padding-right:5px">
    <a href="?mes=<?php echo $i?>&ano=<?php echo $ano_hoje?>" style="
    <?php if($mes_hoje==$i){?>    
    color:#ff0000; font-size:14px;  padding:5px; text-decoration:none; font-family:Arial, Helvetica, sans-serif;
    <?php }else{?>
    color:#666; font-size:14px; text-decoration:none; font-family:Arial, Helvetica, sans-serif;
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
<br />



<form action="fluxo.php" method="post">

<fieldset style="border:1px solid #006699;"><legend>Fluxo de Caixa</legend><br />
<br />

<table width="600" border="0" align="center">
  <tr>
    <td colspan="2"><label>
      <input type="hidden" name="mes" id="mes" value="<?php echo mostraMes($mes_hoje)?>" />
    </label></td>
  </tr>
  <tr>
    <td colspan="2">SELECIONE O TIPO DE FLUXO: 
      <label>
      <input type="radio" name="tipo" id="tipo" value="1" />
      <span class="span11">Receita</span> 
      <input type="radio" name="tipo" id="radio" value="0" /> 
      <span class="span8">Despesas</span> </label></td>
  </tr>
  <tr>
    <td width="176"><label></label></td>
    <td width="408"><br />
      <input name="button" type="submit" class="botao" id="button" value="Enviar" /></td>
  </tr>
</table>
</fieldset>

    
    
    </div>




</form>


