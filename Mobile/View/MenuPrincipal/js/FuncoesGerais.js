const API = PATH_RAIZ = '/sorc/Mobile/';

function CriarSelectPuro(texto, nmeCombo, arrDados, valor, disabled) {
    if (disabled == undefined) {
        disabled = false;
    }
    $("#td" + nmeCombo).html('');
    var select = '<label for="'+nmeCombo+'" class="mb-0 title">'+texto+'</label>';
    if (disabled == true) {
        select += '<select id="' + nmeCombo + '" disabled class="persist form-control">';
    } else {
        select += '<select id="' + nmeCombo + '" class="input persist form-control">';
    }
    select += '<option value="-1">Selecione...</option>';
    for (i = 0; i < arrDados[1].length; i++) {
        if (arrDados[1][i]['ID'] == valor) {
            select += '<option value="' + arrDados[1][i]['ID'] + '" selected>' + arrDados[1][i]['DSC'] + '</option>';
        } else {
            select += '<option value="' + arrDados[1][i]['ID'] + '">' + arrDados[1][i]['DSC'] + '</option>';
        }
    }
    select += '</select>';
    $("#td" + nmeCombo).html(select);
}

function ExecutaDispatch(Controller, Method, Parametros, Callback, MensagemAguarde, MensagemRetorno) {
    if (MensagemAguarde != undefined) {
        swal({
            title: MensagemAguarde,
            imageUrl: PATH_RAIZ + "Resources/images/preload.gif",
            showConfirmButton: false
        });
    }
    var obj = new Object();
    Object.defineProperty(obj, 'method', {
        __proto__: null,
        enumerable: true,
        configurable: true,
        value: Method
    });
    Object.defineProperty(obj, 'controller', {
        __proto__: null,
        enumerable: true,
        configurable: true,
        value: Controller
    });
    if (Parametros != undefined) {
        var dados = Parametros.split('|');
        for (i = 0; i < dados.length; i++) {
            var campos = dados[i].split(';');
            Object.defineProperty(obj, campos[0], {
                __proto__: null,
                enumerable: true,
                configurable: true,
                value: campos[1]
            });
        }
    }
    $.post(PATH_RAIZ + "Dispatch.php",
        obj,
        function (retorno) {
            retorno = eval('(' + retorno + ')');
            if (retorno[0] == true) {
                if (MensagemRetorno != undefined) {
                    $(".jquery-waiting-base-container").fadeOut({ modo: "fast" });
                    swal({
                        title: "Sucesso!",
                        text: MensagemRetorno,
                        showConfirmButton: false,
                        type: "success"
                    });
                    setTimeout(function () {
                        swal.close();
                    }, 2000);
                }
//                swal.close();
                if (Callback != undefined) {
                    Callback(retorno);
                }
            } else {
                $(".jquery-waiting-base-container").fadeOut({ modo: "fast" });
                swal({
                    title: "Erro ao executar!",
                    text: "Erro: " + retorno[1],
                    type: "error",
                    confirmButtonText: "Fechar"
                });
            }
        }
    );
}

function retornaParametros() {
    var name;
    var value;
    var retorno = '';
    $(".persist").each(function (index) {
        name = $(this).prop('id');
        switch ($(this).attr('type')) {
            case 'checkbox':
                if ($(this).is(":checked")) {
                    var value = 'S';
                } else {
                    var value = 'N';
                }
                break;
            default:
                value = $(this).val();
                break;
        }
        retorno += name + ';' + value + '|';
    });
    return retorno;
}

/**
 * 
 * @param {type} arrCampos
 * @param {type} valorPadrao (Passar o nome do campo concatenado com ';' e após o tipo do campo e depois '|' ex.:indAtivo;B|
 * @returns {undefined}
 */
function preencheCamposForm(arrCampos, valorPadrao) {
    var entrou = false;
    for (var k in arrCampos) {
        if (typeof arrCampos[k] !== 'function') {
            var LK = k.toLowerCase();
            var ret = LK.split('_');
            var campo = '';
            for (var i = 0; i < ret.length; i++) {
                if (i > 0) {
                    campo += ret[i].substring(0, 1).toUpperCase() + ret[i].substring(1, ret[i].lenght);
                } else {
                    campo = ret[i];
                }
            }
            if (valorPadrao != undefined) {
                var valores = valorPadrao.split('|');
                for (i = 0; i < valores.length; i++) {
                    var tipo = valores[i].split(';');
                    var entrou = false;
                    if (tipo[0] == campo) {
                        switch (tipo[1]) {
                            case 'B':
                                if (arrCampos[k] == 'S') {
                                    $("#" + campo).prop('checked', true);
                                } else {
                                    $("#" + campo).prop('checked', false);
                                }
                                break;
                            default:
                                $("#" + campo).val(arrCampos[k]);
                                break;
                        }
                        entrou = true;
                    }
                }
            }
            if (!entrou) {
                $("#" + campo).val(arrCampos[k]);
            }
        }
    }
}

function LimparCampos() {
    $(".persist").each(function (index) {
        switch ($(this).prop('type')) {
            case 'radio':
            case 'checkbox':
                $(this).prop("checked", false);
                break;
            case 'file':
                $(this).replaceWith($(this).val('').clone(true));
                break;
            case 'text':
            case 'hidden':
                $(this).val('');
                break;
            case 'select-one':
                $(this).val('-1');
                break;
            default:
                $(this).val('0');
                break;
        }
    });
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function formataDataAmericano(data){
    var dataSplit = data.split('/');
    return dataSplit[2]+'-'+dataSplit[1]+'-'+dataSplit[0];
}

function formataDataPtbr(data){
    var dataPtbr = data.substring(0,10);
    var dataSplit = dataPtbr.split('-');
    return dataSplit[2]+'/'+dataSplit[1]+'/'+dataSplit[0];
}