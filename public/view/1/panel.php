<?php

echo template(TPL_SECTION_LARGE, [
    "content" => template(TPL_COL_3, [
        "content" => [
            template(TPL_POST_CARD, [
                "class" => "color-hover-greyscale-off",
                "srcClass" => "color-greyscale-min color-hover-greyscale-off",
                "src" => HOME . "uploads/site/checklist.jpg",
                "title" => "Convênios",
                "content" => "lista de Convênios Ativos ",
                "href" => "relatorioConvenios",
                "hrefText" => "Obter Relatório",
                "click" => ""
            ]),
            template(TPL_POST_CARD, [
                "class" => "color-hover-greyscale-off",
                "srcClass" => "color-greyscale-min color-hover-greyscale-off",
                "src" => HOME . "uploads/site/static.jpg",
                "title" => "Pontos Multiplica",
                "content" => "lista de Pontos Multiplica a serem cobrados no próximo mês",
                "href" => "relatorioConvenios",
                "hrefText" => "Obter Relatório",
                "click" => ""
            ]),
            template(TPL_POST_CARD, [
                "class" => "color-hover-greyscale-off",
                "srcClass" => "color-greyscale-min color-hover-greyscale-off",
                "src" => HOME . "uploads/site/clock.jpg",
                "title" => "Pagamentos Atrasados",
                "content" => "Débidos pendêntes",
                "href" => "relatorioConvenios",
                "hrefText" => "Obter Relatório",
                "click" => ""
            ])
        ]
    ])
]);