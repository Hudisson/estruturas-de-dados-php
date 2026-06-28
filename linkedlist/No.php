<?php 

/**
 * Classe que representa elemento na memória
 */

class No
{
    public mixed $valor;
    public ?No $proximo = null;

    public function __construct(mixed $valor)
    {
        $this->valor = $valor;
    }
}