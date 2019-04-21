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

    //Botao para buscar cpf
    $(document).on('click', '.busca_cep', function(){

        var id_cep = this.name;
        var cep = $("#cep_cadastrado"+id_cep).val().replace(/\D/g,'');

        if(cep != '')
        {
            var validarCep = /^[0-9]{8}$/;

            if(validarCep.test(cep))
            {
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){

                    if(!("erro" in dados)){
                        $("#endereco_cadastrado"+id_cep).val(dados.logradouro);
                        $("#bairro_cadastrado"+id_cep).val(dados.bairro);
                        $("#cidade_cadastrado"+id_cep).val(dados.localidade);
                        $("#estado_cadastrado"+id_cep).val(dados.uf);
                    }
                });
            }

            else{
                alert("Formato de CEP inválido.");
            }
        }
    });

    //Esconde campo Nº aparelho caso se marcado alongamento
    $(".exercicio_alongamento").click(function(){
        $("#exercicio_alongamento").hide();
        $("#number_aparelho").val('');
    });

    $(".radio_tipo_exercicio").click(function(){
        $("#exercicio_alongamento").show();
        $("#number_aparelho").val('');
    });

    $(document).on('click', '.botao_mostrar_exercicio', function(){

        let id = $(this).closest('[data-id]');
        $("#"+id.data('id')).toggleClass('abrir_box');

    });

    //Preencher select de exercicio
    $("document").ready(function(){
        $(".select_grupo_muscular").change(function(){

            var id = $(this).attr("id");
            var grupo_muscular = $(this).val();
            
            $.ajax({
                type: 'POST',
                url: 'php/controle_sistema.php?f=listarExercicio',
                data: {
                    acao: 'listar_exercicio',
                    grupo_muscular: grupo_muscular
                },
                dataType: 'json',

                beforeSend: function(){
                    $(".select_exercicio").empty();
                },

                success: function(response){

                    for(let i = 0; i < response.total; i++)
                    {
                        $(".select_exercicio").append(
                            "<option value='"+response.id[i]+ "-" +response.tipo[i] +"'>"+response.nome[i]+"</option>");
                    }
                }
            });
        });
    });

    //Criar os box de exercicio
    var contator_exercicio = 0;
    $(".adicionar_exercicio").click(function(){
        
        let exercicio_selecionado = $(".select_exercicio").val();
        let nome_exercicio = $(".select_exercicio :selected").text();
        let id_exercicio = exercicio_selecionado.split("-");
        let id = id_exercicio[0];
        let nome = id_exercicio[1];
        let criar_html;

        if(exercicio_selecionado != "")
        {   
            contator_exercicio++;

            // Box musculação
            if(nome == "musculacao"){
                criar_html = 
                "<div class='box_exercicio' data-id='"+nome+ "_" +contator_exercicio+"' id='"+nome+ "_" +contator_exercicio+"'>"+
                    "<div class='icon_exercicio icon_musculacao'>"+
                        "<img src='imagens/recortada/icon_musculacao.png' alt='icon_musculacao_"+contator_exercicio+"'>"+
                    "</div>"+

                    "<div class='botao_mostrar_exercicio'>"+
                        "<i class='fa fa-angle-down' aria-hidden='true'></i>"+
                    "</div>"+

                    "<div class='nome_exercicio'>"+
                        "<label class='label_sistema titulo_box_exercicio'>"+nome_exercicio+"</label>"+
                        "<input type='hidden' name='grupo_muscular_"+contator_exercicio+"' id='grupo_muscular"+contator_exercicio+"' value='"+id+"'>"+
                        "<div class='campos_tres'>"+
                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Tempo</label>"+
                                "<input type='text' class='campo_sistema' name='tempo"+contator_exercicio+"' id='tempo"+contator_exercicio+"' maxlength='10'>"+
                            "</div>"+

                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Velocidade</label>"+
                                "<input type='text' class='campo_sistema' name='velocidade"+contator_exercicio+"' id='velocidade"+contator_exercicio+"' maxlength='10'>"+
                            "</div>"+

                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Carga</label>"+
                                "<input type='text' class='campo_sistema' name='velocidade"+contator_exercicio+"' id='velocidade"+contator_exercicio+"' maxlength='10'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='base_exercicio'>"+
                            "<button type='button' class='botao excluir_botao botao_vermelho' name='excluir"+contator_exercicio+"'>Excluir</button>"+
                            "<button type='button' class='botao botao_azul' name='editar"+contator_exercicio+"'>Salvar</button>"+
                        "</div>"+
                    "</div>"+
                "</div>";
            }
            // Box funcional
            else if(nome == "funcional"){

                criar_html = 
                "<div class='box_exercicio' data-id='"+nome+ "_" +contator_exercicio+"' id='"+nome+ "_" +contator_exercicio+"'>"+
                    "<div class='icon_exercicio icon_funcional'>"+
                        "<img src='imagens/recortada/icon_funcional.png'>"+
                    "</div>"+

                    "<div class='botao_mostrar_exercicio'>"+
                        "<i class='fa fa-angle-down' aria-hidden='true'></i>"+
                    "</div>"+

                    "<div class='nome_exercicio'>"+
                        "<label class='label_sistema titulo_box_exercicio'>"+nome_exercicio+"</label>"+
                        "<input type='hidden' name='grupo_muscular_"+contator_exercicio+"' id='grupo_muscular"+contator_exercicio+"' value='"+id+"'>"+
                        "<div class='campos_tres'>"+
                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Séries</label>"+
                                "<input type='text' class='campo_sistema' name='serie_"+contator_exercicio+"' id='serie_"+contator_exercicio+"' maxlength='20'>"+
                            "</div>"+

                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Repetições</label>"+
                                "<input type='text' class='campo_sistema' name='repeticao_"+contator_exercicio+"' id='repeticao_"+contator_exercicio+"' maxlength='10'>"+
                            "</div>"+

                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Carga</label>"+
                                "<input type='text' class='campo_sistema' name='carga_"+contator_exercicio+"' id='carga_"+contator_exercicio+"'>"+
                            "</div>"+

                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Descanso</label>"+
                                "<input type='text' class='campo_sistema' name='descanso_"+contator_exercicio+"' id='descanso_"+contator_exercicio+"' maxlength='10'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='base_exercicio'>"+
                            "<button type='button' class='botao excluir_botao botao_vermelho' name='excluir"+contator_exercicio+"'>Excluir</button>"+
                            "<button type='button' class='botao botao_azul' name='editar_"+contator_exercicio+"'>Salvar</button>"+
                        "</div>"+
                    "</div>"+
                "</div>";
            }
            // Box cardio
            else if(nome == "cardio"){

                criar_html = 
                "<div class='box_exercicio' data-id='"+nome+ "_" +contator_exercicio+"' id='"+nome+ "_" +contator_exercicio+"'>"+
                    "<div class='icon_exercicio icon_cardio'>"+
                        "<img src='imagens/recortada/icon_cardio.png'>"+
                    "</div>"+

                    "<div class='botao_mostrar_exercicio'>"+
                        "<i class='fa fa-angle-down' aria-hidden='true'></i>"+
                    "</div>"+

                    "<div class='nome_exercicio'>"+
                        "<label class='label_sistema titulo_box_exercicio'>"+nome_exercicio+"</label>"+
                        "<input type='hidden' name='grupo_muscular_"+contator_exercicio+"' id='grupo_muscular"+contator_exercicio+"' value='"+id+"'>"+
                        "<div class='campos_tres'>"+
                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Tempo</label>"+
                                "<input type='text' class='campo_sistema' name='tempo_"+contator_exercicio+ "' id='tempo_"+contator_exercicio+ "'>"+
                            "</div>"+

                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Velocidade</label>"+
                                "<input type='text' class='campo_sistema' name='velocidade_"+contator_exercicio+ "' id='velocidade_"+contator_exercicio+ "'>"+
                            "</div>"+

                            "<div class='divisao_campo'>"+
                                "<label class='label_sistema'>Carga</label>"+
                                "<input type='text' class='campo_sistema' name='carga_"+contator_exercicio+ "' id='carga_"+contator_exercicio+ "'>"+
                            "</div>"+
                        "</div>"+
                        "<div class='base_exercicio'>"+
                            "<button type='button' class='botao excluir_botao botao_vermelho' name='excluir_"+contator_exercicio+ "'>Excluir</button>"+
                            "<button type='button' class='botao botao_azul' name='editar_"+contator_exercicio+ "'>Salvar</button>"+
                        "</div>"+
                    "</div>"+
                "</div>";
            }
            // Box alongamento
            else{
            
                criar_html = 
                "<div class='box_exercicio' data-id='exercicio_escolhido3' id='exercicio_escolhido3'>"+
                    "<div class='icon_exercicio icon_alongamento'>"+
                        "<img src='imagens/recortada/icon_alongamento.png'>"+
                    "</div>"+

                    "<div class='botao_mostrar_exercicio'>"+
                        "<i class='fa fa-angle-down' aria-hidden='true'></i>"+
                    "</div>"+

                    "<div class='nome_exercicio'>"+
                        "<input type='hidden' name='grupo_muscular_"+contator_exercicio+"' id='grupo_muscular"+contator_exercicio+"' value='"+id+"'>"+
                        "<label class='label_sistema titulo_box_exercicio'>"+nome_exercicio+"</label>"+

                        "<div class='base_exercicio'>"+
                            "<button type='button' class='botao excluir_botao botao_vermelho' name='excluir_"+contator_exercicio+"'>Excluir</button>"+
                            "<button type='button' class='botao botao_azul' name='editar_"+contator_exercicio+"'>Salvar</button>"+
                        "</div>"+
                    "</div>"+
                "</div>";
            }
        }

        $(".container_exercicio_escolhido").append(criar_html);
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