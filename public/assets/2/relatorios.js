function gerarRelatorio() {
    let start = $("#startdate").val();
    let end = $("#enddate").val();

    post("site-multiplica", "relatorios", {datestart: start, dateend: end}, function (data) {
        $("#table-relatorio").html(data);
    });
}
gerarRelatorio();

function downloadRelatorio() {
    let start = $("#startdate").val();
    let end = $("#enddate").val();

    post("site-multiplica", "relatoriosDownload", {datestart: start, dateend: end}, function (data) {
        $("#table-relatorio").html(data);
        window.location.href = HOME + 'relatorio-propostas-pendentes.xlsx?v=' + Date.now();
    });
}