<?php

require_once __DIR__. "/Grafo.php";

$redeSocial = new Grafo(false);

echo "\n--- Montando a Rede Social ---\n";
$redeSocial->adicionarAresta("Alice", "Bob");
$redeSocial->adicionarAresta("Alice", "Charlie");
$redeSocial->adicionarAresta("Bob", "Daniel");

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