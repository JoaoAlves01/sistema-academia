<?php 
    include('php/menu_sistema.php');

    if(empty($_SESSION['primeiro_nome_cadastro']))
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
    }

    $listar_nome_panos = listarNomePlanos();
    $listar_clientes = listarClientes();
?>

                    <h1 class="titulo_formulario">Administrar Clientes</h1>
                    
                    <div class="envelope_formulario">
                        <form method="POST" action="php/controle_sistema.php?f=cadastrarCliente" id="formulario" enctype="multipart/form-data">
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
                                                <input type="text" class="campo_sistema" id="primeiro_nome_cadastrado" name="primeiro_nome_cadastrado" maxlength="70" value="<?php echo $_SESSION['primeiro_nome_cadastro']; ?>" onkeypress="return somenteLetra(event);" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="sobrenome_cadastrado">Sobrenome</label>
                                                <input type="text" class="campo_sistema" id="sobrenome_cadastrado" name="sobrenome_cadastrado" maxlength="14" value="<?php echo $_SESSION['sobrenome_cadastrado']; ?>" onkeypress="return somenteLetra(event);" />
                                            </div>
                                        </div>
                                        <!-- Segunda linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="usuario_cadastrado">Nome de usuário</label>
                                                <input type="text" class="campo_sistema" id="usuario_cadastrado" name="usuario_cadastrado" maxlength="20" value="<?php echo $_SESSION['usuario_cadastrado']; ?>" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="senha_cadastrado">Senha</label>
                                                <div class="visualizar_senha" data-id="senha_cadastrado">
                                                    <input type="password" class="campo_sistema" id="senha_cadastrado" name="senha_cadastrado" maxlength="20" value="<?php echo $_SESSION['senha_cadastrado']; ?>" />
                                                    <i class="fa fa-rss visualizar_senha_icon" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Terceira linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="senha_repetir_cadastrado">Repetir senha</label>
                                                <div class="visualizar_senha" data-id="senha_repetir_cadastrado">
                                                    <input type="password" class="campo_sistema" id="senha_repetir_cadastrado" name="senha_repetir_cadastrado" maxlength="20" value="<?php echo $_SESSION['senha_repetir_cadastrado']; ?>" />
                                                    <i class="fa fa-rss visualizar_senha_icon" aria-hidden="true"></i>
                                                </div>
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="email_cadastrado">E-mail</label>
                                                <input type="text" class="campo_sistema" id="email_cadastrado" name="email_cadastrado" value="<?php echo $_SESSION['email_cadastrado']; ?>" />
                                            </div>
                                        </div>
                                        <!-- Quarta linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="cpf_cadastrado">CPF</label>
                                                <input type="text" class="campo_sistema" id="cpf_cadastrado" name="cpf_cadastrado" maxlength="14" onkeypress="mascaraCpf(this.value, this.id); return somenteNumero(event);" value="<?php echo $_SESSION['cpf_cadastrado']; ?>" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="rg_cadastrado">RG</label>
                                                <input type="text" class="campo_sistema" id="rg_cadastrado" name="rg_cadastrado" maxlength="12" onkeypress="return somenteNumero(event);" value="<?php echo $_SESSION['rg_cadastrado']; ?>" onkeydown="mascaraRg(this.value, this.id);" />
                                            </div>
                                        </div>
                                        <!-- Quinta linha -->
                                        <div class="campos_tres">
                                        <div class="divisao_campo">
                                                <label class="label_sistema" for="sexo_cadastrado">Sexo</label>
                                                <select class="campo_sistema" id="sexo_cadastrado" name="sexo_cadastrado">
                                                    <option value="Masculino" <?php echo $_SESSION['sexo_cadastrado'] == 'Masculino'?'selected':''; ?>>Masculino</option>
                                                    <option value="Feminino" <?php echo $_SESSION['sexo_cadastrado'] == 'Feminino'?'selected':''; ?>>Feminino</option>
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="nascimento_cadastrado">Data de nascimento</label>
                                                <input type="text" class="campo_sistema campo_calendario" id="nascimento_cadastrado" name="nascimento_cadastrado" maxlength="10" value="<?php echo $_SESSION['nascimento_cadastrado']; ?>" />
                                            </div>
                                        </div>
                                        <!-- Sexta linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="tipo_aula_cadastrado">Tipo de aula</label>
                                                <select class="campo_sistema" id="tipo_aula_cadastrado" name="tipo_aula_cadastrado">
                                                    <?php
                                                        foreach($listar_nome_panos as $listar_nome_pano){ ?>
                                                        
                                                            <option value="<?php echo $listar_nome_pano['id']; ?>" <?php echo $_SESSION['tipo_aula_cadastrado'] == $listar_nome_pano['id']?'selected':''; ?>><?php echo $listar_nome_pano['tipo_plano'] ?></option>
                                                        
                                                        <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="situacao_cadastrado">Situação</label>
                                                <select class="campo_sistema" id="situacao_cadastrado" name="situacao_cadastrado">
                                                    <option value="Ativo" <?php echo $_SESSION['situacao_cadastrado'] == 'Ativo'?'selected':''; ?>>Ativo</option>
                                                    <option value="Desativado" <?php echo $_SESSION['situacao_cadastrado'] == 'Desativado'?'selected':''; ?>>Desativado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Setima linha -->
                                        <div class="campos_tres">
                                            <div class="divisao_campo">

                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="permissao_cadastrado">Permissão</label>
                                                <select class="campo_sistema" id="permissao_cadastrado" name="permissao_cadastrado">
                                                    <option value="Administrador" <?php echo $_SESSION['permissao_cadastrado'] == 'Administrador'?'selected':''; ?>>Administrador</option>
                                                    <option value="Professor" <?php echo $_SESSION['permissao_cadastrado'] == 'Professor'?'selected':''; ?>>Professor</option>
                                                    <option value="Aluno" <?php echo $_SESSION['permissao_cadastrado'] == 'Aluno'?'selected':''; ?>>Aluno</option>
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
                                            <button type="submit" class="botao botao_azul" name="cadastrar">Cadastrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>

                    <div class="envelope_formulario">
                        <h3 class="titulo_sub_sub_formulario">Todos os clientes</h3>
                        <?php
                        if($listar_clientes->num_rows)
                        { ?>

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
                                    <div class="lista_aula"><span>Aula</span></div>
                                    <div class="lista_telefone"><span>Telefone</span></div>
                                    <div class="lista_situacao"><span>Situação</span></div>
                                </div>

                                <form method="POST" action="">
                                    <?php while($obj = $listar_clientes->fetch_array(MYSQLI_NUM)){ ?>

                                        <!-- linha ativo -->
                                        <div class="linha_tabela">
                                            <a href="<?php echo 'perfilFicha.php?id='.md5($obj[1]).">".md5($obj[3]); ?>">
                                                <div class="linha_vertical">
                                                    <div class="lista_img">
                                                        <div class="container_img_tabela">
                                                            <img src="img_perfil/<?php echo $obj[15]; ?>" alt="lista_img_tabela" class="centralizar_img" />
                                                        </div>
                                                    </div>

                                                    <div class="lista_nome">
                                                        <span><?php echo $obj[1]." ".$obj[2]; ?></span>
                                                    </div>

                                                    <div class="lista_aniversario">
                                                        <span><?php echo dataBr($obj[9]); ?></span>
                                                    </div>

                                                    <div class="lista_valor">
                                                        <span><?php echo $obj[23]; ?></span>
                                                    </div>

                                                    <div class="lista_aula">
                                                        <span><?php echo $obj[20]; ?></span>
                                                    </div>

                                                    <div class="lista_telefone">
                                                        <span><?php echo $obj[0]; ?></span>
                                                    </div>

                                                    <div class="lista_situacao">
                                                        <div class="situacao_bolinha">
                                                            <div class="container_situacao <?php echo $obj[13] == 'Ativo'?'ativo':'desativo'; ?>"></div>
                                                            <span>Ativo</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div> 
                                    <?php 
                                    } ?>
                                </form>
                            </div>
                            <?php
                        }
                        
                        else
                        { 
                        ?>
                            <span class="titulo_nao_existe">Você não possui nenhum cliente!<i class="fa fa-frown-o" aria-hidden="true"></i></span>
                        <?php

                        } ?>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>