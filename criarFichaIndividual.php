<?php
    include('php/menu_sistema.php');

    if(isset($_GET['id']))
    {   
        $url_id = $_GET['id'];

        $_SESSION['id_perfil'] = $url_id;
        $_SESSION['dados_usuario_perfil'] = buscarPerfil($_SESSION['id_perfil']);
    }

    $grupo_muscular = listarGrupoMuscularUsado();
    $listarDiasSemana = listarDiasSemana();
    $listarUsuario = listarUsuario('Professor');
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

                                        <span class="titulo_sub_sub_formulario">Início<small>00/00/0000</small></span>

                                        <span class="titulo_sub_sub_formulario">E-mail<small><?php echo $_SESSION['dados_usuario_perfil'][5]; ?></small></span>

                                        <span class="titulo_sub_sub_formulario">Situação<small><?php echo $_SESSION['dados_usuario_perfil'][13]; ?></small></span>

                                        <span class="titulo_sub_sub_formulario">Fichas<small>01</small></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>

                    <form method="POST" action="php/controle_sistema.php?f=criarFicha">
                        <div class="container_envelope_treino">
                            <div class="envelope_formulario">
                                <h2 class="titulo_sub_formulario">Treino A</h2>

                                <div class="conter_campos_formulario">
                                    <div class="campos_tres">
                                        <div class="divisao_campo">
                                            <label class="label_sistema">Treino predefinido</label>
                                            <select class="campo_sistema" name="treino_predefinido">
                                                        
                                            </select>
                                        </div>

                                        <div class="divisao_campo">
                                            <label class="label_sistema">Dia da semana</label>
                                            <select class="campo_sistema" name="dia_semana">
                                                <?php 
                                                    while($obj = $listarDiasSemana->fetch_array(MYSQL_NUM))
                                                    {   ?>
                                                        <option value="<?php echo $obj[0]; ?>"><?php echo $obj[1]; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="divisao_campo">
                                            <label class="label_sistema">Descrição</label>
                                            <input type="text" class="campo_sistema" name="descricao" id="descricao" maxlength="40">
                                        </div>
                                    </div>


                                    <div class="container_exercicio">
                                            
                                        <div class="sub_container_exercicio mostrar_modal">
                                                <div class="campos_tres">
                                                    <div class="divisao_campo">
                                                        <label class="label_sistema" for="grupo_muscular">Grupo muscular</label>
                                                        <div class="linha">
                                                            <select class="campo_sistema select_grupo_muscular" name="grupo_muscular" id="grupo_muscular">
                                                                <?php
                                                                if($grupo_muscular->num_rows)
                                                                {   ?>
                                                                    <option value="">Selecione</option>
                                                                    <?php
                                                                    while($obj = $grupo_muscular->fetch_array(MYSQL_NUM))
                                                                    {   ?>
                                                                        <option value="<?php echo $obj[0]; ?>"><?php echo $obj[1]; ?></option> 
                                                                        <?php   
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="divisao_campo">
                                                        <label class="label_sistema" for="exercicio">Exercício</label>
                                                        <div class="linha">
                                                            <select class="campo_sistema select_exercicio" name="exercicio" id="exercicio"> </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container_checkbox">
                                                    <label class="label_sistema"><input type="checkbox" name="conjucado" value="conjucado_a" class="campo_checkbox">Bi-set</label>
                                                </div>
                                        </div>
                                        <!-- Bi-set -->
                                        <div class="sub_container_exercicio">
                                                <div class="campos_tres">
                                                    <div class="divisao_campo">
                                                        <label class="label_sistema" for="grupo_muscular">Grupo muscular</label>
                                                        <div class="linha">
                                                            <select class="campo_sistema" name="grupo_muscular" id="grupo_muscular">
                                                                <option value=""></option>    
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="divisao_campo">
                                                        <label class="label_sistema" for="exercicio">Exercício</label>
                                                        <div class="linha">
                                                            <select class="campo_sistema" name="exercicio" id="exercicio">
                                                                <option value=""></option>    
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container_checkbox">
                                                    <label class="label_sistema"><input type="checkbox" name="conjucado" value="conjucado_a" class="campo_checkbox">Tri-set</label>
                                                </div>
                                        </div>
                                        <!-- Tri-set -->
                                        <div class="sub_container_exercicio">
                                                <div class="campos_tres">
                                                    <div class="divisao_campo">
                                                        <label class="label_sistema" for="grupo_muscular">Grupo muscular</label>
                                                        <div class="linha">
                                                            <select class="campo_sistema" name="grupo_muscular" id="grupo_muscular">
                                                                <option value=""></option>    
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="divisao_campo">
                                                        <label class="label_sistema" for="exercicio">Exercício</label>
                                                        <div class="linha">
                                                            <select class="campo_sistema" name="exercicio" id="exercicio">
                                                                <option value=""></option>    
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="linha">
                                            <button type="button" class="botao botao_azul adicionar_exercicio" name="adicionar">Adicionar</button>
                                        </div>
                                    </div>
                                        
                                    <!-- Gerar exercicios -->
                                    <div class="container_exercicio_escolhido">
                                        <input type="hidden" name="quantidade_exercicio" id="quantidade_exercicio">
                                    </div>
                                </div>
                            </div>
                            <br>
                            
                            <div class="envelope_formulario">
                                <div class="">
                                    <label class="label_sistema">Instrutor</label>
                                    <select class="campo_sistema" name="instrutor" id="instrutor">
                                        <?php
                                        if($listarUsuario->num_rows)
                                        {   
                                            while($obj = $listarUsuario->fetch_array(MYSQL_NUM))
                                            {
                                                ?>
                                                <option value="<?php echo $obj[0]; ?>"><?php echo $obj[1] . " " . $obj[2]; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <div class="campos_tres">
                                        <div class="divisao_campo">
                                            <label class="label_sistema">Observações</label>
                                            <textarea rows="3" class="campo_sistema" name="observacao" id="observacao"></textarea>
                                        </div>

                                        <div class="divisao_campo">
                                            <label class="label_sistema">Patologia</label>
                                            <textarea rows="3" class="campo_sistema" name="patologia" id="patologia"></textarea>
                                        </div>
                                    </div>
                                                    
                                    <label class="label_sistema">Objetivos</label>
                                    <div class="container_checkbox" id="ficha_individual">
                                        <label class="label_sistema"><input type="checkbox" name="objetivo[]" value="Cond. Físico" class="campo_checkbox">Cond. Físico</label>
                                        <label class="label_sistema"><input type="checkbox" name="objetivo[]" value="Fortalec. Muscular" class="campo_checkbox">Fortalec. Muscular</label>
                                        <label class="label_sistema"><input type="checkbox" name="objetivo[]" value="Hipertrofia" class="campo_checkbox">Hipertrofia</label>
                                        <br>
                                        <label class="label_sistema"><input type="checkbox" name="objetivo[]" value="Enrijec. Muscular" class="campo_checkbox">Enrijec. Muscular</label>
                                        <label class="label_sistema"><input type="checkbox" name="objetivo[]" value="Red. Gordura" class="campo_checkbox">Red. Gordura</label>
                                        <label class="label_sistema"><input type="checkbox" name="objetivo[]" value="Saúde" class="campo_checkbox">Saúde</label>
                                        <br>
                                        <label class="label_sistema"><input type="checkbox" name="outro" value="outro" class="campo_checkbox">Outros</label>
                                        <br>
                                        <div class="container_escondido">
                                            <label class="label_sistema">Outros objetivos</label>
                                            <input type="text" class="campo_sistema" name="info_outro" id="info_outro">
                                        </div>
                                    </div>

                                    <label class="label_sistema">Situação</label>
                                    <div class="container_radio">
                                        <label class="label_sistema"><input type="radio" name="situacao" value="1" class="campo_radio">Ativado</label>
                                        <label class="label_sistema"><input type="radio" name="situacao" value="0" class="campo_radio">Desativado</label>
                                    </div>
                                </div>

                                <div class="linha">
                                    <button type="submit" class="botao botao_azul" name="salvar">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </body>
</html>
