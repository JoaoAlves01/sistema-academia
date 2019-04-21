<?php
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_img_update']))
        $_SESSION['nome_img_update'] = "";   
        
    $listar_anuncios = listarAnuncio();
?>
                    <h1 class="titulo_formulario">Administrar Quiosque <a href="painelQuiosque.php" class="botao_dash" target="_blank"><i class="fa fa-tachometer" aria-hidden="true"></i>Visualizar</a></h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Fazer upload de imagens</h2>

                        <form method="POST" action="php/controle_sistema.php?f=uploadImagem" enctype="multipart/form-data" id="form_upload">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <img src="imagens/mini_img_anuncio.jpg" alt= "mini_img_anuncio" class="mini_foto_anuncio centralizar_img" id="mini_foto_anuncio" name="mini_foto_anuncio" />
                                    <input type="file" class="update_arquivo" id="anexar_arquivo"  name="anexar_arquivo" onchange="visualizar_img(this,'mini_foto_anuncio');" />
                                </div>

                                <div class="direita_update">
                                    <div class="conter_campos_formulario">
                                        <label class="label_sistema" for="nome_img_update">Nome</label>
                                        <input type="text" class="campo_sistema" id="nome_img_update" name="nome_img_update" maxlength="35" value="<?php echo $_SESSION['nome_img_update']; ?>" />

                                        <div class="linha">
                                            <button type="submit" class="botao botao_azul" name="upload_img">Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Anúncios em destaque</h2>
                        <?php
                        if($listar_anuncios->num_rows)
                        { ?>
                            <div class="linha_card">
                            <?php
                            while($obj = $listar_anuncios->fetch_array(MYSQLI_NUM)){ ?>

                                <div class="box_contato">
                                    <h1><?php echo $obj[1]; ?></h1>
                                    <div class="box_img_anuncio">
                                        <img class="centralizar_img" src="img_anuncio/<?php echo $obj[2]; ?>" />
                                    </div>
                                    <div class="linha base_box_anuncio">
                                        <button type="button" class="botao excluir_botao botao_vermelho" value="anuncio_<?php echo $obj[0]; ?>">Excluir</button>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                            </div>
                        <?php
                        }

                        else{ ?>

                            <span class="titulo_nao_existe">Você não possui nenhum anuncio!<i class="fa fa-frown-o" aria-hidden="true"></i></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
