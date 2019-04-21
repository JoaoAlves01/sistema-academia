<?php
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_aula']))
    {
        $_SESSION['nome_aula'] = "";
        $_SESSION['inicio_dia_semana'] = "";
        $_SESSION['ligacao_dia_semana'] = "";
        $_SESSION['termino_dia_semana'] = "";
        $_SESSION['horario_inicio'] = "";
        $_SESSION['horario_ligacao'] = "";
        $_SESSION['horario_termino'] = "";
        $_SESSION['preco'] = "";
    }

    $listar_planos = listarPlanos();
?>
                    <h1 class="titulo_formulario">Administrar Planos</h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Cadastrar um novo plano</h2>

                        <form method="POST" action="php/controle_sistema.php?f=cadastrarPlano" id="formulario" enctype="multipart/form-data">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <img src="imagens/mini_img_anuncio.jpg" alt= "mini_img_plano" class="mini_foto_anuncio" id="mini_foto_anuncio" name="mini_foto_anuncio" />
                                    <input type="file" class="update_arquivo" id="anexar_arquivo"  name="anexar_arquivo" onchange="visualizar_img(this,'mini_foto_anuncio');" />
                                </div>

                                <div class="direita_update">
                                    <div class="conter_campos_formulario">
                                        <label class="label_sistema" for="nome_aula">Tipo de Aula</label>
                                        <div class="linha">
                                            <input type="text" class="campo_sistema" id="nome_aula" name="nome_aula" maxlength="25" value="<?php echo $_SESSION['nome_aula']; ?>" />
                                        </div>
                                        
                                        <label class="label_sistema">Dia da Semana</label>
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="inicio_dia_semana">
                                                    <option value="Domingo" <?php echo $_SESSION['inicio_dia_semana'] == 'Domingo'?'selected':'';?>>Domingo</option>
                                                    <option value="Segunda" <?php echo $_SESSION['inicio_dia_semana'] == 'Segunda'?'selected':'';?>>Segunda</option>
                                                    <option value="Terça" <?php echo $_SESSION['inicio_dia_semana'] == 'Terça'?'selected':'';?>>Terça</option>
                                                    <option value="Quarta" <?php echo $_SESSION['inicio_dia_semana'] == 'Quarta'?'selected':'';?>>Quarta</option>
                                                    <option value="Quinta" <?php echo $_SESSION['inicio_dia_semana'] == 'Quinta'?'selected':'';?>>Quinta</option>
                                                    <option value="Sexta" <?php echo $_SESSION['inicio_dia_semana'] == 'Sexta'?'selected':'';?>>Sexta</option>
                                                    <option value="Sábado" <?php echo $_SESSION['inicio_dia_semana'] == 'Sábado'?'selected':'';?>>Sábado</option>  
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="ligacao_dia_semana">
                                                    <option value="a" <?php echo $_SESSION['ligacao_dia_semana'] == 'a'?'selected':'';?>>a</option>
                                                    <option value="e" <?php echo $_SESSION['ligacao_dia_semana'] == 'e'?'selected':'';?>>e</option>
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="termino_dia_semana">
                                                    <option value="Domingo" <?php echo $_SESSION['termino_dia_semana'] == 'Domingo'?'selected':'';?>>Domingo</option>
                                                    <option value="Segunda" <?php echo $_SESSION['termino_dia_semana'] == 'Segunda'?'selected':'';?>>Segunda</option>
                                                    <option value="Terça" <?php echo $_SESSION['termino_dia_semana'] == 'Terça'?'selected':'';?>>Terça</option>
                                                    <option value="Quarta" <?php echo $_SESSION['termino_dia_semana'] == 'Quarta'?'selected':'';?>>Quarta</option>
                                                    <option value="Quinta" <?php echo $_SESSION['termino_dia_semana'] == 'Quinta'?'selected':'';?>>Quinta</option>
                                                    <option value="Sexta" <?php echo $_SESSION['termino_dia_semana'] == 'Sexta'?'selected':'';?>>Sexta</option>
                                                    <option value="Sábado" <?php echo $_SESSION['termino_dia_semana'] == 'Sábado'?'selected':'';?>>Sábado</option>  
                                                </select>
                                            </div>
                                        </div>

                                        <label class="label_sistema">Horário</label>
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <input type="text" class="campo_sistema" id="horario_inicio" name="horario_inicio" maxlength="5" value="<?php echo $_SESSION['horario_inicio']; ?>" onkeyup="mascaraHora(this.value, this.id); return somenteNumero(event);" />
                                            </div>

                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="horario_ligacao">
                                                    <option value="as" <?php echo $_SESSION['horario_ligacao'] == 'as'?'selected':'';?>>as</option>
                                                    <option value="até" <?php echo $_SESSION['horario_ligacao'] == 'até'?'selected':'';?>>até</option>
                                                    <option value="e" <?php echo $_SESSION['horario_ligacao'] == 'e'?'selected':'';?>>e</option>
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <input type="text" class="campo_sistema" id="horario_termino" name="horario_termino" maxlength="5" value="<?php echo $_SESSION['horario_termino']; ?>" onkeyup="mascaraHora(this.value, this.id); return somenteNumero(event);" />
                                            </div>
                                        </div>

                                        <label class="label_sistema" for="preco">Preço</label>
                                        <div class="linha">
                                            <input type="text" class="campo_sistema" id="preco" name="preco" maxlength="10" value="<?php echo $_SESSION['preco']; ?>" onkeyup="mascaraDinheiro(this.value, this.id);" onkeyup="return somenteNumero(event);" />
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
                        <h2 class="titulo_sub_formulario">Planos em destaque</h2>

                        <?php 
                        if($listar_planos->num_rows)
                        {   ?>
                            <div class="linha_card">
                                <?php
                                while($obj = $listar_planos->fetch_array(MYSQLI_NUM)){ ?>
                                    <div class="box_contato">
                                        <form method="POST" action="php/controle_sistema.php?f=configPlano">
                                            <h1><?php echo $obj[2]; ?></h1>
                                            <div class="box_img_anuncio">
                                                <img class="centralizar_img" src="img_planos/<?php echo $obj[1]; ?>" />
                                            </div>
                                            <div class="linha base_box_anuncio">
                                                <button type="submit" class="botao editar_botao botao_amarelo" name="editar" value="<?php echo $obj[0]; ?>">Editar</button>
                                                <button type="button" class="botao excluir_botao botao_vermelho" name="excluir" value="planos_<?php echo $obj[0]; ?>">Excluir</button>
                                            </div>
                                        </form>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                        }

                        else{ ?>
                            <span class="titulo_nao_existe">Você não possui nenhum plano!<i class="fa fa-frown-o" aria-hidden="true"></i></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
