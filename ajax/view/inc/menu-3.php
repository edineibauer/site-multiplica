<div class="col padding-medium">
    <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off" onclick="createCliente()">
        <i class="font-xxxlarge material-icons">people</i>
        <span class="font-large col">Cadastrar Cliente</span>
    </div>
    <div class="col menu-li align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off"
         data-atributo='produtos' data-lib="">
        <i class="font-xxxlarge material-icons">book</i>
        <span class="font-large col">Cadastrar Produtos</span>
    </div>
</div>

<script>
    function createCliente() {
        $(".main").loading();
        hide_sidebar_small();
        closeSidebar();
        get('convenio/create/cliente', function (data) {
            $("#dashboard").html(data.content)
        })
    }
    
    function novoClienteCallback(dados) {
        toast("Cliente Salvo!");
        createCliente();
    }
</script>