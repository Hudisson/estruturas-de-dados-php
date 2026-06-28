<?php

require_once 'ListaEncadeada.php';


$teste = new ListaEncadeada();

$teste->imprimir(); 

$valor = "AAAA";
$teste->adicionar($valor);

$valor = "BBBB";
$teste->adicionar($valor);

$valor = "CCCC";
$teste->adicionar($valor);

$valor = "DDDD";
$teste->adicionar($valor);

$teste->imprimir();

$remover = "CCCC";
$teste->remover($remover);

$teste->imprimir();


