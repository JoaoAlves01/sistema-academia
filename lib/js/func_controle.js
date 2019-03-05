$(document).ready(function()
{   
    //Abrir modal
    $(".excluir_botao").on("click", function(){
        
        var id = this.value;

        $('.fundo').toggleClass('mostrar_modal');
        $('.modal_exclur').toggleClass('mostrar_modal');
        $('#confirma_delete').val(id);
    });

    //Fechar modal
    $('.fechar_modal, #cancelar_cancelar').on('click', function()
    {
        $('.fundo').removeClass('mostrar_modal');
        $('.modal_exclur').removeClass('mostrar_modal');
    });
});

$('.alerta_fundo').ready(function()
{
    setTimeout(function()
    {
        $('.alerta_fundo').remove();
    }, 1500);
});

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

function verificarCadastroPlano()
{
    var horario_inicio = document.getElementById('horario_inicio');
    var horario_termino = document.getElementById('horario_termino');

    //Horario de inicio
    var hora_inicio = (horario_inicio.value.substring(0,2));
    var minuto_inicio = (horario_inicio.value.substring(3,5));

    //Horario de termino
    var hora_termino = (horario_termino.value.substring(0,2));
    var minuto_termino = (horario_termino.value.substring(3,5));

    if (((hora_inicio < 00 ) || (hora_inicio > 23) || ( minuto_inicio < 00) ||( minuto_inicio > 59)) || ((hora_termino < 00 ) || (hora_termino > 23) || ( minuto_termino < 00) ||( minuto_termino > 59)))
        alertaVerificacao("atencao", "Hora inválida!");

    else
        document.getElementById("formulario").submit();
}

/*Gerar div com alerta de verificações*/
function alertaVerificacao(tipo, mensagem)
{
    $(".alerta_verificacao").css("display", "block");
    $(".alerta_verificacao").append(
        "<div class='alerta_fundo'>" +
        "<div class='mensagem " + tipo + "'>"+
        "<span class='texto_msg'>"+ mensagem +"</span>"+
        "</div></div>");

        setTimeout(function()
        {
            $(".alerta_verificacao").css("display", "none");
            $('.alerta_fundo').remove();
        }, 1500);
}