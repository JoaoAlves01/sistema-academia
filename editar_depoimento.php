<?php 
    include('php/menu_sistema.php');
?>

                    <h1 class="titulo_formulario">Depoimento - <?php echo $_SESSION['editar_nome_depoimento']; ?></h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Alterar Depoimento</h2>

                        <form method="POST" action="php/controle_sistema.php?f=configDepoimento" id="formulario" enctype="multipart/form-data">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <img src="img_depoimento/<?php echo $_SESSION['editar_img_mini_depoimento']; ?>" alt= "<?php echo $_SESSION['editar_img_mini_depoimento']; ?>" class="mini_foto_anuncio" id="mini_foto_anuncio" name="mini_foto_anuncio" />
                                    <input type="file" class="update_arquivo" id="anexar_arquivo"  name="anexar_arquivo" onchange="visualizar_img(this,'mini_foto_anuncio');" />
                                </div>

                                <div class="direita_update">
                                    <div class="conter_campos_formulario">
                                        <label class="label_sistema" for="nome_aula">Nome</label>
                                        <div class="linha">
                                            <input type="text" class="campo_sistema" id="nome_depoimento" name="nome_depoimento" maxlength="70" value="<?php echo $_SESSION['editar_nome_depoimento']; ?>" />
                                        </div>

                                        <label class="label_sistema" for="nome_aula">Depoimento</label>
                                        <div class="linha">
                                            <textarea rows="6" class="campo_sistema" id="depoimento" name="depoimento" maxlength="430"><?php echo $_SESSION['editar_depoimento']; ?></textarea>
                                        </div>
                                        
                                        <div class="linha">
                                            <button type="submit" class="botao botao_azul" name="salvar" value="<?php echo $_SESSION['editar_id_depoimento'] ?>">Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>