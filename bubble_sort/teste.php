<?php

require_once __DIR__.'/Ordenador.php';

$teste = new Ordenador();

$dadosBaguncados = [57, 23, 42, 10, 85, 70, 11];

$dadosOrdenados = $teste::bubbleSort($dadosBaguncados);

echo "\n\n==========================Bubble Sort=========================\n\n";

echo "Array desordenado: ". implode(", ", $dadosBaguncados)."\n\n";

echo "Array Ordenado: ". implode(", ", $dadosOrdenados)."\n\n";

echo "=================================================================\n\n";

