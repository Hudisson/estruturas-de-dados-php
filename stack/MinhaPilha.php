 <?php

/**
 * Estrutura de dados Pilha (LIFO - Last In, First Out).
 */
class MinhaPilha
{
    private array $itens = [];
    private int $topo = -1; // -1 indica que a pilha está vazia

    /**
     * Insere um elemento no topo da pilha.
     */
    public function push(mixed $elemento): void
    {
        $this->topo++;
        $this->itens[$this->topo] = $elemento;
    }

    /**
     * Remove e retorna o elemento do topo da pilha.
     */
    public function pop(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }

        $elemento = $this->itens[$this->topo];
        unset($this->itens[$this->topo]);
        $this->topo--;

        return $elemento;
    }

    /**
     * Retorna o elemento do topo sem o remover.
     */
    public function peek(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->itens[$this->topo];
    }

    /**
     * Verifica se a pilha está vazia.
     */
    public function isEmpty(): bool
    {
        return $this->topo === -1;
    }
}