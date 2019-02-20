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

    function uploadImagem()
    {
        $conexao = conexao();
        extract($_POST);

        if($nome_img_update != '' || $_FILES["anexar_arquivo"]["error"] == 0)
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
                        $sql = "INSERT INTO anuncio (nome_img, nome) VALUES ('".$novoNome."', '".$nome_img_update."')";
                        $resultado = $conexao->query($sql); 

                        if($resultado)
                        {
                            header('location: ../quiosque.php?f=ok');
                        }

                        else
                        {
                            $_SESSION['nome_img_upload'] = $nome_img_update;
                            header('location: ../tela_principal.php'); 
                        }
                    }

                    else
                        echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
                }

                else
                    echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
            }
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
                                    <button type='button' class='botao excluir_botao botao_vermelho' value=".$obj['id']." onclick='deletar(this.value)'>Excluir</button>
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
        {
            header('location: ../quiosque.php');
        }
    }
?>