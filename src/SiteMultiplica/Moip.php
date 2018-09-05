<?php

use Moip\Moip;
use Moip\Auth\BasicAuth;

class Moips
{
    private $token;
    private $key;
    private $moip;
    private $cliente;
    private $pedido;
    private $endereco;
    private $cartao;

    /**
     * Moip constructor.
     * @param null $token
     * @param null $key
     */
    public function __construct($token = null, $key = null)
    {
        $this->cartao = new MoipCartao();
        $this->endereco = new MoipEndereco();
        $this->pedido = new MoipPedido();
        $this->cliente = new MoipCliente();

        if($token)
            $this->setToken($token);
        if($key)
            $this->setKey($key);
    }

    /**
     * @param string $key
     */
    public function setKey(string $key)
    {
        $this->key = $key;
        if($this->token)
            $this->start();
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
        if($this->key)
            $this->start();
    }

    private function start()
    {
        if($this->token && $this->key) {
            $this->moip = new Moip(new BasicAuth($this->token, $this->key), Moip::ENDPOINT_SANDBOX);
        }
    }
}