$(document).ready(function()
{
    
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