<?php
	
include_once 'conexao.php';
session_start();


	if (isset($_GET['f'])) 
	{
		$function = $_GET['f'];

		if (function_exists($function)) 
		{
			call_user_func($function);
			exit();
		}
	}

    function login()
    {
    	$conexao = model_conexao();
    	extract($_POST);

    	if($usuario != '' AND $senha != '')
    	{
    		$sql = "SELECT * FROM usuario WHERE usuario = '".$usuario."' AND senha = '".$senha."'";
    		$resultado = $conexao->query($sql);

    		if ($resultado->num_rows)
    		{
    			$resul = $resultado->fetch_array();
    			$_SESSION['idUsuario'] = $resul['id'];
				$_SESSION['usuario'] = $resul['usuario'];
                $_SESSION['nome'] = $resul['nome'];

				$conexao = model_conexao();
				$sql = "SELECT * FROM usuario WHERE id = '".$_SESSION['idUsuario']."'";

				$resultado = $conexao->query($sql);
				$resul = $resultado->fetch_array();

				header("Location: telaPrincipal.php");
    		}

			else
            {
                ?>
                <script>alert('Usuário inválido!'); window.location.href = "index.php?login=n";</script>
                <?php
            }
    	}

        else
        {
            ?>
            <script>alert('Preencha todos os campos!'); window.location.href = "index.php?login=n";</script>
            <?php
        }
    }

    function deslogar()
    {
		session_destroy();
		header("Location: index.php");
	}

	function cadastrar()
	{
		$conexao = model_conexao();
		extract($_POST);

        if($usuario != '' && $senha != '' && $nome != '' && $nascimento != '' && $rg != '' && $cpf != '' && $endereco != '' && $estado != '' && $cidade != '')
        {
    		$sql_cadastrado = "INSERT INTO usuario (usuario, senha, nome, nascimento, rg, cpf, endereco, estado, cidade) VALUES ('".$usuario."', '".$senha."', '".$nome."', '".$nascimento."', '".$rg."', '".$cpf."', '".$endereco."', '".$estado."', '".$cidade."')";
    		$resultado_cadastrado = $conexao->query($sql_cadastrado);

    		?>
            <script>alert('Cadastro realizado com sucesso!'); window.location.href = "index.php?login=n";</script>
            <?php
        }

        else
        {
            ?>
             <script>alert('Preencha todos os campos!'); window.location.href = "cadastro.php";</script>
            <?php
        }
	}

    function listarCarros()
    {
        $cliente = $_SESSION["idUsuario"];

        $conexao = model_conexao();
        $sql = "SELECT * FROM veiculo ORDER BY nome DESC";
        $resultado = $conexao->query($sql);
        
        while($obj = mysqli_fetch_assoc($resultado))
        {
                echo '<div class="'.utf8_encode($obj['classificacao']).'"><div class="card"><div class="conterImg"><img src="'.utf8_encode($obj['img']).'" alt="'.utf8_encode($obj['nome']).'"></div><div class="linha"><h6>'.utf8_encode($obj['nome']).' '.utf8_encode($obj['descricao']).'</h6></div><div class="linha" id="azul"><h4>De: R$ '.utf8_encode($obj['preco']).',00</h4></div><div class="linha" id="vermelho"><h4>Por: R$  '.number_format((85/100) * utf8_encode($obj['preco']), 3, '.', '.').',00</h4></div><div class="linha" id="centralizarBotao"><a href="controle.php?f=realizarCompra&id='.utf8_encode($obj['id']).'&comprador='.utf8_encode($cliente).'"><button type="submit" class="botao" id="'.utf8_encode($obj['id']).'" name="'.utf8_encode($obj['id']).'">Comprar</button></a></div><br></div></div>';
        }
    }

    function realizarCompra()
    {
        $conexao = model_conexao();
        $id_veiculo = $_GET['id'];
        $id_comprador = $_GET['comprador'];

        $conexao = model_conexao();
        $sql_comprar = "INSERT INTO locacao (id_comprador, id_veiculo) VALUES ('".$id_comprador."', '".$id_veiculo."')";
        $resultado_comprar = $conexao->query($sql_comprar);

        ?>
        <script>alert('Compra realizada com sucesso!'); window.location.href = "telaPrincipal.php";</script>
        <?php 
    }
?>