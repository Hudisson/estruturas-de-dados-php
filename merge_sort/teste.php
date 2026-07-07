<?php

require_once __DIR__.'/Ordenador.php';

echo "=========================================\n";
echo "        TESTANDO MERGE SORT               \n";
echo "=========================================\n\n";

// Array totalmente bagunçado
$array_A = [38, 27, 43, 3, 9, 82, 10];
echo "Array totalmente bagunçado\n";
echo "Array original: [ ". implode(", ", $array_A) . "]\n";
$resultado_A = Ordenador::mergeSort($array_A);
echo "Array ordenado: [ ". implode(", ", $resultado_A) . "]\n";
echo "-------------------------------------------------------\n";

// Array com Números repetidos e negativos
$array_B = [12, -5, 3, 12, 0, -1, 3];
echo "Array com Números repetidos e negativos\n";
echo "Array original: [ ". implode(", ", $array_B) . "]\n";
$resultado_B = Ordenador::mergeSort($array_B);
echo "Array ordenado: [ ". implode(", ", $resultado_B) . "]\n";
echo "-------------------------------------------------------\n";

// Array de um único elemento
$array_C = [42];
echo "Array de um único elemento\n";
echo "Array original: [ ". implode(", ", $array_C) . "]\n";
$resultado_C = Ordenador::mergeSort($array_C);
echo "Array ordenado: [ ". implode(", ", $resultado_C) . "]\n";
echo "-------------------------------------------------------\n";