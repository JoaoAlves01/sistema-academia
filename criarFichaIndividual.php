<?php
    include('php/menu_sistema.php');

    if(isset($_GET['id']))
    {   
        $url_id = $_GET['id'];

        $_SESSION['id_perfil'] = $url_id;
        $_SESSION['dados_usuario_perfil'] = buscarPerfil($_SESSION['id_perfil']);
    }

    $grupo_muscular = listarGrupoMuscularUsado();
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

                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Treino A</h2>

                        <form method="POST" action="php/controle.php?f=criarFicha">
                            <div class="conter_campos_formulario">
                                <div class="campos_tres">
                                    <div class="divisao_campo">
                                        <label class="label_sistema">Treino predefinido</label>
                                        <select class="campo_sistema" name="inicio_dia_semana">
                                                
                                        </select>
                                    </div>

                                    <div class="divisao_campo">
                                        <label class="label_sistema">Dia da semana</label>
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

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
