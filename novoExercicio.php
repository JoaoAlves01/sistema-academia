<?php
    include('php/menu_sistema.php');

    if(empty($_SESSION['descricao_curta']))
    {
        $_SESSION['tipo_exercicio'] = "musculacao";
        $_SESSION['nome'] = "";
        $_SESSION['descricao'] = "";
        $_SESSION['grupo_muscular'] = "";
        $_SESSION['numero_aparelho'] = "";
        $_SESSION['dica'] = "";
        $_SESSION['situacao'] = "1";
    }

    $grupoMuscular = grupoMuscular();

    echo $_SESSION['tipo_exercicio'];
?>
                    <h1 class="titulo_formulario">Administrar Exercícios</h1>
                    
                    <div class="envelope_formulario">
                        <form method="POST" action="php/controle_sistema.php?f=cadastrarExercicio">
                            <div class="conter_campos_formulario" id="novo_exercicio">
                                <label class="label_sistema" for="tipo">Tipo</label>
                                <div class="container_radio">
                                    <label class="label_sistema radio_tipo_exercicio"><input type="radio" <?php echo $_SESSION['tipo_exercicio'] == 'musculacao'?'checked="checked" ':''; ?> name="tipo_exercicio" value="musculacao" class="campo_radio">Musculação</label>

                                    <label class="label_sistema radio_tipo_exercicio"><input type="radio" name="tipo_exercicio" value="cardio" class="campo_radio" <?php echo $_SESSION['tipo_exercicio'] == 'cardio'?'checked="checked" ':''; ?>>Cardio</label>

                                    <label class="label_sistema"><input type="radio" name="tipo_exercicio" value="alongamento" class="campo_radio exercicio_alongamento" <?php echo $_SESSION['tipo_exercicio'] == 'alongamento'?'checked="checked" ':''; ?>>Alongamento</label>

                                    <label class="label_sistema radio_tipo_exercicio"><input type="radio" name="tipo_exercicio" value="funcional" class="campo_radio" <?php echo $_SESSION['tipo_exercicio'] == 'funcional'?'checked="checked" ':''; ?>>Funcional</label>
                                </div>
                                <br>
                                <label class="label_sistema" for="nome">Nome</label>
                                <div class="linha">
                                    <input type="text" class="campo_sistema" id="nome" name="nome" maxlength="40" value="<?php echo $_SESSION['nome'] ?>" />
                                </div>

                                <label class="label_sistema" for="descicao">Descrição(optional)</label>
                                <div class="linha">
                                    <input type="text" class="campo_sistema" id="descicao" name="descicao" maxlength="80" value="<?php echo $_SESSION['descicao'] ?>" />
                                </div>

                                <div class="campos_tres">
                                    <div class="divisao_campo">
                                        <label class="label_sistema" for="grupo">Grupo</label>
                                        <select class="campo_sistema" id="grupo" name="grupo">
                                            <?php
                                            if($grupoMuscular->num_rows)
                                            {   
                                                while($obj = $grupoMuscular->fetch_array(MYSQL_NUM))
                                                {
                                                    ?>
                                                    <option value="<?php echo $obj[0]; ?>" <?php echo $_SESSION['grupo_muscular'] == $obj[0]?'selected':'';?>><?php echo $obj[1]; ?></option>
                                                    <?php
                                                }
                                            }

                                            else
                                            {   ?>
                                                <option>erro no banco</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="divisao_campo" id="exercicio_alongamento">
                                        <label class="label_sistema" for="number_aparelho">Nº do aparelho</label>
                                        <input type="number" class="campo_sistema" id="number_aparelho" name="number_aparelho" maxlength="5" min=1 value="<?php echo $_SESSION['numero_aparelho'] ?>" />
                                    </div>
                                </div>

                                <label class="label_sistema" for="dica">Dica</label>
                                <div class="linha">
                                    <textarea rows="4" class="campo_sistema" id="dica" name="dica"><?php echo  $_SESSION['dica'] ?></textarea>
                                </div>
                                <br>

                                <div class="container_radio">
                                    <label class="label_sistema"><input type="radio" name="situacao" value="1" class="campo_radio" <?php echo $_SESSION['situacao'] == '1'?'checked="checked" ':''; ?>>Ativado</label>
                                    <label class="label_sistema"><input type="radio" name="situacao" value="0" class="campo_radio" <?php echo $_SESSION['situacao'] == '0'?'checked="checked" ':''; ?>>Desativado</label>
                                </div>

                                <div class="linha">
                                    <button type="submit" class="botao botao_azul" name="cadastrar">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </section>
        </div>
    </body>
</html>
