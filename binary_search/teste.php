<?php

require_once __DIR__.'/Buscador.php';

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
$valor = 5;

$indice = Buscador::buscaBinaria($array, $valor);

echo "============Busca Binária============\n";

if($indice === -1) {
    echo "O valor {$valor} não foi encontrado no array.\n";
} else {
    echo "O valor {$valor} foi encontrado no índice: {$indice}\n";
}
