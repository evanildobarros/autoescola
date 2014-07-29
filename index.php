<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<title>Gerenciador Auto Escola</title>
	<link href='http://fonts.googleapis.com/css?family=Lato:100,400' rel='stylesheet' type='text/css'>
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/index.css" type="text/css">
	
</head>
<body>
	<!-- IGNORE THIS -->
	<header id="back-to-article">
		<div class="contato">Contatos: (98) 8128 - 6981<br><br>

                             <div style="color:#FFFFFF; font-family:'Museo Sans 700'; font-size:24px;">Email: eneylton@hotmail.com</div></div>
<nav class="links">
			<img width="400" height="130" src="img/logo.png">
			
		</nav>
	</header>
	<!-- END IGNORE THIS -->

	<section id="login">
		<nav id="headers">
			<ul>
				<li id="tab-header-login" class="active"><a href="#">Login</a></li>
				<li id="tab-header-register"><a href="#">Registro</a></li>
				<li id="tab-header-reset"><a href="#">Iniciar Senha</a></li>
			</ul>
		</nav>

		<div id="tabs">
			<div id="tab-content-login" class="tab-content">
				<h1>Gerenciador</h1>
				<p>Sistema desenvolvido para gerenciar e continuamente melhorar as políticas, procedimentos e processos de sua empresa.  </p>

				<form id="login-form" name="form1" method="POST" action="logon.php">
					<ol>
						<li>
							<label for="username">Usuário</label>
							<input type="text" name="usuario" id="usuario" placeholder="Username" value="" />
						</li>
						<li>
							<label for="password">Senha</label>
							<input type="password" name="senha" id="password" placeholder="Password" value="" />
						</li>
						<li>
							<input type="submit" name="button" id="button" value="Enviar" />
						</li>
					</ol>
				</form>
                
                
                <form id="form1" name="form1" method="POST" action="logon.php">
                </form>
                
                
		  </div>
		</div>
	</section>
</body>
</html>