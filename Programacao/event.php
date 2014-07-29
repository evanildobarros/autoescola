<?php
 $mysql = mysql_connect("localhost", "root", "jedai2003");
        mysql_select_db("AutoEscola", $mysql) or die(mysql_error());

// Add our new events
if ($_POST){
	$m = $_POST['0'];
	$d = $_POST['0'];
	$y = $_POST['0'];

	// Formatting for SQL datetime (if this is edited, it will NOT work.)
	$event_date = $y."-".$m."-".$d." ".$_POST["event_time_hh"].":".$_POST["event_time_mm"].":00";

	$insEvent_sql = "INSERT INTO calendar_events3 (event_title,
			                                      event_shortdesc, 
												  event_start,
												  hora,
												  aluno,
												  instrutor,
												  veiculo,
												  categoria,
												  tipo,descricao,mes) VALUES('".$_POST["event_title"]."',
			                                                         '".$_POST["event_shortdesc"]."','$event_date',
																	 '".$_POST["hora"]."',
																	 '".$_POST["aluno"]."',
																	 '".$_POST["instrutor"]."',
																	 '".$_POST["veiculo"]."',
																	 '".$_POST["categoria"]."',
																	 '".$_POST["tipo"]."',
																	 '".$_POST["descricao"]."',
																	 '".$_POST["mes"]."')";
	$insEvent_res = mysql_query($insEvent_sql, $mysql)
			or die(mysql_error($mysql));
} else {
	$m = $_GET['m'];
	$d = $_GET['d'];
	$y = $_GET['y'];
    $month = $_POST[''];
}
// Show the events for this day:
$getEvent_sql = "SELECT event_title, event_shortdesc,
		         date_format(event_start, '%l:%i %p') as fmt_date,
				 hora,
				 aluno,
				 instrutor,
				 veiculo,
				 categoria,
				 tipo,
				 descricao,mes
				 FROM
		         calendar_events3 
				 WHERE 
				 month(event_start) = '".$m."'
		         AND dayofmonth(event_start) = '".$d."' 
				 AND year(event_start)= '".$y."' 
				 ORDER BY event_start";
$getEvent_res = mysql_query($getEvent_sql, $mysql)
		or die(mysql_error($mysql));



mysql_close($mysql);

@header('location:../listas/layout_calendario1.php');
	

?>