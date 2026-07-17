<?php

require_once __DIR__.'/../hash_maps/TabelaHash.php';

class Conjunto
{
    private TabelaHash $armazenamento;
    private array $elementosUnicos; // Array auxiliar para o rastreio fácil dos itens do set

    public function __construct(int $capacidadeMaxima = 50)
    {
        // Inicializa a tabela hash interna
        $this->armazenamento = new TabelaHash($capacidadeMaxima);
        $this->elementosUnicos = [];
    }

    /**
     * Adiciona um elemento ao conjunto.
     * Retorna TRUE se o elemento foi adicionado, ou FALSE se já existia.
     */
    public function adicionar(string $elemento): bool
    {
        if($this->armazenamento->buscar($elemento) === null){
            $this->armazenamento->inserir($elemento, 1);
            $this->elementosUnicos[] = $elemento;
            return true;
        }

        return false;
    }

    /**
     * Verifica se o elemento pertence ao conjuto
     */
    public function contem(string $elemento): bool
    {
        if($this->armazenamento->buscar($elemento) === null){
            return false;
        }
        return true;
    }

    /**
     * Remove um elemento do conjunto.
     * Retorna TRUE se removeu, ou FALSE se o elemento não existia.
     */
    public function remover(string $elemento): bool
    {
        // Tente deletar da TabelaHash
        if($this->armazenamento->deletar($elemento)){
            // Remove do array auxiliar usando foreach para achar a chave
            foreach($this->elementosUnicos as $chave => $valor){
                if($valor === $elemento){
                    unset($this->elementosUnicos[$chave]);
                    break;
                }
            }

            // Reconstrói o array para não deixar buracos
            $novoArrayAuxiliar = [];
            foreach($this->elementosUnicos as $valor){
                $novoArrayAuxiliar[] = $valor;
            }

            $this->elementosUnicos = $novoArrayAuxiliar;

            return true;

        }
        return false;
    }

    /**
     * Retorna todos os elementos do conjunto.
     */
    public function obterElementos(): array
    {
        return $this->elementosUnicos;
    }

    /**
     * Retorna um novo Conjunto contendo a união deste conjunto com outro.
     */
    public function uniao(Conjunto $outro): Conjunto
    {
        $novoConjunto = new Conjunto();

        // Adiciona todos os elementos deste conjunto ($this) no $novoConjunto
        foreach($this->obterElementos() as $elemento){
            $novoConjunto->adicionar($elemento);
        }

        // Adiciona todos os elementos do $outro conjunto no $novoConjunto
        foreach($outro->obterElementos() as $elemento){
            $novoConjunto->adicionar($elemento);
        }

        return $novoConjunto;
    }

    /**
     * Retorna um novo Conjunto contendo apenas os elementos que existem em ambos.
     */
    public function intersecao(Conjunto $outro): Conjunto
    {
        $novoConjunto = new Conjunto();

        // Percorre os elementos deste ($this) conjunto
        foreach($this->obterElementos() as $elemento){
            // Se o $outro conjunto também 'contem' o elemento, adiciona-o ao $novoConjunto
            if( $outro->contem($elemento )){
                $novoConjunto->adicionar($elemento);
            }
        }

        return $novoConjunto;
    }

    /**
     * Retorna um novo Conjunto contendo os elementos que existem apenas neste,
     * mas NÃO existem no outro. 
     * 
     * Ex.: 
     * A = [1, 2, 3]; 
     * B = [1, 5, 7];
     * 
     * A - B = [2,3] Todos que tem em A e não tem em B
     * 
     * B - A = [5,7] Todos que tem em B e não tem em A
     */
    public function diferenca(Conjunto $outro): Conjunto
    {
        $novoConjunto = new Conjunto();

        // Percorra os elementos deste conjunto ($this)
        foreach($this->obterElementos() as $elemento){
            // Se o $outro conjunto NÃO 'contem' o elemento, adiciona-o ao $novoConjunto
            if( ! $outro->contem($elemento)){
                $novoConjunto->adicionar($elemento);
            }
        }

        return $novoConjunto;
    }
}