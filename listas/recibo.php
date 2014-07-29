   <?php require_once('../Connections/conexao.php'); ?>
   

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Recibo</title>
</head>

<body>

<table width="778" border="0" align="center" style="border-collapse:collapse; border:1px solid #999999; padding:20px;">
  <tr>
    <td width="206" bgcolor="#F7F7F7"><div style="padding:5px;  margin:0px 0px 0px 35px;"><img src="../img/LOGO_CARRO3.png" width="175" height="80" /></div></td>
    <td width="215" valign="top" bgcolor="#F7F7F7"><div align="center" style="color:#FF3300; font-weight:bold; font-size:18px;"><br />
        <br />
    RECIBO</div></td>
    <td width="343" valign="top" bgcolor="#F7F7F7"><div style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Av. Jer&ocirc;nimo de Albuquerque, 208, Bloco C<br />
      Pop Center , Sala 08, , Cohab Anil III<br />
      S&atilde;o Lu&iacute;s, Maranh&atilde;o <br />
    CNPJ: 11.796.835/002-05<br />
    Contatos: (98) 3244-1397 / 8283-8755 / 8755-2810</div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7"><hr /></td>
  </tr>
  <tr>
    <td bgcolor="#F7F7F7"><div style="border-radius:5px; background:#FFFFFF; width:200px; margin:0px 0px 0px 35px; padding:10px; border:1px solid #CCCCCC;">
    
    <span style="font-size:20px;">N&#176; <?php echo date("md");?>
<?php $id = $_GET['id']; echo $id; ?></span></div></td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td  bgcolor="#F7F7F7"><div style="border-radius:5px; background:#FFFFFF; width:200px;  margin:0px 0px 0px -35px; padding:10px; border:1px solid #CCCCCC;"> <?php

