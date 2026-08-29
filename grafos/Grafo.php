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

require_once __DIR__ . '/../queue/MinhaFila.php';
require_once __DIR__ . '/../stack/MinhaPilha.php';

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
        if (!isset($this->listaAdjacencia[$vertice])) {
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
        if (!$this->direcionado) {
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
        if (!isset($this->listaAdjacencia[$verticeInicio])) {
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
        while (!$fila->isEmpty()) {
            // Desenfileira o próximo da Fila (FIFO).
            $atual = $fila->dequeue();
            $resultado[] = $atual;

            // Explora os vizinhos
            foreach ($this->listaAdjacencia[$atual] as $vizinho) {
                // Se o $vizinho ainda não foi visitado
                if (!isset($visitados[$vizinho])) {
                    $visitados[$vizinho] = true; // Visita o $vizinho
                    $fila->enqueue($vizinho);   // adiciona o $vizinho visitado na fila
                }
            }
        }

        return $resultado;
    }

    /**
     * Encontra o caminho com o menor número de conexões (arestas) entre dois vértices.
     * Retorna um array com a rota [Origem, ..., Destino] ou [] se não houver caminho.
     */
    public function caminhoMaisCurto(mixed $origem, mixed $destino): array
    {
        // Se a origem ou o destino não existirem no grafo, não há caminho.
        if (!isset($this->listaAdjacencia[$origem]) || !isset($this->listaAdjacencia[$destino])) {
            return [];
        }

        // Se a origem for igual ao destino, o caminho é apenas ele mesmo.
        if ($origem === $destino) {
            return [$origem];
        }

        $visitados = [];
        $predecessores = []; // Guarda de quem o vértice veio: chave = filho, valor = pai
        $fila = new MinhaFila();

        // Inicialização
        $visitados[$origem] = true;
        $fila->enqueue($origem);

        $encontrou = false;

        while (!$fila->isEmpty()) {
            $atual = $fila->dequeue();

            // Se atingir o destino, encerra a busca.
            if ($atual === $destino) {
                $encontrou = true;
                break;
            }

            // Explora os vizinhos do vértice atual.
            foreach ($this->listaAdjacencia[$atual] as $vizinho) {
                if (!isset($visitados[$vizinho])) {
                    $visitados[$vizinho] = true;
                    $predecessores[$vizinho] = $atual; // Guarda quem trouxe até este vizinho.
                    $fila->enqueue($vizinho);
                }
            }
        }

        // Se a fila esvaziou e não encontra o destino, os nós estão desconectados.
        if (!$encontrou) {
            return [];
        }

        // Reconstruindo o caminho do Destino até a Origem (de trás para frente)
        $caminhoInvertido = [];
        $atual = $destino;

        while ($atual !== null) {
            $caminhoInvertido[] = $atual;
            // Busca de onde veio. Se não houver predecessor (chegou na Origem), vira null.
            $atual = $predecessores[$atual] ?? null;
        }

        // Inverte o array para ficar do início ao fim: [Origem -> ... -> Destino]
        $caminhoFinal = [];
        for ($i = count($caminhoInvertido) - 1; $i >= 0; $i--) {
            $caminhoFinal[] = $caminhoInvertido[$i];
        }

        return $caminhoFinal;
    }

    /**
     * Calcula e retorna o nível (distância/camada) de cada nó em relação ao nó inicial.
     * Utiliza o BFS com controle de profundidade.
     * Retorna um array associativo: [ 'NomeDoNo' => nivel (int) ]
     */

    public function obterNiveis(mixed $verticeInicio): array
    {
        // Se o vértice inicial não existir no grafo, retorna um array vazio.
        if (!isset($this->listaAdjacencia[$verticeInicio])) {
            return [];
        }

        $niveis = [];
        $fila = new MinhaFila();

        // O nó inicial começa no Nível 0
        $niveis[$verticeInicio] = 0;
        $fila->enqueue($verticeInicio);

        while (!$fila->isEmpty()) {
            $atual = $fila->dequeue();
            $nivelAtual = $niveis[$atual];

            // Explora os vizinhos do nó atual.
            foreach ($this->listaAdjacencia[$atual] as $vizinho) {
                // Se o vizinho ainda não recebeu um nível, significa que não foi visitado.
                if (!isset($niveis[$vizinho])) {
                    // O nível do vizinho é o nível do nó pai + 1
                    $niveis[$vizinho] = $nivelAtual + 1;
                    $fila->enqueue($vizinho);
                }
            }
        }

        return $niveis;
    }

    /**
     * Algoritmo DFS (Depth-First Search) - Busca em Profundidade.
     * Reutiliza a classe MinhaPilha (LIFO).
     * Explora um ramo até o final antes de recuar (backtracking).
     */
    public function dfs(mixed $verticeInicio): array
    {
        // Se o vétice inicial não existir no grafo, retorna um array vazio.
        if (!isset($this->listaAdjacencia[$verticeInicio])) {
            return [];
        }

        $visitados = [];
        $resultado = [];

        // Instaciando a classe MinhaPilha.
        $pilha = new MinhaPilha();

        // Empilha o ponto de partida.
        $pilha->push($verticeInicio);

        // Enquanto a pilha não estiver vazia.
        while (!$pilha->isEmpty()) {
            // Desempilhar o elemento do topo (LIFO).
            $atual = $pilha->pop();

            // Como um nó pode ser empilhado por rotas diferente, processa ao retirar.
            if (!isset($visitados[$atual])) {
                $visitados[$atual] = true;
                $resultado[] = $atual;

                // Empilahar todos os vizinhos não visitados.
                foreach ($this->listaAdjacencia[$atual] as $vizinho) {
                    if (!isset($visitados[$vizinho])) {
                        $pilha->push($vizinho);
                    }
                }
            }
        }

        return $resultado;
    }

    /**
     * Verifica se o grafo possui pelo menos um ciclo (loop de conexões).
     * Funciona tanto para grafos direcionados quanto não-direcionados.
     */
    public function temCiclo(): bool
    {
        $visitados = [];

        // Para grafos direcionados, controlar os nós no caminho atual
        $noCaminhoAtual = [];

        // Passar por todos os vértices para garantir que até grafos desconectados sejam validados

        foreach ($this->listaAdjacencia as $vertice => $vizinhos) {
            if (!isset($visitados[$vertice])) {
                if ($this->direcionado) {
                    if ($this->dfsDetectarCicloDirecionado($vertice, $visitados, $noCaminhoAtual)) {
                        return true;
                    }
                } else {
                    if ($this->dfsDetectarCicloNaoDirecionado($vertice, null, $visitados)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Auxiliar DFS para detecção de ciclo em Grafo NÃO-DIRECIONADO.
     */
    private function dfsDetectarCicloNaoDirecionado(mixed $atual, mixed $pai, array &$visitados): bool
    {
        $visitados[$atual] = true;

        foreach ($this->listaAdjacencia[$atual] as $vizinho) {
            // Se o vizinho ainda não foi visitado, avança recursivamente no ramo
            if (!isset($visitados[$vizinho])) {
                if ($this->dfsDetectarCicloNaoDirecionado($vizinho, $atual, $visitados)) {
                    return true;
                }
            } 
            // Se o vizinho JÁ foi visitado e NÃO é o pai direto, encontrou um ciclo!
            else if ($vizinho !== $pai) {
                return true;
            }
        }

        return false;
    }

    /**
     * Auxiliar DFS para detecção de ciclo em Grafo DIRECIONADO.
     */
    private function dfsDetectarCicloDirecionado(mixed $atual, array &$visitados, array &$noCaminhoAtual): bool
    {
        $visitados[$atual] = true;
        $noCaminhoAtual[$atual] = true; // Marca como parte do caminho atual do DFS.

        foreach ($this->listaAdjacencia[$atual] as $vizinho) {
            // Se o vizinho ainda não foi visitado.
            if (!isset($visitados[$vizinho])) {
                if ($this->dfsDetectarCicloDirecionado($vizinho, $visitados, $noCaminhoAtual)) {
                    return true;
                }
            } 
            // Se o vizinho JÁ ESTÁ no caminho atual do DFS, existe um ciclo direcionado!
            else if (isset($noCaminhoAtual[$vizinho]) && $noCaminhoAtual[$vizinho] === true) {
                return true;
            }
        }

        // Ao encerrar a exploração desse ramo, remove o nó do caminho atual (backtracking).
        $noCaminhoAtual[$atual] = false;

        return false;
    }
}
