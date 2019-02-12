<!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" />
        <title>Sistema GYM</title>
        <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo_mobile.css" />
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="lib/js/jquery.js"></script>
        <script src="lib/js/controle.js"></script>
    </head>
    <body>
        <header>
            <div class="menu_sistema">
                <div class="img_usuario_sistema">
                    <img src="imagens/0001.png" alt="usuario_sistema" />
                </div>
                <div class="linha">
                    <span class="nome_usuario">Boa Tarde,<small>Joao Pedro Alves de Sousa</small></span>
                </div>

                <nav id="menu_sistema">
                    <ul>
                        <li><i class="fa fa-desktop" aria-hidden="true"><a href="#">Quiosque</a></i></li>
                        <li><i class="fa fa-clone" aria-hidden="true"><a href="#">Planos</a></i></li>
                        <li><i class="fa fa-quote-right" aria-hidden="true"><a href="#">Depoimentos</a></i></li>
                        <li><i class="fa fa-home" aria-hidden="true"><a href="#">Blog</a></i></li>
                    </ul>
                </nav>
            </div>
        </header>

        <section>
            <div class="barra_info">
                <div class="notificacao_usuario">
                    <i class="fa fa-envelope-o" aria-hidden="true"><span>6</span></i>
                </div>
            </div>

            <div class="envelope">
                <h1 class="titulo_formulario">Administrar Quiosque</h1>
                
                <div class="envelope_formulario">
                    <h2 class="titulo_sub_formulario">Fazer upload de imagens</h2>
                    <div class="linha">
                        <div class="esquerda_update">
                            <input type="file" class="update_arquivo" />
                        </div>

                        <div class="direita_update">
                            <div class="conter_campos_formulario">
                                <label class="label_sistema" for="nome_img_update">Nome</label>
                                <input type="text" class="campo_sistema" id="nome_img_update">

                                <label class="label_sistema" for="descricao_img_update">Descrição</label>
                                <textarea rows="4" type="text" class="campo_sistema" id="descricao_img_update"></textarea>

                                <div class="linha">
                                    <button type="submit" class="botao">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="envelope_formulario">
                    <h2 class="titulo_sub_formulario">Anúncios em destaque</h2>
                    <input type="file" class="update_arquivo" />
                </div>
            </div>
        </section>
    </body>
</html>
