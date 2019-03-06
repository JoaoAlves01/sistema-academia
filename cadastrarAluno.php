<?php 
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_depoimento']))
    {
        $_SESSION['nome_depoimento'] = "";
        $_SESSION['depoimento'] = "";
    }
?>

                    <h1 class="titulo_formulario">Administrar Clientes</h1>
                    
                    <div class="envelope_formulario">
                        <form method="POST" action="php/controle_sistema.php?f=cadastrarEvento" id="formulario" enctype="multipart/form-data">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <h3 class="titulo_sub_sub_formulario">Foto do perfil</h3>
                                    <img src="imagens/mini_img_anuncio.jpg" alt= "mini_img_plano" class="mini_foto_anuncio" id="mini_foto_anuncio" name="mini_foto_anuncio" />
                                    <input type="file" class="update_arquivo" id="anexar_arquivo"  name="anexar_arquivo" onchange="visualizar_img(this,'mini_foto_anuncio');" />
                                </div>

                                <div class="direita_update">
                                    <h3 class="titulo_sub_sub_formulario">Informações Gerais</h3>
                                    <div class="conter_campos_formulario">
                                
                                        <!-- Primeira linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="primeiro_nome_cadastrado">Primeiro nome</label>
                                                <input type="text" class="campo_sistema" id="primeiro_nome_cadastrado" name="primeiro_nome_cadastrado" maxlength="70" value="" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="sobrenome_cadastrado">Sobrenome</label>
                                                <input type="text" class="campo_sistema" id="sobrenome_cadastrado" name="sobrenome_cadastrado" maxlength="14" value="" />
                                            </div>
                                        </div>
                                        <!-- Segunda linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="usuario_cadastrado">Nome de usuário</label>
                                                <input type="text" class="campo_sistema" id="usuario_cadastrado" name="usuario_cadastrado" maxlength="20" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="senha_cadastrado">Senha</label>
                                                <input type="password" class="campo_sistema" id="senha_cadastrado" name="senha_cadastrado" maxlength="20" value="" />
                                            </div>
                                        </div>
                                        <!-- Terceira linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="email_cadastrado">E-mail</label>
                                                <input type="text" class="campo_sistema" id="email_cadastrado" name="email_cadastrado" value="" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="cpf_cadastrado">CPF</label>
                                                <input type="text" class="campo_sistema" id="cpf_cadastrado" name="cpf_cadastrado" maxlength="70" value="" />
                                            </div>
                                        </div>
                                        <!-- Quarta linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="rg_cadastrado">RG</label>
                                                <input type="text" class="campo_sistema" id="rg_cadastrado" name="rg_cadastrado" maxlength="17" value="" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="sexo_cadastrado">Sexo</label>
                                                <select class="campo_sistema" id="sexo_cadastrado" name="sexo_cadastrado">
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Feminino">Feminino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Quinta linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="nascimento_cadastrado">Data de nascimento</label>
                                                <input type="text" class="campo_sistema campo_calendario" id="nascimento_cadastrado" name="nascimento_cadastrado" maxlength="10" value="" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="situacao_cadastrado">Situação</label>
                                                <select class="campo_sistema" id="situacao_cadastrado" name="situacao_cadastrado">
                                                    <option value="Masculino">Ativo</option>
                                                    <option value="Feminino">Desativado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Sexta linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">

                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="permissao_cadastrado">Permissão</label>
                                                <select class="campo_sistema" id="permissao_cadastrado" name="permissao_cadastrado">
                                                    <option value="Administrador">Administrador</option>
                                                    <option value="Aluno">Aluno</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        <!-- Telefones -->
                                        <h3 class="titulo_sub_sub_formulario">Telefone</h3>
                                        <div class="conter_campos_formulario" data-id="telefone">
                                            <button type="button" class="botao botao_add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            <div class="container_telefone">
                                                
                                            </div>
                                        </div>

                                        <!-- Enderecos -->
                                        <h3 class="titulo_sub_sub_formulario">Endereço</h3>
                                        <div class="conter_campos_formulario" data-id="endereco">
                                            <button type="button" class="botao botao_add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            <div class="container_endereco">
                                                
                                            </div>
                                        </div>

                                        <div class="linha">
                                            <button type="button" class="botao botao_azul" name="cadastrar" onclick="verificarCadastroPlano();">Cadastrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>

                    <div class="envelope_formulario">
                        <h3 class="titulo_sub_sub_formulario">Todos os clientes</h3>
                        
                        <!-- Linha de pesquisa -->
                        <div class="linha_vertical pesquisar_cliente" id="pesquisar_cliente">
                            <button type="button" class="botao botao_busca" id="botao_busca" name="botao_busca"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <input type="text" class="campo_sistema" name="buscar_cliente" id="buscar_cliente" placeholder="Pesquisar cliente..." />
                        </div>

                        <div class="tabela_cliente">
                            <div class="linha_vertical" id="tabela_cliente">
                                <div class="lista_img"></div>
                                <div class="lista_nome"><span>Nome</span></div>
                                <div class="lista_aniversario"><span>Aniversário</span></div>
                                <div class="lista_valor"><span>Valor</span></div>
                                <div class="lista_vencimento"><span>Próx. Vencimento</span></div>
                                <div class="lista_telefone"><span>Telefone</span></div>
                                <div class="lista_situacao"><span>Situação</span></div>
                            </div>
                            <!-- linha ativo -->
                            <div class="linha_tabela">
                                <a href="#">
                                    <div class="linha_vertical">
                                        <div class="lista_img">
                                            <div class="container_img_tabela">
                                                <img src="imagens/0001.png" alt="lista_img_tabela" class="centralizar_img" />
                                            </div>
                                        </div>

                                        <div class="lista_nome">
                                            <span>João Pedro Alves de Sousa</span>
                                        </div>

                                        <div class="lista_aniversario">
                                            <span>02/02/1998</span>
                                        </div>

                                        <div class="lista_valor">
                                            <span>R$ 00,00</span>
                                        </div>

                                        <div class="lista_vencimento">
                                            <span>00/00/0000</span>
                                        </div>

                                        <div class="lista_telefone">
                                            <span>(00) 0000-0000</span>
                                        </div>

                                        <div class="lista_situacao">
                                            <div class="situacao_bolinha">
                                                <div class="container_situacao ativo"></div>
                                                <span>Ativo</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- linha destivado -->
                            <div class="linha_tabela">
                                <a href="#">
                                    <div class="linha_vertical">
                                        <div class="lista_img">
                                            <div class="container_img_tabela">
                                                <img src="imagens/0002.png" alt="lista_img_tabela" class="centralizar_img" />
                                            </div>
                                        </div>

                                        <div class="lista_nome">
                                            <span>Cristina de Matos Nazário</span>
                                        </div>

                                        <div class="lista_aniversario">
                                            <span>20/03/1998</span>
                                        </div>

                                        <div class="lista_valor">
                                            <span>R$ 00,00</span>
                                        </div>

                                        <div class="lista_vencimento">
                                            <span>00/00/0000</span>
                                        </div>

                                        <div class="lista_telefone">
                                            <span>(00) 0000-0000</span>
                                        </div>

                                        <div class="lista_situacao">
                                            <div class="situacao_bolinha">
                                                <div class="container_situacao desativo"></div>
                                                <span>Desativado</span>
                                            </div>
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