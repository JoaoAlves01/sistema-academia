<?php
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_aula']))
    {
        $_SESSION['nome_aula'] = "";
    }
?>
                    <h1 class="titulo_formulario">Administrar Fichas</h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">João Pedro Alves de Sousa</h2>

                        <form method="POST" action="" id="formulario">
                            <div class="container" id="perfil_ficha">
                                <br>
                                <div class="linha_vertical">
                                    <div class="img_usuario_sistema">
                                        <img src="imagens/perfil.png" alt="img_usario" class="centralizar_img" />
                                    </div>

                                    <div class="alinhar_dados_perfil">
                                        <span class="titulo_sub_sub_formulario">Idade<small>20</small></span>

                                        <span class="titulo_sub_sub_formulario">Sexo<small>Masculino</small></span>

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
                            <button type="button" class="botao botao_azul botao_add_ficha"><i class="fa fa-plus" aria-hidden="true"></i>Nova</button>
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