$qr1=mysql_query("SELECT * FROM lc_movimento Where id ='$id'");
while ($row5=@mysql_fetch_array($qr1)){


$val3 = $row5['valor'];

 $valor3 = number_format($val3,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$valor3."</font>"; 
	  }

?></div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">
    <div style="background:#FFFFFF; border-radius:5px; min-height:0px; width:600px; border:1px solid #999999; padding:10px; margin:auto;"><br />
      <?php 
function numeroEscrito($n) {
 
    $numeros[1][0] = '';
    $numeros[1][1] = 'um';
    $numeros[1][2] = 'dois';
    $numeros[1][3] = 'três';
    $numeros[1][4] = 'quatro';
    $numeros[1][5] = 'cinco';
    $numeros[1][6] = 'seis';
    $numeros[1][7] = 'sete';
    $numeros[1][8] = 'oito';
    $numeros[1][9] = 'nove';
 
    $numeros[2][0] = '';
    $numeros[2][10] = 'dez';
    $numeros[2][11] = 'onze';
    $numeros[2][12] = 'doze';
    $numeros[2][13] = 'treze';
    $numeros[2][14] = 'quatorze';
    $numeros[2][15] = 'quinze';
    $numeros[2][16] = 'dezesseis';
    $numeros[2][17] = 'dezesete';
    $numeros[2][18] = 'dezoito';
    $numeros[2][19] = 'dezenove';
    $numeros[2][2] = 'vinte';
    $numeros[2][3] = 'trinta';
    $numeros[2][4] = 'quarenta';
    $numeros[2][5] = 'cinquenta';
    $numeros[2][6] = 'sessenta';
    $numeros[2][7] = 'setenta';
    $numeros[2][8] = 'oitenta';
    $numeros[2][9] = 'noventa';
 
    $numeros[3][0] = '';
    $numeros[3][1] = 'cem';
    $numeros[3][2] = 'duzentos';
    $numeros[3][3] = 'trezentos';
    $numeros[3][4] = 'quatrocentos';
    $numeros[3][5] = 'quinhentos';
    $numeros[3][6] = 'seiscentos';
    $numeros[3][7] = 'setecentos';
    $numeros[3][8] = 'oitocentos';
    $numeros[3][9] = 'novecentos';
 
    $qtd = strlen($n);
 
    $compl[0] = ' mil ';
    $compl[1] = ' milhão ';
    $compl[2] = ' milhões ';
    $numero = "";
    $casa = $qtd;
    $pulaum = false;
    $x = 0;
    for ($y = 0; $y < $qtd; $y++) {
 
        if ($casa == 5) {
 
            if ($n[$x] == '1') {
 
                $indice = '1' . $n[$x + 1];
                $pulaum = true;
            } else {
 
                $indice = $n[$x];
            }
 
            if ($n[$x] != '0') {
 
                if (isset($n[$x - 1])) {
 
                    $numero .= ' e ';
                }
 
                $numero .= $numeros[2][$indice];
 
                if ($pulaum) {
 
                    $numero .= ' ' . $compl[0];
                }
            }
        }
 
        if ($casa == 4) {
 
            if (!$pulaum) {
 
                if ($n[$x] != '0') {
 
                    if (isset($n[$x - 1])) {
 
                        $numero .= ' e ';
                    }
                }
            }
 
            $numero .= $numeros[1][$n[$x]] . ' ' . $compl[0];
        }
 
        if ($casa == 3) {
 
            if ($n[$x] == '1' && $n[$x + 1] != '0') {
 
                $numero .= 'cento ';
            } else {
 
                if ($n[$x] != '0') {
 
                    if (isset($n[$x - 1])) {
 
                        $numero .= ' e ';
                    }
 
                    $numero .= $numeros[3][$n[$x]];
                }
            }
        }
 
        if ($casa == 2) {
 
            if ($n[$x] == '1') {
 
                $indice = '1' . $n[$x + 1];
                $casa = 0;
            } else {
 
                $indice = $n[$x];
            }
 
            if ($n[$x] != '0') {
 
                if (isset($n[$x - 1])) {
 
                    $numero .= ' e ';
                }
 
                $numero .= $numeros[2][$indice];
            }
        }
 
        if ($casa == 1) {
 
            if ($n[$x] != '0') {
                if ($numeros[1][$n[$x]] <= 10)
                    $numero .= ' ' . $numeros[1][$n[$x]];
                else
                    $numero .= ' e ' . $numeros[1][$n[$x]];
            } else {
 
                $numero .= '';
            }
        }
 
        if ($pulaum) {
 
            $casa--;
            $x++;
            $pulaum = false;
        }
 
        $casa--;
        $x++;
    }
 
    return $numero;
}


function escreverValorMoeda($n){
    //Converte para o formato float 
    if(strpos($n, ',') !== FALSE){
        $n = str_replace('.','',$n); 
        $n = str_replace(',','.',$n);
    }
 
    //Separa o valor "reais" dos "centavos"; 
    $n = explode('.',$n);
 
    return ucfirst(numeroEscrito($n[0])). ' reais' . ((isset($n[1]) && $n[1] > 0)?' e '.numeroEscrito($n[1]).' centavos.':'');
 
}

$id = $_GET['id'];


?>
      <?php

$qr1=mysql_query("SELECT * FROM lc_movimento as m, lc_cat as c Where m.cat = c.id AND m.id ='$id'");
while ($row5=@mysql_fetch_array($qr1)){


$val = $row5['valor'];

?>
  
Recebi da Empresa <strong>Marcelo Im&oacute;veis</strong> </strong>&nbsp;a import&acirc;ncia <strong>R$</strong>&nbsp;<strong>
<?php
//Agora um exemplo prático
     $valor = number_format($val,2,",",".");
    
    echo $valor.' *** ('.escreverValorMoeda($valor); echo ') ***'; 
	
?>
<br /><hr />
    Referente: <?php echo $row5['nome']; ?></div>
    
    
    <?php } ?>    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7"><div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px; margin:0px 0px 0px 30px"><?php echo "$nomediadasemana, $dia de $nomemes de $ano";?></div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7"><div style=" margin:0px 0px 0px 35px;">________________________________________<br />
      Assinatura</div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
</table>
<br />
<table width="780" border="0" align="center" style="border-collapse:collapse; border:1px solid #999999; padding:20px;">
  <tr>
    <td width="212" bgcolor="#F7F7F7"><div style="padding:5px;  margin:0px 0px 0px 35px;"><img src="../img/LOGO_CARRO3.png" alt="" width="175" height="80" /></div></td>
<td width="210" valign="top" bgcolor="#F7F7F7"><div align="center" style="color:#FF3300; font-weight:bold; font-size:18px;"><br />
            <br />
      RECIBO</div></td>
    <td width="349" valign="top" bgcolor="#F7F7F7"><div style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Av. Jer&ocirc;nimo de Albuquerque, 208, Bloco C<br />
Pop Center , Sala 08, , Cohab Anil III<br />
S&atilde;o Lu&iacute;s, Maranh&atilde;o <br />
CNPJ: 11.796.835/002-05<br />
Contatos: (98) 3244-1397 / 8283-8755 / 8755-2810</div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7"><hr /></td>
  </tr>
  <tr>
    <td bgcolor="#F7F7F7"><div style="border-radius:5px; background:#FFFFFF; width:200px; margin:0px 0px 0px 35px; padding:10px; border:1px solid #CCCCCC;"> <span style="font-size:20px;">N&#176; <?php echo date("md");?><?php $id = $_GET['id']; echo $id; ?>
    </span></div></td>
    <td bgcolor="#F7F7F7">&nbsp;</td>
    <td  bgcolor="#F7F7F7"><div style="border-radius:5px; background:#FFFFFF; width:200px;  margin:0px 0px 0px -35px; padding:10px; border:1px solid #CCCCCC;">
      <?php

$qr1=mysql_query("SELECT * FROM lc_movimento Where id ='$id'");
while ($row5=@mysql_fetch_array($qr1)){


$val3 = $row5['valor'];

 $valor3 = number_format($val3,2,",",".");
    
      echo "<font size=\"5\"> R$</strong> "."<font size=\"5\">".$valor3."</font>"; 
	  }

?>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7"><div style="background:#FFFFFF; border-radius:5px; min-height:0px; width:600px; border:1px solid #999999; padding:10px; margin:auto;"><br />
           
            <?php

$qr1=mysql_query("SELECT * FROM lc_movimento as m, lc_cat as c Where m.cat = c.id AND m.id ='$id'");
while ($row5=@mysql_fetch_array($qr1)){


$val = $row5['valor'];

?>
      Recebi da Empresa <strong>Marcelo Im&oacute;veis</strong> </strong>&nbsp;a import&acirc;ncia <strong>R$</strong>&nbsp;<strong>
      <?php
//Agora um exemplo prático
     $valor = number_format($val,2,",",".");
    
    echo $valor.' *** ('.escreverValorMoeda($valor); echo ') ***'; 
	
?>
      <br />
      <hr />
      Referente: <?php echo $row5['nome']; ?></div>
        <?php } ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7"><div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px; margin:0px 0px 0px 30px"><?php echo "$nomediadasemana, $dia de $nomemes de $ano";?></div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7"><div style=" margin:0px 0px 0px 35px;">________________________________________<br />
      Assinatura</div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
</table>
<br />
<br />
<br />
<br />

<br />
<br />
</body>
</html>
