		<?php
        @session_start();

        ?>
        <?php
        // At line 2 of our calendar.php script, add the MySQL connection information:
        $mysql = mysql_connect("localhost", "root", "jedai2003");
        mysql_select_db("AutoEscola", $mysql) or die(mysql_error());
        
        // Now we need to define "A DAY", which will be used later in the script:
        define("ADAY", (60*60*24));
        
        // The rest of the script will stay the same until about line 82
        
        if ((!isset($_POST['month'])) || (!isset($_POST['year']))) {
        $nowArray = getdate();
        $month = $nowArray['mon'];
        $year = $nowArray['year'];
        } else {
        $month = $_POST['month'];
        $year = $_POST['year'];
        }
        $start = mktime(12,0,0,$month,1,$year);
        $firstDayArray = getdate($start);
        ?>
        <html>
        <head>
        <title><?php echo "Calendar: ".$firstDayArray['month']."" . $firstDayArray['year']; ?></title>
        <script language="JavaScript">
        function abrir(URL) {
        
        var width = 550;
        var height = 380;
        
        var left = 50;
        var top = 50;
        
        window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
        
        }
        </script>
        
        <link rel="stylesheet" href="style.css" type="text/css">
        <script type="text/javascript">
        function eventWindow(url) {
        event_popupWin = window.open(url, 'event', 'resizable=yes,scrollbars=yes,toolbar=no,width=400,height=400');
        event_popupWin.opener = self;
        }
        </script>
        
        <head>
      
        
            <link rel="stylesheet" href="../css/layout.css" type="text/css" />
        
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
        
        </head>
        <body>
        <br>
        <table width="90%" border="0" style="border-collapse:collapse;" align="center">
        
        
        <tr>
        <td bgcolor="#FFFFFF">
        <div class="grid12">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
        <select name="month" class="input2">
        <?php
        $months = Array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Otubro", "Novembro", "Dezembro");
        
        for ($x=1; $x<=count($months); $x++){
        echo "<option value=\"$x\"";
        if ($x == $month){
        echo " selected";
        }
        echo ">".$months[$x-1]."</option>";
        }
        ?>
        </select>
        
        <select name="year" class="input2">
        <?php
        for ($x=2010; $x<=2020; $x++){
        echo "<option";
        if ($x == $year){
        echo " selected";
        }
        echo ">$x</option>";
        }
        ?>
        </select>
        <input name="submit" type="submit" class="botao" value="Agendar">
        
        <br>
        <br>
        </form>
        </div>
        
        <div class="grid11">
        
        
        
        
        <?php
        $days = Array("Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado");
        echo "<table bordercolor=\"#e1e1e1\" cellpadding=\"15\" width=\"100%\" style=\"border-collapse:collapse;\" border=\"1\" cellpadding=\"20\" align=\"center\"><tr>\n";
        foreach ($days as $day) {
        echo "<td style=\"background-color: #666; text-align: center; \">
        <font color=\"#fff\" face=\"Arial, Helvetica, sans-serif\"> <strong>$day</strong></font></td>\n";
        }
        
        for ($count=0; $count < (6*7); $count++) {
        $dayArray = getdate($start);
        if (($count % 7) == 0) {
        if ($dayArray["mon"] != $month) {
        break;
        } else {
        echo "</tr><tr>\n";
        }
        }
        if ($count < $firstDayArray["wday"] || $dayArray["mon"] != $month) {
        echo "<td> </td>\n";
        } else {
        $chkEvent_sql = "SELECT id,event_title,event_start,aluno,hora,event_shortdesc FROM calendar_events1 WHERE month(event_start) = '".$month."' AND dayofmonth(event_start) = '".$dayArray["mday"]."' AND year(event_start) = '".$year."' ORDER BY event_start";
        $chkEvent_res = mysql_query($chkEvent_sql, $mysql) or die(mysql_error($mysql));
        
        $id = $ev["id"];
        
        if (mysql_num_rows($chkEvent_res) > 0) {
        $event_title = "<br/>";
        while ($ev = mysql_fetch_array($chkEvent_res)) {
        
        $event_title .= stripslashes("<a class=\"span8\" href=\"javascript:abrir('../Agendamento/cliente2.php?id=".$ev["id"]."');\">".$ev["aluno"]."</a>")."<br/> ";
        
        $event_title .= stripslashes("<font color=\"#666\"><font color=\"#00CC66\"><strong> &radic;</strong></font> ".$ev["hora"]."</font>");
        $event_title .= stripslashes(" <font color=\"#666\">	ás ".$ev["event_shortdesc"])."</font>"."<hr />";
        
        }
        
        
        mysql_free_result($chkEvent_res);
        } else {
        $event_title = "";
        }
        
        echo "<td valign=\"top\"><a class=\"alink\" href=\"../listas/layout_ag_evento.php?m=".$month."&d=".$dayArray["mday"]."&y=$year;\">"."<span class\"alink\">".$dayArray["mday"]."</span>"."<span class=\"numero\"><font color\"Red\">Reservar</font></span> "."</a><br/></br>"."<span class=\"nome\"><font color\"Red\">".$event_title."</td>\n"."</font></span>";
        
        unset($event_title);
        
        $start += ADAY;
        }
        }
        echo "</tr></table>";
        mysql_close($mysql);
        
        ?>
        
        
        </div>
        </td>
        </tr>
        <tr>
        <td bgcolor="#666" align="center"><font color="#FFFFFF">Mhs Solucões Web Contato: (98) 8800-3198 | 3288046 <br>
                   email:mhssloucoesweb@hotmail.com &copy;coyright</font></td>
        </tr>
        </table>
        </body>
        </html>
