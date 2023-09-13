const API = PATH_RAIZ = '/sorc/';

/**
 * 
 * @param {String} nmeCombo Nome do combo a ser montado, detalhe tem que existir um elemento no DOM que o ID comece com td 
 * @param {String} arrDados Array de dados que deverá ser passado, contendo os campos ID e DSC
 * @param {String} valor Valor padrão para ser selecionado
 * @param {String} disabled Marca o combo como desabilitado
 */
function CriarSelect(nmeCombo, arrDados, valor, disabled, persist='persist') {
    if (disabled == undefined) {
        disabled = false;
    }
    $("#td" + nmeCombo).html('');
    if (disabled == true) {
        var select = '<select id="' + nmeCombo + '" disabled class="'+persist+' form-control">';
    } else {
        var select = '<select id="' + nmeCombo + '" class="'+persist+' form-control">';
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

/**
 * 
 * @param {String} nmeCombo Nome do combo a ser montado, detalhe tem que existir um elemento no DOM que o ID comece com td 
 * @param {String} arrDados Array de dados que deverá ser passado, contendo os campos ID e DSC
 * @param {String} valor Valor padrão para ser selecionado
 * @param {String} disabled Marca o combo como desabilitado
 * @param {String} nomeClasse Define uma classe para o componente
 */
function CriarSelectClasse(nmeCombo, arrDados, valor, disabled, nomeClasse) {
    if (disabled == undefined) {
        disabled = false;
    }
    $("#td" + nmeCombo).html('');
    if (disabled == true) {
        var select = '<select id="' + nmeCombo + '" disabled class="persist form-control '+nomeClasse+'">';
    } else {
        var select = '<select id="' + nmeCombo + '" class="persist form-control '+nomeClasse+'">';
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

/**
 * 
 * @param {String} Controller 
 * @param {String} Method 
 * @param {String} Parametros Executar a função retornaParametros() 
 * @param {String} Callback Colocar o nome da função que será executada após o retorno da controller.
 *                          O retorno da controller, será passado como parâmetro, automaticamente, para a função indicada
 *                          Ex: redirecionaLogin
 * @param {String} MensagemAguarde 
 * @param {String} MensagemRetorno 
 */
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

    var name;
    var value;
    $(".persist").each(function () {
        name = $(this).prop('id');
        switch ($(this).attr('type')) {
            case 'checkbox':
                if ($(this).is(":checked")) {
                    value = 'S';
                } else {
                    value = 'N';
                }
                break;
            case 'radio':
                name = $(this).prop('name');
                if ($(this).is(":checked")) {
                    value = $(this).val();
                }
                break;
            case 'summerNote':
                let texto = $(this).val();
                value = $(this).val();
                break;
            default:
                value = $(this).val();
                break;
        }
        Object.defineProperty(obj, name, {
            __proto__: null,
            enumerable: true,
            configurable: true,
            value: value
        });
    });

    if (Parametros != undefined) {
        var dados = Parametros.split('|');
        for (i = 0; i < dados.length; i++) {
            var campos = dados[i].split('<=>');
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
                }else{
                    swal.close();
                }
                if (Callback != undefined) {
                    Callback(retorno);

                }
            } else {
                $(".jquery-waiting-base-container").fadeOut({ modo: "fast" });
                swal({
                    title: "Erro ao executar!",
                    text: "Erro: " + retorno[1].mensagem,
                    type: "error",
                    confirmButtonText: "Fechar"
                });
            }
        }
    );
}

function ExecutaAjax(tipo, url, Parametros, Callback, MensagemAguarde, MensagemRetorno) {
    if (MensagemAguarde != undefined) {
        swal({
            title: MensagemAguarde,
            imageUrl: PATH_RAIZ + "Resources/images/preload.gif",
            showConfirmButton: false
        });
    }
    $.ajax({
        type: tipo,
        url: API + url,
        data: Parametros,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
        },
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            if (data.retorno) {
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
                if (Callback != undefined) {
                    Callback(data.objeto);
                }
            } else {
                swal("Aviso!", data.mensagem, "error");
            }
        },
        error: function (err) {
            swal("Erro!", "Não foi possível concluir a requisição", "error");
        }
    });
}

