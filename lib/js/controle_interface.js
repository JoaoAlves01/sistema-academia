$(document).ready(function()
{
    $(".scroll").click(function(event)
    {
        event.preventDefault();
		$('html, body').animate({scrollTop:$(this.hash).offset().top}, 1500);
    });

    //Botao voltar da pagina de login redirecionar para home
    $("#voltar_index").click(function()
    {
        window.location.href = "index.php";
    });

    //Menu home
    $('.botao_menu_mobile').click(function()
    {
        $('.hamburguer_topo').toggleClass('rotacionar_topo');
        $('.hamburguer_meio').toggleClass('rotacionar_meio');
        $('.hamburguer_base').toggleClass('rotacionar_base');
        $('.menu_mobile').toggleClass('mostrar_menu_mobile');
    });

    //Menu sistema
    $('.botao_hamburger').click(function()
    {
        $('.hamburguer_topo').toggleClass('rotacionar_topo');
        $('.hamburguer_meio').toggleClass('rotacionar_meio');
        $('.hamburguer_base').toggleClass('rotacionar_base');
        $('.menu_sistema').toggleClass('mostrar_menu_sistema');
        // $('.menu_sistema').css('width', '200');
    });
});

var slideIndex = 0;
mostrarDepoimento();

function mostrarDepoimento()
{
    var i;
    var slide = document.getElementsByClassName('depoimento_cliente');

    for(i = 0; i < slide.length; i++)
    {
        slide[i].style.display = "none";  
    }

    slideIndex++;

    if (slideIndex > slide.length) 
    slideIndex = 1

    slide[slideIndex-1].style.display = "block";  
    setTimeout(mostrarDepoimento, 4000);
}