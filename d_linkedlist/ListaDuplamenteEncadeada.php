<?php

/**
 *  Classe responsável por gerenciar os NÓS. Ela só precisa saber onde a lista começa ($cabeca)
 *  e onde termina ($cauda).
 */

require_once 'NoDuplo.php';

class ListaDuplamenteEncadeada
{
    private ?NoDuplo $cabeca = null; // Guara o início da lista
    private ?NoDuplo $cauda = null; // Gurada o fim da lista | ajuda a inserir no final instantaneamente

    /**
     * Método reponsável por inserir um valor no final da lista
     */
    public function adicionarNoFim(mixed $valor): void
    {
        $novoNo = new NoDuplo($valor); // Cria um novo nó

        // Se a lista estiver vazia. O novoNo passa a ser o primeiro (cabeça) e o último (cauda)
        if($this->cabeca === null){
            $this->cabeca = $novoNo;
            $this->cauda = $novoNo;
            return;
        }

        # Se a lista não estiver vazia ( já tem elemento(s) )

        // O próximo da cauda atual é o novoNo
        $this->cauda->proximo = $novoNo;

        // o anterior do novoNo é a cauda atual
        $novoNo->anterior = $this->cauda;

        // Atualiza a cauda da lista para ser o novoNo
        $this->cauda = $novoNo;
    }

    /**
     * Método reponsável por inserir um valor no início da lista
     */
    public function adicionarNoInicio(mixed $valor): void
    {
        $novoNo = new NoDuplo($valor); // Cria um novo nó

        // Se a lista estiver vazia. O novoNo passa a ser o primeiro (cabeça) e o último (cauda)
        if($this->cabeca === null){
            $this->cabeca = $novoNo;
            $this->cauda = $novoNo;
            return;
        }

        # Se a lista não estiver vazia ( já tem elemento(s) )

        // O próximo do novo nó é a atual cabeça
        $novoNo->proximo = $this->cabeca;

        // o anteriot da atual cabeça é o novo nó
        $this->cabeca->anterior = $novoNo;

        // Atualizar a cabeça da lista para ser o novo nó
        $this->cabeca = $novoNo;

    }

    /**
     * Metodo para busca um elemento na lista
     */
    public function buscar(mixed $valor): mixed
    {
        $atualInicio = $this->cabeca;
        $atualFim = $this->cauda;

        // Se a lista estiver vazia
        if($atualInicio === null){
            return null;
        }
        
        while($atualInicio !== null && $atualFim !== null){

            //verificar se o ponteiro do início achou o valor
            if($atualInicio->valor === $valor){
                return $atualInicio;
            }

            //verificar se o ponteiro do fim achou o valor
            if($atualFim->valor === $valor){
                return $atualFim;
            }

            // Condição de parada: os ponteiros se encontraram ou se cruzaram no meio
            if($atualInicio === $atualFim || $atualInicio->proximo === $atualFim){
                break;
            }

            // Move os ponteiro em direção ao centro da lista
            $atualInicio = $atualInicio->proximo;
            $atualFim = $atualFim->anterior;
        }

        return null; // O elemento procurado não existe na lista
    }

