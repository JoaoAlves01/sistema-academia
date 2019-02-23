<?php
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_aula']))
    {
        $_SESSION['nome_aula'] = "";
        $_SESSION['inicio_dia_semana'] = "---";
        $_SESSION['ligacao_dia_semana'] = "---";
        $_SESSION['termino_dia_semana'] = "---";
        $_SESSION['horario_inicio'] = "";
        $_SESSION['horario_ligacao'] = "---";
        $_SESSION['horario_termino'] = "";
        $_SESSION['preco'] = "";
    }

    $_SESSION['img_mini'] = "mini_img_anuncio.jpg";
?>
                    <h1 class="titulo_formulario">Administrar Planos</h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Cadastrar um novo plano</h2>

                        <form method="POST" action="php/controle_sistema.php?f=cadastrarPlano" enctype="multipart/form-data">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <div class="conter_campos_formulario">
                                        <img src="imagens/<?php echo $_SESSION['img_mini']; ?>" alt= "mini_img_plano" class="mini_foto_anuncio" id="mini_foto_anuncio" name="mini_foto_anuncio" />
                                        <input type="file" class="update_arquivo" id="anexar_arquivo"  name="anexar_arquivo" onchange="visualizar_img(this,'mini_foto_anuncio');" />
                                    </div>
                                </div>

                                <div class="direita_update">
                                    <div class="conter_campos_formulario">
                                        <label class="label_sistema" for="nome_aula">Tipo de Aula</label>
                                        <input type="text" class="campo_sistema" id="nome_aula" name="nome_aula" maxlength="25" value="<?php echo $_SESSION['nome_aula']; ?>" />
                                        
                                        <label class="label_sistema">Dia da Semana</label>
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="inicio_dia_semana">
                                                    <option value="---"><?php echo $_SESSION['inicio_dia_semana']; ?></option>
                                                    <option value="Dom.">Domingo</option>
                                                    <option value="Seg.">Segunda</option>
                                                    <option value="Ter.">Terça</option>
                                                    <option value="Qua.">Quarta</option>
                                                    <option value="Qui.">Quinta</option>
                                                    <option value="Sex.">Sexta</option>
                                                    <option value="Sab.">Sábado</option>  
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="ligacao_dia_semana">
                                                    <option value="---"><?php echo $_SESSION['ligacao_dia_semana']; ?></option>
                                                    <option value="a">a</option>
                                                    <option value="e">e</option>
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="termino_dia_semana">
                                                    <option value="---"><?php echo $_SESSION['termino_dia_semana']; ?></option>
                                                    <option value="Dom.">Domingo</option>
                                                    <option value="Seg.">Segunda</option>
                                                    <option value="Ter.">Terça</option>
                                                    <option value="Qua.">Quarta</option>
                                                    <option value="Qui.">Quinta</option>
                                                    <option value="Sex.">Sexta</option>
                                                    <option value="Sab.">Sábado</option>  
                                                </select>
                                            </div>
                                        </div>

                                        <label class="label_sistema">Horário</label>
                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <input type="text" class="campo_sistema" id="horario_inicio" name="horario_inicio" maxlength="5" value="<?php echo $_SESSION['horario_inicio']; ?>" />
                                            </div>

                                            <div class="divisao_campo">
                                                <select class="campo_sistema" name="horario_ligacao">
                                                    <option value="---"><?php echo $_SESSION['horario_ligacao']; ?></option>
                                                    <option value="as">as</option>
                                                    <option value="até">até</option>
                                                    <option value="e">e</option>
                                                </select>
                                            </div>

                                            <div class="divisao_campo">
                                                <input type="text" class="campo_sistema" id="horario_termino" name="horario_termino" maxlength="5" value="<?php echo $_SESSION['horario_termino']; ?>" />
                                            </div>
                                        </div>

                                        <label class="label_sistema" for="preco">Preço</label>
                                        <input type="text" class="campo_sistema" id="preco" name="preco" maxlength="10" value="<?php echo $_SESSION['preco']; ?>" />

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
                        <h2 class="titulo_sub_formulario">Planos em destaque</h2>
                        <div class="linha">
                            <input type="hidden" id="anuncio" />
                            <?php
                                listarPlanos();
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
