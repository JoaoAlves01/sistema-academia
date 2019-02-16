<?php
    function conexao()
    {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "sistema_gym";

        $conection = new mysqli($servidor, $usuario, $senha, $banco);
        $conection->set_charset("utf8");
        return $conection;
    }
?>