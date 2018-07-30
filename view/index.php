<?php

$data['data'] = [];
$data['data'][] = [
    "id" => "header-container",
    "template" => "col",
    "text" => [
        "id" => "parallax",
        "template" => "parallax",
        "style" => "height: 300px; background-size:contain; background-repeat:no-repeat;background-position: left top;",
        "class" => "padding-64 align-center",
        "text" => [
            "id" => "header-h1",
            "template" => "h1",
            "class" => "color-text-white text-shadow padding-64"
        ]
    ]
];

$data['data'][] = [
    "template" => "col",
    "class" => "color-white padding-large padding-64",
    "text" => [
        "id" => "sub-container",
        "template" => "container",
        "text" => [
            [
                "template" => "col",
                "class" => "s12 m7 align-right",
                "text" => [
                    [
                        "id" => "sub-header",
                        "template" => "h2",
                        "class" => "upper align-right"
                    ],
                    [
                        "id" => "sub-tag",
                        "template" => "col",
                        "class" => "color-text-grey font-light"
                    ]
                ]
            ],
            [
                "template" => "col",
                "class" => "s12 m5 padding-large",
                "text" => [
                    "id" => "sub-img",
                    "template" => "img",
                    "class" => "col",
                    "style" => "width:100%"
                ]
            ]

        ]
    ]
];

$data['data'][] = [
    "template" => "col",
    "class" => "padding-16 color-black",
    "text" => [
        "template" => "container_large",
        "text" => [
            [
                "id" => "footer-1",
                "template" => "col",
                "class" => "s12 m4",
            ],
            [
                "id" => "footer-2",
                "template" => "col",
                "class" => "s12 m4 align-center",
            ],
            [
                "id" => "footer-3",
                "template" => "col",
                "class" => "s12 m4 align-right",
            ]
        ]
    ]
];