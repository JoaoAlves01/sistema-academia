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

    function dataBr($data){
        $data = explode("-", $data);
        $data = $data[2]."/".$data[1]."/".$data[0];
        return $data;
    }

    //Listar dias da semana
    function listarDiasSemana(){

        $conexao = conexao();
        $sql = "SELECT * FROM dias_semana ORDER BY semana ASC";
        $resultado = $conexao->query($sql);

        if($resultado)
            return $resultado;
    }

    /*Funcao mascara de cpf*/
    function removerMascaraCPF($cpf) {
       
        $cpf = explode(".", $cpf);
        $cpf = $cpf[0] . $cpf[1] . $cpf[2];

        $cpf = explode("-", $cpf);
        $cpf = $cpf[0] . $cpf[1];
        return $cpf;
    }

    /*Funcao mascara de rg*/
    function removerMascaraRG($rg) {
       
        $rg = explode(".", $rg);
        $rg = $rg[0] . $rg[1] . $rg[2];

        $rg = explode("-", $rg);
        $rg = $rg[0] . $rg[1];
        return $rg;
    }

    //Validar email
    function validarEmail($email){

        if(!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email)){

            $mensagem = false;
            return $mensagem;   
        }

        else{

            $dominio = explode('@',$email);

            if(!checkdnsrr($dominio[1],'A'))
            {
                $mensagem = false;
                return $mensagem;
            }

            else
                return true;
        }
    }

    //Validar itens iguais
    function validarSenhaIgual($senha, $repetida){

        if($senha == $repetida)
        {
            $acao = true;
            return $acao;
        }

        else
        {
            $acao = false;
            return $acao;
        }

    }

    //Retornar idade
    function idadeUsuario($nascimento){

        $nascimento = dataBr($nascimento);

        list($dia, $mes, $ano) = explode("/", $nascimento);

        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        return $idade;
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
                            $_SESSION['mensagem_alerta'] = "Nome já cadastrado, escolha outro!";
                            header('location: ../quiosque.php?f=aten');
                        }

                        else
                        {
                            $sql_insert = "INSERT INTO anuncio (nome_img, nome, situacao) VALUES ('".$novoNome."', '".$nome_img_update."', 'ativo')";
                            $resultado = $conexao->query($sql_insert); 

                            if($resultado)
                            {
                                $_SESSION['nome_img_update'] = "";  
                                $_SESSION['mensagem_alerta'] = "Anúncio cadastrado com sucesso!";
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
            $_SESSION['mensagem_alerta'] = "Preencha todos os campos!";
            header("location: ../quiosque.php?f=aten");
        }
    }

    function listarAnuncio()
    {
        $conexao = conexao();
        $sql = "SELECT * FROM anuncio WHERE situacao = 'ativo' ORDER BY nome ASC";
        $resultado = $conexao->query($sql);

        return $resultado;
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

                            $_SESSION['mensagem_alerta'] = "Plano já cadastrado!";
                            header("location: ../plano.php?f=aten");
                        }

                        else
                        {
                            $conexao = conexao();
                            extract($_POST);

                            $sql_cadastro = "INSERT INTO planos (img_plano, tipo_plano, semana, horario, preco, acao) VALUES('".$novoNome."', '".$nome_aula."', 
                                            '".$inicio_dia_semana." ".$ligacao_dia_semana." ".$termino_dia_semana."', '".$horario_inicio." ".$horario_ligacao." ".$horario_termino."',
                                            '".$preco."', 'ativo')";
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

                                $_SESSION['mensagem_alerta'] = "Plano cadastrado com sucesso!";
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

            $_SESSION['mensagem_alerta'] = "Preencha todos os campos!";
            header("location: ../plano.php?f=aten");
        }
    }

    //Listar planos
    function listarPlanos(){
        $conexao = conexao();
        $sql = "SELECT * FROM planos WHERE acao = 'ativo' ORDER BY tipo_plano ASC";
        $resultado = $conexao->query($sql);

        if($resultado)
            return $resultado;

        else
            return "Nenhum plano cadastrado...";
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
            //Verificar se os campos estão preenchidos
            if($nome_aula != "" && $inicio_dia_semana != "" && $ligacao_dia_semana != "" && $termino_dia_semana
            && $horario_inicio != "" && $horario_ligacao != "" && $horario_termino != "" && $preco != "")
            {
                //Verificar se adicionou img
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
                            {
                                $_SESSION['mensagem_alerta'] = "Plano já cadastrado!";
                                header("location: ../editar_plano.php?f=aten");
                            }

                            else
                            {
                                $sql_editar = "UPDATE planos SET img_plano = '".$novoNome."', tipo_plano = '".$nome_aula."', semana = '".$inicio_dia_semana. " " .$ligacao_dia_semana. " " .$termino_dia_semana. "', horario = '".$horario_inicio. " " .$horario_ligacao. " " .$horario_termino."', preco = '".$preco."' WHERE id = '".$salvar."'";
                                $resultado_editar = $conexao->query($sql_editar);

                                if($resultado_editar)
                                {
                                    $_SESSION['mensagem_alerta'] = "Plano alterado com sucesso!";
                                    $_SESSION['editar_id'] = "";
                                    $_SESSION['editar_img_mini_plano'] = "";
                                    $_SESSION['editar_nome_aula'] = "";
                                    $_SESSION['editar_preco'] = "";
                                    $_SESSION['editar_inicio_dia_semana'] = "";
                                    $_SESSION['editar_ligacao_dia_semana'] = "";
                                    $_SESSION['editar_termino_dia_semana'] = "";
                                    $_SESSION['editar_horario_inicio'] = "";
                                    $_SESSION['editar_horario_ligacao'] = "";
                                    $_SESSION['editar_horario_termino'] = "";
                                    header("location: ../plano.php?f=ok");
                                }

                                else
                                {
                                    $_SESSION['mensagem_alerta'] = "Erro!";
                                    header("location: ../plano.php?f=erro");
                                }
                            }
                        }
                    }
                }

                //Se não adicionou
                else
                {
                    $sql_existe = "SELECT * FROM planos WHERE tipo_plano = '".$nome_aula."'";
                    $resultado_existe = $conexao->query($sql_existe);

                    if($resultado_existe->num_rows)
                    {
                        $_SESSION['mensagem_alerta'] = "Plano já cadastrado!";
                        header("location: ../editar_plano.php?f=aten");
                    }

                    else
                    {
                        $sql_editar = "UPDATE planos SET tipo_plano = '".$nome_aula."', semana = '".$inicio_dia_semana. " " .$ligacao_dia_semana. " " .$termino_dia_semana. "', horario = '".$horario_inicio. " " .$horario_ligacao. " " .$horario_termino."', preco = '".$preco."' WHERE id = '".$salvar."'";
                        $resultado_editar = $conexao->query($sql_editar);

                        if($resultado_editar)
                        {
                            $_SESSION['editar_id'] = "";
                            $_SESSION['editar_img_mini_plano'] = "";
                            $_SESSION['editar_nome_aula'] = "";
                            $_SESSION['editar_preco'] = "";
                            $_SESSION['editar_inicio_dia_semana'] = "";
                            $_SESSION['editar_ligacao_dia_semana'] = "";
                            $_SESSION['editar_termino_dia_semana'] = "";
                            $_SESSION['editar_horario_inicio'] = "";
                            $_SESSION['editar_horario_ligacao'] = "";
                            $_SESSION['editar_horario_termino'] = "";

                            $_SESSION['mensagem_alerta'] = "Plano alterado com sucesso!";
                            header("location: ../plano.php?f=ok");
                        }

                        else
                        {
                            $_SESSION['mensagem_alerta'] = "Erro!";
                            header("location: ../plano.php?f=erro");
                        }
                    }
                }
            }  
            
            else
            {
                $_SESSION['mensagem_alerta'] = "Preencha todos os campos!";
                header("location: ../editar_plano.php?f=aten");
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
                            
                            $_SESSION['mensagem_alerta'] = "Depoimento cadastrado com sucesso!";
                            header("location: ../depoimento.php?f=ok");
                        }

                        else
                        {
                            $_SESSION['nome_depoimento'] = $nome_depoimento;
                            $_SESSION['depoimento'] = $depoimento;
                            $_SESSION['mensagem_alerta'] = "Erro!";
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
            $_SESSION['mensagem_alerta'] = "Depoimento cadastrado com sucesso!";
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
            $_SESSION['mensagem_alerta'] = "Item excluido com sucesso!";

            if($tabela == "anuncio")
                header("location: ../quiosque.php?f=ok");

            else if($tabela == "planos")
                header("location: ../plano.php?f=ok");

            else if($tabela == "depoimento")
                header("location: ../depoimento.php?f=ok");

            else if($tabela == "evento")
                header("location: ../evento.php?f=ok");
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
        $_SESSION['senha_repetir_cadastrado'] = $senha_repetir_cadastrado;
        $_SESSION['email_cadastrado'] = $email_cadastrado;
        $_SESSION['cpf_cadastrado'] = $cpf_cadastrado;
        $_SESSION['rg_cadastrado'] = $rg_cadastrado;
        $_SESSION['sexo_cadastrado'] = $sexo_cadastrado;
        $_SESSION['nascimento_cadastrado'] = $nascimento_cadastrado;
        $_SESSION['tipo_aula_cadastrado'] = $tipo_aula_cadastrado;
        $_SESSION['situacao_cadastrado'] = $situacao_cadastrado;
        $_SESSION['permissao_cadastrado'] = $permissao_cadastrado;

        //Verificar se os campos estao preenchidos
        if($primeiro_nome_cadastrado != "" && $sobrenome_cadastrado != "" && $usuario_cadastrado != "" && $email_cadastrado != "")
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
                        //Validar senha
                        if(validarSenhaIgual($senha_cadastrado, $senha_repetir_cadastrado) == true)
                        {
                            //Verificar tamanho de cpf e rg
                            if(strlen($cpf_cadastrado) == 14 && strlen($rg_cadastrado) == 12)
                            {
                                //Validar email
                                if(validarEmail($email_cadastrado))
                                {
                                    $telefone_numero = $_POST['numero_cadastrado'];
                                    $telefone_tipo = $_POST['tipo_cadastrado'];
                                    $telefone_completo = array();

                                    $endereco_cep = $_POST['cep_cadastrado'];
                                    $endereco_endereco = $_POST['endereco_cadastrado'];
                                    $endereco_complemento = $_POST['complemento_cadastrado'];
                                    $endereco_bairro = $_POST['bairro_cadastrado'];
                                    $endereco_cidade = $_POST['cidade_cadastrado'];
                                    $endereco_estado = $_POST['estado_cadastrado'];
                                    $endereco_completo = array();

                                    for($i = 1; $i <= count($telefone_numero); $i++)
                                    {
                                        $unindo_telefone = $telefone_numero[$i]. "-" .$telefone_tipo[$i];
                                        array_push($telefone_completo, $unindo_telefone);
                                    }

                                    for($i = 1; $i <= count($endereco_cep); $i++)
                                    {
                                        $unindo_endereco = $endereco_cep[$i]. "-" . $endereco_endereco[$i]. "-" . $endereco_complemento[$i]. "-" . $endereco_bairro[$i]. "-" . $endereco_cidade[$i]. "-" . $endereco_bairro[$i];
                                        array_push($endereco_completo, $unindo_endereco);
                                    }

                                    //Convertendo data
                                    $data = dataBd($nascimento_cadastrado);
                                    $telefone_bd = serialize($telefone_completo);
                                    $endereco_bd = serialize($endereco_completo);
                                    $cpf_bd = removerMascaraCPF($cpf_cadastrado);
                                    $rg_bd = removerMascaraRG($rg_cadastrado);

                                    $sql_cadastrar = "INSERT INTO usuario (primeiro_nome, sobrenome, usuario, senha, email, cpf, rg, sexo, nascimento, tipo_aula, 
                                    telefone, endereco, situacao, tipo_usuario, img_usuario) VALUES('".$primeiro_nome_cadastrado."', '".$sobrenome_cadastrado."', 
                                    '".$usuario_cadastrado."', '".$senha_cadastrado."', '".$email_cadastrado."', '".$cpf_bd."', '".$rg_bd."', '".$sexo_cadastrado."', 
                                    '".$data."', ".$tipo_aula_cadastrado.", '".$telefone_bd."', '".$endereco_bd."', '".$situacao_cadastrado."', '".$permissao_cadastrado."', 
                                    '".$novo_nome."')";
                                    $resultado_cadastrar = $conexao->query($sql_cadastrar);

                                    //Adicionou no bd
                                    if($resultado_cadastrar)
                                    {
                                        $_SESSION['primeiro_nome_cadastro'] = "";
                                        $_SESSION['sobrenome_cadastrado'] = "";
                                        $_SESSION['usuario_cadastrado'] = "";
                                        $_SESSION['senha_cadastrado'] = "";
                                        $_SESSION['senha_repetir_cadastrado'] = "";
                                        $_SESSION['email_cadastrado'] = "";
                                        $_SESSION['cpf_cadastrado'] = "";
                                        $_SESSION['rg_cadastrado'] = "";
                                        $_SESSION['sexo_cadastrado'] = "";
                                        $_SESSION['nascimento_cadastrado'] = "";
                                        $_SESSION['situacao_cadastrado'] = "";
                                        $_SESSION['permissao_cadastrado'] = "";
                                        $_SESSION['tipo_aula_cadastrado'] = "";

                                        $_SESSION['mensagem_alerta'] = "Cliente cadastrado com sucesso!";
                                        header("location: ../cadastrarAluno.php?f=ok");
                                    }
                                }

                                else
                                {
                                    $_SESSION['mensagem_alerta'] = "E-mail inválido!";
                                    header("location: ../cadastrarAluno.php?f=aten");
                                }
                            }

                            else
                            {
                                $_SESSION['mensagem_alerta'] = "CPF ou RG inválido!";
                                header("location: ../cadastrarAluno.php?f=aten");
                            }
                        }

                        else
                        {
                            $_SESSION['mensagem_alerta'] = "A senha não está correspondendo a primeira!";
                            header("location: ../cadastrarAluno.php?f=aten");
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

    //Listar clientes
    function listarClientes(){

        $conexao = conexao();
        $sql = "SELECT usuario.*, plano.* FROM usuario AS usuario INNER JOIN planos AS plano ON plano.id = usuario.tipo_aula 
                ORDER BY usuario.primeiro_nome ASC";
        $resultado = $conexao->query($sql);
        return $resultado;
    }

    // listar usuario
    function listarUsuario($permissao){
        $conexao = conexao();
        $sql = "SELECT * FROM usuario WHERE tipo_usuario = '".$permissao."' AND situacao = 'Ativo' ORDER BY primeiro_nome ASC";
        $resultado = $conexao->query($sql);
        return $resultado;
    }

    //Listar clientes - Paginacao
    function listarClientesPaginacao(){

        $inicio_busca = "LIMIT " . $_SESSION['inicio_busca'];
        $filtrar_pagina = $inicio_busca . ", " . $_SESSION['limite_busca'];

        $conexao = conexao();
        $sql = "SELECT usuario.*, plano.* FROM usuario AS usuario INNER JOIN planos AS plano ON plano.id = usuario.tipo_aula ORDER BY usuario.primeiro_nome ASC $filtrar_pagina";
        $resultado = $conexao->query($sql);
        return $resultado;
    }

    //Pegar total usuario
    function totalUsuario(){
        $conexao = conexao();
        $sql = "SELECT * FROM usuario ORDER BY primeiro_nome ASC";
        $resultado = $conexao->query($sql);

        return $resultado->num_rows;
    }

    //Buscar perfil
    function buscarPerfil($id){
        
        $conexao = conexao();
        $sql = "SELECT * FROM usuario WHERE id = '".$id."'";
        $resultado = $conexao->query($sql);
        $resultado_busca = $resultado->fetch_array(MYSQLI_NUM);

        return $resultado_busca;
    }
    
    //Cadastrar Evento
    function cadastrarEvento(){

        extract($_POST);
        $conexao = conexao();

        $_SESSION['nome_evento'] = $nome_evento;
        $_SESSION['endereco_evento'] = $endereco_evento;
        $_SESSION['dia_evento'] = $dia_evento;
        $_SESSION['hora_evento'] = $hora_evento;
        $_SESSION['valor_evento'] = $valor_evento;

        if($nome_evento != "" && $endereco_evento != "" && $dia_evento != "" && $hora_evento != "")
        {
            $arquivo_tmp = $_FILES['anexar_arquivo']['tmp_name'];
            $nome = $_FILES['anexar_arquivo']['name'];
            $extensao = strrchr($nome, '.');
            $extensao = strtolower($extensao);

            if($nome == "" || strstr('.jpg;.jpeg;.gif;.png', $extensao))
            {
                if($nome == "")
                    $novo_nome = "perfil.png";

                else
                    $novo_nome = md5(microtime()) . '.' . $extensao;

                    
                $destino = '../img_evento/'.$novo_nome;

                if(move_uploaded_file($arquivo_tmp, $destino) || $novo_nome == "perfil.png")
                {
                    $dataBanco = dataBd($dia_evento);

                    $sql = "SELECT * FROM evento WHERE data = '".$dataBanco."'";
                    $resultado = $conexao->query($sql);

                    if($resultado->num_rows)
                    {
                        $_SESSION['mensagem_alerta'] = "Já existe um evento nessa data!";
                        header("location: ../evento.php?f=aten");
                    }

                    else
                    {
                        $sql = "INSERT INTO evento (nome_evento, endereco, data, hora, valor, img_evento) VALUES('".$nome_evento."', '".$endereco_evento."',
                        '".$dataBanco."', '".$hora_evento."', '".$valor_evento."', '".$novo_nome."')";
                        $resultado = $conexao->query($sql);

                        if($resultado)
                        {
                            $_SESSION['nome_evento'] = "";
                            $_SESSION['endereco_evento'] = "";
                            $_SESSION['dia_evento'] = "";
                            $_SESSION['hora_evento'] = "";
                            $_SESSION['valor_evento'] = "";

                            $_SESSION['mensagem_alerta'] = "Evento cadastrado com sucesso!";
                            header("location: ../evento.php?f=ok");
                        }

                        else
                        {
                            $_SESSION['mensagem_alerta'] = "Erro!";
                            header("location: ../evento.php?f=erro");
                        }
                    }
                }
            }
        }

        else
        {
            $_SESSION['mensagem_alerta'] = "Preencha todos os campos!";
            header("location: ../evento.php?f=aten");
        }
    }

    //Listar eventos
    function listarEvento(){

        $conexao = conexao();
        $sql = "SELECT * FROM evento ORDER BY nome_evento DESC";
        $resultado = $conexao->query($sql);

        return $resultado;
    }

    //Listar grupo muscular
    function grupoMuscular(){
        $conexao = conexao();
        $sql = "SELECT * FROM grupo_muscular ORDER BY nome ASC";
        $resultado = $conexao->query($sql);

        return $resultado;
    }

    //Salvar exercicio
    function cadastrarExercicio(){

        extract($_POST);
        $conexao = conexao();

        $_SESSION['tipo_exercicio'] = $tipo_exercicio;
        $_SESSION['nome'] = $nome;
        $_SESSION['descricao'] = $descricao;
        $_SESSION['grupo_muscular'] = $grupo;
        $_SESSION['numero_aparelho'] = $number_aparelho;
        $_SESSION['dica'] = $dica;
        $_SESSION['situacao'] = $situacao;

        if($tipo_exercicio != "" && $nome != "" && $grupo != "" && $number_aparelho != "")
        {

            $sql = "SELECT * FROM exercicios WHERE nome = '".$nome."' AND
                    id_grupo = '".$grupo."'";
            $resultado = $conexao->query($sql);

            if($resultado->num_rows)
            {
                $_SESSION['mensagem_alerta'] = "Esse exercício já está cadastrado!";
                header("location: ../novoExercicio.php?f=aten");
            }

            else
            {
                $sql = "INSERT INTO exercicios (tipo, nome, descricao, id_grupo,
                    numero_aparelho, dica, situacao) VALUES('".$tipo_exercicio."', '".$nome."', 
                    '".$descricao."', '".$grupo."', '".$number_aparelho."', '".$dica."', '".$situacao."')";
                $resultado = $conexao->query($sql);

                if($resultado)
                {
                    $_SESSION['tipo_exercicio'] = "musculacao";
                    $_SESSION['nome'] = "";
                    $_SESSION['descricao'] = "";
                    $_SESSION['grupo_muscular'] = "";
                    $_SESSION['numero_aparelho'] = "";
                    $_SESSION['dica'] = "";
                    $_SESSION['situacao'] = '1';

                    $_SESSION['mensagem_alerta'] = "Exercício cadastrado com sucesso!";
                    header("location: ../novoExercicio.php?f=ok");
                }

                else
                {
                    $_SESSION['mensagem_alerta'] = "Erro de conexao com banco!";
                    header("location: ../novoExercicio.php?f=erro");
                }
            }
        }

        else
        {
            $_SESSION['mensagem_alerta'] = "Preencha todos os campos!";
            header("location: ../novoExercicio.php?f=aten");
        }
    }

    //listar grupo_muscular somente se estiver sendo usado
    function listarGrupoMuscularUsado(){

        $conexao = conexao();
        $sql = "SELECT muscular.*, exercicio.* FROM grupo_muscular AS muscular LEFT JOIN exercicios AS 
                exercicio ON exercicio.id_grupo = muscular.id WHERE exercicio.situacao = '1' GROUP BY exercicio.id_grupo ORDER BY muscular.nome ASC";
        $resultado = $conexao->query($sql);

        return $resultado;
    }

    //Listar os exercicios
    function listarExercicio(){

        $conexao = conexao();
        extract($_POST);

        $id_grupo = $_POST['grupo_muscular'];
        $action = $acao;

        $retorno = array();

        if($action == "listar_exercicio")
        {   
            $sql = "SELECT * FROM exercicios WHERE id_grupo = '".$id_grupo."' ORDER BY tipo ASC";
            $resultado = $conexao->query($sql);

            if($resultado)
            {
                $retorno['total'] = $resultado->num_rows;
                $contator = 0;

                while($obj = $resultado->fetch_array(MYSQLI_NUM))
                {
                    $retorno['id'][$contator] = $obj[0];
                    $retorno['tipo'][$contator] = $obj[1];
                    $retorno['nome'][$contator] = $obj[2];
                    $retorno['id_grupo'][$contator] = $obj[4];

                    $contator++;
                }
            }

            die(json_encode($retorno));
        }
    }

    function criarFicha(){

        $conexao = conexao();
        extract($_POST);
        $conj_checkedbox = array();
        $objetivo_check;

        //Verificar se os checks do objetivo estao marcado
        if(isset($objetivo))
        {
            foreach($objetivo as $valor)
            {
                $conj_checkedbox[] = $valor;
            }
        }

        //  Cadastro de ficha
        $sql = "INSERT INTO fichas(id_aluno, qtd_treino, situacao, instrutor, observacao, patologia, 
        objetivo, outros) VALUES('".$_SESSION['id_perfil']."', '".$quantidade_exercicio."', '".$situacao."',
        '".$instrutor."', '".$observacao."', '".$patologia."', '".serialize($conj_checkedbox)."', '".$info_outro."')";
        $resultado = $conexao->query($sql);

        $_SESSION['id_ficha'] = mysqli_insert_id($conexao);

        //Cadastro dos treino
        for($i=1; $i <= $quantidade_exercicio; $i++)
        {
            // Musucalacao ou Cardiovascular
            if($tipo[$i] == "musculacao" || $tipo[$i] == "cardio")
            {
                $sql_treino = "INSERT INTO treinos(id_ficha, dia_semana, descricao, grupo_muscular, exercicio, tempo, velocidade, carga) VALUES('".$_SESSION['id_ficha']."', '".$dia_semana."', '".$descricao."', '".$grupo_muscular[$i]."', '".$exercicio[$i]."', '".$tempo[$i]."', '".$velocidade[$i]."', '".$carga[$i]."')";
            }
            // Funcional
            else if($tipo[$i] == "funcional")
            {
                $sql_treino = "INSERT INTO treinos(id_ficha, dia_semana, descricao, grupo_muscular, exercicio, serie, repeticao, carga, descanso) VALUES('".$_SESSION['id_ficha']."', '".$dia_semana."', '".$descricao."', '".$grupo_muscular[$i]."', '".$exercicio[$i]."', '".$serie[$i]."', '".$repeticao[$i]."', '".$cargar[$i]."', '".$descanso[$i]."')";
            }
            // Cardio
            else
            {
                $sql_treino = "INSERT INTO treinos(id_ficha, dia_semana, descricao, grupo_muscular, exercicio) VALUES('".$_SESSION['id_ficha']."', '".$dia_semana."', '".$descricao."', '".$grupo_muscular[$i]."', '".$exercicio[$i]."')";
            }

            $resultado = $conexao->query($sql_treino);
        }

        header("location: ../perfilFicha.php?id=".$_SESSION['id_perfil']);
    }
?>