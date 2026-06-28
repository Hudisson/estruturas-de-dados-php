<?php

/**
 * Classe que represnta o NÓ que irá guarda a informação
 */

class NoDuplo
{
    public mixed $valor; // Guarda o valor desejado no nó (pode ser um número, um texto, etc.)
    public ?NoDuplo $proximo = null; // Guarda o endereço do próximo nó
    public ?NoDuplo $anterior = null; // Guarda o endereço do nó que vem antes dele

    /**
     * Cria o nó guardando o o valor ali dentro.
     */
    public function __construct(mixed $valor)
    {
        $this->valor = $valor;
    }
}