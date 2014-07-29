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
            
            $editFormAction = $_SERVER['PHP_SELF'];
            if (isset($_SERVER['QUERY_STRING'])) {
            $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
            }
            
            if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
            $updateSQL = sprintf("UPDATE carga SET aluno=%s, qtd=%s, hora=%s WHERE id=%s",
            GetSQLValueString($_POST['aluno'], "text"),
            GetSQLValueString($_POST['qtd'], "text"),
            GetSQLValueString($_POST['hora'], "text"),
            GetSQLValueString($_POST['id'], "int"));
            
            mysql_select_db($database_conexao, $conexao);
            $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
            }
            
            $colname_carg = "-1";
            if (isset($_GET['id'])) {
            $colname_carg = $_GET['id'];
            }
            mysql_select_db($database_conexao, $conexao);
            $query_carg = sprintf("SELECT * FROM carga WHERE id = %s", GetSQLValueString($colname_carg, "int"));
            $carg = mysql_query($query_carg, $conexao) or die(mysql_error());
            $row_carg = mysql_fetch_assoc($carg);
            $totalRows_carg = mysql_num_rows($carg);
            ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <link rel="stylesheet" href="css/layout.css" type="text/css">
	<link rel="stylesheet" href="css/menu_horizontal.css" type="text/css">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Gerenciador auto escola</title>
            </head>
            
            <body onUnload="window.opener.location.reload()">
            <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="center">
            <tr valign="baseline">
            <td colspan="2" align="right" nowrap="nowrap"><div align="center">
              <input type="hidden" name="aluno" value="<?php echo htmlentities($row_carg['aluno'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
              <input type="hidden" name="qtd" value="<?php $sm = $row_carg['qtd'];
                                                     $soma = $sm + 1;
                                                      echo "$soma";
                                                           ?>" size="32" />
              <input type="hidden" name="hora" value="<?php $sm = $row_carg['hora'];
                                                     $soma = $sm + 2;
                                                      echo "$soma"; ?>" size="32" />
            </div></td>
            </tr>
            <tr valign="baseline">
            <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
            <span class="span6"><?php echo htmlentities($row_carg['aluno'], ENT_COMPAT, 'utf-8'); ?></span></tr>
            
            
            <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" class="botao" value="Registrar" /></td>
            </tr>
            </table>
            <input type="hidden" name="MM_update" value="form1" />
            <input type="hidden" name="id" value="<?php echo $row_carg['id']; ?>" />
            </form>
            <p>&nbsp;</p>
            </body>
            </html>
            <?php
            mysql_free_result($carg);
            ?>
            	<?php 
			
			$op="Cadastrou carga horária (Legislação) !";
			$sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
			('', '$_SESSION[usuario_logado]', '$_SESSION[usuario]', '$_SESSION[data]', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
			mysql_query($sql5);
			?>
