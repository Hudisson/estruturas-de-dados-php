<?php
require_once __DIR__. '/Ordenador.php';
require_once __DIR__. '/../binary_search/Buscador.php';


echo "\n==========================Bubble Sort=========================\n\n";

// Um array completamente bagunçado
$dadosBaguncados = [57, 23, 42, 10, 85, 70, 11];
$alvo = 42;

echo "Array Original: " . implode(", ", $dadosBaguncados) . "\n";

//  Ordena
$dadosOrdenados = Ordenador::bubbleSort($dadosBaguncados);
echo "Array Ordenado: " . implode(", ", $dadosOrdenados) . "\n";

// Busca
$indice = Buscador::buscaBinaria($dadosOrdenados, $alvo);

if ($indice !== -1) {
    echo "O valor {$alvo} foi encontrado no índice {$indice} do array ordenado!\n";
} else {
    echo "O valor {$alvo} não existe no array.\n";
}

echo "\n=================================================================\n\n";