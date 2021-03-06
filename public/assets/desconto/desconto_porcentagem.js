$(function () {
    function setDesconto() {
        let particular = parseFloat($(".valor-or-particular").find("input").val());
        if (particular > 0) {
            let diferenca = particular - parseFloat($(".valor-or-desconto").find("input").val());
            if (diferenca > 0) {
                let valorDesconto = parseInt((diferenca * 100) / particular);
                if (valorDesconto > 0)
                    $(".desconto-or-valor").find("input").val(valorDesconto).trigger("input");
            }
        }
    }
    function setValorMultiplica() {
        let particular = parseFloat($(".valor-or-particular").find("input").val());
        if (particular > 0) {
            let valorMultiplica = particular - (particular * (parseFloat($(".desconto-or-valor").find("input").val()) / 100));

            if (valorMultiplica > 0)
                $(".valor-or-desconto").find("input").val(valorMultiplica.toFixed(2)).trigger("input");
        }
    }

    $(".desconto-or-valor").off("keyup change", "input").on("keyup change", "input", function () {
        setValorMultiplica();
    });
    $(".valor-or-desconto").off("keyup change", "input").on("keyup change", "input", function () {
        setDesconto();
    });
    $(".valor-or-particular").off("keyup change", "input").on("keyup change", "input", function () {
        if($(".desconto-or-valor").find("input").val() !== "")
            setValorMultiplica();
        else if($(".valor-or-desconto").find("input").val() !== "")
            setDesconto();
    });
});