<?php 
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_evento']))
    {
        $_SESSION['nome_evento'] = "";
        $_SESSION['endereco_evento'] = "";
        $_SESSION['dia_evento'] = "";
        $_SESSION['hora_evento'] = "";
        $_SESSION['valor_evento'] = "";
    }

    $listarEvento = listarEvento();
?>

                    <h1 class="titulo_formulario">Administrar Eventos</h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Agendar um novo evento</h2>

                        <form method="POST" action="php/controle_sistema.php?f=cadastrarEvento" id="formulario" enctype="multipart/form-data">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <img src="imagens/mini_img_anuncio.jpg" alt= "mini_img_plano" class="mini_foto_anuncio" id="mini_foto_anuncio" name="mini_foto_anuncio" />
                                    <input type="file" class="update_arquivo" id="anexar_arquivo"  name="anexar_arquivo" onchange="visualizar_img(this,'mini_foto_anuncio');" />
                                </div>

                                <div class="direita_update">
                                    <div class="conter_campos_formulario">
                                        <label class="label_sistema" for="nome_evento">Nome</label>
                                        <div class="linha">
                                            <input type="text" class="campo_sistema" id="nome_evento" name="nome_evento" maxlength="20" value="<?php echo $_SESSION['nome_evento']; ?>" />
                                        </div>

                                        <label class="label_sistema" for="endereco_evento">Endereço</label>
                                        <div class="linha">
                                            <input type="text" class="campo_sistema" id="endereco_evento" name="endereco_evento" value="<?php echo $_SESSION['endereco_evento']; ?>" />
                                        </div>

                                        <div class="campos_tres">
                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="dia_evento">Data</label>
                                                <input type="text" class="campo_sistema campo_calendario" id="dia_evento" name="dia_evento" maxlength="10" value="<?php echo $_SESSION['dia_evento']; ?>" />
                                            </div>

                                            <div class="divisao_campo">
                                                <label class="label_sistema" for="hora_evento">Hora</label>
                                                <input type="text" class="campo_sistema" id="hora_evento" name="hora_evento" maxlength="5" value="<?php echo $_SESSION['hora_evento']; ?>" onkeyup="mascaraHora(this.value, this.id); return somenteNumero(event);" />
                                            </div>
                                        </div>

                                        <label class="label_sistema" for="valor_evento">Valor</label>
                                        <div class="linha">
                                            <input type="text" class="campo_sistema" id="valor_evento" name="valor_evento" value="<?php echo $_SESSION['valor_evento']; ?>" onkeyup="mascaraDinheiro(this.value, this.id);" onkeyup="return somenteNumero(event);" />
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
                        <h2 class="titulo_sub_formulario">Próximos Eventos</h2>

                        <?php
                        if($listarEvento->num_rows)
                        {   ?>
                            <div class="linha_vertical">
                                <?php 
                                while($obj = $listarEvento->fetch_array(MYSQLI_NUM))
                                {   ?>
                                    <div class="box_evento">
                                        <form method="POST" action="php/controle_sistema.php?f=configEvento">
                                            <div class="linha_vertical">
                                                <div class="box_img_evento">
                                                    <img class="centralizar_img" src="img_evento/<?php echo $obj[6]; ?>" />
                                                </div>
                                                <div class="box_texto_evento">
                                                    <span class="texto_depoimento texto_evento">Nome do evento: <small><?php echo $obj[1]; ?></small></span>
                                                    <span class="texto_depoimento texto_evento">Endereço: <small><?php echo $obj[2]; ?></small></span>
                                                    <span class="texto_depoimento texto_evento">Data: <small><?php echo dataBr($obj[3]); ?></small></span>
                                                    <span class="texto_depoimento texto_evento">Horário: <small><?php echo $obj[4]; ?></small></span>
                                                    <span class="texto_depoimento texto_evento">Valor: <small><?php echo $obj[5] == 0 ? "Free": "R$ ".$obj[5]; ?></small></span>
                                                </div>
                                                <div class="linha_vertical base_box_depoimento base_evento">
                                                    <button type="submit" class="botao editar_botao botao_amarelo" name="editar" value="<?php echo $obj[0]; ?>">Editar</button>
                                                    <button type="button" class="botao excluir_botao botao_vermelho" name="excluir" value="evento_<?php echo $obj[0]; ?>">Excluir</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php
                                } 
                                ?>
                            </div>
                            <?php
                        }

                        else
                        {   ?>
                            <span class="titulo_nao_existe">Você não possui nenhum evento!<i class="fa fa-frown-o" aria-hidden="true"></i></span>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>