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
    });

    //Mostra campo de busca
    $('.botao_busca').click(function()
    {
        if($('#buscar_cliente').val() == "")
            $('#buscar_cliente').toggleClass('animar_campo_busca');

        else
        {
            $('#buscar_cliente').toggleClass('animar_campo_busca');
        }
    });

    //Gerar campos para telefone
    var contator_tel = 1;
    var contator_end = 1;
    $('.botao_add').click(function(){

        var container_gerar = $(this).closest('[data-id]');
        
        if(container_gerar.data('id') == "telefone")
        {
            $(".container_telefone").append(
                "<div class='container' id='container_tel_"+contator_tel+"'>"+
                    "<div class='linha_vertical'>"+
                        "<span class='titulo_add'>Telefone "+contator_tel+"</span>"+
                        "<button type='button' class='botao botao_rmv' value='"+contator_tel+"'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"+
                    "</div>"+

                    "<div class='campos_tres'>"+
                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='numero_cadastrado"+contator_tel+"'>Número</label>"+
                            "<input type='text' class='campo_sistema' id='numero_cadastrado"+contator_tel+"' name='numero_cadastrado["+contator_tel+"]' maxlength='14' />"+
                        "</div>"+

                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='tipo_cadastrado"+contator_tel+"'>Tipo</label>"+
                            "<select class='campo_sistema' id='tipo_cadastrado"+contator_tel+"' name='tipo_cadastrado["+contator_tel+"]'>"+
                                "<option value='Celular'>Celular</option>"+
                                "<option value='Residencial'>Residencial</option>"+
                                "<option value='Trabalho'>Trabalho</option>"+
                            "</select>"+
                        "</div>"+
                    "</div>"+
                "</div>");

                contator_tel++;
        }

        else
        {
            $(".container_endereco").append(
                "<div class='container' id='container_endereco_"+contator_end+"'>"+
                    "<div class='linha_vertical'>"+
                        "<span class='titulo_add'>Endereço "+contator_end+"</span>"+
                        "<button type='button' class='botao botao_rmv' value='"+contator_end+"'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"+
                    "</div>"+

                    "<label class='label_sistema' for='cep_cadastrado"+contator_end+"'>CEP</label>"+
                    "<div class='linha'>"+
                        "<input type='text' class='campo_sistema' id='cep_cadastrado"+contator_end+"' name='cep_cadastrado["+contator_end+"]' maxlength='9' />"+
                        "<button type='button' class='botao botao_azul busca_cep' name='"+contator_end+"' id='busca_cep"+contator_end+"'>Buscar Endereço</button>"+
                    "</div>"+

                    "<label class='label_sistema' for='endereco_cadastrado"+contator_end+"'>Endereço</label>"+
                    "<div class='linha'>"+
                        "<input type='text' class='campo_sistema' id='endereco_cadastrado"+contator_end+"' name='endereco_cadastrado["+contator_end+"]' />"+
                    "</div>"+

                    "<div class='campos_tres'>"+
                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='complemento_cadastrado"+contator_end+"'>Complemento</label>"+
                            "<input type='text' class='campo_sistema' id='complemento_cadastrado"+contator_end+"' name='complemento_cadastrado["+contator_end+"]' />"+
                        "</div>"+

                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='bairro_cadastrado"+contator_end+"'>Bairro</label>"+
                            "<input type='text' class='campo_sistema' id='bairro_cadastrado"+contator_end+"' name='bairro_cadastrado["+contator_end+"]' />"+
                        "</div>"+
                    "</div>"+

                    "<div class='campos_tres'>"+
                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='cidade_cadastrado"+contator_end+"'>Cidade</label>"+
                            "<input type='text' class='campo_sistema' id='cidade_cadastrado"+contator_end+"' name='cidade_cadastrado["+contator_end+"]' />"+
                        "</div>"+

                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='estado_cadastrado"+contator_end+"'>Estado</label>"+
                            "<select class='campo_sistema' id='estado_cadastrado"+contator_end+"' name='estado_cadastrado["+contator_end+"]'>"+
                                "<option value='Acre'>Acre</option>"+
                                "<option value='Alagos'>Alagos</option>"+
                                "<option value='Amapá'>Amapá</option>"+
                                "<option value='Amazonas'>Amazonas</option>"+
                                "<option value='Bahia'>Bahia</option>"+
                                "<option value='Ceára'>Ceára</option>"+
                                "<option value='Distrito Federal'>Distrito Federal</option>"+
                                "<option value='Espirito Santo'>Espirito Santo</option>"+
                                "<option value='Goiás'>Goiás</option>"+
                                "<option value='Maranhão'>Maranhão</option>"+
                                "<option value='Mato Grosso do Sul'>Mato Grosso do Sul</option>"+
                                "<option value='Mato Grosso'>Mato Grosso</option>"+
                                "<option value='Minas Gerais'>Minas Gerais</option>"+
                                "<option value='Pará'>Pará</option>"+
                                "<option value='Paraiba'>Paraiba</option>"+
                                "<option value='Paraná'>Paraná</option>"+
                                "<option value='Pernambuco'>Pernambuco</option>"+
                                "<option value='Piauí'>Piauí</option>"+
                                "<option value='Rio de Janeiro'>Rio de Janeiro</option>"+
                                "<option value='Rio Grande do Norte'>Rio Grande do Norte</option>"+
                                "<option value='Rio Grande do Sul'>Rio Grande do Sul</option>"+
                                "<option value='Rondônia'>Rondônia</option>"+
                                "<option value='Roraima'>Roraima</option>"+
                                "<option value='Santa Catarina'>Santa Catarina</option>"+
                                "<option value='São Paulo'>São Paulo</option>"+
                                "<option value='Sergipe'>Sergipe</option>"+
                                "<option value='Tocantins'>Tocantins</option>"+
                            "</select>"+
                        "</div>"+
                    "</div>"+
            "</div>");

            contator_end++;
        }
    });

    //Remover campo gerado
    $(document).on('click', '.botao_rmv', function(){

        var container_gerar = $(this).closest('[data-id]');
        
        if(container_gerar.data('id') == "telefone")
        {
           let id = $(this).val();

           $('#container_tel_'+id).remove();
        }

        else
        {
            let id = $(this).val();

           $('#container_endereco_'+id).remove();
        }
    });
});

