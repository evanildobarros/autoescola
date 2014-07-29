		<?php
		@session_start();
	
		?>
		<html>
		
		<head>
		<link rel="stylesheet" href="../css/estilo_principal.css" type="text/css">
		<link rel="stylesheet" href="../css/menu_horizontal.css" type="text/css">
		
		<title>Gerenciador Despachante</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<style type="text/css">
		<!--
		.style1 {
		font-size: 24px;
		color: #FFFFFF;
		}
		-->
		</style>
		</head>
		
		<body>
		<table width="90%" border="0" style="border-collapse:collapse;" align="center">
		<tr>
		<td bgcolor="#333"><div class="logado"><?php echo $_SESSION['data']; ?><br>
		
		Usuário logado: <font color="#FF9933"><?php echo $_SESSION['usuario']; ?></font></div></td>
		</tr>
		<tr>
		<td bgcolor="#666">&nbsp;</td>
		</tr>
		<tr>
		<td bgcolor="#FFFFFF">
		<div class="content">
		
		<div class="grid13"><?php require('event2.php'); ?> </div>
		
		</div>
		
		
		
		
		
		</td>
		
		</table>
		
		</body>
		</html>