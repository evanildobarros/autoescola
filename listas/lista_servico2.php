    
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
    <br />
    <br />
    <br />
    <br />
    <br />
    <table width="435" border="0" align="center" style="border-collapse:collapse;">
    <tr>
    <td bgcolor="#CCCCCC" class=""><div align="left">**** Deseja continuar o cadastro !</div></td>
    </tr>
    </table>
    
    
    <form name="frmMain" action="" method="post" OnSubmit="return onDelete();" enctype="multipart/form-data">
    <table width="437" border="0" align="center" class="td2" style="border-collapse:collapse;">
    
    
    
    <tr>
    <td colspan="2" valign="baseline">			</td>
    </tr>
    <?php
    $p = $_GET["p"];
    
    if(isset($p)) {
    $p = $p;
    } else {
    $p = 1;
    }
    
    $qnt = 1;
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
      <td valign="top"><img src="../img/warning-icon.png" width="41" height="36" /></td>
      <td ><div align="center"><span class="font_estilo">Aluno <span style="color:#FF0033;"><?php echo $resultado['nome']; ?></span> Cadastrado com sucesso !</span></div></td>
    </tr>
    <tr bgcolor="<?php echo $cor ; ?>">
    <td width="76" valign="top"><span class="font_estilo"><br />
      <br />
    </span></td>
    <td width="351" ><div align="center"><span class="font_estilo2"><a style="text-decoration:none; font-weight:bolder;" href="layout_ad_servico.php?id_aluno=<?php echo $resultado['id_aluno'] ?>"><button type="button"> Continuar &raquo;</button></a></span></div></td>
    </tr>
    <tr><?php $cont ++; }?>
    <?php
    $sql_select_all = "select * from alunos";
    
    $sql_query_all = @mysql_query($sql_select_all);
    
    $total_registros = @mysql_num_rows($sql_query_all);
    
    $pags = ceil($total_registros/$qnt);
    
    $max_links = 3;
    ?>
    <td colspan="2" align="center" valign="top"><br />
      <br />
    <br /></td>
    </tr>
    </table>
    </form>
    
    
    
    </div>
    
    </body>
    <?php 
    
    $op="Consultou Exame de legislação !";
    $sql5 = "INSERT INTO log (cod, usuario, nome, data, hora, op, ip) VALUES 
    ('', '$_SESSION[MM_Username]', '$_SESSION[usuario]', '$dat', '$msghora', '$op', '$_SERVER[REMOTE_ADDR]')";
    mysql_query($sql5);
    ?>
    </html>
