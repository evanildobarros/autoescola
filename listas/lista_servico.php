    
    <?php
    @session_start();
    require'../Connections/conexao.php';	
    ?>
    
    
    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
    <head>
    
    <link rel="stylesheet" href="../css/paginacao.css" type="text/css" />
    <link rel="stylesheet" href="../css/layout.css" type="text/css" />
    
    
    <script language="JavaScript">
    function onDelete()
    {
    if(confirm('Deseja Realmente Excluir esses Arquivos ?')==true)
    {
    return true;
    }
    else
    {
    return false;
    }
    }
    </script>
    
    <script language=javascript>
    function CheckAll() { 
    for (var i=0;i<document.frmMain.elements.length;i++) {
    var x = document.frmMain.elements[i];
    if (x.name == 'chkDel[]') { 
    x.checked = document.frmMain.selall.checked;
    } 
    } 
    }
    function MM_openBrWindow(theURL,winName,features) { //v2.0
    window.open(theURL,winName,features);
    }
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>Gerenciador Auto Escola</title>
    
    </head>
    
    <?php
    
    
    for($i=0;$i<count($_POST["chkDel"]);$i++)
    {
    if($_POST["chkDel"][$i] != "")
    {
    $strSQL = "DELETE FROM cliente";
    $strSQL .="WHERE id_cliente = '".$_POST["chkDel"][$i]."' ";
    $objQuery = mysql_query($strSQL);
    }
    }
    
    $dat = date("Y-m-d");
    ?>
    
    <body link="#FF3300" vlink="#ddd">
    <br />
    <br />
    <table width="1000" border="0" align="center" style="border-collapse:collapse;">
    <tr>
    <td bgcolor="#FFFFFF" class="">
    <form name="form2" method="post" action="layout_servico.php">
    <label>
    <input class="input"  type="text" name="filtro" id="filtro">
    </label>
    <label>
    <input class="bt2" type="submit" name="button" id="button" value="Pesquisar">
    </label>
    <span class="span7">&nbsp; &nbsp; &nbsp;registrar servi&ccedil;os</span>
    </form>
    </td>
    </tr>
    </table>
    
    
    <form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
    <table width="1000" border="0" align="center" class="td2" style="border-collapse:collapse;">
    
    
    
    <tr>
    <td colspan="5" valign="baseline">			</td>
    </tr>
    <?php
    $p = $_GET["p"];
    
    if(isset($p)) {
    $p = $p;
    } else {
    $p = 1;
    }
    
    $qnt = 13;
    $inicio = ($p*$qnt) - $qnt;
    
    if($_REQUEST['filtro'] == ' ' )
    $filtro = '';
    else
    $filtro = $_REQUEST['filtro'];
    
    if($_REQUEST['filtro1'] == ' ' )
    $filtro1 = '';
    else
    $filtro1 = $_REQUEST['filtro1'];
    
    $sql = "SELECT * from alunos WHERE nome like '".$filtro."%' ORDER BY id_aluno DESC LIMIT $inicio, $qnt";
    
    $rs  = mysql_query($sql);
    
    function geraTimestamp($data) {
    $partes = explode('/', $data);
    return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
    }
    $cont = 0;
    while ($resultado = @mysql_fetch_array($rs))
    {
    
    
    $cor = ($cont%2 == 0)? "#EDEDED":"ffffff";
    ?>
    <tr bgcolor="<?php echo $cor ; ?>">
    <td width="46" valign="top"><span style="padding:10px; margin:auto;">
    <a href="deletar_serv.php?id_aluno=<?php echo $resultado['id_aluno']; ?>">
    <img src="../img/bt_excluir.PNG" width="26" height="21" /></a></span></td>
    <td width="319"><span class="font_estilo"><?php echo $resultado['nome']; ?></span></td>
    <td width="259"><span class="font_estilo1"><?php echo $resultado['cpf']; ?></span></td>
    <td width="231"><span class="font_estilo"><?php echo $resultado['email']; ?></span></td>
    <td width="123" ><span class="font_estilo2"><a style="text-decoration:none; font-weight:bolder;" href="layout_ad_servico.php?id_aluno=<?php echo $resultado['id_aluno'] ?>">[ &Xi; Servi�os &Xi; ]</a></span></td>
    </tr>
    <tr><?php $cont ++; }?>
    <?php
    $sql_select_all = "select * from alunos";
    
    $sql_query_all = @mysql_query($sql_select_all);
    
    $total_registros = @mysql_num_rows($sql_query_all);
    
    $pags = ceil($total_registros/$qnt);
    
    $max_links = 3;
    ?>
    <td colspan="5" align="center" valign="top"><br />
    
    <?php
    
    echo "<a class=\"pag\" href='layout_servico.php?p=1' target='_self'><span class=\"\">&laquo; Anterior</span></a> ";
    
    for($i = $p-$max_links; $i <= $p-1; $i++) {
    
    if($i <=0) {
    
    } else {
    
    echo "<a class=\"pag\" href='layout_servico.php?p=".$i."' target='_self'>".$i."</a> ";
    }
    }
    
    echo "<span class=\"pag2\"> " .$p." ". "</span>";
    
    for($i = $p+1; $i <= $p+$max_links; $i++) {
    
    if($i > $pags)
    {
    
    }
    
    else
    {
    
    echo "<a class=\"pag\"  href='layout_servico.php?p=".$i."' target='_self'>".$i."</a> ";
    }
    }
    
    echo "<a class=\"pag\" href='layout_servico.php?p= " .$pags."' target='_self'><span class=\"\">Pr&oacute;xima &raquo;</span></a> ";
    
    ?><br />
    <br /></td>
    </tr>
    </table>
    </form>
    
    
    
    </div>
    
    </body>
    <?php 
    
    $op="Consultou Exame de legisla��o !";
    $sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
    ('', '$_SESSION[MM_Username]', '$_SESSION[usuario]', '$dat', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
    mysql_query($sql5);
    ?>
    </html>
