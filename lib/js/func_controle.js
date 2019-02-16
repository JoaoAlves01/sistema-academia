$(document).ready(function()
{
    
});

function verificarUplod()
{
    var nome = document.getElementById('nome_img_update').value;
    var img = document.getElementById('anexar_arquivo').value;

    if(nome != "" && img != "")
    {
        mostrarAlerta('sucesso', 'Upload realizado com sucesso');
        setTimeout(function()
        {
            document.getElementById("form_upload").submit();
        }, 1500);
    }

    else
        mostrarAlerta('erro', 'Preencha todos os campos!');
}

function visualizar_img(input, id) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $('#'+id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function mostrarAlerta(tipo, mensagem)
{
    $('.alerta_fundo').css('display', 'block');
    $('.mensagem').addClass(tipo);
    $('.texto_msg').text(mensagem);

    setTimeout(function()
    {
        $('.alerta_fundo').css('display', 'none');
    }, 1500);
}

function deletar(valorBotao)
{
    mostrarAlerta('sucesso', 'Item deletado com sucesso!');
    setTimeout(function()
    {
        var formularioEscolhido = "form" + valorBotao;
        document.getElementById(formularioEscolhido).submit();
    }, 1500);
}