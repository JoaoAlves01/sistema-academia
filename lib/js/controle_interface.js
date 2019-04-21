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
        window.location.href = "home.php";
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
                            "<input type='text' class='campo_sistema' id='numero_cadastrado"+contator_tel+"' name='numero_cadastrado["+contator_tel+"]' maxlength='15' onkeypress='mascaraTelefone(this.value, this.id); return somenteNumero(event);' />"+
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
                        "<input type='text' class='campo_sistema' id='cep_cadastrado"+contator_end+"' name='cep_cadastrado["+contator_end+"]' maxlength='9' onkeypress='mascaraCep(this.value, this.id); return somenteNumero(event);' />"+
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
                            "<input type='text' class='campo_sistema' id='bairro_cadastrado"+contator_end+"' name='bairro_cadastrado["+contator_end+"]' onkeypress='return somenteNumero(event);' />"+
                        "</div>"+
                    "</div>"+

                    "<div class='campos_tres'>"+
                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='cidade_cadastrado"+contator_end+"'>Cidade</label>"+
                            "<input type='text' class='campo_sistema' id='cidade_cadastrado"+contator_end+"' name='cidade_cadastrado["+contator_end+"]' onkeypress='return somenteNumero(event);' />"+
                        "</div>"+

                        "<div class='divisao_campo'>"+
                            "<label class='label_sistema' for='estado_cadastrado"+contator_end+"'>Estado</label>"+
                            "<select class='campo_sistema' id='estado_cadastrado"+contator_end+"' name='estado_cadastrado["+contator_end+"]'>"+
                                "<option value='AC'>Acre</option>"+
                                "<option value='AL'>Alagos</option>"+
                                "<option value='AP'>Amapá</option>"+
                                "<option value='AM'>Amazonas</option>"+
                                "<option value='BA'>Bahia</option>"+
                                "<option value='CE'>Ceára</option>"+
                                "<option value='DF'>Distrito Federal</option>"+
                                "<option value='ES'>Espirito Santo</option>"+
                                "<option value='GO'>Goiás</option>"+
                                "<option value='MA'>Maranhão</option>"+
                                "<option value='MS'>Mato Grosso do Sul</option>"+
                                "<option value='MT'>Mato Grosso</option>"+
                                "<option value='MG'>Minas Gerais</option>"+
                                "<option value='PA'>Pará</option>"+
                                "<option value='PB'>Paraiba</option>"+
                                "<option value='PR'>Paraná</option>"+
                                "<option value='PE'>Pernambuco</option>"+
                                "<option value='PI'>Piauí</option>"+
                                "<option value='RJ'>Rio de Janeiro</option>"+
                                "<option value='RN'>Rio Grande do Norte</option>"+
                                "<option value='RS'>Rio Grande do Sul</option>"+
                                "<option value='RO'>Rondônia</option>"+
                                "<option value='RR'>Roraima</option>"+
                                "<option value='SC'>Santa Catarina</option>"+
                                "<option value='SP'>São Paulo</option>"+
                                "<option value='SE'>Sergipe</option>"+
                                "<option value='TO'>Tocantins</option>"+
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

    //Mostrar e esconder senha de campo
    $('.visualizar_senha_icon').on('click', function(){

        var id = $(this).closest('[data-id]');
        $("#"+id.data('id')).get(0).type = 'text';

        setTimeout(function()
        {
            $("#"+id.data('id')).get(0).type = 'password';
        }, 1500);
    });

    // Carrossel Imagens
    //Só mostra func do carroseul se estiver no quiosque
    var url_atual = window.location.href;
    url_atual = url_atual.split('/painel');
    url_atual = url_atual[1];
    
    if(url_atual == "Quiosque.php"){
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
    }
});

$(function(){

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

function mascaraCpf(cpf, campo){
    
    cpf = cpf.replace(/\D/g, "");
    cpf = cpf.replace(/(\d{3})(\d)/,"$1.$2");
	cpf = cpf.replace(/(\d{3})(\d)/,"$1.$2");
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
    
	document.getElementById(campo).value = cpf;
}

function mascaraRg(rg, campo){
    
    rg = rg.replace(/\D/g, "");
    rg = rg.replace(/(\d{2})(\d)/,"$1.$2");
	rg = rg.replace(/(\d{3})(\d)/,"$1.$2");
    rg = rg.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
    
	document.getElementById(campo).value = rg;
}

function mascaraTelefone(telefone, campo){
    
    telefone = telefone.replace(/\D/g, "");
    telefone=telefone.replace(/(\d{2})(\d)/,"($1) $2");
	telefone=telefone.replace(/(\d{5})(\d)/,"$1-$2");
    
	document.getElementById(campo).value = telefone;
}

function mascaraCep(cep, campo){

    cep = cep.replace(/\D/g, "");
    cep=cep.replace(/(\d{5})(\d)/,"$1-$2");
    
	document.getElementById(campo).value = cep;
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