<?php require_once("../Connections/conexao.php"); 

$id = $_GET['id_aluno'];

$sql_deletar = mysql_query("DELETE FROM alunos WHERE id_aluno = '$id'");
echo"<script>alert('Deseja Realmente excluir esse Produto!');</script>";
echo"<script>window.location='layout_servico.php'</script>";


?>

