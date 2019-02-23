<?php
    include('php/menu_sistema.php');

    $_SESSION['nome_img_update'];    
?>
                    <h1 class="titulo_formulario">Administrar Quiosque</h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Fazer upload de imagens</h2>

                        <form method="POST" action="php/controle_sistema.php?f=uploadImagem" enctype="multipart/form-data" id="form_upload">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <img src="imagens/mini_img_anuncio.jpg" alt= "mini_img_anuncio" class="mini_foto_anuncio" id="mini_foto_anuncio" name="mini_foto_anuncio" />
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
                        <div class="linha">
                            <input type="hidden" id="anuncio" />
                            <?php
                                listarAnuncio();
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
