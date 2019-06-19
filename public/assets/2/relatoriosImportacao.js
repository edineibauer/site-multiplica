function gerarRelatorio() {
    let start = $("#startdate").val();
    let end = $("#enddate").val();

    post("site-multiplica", "relatoriosImportacao", {datestart: start, dateend: end}, function (data) {
        $("#table-relatorio").html(data);
    });
}
gerarRelatorio();

function downloadRelatorio() {
    let start = $("#startdate").val();
    let end = $("#enddate").val();

    post("site-multiplica", "relatoriosImportacaoDownload", {datestart: start, dateend: end}, function (data) {
        $("#table-relatorio").html(data);
        window.location.href = HOME + 'relatorio-importacao-clientes.xlsx';
    });
}