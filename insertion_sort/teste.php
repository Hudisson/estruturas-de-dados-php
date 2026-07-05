<?php

require_once __DIR__.'/Ordenador.php';

echo "=========================================\n";
echo "        TESTANDO INSERTION SORT          \n";
echo "=========================================\n\n";

$teste = [];

$teste[] = 6;
echo "Original:    [" . implode(", ", $teste) . "]\n";
$resultado = Ordenador::insertionSort($teste);
echo "Ordenado:    [" . implode(", ", $resultado) . "]\n\n";

$teste[] = 10;
echo "Original:    [" . implode(", ", $teste) . "]\n";
$resultado = Ordenador::insertionSort($teste);
echo "Ordenado:    [" . implode(", ", $resultado) . "]\n\n";

$teste[] = 9;
echo "Original:    [" . implode(", ", $teste) . "]\n";
$resultado = Ordenador::insertionSort($teste);
echo "Ordenado:    [" . implode(", ", $resultado) . "]\n\n";

$teste[] = 2;
echo "Original:    [" . implode(", ", $teste) . "]\n";
$resultado = Ordenador::insertionSort($teste);
echo "Ordenado:    [" . implode(", ", $resultado) . "]\n\n";

$teste[] = 17;
echo "Original:    [" . implode(", ", $teste) . "]\n";
$resultado = Ordenador::insertionSort($teste);
echo "Ordenado:    [" . implode(", ", $resultado) . "]\n\n";



