<?php

require_once __DIR__. "/Grafo.php";

$redeSocial = new Grafo(false);

echo "--- Montando a Rede Social ---\n";
$redeSocial->adicionarAresta("Alice", "Bob");
$redeSocial->adicionarAresta("Alice", "Charlie");
$redeSocial->adicionarAresta("Bob", "Daniel");

echo "\n--- Lista de Adjacência no Terminal ---\n";
$redeSocial->exibir();