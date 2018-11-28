$(function () {
    /* Especialista Desconto Calculo*/

    function applyDesconto(action) {
        let $d = $("input[data-model='dados.desconto']");
        let $p = $("input[data-model='dados.valor_particular']");
        let $m = $("input[data-model='dados.valor_multiplica']");

        let p = parseFloat($p.val().replace(".", "").replace(",", "."));
        let d = parseFloat($d.val().replace(".", "").replace(",", "."));
        let m = parseFloat($m.val().replace(".", "").replace(",", "."));

        if(action === 'p') {
            if(d > 0) {
                $m.val((p - ((p * d) / 100)).toFixed(2)).trigger("input");
            } else if(m > 0) {
                $d.val((100 - ((m * 100) / p)).toFixed(2)).trigger("input");
            }
        } else if(action === 'd') {
            if(p > 0) {
                $m.val((p - ((p * d) / 100)).toFixed(2)).trigger("input");
            } else if(m > 0) {
                $p.val(((m * 100) / d).toFixed(2)).trigger("input");
            }
        } else {
            if (d > 0) {
                $p.val(((m * 100) / d).toFixed(2)).trigger("input");
            } else if (p > 0) {
                $d.val((100 - ((m * 100) / p)).toFixed(2)).trigger("input");
            }
        }
    }

    $("input[data-model='dados.desconto']").off("keyup change").on("keyup change", function () {
        applyDesconto('d');
    });
    $("input[data-model='dados.valor_particular']").off("keyup change").on("keyup change", function () {
        applyDesconto('p');
    });
    $("input[data-model='dados.valor_multiplica']").off("keyup change").on("keyup change", function () {
        applyDesconto('m');
    });
});