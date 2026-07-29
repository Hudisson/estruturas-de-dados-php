<?php

class NoArvore
{
    public mixed $valor;
    public ?NoArvore $esquerda;
    public ?NoArvore $direita;

    public function __construct(mixed $valor)
    {
        $this->valor = $valor;
        $this->esquerda = null;
        $this->direita = null;
    }
}