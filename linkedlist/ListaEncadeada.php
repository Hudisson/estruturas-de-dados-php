<?php 

require_once 'No.php';

class ListaEncadeada
{
    private ?No $cabeca = null; // Primeiro Nó da lista

    /**
     * Método para adicionar um elemento no final da lista
     */
    public function adicionar(mixed $valor):void
    {
        $novoNo = new No($valor);

        // Se a lista estiver vazia, o novo nó se torna a cabeça
        if($this->cabeca === null){
            $this->cabeca = $novoNo;
            return;
        }

        // Ponteiro auxiliar começando na cabeça
        $atual = $this->cabeca;

       /**
        *  Enquanto o nó atual tiver um "próximo", anvaçe.
        *  O laço para exatamente quando encontrar o último nó (cujo próximo é null).
        */
        while($atual->proximo !== null){
            $atual = $atual->proximo;
        }

        // Ao chegar ao último nó, guarde o elemento novo nele
        $atual->proximo = $novoNo;
    }

    /**
     * Remove um elemento da lista
     */
    public function remover(mixed $valor): bool
    {
        // Se a lista estiver vazia
        if($this->cabeca === null){
            return false; 
        }

        // Se o elemento estiver no início da lista
        if($this->cabeca->valor === $valor){
            $this->cabeca = $this->cabeca->proximo;
            return true; // Remoção feita com sucesso
        }

        # Se o elemento estiver no meio o no fim da lsita

        $atual = $this->cabeca;

        // Verique os elementos da lista até encontrar
        while($atual->proximo !== null){

            // se o próximo nó for o procurado
            if($atual->proximo->valor === $valor){

                // O nó atual "pula" o próximo e aponta direto para o "próximo do próximo"
                $atual->proximo = $atual->proximo->proximo;
                return true; // Remoção feita com sucesso
            }

            // Continua verificado na lista enquanto não encontrar até chegar oa fim da lista
            $atual = $atual->proximo;
        }

        return false; // O elemento não foi encontrado na lista.
    }

    /**
     *  Método que exibe todos os elemento da lista em ordem
     */
    public function imprimir(): void
    {
        // Se a lista estiver zavia
        if($this->cabeca === null){
            echo "A lista está vazia\n";
            return;
        }

        $atual = $this->cabeca;

        // Enquanto o nó atual não for nulo, imprimima e avançe.
        while($atual !== null){
            echo $atual->valor . " -> ";
            $atual = $atual->proximo;
        }

        echo "null\n"; // indica visualmente o fim da lista

    }
}