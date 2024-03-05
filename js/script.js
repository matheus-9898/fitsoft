$(function () {

    /* #region  MENU DESKTOP */
    $('#contBtMenu').click(function () {
        if ($('#contMenuLateral').css('width') == '70px') {
            $('body,html').css('--larguraMenuLateral', '230px');
            $('#contBtMenu').css('text-align', 'right');
            setTimeout(function () {
                $('#contLista a h2').fadeIn(100);
            }, 100)
            $('#contLista a').css('justify-content', 'left');
            $('#contBtMenu').css('padding', '20px');
            $('#contLista a').css('padding', '25px 20px');

            $('#contPerfil').css('padding-left', '10px').css('justify-content', 'left');
            setTimeout(function () {
                $('#contTxtPerfil').fadeIn(200);
                $('#contPerfil').css('padding-left', '0').css('justify-content', 'center');
            }, 100)
        } else {
            $('#contTxtPerfil').animate({
                'width': '0px'
            }, 100)
            setTimeout(function () {
                $('#contTxtPerfil').css('display', 'none');
                $('#contTxtPerfil').css('width', 'auto');
            }, 200)
            $('body,html').css('--larguraMenuLateral', '70px');
            $('#contBtMenu').css('text-align', 'center');
            $('#contLista a h2').fadeOut(200);

            setTimeout(function () {
                $('#contLista a').css('justify-content', 'center');
                $('#contBtMenu').css('padding', '20px 0');
                $('#contLista a').css('padding', '25px 0');

            }, 300)
        }
    })

    //animação hover menu
    var efeitoHoverDesktop;
    function validarEfeitoHover() {

        if ($(window).width() > 768)
            efeitoHoverDesktop = true;
        else
            efeitoHoverDesktop = false;
    }
    validarEfeitoHover();
    $(window).resize(function () {
        validarEfeitoHover();
    })
    $('#contLista a').mouseenter(function () {
        if (efeitoHoverDesktop == true) {
            $(this).css('border-left', '8px solid var(--azul)')
        }//possocolocar outra animação para mobile usando else
    })
    $('#contLista a').mouseleave(function () {
        if (efeitoHoverDesktop == true) {
            $(this).animate({ 'border-left-width': '0px' }, 150)
        }//possocolocar outra animação para mobile usando else
    })
    /* #endregion */

    /* #region  MENU MOBILE */
    $('#contBtMenuMobile img').click(function () {

        if ($('#contMenuLateral').css('right') < '0') {
            $('#fundoMenuMobile').fadeIn(200);
            $('#contMenuLateral').css('right', '0');
        } else {
            $('#fundoMenuMobile').fadeOut(200);
            $('#contMenuLateral').css('right', '-230px');
        }
    })
    $(window).resize(function () {
        if ($('#fundoMenuMobile').css('display') != 'none') {
            $('#fundoMenuMobile').fadeOut(200);
            $('#contMenuLateral').css('right', '-230px');
        }
    })
    /* #endregion */

    /* #region  SUBMENU PERFIL */
    $('#contPerfil').click(function () {
        if ($('#submenuPerfil').css('display') == 'none')
            $('#submenuPerfil').css('display', 'block');
        else
            $('#submenuPerfil').css('display', 'none');
    })
    $(window).resize(function () {
        $('#submenuPerfil').css('display', 'none');
    })
    /* #endregion */

    /* #region  PREVIEW FOTO PERFIL */
    $('input#imagem').change(function () {
        previewImage(this);
    })
    function previewImage(input) {
        var preview = $('#contImg > img');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        } /* else {
            preview.attr('src', '');
        } */
    }
    /* #endregion */

    /* #region  EDITAR INFORMAÇÕES PERFIL */
    $('.edit-trigger').click(function () {
        var input = $(this).next('.editable-input');
        input.prop('readonly', false);
        input.focus();
        input[0].selectionStart = input[0].selectionEnd = input.val().length;
    });

    $('.editable-input').blur(function () {
        $(this).prop('readonly', true);
    });
    /* #endregion */

    /* #region  ADICIONAR UNIDADES */
    $('#contAddUnidades').click(function () {

        $('#contFormUnidades').fadeIn().css('display', 'flex');
    })
    /* #endregion */

    /* #region  ADICIONAR SERVICOS */
    $('#areaServicos > img').click(function () {

        $(`<div class="itemServico">
            <div class="contInputsServicos">
                <input type="text" name="nomeServico[]" placeholder="Serviço (Ex: Musculação, Av. física, Boxe, etc)" required>
                <input type="text" name="valorServico[]" placeholder="Valor" required>
            </div>
            <select name="pagamento[]" class="pagamento">
                <option value="pagamento único">Pagamento único</option>
                <option value="recorrente">Recorrente</option>
            </select>
            <select name="recorrenciaPag[]" class="recorrenciaPag">
                <option value="1">A cada 1 mês</option>
                <option value="2">A cada 2 mêses</option>
                <option value="3">A cada 3 mêses</option>
                <option value="4">A cada 4 mêses</option>
                <option value="5">A cada 5 mêses</option>
                <option value="6">A cada 6 mêses</option>
                <option value="7">A cada 7 mêses</option>
                <option value="8">A cada 8 mêses</option>
                <option value="9">A cada 9 mêses</option>
                <option value="10">A cada 10 mêses</option>
                <option value="11">A cada 11 mêses</option>
                <option value="12">A cada 12 mêses</option>
            </select>
            <div class="contRemoverServico"><img src="../imagens/ico-remove-vermelho.png" alt="Remover" class="ico"></div>
        </div>`).prependTo('#listaServicos');
    })
    /* #endregion */

    /* #region  PAGAMENTO SERVIÇO */
    $('.pagamento').each(function () {
        if ($(this).val() == 'recorrente') {
            $(this).next('.recorrenciaPag').css('display', 'block');
        }
    })
    $('#areaServicos').on('change', '.pagamento', function () {
        if ($(this).val() == 'recorrente') {
            $(this).next('.recorrenciaPag').css('display', 'block');
        } else {
            $(this).next('.recorrenciaPag').css('display', 'none');
        }
    })
    /* #endregion */

    /* #region  EDITAR UNIDADES */
    var url = window.location.href;
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('editar')) {

        $('#contFormUnidades').fadeIn().css('display', 'flex');
    }
    /* #endregion */

    /* #region  REMOVER ITEM SERVIÇO */
    $("#listaServicos").on('click', '.itemServico .contRemoverServico', function () {
        $(this).closest(".itemServico").remove();
    });
    /* #endregion */

    /* #region  CADASTRAR ALUNO */
    $('#cadastrarAluno').click(function () {

        $('#contFormAlunos').fadeIn().css('display', 'flex');
    })
    /* #endregion */

    /* #region  EDITANDO ALUNOS */
    var url = window.location.href;
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('editarAluno')) {

        $('#contFormAlunos').fadeIn().css('display', 'flex');
    }
    /* #endregion */

    /* #region  NOVA AVALIAÇÃO FÍSICA */
    $('#cadastrarAvaFis').click(function () {

        $('#contFormAvafis').fadeIn().css('display', 'flex');
    })
    /* #endregion */

    /* #region  PERGUNTAS DA AVALIAÇÃO FÍSICA */
    $('.itemPergunta .respostaAnamnese').change(function () {
        if ($(this).val() != "não" && $(this).val() != "1.2") {
            $(this).next('.itemPergunta > div > input[type=text]').fadeIn(200);
        } else {
            $(this).next('.itemPergunta > div > input[type=text]').fadeOut(200);
        }
    });
    /* #endregion */

    /* #region  INPUTS DOBRAS CUTÂNEAS */
    //add e remover placeholder 'mm' dinâmicamente
    $('#contDobras table').on('focus', 'input', function () {
        if (!$(this).hasClass('inputPreencAuto')) {
            $(this).attr('placeholder', 'mm');
        }
    })
    $('#contDobras table').on('blur', 'input', function () {
        $(this).removeAttr('placeholder');
    })

    //exibição das dobras
    function exibicaoDobras() {

        var select = $('#protocolo').val()

        if (select == 1)
            $('#linhaSubescapular, #linhaTriceps, #linhaPeitoral, #linhaAxiliarMedia, #linhaSuprailiaca, #linhaAbdomen, #linhaCoxa').css('display', 'table-row');
        else if (select == 2)
            $('#linhaTriceps, #linhaSuprailiaca, #linhaCoxa').css('display', 'table-row');
        else if (select == 3)
            $('#linhaTriceps, #linhaSubescapular, #linhaSuprailiaca, #linhaPanturrilha').css('display', 'table-row');
        else if (select == 4)
            $('#linhaTriceps, #linhaSuprailiaca, #linhaAbdomen').css('display', 'table-row');
        else if (select == 5)
            $('#linhaSubescapular, #linhaSuprailiaca, #linhaCoxa').css('display', 'table-row');
        else if (select == 6)
            $('#linhaSubescapular, #linhaTriceps, #linhaSuprailiaca, #linhaAbdomen').css('display', 'table-row');
        else if (select == 7)
            $('#linhaSubescapular, #linhaTriceps, #linhaBiceps, #linhaSuprailiaca').css('display', 'table-row');
        else if (select == 8)
            $('#linhaSubescapular, #linhaTriceps, #linhaBiceps, #linhaSuprailiaca').css('display', 'table-row');
        else if (select == 9)
            $('#linhaSubescapular, #linhaTriceps, #linhaAxiliarMedia, #linhaSuprailiaca, #linhaAbdomen, #linhaCoxa, #linhaPanturrilha').css('display', 'table-row');
        else if (select == 10)
            $('#linhaSubescapular, #linhaTriceps, #linhaAxiliarMedia').css('display', 'table-row');
        else if (select == 11)
            $('#linhaAbdomen').css('display', 'table-row');
    }
    exibicaoDobras();

    $('#protocolo').change(function () {
        $('#contDobras table tr:not(tr:first-child)').css('display', 'none');
        exibicaoDobras();
    })

    //médias
    if ($('#linhaTriceps').css('display') != 'none') {
        $('.amostraTriceps').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraTriceps');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaTriceps').val(media);
        })
    }
    if ($('#linhaBiceps').css('display') != 'none') {
        $('.amostraBiceps').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraBiceps');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaBiceps').val(media);
        })
    }
    if ($('#linhaSubescapular').css('display') != 'none') {
        $('.amostraSubescapular').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraSubescapular');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaSubescapular').val(media);
        })
    }
    if ($('#linhaPeitoral').css('display') != 'none') {
        $('.amostraPeitoral').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraPeitoral');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaPeitoral').val(media);
        })
    }
    if ($('#linhaAxiliarMedia').css('display') != 'none') {
        $('.amostraAxiliarMedia').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraAxiliarMedia');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaAxiliarMedia').val(media);
        })
    }
    if ($('#linhaSuprailiaca').css('display') != 'none') {
        $('.amostraSuprailiaca').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraSuprailiaca');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaSuprailiaca').val(media);
        })
    }
    if ($('#linhaAbdomen').css('display') != 'none') {
        $('.amostraAbdomen').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraAbdomen');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaAbdomen').val(media);
        })
    }
    if ($('#linhaCoxa').css('display') != 'none') {
        $('.amostraCoxa').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraCoxa');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaCoxa').val(media);
        })
    }
    if ($('#linhaPanturrilha').css('display') != 'none') {
        $('.amostraPanturrilha').keyup(function () {
            var soma = 0;
            var elementos = $('.amostraPanturrilha');
            var qtdEl = 0;
            elementos.each(function () {
                if ($(this).val() != '') {
                    soma += Number($(this).val());
                    qtdEl += 1;
                }
            })
            var media = soma / qtdEl;
            media = Math.round(media * 10) / 10;
            $('#mediaPanturrilha').val(media);
        })
    }
    /* #endregion */

    /* #region  INPUTS DUPLICADOS AVALIAÇÃO FÍSICA */

    //quadril
    $('#quadril1').keyup(function () {
        $('#quadril2').val($('#quadril1').val());
    })
    $('#quadril2').keyup(function () {
        $('#quadril1').val($('#quadril2').val());
    })

    //massa
    $('#massa').keyup(function () {
        $('#massa2').val($('#massa').val());
    })
    /* #endregion */

    /* #region  IMC E IAC */
    $('#massa,#altura').keyup(function () {
        if ($('#massa').val() != '' && $('#altura').val() != '') {
            var massa = Number($('#massa').val());
            var altura = Number($('#altura').val()) / 100;
            var imc = massa / (altura * altura);
            imc = Math.round(imc * 10) / 10;
            $('#imc').val(imc);
        } else {
            $('#imc').val('');
        }
    })

    $('#quadril1,#quadril2,#altura').keyup(function () {
        if ($('#quadril1').val() != '' && $('#altura').val() != '') {
            var quadril = Number($('#quadril1').val());
            var altura = Number($('#altura').val()) / 100;
            var raizAltura = Math.sqrt(altura)
            var iac = (quadril / (altura * raizAltura)) - 18;
            iac = Math.round(iac);
            $('#iac').val(iac);
        } else {
            $('#iac').val('');
        }
    })
    /* #endregion */

    /* #region  PESO IDEAL */
    $('#massa,#altura').keyup(function () {
        if ($('#massa').val() != '' && $('#altura').val() != '') {
            var altura = Number($('#altura').val()) / 100;
            var massaIdealMin = 18.5 * (altura ** 2);
            var massaIdealMax = 24.9 * (altura ** 2);
            massaIdealMin = Math.round(massaIdealMin * 10) / 10;
            massaIdealMax = Math.round(massaIdealMax * 10) / 10;
            $('#massaIdeal').val(massaIdealMin + ' a ' + massaIdealMax);
        } else {
            $('#massaIdeal').val('');
        }
    })
    /* #endregion */

    /* #region  TMB */
    $('#massa,#altura').keyup(function () {
        if ($('#massa').val() != '' && $('#altura').val() != '') {
            var altura = Number($('#altura').val());
            var massa = Number($('#massa').val());
            var partesIdade = $('#idade').val().split(' ');
            var idade = Number(partesIdade[0]);
            var tmb = 0;
            if ($('#sexo').val() == 'Masculino') {
                //TMB = 66,5 + (13,75 x peso em kg) + (5,003 x altura em cm) - (6,75 x idade em anos)
                tmb = 66.5 + (13.75 * massa) + (5.003 * altura) - (6.75 * idade);
            } else {
                //TMB = 655,1 + (9,563 x peso em kg) + (1,850 x altura em cm) - (4,676 x idade em anos)
                tmb = 655.1 + (9.563 * massa) + (1.850 * altura) - (4.676 * idade);
            }
            tmb = Math.round(tmb * 10) / 10;
            $('#taxaMetabBasal').val(tmb);
        } else {
            $('#taxaMetabBasal').val('');
        }
    })
    /* #endregion */

    /* #region  GET */
    function calcGet() {
        if ($('#massa').val() != '' && $('#altura').val() != '') {
            var get = Number($('#nivelAF').val()) * Number($('#taxaMetabBasal').val());
            get = Math.round(get * 10) / 10;
            $('#gastoEnergTotal').val(get);
        } else {
            $('#gastoEnergTotal').val('');
        }
    }

    $('#massa,#altura').keyup(function () {
        calcGet();
    })
    $('#nivelAF').change(function () {
        calcGet();
    })
    /* #endregion */

    /* #region  LEGENDA AVALIAÇÃO FÍSICA */
    $('#btLegendaAvaFis').mouseenter(function (e) {
        if (e.target === this)
            $('#contLegendaAvaFis').fadeIn(200).css('display', 'flex');
    })
    $('#btLegendaAvaFis').mouseleave(function () {
        $('#contLegendaAvaFis').fadeOut(200);
    })
    $('#contLegendaAvaFis').mouseenter(function () {
        $('#contLegendaAvaFis').fadeOut(200);
    })
    /* #endregion */

    /* #region  CLASSIFICAÇÃO RESULTADOS AVALIAÇÃO FÍSICA */
    function removerClassesAvaFis() {
        $('#imc').removeClass('abaixoInput');
        $('#imc').next('span').removeClass('abaixoSpan');
        $('#imc').removeClass('saudavelInput');
        $('#imc').next('span').removeClass('saudavelSpan');
        $('#imc').removeClass('acimaInput');
        $('#imc').next('span').removeClass('acimaSpan');
        $('#imc').removeClass('mtAcimaInput');
        $('#imc').next('span').removeClass('mtAcimaSpan');
        $('#imc').removeClass('extAcimaInput');
        $('#imc').next('span').removeClass('extAcimaSpan');
    }

    //add classes de classificação
    $('#massa,#altura').keyup(function () {
        removerClassesAvaFis();
        if ($('#imc').val() != '') {
            if (Number($('#imc').val()) < 18.5) {
                $('#imc').addClass('abaixoInput');
                $('#imc').next('span').addClass('abaixoSpan');
            } else if (Number($('#imc').val()) >= 18.5 && Number($('#imc').val()) < 25) {
                $('#imc').addClass('saudavelInput');
                $('#imc').next('span').addClass('saudavelSpan');
            } else if (Number($('#imc').val()) >= 25 && Number($('#imc').val()) <= 30) {
                $('#imc').addClass('acimaInput');
                $('#imc').next('span').addClass('acimaSpan');
            } else if (Number($('#imc').val()) > 30 && Number($('#imc').val()) < 40) {
                $('#imc').addClass('mtAcimaInput');
                $('#imc').next('span').addClass('mtAcimaSpan');
            } else if (Number($('#imc').val()) >= 40) {
                $('#imc').addClass('extAcimaInput');
                $('#imc').next('span').addClass('extAcimaSpan');
            }
        }
    })
    /* #endregion */

    $('#registrarLancamento').click(function () {

        $('#contFormLancamentoFinanc').fadeIn().css('display', 'flex');
    })





})