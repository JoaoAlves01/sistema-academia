<?php
    session_start();
    include_once 'conexao.php';
    
    $msg_sucesso = "sucesso";
    $msg_atencao = "atencao";
    $msg_erro = "erro";

    if(isset($_GET['f']))
    {
        $function = $_GET['f'];

        if(function_exists($function))
        {
            call_user_func($function);
            exit();
        }
    }

    function uploadImagem()
    {
        $conexao = conexao();
        extract($_POST);

        $_SESSION['nome'] = "";

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
                            header('location: ../quiosque.php');
                        }

                        else
                        {
                            $_SESSION['nome'] = $nome_img_update;
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