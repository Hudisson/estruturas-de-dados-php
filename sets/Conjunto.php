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
}