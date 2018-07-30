<?php

define("DEVHOME", HOME . (DOMINIO === "site-multiplica" ? "" : VENDOR . "site-multiplica/"));

$data['data'] = [
    "header-container" => [],
    "parallax" => [
        "style" => ["background-image" => "url('" . DEVHOME . "assets/img/back.jpg')"]
    ],
    "header-h1" => [
        "text" => "Mais que Benefícios, um Estilo de Vida"
    ],
    "sub-header" => [
        "text" => "Venha Fazer Parte dessa Família"
    ],
    "sub-tag" => [
        "text" => "Receba desconto Exclusívos em diversos estabelecimentos e receba cashback em supermercados, farmácias, dentistas, postos de gasolina, onde você for!"
    ],
    "sub-img" => [
        "attr" => [
            "src" => DEVHOME . "assets/img/people.jpg"
        ]
    ],
    "tec-img" => [
        "attr" => [
            "src" => DEVHOME . "assets/img/coffe.png"
        ]
    ],
    "tec-header" => [
        "text" => "Chega de Fazer do 'Geito' Errado!"
    ],
    "tec-tag" => [
        "text" => "Desenvolva como as grandes empresas desenvolvem:<br>* Controle de Versão<br>* Integração Contínua<br>* Metadados<br>* Crud Generation<br>* PWA - Progressive Web App<br>* ElasticSearch - Search Engine<br>* NOSQL - Orientado a Objetos"
    ],
    "mvc-img" => [
        "attr" => [
            "src" => DEVHOME . "assets/img/mvc.png"
        ]
    ],
    "mvc-header" => [
        "text" => "Cada um no seu Quadrado"
    ],
    "mvc-tag" => [
        "text" => "Nunca um conceito foi tão utilizado, chega de misturar as coisas,<br><b>front é front, back é back, PHP não é HTML!</b><br>MUSTACHE TEMPLATE *<br>PADRÃO JSON *<br>REST API *"
    ],
    "footer-img" => [
        "attr" => [
            "src" => DEVHOME . "assets/img/edinei.jpg"
        ]
    ],
    "footer-img-title" => [
        "text" => "Seja bem-vindo"
    ],
    "footer-img-tag" => [
        "text" => "me chamo Edinei J. Bauer, <br>Graduado em Ciência da Computação na UNESC, desenvolvedor a 8 anos, co-fundador sócio da Singular RA - Desenvolvimento de Softwares Web e Realidade Aumentada. "
    ],
    "footer-msg" => [
        "text" => "Vagas limitadas! Faça o pré-registro para Reservar sua Vaga"
    ],
    "footer-1" => [
        "text" => SITENAME
    ],
    "footer-2" => [
        "text" => "&copy; All Rights Reserved"
    ],
    "footer-3" => [
        "text" => date("Y")
    ]
];