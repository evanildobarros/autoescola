		<?php
        @session_start();
        
        ?>
        <?php require_once('../Connections/conexao.php'); ?>
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
        
        $colname_aluno = "-1";
        if (isset($_GET['id_aluno'])) {
        $colname_aluno = $_GET['id_aluno'];
        }
        mysql_select_db($database_conexao, $conexao);
        $query_aluno = sprintf("SELECT * FROM alunos WHERE id_aluno = %s", GetSQLValueString($colname_aluno, "int"));
        $aluno = mysql_query($query_aluno, $conexao) or die(mysql_error());
        $row_aluno = mysql_fetch_assoc($aluno);
        $totalRows_aluno = mysql_num_rows($aluno);
        
        mysql_select_db($database_conexao, $conexao);
        $query_Sala = "SELECT * FROM sala";
        $Sala = mysql_query($query_Sala, $conexao) or die(mysql_error());
        $row_Sala = mysql_fetch_assoc($Sala);
        $totalRows_Sala = mysql_num_rows($Sala);
        
        mysql_select_db($database_conexao, $conexao);
$query_sala01 = "SELECT Count(*) as total1 FROM turma WHERE sala ='Sala 01'";
$sala01 = mysql_query($query_sala01, $conexao) or die(mysql_error());
$row_sala01 = mysql_fetch_assoc($sala01);
$totalRows_sala01 = mysql_num_rows($sala01);
        
        mysql_select_db($database_conexao, $conexao);
$query_sala02 = "SELECT Count(*) as total2 FROM turma WHERE sala ='Sala 02'";
$sala02 = mysql_query($query_sala02, $conexao) or die(mysql_error());
$row_sala02 = mysql_fetch_assoc($sala02);
$totalRows_sala02 = mysql_num_rows($sala02);

mysql_select_db($database_conexao, $conexao);
$query_sala03 = "SELECT Count(*) as total3 FROM turma WHERE sala ='Sala 03'";
$sala03 = mysql_query($query_sala03, $conexao) or die(mysql_error());
$row_sala03 = mysql_fetch_assoc($sala03);
$totalRows_sala03 = mysql_num_rows($sala03);
        ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
        <link rel="stylesheet" href="../css/layout.css" type="text/css" />
        <title>Gerenciador Auto Escola</title>
        <style type="text/css">
        <!--
        .style1 {
        color: #FF0000;
        font-size: 12px;
        }
        -->
        </style>
        </head>
        
        <body>
        <form method="post" name="form1" action="../Programacao/insert_turma.php">
        <table width="444" align="center">
        <input type="hidden" name="id_aluno" value="<?php echo $row_aluno['nome']; ?>" size="32">
        
        <tr valign="baseline">
        <td colspan="2" align="right" nowrap><div align="left" class="style1">No M&aacute;xima 10 alunos por sala</div></td>
        </tr>
        <tr valign="baseline">
        <td  align="right" ><div align="left">Sala 01 Total </div></td>
        <td width="152"><?php
        $s1 = $row_sala01['total1'];
        if ($row_sala01['total1'] >= 32){
        echo "<font color=\"red\" ><strong>$s1</strong></font>". " <img src=\"../img/ANIME.gif\">";
        } else {
        echo "<font color=\"green\" ><strong>$s1</strong></font> ". " <img src=\"../img/ab.jpg\">";
        }
        ?></td>
        </tr>
        <tr valign="baseline">
        <td nowrap align="right"><div align="left">Sala 02 Total </div></td>
        <td>
        <?php
        $s2 = $row_sala02['total2'];
        if ($row_sala02['total2'] >= 32){
        echo "<font color=\"red\"><strong>$s2</strong></font> ". " <img src=\"../img/ANIME.gif\">";
        } else{
        echo "<font color=\"green\" > <strong>$s2</strong> </font>"." <img src=\"../img/ab.jpg\">";
        }
        ?>      </td>
        </tr>
        <tr valign="baseline">
        <td><div align="left">Sala 03 Total </div></td>
        <td><?php
        $s3 = $row_sala03['total3'];
        if ($row_sala03['total3'] >= 32){
        echo "<font color=\"red\"><strong>$s3</strong></font> ". " <img src=\"../img/ANIME.gif\">";
        } else{
        echo "<font color=\"green\" > <strong>$s3</strong> </font>"." <img src=\"../img/ab.jpg\">";
        }
        ?></td>
        </tr>
        <tr valign="baseline">
        <td colspan="2" align="right" nowrap><div align="left">
        <div align="left">Sala:</div>
        </div></td>
        </tr>
        <tr valign="baseline">
        <td colspan="2" align="right" nowrap><label>
        <div align="left">
        <select name="sala" class="input3" id="sala">
        <option value="">Selecione</option>
        <?php
        do {  
        ?>
        <option value="<?php echo $row_Sala['descricao']?>"><?php echo $row_Sala['descricao']?> | <?php echo $row_Sala['turno']?> | Professor: 
        <?php echo $row_Sala['prof']?></option>
        <?php
        } while ($row_Sala = mysql_fetch_assoc($Sala));
        $rows = mysql_num_rows($Sala);
        if($rows > 0) {
        mysql_data_seek($Sala, 0);
        $row_Sala = mysql_fetch_assoc($Sala);
        }
        ?>
        </select>
        </div>
        </label></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" class="bt4" value="Salvar"></td>
        </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
        </form>
        <p>&nbsp;</p>
        </body>
        </html>
        <?php
        mysql_free_result($aluno);
        
        mysql_free_result($Sala);
        
        mysql_free_result($sala01);
        
        mysql_free_result($sala02);

mysql_free_result($sala03);
        ?>
