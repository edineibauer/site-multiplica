function searchUsuario() {
    let cpf = $("#novo_usuario_cpf").cleanVal();
    if(cpf.length === 11) {
        mainLoading();
        get("view/search-usuario/" + cpf, function (g) {
            if(g.content == "2"){
                toast("Permissão Negada", "error", 2000);
            } else {
                $("#dashboard").html(g.content);
                setTimeout(function () {
                    $("input[data-model='dados.nome_completo']").focus();
                }, 10);
            }
        });
    } else {
        toast("Por Favor, informe um CPF!");
    }
}

function desativarUsuario(id) {
    post("site-multiplica", '5/update/desativa_usuario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Usuário Desativado", 2000);
            },10);
            goUsuarios();
        } else {
            toast("Permissão Negada", "error", 2000);
        }
    });
}

function ativarUsuario(id) {
    post("site-multiplica", '5/update/ativa_usuario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Usuário Ativado", 2000);
            },10);
            goUsuarios();
        } else {
            toast("Permissão Negada", "error", 2000);
        }
    });
}

function removerUsuario(id) {
    post("site-multiplica", '5/update/remove_usuario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Usuário Removido", 2000);
            },10);
            goUsuarios();
        } else {
            toast("Permissão Negada", "error", 2000);
        }
    });
}

function goUsuarios() {
    mainLoading();
    $("#usuarios_list").trigger("click");
}

function addUsuario() {
    mainLoading();
    get('view/add-usuario', function (g) {
        $("#dashboard").html(g.content);
        $("#novo_usuario_cpf").mask('999.999.999-99', {reverse: !0}).focus().off("keyup").on("keyup", function (e) {
            if(e.keyCode === 13)
                searchUsuario();
        });

        $("#novo_usuario_btn").off("click").on("click", function () {
            searchUsuario();
        });
    });
}

function addUsuarioCriado(dados) {
    addUsuarioExistente(dados['dados.id'])
}

function addUsuarioExistente(id) {
    post("site-multiplica", '5/update/vincula_usuario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Usuário Vinculado", 2000);
            },10);
            goUsuarios();
        }
    });
}