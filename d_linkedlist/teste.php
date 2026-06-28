<?php

require_once 'ListaDuplamenteEncadeada.php';

$teste = new ListaDuplamenteEncadeada();

$valor = "10";
$teste->adicionarNoFim($valor);

$valor = "20";
$teste->adicionarNoFim($valor);

$valor = "30";
$teste->adicionarNoFim($valor);

$valor = "40";
$teste->adicionarNoFim($valor);

$valor = "00";
$teste->adicionarNoInicio($valor);

echo "\n--------------------------------------------------------------------\n";

echo "Lista: ";
$teste->imprimir();

echo "\n";

echo "--------------------------------------------------------------------\n";
$valorParaRemover = "50";
if($teste->removerPeloInicio($valorParaRemover)){
    echo "Item removido: '$valorParaRemover'\n";
    echo "Lista: ";
    $teste->imprimir();
} else {
    echo "O item '$valorParaRemover' não foi encontrado\n";
}

echo "--------------------------------------------------------------------\n";

$valorParaRemover = "20";
if($teste->removerPeloFim($valorParaRemover)){
    echo "Item removido: '$valorParaRemover'\n";
    echo "Lista: ";
    $teste->imprimir();
} else {
    echo "O item '$valorParaRemover' não foi encontrado\n";
}

echo "--------------------------------------------------------------------\n";


echo "Lista invertida: ";
$teste->imprimirInverso();

echo "\n--------------------------------------------------------------------\n";

$buscar = "30";
$resultado = $teste->buscar($buscar);

if($resultado !== null){
    echo "Elemento encontrado: ". $resultado->valor."\n";
}else {
    echo "Elemento não encontrado\n";
}

echo "\n--------------------------------------------------------------------\n";