<?php

require_once __DIR__ . "/Grafo.php";

$rede = new Grafo(false);

// Montando a estrutura:
//         Alice
//        /     \
//     Bob       Charlie
//    /   \         \
// Daniel  Eva     Felipe

$rede->adicionarAresta("Alice", "Bob");
$rede->adicionarAresta("Alice", "Charlie");
$rede->adicionarAresta("Bob", "Daniel");
$rede->adicionarAresta("Bob", "Eva");
$rede->adicionarAresta("Charlie", "Felipe");

echo "=== Lista de Adjacência ===\n";
$rede->exibir();

echo "\n=== Comparação: BFS vs DFS (A partir de Alice) ===\n\n";

// Executando o BFS
$ordemBfs = $rede->bfs("Alice");
echo "BFS (Largura / Ondas)     : " . implode(" -> ", $ordemBfs) . "\n";


// Executando o DFS
$ordemDfs = $rede->dfs("Alice");
echo "DFS (Profundidade / Ramos): " . implode(" -> ", $ordemDfs) . "\n";