    /**
     * Remove elementos pelo início da lista
     */
    public function removerPeloInicio(mixed $valor): bool
    {
        // verifica se a lista está vazia
        if($this->isEmpty()){
            return false; // Se a lista estiver vazia, não há o que remover
        }

        // Se o valor/elemento procurado estiver no início da lista
        if($this->cabeca->valor === $valor){
            $this->cabeca = $this->cabeca->proximo; // Aponta a cabeça para o próximo item da lista

            if($this->cabeca !== null){
                $this->cabeca->anterior = null; // A nova cabeça não tem ninguém antes
            } else {
                $this->cauda = null; // Se a lista ficou vazia, limpa a cauda também
            }

            return true; // Removido com sucesso
        }

        # Se o Se o valor/elemento procurado estiver no meio ou no final da lista
        
        $atual = $this->cabeca;

        // caminha pela lista procurando o valor
        while($atual !== null){

            // Se existir um próximo nó e o valor dele for o procurado
            if($atual->proximo !== null && $atual->proximo->valor === $valor){
                // Guarda o nó que será removido 
                $noParaRemover = $atual->proximo;

                // O nó atual pula o nó a ser removido e aponta para direita ( para o próximo nó após o nó a ser removido )
                $atual->proximo = $noParaRemover->proximo;

                // ajusta o ponteiro de quem ficou na frente ( se houver )
                if($atual->proximo !== null){
                    // O nó da frente aponta para a esquerda ( para o no $atual )
                    $atual->proximo->anterior = $atual;
                } else {
                    // Se não há ninguém na frente, sugnifica que o nó a ser removido '$noParaRemover' era o último
                    // Então o $atula passa a ser a nova cauda da lista
                    $this->cauda = $atual;
                }

                return true; // Removido com sucesso
            }
          
            $atual = $atual->proximo; // Avança para o próximo nó

        }

        return false; // O valor buscado não foi encontrado da lista, portanto, não há o que remover
    }

    /**
     * Remove elementos pelo fim da lista
     */
    public function removerPeloFim(mixed $valor): bool
    {
        // verifica se a lista está vazia
        if($this->isEmpty()){
            return false; // Se a lista estiver vazia, não há o que remover
        }

        // Se o valor/elemento procurado estiver no fim da lista
        if($this->cauda->valor === $valor){
            $this->cauda = $this->cauda->anterior; // Aponta a cauda para o nó anterior

            if($this->cauda !== null){
                $this->cauda->proximo = null; // A nova cauda não tem ninguém depois dela
            } else {
                $this->cabeca = null; // Se a lista ficou vazia, limpa a cabeça também
            }

            return true; // Removido com sucesso
        }

        # Se o valor/elemento procurado estiver no meio ou no final da lista ( busque de trás para frente)

        $atual = $this->cauda;

        while( $atual !== null){
            // Se o nó anterior ao atual for o procurado
            if($atual->anterior !== null && $atual->anterior->valor === $valor){
                $noParaRemover = $atual->anterior;

                // O atual aponta para o nó a esquerda após o $noParaRemover
                $atual->anterior = $noParaRemover->anterior;

                // ajustamos o ponteiro direito de quem ficou atrás
                if($atual->anterior !== null){
                    // Se existe alguém atrás, faz o 'proximo' dele apontar para o $atual
                    $atual->anterior->proximo = $atual;
                } else {
                    // Se não há ninguém atrás, significa que foi removido o primeiro (cabeca)
                    // Então o $atual passa a ser a nova cabeça da lista
                    $this->cabeca = $atual;
                }

                return true; // Removido com sucesso!

            }

            $atual = $atual->anterior; // Move para o nó anterior (andando de ré)
        }
    
        return false; // O valor buscado não foi encontrado da lista, portanto, não há o que remover
    }
 
    /**
     * Exibe os elementos do início até o fim 
     */
    public function imprimir(): void
    {
        // verifica se a lista está vazia
        if($this->isEmpty()){
            echo "A lista está vazia\n";
            return;
        }

        $atual = $this->cabeca;

        // Enquanto o nó atual não for nulo, imprimima e avançe.
        while($atual !== null){
            echo "[ ".$atual->valor . " ]; ";
            $atual = $atual->proximo;
        }

        echo "\n";
    }

    /**
     * Exibe os elementos do fim para o começo (de trás para frente)
     */
    public function imprimirInverso(): void
    {
        // verifica se a lista está vazia
        if($this->isEmpty()){
            echo "A lista está vazia\n";
            return;
        }

        $atual = $this->cauda;

        while($atual !== null){
            echo "[ ".$atual->valor . " ]; ";
            $atual = $atual->anterior;
        }

        echo "\n";

    }

    /**
     * Método que verifica se a lista está vazia
     */
    public function isEmpty(): bool
    {
       return $this->cabeca === null;
    }
}
