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

    function dataBd($data){
        $data = explode("/", $data);
        $data = $data[2]."-".$data[1]."-".$data[0];
        return $data;
    }

    function dataBr(){
        $dataBrazuca = data("d/m/Y");
        return $dataBrazuca;
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
                $resultado_login = $resultado->fetch_array(MYSQLI_NUM);
                $_SESSION['id'] = $resultado_login[0];
                $_SESSION['primeiro_nome'] = $resultado_login[1];
                $_SESSION['usuario'] = $resultado_login[3];
                $_SESSION['senha'] = $resultado_login[4];

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
                            <h1>".$obj['nome']."</h1>
                            <div class='box_img_anuncio'>
                                <img class='centralizar_img' src='img_anuncio/".$obj['nome_img']."' />
                            </div>
                            <div class='linha base_box_anuncio'>
                                <button type='button' class='botao excluir_botao botao_vermelho' value='anuncio_".$obj['id']."'>Excluir</button>
                            </div>
                        </div>";
            }
        }
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

        $sql = "SELECT * FROM planos ORDER BY tipo_plano ASC";
        $resultado = $conexao->query($sql);

        if($resultado)
        {
            while($obj = mysqli_fetch_assoc($resultado))
            {
                echo    "<div class='box_contato'>
                            <form method='POST' action='php/controle_sistema.php?f=configPlano'>
                                <h1>".$obj['tipo_plano']."</h1>
                                <div class='box_img_anuncio'>
                                    <img class='centralizar_img' src='img_planos/".$obj['img_plano']."' />
                                </div>
                                <div class='linha base_box_anuncio'>
                                    <button type='submit' class='botao editar_botao botao_amarelo' name='editar' value=".$obj['id'].">Editar</button>
                                    <button type='button' class='botao excluir_botao botao_vermelho' name='excluir' value='planos_".$obj['id']."'>Excluir</button>
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
                
                $_SESSION['editar_id'] = $resultado['id'];
                $_SESSION['editar_img_mini_plano'] = $resultado['img_plano'];
                $_SESSION['editar_nome_aula'] = $resultado['tipo_plano'];
                $_SESSION['editar_preco'] = $resultado['preco'];
                $_SESSION['editar_inicio_dia_semana'] = $semana_quebrando[0];
                $_SESSION['editar_ligacao_dia_semana'] = $semana_quebrando[1];
                $_SESSION['editar_termino_dia_semana'] = $semana_quebrando[2];
                $_SESSION['editar_horario_inicio'] = $hora_quebrando[0];
                $_SESSION['editar_horario_ligacao'] = $hora_quebrando[1];
                $_SESSION['editar_horario_termino'] = $hora_quebrando[2];

                header("location: ../editar_plano.php");
            }
        }

        else if(isset($_POST["salvar"]))
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
                        $sql_existe = "SELECT * FROM planos WHERE tipo_plano = '".$nome_aula."'";
                        $resultado_existe = $conexao->query($sql_existe);

                        if($resultado_existe->num_rows)
                            header("location: ../editar_plano.php?f=dup");

                        else
                        {
                            $sql_editar = "UPDATE planos SET img_plano = '".$novoNome."', tipo_plano = '".$nome_aula."', semana = '".$inicio_dia_semana. " " .$ligacao_dia_semana. " " .$termino_dia_semana. "', horario = '".$horario_inicio. " " .$horario_ligacao. " " .$horario_termino."', preco = '".$preco."' WHERE id = '".$salvar."'";
                            $resultado_editar = $conexao->query($sql_editar);

                            if($resultado_editar)
                                header("location: ../plano.php?f=alt");

                            else
                            header("location: ../plano.php?f=erro");
                        }
                    }
                }
            }

            else
            {
                $sql_existe = "SELECT * FROM planos WHERE tipo_plano = '".$nome_aula."'";
                $resultado_existe = $conexao->query($sql_existe);

                if($resultado_existe->num_rows)
                    header("location: ../editar_plano.php?f=dup");

                else
                {
                    $sql_editar = "UPDATE planos SET tipo_plano = '".$nome_aula."', semana = '".$inicio_dia_semana. " " .$ligacao_dia_semana. " " .$termino_dia_semana. "', horario = '".$horario_inicio. " " .$horario_ligacao. " " .$horario_termino."', preco = '".$preco."' WHERE id = '".$salvar."'";
                    $resultado_editar = $conexao->query($sql_editar);

                    if($resultado_editar)
                        header("location: ../plano.php?f=alt");

                    else
                    header("location: ../plano.php?f=erro");
                }
            }
        }
    }

    /*Funcoes do depoimento*/
    function cadastrarDepoimento()
    {
        $conexao = conexao();
        extract($_POST);

        if($nome_depoimento != "" || $depoimento != "")
        {
            if(isset($_FILES['anexar_arquivo']['name']) && $_FILES['anexar_arquivo']['error'] == 0)
            {
                $arquivo_tmp = $_FILES['anexar_arquivo']['tmp_name'];
                $nome = $_FILES['anexar_arquivo']['name'];
                $extensao = strrchr($nome, '.');
                $extensao = strtolower($extensao);

                if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
                {
                    $novoNome = md5(microtime()) . '.' . $extensao;
                    $destino = '../img_depoimento/'.$novoNome;

                    if(move_uploaded_file($arquivo_tmp, $destino))
                    {
                        $sql_insert = "INSERT INTO depoimento (img_nome, nome, depoimento) VALUES ('".$novoNome."', '".$nome_depoimento."', '".$depoimento."')";
                        $resultado_insert = $conexao->query($sql_insert);

                        if($resultado_insert)
                        {
                            $_SESSION['img_mini'] = "mini_img_anuncio.jpg";
                            $_SESSION['nome_depoimento'] = "";
                            $_SESSION['depoimento'] = "";

                            header("location: ../depoimento.php?f=ok");
                        }

                        else
                        {
                            $_SESSION['nome_depoimento'] = $nome_depoimento;
                            $_SESSION['depoimento'] = $depoimento;

                            header("location: ../depoimento.php?f=erro");
                        }
                    }
                }
            }
        }

        else
        {
            $_SESSION['nome_depoimento'] = $nome_depoimento;
            $_SESSION['depoimento'] = $depoimento;
            header("location: ../depoimento.php?f=aten");
        }
    }

    function listarDepoimento()
    {
        $conexao = conexao();
        $sql_listar = "SELECT * FROM depoimento";
        $resultado_lista = $conexao->query($sql_listar);

        if($resultado_lista)
        {
            while($obj = mysqli_fetch_assoc($resultado_lista))
            {
                echo "<div class='box_depoimento'>
                        <form method='POST' action='php/controle_sistema.php?f=configDepoimento'>
                            <div class='linha_vertical'>
                                <div class='box_img_depoimento'>
                                    <img class='centralizar_img' src='img_depoimento/".$obj['img_nome']."' />
                                </div>
                                <div class='box_texto_depoimento'>
                                    <span class='texto_depoimento'>Depoimento - ".$obj['nome']."<small>".$obj['depoimento']."</small></span>
                                </div>
                                <div class=' linha_vertical base_box_depoimento'>
                                    <button type='submit' class='botao editar_botao botao_amarelo' name='editar' value='".$obj['id']."'>Editar</button>
                                    <button type='button' class='botao excluir_botao botao_vermelho' name='excluir' value='depoimento_".$obj['id']."'>Excluir</button>
                                </div>
                            </div>
                        </form>
                    </div>";
            }
        }
    }

    function configDepoimento()
    {
        extract($_POST);
        $conexao = conexao();

        if(isset($_POST["editar"]))
        {
            $sql_puxar = "SELECT * FROM depoimento WHERE id = '".$editar."'";
            $resultado_puxar = $conexao->query($sql_puxar);

            if($resultado_puxar->num_rows)
            {
                $resultado = $resultado_puxar->fetch_array();

                $_SESSION['editar_nome_depoimento'] = $resultado['nome'];
                $_SESSION['editar_depoimento'] = $resultado['depoimento'];
                $_SESSION['editar_img_mini_depoimento'] = $resultado['img_nome'];
                $_SESSION['editar_id_depoimento'] = $resultado['id'];

                header("location: ../editar_depoimento.php");
            }
        }

        else if(isset($_POST["salvar"]))
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
                    $destino = '../img_depoimento/' . $novoNome;

                    if(move_uploaded_file( $arquivo_tmp, $destino))
                    {
                        $sql_editar = "UPDATE depoimento SET img_nome = '".$novoNome."', nome = '".$nome_depoimento."', depoimento = '".$depoimento. "' WHERE id = '".$salvar."'";
                        $resultado_editar = $conexao->query($sql_editar);

                        if($resultado_editar)
                            header("location: ../depoimento.php?f=alt");

                        else
                            header("location: ../depoimento.php?f=erro");
                    }
                }
            }

            else
            {
                $sql_editar = "UPDATE depoimento SET nome = '".$nome_depoimento."', depoimento = '".$depoimento. "' WHERE id = '".$salvar."'";
                $resultado_editar = $conexao->query($sql_editar);

                if($resultado_editar)
                    header("location: ../depoimento.php?f=alt");

                else
                    header("location: ../depoimento.php?f=erro");
            }
        }

        else
        {
            $sql_excluir = "DELETE FROM depoimento WHERE id = '".$excluir."'";
            $resultado_excluir = $conexao->query($sql_excluir);
            
            if($resultado_excluir)
            {
                header("location: ../depoimento.php?f=exc");
            }
        }
    }

    /*Funcao Deletar*/
    function deletar(){

        extract($_POST);
        $conexao = conexao();

        $quebrando = explode("_", $confirma_delete);
        $tabela = $quebrando[0];
        $id = $quebrando[1];
        
        $sql_excluir = "DELETE FROM ".$tabela." WHERE id = '".$id."'";
        $resultado_excluir = $conexao->query($sql_excluir);
            
        if($resultado_excluir)
        {
            if($tabela == "anuncio")
                header("location: ../quiosque.php?f=exc");

            else if($tabela == "planos")
                header("location: ../plano.php?f=exc");

            else if($tabela == "depoimento")
                header("location: ../depoimento.php?f=exc");
        }
    }

    /*Cadastrar clienter*/
    function cadastrarCliente(){

        extract($_POST);
        $conexao = conexao();

        $_SESSION['primeiro_nome_cadastro'] = $primeiro_nome_cadastrado;
        $_SESSION['sobrenome_cadastrado'] = $sobrenome_cadastrado;
        $_SESSION['usuario_cadastrado'] = $usuario_cadastrado;
        $_SESSION['senha_cadastrado'] = $senha_cadastrado;
        $_SESSION['email_cadastrado'] = $email_cadastrado;
        $_SESSION['cpf_cadastrado'] = $cpf_cadastrado;
        $_SESSION['rg_cadastrado'] = $rg_cadastrado;
        $_SESSION['sexo_cadastrado'] = $sexo_cadastrado;
        $_SESSION['nascimento_cadastrado'] = $nascimento_cadastrado;
        $_SESSION['situacao_cadastrado'] = $situacao_cadastrado;
        $_SESSION['permissao_cadastrado'] = $permissao_cadastrado;

        //Verificar se os campos estao preenchidos
        if($primeiro_nome_cadastrado != "" && $sobrenome_cadastrado != "" && $usuario_cadastrado != "" && $senha_cadastrado != "" && $email_cadastrado != "")
        {
            $sql_usuario_repetido = "SELECT * FROM usuario WHERE usuario = '".$usuario_cadastrado."'";
            $resultado_usuario_repetido = $conexao->query($sql_usuario_repetido);

            //Existe? Sim
            if($resultado_usuario_repetido->num_rows)
            {
                $_SESSION['mensagem_alerta'] = "usuário já cadastrado!";
                header("location: ../cadastrarAluno.php?f=aten");
            }

            //Existe? Nao
            else
            {
                $arquivo_tmp = $_FILES['anexar_arquivo'] ['tmp_name'];
                $nome = $_FILES['anexar_arquivo'] ['name'];
                $extensao = strrchr($nome, '.');
                $extensao = strtolower($extensao);

                //Verificar extensao do foto - jpg, jpeg, git, png
                if($nome == "" || strstr('.jpg;.jpeg;.gif;.png', $extensao))
                {
                    //Caso não seja escolhido nenhuma foto, ira colocar uma foto padrao do sistema
                    if($nome == "")
                        $novo_nome = "perfil.png";

                    else
                        $novo_nome = md5(microtime()) . '.' . $extensao;

                    
                    $destino = '../img_perfil/'.$novo_nome;

                    //Verificar se moveu o arquivo
                    if(move_uploaded_file($arquivo_tmp, $destino) || $novo_nome == "perfil.png")
                    {
                        $pegando_telefone = array($_POST['numero_cadastrado'], $_POST['tipo_cadastrado']);
                        $pegando_endereco = $_POST['endereco_cadastrado'];
                        
                        //Criando serialize
                        foreach ($pegando_telefone as $key => $value_telefone) 
                            serialize($value_telefone);

                        foreach ($pegando_endereco as $key => $value_endereco) 
                            $value_endereco;

                        //Convertendo data
                        $data = dataBd($nascimento_cadastrado);

                        $sql_cadastrar = "INSERT INTO usuario (primeiro_nome, sobrenome, usuario, senha, email, cpf, rg, sexo, nascimento, telefone)
                        VALUE('".$primeiro_nome_cadastrado."', '".$sobrenome_cadastrado."', '".$usuario_cadastrado."', '".$senha_cadastrado."', 
                        '".$email_cadastrado."', '".$cpf_cadastrado."', '".$rg_cadastrado."', '".$sexo_cadastrado."', '".$data."', '".$value_telefone."')";
                        $resultado_cadastrar = $conexao->query($sql_cadastrar);

                        //Adicionou no bd
                        if($resultado_cadastrar)
                        {
                            $_SESSION['primeiro_nome_cadastro'] = "";
                            $_SESSION['sobrenome_cadastrado'] = "";
                            $_SESSION['usuario_cadastrado'] = "";
                            $_SESSION['senha_cadastrado'] = "";
                            $_SESSION['email_cadastrado'] = "";
                            $_SESSION['cpf_cadastrado'] = "";
                            $_SESSION['rg_cadastrado'] = "";
                            $_SESSION['sexo_cadastrado'] = "";
                            $_SESSION['nascimento_cadastrado'] = "";
                            $_SESSION['situacao_cadastrado'] = "";
                            $_SESSION['permissao_cadastrado'] = "";

                            $_SESSION['mensagem_alerta'] = "Cliente cadastrado com sucesso!";
                            header("location: ../cadastrarAluno.php?f=ok");
                        }
                    }

                    else
                    {
                        $_SESSION['mensagem_alerta'] = "Ocorreu algum erro ao salvar sua foto, tente novamente!";
                        header("location: ../cadastrarAluno.php?f=erro");
                    }
                }

                //Caso o formado da imagem seja invalido
                else
                {
                    $_SESSION['mensagem_alerta'] = "Você poderá enviar apenas arquivos em \"*.jpg;*.jpeg;*.gif;*.png\"";
                    header("location: ../cadastrarAluno.php?f=erro");
                }

            }
        }

        //Caso tenha campo em branco
        else
        {
            $_SESSION['mensagem_alerta'] = "Preencha todos os campos!";
            header("location: ../cadastrarAluno.php?f=aten");
        }
    }
    
?>