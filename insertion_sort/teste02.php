<?php

require_once __DIR__.'/Ordenador.php';

echo "=========================================\n";
echo "        TESTANDO INSERTION SORT          \n";
echo "=========================================\n\n";

// --- CENÁRIO 1: Array Desordenado Padrão ---
$caso1 = [31, 41, 59, 26, 41, 58];
echo "Caso 1 - Original:    [" . implode(", ", $caso1) . "]\n";
$resultado1 = Ordenador::insertionSort($caso1);
echo "Caso 1 - Ordenado:    [" . implode(", ", $resultado1) . "]\n\n";


// --- CENÁRIO 2: Pior Cenário (Ordem Decrescente) ---
$caso2 = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
echo "Caso 2 - Original:    [" . implode(", ", $caso2) . "]\n";
$resultado2 = Ordenador::insertionSort($caso2);
echo "Caso 2 - Ordenado:    [" . implode(", ", $resultado2) . "]\n\n";


// --- CENÁRIO 3: Melhor Cenário (Já Ordenado) ---
$caso3 = [1, 2, 3, 4, 5];
echo "Caso 3 - Original:    [" . implode(", ", $caso3) . "]\n";
$resultado3 = Ordenador::insertionSort($caso3);
echo "Caso 3 - Ordenado:    [" . implode(", ", $resultado3) . "]\n\n";

echo "=========================================\n";

