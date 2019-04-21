<?php
include('php/controle_sistema.php');

$f="";
if(isset($_GET['f']))
    $f = $_GET['f'];

if(empty($_SESSION['mensagem_alerta'])){
    $_SESSION['mensagem_alerta'] = "";
}

?>

<!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" />
        <title>Sistema GYM</title>
        <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo_mobile.css" />
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="lib/js/jqueryui/jquery-ui.css">
        <script src="lib/js/jquery.js"></script>
        <script src="lib/js/jqueryui/jquery-ui.js"></script>
        <script src="lib/js/controle_interface.js"></script>
        <script src="lib/js/func_controle.js"></script>

    </head>
    <body>

        <?php
        if($f == 'ok'){ ?>
            <div class='alerta_fundo'> 
                <div class='mensagem sucesso'>
                    <span class='texto_msg'><?php echo $_SESSION['mensagem_alerta']; ?></span>
                </div>
            </div>
        <?php 
        } 

        else if($f == 'erro'){?>
            <div class='alerta_fundo'> 
                <div class='mensagem erro'>
                    <span class='texto_msg'><?php echo $_SESSION['mensagem_alerta']; ?></span>
                </div>
            </div>
        <?php
        } 
        
        else if($f == 'aten'){?>
            <div class='alerta_fundo'> 
                <div class='mensagem atencao'>
                    <span class='texto_msg'><?php echo $_SESSION['mensagem_alerta']; ?></span>
                </div>
            </div>
        <?php
        }

        ?>
        
        <div class="alerta_verificacao"></div>

        <div class="fundo">
            <div class="modal_exclur">
                <div class="linha_vertical linha_modal">
                    <span class="titulo_modal">Excluir</span>
                    <span class="fechar_modal"><i class="fa fa-close" aria-hidden="true"></i></span>
                </div>
                <div class="linha linha_modal">
                    <label class="acao_desejada">Deseja realmente excluir!</label>
                </div>
                <form method='POST' action='php/controle_sistema.php?f=deletar'>
                    <div class="alinhar_botao_modal">
                        <button type="submit" class="botao botao_azul botao_modal" id="confirma_delete" name="confirma_delete" value="">Sim</button>
                        <button type="button" class="botao botao_azul botao_modal" id="cancelar_cancelar" name="cancelar_cancelar">Não</button>
                    </div>
                </form>
            </div>       
        </div>

        <div class="envelope_body">
            <header>
                <div class="menu_sistema">
                    <div class="img_usuario_sistema">
                        <img src="imagens/perfil.png" alt="usuario_sistema" />
                    </div>
                    <div class="linha">
                        <span class="nome_usuario"><?php echo $_SESSION['horario_login']; ?><small><?php echo $_SESSION['primeiro_nome']; ?></small></span>
                    </div>

                    <nav id="menu_sistema">
                        <ul>
                            <li><i class="fa fa-user-plus" aria-hidden="true"><a href="cadastrarAluno.php">Cadastrar cliente</a></i></li>
                            <li><i class="fa fa-pencil-square-o" aria-hidden="true"><a href="criarFicha.php">Criar ficha</a></i></li>
                            <li><i class="fa fa-paw" aria-hidden="true"><a href="novoExercicio.php">Novo exercício</a></i></li>
                            <li><i class="fa fa-tachometer" aria-hidden="true"><a href="quiosque.php">Dashboard</a></i></li>
                            <li><i class="fa fa-clone" aria-hidden="true"><a href="plano.php">Criar planos</a></i></li>
                            <li><i class="fa fa-calendar" aria-hidden="true"><a href="evento.php">Cadastrar eventos</a></i></li>
                            <li><i class="fa fa-quote-right" aria-hidden="true"><a href="depoimento.php">Depoimentos</a></i></li>
                        </ul>
                    </nav>
                </div>
            </header>

            <section>
                <div class="barra_info">
                    <div class="notificacao_usuario">
                        <i class="fa fa-envelope-o" aria-hidden="true"><span>6</span></i>
                    </div>

                    <div class="botao_hamburger">
                        <span class="hamburguer_topo"></span>
                        <span class="hamburguer_meio"></span>
                        <span class="hamburguer_base"></span>
                    </div>
                </div>

                <div class="envelope">