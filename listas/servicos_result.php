<?php
	

require_once('../Connections/conexao.php'); 

		//Verifica se o botao foi apertado pra entrar no bloco if
		if(isset($_POST['bt'])){
		
		//Recebe o id do professor
		$id = $_POST['int_id'];
		$id_cliente = $_POST['id_cliente'];
		//Recebe o array materias
		$data        = $_POST['data'];
		$tipo        = $_POST['tipo'];
		$categoria   = $_POST['cat'];
		$pago        = $_POST['f_pagamento'];
		$descricao   = $_POST['descricao'];
		$val         = $_POST['valor'];
		$val2        = $_POST['valor2'];
		$status      = $_POST['status'];
		$mes         = $_POST['mes'];
		$cliente     = $_POST['cliente'];
		$vencimento  = $_POST['venci'];
		
		$local = "Escritorio";
		$desc = "Nenhuma descri&ccedil;&atilde;o no momento";
		$st   = "1";
		$mv   = "Aquardando...";
		$hr   = date("H:i");
		$servico = $_POST['id_servico'];
		$cod = date("d");
		
		//Faz um foreach no array materias para percorrer os valores do array.. e os adiciona na tabela curso_professor
		foreach($servico as $indice => $valor){
		
			$sql = mysql_query("INSERT INTO serv(int_id,id_cliente,data,tipo,cat,f_pagamento,descricao,valor,valor2,status,mes,cliente,venci,id_servico) VALUES('$id','$id_cliente','$data','$tipo','$categoria','$pago','$descricao','$val','$val2','$status','$mes','$cliente','$vencimento','$valor')");
		
		
		}
		
		$sql6 = "INSERT INTO movimento (id_mov,id_cliente,data, cliente, tipo,cat,forma_pagamento,descricao, valor,valor2,status, mes) 
		VALUES ('','$id_cliente','$vencimento','$cliente','$tipo','$cat','$forma_pagamento','$descricao', '$val','$val2','$status', '$mes')";
		mysql_query($sql6);
		
		$d = date("d");
	    $m = date("m");
	    $a = date("Y");
		
		
		 
       
		}
		
		$sql9 = "INSERT INTO lc_movimento (id,tipo,dia,mes,ano,cat,id_cliente,cliente,descricao,valor,valor2,status,vencimento,fpagamento,m) 
	VALUES ('',$tipo,'$d','$m','$a','$categoria','$id_cliente','$cliente','$descricao','$val','$val2','$status','$vencimento','$pago','$mes')";
	mysql_query($sql9);
	
				 
	   header('location:index_financeiro.php');
		
		?>
		
		
	