/**
 * Este método irá procurar por todos os elementos que tem a classe persist no DOM e retornar uma String com nome do campo e valor.
 * @returns 
 */
function retornaParametros() {
    var name;
    var value;
    var retorno = '';
    $(".persist").each(function () {
        name = $(this).prop('id');
        switch ($(this).attr('type')) {
            case 'checkbox':
                if ($(this).is(":checked")) {
                    value = 'S';
                } else {
                    value = 'N';
                }
                break;
            case 'summerNote':
                let texto = $(this).val();
                value = $(this).val();
                break;
            default:
                value = $(this).val();
                break;
        }
        retorno += name + '<=>' + value + '|';
    });
    return retorno;
}

/**
 * 
 * @param {type} arrCampos
 * @param {type} valorPadrao (Passar o nome do campo concatenado com ';' e após o tipo do campo e depois '|' 
 * ex.:indAtivo;B|texto;ST
 * B=>checkbox
 * ST=>summernote, Texto Rico
 * @returns {undefined}
 */
function PreencheCamposForm(arrCampos, valorPadrao) {
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
                            case 'ST':
                                $("#" + campo).summernote('code', arrCampos[k]);
                                break;
                            case 'R':
                                $("input[name="+campo+"][value='"+arrCampos[k]+"']").prop("checked",true);
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

function MontaDataTable(idCampo, isFilter, orderColum = 0, scroll=false, altura=50) {
    if(scroll) {
        $('#' + idCampo).DataTable({
            searching: isFilter,
            paging: false,
            lengthChange: false,
            scrollCollapse: true,
            scrollY: altura+'vh',
            language: {
                "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json",
                "decimal": ',',
                "thousands": '.'
            },
            order: [[orderColum, 'asc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<span id="dtBtnExcel"></span>',
                    className: 'd-none',
                },
                // 'copy', 'csv', 'excel', 'pdf', 'print' -- opções de exportação nativas dos DataTable
            ]
        });
    } else {
        $('#' + idCampo).DataTable({
            "searching": isFilter,
            "pagingType": "simple_numbers",
            "lengthChange": false,
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json",
                "decimal": ',',
                "thousands": '.'
            },
            "order": [[orderColum, 'asc']],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ]
        });
    }
}

function number_format(number, decimals, dec_point, thousands_sep) {
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

function CriarGraficoBarras(nmeCampo, dados, arrLabels) {
    var campo = document.getElementById("" + nmeCampo + "");
    var valores = [];
    for (var i in dados) {
        valores.push(dados[i].VALOR);
    }

    new Chart(campo, {
        type: 'bar',
        data: {
            labels: arrLabels,
            // labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            datasets: [{
                label: "Total: ",
                backgroundColor: "#191970",
                hoverBackgroundColor: "#0000CD",
                borderColor: "#eaecf4",
                data: valores,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    // time: {
                    //     unit: 'month'
                    // },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    },
                    maxBarThickness: 50,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 20000,
                        maxTicksLimit: 10,
                        padding: 5,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return 'R$ ' + number_format(value, 2, ',', '.');
                        }
                    },
                    gridLines: {
                        color: "rgb(200, 200, 200)",
                        zeroLineColor: "rgb(150, 150, 150)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + 'R$ ' + number_format(tooltipItem.yLabel, 2, ',', '.');
                    }
                }
            },
        }
    });
}

