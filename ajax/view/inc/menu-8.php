<div class="col padding-medium">
    <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off" onclick="createFuncionario()">
        <i class="font-xxxlarge material-icons">people</i>
        <span class="font-large col">Cadastrar Funcionário</span>
    </div>
</div>

<script>

    function mainLoading() {
        $(".main").loading();
        hide_sidebar_small();
        closeSidebar();
    }
    function createFuncionario() {
        mainLoading();
        get('5/create/funcionario', function (data) {
            $("#dashboard").html(data.content)
        })
    }
</script>