<?php
include_once 'conexao.php';
session_start();

    if(isset($_GET['f']))
    {
        $function = $_GET['f'];

        if(function_exists($function))
        {
            call_user_func($function);
            exit();
        }
    }

    function login()
    {
        $conexao = conexao();
        extract($_POST);

        if($usuario != "" || $senha != "")
        {
            $sql = "SELECT * FROM usuario WHERE usuario = '".$usuario."' AND senha = '".$senha."'";
            $resultado = $conexao->query($sql);

            if($resultado->num_rows)
            {
                $resultado_login = $resultado->fetch_array();
                $_SESSION['id'] = $resultado_login['id'];
                $_SESSION['nome'] = $resultado_login['nome'];
                $_SESSION['usuario'] = $resultado_login['usuario'];
                $_SESSION['senha'] = $resultado_login['senha'];

                /*Pegar horário e informar periodo*/
                date_default_timezone_set("America/Sao_Paulo");
                $hora_atual = date("H");

                if($hora_atual >= 5 && $hora_atual <= 11)
                    $_SESSION['horario_login'] = "Bom dia,";

                else if($hora_atual >= 12 && $hora_atual <= 17)
                    $_SESSION['horario_login'] = "Boa tarde,";

                else
                    $_SESSION['horario_login'] = "Boa noite,";

                $conexao = conexao();
				$sql = "SELECT * FROM usuario WHERE id = '".$_SESSION['id']."'";

				$resultado = $conexao->query($sql);
                $resul = $resultado->fetch_array();
                
                header("location: ../tela_principal.php");
            }

            else
                header("location: ../login.php?f=erro");
        }

        else
            header("location: ../login.php?f=aten");
    }

    function deslogar()
    {
        session_destroy();
        header("location: ../index.php");
    }

    /*Funcoes do quiosque*/
    function uploadImagem()
    {
        $conexao = conexao();
        extract($_POST);

        if($nome_img_update != '' && $_FILES["anexar_arquivo"]["error"] == 0)
        {
            if(isset($_FILES['anexar_arquivo']['name']) && $_FILES["anexar_arquivo"]["error"] == 0)
            {
                // echo "Você enviou o arquivo: <strong>" . $_FILES['anexar_arquivo']['name'] . "</strong><br />";
                // echo "Este arquivo é do tipo: <strong>" . $_FILES['anexar_arquivo']['type'] . "</strong><br />";
                // echo "Temporáriamente foi salvo em: <strong>" . $_FILES['anexar_arquivo']['tmp_name'] . "</strong><br />";
                // echo "Seu tamanho é: <strong>" . $_FILES['anexar_arquivo']['size'] . "</strong> Bytes<br /><br />";
            
                $arquivo_tmp = $_FILES['anexar_arquivo']['tmp_name'];
                $nome = $_FILES['anexar_arquivo']['name'];
            
                // Pega a extensao
                $extensao = strrchr($nome, '.');
            
                // Converte a extensao para mimusculo
                $extensao = strtolower($extensao);
            
                // Somente imagens, .jpg;.jpeg;.gif;.png
                if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
                {
                    // Cria um nome único para esta imagem
                    // Evita que duplique as imagens no servidor.
                    $novoNome = md5(microtime()) . '.' . $extensao;
                    
                    // Concatena a pasta com o nome
                    $destino = '../img_anuncio/' . $novoNome;
                    
                    if(move_uploaded_file( $arquivo_tmp, $destino))
                    {
                        $sql_repeteco = "SELECT * FROM anuncio WHERE nome = '".$nome_img_update."'";
                        $resultado_repeteco = $conexao->query($sql_repeteco);

                        if($resultado_repeteco->num_rows)
                        {
                            $_SESSION['nome_img_update'] = $nome_img_update;
                            header('location: ../quiosque.php?f=dup');
                        }

                        else
                        {
                            $sql_insert = "INSERT INTO anuncio (nome_img, nome) VALUES ('".$novoNome."', '".$nome_img_update."')";
                            $resultado = $conexao->query($sql_insert); 

                            if($resultado)
                            {
                                $_SESSION['nome_img_update'] = "";  
                                header('location: ../quiosque.php?f=ok');
                            }

                            else
                            {
                                $_SESSION['img_anuncio'] = $destino;
                                $_SESSION['nome_img_update'] = $nome_img_update;
                                header('location: ../tela_principal.php'); 
                            }
                        }
                    }

                    else
                        echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
                }

                else
                    echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
            }
        }

        else
        {
            $_SESSION['nome_img_update'] = $nome_img_update;
            header("location: ../quiosque.php?f=aten");
        }
    }

    function listarAnuncio()
    {
        $conexao = conexao();
        $sql = "SELECT * FROM anuncio ORDER BY nome ASC";
        $resultado = $conexao->query($sql);

        if($resultado)
        {
            while($obj = mysqli_fetch_assoc($resultado))
            {
                echo    "<div class='box_contato'>
                            <form method='POST' id='form".$obj['id']."' action='php/controle_sistema.php?f=deletarAnuncio'>
                                <input type='hidden' name='id_card' value='".$obj['id']."'/>
                                <h1>".$obj['nome']."</h1>
                                <div class='box_img_anuncio'>
                                    <img class='centralizar_img' src='img_anuncio/".$obj['nome_img']."' />
                                </div>
                                <div class='linha base_box_anuncio'>
                                    <button type='submit' class='botao excluir_botao botao_vermelho' value=".$obj['id'].">Excluir</button>
                                </div>
                            </form>
                        </div>";
            }
        }
    }

    function deletarAnuncio()
    {
        $conexao = conexao();
        extract($_POST);

        $sql = "DELETE FROM anuncio WHERE id = '".$id_card."'";
        $resultado = $conexao->query($sql);

        if($resultado)
            header('location: ../quiosque.php?f=exc');
    }

    /*Funcoes do plano*/
    function cadastrarPlano()
    {
        $conexao = conexao();
        extract($_POST);

        if($nome_aula != "" && $inicio_dia_semana != "" && $ligacao_dia_semana != "" && $termino_dia_semana
            && $horario_inicio != "" && $horario_ligacao != "" && $horario_termino != "" && $preco != "" && (isset($_FILES['anexar_arquivo']['name']) && $_FILES["anexar_arquivo"]["error"] == 0))
        {
            if(isset($_FILES['anexar_arquivo']['name']) && $_FILES["anexar_arquivo"]["error"] == 0)
            {
                $arquivo_tmp = $_FILES['anexar_arquivo']['tmp_name'];
                $nome = $_FILES['anexar_arquivo']['name'];
                $extensao = strrchr($nome, '.');
                $extensao = strtolower($extensao);

                if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
                {
                    $novoNome = md5(microtime()) . '.' . $extensao;
                    $destino = '../img_planos/' . $novoNome;

                    if(move_uploaded_file( $arquivo_tmp, $destino))
                    {
                        $sql = "SELECT * FROM planos WHERE tipo_plano = '".$nome_aula."'";
                        $resultado = $conexao->query($sql);

                        if($resultado->num_rows)
                        {
                            $_SESSION['nome_aula'] = $nome_aula;
                            $_SESSION['inicio_dia_semana'] = $inicio_dia_semana;
                            $_SESSION['ligacao_dia_semana'] = $ligacao_dia_semana;
                            $_SESSION['termino_dia_semana'] = $termino_dia_semana;
                            $_SESSION['horario_inicio'] = $horario_inicio;
                            $_SESSION['horario_ligacao'] = $horario_ligacao;
                            $_SESSION['horario_termino'] = $horario_termino;
                            $_SESSION['preco'] = $preco;

                            header("location: ../plano.php?f=dup");
                        }

                        else
                        {
                            $conexao = conexao();
                            extract($_POST);

                            $sql_cadastro = "INSERT INTO planos (img_plano, tipo_plano, semana, horario, preco) VALUES('".$novoNome."', '".$nome_aula."', 
                                            '".$inicio_dia_semana." ".$ligacao_dia_semana." ".$termino_dia_semana."', '".$horario_inicio." ".$horario_ligacao." ".$horario_termino."',
                                            '".$preco."')";
                            $resultado_cadastro = $conexao->query($sql_cadastro);

                            if($resultado_cadastro)
                            {
                                $_SESSION['nome_aula'] = "";
                                $_SESSION['inicio_dia_semana'] = "";
                                $_SESSION['ligacao_dia_semana'] = "";
                                $_SESSION['termino_dia_semana'] = "";
                                $_SESSION['horario_inicio'] = "";
                                $_SESSION['horario_ligacao'] = "";
                                $_SESSION['horario_termino'] = "";
                                $_SESSION['preco'] = "";
                                $_SESSION['img_mini'] = "mini_img_anuncio.jpg";

                                header("location: ../plano.php?f=ok");
                            }
                        }
                    }
                }
            }
        }

        else
        {
            $_SESSION['nome_aula'] = $nome_aula;
            $_SESSION['inicio_dia_semana'] = $inicio_dia_semana;
            $_SESSION['ligacao_dia_semana'] = $ligacao_dia_semana;
            $_SESSION['termino_dia_semana'] = $termino_dia_semana;
            $_SESSION['horario_inicio'] = $horario_inicio;
            $_SESSION['horario_ligacao'] = $horario_ligacao;
            $_SESSION['horario_termino'] = $horario_termino;
            $_SESSION['preco'] = $preco;

            header("location: ../plano.php?f=aten");
        }
    }

    function listarPlanos()
    {
        $conexao = conexao();
        extract($_POST);

        $sql = "SELECT * FROM planos ORDER BY tipo_plano ASC";
        $resultado = $conexao->query($sql);

        if($resultado)
        {
            while($obj = mysqli_fetch_assoc($resultado))
            {
                echo    "<div class='box_contato'>
                            <form method='POST' action='php/controle_sistema.php?f=configPlano'>
                                <input type='hidden' name='id_card' value='".$obj['id']."'/>
                                <h1>".$obj['tipo_plano']."</h1>
                                <div class='box_img_anuncio'>
                                    <img class='centralizar_img' src='img_planos/".$obj['img_plano']."' />
                                </div>
                                <div class='linha base_box_anuncio'>
                                    <button type='submit' class='botao editar_botao botao_amarelo' name='editar' value=".$obj['id'].">Editar</button>
                                    <button type='submit' class='botao excluir_botao botao_vermelho' name='excluir' value=".$obj['id'].">Excluir</button>
                                </div>
                            </form>
                        </div>";
            }
        }
    }

    function configPlano()
    {
        extract($_POST);
        $conexao = conexao();

        if(isset($_POST["editar"]))
        {
            $sql_puxar_dados = "SELECT * FROM planos WHERE id = '".$editar."'";
            $resultado_puxar_dados = $conexao->query($sql_puxar_dados);

            if($resultado_puxar_dados->num_rows)
            {
                $resultado = $resultado_puxar_dados->fetch_array();

                //Dados vindo do banco
                $semana = $resultado['semana'];
                $horario = $resultado['horario'];

                //Quebrando dados para adicionar nos campos
                $semana_quebrando = explode(" ", $semana);
                $hora_quebrando = explode(" ", $horario);
                
                $_SESSION['editar_img_mini_plano'] = $resultado['img_plano'];
                $_SESSION['editar_nome_aula'] = $resultado['tipo_plano'];
                $_SESSION['editar_preco'] = $resultado['preco'];
                $_SESSION['editar_inicio_dia_semana'] = $semana_quebrando[0];
                $_SESSION['editar_ligacao_dia_semana'] = $semana_quebrando[1];
                $_SESSION['editar_termino_dia_semana'] = $semana_quebrando[2];
                $_SESSION['editar_horario_inicio'] = $hora_quebrando[0];
                $_SESSION['editar_horario_ligacao'] = $resultado = [1];
                $_SESSION['editar_horario_termino'] = $resultado = [2];

                //header("location: ../editar_plano.php");
            }
        }

        else if(isset($_POST["excluir"]))
        {
            $sql_excluir = "DELETE FROM planos WHERE id = '".$excluir."'";
            $resultado_excluir = $conexao->query($sql_excluir);
            
            if($resultado_excluir)
            {
                header("location: ../plano.php?f=exc");
            }
        }
    }
?>