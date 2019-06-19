<div class="col padding-32">
    <div class="col container-1200">
        <div class="right relative padding-xlarge padding-right padding-left">
            <div class="right">
                <button onclick="downloadRelatorio()" class="btn btn-primary float-right radius opacity hover-opacity-off hover-shadow padding-medium">
                    <i class="material-icons left padding-right">get_app</i>
                    <div class="left padding-tiny">Baixar Relatório</div>
                </button>
            </div>
            <div class="right">
                <button onclick="gerarRelatorio()" id="ttt" class="btn btn-primary float-right radius opacity hover-opacity-off hover-shadow padding-medium">
                    <i class="material-icons left padding-right">archive</i>
                    <div class="left padding-tiny">Gerar</div>
                </button>
            </div>
        </div>
        <div class="right padding-medium relative">
            <label class="col">
                <span class="col">até</span>
                <input type="date" id="enddate"/>
                <span class="input-bar"></span>
            </label>
        </div>
        <div class="right padding-medium relative">
            <label class="col">
                <span class="col">de</span>
                <input type="date" id="startdate"/>
                <span class="input-bar"></span>
            </label>
        </div>
        <div class="right relative" style="padding-top: 32px;padding-right: 20px;font-weight: 600;color: #666;">
            Data de Cadastro
        </div>

        <div class="col" id="table-relatorio"></div>
    </div>
</div>