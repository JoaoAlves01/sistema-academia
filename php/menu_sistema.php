<?php
include('php/controle_sistema.php');

$f="";
if(isset($_GET['f']))
    $f = $_GET['f'];

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
        <script src="lib/js/jquery.js"></script>
        <script src="lib/js/controle_interface.js"></script>
        <script src="lib/js/func_controle.js"></script>
    </head>
    <body>

        <?php
        if($f == 'ok'){ ?>
            <div class='alerta_fundo'> 
                <div class='mensagem sucesso'>
                    <span class='texto_msg'>Cadastrado com sucesso!</span>
                </div>
            </div>
        <?php 
        } 

        else if($f == 'erro'){?>
            <div class='alerta_fundo'> 
                <div class='mensagem erro'>
                    <span class='texto_msg'>Erro ao conectar no banco!</span>
                </div>
            </div>
        <?php
        } 
        
        else if($f == 'aten'){?>
            <div class='alerta_fundo'> 
                <div class='mensagem atencao'>
                    <span class='texto_msg'>Preencha todos os campos!</span>
                </div>
            </div>
        <?php
        }

        else if($f == 'dup'){?>
            <div class='alerta_fundo'> 
                <div class='mensagem atencao'>
                    <span class='texto_msg'>Item já cadastrado!</span>
                </div>
            </div>
        <?php
        }

        else if($f == 'exc'){?>
            <div class='alerta_fundo'> 
                <div class='mensagem sucesso'>
                    <span class='texto_msg'>Item deletado com sucesso!</span>
                </div>
            </div>
        <?php
        }

        else if($f == 'alt'){?>
            <div class='alerta_fundo'> 
                <div class='mensagem atencao'>
                    <span class='texto_msg'>Item alterado com sucesso!</span>
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
                        <span class="nome_usuario"><?php echo $_SESSION['horario_login']; ?><small><?php echo $_SESSION['nome']; ?></small></span>
                    </div>

                    <nav id="menu_sistema">
                        <ul>
                            <li><i class="fa fa-eye" aria-hidden="true"><a href="serie.php">Visualizar Serie</a></i></li>
                            <li><i class="fa fa-book" aria-hidden="true"><a href="historico.php">Histórico</a></i></li>
                            <li><i class="fa fa-user-plus" aria-hidden="true"><a href="cadastrarAluno.php">Cadastrar Aluno</a></i></li>
                            <li><i class="fa fa-pencil-square-o" aria-hidden="true"><a href="cadastrarSerie.php">Cadastrar Serie</a></i></li>
                            <li><i class="fa fa-desktop" aria-hidden="true"><a href="quiosque.php">Quiosque</a></i></li>
                            <li><i class="fa fa-clone" aria-hidden="true"><a href="plano.php">Planos</a></i></li>
                            <li><i class="fa fa-calendar" aria-hidden="true"><a href="evento.php">Eventos</a></i></li>
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