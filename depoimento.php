<?php 
    include('php/menu_sistema.php');

    if(empty($_SESSION['nome_depoimento']))
    {
        $_SESSION['nome_depoimento'] = "";
        $_SESSION['depoimento'] = "";
    }
?>

                    <h1 class="titulo_formulario">Administrar Depoimentos</h1>
                    
                    <div class="envelope_formulario">
                        <h2 class="titulo_sub_formulario">Cadastrar um novo depoimento</h2>

                        <form method="POST" action="php/controle_sistema.php?f=cadastrarDepoimento" id="formulario" enctype="multipart/form-data">
                            <div class="linha">
                                <div class="esquerda_update">
                                    <img src="imagens/mini_img_anuncio.jpg" alt= "mini_img_plano" class="mini_foto_anuncio" id="mini_foto_anuncio" name="mini_foto_anuncio" />
                                    <input type="file" class="update_arquivo" id="anexar_arquivo"  name="anexar_arquivo" onchange="visualizar_img(this,'mini_foto_anuncio');" />
                                </div>

                                <div class="direita_update">
                                    <div class="conter_campos_formulario">
                                        <label class="label_sistema" for="nome_aula">Nome</label>
                                        <div class="linha">
                                            <input type="text" class="campo_sistema" id="nome_depoimento" name="nome_depoimento" maxlength="70" value="<?php echo $_SESSION['nome_depoimento']; ?>" />
                                        </div>

                                        <label class="label_sistema" for="nome_aula">Depoimento</label>
                                        <div class="linha">
                                            <textarea rows="6" class="campo_sistema" id="depoimento" name="depoimento" maxlength="430" value="<?php echo $_SESSION['depoimento']; ?>"></textarea>
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
                        <h2 class="titulo_sub_formulario">Depoimentos em destaque</h2>
                        <div class="linha_card">
                            <?php
                                listarDepoimento();
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>