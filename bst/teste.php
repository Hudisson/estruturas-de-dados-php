<?php

require_once __DIR__.'/ArvoreBinaria.php';

$arvore = new ArvoreBinaria();

echo "--- Inserindo elementos ---\n";
// O primeiro elemento (50) vira a RAIZ
$arvore->inserir(50);
$arvore->inserir(30);
$arvore->inserir(70);
$arvore->inserir(20);
$arvore->inserir(40);
$arvore->inserir(60);
$arvore->inserir(80);

echo "--- Estrutura da Árvore no Terminal ---\n";
echo "(Lido de lado: topo é a direita, base é a esquerda)\n\n";

$arvore->exibir();

echo "\n--- Testando Busca na Árvore ---\n\n";

// Testes de elementos que EXISTEM
echo "Busca por 50: " . ($arvore->buscar(50) ? "Encontrado!" : "Não encontrado") . "\n";
echo "Busca por 20: " . ($arvore->buscar(20) ? "Encontrado!" : "Não encontrado") . "\n";
echo "Busca por 70: " . ($arvore->buscar(70) ? "Encontrado!" : "Não encontrado") . "\n\n";

// Testes de elementos que NÃO EXISTEM
echo "Busca por 99: " . ($arvore->buscar(99) ? "Encontrado!" : "Não encontrado") . "\n";
echo "Busca por 10: " . ($arvore->buscar(10) ? "Encontrado!" : "Não encontrado") . "\n";