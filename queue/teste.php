<?php 

require_once 'MinhaFila.php';

$teste = new MinhaFila();

$valor = "AAAA";
$teste->enqueue($valor);

$valor = "BBBB";
$teste->enqueue($valor);

$valor = "CCCC";
$teste->enqueue($valor);

$valor = "DDDD";
$teste->enqueue($valor);

if($teste->isEmpty()){
    echo "A fila está vaia\n";
}else{
    echo "A fila não está vazia\n";
}

echo "Elemento do início da fila: ".$teste->front()."\n";

echo "Elemento removido: ".$teste->dequeue()."\n";

echo "Elemento do início da fila: ".$teste->front()."\n";