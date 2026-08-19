<?php

require_once __DIR__. "/Grafo.php";

$redeSocial = new Grafo(false);

echo "\n--- Montando a Rede Social ---\n";

// Alice conecta com Bob e Charlie
$redeSocial->adicionarAresta("Alice", "Bob");
$redeSocial->adicionarAresta("Alice", "Charlie");

// Bob conecta com Daniel e Eva
$redeSocial->adicionarAresta("Bob", "Daniel");
$redeSocial->adicionarAresta("Bob", "Eva");

// Daniel conecta com Felipe
$redeSocial->adicionarAresta("Daniel", "Felipe");

echo "\n--- Lista de Adjacência no Terminal ---\n";
$redeSocial->exibir();

echo "\n\n";
echo "--- Busca em Largura (BFS) com MinhaFila ---\n";

$pontosDeInicio = ['Alice', 'Bob', 'Charlie', 'Daniel'];

foreach ($pontosDeInicio as $apartir) {
    echo "\nA partir de [$apartir]\n";
    $ordemBfs = $redeSocial->bfs($apartir);
    
    echo implode(" -> ", $ordemBfs) . " -> FIM\n";
}

echo "\n";

echo "\n--- Buscando o Menor Caminho --- \n\n";

// Alice até Felipe (Alice -> Bob -> Daniel -> Felipe)
$origem = "Alice";
$destino = "Felipe";
$rota = $redeSocial->caminhoMaisCurto($origem, $destino);

echo "Caminho de [$origem] até [$destino]:\n";
echo implode(" -> ", $rota) . "\n\n";

//  Charlie até Eva (Charlie -> Alice -> Bob -> Eva)
$origem = "Charlie";
$destino = "Eva";
$rota = $redeSocial->caminhoMaisCurto($origem, $destino);

echo "Caminho de [$origem] até [$destino]:\n";
echo implode(" -> ", $rota) . "\n\n";

// Vértice inexistente
$origem = "Alice";
$destino = "Zack";
$rota = $redeSocial->caminhoMaisCurto($origem, $destino);

echo "Caminho de [$origem] até [$destino]:\n";
echo (empty($rota) ? "Caminho não encontrado!" : implode(" -> ", $rota)) . "\n\n";

echo "\n--- Nível de cada Nó a partir de [Alice] ---\n\n";
$niveis = $redeSocial->obterNiveis("Alice");

foreach ($niveis as $no => $nivel) {
    echo "Nó: [" . str_pad($no, 8) . "] | Nível: " . $nivel . "\n";
}

echo "\n";