function CriarGraficoBarrasNovo(nmeCampo, arrLabels, receitas, despesas, despesasAbertas) {
    var campo = document.getElementById("" + nmeCampo + "");
    var arrDiff = [];
    var arrAnterior = [];
    var totalDespesas = [];
    for(var i in receitas) {
        if(i==0){
            arrAnterior.push(0);
        }else {
            arrAnterior.push(arrDiff[i-1]);
        }
        var saldo = parseFloat(receitas[i])+parseFloat(arrAnterior[i]);
        var diff = parseFloat(saldo)-parseFloat(despesas[i]);
        arrDiff.push(diff);
    }
    for(var i in despesas) {
        totalDespesas.push(parseFloat(despesas[i])+parseFloat(despesasAbertas[i]));
    }

    new Chart(campo, {
        type: 'bar',
        data: {
            labels: arrLabels,
            datasets: [
                {
                    label: 'Saldo anterior',
                    data: arrAnterior,
                    backgroundColor: 'rgb(60,120,100)',
                    stack: 'Stack 0',
                    barPercentage: .7,
                },
                {
                    label: 'Receita',
                    data: receitas,
                    backgroundColor: 'rgb(60,179,113)',
                    stack: 'Stack 0',
                    barPercentage: .7,
                },
                {
                    label: 'Despesa Em Aberto',
                    data: despesasAbertas,
                    backgroundColor: 'rgb(178,34,34)',
                    stack: 'Stack 1',
                    barPercentage: .7,
                },
                {
                    label: 'Despesa Paga',
                    data: despesas,
                    backgroundColor: 'rgb(255,50,50)',
                    stack: 'Stack 1',
                    barPercentage: .7,
                },
                {
                    label: 'Total Despesa',
                    data: totalDespesas,
                    backgroundColor: 'rgb(139,0,139)',
                    stack: 'Stack 2',
                    barPercentage: .4,
                },
                {
                    label: 'Saldo Final',
                    data: arrDiff,
                    backgroundColor: 'rgb(30,144,255)',
                    stack: 'Stack 3',
                    barPercentage: .7,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
              intersect: false,
            },
          }
    });
}

function CriarGraficoArea(nmeCampo, dados) {
    var campo = document.getElementById("" + nmeCampo + "");
    var valores = [];
    var labelMeses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    for (var i in labelMeses) {
        var ref = parseInt(i) + parseInt(1);
        var valMesAtual = dados.filter(elm => elm.NRO_MES_REFERENCIA == ref);
        if (valMesAtual.length > 0) {
            valores.push(valMesAtual[0].QTD_TOTAL_PONTOS);
        } else {
            valores.push(0);
        }
    }
    new Chart(campo, {
        type: 'line',
        data: {
            labels: labelMeses,
            datasets: [{
                label: "Pontuação: ",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: valores,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value) + ' USTIBB';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + number_format(tooltipItem.yLabel, 1, ',', '.') + ' Pontos';
                    }
                }
            }
        }
    });
}

/*
 * Exemplo da chamada deste método criarAutoComplete('Login', 'getDsc', 'nmeUsuario', 'codUsuario')
 * Exemplo da estrutura do html
 *      <div class="mb-3 autocompleteBS">
 *          <input type="text" class="form-control" id="nmeUsuario">
 *      </div>
 *      <div class="d-nonx mt-2">
 *        <div class="mb-3">
 *          <input type="hidden" class="form-control" id="codUsuario">
 *        </div>
 *      </div> 
 * Precisa importar o css e o js 
 *   <link href="Resources/autocompleteBS-main/css/autocompleteBS.css" rel="stylesheet">
 *   <script src="Resources/autocompleteBS-main/js/autocompleteBS.js"></script> 
 */
function criarAutoComplete(controller, method, campo, hidden) {
    const autoCompleteConfig = [{
        name: 'AutoComplete',
        debounceMS: 250,
        minLength: 2,
        maxResults: 10,
        inputSource: document.getElementById(campo),
        targetID: document.getElementById(hidden),
        fetchURL: "http://localhost/sorc/Dispatch.php?controller=" + controller + "&method=" + method + "&termo={term}",
        fetchMap: { id: "value", name: "text" }
    }
    ];

    autocompleteBS(autoCompleteConfig);
}

function isValidCPF(cpf) {
    if (typeof cpf !== "string") return false
    cpf = cpf.replace(/[\s.-]*/igm, '')
    if (
        !cpf ||
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999"
    ) {
        return false
    }
    var soma = 0
    var resto
    for (var i = 1; i <= 9; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11)) resto = 0
    if (resto != parseInt(cpf.substring(9, 10))) return false
    soma = 0
    for (var i = 1; i <= 10; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11)) resto = 0
    if (resto != parseInt(cpf.substring(10, 11))) return false
    return true
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
