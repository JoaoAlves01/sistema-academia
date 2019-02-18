<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <title>Fazer Login no SSN</title>
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="lib/css/estilo_mobile.css" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="lib/js/jquery.js"></script>
    <script src="lib/js/controle.js"></script>
</head>
<body>
    <div class="formulario_login">
        <div class="conter_formulario">
            <div class="linha">
                <h1 class="titulo_login">Login no Sistema GYM</h1>
            </div>
            <form method="POST" action="php/controle_sistema.php?f=login">
                <div class="conter_campos_formulario">
                    <label class="label_sistema" for="usuario">Usuário</label>
                    <input type="text" class="campo_sistema" id="usuario" name="usuario" placeholder="Informe seu usuário">

                    <label class="label_sistema" for="senha">Senha</label>
                    <input type="password" class="campo_sistema" id="senha" name="senha" placeholder="Informe sua senha">

                    <div class="linha">
                        <button type="submit" class="botao_login" id="login">Fazer Login</button>
                        <button type="button" class="botao_voltar" id="voltar_index">Voltar</button>
                    </div>
                    <hr>
                    <div class="linha">
                        <span class="opcao_usuario">Novo no sistema? Faça seu cadastro e tenha suas series em mãos</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>