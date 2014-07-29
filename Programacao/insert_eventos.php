<?php
$mysql = mysql_connect("localhost", "root", "");
mysql_select_db("auto_escola_2014", $mysql) or die(mysql_error());

// Add our new events
if ($_POST){
	$m = $_POST['m'];
	$d = $_POST['d'];
	$y = $_POST['y'];

	// Formatting for SQL datetime (if this is edited, it will NOT work.)
	$event_date = $y."-".$m."-".$d." ".$_POST["event_time_hh"].":".$_POST["event_time_mm"].":00";

	$insEvent_sql = "INSERT INTO calendar_events (event_title,
			                                      event_shortdesc, 
												  event_start,
												  hora,
												  aluno,
												  instrutor,
												  veiculo,
												  categoria,
												  tipo,descricao) VALUES('".$_POST["event_title"]."',
			                                                         '".$_POST["event_shortdesc"]."','$event_date',
																	 '".$_POST["hora"]."',
																	 '".$_POST["aluno"]."',
																	 '".$_POST["instrutor"]."',
																	 '".$_POST["veiculo"]."',
																	 '".$_POST["categoria"]."',
																	 '".$_POST["tipo"]."',
																	 '".$_POST["descricao"]."')";
	$insEvent_res = mysql_query($insEvent_sql, $mysql)
			or die(mysql_error($mysql));
} else {
	$m = $_GET['m'];
	$d = $_GET['d'];
	$y = $_GET['y'];
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
				 descricao
				 FROM
		         calendar_events 
				 WHERE 
				 month(event_start) = '".$m."'
		         AND dayofmonth(event_start) = '".$d."' 
				 AND year(event_start)= '".$y."' 
				 ORDER BY event_start";
$getEvent_res = mysql_query($getEvent_sql, $mysql)
		or die(mysql_error($mysql));



mysql_close($mysql);

header('location:../Agendamento/event.php');

?>

