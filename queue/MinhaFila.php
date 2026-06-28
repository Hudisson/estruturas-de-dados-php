<?php

/**
 * Estrutura de dados Fila utilizando controle manual de ponteiros (FIFO).
 */
class MinhaFila
{
    private array $itens = [];
    private int $inicio = 0;
    private int $fim = 0;

    /**
     * Método para inserir no final da fila.
     */
    public function enqueue(mixed $elemento): void 
    {
        $this->itens[$this->fim] = $elemento;
        $this->fim++;
    }

    /**
     * Método que remove o primeiro elemento da fila, (o que chegou primeiro).
     */
    public function dequeue(): mixed
    {   
        // se a fila estiver vazia retorna null
        if ($this->isEmpty()) {
            return null;
        }

        // Guarda o primeiro elemento
        $elemento = $this->itens[$this->inicio];

        // Limpa a memoria liberando o indece que não será mais acessado
        unset($this->itens[$this->inicio]);

        // Incrementa o início para o próximo indice/elemento (a fila andou)
        $this->inicio++;

        return $elemento;
    }

    /**
     * Retorna o primeiro elemento da fila sem removê-lo.
     */
    public function front(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->itens[$this->inicio]; // Retorna o primeiro elemento que está no início da fila
    }

    /**
     * Verifica se a fila está vazia.
     */
    public function isEmpty(): bool
    {
        // Se o início for igual ao fim, então a fila está vazia
        return $this->inicio === $this->fim;
    }
}