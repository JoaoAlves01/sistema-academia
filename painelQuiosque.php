<?php

    include("php/controle_sistema.php");

    $listarAnuncio = listarAnuncio();
    $listarEventoPar = listarEvento();
    $listarEventoImpar = listarEvento();

    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = date ("Y-m-d");
    $horaAtual = date("H:i:s");
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="lib/owl.carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo_mobile.css" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="lib/js/jquery.js"></script>
    <script src="lib/js/controle_interface.js"></script>
    <script src = "lib/owl.carousel/owl-carousel/owl.carousel.min.js"></script>
</head>
<body>
    <section id="container_painel">
        <div class="cabecalho_painel">
            <div class="logo_painel">
                <div class="logo_painel_img">
                    <img src="imagens/logo.png" alt="logo_painel" class="centralizar_img" />
                </div>
            </div>

            <div class="dados_painel">
                <div class="linha">
                    <span class="titulo_painel"><i class="fa fa-cloud" aria-hidden="true"></i></i>30°</span>
                    <span class="titulo_painel" id="data_dash"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo dataBr($dataAtual); ?></span>
                    <span class="titulo_painel"><i class="fa fa-clock-o" aria-hidden="true"></i></i><?php echo $horaAtual; ?></span>
                </div>
            </div>
        </div>

        <div class="container_painel">
            <?php

            // Listando anuncios
            if($listarAnuncio->num_rows)
            {   ?>
                <div class="sidebar_esquerda" id="sidebar_esquerda">
                <?php
                while($obj = $listarAnuncio->fetch_array(MYSQLI_NUM))
                {   ?>
                    <div class="item">
                        <img src="img_anuncio/<?php echo $obj[2]; ?>" alt="<?php echo $obj[2]; ?>" class="centralizar_img" />
                    </div>
                    <?php
                }
                ?>
                </div>
                <?php
            }

            else
            {   ?>
                <span class="titulo_nao_existe">Você não possui nenhum anuncio!<i class="fa fa-frown-o" aria-hidden="true"></i></span>
                <?php
            }


            // Listando eventos
            if($listarEventoPar->num_rows)
            {   ?>
                <div class="sidebar_direita" id="sidebar_direita">
                    <div class="capsula_evento_sidebar">
                    <?php
                    while($obj_par = $listarEventoPar->fetch_array(MYSQLI_NUM))
                    {   
                        if($obj_par[0] % 2 == 0)
                        {   ?>
                            <div class="cartao_evento">
                                <div class="linha_vertical">
                                    <span class="titulo_container_evento"><?php echo $obj_par[1]; ?></span>
                                </div>

                                <div class="container_img_evento">
                                    <img src="img_evento/<?php echo $obj_par[6]; ?>" alt="painel_img" class="centralizar_img" />
                                </div>
                                    
                                <div class="container_txt_evento">
                                    <label class="txt_container_evento"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $obj_par[2]; ?></label>
                                    <label class="txt_container_evento"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $obj_par[4]; ?></label>
                                </div>
                            </div>
                            <?php
                        } 
                    }
                    ?>
                    </div>

                    <div class="capsula_evento_sidebar">
                    <?php
                    while($obj_impar = $listarEventoImpar->fetch_array(MYSQLI_NUM))
                    {   
                        if($obj_impar[0] % 2 != 0)
                        {   ?>
                            <div class="cartao_evento">
                                <div class="linha_vertical">
                                    <span class="titulo_container_evento"><?php echo $obj_impar[1]; ?></span>
                                </div>

                                <div class="container_img_evento">
                                    <img src="img_evento/<?php echo $obj_impar[6]; ?>" alt="painel_img" class="centralizar_img" />
                                </div>
                                    
                                <div class="container_txt_evento">
                                    <label class="txt_container_evento"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $obj_impar[2]; ?></label>
                                    <label class="txt_container_evento"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $obj_impar[4]; ?></label>
                                </div>
                            </div>
                            <?php
                        } 
                    }
                    ?>
                    </div>
                </div>
                <?php
            }

            else
            {   ?>
                <div class="sidebar_direita" id="sidebar_direita">
                    <div class="capsula_evento_sidebar">
                        <div class="cartao_evento">
                            <div class="linha_vertical">
                                <span class="titulo_container_evento">Sistema Gym</span>
                            </div>

                            <div class="container_img_evento">
                                <img src="imagens/logo.png" alt="img_logo_anuncio" class="centralizar_img" />
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>

    <script>
        // Carrossel Imagens
        $(".sidebar_esquerda").owlCarousel(
		{
			autoPlay: 3000,
            items: 1
        });
        
        //Carrossel Eventos
        $(".capsula_evento_sidebar").owlCarousel(
		{
			autoPlay: 6000,
            items: 1
        });
    </script>
</body>
</html>