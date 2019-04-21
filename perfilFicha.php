<?php
    include('php/menu_sistema.php');
 
    if(empty($_SESSION['nome_aula']))
    {
        $_SESSION['nome_aula'] = "";
    }

    if(isset($_GET['id']))
    {   
        $url_id = $_GET['id'];

        $_SESSION['id_perfil'] = $url_id;
        $_SESSION['dados_usuario_perfil'] = buscarPerfil($_SESSION['id_perfil']);
    }
?>
                    <h1 class="titulo_formulario">Administrar Fichas</h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario"><?php echo $_SESSION['dados_usuario_perfil'][1]." ".$_SESSION['dados_usuario_perfil'][2]; ?></h2>

                        <form method="POST" action="" id="formulario">
                            <div class="container" id="perfil_ficha">
                                <br>
                                <div class="linha_vertical">
                                    <div class="img_usuario_sistema">
                                        <img src="img_perfil/<?php echo $_SESSION['dados_usuario_perfil'][15]; ?>" alt="<?php echo $_SESSION['dados_usuario_perfil'][15]. $_SESSION['dados_usuario_perfil'][0]; ?>" class="centralizar_img" />
                                    </div>

                                    <div class="alinhar_dados_perfil">
                                        <span class="titulo_sub_sub_formulario">Idade<small><?php echo idadeUsuario($_SESSION['dados_usuario_perfil'][9]); ?></small></span>

                                        <span class="titulo_sub_sub_formulario">Início<small>02/02/2019</small></span>

                                        <span class="titulo_sub_sub_formulario">E-mail<small><?php echo $_SESSION['dados_usuario_perfil'][5]; ?></small></span>

                                        <span class="titulo_sub_sub_formulario">Situação<small><?php echo $_SESSION['dados_usuario_perfil'][13]; ?></small></span>

                                        <span class="titulo_sub_sub_formulario">Fichas<small>01</small></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>

                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Fichas</h2>

                        <div class="linha_vertical pesquisar_cliente">
                            <a href="<?php echo 'criarFichaIndividual.php?id=' . $_SESSION['id_perfil']; ?>" class="botao botao_azul botao_add_ficha"><i class="fa fa-plus" aria-hidden="true"></i>Nova</a>
                        </div>

                        <form method="POST" action="" id="formulario">
                            <div class="tabela_cliente">
                                <!-- linha ativo -->
                                <div class="linha_tabela">
                                    <a href="#">
                                        <div class="linha_vertical">
                                            <div class="container_linha">
                                                <div class="titulo_ficha">Ficha n° 1 - Ativa</div>
                                                <div class="titulo_ficha"><b>Criado em: </b>06/02/2019</div>
                                                <div class="titulo_ficha"><b>Última edição: </b>06/02/2019</div>
                                            </div>

                                            <div class="container_linha" id="dados_ficha">
                                                <span class="titulo_sub_sub_formulario">Treino<small>1</small></span>
                                                <span class="titulo_sub_sub_formulario">Realizado<small>1</small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="linha_tabela">
                                    <a href="#">
                                        <div class="linha_vertical">
                                            <div class="container_linha">
                                                <div class="titulo_ficha">Ficha n° 1 - Ativa</div>
                                                <div class="titulo_ficha"><b>Criado em: </b>06/02/2019</div>
                                                <div class="titulo_ficha"><b>Última edição: </b>06/02/2019</div>
                                            </div>

                                            <div class="container_linha" id="dados_ficha">
                                                <span class="titulo_sub_sub_formulario">Treino<small>1</small></span>
                                                <span class="titulo_sub_sub_formulario">Realizado<small>1</small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="linha_tabela">
                                    <a href="#">
                                        <div class="linha_vertical">
                                            <div class="container_linha">
                                                <div class="titulo_ficha">Ficha n° 1 - Ativa</div>
                                                <div class="titulo_ficha"><b>Criado em: </b>06/02/2019</div>
                                                <div class="titulo_ficha"><b>Última edição: </b>06/02/2019</div>
                                            </div>

                                            <div class="container_linha" id="dados_ficha">
                                                <span class="titulo_sub_sub_formulario">Treino<small>1</small></span>
                                                <span class="titulo_sub_sub_formulario">Realizado<small>1</small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
