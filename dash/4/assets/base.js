var updateHist = null;
var $dash = $("#dashboard");

function mainLoading() {
    $(".main").loading();
    hide_sidebar_small();
    closeSidebar();
    clearInterval(updateHist);
}

function createCliente() {
    mainLoading();
    get('4/create/cliente', function (data) {
        $dash.html(data.content)
    })
}

function updateHistorico(dd, tt) {
    if (typeof (tt) === "undefined")
        toast("Pontos Aplicados");

    get('4/read/historico', function (data) {
        $dash.find("#credenciado-historico").html(data.content);
    });
}

function updateHistoricoDesconto(dd, tt) {
    if (typeof (tt) === "undefined")
        toast("Desconto Aplicados");

    $("#descontoTotal, #descontoRecebidoTotal").html("");

    get('4/read/descontoHistorico', function (data) {
        $dash.find("#credenciado-desconto-historico").html(data.content);
    });
}

function readMoreHistoryDesc() {
    /*var $ref = $dash.find("#credenciado-desconto-historico-ref").html("");
    var $hist = $dash.find("#credenciado-desconto-historico");
    $hist.loading();
    get('4/read/descontoHistoricoMore', function (data) {
        $ref.template(data.content.template, data.content, function (data) {
            $hist.html(data.content);
        });
    });*/
}

function createTransacao() {
    mainLoading();
    get('4/create/transacao', function (data) {
        $dash.html(data.content);
        updateHistorico(1, 1);
    });
}

function descontoServicos() {
    mainLoading();
    get('4/create/desconto', function (data) {
        console.log(data);
        $dash.html(data.content);
        updateHistoricoDesconto(1, 1);
    });
}

function novoClienteCallback(dados) {
    toast("Cliente Salvo!");
    createCliente();
}

$(function () {
    $dash.off("change", ".checkboxmult").on("change", ".checkboxmult", function () {
        let total = 0;
        let descontoTotal = 0;
        $(".checkboxmult").each(function () {
            if ($(this).is(":checked")) {
                let $div = $(this).siblings("div");
                total += parseFloat($div.find(".checkBoxDesconto").text());
                descontoTotal += parseFloat($div.find(".checkBoxValor").text()) - parseFloat($div.find(".checkBoxDesconto").text());
            }
        });
        $("#descontoTotal").html("R$" + total.toFixed(2));
        $("#descontoRecebidoTotal").html("Desconto de R$" + descontoTotal.toFixed(2));
    });
});

function searchFuncionario() {
    let cpf = $("#novo_funcionario_cpf").cleanVal();
    if(cpf.length === 11) {
        mainLoading();
        get("view/search-funcionario/" + cpf, function (g) {
            if(g.content == "2"){
                toast("Permissão Negada", "error", 2000);
            } else {
                $dash.html(g.content);
                setTimeout(function () {
                    $("input[data-model='dados.nome_completo']").focus();
                }, 10);
            }
        });
    } else {
        toast("Por Favor, informe um CPF!");
    }
}

function removerFuncionario(id) {
    post("site-multiplica", '4/update/remove_funcionario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Funcionário Removido", 2000);
            },10);
            goFuncionarios();
        } else {
            toast("Permissão Negada", "error", 2000);
        }
    });
}

function goFuncionarios() {
    mainLoading();
    $("#functionarios_list").trigger("click");
}

function addFuncionario() {
    mainLoading();
    get('view/add-funcionario', function (g) {
        $dash.html(g.content);
        $("#novo_funcionario_cpf").mask('999.999.999-99', {reverse: !0}).focus().off("keyup").on("keyup", function (e) {
            if(e.keyCode === 13)
                searchFuncionario();
        });

        $("#novo_funcionario_btn").off("click").on("click", function () {
            searchFuncionario();
        });
    });
}

function addFuncionarioCriado(dados) {
    addFuncionarioExistente(dados['dados.id'])
}

function addFuncionarioExistente(id) {
    post("site-multiplica", '4/update/vincula_funcionario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Funcionário Vinculado", 2000);
            },10);
            goFuncionarios();
        }
    });
}