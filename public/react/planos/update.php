<?php

/*
 * Ativação e Desativação do Plano - Contato via email e telefone ao Cliente
 *
*/

if(empty($dados['numero_do_cartao'])) {

    //busca número de cartão para este cliente
    $read = new \ConnCrud\Read();
    $read->exeRead("planos", "WHERE numero_do_cartao IS NOT NULL ORDER BY numero_do_cartao DESC LIMIT 1");
    $numero_cartao_final = ($read->getResult() ? (int)str_replace('363932111234', '', $read->getResult()[0]['numero_do_cartao']) : 0) + 1;

    for($i = 0; $i < 20; $i++) {
        $numero_cartao = "363932111234" . str_pad(($numero_cartao_final + $i), 8, "0", STR_PAD_LEFT);
        $read->exeRead("planos", "WHERE numero_do_cartao = :nn", "nn={$numero_cartao}");
        if(!$read->getResult())
            $i = 20;
    }

    $up = new \ConnCrud\Update();
    $up->exeUpdate("planos", ['numero_do_cartao' => $numero_cartao], "WHERE id = :idc", "idc={$dados['id']}");
}


if ($dadosOld['status'] === 1 && $dados['status'] === 0) {
    //Plano foi desativado

    $read->exeRead("clientes", "WHERE plano = :up", "up={$dados['id']}");
    if ($read->getResult()) {
        $cliente = $read->getResult()[0];

        $d = new \Entity\Dicionario("clientes");
        $nome = !empty($d->getInfo()['title']) ? $dados[$d->search($d->getInfo()['title'])->getColumn()] : "";

        /* Email */
        if (!empty($d->getInfo()['email'])) {
            $emailDestinatario = $dados[$d->search($d->getInfo()['email'])->getColumn()];

            if (!empty($emailDestinatario)) {

                $emailEnvio = new \Entity\Dicionario('email_envio');
                $emailEnvio->setData([
                    'email_destinatario' => $emailDestinatario,
                    'nome_destinatario' => !empty($nome) ? $nome : "",
                    'assunto' => "Atenção! Plano Desativado",
                    'mensagem' => "<p style='color:#FFFFFF'>Olá {$nome}, infelizmente o seu plano expirou e o sistema ainda não recebeu informações sobre reativação. Confira algumas das vantagens que você esta abrindo mão.</p>"
                        . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">"
                        . "DESCONTO de até 85% em Farmacias, Medicos e Dentistas, além de assistência Residencial, Automotiva e Juridica e ainda concorre a R$ 5.000,00"
                        . "</p>"
                        . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">Entre em contato: <b>(48) 3413-9329</b> ou contato@cartaomultiplica.com.br</p>"
                ]);
                $emailEnvio->save();
                if ($emailEnvio->getError())
                    $data['error'] = $emailEnvio->getError();
            }
        }

        /* Telefone */
        if (!empty($d->getInfo()['tel'])) {
            $dadosTel = [
                "celular" => $dados[$d->search($d->getInfo()['tel'])->getColumn()],
                "mensagem" => "Olá {$nome}, infelizmente o seu plano Multiplica expirou. Entre em contato para reativar: 48 3413-9329 ou contato@cartaomultiplica.com.br"
            ];

            $dicTel = new \Entity\Dicionario("smsiagente");
            $dicTel->setData($dadosTel);
            $dicTel->save();
        }
    }

} elseif ($dadosOld['status'] === 0 && $dados['status'] === 1) {
    //Plano foi reativado

    $read->exeRead("clientes", "WHERE plano = :up", "up={$dados['id']}");
    if ($read->getResult()) {
        $cliente = $read->getResult()[0];

        $d = new \Entity\Dicionario("clientes");
        $nome = !empty($d->getInfo()['title']) ? $dados[$d->search($d->getInfo()['title'])->getColumn()] : "";

        /* Email */
        if (!empty($d->getInfo()['email'])) {
            $emailDestinatario = $dados[$d->search($d->getInfo()['email'])->getColumn()];

            if (!empty($emailDestinatario)) {

                $emailEnvio = new \Entity\Dicionario('email_envio');
                $emailEnvio->setData([
                    'email_destinatario' => $emailDestinatario,
                    'nome_destinatario' => !empty($nome) ? $nome : "",
                    'assunto' => "Parabéns! Seu Plano foi Reativado!",
                    'mensagem' => "<p style='color:#FFFFFF'>Muito obrigado {$nome} por continuar fazendo parte da família Multiplica, Confira algumas das vantagens que você possui.</p>"
                        . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">"
                        . "DESCONTO de até 85% em Farmacias, Medicos e Dentistas, além de assistência Residencial, Automotiva e Juridica e ainda concorre a R$ 5.000,00"
                        . "</p>"
                        . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">Para saber todos os benefícios de seu plano, acesse o APP</p>"
                        . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">"
                        . "<a href=\"http://bit.ly/2qhm6la\"><img src=\"http://uebster.com/multiplica/public/assets/img/google-play-badge.svg\" width='135' height='40' style='width: 135px' alt=\"logo play store\"></a>"
                        . "<a href=\"#\"><img src=\"http://uebster.com/multiplica/public/assets/img/app-store-badge.svg\" width='135' height='40' style='width: 135px' alt=\"logo app store\"></a>"
                        . "</p>"
                ]);
                $emailEnvio->save();
                if ($emailEnvio->getError())
                    $data['error'] = $emailEnvio->getError();

            }
        }
    }
}