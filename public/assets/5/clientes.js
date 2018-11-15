function searchUsuario() {
    let cpf = $("#novo_usuario_cpf").cleanVal();
    if(cpf.length === 11) {
        mainLoading();
        post("site-multiplica", "read/search-usuario", {cpf:cpf}, function (g) {
            if(g == "2"){
                toast("Permissão Negada", "error", 2000);
            } else {
                $("#dashboard").html(g);
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
    post("site-multiplica", 'update/desativa_usuario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Usuário Desativado", 2000, "toast-warning");
            },300);
            goUsuarios();
        } else {
            toast("Alterações permitidas somente entre os dias 1 e 4", "error", 2000, "toast-error");
        }
    });
}

function ativarUsuario(id) {
    post("site-multiplica", 'update/ativa_usuario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Usuário Ativado", 2000, "toast-success");
            }, 300);
            goUsuarios();
        } else if(g === 3) {
            toast("Usuário não existe", 2000, "toast-warning");
        } else {
            toast("Alterações permitidas somente entre os dias 1 e 4", 2000, "toast-error");
        }
    });
}

function removerUsuario(id) {
    if(confirm("Remover usuário de sua lista?")) {
        post("site-multiplica", 'update/remove_usuario', {id: id}, function (g) {
            if (g === 1) {
                setTimeout(function () {
                    toast("Usuário Removido", 2000, "toast-warning");
                }, 10);
                goUsuarios();
            } else {
                toast("Alterações permitidas somente entre os dias 1 e 4", 2000, "toast-error");
            }
        });
    }
}

function goUsuarios() {
    mainLoading();
    $("#usuarios_list").trigger("click");
}

function addUsuarioExistente(id) {
    post("site-multiplica", 'update/vincula_usuario', {id: id}, function (g) {
        if(g === 1) {
            setTimeout(function () {
                toast("Usuário Adicionado", 2000, "toast-success");
            },200);
            goUsuarios();
        } else if(g === 3) {
            toast("Usuário já possui plano ativo!", 3000, "toast-warning");
        } else if(g === 4) {
            toast("Usuário não existe", 2000, "toast-error");
        } else {
            toast("Alterações permitidas somente entre os dias 1 e 4", 2000, "toast-error");
        }
    });
}

function addUsuario() {
    mainLoading();
    get('novo-usuario', function (g) {
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