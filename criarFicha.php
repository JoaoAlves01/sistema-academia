<?php 
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_depoimento']))
    {
        $_SESSION['nome_depoimento'] = "";
        $_SESSION['depoimento'] = "";
    }
?>

                    <h1 class="titulo_formulario">Administrar Fichas</h1>
                    
                    <div class="envelope_formulario">
                        <h3 class="titulo_sub_sub_formulario">Todos as fitas</h3>
                        
                        <!-- Linha de pesquisa -->
                        <div class="linha_vertical pesquisar_cliente" id="pesquisar_cliente">
                            <button type="button" class="botao botao_busca" id="botao_busca" name="botao_busca"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <input type="text" class="campo_sistema" name="buscar_cliente" id="buscar_cliente" placeholder="Pesquisar cliente..." />
                        </div>

                        <div class="tabela_cliente">
                            <div class="linha_vertical" id="tabela_cliente">
                                <div class="lista_img"></div>
                                <div class="lista_nome_completo"><span>Nome Completo</span></div>
                                <div class="listar_quant_ficha"><span>Quant. de Fichas</span></div>
                                <div class="lista_prof"><span>Professor</span></div>
                            </div>
                            
                            <div class="linha_tabela">
                                <a href="#">
                                    <div class="linha_vertical">
                                        <div class="lista_img">
                                            <div class="container_img_tabela">
                                                <img src="imagens/0001.png" alt="lista_img_tabela" class="centralizar_img" />
                                            </div>
                                        </div>

                                        <div class="lista_nome_completo">
                                            <span>João Pedro Alves de Sousa</span>
                                        </div>

                                        <div class="listar_quant_ficha">
                                            <span>1</span>
                                        </div>
                                        
                                        <div class="lista_prof">
                                            <span>Professor</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>