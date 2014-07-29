<?php require_once('../Connections/conexao.php'); ?><?php
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
$query_meses = "SELECT * FROM meses";
$meses = mysql_query($query_meses, $conexao) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);


mysql_select_db($database_conexao, $conexao);
$query_soma1 = "SELECT SUM(valor) as total FROM movimento WHERE tipo = 0";
$soma1 = mysql_query($query_soma1, $conexao) or die(mysql_error());
$row_soma1 = mysql_fetch_assoc($soma1);
$totalRows_soma1 = mysql_num_rows($soma1);

mysql_select_db($database_conexao, $conexao);
$query_soma2 = "SELECT SUM(valor) as total FROM movimento WHERE tipo = 1";
$soma2 = mysql_query($query_soma2, $conexao) or die(mysql_error());
$row_soma2 = mysql_fetch_assoc($soma2);
$totalRows_soma2 = mysql_num_rows($soma2);

$s3 = $row_soma1['total'];
$s4 = $row_soma2['total'];
$s_total2 = $s3 - $s4; 

?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['mes'])) {
  $loginUsername=$_POST['mes'];
  $password=$_POST['mes'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "contas_paga.php";
  $MM_redirectLoginFailed = "balaco_financeiro.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexao, $conexao);
  
  $LoginRS__query=sprintf("SELECT descricao, descricao FROM meses WHERE descricao=%s AND descricao=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<?php
mysql_free_result($meses);

mysql_free_result($soma1);

mysql_free_result($soma2);
?>