$( function() 
{
    $('.campo_calendario').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });

    var availableTags = [
        "ActionScript",
        "AppleScript",
        "Asp",
        "BASIC"
    ];

    $( "#buscar_cliente" ).autocomplete({source: availableTags});
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

function mascaraHora(hora, campo)
{
    var hora_digitada = "";
    hora_digitada = hora_digitada + hora;

    if(hora_digitada.length == 2)
    {
        hora_digitada = hora_digitada + ":";
        document.getElementById(campo).value = hora_digitada;
    }
}

function mascaraDinheiro(valor, campo)
{
    if(valor != "")
    {
        valor = valor + '';
        valor = parseInt(valor.replace(/[\D]+/g,''));
        valor = valor + '';
        valor = valor.replace(/([0-9]{2})$/g, ",$1");

        if(valor.length > 6)
            valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        document.getElementById(campo).value = valor;
    }
}

function somenteNumero(evento)
{
    var tecla = (window.event)?event.keyCode:e.which;

    if(tecla > 47 && tecla < 58)
        return true;

    else
    {
        if (tecla==8 || tecla==0) 
           return true;

        else  
           return false;
    }
}

function somenteLetra(evento)
{
     var tecla=(window.event)?event.keyCode:e.which;
     
     if(tecla >= 65 && tecla <= 90 || tecla >= 97 && tecla <= 122 || tecla >= 192 && tecla <= 237) 
        return true;

    else
	{
	    if (tecla==32) 
	       	return true;

        else  
           return false;
	}
}