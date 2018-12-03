<div class="container">
    <div class="container-600 padding-64 align-center">
        <div class="col right padding-top" style="width: 200px">
            <button class="btn color-white btn-floating right" id="clear-cpf" style="margin-top: -2px;">
                <i class="material-icons left padding-right">undo</i>
                <span class="left"></span>
            </button>
            <button class="btn theme right" id="search-cpf">
                <i class="material-icons left padding-right">search</i>
                <span class="left">Consultar</span>
            </button>
        </div>
        <div class="rest">
            <input type="text" class="container padding-small font-xlarge" id="consulta-cpf"
                   placeholder="digite um CPF..."/>
        </div>

        <div class="container padding-32">
            <div class="container-900 align-center">
                <p id="response"></p>
            </div>
        </div>
    </div>
</div>

<script src="<?= HOME . VENDOR ?>site-multiplica/public/assets/mask.js"></script>
<script>
    $(function () {
        $("#consulta-cpf").mask('999.999.999-99', {reverse: true});

        $("#clear-cpf").off("click").on("click", function () {
            $("#consulta-cpf").val("").focus();
        });

        $("#search-cpf").off("click").on("click", function () {
            let cpf = $("#consulta-cpf").cleanVal();
            if (cpf.length === 11) {
                post('site-multiplica', 'read/consulta-cpf', {cpf: cpf}, function (g) {
                    $("#consulta-cpf").val("").focus();
                    let mensagem = "<span class='col padding-16 font-xlarge radius border toast-error'>CPF não Existe!</span>";

                    if (g === 1)
                        mensagem = "<span class='col padding-16 font-xlarge radius border toast-success'>Cliente Ativo!</span>";
                    else if (g === 2)
                        mensagem = "<span class='col padding-16 font-xlarge radius border toast-warning'>Cliente Inativo!</span>";

                    $("#response").html(mensagem);
                });
            } else {
                $("#response").html("<span class='col padding-16 font-xlarge radius border toast-warning'>Informe um CPF!</span>");
            }
        });
    });
</script>