<?php

require_once 'MinhaPilha.php';

$teste = new MinhaPilha();

$valor = "AAAA";
$teste->push($valor);

$valor = "BBBB";
$teste->push($valor);

$valor = "CCCC";
$teste->push($valor);

$valor = "DDDD";
$teste->push($valor);

if($teste->isEmpty()){
    echo "A pilha está vazia\n";
}else{
    echo "A pilha não está vazia\n";
}

echo "Elemento do topo: ".$teste->peek() . "\n";


$teste->pop();

echo "Elemento do topo: ".$teste->peek() . "\n";