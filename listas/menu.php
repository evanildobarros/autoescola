
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Gerenciador Auto Escola</title>
        <meta http-equiv="description" content="" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/jmenu.css" type="text/css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jMenu.jquery.js"></script>
    </head>
    <body>
       

<ul id="jMenu">
            <li>
                <a>Home</a>
              

            <li>
                <a>Cadastros</a>
                <ul>
                    <li><a href="layout_alunos.php">Alunos</a></li>
                    <li><a href="layout_instrutor.php">Instrutor</a></li>
                  <li><a href="layout_veiculos.php">Ve&iacute;culo</a></li>
                    
              </ul>
            </li>
            
             <li>
                <a>Consultas</a>
                <ul>
                    <li><a href="layout_ed_excluir.php">Alunos</a></li>
                    <li><a href="layout_ed_excluir_fornecedor.php">Fornecedor</a></li>
                  <li><a href="layout_ed_excluir_veiculos.php">Ve&iacute;culo</a></li>
                  <li><a href="layout_ed_excluir_instrutor.php">Instrutor</a></li>
                    
              </ul>
            </li>
            
             <li>
                <a>Curso Te&oacute;rico</a>
                <ul>
                    <li><a href="layout_lista_alunos.php">Aulas Te&oacute;ricas</a></li>
                    <li><a href="layout_presenca.php">Lista de Presen&ccedil;a</a></li>
                    <li><a href="layout_carga_teorica.php">Carga Hor&aacute;ria</a></li>
                    <li><a href="layout_legislacao.php">Marca Exame</a></li>
                    <li><a href="layout_legislacao_prova.php">Data do Exame</a></li>
                    <li><a href="layout_rendimento1.php">Situa&ccedil;&atilde;o do Aluno</a></li>
                    <li><a href="layout_aprovados.php">Aprovados</a></li>
                    <li><a href="layout_reprovados.php">Reprovados</a></li>
                  
                    
              </ul>
            </li>
            <li>
                <a>Curso Pr&aacute;tico</a>
                <ul>
                    <li><a href="layout_agendamento.php">Agendamento</a></li>
                    <li><a href="layout_calendario1.php">Agendar</a></li>
                    <li><a href="layout_mapa2.php">Mapa Aluno</a></li>
                     <li><a href="layout_mapa_instrutor.php">Mapa Instrutor</a></li>
                     <li><a href="layout_mapa_instrutor2.php">Mapa Instrutor por Data</a></li>
                      <li><a href="#">Avalia&ccedil;&atilde;o do Instrutor</a></li>
                     <li><a href="layout_pratica.php">Carga Hor&aacute;ria</a></li>
                     <li><a href="layout_trafego.php">Marca Exame</a></li>
                    <li><a href="layout_marca_trafego.php">Data da Prova</a></li>
                    <li><a href="layout_situacao_trafego.php">Situa&ccedil;&atilde;o do Aluno</a></li>
                    <li><a href="layout_situacao_aprovado_trafego.php">Aprovados</a></li>
                    <li><a href="layout_situacao_reprovados_trafego.php">Reprovados</a></li>
                  
                    
              </ul>
            </li>
           

            <li>
                <a>Financeiro</a>
                <ul>
                    <li><a href="layout_servico.php">Registrar Servi&ccedil;os</a></li>
                    <li><a href="index_financeiro.php">fluxo de Caixa</a></li>
                    <li><a href="layout_contas_a_pagar.php">Contas Pagas</a></li>
                    <li><a href="layout_contas_devedor.php">Contas a Pagar</a></li>
                    <li><a href="layout_pagamentos.php">Contas a Receber</a></li>
                   <li><a href="layout_agendamento.php">Agendar</a></li> 
                   <li><a href="consulta_mensal.php">Relatorio</a></li>
                  <li><a href="layout_total_lotacao.php">Receitas por Escrit&oacute;rio</a></li>
                  <li><a href="layout_total_despesas.php">Despesas por Escrit&oacute;rio</a></li>
                  <li><a href="layout_forma_pagamento.php">Forma de Pagamento</a></li>
                  <li><a href="layout_fornecedor.php">Fornecedor</a></li>
                 
              </ul>
            </li>
            
          
            

            <li><a>Administra&ccedil;&atilde;o</a>
            <ul>
                    <li><a href="layout_user.php">Novo Usu&aacute;rio</a></li>
                     <li><a href="layout_sala.php">Nova Sala de Aula</a></li>
                    <li><a href="layout_contrato.php">Contrato do Aluno</a></li>
                    <li><a href="layout_niver_mes.php">Aniversariantes do M&ecirc;s</a></li>
                    <li><a href="layout_admin.php">Consultar Opera&ccedil;&otilde;es</a></li>
                    <li><a href="layout_qd_mes.php">Quantidade de alunos</a></li>
                    <li><a href="layout_grafico.php">Gr&aacute;fico</a></li>
                    
                    
                </ul>
            
            </li>

           
        </ul>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#jMenu").jMenu({
                    openClick : false,
                    ulWidth :'auto',
                     TimeBeforeOpening : 100,
                    TimeBeforeClosing : 11,
                    animatedText : false,
                    paddingLeft: 1,
                    effects : {
                        effectSpeedOpen : 150,
                        effectSpeedClose : 150,
                        effectTypeOpen : 'slide',
                        effectTypeClose : 'slide',
                        effectOpen : 'swing',
                        effectClose : 'swing'
                    }

                });
            });
        </script>
    </body>
</html>

