<?php

/**
 * Explicação sobre a estrutura de Grafos.
 * 
 * Um grafo é composto por dois elementos principais:
 * - Vértice (Vertex / Nó): Representa a entidade (ex: uma pessoa, uma página ou um perfil em uma rede social).
 * - Aresta (Edge / Conexão): Representa o relacionamento entre dois vértices (ex: amizade, conexão ou seguimento).
 * 
 *Tipos Principais no contexto de Redes Sociais:
 * - Não-Direcionado: A conexão é mútua e de mão dupla. 
 *   Exemplo clássico: Amizade no Facebook ou conexões no LinkedIn (quando aceitas), onde se A é conectado a B, B é automaticamente conectado a A.
 * - Direcionado (Digrafo): A conexão possui um sentido específico (unidirecional). 
 *   Exemplo clássico: Seguir alguém no Instagram, TikTok ou X (antigo Twitter), onde o usuário A segue o usuário B, mas B não 
 *   é obrigado a seguir de volta.
 */

require_once __DIR__.'/../queue/MinhaFila.php';

class Grafo
{
    // Lista de Adjacência: chave = Vértice, valor = Array de vizinhos
    private array $listaAdjacencia;
    private bool $direcionado;

    public function __construct(bool $direcionado = false)
    {
        $this->listaAdjacencia = [];
        $this->direcionado = $direcionado;
    }

    /**
     * Adiciona um novo vértice ao grafo (se ainda não existir)
     */
    public function adicionarVertice(mixed $vertice): void
    {
        if(!isset($this->listaAdjacencia[$vertice])){
            $this->listaAdjacencia[$vertice] = [];
        }
    }

    /**
     * Cria uma aresta (conexão) entre dois vértices.
     */
    public function adicionarAresta(mixed $origem, mixed $destino): void
    {
        // Garante que ambos os vértices existam no grafo.
        $this->adicionarVertice($origem);
        $this->adicionarVertice($destino);

        // Adiciona $destino na lista de vizinhos de $origem.
        $this->listaAdjacencia[$origem][] = $destino;

        // Se o grafo não for direcionado, a conexão é de mão dupla.
        if(!$this->direcionado){
            $this->listaAdjacencia[$destino][] = $origem;
        }
    }

    /**
     * Exibe a representação visual da Lista de Adjacência no terminal.
     */
    public function exibir(): void
    {
        foreach ($this->listaAdjacencia as $vertice => $vizinhos) {
            echo "[" . $vertice . "] -> ";
            
            $primeiro = true;
            foreach ($vizinhos as $vizinho) {
                if (!$primeiro) {
                    echo ", ";
                }
                echo $vizinho;
                $primeiro = false;
            }

            echo "\n";
        }
    }

    /**
     * Algoritimo BFS (Breadth-First Search) Busca em Largura orientada a objeto reutilizando a classe MinhaFila.
     * Estrutura interna: Usa uma Fila (Queue - FIFO).
     */
    public function bfs(mixed $verticeInicio): array
    {
        // Se o vértice inicial não existir no grafo, retorna um array vazio.
        if(!isset($this->listaAdjacencia[$verticeInicio])){
            return [];
        }

        $visitados = [];
        $resultado = [];

        // Instanciando um objeto da classe MinhaFila
        $fila = new MinhaFila();

        // Inicialização
        $visitados[$verticeInicio] = true;
        $fila->enqueue($verticeInicio);

        // Enquanto a fila não estiver vazia
        while(!$fila->isEmpty()){
            // Desenfileira o próximo da Fila (FIFO).
            $atual = $fila->dequeue();
            $resultado[] = $atual;

            // Explora os vizinhos
            foreach($this->listaAdjacencia[$atual] as $vizinho){
                // Se o $vizinho ainda não foi visitado
                if(!isset($visitados[$vizinho])){
                    $visitados[$vizinho] = true; // Visita o $vizinho
                    $fila->enqueue($vizinho);   // adiciona o $vizinho visitado na fila
                }
            }
        }

        return $resultado;
    }

}