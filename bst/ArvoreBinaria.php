<?php

require_once __DIR__.'/NoArvore.php';

class ArvoreBinaria
{
    private ?NoArvore $raiz;

    public function __construct()
    {
       $this->raiz = null; // A árvore nasce vazia
    }

    // Método para inserir um valor na árvore.
    public function inserir(mixed $valor): void
    {
        // Se a árvore estiver vazia, o novo nó se torna a raiz
        if($this->raiz === null){
            $this->raiz = new NoArvore($valor);
            return;
        }

        // Caso contrário, usar o método recursivo para achar o lugar correto o novo valor
        $this->inserirRecursivo($this->raiz, $valor);
    }

    
    //Método auxiliar que navega recursivamente pela árvore
    private function inserirRecursivo(NoArvore $noAtual, mixed $valor): void
    {
        // Valores menores vão para a Esquerda
        if($valor < $noAtual->valor){
            if($noAtual->esquerda === null){
                // Achou a posição vaga
                $noAtual->esquerda = new NoArvore($valor);
            } else {
                // Caso contrário - continual descendo pela esquerda
                $this->inserirRecursivo($noAtual->esquerda, $valor);
            }
        }
        // Valores maiores vão para a Direita
        else if($valor > $noAtual->valor){
            if($noAtual->direita === null){
                $noAtual->direita = new NoArvore($valor);
            } else {
                // Caso contrário - continual descendo pela direita
                $this->inserirRecursivo($noAtual->direita, $valor);
            }

            // Se $valor === $noAtual->valor, simplesmente ignoramos para evitar duplicatas.
        }
    }

    // Método que exibe a estrutura da árvore visualmente no terminal
    public function exibir(): void
    {
        $this->exibirRecursivo($this->raiz, 0);
    }

    private function exibirRecursivo(?NoArvore $no, mixed $nivel): void
    {
        if($no === null){
            return;
        }
        // Imprime primeiro a subárvore direita (para ficar no topo do console)
        $this->exibirRecursivo($no->direita, $nivel + 1);

        // Imprime o nó atual com recuo
        for($i = 0; $i < $nivel; $i++){
            echo "   ";
        }
        echo "  ". $no->valor . "\n";

        // Imprime a subárvore esquerda
        $this->exibirRecursivo($no->esquerda, $nivel + 1);
    
    }

    /**
     * Verifica se um valor existe na árvore.
     * Retorna true se encontrar, ou false caso contrário.
     */
    public function buscar(mixed $valor): bool
    {
        return $this->buscarRecursivo($this->raiz, $valor);
    }

    private function buscarRecursivo(?NoArvore $noAtual, mixed $valor): bool
    {
        // O valor não existe na árvore
        if($noAtual === null){
            return false;
        }

        // Achou o valor
        if($valor === $noAtual->valor){
            return true;
        }

        // Decide para qual lado navegar
        if($valor < $noAtual->valor){
            return $this->buscarRecursivo($noAtual->esquerda, $valor);
        }

        return $this->buscarRecursivo($noAtual->direita, $valor);
    }

    // Travessias na Árvore (Percursos)

    /**
     * Percurso EM-ORDEM (In-Order)
     * Visita: Esquerda -> Raiz -> Direita
     * Resultado: Restorna os elementos em ordem crescente
     */
    public function emOrdem(): array
    {
        $resutado = [];
        $this->emOrdemRecursivo($this->raiz, $resutado);
        return $resutado;
    }

    private function emOrdemRecursivo(?NoArvore $no, array &$resutado): void
    {
        if($no !== null){
            $this->emOrdemRecursivo($no->esquerda, $resutado);
            $resutado[] = $no->valor; // Processa a Raiz
            $this->emOrdemRecursivo($no->direita, $resutado);
        }
    }

    /**
     * Percurso PRÉ-ORDEM (Pre-Order)
     * Visita: Raiz -> Esquerda -> Direita
     */
    public function preOrdem(): array
    {
        $resutado = [];
        $this->preOrdemRecursivo($this->raiz, $resutado);
        return $resutado;
    }

    private function preOrdemRecursivo(?NoArvore $no, array &$resultado): void
    {
        if($no !== null){
            $resultado[] = $no->valor; // Processa a Raiz primeiro
            $this->preOrdemRecursivo($no->esquerda, $resultado);
            $this->preOrdemRecursivo($no->direita, $resultado);
        }
    }

    /**
     * Percurso PÓS-ORDEM (Post-Order)
     * Visita: Esquerda -> Direita -> Raiz
     */
    public function posOrdem(): array
    {
        $resultado = [];
        $this->posOrdemRecursivo($this->raiz, $resultado);
        return $resultado;
    }

    private function posOrdemRecursivo(?NoArvore $no, array &$resultado): void
    {
        if($no !== null){
            $this->posOrdemRecursivo($no->esquerda, $resultado);
            $this->posOrdemRecursivo($no->direita, $resultado);
            $resultado[] = $no->valor; // Processa a Raiz por último
        }
    }


}
